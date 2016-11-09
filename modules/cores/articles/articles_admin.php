<?php

	class articles_admin{
		function __construct() {
			global $vsTemplate, $vsStd;

			$vsStd->requireFile(CORE_PATH.'articles/articles.php');
			$this->model = new articles();
			$this->tableName = 'article';
			
			$this->html = $vsTemplate->load_template('skin_articles');
		}
		
        function auto_run() {
			global $bw;
	
			switch ($bw->input['action']) {
				case 'edit' :
						$this->editObj($bw->input[2]);
					break;	

				case 'objTab':
						$this->getObjTab();
					break;

				case 'list' :
						$this->getList();
					break;

				case 'update':
						$this->updateStatus();
					break;

				case 'delete':
						$this->deleteObj($bw->input[2], $bw->input[3]);
					break;

				default :
						$this->loadDefault();
					break;
			}
		}
	
		function updateStatus(){
			global $bw, $vsStd;
			
			$status = 0;
			if($bw->input['status'] == 'enable') $status = 1;
			$this->model->setCondition("articleId in ({$bw->input[2]})");
			$this->model->updateObjectByCondition(array("articleStatus" => $status));
			
			return $this->output = $this->getList($bw->input[3]);
		}
	
		function deleteObj($ids, $cat = 0){
			global $bw, $vsStd, $vsCom;
		
			$this->model->setCondition("articleId IN (".$ids.")");
			$list = $this->model->getObjectsByCondition();
			if(!count($list)) return false;
			
			$this->model->setCondition("articleId IN (".$ids .")");
			if(!$this->model->deleteObjectByCondition()) return false;
			
			foreach ($list as $news)
				$this->model->vsFile->deleteFile($news->getImage());
			
			unset($bw->input[2]);
			unset($bw->input[3]);
			
			$vsStd->requireFile(CORE_PATH.'search/searchs.php');
			$search = new searchs();
			$search->deleteSearch($bw->input[0], $ids);
			
			$vsCom->SEO->deleteSEO($bw->input[0], $ids);
			
			return $this->output = $this->getList($cat);
		}
	
		function getObjTab() {
			global $bw, $vsSettings;
			if ($vsSettings->getSystemKey($bw->input[0] . '_category_list', 0, $bw->input[0]))
				$option['catList'] = $this->getCategoryBox();
			
			$option['objList'] = $this->getList();
			$this->output = $this->html->displayObjTab ( $option );
		}
	
		function getList($catId = '', $message = "") {
			global $bw, $vsSettings, $vsMenu;
			$catId = intval($catId);
	              
			$categories = $this->model->getCategories();
			
			$strIds = $vsMenu->getChildrenIdInTree($categories);
			if(intval($catId)){
				$result = $vsMenu->extractNodeInTree($catId, $categories->getChildren());
				if($result)
					$strIds = trim($catId.",".$vsMenu->getChildrenIdInTree($result['category']), ",");
			}
			
						
			$this->model->setCondition("articleCatId IN (".$strIds.") AND articleStatus >= 0" );
			
			$size = $vsSettings->getSystemKey("{$bw->input[0]}_list_quantity", 10);
			
			$option = $this->model->getPageList("{$bw->input[0]}/list/".$catId, 3, $size, 1, 'obj-panel' );
			
			$option['message'] = $message;
			$option['catId'] = $catId;

			return $this->output = $this->html->getList($option);
		}
	
		function editObj($objId = 0, $option = array()) {
			global $vsLang, $vsStd, $bw, $vsSettings, $vsCom;

			if($bw->input['submit']) return $this->editProcess();
			
			$obj = $this->model->createBasicObject();
			$obj->setTime(time());
			$obj->prefix = $bw->input[0].'/detail/';
			
			$option ['formSubmit'] = $vsLang->getWords('editForm_add_button','Add');
			$option ['formTitle'] = $vsLang->getWords('editForm_add_title','Add '.$bw->input[0]);
			if ($objId) {
	            $option ['formSubmit'] = $vsLang->getWords('editForm_edit_button','Edit');
				$option ['formTitle'] = $vsLang->getWords('editForm_edit_title','Edit '.$bw->input[0]);
				
				$model = $vsCom->SEO;
				
				$seo = $model->getSEOByModuleOBJ($bw->input[0], $objId);
				$obj = $this->model->getObjectById($objId);
				
				$obj->metaURL = $seo['seoAliasUrl'];
				$obj->metaTitle = $seo['seoTitle'];
				$obj->metaKeyword = $seo['seoKeyword'];
				$obj->metaDesc = $seo['seoIntro'];
			} 
	               
			$vsStd->requireFile ( JAVASCRIPT_PATH . "/tiny_mce/tinyMCE.php" );
			$editor = new tinyMCE ();
			if($vsSettings->getSystemKey($bw->input[0].'_intro_editor', 1, $bw->input[0])){
				$editor->setWidth ( '100%' );
				$editor->setHeight ( '150px' );
				$editor->setToolbar ( 'simple' );
				$editor->setTheme ( "advanced" );
				$editor->setInstanceName("articleIntro");
				$editor->setValue($obj->getIntro());
				$obj->setIntro($editor->createHtml());
			}else $obj->setIntro ('<textarea name="articleIntro" style="width:100%; height:100px;">'. strip_tags($obj->getIntro()) .'</textarea>');
	                   
			$editor->setWidth ( '100%' );
			$editor->setHeight ( '350px' );
			$editor->setToolbar ( 'full' );
			$editor->setTheme ( "advanced" );
			$editor->setInstanceName ( "articleContent" );
			$editor->setValue ( $obj->getContent () );
			$obj->setContent ( $editor->createHtml () );
			
			return $this->output = $this->html->editObj($obj, $option);
	}
	
		function editProcess() {
			global $bw, $vsStd, $vsLang, $vsFile, $vsSettings;
			
			unset($bw->input['submit']);
			
			if($bw->input['articleTime']){
				$vsStd->requireFile(LIBS_PATH.'DateTime.class.php');
				$datetime = new VSFDateTime();
				$datetimeArray  	= explode("/",$bw->input['articleTime']);
				$datetime->month 	= $datetimeArray[0];
				$datetime->day	 	= $datetimeArray[1];
				$datetime->year 	= $datetimeArray[2];
				$bw->input['articleTime'] = $datetime->TimeToInt();
			}else $bw->input['articleTime'] = time();
			
			$bw->input["articleStatus"] = $bw->input["articleStatus"] ? $bw->input["articleStatus"] : 0;
			
			if(!$bw->input["articleCatId"]) $bw->input["articleCatId"] = $this->model->getCategories()->getId();
	                        
			$bw->input["articleImage"] = $bw->input['fileId'];
			
			if($bw->input["articleId"]) {
				$obj = $this->model->getObjectById($bw->input["articleId"] );
	                        
				$imageOld = $obj->getImage();

				if($bw->input['deleteImage']){
					$imageOld = $obj->getImage();
					if($imageOld) $vsFile->deleteFile($imageOld);
				}
				
				$objUpdate = new Article();
				$objUpdate->convertToObject($bw->input);
	                       
				$this->model->updateObjectById ( $objUpdate );
				if($this->model->result ['status']) {
					$alert = $vsLang->getWords('edit_successful','You have edited your article');
					$javascript = <<<EOF
							<script type='text/javascript'>
								jAlert(
									"{$alert}",
									"{$bw->vars['global_websitename']} Dialog"
								);
							</script>
EOF;
					$this->convertToSearch(1);
					$this->convertToSEO(1);
				}
			} else {
	            $bw->input["articlePostDate"] = time();           
				$this->model->obj->convertToObject($bw->input);
				
				$this->model->insertObject();
				if ($this->model->result ['status']) {
					$confirmContent = $vsLang->getWords('add_successful','You have added a new article'). '\n' . $vsLang->getWords('add_more','Do you want to add more?');
					$javascript = <<<EOF
						<script type='text/javascript'>
							jConfirm(
								"{$confirmContent}",
								'{$bw->vars['global_websitename']} Dialog',
								function(r){
									if(r){
										vsf.get("{$bw->input[0]}/edit/&pageIndex={$bw->input['pageIndex']}&pageCate={$bw->input['pageCate']}", 'obj-panel');
									}
								}
							);
						</script>
EOF;
					$this->convertToSearch();
					$this->convertToSEO();
				}
			}
			if($imageOld && $bw->input['fileId']) $vsFile->deleteFile($imageOld);

			return $this->output = $javascript . $this->getList();
	}
	

	
	
	function convertToSEO($update = 0){
		global $bw, $vsCom;
		
		$sData = array();
		$i = 0;
		$id = $this->model->obj->getId();
		$title = $this->model->obj->getTitle();
		$sData[$i]['seoRealUrl'] 	= $bw->input[0]."/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')).'-'.$id;
		$sData[$i]['seoAliasUrl'] 	= $bw->input['metaURL'];
		$sData[$i]['seoTitle'] 		= $bw->input['metaTitle'];
		$sData[$i]['seoKeyword'] 	= $bw->input['metaKeyword'];
		$sData[$i]['seoIntro'] 		= $bw->input['metaDesc'];
		$sData[$i]['seoModule'] 	= $bw->input[0];
		$sData[$i]['seoObj'] 		= $id; 
		$sData[$i]['seoType'] 		= 1;
		
		$model = $vsCom->SEO;
		
		if($update){
			$cond = 'seoObj = '.$id.' AND seoModule = "'.$bw->input[0].'"';
			$sData = current($sData);
			
			$model->singleUpdate($sData, $cond);
			return true;
		}
		
		$sData[$i]['seoAliasUrl'] .= '-'.$id;
		$model->multiInsert($sData);
	}
	
	function convertToSearch($update = 0){
		global $bw;
		
		$cId = $this->model->obj->getId();
		$sData = array();
		$sData[$cId]['searchOTitle'] = $bw->input['articleTitle'];
		$sData[$cId]['searchOIntro'] = VSFTextCode::cutString($bw->input['articleContent'], 1024);
		
		$url = $bw->input['metaURL'];
		if(!$url){
			$title = strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($bw->input['articleTitle'])),'-'));
			$url = $bw->input[0].'/detail/'.$title.'-'.$cId;
		}
		$value['articleTitle'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['articleTitle'])),' '));
		$value['articleContent'] = strtolower(VSFTextCode::removeAccent(str_replace("/", ' ', trim($bw->input['articleContent'])),' '));
		
		$sData[$cId]['searchModule'] = $bw->input[0];
		$sData[$cId]['searchObj'] = $cId;
		$sData[$cId]['searchTitle'] =  $value['articleTitle'];
		
		
		$sData[$cId]['searchUrl'] =  $url;
		$content = $value['articleTitle'] . ' ' . $value['articleContent'];
		$sData[$cId]['searchContent'] = $content;

		global $vsStd;
		$vsStd->requireFile(CORE_PATH.'search/searchs.php');
		
		$model = new searchs();
		if($update){
			$cond = 'searchObj = '.$cId.' AND searchModule = "'.$bw->input[0].'"';
			$sData = current($sData);
			$model->singleUpdate($sData, $cond);
		}
		else $model->multiInsert($sData);
	}
	
	function loadDefault() {
		global $vsPrint;
		
		$vsPrint->addJavaScriptFile ( "tiny_mce/tiny_mce" );
		$vsPrint->addJavaScriptString ( 'init_tab', '
			$(document).ready(function(){
    			$("#page_tabs").tabs({
    				cache: false
    			});
  			});
		' );

		$vsPrint->addJavaScriptFile("jquery/ui.datepicker", 1);
		$vsPrint->addCSSFile('ui.datepicker', 1);
		
		$this->output = $this->html->loadDefault();
	}
	
	public function getHtml() {
		return $this->html;
	}
	
	public function getOutput() {
		return $this->output;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function setOutput($output) {
		$this->output = $output;
	}
}
?>
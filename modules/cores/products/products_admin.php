<?php
class products_admin extends ObjectAdmin{
	function __construct(){
            global $vsTemplate,$vsPrint;
		parent::__construct('products', CORE_PATH.'products/', 'products');
		//$vsPrint->addJavaScriptFile("jquery/ui.datepicker");
		//$vsPrint->addCSSFile('ui.datepicker');
   		$this->html = $vsTemplate->load_template('skin_products');
   		$this->getListBrand();
                 
	}
        
function auto_run() {
		global $bw,$search_module,$vsSettings,$vsPrint;
		
	
		switch ($bw->input ['action']) {
			
			case 'visible-checked-obj' :
				$this->checkShowAll(1);
				break;
			
			case 'home-checked-obj' :
				$this->checkShowAll(2);
				break;
			
			case 'hide-checked-obj' :
				$this->checkShowAll(0);
				break;
			case 'banchay-checked-obj' :
				$this->checkShowAll(3);
				break;
			case 'display-obj-tab' :
				$this->displayObjTab ();
				break;
			
			case 'display-obj-list' :
				$this->getObjList ( $bw->input [2], $this->model->result ['message'] );
				break;
			
			case 'add-edit-obj-form' :
				$this->addEditObjForm ( $bw->input [2] );
				break;
			
			case 'add-edit-obj-process' :
				$this->addEditObjProcess ();
				break;
			
			case 'change-objlist-bt' :
				$this->model->changeCateList ();
				$this->getObjList ();
				break;
			case 'insertSearch-objlist-bt' :
				$this->model->insertSearch ();	
				$this->getObjList ();
				break;
			case 'delete-obj' :
				$this->deleteObj($bw->input[2]);
				break;
			case 'display_list_news_comments':
				$this->displayListNewsComments($bw->input [2], $this->module->result ['message'] );
				break;
			case 'create_rss_file':
             	$this->createRSS($bw->input[2]);
              	break;
           	case 'search':
             	$this->search();
              	break;
           	case 'reorder':
           		$this->reorder();
           		break;
			default :
				$this->loadDefault ();
				break;
		}
	}
	function reorder(){
		global $bw;
		
		switch($bw->input[2]){
			case 1:
				$order = $this->tableName.'Status';
				break;
			case 2:
				$order = $this->tableName.'Status DESC';
				break;
			default:
				$order = $this->tableName.'Id DESC';
				break;
		}
		global $bw, $vsSettings;
		$catId = $bw->input['pcategory'];
		$catId = intval($catId);

		$categories = $this->model->getCategories ();

		if ($bw->input['pageCate'])
			$bw->input[2] = $catId = $bw->input['pageCate'];
		if ($bw->input['pageIndex'])
			$bw->input[3] = $bw->input ['pageIndex'];
		
		if (intval ( $catId )) {
			$result = $this->model->vsMenu->extractNodeInTree($catId, $categories->getChildren());
			if($result){
				$strIds = trim ( $catId . "," . $this->model->vsMenu->getChildrenIdInTree ( $result ['category'] ), "," );
				if($result['ids']){
					global $vsMenu, $vsLang;
	           		$result['ids'] = array_reverse($result['ids']);
	           		$subbreadcumbs = $vsLang->getWords('subbreadcumbs_'.$bw->input[0], $bw->input[0]).' › ';
	             	foreach($result['ids'] as $b){
	              		$mobj = $vsMenu->getCategoryById($b);
	                 	if($mobj) $subbreadcumbs .= "{$mobj->getTitle()} › ";
	             	}
	             	$subbreadcumbs = trim($subbreadcumbs, '› ');
	      		}
			}
		}
		if (!$strIds)
			$strIds = $this->model->vsMenu->getChildrenIdInTree ( $categories );		

		$cond .= $this->model->getCategoryField () . " IN (" . $strIds . ") AND {$this->tableName}Status > -1";
		$this->model->setCondition($cond);
		$this->model->setOrder($order);
		$url = $bw->input[0]."/search/";
		$size = $vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number", 10);
		
		$option = $this->model->getPageList($url, 3, $size, 1, 'obj-panel');
	
		if($vsSettings->getSystemKey($bw->input[0].'_comment',0, $bw->input[0], 1, 1)) $option['modulecomment'] = array();
   		
		if(count($option['pageList'])){
       		require_once CORE_PATH . 'comments/comments_public.php';
  			$comments = new comments ();
  			$comments->setFieldsString("id,objId,module");
			$comments->setCondition("module = '{$bw->input['module']}'");
			$comments->setGroupby("objId");
			$option['modulecomment'] = array_keys($comments->countTable());
       	}
		
       	$option ['categoryId'] = $catId;
		$option['subbreadcumbs'] = $subbreadcumbs;
		$option['order'] = $bw->input[2];
    	
		return $this->output = $this->html->objListHtml($this->model->getArrayObj(), $option);
	}
	
	function search(){
		global $bw;
		
		$cond = ''; $suburl = '';
		if($bw->input['scode']){
			$cond .= $this->tableName.'Code like "%'.trim($bw->input['scode'],' ').'%" AND ';
			$suburl .= 'scode='.$bw->input['scode'].'&';
		}
		global $bw, $vsSettings;
		$catId = intval ( $catId );
              
		$categories = $this->model->getCategories ();

		if ($bw->input['pageCate'])
			$bw->input[2] = $catId = $bw->input ['pageCate'];
		if ($bw->input['pageIndex'])
			$bw->input[3] = $bw->input ['pageIndex'];
		
		if (intval ( $catId )) {
			$result = $this->model->vsMenu->extractNodeInTree($catId, $categories->getChildren());
			if($result){
				$strIds = trim ( $catId . "," . $this->model->vsMenu->getChildrenIdInTree ( $result ['category'] ), "," );
				if($result['ids']){
					global $vsMenu, $vsLang;
	           		$result['ids'] = array_reverse($result['ids']);
	           		$subbreadcumbs = $vsLang->getWords('subbreadcumbs_'.$bw->input[0], $bw->input[0]).' › ';
	             	foreach($result['ids'] as $b){
	              		$mobj = $vsMenu->getCategoryById($b);
	                 	if($mobj) $subbreadcumbs .= "{$mobj->getTitle()} › ";
	             	}
	             	$subbreadcumbs = trim($subbreadcumbs, '› ');
	      		}
			}
		}
		if (!$strIds)
			$strIds = $this->model->vsMenu->getChildrenIdInTree ( $categories );		

		$cond .= $this->model->getCategoryField () . " IN (" . $strIds . ") AND {$this->tableName}Status > -1";
		$this->model->setCondition($cond);
		
		$url = $bw->input[0]."/search/";
		$size = $vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number", 10);
		$bw->input['advance'] = '/&'.$suburl;
		$option = $this->model->getPageList($url, 3, $size, 1, 'obj-panel');
	
		if($vsSettings->getSystemKey($bw->input[0].'_comment',0, $bw->input[0], 1, 1)) $option['modulecomment'] = array();
   		
		if(count($option['pageList'])){
       		require_once CORE_PATH . 'comments/comments_public.php';
  			$comments = new comments ();
  			$comments->setFieldsString("id,objId,module");
			$comments->setCondition("module = '{$bw->input['module']}'");
			$comments->setGroupby("objId");
			$option['modulecomment'] = array_keys($comments->countTable());
       	}
		
       	$option ['categoryId'] = $catId;
		$option['subbreadcumbs'] = $subbreadcumbs;
    	
		return $this->output = $this->html->objListHtml($this->model->getArrayObj(), $option);	
	}
	
	
	function addEditObjForm($objId = 0, $option = array()) {
		global $vsLang, $vsStd, $bw, $vsPrint,$vsSettings,$search_module,$langObject;
		
		$option['skey'] = $bw->input['module'];
		$obj = $this->model->createBasicObject ();
		$method = 'preset_'.$bw->input['module'];
               
		if(method_exists($this->html,$method))
		$obj->setContent($this->html->$method());
		
		$option ['formSubmit'] = $langObject['itemFormAddButton'];
		$option ['formTitle'] = $langObject['itemFormAdd'];
		if ($objId) {
			$option ['formSubmit'] = $langObject['itemFormEditButton'];
			$option ['formTitle'] = $langObject['itemFormEdit'];
			$obj = $this->model->getObjectById ( $objId ,1);
		} 
              
		$vsPrint->addJavaScriptFile ( "tiny_mce/tiny_mce" );
		$vsStd->requireFile ( JAVASCRIPT_PATH . "/tiny_mce/tinyMCE.php" );
		$editor = new tinyMCE ();
		if($vsSettings->getSystemKey($option['skey'].'_intro_editor', 1, $option['skey'])){
			$editor->setWidth ( '100%' );
			$editor->setHeight ( '150px' );
			$editor->setToolbar ( 'simple' );
			$editor->setTheme ( "advanced" );
			$editor->setInstanceName ( "{$this->tableName}Intro" );
			if($obj->getIntro()){
				$editor->setValue($obj->getIntro());
			}else{
				$val=$vsSettings->getSystemKey($bw->input[0]."_introdefault{$vsLang->currentLang->getFoldername()}", 0, $bw->input[0], 1, 1);
				if(!is_numeric($val)){
					$editor->setValue($vsSettings->getSystemKey($bw->input[0]."_introdefault{$vsLang->currentLang->getFoldername()}", 0, $bw->input[0], 1, 1));
				}else
					 $editor->setValue($obj->getIntro());	
			}
			$obj->setIntro ( $editor->createHtml () );
		}else
			$obj->setIntro ('<textarea name="'.$this->tableName.'Intro" style="width:100%;height:100px;">'. strip_tags($obj->getIntro()) .'</textarea>');
                   
		$editor->setWidth ( '100%' );
		$editor->setHeight ( '350px' );
		$editor->setToolbar ( 'full' );
		$editor->setTheme ( "advanced" );
		$editor->setInstanceName ( "{$this->tableName}Content" );
		if($obj->getContent()){
			$editor->setValue($obj->getContent());
		}else{
			$val=$vsSettings->getSystemKey($bw->input[0]."_contentdefault{$vsLang->currentLang->getFoldername()}", 0, $bw->input[0], 1, 1);
			if(!is_numeric($val)){
				$editor->setValue($vsSettings->getSystemKey($bw->input[0]."_contentdefault{$vsLang->currentLang->getFoldername()}", 0, $bw->input[0], 1, 1));
			}else
				 $editor->setValue($obj->getContent());
				
		}
		$obj->setContent ( $editor->createHtml () );
		$option['bra']= $obj->getBrand();
		$option['co']=array();
                if($obj->getColor())
                    $option['co'] = explode(",", $obj->getColor());
		return $this->output = $this->html->addEditObjForm ( $obj, $option );
	}
	
	function addEditObjProcess() {
		global $bw, $vsStd, $vsLang, $vsFile,$DB,$vsSettings,$search_module,$langObject;

		$bw->input ["{$this->tableName}Promo"] = $bw->input ["{$this->tableName}HotPrice"] ? 1:0;		
		
		$bw->input ["{$this->tableName}Status"] = $bw->input ["{$this->tableName}Status"] ? $bw->input ["{$this->tableName}Status"] : 0;
              
		$bw->input['productBrand']=$bw->input['productBrand'] ?  $bw->input['productBrand']:0;
		if($bw->input['productBrand']!=0)
		$bw->input['productColor'] = $bw->input['productColor'] ?  implode(",", $bw->input['productColor'][$bw->input['productBrand']]):0;
		else 
		$bw->input['productColor'] = 0;
		if (! $bw->input ["{$this->tableName}CatId"])
			$bw->input ["{$this->tableName}CatId"] = $this->model->getCategories ()->getId ();
                        
		if ($bw->input ['fileId'])
			$bw->input ["{$this->tableName}Image"] = $bw->input ['fileId'];
                elseif($bw->input['txtlink'])
			$bw->input["{$this->tableName}Image"]=$vsFile->copyFile($bw->input["txtlink"],$bw->input[0]);
		
			
		// If there is Object Id passed, processing updating Object
		if ($bw->input ["{$this->tableName}Id"]) {
			$obj = $this->model->getObjectById ( $bw->input ["{$this->tableName}Id"] );
			$bw->input['productArrayColor']=$obj->arrayColor?$obj->arrayColor:array();
			if(is_array($_REQUEST['productColor'])){
				foreach ($_REQUEST['productColor'] as $colorId) {
					if($bw->input['file_color_'.$colorId]){
						$bw->input['productArrayColor'][$colorId]=$bw->input['file_color_'.$colorId];
						if($obj->arrayColor[$colorId]){
							$files=new files();
							$files->deleteFile($obj->arrayColor[$colorId]);
						}
					}
				}
			}            
			$imageOld = $obj->getImage ();
                        if($bw->input['deleteImage']){
				$imageOld = $obj->getImage();
				if($imageOld) $vsFile->deleteFile($imageOld);
				if(!$bw->input["{$this->tableName}Image"]) $bw->input["{$this->tableName}Image"] = 0;
			}
			
			//if($bw->input['productBrand']!=$obj->getBrand())
				 
		    
			$objUpdate = $this->model->createBasicObject ();
			$objUpdate->convertToObject ( $bw->input );

			if($vsSettings->getSystemKey($bw->input[0].'_tags',0, $bw->input[0])){
			/**add tags process***/
			require_once CORE_PATH.'tags/tags.php';
			$tags=new tags();
			$tags->addTagForContentId($bw->input[0], $this->model->obj->getId(), $bw->input['tags_submit_list']);
			/****/
			}

			$this->model->updateObjectById ( $objUpdate );
			if ($this->model->result ['status']) {
				$alert = $langObject['itemEditSuccess'];
				$javascript = <<<EOF
						<script type='text/javascript'>
							jAlert(
								"{$alert}",
								"{$bw->vars['global_websitename']} Dialog"
							);
						</script>
EOF;
			}
		} else {
			if(is_array($_REQUEST['productColor'])){
				foreach ($_REQUEST['productColor'] as $colorId) {
					if($bw->input['file_color_'.$colorId]){
						$bw->input['productArrayColor'][$colorId]=$bw->input['file_color_'.$colorId];
					}
				}
				
			}
            $bw->input["{$this->tableName}PostDate"] = time();
			$this->model->obj->convertToObject($bw->input);
			
			$this->model->insertObject();
			if ($this->model->result ['status']) {
				if(!$bw->input['productIndex']){
					global $DB, $vsMenu;
					$catids = $vsMenu->getChildrenIdInTree($this->model->getCategories());
					$DB->simple_construct(
						array(	'select'	=> "max(productIndex) as total",
								'from'		=> 'product',
								'where'		=> 'productCatId IN ('.$catids.')'
						)
					);
					$DB->simple_exec();
					$result = $DB->fetch_row();
				
					$newindex = $result['total']?$result['total']:0;
					
					$this->model->obj->setIndex($newindex+1);
					$this->model->updateObject();
				}
				$confirmContent = $langObject['itemAddSuccess'] . '\n' . $langObject['itemAddAnother'] ." ?";
				$javascript = <<<EOF
					<script type='text/javascript'>
						jConfirm(
							"{$confirmContent}",
							'{$bw->vars['global_websitename']} Dialog',
							function(r){
								if(r){
									vsf.get("{$bw->input[0]}/add-edit-obj-form/&pageIndex={$bw->input['pageIndex']}&pageCate={$bw->input['pageCate']}",'obj-panel');
								}
							}
						);
					</script>
EOF;
			}
		}
		if ($imageOld && $bw->input ['fileId']) {
			$vsFile->deleteFile ( $imageOld );
		}
		
        //convert to Search
		if (in_array($bw->input['module'], $search_module)){
                    if($bw->input['searchRecord']){
                        $vsStd->requireFile(CORE_PATH."searchs/searchs.php");
                        $search = new searchs();
                        $search->setCondition("searchRecord  = ".$bw->input['searchRecord']);
                        $search->updateObjectByCondition($this->model->obj->convertSearchDB());
                    }
                    elseif(isset ($bw->input['searchRecord'])){
                        $DB->do_insert("search",$this->model->obj->convertSearchDB());
                    }
		}
		      
        //end convert to Search
		$cat = $bw->input ['pageCate'] ? $bw->input ['pageCate'] : $bw->input ['pageCatId'];
		$vsFile->buildCacheFile ( $bw->input ['module'] );
		return $this->output = $javascript . $this->getObjList ();
	}
	
	function getListBrand(){
   		global $vsStd,$vsMenu,$opt;
      	$vsStd->requireFile(CORE_PATH."pages/pages.php");
       	$pages = new pages();
      
      	$categories = $vsMenu->getCategoryGroup('brands');
       	$strIds = $vsMenu->getChildrenIdInTree($categories);
      	$opt['brand']= $categories->getChildren();
       	$pages->setCondition("pageStatus > 0 and pageCatId in ({$strIds})");
      	$pages->setOrder("pageCatId ASC ");
      	$opt['color'] = $pages->getObjectsByCondition();
       	$color = $pages->getObjectsByCondition('getCatId',1);
 
     	foreach ($color as $key => $val){
     		$pages->convertFileObject($val,'brands');
       		if( $opt['brand'][$key])
           		$opt['brand'][$key]->list = $val;
      	}

  
	}
}

?>
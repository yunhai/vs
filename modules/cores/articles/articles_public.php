 <?php
 
/*
 +-----------------------------------------------------------------------------
 |   VS FRAMEWORK 3.0.0
 |	Author: BabyWolf
 |	Homepage: http://vietsol.net
 |	If you use this code, please don't delete these comment line!
 |	Start Date: 21/09/2004
 |	Finish Date: 22/09/2004
 |	Version 2.0.0 Start Date: 07/02/2007
 |	Version 3.0.0 Start Date: 03/29/2009
 +-----------------------------------------------------------------------------
 */
if(!defined( 'IN_VSF')){
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}

	require_once(CORE_PATH."articles/articles.php");
	class articles_public{
	

		function auto_run(){
			global $bw, $vsSettings, $vsTemplate;
	
			switch($bw->input['action']){
				case 'detail':
						$this->loadDetail($bw->input[2]);
					break;
					
				default:
						$this->loadDefault();
					break;
			}
		}


		function loadDefault(){
            global $vsPrint, $vsLang, $bw,$vsSettings,$vsTemplate,$vsStd,$vsMenu;
            
          
            $categories = $vsMenu->getCategoryGroup($bw->input['module']);
            $strIds = $vsMenu->getChildrenIdInTree($categories);
            
            
            $this->model->setFieldsString('articleId, articleTitle, articleContent, articleTime, articleImage, vsf_seo.*');
            $this->model->setTableName("article, vsf_seo");
            
            $this->model->setCondition("articleId = seoObj AND seoModule = '".$bw->input[0]."' AND articleCatId in ({$strIds}) and articleStatus > 0");
            $this->model->setOrder('articleId DESC');
            
            $url = $bw->input['module']."/";
            $size = $vsSettings->getSystemKey($bw->input['module'].'_user_item_quality', 10, $bw->input['module'], 1);
            $pIndex = 1;
            
            $extent = array('seourl'=>'seoAliasUrl');
            $option = $this->model->getAdvancePageList($url, $pIndex, $size, 0, "", 'getId', 0, 2, $extent);
            
			$cclass = array('even','odd');
			foreach($option['pageList'] as $key => $page)
				$option['pageList'][$key]->cclass = $cclass[($page->stt)%2];
				
            $this->output = $this->html->loadDefault($option);
		}

		function loadDetail($pageId){
			global $bw, $vsPrint, $vsSettings, $vsTemplate,$vsStd;              
			
			$query = explode('-',$pageId);
			$pageId = intval($query[count($query)-1]);
			
			if(!$pageId) return $vsPrint->boink_it($bw->base_url.'error');
			
			$this->model->setTableName('article, vsf_seo');
			
			$cond = 'articleId = seoObj AND seoModule = "'.$bw->input[0].'" AND articleId <= '.$pageId .' AND articleStatus > 0';
			$this->model->setCondition($cond);
			$this->model->setLimit(array(0, 6));
			$this->model->setOrder('articleId DESC');
			
            
            $extent = array('seourl'=>'seoAliasUrl');
			$list = $this->model->getAdvanceObjectsByCondition('getId', 0, 2, $extent);
			
			$option['obj'] = array_shift($list);
			$option['other'] = $list;

			$this->output = $this->html->loadDetail($option);
		}


	
		protected $html;
		protected $model;
		protected $output;
		
		function __construct(){
			global $bw, $vsPrint, $vsTemplate;
			
			$this->html = $vsTemplate->load_template('skin_articles');
			$this->model = new articles();
			
			$vsPrint->addCSSFile('article');
		}
	
		function setOutput($out){
			return $this->output = $out;
		}
	
		function getOutput(){
			return $this->output;
		}
}
?>

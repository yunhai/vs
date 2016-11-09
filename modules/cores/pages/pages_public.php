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

require_once(CORE_PATH."pages/pages.php");
class pages_public{
	protected $html;
	protected $module;
	protected $output;
	
	function __construct(){
		global $vsTemplate,$bw,$vsModule;
		$this->html = $vsTemplate->load_template('skin_pages');
		$this->module = new pages();
	}

	function auto_run(){
		global $bw, $vsSettings, $vsTemplate;

		switch($bw->input['action']){
			case 'detail':
					$this->loadDetail($bw->input[2]);
				break;
				
			case 'category':
					$this->loadCategory($bw->input[2]);
				break;

                        case 'service' :
                                $this->showService($bw->input[2]);
                                break;
                            
			default:
					$this->loadDefault();
				break;
		}
	}

        function showService($pageId){
            global $vsPrint, $vsLang, $bw,$vsSettings,$vsTemplate,$vsStd,$vsMenu;
            
            $categories = $vsMenu->getCategoryGroup($bw->input['module']);
            $strIds = $vsMenu->getChildrenIdInTree($categories);
            $this->module->setOrder('pageIndex ASC,pageId DESC');
            $this->module->setCondition("pageCatId in ({$strIds}) and pageStatus > 0 ");
            $this->module->setTableName ("page left join vsf_file on pageImage = fileId");
            $list = $this->module->getObjectsByCondition();
            if(count($list)==0) return $this->output ="no data";
           if($pageId){
                $query = explode('-',$pageId);
                $pageId = intval($query[count($query)-1]);
                $option['show'] = $list[$pageId];
           }
           if(!$option['show'])$option['show']=current($list);
           unset ($list[$option['show']->getId()]);
           $option['other'] = $list;
           $vsPrint->mainTitle = $vsPrint->pageTitle = $option['show']->getTitle();
          
           $this->output = $this->html->showService($option);
	}

	function loadDefault(){
            global $vsPrint, $vsLang, $bw,$vsSettings,$vsTemplate,$vsStd,$vsMenu;
            if($vsSettings->getSystemKey($bw->input['module'].'_show_cate_first', 0, $bw->input['module'], 1, 1))return $this->loadCategory();
            $categories = $vsMenu->getCategoryGroup($bw->input['module']);
            $strIds = $vsMenu->getChildrenIdInTree($categories);
            $size = $vsSettings->getSystemKey($bw->input['module'].'_user_item_quality', 10, $bw->input['module'],1);
            $this->module->setFieldsString('pageId,pageTitle,pageIntro,pagePostDate,pageImage,vsf_file.*');
            $this->module->setCondition("pageCatId in ({$strIds}) and pageStatus > 0");
            $this->module->setOrder('pageIndex, pageId DESC');
            $this->module->setTableName ("page left join vsf_file on pageImage = fileId");
            $option = $this->module->getPageList($bw->input['module']."/", 1, $size);
            $option['cate'] = $categories->getChildren();
            $this->output = $this->html->loadDefault($option);
	}


	
	

	function setOutput($out){
		return $this->output = $out;
	}

	function getOutput(){
		return $this->output;
	}
}
?>

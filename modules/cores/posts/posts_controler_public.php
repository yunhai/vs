<?php
require_once CORE_PATH.'posts/posts.php';
class posts_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw;
		parent::__construct($modelName,"skin_posts","post",$bw->input[0]);
		unset($_SESSION['active']);
	}
	
	/*
	 * Show default action 
	 */
	function showDefault(){
		global $bw,$vsTemplate;
		
		$this->model->setCondition("status>0");
		$option=$this->model->getPageList("posts",1,VSFactory::getSettings()->getSystemKey('post_page_limit',6));
		$option['title'] = VSFactory::getLangs()->getWords($bw->input[0]);
        return $this->output = $this->getHtml()->showDefault($option);
	}
/*
	 * Show default action 
	 */
	function showCategory($catId){
		global $bw,$vsPrint;
        $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$idcate = $this->getIdFromUrl($catId);		
		$category=VSFactory::getMenus()->getCategoryById($idcate);
		if(!$category){
			$vsPrint->boink_it($bw->base_url);
		}
		
		
		$ids=VSFactory::getMenus()->getChildrenIdInTree($category);
		$this->model->setCondition("status>0 and catId in ({$idcate})");
		
		$this->model->setOrder("`index` desc,id desc");
		$option=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2]."/".$bw->input[3],4,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));

		$option['title']=$category->getTitle();
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['cate'] = $category->getChildren();
        $option['breakcrum']=$this->createBreakCrum(VSFactory::getMenus()->getCategoryById($idcate) );
        $option['obj']=$category;
     
		return $this->output = $this->getHtml()->showDefault($option);
	}
	/*
	 * Show detail action 
	 */
	function showDetail($objId){
		global $vsPrint, $bw,$vsTemplate;       
		$obj=$this->model->getObjectById($this->getIdFromUrl($objId));
		if(!is_object($obj)){
			$vsPrint->boink_it($bw->base_url);
		}       
		$option['other']=$this->model->getOtherPost($obj,4);
		$option['breakcrum']=$this->createBreakCrum($obj);
		$option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
		
    	$this->output = $this->getHtml()->showDetail($obj,$option);
	}
	
//	/*
//	 * Show category action 
//	 */
//	function showCategory($catId){
//		global $bw;
//		return $this->output = $this->getHtml()->showDefault($option);
//	}
	
	
	
	/**
	 * 
	 * @var posts
	 */
	protected $model;
	
	
    function getListLangObject(){
         	
    }
       /**
        * 
        * @param BasicObject
        */ 
    protected  function  onDeleteObject($obj){
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
	/**
	 * 
	 * Enter description here ...
	 * @var skin_posts
	 */
	public $html;
}

?>
<?php
require_once CORE_PATH.'posts/posts.php';
class posts_controler_public extends VSControl_public {
	function __construct($modelName){
		global $vsTemplate,$bw;
		parent::__construct($modelName,"skin_posts","post",$bw->input[0]);
		unset($_SESSION['active']);
	}
	
	function auto_run() {
	    global $bw;
	
	    switch ($bw->input ['action']) {
	    	case $this->modelName.'_form':
	    	    $this->showForm($bw->input [2]);
	    	    break;
	    	case $this->modelName.'_submit':
	    	    $this->submitForm($bw->input [2]);
	    	    break;
	    	default :
	    	    $this->showCategory ( $bw->input [2] );
	    	    break;
	    }
	}
	
	function showCategory($catId){
	    global $bw,$vsPrint;
	
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	
	    if((!empty($bw->input[1]) && $bw->input[1] != 'category') || empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	
	        $idcate = $tmp->getId();
	         
	        $index = 1;
	        $url = $bw->input[0]."/";
	    } else {
	        $idcate = $this->getIdFromUrl($catId);
	
	        $index = 3;
	        $url = $bw->input[0]."/".$bw->input[1]."/".$bw->input[2]."/";
	    }
	
	    $option['current'] = $idcate;
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	
	    $ids=VSFactory::getMenus()->getChildrenIdInTree($category);
	    $this->model->setCondition("status>0 and catId in ({$ids})");
	
	    $this->model->setOrder("`status` desc, public_date desc");
	
	    $option[$idcate]=$this->model->getPageList($url,$index,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
	
	    $vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
	
	    $option['category'] = $category;
	    return $this->output = $this->getHtml()->showDefault($option);
	}
	
	function showForm($catId) {
	    global $vsPrint,$bw;
	
	    $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	    $option['cate'] = $category->getChildren();
	    
	    if(empty($catId)) {
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	         
	        $idcate = $tmp->getId();
	    } else {
	        $idcate = $this->getIdFromUrl($catId);
	    }
	     
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	     
	    $option['category'] = $category;
	     
	    $option[$idcate] = true;
	    
	    $this->output = $this->html->showForm($option);
	}
	
	function submitForm($catId) {
	    global $bw, $vsPrint;
	
	    if(empty($catId)) {
	        $category = VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
	        $option['cate'] = $category->getChildren();
	         
	        reset($option['cate']);
	        $tmp = current($option['cate']);
	
	        $idcate = $tmp->getId();
	    } else {
	        $idcate = $this->getIdFromUrl($catId);
	    }
	
	    $category=VSFactory::getMenus()->getCategoryById($idcate);
	    if(!$category){
	        $vsPrint->boink_it($bw->base_url);
	    }
	     
	    $redirect = $bw->base_url.'faq';
	    if(empty($catId)) {
	        $redirect = $bw->base_url.'faq/category/'.$category->getSlugId();
	    }
	
	    $option['category'] = $category;
	     
	    $title = array();
	    $ignore = array('fullname', 'phone', 'email');
	    foreach($ignore as $item) {
	        $title[$item] = $bw->input[$this->modelName][$item];
	        unset($bw->input[$this->modelName][$item]);
	    }
	     
	    $bw->input[$this->modelName]['title'] = json_encode($title);
	     
	    $bw->input[$this->modelName]['catId'] = $idcate;
	     
	    $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	    $this->model->insertObject();
	     
	    $vsPrint->boink_it($redirect);
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

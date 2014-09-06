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
	    	case $this->modelName.'_add':
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
	
	function showForm($catId, $custom = array()) {
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
	     
	    $json = array();
	    foreach($option['cate'] as $item) {
	        $tmp = $item->getChildren();
	        if(empty($tmp)) continue;
	        $children = array();
	        foreach ($tmp as $child) {
	            $children[$child->getId()] = array('name' => $child->getTitle());
	        }
	        
	        $json[$item->getId()] = array(
	        	'name' => $item->getTitle(),
                'children' => $children
	        );
	    }
	    $option['current'] = $idcate;
	    $option['category_min'] = $json;
	    $option['json'] = json_encode($json);
	    $option['category'] = $category;
	     
	    $option[$idcate] = true;
	   
	    $vsPrint->addCSSFile("uploader/style");
	    $vsPrint->addCSSFile("uploader/jquery.fileupload");
	    $vsPrint->addCSSFile("uploader/jquery.fileupload-ui");
	    
	    $option['obj'] = $this->model->basicObject;
	    if($custom) {
	        foreach($custom as $k => $value) {
	            $option[$k] = $value;
	        }
	    }
	   
// 	    print "<pre>";
// 	    print_r($option['obj']);
// 	    print "</pre>";
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
	
	 //   $bw->input['posts']['title'] = time();
	    
	    if(empty($bw->input['file'])) {
	        $option['error'] = VSFactory::getLangs()->getWords('empty_image','Hình đại diện không hợp lệ');
	        
	        $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	        return $this->showForm($catId, $option);
	    }
	    
	    reset($bw->input['file']);
	    $bw->input['posts']['image'] = current($bw->input['file']);
	    
	    $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	    $flag = $this->model->insertObject();
	    if(empty($flag)) {
	        $option['error'] = VSFactory::getLangs()->getWords('empty_title','Tiêu đề không được để trống');
	         
// 	        $this->model->basicObject->convertToObject($bw->input[$this->modelName]);
	        return $this->showForm($catId, $option);
	    }
	    
	    require_once CORE_PATH.'gallerys/gallerys.php';
	    $model = new gallerys();
	    $catId = $model->getCategories ();
	    
	    $galleries = array(
	    	          'title'  => $bw->input['posts']['title'],
	                  'module' => $this->modelName,
	                  'catId'  => $catId,
	                  'status' => -1,
                      'code'   => $this->modelName.'_'.$this->model->basicObject->getId(),
	    );
	    
	    $model->basicObject->convertToObject($galleries);
	    $model->insertObject();

	    $g_id = $model->basicObject->getId();
	    foreach($bw->input['gallery'] as $id) {
	       $model->addFileToAlbum($id, $g_id);
	    }
	   // $newAlbum=$this->model->createAlbum($bw->input[2].'_'.$bw->input[3],$bw->input[2]);
	    
	    global $DB;
	    print "<pre>";
	    print_r($DB->obj);
	    print "</pre>";
	    print "<pre>";
	    print_r($bw->input);
	    print "</pre>";exit;
	    
	    $redirect = $bw->base_url.'faq';
	    if(empty($catId)) {
	        $redirect = $bw->base_url.'faq/category/'.$category->getSlugId();
	    }
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

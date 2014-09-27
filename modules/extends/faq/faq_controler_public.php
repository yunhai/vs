<?php
require_once CORE_PATH.'pages/pages_controler_public.php';
class faq_controler_public extends pages_controler_public {
	function __construct($modelName){
		global $vsTemplate,$bw,$vsPrint,$vsSkin;
		if(file_exists(ROOT_PATH.$vsSkin->basicObject->getFolder()."/skin_".$bw->input[0].".php")){
    		parent::__construct($modelName,"skin_".$bw->input[0],"page",$bw->input[0]);;
		}else{
		    parent::__construct($modelName,"skin_pages","page",$bw->input[0]);
		}
	}
	
	/**
	 * 
	 * @var pages
	 */
	protected $model;
	
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
		
		$this->model->setOrder("`index` desc, id desc");
		
		$length = VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12);
		$option[$idcate]=$this->model->getPageList($url,$index,$length);
		
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
	 * @var skin_pages
	 */
	public $html;
}

?>
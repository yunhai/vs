<?php
require_once(CORE_PATH.'videos/videos.php');

class videos_controler_public extends VSControl_public {

	





	public	function __construct($modelName){
	
		global $vsTemplate,$bw;
//		$this->html=$vsTemplate->load_template("skin_video");
		parent::__construct($modelName,"skin_videos","video",$bw->input[0]);
//		$this->model->categoryName=$bw->input[0];

	}
	function auto_run() {
		global $bw;
		
		switch ($bw->input ['action']) {
			case $this->modelName . '_detail' :
				$this->showDetail ( $bw->input [2] );
				break;
			
			case $this->modelName . '_category' :
				$this->showCategory ( $bw->input [2] );
				break;
			case $this->modelName . '_review' :
				$this->showReview ( $bw->input [2] );
				break;
			case $this->modelName . '_search' :
				$this->showSearch ();
				break;
			case $this->modelName.'_change_cate':
				$this->changeCateVideo();
				break;	
			default :
				$this->showDefault ();
				break;
		}
	}
	
	function changeCateVideo($option=array()){
		global $bw,$vsTemplate,$vsStd,$vsPrint;
			$catId=$bw->input['2'];
			$this->model->setCondition("status>0 and catId={$catId}");
			$this->model->setLimit(array(0,8));
           $option['objByCate']=$this->model->getObjectsByCondition();
           
//            $resul['an1']=2;
//            $resul['an2']=3;
//            $resul['an4']=4;
//            
//            echo json_encode($resul);exit();
//            
            
           $html=$this->getHtml()->changeCate($option['objByCate']);
           
           echo $html;exit();
         
	
	}
	

	function showDefault($option = array()) {
		global $bw, $vsTemplate, $vsStd, $vsPrint;
		
		$category = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] );
		if (! $category) {
			$vsPrint->boink_it ( $bw->base_url );
		}
		$ids = VSFactory::getMenus ()->getChildrenIdInTree ( $category);
		$this->model->setCondition("status>0 and catId in ($ids)");
		$this->model->setOrder("`index`,id desc");
		
		$tmp=$this->model->getPageList($bw->input[0],1,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit',12));
		$option=array_merge($tmp,$option);
		$option['breakcrum']=$this->createBreakCrum(null);
		$option['title']=VSFactory::getLangs()->getWords($bw->input[0]);
		$vsPrint->mainTitle=$vsPrint->pageTitle=$option['title'];
        $option['cate'] = $category->getChildren();
        return $this->output = $this->getHtml()->showDefault($option);
		}
	
		function showDetail($objId,$option=array()){
		global $vsPrint, $bw,$vsTemplate;     
                $category=VSFactory::getMenus()->getCategoryGroup($bw->input[0]);
		$obj=$this->model->getObjectById($this->getIdFromUrl($objId));
		if(!$obj->getId()||$obj->getStatus()<=0){
			return $this->output=VSFactory::getLangs()->getWords('not_count_item');
		}
		$obj->createSeo();
		$option['breakcrum']=$this->createBreakCrum($obj);
		$option['other']=$this->model->getOtherList($obj);
        $option['cate'] = $category->getChildren();
        $option['cate_obj']=VSFactory::getMenus()->getCategoryById($obj->getCatId());
       	$obj->createSeo();
       	
       	
       	$category = VSFactory::getMenus ()->getCategoryGroup ( $bw->input [0] );
		if (! $category) {
			$vsPrint->boink_it ( $bw->base_url );
		}
		$ids = VSFactory::getMenus ()->getChildrenIdInTree ( $category);
		$this->model->setCondition("status>0 and catId in ($ids)");
		$this->model->setOrder("`index`,id desc");
		$tmp=$this->model->getPageList($bw->input[0]."/".$bw->input[1]."/".$bw->input[2],3,VSFactory::getSettings()->getSystemKey($bw->input[0].'_paging_limit_detail',12));
		$option=array_merge($tmp,$option);
		unset($option['pageList'][$obj->getId()]);
		
    	$this->output = $this->getHtml()->showDetail($obj,$option);
	}
	
	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var videos
	**/
	var		$model;

	
	/**
	*
	*@var skin_videos
	**/
	var		$html;
}

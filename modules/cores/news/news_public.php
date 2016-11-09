<?php

class news_public extends ObjectPublic{
	function __construct(){
            global $vsTemplate;
            parent::__construct( 'news', CORE_PATH.'news/', 'newses');
           // $this->html = $vsTemplate->load_template('skin_news');    
	}
	
	function showDefault(){
		global $vsSettings,$vsMenu,$bw,$vsTemplate,$vsCom,$vsPrint;
               
		$categories = $this->model->getCategories();
       	$strIds = $vsMenu->getChildrenIdInTree($categories);
     
		$option = array();
		
		

       	$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}Intro,{$this->tableName}CatId,{$this->tableName}PostDate");
       	
		$this->model->setCondition("{$this->tableName}Status > 0 and {$this->tableName}CatId in ({$strIds})");
		$this->model->setOrder("{$this->tableName}Index ASC, {$this->tableName}Id DESC");
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",10,$bw->input[0]);
		$option = $this->model->getPageList($bw->input['module'], 1, $size);
		if($option['pageList'])
        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
    	
		foreach ($categories->getChildren() as $value) {
			$option['cate'][$value->getId()] = $value->getTitle();
		}
    	
     	//$option['cate'] = $categories;
        $this->model->getNavigator();
    	return $this->output = $this->html->showDefault($option);
		
	}
	
function showCategory($catId){
		global $vsPrint,$bw,$vsSettings, $vsMenu,$vsTemplate,$vsCom;
               
		$query = explode('-',$catId);
		$idCate = abs(intval($query[count($query)-1]));
		$categories = $this->model->getCategories();
                
		if(!intval($idCate)){
			$strIds = $vsMenu->getChildrenIdInTree( $categories);
		}else{
			$result = $vsMenu->extractNodeInTree($idCate, $categories->getChildren());
			if($result)
			$strIds = $vsMenu->getChildrenIdInTree( $result['category']);
		}
     
		if($strIds)
			$this->model->setCondition($this->model->getCategoryField().' in ('. $strIds. ") and {$this->tableName}Status > 0 ");
		
       	$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}Intro,{$this->tableName}CatId,{$this->tableName}PostDate");
		
		$this->model->setOrder("{$this->tableName}Index Asc,{$this->tableName}Id Desc");
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",12,$bw->input[0]);
		
    	$option = $this->model->getPageList($bw->input['module']."/category/".$catId."/", 3, $size);
	
    	if($option['pageList']){
        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
      	}

		foreach ($categories->getChildren() as $value) {
			$option['cate'][$value->getId()] = $value->getTitle();
		}
      	$this->model->getNavigator($idCate);
		$option['catetitle'] =  $vsMenu->getCategoryById($idCate);
		
		$vsPrint->mainTitle = $vsPrint->pageTitle = $option['catetitle']->getTitle();
		
    	return $this->output = $this->html->showDefault($option);
    	
	}
	
	
}

?>
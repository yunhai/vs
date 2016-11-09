<?php
class gallerys_public extends ObjectPublic{
	function __construct(){
            global $vsTemplate;
            parent::__construct('gallerys', CORE_PATH.'gallerys/', 'gallerys');
           $this->html = $vsTemplate->load_template('skin_download');    
	}
	
function showDefault(){
		global $vsSettings,$vsMenu,$bw,$vsTemplate,$vsCom,$vsPrint;
               
		$categories = $this->model->getCategories();
       	$strIds = $vsMenu->getChildrenIdInTree($categories);
     
		
       	$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}CatId,{$this->tableName}Fileupload");
       	
		$this->model->setCondition("{$this->tableName}Status > 0 and {$this->tableName}CatId in ({$strIds})");
		$this->model->setOrder("{$this->tableName}Index ASC, {$this->tableName}Id DESC");
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",10,$bw->input[0]);
		$option = $this->model->getPageList($bw->input['module'], 1, 5);
		if($option['pageList'])
        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
    	
   		
        $this->model->getNavigator();
    	return $this->output = $this->html->showDefault($option);
		
	}

	function showDetail($objIds){
		global $vsPrint, $vsLang, $bw,$vsMenu,$vsSettings,$vsTemplate;              
		$query = explode('-',$objIds);
		$objId = intval($query[count($query)-1]);
		if(!$objId) return $vsPrint->redirect_screen($vsLang->getWords('global_no_item','Không có dữ liệu theo yêu cầu!'));
		$obj = $this->model->getObjectById($objId);
		$this->model->convertFileObject(array($obj),$bw->input['module']);
		$this->model->getNavigator($obj->getCatId());
		
	
		$cat=$vsMenu->getCategoryById($obj->getCatId());
		$ids=$vsMenu->getChildrenIdInTree($cat);

	
        	
		$option['gallery'] = $this->model->getFileByAlbumId($objId);

		
		$this->model->convertFileObject($option['gallery'],$bw->input['module']);
		
		
		$vsPrint->mainTitle = $vsPrint->pageTitle = $obj->getTitle();
		if($obj->getCode()=='video')
		$this->output = $this->html->showDetailVideo($obj,$option);
		else
		$this->output = $this->html->showDetail($obj,$option);
	}
	
}
?>
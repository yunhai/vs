<?php
/*
 * @author Luu Quang Vu
 * This class is used to describle the genaral for objects public of VSF
 */
class ObjectPublic{
	public $html;
	public $modelName;
	public $model;
	public $output;
	public $gallery;
	public $skinName;
	public $classNameModel;
	public $tableName;
	
	/*
	 * @description  initialize contructor
	 * @param $skinName string <p>
	 * The name of skin that you want to show 
	 * </p>
	 * @param $modelName string <p>
	 * The nam of model that you want to process
	 * </p>
	 * @param $pathModel string <p>
	 * Path to file model(It can: CORE_PATH.'/news' or other)
	 * </p>
	 * @return void
	 */
	function __construct($modelName, $pathModel, $classModelName){
		global $vsStd, $vsTemplate, $tableName,$bw;
		
		// Initialize model
		$this->modelName = $modelName;
		$this->modelName = $modelName;
		$vsStd->requireFile($pathModel. $this->modelName.'.php');
		
		$this->classNameModel = $classModelName;
		$this->model = new $this->classNameModel;
		
		$this->tableName = $this->model->getTableName();
		$this->getIconPage();
		$tableName = $this->tableName;
//		if(in_array($bw->input['module'],array('abouts','investment')))
//                        $this->html = $vsTemplate->load_template('skin_abouts');
//                else {        
		$skin  = 'skin_objectpublic';
                if(file_exists(SKIN_PATH."finance/skin_".str_replace("-","", $bw->input['module']).".php")) 
                        $skin  = "skin_".str_replace("-","", $bw->input['module']);
                   
		$this->html = $vsTemplate->load_template($skin);
//                }
   		
	}
	
	/*
	 * @description function auto_run, it's a router for actions in model 
	 */
	function auto_run() {
		global $bw,$class_def;
                
                
		switch ($bw->input['action']) {
			case 'detail':
				$this->showDetail($bw->input[2]);
				break;

			case 'category':
				$this->showCategory($bw->input[2]);
				break;
                        case 'searchs':
                            $this->showSearch();
                            break;
			default:
				$this->showDefault();
				break;
		}
	}
	function showSearch(){
		global $vsSettings,$vsMenu,$bw,$vsLang,$DB,$vsPrint;


		$categories = $this->model->getCategories();
                $strIds = $vsMenu->getChildrenIdInTree($categories);
		$keywords=strtolower(VSFTextCode::removeAccent(trim($bw->input[2])));
		$where .= " and ({$this->tableName}ClearSearch like '%".$keywords."%')";
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",16,$bw->input[0]);
		$this->model->setCondition("{$this->tableName}Status > 0 and {$this->tableName}CatId in ({$strIds})".$where);
		$this->model->setOrder("{$this->tableName}Id DESC");
		$option = $this->model->getPageList($this->modelName."/search/{$keywords}", 3, $size);
                $this->model->getNavigator();
                if($option['pageList'])
                    foreach($option['pageList'] as $obj)
                        $this->model->convertFileObject(array($obj),$obj->module);

        return $this->output = $this->html->showSearch($option);
	}
	/*
	 * Show default action 
	 */
	function showDefault(){
		global $vsSettings,$vsMenu,$bw,$vsTemplate,$vsCom,$vsPrint;
              
		$categories = $this->model->getCategories();
                $strIds = $vsMenu->getChildrenIdInTree($categories);
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",7,$bw->input[0]);
	
		$this->model->setCondition("{$this->tableName}Status > 0 and {$this->tableName}CatId in ({$strIds})");
		$this->model->setOrder("{$this->tableName}Index ASC, {$this->tableName}Id DESC");
		
		//$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}Intro, {$this->tableName}CatId,{$this->tableName}PostDate");
		$option = $this->model->getPageList($bw->input['module'], 1,$size);
		
		if($option['pageList'])
        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
                $this->model->getNavigator();
                 if(in_array($bw->input['module'],array('sanh-tiec','td-tiec-cuoi','bang-gia','sanh-hoi-nghi','am-thuc','dich-vu'))&&$option['pageList']){
                     
                     $curre =  current($option['pageList']);
                    $exac_url=strtr($curre->getUrl($bw->input['module']), $vsCom->SEO->aliasurls);
                    
                    $vsPrint->boink_it($exac_url);
                 }
		
       	return $this->output = $this->html->showDefault($option);		
	}
	
	/*
	 * Show detail action 
	 */
	function showDetail($objId){
		global $vsPrint, $vsLang, $bw,$vsMenu,$vsTemplate;              
		$query = explode('-',$objId);
		$Id = intval($query[count($query)-1]);
               // $cond = "{$this->tableName}MtUrl = '{$objId}'";
                if($Id)$cond.="  {$this->tableName}Id = {$Id}";
//                $this->model->setOrder("{$this->tableName}MtUrl DESC");
		$this->model->setCondition($cond);
		$obj=$this->model->getOneObjectsByCondition();
                if(!$obj) return $vsPrint->redirect_screen($vsLang->getWords('global_no_item','KhÃ´ng cÃ³ dá»¯ liá»‡u theo yÃªu cáº§u'));
		$this->model->convertFileObject(array($obj),$bw->input['module']);
		$cat=$this->model->vsMenu->getCategoryById($obj->getCatId());
		$this->model->getNavigator($obj->getCatId());
		$option['img'] =$this->model->getarrayGallery($obj->getId(),  str_replace("-", "", $bw->input['module']));
              
                if($option['img']){
                    $option['current_img']= current ($option['img']);
                    return $this->output = $this->html->showImage($obj,$option);
                }
		$option['cate'] =  $vsMenu->getCategoryById($obj->getCatId());
//                if(in_array($bw->input['module'], array('abouts','investment')))
//                        $option['other'] = $this->model->getOtherList($obj,1); 
//                else
                
		$obj->createSeo();
                
                    $option['other'] = $this->model->getOtherList($obj); 
                
                    if($option['other'])
                       $this->model->convertFileObject($option['other'],$bw->input['module']);
               
              
                $this->output = $this->html->showDetail($obj,$option);
	}
	
/*
	 * Show category action 
	 */
	function showCategory($catId){
		global $vsPrint,$bw,$vsSettings, $vsMenu,$vsTemplate;
               
		$query = explode('-',$catId);
		$idCate = abs(intval($query[count($query)-1]));
		$categories = $this->model->getCategories();
                
		if(!intval($idCate)){
			$strIds = $vsMenu->getChildrenIdInTree( $categories);
		}else{
			$result = $vsMenu->extractNodeInTree($idCate, $categories->getChildren());
			if($result)
			//$strIds = implode (",", $result['ids']);
			$strIds = $vsMenu->getChildrenIdInTree( $result['category']);
		}
             
		if($strIds)
			$this->model->setCondition($this->model->getCategoryField().' in ('. $strIds. ") and {$this->tableName}Status > 0 ");
		
		$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}Intro, {$this->tableName}CatId,{$this->tableName}PostDate");       
		
//		$this->model->setOrder("{$this->tableName}Status Desc,{$this->tableName}Index Asc,{$this->tableName}Id Desc");
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",7,$bw->input[0]);
		
                $option = $this->model->getPageList($bw->input['module']."/category/".$catId."/", 3, $size);
                $this->model->getNavigator($idCate);
                if($option['pageList'])
        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
                
      	
		$option['cate'] =  $vsMenu->getCategoryById($idCate);
		$option['parentcate'] =  $vsMenu->getCategoryById($option['cate']->getParentId());
		$vsPrint->mainTitle = $vsPrint->pageTitle =  $result['category']->getTitle();
		
    	return $this->output = $this->html->showDefault($option);
	}
        
        function getIconPage(){
            global $bw,$class_def;
            $class_def = "main_title_service";
            $arra =array("tuyen-dung"=>"main_title_tuyendung",
                "khuyen-mai"=>"main_title_khuyenmai",
                "news"=>"main_title_text"
                );            
            if($arra[$bw->input['module']])$class_def = $arra[$bw->input['module']];
            
        }
	/**
	 * @return the $html
	 */
	public function getHtml() {
		return $this->html;
	}

	/**
	 * @return the $modelName
	 */
	public function getModelName() {
		return $this->modelName;
	}

	/**
	 * @return the $model
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * @return the $output
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * @return the $gallery
	 */
	public function getGallery() {
		return $this->gallery;
	}

	/**
	 * @return the $skinName
	 */
	public function getSkinName() {
		return $this->skinName;
	}

	/**
	 * @return the $classNameModel
	 */
	public function getClassNameModel() {
		return $this->classNameModel;
	}

	/**
	 * @return the $tableName
	 */
	public function getTableName() {
		return $this->tableName;
	}

	/**
	 * @param field_type $html
	 */
	public function setHtml($html) {
		$this->html = $html;
	}

	/**
	 * @param field_type $modelName
	 */
	public function setModelName($modelName) {
		$this->modelName = $modelName;
	}

	/**
	 * @param field_type $model
	 */
	public function setModel($model) {
		$this->model = $model;
	}

	/**
	 * @param field_type $output
	 */
	public function setOutput($output) {
		$this->output = $output;
	}

	/**
	 * @param field_type $gallery
	 */
	public function setGallery($gallery) {
		$this->gallery = $gallery;
	}

	/**
	 * @param field_type $skinName
	 */
	public function setSkinName($skinName) {
		$this->skinName = $skinName;
	}

	/**
	 * @param field_type $classNameModel
	 */
	public function setClassNameModel($classNameModel) {
		$this->classNameModel = $classNameModel;
	}

	/**
	 * @param field_type $tableName
	 */
	public function setTableName($tableName) {
		$this->tableName = $tableName;
	}

	
	
}
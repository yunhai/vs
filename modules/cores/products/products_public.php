<?php

class products_public extends ObjectPublic{
	function __construct(){
            global $vsTemplate;
            parent::__construct('products', CORE_PATH.'products/', 'products');
           $this->html = $vsTemplate->load_template('skin_products');
           $this->getListBrand();
	}

	function auto_run() {
		global $bw;

		switch ($bw->input['action']) {
			case 'detail':
				$this->showDetail($bw->input[2]);
				break;

			case 'category':
				$this->showCategory($bw->input[2]);
				break;
			case 'search':
				$this->loadSearch();
				break;
			case 'filter':
				$this->showFilter();
				break;
			default:
				$this->showDefault();
				break;
		}
	}
	
	function showFilter(){
		global $vsSettings,$vsMenu,$bw,$vsTemplate,$vsCom,$vsLang;
               
		$categories = $this->model->getCategories();
       	$strIds = $vsMenu->getChildrenIdInTree($categories);   
       	if($bw->input[2] == 'hot')
       		$cond = " and {$this->tableName}Status = 3";
       	else 
       		$cond = " and {$this->tableName}Status > 0";
       	$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}Intro,{$this->tableName}CatId,{$this->tableName}PostDate");
		$this->model->setCondition(" {$this->tableName}CatId in ({$strIds}) and {$this->tableName}Id not in ({$bw->input[3]}) ".$cond);
		$this->model->setOrder("{$this->tableName}Index DESC, {$this->tableName}Id DESC");
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",10,$bw->input[0]);
		$option = $this->model->getPageList($bw->input['module'], 1, $size);
		if($option['pageList'])
        	$this->model->convertFileObject($option['pageList'],$bw->input['module']);
    	
   		
     	$option['title'] = $vsLang->getWordsGlobal("global_products_".$bw->input[2],"sản phẩm mới");
        $this->model->getNavigator();
    	return $this->output = $this->html->showDefault($option);
	}
	
	function getListBrand(){
   		global $vsStd,$vsMenu,$opt;
      	$vsStd->requireFile(CORE_PATH."pages/pages.php");
       	$pages = new pages();
      
      	$categories = $vsMenu->getCategoryGroup('brands');
       	$strIds = $vsMenu->getChildrenIdInTree($categories);
      	$opt['brand']= $categories->getChildren();
       	$pages->setCondition("pageStatus > 0 and pageCatId in ({$strIds})");
      	$pages->setOrder("pageCatId ASC ");
      	$opt['color'] = $pages->getObjectsByCondition();
       	$color = $pages->getObjectsByCondition('getCatId',1);
 
     	if($opt['color']){
     		$pages->convertFileObject($opt['color'],'brands');
        	foreach($opt['color'] as $menu)
          		$menu->img = $menu->createImageCache($menu->file,12,11,1);
     	}

  
	}
	
	
function showDetail($objId){
		global $vsPrint, $vsLang, $bw,$vsMenu,$vsTemplate,$opt;  
		
		         
		$query = explode('-',$objId);
		$objId = intval($query[count($query)-1]);
		if(!$objId) return $vsPrint->redirect_screen($vsLang->getWords('global_no_item','Không có dữ liệu theo yêu cầu!'));
		$obj=$this->model->getObjectById($objId);
		$this->model->convertFileObject(array($obj),$bw->input['module']);
		$cat=$this->model->vsMenu->getCategoryById($obj->getCatId());
		$this->model->getNavigator($obj->getCatId());
		
      	$option['brand']=$this->model->vsMenu->getCategoryById($obj->getBrand());  
		$option['gallery'] = $this->model->getarrayGallery($obj->getId(),$bw->input['module']);

		$option['cate'] =  $vsMenu->getCategoryById($obj->getCatId());
	
		$vsPrint->mainTitle = $vsPrint->pageTitle = $obj->getTitle();
	
		$option['other'] = $this->model->getOtherList($obj);
		$this->model->convertFileObject($option['other'],$bw->input['module']);
	
		$obj->createSeo();
	
		$this->output = $this->html->showDetail($obj,$option);
	}
	
	function showDetail_listcolor($objId){
		global $vsPrint, $vsLang, $bw,$vsMenu,$vsTemplate,$opt;  
		
		         
		$query = explode('-',$objId);
		$objId = intval($query[count($query)-1]);
		if(!$objId) return $vsPrint->redirect_screen($vsLang->getWords('global_no_item','Không có dữ liệu theo yêu cầu!'));
		$obj=$this->model->getObjectById($objId);
		$this->model->convertFileObject(array($obj),$bw->input['module']);
		$cat=$this->model->vsMenu->getCategoryById($obj->getCatId());
		$this->model->getNavigator($obj->getCatId());
		
		if($obj->getBrand()){
        	$pages = new pages();
          	$pages->setCondition("pageStatus > 0 and pageId in ({$obj->getBrand()})");
          	$list = $pages->getObjectsByCondition('getCatId',1);
              
         	if($list)
           		foreach($opt['brand'] as $key => $val){
              		if($list[$key]){
                    	$opt['brand'][$key]->list = $list[$key];
                  	}else{
                      	unset ($opt['brand'][$key]);
                 	}
          		}
     	}else{
				$opt['brand'] = array();
		}
		$option['gallery'] = $this->model->getarrayGallery($obj->getId(),$bw->input['module']);
		
		reset($opt['color']);
		$listcolor = $obj->getListColor();
	
		

       	if($bw->input['color'])$color= $opt['color'][$bw->input['color']];
     
      	if(!$color) {
      		$current = current($listcolor);
      		$color = $current;
      	}
     	$bw->input['color'] = $color->getId();
    
       	if($obj->getColor()){
        	$link = "gallery/{$color->getColorTitle()}_{$color->getId()}/";
        	$len = strlen($link);
          	foreach($option['gallery'] as $key => $img){
            	$str = substr($img->getPath(), 0,$len);
            	if($str!=$link){
                	unset ($option['gallery'][$key]);
             	}
          	}

     	}else{
         	unset ($option['gallery']);
     	}	
     	
        $option['current'] = $color;	
       
		$option['cate'] =  $vsMenu->getCategoryById($obj->getCatId());
		
		
        	
		$vsPrint->mainTitle = $vsPrint->pageTitle = $obj->getTitle();
	
		$option['other'] = $this->model->getOtherList($obj);
		$this->model->convertFileObject($option['other'],$bw->input['module']);
	
		//$obj->createSeo();
	
		$this->output = $this->html->showDetail($obj,$option);
	}
	
	function loadSearch(){
		global $vsSettings,$vsMenu,$bw,$vsLang,$DB,$vsPrint;
		if($bw->input['keySearch'])
			$keywords=strtolower(VSFTextCode::removeAccent(trim($bw->input['keySearch'])));
		else 
			$keywords=strtolower(VSFTextCode::removeAccent(trim($bw->input[2])));
		$keywords = strtolower(VSFTextCode::removeAccent(trim($keywords)));	
		$categories = $this->model->getCategories();
       	$strIds = $vsMenu->getChildrenIdInTree($categories);
       	
		$where = " and ({$this->tableName}ClearSearch like '%".$keywords."%' or {$this->tableName}Title like '%".$keywords."%' or {$this->tableName}Content like '%".$keywords."%' or {$this->tableName}Intro like '%".$keywords."%')";
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",16,$bw->input[0]);
		$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}CatId,{$this->tableName}Price");
		$this->model->setCondition("{$this->tableName}Status > 0 and {$this->tableName}CatId in ($strIds)".$where);
		$this->model->setOrder("{$this->tableName}Id DESC");
		
		$option = $this->model->getPageList($bw->input['module']."/search/{$keywords}", 3, $size);

    	$this->model->getNavigator();
      	$vsPrint->mainTitle = $vsPrint->pageTitle = $option['title_search'] = $vsLang->getWords($bw->input['module'].'_search_result','Result search');
      	if ($option['pageList'])
     		$this->model->convertFileObject($option['pageList'],$bw->input['module']);
     	else 
     		$option['error_search'] = $vsLang->getWords($bw->input['module'].'_search_emty','Không tìm thấy dữ liệu theo yêu cầu. Vui lòng nhập từ khóa khác!');
     		
	
        return $this->output = $this->html->showCategory($option);
	}
	
}

?>
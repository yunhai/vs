 <?php
class pages_public extends ObjectPublic{
	function __construct(){
		parent::__construct('pages', CORE_PATH.'pages/', 'pages');
	}
	function loadSearch(){
		global $vsSettings,$vsMenu,$bw,$vsLang,$DB,$vsPrint;
		
		if($bw->input['keySearch']){
			$keywords=strtolower(VSFTextCode::removeAccent(trim($bw->input['keySearch'])));
			$bw->input[2]=$bw->input['keySearch'];
		}else 
			$keywords=strtolower(VSFTextCode::removeAccent(trim($bw->input[2])));
			
		$keywords = strtolower(VSFTextCode::removeAccent(trim($keywords)));	
			
		$categories = $this->model->getCategories();
       	$strIds = $vsMenu->getChildrenIdInTree($categories);
       	
		$where = " and ({$this->tableName}CleanContent like '%".$keywords."%' or {$this->tableName}Title like '%".$keywords."%' or {$this->tableName}Content like '%".$keywords."%' or {$this->tableName}Mau like '%".$keywords."%' or {$this->tableName}Donvi like '%".$keywords."%' or {$this->tableName}Ketqua like '%".$keywords."%')";
		$size  = $vsSettings->getSystemKey("{$bw->input[0]}_user_item_quality",16,$bw->input[0]);
		$this->model->setFieldsString("{$this->tableName}Title, {$this->tableName}Image, {$this->tableName}Id, {$this->tableName}CatId,{$this->tableName}Content,{$this->tableName}Module");
		$this->model->setCondition("{$this->tableName}Status > 0 ".$where);
		$this->model->setOrder("{$this->tableName}Id DESC");
		
		$option = $this->model->getPageList($bw->input['module']."/search/{$keywords}", 3, $size);

    	$this->model->getNavigator();
      	$vsPrint->mainTitle = $vsPrint->pageTitle = $option['title_search'] = $vsLang->getWords($bw->input['module'].'_search_result','Result search');
      	if (!$option['pageList']) 
     		$option['error_search'] = $vsLang->getWords($bw->input['module'].'_search_emty','Không tìm thấy dữ liệu theo yêu cầu. Vui lòng nhập từ khóa khác!');
	
        return $this->output = $this->html->showSearch($option);
	}
}
?>

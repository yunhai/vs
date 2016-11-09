<?php

global $vsStd;
require_once(CORE_PATH."products/products.php");

class products_public{
	
	protected $html;
	protected $module;
	protected $output;
	
	function __construct() {
		global $vsTemplate, $vsPrint;
		$this->module = new products();
        $this->html = $vsTemplate->load_template('skin_products');
	}
	
	function auto_run() {
		global $bw;
	
		switch ($bw->input[1]) {
			case 'detail':
					$this->loadDetail($bw->input[2]);
				break;
			case 'category':
					$this->loadCategory($bw->input[2]);
				break;
			default:{
					$this->loadDefault();
				break;
			}
		}
	}
	function loadDefault(){
		$hostObject = $this->module->getHotList();
		if(count($hostObject)){
			$currentItem = current($hostObject);
			next($hostObject);
		}
		$htmlListCatProject=$this->getListWithCat();
		return $this->output = $this->html->loadDefault($currentItem,$hostObject,$htmlListCatProject);
	}
	
	function getListWithCat(){
		global $vsMenu,$vsSettings;
		$count=0;
		$category= $this->module->getCategories();
		if (count($category->getChildren()))
		{
			foreach ($category->getChildren() as $key=> $cat) {
				$count++;
				$cat=$vsMenu->getCategoryById($key);
				$listObject=$this->module->getListWithCat($cat);
				$size =  $vsSettings->getSystemKey("news_show_cat_num",8);
				$listObject =  array_slice($listObject,0,$size);
				$html .= $this->html->htmlListObject($cat,$listObject,$count);
			}
		}
		else 
		{
			$listObject=$this->module->getListWithCat($category);
			$html = $this->html->htmlListObject($category,$listObject,$count);
		}
		return $html;
	}
	
	public function loadDetail($objId) {
		global $bw, $vsLang, $vsPrint;
		$query = explode('-',$objId);
		$objId = abs(intval($query[count($query)-1]));
		$obj = $this->module->getObjectById($objId);
		if(!$obj) return $vsPrint->redirect_screen('Không có dữ liệu theo yêu cầu');
		$cat=$this->module->vsMenu->getCategoryById($obj->getCatId());
		$bw->input['catUrl']=$cat->getCatUrl('news');
		$arrayOther = $this->module->getOtherList($obj);
		
		return $this->output = $this->html->loadDetail($obj, $arrayOther);
	}
	
	public function loadCategory($catId=0) {
		global $vsPrint,$bw,$vsSettings;		
		$category = $this->module->vsMenu->getCategoryById($catId);
		$bw->input['catUrl']=$category->getCatUrl('news');
		$listObjectAll=$this->module->getListWithCat($category);
		$size =  $vsSettings->getSystemKey("news_show_cat_num",8);
		$listObject =  array_slice($listObjectAll,0,$size);
		
		$listOther  =  array_slice($listObjectAll,$size,$size);	
	
		$vsPrint->mainTitle = $vsPrint->pageTitle = $category->getTitle();
		return $this->output = $this->html->htmlListObject($category,$listObject,"",$listOther);
	}
	

	public function getOutput() {
		return $this->output;
	}

	public function setOutput($output) {
		$this->output = $output;
	}
}
?>
<?php
/*
+-----------------------------------------------------------------------------
|   VSF version 3.0.0.0
|	Author: BabyWolf
|	Homepage: http://www.vietsol.net
|	If you use this code, please don't delete these comment lines!
|	Start Date: 10/21/2007
|	Finish Date: 10/21/2007
|	Modified Start Date: 10/27/2007
|	Modified Finish Date: 10/28/2007
|	News Description: This News is for management all newses in system.
+-----------------------------------------------------------------------------
*/
require_once(CORE_PATH."products/products.php");

class products_admin {
	protected $html = "";
	protected $module;
	
	protected $output = "";
	
	public function __construct(){
		global $vsTemplate;
		$this->module = new products();
        $this->html = $vsTemplate->load_template('skin_products');
        
        
	}
	
	function auto_run() {
		global $bw;
		switch($bw->input[1]){
			case 'delete-checked-obj':
					$this->module->delete(rtrim($bw->input['checkedObj'],","));
				break;
					
			case 'visible-checked-obj':
					$this->checkShowAll(1);
				break;
				
			case 'hide-checked-obj':
					$this->checkShowAll(0);
				break;
				
			case 'display-obj-tab':
					$this->displayObjTab();
				break;
				
			case 'display-obj-list':					
					$this->getObjList($bw->input[2], $this->module->result['message']);
				break;
			
			case 'add-edit-obj-form':
					$this->addEditObjForm($bw->input[2]);
				break;
				
			case 'add-edit-obj-process':
					$this->addEditObjProcess();
				break;
				
			case 'delete-obj':
					$this->module->delete($bw->input[2]);
				break;
				
			default:
				$this->loadDefault();
		}
	}
	function checkShowAll($val = 0){
		global $bw;
	
		$this->module->setCondition("productId in ({$bw->input[2]})");
		$this->module->updateObjectByCondition(array('productStatus'=>$val));
		return $this->output = $this->getObjList($bw->input[3]);
		
	}	
	
	function displayObjTab() {
		$option['categoryList'] = $this->getCategoryBox();
		$option['objList'] 	= $this->getObjList();
   
		$this->output = $this->html->displayObjTab($option);
	}
			
	function getObjList($catId='', $message=""){
		global $bw, $vsStd ,$vsSettings;
		if($bw->input['pageCate'])	{
			$catId = $bw->input['pageCate'];
			$bw->input[2] = $bw->input['pageCate'];
		}
		if($bw->input['pageIndex'])	$bw->input[3]=$bw->input['pageIndex'];
		$catId = intval($catId);
		$categories = $this->module->getCategories();
		
		// Check if the catIds is specified
		// If not just get all product
		if(!intval($catId)){
			$strIds = $this->module->vsMenu->getChildrenIdInTree($categories);
		}else{
			$result = $this->module->vsMenu->extractNodeInTree($catId, $categories->getChildren());
			if($result)
			$strIds = trim($catId.",".$this->module->vsMenu->getChildrenIdInTree($result['category']),",");
		}
		
		// Set the condition to get all product in specified category and its chidlren
		if($strIds)
			$this->module->setCondition($this->module->getCategoryField().' in ('. $strIds. ')');
		
		$total = $this->module->getNumberOfObject();		
	
		$size =  $vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number",10);		

		
		$option=$this->module->getPageList("{$bw->input[0]}/display-obj-list/{$catId}", 3,$size,1,'obj-panel');
		$option['message'] = $message;
		$option['categoryId'] = $catId; 
		return $this->output = $this->html->objListHtml($this->module->getArrayObj(), $option);
	}
	
	function addEditObjForm($objId=0, $option=array()){
		global $vsLang, $vsStd,$bw ,$vsSettings, $vsPrint;
	
		$vsSettings->getSystemKey($bw->input[0].'_title',1);
		$vsSettings->getSystemKey($bw->input[0].'_index',1);
		$vsSettings->getSystemKey($bw->input[0].'_status',1);
		$vsSettings->getSystemKey($bw->input[0].'_intro',1);
		$vsSettings->getSystemKey($bw->input[0].'_code',1);
		$vsSettings->getSystemKey($bw->input[0].'_price',1);
		$vsSettings->getSystemKey($bw->input[0].'_content',1);
		$vsSettings->getSystemKey($bw->input[0].'_image',1);
		
		$obj = $this->module->createBasicObject();
		$option['formSubmit'] = $vsLang->getWords('obj_EditObjFormButton_Add', 'Add');
		$option['formTitle']  = $vsLang->getWords('obj_EditObjFormTitile_Add', "Add {$bw->input[0]}");
				
		if($objId){
			$option['formSubmit'] = $vsLang->getWords('obj_EditObjFormButton_Edit', 'Edit');
			$option['formTitle']  = $vsLang->getWords('obj_EditObjFormTitile_Edit', "Edit {$bw->input[0]}");
			$obj = $this->module->getObjectById($objId);
			$option['categoryId'] = $obj->getCategory();
		}
		
		
		$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce");
		$vsStd->requireFile(JAVASCRIPT_PATH."/tiny_mce/tinyMCE.php");
		
		$editor = new tinyMCE();
		
		$editor->setWidth('375px');
		$editor->setHeight('150px');
		$editor->setToolbar('narrow');
		$editor->setTheme("advanced");
		$editor->setInstanceName('productIntro');
		$editor->setValue($obj->getIntro());
		$obj->setIntro($editor->createHtml());
		
		
		$editor->setWidth('100%');
		$editor->setHeight('350px');
		$editor->setToolbar('full');
		$editor->setTheme("advanced");
		$editor->setInstanceName('productContent');
		$editor->setValue($obj->getContent());
		$obj->setContent($editor->createHtml());
		
		
		return $this->output = $this->html->addEditObjForm($obj, $option);
	}
	
	function addEditObjProcess(){
		global $bw, $vsStd, $vsLang ,$vsSettings;
	
		
		$bw->input['productStatus'] = $bw->input['productStatus']? 1:0;
		if(!$bw->input['productCatId'])
			$bw->input['productCatId']=$this->module->getCategories()->getId();

		if($bw->input['fileId'])
			$bw->input['productImage']=$bw->input['fileId'];
		elseif($bw->input['txtlink']){
			$bw->input['productImage']=$this->module->vsFile->copyFile($bw->input['txtlink'],$bw->input[0]);
		}
	
		// If there is Object Id passed, processing updating Object
		if($bw->input['productId']){
			$obj = $this->module->getObjectById($bw->input['productId']);
			$imageOld =$obj->getImage();
			if(!$obj){
				$this->alertMessage();
			}
			$objUpdate = $this->module->createBasicObject();
			$objUpdate->convertToObject($bw->input);
		
			$this->module->updateObjectById($objUpdate);
		
			if(!$this->module->result['status']){
				$this->module->reportError();
			}
		}
		else{
			$bw->input['productPostDate'] = time();
			$this->module->obj->convertToObject($bw->input);
			$this->module->insertObject($this->module->obj);
		}
		
				
		if($imageOld&&$bw->input['fileId']){
			$this->module->files->deleteFile($imageOld);
		}
		
		if($vsSettings->getSystemKey("{$bw->input[0]}_multi_cat", 1) && $this->module->result['status']){
//			$vsSettings->getSystemKey("{$bw->input[0]}_multi_cat", 1)
		
			$vsStd->requireFile(LIBS_PATH."Relationship.class.php");
			$rel = new VSFRelationship();
			$rel->setObjectId($this->module->obj->getId());
			$rel->setRelId($bw->input['productCatId']);
			$rel->setTableName($this->module->getRelTableName());
			$rel->insertRel();
		}
		
		
		$this->alertMessage();
	}
	
	function alertMessage() {
		global $bw ;
		
		print 	"<script>
					vsf.alert('{$this->module->result['message']}');
					vsf.get('{$bw->input[0]}/display-obj-list/{$bw->input['pageCate']}/{$bw->input['pageIndex']}', 'obj-panel')
				</script>";	
		return true;
	}
	
	function getCategoryBox($message = "") {
		global $bw, $vsMenu, $vsSettings;
		$data['message'] = $message;

		$option = array('listStyle' => "| - -",
						'id'		=> "obj-category",
						'size'		=> 10,
						);
						
		if($vsSettings->getSystemKey("{$bw->input[0]}_multi_cat", 1)) $option['multiple'] = "multiple";
		$menu = new Menu();
		$menu = $this->module->getCategories();
		$data['html'] = $vsMenu->displaySelectBox($menu->getChildren(), $option);
		
		return $this->html->categoryList($data);
	}
	
	function loadDefault() {
		global $vsPrint;
		
		$vsPrint->addJavaScriptFile("tiny_mce/tiny_mce");
		
		$vsPrint->addJavaScriptString('init_tab','
			$(document).ready(function(){
    			$("#page_tabs").tabs({
    				cache: false
    			});
  			});
		');
		
		$this->setOutput($this->html->managerObjHtml());
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
}
?>
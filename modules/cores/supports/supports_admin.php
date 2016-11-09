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
 +-----------------------------------------------------------------------------
 */
require_once(CORE_PATH."supports/supports.php");

class supports_admin {
	protected $html = "";
	protected $module;

	protected $output = "";

	public function __construct(){
		global $vsTemplate;

		$this->module = new supports();
		$this->html = $vsTemplate->load_template('skin_supports');
	}

	function auto_run() {
		global $bw;
		switch($bw->input[1]){
			case 'delete-checked-obj':
				$this->module->delete(rtrim($bw->input['checkedObj'],","));
				break;
					
			case 'visible-checked-obj':
				$this->module->updateStatus(rtrim($bw->input['checkedObj'],","),array("supportStatus" => 1));
				break;

			case 'hide-checked-obj':
				$this->module->updateStatus(rtrim($bw->input['checkedObj'],","),array("supportStatus" => 0));
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

	function displayObjTab() {
		$option['categoryList'] = $this->getCategoryBox();
		$option['objList'] 	= $this->getObjList();
		$this->output = $this->html->displayObjTab($option);
	}
		
	function getObjList($catId='', $message=""){
		global $bw, $vsStd,$vsSettings;
		$catId = intval($catId);
		$categories = $this->module->getCategories();
		// Check if the catIds is specified
		// If not just get all product
		if(!intval($catId)){
			$strIds = $this->module->vsMenu->getChildrenIdInTree( $categories);
		}else{
			$result = $this->module->vsMenu->extractNodeInTree($catId, $categories->getChildren());
			if($result)
			$strIds = trim($catId.",".$this->module->vsMenu->getChildrenIdInTree($result['category']),",");
		}
		// Set the condition to get all product in specified category and its chidlren
		$this->module->setCondition($this->module->getCategoryField().' in ('. $strIds. ')');

		$end = $this->module->getNumberOfObject();
		$size = $vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number",10);
		$limit = array();
		if($end > $size){
			// Build page link for product list
			$vsStd->requireFile(LIBS_PATH.'Pagination.class.php');
			$pagination = new VSFPagination();
			$pagination->ajax 				= 1;
			$pagination->callbackobjectId 	= 'obj-panel';
			$pagination->url 				= "{$bw->input[0]}/display-obj-list/{$catId}/";
			$pagination->p_Size 			= $size;
			$pagination->p_TotalRow 		= $end ;
			$pagination->SetCurrentPage(3);
			$pagination->BuildPageLinks();
			$limit = array($pagination->p_StartRow,$pagination->p_Size);
		}
		$this->module->setOrder("{$this->module->getPrimaryField()} DESC");
		$this->module->setLimit($limit);
		$this->module->getObjectsByCondition();

		$option['paging'] = $pagination->p_Links;
		$option['message'] = $message;
		$option['categoryId'] = $catId;
		return $this->output = $this->html->objListHtml($this->module->getArrayObj(), $option);
	}

	function addEditObjForm($objId=0, $option=array()){
		global $vsLang, $vsStd,$bw,$vsMenu,$vsSettings;
		$vsSettings->getSystemKey($bw->input[0].'_nick',1);
		$vsSettings->getSystemKey($bw->input[0].'_index',1);
		$vsSettings->getSystemKey($bw->input[0].'_image',1);
		$vsSettings->getSystemKey($bw->input[0].'_status',1);
		$vsSettings->getSystemKey($bw->input[0].'_intro',1);
		$vsSettings->getSystemKey($bw->input[0].'_type',1);
		$vsSettings->getSystemKey($bw->input[0].'_nickicon',1);

		$obj = $this->module->createBasicObject();
		$option['formSubmit'] = $vsLang->getWords('obj_EditObjFormButton_Add', 'Add');
		$option['formTitle']  = $vsLang->getWords('obj_EditObjFormTitile_Add', "Add {$bw->input[0]}");
		$nickicons = $vsMenu->getCategoryGroup("nickicons")->getChildren();
		if(count($nickicons)){
			foreach ($nickicons as $icon){
				$icon->getIsDropdown()?$option['icon_online'][]=$icon:$option['icon_offline'][]=$icon;
			}
		}
		if($objId){
			$option['formSubmit'] = $vsLang->getWords('obj_EditObjFormButton_Edit', 'Edit');
			$option['formTitle']  = $vsLang->getWords('obj_EditObjFormTitile_Edit', "Edit {$bw->input[0]}");
			$obj = $this->module->getObjectById($objId);
			$option['categoryId'] = $obj->createCategory()->getId();
		}
		else{
			if(count($option['icon_offline']))
				$obj->setImageOffline(current($option['icon_offline'])->getId());
			if(count($option['icon_online']))
				$obj->setImageOnline(current($option['icon_online'])->getId());
		}

		$obj->setStatus($obj->getStatus()?'checked':'');
		$vsStd->requireFile(UTILS_PATH."class_editor.php");
		$editor = new class_editor();
		$editor->setToolbarSet("narrow");
		$editor->setValue($obj->getIntro());
		$editorHtml=$editor->createEditor("supportIntro",array('width'=>'400px;','height'=>'150px'));
		$obj->setIntro($editorHtml);
		return $this->output = $this->html->addEditObjForm($obj, $option);
	}

	function addEditObjProcess(){
		global $bw, $vsStd, $vsLang ,$vsSettings;
		if($bw->input['supportStatus']) $bw->input['supportStatus'] 	= 1;
		if(!$bw->input['supportCatId'])
		$bw->input['supportCatId']=$this->module->getCategories()->getId();
		if($bw->input['fileId'])
		$bw->input['supportAvatar']=$bw->input['fileId'];

		// If there is Object Id passed, processing updating Object
		if($bw->input['supportId']){
			$obj = $this->module->getObjectById($bw->input['supportId']);
			$imageOld =$obj->getAvatar();
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
			$this->module->obj->convertToObject($bw->input);
			$this->module->insertObject($this->module->obj);
		}

		if($vsSettings->getSystemKey("{$bw->input[0]}_multi_file",1))
		{
			$this->module->vsRelation->setObjectId($this->module->obj->getId());
			$this->module->vsRelation->setRelId($bw->input['fileId']);
			$this->module->vsRelation->setTableName($this->module->getRelTableName());
			$this->module->vsRelation->insertRel();
		}
		else
		{
			// nêu khong dùng multi file thì sẽ loại bỏ những file dư thừa
			if($imageOld&&$bw->input['fileId']){
				$this->module->vsFile->deleteFile($imageOld);
			}
		}
		$this->alertMessage();
	}
	function alertMessage() {
		global $bw ;
		print 	"<script>
					vsf.alert(\"{$this->module->result['message']}\");
					vsf.get('{$bw->input[0]}/display-obj-list/', 'obj-panel')
				</script>";	
		return true;
	}

	function getCategoryBox($message="") {
		global $bw , $vsMenu;
		$menu = $this->module->getCategories();

		return $this->html->categoryList($menu);
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
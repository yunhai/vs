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
require_once(CORE_PATH."weblinks/weblinks.php");

class weblinks_admin {
	protected $html = "";
	protected $module;
	protected $output = "";

	public function __construct(){
		global $vsTemplate;
		$this->module = new weblinks();
		$this->html = $vsTemplate->load_template('skin_weblinks');
	}

	function auto_run() {
		global $bw;
		switch($bw->input[1]){
			case 'delete-checked-obj':
				$this->module->delete(rtrim($bw->input['checkedObj'],","));
				break;
			case 'visible-checked-obj':
				$this->module->updateStatus(rtrim($bw->input['checkedObj'],","),array("weblinkStatus" => 1));
				break;
			case 'hide-checked-obj':
				$this->module->updateStatus(rtrim($bw->input['checkedObj'],","),array("weblinkStatus" => 0));
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
		global $bw, $vsSettings;
		if($vsSettings->getSystemKey($bw->input[0].'_category_tab',1))
		$option['categoryList'] = $this->getCategoryBox();
		$option['objList'] 	= $this->getObjList();
		$this->output = $this->html->displayObjTab($option);
	}
		
	function getObjList($catId='', $message=""){
		global $bw, $vsStd ,$vsSettings;
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
		$size =$vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number",10);
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
		$obj = $this->module->createBasicObject();
		$option['formSubmit'] = $vsLang->getWords('obj_EditObjFormButton_Add', 'Add');
		$option['formTitle']  = $vsLang->getWords('obj_EditObjFormTitile_Add', "Add {$bw->input[0]}");

		if($objId){
			$option['formSubmit'] = $vsLang->getWords('obj_EditObjFormButton_Edit', 'Edit');
			$option['formTitle']  = $vsLang->getWords('obj_EditObjFormTitile_Edit', "Edit {$bw->input[0]}");
			$obj = $this->module->getObjectById($objId);
			$obj->createCategory();
			$this->module->vsRelation->setObjectId($obj->getId());
			$this->module->vsRelation->setTableName("weblink_link");
			$this->module->vsRelation->getRelByObject();
			$option['access']=$this->module->vsRelation->arrval;
		}
		$vsStd->requireFile(CORE_PATH.'access/access.php');
		$access= new accesses();
		$access->setGroupby("accessModule,accessAction");
		$array=$access->getObjectsByCondition();
		$vsStd->requireFile(UTILS_PATH."class_editor.php");
		$editor = new class_editor();
		$editor->setValue($obj->getContent());
		$editorHtml=$editor->createEditor("weblinkContent",array('width'=>'650px','height'=>'350px'));
		$obj->setContent($editorHtml);
		$editor->setToolbarSet("narrow");
		$editor->setValue($obj->getIntro());
		$editorHtml=$editor->createEditor("weblinkIntro",array('width'=>'515px;','height'=>'150px'));
		$obj->setIntro($editorHtml);
		return $this->output = $this->html->addEditObjForm($obj, $option,$array);
	}

	function addEditObjProcess(){
		global $bw, $vsStd, $vsLang,$vsSettings;
		if($bw->input['weblinkStatus']) $bw->input['weblinkStatus'] 	= 1;
		if(!$bw->input['weblinkCatId'])
		$bw->input['weblinkCatId']=$this->module->getCategories()->getId();
		if($bw->input['fileId'])
		$bw->input['weblinkFileId']=$bw->input['fileId'];

		$posStr = "@";
		$dbobj['weblinkPosition'] = $posStr;
		$posStr.=$bw->input['posTop']?'1':'0';
		$posStr.=$bw->input['posRight']?'1':'0';
		$posStr.=$bw->input['posCenter']?'1':'0';
		$posStr.=$bw->input['posBottom']?'1':'0';
		$posStr.=$bw->input['posLeft']?'1':'0';
		$bw->input['weblinkPosition'] = $posStr;
		// If there is Object Id passed, processing updating Object
		if($bw->input['weblinkId']){
			$obj = $this->module->getObjectById($bw->input['weblinkId']);
			$imageOld =$obj->getFileId();
			if(!$obj){
				$this->alertMessage();
			}
			$objUpdate = $this->module->createBasicObject();
			$objUpdate->convertToObject($bw->input);
			$this->module->updateObjectById($objUpdate);
			if($bw->input['relAccess']){
				$this->module->vsRelation->setObjectId($this->module->obj->getId());
				$this->module->vsRelation->setRelId($bw->input['relAccess']);
				$this->module->vsRelation->setTableName("weblink_link");
				$this->module->vsRelation->insertRel();
			}
			if(!$this->module->result['status']){
				$this->module->reportError();
			}
		}
		else{
			$bw->input['relAccess']?"":$bw->input['relAccess']=-1;
			$this->module->obj->convertToObject($bw->input);
			$this->module->insertObject($this->module->obj);
			if($this->module->result['status']){
				$this->module->vsRelation->setObjectId($this->module->obj->getId());
				$this->module->vsRelation->setRelId($bw->input['relAccess']);
				$this->module->vsRelation->setTableName("weblink_link");
				$this->module->vsRelation->insertRel();
			}
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
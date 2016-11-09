<?php
/*
+-----------------------------------------------------------------------------
|   VS FRAMEWORK 3.0.0
|	Author: BabyWolf
|	Homepage: http://vietsol.net
|	If you use this code, please don't delete these comment line!
|	Start Date: 21/09/2004
|	Finish Date: 22/09/2004
|	Version 2.0.0 Start Date: 07/02/2007
|	Version 3.0.0 Start Date: 03/29/2009
+-----------------------------------------------------------------------------
*/

if ( ! defined( 'IN_VSF' ) )
{
	print "<h1>Permission denied!</h1>You cannot access this area. (VS Framework is powered by <a href=\"http://www.vietsol.net\">Viet Solution webdesign company</a>)";
	exit();
}

global $vsStd;
$vsStd->requireFile(CORE_PATH."users/users.php");

class users_admin 
{
    private $output		= "";
	private $html       = "";
	protected  $module       = "";
	function __construct() {
		global $vsStd, $vsPrint,$vsTemplate;
    	$this->module = new users();
    	$vsPrint->addJavaScriptFile('encryptor');
        $this->html = $vsTemplate->load_template('skin_users');
	}
	
	
	function setOutput($html="") {
		$this->output = $html;
	}
	
	function getOutput() {
		return $this->output;	
	}
    
    function auto_run(){
		global $bw;
		switch($bw->input['action']){
			case 'delete-user-group':
					$this->deleteGroup($bw->input[2]);
				break;
			case 'edit-group':
					$this->addEditGroupForm($bw->input[2]);
				break;
			
			case 'hide-checked-obj':
					$this->module->updateStatus(rtrim($bw->input['checkedObj'],","),array("userStatus" => 0));
					$this->getObjList($this->module->result['message']);
				break;
			case 'visible-checked-obj':
					$this->module->updateStatus(rtrim($bw->input['checkedObj'],","),array("userStatus" => 1));
					$this->getObjList($this->module->result['message']);
				break;
			case 'display-list-group':
					$this->getGroupList();
				break;
			case 'add-group':
					$this->addEditUserGroup();
				break;
			case 'display-group-tab':
					$this->displayGroup();
				break;
			/* Admin permssion zone */
			case 'savepermission':
					$this->savePermission();
				break;
			case 'getpermission':
					$this->getPermissionList($bw->input[2],$bw->input[3]);
				break;
			case 'permission':
					$this->viewPermission();
				break;
			case 'edit-obj-form':
					$this->addEditUserForm($bw->input[2]);
				break;
			case 'add-obj-form':
					$this->addEditUserForm();
				break;
			case 'add-edit-obj':
					$this->addEditUser();
				break;
			case 'display-obj-list':
					$this->getObjList();
				break;
			case 'delete-checked-obj':
					$this->module->deleteObjectById(rtrim($bw->input['checkedObj'],","));
					$this->getObjList($this->module->result['message']);
				break;
			case 'display-obj-tab':
					$this->displayUsers();
				break;
			default: 
					$this->loadDefault();
				break;
		}
	}
	
	function getObjList($message=""){
		global $bw,$vsSettings;
		$end = $this->module->getNumberOfObject();
		$size = $vsSettings->getSystemKey("admin_{$bw->input[0]}_list_number",10);
		$option=$this->module->getPageList("{$bw->input[0]}/display-obj-list/", 2, $size,1,'obj-panel');
		$option['message']=$message;
		return $this->output = $this->html->objListHtml($option);
	}
	
	function displayUsers($message='') {
		$userFormHTML = $this->addEditUserForm();
		$userTableHTML = $this->getObjList();
		return $this->setOutput($this->html->mainUserHtml($userFormHTML,$userTableHTML,$message));
	}
	//===============================================
	// USER GROUP
	//===============================================
//	function deleteGroup($groupId=0) {
//		
//		$this->module->groupusers->deleteObjectById($groupId);
//		$this->setOutput($this->getGroupList($this->module->groupusers->result['message']));
//	}
	function deleteGroup($groupId=0) {
		if($groupId)
		$this->module->groupusers->setCondition("groupId in ($groupId)");
		$this->module->groupusers->deleteObjectByCondition();
		$this->setOutput($this->getGroupList($this->module->groupusers->result['message']));
	}
	
	function addEditUserGroup() {
		global $bw; 
		$this->module->groupusers->obj->convertToObject($bw->input);
		if($bw->input['formType']=='edit') 
			$this->module->groupusers->updateObjectById($this->module->groupusers->obj);		
		else 
			$this->module->groupusers->insertObject($this->module->groupusers->obj);
		return $this->output = $this->getGroupList("user insert success");	
		return $this->output = $this->addEditGroupForm(0,$this->module->groupusers->result['message']);
	}
	
	function getGroupList($message="") {
		$this->module->groupusers = new groupusers();
		$arrayGroup=$this->module->groupusers->getArrayObj();
		return $this->output = $this->html->groupTable($arrayGroup,$message);
	}
	
	function addEditGroupForm($groupId=0, $message = "") {
		global $vsLang;
		$group = $this->module->groupusers->createBasicObject();
		$form['type'] = "add";
		$form['title'] = $vsLang->getWords('user_group_title_add',"Add new group");
		$form['submit'] = $vsLang->getWords('user_group_bt_add',"Add");
		$form['message'] = $message;
		if($groupId) 
		{
			$group = $this->module->groupusers->getObjectById($groupId);
			$form['type'] = "edit";
			$form['title'] = $vsLang->getWords('user_group_title_edit',"Edit a group");
			$form['submit'] = $vsLang->getWords('user_group_bt_edit',"Edit");
		}
		return $this->output = $this->html->addEditGroupForm($form, $group);
	}
	
	function displayGroup() {
		$groupTableHTML = $this->getGroupList();
		$addEditGroupForm = $this->addEditGroupForm();
		
		$this->setOutput($this->html->mainGroup($addEditGroupForm,$groupTableHTML));
	}
	
	function savePermission($type='admin') {
		global $bw, $vsModule;
		
		// First get module information and group information
		$this->getGroupById($bw->input['groupId']);
		$vsModule->getModuleById($bw->input['moduleId']);
		
		// If group and module is not exist return the error
		if(!$this->result['status'] && !$vsModule->result['status']) {
			$this->getPermissionList($this->result['message']."<br />".$vsModule->result['status']);
			return;
		}
		
		// Get the current permission and asign to temporary $currentPermission variable
		$currentPermission = $this->group->getPermissions();
		if(!is_array($currentPermission)) $currentPermission = array();
		
		// Get the permssion of the current module
		require_once(CORE_PATH.$vsModule->module->getClass()."/".$vsModule->module->getClass()."_".$type.".php");
		$thisControllerName = $vsModule->module->getClass()."_".$type;
		$thisModuleObject = new $thisControllerName;
		$currentModulePermission = $thisModuleObject->getPermission();
		
		// Fill the module name before permission item
		foreach ($currentModulePermission[1] as $key => $value) {
			$newModulePermission[$vsModule->module->getClass()."/".$key] = $value;
		}

		// Now get the preserved permission
		$preservePermission = array_diff_key($currentPermission,$newModulePermission);

		// Reset the permission of this group
		$this->group->resetPermission();
		
		// Get number of permission of the module for the next loop
		$count = $bw->input['permCount'];
		for($i=1; $i<=$count; $i++) {
			// If permission is checked set permission for group
			if($bw->input['perm_'.$i]) {
				$this->group->setPermission($vsModule->module->getClass()."/".$bw->input['perm_'.$i],true);
			}
		}
		
		// Merget the preserved Permssion with the new permission
		$this->group->setPermissions(array_merge($this->group->getPermissions(),$preservePermission));
		
		// Update permissions for group after proccessing
		$this->updateGroup();
		
		$this->getPermissionList($bw->input['moduleId'],$bw->input['groupId'],$this->result['message']);
	}
	
	function getPermissionList($moduleId=0,$groupId=0,$message="") {
		global $vsModule;
				
		$this->getGroupById($groupId);
		$vsModule->getModuleById($moduleId);
		
		if(!$vsModule->result['status']) {
			$this->output = $vsModule->result['message'];
			return;
		}
		
		$requireFile = CORE_PATH.$vsModule->module->getClass()."/".$vsModule->module->getClass()."_admin.php";
		require_once($requireFile);
		$className = $vsModule->module->getClass()."_admin";		
		$this_module = new $className;
		$permission = $this_module->getPermission();
		
		$permListHTML .= $this->html->module->objPermModule($permission[0]);
		
		$count=0;
		foreach ($permission[1] as $key => $value) {
			$count++;
			$permItem['order'] = $count;
			$permItem['name'] = $value;
			$permItem['path'] = $key;
			if($this->group->getPermission($vsModule->module->getClass()."/".$key)) $permItem['checked'] = " checked";
			else $permItem['checked'] = "";
			$permListHTML .= $this->html->module->objPermItem($permItem);
		}
		
		$perm = array(	'list' 		=> $permListHTML,
						'count'		=> $count,
						'moduleId'	=> $moduleId,
						'groupId'	=> $groupId
						);
						
		$this->output = $this->html->module->objPermList($perm,$message);
	}
	
	function viewPermission() {
		global $vsModule, $vsStd;
		$groupBoxHTML = $this->html->permGroupBox($this->module->groupusers->getArrayObj());
		$vsModule->getEnabledModule();
		foreach ($vsModule->arrayModule as $module) {
			$requireFile = MODS_PATH.$module->getClass()."/".$module->getClass().".perm.php";
			// If the file is not exist, don't process for this module
			if(!file_exists($requireFile)) continue;
			$vsStd->requireFile($requireFile);
			$className = $module->getClass()."_perm";
			// If the class is not exist, don't process for this module
			if(!class_exists($className)) continue;
			$this_module = new $className;
			
			// If the getAdminPermission method is not exist, don't process for this module
			if(!method_exists($this_module,'getAdminPermission')) {
				unset($this_module);
				continue;
			}
			
			$permission = $this_module->getAdminPermission();
			
			$moduleItemHTML .= $this->html->ModuleOption($permission[0],$module);
		}
		
		$moduleListHTML = $this->html->ModuleBox($moduleItemHTML);
//		$permTableHTML = $this->getAdminModuleList();
		
		$this->output = $this->html->mainPermission($moduleListHTML,$groupBoxHTML);	
	}
	
	function addEditUser() {
		global $bw;
		$bw->input['userStatus']=$bw->input['userStatus']?$bw->input['userStatus']:0;
		$this->module->setCondition("userName = '{$bw->input['userName']}'");
		$this->module->getObjectsByCondition();
		if($this->module->result['status'])
		{
			return $this->getObjList($this->module->result['message']);
		}
		$this->module->obj->convertToObject($bw->input);
		
		if(is_array($bw->input['group']))
			$this->module->obj->setGroups($bw->input['group']);
		
		if($this->module->obj->getId()) {
			$this->module->updateObjectById($this->module->obj);
		}
		else {
			$this->module->obj->setJoinDate(time());
			$this->module->insertObject($this->module->obj);
		}
		if($this->module->result['status'])
		{
			$this->module->vsRelation->setObjectId($this->module->obj->getId());
			$this->module->vsRelation->setRelId(implode(',',$bw->input['group']));
			$this->module->vsRelation->setTableName($this->module->getRelTableName());
			$this->module->vsRelation->insertRel();
		}
		$bw->input[3]=$bw->input['pageIndex'];
		$this->getObjList($this->module->result['message']);
	}
	
	function addEditUserForm($userId=0, $message="") {
		$this->module->obj=$this->module->createBasicObject();
		$form['type'] = "add";
		$form['group']=$this->module->groupusers->getArrayObj();
		$form['message'] = $message;
		$form['formSubmit']="Add";
		$form['formTitle'] ="Add New User";
		if($userId){
			$form['type'] = "edit";
			$form['formSubmit']="Edit";
			$form['formTitle']="Edit User";
			$this->module->getObjectById($userId);
			$this->module->vsRelation->setObjectId($this->module->obj->getId());
			$this->module->vsRelation->setTableName($this->module->getRelTableName());
			$this->module->vsRelation->getRelByObject();
			$form['cur_groups']=$this->module->vsRelation->arrval;
		}
		return $this->output = $this->html->addEditObjForm($this->module->obj,$form);
	}
	
	function addEditGroup() {
		global $bw;
		
		$this->group->convertToObject($bw->input);
		
		if($bw->input['formType']) {
			$this->updateGroup();			
		}
		else {
			$this->insertGroup();
		}
		
		if($this->result['status']) {
			$this->output = $this->addEditGroupForm(0,$this->result['message']);
		}
		else {
			$this->output = $this->addEditGroupForm(1,$this->result['message']);
		}
		
	}
	
	function displayEditGroupForm() {
		global $bw;
		
		$this->getGroupById($bw->input[2]);

		$this->output = $this->addEditGroupForm(1);
	}
	
	
	function loadDefault() {
		global $vsPrint;
		$vsPrint->addJavaScriptString('init_tab',
			'$(document).ready(function(){
				$("#page_tabs").tabs({fx:{opacity: "toggle"},cache:true});
			});'
    		);
    		
		$this->output = $this->html->MainPage();
	}
}
?>
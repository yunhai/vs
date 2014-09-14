<?php
require_once(CORE_PATH.'users/users.php');

class users_controler extends VSControl_admin {

	function __construct($modelName){
		global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_users");
		
		parent::__construct($modelName,"skin_users","user");
		$this->model->categoryName="users";
	}

	function auto_run() {
	    global $bw;
// 	    print "<pre>";
// 	    print_r($bw->input);
// 	    print "</pre>";exit;
	    switch ($bw->input ['action']) {
	    	case 'dologin' :
	    	    $this->doLogin ();
	    	    break;
	    	    	
	    	case 'login' :
	    	    $this->displayLoginForm ();
	    	    break;
	    	    	
	    	case 'logout' :
	    	    $this->doLogout ();
	    	    break;
	    	
	    	case 'admins_info_form_process' :
	    	    $this->admins_info_form_process ();
	    	    break;
	    	default :
	    	    parent::auto_run ();
	    	    break;
	    }
	}
function displaySearch(){
		global $bw;
//		if (VSFactory::getSettings()->getSystemKey ( $bw->input [0] . '_category_list', 0, $bw->input[0] ))
//			$option ['categoryList'] = $this->getCategoryBox ();
			//$option ['objList'] = $this->getObjList ();
        	$order="";
        	$from="vsf_".$this->tableName;
        	$where="1=1";
        	if($bw->input['search']['title']){
        		$where.=" and (`title` like '%{$bw->input['search']['title']}%' or `name` like '%{$bw->input['search']['title']}%')";
        	}
        	if($bw->input['search']['id']){
        		$where.=" and `id`='{$bw->input['search']['id']}' ";
        	}
        	if(isset($bw->input['search']['catId']))
        	if($bw->input['search']['catId']>0){
        		$category=VSFactory::getMenus()->getCategoryById($bw->input['search']['catId']);
        		if($category){
	        		$idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
	        		$where.=" and `catId` in ({$idns})";
        		}
        	}else{
        		if($this->model->categoryName){
        			$category=VSFactory::getMenus()->getCategoryGroup($this->model->categoryName);
        			if($category){
		        		$idns=VSFactory::getMenus()->getChildrenIdInTree($category->getId());
		        		$where.=" and `catId` in ({$idns})";
        			}
        		}
        	}
        	if($bw->input['search']['status']!=-1&&$bw->input['search']['status']!==NULL){
	        		$where.=" and `status`='{$bw->input['search']['status']}'";
        		
        	}
        	$this->model->setCondition($where);
        	
        	$itemList=$this->model->getObjectsByCondition();
        	$vdata['search']=$bw->input['search'];
        	$option['vdata']=json_encode($vdata);
        	//if(!is_object($_GET['search'])) $_GET['search']=array();
        	$tmp['search']=$_GET['search'];
        	$bw->input['back']=urldecode( http_build_query($tmp	))."&pageIndex=".$bw->input['pageIndex'];
		return $this->output = $this->html->getListItemTable ($itemList, $option );
	}

	function addEditObjForm($objId = 0, $option = array()) {
		global  $vsStd, $bw, $vsPrint;

		$option['location'] = VSFactory::getMenus()->getCategoryGroup('locations')->getChildren();
		return parent::addEditObjForm($objId,$option);
	}
	function addEditObjProcess(){
		global $bw;
		
		print "<pre>";
		print_r($bw->input);
		print "</pre>";exit;
		$admins->getObjectById ( VSFactory::getAdmins ()->basicObject->getId () );
		$admins->basicObject->setEmail ( $bw->input ['admins'] ['email'] );
		$admins->basicObject->setAddress ( $bw->input ['admins'] ['address'] );
		$admins->basicObject->setPhone ( $bw->input ['admins'] ['phone'] );
		if ($bw->input ['admins'] ['password']) {
			$admins->basicObject->setPassword ( md5 ( $bw->input ['admins'] ['password'] ) );
		}
		$admins->updateObject ();
		VSFactory::getAdmins ()->basicObject = $admins->basicObject;
		return $this->admins_info_form ( $this->output = VSFactory::getLangs ()->getWords ( 'admin_update_successfully', "update successfully!" ) );
	}

	function getHtml(){
		return $this->html;
	}



	function getOutput(){
		return $this->output;
	}



	function setHtml($html){
		$this->html=$html;
	}




	function setOutput($output){
		$this->output=$output;
	}



	
	/**
	*Skins for user ...
	*@var skin_users
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}

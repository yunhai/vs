<?php
global $vsStd;
require_once(CORE_PATH."users/User.class.php");
require_once(CORE_PATH."users/sessions.php");
require_once(CORE_PATH."users/groupusers.php");

class users extends VSFObject {
	
	
	function authorize() {
		global $bw, $vsModule, $vsUser, $vsPrint;
	
		$access = array('login', 'logout', 'signup', "renew", "signup", "instant", "recover", "convert", "verifyemail", 'convertprofile');
		if(in_array($bw->input[1], $access)) return true;

		$valid = array( 'renew', 'logout', 'signup','updateCampus','instant', 'login', 'changelt',
						'usercp', 'changname', 'changepassword', 'changealias', 'changeemail', 
						'changepa', 'changepi', 'changepipv', 'acctab', 'protab','recover', 'settingtab',
						'sprofile', 'editsp', 'editprofile', 
						'editedu', 'deleteedu', 'editepro', 'deleteepro', 
						'editwork', 'editwpro', 'deletework','deletewpro'
		);
		
		if(!in_array($bw->input[1], $valid)){
			if($bw->input['statuscomment'] == 'statuscomment'){
				if(!$vsUser->obj->getId())
					$vsPrint->boink_it($bw->base_url."users/login");
				$bw->input['user_public_type']	= 'statuscomment';
				return true;
			}
			else $vsPrint->boink_it($bw->base_url."error");
		}
			
		if(in_array($bw->input[1], array('settingtab', 'sprofile', 'editsp'))){
			$bw->input['user_public_type']	= 'usersetting';	
		}
		
		if(in_array($bw->input[1], array('changelt', 'changname', 'changepassword', 'changealias', 'changeemail', 'changepa', 'changepi', 'changepipv', 'acctab'))){
			$bw->input['user_public_type']	= 'useraccount';	
		}
		
		if(in_array($bw->input[1], array('protab', 'editprofile', 'editedu', 'deleteedu', 'editepro', 'deleteepro', 'editwork', 'deletework', 'editwpro', 'deletewpro'))){
			$bw->input['userprofile'] = 'userprofile';
			$bw->input['user_public_type']	= 'userprofile';	
		}
			
		
		$this->sessions->deleteSession();
		if($vsUser->obj->getId()) {
			$this->sessions->setCondition("sessionCode='".$vsUser->sessions->obj->getCode()."'");
			$this->sessions->getObjectsByCondition();
			
			if($this->sessions->result['status']) {
				$vsUser->sessions->obj->setTime(time());
				$vsUser->sessions->updateLoginSession();
			}
			else {
				$vsModule->obj->setClass('users'); // Admin session time out
				$bw->input[2] = "timeout";
				$bw->input[1] = "login";
				$vsUser->obj->__destruct();
				unset($_SESSION[APPLICATION_TYPE]['obj']);
				unset($_SESSION[APPLICATION_TYPE]['session']);
				unset($_SESSION[APPLICATION_TYPE]['groups']);
			}
			return true;
		}
		
		if($bw->input[1] == 'protab'){
			global $vsTemplate;
			echo $vsTemplate->global_template->redirectJS('', $bw->vars['board_url']."/users/login");
			exit;
		}
		
		$vsPrint->boink_it($bw->base_url."users/login");
	}
	
	function convertNameToId($names = ""){
//		global $vsSettings;
		
//		$sname = $vsSettings->getSystemKey('global_system_message_name', 'system', 'global', 1, 1);
//		$salias = $vsSettings->getSystemKey('global_system_message_alias', 'system@icampux.com', 'global', 1, 1);
		
		if(!$names) return array();
		$array = explode(",", $names);
		$name = "";	$alias = "";
		
		$return = array();
		foreach($array as $element){
			$temp = trim($element);
			if(strrpos($temp, '@') === false)
				$alias .= "'".$temp."',";
			else $name .= "'".$temp."',";
		}
		
		
		
		if($name) $str = "userName in (".trim($name,",").")";
		if($alias){
			if($name) $str .= " OR ";
			$str .= "userAlias in (".trim($alias,",").")";
		}
		
		$this->setFieldsString("userId");
		$this->setCondition("(".$str.")");
		return $return = $this->getArrayByCondition('userId');
	}

	function checkProfile(){
		global $bw, $vsModule;
		$userId = $this->convertNameToId($bw->input['module']);

		if($userId){
			
			$bw->input['statuscomment'] = 'statuscomment';
			$bw->input['username'] 	= $bw->input['module'];
			$bw->input['profile'] 	= implode(',', array_keys($userId));
			
			$bw->input['vs'] = str_replace($bw->input['module'], '', $bw->input['vs']);
			$temp = explode("/", $bw->input['vs']);
			
			
			
			$bw->input[0] 	= 'users';
			$bw->input[1]	= 'profile';
			
			$i = 1;
			foreach($temp as $element){
				if($element){
					$bw->input[$i++] = $element;
					$vs .= $element."/"; 
				}
			}
			
			$bw->input['action']= $bw->input[1];
			
			$bw->input['module'] = 'users';
			
			
			$bw->input['vs'] = 'users/'.$vs;
			
			$vsModule->obj->setClass('users'); 
			
	
			return true;
		}
		return false;
	}




	public $sessions;
	public $obj;
	public $groupusers;
	protected $relTableName 	="";

	
	function getRelTableName() {
		return $this->relTableName;
	}

	 function setRelTableName($relTableName) {
		$this->relTableName = $relTableName;
	}
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'userId';
		$this->basicClassName 	= 'User';
		$this->tableName 		= 'user';
		$this->relTableName 	= "user_group";
		$this->sessions = 	new usersessions();
		$this->groupusers = new groupusers();
		
		$this->obj = $this->createBasicObject();
		
	}
	
	 function checkUserPermission($permission=array()) {
		global $bw, $vsUser, $vsLang;

		$this->result['status'] = true;
		$bw->input['action'] = $bw->input['action']?$bw->input['action']:'default';
		
		// If this admin is in root groups
		// return true to allow all actions
		$userPermission = array();

		foreach ($vsUser->user->getGroups() as $group) {
			if(is_array($group->getPermission()))
				$userPermission = array_merge($group->getPermissions(), $userPermission);
		}

		$thisPath = $bw->input['module']."/".$bw->input['action'];

		// If the module require to authorize for this action isset($permission[1][$thisPath])
		// And if this user is not allowed for this permission $userPermission[$thisPath]
		// return false
		if(!$userPermission[$thisPath] && isset($permission[1][$bw->input['action']]) ) {
			$this->result['status'] = false;
			$this->result['message'] = sprintf($vsLang->getWords('global_permission_denied',"<b>Permission denied!</b> You don't have permission to access this function.<br />Please contact your root administrators to allow the setting <b>'%s'</b> in <b>'%s'</b>"),$permission[1][$bw->input[action]],$permission[0]);
		}
	}

	function updateStatus($ids, $status){
		$this->setCondition("userId IN (". $ids.")");
		return $this->updateObjectByCondition($status);
	}
	
	function checkRoot($user=null) {
		global $bw,$vsUser;
		if(!is_object($user))
			$user=$vsUser->obj;
		$arrGroup=$user->getGroups();
		if(!count($arrGroup) and is_array($arrGroup))
			return false;
		if(array_key_exists($bw->vars['root_admin_groups'],$arrGroup))
			return true;
		return false;
	}















}
?>
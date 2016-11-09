<?php
global $vsStd;
require_once(CORE_PATH."users/profile/Profile.class.php");

class profiles extends VSFObject {
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'profileId';
		$this->basicClassName 	= 'Profile';
		$this->tableName 		= 'user_profile';
		
		$this->obj = $this->createBasicObject();
	}
	
	function getUserProfile($user = 0){
		if(!$user) return array();
		
		$cond = 'profileUser = '.$user;
		$this->setCondition($cond);
		$profiles = $this->getArrayByCondition('profileUser');
		$profile = current($profiles);
		return $profile;
	}
	
	function getUsersProfile($user = 0){
		if(!$user) return array();
		
		$cond = 'profileUser IN ('.$user.')';
		$this->setCondition($cond);
		return $this->getArrayByCondition('profileUser');
	}
}
?>
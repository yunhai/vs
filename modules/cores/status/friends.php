<?php
require_once(CORE_PATH."status/Friend.class.php");

class friends extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "friendId";
		$this->basicClassName = "Friend";
		$this->tableName = 'friend';
		$this->obj = $this->createBasicObject();
		
	}
	
	function __destruct(){	
		unset($this);
	}
	
	
	
	function getUserFriendIds($userId = 0, $min = 0){
		if(!$userId) return "";
		
		$cond = 'friendUser = '.$userId.' AND friendStatus > '.$min;
		$this->setCondition($cond);
		$this->setFieldsString('friendFriend');
		$array = $this->getArrayByCondition('friendFriend');
		return implode(',', array_keys($array));
	}
	
	function checkFriendRelationship($friend = 0, $userId = 0){
		if(!$userId){
			global $vsUser;
			$userId = $vsUser->obj->getId();
		}
		if($friend){
			$cond = 'friendUser = '.$userId.' AND friendFriend = '.$friend.' AND friendStatus > 0';
			$this->setCondition($cond);
			$this->setFieldsString('friendFriend');
			$array = $this->getArrayByCondition('friendFriend');

			if($array) return true;
		}
		return false;
	}

	//check friend of friend - extend network
	function checkFoFriendRelationship($friend = 0, $userId = 0){

		if(!$userId) $userId = $vsUser->obj->getId();
		if($friend){
			global $vsUser;
			$cond = 'friendUser = '.$userId.' AND friendStatus > 0';
			$this->setCondition($cond);
			$this->setFieldsString('friendFriend');
			$array = $this->getArrayByCondition('friendFriend');
			if($array[$friend]) return true;
			
			if($array){
				$tempId = implode(',', array_keys($array));
				
				$array = array();
				$cond = 'friendUser IN ('.$tempId.') AND friendFriend = '.$friend.' AND friendStatus > 0';
				$this->setCondition($cond);
				$this->setFieldsString('friendFriend');
				$array = $this->getArrayByCondition('friendFriend');

				if($array) return true;
			}
		}
		return false;
	}
	
	function checkMultiFriendRelationship($userId = 0){
		$array = array();
		if($userId){
			global $vsUser;
			$cond = 'friendUser = '.$vsUser->obj->getId().' AND friendFriend in ('.$userId.') AND friendStatus > 0';
			$this->setCondition($cond);
			$this->setFieldsString('friendFriend');
			$array = $this->getArrayByCondition('friendFriend');

			if($array) return $array;
		}
		return $array;
	}
	
	
}
?>
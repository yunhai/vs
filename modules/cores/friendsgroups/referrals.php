<?php
require_once(CORE_PATH."friendsgroups/Referral.class.php");

class referrals extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= "refId";
		$this->basicClassName 	= "Referral";
		$this->tableName 		= 'friend_referral';
		$this->obj 				= $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
<?php
require_once(CORE_PATH."friendsgroups/Group.class.php");

class groups extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= "groupId";
		$this->basicClassName 	= "Group";
		$this->tableName 		= 'friend_group';
		$this->obj 				= $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
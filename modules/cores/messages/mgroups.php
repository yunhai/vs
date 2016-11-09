<?php
require_once(CORE_PATH."messages/MGroup.class.php");

class mgroups extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "groupId";
		$this->basicClassName = "MGroup";
		$this->tableName = 'message_group';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
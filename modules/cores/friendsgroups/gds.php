<?php
require_once(CORE_PATH."friendsgroups/Gd.class.php");

class gds extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "gdId";
		$this->basicClassName = "Gd";
		$this->tableName = 'friend_group_detail';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
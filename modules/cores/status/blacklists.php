<?php
require_once(CORE_PATH."status/Blacklist.class.php");

class blacklists extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "statusId, statusUser";
		$this->basicClassName = "Blacklist";
		$this->tableName = 'status_blacklist';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
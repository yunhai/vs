<?php
require_once(CORE_PATH."users/setting/usGroup.class.php");

class usgroups extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "sgId";
		$this->basicClassName = "usGroup";
		$this->tableName = 'user_sgroup';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
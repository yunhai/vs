<?php
require_once(CORE_PATH."users/setting/usUser.class.php");

class ususers extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "usId";
		$this->basicClassName = "usUser";
		$this->tableName = 'user_suser';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
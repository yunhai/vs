<?php
require_once(CORE_PATH."users/setting/usItem.class.php");

class usitems extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "itemId";
		$this->basicClassName = "usItem";
		$this->tableName = 'user_sitem';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
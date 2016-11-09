<?php
require_once(CORE_PATH."messages/Deliver.class.php");

class delivers extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= "deliverId";
		$this->basicClassName 	= "Deliver";
		$this->tableName 		= 'message_deliver';
		$this->obj 				= $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
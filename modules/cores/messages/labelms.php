<?php
require_once(CORE_PATH."messages/Labelm.class.php");

class labelms extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "lmId";
		$this->basicClassName = "Labelm";
		$this->tableName = 'message_labelm';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
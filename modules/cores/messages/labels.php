<?php
require_once(CORE_PATH."messages/Label.class.php");

class labels extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= "labelId";
		$this->basicClassName 	= "Label";
		$this->tableName 		= 'message_label';
		$this->obj 				= $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
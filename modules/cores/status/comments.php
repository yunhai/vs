<?php
require_once(CORE_PATH."status/Comment.class.php");

class comments extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "commentId";
		$this->basicClassName = "Comment";
		$this->tableName = 'status_comment';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
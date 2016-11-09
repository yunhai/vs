<?php
require_once(CORE_PATH."status/Whitelist.class.php");

class whitelists extends VSFObject {
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "statusId";
		$this->basicClassName = "Whitelist";
		$this->tableName = 'status_whitelist';
	}
	
	function __destruct(){	
		unset($this);
	}
	

}
?>
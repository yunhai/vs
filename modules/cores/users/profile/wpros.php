<?php
global $vsStd;
require_once(CORE_PATH."users/profile/Wpro.class.php");

class wpros extends VSFObject {
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'wpId';
		$this->basicClassName 	= 'Wpro';
		$this->tableName 		= 'user_work_project';
		
		$this->obj = $this->createBasicObject();
	}
}
?>
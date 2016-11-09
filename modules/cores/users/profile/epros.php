<?php
global $vsStd;
require_once(CORE_PATH."users/profile/Epro.class.php");

class epros extends VSFObject {
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'epId';
		$this->basicClassName 	= 'Epro';
		$this->tableName 		= 'user_edu_project';
		
		$this->obj = $this->createBasicObject();
	}
}
?>
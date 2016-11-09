<?php
require_once (CORE_PATH . "search/Search.class.php");

class searchs extends VSFObject{
	public $obj;

	function __construct() {
		parent::__construct ();
		
		$this->primaryField 	= 'searchId';
		$this->basicClassName 	= 'Search';
		$this->tableName 		= 'search';
		
		$this->obj = $this->createBasicObject();
	}
	
	function deleteSearch($module = '', $obj = ''){
		if(!$module || !$obj) return false;
		
		$cond = 'searchModule = "'.$module.'" AND searchObj IN ('.$obj.')';
		$this->setCondition($cond);
		
		return $this->deleteObjectByCondition();
	}
}
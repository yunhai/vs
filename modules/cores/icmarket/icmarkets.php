<?php
global $vsStd;
require_once(CORE_PATH."icmarket/Icmarket.class.php");

class icmarkets extends VSFObject {
	public $obj;

	
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'cfId';
		$this->basicClassName 	= 'Icmarket';
		$this->tableName 		= 'icmarket';
		
		$this->obj = $this->createBasicObject();
	}
	

	function getCfCategory(){
		global $vsMenu;
		return $vsMenu->getCategoryGroup("ccategory")->getChildren();
	}
}
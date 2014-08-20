<?php
require_once(CORE_PATH."logos/Logo.class.php");

class logos extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Logo';
		$this->tableName 		= 'logo';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"logos";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Logo
	**/
	var		$obj;
}

<?php
require_once(CORE_PATH."slidebanners/Slidebanner.class.php");

class slidebanners extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Slidebanner';
		$this->tableName 		= 'slidebanner';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"slidebanners";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Slidebanner
	**/
	var		$obj;
}

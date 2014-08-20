<?php
require_once(CORE_PATH."trashs/Trash.class.php");

class trashs extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Trash';
		$this->tableName 		= 'trash';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"trashs";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Trash
	**/
	var		$obj;
}

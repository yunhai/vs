<?php 
require_once(CORE_PATH."documents/Document.class.php");

class documents extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Document';
		$this->tableName 		= 'document';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"documents";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Document
	**/
	var		$obj;
}

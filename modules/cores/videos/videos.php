<?php
require_once(CORE_PATH."videos/Video.class.php");

class videos extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Video';
		$this->tableName 		= 'video';
		$this->categoryField='catId';
		$this->categoryName=$category?$category:"videos";
		$this->createBasicObject();		parent::__construct();

	}




	
	/**
	*Enter description here ...
	*@var Video
	**/
	var		$obj;
}

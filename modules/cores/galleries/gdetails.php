<?php
require_once (CORE_PATH . "galleries/Gdetail.class.php");

class gdetails extends VSFObject{
	public $obj;

	function __construct() {
		parent::__construct ();
		
		$this->primaryField 	= 'gdId';
		$this->basicClassName 	= 'GDetail';
		$this->tableName 		= 'gallery_detail';
		
		$this->obj = $this->createBasicObject();
	}
}
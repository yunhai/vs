<?php
require_once (CORE_PATH . "galleries/Ginfo.class.php");

class ginfos extends VSFObject{
	public $obj;

	function __construct() {
		parent::__construct ();
		
		$this->primaryField 	= 'giId';
		$this->basicClassName 	= 'GInfo';
		$this->tableName 		= 'gallery_info';
		
		$this->obj = $this->createBasicObject();
	}
}
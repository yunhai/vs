<?php
require_once(CORE_PATH."campuses/Campus.class.php");

class campuses extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "campusId";
		$this->basicClassName = "Campus";
		$this->tableName = 'campus';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function getCampusList(){
		$this->setCondition('campusStatus > 0');
		$this->setOrder('campusTitle');
		return $this->getObjectsByCondition();
	}
	
	function getCampusByName($name){
		$this->setCondition('campusTitle like "%'.$name.'%" AND campusStatus > 0');
		return $this->getObjectsByCondition();
	}
}
?>
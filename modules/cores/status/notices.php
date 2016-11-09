<?php
require_once(CORE_PATH."status/Notice.class.php");

class notices extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "noticeId";
		$this->basicClassName = "Notice";
		$this->tableName = 'notice';
		$this->obj = $this->createBasicObject();
		
	}
	
	function __destruct(){	
		unset($this);
	}
	
	function getUserNotice($userId = 0){
		if(!$userId) return array();
		
		$cond = 'noticeUser = '.$userId.' AND noticeStatus = 0';
		$this->setCondition($cond);
		$this->setOrder('noticeTime DESC');
		
		return $this->getObjectsByCondition();
	}
	
}
?>
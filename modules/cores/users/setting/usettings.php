<?php
require_once(CORE_PATH."users/setting/uSetting.class.php");

class usettings extends VSFObject {
	public $obj;
	
	function __construct(){
		parent::__construct();
		
		$this->primaryField = "settingId";
		$this->basicClassName = "uSetting";
		$this->tableName = 'user_setting';
		$this->obj = $this->createBasicObject();
	}
	
	function __destruct(){	
		unset($this);
	}
}
?>
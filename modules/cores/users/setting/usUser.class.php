<?php
class usUser{
	private $id			= NULL;
	private $user		= NULL;
	private $setting	= NULL;
	private $value		= NULL;
	
	public $message = "";
	
	function __construct() {
	}
	
	function __destruct() {
		unset($this->id);
		unset($this->user);
		unset($this->setting);
		unset($this->value);
	}
	
	
	
	function convertToObject($object) {
		isset ( $object ['usId'] ) 		? ($this->id = $object['usId']) 			: '';
		isset ( $object ['usUser'] ) 	? ($this->user = $object['usUser']) 		: '';
		isset ( $object ['usSetting'] ) ? ($this->setting = $object['usSetting'])	: '';
		isset ( $object ['friendTime'] )? ($this->value = $object['usValue']) 		: '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['usId'] 		= $this->id) 		: '';
		isset ( $this->user) 		? ($dbobj ['usUser']	= $this->user) 		: '';
		isset ( $this->setting) 	? ($dbobj ['usSetting']	= $this->setting) 	: '';
		isset ( $this->value) 		? ($dbobj ['usValue'] 	= $this->value) 	: '';
		
		return $dbobj;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getUser() {
		return $this->user;
	}

	public function getSetting() {
		return $this->setting;
	}

	public function getValue() {
		return $this->value;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function setSetting($setting) {
		$this->setting = $setting;
	}

	public function setValue($value) {
		$this->value = $value;
	}

}
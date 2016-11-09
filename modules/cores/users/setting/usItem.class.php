<?php
class usItem{
	private $id			= NULL;
	private $setting	= NULL;
	private $title		= NULL;
	private $key		= NULL;
	private $value		= NULL;
	private $default	= NULL;
	private $index		= NULL;
	private $status		= NULL;
	
	
	public $message 	= "";
	
	function __construct() {
	}
	
	function __destruct() {
		unset($this->id);
		unset($this->setting);
		unset($this->title);
		unset($this->key);
		unset($this->value);
		unset($this->default);
		unset($this->index);
		unset($this->status);
	}
	
	function convertToObject($object) {
		isset ( $object ['itemId'] ) 		? ($this->id = $object['itemId']) 				: '';
		isset ( $object ['itemSetting'] ) 	? ($this->setting = $object['itemSetting']) 	: '';
		isset ( $object ['itemTitle'] ) 	? ($this->title = $object['itemTitle'])			: '';
		isset ( $object ['itemKey'] ) 		? ($this->key = $object['itemKey'])				: '';
		isset ( $object ['itemValue'] )		? ($this->value = $object['itemValue'])			: '';
		isset ( $object ['itemDefault'] )	? ($this->default = $object['itemDefault'])		: '';
		isset ( $object ['itemIndex'] ) 	? ($this->index = $object['itemIndex'])			: '';
		isset ( $object ['itemStatus'] ) 	? ($this->status = $object['itemStatus']) 		: '';
	}
	
	function convertToDB() {
		isset ( $this->id) 		? ($dbobj ['itemId'] 		= $this->id) 		: '';
		isset ( $this->setting) ? ($dbobj ['itemSetting']	= $this->setting) 	: '';
		isset ( $this->title) 	? ($dbobj ['itemTitle']		= $this->title) 	: '';
		isset ( $this->key) 	? ($dbobj ['itemKey']		= $this->key) 		: '';	
		isset ( $this->value) 	? ($dbobj ['itemValue']		= $this->value) 	: '';
		isset ( $this->default) ? ($dbobj ['itemDefault']	= $this->default) 	: '';
		isset ( $this->index) 	? ($dbobj ['itemIndex']		= $this->index) 	: '';
		isset ( $this->status) 	? ($dbobj ['itemStatus'] 	= $this->status)	: '';
		
		return $dbobj;
	}
	public function getId() {
		return $this->id;
	}

	public function getSetting() {
		return $this->setting;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getKey() {
		return $this->key;
	}

	public function getValue() {
		return $this->value;
	}

	public function getDefault() {
		return $this->default;
	}

	public function getIndex() {
		return $this->index;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setSetting($setting) {
		$this->setting = $setting;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setKey($key) {
		$this->key = $key;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function setDefault($default) {
		$this->default = $default;
	}

	public function setIndex($index) {
		$this->index = $index;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
}
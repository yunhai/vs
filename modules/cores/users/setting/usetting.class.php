<?php
class uSetting{
	private $id		= NULL;
	private $title	= NULL;
	private $key	= NULL;
	private $group	= NULL;
	private $index	= NULL;
	private $status	= NULL;
	
	
	public $message 	= "";
	
	function __construct() {
	}
	
	function __destruct() {
		unset($this->id);
		unset($this->title);
		unset($this->key);
		unset($this->group);
		unset($this->index);
		unset($this->status);
	}
	
	function convertToObject($object) {
		isset ( $object ['settingId'] ) 	? ($this->id = $object['settingId']) 		: '';
		isset ( $object ['settingTitle'] )	? ($this->title = $object['settingTitle'])	: '';
		isset ( $object ['settingKey'] )	? ($this->key = $object['settingKey'])		: '';
		isset ( $object ['settingGroup'] ) 	? ($this->group = $object['settingGroup']) 	: '';
		isset ( $object ['settingIndex'] )	? ($this->index = $object['settingIndex'])	: '';
		isset ( $object ['settingStatus'] ) ? ($this->status = $object['settingStatus']): '';
	}

	function convertToDB() {
		isset ( $this->id) 		? ($dbobj ['settingId'] 	= $this->id) 		: '';
		isset ( $this->title) 	? ($dbobj ['settingTitle']	= $this->title) 	: '';
		isset ( $this->group) 	? ($dbobj ['settingGroup']	= $this->group) 	: '';
		isset ( $this->key) 	? ($dbobj ['settingKey']	= $this->key) 	: '';
		isset ( $this->index) 	? ($dbobj ['settingIndex']	= $this->index) 	: '';
		isset ( $this->status) 	? ($dbobj ['settingStatus']	= $this->status) 	: '';	
		
		return $dbobj;
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getKey() {
		return $this->key;
	}

	public function getGroup() {
		return $this->group;
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

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setKey($key) {
		$this->key = $key;
	}

	public function setGroup($group) {
		$this->group = $group;
	}

	public function setIndex($index) {
		$this->index = $index;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
}
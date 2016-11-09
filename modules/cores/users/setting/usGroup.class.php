<?php
class usGroup{
	private $id			= NULL;
	private $title		= NULL;
	private $value		= NULL;
	private $status		= NULL;
	
	public $message 	= "";
	
	
	function __destruct() {
		unset($this->id);
		unset($this->title);
		unset($this->status);
	}
	
	
	function convertToObject($object) {
		isset ( $object ['sgId'] ) 		? ($this->id 	= $object['sgId']) 			: '';
		isset ( $object ['sgUser'] ) 	? ($this->title = $object['sgUser']) 		: '';
		isset ( $object ['sgValue'] ) 	? ($this->value = $object['sgValue']) 		: '';
		isset ( $object ['sgStatus'] ) 	? ($this->status = $object['sgStatus']) 		: '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['sgId'] 		= $this->id) 		: '';
		isset ( $this->title) 		? ($dbobj ['sgTitle']	= $this->title) 	: '';
		isset ( $this->value) 		? ($dbobj ['sgValue']	= $this->value) 	: '';
		isset ( $this->status) 		? ($dbobj ['sgStatus']	= $this->status) 	: '';
		return $dbobj;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getValue() {
		return $this->value;
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

	public function setValue($value) {
		$this->value = $value;
	}

	public function setStatus($status) {
		$this->status = $status;
	}


	
}
<?php
class Blacklist{
	private $id			= NULL;
	private $user		= NULL;
	private $level		= NULL;
	
	public $message 	= "";
	
	
	function __destruct() {
		unset($this->id);
		unset($this->user);
		unset($this->level);
	}
	
	
	function convertToObject($object) {
		isset ( $object ['statusId'] ) 		? ($this->id 	= $object['statusId']) 			: '';
		isset ( $object ['statusUser'] ) 	? ($this->user 	= $object['statusUser']) 		: '';
		isset ( $object ['statusLevel'] ) 	? ($this->level = $object['statusLevel']) 		: '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['statusId'] 		= $this->id) 		: '';
		isset ( $this->user) 		? ($dbobj ['statusUser']	= $this->user) 		: '';
		isset ( $this->level) 		? ($dbobj ['statusLevel']	= $this->level) 	: '';
		return $dbobj;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getUser() {
		return $this->user;
	}


	public function getLevel() {
		return $this->level;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser($user) {
		$this->user = $user;
	}


	public function setLevel($level) {
		$this->level = $level;
	}

	
}
<?php
class Referral{
	private $id			= NUll;
	private $user		= NULL;
	private $email		= NULL;
	private $time		= NULL;
	private $status		= NULL;
	
	function convertToObject($object) {
		isset ( $object ['refId'] ) 	? ($this->id 	= $object['refId']) 	: '';
		isset ( $object ['refUser'] ) 	? ($this->user 	= $object['refUser']) 	: '';
		isset ( $object ['refEmail'] ) 	? ($this->email = $object['refEmail']) 	: '';
		isset ( $object ['refTime'] ) 	? ($this->time = $object['refTime']) 	: '';
		isset ( $object ['refStatus'] ) ? ($this->status = $object['refStatus']): '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['refId'] 	= $this->id) 		: '';
		isset ($this->user) 	? ($dbobj ['refUser'] 	= $this->user) 		: '';
		isset ($this->email) 	? ($dbobj ['refEmail'] 	= $this->email) 	: '';
		isset ($this->time) 	? ($dbobj ['refTime'] 	= $this->time) 		: '';
		isset ($this->status) 	? ($dbobj ['refStatus'] = $this->status) 	: '';
		return $dbobj;
	}
	public function getId() {
		return $this->id;
	}

	public function getUser() {
		return $this->user;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getTime() {
		return $this->time;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setTime($time) {
		$this->time = $time;
	}
	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
}
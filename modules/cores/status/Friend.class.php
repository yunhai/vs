<?php
class Friend{
	private $id			= NULL;
	private $user		= NULL;
	private $friend		= NULL;
	private $time		= NULL;
	private $status		= NULL;
	
	public $message = "";
	
	function __construct() {
	}
	
	function __destruct() {
		unset($this->id);
		unset($this->user);
		unset($this->friend);
		unset($this->time);
		unset($this->status);
	}
	
	
	
	function convertToObject($object) {
		isset ( $object ['friendId'] ) 		? ($this->id = $object['friendId']) 			: '';
		isset ( $object ['friendUser'] ) 	? ($this->user = $object['friendUser']) 		: '';
		isset ( $object ['friendFriend'] ) 	? ($this->friend = $object['friendFriend'])		: '';
		isset ( $object ['friendTime'] ) 	? ($this->time = $object['friendTime']) 		: '';
		isset ( $object ['friendStatus'] ) 	? ($this->status = $object['friendStatus'])		: ($this->status = 0);
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['friendId'] 		= $this->id) 		: '';
		isset ( $this->user) 		? ($dbobj ['friendUser']	= $this->user) 		: '';
		isset ( $this->friend) 		? ($dbobj ['friendFriend']	= $this->friend) 	: '';
		
		isset ( $this->time) 		? ($dbobj ['friendTime'] 	= $this->time) 		: '';
		isset ( $this->status) 		? ($dbobj ['friendStatus']	= $this->status) 	: '';		
		
		return $dbobj;
	}
	public function getId() {
		return $this->id;
	}

	public function getUser() {
		return $this->user;
	}

	public function getFriend() {
		return $this->friend;
	}

	public function getTime() {
		return $this->time;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function setFriend($friend) {
		$this->friend = $friend;
	}

	public function setTime($time) {
		$this->time = $time;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	
}
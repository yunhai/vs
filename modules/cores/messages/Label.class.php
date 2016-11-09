<?php
class Label extends BasicObject{
	public $message = "";
	private $user	= NULL;
	
	function __destruct() {
		parent::__destruct();
		unset($this->user);
		//status: 0: hide, 1: display
	}
	
	function convertToObject($object) {
		isset ( $object ['labelId'] ) 		? $this->id 	= $object['labelId'] 		: '';
		isset ( $object ['labelUser'] ) 	? $this->user 	= $object['labelUser'] 	: '';
		isset ( $object ['labelTitle'] ) 	? $this->title 	= $object['labelTitle'] 	: '';
		isset ( $object ['labelStatus'] ) 	? $this->status = $object['labelStatus'] 	: '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['labelId'] 		= $this->id) 			: '';
		isset ( $this->user) 		? ($dbobj ['labelUser'] 	= $this->user) 			: '';
		isset ( $this->title) 	? ($dbobj ['labelTitle'] 	= $this->title) 		: '';
		isset ( $this->status) 		? ($dbobj ['labelStatus'] 	= $this->status) 		: '';
		
		return $dbobj;
	}
	
	function getUser() {
		return $this->user;
	}

	function setUser($user) {
		$this->user = $user;
	}
}
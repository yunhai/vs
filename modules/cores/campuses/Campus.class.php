<?php
class Campus extends BasicObject{
	private $address	= NULL;
	private $phone 		= NULL;
	

	public $message = "";
	function __destruct() {
		parent::__destruct();
		unset($this->address);
		unset($this->phone);
	}
	
	
	
	function convertToObject($object) {
		isset ( $object ['campusId'] ) 		? $this->setId($object['campusId']) 			: '';
		isset ( $object ['campusTitle'] ) 	? $this->setTitle($object['campusTitle']) 		: '';
		isset ( $object ['campusAddress'] ) ? $this->setAddress($object['campusAddress'])	: '';
		isset ( $object ['campusPhone'] ) 	? $this->setPhone($object['campusPhone'])	 	: '';
		isset ( $object ['campusStatus'] ) 	? $this->setStatus($object['campusStatus']) 	: '';
	}

	function convertToDB() {
		isset ( $this->id) 		? ($dbobj ['campusId'] 		= $this->id) 		: '';
		isset ( $this->title) 	? ($dbobj ['campusTitle'] 	= $this->title) 	: '';
		isset ( $this->address) 	? ($dbobj ['campusAddress']	= $this->address) 	: '';		
		isset ( $this->phone) 	? ($dbobj ['campusPhone'] 	= $this->phone) 	: '';			
		isset ( $this->status) 	? ($dbobj ['campusStatus'] 	= $this->status) 	: '';
		return $dbobj;
	}
	
	function validate() {
		$status = true;
		if ($this->title == "") {
			$this->message .= "campus name can not be blank!";
			$status = false;
		}
		return $status;
	}
	
	function getAddress() {
		return $this->address;
	}

	function getPhone() {
		return $this->phone;
	}

	function setAddress($address) {
		$this->address = $address;
	}

	function setPhone($phone) {
		$this->phone = $phone;
	}

}
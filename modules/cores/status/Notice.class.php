<?php
class Notice extends BasicObject{
	private $user		= NULL;
	private $obj		= NULL;
	private $time		= NULL;
	private $type		= NULL;
	
	public $message = "";
	
	function __construct() {
		parent::__construct();
	}
	
	function __destruct() {
		parent::__destruct();
		unset($this->user);
		unset($this->obj);
		unset($this->time);
		unset($this->type);
	}
	
	
	
	function convertToObject($object) {
		isset ( $object ['noticeId'] ) 		? ($this->id = $object['noticeId']) 			: '';
		isset ( $object ['noticeUser'] ) 	? ($this->user = $object['noticeUser']) 		: '';
		isset ( $object ['noticeObj'] ) 	? ($this->obj = $object['noticeObj']) 			: '';
		isset ( $object ['noticeContent'] ) ? ($this->content = $object['noticeContent'])	: '';
		isset ( $object ['noticeTime'] ) 	? ($this->time = $object['noticeTime']) 		: '';
		isset ( $object ['noticeType'] ) 	? ($this->type = $object['noticeType']) 		: '';
		isset ( $object ['noticeStatus'] ) 	? ($this->status = $object['noticeStatus'])		: ($this->status = 0);
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['noticeId'] 		= $this->id) 		: '';
		isset ( $this->user) 		? ($dbobj ['noticeUser']	= $this->user) 		: '';
		isset ( $this->obj) 		? ($dbobj ['noticeObj']		= $this->obj) 		: '';
		isset ( $this->content) 	? ($dbobj ['noticeContent']	= $this->content) 	: '';
		isset ( $this->type) 		? ($dbobj ['noticeType'] 	= $this->type) 		: '';
		isset ( $this->time) 		? ($dbobj ['noticeTime'] 	= $this->time) 		: '';
		isset ( $this->status) 		? ($dbobj ['noticeStatus']	= $this->status) 	: '';		
		
		return $dbobj;
	}
	
	function validate() {
		$status = true;
		return $status;
	}
	
	function getUser() {
		return $this->user;
	}

	function getObj() {
		return $this->obj;
	}

	function getTime() {
		return $this->time;
	}

	function getType() {
		return $this->type;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setObj($obj) {
		$this->obj = $obj;
	}

	function setTime($time) {
		$this->time = $time;
	}

	function setType($type) {
		$this->type = $type;
	}



}
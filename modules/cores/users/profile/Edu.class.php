<?php
class Edu{
	private $id		= NULL;
	private $user	= NULL;
	private $school = NULL;
	private $degree = null;
	private $major	= null;
	private $start	= null;
	private $end	= NULL;	
	private $main	= NULL;

	
	function convertToDB() {
		isset($this->id)        ? ($dbobj['eduId'] 			= $this->id) 	: '';
		isset($this->user)	  	? ($dbobj['eduUser'] 		= $this->user) 	: ''; 
		isset($this->school)	? ($dbobj['eduSchool'] 		= $this->school): '';
		isset($this->degree)	? ($dbobj['eduDegree'] 		= $this->degree): '';
		isset($this->major)		? ($dbobj['eduMajor'] 		= $this->major) : '';
		isset($this->start)     ? ($dbobj['eduStart'] 		= $this->start) : '';
		isset($this->end)      	? ($dbobj['eduEnd'] 		= $this->end) 	: '';
		isset($this->main)		? $dbobj['eduMain'] 		= $this->main 	: '';
		
		return $dbobj; 
	}
	
	function convertToObject($object) {
		isset($object['eduId']) 	? $this->id 	= $object['eduId']		:	'';
		isset($object['eduUser']) 	? $this->user 	= $object['eduUser']	:	'';
		isset($object['eduSchool']) ? $this->school = $object['eduSchool']	:	'';
		isset($object['eduDegree']) ? $this->degree = $object['eduDegree']	:	'';
		isset($object['eduMajor']) 	? $this->major 	= $object['eduMajor']	:	'';
		isset($object['eduStart']) 	? $this->start 	= $object['eduStart']	:	'';
		isset($object['eduEnd']) 	? $this->end 	= $object['eduEnd']		:	'';
		isset($object['eduMain']) 	? $this->main 	= $object['eduMain']	:	'';
	}
	
	public function getId() {
		return $this->id;
	}

	public function getUser() {
		return $this->user;
	}

	public function getSchool() {
		return $this->school;
	}

	public function getDegree() {
		return $this->degree;
	}

	public function getMajor() {
		return $this->major;
	}

	public function getStart() {
		return $this->start;
	}

	public function getEnd() {
		return $this->end;
	}

	public function getMain() {
		return $this->main;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function setSchool($school) {
		$this->school = $school;
	}

	public function setDegree($degree) {
		$this->degree = $degree;
	}

	public function setMajor($major) {
		$this->major = $major;
	}

	public function setStart($start) {
		$this->start = $start;
	}

	public function setEnd($end) {
		$this->end = $end;
	}

	public function setMain($main) {
		$this->main = $main;
	}

	
	

}
?>
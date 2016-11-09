<?php
class Work{
	private $id		= NULL;
	private $user 	= NULL;
	private $title	= NULL; // job title
	private $company= NULL;
	private $start	= NULL;
	private $end	= NULL;

	function convertToDB() {
		isset($this->id)        ? ($dbobj['workId'] 	= $this->id) 		: '';
		isset($this->user)      ? ($dbobj['workUser'] 	= $this->user) 		: '';
		isset($this->title)     ? ($dbobj['workTitle'] 	= $this->title) 	: '';
		isset($this->company)	? ($dbobj['workCompany']= $this->company)	: '';
		isset($this->start)		? ($dbobj['workStart'] 	= $this->start) 	: '';
		isset($this->end)		? ($dbobj['workEnd'] 	= $this->end) 		: '';

		return $dbobj; 
	}
	
	function convertToObject($object) {
		isset($object['workId'])		?	$this->id 		= $object['workId']			:	'';
		isset($object['workUser'])		?	$this->user 	= $object['workUser']		:	'';
		isset($object['workTitle'])		?	$this->title 	= $object['workTitle']		:	'';
		isset($object['workCompany'])	?	$this->company 	= $object['workCompany']	:	'';
		isset($object['workStart'])		?	$this->start 	= $object['workStart']		:	'';
		isset($object['workEnd'])		?	$this->end 		= $object['workEnd']		:	'';
	}
	
	function getId() {
		return $this->id;
	}

	function getUser() {
		return $this->user;
	}

	function getTitle() {
		return $this->title;
	}

	function getCompany() {
		return $this->company;
	}

	function getStart() {
		return $this->start;
	}

	function getEnd() {
		return $this->end;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setCompany($company) {
		$this->company = $company;
	}

	function setStart($start) {
		$this->start = $start;
	}

	function setEnd($end) {
		$this->end = $end;
	}
}
?>
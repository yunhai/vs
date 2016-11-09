<?php
class Epro{
	private $id		= NULL;
	private $edu	= NULL;
	private $title 	= NULL;
	private $detail = NULL;
	private $start	= NULL;
	private $end	= NULL;

	

	
	function convertToDB() {
		isset($this->id)       	? ($dbobj['epId'] 	= $this->id) 	: '';
		isset($this->edu)		? ($dbobj['epEdu'] 	= $this->edu) 	: '';
		isset($this->title)  	? ($dbobj['epTitle'] = $this->title) : '';
		isset($this->detail)   	? ($dbobj['epDetail']= $this->detail): '';
		isset($this->start)    	? ($dbobj['epStart'] = $this->start) : '';
		isset($this->end)      	? ($dbobj['epEnd'] 	= $this->end)	: '';
		return $dbobj; 
	}
	
	function convertToObject($object) {
		isset($object['epId'])		? $this->id  	= $object['epId'] 		: '';
		isset($object['epEdu'])		? $this->edu  	= $object['epEdu'] 	: '';
		isset($object['epTitle'])	? $this->title 	= $object['epTitle'] 	: '';
		isset($object['epDetail'])	? $this->detail	= $object['epDetail'] 	: '';
		isset($object['epStart'])	? $this->start	= $object['epStart'] 	: '';
		isset($object['epEnd'])		? $this->end	= $object['epEnd'] 		: '';
	}
	
	public function getId() {
		return $this->id;
	}

	public function getEdu() {
		return $this->edu;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getDetail() {
		return $this->detail;
	}

	public function getStart() {
		return $this->start;
	}

	public function getEnd() {
		return $this->end;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setEdu($edu) {
		$this->edu = $edu;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function setDetail($detail) {
		$this->detail = $detail;
	}

	public function setStart($start) {
		$this->start = $start;
	}

	public function setEnd($end) {
		$this->end = $end;
	}

	
}
?>
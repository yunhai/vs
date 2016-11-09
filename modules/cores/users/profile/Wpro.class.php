<?php
class Wpro{
	private $id		= NULL;
	private $work	= NULL;
	private $title 	= NULL;
	private $detail = NULL;
	private $start	= NULL;
	private $end	= NULL;

	

	
	function convertToDB() {
		isset($this->id)       ? ($dbobj['wpId'] 	= $this->id) 	: '';
		isset($this->work)     ? ($dbobj['wpWork'] 	= $this->work) 	: '';
		isset($this->title)    ? ($dbobj['wpTitle'] = $this->title) : '';
		isset($this->detail)   ? ($dbobj['wpDetail']= $this->detail): '';
		isset($this->start)    ? ($dbobj['wpStart'] = $this->start) : '';
		isset($this->end)      ? ($dbobj['wpEnd'] 	= $this->end)	: '';
		return $dbobj; 
	}
	
	function convertToObject($object) {
		isset($object['wpId'])		? $this->id  	= $object['wpId'] 		: '';
		isset($object['wpWork'])	? $this->work  	= $object['wpWork'] 	: '';
		isset($object['wpTitle'])	? $this->title 	= $object['wpTitle'] 	: '';
		isset($object['wpDetail'])	? $this->detail	= $object['wpDetail'] 	: '';
		isset($object['wpStart'])	? $this->start	= $object['wpStart'] 	: '';
		isset($object['wpEnd'])		? $this->end	= $object['wpEnd'] 		: '';
	}
	public function getId() {
		return $this->id;
	}

	public function getWork() {
		return $this->work;
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

	public function setWork($work) {
		$this->work = $work;
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
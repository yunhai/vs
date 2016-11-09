<?php
class GDetail{
	private $id		= NULL;
	private $gallery= NULl;
	private $file	= NULL;
	private $index	= NULL;
	private $status	= NULL;
	private $time	= NULL;
	
	
	
	function convertToDB() {
		$dbobj = array();
		isset($this->id)		? ($dbobj['gdId'] 		= $this->id) 		: '';
		isset($this->gallery)	? ($dbobj['gdGallery'] 	= $this->gallery) 	: '';
		isset($this->file)		? ($dbobj['gdFile'] 	= $this->file) 		: '';
		isset($this->index)		? ($dbobj['gdIndex'] 	= $this->index) 	: '';
		isset($this->status)	? ($dbobj['gdStatus'] 	= $this->status) 	: '';
		isset($this->time)		? ($dbobj['gdTime'] 	= $this->time) 		: '';
		
		return $dbobj;
	}
	
	function convertToObject($object = array()) {
		isset($object['gdId'])		? ($this->id 		= $object['gdId'])			:	'';
		isset($object['gdGallery'])	? ($this->gallery	= $object['gdGallery'])		:	'';
		isset($object['gdFile'])	? ($this->file		= $object['gdFile'])		:	'';
		isset($object['gdIndex'])	? ($this->index		= $object['gdIndex'])		:	'';
		isset($object['gdStatus'])	? ($this->status	= $object['gdStatus'])		:	'';
		isset($object['gdTime'])	? ($this->time 		= $object['gdTime'])		:	'';
	}
	
	function getId() {
		return $this->id;
	}

	function getGallery() {
		return $this->gallery;
	}

	function getFile() {
		return $this->file;
	}

	function getIndex() {
		return $this->index;
	}

	function getStatus() {
		return $this->status;
	}

	function getTime() {
		return $this->time;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setGallery($gallery) {
		$this->gallery = $gallery;
	}

	function setFile($file) {
		$this->file = $file;
	}

	function setIndex($index) {
		$this->index = $index;
	}

	function setStatus($status) {
		$this->status = $status;
	}

	function setTime($time) {
		$this->time = $time;
	}
}
<?php
class Gallery{
	private $id		= NULL;
	private $obj	= NULl;
	private $objCat	= NULL;
	private $index	= NULL;
	private $status	= NULL;
	private $time	= NULL;
	private $code	= NULL;
	private $image	= NULL;
	
	
	
	function convertToDB() {
		$dbobj = array();
		isset($this->id)		? ($dbobj['galleryId'] 		= $this->id) 		: '';
		isset($this->obj)		? ($dbobj['galleryObj'] 	= $this->obj) 		: '';
		isset($this->objCat)	? ($dbobj['galleryObjCat'] 	= $this->objCat) 	: '';
		isset($this->index)		? ($dbobj['galleryIndex'] 	= $this->index) 	: '';
		isset($this->status)	? ($dbobj['galleryStatus'] 	= $this->status) 	: '';
		isset($this->time)		? ($dbobj['galleryTime'] 	= $this->time) 		: '';
		isset($this->code)		? ($dbobj['galleryCode'] 	= $this->code) 		: '';
		isset($this->image)		? ($dbobj['galleryImage'] 	= $this->image) 	: '';
		
		return $dbobj;
	}
	
	function convertToObject($object = array()) {
		isset($object['galleryId'])		? ($this->id 		= $object['galleryId'])			:	'';
		isset($object['galleryObj'])	? ($this->obj		= $object['galleryObj'])		:	'';
		isset($object['galleryObjCat'])	? ($this->objCat	= $object['galleryObjCat'])		:	'';
		isset($object['galleryIndex'])	? ($this->index		= $object['galleryIndex'])		:	'';
		isset($object['galleryStatus'])	? ($this->status	= $object['galleryStatus'])		:	'';
		isset($object['galleryTime'])	? ($this->time 		= $object['galleryTime'])		:	'';
		isset($object['galleryCode'])	? ($this->code 		= $object['galleryCode'])		:	'';
		isset($object['galleryImage'])	? ($this->image		= $object['galleryImage'])		:	'';
	}
	
	function getId() {
		return $this->id;
	}

	function getObj() {
		return $this->obj;
	}

	function getObjCat() {
		return $this->objCat;
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

	function getCode() {
		return $this->code;
	}

	function getImage() {
		return $this->image;
	}


	function setId($id) {
		$this->id = $id;
	}

	function setObj($obj) {
		$this->obj = $obj;
	}

	function setObjCat($objCat) {
		$this->objCat = $objCat;
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

	function setCode($code) {
		$this->code = $code;
	}

	function setImage($image) {
		$this->image = $image;
	}

}
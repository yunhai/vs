<?php
class GInfo{
	
	private $id		= NULL;
	private $gallery = NULL;
	private $title	= NULL;
	private $content= NULL;
	
	
	
	function convertToDB() {
		$dbobj = array();
		isset($this->id)		? ($dbobj['giId'] 		= $this->id) 		: '';
		isset($this->gallery)	? ($dbobj['giGallery'] 	= $this->gallery) 	: '';
		isset($this->title)		? ($dbobj['giTitle'] 	= $this->title) 	: '';
		isset($this->content)	? ($dbobj['giContent'] 	= $this->content) 	: '';
		
		return $dbobj;
	}
	
	function convertToObject($object = array()) {
		isset($object['giId'])		? ($this->id 		= $object['giId'])			:	'';
		isset($object['giGallery'])	? ($this->obj		= $object['giGallery'])		:	'';
		isset($object['giTitle'])	? ($this->title 	= $object['giTitle'])		:	'';
		isset($object['giContent'])	? ($this->content 	= $object['giContent'])		:	'';
	}
	
	function getId() {
		return $this->id;
	}

	function getGallery() {
		return $this->gallery;
	}

	function getTitle() {
		return $this->title;
	}

	function getContent() {
		return $this->content;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setGallery($gallery) {
		$this->gallery = $gallery;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setContent($content) {
		$this->content = $content;
	}

	
}
<?php
class Search{

	private $id			= NULL;
	private $module		= NULL;
	private $obj		= NULL;
	private $url		= NULL;
	private $title		= NULL;
	private $intro		= NULL;
	private $content	= NULL;
	private $otitle		= NULL;
	private $ointro		= NULL;
	
	function convertToDB() {
		isset($this->id)        	? ($dbobj['searchId']	 	= $this->id) 		: '';
		isset($this->module)        ? ($dbobj['searchModule']	= $this->module) 	: '';
		isset($this->obj)        	? ($dbobj['searchObj'] 		= $this->obj) 		: '';
		isset($this->url)			? ($dbobj['searchUrl'] 		= $this->url) 		: '';
		isset($this->title)			? ($dbobj['searchTitle'] 	= $this->title) 	: '';
		isset($this->intro)			? ($dbobj['searchIntro'] 	= $this->intro) 	: '';
		isset($this->content)		? ($dbobj['searchContent'] 	= $this->content) 	: '';
		isset($this->otitle)		? ($dbobj['searchOTitle'] 	= $this->otitle) 	: '';
		isset($this->ointro)		? ($dbobj['searchOIntro'] 	= $this->ointro) 	: '';
		return $dbobj; 
	}
	
	function convertToObject($object) {
		isset($object['searchId'])			?	($this->id = $object['searchId'])			:	'';
		isset($object['searchModule'])		?	($this->module = $object['searchModule'])	:	'';
		isset($object['searchObj'])			?	($this->obj = $object['searchObj'])			:	'';
		isset($object['searchUrl'])			?	($this->url = $object['searchUrl'])			:	'';
		isset($object['searchTitle'])		?	($this->title = $object['searchTitle'])		:	'';
		isset($object['searchIntro'])		?	($this->intro = $object['searchIntro'])		:	'';
		isset($object['searchContent'])		?	($this->content = $object['searchContent'])	:	'';
		isset($object['searchOTitle'])		?	($this->otitle = $object['searchOTitle'])	:	'';
		isset($object['searchOIntro'])		?	($this->ointro = $object['searchOIntro'])	:	'';
	}
	function getId() {
		return $this->id;
	}

	function getModule() {
		return $this->module;
	}

	function getObj() {
		return $this->obj;
	}

	function getUrl() {
		return $this->url;
	}

	function getTitle() {
		return $this->title;
	}

	function getIntro() {
		return $this->intro;
	}

	function getContent() {
		return $this->content;
	}

	function getOtitle() {
		return $this->otitle;
	}

	function getOintro() {
		return $this->ointro;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setModule($module) {
		$this->module = $module;
	}

	function setObj($obj) {
		$this->obj = $obj;
	}

	function setUrl($url) {
		$this->url = $url;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setIntro($intro) {
		$this->intro = $intro;
	}

	function setContent($content) {
		$this->content = $content;
	}

	function setOtitle($otitle) {
		$this->otitle = $otitle;
	}

	function setOintro($ointro) {
		$this->ointro = $ointro;
	}
}
?>
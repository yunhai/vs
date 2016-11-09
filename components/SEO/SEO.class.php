<?php
class SEO extends BasicObject{

	private $aliasUrl 	= NULL;
	private $realUrl 	= NULL;
	private $keyword 	= NULL;
	private $obj		= NULL;
	private $module		= NULL;
	
	public $title 	= NULL;
	public $type 	= NULL;
	

	function __construct() {
		parent::__construct();
	}

	function __destruct() {
		parent::__destruct();
		unset($this->aliasUrl);
		unset($this->realUrl);
		unset($this->keyword);

	}

	function convertToDB() {
		isset($this->id)        	? ($dbobj['seoId'] 				= $this->id) 		: '';
		isset($this->aliasUrl)      ? ($dbobj['seoAliasUrl'] 		= $this->aliasUrl) 	: '';
		isset($this->realUrl)       ? ($dbobj['seoRealUrl'] 		= $this->realUrl) 	: '';
		isset($this->keyword)       ? ($dbobj['seoKeyword'] 		= $this->keyword) 	: '';
		isset($this->intro)        	? ($dbobj['seoIntro'] 			= $this->intro) 	: '';
		isset($this->title)        	? ($dbobj['seoTitle'] 			= $this->title) 	: '';
		isset($this->type)        	? ($dbobj['seoType'] 			= $this->type) 		: '';
		isset($this->obj)        	? ($dbobj['seoObj'] 			= $this->obj) 		: '';
		isset($this->module)        ? ($dbobj['seoModule'] 			= $this->module) 	: '';
		return $dbobj;
	}

	function convertToObject($object) {
		global $vsMenu;
		isset ( $object ['seoId'] ) 		? $this->setId ( $object ['seoId'] ) 			: '';
		isset ( $object ['seoAliasUrl'] ) 	? $this->setAliasUrl($object['seoAliasUrl'])	: '';
		isset ( $object ['seoRealUrl'] ) 	? $this->setRealUrl( $object ['seoRealUrl'] )	: '';
		isset ( $object ['seoKeyword'] ) 	? $this->setKeyword ( $object ['seoKeyword'] ) 	: '';
		isset ( $object ['seoIntro'] ) 		? $this->setIntro( $object ['seoIntro'] ) 		: '';
		isset ( $object ['seoTitle'] ) 		? $this->setTitle( $object ['seoTitle'] ) 		: '';
		isset ( $object ['seoType'] ) 		? $this->setType( $object ['seoType'] ) 		: '';
		isset ( $object ['seoObj'] ) 		? $this->setObj( $object ['seoObj'] ) 			: '';
		isset ( $object ['seoModule'] ) 	? $this->setModule( $object ['seoModule'] ) 	: '';
	}
	
	function getAliasUrl() {
		return $this->aliasUrl;
	}
	

	function getRealUrl() {
		return $this->realUrl;
	}
	

	function getKeyword() {
		return $this->keyword;
	}
	

	function getObj() {
		return $this->obj;
	}
	

	function getModule() {
		return $this->module;
	}
	

	function getTitle() {
		return $this->title;
	}
	

	function getType() {
		return $this->type;
	}
	

	function setAliasUrl($aliasUrl) {
		$this->aliasUrl = $aliasUrl;
	}
	

	function setRealUrl($realUrl) {
		$this->realUrl = $realUrl;
	}
	

	function setKeyword($keyword) {
		$this->keyword = $keyword;
	}
	

	function setObj($obj) {
		$this->obj = $obj;
	}
	

	function setModule($module) {
		$this->module = $module;
	}
	

	function setTitle($title) {
		$this->title = $title;
	}
	

	function setType($type) {
		$this->type = $type;
	}

}
?>
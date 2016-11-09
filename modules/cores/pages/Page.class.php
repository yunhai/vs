<?php
	class Page extends BasicObject{
        protected $code         = NULL;
        protected $image		= NULL;
        
		function __construct(){
			parent::__construct();
	    }
	    function __destruct(){
	    	parent::__destruct();
	    	
	    }
        function convertToDB(){
        	$tableName = page;
			isset ( $this->catId )      ? ($dbobj ["{$tableName}CatId"] 	= $this->getCatId())	: "";
			isset ( $this->id )         ? ($dbobj ["{$tableName}Id"] 		= $this->id) 			: "";
			isset ( $this->title )      ? ($dbobj ["{$tableName}Title"]		= $this->title) 		: "";
			isset ( $this->intro )      ? ($dbobj ["{$tableName}Intro"] 	= $this->intro) 		: "";
			isset ( $this->image )      ? ($dbobj ["{$tableName}Image"] 	= $this->image) 		: "";
			isset ( $this->content )    ? ($dbobj ["{$tableName}Content"] 	= $this->content) 		: "";
			isset ( $this->index )      ? ($dbobj ["{$tableName}Index"] 	= $this->index) 		: "";
			isset ( $this->status )     ? ($dbobj ["{$tableName}Status"] 	= $this->status) 		: "";
			isset ( $this->code )       ? ($dbobj ["{$tableName}Code"]     	= $this->code) 			: "";
			
			
			isset ( $this->postdate )	? ($dbobj ["pagePostDate"] 			= $this->postdate) 		: "";
			return $dbobj;
		}
		
		function convertToObject($object) {
			global $vsFile,$DB;
			$tableName = page;
			
			isset ( $object ["{$tableName}Id"] )      	? $this->setId ( $object ["{$tableName}Id"] )           : "";
			isset ( $object ["{$tableName}CatId"] )   	? $this->setCatId ( $object ["{$tableName}CatId"] )     : "";
			isset ( $object ["{$tableName}CatId"] )   	? $this->setCategory ( $object ["{$tableName}CatId"] )  : "";
			isset ( $object ["{$tableName}Title"] )   	? $this->setTitle ( $object ["{$tableName}Title"] )     : "";
			isset ( $object ["{$tableName}Intro"] )   	? $this->setIntro ( $object ["{$tableName}Intro"] )     : "";
			isset ( $object ["{$tableName}Index"] )   	? $this->setIndex ( $object ["{$tableName}Index"] )     : "";
			isset ( $object ["{$tableName}Image"] )   	? $this->setImage ( $object ["{$tableName}Image"] )     : "";
			isset ( $object ["{$tableName}Content"]) 	? $this->setContent ( $object ["{$tableName}Content"] ) : "";
			isset ( $object ["{$tableName}Status"])  	? $this->setStatus ( $object ["{$tableName}Status"] )   : "";
			isset ( $object ["{$tableName}Code"])    	? $this->setCode( $object ["{$tableName}Code"] )       : "";
			isset ( $object ["{$tableName}PostDate"] )  ? $this->setPostDate($object ["{$tableName}PostDate"])  : "";
			isset ( $object ["{$tableName}MtTitle"] )  	? $this->mtTitle   	= $object ["{$tableName}MtTitle"]	: "";
			isset ( $object ["{$tableName}MtKeyWord"] )	? $this->mtKeyWord 	= $object ["{$tableName}MtKeyWord"]	: "";
			isset ( $object ["{$tableName}MtDesc"] )   	? $this->mtDesc    	= $object ["{$tableName}MtDesc"]		: "";
			isset ( $object ["{$tableName}MtUrl"] )   	? $this->mtUrl   	= $object ["{$tableName}MtUrl"]      	: "";
		}
		
		function validate() {
			$status = true;
			if ($this->title == "") {
				$this->message .= " title can not be blank!";
				$status = false;
			}
			return $status;
		}
		function getCode() {
			return $this->code;
		}

		function getImage() {
			return $this->image;
		}

		function setCode($code) {
			$this->code = $code;
		}

		function setImage($image) {
			$this->image = $image;
		}
	}
?>
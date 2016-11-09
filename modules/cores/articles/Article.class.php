<?php
	class Article extends BasicObject{
		private $code	= NULL;
		private $image	= NULL;
        private $time	= NULL;
        
        function convertToDB(){
			isset ( $this->catId )      ? ($dbobj ["articleCatId"] 	= $this->getCatId())	: "";
			isset ( $this->id )         ? ($dbobj ["articleId"] 	= $this->id) 			: "";
			isset ( $this->title )      ? ($dbobj ["articleTitle"]	= $this->title) 		: "";
			isset ( $this->intro )      ? ($dbobj ["articleIntro"] 	= $this->intro) 		: "";
			isset ( $this->image )      ? ($dbobj ["articleImage"] 	= $this->image) 		: "";
			isset ( $this->content )    ? ($dbobj ["articleContent"]= $this->content) 		: "";
			isset ( $this->index )      ? ($dbobj ["articleIndex"] 	= $this->index) 		: "";
			isset ( $this->status )     ? ($dbobj ["articleStatus"] = $this->status) 		: "";
			isset ( $this->code )       ? ($dbobj ["articleCode"]   = $this->code) 			: "";
			isset ( $this->postdate )	? ($dbobj ["articlePostDate"] = $this->postdate) 		: "";
			isset ( $this->time )		? ($dbobj ["articleTime"] 	= $this->time) 			: "";
			return $dbobj;
		}
		
		function convertToObject($object) {
			isset ( $object ["articleId"] )      	? $this->id 		= $object ["articleId"]			: "";
			isset ( $object ["articleCatId"] )   	? $this->catId 		= $object ["articleCatId"]      : "";
			
			isset ( $object ["articleTitle"] )   	? $this->title 		= $object ["articleTitle"]      : "";
			isset ( $object ["articleIntro"] )   	? $this->intro 		= $object ["articleIntro"]      : "";
			isset ( $object ["articleIndex"] )   	? $this->index 		= $object ["articleIndex"]      : "";
			isset ( $object ["articleImage"] )   	? $this->image 		= $object ["articleImage"]      : "";
			isset ( $object ["articleContent"]) 	? $this->content 	= $object ["articleContent"] 	: "";
			isset ( $object ["articleStatus"])  	? $this->status 	= $object ["articleStatus"]    	: "";
			isset ( $object ["articleCode"])    	? $this->code 		= $object ["articleCode"]       : "";
			isset ( $object ["articlePostDate"] )  	? $this->postdate 	= $object ["articlePostDate"]  	: "";
			isset ( $object ["articleTime"] )   	? $this->time   	= $object ["articleTime"]      	: "";
			
			isset ( $object ["articleCatId"] )   	? $this->category = $object ["articleCatId"]   		: "";
		}
		
		function validate() {
			$status = true;
			if ($this->title == "") {
				$this->message .= " title can not be blank!";
				$status = false;
			}
			return $status;
		}
	
		function __construct(){
			parent::__construct();
	    }
	    function __destruct(){
	    	parent::__destruct();
	    }
	    
		function getCode() {
			return $this->code;
		}

		function getImage() {
			return $this->image;
		}

		function getTime($format='', $standard=false){
			if(!$this->time) return $this->time;
			if($format){
				$datetime= new VSFDateTime();
				return $datetime->getDate($this->time, $format, $standard);
			}
			return $this->time;
		}

		function setCode($code) {
			$this->code = $code;
		}

		function setImage($image) {
			$this->image = $image;
		}

		function setTime($time) {
			$this->time = $time;
		}
	}
?>
<?php
class Icmarket extends BasicObject{


	private $user		= NULL;
	private $condition	= NULL;
	private $price		= NULL;
	private $campus		= NULL;	
	private $location	= NULL;
	private $gallery	= NULL;
	private $time		= NULL;
	

	
	function convertToDB() {
		isset($this->id)        	? ($dbobj['cfId']	 		= $this->id) 		: '';
		isset($this->catId)        	? ($dbobj['cfCatId']	 	= $this->catId) 	: '';
		isset($this->user)        	? ($dbobj['cfUser'] 		= $this->user) 		: '';
		isset($this->title)			? ($dbobj['cfTitle'] 		= $this->title) 	: '';
		isset($this->content)		? ($dbobj['cfContent'] 		= $this->content) 	: '';
		isset($this->condition)		? ($dbobj['cfCondition'] 	= $this->condition) : '';
		isset($this->price)        	? ($dbobj['cfPrice'] 		= $this->price) 	: '';
		isset($this->campus)		? ($dbobj['cfCampus'] 		= $this->campus) 	: '';
		isset($this->location)		? ($dbobj['cfLocation'] 	= $this->location) 	: '';
		isset($this->gallery)		? ($dbobj['cfGallery'] 		= $this->gallery) 	: '';
		isset($this->time)			? ($dbobj['cfTime'] 		= $this->time) 	: '';
		
		return $dbobj; 
	}
	
	function convertToObject($object) {
		isset($object['cfId'])			?	($this->id = $object['cfId'])			:	'';
		isset($object['cfCatId'])		?	($this->catId = $object['cfCatId'])	:	'';
		isset($object['cfUser'])		?	($this->user = $object['cfUser'])			:	'';
		isset($object['cfTitle'])		?	($this->title = $object['cfTitle'])			:	'';
		isset($object['cfContent'])		?	($this->content = $object['cfContent'])	:	'';
		isset($object['cfCondition'])	?	($this->condition = $object['cfCondition'])	:	'';
		isset($object['cfPrice'])		?	($this->price = $object['cfPrice'])			:	'';
		isset($object['cfCampus'])		?	($this->campus = $object['cfCampus'])		:	'';
		isset($object['cfLocation'])	?	($this->location = $object['cfLocation'])	:	'';
		isset($object['cfGallery'])		?	($this->gallery = $object['cfGallery'])		:	'';
		isset($object['cfTime'])		?	($this->time = $object['cfTime'])			:	'';
	}
	function getUser() {
		return $this->user;
	}

	function getCondition() {
		return $this->condition;
	}

	function getPrice($format = false) {
		if($format) return number_format($this->price, 2, ".", ", ");
		return $this->price;
	}

	function getCampus() {
		return $this->campus;
	}

	function getLocation() {
		return $this->location;
	}

	function getGallery() {
		return $this->gallery;
	}

	function getTime($format=NULL, $standard=false){
		if($format) {
			if($format == 'real'){
				$cyear = date(Y);
				$year = date("Y", $this->time);
				if($year < $cyear)
					return date("M d, Y", $this->time);
				
				$ago = time() - $this->time;
			
				if($ago<59){
					$str = (int)($ago);
					return strval($str)." secs ago";
				}
				
				$minute = 60*60;
				if($ago < $minute){
					$str = (int)($ago/60);
					return strval($str)." mins ago";
				}
				
				$hour = $minute*24;
				if($ago < $hour){
					$str = (int)($ago/($minute));
					return strval($str)." hours ago";
				}
				
				return date("M. d", $this->time);
			}
			$datetime= new VSFDateTime();
			return $datetime->getDate($this->time, $format, $standard);
		}
		
		return $this->time;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setCondition($condition) {
		$this->condition = $condition;
	}

	function setPrice($price) {
		$this->price = $price;
	}

	function setCampus($campus) {
		$this->campus = $campus;
	}

	function setLocation($location) {
		$this->location = $location;
	}

	function setGallery($gallery) {
		$this->gallery = $gallery;
	}

	function setTime($time) {
		$this->time = $time;
	}
}
?>
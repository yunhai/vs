<?php
class Gd{
	private $id			= NUll;
	private $group		= NULL;
	private $friend 	= NULL;
	
	
	function __destruct() {
	}
	
	
	function convertToObject($object) {
		isset ( $object ['gdId'] ) 			? ($this->id 	= $object['gdId']) 			: '';
		isset ( $object ['gdGroup'] ) 		? ($this->group = $object['gdGroup']) 		: '';
		isset ( $object ['groupTitle'] ) 	? ($this->title = $object['groupTitle']) 	: '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['gdId'] 			= $this->id) 		: '';
		isset ($this->user)		? ($dbobj ['gdGroup'] 		= $this->user) 		: '';
		isset ($this->title) 	? ($dbobj ['groupTitle']	= $this->title) 	: '';
		return $dbobj;
	}
	
}
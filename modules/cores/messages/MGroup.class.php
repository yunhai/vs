<?php
class MGroup extends BasicObject{
	public $message = "";
	
	
	function __destruct() {
		parent::__destruct();
	}
	
	
	function convertToObject($object) {
		isset ( $object ['groupId'] ) 	? ($this->id = $object['groupId']) 			: '';
		isset ( $object ['groupTitle'] )? ($this->title = $object['groupTitle']) 	: '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['groupId'] 		= $this->id) 		: '';
		isset ($this->title) 	? ($dbobj ['groupTitle'] 	= $this->title) 	: '';
		
		return $dbobj;
	}
}
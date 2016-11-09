<?php
class Labelm extends BasicObject{
	private $label		= NULL;
	private $message 	= NULL;
	private $type		= NULL;
	
	
	function __destruct() {
		parent::__destruct();
		unset($this->label);
		unset($this->message);
		unset($this->type);
	}
	
	
	function convertToObject($object) {
		isset ( $object ['lmId'] ) 	? ($this->id = $object['lmId']) 			: '';
		isset ( $object ['lmLabel'] )? ($this->label = $object['lmLabel']) 	: '';
		isset ( $object ['lmMessage']) 	? ($this->message = $object['lmMessage']) 			: '';
		isset ( $object ['lmType'])? ($this->type = $object['lmType']) 	: '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['lmId'] 		= $this->id) 		: '';
		isset ($this->label) 	? ($dbobj ['lmLabel'] 	= $this->label) 	: '';
		isset ($this->message) 	? ($dbobj ['lmMessage'] = $this->message) 	: '';
		isset ($this->type) 	? ($dbobj ['lmType'] 	= $this->type) 		: '';
		return $dbobj;
	}
	
	function getLabel() {
		return $this->label;
	}

	function getMessage() {
		return $this->message;
	}

	function getType() {
		return $this->type;
	}

	function setLabel($label) {
		$this->label = $label;
	}

	function setMessage($message) {
		$this->message = $message;
	}

	function setType($type) {
		$this->type = $type;
	}

}
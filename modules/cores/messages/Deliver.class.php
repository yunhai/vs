<?php
class Deliver extends BasicObject{
	private $message	= NULL;
	private $recipient	= NULL;
	
	
	function __destruct() {
		parent::__destruct();
		//status: 0: trash, 1: read, 2: unread
		unset($this->message);
		unset($this->recipient);
	}
	
	function convertToObject($object) {
		isset ( $object ['deliverId'] ) 		? $this->id 		= $object['deliverId'] 			: '';
		isset ( $object ['deliverMessage'] ) 	? $this->message 	= $object['deliverMessage'] 	: '';
		isset ( $object ['deliverRecipient'] ) 	? $this->recipient 	= $object['deliverRecipient'] 	: '';
		isset ( $object ['deliverStatus'] ) 	? $this->status 	= $object['deliverStatus'] 		: $this->status = 1;
		isset ( $object ['deliverPostdate'] ) 	? $this->postdate 	= $object['deliverPostdate'] 	: '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['deliverId'] 		= $this->id) 		: '';
		isset ( $this->message) 	? ($dbobj ['deliverMessage'] 	= $this->message) 	: '';
		isset ( $this->recipient) 	? ($dbobj ['deliverRecipient'] 	= $this->recipient) : '';
		isset ( $this->status) 		? ($dbobj ['deliverStatus'] 	= $this->status) 	: '';
		isset ( $this->postdate)	? ($dbobj ['deliverPostdate'] 	= $this->postdate) 	: '';
		
		return $dbobj;
	}
	
	function getMessage() {
		return $this->message;
	}

	function setMessage($message) {
		$this->message = $message;
	}
	
	function getRecipient() {
		return $this->recipient;
	}

	function setRecipient($recipient) {
		$this->recipient = $recipient;
	}
}
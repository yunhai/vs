<?php
class Group{
	private $id			= NUll;
	private $user		= NULL;
	private $title		= NULL;
	private $index		= NULL;
	
	
	function __destruct() {
	}
	
	
	function convertToObject($object) {
		isset ( $object ['groupId'] ) 		? ($this->id 	= $object['groupId']) 		: '';
		isset ( $object ['groupUser'] ) 	? ($this->user 	= $object['groupUser']) 	: '';
		isset ( $object ['groupTitle'] ) 	? ($this->title = $object['groupTitle']) 	: '';
		isset ( $object ['groupIndex'] ) 	? ($this->index = $object['groupIndex']) 	: '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['groupId'] 		= $this->id) 		: '';
		isset ($this->user) 	? ($dbobj ['groupUser'] 	= $this->user) 		: '';
		isset ($this->title) 	? ($dbobj ['groupTitle'] 	= $this->title) 		: '';
		isset ($this->index) 	? ($dbobj ['groupIndex'] 	= $this->index) 		: '';
		return $dbobj;
	}
	
	function getId() {
		return $this->id;
	}

	function getUser() {
		return $this->user;
	}

	function getTitle() {
		return $this->title;
	}


	function getIndex() {
		return $this->index;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setIndex($index) {
		$this->index = $index;
	}
}
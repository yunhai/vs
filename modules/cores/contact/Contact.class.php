<?php

class Contact extends BasicObject{

	private $email 		= NULL;
	private $isReply 	= NULL;
	private $name  		= NULL;
	private $type		= NULL;
	private $user		= NULL;

	function convertToDB() {
		isset ( $this->id ) 			? ($dbobj ['contactId'] 			= $this->id) 				: '';//id
		isset ( $this->name ) 			? ($dbobj ['contactName'] 			= $this->name) 				: '';//name
		isset ( $this->profile ) 		? ($dbobj ['contactProfile'] 		= $this->profile) 			: '';//profile
		
		isset ( $this->email ) 			? ($dbobj ['contactEmail'] 			= $this->email) 			: '';//email
		isset ( $this->title ) 			? ($dbobj ['contactTitle'] 			= $this->title) 			: '';//title
		isset ( $this->content ) 		? ($dbobj ['contactContent'] 		= $this->content) 			: '';//message
		
		isset ( $this->type ) 			? ($dbobj ['contactType'] 			= $this->type) 				: '';//type
		isset ( $this->status ) 		? ($dbobj ['contactStatus'] 		= $this->status) 			: '';//status
		
		
		isset ( $this->postdate ) 		? ($dbobj ['contactPostDate'] 		= $this->postdate) 			: '';//postdate
		isset ( $this->isReply ) 		? ($dbobj ['contactIsReply'] 		= $this->isReply) 			: '';//reply
		isset ( $this->user ) 			? ($dbobj ['contactUser'] 			= $this->user) 			: '';//reply
		
		return $dbobj;
	}

	function convertToObject($object) {
		global $vsMenu;
		isset ( $object ['contactId'] ) 		? $this->setId ( $object ['contactId'] ) 				: '';
		isset ( $object ['contactTitle'] ) 		? $this->setTitle ( $object ['contactTitle'] ) 			: '';
		isset ( $object ['contactType'] ) 		? $this->setType ( $object ['contactType'] ) 			: '';
		isset ( $object ['contactContent'] ) 	? $this->setContent ( $object ['contactContent'] ) 		: '';
		isset ( $object ['contactEmail'] ) 		? $this->setEmail ( $object ['contactEmail'] ) 			: '';
		isset ( $object ['contactStatus'] ) 	? $this->setStatus ( $object ['contactStatus'] ) 		: '';
		isset ( $object ['contactPostDate'] ) 	? $this->setPostDate ( $object ['contactPostDate'] ) 	: '';
		isset ( $object ['contactIsReply'] ) 	? $this->setIsReply ( $object ['contactIsReply'] ) 		: '';
		isset ( $object ['contactName'] ) 		? $this->setName ( $object ['contactName'] ) 			: '';
		isset ( $object ['contactUser'] ) 		? $this->setUser ( $object ['contactUser'] ) 			: '';
	}

	function __construct(){
		parent::__construct();
	}
	
	function validate(){
		global $vsLang, $vsSettings;
              
		$this->result ['status'] = true;
		$this->result ['message'] = "";
		
		if($this->getName() == ""){
			$this->result['status'] = false;
			$this->result['message'] .= $vsLang->getWords("contacts_ErrorNameEmpty","* Name cannot be blank!");
		}
		
		return $this->result['status'];
	}
	
	function __destruct() {
		parent::__destruct ();
		unset ( $this->profile );
		unset ( $this->email );
		unset ( $this->isReply );
		unset ( $this->address );
		unset ( $this->phone );
		unset ( $this->name );
		unset ( $this->type );
	}
	function getEmail() {
		return $this->email;
	}

	function getIsReply() {
		return $this->isReply;
	}

	function getName() {
		return $this->name;
	}

	function getType() {
		return $this->type;
	}

	function getUser() {
		return $this->user;
	}

	function setEmail($email) {
		$this->email = $email;
	}

	function setIsReply($isReply) {
		$this->isReply = $isReply;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setType($type) {
		$this->type = $type;
	}

	function setUser($user) {
		$this->user = $user;
	}

}
?>
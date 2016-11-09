<?php
class Module extends BasicObject{
	public function convertToDB() {
		isset ( $this->id ) 		? ($dbobj ['moduleId'] 			= $this->id) 			: '';
		isset ( $this->title ) 		? ($dbobj ['moduleTitle'] 		= $this->title) 		: '';
		isset ( $this->class ) 		? ($dbobj ['moduleClass'] 		= trim($this->class)) 	: '';
		isset ( $this->admin ) 		? ($dbobj ['moduleIsAdmin'] 	= $this->admin) 		: '';
		isset ( $this->user ) 		? ($dbobj ['moduleIsUser'] 		= $this->user) 			: '';
		isset ( $this->intro )		? ($dbobj ['moduleIntro'] 		= $this->intro) 		: '';
		isset ( $this->virtual )	? ($dbobj ['moduleVirtual'] 	= $this->virtual) 		: '';
		isset ( $this->version ) 	? ($dbobj ['moduleVersion'] 	= str_replace(".","",$this->version)) 	: '';
		isset ( $this->parent )     ? ($dbobj ['moduleParent']    = $this->parent) 		: '';
		return $dbobj;
	}
	
	function convertToObject($object) {
		global $vsMenu;
		isset ( $object ['moduleId'] ) 		? $this->setId 		( $object ['moduleId'] ) 		: '';
		isset ( $object ['moduleTitle'] ) 	? $this->setTitle 	( $object ['moduleTitle'] ) 	: '';
		isset ( $object ['moduleClass'] ) 	? $this->setClass 	( $object ['moduleClass'] ) 	: '';
		isset ( $object ['moduleIsAdmin'] ) ? $this->setAdmin 	( $object ['moduleIsAdmin'] ) 	: '';
		isset ( $object ['moduleIsUser'] ) 	? $this->setUser 	( $object ['moduleIsUser'] ) 	: '';
		isset ( $object ['moduleIntro'] )	? $this->setIntro 	( $object ['moduleIntro'] ) 	: '';
		isset ( $object ['moduleVirtual'] )	? $this->setVirtual ( $object ['moduleVirtual'] ) 	: '';
		isset ( $object ['moduleParent'] )	? $this->setParent ( $object ['moduleParent'] ) 	: '';
		isset ( $object ['moduleVersion'] ) ? $this->setVersion ( intval($object['moduleVersion'][0]).".".intval($object['moduleVersion'][1]).".".intval($object['moduleVersion'][2]).".".intval($object['moduleVersion'][3]) ) : $this->setVersion (0);
	}
	function validate() {
		global $DB, $vsLang;

		$status = true;
		$this->message = "";
		if($this->getTitle() == "") {
			$status = false;
			$this->message .= $vsLang->getWords('err_module_name_blank',"Module name can't be left blank!<br>");
		}
		if($this->getClass() == "") {
			$status = false;
			$this->message .= $vsLang->getWords('err_module_action_blank',"Module action can't be left blank!<br>");
		}
		return $status;
	}
	private $class 			= NULL;
	private $admin 			= NULL;
	private $user 			= NULL;
	private $version 		= NULL;
	private $installed 		= NULL;
	private $virtual 		= NULL;
	private $parent			= NULL;

	public function getVirtual() {
		return $this->virtual;
	}

	public function setVirtual($virtual) {
		$this->virtual = $virtual;
	}

	function __construct(){
		parent::__construct();
	}


	function __destruct(){
		unset($this->class);
		unset($this->admin);
		unset($this->user);
		unset($this->version);
	}

	public function getInstalled() {
		return $this->installed;
	}

	public function setInstalled($installed=-1) {
		$this->installed = $installed;
	}

	public function getAdmin() {
		return $this->admin;
	}

	public function getClass() {
		return $this->class;
	}

	public function getUser() {
		return $this->user;
	}

	public function getVersion() {
		return $this->version;
	}


	public function setVersion($version = "") {
		$this->version = $version;
	}

	public function setAdmin($admin) {
		$this->admin = $admin;
	}

	public function setClass($class) {
		$this->class = strtolower($class);
	}

	public function setUser($user) {
		$this->user = $user;
	}
	public function getParent() {
		return $this->parent;
	}

	public function setParent($parent) {
		$this->parent = $parent;
	}

}
?>
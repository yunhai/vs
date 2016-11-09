<?php
class User extends BasicObject{
	private $name 		= NULL;
	private $alias 		= NULL;
	private $fullname	= NULL;
	private $language	= NULL;
	private $timezone	= NULL;
	private $image 		= null;
	private $password 	= null;
	private $arrayinfo 	= null;
	private $lastLogin 	= null;
	private $campusId	= null;
	private $joinDate 	= null;
	private $referral	= NULL;	
	private $email		= NULL;
	
	private $groups = array();

	
	function validate() {
		global $vsLang;
		$status = true;
		if ($this->getName() == "") {
			$this->message .= $vsLang->getWords('err_user_name_blank', "Username can't be left blank!");
			$status = false;
		}

		return $status;
	}

	
	function convertToDB() {
		isset($this->id)        	? ($dbobj['userId'] 		= $this->id) : '';
		isset($this->name)      	? ($dbobj['userName'] 		= $this->name) : '';
		isset($this->alias)      	? ($dbobj['userAlias'] 		= $this->alias) : '';
		isset($this->fullname)      ? ($dbobj['userFullname'] 	= $this->fullname) : '';
		isset($this->language)      ? ($dbobj['userLanguage'] 	= $this->language) : '';
		isset($this->timezone)      ? ($dbobj['userTimezone'] 	= $this->timezone) : '';
		isset($this->image)       	? ($dbobj['userImage'] 		= $this->image) : '';
		isset($this->arrayinfo)     ? ($dbobj['userInfo'] 		= serialize($this->arrayinfo)) : '';
		isset($this->campusId)      ? ($dbobj['userCampusId'] 	= $this->campusId) : '';
		isset($this->joinDate)      ? ($dbobj['userJoinDate'] 	= $this->joinDate) : '';
		isset($this->lastLogin)     ? ($dbobj['userLastLogin'] 	= $this->lastLogin) : '';
		isset($this->status)      	? ($dbobj['userStatus'] 	= $this->status) : '';
		isset($this->referral)      ? ($dbobj['userReferral'] 	= $this->referral) : '';
		isset($this->email)      ? ($dbobj['userEmail'] 	= $this->email) : '';
		
		if($this->password) $dbobj['userPassword'] = $this->password;
			
		return $dbobj; 
	}
	
	function convertToObject($object) {
		
		isset($object['userId'])		?	$this->id = $object['userId']							:	'';
		isset($object['userName'])		?	$this->name = $object['userName']						:	'';
		isset($object['userAlias'])		?	$this->alias =$object['userAlias']						:	'';
		isset($object['userFullname'])	?	$this->fullname = $object['userFullname']				:	'';
		isset($object['userLanguage'])	?	$this->setLanguage($object['userLanguage'])				:	'';
		isset($object['userTimezone'])	?	$this->setTimezone($object['userTimezone'])				:	'';
		isset($object['userPassword'])	?	$this->password	= $object['userPassword'] 				:	'';
		isset($object['userCampusId'])	?	$this->setCampusId($object['userCampusId'])				:	'';
		isset($object['userImage'])		?	$this->setImage($object['userImage'])					:	'';
		isset($object['userJoinDate'])	?	$this->setJoinDate($object['userJoinDate'])				:	'';
		isset($object['userLastLogin'])	?	$this->setLastLogin($object['userLastLogin'])			:	'';
		isset($object['userStatus'])	?	$this->setStatus($object['userStatus'])					:	'';
		isset($object['userFirstName'])	?	$this->setFirstName($object['userFirstName'])			:	'';
		isset($object['userLastName'])	?	$this->setLastName($object['userLastName'])				:	'';
		isset($object['userInfo'])		?	$this->setArrayInfo(unserialize($object['userInfo']))	:	'';
		isset($object['userReferral'])	?	($this->referral = $object['userReferral'])			:	'';
		
		isset($object['userEmail'])	?	$this->email = $object['userEmail']			:	'';
	}
	
	
	public function setFullname($fullname) {
		$this->fullname = $fullname;
	}
	
	function getFullname(){
		return $this->fullname;
	}

	function addGroup($group) {
		$this->groups[$group->getId()] = $group;
	}

	
	function getGroups() {
		return $this->groups;	
	}

	function getArrayInfo() {
		return $this->arrayinfo;	
	}

	function getName() {
		return $this->name;
	}


	function getPassword() {
		return $this->password;
	}
	
	
	function getRoot(){
		return $this->root;
	}
	
	function getLastLogin($format="") {
		if($format)
			return VSFDateTime::getDate($this->lastLogin,$format);
		return $this->lastLogin;
	}
	
	
	function getJoinDate($format='') {
		if($format)
			return VSFDateTime::getDate($this->joinDate,$format);
		return $this->joinDate;
	}
	
	

	function setGroups($groups=array()) {
		$this->groups = $groups;
	}

	function setArrayInfo($array) {
		$this->arrayinfo = $array;
	}
	function setName($name="") {
		$this->name = strtolower($name);
	}
	function setPassword($password) {
		$this->password = md5($password);
	}
	function setFirstName($firstname) {
		$this->arrayinfo['userFirstName'] = $firstname;
	}
	function setLastName($lastname) {
		$this->arrayinfo['userLastName'] = $lastname;
	}
	function getFirstName(){
		return $this->arrayinfo['userFirstName'];
	}
	function getLastName(){
		return $this->arrayinfo['userLastName'];
	}
	function setLastLogin($lastLogin) {
		$this->lastLogin = $lastLogin;
	}
	function setJoinDate($joinDate) {
		$this->joinDate = $joinDate;
	}

	

	
	function getCampusId() {
		return $this->campusId;
	}

	function setCampusId($campusId) {
		$this->campusId = $campusId;
	}

	function getAlias($full = false){
		if($full){
			if($this->alias) return $this->alias;
			return 'Undisclosed';
		}
		return $this->alias;
	}

	function setAlias($alias) {
		$this->alias = $alias;
	}

	function getImage() {
		return $this->image;
	}

	function setImage($image) {
		$this->image = $image;
	}
	
	function __construct() {
		parent::__construct();
	}
	
	function __destruct() {
		unset($this->name);
		unset($this->password);
		unset($this->address);
		unset($this->email);
		unset($this->alias);
		unset($this->lastLogin);
		unset($this->campusId);
		unset($this->joinDate);
		unset($this->arrayinfo);
		unset($this->groups);
	}
	
	function getLanguage() {
		return $this->language;
	}

	function getLocation() {
		return $this->location;
	}

	function getTimezone() {
		return $this->timezone;
	}

	function setLanguage($language) {
		$this->language = $language;
	}

	function setLocation($location) {
		$this->location = $location;
	}

	function setTimezone($timezone) {
		$this->timezone = $timezone;
	}
	public function getReferral() {
		if(!isset($this->referral)) return 0;
		return $this->referral;
	}

	public function setReferral($referral) {
		$this->referral = $referral;
	}

	
	
	
	function convertRelToDB($group) {
		$dbobj = array(	'userId'	=> $this->id,
						'groupId'	=> $group->getId()
						);
		return $dbobj;
	}
	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

}
?>
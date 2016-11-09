<?php
class Profile{
	private $id			= NULL;
	private $user		= NULL;
	private $birthday 	= NULL;
	private $gender		= NULL;
	private $location 	= NULL;
	private $rs			= NULL; // relationship
	private $intro		= NULL;
	private $language	= NULL;
	private $interest	= NULL;
	private $ga			= NULL;
	private $honor	 	= NULL;
	private $email 		= NULL;
	private $phone 		= NULL;
	private $address 	= NULL;
	private $website 	= NULL;
	private $sn 		= NULL; //screen name
	private $skill		= NULL;
	

	

	
	function convertToDB() {
		isset($this->id)        	? ($dbobj['profileId'] 			= $this->id) 		: '';
		isset($this->user)      	? ($dbobj['profileUser'] 		= $this->user) 		: '';
		isset($this->birthday)      ? ($dbobj['profileBirthday'] 	= $this->birthday) 	: '';
		isset($this->gender)      	? ($dbobj['profileGender'] 		= $this->gender) 	: '';
		isset($this->location)      ? ($dbobj['profileLocation'] 	= $this->location) 	: '';
		isset($this->rs)      		? ($dbobj['profileRS'] 			= $this->rs) 		: '';
		isset($this->intro)      	? ($dbobj['profileIntro'] 		= $this->intro) 	: '';
		isset($this->language)      ? ($dbobj['profileLanguage'] 	= $this->language) 	: '';
		isset($this->interest)      ? ($dbobj['profileInterest'] 	= $this->interest) 	: '';
		isset($this->ga)       		? ($dbobj['profileGA'] 			= $this->ga) 		: '';
		isset($this->honor)      	? ($dbobj['profileHonor'] 		= $this->honor)	 	: '';
		isset($this->skill)      	? ($dbobj['profileSkill'] 		= $this->skill) 	: '';
		isset($this->email)      	? ($dbobj['profileEmail'] 		= $this->email) 	: '';
		isset($this->phone)        	? ($dbobj['profilePhone'] 		= $this->phone) 	: '';
		isset($this->address)       ? ($dbobj['profileAddress'] 	= $this->address) 	: '';
		isset($this->website)      	? ($dbobj['profileWebsite'] 	= $this->website) 	: '';
		isset($this->sn)     		? ($dbobj['profileSN'] 			= $this->sn) 		: '';
		
		
		return $dbobj; 
	}
	
	function convertToObject($object) {
		
		isset($object['profileId'])			? $this->id 		= $object['profileId']		:	'';
		isset($object['profileUser'])		? $this->user 		= $object['profileUser']	:	'';
		isset($object['profileBirthday'])	? $this->birthday 	= $object['profileBirthday']:	'';
		isset($object['profileGender'])		? $this->gender		= $object['profileGender']	:	'';
		isset($object['profileLocation'])	? $this->location 	= $object['profileLocation']:	'';
		isset($object['profileRS'])			? $this->rs 		= $object['profileRS']		:	'';
		isset($object['profileIntro'])		? $this->intro 		= $object['profileIntro']	:	'';
		isset($object['profileLanguage'])	? $this->language 	= $object['profileLanguage']:	'';
		isset($object['profileInterest'])	? $this->interest 	= $object['profileInterest']:	'';
		isset($object['profileGA'])			? $this->ga 		= $object['profileGA']		:	'';
		isset($object['profileHonor'])		? $this->honor 		= $object['profileHonor']	:	'';
		isset($object['profileSkill'])		? $this->skill 		= $object['profileSkill']	:	'';
		isset($object['profileEmail'])		? $this->email 		= $object['profileEmail']	:	'';
		isset($object['profilePhone'])		? $this->phone	 	= $object['profilePhone']	:	'';
		isset($object['profileAddress'])	? $this->address 	= $object['profileAddress']	:	'';
		isset($object['profileWebsite'])	? $this->website 	= $object['profileWebsite']	:	'';
		isset($object['profileSN'])			? $this->sn 		= $object['profileSN']		:	'';
	}
	
	function getId() {
		return $this->id;
	}

	function getUser() {
		return $this->user;
	}

	function getBirthday() {
		return $this->birthday;
	}

	function getGender() {
		return $this->gender;
	}

	function getLocation() {
		return $this->location;
	}

	function getRs() {
		return $this->rs;
	}

	function getIntro() {
		return $this->intro;
	}

	function getLanguage() {
		return $this->language;
	}

	function getInterest() {
		return $this->interest;
	}

	function getGa() {
		return $this->ga;
	}

	function getHonors() {
		return $this->honors;
	}

	function getEmail() {
		return $this->email;
	}

	function getPhone() {
		return trim($this->phone, '@');
	}

	function getAddress() {
		return $this->address;
	}

	function getWebsite() {
		return $this->website;
	}

	function getSn() {
		return $this->sn;
	}

	function getSkill() {
		return $this->skill;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setBirthday($birthday) {
		$this->birthday = $birthday;
	}

	function setGender($gender) {
		$this->gender = $gender;
	}

	function setLocation($location) {
		$this->location = $location;
	}

	function setRs($rs) {
		$this->rs = $rs;
	}

	function setIntro($intro) {
		$this->intro = $intro;
	}

	function setLanguage($language) {
		$this->language = $language;
	}

	function setInterest($interest) {
		$this->interest = $interest;
	}

	function setGa($ga) {
		$this->ga = $ga;
	}

	function setHonors($honors) {
		$this->honors = $honors;
	}

	function setEmail($email) {
		$this->email = $email;
	}

	function setPhone($phone) {
		$this->phone = "@".$phone;
	}

	function setAddress($address) {
		$this->address = $address;
	}

	function setWebsite($website) {
		$this->website = $website;
	}

	function setSn($sn) {
		$this->sn = $sn;
	}

	function setSkill($skill) {
		$this->skill = $skill;
	}
	
	
	
	
	
	function __construct() {
	}
	
	function __destruct() {
	}
}
?>
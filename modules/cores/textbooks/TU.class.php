<?php
class TU extends BasicObject{
	private $user		= NULL;
//	private $useralias	= NULL;
	private $book		= NULL;

	private $subject	= NULL;
	private $campus		= NULL;
	
	private $department	= NULL;
	private $course		= NULL;
	private $profressor	= NULL;
	
	private $condition	= NULL;
	
	private $location	= NULL;
	
	private $description= NULL;
	private $comment	= NULL;
	private $price		= NULL;
	private $verify		= NULL; // need verifing
	
	private $sold		= NULL;
	private $type		= NULL;
	
	public $message = "";
// status: -1:delete	
	function __destruct() {
		parent::__destruct();
		unset($this->user);
//		unset($this->useralias);
		unset($this->book);
		
		
		unset($this->subject);
		unset($this->campus);
		unset($this->department);
		unset($this->course);
		unset($this->professor);
		
		unset($this->condition);
		unset($this->location);
		
		unset($this->description);
		unset($this->comment);
		
		unset($this->price);
		unset($this->verify);
		
		unset($this->type);
		unset($this->sold);
	}
	
	function convertToObject($object) {
		isset ( $object ['tuId'] ) 			? $this->id = $object['tuId'] 					: '';
		isset ( $object ['tuUser'] ) 		? $this->user = $object['tuUser'] 				: '';
//		isset ( $object ['tuUserAlias'] ) 	? $this->useralias = $object['tuUserAlias'] 		: '';
		
		isset ( $object ['tuBook'] ) 		? $this->book = $object['tuBook'] 				: '';
		isset ( $object ['tuSubject'] ) 	? $this->subject = $object['tuSubject'] 		: '';
		isset ( $object ['tuCampus'] ) 		? $this->campus = $object['tuCampus'] 	 		: '';
		
		isset ( $object ['tuDepartment']) 	? $this->department = $object['tuDepartment']  	: '';
		isset ( $object ['tuCourse'] ) 		? $this->course = $object['tuCourse'] 			: '';
		isset ( $object ['tuProfessor'] ) 	? $this->professor = $object['tuProfessor'] 	: '';
		
		isset ( $object ['tuCondition'] ) 	? $this->condition = $object['tuCondition'] 	: '';
		isset ( $object ['tuLocation'] ) 	? $this->location = $object['tuLocation'] 		: '';
		isset ( $object ['tuDescription'] ) ? $this->description = $object['tuDescription'] : '';
		isset ( $object ['tuComment'] ) 	? $this->comment = $object['tuComment'] 		: '';
		
		isset ( $object ['tuPrice'] ) 		? $this->price = $object['tuPrice'] 			: '';
		isset ( $object ['tuStatus'] ) 		? $this->status = $object['tuStatus'] 			: '';
		isset ( $object ['tuVerify'] ) 		? $this->verify = $object['tuVerify'] 			: '';
		
		isset ( $object ['tuSold'] ) 		? $this->sold = $object['tuSold'] 				: '';
		isset ( $object ['tuType'] ) 		? $this->type = $object['tuType'] 				: '';
		isset ( $object ['tuPostdate'] ) 	? $this->postdate = $object['tuPostdate'] 		: '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['tuId'] 			= $this->id) 			: '';
		isset ( $this->user) 		? ($dbobj ['tuUser']		= $this->user) 			: '';
//		isset ( $this->useralias) 	? ($dbobj ['tuUserAlias']	= $this->useralias) 	: '';
		isset ( $this->book) 		? ($dbobj ['tuBook']		= $this->book) 			: '';
		
		isset ( $this->subject) 	? ($dbobj ['tuSubject'] 	= $this->subject) 		: '';
		isset ( $this->campus) 		? ($dbobj ['tuCampus']		= $this->campus) 		: '';		
		isset ( $this->department) 	? ($dbobj ['tuDepartment'] 	= $this->department) 	: '';
		
		isset ( $this->course) 		? ($dbobj ['tuCourse']		= $this->course) 		: '';
		isset ( $this->professor) 	? ($dbobj ['tuProfessor']	= $this->professor) 	: '';
		isset ( $this->condition) 	? ($dbobj ['tuCondition']	= $this->condition) 	: '';
		
		isset ( $this->location) 	? ($dbobj ['tuLocation']	= $this->location) 		: '';		
		isset ( $this->description) ? ($dbobj ['tuDescription'] = $this->description) 	: '';
		
		isset ( $this->comment) 	? ($dbobj ['tuComment'] 	= $this->comment) 		: '';
		isset ( $this->price) 		? ($dbobj ['tuPrice'] 		= $this->price) 		: '';
		isset ( $this->status) 		? ($dbobj ['tuStatus'] 		= $this->status) 		: '';
		isset ( $this->verify) 		? ($dbobj ['tuVerify'] 		= $this->verify) 		: '';
		isset ( $this->sold) 		? ($dbobj ['tuSold'] 		= $this->sold) 			: '';
		isset ( $this->type) 		? ($dbobj ['tuType'] 		= $this->type) 			: '';
		isset ( $this->postdate)	? ($dbobj ['tuPostdate'] 	= $this->postdate) 		: '';
		
		
		return $dbobj;
	}
	
	function validate() {
		$status = true;
		return $status;
	}
	
	function getURL($title=null){
		global $bw;
		return $bw->base_url . "textbooks/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $this->getId();
	}
	
	function getUser() {
		return $this->user;
	}

	function getBook() {
		return $this->book;
	}

	function getSubject() {
		return $this->subject;
	}

	function getCampus() {
		return $this->campus;
	}

	function getDepartment() {
		return $this->department;
	}

	function getCourse() {
		return $this->course;
	}

	function getProfessor() {
		return $this->professor;
	}

	function getCondition() {
		return $this->condition;
	}

	function getLocation() {
		return $this->location;
	}


	function getDescription($size=0, $br = 0, $tags = "") {
		$parser = new PostParser ();
		$parser->pp_do_html = 1;
		$parser->pp_nl2br = $br;
		$description = $parser->post_db_parse($this->description);
		if($size){
			if($tags) $description = strip_tags($description, $tags);
			else $description = strip_tags($description);
			return VSFTextCode::cutString($description, $size);
		}
		return $description;
	}
	
	function getComment($size=0, $br = 0, $tags = "") {
		$parser = new PostParser ();
		$parser->pp_do_html = 1;
		$parser->pp_nl2br = $br;
		$comment = $parser->post_db_parse($this->comment);
		if($size){
			if($tags) $comment = strip_tags($comment, $tags);
			else $comment = strip_tags($comment);
			return VSFTextCode::cutString($comment, $size);
		}
		return $comment;
	}

	function getPrice($number=true) {
		global $vsLang;
		if (APPLICATION_TYPE=='user' && $number){
			if ($this->price>0)
				return number_format($this->price, 2, ".", ", ");
			return $vsLang->getWords('global_price_updating','Updating');
		}
		return $this->price;
	}
	
	function getVerify() {
		return $this->verify;
	}
	
	function getSold() {
		return $this->sold;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setBook($book) {
		$this->book = $book;
	}

	function setSubject($subject) {
		$this->subject = $subject;
	}

	function setCampus($campus) {
		$this->campus = $campus;
	}

	function setDepartment($department) {
		$this->department = $department;
	}

	function setCourse($course) {
		$this->course = $course;
	}

	function setProfessor($professor) {
		$this->professor = $professor;
	}

	function setCondition($condition) {
		$this->condition = $condition;
	}

	function setLocation($location) {
		$this->location = $location;
	}

	function setDescription($description) {
		$this->description = $description;
	}

	function setComment($comment) {
		$this->comment = $comment;
	}

	function setPrice($price) {
		$this->price = $price;
	}

	function setVerify($verify) {
		$this->verify = $verify;
	}

	function setSold($sold) {
		$this->sold = $sold;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}
}
<?php
class Comment{
	private $id			= NULL;
	private $content	= NULL;
	private $user		= NULL;
	private $original	= NULL;
	private $group		= NULL;
	private $type		= NULL; //0: public, 1: friends, 3: customize - blacklist, 4: customize - whitelist
	private $level		= NULL;
	private $time		= NULL;
	private $reply		= NULL;
	private $profile	= NULL;	
	private $lastupdate	= NULL;
	
	public $message 	= "";
	
	function __construct() {
	}
	
	function __destruct() {
		unset($this->user);
		unset($this->original);
		unset($this->group);
		unset($this->type);
		unset($this->time);
		unset($this->reply);
		unset($this->profile);
		unset($this->lastupdate);
	}
	
	function convertToObject($object) {
		isset ( $object ['commentId'] ) 		? ($this->id = $object['commentId']) 				: '';
		isset ( $object ['commentUser'] ) 		? ($this->user = $object['commentUser']) 			: '';
		isset ( $object ['commentContent'] ) 	? ($this->content = $object['commentContent'])		: '';
		isset ( $object ['commentOriginal'] )	? ($this->original = $object['commentOriginal'])	: '';
		isset ( $object ['commentGroup'] ) 		? ($this->group = $object['commentGroup']) 			: '';
		isset ( $object ['commentType'] ) 		? ($this->type = $object['commentType'])			: '';
		isset ( $object ['commentLevel'] ) 		? ($this->level = $object['commentLevel'])			: '';
		isset ( $object ['commentTime'] ) 		? ($this->time = $object['commentTime']) 			: '';
		isset ( $object ['commentReply'] ) 		? ($this->reply = $object['commentReply']) 			: '';
		isset ( $object ['commentProfile'] ) 	? ($this->profile = $object['commentProfile']) 		: '';
		isset ( $object ['commentLastUpdate'] ) ? ($this->lastupdate = $object['commentLastUpdate']): '';
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['commentId'] 		= $this->id) 		: '';
		isset ( $this->user) 		? ($dbobj ['commentUser']		= $this->user) 		: '';
		isset ( $this->content) 	? ($dbobj ['commentContent']	= $this->content) 	: '';
		isset ( $this->original) 	? ($dbobj ['commentOriginal']	= $this->original) 	: '';	
		isset ( $this->group) 		? ($dbobj ['commentGroup']		= $this->group) 	: '';
		isset ( $this->type) 		? ($dbobj ['commentType']		= $this->type) 		: '';	
		isset ( $this->level) 		? ($dbobj ['commentLevel']		= $this->level) 	: '';
		isset ( $this->time) 		? ($dbobj ['commentTime'] 		= $this->time) 		: '';
		isset ( $this->reply) 		? ($dbobj ['commentReply'] 		= $this->reply) 	: '';
		isset ( $this->profile) 	? ($dbobj ['commentProfile'] 	= $this->profile) 	: '';
		isset ( $this->lastupdate) 	? ($dbobj ['commentLastUpdate'] = $this->lastupdate): '';
		
		return $dbobj;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getContent() {
		return $this->content;
	}

	public function getUser() {
		return $this->user;
	}

	public function getOriginal() {
		return $this->original;
	}

	public function getGroup() {
		return $this->group;
	}

	public function getType() {
		return $this->type;
	}

	public function getLevel() {
		return $this->level;
	}

	

	public function getReply() {
		return $this->reply;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function setOriginal($original) {
		$this->original = $original;
	}

	public function setGroup($group) {
		$this->group = $group;
	}

	public function setType($type) {
		$this->type = $type;
	}

	public function setLevel($level) {
		$this->level = $level;
	}

	public function setTime($time) {
		$this->time = $time;
	}

	public function setReply($reply) {
		$this->reply = $reply;
	}

	function getTime($format=NULL, $standard=false){
		global $vsLang;
		
		if($format == 'real'){
			$cyear = date(Y);
			$year = date("Y", $this->time);
			
			if($year < $cyear)
				return date("M d, Y", $this->time);
			
			$ago = time() - $this->time;
		
			if($ago<59){
				$str = (int)($ago);
				return strval($str)." seconds ago";
			}
			
			$minute = 60*60;
			if($ago < $minute){
				$str = (int)($ago/60);
				return strval($str)." mins ago";
			}
			
			$hour = $minute*24;
			if($ago < $hour){
				$str = (int)($ago/($minute));
				return strval($str)." hours ago";
			}
			
			return date("M. d", $this->time);
		}
		if($format == 'long')
			return date("M. d, Y H:i", $this->time);
		return $this->time;
	}
	
	function getLastUpdate($format=NULL, $standard=false){
		global $vsLang;
		
		if(!$this->lastupdate) return $this->lastupdate;
		
		if($format == 'real'){
			$cyear = date(Y);
			$year = date("Y", $this->lastupdate);
			
			if($year < $cyear)
				return date("M d, Y", $this->lastupdate);
			
			$ago = time() - $this->lastupdate;
		
			if($ago<59){
				$str = (int)($ago);
				return strval($str)." seconds ago";
			}
			
			$minute = 60*60;
			if($ago < $minute){
				$str = (int)($ago/60);
				return strval($str)." mins ago";
			}
			
			$hour = $minute*24;
			if($ago < $hour){
				$str = (int)($ago/($minute));
				return strval($str)." hours ago";
			}
			
			return date("M. d", $this->lastupdate);
		}
		if($format == 'long')
			return date("M. d, Y H:i", $this->lastupdate);
			
		return $this->lastupdate;
	}
	
	public function getProfile() {
		return $this->profile;
	}

	public function setProfile($profile) {
		$this->profile = $profile;
	}

	public function setLastupdate($lastupdate) {
		$this->lastupdate = $lastupdate;
	}

}
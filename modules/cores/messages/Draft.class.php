<?php
class Draft extends BasicObject{
	private $files 		= NULL;
	private $type 		= NULL;
	private $original 	= NULL;
	private $user	 	= NULL;
	private $recipient	= NULL;
	private $group		= NULL; 
	private $message	= NULL;
	
	
	function __destruct() {
		parent::__destruct();
		//status: -1: deleted, 0: trash, 1: draft, 2: read, 3: unread
		unset($this->files);
		unset($this->type); //1: orginal, 2: reply, 3: forward
		unset($this->original);
		unset($this->user);
		unset($this->recipient);
		unset($this->group);
		unset($this->message);
	}
	
	
	function convertToObject($object) {
		isset ( $object ['draftId'] ) 		? ($this->id = $object['draftId']) 				: '';
		isset ( $object ['draftTitle'] ) 	? ($this->title = $object['draftTitle']) 		: '';
		isset ( $object ['draftContent'] )	? ($this->content= $object['draftContent']) 	: '';
		isset ( $object ['draftFiles'] ) 	? ($this->files = $object['draftFiles']) 		: '';
		isset ( $object ['draftPostdate'])	? ($this->postdate = $object['draftPostdate']) 	: '';
		isset ( $object ['draftType'] ) 	? ($this->type = $object['draftType']) 			: $this->type = 0;
		isset ( $object ['draftOriginal'])	? ($this->original = $object['draftOriginal']) 	: $this->original = 0;
		isset ( $object ['draftUser'] )		? ($this->user = $object['draftUser']) 			: '';
		isset ( $object ['draftRecipient'])	? ($this->recipient = $object['draftRecipient']): '';
		isset ( $object ['draftGroup'])		? ($this->group = $object['draftGroup']): '';
		isset ( $object ['draftMessage'])	? ($this->message = $object['draftMessage']): '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['draftId'] 		= $this->id) 		: '';
		isset ($this->title) 	? ($dbobj ['draftTitle'] 	= $this->title) 	: '';
		isset ($this->content) 	? ($dbobj ['draftContent'] 	= $this->content) 	: '';
		isset ($this->files) 	? ($dbobj ['draftFiles'] 	= $this->files) 	: '';
		isset ($this->postdate) ? ($dbobj ['draftPostdate'] = $this->postdate) 	: '';
		isset ($this->type) 	? ($dbobj ['draftType'] 	= $this->type) 		: '';
		isset ($this->original) ? ($dbobj ['draftOriginal'] = $this->original) 	: '';
		isset ($this->user) 	? ($dbobj ['draftUser'] 	= $this->user) 		: '';
		isset ($this->recipient)? ($dbobj ['draftRecipient']= $this->recipient) : '';
		isset ($this->group)	? ($dbobj ['draftGroup']	= $this->group) 	: '';
		isset ($this->message)	? ($dbobj ['draftMessage']	= $this->message) 	: '';
		
		return $dbobj;
	}
	
	
	function getUrl() {
		global $bw;
		
		$type = $this->type;
		if($this->type < 4) $type .= "#topcon";
		return "javascript:vsf.get('" . "messages/draft/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($this->title)),'-')). '-' . $this->id."&dt=".$type."', 'main_content_container')";
	}
	
	function getFiles() {
		return $this->files;
	}

	function getType() {
		return $this->type;
	}

	function getOriginal() {
		return $this->original;
	}

	function getUser() {
		return $this->user;
	}

	function getRecipient() {
		return $this->recipient;
	}

	function getGroup() {
		return $this->group;
	}
	
	function setFiles($files) {
		$this->files = $files;
	}

	function setType($type) {
		$this->type = $type;
	}

	function setOriginal($original) {
		$this->original = $original;
	}

	function setUser($user) {
		$this->user = $user;
	}

	function setRecipient($recipient) {
		$this->recipient = $recipient;
	}

	function setGroup($group) {
		$this->group = $group;
	}
	
	function getMessage() {
		return $this->message;
	}

	function setMessage($message) {
		$this->message = $message;
	}

	function getPostDate($format=NULL, $standard=false){
		global $vsLang;
		
		if($format == 'real'){
			$cyear = date(Y);
			$year = date("Y", $this->postdate);
			if($year < $cyear)
				return date("M d, Y", $this->postdate);
			
			$ago = time() - $this->postdate;
		
			if($ago<59){
				$str = (int)($ago);
				return strval($str)." secs ago";
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
			
			return date("M. d", $this->postdate);
		}
		if($format == 'long'){
			return date("M. d, Y H:i", $this->postdate);
		}
		return $this->postdate;
	}
}
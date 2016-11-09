<?php
class Message extends BasicObject{
	private $files 		= NULL;
	private $type 		= NULL;
	private $original 	= NULL;
	private $user	 	= NULL;
	private $group 		= NULL;
	
	public $message = "";
	
	
	function __destruct() {
		parent::__destruct();
		//status: -2: spam, -1: trash, 0: trash, 1: draft, 2: read, 3: unread
		unset($this->files);
		unset($this->type); //1: orginal, 2: reply, 3: forward
		unset($this->original);
		unset($this->user); //0: system, -1: iCampux icMarket
		unset($this->group);
	}
	
	
	function convertToObject($object) {
		isset ( $object ['messageId'] ) 	? ($this->id = $object['messageId']) 				: '';
		isset ( $object ['messageContent'] )? ($this->content= $object['messageContent']) 		: '';
		isset ( $object ['messageFiles'] ) 	? ($this->files = $object['messageFiles']) 			: '';
		isset ( $object ['messagePostdate'])? ($this->postdate = $object['messagePostdate']) 	: '';
		isset ( $object ['messageStatus'] ) ? ($this->status = $object['messageStatus'])		: $this->status = 1;
		isset ( $object ['messageType'] ) 	? ($this->type = $object['messageType']) 			: $this->type = 0;
		isset ( $object ['messageOriginal'])? ($this->original = $object['messageOriginal']) 	: $this->original = 0;
		isset ( $object ['messageUser'] )	? ($this->user = $object['messageUser']) 			: '';
		isset ( $object ['messageGroup'] )	? ($this->group = $object['messageGroup']) 			: '';
	}

	function convertToDB() {
		isset ($this->id) 		? ($dbobj ['messageId'] 		= $this->id) 		: '';
		isset ($this->content) 	? ($dbobj ['messageContent'] 	= $this->content) 	: '';
		isset ($this->files) 	? ($dbobj ['messageFiles'] 		= $this->files) 	: '';
		isset ($this->postdate) ? ($dbobj ['messagePostdate'] 	= $this->postdate) 	: '';
		isset ($this->status) 	? ($dbobj ['messageStatus'] 	= $this->status) 	: '';
		isset ($this->type) 	? ($dbobj ['messageType'] 		= $this->type) 		: '';
		isset ($this->original) ? ($dbobj ['messageOriginal'] 	= $this->original) 	: '';
		isset ($this->user) 	? ($dbobj ['messageUser'] 		= $this->user) 		: '';
		isset ($this->group) 	? ($dbobj ['messageGroup'] 		= $this->group) 	: '';
		
		return $dbobj;
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
	
	function setGroup($group) {
		$this->group = $group;
	}
	
	function getSpamUrl($title = "", $extend="") {
		global $bw;
		if($extend)
			return "javascript:vsf.get('" . "messages/spam/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $extend."&spt=spd"."', 'main_content_container')";
		return "javascript:vsf.get('" . "messages/spam/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $this->getId()."&spt=spd"."', 'main_content_container')";
	}
	
	function getSentUrl($title = "", $extend="") {
		global $bw;
		if($extend)
			return "javascript:vsf.get('" . "messages/sent/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $extend."&st=sd"."', 'main_content_container')";
		return "javascript:vsf.get('" . "messages/sent/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $this->getId()."&st=sd"."', 'main_content_container')";
	}
	
	function getTrashUrl($title = "", $extend="") {
		global $bw;
		if($extend)
			return "javascript:vsf.get('" . "messages/trash/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $extend."&trt=trd"."', 'main_content_container')";
		return "javascript:vsf.get('" . "messages/trash/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $this->getId()."&trt=trd"."', 'main_content_container')";
	}
	
	function getUrl($title = "", $extend="") {
		global $bw;
		if($extend)
			return "javascript:vsf.get('"."messages/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $extend."', 'campus_user_right')";
		return "javascript:vsf.get('"."messages/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($title)),'-')). '-' . $this->getId ()."', 'campus_user_right')";
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
	
	function getTimeAgo(){
		global $vsf,$vsLang;
		//$vsf->getDateTime()->getDate()
		$ago=time()-$this->postTime;
		if($ago<59) return (int)($ago)." ".$vsLang->getWordsGlobal("seccond_","giây trước");
		if($ago<60*60) return (int)($ago/60)." ".$vsLang->getWordsGlobal("min_","phút trước");
		if($ago<60*60*24) return ((int)($ago/(60*60)))." ".$vsLang->getWordsGlobal("hours_","giờ trước");
		if($ago<60*60*24*30) return ((int)($ago/(60*60*24)))." ".$vsLang->getWordsGlobal("day_","ngày trước");
		return $vsf->getDateTime()->getDate($this->postTime);
	}
}
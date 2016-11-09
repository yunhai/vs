<?php
class LT extends BasicObject{
	
	private $tu			= NULL;
	private $buyer		= NULL;
	private $price		= NULL;
	private $time		= NULL;
	private $del		= NULL;
	
	// staus : 1: open, 2: pendding, 3: sold
	public $message = "";
	
	function __destruct() {
		parent::__destruct();
	}
	
	function convertToObject($object) {
		isset ( $object ['ltId'] ) 		? $this->id = $object['ltId'] 			: '';
		isset ( $object ['ltTu'] ) 		? $this->tu = $object['ltTu'] 			: '';
		isset ( $object ['ltBuyer'] ) 	? $this->buyer = $object['ltBuyer'] 	: '';
		isset ( $object ['ltPrice']) 	? $this->price = $object['ltPrice']  	: '';
		isset ( $object ['ltTime'] ) 	? $this->time = $object['ltTime'] 		: '';
		isset ( $object ['ltStatus'] ) 	? $this->status = $object['ltStatus'] 	: '';
		isset ( $object ['ltDel'] ) 	? $this->del = $object['ltDel'] 	: '';
	}

	function convertToDB() {
		isset ( $this->id) 		? ($dbobj ['ltId'] 		= $this->id) 			: '';
		isset ( $this->tu) 		? ($dbobj ['ltTu']		= $this->tu) 			: '';
		isset ( $this->buyer) 	? ($dbobj ['ltBuyer']	= $this->buyer) 		: '';
		isset ( $this->status) 	? ($dbobj ['ltStatus'] 	= $this->status) 		: '';
		isset ( $this->price) 	? ($dbobj ['ltPrice'] 	= $this->price) 		: '';
		isset ( $this->time) 	? ($dbobj ['ltTime'] 	= $this->time) 			: '';
		isset ( $this->del) 	? ($dbobj ['ltDel'] 	= $this->del) 			: '';
		
		return $dbobj;
	}
	
	function validate() {
		$status = true;
		return $status;
	}
	function getTu() {
		return $this->tu;
	}

	function getBuyer() {
		return $this->buyer;
	}

	function getPrice() {
		return $this->price;
	}

	function getTime() {
		return $this->time;
	}

	function setTu($tu) {
		$this->tu = $tu;
	}

	function setBuyer($buyer) {
		$this->buyer = $buyer;
	}

	function setPrice($price) {
		$this->price = $price;
	}

	function setTime($time) {
		$this->time = $time;
	}
	
	function getStatus($type = NULL) {
		global $bw, $vsLang;
		
		if(!$type) return isset($this->status) ? $this->status : 1;
		
		if($type=="text"){
			$text = array(1=>$vsLang->getWords('status_open', 'Open'), 2=>$vsLang->getWords('status_sold', 'Sold'), 3=>$vsLang->getWords('status_pending', 'Pending'));
			return $text[$this->status];
		}
	}
	
	function getDel(){
		return $this->del;
	}

	function setDel($del){
		$this->del = $del;
	}

}
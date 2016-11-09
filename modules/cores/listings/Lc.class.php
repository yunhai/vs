<?php
class Lc extends BasicObject{
	
	private $obj		= NULL;
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
		isset ( $object ['lcId'] ) 			? $this->id 		= $object['lcId'] 			: '';
		isset ( $object ['lcObj'])			? $this->obj 		= $object['lcObj'] 	: '';
		isset ( $object ['lcBuyer'] ) 		? $this->buyer 		= $object['lcBuyer'] 		: '';
		isset ( $object ['lcPrice']) 		? $this->price 		= $object['lcPrice']  		: '';
		isset ( $object ['lcTime'] ) 		? $this->time 		= $object['lcTime'] 		: '';
		isset ( $object ['lcStatus'] ) 		? $this->status 	= $object['lcStatus'] 		: '';
		isset ( $object ['lcDel'] ) 		? $this->del 		= $object['lcDel'] 			: '';
	}

	function convertToDB() {
		isset ( $this->id) 				? ($dbobj ['lcId'] 			= $this->id) 			: '';
		isset ( $this->obj) 			? ($dbobj ['lcObj']			= $this->obj) 	: '';
		isset ( $this->buyer) 			? ($dbobj ['lcBuyer']		= $this->buyer) 		: '';
		isset ( $this->status) 			? ($dbobj ['lcStatus'] 		= $this->status) 		: '';
		isset ( $this->price) 			? ($dbobj ['lcPrice'] 		= $this->price) 		: '';
		isset ( $this->time) 			? ($dbobj ['lcTime'] 		= $this->time) 			: '';
		isset ( $this->del) 			? ($dbobj ['lcDel'] 		= $this->del) 			: '';
		
		return $dbobj;
	}
	
	function validate() {
		$status = true;
		return $status;
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
	public function getObj() {
		return $this->obj;
	}

	public function getBuyer() {
		return $this->buyer;
	}

	public function getPrice() {
		return $this->price;
	}

	public function getTime() {
		return $this->time;
	}

	public function setObj($obj) {
		$this->obj = $obj;
	}

	public function setBuyer($buyer) {
		$this->buyer = $buyer;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function setTime($time) {
		$this->time = $time;
	}


}
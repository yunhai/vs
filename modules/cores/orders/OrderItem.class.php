<?php
class OrderItem extends BasicObject{
	private $orderId 	= NULL;
	private $bookId 	= NULL;
	private $quantity 	= NULL;
	private $bookUserId = NULL;
	private $price		= NULL;
	private $info		= NULL;
	private $image		= NULL;
	private $date		= NULL;
	
	function __construct(){
		
	}
	
	function __destruct(){
		unset($this->id);
		unset($this->orderId);
		unset($this->bookId);
		unset($this->bookUserId);
		unset($this->quantity);
		unset($this->price);
	}
	
	/**
	 * change order detail to array to insert database
	 *
	 * @return array $dbObj
	 */
	public function convertToDB() {
		isset ( $this->id) 				? ($object["itemId"]			= $this->id)			:"" ;
		isset ( $this->orderId ) 		? ($dbobj ['orderId'] 		= $this->orderId) 		: '';
		isset ( $this->bookId ) 		? ($dbobj ['bookId'] 		= $this->bookId) 	: '';
		isset ( $this->bookUserId ) 	? ($dbobj ['bookUserId'] 		= $this->bookUserId) 		: "";
		isset ( $this->bookImage) 	? ($dbobj ['bookImage'] 		= $this->bookImage) 		: "";
		isset ( $this->quantity ) 		? ($dbobj ['itemQuantity'] 		= $this->quantity) 		: "";
		isset ( $this->price ) 			? ($dbobj ['itemPrice'] 		= $this->price) 		: '';
		
		isset ( $this->title )	? ($dbobj ['itemTitle'] 	= $this->title) 	: "";
		isset ( $this->postdate ) 		? ($dbobj ['itemDate'] 		= $this->postdate) 			: '';
		isset ( $this->status ) 		? ($dbobj ['itemStatus'] 		= $this->status) 			: '';
		isset ( $this->info ) 		? ($dbobj ['itemInfo'] 		= $this->info) 			: '';
		return $dbobj;
	}
	/**
	 * Change order item form database object to orderitem object
	 * @param unknown_type $object
	 */
	function convertToObject($object) {
		isset ( $object ['itemId'] ) 		? $this->setId ( $object ['itemId'] ) 					: '';
		isset ( $object ['orderId'] ) 	? $this->setOrderId( $object ['orderId'] ) 			: '';
		isset ( $object ['bookId'] ) ? $this->setBookId( $object ['bookId'] ) 	: '';
		isset ( $object ['bookUserId'] ) 	? $this->setBookUserId( $object ['bookUserId'] ) 		: '';
		isset ( $object ['bookImage'] ) 	? $this->setBookImage( $object ['bookImage'] ) 		: '';
		isset ( $object ['itemQuantity'] ) 	? $this->setQuantity ( $object ['itemQuantity'])		: '';
		
		isset ( $object ['itemPrice'])? $this->setPrice( $object ['itemPrice'] ) : '';
		isset ( $object ['itemTitle'])? $this->setTitle ( $object ['itemTitle'] ) : '';
		isset ( $object ['itemDate'])? $this->setPostDate ( $object ['itemDate'] ) : '';
		isset ( $object ['itemStatus'])? $this->setStatus ( $object ['itemStatus'] ) : '';
		isset ( $object ['itemInfo'])? $this->setInfo ( $object ['itemInfo'] ) : '';
	}

	public function getInfo() {
		return $this->info;
	}


	public function setInfo($info) {
		$this->info = $info;
	}

	public function getPrice($number = true) {		
		return $this->price;
	}


	public function setPrice($price) {
		$this->price = $price;
	}

	public function getOrderId() {
		return $this->orderId;
	}

	public function getBookId() {
		return $this->bookId;
	}


	public function getQuantity() {
		return $this->quantity;
	}


	public function getBookUserId() {
		return $this->bookUserId;
	}

	public function getBookImage() {
		return $this->bookImage;
	}

	public function setOrderId($orderId) {
		$this->orderId = $orderId;
	}


	public function setBookId($bookId) {
		$this->bookId = $bookId;
	}

	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}


	public function setBookUserId($bookUserId) {
		$this->bookUserId = $bookUserId;
	}
	
	public function setBookImage($bookImage) {
		$this->bookImage = $bookImage;
	}
}
?>
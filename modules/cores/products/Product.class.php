<?php
class Product extends BasicObject {
	private $code 	= NULL;
	private $price 	= NULL;
	private $image 	= NULL;
	private $hits 	= NULL;
	
	private $cleanTitle 	= NULL;
	private $cleanContent 	= NULL;
	
	
	public $message = NULL;
	
	function __construct() {
		parent::__construct ();
	}
	
	function __destruct() {
		parent::__destruct ();
		unset ( $this->code );
		unset ( $this->price );
		unset ( $this->image );
		unset ( $this->hits );
		unset ( $this->cleanTitle);
		unset ( $this->cleanContent);
	}
	
	public function convertToDB() {
		isset ( $this->catId ) 	? ($dbobj ['productCatId'] 	= $this->getCatId()) : '';
		isset ( $this->id ) 	? ($dbobj ['productId'] 	= $this->id) : '';
		
		isset ( $this->intro ) 	? ($dbobj ['productIntro'] 	= $this->intro) : '';
		isset ( $this->content )? ($dbobj ['productContent']= $this->content) : '';
		isset ( $this->code )	? ($dbobj ['productCode']	= $this->code) : '';
		isset ( $this->image ) 	? ($dbobj ['productImage'] 	= $this->image) : '';
		isset ( $this->postdate)? ($dbobj ['productPostDate']= $this->postdate) : '';
		isset ( $this->price)	? ($dbobj ['productPrice']	= $this->price) : '';
		isset ( $this->index ) 	? ($dbobj ['productIndex'] 	= $this->index) : '';
		isset ( $this->hits ) 	? ($dbobj ['productHits'] 	= $this->hits) : '';
		isset ( $this->status ) ? ($dbobj ['productStatus'] = $this->status) : '';
				
		if(isset ( $this->title )){
			$dbobj ['productTitle'] 	 = $this->title;
			$dbobj ['productCleanTitle'] = VSFTextCode::removeAccent(str_replace("/", '-', $this->title),'-');
		}
		
		if(isset ( $this->intro ) || isset($this->content)){
			$cleanContent = VSFTextCode::removeAccent(str_replace("/", '-', $this->intro),'-');
			$cleanContent.= VSFTextCode::removeAccent(str_replace("/", '-', $this->content),'-');	
			$dbobj ['productCleanContent'] = $cleanContent;	
		}
		return $dbobj;
	}
	
	function convertToObject($object) {
		global $vsMenu;
		isset ( $object ['productId'] ) ? $this->setId ( $object ['productId'] ) : '';
		isset ( $object ['productCatId'] ) ? $this->setCatId ( $object ['productCatId'] ) : '';
		isset ( $object ['productCatId'] ) ? $this->setCategory ( $object ['productCatId'] ) : '';
		isset ( $object ['productTitle'] ) ? $this->setTitle ( $object ['productTitle'] ) : '';
		isset ( $object ['productIntro'] ) ? $this->setIntro ( $object ['productIntro'] ) : '';
		isset ( $object ['productContent'] ) ? $this->setContent ( $object ['productContent'] ) : '';
		isset ( $object ['productCode'] ) ? $this->setCode( $object ['productCode'] ) : '';
		isset ( $object ['productPrice'] ) ? $this->setPrice( $object ['productPrice'] ) : '';
		isset ( $object ['productImage'] ) ? $this->setImage ( $object ['productImage'] ) : '';
		isset ( $object ['productPostDate'] ) ? $this->setPostdate ( $object ['productPostDate'] ) : '';
		isset ( $object ['productHits'] ) ? $this->setHits ( $object ['productHits'] ) : '';
		isset ( $object ['productIndex'] ) ? $this->setIndex ( $object ['productIndex'] ) : '';
		isset ( $object ['productStatus'] ) ? $this->setStatus ( $object ['productStatus'] ) : '';
	}
	
	function validate() {
		$status = true;
			
		if ($this->title == "") {
			$this->message .= "Product title can not be blank!";
			$status = false;
		}
		return $status;
	}
	
	public function getCode() {
		return $this->code;
	}

	public function getPrice() {
		return $this->price;
	}

	public function getImage() {
		return $this->image;
	}

	public function getHits() {
		return $this->hits;
	}

	public function setCode($code) {
		$this->code = $code;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function setImage($image) {
		$this->image = $image;
	}

	public function setHits($hits) {
		$this->hits = $hits;
	}


	
}
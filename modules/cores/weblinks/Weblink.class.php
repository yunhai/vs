<?php
class Weblink extends BasicObject{
	private $address 	= NULL;
	private $fileId 	= NULL;
	private $expTime 	= NULL;
	private $price		= NULL;
	private $website 	= NULL;
	private $hits 		= NULL;
	private $position	= NULL;
	public $top 		= 0;
	public $center 		= 0;
	public $right 		= 0;
	public $bottom 		= 0;
	public $left 		= 0;
	public $message 	= NULL;

	public function convertToDB() {
		isset ( $this->catId ) 			? ($dbobj ['weblinkCatId'] 		= $this->getCatId()) 		: '';
		isset ( $this->id ) 			? ($dbobj ['weblinkId'] 		= $this->id) 				: '';
		isset ( $this->title ) 			? ($dbobj ['weblinkTitle'] 		= $this->title) 			: '';
		isset ( $this->intro ) 			? ($dbobj ['weblinkIntro'] 		= $this->intro) 			: '';
		isset ( $this->website ) 		? ($dbobj ['weblinkWebsite'] 	= $this->website) 			: '';
		isset ( $this->expTime ) 		? ($dbobj ['weblinkExpTime']	= $this->expTime) 			: '';
		isset ( $this->address ) 		? ($dbobj ['weblinkAddress']	= $this->address) 			: '';
		isset ( $this->content ) 		? ($dbobj ['weblinkContent'] 	= $this->content) 			: '';
		isset ( $this->index ) 			? ($dbobj ['weblinkIndex'] 		= $this->index) 			: '';
		isset ( $this->fileId ) 		? ($dbobj ['weblinkFileId'] 	= $this->fileId) 			: '';
		isset ( $this->hits ) 			? ($dbobj ['weblinkHits'] 		= $this->hits) 				: '';
		isset ( $this->status ) 		? ($dbobj ['weblinkStatus'] 	= $this->status) 			: '';
		isset ( $this->price ) 			? ($dbobj ['weblinkPrice'] 		= $this->price) 			: '';

		$posStr = "@";
		$posStr .= $this->top;
		$posStr .= $this->right;
		$posStr .= $this->center;
		$posStr .= $this->bottom;
		$posStr .= $this->left;
		$dbobj['weblinkPosition'] = $posStr;

		return $dbobj;
	}

	function convertToObject($object) {
		isset ( $object ['weblinkId'] ) 		? $this->setId ( $object ['weblinkId'] ) 				: '';
		isset ( $object ['weblinkCatId'] ) 		? $this->setCatId ( $object ['weblinkCatId'] ) 			: '';
		isset ( $object ['weblinkTitle'] ) 		? $this->setTitle ( $object ['weblinkTitle'] ) 			: '';
		isset ( $object ['weblinkIntro'] ) 		? $this->setIntro ( $object ['weblinkIntro'] ) 			: '';
		isset ( $object ['weblinkWebsite'] ) 	? $this->setWebsite( $object ['weblinkWebsite'] ) 		: '';
		isset ( $object ['weblinkAddress'] ) 	? $this->setAddress ( $object ['weblinkAddress'] ) 		: '';
		isset ( $object ['weblinkPrice'] ) 		? $this->setPrice ( $object ['weblinkPrice'] ) 			: '';
		isset ( $object ['weblinkExpTime'] ) 	? $this->setExpTime ( $object ['weblinkExpTime'] ) 		: '';
		isset ( $object ['weblinkFileId'] ) 	? $this->setFileId ( $object ['weblinkFileId'] ) 		: '';
		isset ( $object ['weblinkIndex'] ) 		? $this->setIndex ( $object ['weblinkIndex'] ) 			: '';
		isset ( $object ['weblinkContent'] )	? $this->setContent ( $object ['weblinkContent'] ) 		: '';
		isset ( $object ['weblinkHits'] ) 		? $this->setHits ( $object ['weblinkHits'] ) 			: '';
		isset ( $object ['weblinkStatus'] ) 	? $this->setStatus ( $object ['weblinkStatus'] ) 		: '';
		isset ( $object ['weblinkPosition'] ) 	? $this->setPosition ( $object ['weblinkPosition'] ) 	: '';
		if($object['weblinkPosition'])
		{
			$posString		= trim($object['weblinkPosition'],'@');
			$this->top 		= $posString[0];
			$this->right 	= $posString[1];
			$this->center 	= $posString[2];
			$this->bottom 	= $posString[3];
			$this->left 	= $posString[4];
		}
	}
	/**
	 * @return the $latitude
	 */

	/**
	 * @return unknown
	 */
	public function getPosition($position="top") {
		return $this->$position;
	}

	/**
	 * @param unknown_type $position
	 */
	public function setPosition($position) {
		$this->$position = 1;
	}

	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param $address the $address to set
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	function __construct() {
		parent::__construct();
	}

	function __destruct() {
		unset ( $this );
	}

	/**
	 * @param $hits the $hits to set
	 */
	public function setHits($hits) {
		$this->hits = $hits;
	}

	/**
	 * @param $fileId the $fileId to set
	 */
	public function setFileId($fileId) {
		$this->fileId = $fileId;
	}

	/**
	 * @return the $url
	 */
	public function getUrl() {
		global $bw;
		return $bw->base_url . 'weblinks/detail/' . $this->getTitle ( true ) . '-' . $this->getId () . '/';
	}

	/**
	 * @return the $hits
	 */
	public function getHits() {
		return $this->hits;
	}

	/**
	 * @return the $fileId
	 */
	public function getFileId() {
		return $this->fileId;
	}

	/**
	 * @return the $expTime
	 */
	public function getExpTime() {
		return $this->expTime;
	}

	/**
	 * @return the $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @return the $website
	 */
	public function getWebsite() {
		return "http://".str_replace("http://","",$this->website);
	}

	/**
	 * @param $expTime the $expTime to set
	 */
	public function setExpTime($expTime) {
		$this->expTime = $expTime;
	}

	/**
	 * @param $price the $price to set
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @param $website the $website to set
	 */
	public function setWebsite($website) {
		$this->website = $website;
	}

	function validate() {
		$status = true;
		if ($this->title == "") {
			$this->message .= "weblink title can not be blank!";
			$status = false;
		}
		return $status;
	}

}
<?php
class Partner extends BasicObject{
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
		isset ( $this->catId ) 			? ($dbobj ['partnerCatId'] 		= $this->getCatId()) 		: '';
		isset ( $this->id ) 			? ($dbobj ['partnerId'] 		= $this->id) 				: '';
		isset ( $this->title ) 			? ($dbobj ['partnerTitle'] 		= $this->title) 			: '';
		isset ( $this->intro ) 			? ($dbobj ['partnerIntro'] 		= $this->intro) 			: '';
		isset ( $this->website ) 		? ($dbobj ['partnerWebsite'] 	= $this->website) 			: '';
		isset ( $this->expTime ) 		? ($dbobj ['partnerExpTime']	= $this->expTime) 			: '';
		isset ( $this->address ) 		? ($dbobj ['partnerAddress']	= $this->address) 			: '';
		isset ( $this->content ) 		? ($dbobj ['partnerContent'] 	= $this->content) 			: '';
		isset ( $this->index ) 			? ($dbobj ['partnerIndex'] 		= $this->index) 			: '';
		isset ( $this->fileId ) 		? ($dbobj ['partnerFileId'] 	= $this->fileId) 			: '';
		isset ( $this->hits ) 			? ($dbobj ['partnerHits'] 		= $this->hits) 				: '';
		isset ( $this->status ) 		? ($dbobj ['partnerStatus'] 	= $this->status) 			: '';
		isset ( $this->price ) 			? ($dbobj ['partnerPrice'] 		= $this->price) 			: '';

		$posStr = "@";
		$posStr .= $this->top;
		$posStr .= $this->right;
		$posStr .= $this->center;
		$posStr .= $this->bottom;
		$posStr .= $this->left;
		$dbobj['partnerPosition'] = $posStr;

		return $dbobj;
	}

	function convertToObject($object) {
		isset ( $object ['partnerId'] ) 		? $this->setId ( $object ['partnerId'] ) 				: '';
		isset ( $object ['partnerCatId'] ) 		? $this->setCatId ( $object ['partnerCatId'] ) 			: '';
		isset ( $object ['partnerTitle'] ) 		? $this->setTitle ( $object ['partnerTitle'] ) 			: '';
		isset ( $object ['partnerIntro'] ) 		? $this->setIntro ( $object ['partnerIntro'] ) 			: '';
		isset ( $object ['partnerWebsite'] ) 	? $this->setWebsite( $object ['partnerWebsite'] ) 		: '';
		isset ( $object ['partnerAddress'] ) 	? $this->setAddress ( $object ['partnerAddress'] ) 		: '';
		isset ( $object ['partnerPrice'] ) 		? $this->setPrice ( $object ['partnerPrice'] ) 			: '';
		isset ( $object ['partnerExpTime'] ) 	? $this->setExpTime ( $object ['partnerExpTime'] ) 		: '';
		isset ( $object ['partnerFileId'] ) 	? $this->setFileId ( $object ['partnerFileId'] ) 		: '';
		isset ( $object ['partnerIndex'] ) 		? $this->setIndex ( $object ['partnerIndex'] ) 			: '';
		isset ( $object ['partnerContent'] )	? $this->setContent ( $object ['partnerContent'] ) 		: '';
		isset ( $object ['partnerHits'] ) 		? $this->setHits ( $object ['partnerHits'] ) 			: '';
		isset ( $object ['partnerStatus'] ) 	? $this->setStatus ( $object ['partnerStatus'] ) 		: '';
		isset ( $object ['partnerPosition'] ) 	? $this->setPosition ( $object ['partnerPosition'] ) 	: '';
		if($object['partnerPosition'])
		{
			$posString		= trim($object['partnerPosition'],'@');
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
		return $bw->base_url . 'partners/detail/' . $this->getTitle ( true ) . '-' . $this->getId () . '/';
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
			$this->message .= "partner title can not be blank!";
			$status = false;
		}
		return $status;
	}

}
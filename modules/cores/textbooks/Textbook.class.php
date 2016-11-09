<?php
class Textbook extends BasicObject{
	private $isbn		= NULL;
	private $isbn10		= NULL;

	private $author		= NULL;
	private $edition	= NULL;
	
	private $page		= NULL;
	private $publisher	= NULL;
	private $release	= NULL;
	
	private $format		= NULL;
	private $language	= NULL;
	
	private $dimension	= NULL;
	private $weight		= NULL;
	
	private $dimensionUnit	= NULL;
	private $weightUnit		= NULL;
	
	private $image		= NULL;
	
	public $message = "";
	
	
	function __destruct() {
		parent::__destruct();
		unset($this->isbn);
		unset($this->isbn10);
		
		unset($this->author);
		unset($this->edition);
		unset($this->page);
		unset($this->publisher);
		
		unset($this->release);
		unset($this->format);
		unset($this->language);
		
		unset($this->dimension);
		unset($this->weight);
		
		unset($this->dimensionUnit);
		unset($this->weightUnit);
		
		
		unset($this->image);
	}
	
	
	
	function convertToObject($object) {
		isset ( $object ['bookId'] ) 		? $this->setId($object['bookId']) 				: '';
		isset ( $object ['bookISBN'] ) 		? $this->setIsbn($object['bookISBN']) 			: '';
		isset ( $object ['bookISBN10'] ) 	? $this->setIsbn10($object['bookISBN10'])		: '';
		isset ( $object ['bookTitle'] ) 	? $this->setTitle($object['bookTitle'])			: '';
		isset ( $object ['bookAuthor'] ) 	? $this->setAuthor($object['bookAuthor'])	 	: '';
		
		isset ( $object ['bookEdition'] ) 	? $this->setEdition($object['bookEdition']) 	: '';
		isset ( $object ['bookPage'] ) 		? $this->setPage($object['bookPage'])			: '';
		isset ( $object ['bookPublisher'] ) ? $this->setPublisher($object['bookPublisher'])	: '';
		
		isset ( $object ['bookRelease'] ) 	? $this->setRelease($object['bookRelease'])		: '';
		isset ( $object ['bookFormat'] ) 	? $this->setFormat($object['bookFormat'])		: '';
		isset ( $object ['bookLanguage'] ) 	? $this->setLanguage($object['bookLanguage'])	: '';
		
		isset ( $object ['bookRate'] ) 		? $this->setRate($object['bookRate']) 			: '';
		isset ( $object ['bookRateValue'] ) ? $this->setRateValue($object['bookRateValue']) : '';
		isset ( $object ['bookStar'] ) 		? $this->setStar($object['bookStar']) 			: '';
		
		isset ( $object ['bookDimension'] ) ? $this->setDimension($object['bookDimension'])	: '';
		isset ( $object ['bookWeight'] ) 	? $this->setWeight($object['bookWeight'])		: '';
		
		isset ( $object ['bookDimensionUnit'] ) ? $this->setDimensionUnit($object['bookDimensionUnit'])	: '';
		isset ( $object ['bookWeightUnit'] ) 	? $this->setWeightUnit($object['bookWeightUnit'])		: '';
		
		isset ( $object ['bookImage'] ) 	? $this->setImage($object['bookImage']) 		: '';
		
		isset ( $object ['bookStatus'] ) 	? $this->setStatus($object['bookStatus'])		: $this->setStatus(1);
	}

	function convertToDB() {
		isset ( $this->id) 			? ($dbobj ['bookId'] 		= $this->id) 		: '';
		isset ( $this->isbn) 		? ($dbobj ['bookISBN']		= $this->isbn) 		: '';
		isset ( $this->isbn10) 		? ($dbobj ['bookISBN10']	= $this->isbn10) 	: '';
		
		isset ( $this->title) 		? ($dbobj ['bookTitle'] 	= $this->title) 	: '';
		isset ( $this->author) 		? ($dbobj ['bookAuthor']	= $this->author) 	: '';		
		isset ( $this->edition) 	? ($dbobj ['bookEdition'] 	= $this->edition) 	: '';
		
		isset ( $this->page) 		? ($dbobj ['bookPage']		= $this->page) 		: '';
		isset ( $this->publisher) 	? ($dbobj ['bookPublisher']	= $this->publisher) : '';
		isset ( $this->release) 	? ($dbobj ['bookRelease']	= $this->release) 	: '';
		
		isset ( $this->image) 		? ($dbobj ['bookImage']		= $this->image) 	: '';
		isset ( $this->format) 		? ($dbobj ['bookFormat']	= $this->format) 	: '';

		
		isset ( $this->star) 		? ($dbobj ['bookStar']		= $this->star) 	: '';
		isset ( $this->ratevalue)	? ($dbobj ['bookRateValue']	= $this->ratevalue) : '';
		isset ( $this->rate) 		? ($dbobj ['bookRate']		= $this->rate) 	: '';
		
		isset ( $this->language) 	? ($dbobj ['bookLanguage'] 	= $this->language) 	: '';	
		isset ( $this->status) 		? ($dbobj ['bookStatus'] 	= $this->status) 	: $dbobj['bookStatus'] = 1;
		
		isset ( $this->dimension) 	? ($dbobj ['bookDimension']	= $this->dimension) : '';
		isset ( $this->weight) 		? ($dbobj ['bookWeight']	= $this->weight) 	: '';
		
		isset ( $this->dimensionUnit) 	? ($dbobj ['bookDimensionUnit']	= $this->dimensionUnit) : '';
		isset ( $this->weightUnit) 		? ($dbobj ['bookWeightUnit']	= $this->weightUnit) 	: '';
		
		return $dbobj;
	}
	
	function validate() {
		$status = true;
		if ($this->title == "") {
			$this->message .= "book name can not be blank!";
			$status = false;
		}
		return $status;
	}
	
	function getIsbn() {
		return $this->isbn;
	}
	
	function getIsbn10() {
		return $this->isbn10;
	}

	function getAuthor($size = 0){
		if($size) return VSFTextCode::cutString($this->author, $size);
		return $this->author;
	}

	function getEdition() {
		return $this->edition;
	}

	function getPage() {
		return $this->page;
	}
	
	function getPublisher() {
		return $this->publisher;
	}
	
	function getRelease($raw = 0, $type = 0){
		if($raw) return $this->release;
		if($this->release){
			$timestamp = strtotime($this->release);
			if(!$timestamp) return "";
			if($type)
				return date("M d, Y", $timestamp);
			return date("M. Y", $timestamp);
		}
		return "";
	}

	function getImage() {
		return $this->image;
	}
	
	function getWeight() {
		return $this->weight;
	}


	function getStar() {
		return $this->star;
	}
	
	function getRate() {
		return $this->rate;
	}
	
	function getRateValue() {
		return $this->ratevalue;
	}
	
	function setIsbn($isbn) {
		$this->isbn = $isbn;
	}

	function setIsbn10($isbn10) {
		$this->isbn10 = $isbn10;
	}
	
	function setAuthor($author) {
		$this->author = $author;
	}

	function setEdition($edition) {
		$this->edition = $edition;
	}

	function setPage($page) {
		$this->page= $page;
	}
	
	function setPublisher($publisher) {
		$this->publisher = $publisher;
	}
	
	function setRelease($release) {
		return $this->release = $release;
	}
	
	function setImage($image) {
		$this->image = $image;
	}
	

	function getFormat() {
		return $this->format;
	}

	function getLanguage() {
		return $this->language;
	}

	function setFormat($format) {
		$this->format = $format;
	}

	function setLanguage($language) {
		$this->language = $language;
	}

	function setDimension($dimension) {
		$this->dimension = $dimension;
	}

	function setWeight($weight) {
		$this->weight = $weight;
	}
	
	function setStar($star) {
		$this->star = $star;
	}

	function setRate($rate) {
		$this->rate = $rate;
	}
	
	function setRateValue($rate) {
		$this->ratevalue = $rate;
	}

	function getListingURL(){
		global $bw;
		return $bw->base_url . "textbooks/listing/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($this->title)),'-')). '-' . $this->getId ();
	}
	

	function getDetailUrl(){
		global $bw;
		return $bw->base_url . "textbooks/detail/".strtolower(VSFTextCode::removeAccent(str_replace("/", '-', trim($this->title)),'-')). '-' . $this->getId().'-'.$this->tuid;
	}
	
	public function getDimension() {
		return $this->dimension;
	}

	public function getDimensionUnit() {
		return $this->dimensionUnit;
	}

	public function getWeightUnit() {
		return $this->weightUnit;
	}

	public function setDimensionUnit($dimensionUnit) {
		$this->dimensionUnit = $dimensionUnit;
	}

	public function setWeightUnit($weightUnit) {
		$this->weightUnit = $weightUnit;
	}

	public function getSold() {
		return $this->sold;
	}

	public function setSold($sold) {
		$this->sold = $sold;
	}

}
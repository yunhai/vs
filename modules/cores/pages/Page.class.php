<?php
class Page extends BasicObject {

	public function convertToDB() {
		isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->content ) ? ($dbobj ['content'] = $this->content) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->code ) ? ($dbobj ['code'] = $this->code) : '';
		isset ( $this->module ) ? ($dbobj ['module'] = $this->module) : '';
		isset ( $this->mTitle ) ? ($dbobj ['mTitle'] = $this->mTitle) : '';
		isset ( $this->mKeyword ) ? ($dbobj ['mKeyword'] = $this->mKeyword) : '';
		isset ( $this->mIntro ) ? ($dbobj ['mIntro'] = $this->mIntro) : '';
		isset ( $this->mUrl ) ? ($dbobj ['mUrl'] = $this->mUrl) : '';
		
		isset ( $this->provin ) ? ($dbobj ['provin'] = $this->provin) : '';
		isset ( $this->dis ) ? ($dbobj ['dis'] = $this->dis) : '';
		isset ( $this->map ) ? ($dbobj ['map'] = $this->map) : '';
		
		
		return $dbobj;
	}

	public function convertToObject($object = array()) {
		isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['content'] ) ? $this->setContent ( $object ['content'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['code'] ) ? $this->setCode ( $object ['code'] ) : '';
		isset ( $object ['module'] ) ? $this->setModule ( $object ['module'] ) : '';
		isset ( $object ['mTitle'] ) ? $this->setMTitle ( $object ['mTitle'] ) : '';
		isset ( $object ['mKeyword'] ) ? $this->setMKeyWord ( $object ['mKeyword'] ) : '';
		isset ( $object ['mIntro'] ) ? $this->getMIntro ( $object ['mIntro'] ) : '';
		isset ( $object ['mUrl'] ) ? $this->setMUrl ( $object ['mUrl'] ) : '';
		
		isset ( $object ['provin'] ) ? $this->setProvin ( $object ['provin'] ) : '';
		isset ( $object ['dis'] ) ? $this->setDis ( $object ['dis'] ) : '';
		isset ( $object ['map'] ) ? $this->setMap ( $object ['map'] ) : '';
		
	}

	function getId() {
		return $this->id;
	}

	function getCatId() {
		return $this->catId;
	}

	function getTitle() {
		return $this->title;
	}

	function getIntro() {
		return $this->intro;
	}

	function getImage() {
		return $this->image;
	}

	function getContent() {
		return $this->content;
	}

	function getPostDate() {
		return $this->postDate;
	}

	function getIndex() {
		return $this->index;
	}

	function getCode() {
		return $this->code;
	}

	function getModule() {
		return $this->module;
	}

	function setIds($id) {
		$this->id = $id;
	}

	function setCatId($catId) {
		$this->catId = $catId;
	}

	function setTitle($title) {
		$this->title = $title;
	}

	function setIntro($intro) {
		$this->intro = $intro;
	}

	function setImage($image) {
		$this->image = $image;
	}

	function setContent($content) {
		$this->content = $content;
	}

	function setPostDate($postDate) {
		$this->postDate = $postDate;
	}

	function setStatus($status) {
		$this->status = $status;
	}

	function setIndex($index) {
		$this->index = $index;
	}

	function setCode($code) {
		$this->code = $code;
	}

	function setModule($module) {
		$this->module = $module;
	}
	var $id;
	var $catId;
	var $title;
	var $intro;
	var $image;
	var $content;
	var $postDate;
	var $status;
	var $index;
	var $code;
	var $module;
	
	var $name;
	var $phone;
	var $address;
	var $timebegin;
	var $datebegin;
	var $timeend;
	var $dateend;
	var $provin;
	var $dis;
	var $map;
	/**
	 * @return the $name
	 */
	/**
	 * @return the $provin
	 */
	public function getProvin() {
		return $this->provin;
	}

	/**
	 * @return the $dis
	 */
	public function getDis() {
		return $this->dis;
	}

	/**
	 * @return the $map
	 */
	public function getMap() {
		return $this->map;
	}

	/**
	 * @param field_type $provin
	 */
	public function setProvin($provin) {
		$this->provin = $provin;
	}

	/**
	 * @param field_type $dis
	 */
	public function setDis($dis) {
		$this->dis = $dis;
	}

	/**
	 * @param field_type $map
	 */
	public function setMap($map) {
		$this->map = $map;
	}

	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @return the $timebegin
	 */
	public function getTimebegin() {
		return $this->timebegin;
	}

	/**
	 * @return the $datebegin
	 */
	public function getDatebegin() {
		return $this->datebegin;
	}

	/**
	 * @return the $timeend
	 */
	public function getTimeend() {
		return $this->timeend;
	}

	/**
	 * @return the $dateend
	 */
	public function getDateend() {
		return $this->dateend;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $phone
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * @param field_type $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @param field_type $timebegin
	 */
	public function setTimebegin($timebegin) {
		$this->timebegin = $timebegin;
	}

	/**
	 * @param field_type $datebegin
	 */
	public function setDatebegin($datebegin) {
		$this->datebegin = $datebegin;
	}

	/**
	 * @param field_type $timeend
	 */
	public function setTimeend($timeend) {
		$this->timeend = $timeend;
	}

	/**
	 * @param field_type $dateend
	 */
	public function setDateend($dateend) {
		$this->dateend = $dateend;
	}

	
}

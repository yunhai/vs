<?php

class Faq extends BasicObject {

	public function convertToDB() {
		isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->content ) ? ($dbobj ['content'] = $this->content) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->email ) ? ($dbobj ['email'] = $this->email) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->phone ) ? ($dbobj ['phone'] = $this->phone) : '';
		return $dbobj;
	
	}

	public function convertToObject($object = array()) {
		
		isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['content'] ) ? $this->setContent ( $object ['content'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['email'] ) ? $this->setEmail ( $object ['email'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['phone'] ) ? $this->setPhone ( $object ['phone'] ) : '';
	}

	function getId() {
		return $this->id;
	}

	function getCatId() {
		return $this->catId;
	}

	function getContent() {
		return $this->content;
	}

	function getFullName() {
		return $this->fullName;
	}

	function getEmail() {
		return $this->email;
	}

	function getPostDate() {
		return $this->postDate;
	}

	function getStatus() {
		return $this->status;
	}

	function getIndex() {
		return $this->index;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCatId($catId) {
		$this->catId = $catId;
	}

	function setContent($content) {
		$this->content = $content;
	}

	function setFullName($fullName) {
		$this->fullName = $fullName;
	}

	function setEmail($email) {
		$this->email = $email;
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
	
	public function getPhone() {
		return $this->phone;
	}
	
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	
	var $id;
	
	var $catId;
	
	var $content;
	
	var $fullName;
	
	var $email;
	
	var $postDate;
	
	var $status;
	
	var $index;
	var $phone;

	

}

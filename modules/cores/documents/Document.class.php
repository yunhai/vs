<?php 

class Document extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->catId ) ? ($dbobj ['catId'] = $this->catId) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->intro ) ? ($dbobj ['intro'] = $this->intro) : '';
		isset ( $this->image ) ? ($dbobj ['image'] = $this->image) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->postDate ) ? ($dbobj ['postDate'] = $this->postDate) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['catId'] ) ? $this->setCatId ( $object ['catId'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['intro'] ) ? $this->setIntro ( $object ['intro'] ) : '';
		isset ( $object ['image'] ) ? $this->setImage ( $object ['image'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['postDate'] ) ? $this->setPostDate ( $object ['postDate'] ) : '';

	}





	function getId(){
		return $this->id;
	}



	function getCatId(){
		return $this->catId;
	}



	function getTitle(){
		return $this->title;
	}



	function getIntro(){
		return $this->intro;
	}



	function getImage(){
		return $this->image;
	}



	function getStatus(){
		return $this->status;
	}



	function getIndex(){
		return $this->index;
	}



	function getPostDate(){
		return $this->postDate;
	}



	function setId($id){
		$this->id=$id;
	}




	function setCatId($catId){
		$this->catId=$catId;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setIntro($intro){
		$this->intro=$intro;
	}




	function setImage($image){
		$this->image=$image;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setIndex($index){
		$this->index=$index;
	}




	function setPostDate($postDate){
		$this->postDate=$postDate;
	}



		var		$id;

		var		$catId;

		var		$title;

		var		$intro;

		var		$image;

		var		$status;

		var		$index;

		var		$postDate;
}

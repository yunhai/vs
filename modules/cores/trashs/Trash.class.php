<?php

class Trash extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->table ) ? ($dbobj ['table'] = $this->table) : '';
		isset ( $this->objectid ) ? ($dbobj ['objectid'] = $this->objectid) : '';
		isset ( $this->module ) ? ($dbobj ['module'] = $this->module) : '';
		isset ( $this->username ) ? ($dbobj ['username'] = $this->username) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->date ) ? ($dbobj ['date'] = $this->date) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['table'] ) ? $this->setTable ( $object ['table'] ) : '';
		isset ( $object ['objectid'] ) ? $this->setObjectid ( $object ['objectid'] ) : '';
		isset ( $object ['module'] ) ? $this->setModule ( $object ['module'] ) : '';
		isset ( $object ['username'] ) ? $this->setUsername ( $object ['username'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['date'] ) ? $this->setDate ( $object ['date'] ) : '';

	}





	function getId(){
		return $this->id;
	}



	function getTitle(){
		return $this->title;
	}



	function getTable(){
		return $this->table;
	}



	function getObjectid(){
		return $this->objectid;
	}



	function getModule(){
		return $this->module;
	}



	function getUsername(){
		return $this->username;
	}



	function getStatus(){
		return $this->status;
	}



	function getIndex(){
		return $this->index;
	}



	function getDate(){
		return $this->date;
	}



	function setId($id){
		$this->id=$id;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setTable($table){
		$this->table=$table;
	}




	function setObjectid($objectid){
		$this->objectid=$objectid;
	}




	function setModule($module){
		$this->module=$module;
	}




	function setUsername($username){
		$this->username=$username;
	}




	function setStatus($status){
		$this->status=$status;
	}




	function setIndex($index){
		$this->index=$index;
	}




	function setDate($date){
		$this->date=$date;
	}



		var		$id;

		var		$title;

		var		$table;

		var		$objectid;

		var		$module;

		var		$username;

		var		$status;

		var		$index;

		var		$date;
}

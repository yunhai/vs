<?php

class Widget extends BasicObject {

	public	function convertToDB(){
			isset ( $this->id ) ? ($dbobj ['id'] = $this->id) : '';
		isset ( $this->title ) ? ($dbobj ['title'] = $this->title) : '';
		isset ( $this->position ) ? ($dbobj ['position'] = $this->position) : '';
		isset ( $this->index ) ? ($dbobj ['index'] = $this->index) : '';
		isset ( $this->option ) ? ($dbobj ['option'] = $this->option) : '';
		isset ( $this->instant ) ? ($dbobj ['instant'] = $this->instant) : '';
		isset ( $this->status ) ? ($dbobj ['status'] = $this->status) : '';
		return $dbobj;

	}





	public	function convertToObject($object = array()){
			isset ( $object ['id'] ) ? $this->setId ( $object ['id'] ) : '';
		isset ( $object ['title'] ) ? $this->setTitle ( $object ['title'] ) : '';
		isset ( $object ['position'] ) ? $this->setPosition ( $object ['position'] ) : '';
		isset ( $object ['index'] ) ? $this->setIndex ( $object ['index'] ) : '';
		isset ( $object ['option'] ) ? $this->setOption ( $object ['option'] ) : '';
		isset ( $object ['instant'] ) ? $this->setInstant ( $object ['instant'] ) : '';
		isset ( $object ['status'] ) ? $this->setStatus ( $object ['status'] ) : '';

	}





	function getId(){
		return $this->id;
	}



	function getTitle(){
		return $this->title;
	}



	function getPosition(){
		return $this->position;
	}



	function getIndex(){
		return $this->index;
	}



	function getOption(){
		return $this->option;
	}



	function getStatus(){
		return $this->status;
	}



	function setId($id){
		$this->id=$id;
	}




	function setTitle($title){
		$this->title=$title;
	}




	function setPosition($position){
		$this->position=$position;
	}




	function setIndex($index){
		$this->index=$index;
	}




	function setOption($option){
		$this->option=$option;
	}




	function setStatus($status){
		$this->status=$status;
	}



		var		$id;

		var		$title;

		var		$position;

		var		$index;

		var		$option;
		var		$instant;

		var		$status;

	
	/**
	*List fields in table
	**/
	var		$fields=array('id','title','position','index','option','status',);
	/**
	 * @return the $instant
	 */
	public function getInstant() {
		return $this->instant;
	}

	/**
	 * @param field_type $instant
	 */
	public function setInstant($instant) {
		$this->instant = $instant;
	}
	function validate() {
		return true;
	}
	public function getObj(){
		if($this->obj) return $this->obj;
		$widgets=new widgets();
		if($class_name=$widgets->checkWidget($this->instant)){
			$this->obj=new $class_name();
			$this->obj->obj=$this;
			return $this->obj;
		}else{ 
			require_once LIBS_PATH.'boards/widgets_board.php';
			$this->obj=new widgets_board();
			$this->obj->obj=$this;
			return 	$this->obj;
		}
		
	}
	function getConfig(){
		if($this->config) return $this->config;
		$this->config=new stdClass;
		$p=unserialize($this->option);
		if(is_array($p))
		foreach ($p as $index=>$value){
			$this->config->$index=$value;
		}
		return $this->config;
	}
}

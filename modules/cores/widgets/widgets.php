<?php
require_once(CORE_PATH."widgets/Widget.class.php");

class widgets extends VSFObject {


	/**
	*Enter description here ...
	**/
	public	function __construct($category=''){
			$this->primaryField 	= 'id';
		$this->basicClassName 	= 'Widget';
		$this->tableName 		= 'widget';
		//$this->categoryField='catId';
		//$this->categoryName=$category?$category:"widgets";
		$this->createBasicObject();		
		parent::__construct();
	}




	
	/**
	*Enter description here ...
	*@var Widget
	**/
	var		$obj;
	function checkWidget($instant_name){
		$file=WIDGETS_PATH."$instant_name/widgets_$instant_name.php";
		if(file_exists($file)){
			require_once WIDGETS_PATH."$instant_name/widgets_$instant_name.php";
			$class_name="widgets_$instant_name";
			if(!class_exists($class_name)){
				$this->message="Object not found!";
				return false;
			}else{
				return $class_name;
			}
		}else{
			$this->message="Instant not define in path!";;
			return false;
		}
	}
}

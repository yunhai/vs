<?php
require_once(CORE_PATH.'slidebanners/slidebanners.php');

class slidebanners_controler_public extends VSControl_public {

	public	function auto_run(){
	
	global $bw;
				switch ($bw->input['action']) {
//			case $this->modelName.'_some_action':
//				$this->someMethod($bw->input[2]);
//				break;
			default:
				parent::auto_run();
				break;
		}

	}





	public	function __construct($modelName){
	
		global $vsTemplate,$bw;
//		$this->html=$vsTemplate->load_template("skin_slidebanner");
		parent::__construct($modelName,"skin_slidebanners","slidebanner",$bw->input[0]);
//		$this->model->categoryName=$bw->input[0];

	}





	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var slidebanners
	**/
	var		$model;

	
	/**
	*
	*@var skin_slidebanners
	**/
	var		$html;
}

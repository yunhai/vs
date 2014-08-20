<?php
require_once(CORE_PATH.'trashs/trashs.php');

class trashs_controler_public extends VSControl_public {

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
//		$this->html=$vsTemplate->load_template("skin_trash");
		parent::__construct($modelName,"skin_trashs","trash",$bw->input[0]);
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
	*@var trashs
	**/
	var		$model;

	
	/**
	*
	*@var skin_trashs
	**/
	var		$html;
}

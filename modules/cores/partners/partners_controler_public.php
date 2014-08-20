<?php
require_once(CORE_PATH.'partners/partners.php');

class partners_controler_public extends VSControl_public {

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
//		$this->html=$vsTemplate->load_template("skin_partner");
		parent::__construct($modelName,"skin_partners","partner",$bw->input[0]);
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
	*@var partners
	**/
	var		$model;

	
	/**
	*
	*@var skin_partners
	**/
	var		$html;
}

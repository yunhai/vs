<?php
require_once(CORE_PATH.'slidebanners/slidebanners.php');

class slidebanners_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_slidebanners");
		parent::__construct($modelName,"skin_slidebanners","slidebanner");
		$this->model->categoryName="slidebanners";

	}





	function getHtml(){
		return $this->html;
	}



	function getOutput(){
		return $this->output;
	}



	function setHtml($html){
		$this->html=$html;
	}




	function setOutput($output){
		$this->output=$output;
	}



	
	/**
	*Skins for slidebanner ...
	*@var skin_slidebanners
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}

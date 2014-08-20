<?php
require_once(CORE_PATH.'logos/logos.php');

class logos_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_logos");
		parent::__construct($modelName,"skin_logos","logo");
		$this->model->categoryName="logos";

	}

function auto_run() {
		global $bw;
		
		switch ($bw->input [1]) {
			case $this->modelName . '_change_status' :
				$this->changeStatus ();
				break;
			
			default :
				parent::auto_run();
				break;
				
		}
	}
	
	function changeStatus(){
		global $bw;
		
		//$this->model->setCondition("status=0");
		$this->model->updateObjectByCondition(array("status"=>"0"));
		$this->model->resetQuery();
		$ids=trim($bw->input[2]);
		$this->model->setCondition("`{$this->model->getPrimaryField()}` =".$ids ."");
		$this->model->updateObjectByCondition(array("status"=>"1"));
		
		//echo 1;;
		echo VSFactory::getLangs()->getWords('update_ok','Cập nhật thành công !');exit();
		//echo json_encode($value);exit();
			
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
	*Skins for logo ...
	*@var skin_logos
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}

<?php
require_once(CORE_PATH.'videos/videos.php');

class videos_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_videos");
		parent::__construct($modelName,"skin_videos","video");
		$this->model->categoryName="videos";

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
	*Skins for video ...
	*@var skin_videos
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}

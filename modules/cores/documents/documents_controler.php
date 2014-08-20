<?php
require_once(CORE_PATH.'documents/documents.php');

class documents_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_documents");
		parent::__construct($modelName,"skin_documents","document");
		$this->model->categoryName="documents";

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
	*Skins for document ...
	*@var skin_documents
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}

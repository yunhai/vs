<?php
require_once(CORE_PATH.'files/files.php');

class files_controler_public extends VSControl_public {

    function __construct($modelName) {
        global $vsTemplate, $bw;
        parent::__construct ( $modelName, "", "product", $bw->input [0] );
    }
    
	public	function auto_run(){
        global $bw;
				
		switch ($bw->input['action']) {
		    case 'files_uploadfile' :
    		    $this->model->uploadFile($bw->input['uploadName'], $bw->input['fileFolder'], $bw->input['utype'], true);
    		    break;
			default:
				parent::auto_run();
				break;
		}
	}




	function getHtml(){
		return $this->html;
	}



	function setHtml($html){
		$this->html=$html;
	}



	
	/**
	*
	*@var files
	**/
	var		$model;

	
	/**
	*
	*@var skin_files
	**/
	var		$html;
}

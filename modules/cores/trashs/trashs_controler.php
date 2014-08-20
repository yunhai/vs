<?php
require_once(CORE_PATH.'trashs/trashs.php');

class trashs_controler extends VSControl_admin {

		function __construct($modelName){
			global $vsTemplate,$bw;//		$this->html=$vsTemplate->load_template("skin_trashs");
		parent::__construct($modelName,"skin_trashs","trash");
		$this->model->categoryName="trashs";

	}

	
	function auto_run(){
		global $bw;
		switch($bw->input[1]){
			case $this->modelName.'_delete' :
				$this->deleteObject($bw->input[2]);
				parent::auto_run();
				break;
			case $this->modelName.'_restore_checked' :
				$this->deleteObject($bw->input[2], 0);
				parent::deleteObj($bw->input[2]);
				break;	
			default :
				parent::auto_run ();
				break;	
		}
	}

	function deleteObject($ids,$delete = 1){
		global $bw,$vsStd,$DB;
		$this->model->setCondition('id IN ('.$ids.')');
		$objectList = $this->model->getObjectsByCondition();
		$modulList = array();
		$tableList = array();
		if($objectList)
			foreach($objectList as $obj){
				$modulList[$obj->getModule()][] = $obj->getObjectid();
				$tableList[$obj->getModule()] = $obj->getTable();
			}
		if($modulList)
			foreach($modulList as $module=>$value){
				$idString = $value?implode($value, ','):0;
				if($delete)
					$DB->query('DELETE FROM '.$bw->vars['sql_tbl_prefix_0'].$tableList[$module].' WHERE id IN ('.$idString.')');
					else 
					$DB->query('UPDATE '.$bw->vars['sql_tbl_prefix_0'].$tableList[$module].' SET status=1 WHERE id IN ('.$idString.')');
			}
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
	*Skins for trash ...
	*@var skin_trashs
	**/
	var		$html;

	
	/**
	*String code return to browser
	**/
	var		$output;
}

<?php
require_once(CORE_PATH."projects/Project.class.php");
class projects extends VSFObject {
        public $obj;
	function __construct(){
            global $vsMenu,$bw;
//            $this->requireFileUseFull();
		parent::__construct();
		$this->categoryField 	= "projectCatId";
		$this->primaryField 	= 'projectId';
		$this->basicClassName 	= 'Project';
		$this->tableName 	= 'project';
		$this->obj              = $this->createBasicObject();
		$this->obj              =&$this->basicObject;
		$this->fields           = $this->obj->convertToDB();
		$this->categories       = array();
		$this->categories       = $vsMenu->getCategoryGroup($bw->input['module']);
	}
	
}
?>
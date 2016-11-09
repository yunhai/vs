<?php
global $vsStd;
require_once(CORE_PATH."users/profile/Work.class.php");


class works extends VSFObject{
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'workId';
		$this->basicClassName 	= 'Work';
		$this->tableName 		= 'user_work';
		
		$this->obj = $this->createBasicObject();
	}
	
	function getUserWork($user = 0){
		if(!$user) return array();
		
		$cond = 'workUser = '.$user;
		$this->setCondition($cond);
		$works = $this->getArrayByCondition('workId');
		$workIds = implode(',', array_keys($works));
		
		if($workIds){
			$this->setTableName('user_work_project');
			$cond = 'wpWork IN ('.$workIds.')';
			$this->setCondition($cond);
			$this->setOrder('wpId');
			$eps = $this->getArrayByCondition('wpId', 'wpWork');//$method='', $group=0, $type = 0, $extend = array()
		}
		foreach($works as $key => $value){
			$value['projects'] = $eps[$key];
			$works[$key] = $value;
		}
		return $works;
	}
}
?>
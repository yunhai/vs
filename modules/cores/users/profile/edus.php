<?php
global $vsStd;
require_once(CORE_PATH."users/profile/Edu.class.php");


class edus extends VSFObject{
	function __construct(){
		parent::__construct();
		
		$this->primaryField 	= 'eduId';
		$this->basicClassName 	= 'Edu';
		$this->tableName 		= 'user_edu';
		
		$this->obj = $this->createBasicObject();
	}
	
	function getUserMainEdu($user = 0){
		if(!$user) return array();
		
		$cond = 'eduUser = '.$user.' AND eduMain = 1';
		$this->setCondition($cond);
		$edus = $this->getArrayByCondition('eduId');
		return current($edus);
	}
	
	function getUserEdu($user = 0){
		if(!$user) return array();
		
		$cond = 'eduUser = '.$user;
		$this->setCondition($cond);
		$edus = $this->getArrayByCondition('eduId');
		$eduIds = implode(',', array_keys($edus));
		
		if($eduIds){
			$this->setTableName('user_edu_project');
			$cond = 'epEdu IN ('.$eduIds.')';
			$this->setCondition($cond);
			$this->setOrder('epId');
			$eps = $this->getArrayByCondition('epId', 'epEdu');//$method='', $group=0, $type = 0, $extend = array()
		}
		$return = array(); $tarray = array('normalschool', 'mainschool');
		foreach($edus as $key => $value){
			$value['projects'] = $eps[$key];
			$return[$tarray[$value['eduMain']]][$key] = $value;
		}
		return $return;
	}

	function getUserEdu2($user = 0){ // khong co phan chia main school hay la normal school
		if(!$user) return array();
		
		$cond = 'eduUser = '.$user;
		$this->setCondition($cond);
		$edus = $this->getArrayByCondition('eduId');
		$eduIds = implode(',', array_keys($edus));
		
		if($eduIds){
			$this->setTableName('user_edu_project');
			$cond = 'epEdu IN ('.$eduIds.')';
			$this->setCondition($cond);
			$this->setOrder('epId');
			$eps = $this->getArrayByCondition('epId', 'epEdu');//$method='', $group=0, $type = 0, $extend = array()
		}

		foreach($edus as $key => $value){
			$value['projects'] = $eps[$key];
			$edus[$key] = $value;
		}
		return $edus;
	}

	
	
}
?>
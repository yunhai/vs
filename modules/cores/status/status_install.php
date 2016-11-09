<?php
/*
+-----------------------------------------------------------------------------
|   VIET SOLUTION SJC  base on IPB Code version 3.3.4.1
|	Author: tongnguyen
|	Start Date: 19/05/2009
|	Finish Date: 20/05/2009
|	moduleName Description: This module is for management all component in system.
+-----------------------------------------------------------------------------
*/

class status_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	public $tableName = "status";
	public $moduleTitle = "status";
	function Install() {
		
		
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) VALUES 
			('Manage Status','".$this->version."',1,1,'This is a system module for management all {$this->moduleTitle}  for VS Framework.','{$this->moduleTitle}');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleClass`='{$this->moduleTitle}'";
		$this->query[] = "DROP TABLE `".SQL_PREFIX."{$this->tableName}`";
	}
}
?>
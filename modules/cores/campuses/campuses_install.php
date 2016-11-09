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

class campuses_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	public $tableName = "campus";
	public $moduleTitle = "campuses";
	function Install() {
		$this->query[] = "DROP TABLE IF EXISTS`".SQL_PREFIX."{$this->tableName}`";
		$this->query[] = "
			 CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."campus` (
			  `campusId` mediumint(10) NOT NULL AUTO_INCREMENT,
			  `campusTitle` varchar(64) NOT NULL,
			  `campusAddress` varchar(128) NOT NULL,
			  `campusPhone` varchar(16) NOT NULL,
			  `campusStatus` tinyint(4) NOT NULL,
			  PRIMARY KEY (`campusId`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		";
		
		
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) VALUES 
			('Manage campus','".$this->version."',1,1,'This is a system module for management all {$this->moduleTitle}  for VS Framework.','{$this->moduleTitle}');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleClass`='{$this->moduleTitle}'";
		$this->query[] = "DROP TABLE `".SQL_PREFIX."{$this->tableName}`";
	}
}
?>
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

class textbooks_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	public $tableName = "textbook";
	public $moduleTitle = "textbooks";
	function Install() {
		$this->query[] = "DROP TABLE IF EXISTS`".SQL_PREFIX."{$this->tableName}`";
		$this->query[] = "
			 CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."textbook` (
				  `bookId` int(10) NOT NULL AUTO_INCREMENT,
				  `bookISBN` varchar(13) NOT NULL,
				  `bookISBN10` varchar(10) NOT NULL,
				  `bookTitle` varchar(256) NOT NULL,
				  `bookAuthor` varchar(256) NOT NULL,
				  `bookEdition` varchar(16) NOT NULL,
				  `bookCondition` tinyint(4) NOT NULL,
				  `bookPrice` float NOT NULL,
				  `bookPage` int(5) NOT NULL,
				  `bookPublisher` varchar(128) NOT NULL,
				  `bookRelease` varchar(16) NOT NULL,
				  `bookSubject` int(10) NOT NULL,
				  `bookUserId` int(10) NOT NULL,
				  `bookCampusId` int(10) NOT NULL,
				  `bookCourse` varchar(256) NOT NULL,
				  `bookImage` int(10) NOT NULL,
				  `bookContent` text NOT NULL,
				  `bookStatus` tinyint(4) NOT NULL,
				  `bookSold` mediumint(10) NOT NULL,
				  PRIMARY KEY (`bookId`)
				) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		";
		
		
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) VALUES 
			('Manage textbook','".$this->version."',1,1,'This is a system module for management all {$this->moduleTitle}  for VS Framework.','{$this->moduleTitle}');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleClass`='{$this->moduleTitle}'";
		$this->query[] = "DROP TABLE `".SQL_PREFIX."{$this->tableName}`";
	}
}
?>
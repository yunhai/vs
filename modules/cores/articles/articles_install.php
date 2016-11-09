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

class articles_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";

	function Install(){
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."article;";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."article` (
			  `pageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `pageCatId` int(10) NOT NULL DEFAULT '0',
			  `pageTitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
			  `pageIntro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			  `pageImage` int(10) DEFAULT NULL,
			  `pageContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			  `pagePostDate` int(10) NOT NULL DEFAULT '0',
			  `pageTime` int(10) NOT NULL DEFAULT '0',
			  `pageStatus` tinyint(4) NOT NULL DEFAULT '0',
			  `pageIndex` tinyint(4) NOT NULL DEFAULT '0',
			  `pageCode` varchar(100) NOT NULL DEFAULT '0',
			  PRIMARY KEY (`pageId`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		";

		$this->query[] = "DROP TABLE IF EXISTS `".SQL_PREFIX."page_category`;";


		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) values 
			('Article Manager','".$this->version."', 1, 1, 'This is a system module for management all page for VS Framework.','articles');
		";
	}

	function Uninstall($moduleId) {
		$this->query[] = "DROP TABLE `".SQL_PREFIX."page`";
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleId`=".$moduleId;
		$this->query[] = "DELETE FROM `".SQL_PREFIX."menu` WHERE `menuTitle`='article' and `parentId`=18";
	}
}
?>
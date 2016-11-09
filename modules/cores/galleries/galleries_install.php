<?php
/**
 *
 * @author Sanh Nguyen
 * @version
 */


class galleries_install {
	public $query = "";
	public $version = "3.4.1";
	public $build = "634";

	function Install() {
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."gallery";
		$this->query[] = "
			INSERT INTO ".SQL_PREFIX."module(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) values 
			('Manage Galleries','".$this->version."',1,1,'This is a system module for management all menu links in VS Framework.', 'galleries')
		";
	}

	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleId`=".$moduleId;
	}
}

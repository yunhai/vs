<?php


class search_install {
	public $query = "";
	public $version = "3.4.1";
	public $build = "634";

	function Install() {
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."search";
		$this->query[] = "
			INSERT INTO ".SQL_PREFIX."module(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) values 
			('Manage Search','".$this->version."',1,1,'Search module', 'search')
		";
	}

	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleId`=".$moduleId;
	}
}
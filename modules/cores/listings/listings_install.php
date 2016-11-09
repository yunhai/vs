<?php
class listings_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	
	function Install(){
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) values 
			('Listing Manager','".$this->version."', 1, 1,'','listings');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleClass`='listings'";
		$this->query[] = "DELETE FROM `".SQL_PREFIX."menu` WHERE `menuTitle`='listings'";
	}
}
?>
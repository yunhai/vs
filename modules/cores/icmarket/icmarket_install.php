<?php
class classifieds_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	
	function Install(){
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) values 
			('Classified Manager','".$this->version."', 1, 1,'','classifieds');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleClass`='classifieds'";
		$this->query[] = "DELETE FROM `".SQL_PREFIX."menu` WHERE `menuTitle`='classifieds'";
	}
}
?>
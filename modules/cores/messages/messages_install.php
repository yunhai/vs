<?php

class messages_install {
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	public $tableName = "message";
	public $moduleTitle = "messages";
	function Install() {
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX.$this->tableName;
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS ".SQL_PREFIX.$this->tableName." (
			  `messageId` int(10) NOT NULL AUTO_INCREMENT,
			  `messageContent` text,
			  `messageFiles` varchar(256) DEFAULT NULL,
			  `messagePostdate` int(10) DEFAULT NULL,
			  `messageStatus` tinyint(4) DEFAULT NULL,
			  `messageType` tinyint(2) DEFAULT NULL,
			  `messageOriginal` int(10) DEFAULT NULL,
			  `messageUser` int(10) DEFAULT NULL,
			  `messageGroup` int(10) NOT NULL,
			  PRIMARY KEY (`messageId`),
			  KEY `messageOriginal` (`messageOriginal`),
			  KEY `messageUser` (`messageUser`),
			  KEY `messageGroup` (`messageGroup`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."message_deliver";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."message_deliver` (
			  `deliverId` int(10) NOT NULL AUTO_INCREMENT,
			  `deliverMessage` int(10) NOT NULL,
			  `deliverRecipient` int(10) DEFAULT NULL,
			  `deliverPostdate` int(10) DEFAULT NULL,
			  `deliverStatus` tinyint(4) DEFAULT NULL,
			  PRIMARY KEY (`deliverId`),
			  KEY `deliverReceiver` (`deliverRecipient`),
  			  KEY `deliverMessage` (`deliverMessage`,`deliverRecipient`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."message_draft";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS ".SQL_PREFIX."vsf_message_draft (
			  `draftId` int(10) NOT NULL AUTO_INCREMENT,
			  `draftPostdate` int(11) NOT NULL,
			  `draftTitle` varchar(1024) DEFAULT NULL,
			  `draftContent` text,
			  `draftRecipient` varchar(256) DEFAULT NULL,
			  `draftOriginal` int(10) DEFAULT NULL,
			  `draftFiles` varchar(128) DEFAULT NULL,
			  `draftType` tinyint(4) DEFAULT NULL,
			  `draftUser` int(10) DEFAULT NULL,
			  `draftGroup` int(10) NOT NULL,
			  `draftMessage` int(10) NOT NULL,
			  PRIMARY KEY (`draftId`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."message_file";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."message_file` (
			  `objectId` varchar(56) NOT NULL,
			  `relId` varchar(56) NOT NULL,
			  KEY `objectId` (`objectId`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;
		";
		
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."message_group";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."message_group` (
			  `groupId` int(10) NOT NULL AUTO_INCREMENT,
			  `groupTitle` varchar(1024) NOT NULL,
			  PRIMARY KEY (`groupId`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."message_label";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."message_label` (
			  `labelId` int(10) NOT NULL AUTO_INCREMENT,
			  `labelUser` int(10) NOT NULL,
			  `labelTitle` varchar(128) NOT NULL,
			  `labelStatus` tinyint(8) NOT NULL,
			  PRIMARY KEY (`labelId`),
			  KEY `labelId` (`labelId`,`labelTitle`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		
		$this->query[] = "DROP TABLE IF EXISTS ".SQL_PREFIX."message_labelm";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."message_labelm` (
			  `lmId` int(10) NOT NULL AUTO_INCREMENT,
			  `lmLabel` int(10) NOT NULL,
			  `lmMessage` int(10) NOT NULL,
			  `lmType` int(10) NOT NULL,
			  PRIMARY KEY (`lmId`),
			  KEY `messageId` (`lmMessage`,`lmType`),
			  KEY `messageId` (`lmMessage`,`lmType`),
  			  KEY `lmLabel` (`lmLabel`,`lmMessage`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
		";
		
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) VALUES 
			('Manage message','".$this->version."',1,1,'This is a system module for management all {$this->moduleTitle}  for VS Framework.','{$this->moduleTitle}');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleClass`='{$this->moduleTitle}'";
		$this->query[] = "DROP TABLE ".SQL_PREFIX.$this->tableName;
		$this->query[] = "DROP TABLE ".SQL_PREFIX."message_deliver";
	}
}
?>
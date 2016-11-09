<?php
class orders_install{
	public $query = "";
	public $version = "3.3.4.1";
	public $build = "628";
	
	function Install() {
		$this->query[] = "DROP TABLE IF EXISTS `".SQL_PREFIX."order`;";
		$this->query[] = "DROP TABLE IF EXISTS `".SQL_PREFIX."order_items`;";
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."order` (
			 `orderId` smallint(5) NOT NULL AUTO_INCREMENT,
			  `orderName` varchar(250) DEFAULT NULL,
			  `userId` int(10) DEFAULT NULL,
			  `orderAddress` varchar(250) DEFAULT NULL,
			  `orderEmail` varchar(150) DEFAULT NULL,
			  `orderInfo` text,
			  `orderTime` int(10) DEFAULT NULL,
			  `orderPhone` varchar(15) DEFAULT NULL,
			  `seoId` int(255) DEFAULT NULL,
			  PRIMARY KEY (`orderId`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		";
		
		$this->query[] = "
			CREATE TABLE IF NOT EXISTS `".SQL_PREFIX."order_item` (
			  `itemId` int(10) NOT NULL AUTO_INCREMENT,
			  `orderId` int(10) NOT NULL,
			  `itemTitle` varchar(250) NOT NULL,
			  `productId` int(10) NOT NULL,
			  `itemQuantity` smallint(5) NOT NULL,
			  `itemPrice` int(10) NOT NULL,
			  `itemSaleOff` varchar(20) NOT NULL,
			  `itemDate` int(10) DEFAULT NULL,
			  `itemStatus` varchar(100) DEFAULT NULL,
			  `itemInfo` varchar(200) DEFAULT NULL,
			  PRIMARY KEY (`itemId`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		";
		$this->query[] = "
			INSERT INTO `".SQL_PREFIX."module`(`moduleTitle`,`moduleVersion`,`moduleIsAdmin`,`moduleIsUser`,`moduleIntro`,`moduleClass`) values 
			('Order','".$this->version."',1,1,'This is a system module for management all Order for VS Framework.','orders');
		";
	}
	
	function Uninstall($moduleId) {
		$this->query[] = "DELETE FROM `".SQL_PREFIX."module` WHERE `moduleId`=".$moduleId;
		$this->query[] = "DROP TABLE IF EXISTS `".SQL_PREFIX."order`;";
		$this->query[] = "DROP TABLE IF EXISTS `".SQL_PREFIX."order_items`;";
	}
}
?>
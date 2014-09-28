-- phpMyAdmin SQL Dump
-- version 4.2.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 28, 2014 at 02:53 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nail`
--

-- --------------------------------------------------------

--
-- Table structure for table `vsf_acp_help`
--

CREATE TABLE IF NOT EXISTS `vsf_acp_help` (
`id` int(10) NOT NULL,
  `langId` smallint(4) NOT NULL,
  `module_key` varchar(255) NOT NULL,
  `help_title` varchar(255) NOT NULL,
  `help_body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin`
--

CREATE TABLE IF NOT EXISTS `vsf_admin` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastLogin` int(10) DEFAULT '0' COMMENT 'Last login time',
  `joinDate` int(10) DEFAULT '0' COMMENT 'Created time',
  `status` tinyint(1) DEFAULT '1' COMMENT 'Lock or not',
  `index` tinyint(4) DEFAULT NULL,
  `images` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `vsf_admin`
--

INSERT INTO `vsf_admin` (`id`, `name`, `address`, `email`, `phone`, `password`, `lastLogin`, `joinDate`, `status`, `index`, `images`) VALUES
(10, 'vietsol', '26 yên thế', 'root@vietsol.net', '123123', '37f2004c999fd47458ddb1b8389a0cd1', 1411302206, 1317969079, 1, 0, NULL),
(27, 'admin', '', 'admin@tuyenbui.com', '', '21232f297a57a5a743894a0e4a801fc3', 1410361029, 1317969079, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admingroup`
--

CREATE TABLE IF NOT EXISTS `vsf_admingroup` (
`id` smallint(4) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `homepath` varchar(128) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `vsf_admingroup`
--

INSERT INTO `vsf_admingroup` (`id`, `name`, `intro`, `homepath`, `default`) VALUES
(1, 'root', 'Nhóm Quản trị viên', 'admins', 0),
(8, 'Quản trị web', 'Quản trị web', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin_group`
--

CREATE TABLE IF NOT EXISTS `vsf_admin_group` (
  `adminId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vsf_admin_group`
--

INSERT INTO `vsf_admin_group` (`adminId`, `groupId`) VALUES
(1, 1),
(2, 3),
(2, 2),
(29, 2),
(29, 5),
(10, 3),
(33, 8),
(43, 8),
(10, 1),
(34, 8),
(35, 1),
(38, 8),
(39, 8),
(40, 1),
(41, 8),
(42, 8),
(27, 8),
(44, 8);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin_permission`
--

CREATE TABLE IF NOT EXISTS `vsf_admin_permission` (
  `groupId` int(11) NOT NULL,
  `permission` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `grant` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vsf_admin_permission`
--

INSERT INTO `vsf_admin_permission` (`groupId`, `permission`, `grant`) VALUES
(4, 'products_access_module', 0),
(2, 'orders_access_module', 0),
(2, 'menu_show_7', 0),
(2, 'menu_show_316', 0),
(2, 'menu_show_2', 0),
(3, 'posts_cate_183', 0),
(3, 'posts_cate_182', 0),
(3, 'posts_cate_300', 0),
(3, 'posts_delete_post', 0),
(3, 'posts_add_post', 0),
(3, 'posts_edit_other_userpost', 0),
(2, 'menu_show_271', 0),
(2, 'posts_add_post', 0),
(2, 'posts_access_module', 0),
(2, 'posts_subject_manager', 0),
(2, 'products_access_module', 0),
(5, 'posts_cate_300', 0),
(4, 'orders_access_module', 0),
(2, 'admins_access_module', 0),
(3, 'posts_cate_181', 0),
(3, 'posts_cate_180', 0),
(3, 'posts_edit_post', 0),
(3, 'posts_public_post', 0),
(3, 'posts_cate_manager', 0),
(3, 'posts_receive_notify_post', 0),
(3, 'posts_subject_manager', 0),
(3, 'posts_access_module', 0),
(10, 'langs_access_module', 0),
(8, 'admins_account_manager', 0),
(8, 'menu_show_510', 0),
(8, 'menu_show_531', 0),
(8, 'menu_show_534', 0),
(8, 'menu_show_533', 0),
(8, 'menu_show_532', 0),
(8, 'menu_show_515', 0),
(8, 'menu_show_537', 0),
(8, 'menu_show_536', 0),
(8, 'menu_show_535', 0),
(8, 'menu_show_9', 0),
(8, 'menus_access_module', 0),
(8, 'posts_access_module', 0),
(8, 'products_access_module', 0),
(8, 'configs_access_module', 0),
(8, 'menu_show_287', 0),
(8, 'settings_access_module', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin_session`
--

CREATE TABLE IF NOT EXISTS `vsf_admin_session` (
`sessionId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `sessionCode` varchar(32) NOT NULL,
  `sessionTime` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5663 ;

--
-- Dumping data for table `vsf_admin_session`
--

INSERT INTO `vsf_admin_session` (`sessionId`, `adminId`, `sessionCode`, `sessionTime`) VALUES
(5662, 10, '82d99e0d7b05a36c31e17829957d1777', 1411310569);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_banner`
--

CREATE TABLE IF NOT EXISTS `vsf_banner` (
`id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `index` int(11) NOT NULL,
  `video` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `vsf_banner`
--

INSERT INTO `vsf_banner` (`id`, `catId`, `title`, `intro`, `content`, `url`, `image`, `position`, `status`, `index`, `video`) VALUES
(29, 41, 'Banner 2', '', '', 'http://google.com', 3509, 11, 1, 0, NULL),
(28, 41, 'Banner 1', '', '', 'http://', 3508, 11, 1, 0, NULL),
(30, 41, 'top 1', '', '', '', 3511, 10, 1, 1, NULL),
(31, 41, 'top 2', '', '', '', 3512, 10, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_bannerpo`
--

CREATE TABLE IF NOT EXISTS `vsf_bannerpo` (
`id` int(11) NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(2048) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vsf_bannerpo`
--

INSERT INTO `vsf_bannerpo` (`id`, `title`, `image`, `index`, `status`, `code`, `intro`) VALUES
(10, 'top', 0, 0, 1, 'BANNER_TOP', 'ádsdsd'),
(11, 'right', 0, 2, 1, 'BANNER_RIGHT', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_comment`
--

CREATE TABLE IF NOT EXISTS `vsf_comment` (
`id` int(11) NOT NULL,
  `objId` int(10) NOT NULL,
  `catId` int(10) NOT NULL,
  `title` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` int(10) NOT NULL,
  `module` varchar(50) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postdate` int(10) NOT NULL,
  `lastUpdate` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 deleted,1 unapprove, 2 approve',
  `userId` int(10) NOT NULL,
  `poster` text NOT NULL,
  `profile` text NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `like` int(11) DEFAULT '0',
  `parentId` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_components`
--

CREATE TABLE IF NOT EXISTS `vsf_components` (
`comId` smallint(4) NOT NULL,
  `comName` varchar(64) NOT NULL DEFAULT '',
  `comPackage` varchar(32) NOT NULL DEFAULT '',
  `comInstalled` tinyint(1) NOT NULL,
  `comDescription` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vsf_components`
--

INSERT INTO `vsf_components` (`comId`, `comName`, `comPackage`, `comInstalled`, `comDescription`) VALUES
(1, 'SEO', 'SEO', 1, 'seo site');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_config`
--

CREATE TABLE IF NOT EXISTS `vsf_config` (
`id` int(10) unsigned NOT NULL,
  `catId` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postDate` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `index` tinyint(4) NOT NULL DEFAULT '0',
  `code` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mKeyWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mIntro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `vsf_config`
--

INSERT INTO `vsf_config` (`id`, `catId`, `title`, `intro`, `image`, `content`, `postDate`, `status`, `index`, `code`, `module`, `mTitle`, `mKeyWord`, `mIntro`, `mUrl`) VALUES
(130, 0, 'hotline', '', NULL, '', 1386731574, 1, 0, '123214234234', 'configs', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_contact`
--

CREATE TABLE IF NOT EXISTS `vsf_contact` (
`id` smallint(4) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(1024) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `reply` smallint(1) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `postDate` text NOT NULL,
  `company` varchar(128) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vsf_contact`
--

INSERT INTO `vsf_contact` (`id`, `name`, `profile`, `phone`, `email`, `title`, `address`, `status`, `reply`, `type`, `content`, `postDate`, `company`) VALUES
(1, 'hoten', NULL, 'dienthoai', 'email@email.com', 'Nail | tieude', 'diachi', 0, 0, 0, 'noi dung', '1409648836', ''),
(2, 'hoten', NULL, '09090990', 'yunhai@gmail.com', 'Nail | tieude', 'diachi', 0, 0, 0, 'fdafsff', '1409650541', ''),
(3, 'hoten', NULL, '09090990', 'yunhai@gmail.com', 'Nail | tieude', 'diachi', 0, 0, 0, 'fdfdafd', '1409650888', ''),
(4, 'hoten', NULL, '09090990', 'yunhai@gmail.com', 'Nail | tieude', 'diachi', 0, 0, 0, 'fdfdafd', '1409651128', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_counter`
--

CREATE TABLE IF NOT EXISTS `vsf_counter` (
`id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `code` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `title` varchar(240) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `vsf_counter`
--

INSERT INTO `vsf_counter` (`id`, `userId`, `code`, `count`, `title`) VALUES
(16, 28, 'friend', 0, 'no_title'),
(17, 28, 'photos', 5, 'no_title'),
(18, 28, 'comment', 21, 'no_title'),
(19, 28, 'like', 0, 'no_title'),
(20, 28, 'view', 73, 'no_title'),
(21, 28, 'point', 0, 'no_title'),
(22, 28, 'checkin', 0, 'no_title'),
(23, 28, 'add_send', 0, 'no_title'),
(24, 28, 'add_inbox', 0, 'no_title'),
(25, 28, 'success', 0, 'no_title');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_counter_log`
--

CREATE TABLE IF NOT EXISTS `vsf_counter_log` (
  `time` int(10) unsigned NOT NULL,
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `guests` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `members` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bots` mediumint(8) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vsf_counter_log`
--

INSERT INTO `vsf_counter_log` (`time`, `visits`, `guests`, `members`, `bots`) VALUES
(1395212100, 1, 1, 1, 0),
(1395729300, 1, 1, 1, 0),
(1395729600, 1, 1, 1, 0),
(1395729900, 1, 1, 1, 0),
(1395730200, 1, 1, 1, 0),
(1395730500, 1, 1, 1, 0),
(1395730800, 1, 1, 1, 0),
(1395731400, 1, 1, 1, 0),
(1395731700, 1, 1, 1, 0),
(1395732000, 1, 1, 1, 0),
(1395732300, 1, 1, 1, 0),
(1395732600, 1, 1, 1, 0),
(1395732900, 1, 1, 1, 0),
(1395733200, 1, 1, 1, 0),
(1395733500, 1, 1, 1, 0),
(1395733800, 1, 1, 1, 0),
(1395734100, 1, 1, 1, 0),
(1395734400, 1, 1, 1, 0),
(1395734700, 1, 1, 1, 0),
(1395735000, 1, 1, 1, 0),
(1395735300, 1, 1, 1, 0),
(1395735600, 1, 1, 1, 0),
(1395735900, 1, 1, 1, 0),
(1395736200, 1, 1, 1, 0),
(1395803400, 1, 1, 1, 0),
(1395803700, 1, 1, 1, 0),
(1395804000, 1, 1, 1, 0),
(1395804300, 1, 1, 1, 0),
(1395808800, 1, 1, 1, 0),
(1396252500, 2, 2, 2, 0),
(1396252800, 1, 1, 1, 0),
(1396579500, 1, 1, 1, 0),
(1397533200, 1, 1, 1, 0),
(1398666600, 1, 1, 1, 0),
(1401096000, 1, 1, 1, 0),
(1401606600, 1, 1, 1, 0),
(1404288600, 1, 1, 1, 0),
(1404968400, 1, 1, 1, 0),
(1404968700, 1, 1, 1, 0),
(1404972600, 1, 1, 1, 0),
(1404972900, 1, 1, 1, 0),
(1405186200, 1, 1, 1, 0),
(1405186500, 1, 1, 1, 0),
(1406431800, 1, 1, 1, 0),
(1406432100, 1, 1, 1, 0),
(1406432400, 1, 1, 1, 0),
(1406556900, 1, 1, 1, 0),
(1408281900, 1, 1, 1, 0),
(1408518900, 1, 1, 1, 0),
(1408519200, 1, 1, 1, 0),
(1408519500, 1, 1, 1, 0),
(1408519800, 1, 1, 1, 0),
(1408520100, 1, 1, 1, 0),
(1408520700, 1, 1, 1, 0),
(1408521300, 1, 1, 1, 0),
(1408521600, 1, 1, 1, 0),
(1408521900, 1, 1, 1, 0),
(1408522200, 1, 1, 1, 0),
(1408522500, 1, 1, 1, 0),
(1408522800, 1, 1, 1, 0),
(1408523100, 1, 1, 1, 0),
(1408523400, 1, 1, 1, 0),
(1408523700, 1, 1, 1, 0),
(1408524000, 1, 1, 1, 0),
(1408524300, 1, 1, 1, 0),
(1408524600, 1, 1, 1, 0),
(1408524900, 1, 1, 1, 0),
(1408525200, 1, 1, 1, 0),
(1408525500, 1, 1, 1, 0),
(1408525800, 1, 1, 1, 0),
(1408526100, 1, 1, 1, 0),
(1408526400, 1, 1, 1, 0),
(1408526700, 1, 1, 1, 0),
(1408527000, 1, 1, 1, 0),
(1408528800, 1, 1, 1, 0),
(1408529700, 1, 1, 1, 0),
(1408530000, 1, 1, 1, 0),
(1408530900, 1, 1, 1, 0),
(1408531200, 1, 1, 1, 0),
(1408531500, 1, 1, 1, 0),
(1408531800, 1, 1, 1, 0),
(1408532100, 1, 1, 1, 0),
(1408533000, 1, 1, 1, 0),
(1408534500, 1, 1, 1, 0),
(1408534800, 1, 1, 1, 0),
(1408538400, 2, 2, 2, 0),
(1408539000, 4, 4, 4, 0),
(1408542900, 1, 1, 1, 0),
(1408545300, 1, 1, 1, 0),
(1408545600, 1, 1, 1, 0),
(1408545900, 1, 1, 1, 0),
(1408546200, 1, 1, 1, 0),
(1408546500, 1, 1, 1, 0),
(1408546800, 1, 1, 1, 0),
(1408547100, 1, 1, 1, 0),
(1408547700, 1, 1, 1, 0),
(1408548000, 1, 1, 1, 0),
(1408548600, 1, 1, 1, 0),
(1408614900, 1, 1, 1, 0),
(1408860300, 1, 1, 1, 0),
(1408868100, 1, 1, 1, 0),
(1408870800, 1, 1, 1, 0),
(1408871100, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_file`
--

CREATE TABLE IF NOT EXISTS `vsf_file` (
`id` int(10) unsigned NOT NULL,
  `module` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uploadTime` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(1) DEFAULT NULL,
  `index` smallint(4) DEFAULT NULL,
  `pass` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `userId` smallint(4) DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `objId` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3752 ;

--
-- Dumping data for table `vsf_file`
--

INSERT INTO `vsf_file` (`id`, `module`, `title`, `name`, `intro`, `type`, `size`, `uploadTime`, `path`, `status`, `index`, `pass`, `userId`, `url`, `objId`) VALUES
(3110, 'menus', 'lighthouse', 'lighthouse', 'lighthouse', 'jpg', 561276, 1383809927, 'menus/2013/11/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3107, 'menus', 'lighthouse', 'lighthouse_0', 'lighthouse', 'jpg', 561276, 1383809872, 'menus/2013/11/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3343, 'slidebanners', 'vn1', 'vn1_0', 'vn1', 'jpg', 264991, 1388385263, 'slidebanners/2013/12/30/', NULL, NULL, NULL, NULL, NULL, NULL),
(3119, 'logos', 'penguins', 'penguins', 'penguins', 'jpg', 777835, 1385371793, 'logos/2013/11/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3214, 'news', 'test', 'test', 'test', 'jpg', 109936, 1386919430, 'news/2013/12/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3121, 'logos', 'logo', 'logo', 'logo', 'png', 2253, 1385436693, 'logos/2013/11/26/', NULL, NULL, NULL, NULL, NULL, NULL),
(3123, NULL, 'chrysanthemum', 'chrysanthemum', 'chrysanthemum', 'jpg', 879394, 1385523975, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3124, NULL, 'chrysanthemum', 'chrysanthemum_0', 'chrysanthemum', 'jpg', 879394, 1385524026, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3125, NULL, 'desert', 'desert', 'desert', 'jpg', 845941, 1385524050, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3126, NULL, 'desert', 'desert_0', 'desert', 'jpg', 845941, 1385524401, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3127, NULL, 'chrysanthemum', 'chrysanthemum_1', 'chrysanthemum', 'jpg', 879394, 1385524444, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3128, NULL, 'chrysanthemum', 'chrysanthemum_2', 'chrysanthemum', 'jpg', 879394, 1385524474, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3129, NULL, 'chrysanthemum', 'chrysanthemum_3', 'chrysanthemum', 'jpg', 879394, 1385524511, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3130, NULL, 'chrysanthemum', 'chrysanthemum_4', 'chrysanthemum', 'jpg', 879394, 1385524546, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3131, NULL, 'chrysanthemum', 'chrysanthemum_5', 'chrysanthemum', 'jpg', 879394, 1385524591, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3132, NULL, 'chrysanthemum', 'chrysanthemum_6', 'chrysanthemum', 'jpg', 879394, 1385524621, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3133, NULL, 'chrysanthemum', 'chrysanthemum_7', 'chrysanthemum', 'jpg', 879394, 1385524636, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3134, NULL, 'chrysanthemum', 'chrysanthemum_8', 'chrysanthemum', 'jpg', 879394, 1385524729, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3135, NULL, 'chrysanthemum', 'chrysanthemum_9', 'chrysanthemum', 'jpg', 879394, 1385524751, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3136, NULL, 'chrysanthemum', 'chrysanthemum_10', 'chrysanthemum', 'jpg', 879394, 1385524912, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3137, NULL, 'chrysanthemum', 'chrysanthemum_11', 'chrysanthemum', 'jpg', 879394, 1385524932, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3138, NULL, 'chrysanthemum', 'chrysanthemum_12', 'chrysanthemum', 'jpg', 879394, 1385524955, 'memberUpload/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3181, NULL, 'koala', 'koala', 'koala', 'jpg', 780831, 1385536865, 'products/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3182, 'products', 'bg body', 'bg_body', 'bg body', 'jpg', 161134, 1385543406, 'products/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3183, 'products', 'bg body1', 'bg_body1', 'bg body1', 'jpg', 172544, 1385543430, 'products/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3184, 'products', 'news thumnail', 'news_thumnail', 'news thumnail', 'jpg', 1405, 1385543503, 'products/2013/11/27/', NULL, NULL, NULL, NULL, NULL, NULL),
(3266, 'logolefts', 'test', 'test_2', 'test', 'jpg', 3097, 1387273861, 'logolefts/2013/12/17/', NULL, NULL, NULL, NULL, NULL, NULL),
(3264, 'logolefts', 'test', 'test_0', 'test', 'jpg', 2550, 1387273617, 'logolefts/2013/12/17/', NULL, NULL, NULL, NULL, NULL, NULL),
(3263, 'logolefts', 'test', 'test', 'test', 'jpg', 1513, 1387273470, 'logolefts/2013/12/17/', NULL, NULL, NULL, NULL, NULL, NULL),
(3394, 'products', 'hkt030   1400k', 'hkt030_1400k', 'hkt030   1400k', 'jpg', 62031, 1389604917, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3357, 'products', 'im pro', 'im_pro_0', 'im pro', 'png', 69360, 1388632622, 'products/2014/01/02/', NULL, NULL, NULL, NULL, NULL, NULL),
(3395, 'products', 'hkt031   1600k', 'hkt031_1600k', 'hkt031   1600k', 'jpg', 169640, 1389604948, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3360, 'news', 'im news', 'im_news', 'im news', 'png', 19443, 1388734427, 'news/2014/01/03/', NULL, NULL, NULL, NULL, NULL, NULL),
(3428, 'news', 'bí quyết giữ hoa tươi lâu 3', 'bi_quyet_giu_hoa_tuoi_lau_3', 'bí quyết giữ hoa tươi lâu 3', 'jpg', 91802, 1390465110, 'news/2014/01/23/', NULL, NULL, NULL, NULL, NULL, NULL),
(3239, NULL, '2', '2_2', '2', 'jpg', 172201, 1387163608, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3225, NULL, '1', '1', '1', 'jpg', 62553, 1387161634, 'gallerys/2013/12/16/', NULL, 1, NULL, NULL, NULL, NULL),
(3219, 'news', 'test', 'test_3', 'test', 'jpg', 81348, 1386919854, 'news/2013/12/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3216, 'news', 'test', 'test_1', 'test', 'jpg', 44710, 1386919662, 'news/2013/12/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3215, 'news', 'test', 'test_0', 'test', 'jpg', 24795, 1386919463, 'news/2013/12/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3207, NULL, 'map', 'map', 'map', 'jpg', 90581, 1386750435, 'gallerys/2013/12/11/', NULL, 1, NULL, NULL, NULL, NULL),
(3208, NULL, 'img10', 'img10', 'img10', 'jpg', 17144, 1386750437, 'gallerys/2013/12/11/', NULL, 2, NULL, NULL, NULL, NULL),
(3209, NULL, 'news2', 'news2', 'news2', 'jpg', 25162, 1386750442, 'gallerys/2013/12/11/', NULL, 3, NULL, NULL, NULL, NULL),
(3210, NULL, 'news1', 'news1', 'news1', 'jpg', 17393, 1386750447, 'gallerys/2013/12/11/', NULL, 4, NULL, NULL, NULL, NULL),
(3269, 'services', 'video 20', 'video_20', 'video 20', 'jpg', 18040, 1387725671, 'services/2013/12/22/', NULL, NULL, NULL, NULL, NULL, NULL),
(3226, NULL, '2', '2', '2', 'jpg', 112364, 1387161634, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3218, 'news', 'test', 'test_2', 'test', 'jpg', 19988, 1386919723, 'news/2013/12/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3227, NULL, '3', '3', '3', 'jpg', 214831, 1387161634, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3230, NULL, '2', '2_0', '2', 'jpg', 112364, 1387161808, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3231, NULL, '3', '3_0', '3', 'jpg', 214831, 1387161808, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3233, NULL, '1', '1_0', '1', 'jpg', 62553, 1387163232, 'gallerys/2013/12/16/', NULL, 1, NULL, NULL, NULL, NULL),
(3234, NULL, '2', '2_1', '2', 'jpg', 112364, 1387163232, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3235, NULL, '3', '3_1', '3', 'jpg', 214831, 1387163233, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3240, NULL, '3', '3_2', '3', 'jpg', 176674, 1387163608, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3241, NULL, '4', '4', '4', 'jpg', 129371, 1387163608, 'gallerys/2013/12/16/', NULL, 4, NULL, NULL, NULL, NULL),
(3243, NULL, '1', '1_1', '1', 'jpg', 98580, 1387163770, 'gallerys/2013/12/16/', NULL, 1, NULL, NULL, NULL, NULL),
(3244, NULL, '3', '3_3', '3', 'jpg', 176674, 1387163770, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3245, NULL, '4', '4_0', '4', 'jpg', 129371, 1387163771, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3247, NULL, '1', '1_2', '1', 'jpg', 98580, 1387163837, 'gallerys/2013/12/16/', NULL, 1, NULL, NULL, NULL, NULL),
(3248, NULL, '4', '4_1', '4', 'jpg', 129371, 1387163837, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3249, NULL, '2', '2_3', '2', 'jpg', 172201, 1387163838, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3251, NULL, '1', '1_3', '1', 'jpg', 98580, 1387163969, 'gallerys/2013/12/16/', NULL, 1, NULL, NULL, NULL, NULL),
(3252, NULL, '3', '3_4', '3', 'jpg', 176674, 1387163969, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3253, NULL, '2', '2_4', '2', 'jpg', 172201, 1387163970, 'gallerys/2013/12/16/', NULL, 3, NULL, NULL, NULL, NULL),
(3255, NULL, '2', '2_5', '2', 'jpg', 200254, 1387164292, 'gallerys/2013/12/16/', NULL, 1, NULL, NULL, NULL, NULL),
(3256, NULL, '3', '3_5', '3', 'jpg', 158007, 1387164292, 'gallerys/2013/12/16/', NULL, 2, NULL, NULL, NULL, NULL),
(3267, 'learn', 'imgflo', 'imgflo', 'imgflo', 'jpg', 3752, 1387704637, 'learn/2013/12/22/', NULL, NULL, NULL, NULL, NULL, NULL),
(3270, 'services', 'penguins', 'penguins', 'penguins', 'jpg', 777835, 1387839462, 'services/2013/12/23/', NULL, NULL, NULL, NULL, NULL, NULL),
(3271, 'services', 'lighthouse', 'lighthouse', 'lighthouse', 'jpg', 561276, 1387839490, 'services/2013/12/23/', NULL, NULL, NULL, NULL, NULL, NULL),
(3336, 'banners', 'lien he voi shop hoa tuoi', 'lien_he_voi_shop_hoa_tuoi_0', 'lien he voi shop hoa tuoi', 'png', 48738, 1388251435, 'banners/2013/12/29/', NULL, NULL, NULL, NULL, NULL, NULL),
(3274, 'callflower', 'tulips', 'tulips', 'tulips', 'jpg', 620888, 1387839647, 'callflower/2013/12/23/', NULL, NULL, NULL, NULL, NULL, NULL),
(3298, 'flower_japan', 'dsc 1616', 'dsc_1616', 'dsc 1616', 'jpg', 984675, 1387964622, 'flower_japan/2013/12/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3365, 'slidebanner', 'banner', 'banner', 'banner', 'png', 1176938, 1388807064, 'slidebanner/2014/01/04/', NULL, NULL, NULL, NULL, NULL, NULL),
(3366, 'slidebanner', 'banner', 'banner_0', 'banner', 'png', 1176938, 1388807075, 'slidebanner/2014/01/04/', NULL, NULL, NULL, NULL, NULL, NULL),
(3367, 'menus', 'bg flowerbottom', 'bg_flowerbottom', 'bg flowerbottom', 'png', 9384, 1388901257, 'products_category/2014/01/05/', NULL, NULL, NULL, NULL, NULL, NULL),
(3460, 'bxh', 'ngoaihanganh2 326x235', 'ngoaihanganh2_326x235', 'ngoaihanganh2 326x235', 'png', 174517, 1392972347, 'bxh/2014/02/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3372, 'customers', 'im cos', 'im_cos', 'im cos', 'png', 24358, 1388916783, 'customers/2014/01/05/', NULL, NULL, NULL, NULL, NULL, NULL),
(3370, 'banners', 'im ads', 'im_ads_1', 'im ads', 'png', 138021, 1388906435, 'banners/2014/01/05/', NULL, NULL, NULL, NULL, NULL, NULL),
(3384, 'menus', 'im hightlight', 'im_hightlight_0', 'im hightlight', 'png', 92389, 1389254084, 'products_category/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3382, 'customers', 'bidv', 'bidv', 'bidv', 'jpg', 4848, 1389226776, 'customers/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3381, 'customers', 'vietcombank', 'vietcombank', 'vietcombank', 'jpg', 7183, 1389226751, 'customers/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3377, 'menus', 'im hightlight', 'im_hightlight', 'im hightlight', 'png', 92389, 1388974081, 'products_category/2014/01/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3383, 'menus', 'im hightlight', 'im_hightlight', 'im hightlight', 'png', 92389, 1389254033, 'products_category/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3379, 'menus', 'im hightlight', 'im_hightlight_1', 'im hightlight', 'png', 92389, 1388974110, 'products_category/2014/01/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3330, 'services', 'dsc 1608', 'dsc_1608', 'dsc 1608', 'jpg', 976708, 1388045170, 'services/2013/12/26/', NULL, NULL, NULL, NULL, NULL, NULL),
(3338, 'banners', 'payoo', 'payoo', 'payoo', 'png', 37262, 1388306292, 'banners/2013/12/29/', NULL, NULL, NULL, NULL, NULL, NULL),
(3339, 'products', '20131228 161338 1', '20131228_161338_1', '20131228 161338 1', 'jpg', 1141890, 1388313755, 'products/2013/12/29/', NULL, NULL, NULL, NULL, NULL, NULL),
(3347, 'slidebanners', 'nguồn từ báo dân trí', 'nguon_tu_bao_dan_tri_1', 'nguồn từ báo dân trí', 'jpg', 458894, 1388385628, 'slidebanners/2013/12/30/', NULL, NULL, NULL, NULL, NULL, NULL),
(3380, 'customers', 'ngan hang dong a', 'ngan_hang_dong_a', 'ngan hang dong a', 'jpg', 6958, 1389226561, 'customers/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3385, 'menus', 'im hightlight', 'im_hightlight_1', 'im hightlight', 'png', 92389, 1389254095, 'products_category/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3386, 'menus', 'im hightlight', 'im_hightlight_2', 'im hightlight', 'png', 92389, 1389254133, 'products_category/2014/01/09/', NULL, NULL, NULL, NULL, NULL, NULL),
(3387, 'products', 'hoa chia buon01', 'hoa_chia_buon01', 'hoa chia buon01', 'jpg', 89752, 1389603795, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3388, 'products', 'hoa chia buon02', 'hoa_chia_buon02', 'hoa chia buon02', 'jpg', 233407, 1389603953, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3389, 'products', 'hoa chia buon3', 'hoa_chia_buon3', 'hoa chia buon3', 'jpg', 43376, 1389604011, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3390, 'products', '12', '12', '12', 'jpg', 52000, 1389604449, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3391, 'products', '16', '16', '16', 'jpg', 48613, 1389604483, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3392, 'products', '23', '23', '23', 'jpg', 86618, 1389604517, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3393, 'products', '11', '11', '11', 'jpg', 91671, 1389604547, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3396, 'products', 'img 1295   1000k', 'img_1295_1000k', 'img 1295   1000k', 'jpg', 82695, 1389604976, 'products/2014/01/13/', NULL, NULL, NULL, NULL, NULL, NULL),
(3412, 'slidebanner', '04', '04', '04', 'png', 567162, 1389669398, 'slidebanner/2014/01/14/', NULL, NULL, NULL, NULL, NULL, NULL),
(3413, 'slidebanner', '05', '05', '05', 'png', 695549, 1389669495, 'slidebanner/2014/01/14/', NULL, NULL, NULL, NULL, NULL, NULL),
(3414, 'menus', 'im hightlight', 'im_hightlight', 'im hightlight', 'png', 92389, 1389761597, 'products_category/2014/01/15/', NULL, NULL, NULL, NULL, NULL, NULL),
(3415, 'menus', 'sinhnhat', 'sinhnhat', 'sinhnhat', 'jpg', 28779, 1389761940, 'products_category/2014/01/15/', NULL, NULL, NULL, NULL, NULL, NULL),
(3416, 'menus', 'tieccuoi', 'tieccuoi', 'tieccuoi', 'jpg', 29040, 1389761952, 'products_category/2014/01/15/', NULL, NULL, NULL, NULL, NULL, NULL),
(3417, 'products', '01 850k', '01_850k', '01 850k', 'jpg', 37365, 1390298302, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3418, 'products', '02 1400k', '02_1400k', '02 1400k', 'jpg', 45971, 1390298364, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3419, 'products', '03 1000k', '03_1000k', '03 1000k', 'jpg', 35372, 1390298419, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3420, 'products', '04 900k', '04_900k', '04 900k', 'jpg', 24511, 1390298471, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3421, 'products', '05 1600k', '05_1600k', '05 1600k', 'jpg', 79098, 1390298514, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3422, 'products', '06 700k', '06_700k', '06 700k', 'jpg', 29364, 1390298550, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3423, 'products', '07 650k', '07_650k', '07 650k', 'jpg', 27734, 1390298579, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3424, 'products', '08 800k', '08_800k', '08 800k', 'jpg', 749927, 1390298609, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3425, 'products', '09 2000k', '09_2000k', '09 2000k', 'jpg', 654101, 1390298636, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3426, 'products', '10 1100k', '10_1100k', '10 1100k', 'jpg', 22689, 1390298663, 'products/2014/01/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3427, 'news', 'bao quan hoa cuoi 2', 'bao_quan_hoa_cuoi_2', 'bao quan hoa cuoi 2', 'jpg', 201546, 1390464308, 'news/2014/01/23/', NULL, NULL, NULL, NULL, NULL, NULL),
(3432, 'videos', 'im newvideo', 'im_newvideo', 'im newvideo', 'png', 36923, 1392691767, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3430, 'clubs', 'mu', 'mu', 'mu', 'jpg', 7889, 1392429939, 'clubs/2014/02/15/', NULL, NULL, NULL, NULL, NULL, NULL),
(3431, 'clubs', 'ars', 'ars', 'ars', 'jpg', 6817, 1392429976, 'clubs/2014/02/15/', NULL, NULL, NULL, NULL, NULL, NULL),
(3433, 'videos', 'ball', 'ball', 'ball', 'png', 2431, 1392692436, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3434, 'videos', 'wildlife', 'wildlife', 'wildlife', 'wmv', 16777215, 1392692792, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3435, 'videos', 'im newvideo', 'im_newvideo_0', 'im newvideo', 'png', 36923, 1392693080, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3436, 'videos', 'wildlife', 'wildlife_0', 'wildlife', 'wmv', 16777215, 1392693080, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3437, 'videos', 'im newvideo', 'im_newvideo_1', 'im newvideo', 'png', 36923, 1392693132, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3438, 'videos', 'wildlife', 'wildlife_1', 'wildlife', 'wmv', 16777215, 1392693132, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3439, 'videos', 'as long as you love me', 'as_long_as_you_love_me', 'as long as you love me', 'mp4', 16777215, 1392699578, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3440, 'videos', 'im newvideo', 'im_newvideo_2', 'im newvideo', 'png', 36923, 1392709426, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3441, 'videos', 'im newvideo', 'im_newvideo_3', 'im newvideo', 'png', 36923, 1392709445, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3442, 'videos', 'im newvideo', 'im_newvideo_4', 'im newvideo', 'png', 36923, 1392709522, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3443, 'videos', 'im newvideo', 'im_newvideo_5', 'im newvideo', 'png', 36923, 1392709570, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3446, 'videos', 'as long as you love me', 'as_long_as_you_love_me_1', 'as long as you love me', 'mp4', 16777215, 1392709850, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3448, 'posts', 'img album', 'img_album', 'img album', 'png', 185578, 1392782888, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3447, 'videos', 'try', 'try', 'try', 'jpg', 62964, 1392709862, 'videos/2014/02/18/', NULL, NULL, NULL, NULL, NULL, NULL),
(3449, 'posts', 'img album', 'img_album_0', 'img album', 'png', 185578, 1392782908, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3450, 'posts', 'img album', 'img_album_1', 'img album', 'png', 185578, 1392782949, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3451, 'posts', 'img album', 'img_album_2', 'img album', 'png', 185578, 1392782977, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3452, 'posts', 'img album', 'img_album_3', 'img album', 'png', 185578, 1392783023, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3453, 'posts', 'img album', 'img_album_4', 'img album', 'png', 185578, 1392783046, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3454, 'posts', 'img album', 'img_album_5', 'img album', 'png', 185578, 1392784738, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3455, 'posts', 'img album', 'img_album_6', 'img album', 'png', 185578, 1392784807, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3456, 'posts', 'img album', 'img_album_7', 'img album', 'png', 185578, 1392784830, 'posts/2014/02/19/', NULL, NULL, NULL, NULL, NULL, NULL),
(3457, 'expects', 'img album', 'img_album', 'img album', 'png', 185578, 1392881059, 'expects/2014/02/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3458, 'expects', 'img album', 'img_album_0', 'img album', 'png', 185578, 1392881093, 'expects/2014/02/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3509, 'banners', '15551561183894095 sz5zcsal f', '15551561183894095_sz5zcsal_f', '15551561183894095 sz5zcsal f', 'jpg', 47030, 1408544361, 'banners/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3461, 'bxh', 'ngoaihanganh2 326x235', 'ngoaihanganh2_326x235_0', 'ngoaihanganh2 326x235', 'png', 174517, 1392972361, 'bxh/2014/02/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3462, 'bxh', 'ngoaihanganh2 326x235', 'ngoaihanganh2_326x235_1', 'ngoaihanganh2 326x235', 'png', 174517, 1392972377, 'bxh/2014/02/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3463, 'slidebanner', 'try', 'try', 'try', 'jpg', 62964, 1393232765, 'slidebanner/2014/02/24/', NULL, NULL, NULL, NULL, NULL, NULL),
(3464, 'slidebanner', 'toc', 'toc', 'toc', 'jpg', 61917, 1393232957, 'slidebanner/2014/02/24/', NULL, NULL, NULL, NULL, NULL, NULL),
(3492, 'posts', 'im project', 'im_project', 'im project', 'png', 138335, 1395733361, 'posts/2014/03/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3493, 'posts', 'im project', 'im_project_0', 'im project', 'png', 138335, 1395735592, 'posts/2014/03/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3471, 'projects', 'im duan detail', 'im_duan_detail', 'im duan detail', 'png', 167010, 1395389851, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3472, 'projects', 'im duan detail', 'im_duan_detail_0', 'im duan detail', 'png', 167010, 1395389851, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3474, 'projects', 'bg detail', 'bg_detail', 'bg detail', 'png', 1207, 1395391589, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3476, 'projects', 'im duan detail', 'im_duan_detail_1', 'im duan detail', 'png', 167010, 1395392281, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3477, 'projects', 'im map', 'im_map', 'im map', 'png', 588213, 1395392282, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3478, 'projects', 'im duan detail', 'im_duan_detail_2', 'im duan detail', 'png', 167010, 1395392344, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3479, 'projects', 'im map', 'im_map_0', 'im map', 'png', 588213, 1395392344, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3480, 'projects', 'im duan detail', 'im_duan_detail_3', 'im duan detail', 'png', 167010, 1395392367, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3481, 'projects', 'im map', 'im_map_1', 'im map', 'png', 588213, 1395392367, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3482, 'projects', 'im duan detail', 'im_duan_detail_4', 'im duan detail', 'png', 167010, 1395392392, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3483, 'projects', 'im map', 'im_map_2', 'im map', 'png', 588213, 1395392392, 'projects/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3484, 'partners', 'im ads', 'im_ads', 'im ads', 'png', 30913, 1395394866, 'partners/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3485, 'ads', 'im ads', 'im_ads', 'im ads', 'png', 30913, 1395395193, 'ads/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3486, 'ads', 'im ads', 'im_ads_0', 'im ads', 'png', 30913, 1395395210, 'ads/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3487, 'ads', 'im ads', 'im_ads_1', 'im ads', 'png', 30913, 1395395231, 'ads/2014/03/21/', NULL, NULL, NULL, NULL, NULL, NULL),
(3488, 'videos', 'wildlife', 'wildlife', 'wildlife', 'wmv', 16777215, 1395570929, 'videos/2014/03/23/', NULL, NULL, NULL, NULL, NULL, NULL),
(3510, 'supports', '1266706115714525 audl7tzz f', '1266706115714525_audl7tzz_f', '1266706115714525 audl7tzz f', 'jpg', 40671, 1408545156, 'supports/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3497, 'posts', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'americanngorussia1_7f17a8195b2_2550_7896_1408522325', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'jpg', 55467, 1408540633, 'posts/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3498, 'posts', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'americanngorussia1_7f17a8195b2_2550_7896_1408522325_0', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'jpg', 55467, 1408540691, 'posts/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3499, 'posts', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'americanngorussia1_7f17a8195b2_2550_7896_1408522325_1', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'jpg', 55467, 1408540819, 'posts/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3500, 'posts', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'americanngorussia1_7f17a8195b2_2550_7896_1408522325_2', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'jpg', 55467, 1408540952, 'posts/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3501, 'posts', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'americanngorussia1_7f17a8195b2_2550_7896_1408522325_3', 'americanngorussia1 7f17a8195b2 2550 7896 1408522325', 'jpg', 55467, 1408540974, 'posts/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3502, NULL, '15551561183894095 sz5zcsal f', '15551561183894095_sz5zcsal_f', '15551561183894095 sz5zcsal f', 'jpg', 47030, 1408542481, 'gallerys/2014/08/20/', NULL, 1, NULL, NULL, NULL, NULL),
(3503, NULL, '1266706115714525 audl7tzz f', '1266706115714525_audl7tzz_f', '1266706115714525 audl7tzz f', 'jpg', 40671, 1408542482, 'gallerys/2014/08/20/', NULL, 2, NULL, NULL, NULL, NULL),
(3504, NULL, '32158584809927199 t4xeddse c', '32158584809927199_t4xeddse_c', '32158584809927199 t4xeddse c', 'jpg', 42414, 1408542483, 'gallerys/2014/08/20/', NULL, 3, NULL, NULL, NULL, NULL),
(3505, NULL, '34199278390902015 cgahq1tr f', '34199278_0902015_cgahq1tr_f', '34199278390902015 cgahq1tr f', 'jpg', 55058, 1408542484, 'gallerys/2014/08/20/', NULL, 4, NULL, NULL, NULL, NULL),
(3506, NULL, '34199278390906134 yodeicug f', '34199278_0906134_yodeicug_f', '34199278390906134 yodeicug f', 'jpg', 40355, 1408542485, 'gallerys/2014/08/20/', NULL, 5, NULL, NULL, NULL, NULL),
(3507, NULL, '61713457365572203 mx49t54f c', '61713457365572203_mx49t54f_c', '61713457365572203 mx49t54f c', 'jpg', 104921, 1408542487, 'gallerys/2014/08/20/', NULL, 6, NULL, NULL, NULL, NULL),
(3508, 'banners', '1266706115714525 audl7tzz f', '1266706115714525_audl7tzz_f', '1266706115714525 audl7tzz f', 'jpg', 40671, 1408544347, 'banners/2014/08/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3511, 'banners', 'banner', 'banner', 'banner', 'png', 45572, 1408893485, 'banners/2014/08/24/', NULL, NULL, NULL, NULL, NULL, NULL),
(3512, 'banners', 'banner2', 'banner2', 'banner2', 'png', 47813, 1408893495, 'banners/2014/08/24/', NULL, NULL, NULL, NULL, NULL, NULL),
(3513, NULL, '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1409991593, 'gallerys/2014/09/06/', NULL, 1, NULL, NULL, NULL, NULL),
(3514, NULL, '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1409991593, 'gallerys/2014/09/06/', NULL, 2, NULL, NULL, NULL, NULL),
(3515, NULL, '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1409991593, 'gallerys/2014/09/06/', NULL, 3, NULL, NULL, NULL, NULL),
(3516, NULL, '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1409991593, 'gallerys/2014/09/06/', NULL, 4, NULL, NULL, NULL, NULL),
(3517, NULL, '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c', '139189444703588266 pddyjcer c', 'jpg', 49064, 1409991593, 'gallerys/2014/09/06/', NULL, 5, NULL, NULL, NULL, NULL),
(3518, NULL, '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1409991593, 'gallerys/2014/09/06/', NULL, 6, NULL, NULL, NULL, NULL),
(3519, NULL, '150096600051454741 gofwjxws f', '150096600051454741_gofwjxws_f', '150096600051454741 gofwjxws f', 'jpg', 83670, 1409991594, 'gallerys/2014/09/06/', NULL, 7, NULL, NULL, NULL, NULL),
(3520, NULL, '150096600051455402 4jcets8u f', '150096600051455402_4jcets8u_f', '150096600051455402 4jcets8u f', 'jpg', 75776, 1409991594, 'gallerys/2014/09/06/', NULL, 8, NULL, NULL, NULL, NULL),
(3521, NULL, '150096600052237621 vd52mzqu c', '150096600052237621_vd52mzqu_c', '150096600052237621 vd52mzqu c', 'jpg', 35155, 1409991594, 'gallerys/2014/09/06/', NULL, 9, NULL, NULL, NULL, NULL),
(3522, NULL, '152840981075057306 h2fqze2m c', '152840981075057306_h2fqze2m_c', '152840981075057306 h2fqze2m c', 'jpg', 40948, 1409991594, 'gallerys/2014/09/06/', NULL, 11, NULL, NULL, NULL, NULL),
(3523, NULL, '154811305911502014 vzc2bjxf f', '154811305911502014_vzc2bjxf_f', '154811305911502014 vzc2bjxf f', 'jpg', 109771, 1409991594, 'gallerys/2014/09/06/', NULL, 10, NULL, NULL, NULL, NULL),
(3524, NULL, '160229699213631259 mpnfz4kd c', '160229699213631259_mpnfz4kd_c', '160229699213631259 mpnfz4kd c', 'jpg', 47030, 1409991594, 'gallerys/2014/09/06/', NULL, 12, NULL, NULL, NULL, NULL),
(3525, NULL, '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_0', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1409992295, 'gallerys/2014/09/06/', NULL, 1, NULL, NULL, NULL, NULL),
(3526, NULL, '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_0', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1409992296, 'gallerys/2014/09/06/', NULL, 2, NULL, NULL, NULL, NULL),
(3527, NULL, '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_0', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1409992296, 'gallerys/2014/09/06/', NULL, 3, NULL, NULL, NULL, NULL),
(3528, NULL, '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_0', '139189444703588266 pddyjcer c', 'jpg', 49064, 1409992296, 'gallerys/2014/09/06/', NULL, 4, NULL, NULL, NULL, NULL),
(3529, NULL, '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_0', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1409992296, 'gallerys/2014/09/06/', NULL, 5, NULL, NULL, NULL, NULL),
(3530, NULL, '150096600051454741 gofwjxws f', '150096600051454741_gofwjxws_f_0', '150096600051454741 gofwjxws f', 'jpg', 83670, 1409992296, 'gallerys/2014/09/06/', NULL, 6, NULL, NULL, NULL, NULL),
(3531, NULL, '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_1', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1409992336, 'gallerys/2014/09/06/', NULL, 1, NULL, NULL, NULL, NULL),
(3532, NULL, '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_1', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1409992336, 'gallerys/2014/09/06/', NULL, 2, NULL, NULL, NULL, NULL),
(3533, NULL, '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_0', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1409992336, 'gallerys/2014/09/06/', NULL, 3, NULL, NULL, NULL, NULL),
(3534, NULL, '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_1', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1409992337, 'gallerys/2014/09/06/', NULL, 4, NULL, NULL, NULL, NULL),
(3535, 'admins', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1409997491, 'admins/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3536, 'admins', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_0', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410000536, 'admins/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3537, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_2', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410000901, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3538, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_1', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410001318, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3539, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_1', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410002707, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3540, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_1', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410002744, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3541, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_2', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410002784, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3542, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_2', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410002822, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3543, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_3', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410002855, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3544, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_3', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410002883, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3545, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_2', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410002988, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3546, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_3', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410003412, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3547, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_4', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410003730, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3548, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_3', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410008809, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3549, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_4', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410008809, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3550, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_2', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410008809, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3551, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_2', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410008809, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3552, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_4', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410008958, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3553, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_5', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410008958, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3554, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_3', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410008958, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3555, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_3', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410008959, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3556, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_5', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410008982, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3557, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_6', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410008982, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3558, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_4', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410008982, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3559, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_4', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410008982, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3560, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_6', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410008990, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3561, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_7', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410008994, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3562, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_8', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009006, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3563, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_9', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009033, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3564, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_10', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009129, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3565, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_11', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009280, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3566, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_12', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009320, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3567, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_4', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410009389, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3568, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_7', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410009431, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3569, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_13', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009735, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3570, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_14', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009749, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3571, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_15', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009794, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3572, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_8', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410009803, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3573, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_16', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410009965, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3574, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_9', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410009965, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3575, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_5', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410009965, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3576, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_5', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410009965, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3577, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_5', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410010576, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3578, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_17', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410010662, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3579, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_18', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410010718, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3580, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_19', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410010743, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3581, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_20', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410010923, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3582, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_10', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410010923, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3583, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_6', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410010923, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3584, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_6', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410010923, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3585, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_21', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410010983, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3586, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_11', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410010983, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3587, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_7', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410010983, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3588, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_7', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410010983, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3589, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_22', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410010989, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3590, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_23', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011104, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3591, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_12', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410011105, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3592, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_8', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410011105, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3593, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_8', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410011105, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3594, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_24', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011242, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3595, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_25', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011296, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3596, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_26', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011328, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3597, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_13', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410011328, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3598, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_27', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011442, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3599, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_28', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011476, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3600, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_29', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011561, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3601, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_14', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410011561, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3602, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_9', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410011561, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3603, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_9', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410011561, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3604, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_5', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410011561, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3605, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_6', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3606, 'gallerys', '150096600051454741 gofwjxws f', '150096600051454741_gofwjxws_f_1', '150096600051454741 gofwjxws f', 'jpg', 83670, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3607, 'gallerys', '150096600051455402 4jcets8u f', '150096600051455402_4jcets8u_f_0', '150096600051455402 4jcets8u f', 'jpg', 75776, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3608, 'gallerys', '150096600052237621 vd52mzqu c', '150096600052237621_vd52mzqu_c_0', '150096600052237621 vd52mzqu c', 'jpg', 35155, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3609, 'gallerys', '152840981075057306 h2fqze2m c', '152840981075057306_h2fqze2m_c_0', '152840981075057306 h2fqze2m c', 'jpg', 40948, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3610, 'gallerys', '154811305911502014 vzc2bjxf f', '154811305911502014_vzc2bjxf_f_0', '154811305911502014 vzc2bjxf f', 'jpg', 109771, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3611, 'gallerys', '160229699213631259 mpnfz4kd c', '160229699213631259_mpnfz4kd_c_0', '160229699213631259 mpnfz4kd c', 'jpg', 47030, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3612, 'gallerys', '169448004701112326 u4qkiiq6 c', '169448004701112326_u4qkiiq6_c', '169448004701112326 u4qkiiq6 c', 'jpg', 69746, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3613, 'gallerys', '169448004701210260 wro1rscl c', '169448004701210260_wro1rscl_c', '169448004701210260 wro1rscl c', 'jpg', 75194, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3614, 'gallerys', '170644273351978219 digtjnak f', '170644273351978219_digtjnak_f', '170644273351978219 digtjnak f', 'jpg', 40948, 1410011562, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3615, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_30', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410011710, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3616, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_15', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410011711, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3617, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_10', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410011711, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3618, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_31', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012103, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3619, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_32', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012116, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3620, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_33', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012200, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3621, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_34', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012300, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3622, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_35', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012380, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3623, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_36', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012541, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3624, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_16', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410012554, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3625, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_37', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012598, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3626, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_38', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012619, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3627, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_39', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012931, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3628, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_17', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410012931, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3629, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_11', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410012932, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `vsf_file` (`id`, `module`, `title`, `name`, `intro`, `type`, `size`, `uploadTime`, `path`, `status`, `index`, `pass`, `userId`, `url`, `objId`) VALUES
(3630, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_10', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410012932, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3631, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_40', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410012975, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3632, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_18', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410012975, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3633, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_12', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410012975, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3634, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_11', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410012975, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3635, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_41', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410013201, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3636, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_19', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410013201, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3637, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_13', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410013201, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3638, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_12', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410013202, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3639, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_42', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410014076, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3640, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_13', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410014080, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3641, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_6', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410014198, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3642, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_43', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410014317, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3643, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_20', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410014318, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3644, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_14', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410014318, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3645, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_14', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410014318, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3646, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_7', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410015277, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3647, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_44', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015318, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3648, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_45', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015480, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3649, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_46', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015513, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3650, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_47', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015544, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3651, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_48', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015809, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3652, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_49', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015859, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3653, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_50', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015888, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3654, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_51', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015912, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3655, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_8', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410015935, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3656, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_52', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015963, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3657, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_53', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410015991, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3658, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_9', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410015996, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3659, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_54', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410016228, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3660, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_55', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410016335, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3661, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_21', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410016506, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3662, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_10', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410016533, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3663, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_56', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410016684, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3664, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_7', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410016687, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3665, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_57', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410016767, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3666, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_22', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410016776, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3667, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_58', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410016909, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3668, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_8', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410016911, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3669, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_59', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410017028, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3670, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_60', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410018173, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3671, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_61', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410018177, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3672, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_23', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410018177, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3673, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_15', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410018177, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3674, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_15', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410018177, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3675, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c_11', '139189444703588266 pddyjcer c', 'jpg', 49064, 1410018178, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3676, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f_9', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1410018178, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3677, 'gallerys', '150096600051454741 gofwjxws f', '150096600051454741_gofwjxws_f_2', '150096600051454741 gofwjxws f', 'jpg', 83670, 1410018178, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3678, 'gallerys', '150096600051455402 4jcets8u f', '150096600051455402_4jcets8u_f_1', '150096600051455402 4jcets8u f', 'jpg', 75776, 1410018178, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3679, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_62', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410018327, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3680, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_24', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410018331, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3681, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_63', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410018331, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3682, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_16', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410018331, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3683, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f_16', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410018331, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3696, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_2', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410084455, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3685, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_65', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410018458, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3686, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f_25', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410018458, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3687, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f_17', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410018458, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3688, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_66', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410021609, 'gallerys/2014/09/06/', NULL, NULL, NULL, NULL, NULL, NULL),
(3697, 'menus', 'adamsville map.54153833', 'adamsville_map_54153833', 'adamsville map.54153833', 'jpg', 107289, 1410677939, 'gallerys/2014/09/14/', NULL, NULL, NULL, NULL, NULL, NULL),
(3690, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410077889, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3691, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_0', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410082692, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3692, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f_1', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1410082696, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3693, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1410082696, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3694, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1410082696, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3695, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1410082696, 'gallerys/2014/09/07/', NULL, NULL, NULL, NULL, NULL, NULL),
(3698, 'gallerys', '63050463503764436 zsxiixjm f', '63050463503764436_zsxiixjm_f', '63050463503764436 zsxiixjm f', 'jpg', 242585, 1411182107, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3699, 'gallerys', '68187381828849066 rjmnkxuq f', '68187381828849066_rjmnkxuq_f', '68187381828849066 rjmnkxuq f', 'jpg', 108945, 1411182113, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3700, 'gallerys', '77194581083338950 p3wz0f1i f', '77194581083338950_p3wz0f1i_f', '77194581083338950 p3wz0f1i f', 'jpg', 45940, 1411182113, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3701, 'gallerys', '136233957448034093 ydy3big5 f', '13623_57448034093_ydy3big5_f', '136233957448034093 ydy3big5 f', 'jpg', 68762, 1411182113, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3702, 'gallerys', '139189444703588266 pddyjcer c', '1_189444703588266_pddyjcer_c', '139189444703588266 pddyjcer c', 'jpg', 49064, 1411182113, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3703, 'gallerys', '148689225167972027 m0yk5edu f', '148689225167972027_m0yk5edu_f', '148689225167972027 m0yk5edu f', 'jpg', 67222, 1411182113, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3704, 'gallerys', '150096600051454741 gofwjxws f', '150096600051454741_gofwjxws_f', '150096600051454741 gofwjxws f', 'jpg', 83670, 1411182114, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3705, 'gallerys', '150096600051455402 4jcets8u f', '150096600051455402_4jcets8u_f', '150096600051455402 4jcets8u f', 'jpg', 75776, 1411182114, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3706, 'gallerys', 'details nail final', 'details_nail_final', 'details nail final', 'jpg', 278352, 1411195735, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3707, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final', 'cac tin da dang nail final', 'jpg', 319907, 1411195865, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3708, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_0', 'cac tin da dang nail final', 'jpg', 319907, 1411206336, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3709, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_1', 'cac tin da dang nail final', 'jpg', 319907, 1411206356, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3710, 'gallerys', 'details nail final', 'details_nail_final_0', 'details nail final', 'jpg', 278352, 1411206357, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3711, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_2', 'cac tin da dang nail final', 'jpg', 319907, 1411206454, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3712, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_3', 'cac tin da dang nail final', 'jpg', 319907, 1411206481, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3713, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_4', 'cac tin da dang nail final', 'jpg', 319907, 1411206903, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3714, 'gallerys', 'details nail final', 'details_nail_final_1', 'details nail final', 'jpg', 278352, 1411206905, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3715, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_5', 'cac tin da dang nail final', 'jpg', 319907, 1411206922, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3716, 'gallerys', 'details nail final', 'details_nail_final_2', 'details nail final', 'jpg', 278352, 1411206930, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3717, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_6', 'cac tin da dang nail final', 'jpg', 319907, 1411207066, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3718, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_7', 'cac tin da dang nail final', 'jpg', 319907, 1411207069, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3719, 'gallerys', 'details nail final', 'details_nail_final_3', 'details nail final', 'jpg', 278352, 1411207069, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3720, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_8', 'cac tin da dang nail final', 'jpg', 319907, 1411207505, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3721, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_9', 'cac tin da dang nail final', 'jpg', 319907, 1411207512, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3722, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_10', 'cac tin da dang nail final', 'jpg', 319907, 1411208008, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3723, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_11', 'cac tin da dang nail final', 'jpg', 319907, 1411217204, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3724, 'gallerys', 'details nail final', 'details_nail_final_4', 'details nail final', 'jpg', 278352, 1411217327, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3725, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_12', 'cac tin da dang nail final', 'jpg', 319907, 1411217367, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3726, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_13', 'cac tin da dang nail final', 'jpg', 319907, 1411218108, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3727, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_14', 'cac tin da dang nail final', 'jpg', 319907, 1411219690, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3728, 'gallerys', 'details nail final', 'details_nail_final_5', 'details nail final', 'jpg', 278352, 1411219719, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3729, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_15', 'cac tin da dang nail final', 'jpg', 319907, 1411219823, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3730, 'gallerys', 'details nail final', 'details_nail_final_6', 'details nail final', 'jpg', 278352, 1411219898, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3731, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_16', 'cac tin da dang nail final', 'jpg', 319907, 1411219926, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3732, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_17', 'cac tin da dang nail final', 'jpg', 319907, 1411219968, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3733, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_18', 'cac tin da dang nail final', 'jpg', 319907, 1411220071, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3734, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_19', 'cac tin da dang nail final', 'jpg', 319907, 1411220466, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3735, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_20', 'cac tin da dang nail final', 'jpg', 319907, 1411220503, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3736, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_21', 'cac tin da dang nail final', 'jpg', 319907, 1411220590, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3737, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_22', 'cac tin da dang nail final', 'jpg', 319907, 1411220599, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3738, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_23', 'cac tin da dang nail final', 'jpg', 319907, 1411220617, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3739, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_24', 'cac tin da dang nail final', 'jpg', 319907, 1411220635, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3740, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_25', 'cac tin da dang nail final', 'jpg', 319907, 1411220748, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3741, 'gallerys', 'form hoidap nail final', 'form_hoidap_nail_final', 'form hoidap nail final', 'jpg', 457742, 1411220925, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3742, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_26', 'cac tin da dang nail final', 'jpg', 319907, 1411220952, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3743, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_27', 'cac tin da dang nail final', 'jpg', 319907, 1411220993, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3744, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_28', 'cac tin da dang nail final', 'jpg', 319907, 1411221021, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3745, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_29', 'cac tin da dang nail final', 'jpg', 319907, 1411221037, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3746, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_30', 'cac tin da dang nail final', 'jpg', 319907, 1411221067, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3747, 'gallerys', 'cac tin da dang nail final', 'cac_tin_da_dang_nail_final_31', 'cac tin da dang nail final', 'jpg', 319907, 1411221080, 'gallerys/2014/09/20/', NULL, NULL, NULL, NULL, NULL, NULL),
(3748, 'gallerys', 'login form', 'login_form', 'login form', 'png', 457, 1411660077, 'gallerys/2014/09/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3749, 'gallerys', 'login form', 'login_form_0', 'login form', 'png', 457, 1411660675, 'gallerys/2014/09/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3750, 'gallerys', 'reporting a post on facebook the process 5029195b15284', 'reporting_a_post_on_facebook_the_process_5029195b15284', 'reporting a post on facebook the process 5029195b15284', 'png', 673795, 1411660702, 'gallerys/2014/09/25/', NULL, NULL, NULL, NULL, NULL, NULL),
(3751, 'gallerys', 'error', 'error', 'error', 'png', 116188, 1411745818, 'gallerys/2014/09/26/', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_file_type`
--

CREATE TABLE IF NOT EXISTS `vsf_file_type` (
`fileTypeId` smallint(4) unsigned NOT NULL,
  `fileTypeMime` varchar(64) NOT NULL DEFAULT '',
  `fileExtension` varchar(32) NOT NULL DEFAULT '',
  `fileShowHTML` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_gallery`
--

CREATE TABLE IF NOT EXISTS `vsf_gallery` (
`id` smallint(5) NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `catId` smallint(5) DEFAULT NULL,
  `album` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `index` smallint(4) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` smallint(4) DEFAULT NULL,
  `passWord` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postDate` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vsf_gallery`
--

INSERT INTO `vsf_gallery` (`id`, `title`, `module`, `catId`, `album`, `intro`, `index`, `status`, `code`, `image`, `passWord`, `postDate`, `userId`) VALUES
(1, 'posts', 'posts', 21, NULL, NULL, 0, -1, 'posts_2', NULL, NULL, 0, NULL),
(2, 'posts', 'posts', 21, NULL, NULL, 0, -1, 'posts_5', NULL, NULL, 0, NULL),
(3, 'posts', 'posts', 21, NULL, NULL, 0, -1, 'posts_1', NULL, NULL, 0, NULL),
(4, '1410019529', 'posts', 0, NULL, NULL, 0, -1, 'posts_11', NULL, NULL, 1410019529, NULL),
(5, '1410019687', 'posts', 0, NULL, NULL, 0, -1, 'posts_12', NULL, NULL, 1410019687, NULL),
(6, '1410019728', 'posts', 0, NULL, NULL, 0, -1, 'posts_13', NULL, NULL, 1410019728, NULL),
(7, 'tieu de', 'posts', 0, NULL, NULL, 0, -1, 'posts_14', NULL, NULL, 1410021863, NULL),
(8, 'nha hang sang tiem', 'posts', 0, NULL, NULL, 0, -1, 'posts_15', NULL, NULL, 1410080106, NULL),
(9, 'can tho nail', 'posts', 0, NULL, NULL, 0, -1, 'posts_18', NULL, NULL, 1410082712, NULL),
(10, 'posts', 'posts', 21, NULL, NULL, 0, -1, 'posts_19', NULL, NULL, 0, NULL),
(11, '20/9 test', 'posts', 21, NULL, NULL, 0, -1, 'posts_20', NULL, NULL, 1411182126, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_gallery_file_rel`
--

CREATE TABLE IF NOT EXISTS `vsf_gallery_file_rel` (
  `galleryId` int(56) NOT NULL,
  `fileId` int(56) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vsf_gallery_file_rel`
--

INSERT INTO `vsf_gallery_file_rel` (`galleryId`, `fileId`) VALUES
(1, 3513),
(1, 3514),
(1, 3515),
(1, 3516),
(1, 3517),
(1, 3518),
(1, 3519),
(1, 3520),
(1, 3521),
(1, 3522),
(1, 3523),
(1, 3524),
(2, 3525),
(2, 3526),
(2, 3527),
(2, 3528),
(2, 3529),
(2, 3530),
(6, 3685),
(6, 3686),
(6, 3687),
(9, 3692),
(9, 3693),
(9, 3694),
(9, 3695),
(11, 3699),
(11, 3700),
(11, 3701),
(11, 3702),
(11, 3703),
(11, 3704),
(11, 3705),
(3, 3726);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_helper`
--

CREATE TABLE IF NOT EXISTS `vsf_helper` (
`id` int(11) NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_helper`
--

INSERT INTO `vsf_helper` (`id`, `code`, `title`, `content`, `view`) VALUES
(1, 'abc', 'Helper về phần hướng dẫn lung tung', 'Helper về phần hướng dẫn lung tungHelper về phần hướng dẫn lung tungHelper về phần hướng dẫn lung tungHelper về phần hướng dẫn lung tungHelper về phần hướng dẫn lung tung', 0),
(2, 'help_tag', 'help_tag', 'help_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_taghelp_tag', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_lang`
--

CREATE TABLE IF NOT EXISTS `vsf_lang` (
`id` int(11) NOT NULL,
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `en` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `vi` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'global',
  `root` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=881 ;

--
-- Dumping data for table `vsf_lang`
--

INSERT INTO `vsf_lang` (`id`, `key`, `en`, `vi`, `type`, `module`, `root`) VALUES
(1, 'global_page_title', '', 'Home page', 'admin', 'global', 1),
(2, 'global_main_title', '', 'Home page', 'admin', 'global', 1),
(3, 'module_get_class_success', '', 'Get action successfully!', 'admin', 'admin', 1),
(4, 'module_get_class_fail', '', 'There is no item with specified action!', 'admin', 'admin', 1),
(5, 'main_title', '', 'Quản trị website', 'admin', 'admin', 1),
(6, 'pageTitle', '', 'Trang chủ', 'admin', 'admin', 1),
(7, 'global_website_choise', '', 'You haven''t choose any items !', 'admin', 'global', 1),
(8, 'admins_title_system', '', 'Hệ thống', 'admin', 'global', 1),
(9, 'admins_title_system_manager', '', 'Quản trị website', 'admin', 'global', 1),
(10, 'admins_userName', '', 'Tên đăng nhập', 'admin', 'global', 1),
(11, 'admins_password', '', 'Mật khẩu', 'admin', 'global', 1),
(12, 'admins_forget_password', '', 'Quên mật khẩu', 'admin', 'global', 1),
(13, 'admins_logInTitle', '', 'Login', 'admin', 'global', 1),
(14, 'tab_admin', '', 'Tài khoản', 'admin', 'global', 1),
(15, 'tab_admin_changpassword', '', 'Thay đổi mật khẩu', 'admin', 'global', 1),
(16, 'tab_admingroup', '', 'Quản lý nhóm', 'admin', 'global', 1),
(17, 'admins_ss', '', 'Cấu hình admins', 'admin', 'global', 1),
(18, 'admins_welcome', '', 'Chào mừng', 'admin', 'global', 1),
(19, 'admins_login_last', '', 'Hoạt động cuối', 'admin', 'global', 1),
(20, 'global_d_mon', '', 'Monday', 'admin', 'global', 1),
(21, 'global_d_tue', '', 'Tuesday', 'admin', 'global', 1),
(22, 'global_d_wed', '', 'Wednesday', 'admin', 'global', 1),
(23, 'global_d_thu', '', 'Thursday', 'admin', 'global', 1),
(24, 'global_d_fri', '', 'Friday', 'admin', 'global', 1),
(25, 'global_d_sat', '', 'Saturday', 'admin', 'global', 1),
(26, 'global_d_sun', '', 'Sunday', 'admin', 'global', 1),
(27, 'global_title_home', '', 'Xem trang chủ', 'admin', 'global', 1),
(28, 'global_logout', '', 'Thoát', 'admin', 'global', 1),
(29, 'admin_list_title', '', 'Danh sách tài khoản', 'admin', 'admins', 1),
(30, 'id', '', 'Id', 'admin', 'admins', 1),
(31, 'title', '', 'Tiêu đề', 'admin', 'admins', 1),
(32, 'status', '', 'Trạng thái', 'admin', 'admins', 1),
(33, 'all', '', 'All', 'admin', 'admins', 1),
(34, 'action_hide', '', 'Ẩn', 'admin', 'admins', 1),
(35, 'action_visible', '', 'Hiện', 'admin', 'admins', 1),
(36, 'search', '', 'Tìm kiếm', 'admin', 'admins', 1),
(37, 'search_advanced', '', 'Tìm kiếm nâng cao', 'admin', 'admins', 1),
(38, 'action_add', '', 'Thêm', 'admin', 'admins', 1),
(39, 'action_delete', '', 'Xóa', 'admin', 'admins', 1),
(40, 'email', '', 'Email', 'admin', 'admins', 1),
(41, 'lastLogin', '', 'Thời gian đăng nhập', 'admin', 'admins', 1),
(42, 'action', '', 'Thao tác', 'admin', 'admins', 1),
(43, 'action_edit', '', 'Sửa', 'admin', 'admins', 1),
(44, 'global_error_none_select', '', 'Vui lòng chọn một hay nhiều tin', 'admin', 'global', 1),
(45, 'global_yesno_delete', '', 'Bạn có chắc chắn muốn xóa nó?', 'admin', 'global', 1),
(46, 'tab_post', '', 'Tin tức', 'admin', 'posts', 1),
(47, 'posts_category', '', 'Danh mục', 'admin', 'posts', 1),
(48, 'posts_ss', '', 'posts Settings', 'admin', 'posts', 1),
(49, 'posts_title', '', 'Danh sách bài viết', 'admin', 'posts', 1),
(50, 'category', '', 'Danh mục', 'admin', 'posts', 1),
(51, 'global_action_add', '', 'Thêm', 'admin', 'global', 1),
(52, 'global_action_delete', '', 'Xóa', 'admin', 'global', 1),
(53, 'global_action_hide', '', 'Ẩn', 'admin', 'global', 1),
(54, 'global_action_visible', '', 'Hiện', 'admin', 'global', 1),
(55, 'global_action_index_change', '', 'Cập nhật thứ tự', 'admin', 'global', 1),
(56, 'image', '', 'Hình ảnh', 'admin', 'posts', 1),
(57, 'postdate', '', 'Ngày đăng', 'admin', 'posts', 1),
(58, 'index', '', 'Thứ tự', 'admin', 'posts', 1),
(59, 'no_data', '', 'Hiện không có dữ liệu', 'admin', 'posts', 1),
(60, 'move_to_categories', '', 'Di chuyển tin đến', 'admin', 'posts', 1),
(61, 'develop_get_obj_fail', '', 'No object was found', 'admin', 'posts', 1),
(62, 'add_edit_posts', '', 'Thêm/Sửa tin', 'admin', 'posts', 1),
(63, 'global_accept', '', 'Lưu', 'admin', 'global', 1),
(64, 'global_cancel', '', 'Đóng', 'admin', 'global', 1),
(65, 'Permalink', '', 'Đường dẫn cố định', 'admin', 'posts', 1),
(66, 'global_hide', '', 'Ẩn', 'admin', 'global', 1),
(67, 'global_visible', '', 'Hiện', 'admin', 'global', 1),
(68, 'upload', '', 'Tải lên từ máy', 'admin', 'posts', 1),
(69, 'download_from', '', 'Tải về từ đường dẫn', 'admin', 'posts', 1),
(70, 'intro', '', 'Mô tả', 'admin', 'posts', 1),
(71, 'content', '', 'Nội dung', 'admin', 'posts', 1),
(72, 'error_title', '', 'Error Title', 'admin', 'posts', 1),
(73, 'tab_lang', '', 'lang', 'admin', 'langs', 1),
(74, 'tab_language', '', 'language', 'admin', 'langs', 1),
(75, 'P_trang', 'trang', 'trang', 'admin', 'langs', 1),
(76, 'type', '', 'Type', 'admin', 'langs', 1),
(77, 'module', '', 'Module', 'admin', 'langs', 1),
(78, 'key', '', 'Key', 'admin', 'langs', 1),
(79, 'en', '', 'en', 'admin', 'langs', 1),
(80, 'vi', '', 'vi', 'admin', 'langs', 1),
(81, 'global_action_update', '', 'Cập nhật', 'admin', 'global', 1),
(82, 'search_key', '', 'Key', 'admin', 'langs', 1),
(83, 'search_module', '', 'Module', 'admin', 'langs', 1),
(84, 'search_language', '', 'Languages', 'admin', 'langs', 1),
(85, 'search_type', '', 'Types', 'admin', 'langs', 1),
(86, 'search_type_admin', '', 'Admin', 'admin', 'langs', 1),
(87, 'search_type_user', '', 'User', 'admin', 'langs', 1),
(88, 'search_type_normal', '', 'Normal', 'admin', 'langs', 1),
(89, 'error_none_select', '', 'Error None Select', 'admin', 'langs', 1),
(90, 'yesno_delete', '', 'Yesno Delete', 'admin', 'langs', 1),
(91, 'tab_obj_objes', '', 'settings', 'admin', 'settings', 1),
(92, 'tab_obj_categories', '', 'Categories', 'admin', 'settings', 1),
(93, 'group_global', '', 'Global', 'admin', 'settings', 1),
(94, 'group_global_module', '', 'global', 'admin', 'settings', 1),
(95, 'search_location', '', 'Location', 'admin', 'settings', 1),
(96, 'search_location_global', '', 'Global', 'admin', 'settings', 1),
(97, 'search_location_category', '', 'Category', 'admin', 'settings', 1),
(98, 'name_lable', '', 'Name', 'admin', 'settings', 1),
(99, 'value_lable', '', 'Value', 'admin', 'settings', 1),
(100, 'order_lable', '', 'Order', 'admin', 'settings', 1),
(101, 'delete_confirm', '', 'Are you sure to delete these settings information?', 'admin', 'settings', 1),
(102, 'group_title', '', 'Setting Group', 'admin', 'settings', 1),
(103, 'update_fail', '', 'Update fail', 'admin', 'global', 1),
(104, 'update_successful', '', 'Update successful', 'admin', 'global', 1),
(105, 'page_index', 'page', 'Trang', 'admin', 'settings', 1),
(106, 'content_info', '', 'Thông tin phim/Rạp', 'admin', 'posts', 1),
(107, 'author', '', 'Tác giả', 'admin', 'posts', 1),
(108, 'video', '', 'Video (Link youtube)', 'admin', 'posts', 1),
(109, 'menu_user', '', 'User menus', 'admin', 'menus', 1),
(110, 'menu_admin', '', 'Admin menus', 'admin', 'menus', 1),
(111, 'menu_title_add', '', 'Add new menu', 'admin', 'menus', 1),
(112, 'menu_bt_add', '', 'Add', 'admin', 'menus', 1),
(113, 'menu_form_name', '', 'Name', 'admin', 'menus', 1),
(114, 'menu_form_visible', '', 'Hiện', 'admin', 'menus', 1),
(115, 'menu_form_yes', '', 'Yes', 'admin', 'menus', 1),
(116, 'menu_form_no', '', 'No', 'admin', 'menus', 1),
(117, 'menu_form_link', '', 'Url', 'admin', 'menus', 1),
(118, 'menu_form_index', '', 'Index', 'admin', 'menus', 1),
(119, 'menu_form_type', '', 'Type', 'admin', 'menus', 1),
(120, 'menu_form_external', '', 'External', 'admin', 'menus', 1),
(121, 'menu_form_internal', '', 'Internal', 'admin', 'menus', 1),
(122, 'menu_form_islink', '', 'Is link', 'admin', 'menus', 1),
(123, 'menu_form_alt', '', 'Description', 'admin', 'menus', 1),
(124, 'menu_form_dropdown', '', 'Dropdown', 'admin', 'menus', 1),
(125, 'menu_form_position', '', 'Position', 'admin', 'menus', 1),
(126, 'menu_form_main', '', 'Main', 'admin', 'menus', 1),
(127, 'menu_form_top', '', 'Top', 'admin', 'menus', 1),
(128, 'menu_form_right', '', 'Right', 'admin', 'menus', 1),
(129, 'menu_form_bottom', '', 'Bottom', 'admin', 'menus', 1),
(130, 'menu_form_left', '', 'Left', 'admin', 'menus', 1),
(131, 'obj_image_image', '', 'Image', 'admin', 'menus', 1),
(132, 'null_title', '', 'Tiêu đề không được để trống!!!', 'admin', 'menus', 1),
(133, 'pages_deleteConfirm', '', 'Are you sure to delete these page information?', 'admin', 'menus', 1),
(134, 'menu_select_to_delete', '', 'Please select a menu to delete!', 'admin', 'menus', 1),
(135, 'menu_select_to_edit', '', 'Please select a menu to edit!', 'admin', 'menus', 1),
(136, 'menu_form_menulist', '', 'Menu list', 'admin', 'menus', 1),
(137, 'tab_modules', '', 'modules', 'admin', 'modules', 1),
(138, 'tab_modules_ss', '', 'modulesSettings', 'admin', 'modules', 1),
(139, 'modules', '', 'modules', 'admin', 'modules', 1),
(140, 'action_index_change', '', 'Action Index Change', 'admin', 'modules', 1),
(141, 'import', '', 'Import', 'admin', 'modules', 1),
(142, 'class', '', 'Class Name', 'admin', 'modules', 1),
(143, 'edit', '', 'Edit', 'admin', 'modules', 1),
(144, 'delete', '', 'Delete', 'admin', 'modules', 1),
(145, 'add_edit_modules_modules', '', 'Add edit modules', 'admin', 'modules', 1),
(146, 'close', '', 'Close', 'admin', 'modules', 1),
(147, 'hide', '', 'Ẩn', 'admin', 'modules', 1),
(148, 'visible', '', 'Hiện', 'admin', 'modules', 1),
(149, 'isParent', '', 'Is parent', 'admin', 'modules', 1),
(150, 'isAdmin', '', 'Is admin', 'admin', 'modules', 1),
(151, 'isUser', '', 'Is user', 'admin', 'modules', 1),
(152, 'virtual', '', 'virtual', 'admin', 'modules', 1),
(153, 'parent', '', 'Parent', 'admin', 'modules', 1),
(154, 'accept', '', 'Accept', 'admin', 'modules', 1),
(155, 'Cancel', '', 'Cancel', 'admin', 'modules', 1),
(156, 'error_intro', '', 'Error Intro', 'admin', 'modules', 1),
(213, 'link', '', 'Link detail', 'admin', 'calendars', 1),
(160, 'menus_option_root', '', 'Root', 'admin', 'menus', 1),
(161, 'global_action_edit', '', 'Sửa', 'admin', 'global', 1),
(162, 'err_chosen_category', '', 'Hãy chọn danh mục!', 'admin', 'menus', 1),
(163, 'page_delparentcate', '', 'Không thể xóa danh mục cha. Muốn xóa danh mục này, bạn phải xóa danh mục con trước!', 'admin', 'menus', 1),
(164, 'category_confirm_delete', '', 'Bạn có chắc chắn để xóa danh mục này?', 'admin', 'menus', 1),
(165, 'hide_obj_only_cate', '', 'Chỉ chọn một category!', 'admin', 'menus', 1),
(166, 'news_EditCategoryFormTilte_Add', '', 'Thêm danh mục', 'admin', 'menus', 1),
(167, 'news_EditCategoryFormButton_Add', '', 'Lưu', 'admin', 'menus', 1),
(168, 'category_form_header_name', '', 'Tên', 'admin', 'menus', 1),
(169, 'category_form_header_index', '', 'Thứ tự', 'admin', 'menus', 1),
(170, 'err_category_name_blank', '', 'Please enter the category name!', 'admin', 'menus', 1),
(171, 'page_emptycateincate', '', 'Danh mục cha không thể sửa vào danh mục con!', 'admin', 'menus', 1),
(172, 'add', '', 'Add', 'admin', 'settings', 1),
(173, 'obj_back', 'Back', 'Trở lại', 'admin', 'settings', 1),
(174, 'module_label', '', 'Module', 'admin', 'settings', 1),
(175, 'title_label', '', 'Title', 'admin', 'settings', 1),
(176, 'description_label', '', 'Description', 'admin', 'settings', 1),
(177, 'value_label', '', 'Value', 'admin', 'settings', 1),
(178, 'key_label', '', 'Key', 'admin', 'settings', 1),
(179, 'input_type_label', '', 'Input Type', 'admin', 'settings', 1),
(180, 'type_label', '', 'Type', 'admin', 'settings', 1),
(181, 'type_global', '', 'Global', 'admin', 'settings', 1),
(182, 'type_admin', '', 'Admin', 'admin', 'settings', 1),
(183, 'type_public', '', 'Public', 'admin', 'settings', 1),
(184, 'index_label', '', 'Index', 'admin', 'settings', 1),
(185, 'root_label', '', 'Root', 'admin', 'settings', 1),
(186, 'develop_get_obj_success', '', 'Execute successful', 'admin', 'settings', 1),
(187, 'cbhqs', '', 'Cbhqs', 'user', 'favicon.ico', 1),
(188, 'tab_rap', '', 'rap', 'admin', 'rap', 1),
(189, 'rap_category_tab', '', 'Danh mục', 'admin', 'rap', 1),
(190, 'category_form_header_status', '', 'Trạng thái', 'admin', 'menus', 1),
(191, 'global_home', '', 'Trang chủ', 'admin', 'global', 1),
(192, 'meta_title', '', 'Meta Title', 'admin', 'menus', 1),
(193, 'meta_keywords', '', 'Meta Keywords', 'admin', 'menus', 1),
(194, 'meta_description', '', 'Meta Description', 'admin', 'menus', 1),
(195, 'news_EditCategoryFormTilte_Edit', '', 'Sửa danh mục', 'admin', 'menus', 1),
(196, 'news_EditCategoryFormButton_Edit', '', 'Cập nhật', 'admin', 'menus', 1),
(197, 'menu_bt_switch_add', '', 'Đóng', 'admin', 'menus', 1),
(198, 'add_edit_rap', '', 'Thêm/Sửa tin', 'admin', 'rap', 1),
(199, 'search_result', '', 'Search result', 'admin', 'global', 1),
(200, 'seo', '', 'Seo', 'admin', 'rap', 1),
(212, 'err_category_delete_unempty', '', 'Here are several category cannot be deleted due to being unempty! Please delete its children first.', 'admin', 'menus', 1),
(202, 'tab_pages', '', 'pages', 'admin', 'pages', 1),
(203, 'pages_category_tab', '', 'Danh mục', 'admin', 'pages', 1),
(204, 'insert_success', '', 'Insert Success', 'admin', 'global', 1),
(206, 'tab_calendars', '', 'Lịch', 'admin', 'calendars', 1),
(207, 'calendars_title', '', 'Danh sách lịch', 'admin', 'calendars', 1),
(208, 'menu_title_edit', '', 'Edit a menu', 'admin', 'menus', 1),
(209, 'menu_bt_edit', '', 'Edit', 'admin', 'menus', 1),
(210, 'add_edit_calendars', '', 'Thêm/Sửa lịch', 'admin', 'calendars', 1),
(211, 'category_rap', '', 'Rạp', 'admin', 'calendars', 1),
(214, 'time', '', 'Giờ chiếu', 'admin', 'calendars', 1),
(215, 'date', '', 'Ngày chiếu', 'admin', 'calendars', 1),
(216, 'pages_title', '', 'Danh sách bài viết', 'admin', 'rap', 1),
(217, 'startDate', '', 'Ngày khởi chiếu', 'admin', 'calendars', 1),
(218, 'endDate', '', 'Ngày kết thúc', 'admin', 'calendars', 1),
(219, 'update_success', '', 'Update Success', 'admin', 'global', 1),
(220, 'publish', '', 'Đang diễn ra', 'admin', 'posts', 1),
(221, 'publish_1', '', 'Đã diễn ra', 'admin', 'posts', 1),
(222, 'hit', '', 'Đi đâu hôm nay', 'admin', 'posts', 1),
(223, 'publishDate', '', 'Ngày chiếu', 'admin', 'posts', 1),
(224, 'lastModify', '', 'Ngày kết thúc', 'admin', 'posts', 1),
(225, 'album', '', 'Album hình ảnh', 'admin', 'posts', 1),
(226, 'tab_gallerys', '', 'gallerys', 'admin', 'gallerys', 1),
(227, 'action_checkall', '', 'Chọn tất cả', 'admin', 'gallerys', 1),
(228, 'action_uncheckall', '', 'Bỏ chọn tất cả', 'admin', 'gallerys', 1),
(229, 'tab_file', '', 'file', 'admin', 'files', 1),
(230, 'files_ss', '', 'files Settings', 'admin', 'files', 1),
(231, 'tab_contact', 'Liên hệ', 'Hộp thư liên hệ ', 'admin', 'contacts', 1),
(232, 'tab_pcontact', '', 'Liên hệ', 'admin', 'contacts', 1),
(233, 'from', '', 'From', 'admin', 'contacts', 1),
(234, 'contacts', 'Liên hệ', 'Liên hệ', 'admin', 'contacts', 1),
(235, 'category_form_header_template', '', 'Giao diện', 'admin', 'menus', 1),
(236, 'admingroups_title', '', 'Danh sách bài viết', 'admin', 'admins', 1),
(237, 'langs_access_module', '', 'Access langs module', 'admin', 'admins', 1),
(238, 'products_access_module', '', 'Access products module', 'admin', 'admins', 1),
(239, 'posts_access_module', '', 'Access posts module', 'admin', 'admins', 1),
(240, 'menus_access_module', '', 'Access menus module', 'admin', 'admins', 1),
(241, 'admins_access_module', '', 'Access admins module', 'admin', 'admins', 1),
(242, 'admins_account_manager', '', 'Quản lý tài khoản', 'admin', 'admins', 1),
(243, 'add_edit_admins_admingroups', '', 'Add edit admingroups', 'admin', 'admins', 1),
(244, 'default', '', 'Default', 'admin', 'admins', 1),
(245, 'permission', '', 'Permission', 'admin', 'admins', 1),
(246, 'langs', '', 'Langs', 'admin', 'admins', 1),
(247, 'products', 'Sản phẩm', 'Sản phẩm', 'admin', 'admins', 1),
(248, 'posts', '', 'Posts', 'admin', 'admins', 1),
(249, 'menus', '', 'Menus', 'admin', 'admins', 1),
(250, 'admins', '', 'Admins', 'admin', 'admins', 1),
(251, 'tab_banner', '', 'Banner', 'admin', 'banners', 1),
(252, 'banners_title', '', 'Danh sách bài viết', 'admin', 'banners', 1),
(253, 'position', '', 'Vị trí', 'admin', 'banners', 1),
(254, 'tab_bannerpo', '', 'bannerpo', 'admin', 'banners', 1),
(255, 'bannerpos_title', '', 'Danh sách banner', 'admin', 'banners', 1),
(256, 'add_edit_banners_bannerpos', '', 'Add edit bannerpos', 'admin', 'banners', 1),
(257, 'code', '', 'Code', 'admin', 'banners', 1),
(258, 'add_edit_banners_banners', '', 'Add edit banners', 'admin', 'banners', 1),
(259, 'url', '', 'Url', 'admin', 'banners', 1),
(260, 'add_edit_banners', '', 'Thêm/Sửa banner', 'admin', 'banners', 1),
(261, 'banenrs_intro', '', 'Code', 'admin', 'banners', 1),
(262, 'cate_change_success', '', 'Category have been changed!', 'admin', 'global', 1),
(263, 'global_title_phim', '', 'xem phim', 'user', 'global', 1),
(264, 'global_title_music', '', 'nghe nhạc', 'user', 'global', 1),
(265, 'global_title_fell', '', 'Cảm nhận nghệ thuật', 'user', 'global', 1),
(266, 'global_title_kich', '', 'Xem kịch', 'user', 'global', 1),
(267, 'global_title_place', '', 'điểm đến thú vị', 'user', 'global', 1),
(268, 'global_title_nightstyle', '', 'Sôi động nightstyle', 'user', 'global', 1),
(269, 'global_title_discovery', '', 'khám phá tiềm năng', 'user', 'global', 1),
(270, 'global_title_promotion', '', 'khuyến mãi hàng hiệu', 'user', 'global', 1),
(271, 'tags', '', 'Tags', 'admin', 'posts', 1),
(272, 'tab_tag', '', 'tag', 'admin', 'tags', 1),
(273, 'tags_ss', '', 'tags Settings', 'admin', 'tags', 1),
(274, 'global_title_wherego', '', 'đi đâu hôm nay', 'user', 'global', 1),
(275, 'global_title_wherego_intro', '', 'đừng bỏ lỡ những sự kiện và địa điểm khuyễn mãi hấp dẫn trong hôm nay', 'user', 'global', 1),
(276, 'postss', '', 'Postss', 'user', 'posts', 1),
(277, 'global_action_home', '', 'Trang chủ', 'admin', 'global', 1),
(278, 'global_title_people', '', 'cộng đồng', 'user', 'global', 1),
(279, 'global_title_newplace', '', 'địa điểm mới', 'user', 'global', 1),
(280, 'global_title_newplace_intro', '', 'Những địa điểm đáng cho bạn khám phá', 'user', 'global', 1),
(281, 'post_type', '', 'Thể loại', 'admin', 'posts', 1),
(282, 'move_to_type', '', 'Di chuyển tin đến', 'admin', 'posts', 1),
(283, 'type_change_success', '', 'Chuyển tin thành công!', 'admin', 'global', 1),
(284, 'global_calendar_film', '', 'lịch phim', 'user', 'global', 1),
(285, 'global_calendar_kich', '', 'lịch kịch', 'user', 'global', 1),
(286, 'global_calendar_music', '', 'lịch âm nhạc', 'user', 'global', 1),
(287, 'global_calendar_nightstyle', '', 'lịch nightstyle', 'user', 'global', 1),
(288, 'global_event_today', '', 'sự kiện hôm nay', 'user', 'global', 1),
(289, 'count', '', 'Count', 'admin', 'tags', 1),
(290, 'tags_title', '', 'Danh sách tags', 'admin', 'tags', 1),
(291, 'find_friend', '', 'Rủ bạn cùng đi', 'admin', 'posts', 1),
(292, 'tab_media', '', 'Thông tin báo chí', 'admin', 'media', 1),
(293, 'media_category_tab', '', 'Danh mục', 'admin', 'media', 1),
(294, 'add_edit_media', '', 'Thêm/Sửa tin', 'admin', 'media', 1),
(295, 'global_comment', '', 'Bình luận', 'user', 'global', 1),
(296, 'global_images', '', 'Hình ảnh', 'user', 'global', 1),
(297, 'global_vote', '', 'Đánh giá', 'user', 'global', 1),
(298, 'global_like', '', 'Yêu thích', 'user', 'global', 1),
(299, 'global_goto', '', 'Đã đến', 'user', 'global', 1),
(300, 'global_view', '', 'lượt xem', 'user', 'global', 1),
(301, 'global_content', '', 'Nội dung', 'user', 'global', 1),
(302, 'global_media', '', 'thông tin báo chí', 'user', 'global', 1),
(303, 'global_find_friend', '', 'Tìm bạn đi cùng', 'user', 'global', 1),
(304, 'hot', '', 'Sự kiện hot', 'admin', 'posts', 1),
(305, 'global_event_hot', '', 'Sự kiện hot', 'user', 'global', 1),
(306, 'global_event_other', '', 'Các sự kiện liên quan', 'user', 'global', 1),
(307, 'global_view_all', '', 'Xem tất cả', 'user', 'global', 1),
(308, 'add_edit_admins_admins', '', 'Thêm/Sửa tài khoản', 'admin', 'admins', 1),
(309, 'admin_image', '', 'Hình đại diện', 'admin', 'admins', 1),
(310, 'address', '', 'Địa chỉ', 'admin', 'admins', 1),
(311, 'phone', '', 'Điện thoại', 'admin', 'admins', 1),
(312, 'error_user_name', '', 'Tên đăng nhập phải nhiều hơn 3 ký tự', 'admin', 'admins', 1),
(313, 'error_email', '', 'Địa chỉ email không chính xác!', 'admin', 'admins', 1),
(314, 'error_password', '', 'Mật khẩu ít nhất 6 ký tự', 'admin', 'admins', 1),
(315, 'calendars', '', 'Calendars', 'user', 'calendars', 1),
(316, 'not_count_item', '', 'Not Count Item', 'user', 'calendars', 1),
(317, 'calendarss', '', 'Calendarss', 'user', 'calendars', 1),
(318, 'global_calendar_nightlife', '', 'lịch nightlife', 'user', 'global', 1),
(319, 'calendars_place', '', 'địa điểm', 'user', 'calendars', 1),
(320, 'calendars_name', '', 'Họ tên', 'user', 'calendars', 1),
(321, 'calendars_time', '', 'Thời gian', 'user', 'calendars', 1),
(322, 'rap', '', 'Rap', 'user', 'rap', 1),
(323, 'raps', '', 'Raps', 'user', 'rap', 1),
(324, 'global_event_calendar', '', 'Nhấp vào đây để xem sự kiện ngày khác', 'user', 'global', 1),
(325, 'media', '', 'Media', 'user', 'media', 1),
(326, 'add_edit_langs_langs', '', 'Add edit langs', 'admin', 'global', 1),
(327, 'type_user', '', 'user', 'admin', 'global', 1),
(328, 'changpassword', '', 'Đổi mật khẩu', 'admin', 'admins', 1),
(329, 'new_password', '', 'Mật khẩu mới', 'admin', 'admins', 1),
(330, 'password_confirm', '', 'Xác nhận mật khẩu', 'admin', 'admins', 1),
(331, 'error_password_confirm', '', 'Password not valid', 'admin', 'admins', 1),
(332, 'add_edit_tags', '', 'Thêm/Sửa tin', 'admin', 'tags', 1),
(333, 'pcontacts_title', '', 'Danh sách bài viết', 'admin', 'contacts', 1),
(334, 'add_edit_contacts', '', 'Thêm/Sửa tin', 'admin', 'contacts', 1),
(335, 'google_map', '', 'Google Map', 'admin', 'contacts', 1),
(336, 'obj_choise_place', '', ' Choise Place', 'admin', 'contacts', 1),
(337, 'obj_center_hcm', '', ' Center HCM', 'admin', 'contacts', 1),
(338, 'Google_map_goo', '', 'Bản đồ google', 'admin', 'contacts', 1),
(339, 'admin_wrong_password', '', 'Mật khẩu không đúng!', 'admin', 'admins', 1),
(340, 'exitDenyAccess', '', 'Access denied!', 'admin', 'menus', 1),
(341, 'admin_no_username', '', 'Tài khoản không tồn tại!', 'admin', 'admins', 1),
(342, 'Can_not_copy', '', 'Can not copy file from %s to %s', 'admin', 'files', 1),
(343, 'password_username_not_match', '', 'Tên đăng nhập hoặc mật khẩu không đúng', 'admin', 'admins', 1),
(344, 'newsfeeds', '', 'Newsfeeds', 'user', 'newsfeeds', 1),
(345, 'view_comment', '', 'Xem thêm bình luận', 'user', 'newsfeeds', 1),
(346, 'comments', '', 'Comments', 'user', 'comments', 1),
(347, 'o_ago_giay', '', '0 giây trước', 'user', 'comments', 1),
(348, 'submit_newsfeed', '', 'Đăng', 'user', 'newsfeeds', 1),
(349, 'tab_newsfeed', '', 'newsfeed', 'admin', 'newsfeeds', 1),
(350, 'newsfeeds_ss', '', 'newsfeeds Settings', 'admin', 'newsfeeds', 1),
(351, 'newsfeeds_title', '', 'Danh sách bài viết', 'admin', 'newsfeeds', 1),
(352, 'add_edit_newsfeeds', '', 'Thêm/Sửa tin', 'admin', 'newsfeeds', 1),
(353, 'tab_like', '', 'like', 'admin', 'likes', 1),
(354, 'likes_ss', '', 'likes Settings', 'admin', 'likes', 1),
(355, 'likes_title', '', 'Danh sách bài viết', 'admin', 'likes', 1),
(356, 'likes', '', 'Likes', 'user', 'likes', 1),
(357, 'users', '', 'Users', 'user', 'users', 1),
(358, 'album_no_title', '', 'Album chưa đặt tên', 'user', 'users', 1),
(359, 'submit_album', '', 'Đăng', 'user', 'users', 1),
(360, 'friends', '', 'Friends', 'user', 'friends', 1),
(361, 'no_content', '', 'Vui lòng nhập nội dung', 'user', 'posts', 1),
(362, 'locations', '', 'Locations', 'user', 'locations', 1),
(363, 'gallerys', '', 'Gallerys', 'user', 'gallerys', 1),
(364, 'galleryss', '', 'Galleryss', 'user', 'gallerys', 1),
(365, 'global_file_not_exist', '', 'The file <b>%s</b> does not exist!', 'admin', 'global', 1),
(366, 'tab_notification', '', 'notification', 'admin', 'notifications', 1),
(367, 'notifications_ss', '', 'notifications Settings', 'admin', 'notifications', 1),
(368, 'notifications_title', '', 'Danh sách bài viết', 'admin', 'notifications', 1),
(369, 'invite', '', 'Mời bạn đi cùng', 'admin', 'posts', 1),
(370, 'tab_findfriends', '', 'findfriends', 'admin', 'findfriends', 1),
(371, 'findfriends_ss', '', 'findfriends Settings', 'admin', 'findfriends', 1),
(372, 'tab_findfriend', '', 'findfriend', 'admin', 'findfriends', 1),
(373, 'findfriends_title', '', 'Danh sách bài viết', 'admin', 'findfriends', 1),
(374, 'findfriends', '', 'Findfriends', 'user', 'findfriends', 1),
(375, 'tab_findfriendrel', '', 'findfriendrel', 'admin', 'findfriendrels', 1),
(376, 'findfriendrels_ss', '', 'findfriendrels Settings', 'admin', 'findfriendrels', 1),
(377, 'findfriendrels_title', '', 'Danh sách bài viết', 'admin', 'findfriendrels', 1),
(378, 'sub_title', '', 'Tiêu đề con', 'admin', 'posts', 1),
(379, 'notifications', '', 'Notifications', 'user', 'notifications', 1),
(380, 'đã mời bạn tham gia', '', 'đã Mời Bạn Tham Gia', 'user', 'findfriends', 1),
(381, ' đã mời bạn tham gia ', '', ' đã Mời Bạn Tham Gia ', 'user', 'findfriends', 1),
(382, 'search_date', '', 'Ngày', 'admin', 'posts', 1),
(383, 'location_tab_category', '', 'Tỉnh thành phố', 'admin', 'posts', 1),
(384, 'Uncategory', '', 'Không có danh mục', 'admin', 'rap', 1),
(385, 'supports', '', 'Cảm nhận khách hàng', 'user', 'global', 1),
(386, 'hotnews', '', 'tin tức nổi bật', 'user', 'global', 1),
(387, 'view_all', '', 'Xem tất cả', 'user', 'global', 1),
(388, 'form_search', '', 'Tìm kiếm sản phẩm...', 'user', 'global', 1),
(389, 'global_lienketweb', '', 'Liên kết website', 'user', 'global', 1),
(390, 'tab_page_rap', '', 'tab_page_title_rap', 'admin', 'global', 1),
(391, 'service_info', '', 'Service Info', 'user', 'favicon.ico', 1),
(392, 'ads_cm', '', 'Ads Cm', 'user', 'favicon.ico', 1),
(393, 'news_event', '', 'News Event', 'user', 'favicon.ico', 1),
(394, 'comment_KH', '', 'Comment Kh', 'user', 'favicon.ico', 1),
(395, 'Working_hours', '', 'Working Hours', 'user', 'favicon.ico', 1),
(396, 'book_datting', '', 'Book Datting', 'user', 'favicon.ico', 1),
(397, 'form_name', '', 'Form Name', 'user', 'favicon.ico', 1),
(398, 'form_phone', '', 'Form Phone', 'user', 'favicon.ico', 1),
(399, 'form_address', '', 'Form Address', 'user', 'favicon.ico', 1),
(400, 'form_time', '', 'Form Time', 'user', 'favicon.ico', 1),
(401, 'send', '', 'Send', 'user', 'favicon.ico', 1),
(402, 'tab_statistic', '', 'statistic', 'admin', 'statistics', 1),
(403, 'statistics_ss', '', 'statistics Settings', 'admin', 'statistics', 1),
(404, 'statistics_title', '', 'Danh sách bài viết', 'admin', 'statistics', 1),
(405, 'statistics', '', 'Statistics', 'user', 'statistics', 1),
(406, 'configs', '', 'Thiết lập', 'admin', 'configs', 1),
(407, 'tab_setting', '', 'Cấu hình', 'admin', 'settings', 1),
(408, 'settings_category', '', 'settings Category', 'admin', 'settings', 1),
(409, 'settings_title', '', 'Danh sách bài viết', 'admin', 'settings', 1),
(410, 'add_edit_settings', '', 'Thêm/Sửa tin', 'admin', 'settings', 1),
(411, 'Shared', '', 'Chia sẻ', 'admin', 'settings', 1),
(412, 'Unshared', '', 'Chưa chia sẻ', 'admin', 'settings', 1),
(413, 'tab_widget', '', 'widget', 'admin', 'widgets', 1),
(414, 'widgets_ss', '', 'widgets Settings', 'admin', 'widgets', 1),
(415, 'widgets_title', '', 'Danh sách bài viết', 'admin', 'widgets', 1),
(416, 'add_edit_widgets', '', 'Thêm/Sửa tin', 'admin', 'widgets', 1),
(417, 'save', '', 'Lưu', 'admin', 'widgets', 1),
(418, 'tab_product', 'Products', 'Sản phẩm', 'admin', 'products', 1),
(419, 'tab_productcate', '', 'Danh mục', 'admin', 'products', 1),
(420, 'productcates_title', '', 'Danh sách bài viết', 'admin', 'products', 1),
(421, 'add_edit_products', '', 'Thêm/Sửa tin', 'admin', 'products', 1),
(422, 'parent_category', '', 'Danh mục cha', 'admin', 'products', 1),
(423, 'products_category', '', 'Danh mục sản phẩm', 'admin', 'products', 1),
(424, 'add_edit_products_products', '', 'Add edit products', 'admin', 'products', 1),
(425, 'products_price', '', 'Products Price', 'admin', 'products', 1),
(426, 'products_price_unit', '', 'VNĐ', 'admin', 'products', 1),
(427, 'seo_option', '', 'Seo Option', 'admin', 'products', 1),
(428, 'show_category', '', 'Hiển thị danh mục con', 'admin', 'menus', 1),
(429, 'products_title', '', 'Danh sách bài viết', 'admin', 'products', 1),
(430, 'settings_ss', '', 'Cấu hình settings', 'admin', 'settings', 1),
(431, 'admin_session_timeout', '', 'Administration session time out', 'admin', 'global', 1),
(432, 'tab_seo', '', 'seo', 'admin', 'seos', 1),
(433, 'seos_ss', '', 'seos Settings', 'admin', 'seos', 1),
(434, 'seos', '', 'seos', 'admin', 'seos', 1),
(435, 'keyword', '', 'Keyword', 'admin', 'seos', 1),
(436, 'add_edit_seos', '', 'Add Edit Seos', 'admin', 'seos', 1),
(437, 'aliasUrl', '', 'Aliasurl', 'admin', 'seos', 1),
(438, 'realUrl', '', 'Realurl', 'admin', 'seos', 1),
(439, 'contact_form', '', 'Contact Form', 'user', 'contacts', 1),
(440, 'contact_name', '', 'Họ và tên', 'user', 'contacts', 1),
(441, 'contact_phone', '', 'Điện thoại', 'user', 'contacts', 1),
(442, 'contact_title', '', 'Tiêu đề', 'user', 'contacts', 1),
(443, 'contact_content', '', 'Nội dung', 'user', 'contacts', 1),
(444, 'contact_code', '', 'Mã bảo vệ', 'user', 'contacts', 1),
(445, 'contact_send', '', 'Contact Send', 'user', 'contacts', 1),
(446, 'abouts', 'Giới thiệu', 'Giới thiệu', 'user', 'abouts', 1),
(447, 'slug', '', 'Slug', 'admin', 'menus', 1),
(448, 'tab_slidebanner', '', 'Banner trang chủ', 'admin', 'slidebanners', 1),
(449, 'slidebanners_ss', '', 'slidebanners Settings', 'admin', 'slidebanners', 1),
(450, 'slidebanners_title', '', 'Danh sách bài viết', 'admin', 'slidebanners', 1),
(451, 'add_edit_slidebanners', '', 'Thêm/Sửa tin', 'admin', 'slidebanners', 1),
(452, 'setting', '', 'Setting', 'admin', 'slidebanners', 1),
(453, 'website', '', 'Địa chỉ web', 'admin', 'slidebanners', 1),
(454, 'tab_logo', '', 'logo', 'admin', 'logos', 1),
(455, 'logos_ss', '', 'logos Settings', 'admin', 'logos', 1),
(456, 'logos_title', '', 'Danh sách bài viết', 'admin', 'logos', 1),
(457, 'add_edit_logos', '', 'Thêm/Sửa tin', 'admin', 'logos', 1),
(458, 'update_ok', '', 'Cập nhật thành công !', 'admin', 'logos', 1),
(459, 'code_pro', '', 'Mã sản phẩm', 'admin', 'products', 1),
(460, 'date_start', '', 'Thời gian hiển thị', 'admin', 'products', 1),
(461, 'date_end', '', 'Thời gian kết thúc', 'admin', 'products', 1),
(462, 'drop', '', 'Kéo thả hình ảnh', 'admin', 'products', 1),
(463, 'products_label', '', 'Nhãn', 'admin', 'products', 1),
(464, 'label', '', 'Label', 'admin', 'products', 1),
(465, 'label_products', '', 'Nhãn', 'admin', 'products', 1),
(466, 'price', '', 'Giá', 'admin', 'products', 1),
(467, 'products_labels', '', 'Nhãn', 'admin', 'products', 1),
(468, 'productlabels_title', '', 'Danh sách bài viết', 'admin', 'products', 1),
(469, 'tab_order', '', 'order', 'admin', 'orders', 1),
(470, 'orders', '', 'orders', 'admin', 'orders', 1),
(471, 'order_status_0', '', 'Mới đặt', 'admin', 'orders', 1),
(472, 'order_status_1', '', 'Chấp nhận', 'admin', 'orders', 1),
(473, 'order_status_2', '', 'Đã giao', 'admin', 'orders', 1),
(474, 'order_name', '', 'Họ tên', 'admin', 'orders', 1),
(475, 'order_time', '', 'TG đặt hàng', 'admin', 'orders', 1),
(476, 'product_not_found', '', 'Không tìm thấy sản phẩm', 'user', 'orders', 1),
(477, 'order_item_added', '', 'Sản phẩm vừa được thêm vào giỏ hàng', 'user', 'orders', 1),
(478, 'cart_info', '', 'Dưới đây là những sản phẩm mà Quý khách hàng đã chọn mua, Quý khách hàng có thể <span style=''color:#b11217''>thêm, xóa</span> các sản phẩm và <span style=''color:#b11217''>cập nhật</span> số lượng sản phẩm trong giỏ hàng...!', 'user', 'orders', 1),
(479, 'currency', '', 'VNĐ', 'user', 'orders', 1),
(480, 'cart_info_user', '', 'Sau khi đã hoàn thành việc chọn mua các sản phẩm, Quý khách hàng hãy điền đầy đủ Thông tin người nhận hàng vào form dưới đây và chọn <span style=''color:#b11217''>Xác nhận đặt hàng</span> để hoàn tất việc mua hàng. Chúng tôi sẻ liên hệ và giao hàng trong thời gian sớm nhất...!', 'user', 'orders', 1),
(481, 'tab_abouts', '', 'Giới thiệu', 'admin', 'abouts', 1),
(482, 'abouts_category_tab', '', 'Danh mục', 'admin', 'abouts', 1),
(483, 'add_edit_abouts', '', 'Thêm/Sửa tin', 'admin', 'abouts', 1),
(484, 'aboutss', '', 'Giới thiệu', 'user', 'abouts', 1),
(485, 'tab_abouts_ss', '', 'aboutsSettings', 'admin', 'abouts', 1),
(486, 'tab_simple', '', 'simple', 'admin', 'simple', 1),
(487, 'simple_category_tab', '', 'Danh mục', 'admin', 'simple', 1),
(488, 'add_edit_simple', '', 'Thêm/Sửa tin', 'admin', 'simple', 1),
(489, 'simple', 'Simple', 'Simple', 'user', 'simple', 1),
(490, 'simples', '', 'Simples', 'user', 'simple', 1),
(491, 'captcha_not_match', '', 'Mã bảo vệ không đúng', 'user', 'contacts', 1),
(492, 'contact_thankyou', 'Contact  Thank you !', 'Contact Thankyou !', 'user', 'contacts', 1),
(493, 'contactReadTitle', '', 'Read Email', 'admin', 'global', 1),
(494, 'FirstName', '', 'Firstname', 'admin', 'global', 1),
(495, 'contactName', '', 'Fullname', 'admin', 'global', 1),
(496, 'contactEmail', '', 'Email', 'admin', 'global', 1),
(497, 'contactAddress', '', 'Address', 'admin', 'global', 1),
(498, 'contactTime', '', 'Thời gian', 'admin', 'global', 1),
(499, 'contactMessage', '', 'Message', 'admin', 'global', 1),
(500, 'contactReply', '', 'Reply', 'admin', 'global', 1),
(501, 'contactPhone', '', 'Phone', 'admin', 'global', 1),
(502, 'contactTitle', '', 'Tiêu đề', 'admin', 'global', 1),
(503, 'tab_address', '', 'address', 'admin', 'address', 1),
(504, 'address_category_tab', '', 'Danh mục', 'admin', 'address', 1),
(505, 'add_edit_address', '', 'Thêm/Sửa tin', 'admin', 'address', 1),
(506, 'addresss', '', 'Addresss', 'user', 'address', 1),
(507, 'news', 'News', 'Tin tức', 'user', 'news', 1),
(508, 'newss', 'News', 'Tin tức', 'user', 'news', 1),
(509, 'tab_news', 'News', 'Tin tức', 'admin', 'news', 1),
(510, 'news_category_tab', '', 'Danh mục', 'admin', 'news', 1),
(511, 'add_edit_news', '', 'Thêm/Sửa tin', 'admin', 'news', 1),
(512, 'view_detail', 'Details', 'Chi tiết', 'user', 'news', 1),
(513, 'tab_ togethers', '', 'Tuyển dụng', 'admin', ' togethers', 1),
(514, ' togethers_category_tab', '', 'Danh mục', 'admin', ' togethers', 1),
(515, 'add_edit_ togethers', '', 'Thêm/Sửa tin', 'admin', ' togethers', 1),
(516, 'tab_togethers', '', 'Tuyển dụng', 'admin', 'togethers', 1),
(517, 'togethers_category_tab', '', 'Danh mục', 'admin', 'togethers', 1),
(518, 'add_edit_togethers', '', 'Thêm/Sửa tin', 'admin', 'togethers', 1),
(519, 'togethers', 'Recruitment', 'Đối tác khách hàng', 'user', 'togethers', 1),
(520, 'togetherss', 'Recruitment', 'Đối tác khách hàng', 'user', 'togethers', 1),
(521, 'tab_support', '', 'support', 'admin', 'supports', 1),
(522, 'add_edit_supports_supports', '', 'Add edit supports', 'admin', 'supports', 1),
(523, 'nickName', 'Nick skype', 'Nick skype', 'admin', 'supports', 1),
(524, 'tab_logolefts', '', 'Logo đối tác', 'admin', 'logolefts', 1),
(525, 'logolefts_category_tab', '', 'Danh mục', 'admin', 'logolefts', 1),
(526, 'add_edit_logolefts', '', 'Thêm/Sửa tin', 'admin', 'logolefts', 1),
(527, 'name', '', 'name', 'admin', 'langs', 1),
(528, 'admindefault', '', 'admin default', 'admin', 'langs', 1),
(529, 'userdefault', '', 'user default', 'admin', 'langs', 1),
(530, 'vlanguages', '', 'vlanguages', 'admin', 'langs', 1),
(531, 'add_edit_langs_vlanguages', '', 'Add edit vlanguages', 'admin', 'global', 1),
(532, 'error_name', '', 'Error Name', 'admin', 'global', 1),
(533, 'About Us', 'Giới thiệu', 'Giới thiệu', 'user', 'vi', 1),
(534, 'news_block', 'News', 'Tin tức', 'user', 'vi', 1),
(535, 'Từ khóa tìm kiếm...', ' Search...', 'Tìm kiếm ....', 'user', 'vi', 1),
(536, 'products_search_result', '', 'Kết quả tìm kiếm', 'user', 'vi', 1),
(537, 'products_search_title', '', 'Tìm kiếm với từ khóa: ', 'user', 'vi', 1),
(538, 'logolefts', 'Logolefts', '', 'user', 'logolefts', 1),
(539, 'logoleftss', 'Logoleftss', '', 'user', 'logolefts', 1),
(540, 'ge', '', 'ge', 'admin', 'langs', 1),
(541, 'Thiết kế web', ' Design web', 'Thiết kế web', 'user', 'vi', 1),
(542, 'bởi', 'by', 'bởi', 'user', 'vi', 1),
(543, 'News_fix', ' Others', 'Các tin khác', 'user', 'vi', 1),
(544, 'date_update', 'Updated', ' Ngày cập nhât', 'user', 'vi', 1),
(545, 'Commodity', 'Commodity', 'Hàng hóa', 'user', 'vi', 1),
(546, 'Usage / Purpose', 'Usage / Purpose', 'Sử dụng / Mục đích', 'user', 'vi', 1),
(547, 'Back', 'Back', 'Trở lại', 'user', 'vi', 1),
(548, 'Copyright © 2013 by PSAGRIMEX CORP. All rights reserved.', 'Copyright © 2013 by Psagrimex Corp. All Rights Reserved.', 'Copyright © 2013 by Psagrimex Corp. All Rights Reserved.', 'user', 'vi', 1),
(549, 'tab_config', '', 'config', 'admin', 'configs', 1),
(550, 'configs_ss', '', 'configs Settings', 'admin', 'configs', 1),
(551, 'configs_title', '', 'Danh sách bài viết', 'admin', 'configs', 1),
(552, 'add_edit_configs', '', 'Thêm/Sửa tin', 'admin', 'configs', 1),
(553, 'tab_customers', 'Customers', 'Danh mục', 'admin', 'customers', 1),
(554, 'customers_category_tab', '', 'Danh mục', 'admin', 'customers', 1),
(555, 'add_edit_customers', '', 'Thêm/Sửa tin', 'admin', 'customers', 1),
(556, 'customers', 'Customers', 'Quản lý khách hàng', 'user', 'vi', 1),
(557, 'customerss', 'Customers', 'Customers', 'user', 'vi', 1),
(558, 'Gửi', 'Sent', 'Gửi', 'user', 'contacts', 1),
(559, 'Làm lại', 'Reset', 'Làm Lại', 'user', 'contacts', 1),
(560, 'category_products_value', '', 'Value', 'admin', 'menus', 1),
(561, 'supports_title', '', 'Danh sách bài viết', 'admin', 'supports', 1),
(562, 'add_edit_supports', '', 'Thêm/Sửa tin', 'admin', 'supports', 1),
(563, 'Company:', 'Company:', '', 'user', 'contacts', 1),
(564, 'Country:', 'Country:', '', 'user', 'contacts', 1),
(565, 'Telephone:', 'Telephone:', '', 'user', 'contacts', 1),
(566, 'Your email:', 'Your Email:', '', 'user', 'contacts', 1),
(567, 'Your name:', 'Your Name:', '', 'user', 'contacts', 1),
(568, 'Subject:', 'Subject:', '', 'user', 'contacts', 1),
(569, 'Body:', 'Body:', '', 'user', 'contacts', 1),
(570, 'reply_from', '', 'From', 'admin', 'contacts', 1),
(571, 'reply_subject', '', 'Subject', 'admin', 'contacts', 1),
(572, 'reply_to', '', 'To', 'admin', 'contacts', 1),
(573, 'contactReplyFormTitle', '', 'Reply Email', 'admin', 'contacts', 1),
(574, 'contacts_replyForm_Send', '', 'Send Reply', 'admin', 'contacts', 1),
(575, 'orders_access_module', '', 'Access orders module', 'admin', 'admins', 1),
(576, 'no_login', '', 'Chưa đăng nhập lần nào', 'admin', 'global', 1),
(577, 'comment', '', 'Comment', 'admin', 'slidebanners', 1),
(578, 'type_pro', '', 'Loại', 'admin', 'products', 1),
(579, 'product_new', 'Sản Phẩm mới nhất', 'Sản Phẩm mới nhất', 'user', 'global', 1),
(580, 'gift', 'Quà tặng', 'Quà tặng', 'user', 'global', 1),
(581, 'tab_weblinks', '', 'weblinks', 'admin', 'weblinks', 1),
(582, 'weblinks_category_tab', '', 'Danh mục', 'admin', 'weblinks', 1),
(583, 'pages', '', 'pages', 'admin', 'weblinks', 1),
(584, 'add_edit_weblinks', '', 'Thêm/Sửa tin', 'admin', 'weblinks', 1),
(585, 'weblinks_category', '', 'Danh mục', 'admin', 'weblinks', 1),
(586, 'partners_title', '', 'Danh sách bài viết', 'admin', 'weblinks', 1),
(587, 'tab_learn', '', 'learn', 'admin', 'learn', 1),
(588, 'learn_category_tab', '', 'Danh mục', 'admin', 'learn', 1),
(589, 'add_edit_learn', '', 'Thêm/Sửa tin', 'admin', 'learn', 1),
(590, 'tab_videos', '', 'videos', 'admin', 'videos', 1),
(591, 'add_edit_videos', '', 'Thêm/Sửa tin', 'admin', 'videos', 1),
(592, 'home', 'Trang chủ', 'Trang chủ', 'user', 'products', 1),
(593, 'product_in_cate', 'Sản cùng loại', 'Sản cùng loại', 'user', 'products', 1),
(594, 'tab_services', '', 'services', 'admin', 'services', 1),
(595, 'services_category_tab', '', 'Danh mục', 'admin', 'services', 1),
(596, 'add_edit_services', '', 'Thêm/Sửa tin', 'admin', 'services', 1),
(597, 'services', 'Dịch vụ', '', 'user', 'services', 1),
(598, 'servicess', 'Servicess', '', 'user', 'services', 1),
(599, 'tab_callflower', '', 'callflower', 'admin', 'callflower', 1),
(600, 'callflower_category_tab', '', 'Danh mục', 'admin', 'callflower', 1),
(601, 'add_edit_callflower', '', 'Thêm/Sửa tin', 'admin', 'callflower', 1),
(602, 'callflower', 'Điện hoa quốc tế', '', 'user', 'callflower', 1),
(603, 'callflowers', 'Callflowers', '', 'user', 'callflower', 1),
(604, 'learn', 'Tìm hiểu về hoa', '', 'user', 'learn', 1),
(605, 'learns', 'Learns', '', 'user', 'learn', 1),
(606, 'tab_flower_japan', '', 'flower_japan', 'admin', 'flower_japan', 1),
(607, 'flower_japan_category_tab', '', 'Danh mục', 'admin', 'flower_japan', 1),
(608, 'add_edit_flower_japan', '', 'Thêm/Sửa tin', 'admin', 'flower_japan', 1),
(609, 'flower_japan', 'Cắm hoa nhật bản', '', 'user', 'flower_japan', 1),
(610, 'flower_japans', 'Cắm hoa nhật bản', '', 'user', 'flower_japan', 1),
(611, 'payment_finish', 'Cảm ơn quý khách đã đặt hàng! Chúng tôi sẽ kiểm tra đơn hàng và liên hệ với quý khách trong thời gian sớm nhất!', '', 'user', 'orders', 1),
(612, 'name_date', 'Name Date', '', 'user', 'contacts', 1),
(613, 'address_date', 'Address Date', '', 'user', 'contacts', 1),
(614, 'phone_date', 'Phone Date', '', 'user', 'contacts', 1),
(615, 'capcha', 'Mã bảo vệ', '', 'user', 'contacts', 1),
(616, 'name_ct', 'Họ tên', '', 'user', 'contacts', 1),
(617, 'address_ct', 'Địa chỉ', '', 'user', 'contacts', 1),
(618, 'phone_ct', 'Điện thoại', '', 'user', 'contacts', 1),
(619, 'email_ct', 'Email', '', 'user', 'contacts', 1),
(620, 'title_ct', 'Tiêu đề', '', 'user', 'contacts', 1),
(621, 'content_ct', 'Nội dung', '', 'user', 'contacts', 1),
(622, 'capcha_ct', 'Mã bảo vệ ', '', 'user', 'contacts', 1),
(623, 'order_edit', '', 'Xem đơn hàng', 'admin', 'orders', 1),
(624, 'order_item_list', '', 'Danh sách hóa đơn', 'admin', 'orders', 1),
(625, 'order_status_-1', '', 'Hủy', 'admin', 'orders', 1),
(626, 'order_intro', '', 'Thông tin thêm', 'admin', 'orders', 1),
(627, 'global_action_trash', '', 'Đưa vào thùng rác', 'admin', 'global', 1),
(628, 'tab_lease', '', 'lease', 'admin', 'lease', 1),
(629, 'add_edit_lease', '', 'Thêm/Sửa tin', 'admin', 'lease', 1),
(630, 'lease', '', 'Lease', 'user', 'lease', 1),
(631, 'add_edit_slidebanner', '', 'Thêm/Sửa tin', 'admin', 'slidebanner', 1),
(632, 'global_yes', '', 'Yes', 'admin', 'global', 1),
(633, 'global_no', '', 'No', 'admin', 'global', 1),
(634, 'global_ishome', '', 'Trang chủ', 'admin', 'global', 1),
(635, 'tab_subscribes', '', 'subscribes', 'admin', 'subscribes', 1),
(636, 'send_email_to_all', '', 'Gửi email cho tất cả', 'admin', 'subscribes', 1),
(637, 'add_edit_subscribes_pages', '', 'Add edit pages', 'admin', 'subscribes', 1),
(638, 'tab_getEmail', '', 'getEmail', 'admin', 'getEmail', 1),
(639, 'tab_newsletters', '', 'newsletters', 'admin', 'newsletters', 1),
(640, 'add_edit_getEmail', '', 'Thêm/Sửa tin', 'admin', 'getEmail', 1),
(641, 'name_product', '', 'Title', 'user', 'orders', 1),
(642, 'price_product', '', 'Price', 'user', 'orders', 1),
(643, 'number_product', '', 'Number', 'user', 'orders', 1),
(644, 'total_product', '', 'Total', 'user', 'orders', 1),
(645, 'currency_order', '', '$', 'user', 'orders', 1),
(646, 'cont_shop', '', 'Continue shopping', 'user', 'orders', 1),
(647, 'amount_products', '', 'Amount', 'user', 'orders', 1),
(648, 'full_name', '', 'Name', 'user', 'orders', 1),
(649, 'phone_order', '', 'Phone', 'user', 'orders', 1),
(650, 'email_order', '', 'Email', 'user', 'orders', 1),
(651, 'address_order', '', 'Address', 'user', 'orders', 1),
(652, 'intro_order', '', 'Intro', 'user', 'orders', 1),
(653, 'ple_title', '', 'Please enter the your name!', 'user', 'orders', 1),
(654, 'ple_phone', '', 'Please enter available phone number!', 'user', 'orders', 1),
(655, 'ple_email', '', 'Please enter the email!', 'user', 'orders', 1),
(656, 'ple_address', '', 'Please enter the address!', 'user', 'orders', 1),
(657, 'tab_national', '', 'national', 'admin', 'nationals', 1),
(658, 'nationals_ss', '', 'nationals Settings', 'admin', 'nationals', 1),
(659, 'nationals_title', '', 'Danh sách bài viết', 'admin', 'nationals', 1),
(660, 'add_edit_nationals', '', 'Thêm/Sửa tin', 'admin', 'nationals', 1),
(661, 'tab_league', '', 'league', 'admin', 'leagues', 1),
(662, 'leagues_ss', '', 'leagues Settings', 'admin', 'leagues', 1),
(663, 'leagues_title', '', 'Danh sách bài viết', 'admin', 'leagues', 1),
(664, 'add_edit_leagues', '', 'Thêm/Sửa tin', 'admin', 'leagues', 1),
(665, 'nationals_category', '', 'nationals Category', 'admin', 'nationals', 1),
(666, 'national', '', 'Quốc gia', 'admin', 'leagues', 1),
(667, 'tab_club', '', 'club', 'admin', 'clubs', 1),
(668, 'clubs_ss', '', 'clubs Settings', 'admin', 'clubs', 1),
(669, 'clubs_title', '', 'Danh sách bài viết', 'admin', 'clubs', 1),
(670, 'add_edit_clubs', '', 'Thêm/Sửa tin', 'admin', 'clubs', 1),
(671, 'subTitle', '', 'Sub Name', 'admin', 'clubs', 1),
(672, 'nameClub', '', 'Tên CLB', 'admin', 'clubs', 1),
(673, 'league', '', 'Giải đấu', 'admin', 'clubs', 1),
(674, 'tab_game', '', 'game', 'admin', 'games', 1),
(675, 'games_ss', '', 'games Settings', 'admin', 'games', 1),
(676, 'games_title', '', 'Danh sách bài viết', 'admin', 'games', 1),
(677, 'add_edit_games', '', 'Thêm/Sửa tin', 'admin', 'games', 1),
(678, 'homeTeam', '', 'Chủ', 'admin', 'games', 1),
(679, 'awayTeam', '', 'Khách', 'admin', 'games', 1),
(680, 'tab_match', '', 'match', 'admin', 'matchs', 1),
(681, 'matchs_ss', '', 'matchs Settings', 'admin', 'matchs', 1),
(682, 'matchs_title', '', 'Danh sách bài viết', 'admin', 'matchs', 1),
(683, 'add_edit_matchs', '', 'Thêm/Sửa tin', 'admin', 'matchs', 1),
(684, 'time_count_down', '', 'Thời gian', 'admin', 'matchs', 1),
(725, 'location', '', 'Địa điểm', 'admin', 'posts', 1),
(686, 'matchs', '', 'Matchs', 'user', 'matchs', 1),
(687, 'tab_video', '', 'video', 'admin', 'videos', 1),
(688, 'videos_ss', '', 'videos Settings', 'admin', 'videos', 1),
(689, 'videos_title', '', 'Danh sách bài viết', 'admin', 'videos', 1),
(690, 'videos', '', 'Videos', 'user', 'videos', 1),
(691, 'videos_category', '', 'videos Category', 'admin', 'videos', 1),
(692, 'clubs_category', '', 'clubs Category', 'admin', 'clubs', 1),
(693, 'tab_expects', '', 'expects', 'admin', 'expects', 1),
(694, 'add_edit_expects', '', 'Thêm/Sửa tin', 'admin', 'expects', 1),
(695, 'expects_category_tab', '', 'Danh mục', 'admin', 'expects', 1),
(696, 'expects', '', 'Expects', 'user', 'expects', 1),
(697, 'bxh', '', 'Bxh', 'user', 'bxh', 1),
(698, 'tab_bxh', '', 'bxh', 'admin', 'bxh', 1),
(699, 'add_edit_bxh', '', 'Thêm/Sửa tin', 'admin', 'bxh', 1),
(700, 'tab_injury', '', 'injury', 'admin', 'injurys', 1),
(701, 'injurys_ss', '', 'injurys Settings', 'admin', 'injurys', 1),
(702, 'injurys_title', '', 'Danh sách bài viết', 'admin', 'injurys', 1),
(703, 'add_edit_injurys', '', 'Thêm/Sửa tin', 'admin', 'injurys', 1),
(704, 'injurys', '', 'Injurys', 'user', 'injurys', 1),
(705, 'time_comback', '', 'Thời gian trở lại', 'admin', 'injurys', 1),
(706, 'cause', '', 'Nguyên nhân', 'admin', 'injurys', 1),
(707, 'clubs', '', 'Clubs', 'user', 'clubs', 1),
(708, 'tab_projects', '', 'projects', 'admin', 'projects', 1),
(709, 'projects', '', 'Projects', 'user', 'projects', 1),
(710, 'add_edit_projects', '', 'Thêm/Sửa tin', 'admin', 'projects', 1),
(711, 'projectss', '', 'Projectss', 'user', 'projects', 1),
(712, 'tab_partners', '', 'partners', 'admin', 'partners', 1),
(713, 'add_edit_partners', '', 'Thêm/Sửa tin', 'admin', 'partners', 1),
(714, 'tab_ads', '', 'ads', 'admin', 'ads', 1),
(715, 'add_edit_ads', '', 'Thêm/Sửa tin', 'admin', 'ads', 1),
(716, 'category_posts_value', '', 'Value', 'admin', 'menus', 1),
(717, 'category_form_desc', '', 'Mô tả', 'admin', 'menus', 1),
(718, 'global_Apply', '', 'Apply', 'admin', 'global', 1),
(719, 'tab_locations', '', 'locations', 'admin', 'locations', 1),
(720, 'locations_category_tab', '', 'Địa điểm', 'admin', 'locations', 1),
(721, 'category_locations_value', '', 'zipcode', 'admin', 'menus', 1),
(722, 'category_form_header_desc', '', 'Mô tả', 'admin', 'menus', 1),
(723, 'obj_image_document', '', 'docuemnt', 'admin', 'menus', 1),
(724, '_title', '', 'Danh sách bài viết', 'admin', 'posts', 1),
(726, 'publicdate', '', 'Ngày xuất bản', 'admin', 'posts', 1),
(727, 'tab_supporttype', '', 'supporttype', 'admin', 'supports', 1),
(728, 'supporttypes_title', '', 'Danh sách bài viết', 'admin', 'supports', 1),
(729, 'tab_faq', '', 'faq', 'admin', 'faq', 1),
(730, 'faq_category_tab', '', 'Danh mục', 'admin', 'faq', 1),
(731, 'add_edit_faq', '', 'Thêm/Sửa tin', 'admin', 'faq', 1),
(732, 'global_search', '', 'Tìm theo tên địa điểm, danh mục', 'user', 'global', 1),
(733, 'faq', '', 'Faq', 'user', 'faq', 1),
(734, 'faqs', '', 'Faqs', 'user', 'faq', 1),
(735, 'faq_question', '', 'Câu hỏi', 'user', 'faq', 1),
(736, 'faq_answer', '', 'Xem câu trả lời', 'user', 'faq', 1),
(737, 'faq_postdate', '', 'Ngày gửi: ', 'user', 'faq', 1),
(738, 'faq_empty', '', 'Hiện thời danh mục chưa có bài viết.', 'user', 'faq', 1),
(739, 'global_sidebar_ad', '', 'Quảng cáo', 'user', 'global', 1),
(740, 'faq_header', '', 'Hỏi đáp', 'user', 'faq', 1),
(741, 'faq_submit', '', 'Gửi câu hỏi', 'user', 'faq', 1),
(742, 'faq_list', '', 'Các câu hỏi thường gặp', 'user', 'faq', 1),
(743, 'faq_form_intro', '', 'Mục này được thực hiện nhằm tạo cơ hội cho Quý khách, có thể gửi những câu hỏi thắc mắc, trao đổi, hợp tác.. về cho chúng tôi. Để gửi câu hỏi, xin vui lòng nhập vào mẫu bên dưới, chúng tôi sẽ trả lời và cập nhật câu trả lời lên website trong thời gian sớm. nhất.', 'user', 'faq', 1),
(744, 'faq_form_fullname', '', 'Họ tên', 'user', 'faq', 1),
(745, 'faq_form_phone', '', 'Điện thoại', 'user', 'faq', 1);
INSERT INTO `vsf_lang` (`id`, `key`, `en`, `vi`, `type`, `module`, `root`) VALUES
(746, 'faq_form_question', '', 'Nội dung cần hỏi', 'user', 'faq', 1),
(747, 'faq_form_submit', '', 'Gửi', 'user', 'faq', 1),
(748, 'faq_form_reset', '', 'Làm lại', 'user', 'faq', 1),
(749, 'contacts_category', '', 'contacts Category', 'admin', 'contacts', 1),
(750, 'contact_header', '', 'Thông tin liên hệ', 'user', 'contacts', 1),
(751, 'contact_form_fullname', '', 'Họ tên', 'user', 'contacts', 1),
(752, 'contact_form_address', '', 'Địa chỉ', 'user', 'contacts', 1),
(753, 'contact_form_phone', '', 'Điện thoại', 'user', 'contacts', 1),
(754, 'contact_form_question', '', 'Nội dung cần hỏi', 'user', 'contacts', 1),
(755, 'contact_form_submit', '', 'Gửi', 'user', 'contacts', 1),
(756, 'contact_form_reset', '', 'Làm lại', 'user', 'contacts', 1),
(757, 'global_require', '', 'Thông tin bắt buộc', 'user', 'global', 1),
(758, 'contact_form_capchar', '', 'Mã bảo vệ', 'user', 'contacts', 1),
(759, 'contact_form_content', '', 'Nội dung cần hỏi', 'user', 'contacts', 1),
(760, 'contact_form_title', '', 'Tiêu đề', 'user', 'contacts', 1),
(761, 'global_error_title', '', 'Đã có lỗi xảy ra', 'user', 'global', 1),
(762, 'contact_form_content111', '', 'Nội dung', 'user', 'contacts', 1),
(763, 'contact_form_detail', '', 'Nội dung', 'user', 'contacts', 1),
(764, 'tab_user', '', 'user', 'admin', 'users', 1),
(765, 'users_location', '', 'location', 'admin', 'users', 1),
(766, 'regis_header_text', '', 'Để tham gia Giải thi đấu HIPHOP Cúp Parkson 2012, Các Bạn hày đăng ký thành viên theo yêu cầu dưới đây!', 'user', 'users', 1),
(767, 'registry_form_phone', '', 'Số phone', 'user', 'users', 1),
(768, 'registry_form_phone_placeholder', '', 'Số phone tiệm/thợ/công ty/nhà hàng/cá nhân', 'user', 'users', 1),
(769, 'registry_form_submit', '', 'Gửi', 'user', 'users', 1),
(770, 'registry_form_reset', '', 'Làm lại', 'user', 'users', 1),
(771, 'registry_form_password', '', 'Mật khẩu', 'user', 'users', 1),
(772, 'registry_form_password_confirm', '', 'Nhập lại mật khẩu', 'user', 'users', 1),
(773, 'registry_form_name', '', 'Tên', 'user', 'users', 1),
(774, 'registry_form_name_placeholder', '', 'Tên tiệm/thợ/công ty/nhà hàng/cá nhân', 'user', 'users', 1),
(775, 'registry_form_address', '', 'Địa chỉ', 'user', 'users', 1),
(776, 'registry_form_city', '', 'Thành phố', 'user', 'users', 1),
(777, 'registry_form_question', '', 'Nội dung cần hỏi', 'user', 'users', 1),
(778, 'registry_form_state', '', 'Tiểu bang', 'user', 'users', 1),
(779, 'registry_form_zipcode', '', 'Zipcode', 'user', 'users', 1),
(780, 'user_registry_header', '', 'Đăng ký thành viên', 'user', 'users', 1),
(781, 'registry_successfully', '', 'Đăng ký thành công', 'user', 'users', 1),
(782, 'username_exist', '', 'Tên đăng nhập đã tồn tại', 'user', 'users', 1),
(783, 'user_forget_password_header', '', 'Quên mật khẩu', 'user', 'users', 1),
(784, 'forgot_password_info', '', 'Thông tin mật khẩu', 'user', 'users', 1),
(785, 'forgot_passwd_message', '', 'Hệ thống đã gửi mật khẩu vào tài khoản email của bạn vui lòng kiểm tra email', 'user', 'users', 1),
(786, 'user_forget_password_success', '', 'Chúng tôi đã gửi email để cập nhật password mới cho bạn, xin vui lòng kiểm tra email', 'user', 'users', 1),
(787, 'link_invalid', '', 'Đường dẫn không chính xác', 'user', 'users', 1),
(788, 'renew_password_header', '', 'Cập nhật mật khẩu mới', 'user', 'users', 1),
(789, 'username_doesnot_exist', '', 'Tên đăng nhập không đã tồn tại', 'user', 'users', 1),
(790, 'login_form_phone', '', 'Số phone', 'user', 'users', 1),
(791, 'login_form_password', '', 'Mật khẩu', 'user', 'users', 1),
(792, 'global_login', '', 'Đăng nhập vào tài khoản', 'user', 'global', 1),
(793, 'login_form_forget_password', '', 'Quên mật khẩu', 'user', 'users', 1),
(794, 'login_form_login', '', 'Đăng nhập', 'user', 'users', 1),
(795, 'user_password_not_exist', '', 'Tên đăng nhập hoặc mật khẩu không tồn tại', 'user', 'users', 1),
(796, 'not_login', '', 'Bạn chưa đăng  nhập', 'user', 'users', 1),
(797, 'chang_info_successfully', '', 'Thay đổi thông tin thành công', 'user', 'users', 1),
(798, 'changepassword_form_password_old', '', 'Mật khẩu cũ', 'user', 'users', 1),
(799, 'changepassword_form_password', '', 'Mật khẩu cũ', 'user', 'users', 1),
(800, 'changepassword_form_password_new', '', 'Mật khẩu mới', 'user', 'users', 1),
(801, 'changepassword_form_password_new_confirm', '', 'Nhập lại mật khẩu mới', 'user', 'users', 1),
(802, 'changepassword_form_submit', '', 'Gửi', 'user', 'users', 1),
(803, 'changepassword_form_reset', '', 'Làm lại', 'user', 'users', 1),
(804, 'user_update_header', '', 'Cập nhật tiệm', 'user', 'users', 1),
(805, 'global_user_update', '', 'Cập nhật tiệm (tài khoản)', 'user', 'global', 1),
(806, 'global_user_change_password', '', 'Cập nhật mật khẩu', 'user', 'global', 1),
(807, 'global_post_list', '', 'Các tin đã đăng', 'user', 'global', 1),
(808, 'global_post_add', '', 'Đăng quảng cáo', 'user', 'global', 1),
(809, 'users_link', '', 'Quản lý tài khoản', 'user', 'users', 1),
(810, 'post_header', '', 'Đăng quảng cáo', 'user', 'posts', 1),
(811, 'post_form_intro', '', 'Mô tả', 'user', 'posts', 1),
(812, 'post_form_detail', '', 'Nội dung chi tiết', 'user', 'posts', 1),
(813, 'global_login_form_phone', '', 'Số phone', 'user', 'global', 1),
(814, 'global_login_form_password', '', 'Mật khẩu', 'user', 'global', 1),
(815, 'global_login_form_forget_password', '', 'Quên mật khẩu', 'user', 'global', 1),
(816, 'global_login_form_login', '', 'Đăng nhập', 'user', 'global', 1),
(817, 'faq_form_category', '', 'Danh mục cần đăng', 'user', 'posts', 1),
(818, 'post_form_file', '', 'Hình đại diện', 'user', 'posts', 1),
(819, 'faq_form_album', '', 'Album hình ảnh', 'user', 'posts', 1),
(820, 'files', '', 'Files', 'user', 'files', 1),
(821, 'post_form_file_chose', '', 'Chọn tệp', 'user', 'posts', 1),
(822, 'empty_image', '', 'Hình đại diện không hợp lệ', 'user', 'posts', 1),
(823, 'post_form_title', '', 'Tiêu đề', 'user', 'posts', 1),
(824, 'empty_title', '', 'Tiêu đề không được để trống', 'user', 'posts', 1),
(825, 'registry_form_website', '', 'Website', 'user', 'users', 1),
(826, 'createddate', '', 'Ngày đăng', 'admin', 'posts', 1),
(827, 'action_pending', '', 'Pending', 'admin', 'posts', 1),
(828, 'pending_type', '', 'Pending', 'admin', 'posts', 1),
(829, 'normal_type', '', 'Normal', 'admin', 'posts', 1),
(830, 'vip_type', '', 'Vip', 'admin', 'posts', 1),
(831, 'unapprove', '', 'Chưa duyệt', 'admin', 'users', 1),
(832, 'approve_reg', '', 'Chấp nhận đăng ký', 'admin', 'users', 1),
(833, 'add_edit_users_users', '', 'Add edit users', 'admin', 'users', 1),
(834, 'birthday', '', 'Birthday', 'admin', 'users', 1),
(835, 'password', '', 'Password', 'admin', 'users', 1),
(836, 'city', '', 'Thành phố', 'admin', 'users', 1),
(837, 'zipcode', '', 'Zipcode', 'admin', 'users', 1),
(838, 'posts_id', '', 'Ad Id:', 'user', 'posts', 1),
(839, 'posts_empty', '', 'Hiện thời danh mục chưa có bài viết.', 'user', 'posts', 1),
(840, 'posts_state', '', 'Bang', 'user', 'posts', 1),
(841, 'posts_cty', '', 'Thành phố', 'user', 'posts', 1),
(842, 'location-info', '', 'Thông tin thành phố', 'user', 'posts', 1),
(843, 'tab_', '', 'Tab ', 'admin', 'faq', 1),
(844, 'question', '', 'Câu hỏi', 'admin', 'faq', 1),
(845, 'fullname', '', 'Họ tên', 'admin', 'faq', 1),
(846, 'answer', '', 'Trả lời', 'admin', 'faq', 1),
(847, 'manage-account', '', 'Quản lý tài khoản', 'user', 'posts', 1),
(848, 'update-store', '', 'Cập nhật tiêm (Tài khoản)', 'user', 'posts', 1),
(849, 'post', '', 'Đăng quảng cáo', 'user', 'posts', 1),
(850, 'my-list', '', 'Các tin đã đăng', 'user', 'posts', 1),
(851, 'other_post', '', 'Tin cùng khu vực', 'user', 'posts', 1),
(852, 'other_post_title', '', 'Tin cùng khu vực', 'user', 'posts', 1),
(853, 'other_post_all', '', 'Xem tất cả', 'user', 'posts', 1),
(854, 'list', '', 'Danh sách các tin tại thành phố ''%s'' bang ''%s''', 'user', 'posts', 1),
(855, 'category_detail_message', '', 'Danh sách các tin tại thành phố <b>''%s''</b> bang <b>''%s''</b>', 'user', 'posts', 1),
(856, 'form_category', '', 'Danh mục cần đăng', 'user', 'posts', 1),
(857, 'form_album', '', 'Album hình ảnh', 'user', 'posts', 1),
(858, 'form_submit', '', 'Gửi', 'user', 'posts', 1),
(859, 'form_reset', '', 'Làm lại', 'user', 'posts', 1),
(860, 'user_update', '', 'Cập nhật tiệm (tài khoản)', 'user', 'users', 1),
(861, 'user_change_password', '', 'Cập nhật mật khẩu', 'user', 'users', 1),
(862, 'post_list', '', 'Các tin đã đăng', 'user', 'users', 1),
(863, 'post_add', '', 'Đăng quảng cáo', 'user', 'users', 1),
(864, 'post_me', '', 'Các tin đã đăng', 'user', 'posts', 1),
(865, 'edit_ok', '', 'Bạn đã cập nhật thành công', 'user', 'posts', 1),
(866, 'delete_ok', '', 'Bạn đã xóa bài viết thành công', 'user', 'posts', 1),
(867, 'login_required', '', 'Bạn chưa đăng nhập', 'user', 'posts', 1),
(868, 'global_support_online_title', '', 'Hỗ trợ trực tuyến', 'user', 'global', 1),
(869, 'global_login_form_remember_me', '', 'Nhớ tài khoản', 'user', 'global', 1),
(870, 'global_phone_title', '', 'Phone', 'user', 'global', 1),
(871, 'global_email_title', '', 'Email', 'user', 'global', 1),
(872, 'posts_publicdate', '', 'Ngày đăng:', 'user', 'posts', 1),
(873, 'map-info', '', 'Bản đồ', 'user', 'posts', 1),
(874, 'posts_empty_me', '', 'Quý khách chưa có bài đăng.', 'user', 'posts', 1),
(875, 'faq_form_header', '', 'Gửi câu hỏi', 'user', 'faq', 1),
(876, 'post_account_linkheader', '', 'Quản lý tài khoản', 'user', 'posts', 1),
(877, 'user_email_not_exist', '', 'Tên đăng nhập hoặc email không đúng', 'user', 'users', 1),
(878, 'add_ok', '', 'Bạn đã đăng tin thành công', 'user', 'posts', 1),
(879, 'password_not_available', '', 'Mật khẩu không hợp lệ', 'user', 'users', 1),
(880, 'change_password', '', 'Cập nhật mật khẩu', 'user', 'users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_langs`
--

CREATE TABLE IF NOT EXISTS `vsf_langs` (
`id` smallint(4) NOT NULL,
  `name` varchar(32) NOT NULL,
  `userDefault` tinyint(1) NOT NULL DEFAULT '0',
  `adminDefault` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `symbol` varchar(32) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vsf_langs`
--

INSERT INTO `vsf_langs` (`id`, `name`, `userDefault`, `adminDefault`, `code`, `status`, `symbol`) VALUES
(1, 'Vietnamese', 1, 1, 'vi', 1, 'vietnam.png'),
(2, 'English', 0, 0, 'en', 1, 'england.png');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_logo`
--

CREATE TABLE IF NOT EXISTS `vsf_logo` (
`id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `index` int(11) NOT NULL,
  `video` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `vsf_logo`
--

INSERT INTO `vsf_logo` (`id`, `catId`, `title`, `intro`, `content`, `website`, `image`, `position`, `status`, `index`, `video`) VALUES
(23, 0, 'logo', 'asd', '<p>asd</p>', '', 3119, 0, 0, 0, NULL),
(24, 0, 'ádasd', 'ádasd', '<p>&aacute;dasdasd</p>', '', 3121, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_menu`
--

CREATE TABLE IF NOT EXISTS `vsf_menu` (
`menuId` int(10) NOT NULL,
  `langId` smallint(4) unsigned NOT NULL,
  `menuTitle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `menuUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menuIndex` smallint(4) NOT NULL DEFAULT '0',
  `menuStatus` tinyint(1) NOT NULL DEFAULT '0',
  `menuAlt` text COLLATE utf8_unicode_ci,
  `parentId` int(10) NOT NULL DEFAULT '0',
  `menuIsLink` varchar(60) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `menuIsDropDown` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `menuType` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `menuLevel` tinyint(1) NOT NULL DEFAULT '0',
  `menuPosition` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `menuIsAdmin` tinyint(1) DEFAULT '1',
  `menuBackup` varchar(255) CHARACTER SET latin1 NOT NULL,
  `menuFileId` varchar(100) CHARACTER SET latin1 NOT NULL,
  `menuSlug` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `menuQuick` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `menuTemplate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `menuCate` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menuMtTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menuMtKeyWord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menuMtDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1122 ;

--
-- Dumping data for table `vsf_menu`
--

INSERT INTO `vsf_menu` (`menuId`, `langId`, `menuTitle`, `menuUrl`, `menuIndex`, `menuStatus`, `menuAlt`, `parentId`, `menuIsLink`, `menuIsDropDown`, `menuType`, `menuLevel`, `menuPosition`, `menuIsAdmin`, `menuBackup`, `menuFileId`, `menuSlug`, `menuQuick`, `menuTemplate`, `menuCate`, `menuMtTitle`, `menuMtKeyWord`, `menuMtDesc`) VALUES
(9, 1, 'Quản lý tài khoản', 'admin.php?vs=users', 0, 1, 'abouts', 0, '1', '0', '0', 1, '@10000', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(18, 0, 'Categories', '0', 0, 1, 'System categories', 0, '0', '0', '0', 0, '@0000', -1, '', '', '', '', '', NULL, '', '', ''),
(10, 1, 'supports', 'supports', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', NULL, '', '', ''),
(8, 1, 'nickicons', 'nickicons', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', NULL, '', '', ''),
(11, 1, 'yahoo_on', 'nickicons', 3, 1, '', 8, '1', '1', '0', 2, '@00000', -1, '', '125', '', '', '', NULL, '', '', ''),
(12, 1, 'yahoo_off', 'nickicons', 3, 1, '', 8, '1', '0', '0', 2, '@00000', -1, '', '126', '', '', '', NULL, '', '', ''),
(14, 1, 'settings', 'settings', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', NULL, '', '', ''),
(13, 1, 'sky_on', 'nickicons', 1, 0, '', 8, '0', '1', '0', 2, '@00000', -1, '', '123', '', '', '', NULL, '', '', ''),
(19, 1, 'sky_off', 'nickicons', 1, 0, '', 8, '0', '0', '0', 2, '@00000', -1, '', '124', '', '', '', NULL, '', '', ''),
(20, 1, 'products', 'products', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(21, 1, 'gallerys', 'gallerys', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(81, 0, 'tags', 'tags', 0, 1, 'tags', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(82, 1, 'type', 'type', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(555, 0, 'faq', 'faq', 0, 1, 'faq', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(37, 0, 'modules', 'modules', 0, 1, 'modules', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(38, 1, 'posts', 'posts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(39, 1, 'pages', 'pages', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(40, 1, 'cbhq', 'cbhq', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(41, 1, 'banners', 'banners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(42, 1, 'favicon.ico', 'favicon.ico', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(43, 1, 'brands', 'brands', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(247, 0, 'simple', 'simple', 0, 1, 'simple', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(45, 1, 'attp', 'attp', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(46, 1, 'shtt', 'shtt', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(47, 1, 'clgp', 'clgp', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(48, 1, 'services', 'services', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(49, 0, 'admins', 'admins', 0, 1, 'admins', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(50, 0, 'seos', 'seos', 0, 1, 'seos', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(51, 0, 'settings', 'settings', 0, 1, 'settings', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(52, 0, 'langs', 'langs', 0, 1, 'langs', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(53, 0, 'menus', 'menus', 0, 1, 'menus', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(75, 0, 'gallerys', 'gallerys', 0, 1, 'gallerys', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(69, 0, 'configs', 'configs', 0, 1, 'configs', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(71, 1, 'rap', 'rap', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(72, 0, 'pages', 'pages', 0, 1, 'pages', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(74, 1, 'calendars', 'calendars', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(177, 0, 'widgets', 'widgets', 0, 1, 'widgets', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(77, 0, 'contacts', 'contacts', 0, 1, 'contacts', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(79, 0, 'banners', 'banners', 0, 1, 'banners', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(287, 1, 'Quản lý cấu hình', 'admin.php?vs=configs', 54, 1, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(94, 1, 'contacts', 'contacts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(527, 1, 'Hỏi đáp', 'faq/', 2, 1, '', 0, '1', '0', '0', 0, '@10001', 0, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(553, 0, 'posts', 'posts', 0, 1, 'posts', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(529, 1, 'Liên hệ', 'contacts/', 4, 1, '', 0, '1', '0', '0', 0, '@10001', 0, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(530, 1, 'Đăng ký', 'users/registry', 5, 1, 'users_registry', 0, '1', '0', '0', 0, '@10001', 0, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(535, 1, 'Quản lý liên hệ', 'admin.php?vs=contacts', 0, 0, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(536, 1, 'Quản lý quảng cáo', 'admin.php?vs=ads', 52, 0, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(537, 1, 'Quản lý địa điểm', 'admin.php?vs=locations', 2, 1, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(248, 1, 'simple', 'simple', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(178, 0, 'products', 'products', 0, 1, 'products', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(179, 1, 'manufacturer', 'manufacturer', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(246, 0, 'abouts', 'abouts', 0, 1, 'abouts', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(135, 1, 'news', 'news', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(136, 1, 'partners', 'partners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(137, 1, 'videos', 'videos', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(138, 1, 'facebook', 'facebook', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(139, 1, 'partner', 'partner', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(140, 1, 'branchs', 'branchs', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(141, 1, 'feel', 'feel', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(526, 1, 'Cập nhật tiệm', 'users/update', 1, 1, 'users_update', 0, '1', '0', '0', 0, '@10001', 0, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(245, 0, 'abouts', 'abouts', 0, 1, 'abouts', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(151, 1, 'bannerglobal', 'bannerglobal', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(152, 1, 'slidebottoms', 'slidebottoms', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(153, 1, 'pcontacts', 'pcontacts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(192, 0, 'files', 'files', 0, 1, 'files', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(249, 0, 'address', 'address', 0, 1, 'address', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(156, 1, 'weblinks', 'weblinks', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(157, 1, 'advisory', 'advisory', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(158, 1, 'knowledge', 'knowledge', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(159, 1, 'comment', 'comment', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(250, 1, 'address', 'address', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(161, 1, 'statistics', 'statistics', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(162, 2, 'posts', 'posts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(163, 2, 'pages', 'pages', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(164, 2, 'cbhq', 'cbhq', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(165, 2, 'services', 'services', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(166, 2, 'advisory', 'advisory', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(167, 2, 'knowledge', 'knowledge', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(168, 2, 'news', 'news', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(169, 2, 'comment', 'comment', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(170, 2, 'banners', 'banners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(171, 2, 'supports', 'supports', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(244, 1, 'abouts', 'abouts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(173, 2, 'partners', 'partners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(174, 2, 'weblinks', 'weblinks', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(175, 2, 'pcontacts', 'pcontacts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(176, 2, 'contacts', 'contacts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(515, 1, 'Quản lý bài đăng', 'admin.php?vs=posts', 1, 1, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(227, 1, 'Chọn danh mục', 'Chọn danh mục', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(226, 1, 'Array', 'Array', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(338, 0, 'slidebanners', 'slidebanners', 0, 1, 'slidebanners', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(230, 1, 'slidebanners', 'slidebanners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(231, 0, 'logos', 'logos', 0, 1, 'logos', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(232, 1, 'logos', 'logos', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(233, 0, 'home', 'home', 0, 1, 'home', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(234, 1, 'products_label', 'products_label', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(235, 0, 'products_label', 'products_label', 0, 1, 'products_label', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(236, 1, 'Sản phẩm bán chạy', 'products_label', 0, 1, NULL, 234, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(237, 1, 'Sản phẩm hot', 'products_label', 0, 1, NULL, 234, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(239, 1, 'productlabels', 'productlabels', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(240, 0, 'orders', 'orders', 0, 1, 'orders', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(254, 1, 'logolefts', 'logolefts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(255, 0, 'news', 'news', 0, 1, 'news', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(256, 0, ' togethers', ' togethers', 0, 1, ' togethers', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(257, 1, ' togethers', ' togethers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(258, 0, 'togethers', 'togethers', 0, 1, 'togethers', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(259, 1, 'togethers', 'togethers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(260, 0, 'supports', 'supports', 0, 1, 'supports', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(261, 0, 'logolefts', 'logolefts', 0, 1, 'logolefts', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(262, 2, 'products', 'products', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(263, 2, 'slidebanners', 'slidebanners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(264, 2, 'simple', 'simple', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(265, 2, 'address', 'address', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(266, 2, 'logos', 'logos', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(267, 2, 'logolefts', 'logolefts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(268, 3, 'products', 'products', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(269, 3, 'pages', 'pages', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(270, 3, 'slidebanners', 'slidebanners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(271, 3, 'supports', 'supports', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(272, 3, 'simple', 'simple', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(273, 3, 'address', 'address', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(274, 3, 'logos', 'logos', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(275, 3, 'logolefts', 'logolefts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(276, 2, 'abouts', 'abouts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(277, 3, 'abouts', 'abouts', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(279, 1, 'Tin công ty', 'news', 2, 1, NULL, 135, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(280, 1, 'Tin chuyên ngành', 'news', 1, 1, NULL, 135, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(525, 1, 'Đăng quảng cáo', 'posts/add', 0, 1, 'post_add', 493, '1', '0', '0', 0, '@10001', 0, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(284, 2, 'togethers', 'togethers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(285, 0, 'global', 'global', 0, 1, 'global', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(286, 3, 'news', 'news', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(442, 1, 'brand', 'brand', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(290, 2, 'Chọn danh mục', 'Chọn danh mục', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(524, 1, 'project', 'project', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(292, 2, 'Array', 'Array', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(294, 0, 'customers', 'customers', 0, 1, 'customers', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(295, 1, 'customers', 'customers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(298, 2, 'Company News', 'news', 1, 1, NULL, 168, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(299, 2, 'Specialized News', 'news', 2, 1, NULL, 168, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(347, 0, 'weblinks', 'weblinks', 0, 1, 'weblinks', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(346, 2, 'home', 'home', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(303, 2, 'customers', 'customers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(522, 0, 'ads', 'ads', 0, 1, 'ads', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(523, 1, 'ads', 'ads', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(306, 2, 'gallerys', 'gallerys', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(313, 3, 'togethers', 'togethers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(315, 3, 'Chọn danh mục', 'Chọn danh mục', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(322, 3, 'customers', 'customers', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(521, 0, 'partners', 'partners', 0, 1, 'partners', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(337, 3, 'banners', 'banners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(348, 0, 'learn', 'learn', 0, 1, 'learn', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(349, 2, 'learn', 'learn', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(350, 0, 'videos', 'videos', 0, 1, 'videos', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(351, 2, 'videos', 'videos', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(352, 2, 'Hoa rẻ quạt', 'learn', 0, 1, NULL, 349, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(353, 2, 'Hoa loa ken', 'learn', 0, 1, NULL, 349, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(356, 0, 'services', 'services', 0, 1, 'services', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(516, 1, 'Nail', 'posts', 0, 1, NULL, 38, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(517, 1, 'Nhà hàng', 'posts', 0, 1, NULL, 38, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(519, 0, 'projects', 'projects', 0, 1, 'projects', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(520, 1, 'projects', 'projects', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(363, 2, 'orders', 'orders', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(366, 2, 'js', 'js', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(369, 2, 'trantuthien@gmail.com', 'trantuthien@gmail.com', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(374, 2, 'images', 'images', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(375, 2, 'domainsigma_removal_09de9b7f53183dd27c8da8f6045f048a6b102658', 'domainsigma_removal_09de9b7f53183dd27c8da8f6045f048a6b102658', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(413, 2, 'wp-admin', 'wp-admin', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(414, 2, 'wordpress', 'wordpress', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(415, 2, 'blog', 'blog', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(416, 2, 'phpmyadmin', 'phpmyadmin', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(417, 2, 'index.php', 'index.php', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(418, 2, 'uploads', 'uploads', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(446, 0, 'subscribes', 'subscribes', 0, 1, 'subscribes', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(447, 1, 'subscribes', 'subscribes', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(448, 0, 'getemail', 'getemail', 0, 1, 'getemail', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(449, 1, 'getEmail', 'getEmail', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(450, 0, 'newsletters', 'newsletters', 0, 1, 'newsletters', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(451, 1, 'newsletters', 'newsletters', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(532, 1, 'Quản lý giới thiệu', 'admin.php?vs=abouts', 0, 0, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(533, 1, 'Quản lý hỏi đáp', 'admin.php?vs=faq', 3, 1, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(534, 1, 'Quản lý hỗ trợ trực tuyến', 'admin.php?vs=supports', 53, 1, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'nickicons', '', '', ''),
(531, 1, 'Quản lý dự án', 'admin.php?vs=projects', 0, 0, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(510, 1, 'Quản lý banner', 'admin.php?vs=banners', 51, 1, '', 0, '1', '0', '0', 0, '@10001', 1, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(538, 1, 'Bán tiệm nail', 'posts', 0, 1, NULL, 516, '0', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(539, 1, 'Cần thợ nail', 'posts', 0, 1, NULL, 516, '0', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(540, 1, 'Cập nhật tiệm', 'posts', 0, 1, NULL, 516, '0', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(541, 1, 'Tuyển dụng', 'posts', 0, 1, NULL, 517, '0', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(542, 1, 'Sang tiệm', 'posts', 0, 1, NULL, 517, '0', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(543, 1, 'Địa điểm ăn uống', 'posts', 0, 1, NULL, 517, '0', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(570, 1, 'Alaska', 'locations', 0, 1, '<p>Alaska ( /əˈl&aelig;skə/) l&agrave; một bang của Hợp ch&uacute;ng quốc Hoa Kỳ, nằm tại đầu t&acirc;y bắc của lục địa Bắc Mỹ. Alaska gi&aacute;p với Canada ở ph&iacute;a đ&ocirc;ng, gi&aacute;p với Bắc Băng Dương ở ph&iacute;a bắc, v&agrave; gi&aacute;p với Th&aacute;i B&igrave;nh Dương ở ph&iacute;a t&acirc;y v&agrave; ph&iacute;a nam, đối diện với Nga qua eo biển Bering. Alaska l&agrave; bang c&oacute; diện t&iacute;ch lớn nhất, &iacute;t d&acirc;n thứ tư v&agrave; thưa d&acirc;n nhất tại Hoa Kỳ. Xấp xỉ một nửa trong số 731.449[2] cư d&acirc;n của Alaska sống trong v&ugrave;ng đ&ocirc; thị Anchorage. Chiếm vị thế chi phối trong nền kinh tế của Alaska l&agrave; c&aacute;c ng&agrave;nh dầu mỏ, kh&iacute; thi&ecirc;n nhi&ecirc;n, v&agrave; ngư nghiệp, cũng l&agrave; những t&agrave;i nguy&ecirc;n m&agrave; Alaska c&oacute; trữ lượng phong ph&uacute;. Du lịch cũng l&agrave; một th&agrave;nh phần quan trọng của nền kinh tế bang.</p>\r\n<p>Người bản địa chiếm giữ v&ugrave;ng đất nay l&agrave; Alaska bắt đầu từ h&agrave;ng ngh&igrave;n năm trước, v&agrave; từ thế kỷ 18 trở đi, c&aacute;c thế lực ch&acirc;u &Acirc;u nhận định việc khai th&aacute;c l&atilde;nh thổ n&agrave;y đ&atilde; ch&iacute;n muồi. Hoa Kỳ mua Alaska từ Đế quốc Nga v&agrave;o ng&agrave;y 30 th&aacute;ng 3 năm 1867. Khu vực trải qua một v&agrave;i thay đổi về mặt h&agrave;nh ch&iacute;nh trước khi được tổ chức th&agrave;nh một l&atilde;nh thổ v&agrave;o ng&agrave;y 11 th&aacute;ng 5 năm 1912. Alaska được c&ocirc;ng nhận l&agrave; bang thứ 49 của Hoa Kỳ v&agrave;o ng&agrave;y 3 th&aacute;ng 1 năm 1959.[3]</p>\r\n<p>Bờ biển của Alaska d&agrave;i hơn tổng chiều d&agrave;i bờ biển của tất cả c&aacute;c bang kh&aacute;c tại Hoa Kỳ.[4] Đ&acirc;y l&agrave; bang kh&ocirc;ng liền kề duy nhất của Hoa Kỳ nằm tr&ecirc;n lục địa Bắc Mỹ; Alaska t&aacute;ch biệt với bang Washington qua 500 dặm (800 km) của tỉnh British Columbia (Canada). Alaska do vậy l&agrave; một l&atilde;nh thổ t&aacute;ch rời của Hoa Kỳ, cũng c&oacute; thể l&agrave; v&ugrave;ng l&atilde;nh thổ t&aacute;ch rời lớn nhất tr&ecirc;n thế giới. Về mặt kỹ thuật th&igrave; Alaska l&agrave; một bộ phận của Hoa Kỳ lục địa, song bang vắng b&oacute;ng trong c&aacute;ch d&ugrave;ng th&ocirc;ng tục của từ n&agrave;y. Thủ phủ của bang l&agrave; Juneau, th&agrave;nh phố nằm tr&ecirc;n lục địa Bắc Mỹ, song kh&ocirc;ng c&oacute; li&ecirc;n kết bằng đường bộ với phần c&ograve;n lại của hệ thống xa lộ Bắc Mỹ.</p>\r\n<p>Ở ph&iacute;a đ&ocirc;ng, Alaska gi&aacute;p với l&atilde;nh thổ Yukon v&agrave; tỉnh British Columbia của Canada; ở ph&iacute;a nam, Alaska gi&aacute;p với vịnh Alaska v&agrave; Th&aacute;i B&igrave;nh Dương; ở ph&iacute;a t&acirc;y, Alaska gi&aacute;p với biển Bering, eo biển Bering, v&agrave; biển Chukchi; ở ph&iacute;a bắc, Alaska gi&aacute;p với Bắc Băng Dương. V&ugrave;ng l&atilde;nh hải của Alaska nằm s&aacute;t với v&ugrave;ng l&atilde;nh hải của Nga tr&ecirc;n eo biển Bering, do đảo Diomede Lớn của Nga v&agrave; đảo Diomede Nhỏ của Alaska chỉ c&aacute;ch nhau 4,8 kil&ocirc;m&eacute;t (3,0 mi). Quần đảo Aleut k&eacute;o d&agrave;i sang Đ&ocirc;ng b&aacute;n cầu, do vậy về mặt kỹ thuật th&igrave; Alaska l&agrave; bang cực đ&ocirc;ng v&agrave; cực t&acirc;y của Hoa Kỳ, cũng như l&agrave; cực bắc.</p>\r\n<p>Alaska l&agrave; bang lớn nhất Hoa Kỳ với diện t&iacute;ch 586.412 dặm vu&ocirc;ng Anh (1.518.800 km2), gấp hai lần k&iacute;ch thước của bang đứng thứ hai l&agrave; Texas. Alaska chỉ nhỏ hơn 18 quốc gia c&oacute; chủ quyền. Diện t&iacute;ch v&ugrave;ng l&atilde;nh hải của Alaska lớn hơn diện t&iacute;ch của ba bang đứng liền sau l&agrave; Texas, California, v&agrave; Montana cộng lại. Diện t&iacute;ch của Alaska cũng lớn hơn tổng diện t&iacute;ch của 22 bang nhỏ nhất tại Hoa Kỳ.</p>\r\n<p>Với cả vạn h&ograve;n đảo, Alaska c&oacute; gần 34.000 dặm (54.720 km) bờ biển. Quần đảo Aleut k&eacute;o d&agrave;i về ph&iacute;a t&acirc;y từ mũi ph&iacute;a nam của b&aacute;n đảo Alaska. Ph&aacute;t hiện được nhiều n&uacute;i lửa hoạt động tr&ecirc;n quần đảo Aleut v&agrave; c&aacute;c khu vực ven biển. Chẳng hạn như tr&ecirc;n đảo Unimak c&oacute; n&uacute;i Shishaldin- l&agrave; một n&uacute;i lửa &acirc;m ỉ cao 10.000 foot (3.048 m) tr&ecirc;n Bắc Th&aacute;i B&igrave;nh Dương. Đ&acirc;y l&agrave; n&uacute;i lửa h&igrave;nh n&oacute;n ho&agrave;n hảo nhất tr&ecirc;n Tr&aacute;i Đất, thậm ch&iacute; c&ograve;n đối xứng hơn cả n&uacute;i Ph&uacute; Sĩ của Nhật Bản. Chuỗi c&aacute;c n&uacute;i lửa k&eacute;o d&agrave;i đến n&uacute;i Spurr ở ph&iacute;a t&acirc;y Anchorage tr&ecirc;n lục địa. C&aacute;c nh&agrave; địa chất học x&aacute;c định Alaska l&agrave; một bộ phận của Wrangellia, một v&ugrave;ng rộng lớn bao gồm cả c&aacute;c v&ugrave;ng đất của Canada ở T&acirc;y Bắc Th&aacute;i B&igrave;nh Dương.</p>\r\n<p>Alaska c&oacute; tr&ecirc;n ba triệu hồ.[5][6] C&aacute;c đồng lầy v&agrave; c&aacute;c v&ugrave;ng đất đ&oacute;ng băng vĩnh cửu ngập nước chiếm diện t&iacute;ch 188.320 dặm vu&ocirc;ng Anh (487.747 km2) (hầu hết nằm tại c&aacute;c b&igrave;nh nguy&ecirc;n ở bắc bộ, t&acirc;y bộ v&agrave; t&acirc;y nam bộ). Băng của c&aacute;c s&ocirc;ng băng bao tr&ugrave;m khoảng 16.000 dặm vu&ocirc;ng Anh (41.440 km2) đất v&agrave; 1.200 dặm vu&ocirc;ng Anh (3.110 km2) v&ugrave;ng triều. Phức hợp s&ocirc;ng băng Bering nằm gần bi&ecirc;n giới đ&ocirc;ng nam với Yukon bao tr&ugrave;m 2.250 dặm vu&ocirc;ng Anh (5.827 km2) bề mặt. Với tr&ecirc;n 100.000 s&ocirc;ng băng, Alaska sở hữu một nửa số s&ocirc;ng băng tr&ecirc;n thế giới.</p>\r\n<p>V&ugrave;ng Đ&ocirc;ng Nam Alaska c&oacute; một kh&iacute; hậu đại dương vĩ độ trung (ph&acirc;n loại kh&iacute; hậu K&ouml;ppen: Cfb) ở phần ph&iacute;a nam v&agrave; một kh&iacute; hậu cận Bắc cực (K&ouml;ppen Cfc) ở phần ph&iacute;a bắc. X&eacute;t theo trung b&igrave;nh h&agrave;ng năm, Đ&ocirc;ng Nam l&agrave; nơi ẩm ướt nhất v&agrave; ấm nhất tại Alaska với nhiệt độ &ocirc;n h&ograve;a h[n v&agrave;o m&ugrave;a đ&ocirc;ng v&agrave; lượng gi&aacute;ng thủy cao quanh năm. Đ&acirc;y cũng l&agrave; v&ugrave;ng duy nhất tại Alaska c&oacute; nhiệt độ trung b&igrave;nh cao ban ng&agrave;y tr&ecirc;n mức đ&oacute;ng băng trong những th&aacute;ng m&ugrave;a đ&ocirc;ng. Kh&iacute; hậu Anchorage v&agrave; Trung Nam Alaska l&agrave; &ocirc;n h&ograve;a theo ti&ecirc;u chuẩn tại Alaska do v&ugrave;ng n&agrave;y nằm gần bờ biển. Mặc d&ugrave; c&oacute; lượng mưa thấp hơn v&ugrave;ng Đ&ocirc;ng Nam Alaska, song v&ugrave;ng n&agrave;y lại c&oacute; nhiều tuyết hơn, v&agrave; ban ng&agrave;y c&oacute; xu hướng quang đ&atilde;ng hơn. Khu vực c&oacute; kh&iacute; hậu cận Bắc cực do c&oacute; một m&ugrave;a h&egrave; ngắn v&agrave; m&aacute;t. Kh&iacute; hậu T&acirc;y Alaska được x&aacute;c định phần lớn nhờ biển Bering v&agrave; vịnh Alaska, v&ugrave;ng n&agrave;y c&oacute; kh&iacute; hậu cận Bắc cực đại dương ở phần t&acirc;y nam v&agrave; kh&iacute; hậu cận Bắc cực lục địa ở xa về ph&iacute;a bắc, c&oacute; lượng gi&aacute;ng thủy lớn. V&ugrave;ng nội địa của Alaska c&oacute; kh&iacute; hậu cận Bắc cực. Một số nhiệt độ cao nhất v&agrave; thấp nhất tại Alaska xảy ra tại khu vực gần Fairbanks. Nhiệt độ c&oacute; thể l&ecirc;n tới khoảng 90 &deg;F (khoảng 30 &deg;C), c&ograve;n m&ugrave;a đ&ocirc;ng c&oacute; thể xuống dưới &minus;60 &deg;F (&minus;51 &deg;C).</p>\r\n<p>Nhiệt độ tối cao v&agrave; tối thấp từng ghi nhận được tại Alaska đều l&agrave; ở v&ugrave;ng Nội địa. Nhiệt độ cao nhất l&agrave; 100 &deg;F (38 &deg;C) ở Fort Yukon (c&aacute;ch 8 mi hoặc 13 km về ph&iacute;a bắc của v&ograve;ng Bắc cực) v&agrave;o ng&agrave;y 27 th&aacute;ng 6 năm 1915,[7][8] Nhiệt độ thấp nhất được ghi nhận tại Alaska l&agrave; &minus;80 &deg;F (&minus;62 &deg;C) tại Prospect Creek v&agrave;o ng&agrave;y 23 th&aacute;ng 1 năm 1971.[7][8]</p>', 544, 'AK', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(544, 1, 'locations', 'locations', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(545, 0, 'locations', 'locations', 0, 1, 'locations', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(573, 1, 'California', 'locations', 0, 1, '<p>California kề cận với Th&aacute;i B&igrave;nh Dương, Oregon, Nevada, Arizona v&agrave; tiểu bang Baja California của Mexico. Tiểu bang n&agrave;y c&oacute; nhiều cảnh tự nhi&ecirc;n rất đẹp, bao gồm Central Valley rộng r&atilde;i, n&uacute;i cao, sa mạc n&oacute;ng nực, v&agrave; h&agrave;ng trăm dặm bờ biển đẹp. Với diện t&iacute;ch 411,000 km2 (160,000 mi2), n&oacute; l&agrave; tiểu bang lớn thứ ba của Hoa Kỳ v&agrave; lớn hơn cả nước Đức v&agrave; cũng như Việt Nam. Hầu hết c&aacute;c th&agrave;nh phố lớn của tiểu bang nằm s&aacute;t hay gần bờ biển Th&aacute;i B&igrave;nh Dương, đ&aacute;ng ch&uacute; &yacute; l&agrave; Los Angeles, San Francisco, San Jose, Long Beach, Oakland, Santa Ana/Quận Cam, v&agrave; San Diego. Tuy nhi&ecirc;n, thủ phủ của tiểu bang, Sacramento, l&agrave; một th&agrave;nh phố lớn nằm trong thung lũng Trung t&acirc;m. Trung t&acirc;m địa l&yacute; của tiểu bang thuộc về Bắc Fork, California.</p>\r\n<p>&nbsp;Địa l&yacute; California phong ph&uacute;, phức tạp v&agrave; đa dạng. Giữa tiểu bang c&oacute; thung lũng Trung t&acirc;m, một thung lũng lớn, m&agrave;u mỡ được bao quanh bởi những d&atilde;y n&uacute;i bờ biển ở ph&iacute;a t&acirc;y, d&atilde;y n&uacute;i đ&aacute; granit Sierra Nevada ở ph&iacute;a đ&ocirc;ng, d&atilde;y n&uacute;i Cascade c&oacute; đ&aacute; lửa ở miền bắc, v&agrave; d&atilde;y n&uacute;i Tehachapi ở miền nam. C&aacute;c s&ocirc;ng, đập nước, v&agrave; k&ecirc;nh chảy từ c&aacute;c n&uacute;i để tưới thung lũng Trung t&acirc;m. Nguồn nước của phần lớn tiểu bang do Dự &aacute;n Nước Tiểu bang cung cấp. Dự &aacute;n Thung lũng Trung t&acirc;m hỗ trợ hệ thống nước của một số th&agrave;nh phố, nhưng chủ yếu cung cấp cho việc tưới ti&ecirc;u n&ocirc;ng nghiệp. Nhờ nạo v&eacute;t, v&agrave;i con s&ocirc;ng đ&atilde; đủ rộng v&agrave; s&acirc;u để cho v&agrave;i th&agrave;nh phố nội địa (nhất l&agrave; Stockton) được trở th&agrave;nh hải cảng. Trung lũng Trung t&acirc;m n&oacute;ng nực v&agrave; m&agrave;u mỡ l&agrave; trung t&acirc;m n&ocirc;ng nghiệp của California v&agrave; trồng một phần lớn c&acirc;y lương thực của Mỹ. Tuy nhi&ecirc;n, việc trồng trọt bị t&agrave;n ph&aacute; bởi nhiệt độ thấp gần điểm đ&ocirc;ng trong m&ugrave;a đ&ocirc;ng. Ph&iacute;a nam của thung lũng, một phần l&agrave; sa mạc, được gọi l&agrave; thung lũng San Joaquin, do nước chảy xuống s&ocirc;ng San Joaquin, c&ograve;n ph&iacute;a bắc được gọi l&agrave; thung lũng Sacramento, do nước chảy xuống s&ocirc;ng Sacramento. Ch&acirc;u thổ vịnh Sacramento &ndash; San Joaquin vừa l&agrave; cửa s&ocirc;ng quan trọng hỗ trợ hệ sinh th&aacute;i nước mặn v&agrave; vừa l&agrave; nguồn nước chủ yếu của phần lớn d&acirc;n cư tiểu bang.</p>\r\n<p>D&atilde;y n&uacute;i Sierra Nevada (tức "d&atilde;y n&uacute;i tuyết" trong tiếng T&acirc;y Ban Nha) ở ph&iacute;a đ&ocirc;ng v&agrave; trung t&acirc;m tiểu bang, c&oacute; n&uacute;i Whitney l&agrave; đỉnh n&uacute;i cao nhất trong 48 tiểu bang (4,421 m&eacute;t (14,505 feet)). Trong d&atilde;y Sierra c&ograve;n c&oacute; C&ocirc;ng vi&ecirc;n Quốc gia Yosemite nổi tiếng v&agrave; hồ Tahoe (một hồ nước ngọt s&acirc;u v&agrave; l&agrave; hồ lớn nhất của tiểu bang theo thể t&iacute;ch). B&ecirc;n ph&iacute;a đ&ocirc;ng của d&atilde;y Sierra l&agrave; thung lũng Owens v&agrave; hồ Mono &ndash; nơi sinh sống chủ yếu của chim biển. C&ograve;n b&ecirc;n ph&iacute;a t&acirc;y l&agrave; hồ Clear, hồ nước ngọt lớn nhất của California theo diện t&iacute;ch. V&agrave;o m&ugrave;a đ&ocirc;ng, nhiệt độ ở d&atilde;y Sierra Nevada xuống tới nhiệt độ đ&oacute;ng băng v&agrave; ở đ&acirc;y c&oacute; h&agrave;ng chục d&ograve;ng s&ocirc;ng băng nhỏ, trong đ&oacute; c&oacute; s&ocirc;ng băng cực nam của Hoa Kỳ, s&ocirc;ng băng Palisade.</p>\r\n<p>Rừng che phủ khoảng 35% tổng diện t&iacute;ch tiểu bang v&agrave; California c&oacute; nhiều loại th&ocirc;ng hơn bất cứ tiểu bang n&agrave;o kh&aacute;c. Về diện t&iacute;ch rừng, California chỉ đứng sau Alaska mặc d&ugrave; tỉ lệ rừng theo diện t&iacute;ch nhỏ hơn một số tiểu bang kh&aacute;c. Phần lớn của rừng ở đ&acirc;y ở ph&iacute;a t&acirc;y bắc tiểu bang v&agrave; triền ph&iacute;a t&acirc;y d&atilde;y Sierra Nevada. Những c&aacute;nh rừng nhỏ hơn với chủ yếu l&agrave; c&acirc;y sồi dọc theo những d&atilde;y n&uacute;i California gần bờ biển hơn, v&agrave; cả những đồi thấp dưới ch&acirc;n d&atilde;y Sierra Nevada. Những rừng th&ocirc;ng nhỏ hơn c&oacute; ở c&aacute;c d&atilde;y n&uacute;i San Gabriel v&agrave; San Bernardino ở miền Nam California cũng như tr&ecirc;n những v&ugrave;ng n&uacute;i ở miền trung Quận San Diego.</p>\r\n<p>C&aacute;c sa mạc ở California chiếm 25% tổng diện t&iacute;ch. Ở miền nam c&oacute; d&atilde;y n&uacute;i Transverse v&agrave; một hồ nước mặn lớn &ndash; biển Salton. Sa mạc ph&iacute;a trung nam được gọi l&agrave; Mojave. Ph&iacute;a đ&ocirc;ng nam của sa mạc n&agrave;y l&agrave; thung lũng Chết, l&agrave; nơi c&oacute; Badwater Flat &ndash; điểm thấp nhất v&agrave; n&oacute;ng nhất của Bắc Mỹ. Điểm thấp nhất của thung lũng Chết c&aacute;ch đỉnh của n&uacute;i Whitney &iacute;t hơn 322 km (200 dặm). Con người đ&atilde; v&agrave;i lần cố gắng đi bộ từ điểm n&agrave;y tới điểm kia v&agrave; người nổi tiếng nhất l&agrave; Lee Bergthold. Thực sự hầu như cả miền đ&ocirc;ng nam California l&agrave; sa mạc kh&ocirc; cằn v&agrave; n&oacute;ng bức, v&agrave; c&aacute;c thung lũng Coachella v&agrave; Imperial thường c&oacute; nhiệt độ rất cao v&agrave;o m&ugrave;a h&egrave;.</p>\r\n<p>Nằm theo bờ biển d&agrave;i v&agrave; đ&ocirc;ng đ&uacute;c d&acirc;n cư của California l&agrave; v&agrave;i khu vực đ&ocirc; thị lớn, bao gồm San Jose&ndash;San Francisco&ndash;Oakland, Los Angeles&ndash;Long Beach, Santa Ana&ndash;Irvine&ndash;Anaheim, v&agrave; San Diego. Thời tiết gần Th&aacute;i B&igrave;nh Dương rất &ocirc;n h&ograve;a so với những kh&iacute; hậu trong đất liền. Nhiệt độ kh&ocirc;ng bao giờ xuống tới điểm đ&ocirc;ng v&agrave;o m&ugrave;a đ&ocirc;ng (hầu như kh&ocirc;ng c&oacute; tuyết) v&agrave; nhiệt độ hiếm khi l&ecirc;n tr&ecirc;n 30&deg;C (gần 80&deg;F).</p>\r\n<p>California nổi tiếng về động đất v&igrave; c&oacute; nhiều vết đứt g&atilde;y, nhất l&agrave; vết đứt g&atilde;y San Andreas. Tuy ở nhiều tiểu bang kh&aacute;c như Alaska, Washington, Oregon, v&agrave; Missouri đ&atilde; xảy ra c&aacute;c trận động đất rất mạnh (g&acirc;y ra bởi vết đứt g&atilde;y New Madrid), nhưng nhiều người biết đến những động đất ở California hơn v&igrave; ch&uacute;ng xảy ra thường xuy&ecirc;n v&agrave; hay xảy ra ở những v&ugrave;ng đ&ocirc;ng d&acirc;n cư.</p>\r\n<p>California cũng c&oacute; v&agrave;i n&uacute;i lửa, một số c&ograve;n hoạt động như n&uacute;i lửa Mammoth. Những n&uacute;i lửa kh&aacute;c bao gồm đỉnh Lassen, n&oacute; phun nham thạch từ 1914 đến 1921, v&agrave; n&uacute;i lửa Shasta.</p>', 544, 'CA', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(556, 1, 'faq', 'faq', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(557, 1, 'Nail', 'faq', 1, 1, NULL, 556, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(558, 1, 'Nhà hàng', 'faq', 2, 1, NULL, 556, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(559, 1, 'Bất động sản', 'faq', 3, 1, NULL, 556, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(560, 1, 'Đăng nhập', 'users/login', 6, 1, 'users_login', 0, '1', '0', '0', 0, '@10001', 0, '', '', '', '', '', 'Chọn danh mục', '', '', ''),
(561, 1, 'slidebanner', 'slidebanner', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(562, 1, 'Nail', 'contacts', 0, 1, NULL, 94, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(563, 1, 'Nhà hàng', 'contacts', 1, 1, NULL, 94, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(564, 1, 'Bất động sản', 'contacts', 2, 1, NULL, 94, '0', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(565, 0, 'users', 'users', 0, 1, 'users', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(566, 1, 'location', 'location', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(567, 1, 'users', 'users', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(568, 1, 'files', 'files', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', '', '', '', '', 'Array', '', '', ''),
(569, 1, 'Alabama', 'locations', 0, 1, NULL, 544, 'AL', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(571, 1, 'Arizona', 'locations', 0, 1, NULL, 544, 'AZ', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(572, 1, 'Arkansas', 'locations', 0, 1, NULL, 544, 'AR', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(574, 1, 'Colorado', 'locations', 0, 1, NULL, 544, 'CO', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(575, 1, 'Connecticut', 'locations', 0, 1, NULL, 544, 'CT', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(576, 1, 'Delaware', 'locations', 0, 1, NULL, 544, 'DE', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(577, 1, 'Florida', 'locations', 0, 1, NULL, 544, 'FL', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(578, 1, 'Georgia', 'locations', 0, 1, NULL, 544, 'GA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(579, 1, 'Hawaii', 'locations', 0, 1, NULL, 544, 'HI', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(580, 1, 'Idaho', 'locations', 0, 1, NULL, 544, 'ID', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(581, 1, 'Illinois', 'locations', 0, 1, NULL, 544, 'IL', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(582, 1, 'Indiana', 'locations', 0, 1, NULL, 544, 'IN', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(583, 1, 'Iowa', 'locations', 0, 1, NULL, 544, 'IA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(584, 1, 'Kansas', 'locations', 0, 1, NULL, 544, 'KS', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(585, 1, 'Kentucky', 'locations', 0, 1, NULL, 544, 'KY', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(586, 1, 'Louisiana', 'locations', 0, 1, NULL, 544, 'LA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(587, 1, 'Maine', 'locations', 0, 1, NULL, 544, 'ME', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(588, 1, 'Maryland', 'locations', 0, 1, NULL, 544, 'MD', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(589, 1, 'Massachusetts', 'locations', 0, 1, NULL, 544, 'MA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(590, 1, 'Michigan', 'locations', 0, 1, NULL, 544, 'MI', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(591, 1, 'Minnesota', 'locations', 0, 1, NULL, 544, 'MN', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(592, 1, 'Mississippi', 'locations', 0, 1, NULL, 544, 'MS', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(593, 1, 'Missouri', 'locations', 0, 1, NULL, 544, 'MO', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(594, 1, 'Montana', 'locations', 0, 1, NULL, 544, 'MT', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(595, 1, 'Nebraska', 'locations', 0, 1, NULL, 544, 'NE', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(596, 1, 'Nevada', 'locations', 0, 1, NULL, 544, 'NV', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(597, 1, 'New Hampshire', 'locations', 0, 1, NULL, 544, 'NH', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(598, 1, 'New Jersey', 'locations', 0, 1, NULL, 544, 'NJ', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(599, 1, 'New Mexico', 'locations', 0, 1, NULL, 544, 'NM', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(600, 1, 'New York', 'locations', 0, 1, NULL, 544, 'NY', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(601, 1, 'North Carolina', 'locations', 0, 1, NULL, 544, 'NC', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(602, 1, 'North Dakota', 'locations', 0, 1, NULL, 544, 'ND', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(603, 1, 'Ohio', 'locations', 0, 1, NULL, 544, 'OH', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(604, 1, 'Oklahoma', 'locations', 0, 1, NULL, 544, 'OK', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(605, 1, 'Oregon', 'locations', 0, 1, NULL, 544, 'OR', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(606, 1, 'Pennsylvania', 'locations', 0, 1, NULL, 544, 'PA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(607, 1, 'Rhode Island', 'locations', 0, 1, NULL, 544, 'RI', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(608, 1, 'South Carolina', 'locations', 0, 1, NULL, 544, 'SC', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(609, 1, 'South Dakota', 'locations', 0, 1, NULL, 544, 'SD', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(610, 1, 'Tennessee', 'locations', 0, 1, NULL, 544, 'TN', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(611, 1, 'Texas', 'locations', 0, 1, NULL, 544, 'TX', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(612, 1, 'Utah', 'locations', 0, 1, NULL, 544, 'UT', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(613, 1, 'Vermont', 'locations', 0, 1, NULL, 544, 'VT', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(614, 1, 'Virginia', 'locations', 0, 1, NULL, 544, 'VA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(615, 1, 'Washington', 'locations', 0, 1, NULL, 544, 'WA', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(616, 1, 'West Virginia', 'locations', 0, 1, NULL, 544, 'WV', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(617, 1, 'Wisconsin', 'locations', 0, 1, NULL, 544, 'WI', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(618, 1, 'Wyoming', 'locations', 0, 1, NULL, 544, 'WY', '0', '0', 2, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(620, 1, 'Adak', 'locations', 0, 1, NULL, 570, '99570', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(621, 1, 'Akhiok', 'locations', 0, 1, NULL, 570, '99615', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(622, 1, 'Akiak', 'locations', 0, 1, NULL, 570, '99552', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(623, 1, 'Akutan', 'locations', 0, 1, NULL, 570, '99553', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(624, 1, 'Alakanuk', 'locations', 0, 1, NULL, 570, '99554', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(625, 1, 'Aleknagik', 'locations', 0, 1, NULL, 570, '99555', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(626, 1, 'Allakaket', 'locations', 0, 1, NULL, 570, '99720', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(627, 1, 'Ambler', 'locations', 0, 1, NULL, 570, '99786', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(628, 1, 'Anaktuvuk Pass', 'locations', 0, 1, NULL, 570, '99721', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(629, 1, 'Anchorage', 'locations', 0, 1, NULL, 570, '99501', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(630, 1, 'Anderson', 'locations', 0, 1, NULL, 570, '99744', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(631, 1, 'Angoon', 'locations', 0, 1, NULL, 570, '99820', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(632, 1, 'Aniak', 'locations', 0, 1, NULL, 570, '99557', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(633, 1, 'Anvik', 'locations', 0, 1, NULL, 570, '99558', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(634, 1, 'Atka', 'locations', 0, 1, NULL, 570, '99547', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(635, 1, 'Atqasuk', 'locations', 0, 1, NULL, 570, '99791', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(636, 1, 'Barrow', 'locations', 0, 1, NULL, 570, '99723', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', '');
INSERT INTO `vsf_menu` (`menuId`, `langId`, `menuTitle`, `menuUrl`, `menuIndex`, `menuStatus`, `menuAlt`, `parentId`, `menuIsLink`, `menuIsDropDown`, `menuType`, `menuLevel`, `menuPosition`, `menuIsAdmin`, `menuBackup`, `menuFileId`, `menuSlug`, `menuQuick`, `menuTemplate`, `menuCate`, `menuMtTitle`, `menuMtKeyWord`, `menuMtDesc`) VALUES
(637, 1, 'Bethel', 'locations', 0, 1, NULL, 570, '99559', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(638, 1, 'Bettles', 'locations', 0, 1, NULL, 570, '99726', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(639, 1, 'Brevig Mission', 'locations', 0, 1, NULL, 570, '99785', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(640, 1, 'Buckland', 'locations', 0, 1, NULL, 570, '99727', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(641, 1, 'Chefornak', 'locations', 0, 1, NULL, 570, '99561', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(642, 1, 'Chevak', 'locations', 0, 1, NULL, 570, '99563', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(643, 1, 'Chignik', 'locations', 0, 1, NULL, 570, '99564', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(644, 1, 'Chuathbaluk', 'locations', 0, 1, NULL, 570, '99557', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(645, 1, 'Clark''s Point', 'locations', 0, 1, NULL, 570, '99569', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(646, 1, 'Coffman Cove', 'locations', 0, 1, NULL, 570, '99918', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(647, 1, 'Cold Bay', 'locations', 0, 1, NULL, 570, '99571', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(648, 1, 'Cordova', 'locations', 0, 1, NULL, 570, '99574', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(649, 1, 'Craig', 'locations', 0, 1, NULL, 570, '99921', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(650, 1, 'Deering', 'locations', 0, 1, NULL, 570, '99736', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(651, 1, 'Delta Junction', 'locations', 0, 1, NULL, 570, '99737', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(652, 1, 'Dillingham', 'locations', 0, 1, NULL, 570, '99576', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(653, 1, 'Diomede', 'locations', 0, 1, NULL, 570, '99762', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(654, 1, 'Eagle', 'locations', 0, 1, NULL, 570, '99738', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(655, 1, 'Eek', 'locations', 0, 1, NULL, 570, '99578', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(656, 1, 'Egegik', 'locations', 0, 1, NULL, 570, '99579', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(657, 1, 'Ekwok', 'locations', 0, 1, NULL, 570, '99580', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(658, 1, 'Elim', 'locations', 0, 1, NULL, 570, '99739', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(659, 1, 'Emmonak', 'locations', 0, 1, NULL, 570, '99581', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(660, 1, 'Fairbanks', 'locations', 0, 1, NULL, 570, '99701', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(661, 1, 'False Pass', 'locations', 0, 1, NULL, 570, '99583', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(662, 1, 'Fort Yukon', 'locations', 0, 1, NULL, 570, '99740', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(663, 1, 'Galena', 'locations', 0, 1, NULL, 570, '99741', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(664, 1, 'Gambell', 'locations', 0, 1, NULL, 570, '99742', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(665, 1, 'Golovin', 'locations', 0, 1, NULL, 570, '99762', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(666, 1, 'Goodnews Bay', 'locations', 0, 1, NULL, 570, '99589', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(667, 1, 'Grayling', 'locations', 0, 1, NULL, 570, '99590', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(668, 1, 'Gustavus', 'locations', 0, 1, NULL, 570, '99826', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(669, 1, 'Holy Cross', 'locations', 0, 1, NULL, 570, '99602', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(670, 1, 'Homer', 'locations', 0, 1, NULL, 570, '99603', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(671, 1, 'Hoonah', 'locations', 0, 1, NULL, 570, '99829', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(672, 1, 'Hooper Bay', 'locations', 0, 1, NULL, 570, '99604', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(673, 1, 'Houston', 'locations', 0, 1, NULL, 570, '99694', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(674, 1, 'Hughes', 'locations', 0, 1, NULL, 570, '99745', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(675, 1, 'Huslia', 'locations', 0, 1, NULL, 570, '99746', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(676, 1, 'Hydaburg', 'locations', 0, 1, NULL, 570, '99922', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(677, 1, 'Juneau', 'locations', 0, 1, NULL, 570, '99801', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(678, 1, 'Kachemak', 'locations', 0, 1, NULL, 570, '99603', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(679, 1, 'Kake', 'locations', 0, 1, NULL, 570, '99830', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(680, 1, 'Kaktovik', 'locations', 0, 1, NULL, 570, '99747', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(681, 1, 'Kaltag', 'locations', 0, 1, NULL, 570, '99748', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(682, 1, 'Kasaan', 'locations', 0, 1, NULL, 570, '99919', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(683, 1, 'Kenai', 'locations', 0, 1, NULL, 570, '99611', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(684, 1, 'Ketchikan', 'locations', 0, 1, NULL, 570, '99901', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(685, 1, 'Kiana', 'locations', 0, 1, NULL, 570, '99749', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(686, 1, 'King Cove', 'locations', 0, 1, NULL, 570, '99612', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(687, 1, 'Kivalina', 'locations', 0, 1, NULL, 570, '99750', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(688, 1, 'Klawock', 'locations', 0, 1, NULL, 570, '99925', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(689, 1, 'Kobuk', 'locations', 0, 1, NULL, 570, '99751', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(690, 1, 'Kodiak', 'locations', 0, 1, NULL, 570, '99615', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(691, 1, 'Kotlik', 'locations', 0, 1, NULL, 570, '99620', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(692, 1, 'Kotzebue', 'locations', 0, 1, NULL, 570, '99752', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(693, 1, 'Koyuk', 'locations', 0, 1, NULL, 570, '99753', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(694, 1, 'Koyukuk', 'locations', 0, 1, NULL, 570, '99754', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(695, 1, 'Kupreanof', 'locations', 0, 1, NULL, 570, '99833', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(696, 1, 'Kwethluk', 'locations', 0, 1, NULL, 570, '99621', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(697, 1, 'Larsen Bay', 'locations', 0, 1, NULL, 570, '99624', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(698, 1, 'Lower Kalskag', 'locations', 0, 1, NULL, 570, '99626', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(699, 1, 'Manokotak', 'locations', 0, 1, NULL, 570, '99628', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(700, 1, 'Marshall', 'locations', 0, 1, NULL, 570, '99585', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(701, 1, 'McGrath', 'locations', 0, 1, NULL, 570, '99627', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(702, 1, 'Mekoryuk', 'locations', 0, 1, NULL, 570, '99630', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(703, 1, 'Mountain Village', 'locations', 0, 1, NULL, 570, '99632', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(704, 1, 'Napakiak', 'locations', 0, 1, NULL, 570, '99634', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(705, 1, 'Napaskiak', 'locations', 0, 1, NULL, 570, '99559', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(706, 1, 'Nenana', 'locations', 0, 1, NULL, 570, '99760', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(707, 1, 'Newhalen', 'locations', 0, 1, NULL, 570, '99606', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(708, 1, 'New Stuyahok', 'locations', 0, 1, NULL, 570, '99636', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(709, 1, 'Nightmute', 'locations', 0, 1, NULL, 570, '99690', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(710, 1, 'Nikolai', 'locations', 0, 1, NULL, 570, '99691', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(711, 1, 'Nome', 'locations', 0, 1, NULL, 570, '99762', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(712, 1, 'Nondalton', 'locations', 0, 1, NULL, 570, '99640', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(713, 1, 'Noorvik', 'locations', 0, 1, NULL, 570, '99763', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(714, 1, 'North Pole', 'locations', 0, 1, NULL, 570, '99705', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(715, 1, 'Nuiqsut', 'locations', 0, 1, NULL, 570, '99789', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(716, 1, 'Nulato', 'locations', 0, 1, NULL, 570, '99765', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(717, 1, 'Nunam Iqua', 'locations', 0, 1, NULL, 570, '99666', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(718, 1, 'Nunapitchuk', 'locations', 0, 1, NULL, 570, '99641', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(719, 1, 'Old Harbor', 'locations', 0, 1, NULL, 570, '99643', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(720, 1, 'Ouzinkie', 'locations', 0, 1, NULL, 570, '99644', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(721, 1, 'Palmer', 'locations', 0, 1, NULL, 570, '99645', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(722, 1, 'Pelican', 'locations', 0, 1, NULL, 570, '99832', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(723, 1, 'Petersburg', 'locations', 0, 1, NULL, 570, '99833', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(724, 1, 'Pilot Point', 'locations', 0, 1, NULL, 570, '99649', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(725, 1, 'Pilot Station', 'locations', 0, 1, NULL, 570, '99650', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(726, 1, 'Platinum', 'locations', 0, 1, NULL, 570, '99651', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(727, 1, 'Point Hope', 'locations', 0, 1, NULL, 570, '99766', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(728, 1, 'Port Alexander', 'locations', 0, 1, NULL, 570, '99836', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(729, 1, 'Port Heiden', 'locations', 0, 1, NULL, 570, '99549', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(730, 1, 'Port Lions', 'locations', 0, 1, NULL, 570, '99550', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(731, 1, 'Quinhagak', 'locations', 0, 1, NULL, 570, '99655', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(732, 1, 'Ruby', 'locations', 0, 1, NULL, 570, '99768', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(733, 1, 'Russian Mission', 'locations', 0, 1, NULL, 570, '99657', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(734, 1, 'Sand Point', 'locations', 0, 1, NULL, 570, '99661', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(735, 1, 'Savoonga', 'locations', 0, 1, NULL, 570, '99769', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(736, 1, 'Saxman', 'locations', 0, 1, NULL, 570, '99901', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(737, 1, 'Scammon Bay', 'locations', 0, 1, NULL, 570, '99662', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(738, 1, 'Selawik', 'locations', 0, 1, NULL, 570, '99770', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(739, 1, 'Seldovia', 'locations', 0, 1, NULL, 570, '99663', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(740, 1, 'Seward', 'locations', 0, 1, NULL, 570, '99664', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(741, 1, 'Shageluk', 'locations', 0, 1, NULL, 570, '99665', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(742, 1, 'Shaktoolik', 'locations', 0, 1, NULL, 570, '99771', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(743, 1, 'Shishmaref', 'locations', 0, 1, NULL, 570, '99772', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(744, 1, 'Shungnak', 'locations', 0, 1, NULL, 570, '99773', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(745, 1, 'Sitka', 'locations', 0, 1, NULL, 570, '99835', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(746, 1, 'Soldotna', 'locations', 0, 1, NULL, 570, '99669', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(747, 1, 'Stebbins', 'locations', 0, 1, NULL, 570, '99671', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(748, 1, 'St. George', 'locations', 0, 1, NULL, 570, '99591', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(749, 1, 'St. Mary''s', 'locations', 0, 1, NULL, 570, '99658', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(750, 1, 'St. Michael', 'locations', 0, 1, NULL, 570, '99659', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(751, 1, 'St. Paul', 'locations', 0, 1, NULL, 570, '99660', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(752, 1, 'Tanana', 'locations', 0, 1, NULL, 570, '99777', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(753, 1, 'Teller', 'locations', 0, 1, '', 570, '99778', '0', '0', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(754, 1, 'Tenakee Springs', 'locations', 0, 1, NULL, 570, '99841', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(755, 1, 'Thorne Bay', 'locations', 0, 1, NULL, 570, '99919', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(756, 1, 'Togiak', 'locations', 0, 1, NULL, 570, '99678', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(757, 1, 'Toksook Bay', 'locations', 0, 1, NULL, 570, '99637', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(758, 1, 'Unalakleet', 'locations', 0, 1, NULL, 570, '99684', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(759, 1, 'Unalaska', 'locations', 0, 1, NULL, 570, '99685', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(760, 1, 'Upper Kalskag', 'locations', 0, 1, NULL, 570, '99607', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(761, 1, 'Valdez', 'locations', 0, 1, NULL, 570, '99686', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(762, 1, 'Wainwright', 'locations', 0, 1, NULL, 570, '99782', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(763, 1, 'Wales', 'locations', 0, 1, NULL, 570, '99783', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(764, 1, 'Wasilla', 'locations', 0, 1, NULL, 570, '99654', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(765, 1, 'White Mountain', 'locations', 0, 1, NULL, 570, '99784', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(766, 1, 'Whittier', 'locations', 0, 1, NULL, 570, '99693', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(767, 1, 'Wrangell', 'locations', 0, 1, NULL, 570, '99929', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(768, 1, 'Abbeville', 'locations', 0, 1, '<p>Abbeville has the unique distinction of being both the birthplace and the deathbed of the Confederacy. On November 22, 1860, a meeting was held at Abbeville, at a site since dubbed "Secession Hill", to launch South Carolina''s secession from the Union; one month later, the state of South Carolina became the first state to secede.</p>\r\n<p>Abbeville is considered to be the home of noted states'' rights advocate and Vice President of the United States John C. Calhoun, as he was born on a farm on the outskirts.[8]</p>\r\n<p>At the end of the Civil War, with the Confederacy in shambles, Confederate President Jefferson Davis fled Richmond, Virginia, and headed south, stopping for a night in Abbeville at the home of his friend Armistead Burt. It was on May 2, 1865, in the front parlor of what is now known as the Burt-Stark Mansion that Jefferson Davis officially acknowledged the dissolution of the Confederate government.</p>', 569, '36310', '0', '0', 3, '@00000', -1, '', '', '', '', '', 'Array', '', '', ''),
(769, 1, 'Adamsville', 'locations', 0, 1, '<p>Adamsville - Is located in Southwest Atlanta, west of I-285. The main artery in Adamsville is Martin Luther King, Jr., Drive. The 2000 Census reported the total population was around 17,273 with a population breakdown of approxmiately - 94% Black, 5% Hispanic, and 1% White &nbsp;Average income for 70% of the residents was under $50,000 per year - Most homes range in value for $70,000 to $175,000. Adamsville offers an array of resources to enhance the quality of life.</p>', 569, '35005', '0', '0', 3, '@00000', -1, '', '3697', '', '', '', 'Array', '', '', ''),
(770, 1, 'Addison', 'locations', 0, 1, NULL, 569, '35540', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(771, 1, 'Akron', 'locations', 0, 1, NULL, 569, '35441', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(772, 1, 'Alabaster', 'locations', 0, 1, NULL, 569, '35007', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(773, 1, 'Albertville', 'locations', 0, 1, NULL, 569, '35950', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(774, 1, 'Alexander City', 'locations', 0, 1, NULL, 569, '35010', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(775, 1, 'Aliceville', 'locations', 0, 1, NULL, 569, '35442', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(776, 1, 'Allgood', 'locations', 0, 1, NULL, 569, '35121', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(777, 1, 'Altoona', 'locations', 0, 1, NULL, 569, '35952', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(778, 1, 'Andalusia', 'locations', 0, 1, NULL, 569, '36420', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(779, 1, 'Anderson', 'locations', 0, 1, NULL, 569, '35610', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(780, 1, 'Anniston', 'locations', 0, 1, NULL, 569, '36201', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(781, 1, 'Arab', 'locations', 0, 1, NULL, 569, '35016', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(782, 1, 'Ardmore', 'locations', 0, 1, NULL, 569, '35739', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(783, 1, 'Argo', 'locations', 0, 1, NULL, 569, '35120', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(784, 1, 'Ariton', 'locations', 0, 1, NULL, 569, '36311', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(785, 1, 'Arley', 'locations', 0, 1, NULL, 569, '35541', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(786, 1, 'Ashford', 'locations', 0, 1, NULL, 569, '36312', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(787, 1, 'Ashland', 'locations', 0, 1, NULL, 569, '36251', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(788, 1, 'Ashville', 'locations', 0, 1, NULL, 569, '35953', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(789, 1, 'Athens', 'locations', 0, 1, NULL, 569, '35611', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(790, 1, 'Atmore', 'locations', 0, 1, NULL, 569, '36502', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(791, 1, 'Attalla', 'locations', 0, 1, NULL, 569, '35954', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(792, 1, 'Auburn', 'locations', 0, 1, NULL, 569, '36830', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(793, 1, 'Autaugaville', 'locations', 0, 1, NULL, 569, '36003', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(794, 1, 'Avon', 'locations', 0, 1, NULL, 569, '36312', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(795, 1, 'Babbie', 'locations', 0, 1, NULL, 569, '36467', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(796, 1, 'Baileyton', 'locations', 0, 1, NULL, 569, '35019', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(797, 1, 'Bakerhill', 'locations', 0, 1, NULL, 569, '36027', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(798, 1, 'Banks', 'locations', 0, 1, NULL, 569, '36081', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(799, 1, 'Bay Minette', 'locations', 0, 1, NULL, 569, '36507', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(800, 1, 'Bayou La Batre', 'locations', 0, 1, NULL, 569, '36509', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(801, 1, 'Bear Creek', 'locations', 0, 1, NULL, 569, '35543', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(802, 1, 'Beatrice', 'locations', 0, 1, NULL, 569, '36425', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(803, 1, 'Beaverton', 'locations', 0, 1, NULL, 569, '35544', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(804, 1, 'Belk', 'locations', 0, 1, NULL, 569, '35545', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(805, 1, 'Benton', 'locations', 0, 1, NULL, 569, '36785', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(806, 1, 'Berry', 'locations', 0, 1, NULL, 569, '35570', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(807, 1, 'Bessemer', 'locations', 0, 1, NULL, 569, '35020', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(808, 1, 'Billingsley', 'locations', 0, 1, NULL, 569, '36006', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(809, 1, 'Birmingham', 'locations', 0, 1, NULL, 569, '35203', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(810, 1, 'Black', 'locations', 0, 1, NULL, 569, '36314', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(811, 1, 'Blountsville', 'locations', 0, 1, NULL, 569, '35031', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(812, 1, 'Blue Springs', 'locations', 0, 1, NULL, 569, '36017', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(813, 1, 'Boaz', 'locations', 0, 1, NULL, 569, '35957', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(814, 1, 'Boligee', 'locations', 0, 1, NULL, 569, '35443', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(815, 1, 'Bon Air', 'locations', 0, 1, NULL, 569, '35032', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(816, 1, 'Brantley', 'locations', 0, 1, NULL, 569, '36009', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(817, 1, 'Brent', 'locations', 0, 1, NULL, 569, '35034', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(818, 1, 'Brewton', 'locations', 0, 1, NULL, 569, '36426', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(819, 1, 'Bridgeport', 'locations', 0, 1, NULL, 569, '35740', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(820, 1, 'Brighton', 'locations', 0, 1, NULL, 569, '35020', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(821, 1, 'Brilliant', 'locations', 0, 1, NULL, 569, '35548', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(822, 1, 'Brookside', 'locations', 0, 1, NULL, 569, '35036', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(823, 1, 'Brookwood', 'locations', 0, 1, NULL, 569, '35444', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(824, 1, 'Brundidge', 'locations', 0, 1, NULL, 569, '36010', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(825, 1, 'Butler', 'locations', 0, 1, NULL, 569, '36904', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(826, 1, 'Calera', 'locations', 0, 1, NULL, 569, '35040', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(827, 1, 'Camden', 'locations', 0, 1, NULL, 569, '36726', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(828, 1, 'Camp Hill', 'locations', 0, 1, NULL, 569, '36850', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(829, 1, 'Carbon Hill', 'locations', 0, 1, NULL, 569, '35549', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(830, 1, 'Cardiff', 'locations', 0, 1, NULL, 569, '35073', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(831, 1, 'Carolina', 'locations', 0, 1, NULL, 569, '36420', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(832, 1, 'Carrollton', 'locations', 0, 1, NULL, 569, '35447', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(833, 1, 'Castleberry', 'locations', 0, 1, NULL, 569, '36432', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(834, 1, 'Cedar Bluff', 'locations', 0, 1, NULL, 569, '35959', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(835, 1, 'Center Point', 'locations', 0, 1, NULL, 569, '35215', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(836, 1, 'Centre', 'locations', 0, 1, NULL, 569, '35960', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(837, 1, 'Centreville', 'locations', 0, 1, NULL, 569, '35042', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(838, 1, 'Chatom', 'locations', 0, 1, NULL, 569, '36518', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(839, 1, 'Chelsea', 'locations', 0, 1, NULL, 569, '35043', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(840, 1, 'Cherokee', 'locations', 0, 1, NULL, 569, '35616', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(841, 1, 'Chickasaw', 'locations', 0, 1, NULL, 569, '36611', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(842, 1, 'Childersburg', 'locations', 0, 1, NULL, 569, '35044', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(843, 1, 'Citronelle', 'locations', 0, 1, NULL, 569, '36522', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(844, 1, 'Clanton', 'locations', 0, 1, NULL, 569, '35045', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(845, 1, 'Clay', 'locations', 0, 1, NULL, 569, '35126', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(846, 1, 'Clayhatchee', 'locations', 0, 1, NULL, 569, '36322', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(847, 1, 'Clayton', 'locations', 0, 1, NULL, 569, '36016', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(848, 1, 'Cleveland', 'locations', 0, 1, NULL, 569, '35049', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(849, 1, 'Clio', 'locations', 0, 1, NULL, 569, '36017', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(850, 1, 'Coaling', 'locations', 0, 1, NULL, 569, '35453', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(851, 1, 'Coffee Springs', 'locations', 0, 1, NULL, 569, '36318', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(852, 1, 'Coffeeville', 'locations', 0, 1, NULL, 569, '36524', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(853, 1, 'Coker', 'locations', 0, 1, NULL, 569, '35452', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(854, 1, 'Collinsville', 'locations', 0, 1, NULL, 569, '35961', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(855, 1, 'Colony', 'locations', 0, 1, NULL, 569, '35077', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(856, 1, 'Columbia', 'locations', 0, 1, NULL, 569, '36319', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(857, 1, 'Columbiana', 'locations', 0, 1, NULL, 569, '35051', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(858, 1, 'Coosada', 'locations', 0, 1, NULL, 569, '36020', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(859, 1, 'Cordova', 'locations', 0, 1, NULL, 569, '35550', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(860, 1, 'Cottonwood', 'locations', 0, 1, NULL, 569, '36320', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(861, 1, 'County Line', 'locations', 0, 1, NULL, 569, '35172', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(862, 1, 'Courtland', 'locations', 0, 1, NULL, 569, '35618', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(863, 1, 'Cowarts', 'locations', 0, 1, NULL, 569, '36321', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(864, 1, 'Creola', 'locations', 0, 1, NULL, 569, '36525', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(865, 1, 'Crossville', 'locations', 0, 1, NULL, 569, '35962', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(866, 1, 'Cuba', 'locations', 0, 1, NULL, 569, '36907', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(867, 1, 'Cullman', 'locations', 0, 1, NULL, 569, '35055', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(868, 1, 'Cusseta', 'locations', 0, 1, NULL, 569, '36852', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(869, 1, 'Dadeville', 'locations', 0, 1, NULL, 569, '36853', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(870, 1, 'Daleville', 'locations', 0, 1, NULL, 569, '36322', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(871, 1, 'Daphne', 'locations', 0, 1, NULL, 569, '36526', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(872, 1, 'Dauphin Island', 'locations', 0, 1, NULL, 569, '36528', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(873, 1, 'Daviston', 'locations', 0, 1, NULL, 569, '36256', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(874, 1, 'Dayton', 'locations', 0, 1, NULL, 569, '36738', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(875, 1, 'Deatsville', 'locations', 0, 1, NULL, 569, '36022', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(876, 1, 'Decatur', 'locations', 0, 1, NULL, 569, '35601', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(877, 1, 'Demopolis', 'locations', 0, 1, NULL, 569, '36732', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(878, 1, 'Detroit', 'locations', 0, 1, NULL, 569, '35552', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(879, 1, 'Dodge City', 'locations', 0, 1, NULL, 569, '35077', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(880, 1, 'Dora', 'locations', 0, 1, NULL, 569, '35062', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(881, 1, 'Dothan', 'locations', 0, 1, NULL, 569, '36301', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(882, 1, 'Double Springs', 'locations', 0, 1, NULL, 569, '35553', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(883, 1, 'Douglas', 'locations', 0, 1, NULL, 569, '35980', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(884, 1, 'Dozier', 'locations', 0, 1, NULL, 569, '36028', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(885, 1, 'Dutton', 'locations', 0, 1, NULL, 569, '35744', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(886, 1, 'East Brewton', 'locations', 0, 1, NULL, 569, '36426', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(887, 1, 'Eclectic', 'locations', 0, 1, NULL, 569, '36024', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(888, 1, 'Edwardsville', 'locations', 0, 1, NULL, 569, '36264', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(889, 1, 'Elba', 'locations', 0, 1, NULL, 569, '36323', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(890, 1, 'Elberta', 'locations', 0, 1, NULL, 569, '36530', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(891, 1, 'Eldridge', 'locations', 0, 1, NULL, 569, '35554', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(892, 1, 'Elkmont', 'locations', 0, 1, NULL, 569, '35620', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(893, 1, 'Elmore', 'locations', 0, 1, NULL, 569, '36025', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(894, 1, 'Emelle', 'locations', 0, 1, NULL, 569, '35459', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(895, 1, 'Enterprise', 'locations', 0, 1, NULL, 569, '36330', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(896, 1, 'Epes', 'locations', 0, 1, NULL, 569, '35700', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(897, 1, 'Ethelsville', 'locations', 0, 1, NULL, 569, '35701', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(898, 1, 'Eufaula', 'locations', 0, 1, NULL, 569, '36027', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(899, 1, 'Eutaw', 'locations', 0, 1, NULL, 569, '35702', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(900, 1, 'Eva', 'locations', 0, 1, NULL, 569, '35621', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(901, 1, 'Evergreen', 'locations', 0, 1, NULL, 569, '36401', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(902, 1, 'Excel', 'locations', 0, 1, NULL, 569, '36439', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(903, 1, 'Fairfield', 'locations', 0, 1, NULL, 569, '35064', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(904, 1, 'Fairhope', 'locations', 0, 1, NULL, 569, '36532', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(905, 1, 'Fairview', 'locations', 0, 1, NULL, 569, '35058', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(906, 1, 'Falkville', 'locations', 0, 1, NULL, 569, '35622', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(907, 1, 'Faunsdale', 'locations', 0, 1, NULL, 569, '36738', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(908, 1, 'Fayette', 'locations', 0, 1, NULL, 569, '35555', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(909, 1, 'Five Points', 'locations', 0, 1, NULL, 569, '36855', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(910, 1, 'Flomaton', 'locations', 0, 1, NULL, 569, '36441', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(911, 1, 'Florala', 'locations', 0, 1, NULL, 569, '36442', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(912, 1, 'Florence', 'locations', 0, 1, NULL, 569, '35630', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(913, 1, 'Foley', 'locations', 0, 1, NULL, 569, '36535', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(914, 1, 'Forkland', 'locations', 0, 1, NULL, 569, '36740', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(915, 1, 'Fort Deposit', 'locations', 0, 1, NULL, 569, '36032', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(916, 1, 'Fort Payne', 'locations', 0, 1, NULL, 569, '35967', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(917, 1, 'Franklin', 'locations', 0, 1, NULL, 569, '36083', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(918, 1, 'Frisco City', 'locations', 0, 1, NULL, 569, '36445', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(919, 1, 'Fruithurst', 'locations', 0, 1, NULL, 569, '36262', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(920, 1, 'Fulton', 'locations', 0, 1, NULL, 569, '36451', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(921, 1, 'Fultondale', 'locations', 0, 1, NULL, 569, '35068', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(922, 1, 'Fyffe', 'locations', 0, 1, NULL, 569, '35971', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(923, 1, 'Gadsden', 'locations', 0, 1, NULL, 569, '35901', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(924, 1, 'Gainesville', 'locations', 0, 1, NULL, 569, '35704', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(925, 1, 'Gantt', 'locations', 0, 1, NULL, 569, '36421', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(926, 1, 'Garden City', 'locations', 0, 1, NULL, 569, '35070', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(927, 1, 'Gardendale', 'locations', 0, 1, NULL, 569, '35071', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(928, 1, 'Gaylesville', 'locations', 0, 1, NULL, 569, '35973', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(929, 1, 'Geiger', 'locations', 0, 1, NULL, 569, '35459', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(930, 1, 'Geneva', 'locations', 0, 1, NULL, 569, '36340', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(931, 1, 'Georgiana', 'locations', 0, 1, NULL, 569, '36033', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(932, 1, 'Geraldine', 'locations', 0, 1, NULL, 569, '35974', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(933, 1, 'Gilbertown', 'locations', 0, 1, NULL, 569, '36908', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(934, 1, 'Glen Allen', 'locations', 0, 1, NULL, 569, '35594', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(935, 1, 'Glencoe', 'locations', 0, 1, NULL, 569, '35905', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(936, 1, 'Glenwood', 'locations', 0, 1, NULL, 569, '36034', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(937, 1, 'Goldville', 'locations', 0, 1, NULL, 569, '36256', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(938, 1, 'Good Hope', 'locations', 0, 1, NULL, 569, '35055', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(939, 1, 'Goodwater', 'locations', 0, 1, NULL, 569, '35072', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(940, 1, 'Gordo', 'locations', 0, 1, NULL, 569, '35706', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(941, 1, 'Gordon', 'locations', 0, 1, NULL, 569, '36343', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(942, 1, 'Gordonville', 'locations', 0, 1, NULL, 569, '36040', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(943, 1, 'Goshen', 'locations', 0, 1, NULL, 569, '36035', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(944, 1, 'Grant', 'locations', 0, 1, NULL, 569, '35747', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(945, 1, 'Graysville', 'locations', 0, 1, NULL, 569, '35073', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(946, 1, 'Greensboro', 'locations', 0, 1, NULL, 569, '36744', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(947, 1, 'Greenville', 'locations', 0, 1, NULL, 569, '36037', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(948, 1, 'Grimes', 'locations', 0, 1, NULL, 569, '36350', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(949, 1, 'Grove Hill', 'locations', 0, 1, NULL, 569, '36451', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(950, 1, 'Guin', 'locations', 0, 1, NULL, 569, '35563', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(951, 1, 'Gulf Shores', 'locations', 0, 1, NULL, 569, '36542', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(952, 1, 'Guntersville', 'locations', 0, 1, NULL, 569, '35976', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(953, 1, 'Gurley', 'locations', 0, 1, NULL, 569, '35748', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(954, 1, 'Gu-Win', 'locations', 0, 1, NULL, 569, '35563', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(955, 1, 'Hackleburg', 'locations', 0, 1, NULL, 569, '35564', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(956, 1, 'Haleburg', 'locations', 0, 1, NULL, 569, '36319', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(957, 1, 'Haleyville', 'locations', 0, 1, NULL, 569, '35565', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(958, 1, 'Hamilton', 'locations', 0, 1, NULL, 569, '35570', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(959, 1, 'Hammondville', 'locations', 0, 1, NULL, 569, '35989', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(960, 1, 'Hanceville', 'locations', 0, 1, NULL, 569, '35077', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(961, 1, 'Harpersville', 'locations', 0, 1, NULL, 569, '35078', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(962, 1, 'Hartford', 'locations', 0, 1, NULL, 569, '36344', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(963, 1, 'Hartselle', 'locations', 0, 1, NULL, 569, '35640', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(964, 1, 'Hayden', 'locations', 0, 1, NULL, 569, '35079', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(965, 1, 'Hayneville', 'locations', 0, 1, NULL, 569, '36040', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(966, 1, 'Headland', 'locations', 0, 1, NULL, 569, '36345', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(967, 1, 'Heath', 'locations', 0, 1, NULL, 569, '36421', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(968, 1, 'Heflin', 'locations', 0, 1, NULL, 569, '36264', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(969, 1, 'Helena', 'locations', 0, 1, NULL, 569, '35080', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(970, 1, 'Henagar', 'locations', 0, 1, NULL, 569, '35978', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(971, 1, 'Highland Lake', 'locations', 0, 1, NULL, 569, '35121', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(972, 1, 'Hillsboro', 'locations', 0, 1, NULL, 569, '35643', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(973, 1, 'Hobson City', 'locations', 0, 1, NULL, 569, '36201', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(974, 1, 'Hodges', 'locations', 0, 1, NULL, 569, '35571', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(975, 1, 'Hokes Bluff', 'locations', 0, 1, NULL, 569, '35903', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(976, 1, 'Holly Pond', 'locations', 0, 1, NULL, 569, '35083', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(977, 1, 'Hollywood', 'locations', 0, 1, NULL, 569, '35752', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(978, 1, 'Homewood', 'locations', 0, 1, NULL, 569, '35209', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(979, 1, 'Hoover', 'locations', 0, 1, NULL, 569, '35226', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(980, 1, 'Horn Hill', 'locations', 0, 1, NULL, 569, '36467', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(981, 1, 'Hueytown', 'locations', 0, 1, NULL, 569, '35023', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(982, 1, 'Huntsville', 'locations', 0, 1, NULL, 569, '35801', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(983, 1, 'Hurtsboro', 'locations', 0, 1, NULL, 569, '36860', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(984, 1, 'Hytop', 'locations', 0, 1, NULL, 569, '35768', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(985, 1, 'Ider', 'locations', 0, 1, NULL, 569, '35981', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(986, 1, 'Indian Springs Village', 'locations', 0, 1, NULL, 569, '35124', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(987, 1, 'Irondale', 'locations', 0, 1, NULL, 569, '35210', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(988, 1, 'Jackson', 'locations', 0, 1, NULL, 569, '36545', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(989, 1, 'Jacksons'' Gap', 'locations', 0, 1, NULL, 569, '36861', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(990, 1, 'Jacksonville', 'locations', 0, 1, NULL, 569, '36265', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(991, 1, 'Jasper', 'locations', 0, 1, NULL, 569, '35501', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(992, 1, 'Jemison', 'locations', 0, 1, NULL, 569, '35085', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(993, 1, 'Kansas', 'locations', 0, 1, NULL, 569, '35549', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(994, 1, 'Kellyton', 'locations', 0, 1, NULL, 569, '35089', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(995, 1, 'Kennedy', 'locations', 0, 1, NULL, 569, '35574', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(996, 1, 'Killen', 'locations', 0, 1, NULL, 569, '35645', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(997, 1, 'Kimberly', 'locations', 0, 1, NULL, 569, '35091', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(998, 1, 'Kinsey', 'locations', 0, 1, NULL, 569, '36303', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(999, 1, 'Kinston', 'locations', 0, 1, NULL, 569, '36453', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1000, 1, 'La Fayette', 'locations', 0, 1, NULL, 569, '36862', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1001, 1, 'Lakeview', 'locations', 0, 1, NULL, 569, '35971', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1002, 1, 'Lake View', 'locations', 0, 1, NULL, 569, '35111', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1003, 1, 'Lanett', 'locations', 0, 1, NULL, 569, '36863', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1004, 1, 'Langston', 'locations', 0, 1, NULL, 569, '35755', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1005, 1, 'Leeds', 'locations', 0, 1, NULL, 569, '35094', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1006, 1, 'Leesburg', 'locations', 0, 1, NULL, 569, '35983', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1007, 1, 'Leighton', 'locations', 0, 1, NULL, 569, '35646', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1008, 1, 'Lester', 'locations', 0, 1, NULL, 569, '35647', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1009, 1, 'Level Plains', 'locations', 0, 1, NULL, 569, '36322', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1010, 1, 'Lexington', 'locations', 0, 1, NULL, 569, '35648', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1011, 1, 'Libertyville', 'locations', 0, 1, NULL, 569, '36420', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1012, 1, 'Lincoln', 'locations', 0, 1, NULL, 569, '35096', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1013, 1, 'Linden', 'locations', 0, 1, NULL, 569, '36748', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1014, 1, 'Lineville', 'locations', 0, 1, NULL, 569, '36266', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1015, 1, 'Lipscomb', 'locations', 0, 1, NULL, 569, '35020', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1016, 1, 'Lisman', 'locations', 0, 1, NULL, 569, '36912', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1017, 1, 'Littleville', 'locations', 0, 1, NULL, 569, '35654', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1018, 1, 'Livingston', 'locations', 0, 1, NULL, 569, '35470', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1019, 1, 'Loachapoka', 'locations', 0, 1, NULL, 569, '36865', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1020, 1, 'Lockhart', 'locations', 0, 1, NULL, 569, '36455', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1021, 1, 'Locust Fork', 'locations', 0, 1, NULL, 569, '35097', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1022, 1, 'Louisville', 'locations', 0, 1, NULL, 569, '36048', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1023, 1, 'Lowndesboro', 'locations', 0, 1, NULL, 569, '36752', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1024, 1, 'Loxley', 'locations', 0, 1, NULL, 569, '36551', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', '');
INSERT INTO `vsf_menu` (`menuId`, `langId`, `menuTitle`, `menuUrl`, `menuIndex`, `menuStatus`, `menuAlt`, `parentId`, `menuIsLink`, `menuIsDropDown`, `menuType`, `menuLevel`, `menuPosition`, `menuIsAdmin`, `menuBackup`, `menuFileId`, `menuSlug`, `menuQuick`, `menuTemplate`, `menuCate`, `menuMtTitle`, `menuMtKeyWord`, `menuMtDesc`) VALUES
(1025, 1, 'Luverne', 'locations', 0, 1, NULL, 569, '36049', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1026, 1, 'Lynn', 'locations', 0, 1, NULL, 569, '35575', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1027, 1, 'Madison', 'locations', 0, 1, NULL, 569, '35758', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1028, 1, 'Madrid', 'locations', 0, 1, NULL, 569, '36320', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1029, 1, 'Magnolia Springs', 'locations', 0, 1, NULL, 569, '36555', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1030, 1, 'Malvern', 'locations', 0, 1, NULL, 569, '36375', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1031, 1, 'Maplesville', 'locations', 0, 1, NULL, 569, '36750', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1032, 1, 'Margaret', 'locations', 0, 1, NULL, 569, '35112', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1033, 1, 'Marion', 'locations', 0, 1, NULL, 569, '36756', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1034, 1, 'Maytown', 'locations', 0, 1, NULL, 569, '35005', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1035, 1, 'McIntosh', 'locations', 0, 1, NULL, 569, '36553', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1036, 1, 'McKenzie', 'locations', 0, 1, NULL, 569, '36456', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1037, 1, 'McMullen', 'locations', 0, 1, NULL, 569, '35442', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1038, 1, 'Memphis', 'locations', 0, 1, NULL, 569, '35442', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1039, 1, 'Mentone', 'locations', 0, 1, NULL, 569, '35984', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1040, 1, 'Midfield', 'locations', 0, 1, NULL, 569, '35228', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1041, 1, 'Midland City', 'locations', 0, 1, NULL, 569, '36350', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1042, 1, 'Midway', 'locations', 0, 1, NULL, 569, '36053', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1043, 1, 'Millbrook', 'locations', 0, 1, NULL, 569, '36054', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1044, 1, 'Millport', 'locations', 0, 1, NULL, 569, '35576', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1045, 1, 'Millry', 'locations', 0, 1, NULL, 569, '36558', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1046, 1, 'Mobile', 'locations', 0, 1, NULL, 569, '36602', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1047, 1, 'Monroeville', 'locations', 0, 1, NULL, 569, '36460', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1048, 1, 'Montevallo', 'locations', 0, 1, NULL, 569, '35115', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1049, 1, 'Montgomery', 'locations', 0, 1, NULL, 569, '36104', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1050, 1, 'Moody', 'locations', 0, 1, NULL, 569, '35004', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1051, 1, 'Mooresville', 'locations', 0, 1, NULL, 569, '35649', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1052, 1, 'Morris', 'locations', 0, 1, NULL, 569, '35116', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1053, 1, 'Mosses', 'locations', 0, 1, NULL, 569, '36040', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1054, 1, 'Moulton', 'locations', 0, 1, NULL, 569, '35650', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1055, 1, 'Moundville', 'locations', 0, 1, NULL, 569, '35474', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1056, 1, 'Mountain Brook', 'locations', 0, 1, NULL, 569, '35213', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1057, 1, 'Mount Vernon', 'locations', 0, 1, NULL, 569, '36560', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1058, 1, 'Mulga', 'locations', 0, 1, NULL, 569, '35118', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1059, 1, 'Munford', 'locations', 0, 1, NULL, 569, '36268', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1060, 1, 'Muscle Shoals', 'locations', 0, 1, NULL, 569, '35661', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1061, 1, 'Myrtlewood', 'locations', 0, 1, NULL, 569, '36763', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1062, 1, 'Napier Field', 'locations', 0, 1, NULL, 569, '36303', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1063, 1, 'Natural Bridge', 'locations', 0, 1, NULL, 569, '35577', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1064, 1, 'Nauvoo', 'locations', 0, 1, NULL, 569, '35578', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1065, 1, 'Nectar', 'locations', 0, 1, NULL, 569, '35049', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1066, 1, 'Needham', 'locations', 0, 1, NULL, 569, '36915', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1067, 1, 'Newbern', 'locations', 0, 1, NULL, 569, '36765', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1068, 1, 'New Brockton', 'locations', 0, 1, NULL, 569, '36351', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1069, 1, 'New Hope', 'locations', 0, 1, NULL, 569, '35760', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1070, 1, 'New Site', 'locations', 0, 1, NULL, 569, '36256', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1071, 1, 'Newton', 'locations', 0, 1, NULL, 569, '36352', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1072, 1, 'Newville', 'locations', 0, 1, NULL, 569, '36353', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1073, 1, 'North Courtland', 'locations', 0, 1, NULL, 569, '35618', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1074, 1, 'North Johns', 'locations', 0, 1, NULL, 569, '35006', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1075, 1, 'Northport', 'locations', 0, 1, NULL, 569, '35476', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1076, 1, 'Notasulga', 'locations', 0, 1, NULL, 569, '36866', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1077, 1, 'Oak Grove', 'locations', 0, 1, NULL, 569, '35150', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1078, 1, 'Oak Hill', 'locations', 0, 1, NULL, 569, '36768', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1079, 1, 'Oakman', 'locations', 0, 1, NULL, 569, '35579', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1080, 1, 'Odenville', 'locations', 0, 1, NULL, 569, '35120', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1081, 1, 'Ohatchee', 'locations', 0, 1, NULL, 569, '36271', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1082, 1, 'Oneonta', 'locations', 0, 1, NULL, 569, '35121', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1083, 1, 'Onycha', 'locations', 0, 1, NULL, 569, '36467', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1084, 1, 'Opelika', 'locations', 0, 1, NULL, 569, '36801', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1085, 1, 'Opp', 'locations', 0, 1, NULL, 569, '36467', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1086, 1, 'Orange Beach', 'locations', 0, 1, NULL, 569, '36561', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1087, 1, 'Orrville', 'locations', 0, 1, NULL, 569, '36767', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1088, 1, 'Owens Cross Roads', 'locations', 0, 1, NULL, 569, '35763', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1089, 1, 'Oxford', 'locations', 0, 1, NULL, 569, '36203', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1090, 1, 'Ozark', 'locations', 0, 1, NULL, 569, '36360', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1091, 1, 'Paint Rock', 'locations', 0, 1, NULL, 569, '35764', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1092, 1, 'Parrish', 'locations', 0, 1, NULL, 569, '35580', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1093, 1, 'Pelham', 'locations', 0, 1, NULL, 569, '35124', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1094, 1, 'Pell City', 'locations', 0, 1, NULL, 569, '35125', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1095, 1, 'Pennington', 'locations', 0, 1, NULL, 569, '36916', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1096, 1, 'Perdido Beach', 'locations', 0, 1, NULL, 569, '36530', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1097, 1, 'Petrey', 'locations', 0, 1, NULL, 569, '36049', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1098, 1, 'Phenix City', 'locations', 0, 1, NULL, 569, '36867', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1099, 1, 'Phil Campbell', 'locations', 0, 1, NULL, 569, '35581', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1100, 1, 'Pickensville', 'locations', 0, 1, NULL, 569, '35447', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1101, 1, 'Piedmont', 'locations', 0, 1, NULL, 569, '36272', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1102, 1, 'Pike Road', 'locations', 0, 1, NULL, 569, '36064', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1103, 1, 'Pinckard', 'locations', 0, 1, NULL, 569, '36371', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1104, 1, 'Pine Apple', 'locations', 0, 1, NULL, 569, '36768', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1105, 1, 'Pine Hill', 'locations', 0, 1, NULL, 569, '36769', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1106, 1, 'Pine Ridge', 'locations', 0, 1, NULL, 569, '35968', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1107, 1, 'Pinson', 'locations', 0, 1, NULL, 569, '35126', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1108, 1, 'Pisgah', 'locations', 0, 1, NULL, 569, '35765', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1109, 1, 'Pleasant Grove', 'locations', 0, 1, NULL, 569, '35127', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1110, 1, 'Pleasant Groves', 'locations', 0, 1, NULL, 569, '35776', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1111, 1, 'Pollard', 'locations', 0, 1, NULL, 569, '36441', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1112, 1, 'Powell', 'locations', 0, 1, NULL, 569, '35971', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1113, 1, 'Prattville', 'locations', 0, 1, NULL, 569, '36067', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1114, 1, 'Priceville', 'locations', 0, 1, NULL, 569, '35603', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1115, 1, 'Prichard', 'locations', 0, 1, NULL, 569, '36610', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1116, 1, 'Providence', 'locations', 0, 1, NULL, 569, '36742', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1117, 1, 'Ragland', 'locations', 0, 1, NULL, 569, '35131', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1118, 1, 'Rainbow City', 'locations', 0, 1, NULL, 569, '35906', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1119, 1, 'Rainsville', 'locations', 0, 1, NULL, 569, '35986', '0', '0', 3, '@00000', -1, '', '', '', '', '', NULL, '', '', ''),
(1121, 0, 'location', 'location', 0, 1, 'location', 14, '1', '0', '1', 2, '@00000', -1, '', '', '', '', '', 'Array', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_module`
--

CREATE TABLE IF NOT EXISTS `vsf_module` (
`id` smallint(4) unsigned NOT NULL,
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isUser` tinyint(1) NOT NULL DEFAULT '0',
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `virtual` tinyint(4) NOT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `isParent` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=580 ;

--
-- Dumping data for table `vsf_module`
--

INSERT INTO `vsf_module` (`id`, `title`, `version`, `isAdmin`, `isUser`, `intro`, `class`, `virtual`, `parent`, `isParent`) VALUES
(2, 'Modules Management', '0', 1, 0, 'This is a system module for management all modules in VS Framework.', 'modules', 0, NULL, 1),
(20, 'Menus Manager', '3.4.1', 1, 1, 'This is a system module for management all menu links in VS Framework.', 'menus', 0, NULL, 0),
(7, 'User management', '0', 1, 1, 'This module is for manage public user.', 'users', 0, NULL, 0),
(17, 'Component', '3.3.', 1, 0, 'This is a system module for management all Component for VS Framework.', 'components', 0, NULL, 0),
(5, 'Admin', '3.3.4.1', 1, 1, 'This is a system module for management all simple page for VS Framework.', 'admins', 0, NULL, 0),
(57, 'File manager', '3.3.4.1', 1, 1, 'This is a system module for management all News for VS Framework.', 'files', 0, NULL, 0),
(24, 'Manage Gallery', '3.4.1', 1, 1, 'This is a system module for management all menu links in VS Framework.', 'gallery', 0, NULL, 0),
(25, 'Skins', '0', 1, 0, '', 'skins', 0, NULL, 0),
(488, 'supports', '', 1, 1, 'supports', 'supports', 0, '0', 0),
(489, 'langs', '', 1, 0, 'langs', 'langs', 1, '0', 0),
(108, 'Page Manager', '3.3.4.1', 1, 1, 'This is a system module for management all page for VS Framework.', 'pages', 0, '0', 1),
(66, 'Manage Gallerys', '3.4.1', 1, 1, 'This is a system module for management all menu links in VS Framework.', 'gallerys', 0, NULL, 0),
(486, 'banners', '', 1, 1, 'banners managers with position adverting', 'banners', 0, '0', 0),
(107, 'Settings', '0', 1, 0, 'This is a system module for management all system settings for VS Framework configuration.', 'settings', 0, NULL, 0),
(577, 'posts', '', 1, 1, 'posts', 'posts', 0, '0', 0),
(579, 'faq', '', 1, 1, 'faq', 'faq', 1, 'pages', 0),
(471, 'Page Manager', '3.3.4.1', 1, 1, 'This module had create auto by system for management all products for VS Framework.', 'products', 0, NULL, 0),
(484, 'contacts', '', 1, 1, 'contacts managers', 'contacts', 0, '0', 0),
(494, 'tags', '', 1, 1, 'tests', 'tags', 1, '0', 0),
(490, 'seos', '', 1, 0, 'seos', 'seos', 0, '0', 0),
(504, 'weblinks', '', 1, 1, 'weblinks', 'weblinks', 1, 'partners', 0),
(531, 'configs', '', 1, 1, 'configs', 'configs', 1, '0', 0),
(532, 'widgets', '', 1, 0, 'widgets', 'widgets', 0, '0', 0),
(557, 'slidebanner', '', 1, 1, 'slidebanner', 'slidebanner', 1, 'pages', 0),
(534, 'logos', '', 1, 1, 'logos', 'logos', 0, 'modules', 0),
(535, 'orders', '', 1, 1, 'orders', 'orders', 1, 'modules', 0),
(536, 'abouts', '', 1, 1, 'abouts', 'abouts', 1, 'pages', 0),
(537, 'simple', '', 1, 1, 'simple', 'simple', 1, 'pages', 0),
(538, 'address', '', 1, 1, 'address', 'address', 1, 'pages', 0),
(540, 'news', '', 1, 1, 'Tin tức', 'news', 1, 'pages', 0),
(545, 'languages', '', 1, 1, 'languages', 'languages', 0, '0', 0),
(546, 'customers', '', 1, 1, 'đối tác khách hàng', 'customers', 1, 'pages', 0),
(547, 'partners', '', 1, 1, 'partners', 'partners', 0, 'modules', 1),
(570, 'videos', '', 1, 1, 'videos', 'videos', 0, 'modules', 0),
(551, 'services', '', 1, 1, 'services', 'services', 1, 'pages', 0),
(554, 'payment', '', 1, 1, 'payment', 'payment', 1, 'pages', 0),
(575, 'ads', '', 1, 1, 'ads', 'ads', 1, 'pages', 0),
(574, 'projects', '', 1, 1, 'projects', 'projects', 1, 'pages', 0),
(576, 'locations', '', 1, 1, 'locations', 'locations', 1, 'pages', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_notification`
--

CREATE TABLE IF NOT EXISTS `vsf_notification` (
`id` int(11) NOT NULL,
  `idInbox` int(11) NOT NULL,
  `idSend` int(11) NOT NULL,
  `objId` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `postDate` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `module` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hide` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `vsf_notification`
--

INSERT INTO `vsf_notification` (`id`, `idInbox`, `idSend`, `objId`, `content`, `postDate`, `index`, `status`, `module`, `title`, `type`, `flag`, `link`, `hide`) VALUES
(46, 26, 25, 0, 'vietsol1 đã Mời Bạn Tham Gia [Phim rạp] Percy Jackson: Biển quái vật - Cuộc phiêu lưu đến Tam giác quỷ', 1380272077, 0, 1, 'findfriends', 'findfriends', 'findfriend', '', 'http://localhost/dididi/findfriends/add_friend/phim-rap-percy-jackson-bien-quai-vat-cuoc-phieu-luu-den-tam-giac-quy-704', 0),
(47, 26, 25, 0, 'vietsol1 đã Mời Bạn Tham Gia [Phim rạp] Percy Jackson: Biển quái vật - Cuộc phiêu lưu đến Tam giác quỷ', 1380272342, 0, 0, 'findfriends', 'findfriends', 'findfriend', '', 'http://localhost/dididi/findfriends/add_friend/phim-rap-percy-jackson-bien-quai-vat-cuoc-phieu-luu-den-tam-giac-quy-704', 0),
(48, 25, 26, 0, 'vietsol2 đã chấp lận lời mời kết bạn', 1380272357, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/vietsol2-26', 0),
(49, 28, 28, 0, 'thienvong đã Mời Bạn Tham Gia [Phim rạp] Percy Jackson: Biển quái vật - Cuộc phiêu lưu đến Tam giác quỷ', 1380362368, 0, 0, 'findfriends', 'findfriends', 'findfriend', '', 'http://localhost/dididi/findfriends/add_friend/phim-rap-percy-jackson-bien-quai-vat-cuoc-phieu-luu-den-tam-giac-quy-704', 1),
(50, 26, 28, 0, 'thienvong đã Mời Bạn Tham Gia [Phim rạp] Percy Jackson: Biển quái vật - Cuộc phiêu lưu đến Tam giác quỷ', 1380362370, 0, 0, 'findfriends', 'findfriends', 'findfriend', '', 'http://localhost/dididi/findfriends/add_friend/phim-rap-percy-jackson-bien-quai-vat-cuoc-phieu-luu-den-tam-giac-quy-704', 0),
(51, 26, 28, 0, 'thienvong đã gửi lời mời kết bạn', 1380364337, 0, 0, 'friends', 'friends', 'friend', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 0),
(52, 25, 28, 0, 'thienvong đã gửi lời mời kết bạn', 1380365164, 0, 0, 'friends', 'friends', 'friend', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 0),
(53, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380366684, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 1),
(54, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380366685, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 1),
(55, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380366879, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 1),
(56, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380366904, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 1),
(57, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380366907, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 1),
(58, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380367038, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://localhost/dididi/newsfeeds/newsfeed_user/thienvong-28', 1),
(59, 28, 28, 0, 'thienvong đã Mời Bạn Tham Gia [Phim rạp] Percy Jackson: Biển quái vật - Cuộc phiêu lưu đến Tam giác quỷ', 1380436978, 0, 1, 'findfriends', 'findfriends', 'findfriend', '', 'http://dididi1.websiteviet.com/findfriends/add_friend/phim-rap-percy-jackson-bien-quai-vat-cuoc-phieu-luu-den-tam-giac-quy-704', 0),
(60, 28, 28, 0, 'thienvong đã Mời Bạn Tham Gia [Âm nhạc] Hòa mình cùng nhạc trữ tình @ Nam Quang, Q.3', 1380437200, 0, 0, 'findfriends', 'findfriends', 'findfriend', '', 'http://dididi1.websiteviet.com/findfriends/add_friend/am-nhac-hoa-minh-cung-nhac-tru-tinh-nam-quang-q-3-599', 1),
(61, 28, 28, 0, 'thienvong đã chấp lận lời mời tham gia', 1380437208, 0, 0, 'findfriends', 'findfriends', 'simple', '', 'http://dididi1.websiteviet.com/newsfeeds/newsfeed_user/thienvong-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_notify`
--

CREATE TABLE IF NOT EXISTS `vsf_notify` (
`id` int(10) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `url` varchar(512) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `time` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_notify_viewstatus`
--

CREATE TABLE IF NOT EXISTS `vsf_notify_viewstatus` (
`id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `utype` varchar(8) NOT NULL DEFAULT 'admins',
  `notify` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_order`
--

CREATE TABLE IF NOT EXISTS `vsf_order` (
`id` smallint(5) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(2048) NOT NULL,
  `userId` int(10) DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `postDate` int(10) DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `seri` varchar(20) DEFAULT NULL,
  `total` int(10) NOT NULL DEFAULT '0',
  `quantity` tinyint(4) NOT NULL DEFAULT '0',
  `userinfo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `paymethod` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `vsf_order`
--

INSERT INTO `vsf_order` (`id`, `title`, `intro`, `userId`, `address`, `email`, `info`, `postDate`, `phone`, `seri`, `total`, `quantity`, `userinfo`, `paymethod`, `status`) VALUES
(4, 'dádfsdfsdf', 'ádasd', NULL, 'ádasd', 'sddasdasd@yahoo.com', NULL, 1387840322, '123123', NULL, 0, 0, NULL, 0, 0),
(5, 'thoa', 'hoa lan cuoi', NULL, 'dian', 'nguyenphiphi62@yahoo.com.vn', NULL, 1388038384, '01687787907', NULL, 0, 0, NULL, 0, 0),
(9, 'Trần Linh', 'giao hang dung hen', NULL, '136/19 dang van ngu', 'tvthuylinh01@gmail.com', NULL, 1390360451, '0936652727', NULL, 1650000, 0, NULL, 0, 0),
(10, 'tran linh', 'd?', NULL, '136/18 dang van ng', 'tvthuylinh01@yahoo.com', NULL, 1390360686, '0168563770', NULL, 7200000, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_order_item`
--

CREATE TABLE IF NOT EXISTS `vsf_order_item` (
`id` int(10) NOT NULL,
  `orderId` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `productId` int(10) NOT NULL,
  `quantity` smallint(5) NOT NULL,
  `price` int(10) NOT NULL,
  `saleOff` varchar(20) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `info` varchar(200) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `vsf_order_item`
--

INSERT INTO `vsf_order_item` (`id`, `orderId`, `title`, `productId`, `quantity`, `price`, `saleOff`, `type`, `status`, `info`) VALUES
(19, 0, 'Tapioca (Manioc / Cassava) Starch', 80, 2, 0, '', NULL, NULL, NULL),
(20, 0, 'Viet Nam Tapioca', 84, 5, 0, '', NULL, NULL, NULL),
(21, 4, 'Thin Cassia', 91, 5, 0, '', NULL, NULL, NULL),
(22, 5, 'Hoa khai tr??ng', 110, 1, 0, '', NULL, NULL, NULL),
(29, 10, 'Proin sed odio et ante adipiscing lobortis', 123, 8, 900000, '', NULL, NULL, NULL),
(28, 9, 'Hoa sinh nh?t 04', 132, 3, 550000, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_page`
--

CREATE TABLE IF NOT EXISTS `vsf_page` (
`id` int(10) unsigned NOT NULL,
  `catId` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postDate` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `index` tinyint(4) NOT NULL DEFAULT '0',
  `code` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mKeyWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mIntro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `provin` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dis` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `map` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=288 ;

--
-- Dumping data for table `vsf_page`
--

INSERT INTO `vsf_page` (`id`, `catId`, `title`, `intro`, `image`, `content`, `postDate`, `status`, `index`, `code`, `module`, `mTitle`, `mKeyWord`, `mIntro`, `mUrl`, `provin`, `dis`, `map`) VALUES
(212, 244, 'Kim Tây Nam Group', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395221212, 1, 0, '', 'abouts', '', '', '', '', '', '', 0),
(213, 48, 'Mua bất động sản', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395221494, 1, 4, '', 'services', '', '', '', '', '', '', 0),
(214, 48, 'Bán bất động sản', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395221513, 1, 3, '', 'services', '', '', '', '', '', '', 0),
(215, 48, 'Hỗ trợ tài chính', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395221819, 1, 2, '', 'services', '', '', '', '', '', '', 0),
(216, 48, 'Hỗ trợ pháp lý', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395221830, 1, 0, '', 'services', '', '', '', 'ho-tro-tai-chinh', '', '', 0),
(217, 48, 'Tư vấn, thiết kế, xây dựng', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395221849, 1, 1, '', 'services', 'fdgfdgdfg', '', '', 'tu-van-thiet-ke-xay-dung', '', '', 0),
(218, 295, 'Hỗ trợ vay vốn', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395222895, 1, 0, '', 'customers', '', '', '', '', '', '', 0),
(219, 295, 'Tri ân khách hàng thân thiết', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395222920, 1, 0, '', 'customers', '', '', '', '', '', '', 0),
(220, 295, 'Quà tặng', '', NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisi Lorem ipsum dolor sit amet, consectetur adipisi Cing elit, sed do eiusmod tempor incididunt ut labore et.<br /><br />Dolore magna aliqua. Ut enim ad minim veniam, quis nostrudes. exercitation ullamco laboris nisi ut aliquip uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proide sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consec.<br /><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>', 1395223025, 1, 0, '', 'customers', '', '', '', '', '', '', 0),
(223, 520, 'Dự án 1', 'Dự án Times City của Vingroup, ngay trong ngày mở bán đầu tiên, một lượng lớn căn hộ đã được giao dịch thành công. Dự án Thăng Long Number 1 cũng đã có hơn 10 giao dịch đầu tiên trong năm mới. Các dự án căn hộ cao cấp khác như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Khánh, Mandarin Garden, Indochina Plaza Hà Nội hay Star City Lê Văn Lương,... cũng đang được nhiều người mua quan tâm. Mức giá những căn hộ này trong khoảng 33-40 triệu đồng/m2.\r\n\r\nTại thị trường phía Nam, Phú Mỹ Hưng công bố kết quả chào bán thành công 44 trong tổng số 48 căn biệt thự Nam Viên. Mức giá hiện nay trên thị trường của dự án này lên tới 11 tỷ đồng/căn. Trước đó, dự án lâu đài biệt thự dự án Chateau của liên doanh này đã bán được hơn 90%.\r\n\r\nNhiều dự án BĐS cao cấp cũng đang rục rịch lên kế hoạch tung ra thị trường. Savills VN đang mở bán những căn hộ cuối cùng của dự án Tây Hồ Residence với mức giá gần 30 triệu đồng/m2. Phú Mỹ Hưng lên kế hoạch giới thiệu căn hộ Green Valley với mức ưu đãi lãi suất vay và tiến độ thanh toán hợp lý.\r\n\r\nKhảo sát thị trường cho thấy, các sản phẩm BĐS cao cấp mở bán có thanh khoản cao tập trung chủ yếu ở các dự án có vị trí đẹp và môi trường sống tốt, đã và đang hoàn thiện, khách hàng có thể nhận nhà ngay và mức giá hợp lý. Do đó, đợt mở bán này đã thu hút rất đông những người có nhu cầu ở thực.', '3476', '<p>Dự &aacute;n Times City của Vingroup, ngay trong ng&agrave;y mở b&aacute;n đầu ti&ecirc;n, một lượng lớn căn hộ đ&atilde; được giao dịch th&agrave;nh c&ocirc;ng. Dự &aacute;n Thăng Long Number 1 cũng đ&atilde; c&oacute; hơn 10 giao dịch đầu ti&ecirc;n trong năm mới. C&aacute;c dự &aacute;n căn hộ cao cấp kh&aacute;c như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Kh&aacute;nh, Mandarin Garden, Indochina Plaza H&agrave; Nội hay Star City L&ecirc; Văn Lương,... cũng đang được nhiều người mua quan t&acirc;m. Mức gi&aacute; những căn hộ n&agrave;y trong khoảng 33-40 triệu đồng/m2.<br /><br />Tại thị trường ph&iacute;a Nam, Ph&uacute; Mỹ Hưng c&ocirc;ng bố kết quả ch&agrave;o b&aacute;n th&agrave;nh c&ocirc;ng 44 trong tổng số 48 căn biệt thự Nam Vi&ecirc;n. Mức gi&aacute; hiện nay tr&ecirc;n thị trường của dự &aacute;n n&agrave;y l&ecirc;n tới 11 tỷ đồng/căn. Trước đ&oacute;, dự &aacute;n l&acirc;u đ&agrave;i biệt thự dự &aacute;n Chateau của li&ecirc;n doanh n&agrave;y đ&atilde; b&aacute;n được hơn 90%.<br /><br />Nhiều dự &aacute;n BĐS cao cấp cũng đang rục rịch l&ecirc;n kế hoạch tung ra thị trường. Savills VN đang mở b&aacute;n những căn hộ cuối c&ugrave;ng của dự &aacute;n T&acirc;y Hồ Residence với mức gi&aacute; gần 30 triệu đồng/m2. Ph&uacute; Mỹ Hưng l&ecirc;n kế hoạch giới thiệu căn hộ Green Valley với mức ưu đ&atilde;i l&atilde;i suất vay v&agrave; tiến độ thanh to&aacute;n hợp l&yacute;.<br /><br />Khảo s&aacute;t thị trường cho thấy, c&aacute;c sản phẩm BĐS cao cấp mở b&aacute;n c&oacute; thanh khoản cao tập trung chủ yếu ở c&aacute;c dự &aacute;n c&oacute; vị tr&iacute; đẹp v&agrave; m&ocirc;i trường sống tốt, đ&atilde; v&agrave; đang ho&agrave;n thiện, kh&aacute;ch h&agrave;ng c&oacute; thể nhận nh&agrave; ngay v&agrave; mức gi&aacute; hợp l&yacute;. Do đ&oacute;, đợt mở b&aacute;n n&agrave;y đ&atilde; thu h&uacute;t rất đ&ocirc;ng những người c&oacute; nhu cầu ở thực.</p>\r\n<p>&nbsp;</p>', 1395392282, 1, 0, '', 'projects', '', '', '', 'du-an-1', 'Bến Tre', 'Giồng Trôm', 3477),
(224, 520, 'Dự án 2', 'Dự án Times City của Vingroup, ngay trong ngày mở bán đầu tiên, một lượng lớn căn hộ đã được giao dịch thành công. Dự án Thăng Long Number 1 cũng đã có hơn 10 giao dịch đầu tiên trong năm mới. Các dự án căn hộ cao cấp khác như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Khánh, Mandarin Garden, Indochina Plaza Hà Nội hay Star City Lê Văn Lương,... cũng đang được nhiều người mua quan tâm. Mức giá những căn hộ này trong khoảng 33-40 triệu đồng/m2.\r\n\r\nTại thị trường phía Nam, Phú Mỹ Hưng công bố kết quả chào bán thành công 44 trong tổng số 48 căn biệt thự Nam Viên. Mức giá hiện nay trên thị trường của dự án này lên tới 11 tỷ đồng/căn. Trước đó, dự án lâu đài biệt thự dự án Chateau của liên doanh này đã bán được hơn 90%.\r\n\r\nNhiều dự án BĐS cao cấp cũng đang rục rịch lên kế hoạch tung ra thị trường. Savills VN đang mở bán những căn hộ cuối cùng của dự án Tây Hồ Residence với mức giá gần 30 triệu đồng/m2. Phú Mỹ Hưng lên kế hoạch giới thiệu căn hộ Green Valley với mức ưu đãi lãi suất vay và tiến độ thanh toán hợp lý.\r\n\r\nKhảo sát thị trường cho thấy, các sản phẩm BĐS cao cấp mở bán có thanh khoản cao tập trung chủ yếu ở các dự án có vị trí đẹp và môi trường sống tốt, đã và đang hoàn thiện, khách hàng có thể nhận nhà ngay và mức giá hợp lý. Do đó, đợt mở bán này đã thu hút rất đông những người có nhu cầu ở thực.', '3478', '<p>Dự &aacute;n Times City của Vingroup, ngay trong ng&agrave;y mở b&aacute;n đầu ti&ecirc;n, một lượng lớn căn hộ đ&atilde; được giao dịch th&agrave;nh c&ocirc;ng. Dự &aacute;n Thăng Long Number 1 cũng đ&atilde; c&oacute; hơn 10 giao dịch đầu ti&ecirc;n trong năm mới. C&aacute;c dự &aacute;n căn hộ cao cấp kh&aacute;c như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Kh&aacute;nh, Mandarin Garden, Indochina Plaza H&agrave; Nội hay Star City L&ecirc; Văn Lương,... cũng đang được nhiều người mua quan t&acirc;m. Mức gi&aacute; những căn hộ n&agrave;y trong khoảng 33-40 triệu đồng/m2.<br /><br />Tại thị trường ph&iacute;a Nam, Ph&uacute; Mỹ Hưng c&ocirc;ng bố kết quả ch&agrave;o b&aacute;n th&agrave;nh c&ocirc;ng 44 trong tổng số 48 căn biệt thự Nam Vi&ecirc;n. Mức gi&aacute; hiện nay tr&ecirc;n thị trường của dự &aacute;n n&agrave;y l&ecirc;n tới 11 tỷ đồng/căn. Trước đ&oacute;, dự &aacute;n l&acirc;u đ&agrave;i biệt thự dự &aacute;n Chateau của li&ecirc;n doanh n&agrave;y đ&atilde; b&aacute;n được hơn 90%.<br /><br />Nhiều dự &aacute;n BĐS cao cấp cũng đang rục rịch l&ecirc;n kế hoạch tung ra thị trường. Savills VN đang mở b&aacute;n những căn hộ cuối c&ugrave;ng của dự &aacute;n T&acirc;y Hồ Residence với mức gi&aacute; gần 30 triệu đồng/m2. Ph&uacute; Mỹ Hưng l&ecirc;n kế hoạch giới thiệu căn hộ Green Valley với mức ưu đ&atilde;i l&atilde;i suất vay v&agrave; tiến độ thanh to&aacute;n hợp l&yacute;.<br /><br />Khảo s&aacute;t thị trường cho thấy, c&aacute;c sản phẩm BĐS cao cấp mở b&aacute;n c&oacute; thanh khoản cao tập trung chủ yếu ở c&aacute;c dự &aacute;n c&oacute; vị tr&iacute; đẹp v&agrave; m&ocirc;i trường sống tốt, đ&atilde; v&agrave; đang ho&agrave;n thiện, kh&aacute;ch h&agrave;ng c&oacute; thể nhận nh&agrave; ngay v&agrave; mức gi&aacute; hợp l&yacute;. Do đ&oacute;, đợt mở b&aacute;n n&agrave;y đ&atilde; thu h&uacute;t rất đ&ocirc;ng những người c&oacute; nhu cầu ở thực.</p>', 1395392345, 2, 0, '', 'projects', '', '', '', 'du-an-2', 'Long An', 'Thủ thừa', 3479),
(225, 520, 'Dự án 3', 'Dự án Times City của Vingroup, ngay trong ngày mở bán đầu tiên, một lượng lớn căn hộ đã được giao dịch thành công. Dự án Thăng Long Number 1 cũng đã có hơn 10 giao dịch đầu tiên trong năm mới. Các dự án căn hộ cao cấp khác như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Khánh, Mandarin Garden, Indochina Plaza Hà Nội hay Star City Lê Văn Lương,... cũng đang được nhiều người mua quan tâm. Mức giá những căn hộ này trong khoảng 33-40 triệu đồng/m2.\r\n\r\nTại thị trường phía Nam, Phú Mỹ Hưng công bố kết quả chào bán thành công 44 trong tổng số 48 căn biệt thự Nam Viên. Mức giá hiện nay trên thị trường của dự án này lên tới 11 tỷ đồng/căn. Trước đó, dự án lâu đài biệt thự dự án Chateau của liên doanh này đã bán được hơn 90%.\r\n\r\nNhiều dự án BĐS cao cấp cũng đang rục rịch lên kế hoạch tung ra thị trường. Savills VN đang mở bán những căn hộ cuối cùng của dự án Tây Hồ Residence với mức giá gần 30 triệu đồng/m2. Phú Mỹ Hưng lên kế hoạch giới thiệu căn hộ Green Valley với mức ưu đãi lãi suất vay và tiến độ thanh toán hợp lý.\r\n\r\nKhảo sát thị trường cho thấy, các sản phẩm BĐS cao cấp mở bán có thanh khoản cao tập trung chủ yếu ở các dự án có vị trí đẹp và môi trường sống tốt, đã và đang hoàn thiện, khách hàng có thể nhận nhà ngay và mức giá hợp lý. Do đó, đợt mở bán này đã thu hút rất đông những người có nhu cầu ở thực.', '3480', '<p>Dự &aacute;n Times City của Vingroup, ngay trong ng&agrave;y mở b&aacute;n đầu ti&ecirc;n, một lượng lớn căn hộ đ&atilde; được giao dịch th&agrave;nh c&ocirc;ng. Dự &aacute;n Thăng Long Number 1 cũng đ&atilde; c&oacute; hơn 10 giao dịch đầu ti&ecirc;n trong năm mới. C&aacute;c dự &aacute;n căn hộ cao cấp kh&aacute;c như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Kh&aacute;nh, Mandarin Garden, Indochina Plaza H&agrave; Nội hay Star City L&ecirc; Văn Lương,... cũng đang được nhiều người mua quan t&acirc;m. Mức gi&aacute; những căn hộ n&agrave;y trong khoảng 33-40 triệu đồng/m2.<br /><br />Tại thị trường ph&iacute;a Nam, Ph&uacute; Mỹ Hưng c&ocirc;ng bố kết quả ch&agrave;o b&aacute;n th&agrave;nh c&ocirc;ng 44 trong tổng số 48 căn biệt thự Nam Vi&ecirc;n. Mức gi&aacute; hiện nay tr&ecirc;n thị trường của dự &aacute;n n&agrave;y l&ecirc;n tới 11 tỷ đồng/căn. Trước đ&oacute;, dự &aacute;n l&acirc;u đ&agrave;i biệt thự dự &aacute;n Chateau của li&ecirc;n doanh n&agrave;y đ&atilde; b&aacute;n được hơn 90%.<br /><br />Nhiều dự &aacute;n BĐS cao cấp cũng đang rục rịch l&ecirc;n kế hoạch tung ra thị trường. Savills VN đang mở b&aacute;n những căn hộ cuối c&ugrave;ng của dự &aacute;n T&acirc;y Hồ Residence với mức gi&aacute; gần 30 triệu đồng/m2. Ph&uacute; Mỹ Hưng l&ecirc;n kế hoạch giới thiệu căn hộ Green Valley với mức ưu đ&atilde;i l&atilde;i suất vay v&agrave; tiến độ thanh to&aacute;n hợp l&yacute;.<br /><br />Khảo s&aacute;t thị trường cho thấy, c&aacute;c sản phẩm BĐS cao cấp mở b&aacute;n c&oacute; thanh khoản cao tập trung chủ yếu ở c&aacute;c dự &aacute;n c&oacute; vị tr&iacute; đẹp v&agrave; m&ocirc;i trường sống tốt, đ&atilde; v&agrave; đang ho&agrave;n thiện, kh&aacute;ch h&agrave;ng c&oacute; thể nhận nh&agrave; ngay v&agrave; mức gi&aacute; hợp l&yacute;. Do đ&oacute;, đợt mở b&aacute;n n&agrave;y đ&atilde; thu h&uacute;t rất đ&ocirc;ng những người c&oacute; nhu cầu ở thực.</p>', 1395392367, 2, 0, '', 'projects', '', '', '', 'du-an-3', 'Hồ Chí Minh', 'Gò vấp', 3481),
(226, 520, 'Dự án 4', 'Dự án Times City của Vingroup, ngay trong ngày mở bán đầu tiên, một lượng lớn căn hộ đã được giao dịch thành công. Dự án Thăng Long Number 1 cũng đã có hơn 10 giao dịch đầu tiên trong năm mới. Các dự án căn hộ cao cấp khác như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Khánh, Mandarin Garden, Indochina Plaza Hà Nội hay Star City Lê Văn Lương,... cũng đang được nhiều người mua quan tâm. Mức giá những căn hộ này trong khoảng 33-40 triệu đồng/m2.\r\n\r\nTại thị trường phía Nam, Phú Mỹ Hưng công bố kết quả chào bán thành công 44 trong tổng số 48 căn biệt thự Nam Viên. Mức giá hiện nay trên thị trường của dự án này lên tới 11 tỷ đồng/căn. Trước đó, dự án lâu đài biệt thự dự án Chateau của liên doanh này đã bán được hơn 90%.\r\n\r\nNhiều dự án BĐS cao cấp cũng đang rục rịch lên kế hoạch tung ra thị trường. Savills VN đang mở bán những căn hộ cuối cùng của dự án Tây Hồ Residence với mức giá gần 30 triệu đồng/m2. Phú Mỹ Hưng lên kế hoạch giới thiệu căn hộ Green Valley với mức ưu đãi lãi suất vay và tiến độ thanh toán hợp lý.\r\n\r\nKhảo sát thị trường cho thấy, các sản phẩm BĐS cao cấp mở bán có thanh khoản cao tập trung chủ yếu ở các dự án có vị trí đẹp và môi trường sống tốt, đã và đang hoàn thiện, khách hàng có thể nhận nhà ngay và mức giá hợp lý. Do đó, đợt mở bán này đã thu hút rất đông những người có nhu cầu ở thực.', '3482', '<p>Dự &aacute;n Times City của Vingroup, ngay trong ng&agrave;y mở b&aacute;n đầu ti&ecirc;n, một lượng lớn căn hộ đ&atilde; được giao dịch th&agrave;nh c&ocirc;ng. Dự &aacute;n Thăng Long Number 1 cũng đ&atilde; c&oacute; hơn 10 giao dịch đầu ti&ecirc;n trong năm mới. C&aacute;c dự &aacute;n căn hộ cao cấp kh&aacute;c như Mulberry Lane của CapitaLand, Platinum Residence Ngọc Kh&aacute;nh, Mandarin Garden, Indochina Plaza H&agrave; Nội hay Star City L&ecirc; Văn Lương,... cũng đang được nhiều người mua quan t&acirc;m. Mức gi&aacute; những căn hộ n&agrave;y trong khoảng 33-40 triệu đồng/m2.<br /><br />Tại thị trường ph&iacute;a Nam, Ph&uacute; Mỹ Hưng c&ocirc;ng bố kết quả ch&agrave;o b&aacute;n th&agrave;nh c&ocirc;ng 44 trong tổng số 48 căn biệt thự Nam Vi&ecirc;n. Mức gi&aacute; hiện nay tr&ecirc;n thị trường của dự &aacute;n n&agrave;y l&ecirc;n tới 11 tỷ đồng/căn. Trước đ&oacute;, dự &aacute;n l&acirc;u đ&agrave;i biệt thự dự &aacute;n Chateau của li&ecirc;n doanh n&agrave;y đ&atilde; b&aacute;n được hơn 90%.<br /><br />Nhiều dự &aacute;n BĐS cao cấp cũng đang rục rịch l&ecirc;n kế hoạch tung ra thị trường. Savills VN đang mở b&aacute;n những căn hộ cuối c&ugrave;ng của dự &aacute;n T&acirc;y Hồ Residence với mức gi&aacute; gần 30 triệu đồng/m2. Ph&uacute; Mỹ Hưng l&ecirc;n kế hoạch giới thiệu căn hộ Green Valley với mức ưu đ&atilde;i l&atilde;i suất vay v&agrave; tiến độ thanh to&aacute;n hợp l&yacute;.<br /><br />Khảo s&aacute;t thị trường cho thấy, c&aacute;c sản phẩm BĐS cao cấp mở b&aacute;n c&oacute; thanh khoản cao tập trung chủ yếu ở c&aacute;c dự &aacute;n c&oacute; vị tr&iacute; đẹp v&agrave; m&ocirc;i trường sống tốt, đ&atilde; v&agrave; đang ho&agrave;n thiện, kh&aacute;ch h&agrave;ng c&oacute; thể nhận nh&agrave; ngay v&agrave; mức gi&aacute; hợp l&yacute;. Do đ&oacute;, đợt mở b&aacute;n n&agrave;y đ&atilde; thu h&uacute;t rất đ&ocirc;ng những người c&oacute; nhu cầu ở thực.</p>', 1395392393, 2, 0, '', 'projects', '', '', '', 'du-an-4', 'Hồ Chí Minh', 'Quận 12', 3483),
(227, 523, 'Đối tác 1', '', '3485', '', 1395395194, 1, 0, '', 'ads', '', '', '', '', '', '', 0),
(228, 523, 'Đối tac 2', '', '3486', '', 1395395211, 1, 0, '', 'ads', '', '', '', '', '', '', 0),
(229, 523, 'Đối tác 4', '', '3487', '', 1395395231, 1, 0, 'https://www.google.com.vn/?gfe_rd=cr&ei=0gosU-OUH6mJ8QfOj4GACg', 'ads', '', '', '', 'doi-tac-4', '', '', 0),
(230, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(231, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(232, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(233, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(234, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(235, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(236, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(237, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(238, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(239, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(240, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(241, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0);
INSERT INTO `vsf_page` (`id`, `catId`, `title`, `intro`, `image`, `content`, `postDate`, `status`, `index`, `code`, `module`, `mTitle`, `mKeyWord`, `mIntro`, `mUrl`, `provin`, `dis`, `map`) VALUES
(242, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(243, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(244, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(245, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(246, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(247, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(248, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(249, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(250, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(251, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(252, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(253, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(254, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(255, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(256, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(257, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(258, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(259, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(260, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(261, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(262, 557, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(263, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(264, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(265, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(266, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(267, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(268, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(269, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(270, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(271, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(272, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(273, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(274, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(275, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(276, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(277, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(278, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(279, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(280, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(281, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(282, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(283, 558, 'Vân tay hai anh em sinh đôi có điểm trùng lặp không?', 'Hai anh em sinh đôi có gene giống nhau nhưng liệu họ có điểm trùng nhau nào về vân tay không? Tôi còn thắc mắc là tại sao nhiều người làm phẫu thuật thay lớp da tay rồi nhưng sau đó vân tay vẫn được phục hồi? (Trường)', NULL, '<p><span>Anh em sinh đ&ocirc;i c&ugrave;ng trứng c&oacute; bộ genome ho&agrave;n to&agrave;n giống nhau, nhưng v&acirc;n tay kh&ocirc;ng do gene quyết định, v&igrave; thế họ kh&ocirc;ng c&oacute; v&acirc;n tay giống nhau. C&aacute;c yếu tố quyết định như c&aacute;c đường v&acirc;n nổi (ridge), c&aacute;c r&atilde;nh (valey) v&agrave; h&igrave;nh dạng xo&aacute;y (swirl) của v&acirc;n tay được h&igrave;nh th&agrave;nh từ l&uacute;c nằm trong bụng mẹ.</span></p>', 1408548718, 1, 0, '', 'faq', '', '', '', '', '', '', 0),
(284, 557, '{"fullname":"fdsffda","phone":"fda","email":"yunha@mail.com"}', 'fdas', NULL, '', 1409526619, 0, 0, '', '', '', '', '', '', '', '', 0),
(285, 557, '{"fullname":"fdsffda","phone":"fda","email":"yunha@mail.com"}', 'fdas', NULL, '', 1409526630, 0, 0, '', '', '', '', '', '', '', '', 0),
(286, 559, '{"fullname":"minh h\\u1ea3i","phone":"0937-256-252","email":"yunha@mail.com"}', 'Khi làm việc với máy tính hãy nhớ quy tắc 20x20x20: Sau khoảng 20 phút, hãy rời mắt khỏi màn hình của bạn, nhìn một cái gì đó cách 20 feet (6 m) trong 20 giây.', NULL, '', 1409526831, 1, 0, '', '', '', '', '', '', '', '', 0),
(287, 557, '{"fullname":["pandog-edit","pandog-edit"],"phone":null,"email":"pandog-edit@pandog.net"}', 'Câu hỏi', NULL, '<p><span>Nội dung</span></p>', 1409752832, 0, 0, '', 'faq', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_partner`
--

CREATE TABLE IF NOT EXISTS `vsf_partner` (
`id` int(10) unsigned NOT NULL,
  `catId` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `website` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fileId` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `beginTime` int(11) NOT NULL,
  `expTime` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `position` varchar(10) NOT NULL,
  `hits` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `clearSearch` varchar(250) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_pcontact`
--

CREATE TABLE IF NOT EXISTS `vsf_pcontact` (
`id` int(11) NOT NULL,
  `catId` int(11) DEFAULT NULL,
  `title` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `image` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `zoom` int(11) NOT NULL DEFAULT '13',
  `email` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sname` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `postDate` int(11) DEFAULT NULL,
  `pcontactMtTitle` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mtKeyWord` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mtDesc` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mtUrl` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vsf_pcontact`
--

INSERT INTO `vsf_pcontact` (`id`, `catId`, `title`, `intro`, `content`, `image`, `code`, `index`, `address`, `longitude`, `latitude`, `zoom`, `email`, `sname`, `status`, `postDate`, `pcontactMtTitle`, `mtKeyWord`, `mtDesc`, `mtUrl`) VALUES
(3, 562, 'All Nail', '49B Hùng Vương, Phường 6, Quận 5, HCM\r\nĐt: 08 3830 7888 - 08 3830 7999 - 3832 1666', '<p>506/15/21, Đường 3/2, Phường 14, Quận 10. HCM</p>\r\n<p>Điện thoại: 08.668.72.82 - Hotline: 0913.88.53.53</p>', NULL, 'contact', 0, '506/15/21, Đường 3/2, Phường 14, Quận 10. HCM', 106.70456161117556, 10.771567354561485, 17, NULL, NULL, 1, 1377151849, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_post`
--

CREATE TABLE IF NOT EXISTS `vsf_post` (
`id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `index` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `mUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mIntro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mKeyWord` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clean` text COLLATE utf8_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `author_type` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `public_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `vsf_post`
--

INSERT INTO `vsf_post` (`id`, `catId`, `title`, `intro`, `content`, `status`, `index`, `image`, `location`, `address`, `phone`, `name`, `website`, `email`, `mUrl`, `mTitle`, `mIntro`, `mKeyWord`, `clean`, `author`, `author_type`, `public_date`, `end_date`, `created_date`) VALUES
(1, 538, 'Bán tiệm nail ', '10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga và lập gia đình. Nay khi quan hệ giữa hai nước ngày càng băng giá, cô được lệnh phải rời đất nước mà cô yêu mến.', '&lt;p&gt;10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga và lập gia đình. Nay khi quan hệ giữa hai nước ngày càng băng giá, cô được lệnh phải rời đất nước mà cô yêu mến.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;&quot;Nga không phải là một nơi tệ, nhưng những điều tồi tệ đang xảy ra&quot;, &lt;em&gt;NBC News &lt;/em&gt;dẫn lời Gaspar, cho biết. Cô đang đóng gói đồ đạc trong ngôi nhà của mình tại St. Petersburg. &quot;Gia đình chúng tôi ở đây là người Nga, bạn bè chúng tôi ở đây là người Nga. Đó là những điều tốt đẹp duy nhất&quot;, cô nói tiếp.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Nhà chức trách Nga tháng trước thu hồi giấy phép cư trú của Gaspar. Một bức thư gửi vào ngày 21/7 cáo buộc cô có hành vi hoặc có ý định vi phạm hiến pháp, và là mối đe dọa cho an ninh quốc gia.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Cô đã gửi đi nhiều đơn khiếu nại nhưng không có kết quả. Vì vậy cô, chồng cô Ivan Pavlov, và con gái sẽ rời khỏi Nga trong tuần này. Điểm đến của họ được giữ kín.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Gaspar cho biết cô không nghĩ rằng chính quyền Nga ra quyết định này do nghề nghiệp của cô. Công việc gần đây nhất của cô là về giao lưu văn hóa giữa Anh và Bảo tàng Hermitage danh tiếng. Cô tin rằng chồng cô, một luật sư nhân quyền và người ủng hộ tự do báo chí mới là mục tiêu thực sự.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Pavlov, người từng biện hộ cho một số khách hàng vi phạm quy định về an ninh của Nga, đồng ý rằng công việc của anh có thể là một phần lý do cô bị trục xuất. Tuy nhiên, còn một yếu tố quan trọng khác, Gasper là người Mỹ.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;&quot;Đó là một giải pháp dễ dàng cho các vấn đề phức tạp&quot;, Pavlov nhận xét về quyết định của chính phủ. &quot;Họ không cần giải thích bất cứ điều gì&quot;, anh nói thêm. Trong khi đó, các quan chức Nga từ chối bình luận về vụ việc.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Tai họa ập đến gia đình Gaspar và Pavlov khi mối quan hệ Nga - Mỹ đang trong giai đoạn căng thẳng nhất kể từ sau Chiến tranh Lạnh. &quot;Ivan và tôi bắt đầu cảm thấy lo lắng khi Nga quyết định sáp nhập Crimea, chúng tôi nhận ra rằng mọi thứ liên quan đến hai nước sẽ nhanh chóng thay đổi&quot;, cô nói.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Cuộc xung đột ở Ukraine đổ thêm dầu vào lửa cho những lời cáo buộc của điện Kremlin về việc Mỹ đứng đằng sau vụ lật đổ Tổng thống thân Nga, Viktor Yanukovych hồi tháng hai, và hiện nay đang ủng hộ chính quyền mới của ông Petro Poroshenko.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Trước khi cuộc xung đột ở Ukraine bùng nổ, Nga đã đưa ra một số luật chống phương Tây. Cuối năm 2012, chính phủ thông qua một đạo luật, bắt buộc các tổ chức phi chính phủ nhận tài trợ từ các nước khác phải đăng ký là cơ quan nước ngoài.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Nhiều tổ chức phi lợi nhuận và nhân đạo phải đối mặt với nhiều áp lực, hoặc phải rời khỏi nước Nga, trong đó có Cơ quan Phát triển Quốc tế Mỹ và Nhóm Giám sát Bầu cử Golos. Nga cũng cấm người Mỹ nhận nuôi trẻ em Nga sau những ca gây bất đồng.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Phương Tây đã áp đặt nhiều lệnh trừng phạt với Nga do Moscow tiếp tục hỗ trợ phiến quân Ukraine. Đáp trả động thái này, Nga ra lệnh cấm nhập khẩu thực phẩm, sữa, trái cây, rau quả, thịt lợn, cá và các loại thịt khác từ Mỹ, EU, Hà Lan và Australia.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Ở nhà, Gaspar cố gắng giải thích số phận của gia đình mình bằng cách dễ hiểu nhất cho cô con gái 5 tuổi. “Con có nhớ bố và mẹ thi thoảng cãi nhau không, lần này bố mẹ không cãi nhau, mà là đất nước của bố mẹ. Đất nước của bố nói rằng, vì mẹ đến từ nơi họ đang có bất hòa, nên mẹ phải nên rời đi&quot;.&lt;/p&gt;\n&lt;p class=&quot;Normal&quot;&gt;Mặc dù Gaspar bị sốc trước khả năng không thể trở lại Nga trong tương lai gần, cô vẫn giữ lòng yêu mến với quốc gia trục xuất cô. &quot;Sẽ đến lúc tôi phải đối mặt với thực tế&quot;, Gaspar nói. &quot;Đây là nhà của tôi, nó luôn nhà của tôi, tôi có những người bạn tuyệt vời ở đây&quot;.&lt;/p&gt;', 2, 0, 3501, 769, '5812 Yadkin Rd', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog 5812 yadkin rd adamsville 35005 90005 ban tiem nail 10 nam truoc jennifer gaspar di cu tu my den o lai nga va lap gia dinh nay khi quan he giua hai nuoc ngay cang bang gia co duoc lenh phai roi dat nuoc ma co yeu men p 10 nam truoc jennifer gaspar di cu tu my den o lai nga va lap gia dinh nay khi quan he giua hai nuoc ngay cang bang gia co duoc lenh phai roi dat nuoc ma co yeu men p \n p class normal nga khong phai la mot noi te nhung nhung dieu toi te dang xay ra em nbc news em dan loi gaspar cho biet co dang dong goi do dac trong ngoi nha cua minh tai st petersburg gia dinh chung toi o day la nguoi nga ban be chung toi o day la nguoi nga do la nhung dieu tot dep duy nhat co noi tiep p \n p class normal nha chuc trach nga thang truoc thu hoi giay phep cu tru cua gaspar mot buc thu gui vao ngay 21 7 cao buoc co co hanh vi hoac co y dinh vi pham hien phap va la moi de doa cho an ninh quoc gia p \n p class normal co da gui di nhieu don khieu nai nhung khong co ket qua vi vay co chong co ivan pavlov va con gai se roi khoi nga trong tuan nay diem den cua ho duoc giu kin p \n p class normal gaspar cho biet co khong nghi rang chinh quyen nga ra quyet dinh nay do nghe nghiep cua co cong viec gan day nhat cua co la ve giao luu van hoa giua anh va bao tang hermitage danh tieng co tin rang chong co mot luat su nhan quyen va nguoi ung ho tu do bao chi moi la muc tieu thuc su p \n p class normal pavlov nguoi tung bien ho cho mot so khach hang vi pham quy dinh ve an ninh cua nga dong y rang cong viec cua anh co the la mot phan ly do co bi truc xuat tuy nhien con mot yeu to quan trong khac gasper la nguoi my p \n p class normal do la mot giai phap de dang cho cac van de phuc tap pavlov nhan xet ve quyet dinh cua chinh phu ho khong can giai thich bat cu dieu gi anh noi them trong khi do cac quan chuc nga tu choi binh luan ve vu viec p \n p class normal tai hoa ap den gia dinh gaspar va pavlov khi moi quan he nga my dang trong giai doan cang thang nhat ke tu sau chien tranh lanh ivan va toi bat dau cam thay lo lang khi nga quyet dinh sap nhap crimea chung toi nhan ra rang moi thu lien quan den hai nuoc se nhanh chong thay doi co noi p \n p class normal cuoc xung dot o ukraine do them dau vao lua cho nhung loi cao buoc cua dien kremlin ve viec my dung dang sau vu lat do tong thong than nga viktor yanukovych hoi thang hai va hien nay dang ung ho chinh quyen moi cua ong petro poroshenko p \n p class normal truoc khi cuoc xung dot o ukraine bung no nga da dua ra mot so luat chong phuong tay cuoi nam 2012 chinh phu thong qua mot dao luat bat buoc cac to chuc phi chinh phu nhan tai tro tu cac nuoc khac phai dang ky la co quan nuoc ngoai p \n p class normal nhieu to chuc phi loi nhuan va nhan dao phai doi mat voi nhieu ap luc hoac phai roi khoi nuoc nga trong do co co quan phat trien quoc te my va nhom giam sat bau cu golos nga cung cam nguoi my nhan nuoi tre em nga sau nhung ca gay bat dong p \n p class normal phuong tay da ap dat nhieu lenh trung phat voi nga do moscow tiep tuc ho tro phien quan ukraine dap tra dong thai nay nga ra lenh cam nhap khau thuc pham sua trai cay rau qua thit lon ca va cac loai thit khac tu my eu ha lan va australia p \n p class normal o nha gaspar co gang giai thich so phan cua gia dinh minh bang cach de hieu nhat cho co con gai 5 tuoi “con co nho bo va me thi thoang cai nhau khong lan nay bo me khong cai nhau ma la dat nuoc cua bo me dat nuoc cua bo noi rang vi me den tu noi ho dang co bat hoa nen me phai nen roi di p \n p class normal mac du gaspar bi soc truoc kha nang khong the tro lai nga trong tuong lai gan co van giu long yeu men voi quoc gia truc xuat co se den luc toi phai doi mat voi thuc te gaspar noi day la nha cua toi no luon nha cua toi toi co nhung nguoi ban tuyet voi o day p', 8, 'user', '2014-09-01 00:00:00', '2014-09-30 00:00:00', '2014-08-20 13:08:21'),
(2, 538, 'Bán tiệm nail 1', 'Bán tiệm nail', '<p class="Normal">10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p>\r\n<p class="Normal">"Nga kh&ocirc;ng phải l&agrave; một nơi tệ, nhưng những điều tồi tệ đang xảy ra", <em>NBC News </em>dẫn lời Gaspar, cho biết. C&ocirc; đang đ&oacute;ng g&oacute;i đồ đạc trong ng&ocirc;i nh&agrave; của m&igrave;nh tại St. Petersburg. "Gia đ&igrave;nh ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga, bạn b&egrave; ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga. Đ&oacute; l&agrave; những điều tốt đẹp duy nhất", c&ocirc; n&oacute;i tiếp.</p>\r\n<p class="Normal">Nh&agrave; chức tr&aacute;ch Nga th&aacute;ng trước thu hồi giấy ph&eacute;p cư tr&uacute; của Gaspar. Một bức thư gửi v&agrave;o ng&agrave;y 21/7 c&aacute;o buộc c&ocirc; c&oacute; h&agrave;nh vi hoặc c&oacute; &yacute; định vi phạm hiến ph&aacute;p, v&agrave; l&agrave; mối đe dọa cho an ninh quốc gia.</p>\r\n<p class="Normal">C&ocirc; đ&atilde; gửi đi nhiều đơn khiếu nại nhưng kh&ocirc;ng c&oacute; kết quả. V&igrave; vậy c&ocirc;, chồng c&ocirc; Ivan Pavlov, v&agrave; con g&aacute;i sẽ rời khỏi Nga trong tuần n&agrave;y. Điểm đến của họ được giữ k&iacute;n.</p>\r\n<p class="Normal">Gaspar cho biết c&ocirc; kh&ocirc;ng nghĩ rằng ch&iacute;nh quyền Nga ra quyết định n&agrave;y do nghề nghiệp của c&ocirc;. C&ocirc;ng việc gần đ&acirc;y nhất của c&ocirc; l&agrave; về giao lưu văn h&oacute;a giữa Anh v&agrave; Bảo t&agrave;ng Hermitage danh tiếng. C&ocirc; tin rằng chồng c&ocirc;, một luật sư nh&acirc;n quyền v&agrave; người ủng hộ tự do b&aacute;o ch&iacute; mới l&agrave; mục ti&ecirc;u thực sự.</p>\r\n<p class="Normal">Pavlov, người từng biện hộ cho một số kh&aacute;ch h&agrave;ng vi phạm quy định về an ninh của Nga, đồng &yacute; rằng c&ocirc;ng việc của anh c&oacute; thể l&agrave; một phần l&yacute; do c&ocirc; bị trục xuất. Tuy nhi&ecirc;n, c&ograve;n một yếu tố quan trọng kh&aacute;c, Gasper l&agrave; người Mỹ.</p>\r\n<p class="Normal">"Đ&oacute; l&agrave; một giải ph&aacute;p dễ d&agrave;ng cho c&aacute;c vấn đề phức tạp", Pavlov nhận x&eacute;t về quyết định của ch&iacute;nh phủ. "Họ kh&ocirc;ng cần giải th&iacute;ch bất cứ điều g&igrave;", anh n&oacute;i th&ecirc;m. Trong khi đ&oacute;, c&aacute;c quan chức Nga từ chối b&igrave;nh luận về vụ việc.</p>\r\n<p class="Normal">Tai họa ập đến gia đ&igrave;nh Gaspar v&agrave; Pavlov khi mối quan hệ Nga - Mỹ đang trong giai đoạn căng thẳng nhất kể từ sau Chiến tranh Lạnh. "Ivan v&agrave; t&ocirc;i bắt đầu cảm thấy lo lắng khi Nga quyết định s&aacute;p nhập Crimea, ch&uacute;ng t&ocirc;i nhận ra rằng mọi thứ li&ecirc;n quan đến hai nước sẽ nhanh ch&oacute;ng thay đổi", c&ocirc; n&oacute;i.</p>\r\n<p class="Normal">Cuộc xung đột ở Ukraine đổ th&ecirc;m dầu v&agrave;o lửa cho những lời c&aacute;o buộc của điện Kremlin về việc Mỹ đứng đằng sau vụ lật đổ Tổng thống th&acirc;n Nga, Viktor Yanukovych hồi th&aacute;ng hai, v&agrave; hiện nay đang ủng hộ ch&iacute;nh quyền mới của &ocirc;ng Petro Poroshenko.</p>\r\n<p class="Normal">Trước khi cuộc xung đột ở Ukraine b&ugrave;ng nổ, Nga đ&atilde; đưa ra một số luật chống phương T&acirc;y. Cuối năm 2012, ch&iacute;nh phủ th&ocirc;ng qua một đạo luật, bắt buộc c&aacute;c tổ chức phi ch&iacute;nh phủ nhận t&agrave;i trợ từ c&aacute;c nước kh&aacute;c phải đăng k&yacute; l&agrave; cơ quan nước ngo&agrave;i.</p>\r\n<p class="Normal">Nhiều tổ chức phi lợi nhuận v&agrave; nh&acirc;n đạo phải đối mặt với nhiều &aacute;p lực, hoặc phải rời khỏi nước Nga, trong đ&oacute; c&oacute; Cơ quan Ph&aacute;t triển Quốc tế Mỹ v&agrave; Nh&oacute;m Gi&aacute;m s&aacute;t Bầu cử Golos. Nga cũng cấm người Mỹ nhận nu&ocirc;i trẻ em Nga sau những ca g&acirc;y bất đồng.</p>\r\n<p class="Normal">Phương T&acirc;y đ&atilde; &aacute;p đặt nhiều lệnh trừng phạt với Nga do Moscow tiếp tục hỗ trợ phiến qu&acirc;n Ukraine. Đ&aacute;p trả động th&aacute;i n&agrave;y, Nga ra lệnh cấm nhập khẩu thực phẩm, sữa, tr&aacute;i c&acirc;y, rau quả, thịt lợn, c&aacute; v&agrave; c&aacute;c loại thịt kh&aacute;c từ Mỹ, EU, H&agrave; Lan v&agrave; Australia.</p>\r\n<p class="Normal">Ở nh&agrave;, Gaspar cố gắng giải th&iacute;ch số phận của gia đ&igrave;nh m&igrave;nh bằng c&aacute;ch dễ hiểu nhất cho c&ocirc; con g&aacute;i 5 tuổi. &ldquo;Con c&oacute; nhớ bố v&agrave; mẹ thi thoảng c&atilde;i nhau kh&ocirc;ng, lần n&agrave;y bố mẹ kh&ocirc;ng c&atilde;i nhau, m&agrave; l&agrave; đất nước của bố mẹ. Đất nước của bố n&oacute;i rằng, v&igrave; mẹ đến từ nơi họ đang c&oacute; bất h&ograve;a, n&ecirc;n mẹ phải n&ecirc;n rời đi".</p>\r\n<p class="Normal">Mặc d&ugrave; Gaspar bị sốc trước khả năng kh&ocirc;ng thể trở lại Nga trong tương lai gần, c&ocirc; vẫn giữ l&ograve;ng y&ecirc;u mến với quốc gia trục xuất c&ocirc;. "Sẽ đến l&uacute;c t&ocirc;i phải đối mặt với thực tế", Gaspar n&oacute;i. "Đ&acirc;y l&agrave; nh&agrave; của t&ocirc;i, n&oacute; lu&ocirc;n nh&agrave; của t&ocirc;i, t&ocirc;i c&oacute; những người bạn tuyệt vời ở đ&acirc;y".</p>', 1, 0, 3500, 516, '5812 Yadkin Rd', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'Ban tiem nail 1 Ban tiem nail p class Normal 10 nam truoc Jennifer Gaspar di cu tu My den o lai Nga v', 8, 'user', '2014-08-01 00:00:00', '2014-09-30 00:00:00', '2014-08-20 13:08:33'),
(3, 516, 'Chồng Nga vợ Mỹ kẹt giữa cơn giận của hai quốc gia', '<p>10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p>', '<p>10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p>\r\n<p class="Normal">"Nga kh&ocirc;ng phải l&agrave; một nơi tệ, nhưng những điều tồi tệ đang xảy ra", <em>NBC News </em>dẫn lời Gaspar, cho biết. C&ocirc; đang đ&oacute;ng g&oacute;i đồ đạc trong ng&ocirc;i nh&agrave; của m&igrave;nh tại St. Petersburg. "Gia đ&igrave;nh ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga, bạn b&egrave; ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga. Đ&oacute; l&agrave; những điều tốt đẹp duy nhất", c&ocirc; n&oacute;i tiếp.</p>\r\n<p class="Normal">Nh&agrave; chức tr&aacute;ch Nga th&aacute;ng trước thu hồi giấy ph&eacute;p cư tr&uacute; của Gaspar. Một bức thư gửi v&agrave;o ng&agrave;y 21/7 c&aacute;o buộc c&ocirc; c&oacute; h&agrave;nh vi hoặc c&oacute; &yacute; định vi phạm hiến ph&aacute;p, v&agrave; l&agrave; mối đe dọa cho an ninh quốc gia.</p>\r\n<p class="Normal">C&ocirc; đ&atilde; gửi đi nhiều đơn khiếu nại nhưng kh&ocirc;ng c&oacute; kết quả. V&igrave; vậy c&ocirc;, chồng c&ocirc; Ivan Pavlov, v&agrave; con g&aacute;i sẽ rời khỏi Nga trong tuần n&agrave;y. Điểm đến của họ được giữ k&iacute;n.</p>\r\n<p class="Normal">Gaspar cho biết c&ocirc; kh&ocirc;ng nghĩ rằng ch&iacute;nh quyền Nga ra quyết định n&agrave;y do nghề nghiệp của c&ocirc;. C&ocirc;ng việc gần đ&acirc;y nhất của c&ocirc; l&agrave; về giao lưu văn h&oacute;a giữa Anh v&agrave; Bảo t&agrave;ng Hermitage danh tiếng. C&ocirc; tin rằng chồng c&ocirc;, một luật sư nh&acirc;n quyền v&agrave; người ủng hộ tự do b&aacute;o ch&iacute; mới l&agrave; mục ti&ecirc;u thực sự.</p>\r\n<p class="Normal">Pavlov, người từng biện hộ cho một số kh&aacute;ch h&agrave;ng vi phạm quy định về an ninh của Nga, đồng &yacute; rằng c&ocirc;ng việc của anh c&oacute; thể l&agrave; một phần l&yacute; do c&ocirc; bị trục xuất. Tuy nhi&ecirc;n, c&ograve;n một yếu tố quan trọng kh&aacute;c, Gasper l&agrave; người Mỹ.</p>\r\n<p class="Normal">"Đ&oacute; l&agrave; một giải ph&aacute;p dễ d&agrave;ng cho c&aacute;c vấn đề phức tạp", Pavlov nhận x&eacute;t về quyết định của ch&iacute;nh phủ. "Họ kh&ocirc;ng cần giải th&iacute;ch bất cứ điều g&igrave;", anh n&oacute;i th&ecirc;m. Trong khi đ&oacute;, c&aacute;c quan chức Nga từ chối b&igrave;nh luận về vụ việc.</p>\r\n<p class="Normal">Tai họa ập đến gia đ&igrave;nh Gaspar v&agrave; Pavlov khi mối quan hệ Nga - Mỹ đang trong giai đoạn căng thẳng nhất kể từ sau Chiến tranh Lạnh. "Ivan v&agrave; t&ocirc;i bắt đầu cảm thấy lo lắng khi Nga quyết định s&aacute;p nhập Crimea, ch&uacute;ng t&ocirc;i nhận ra rằng mọi thứ li&ecirc;n quan đến hai nước sẽ nhanh ch&oacute;ng thay đổi", c&ocirc; n&oacute;i.</p>\r\n<p class="Normal">Cuộc xung đột ở Ukraine đổ th&ecirc;m dầu v&agrave;o lửa cho những lời c&aacute;o buộc của điện Kremlin về việc Mỹ đứng đằng sau vụ lật đổ Tổng thống th&acirc;n Nga, Viktor Yanukovych hồi th&aacute;ng hai, v&agrave; hiện nay đang ủng hộ ch&iacute;nh quyền mới của &ocirc;ng Petro Poroshenko.</p>\r\n<p class="Normal">Trước khi cuộc xung đột ở Ukraine b&ugrave;ng nổ, Nga đ&atilde; đưa ra một số luật chống phương T&acirc;y. Cuối năm 2012, ch&iacute;nh phủ th&ocirc;ng qua một đạo luật, bắt buộc c&aacute;c tổ chức phi ch&iacute;nh phủ nhận t&agrave;i trợ từ c&aacute;c nước kh&aacute;c phải đăng k&yacute; l&agrave; cơ quan nước ngo&agrave;i.</p>\r\n<p class="Normal">Nhiều tổ chức phi lợi nhuận v&agrave; nh&acirc;n đạo phải đối mặt với nhiều &aacute;p lực, hoặc phải rời khỏi nước Nga, trong đ&oacute; c&oacute; Cơ quan Ph&aacute;t triển Quốc tế Mỹ v&agrave; Nh&oacute;m Gi&aacute;m s&aacute;t Bầu cử Golos. Nga cũng cấm người Mỹ nhận nu&ocirc;i trẻ em Nga sau những ca g&acirc;y bất đồng.</p>\r\n<p class="Normal">Phương T&acirc;y đ&atilde; &aacute;p đặt nhiều lệnh trừng phạt với Nga do Moscow tiếp tục hỗ trợ phiến qu&acirc;n Ukraine. Đ&aacute;p trả động th&aacute;i n&agrave;y, Nga ra lệnh cấm nhập khẩu thực phẩm, sữa, tr&aacute;i c&acirc;y, rau quả, thịt lợn, c&aacute; v&agrave; c&aacute;c loại thịt kh&aacute;c từ Mỹ, EU, H&agrave; Lan v&agrave; Australia.</p>\r\n<p class="Normal">Ở nh&agrave;, Gaspar cố gắng giải th&iacute;ch số phận của gia đ&igrave;nh m&igrave;nh bằng c&aacute;ch dễ hiểu nhất cho c&ocirc; con g&aacute;i 5 tuổi. &ldquo;Con c&oacute; nhớ bố v&agrave; mẹ thi thoảng c&atilde;i nhau kh&ocirc;ng, lần n&agrave;y bố mẹ kh&ocirc;ng c&atilde;i nhau, m&agrave; l&agrave; đất nước của bố mẹ. Đất nước của bố n&oacute;i rằng, v&igrave; mẹ đến từ nơi họ đang c&oacute; bất h&ograve;a, n&ecirc;n mẹ phải n&ecirc;n rời đi".</p>\r\n<p class="Normal">Mặc d&ugrave; Gaspar bị sốc trước khả năng kh&ocirc;ng thể trở lại Nga trong tương lai gần, c&ocirc; vẫn giữ l&ograve;ng y&ecirc;u mến với quốc gia trục xuất c&ocirc;. "Sẽ đến l&uacute;c t&ocirc;i phải đối mặt với thực tế", Gaspar n&oacute;i. "Đ&acirc;y l&agrave; nh&agrave; của t&ocirc;i, n&oacute; lu&ocirc;n nh&agrave; của t&ocirc;i, t&ocirc;i c&oacute; những người bạn tuyệt vời ở đ&acirc;y".</p>', 2, 0, 3501, 769, '', 'phonephone', '', 'websitewebsite', 'emailemail', NULL, NULL, NULL, NULL, 'titleChong Nga vo My ket giua con gian cua hai quoc gia p 10 nam truoc Jennifer Gaspar di cu tu My den o lai Nga v', 10, 'admin', '2014-08-20 13:08:21', '2014-10-31 06:24:30', '2014-08-20 13:08:21'),
(4, 516, 'Chồng Nga vợ Mỹ kẹt giữa cơn giận của hai quốc gia', '<p>10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p>', '<p>10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p>\r\n<p class="Normal">"Nga kh&ocirc;ng phải l&agrave; một nơi tệ, nhưng những điều tồi tệ đang xảy ra", <em>NBC News </em>dẫn lời Gaspar, cho biết. C&ocirc; đang đ&oacute;ng g&oacute;i đồ đạc trong ng&ocirc;i nh&agrave; của m&igrave;nh tại St. Petersburg. "Gia đ&igrave;nh ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga, bạn b&egrave; ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga. Đ&oacute; l&agrave; những điều tốt đẹp duy nhất", c&ocirc; n&oacute;i tiếp.</p>\r\n<p class="Normal">Nh&agrave; chức tr&aacute;ch Nga th&aacute;ng trước thu hồi giấy ph&eacute;p cư tr&uacute; của Gaspar. Một bức thư gửi v&agrave;o ng&agrave;y 21/7 c&aacute;o buộc c&ocirc; c&oacute; h&agrave;nh vi hoặc c&oacute; &yacute; định vi phạm hiến ph&aacute;p, v&agrave; l&agrave; mối đe dọa cho an ninh quốc gia.</p>\r\n<p class="Normal">C&ocirc; đ&atilde; gửi đi nhiều đơn khiếu nại nhưng kh&ocirc;ng c&oacute; kết quả. V&igrave; vậy c&ocirc;, chồng c&ocirc; Ivan Pavlov, v&agrave; con g&aacute;i sẽ rời khỏi Nga trong tuần n&agrave;y. Điểm đến của họ được giữ k&iacute;n.</p>\r\n<p class="Normal">Gaspar cho biết c&ocirc; kh&ocirc;ng nghĩ rằng ch&iacute;nh quyền Nga ra quyết định n&agrave;y do nghề nghiệp của c&ocirc;. C&ocirc;ng việc gần đ&acirc;y nhất của c&ocirc; l&agrave; về giao lưu văn h&oacute;a giữa Anh v&agrave; Bảo t&agrave;ng Hermitage danh tiếng. C&ocirc; tin rằng chồng c&ocirc;, một luật sư nh&acirc;n quyền v&agrave; người ủng hộ tự do b&aacute;o ch&iacute; mới l&agrave; mục ti&ecirc;u thực sự.</p>\r\n<p class="Normal">Pavlov, người từng biện hộ cho một số kh&aacute;ch h&agrave;ng vi phạm quy định về an ninh của Nga, đồng &yacute; rằng c&ocirc;ng việc của anh c&oacute; thể l&agrave; một phần l&yacute; do c&ocirc; bị trục xuất. Tuy nhi&ecirc;n, c&ograve;n một yếu tố quan trọng kh&aacute;c, Gasper l&agrave; người Mỹ.</p>\r\n<p class="Normal">"Đ&oacute; l&agrave; một giải ph&aacute;p dễ d&agrave;ng cho c&aacute;c vấn đề phức tạp", Pavlov nhận x&eacute;t về quyết định của ch&iacute;nh phủ. "Họ kh&ocirc;ng cần giải th&iacute;ch bất cứ điều g&igrave;", anh n&oacute;i th&ecirc;m. Trong khi đ&oacute;, c&aacute;c quan chức Nga từ chối b&igrave;nh luận về vụ việc.</p>\r\n<p class="Normal">Tai họa ập đến gia đ&igrave;nh Gaspar v&agrave; Pavlov khi mối quan hệ Nga - Mỹ đang trong giai đoạn căng thẳng nhất kể từ sau Chiến tranh Lạnh. "Ivan v&agrave; t&ocirc;i bắt đầu cảm thấy lo lắng khi Nga quyết định s&aacute;p nhập Crimea, ch&uacute;ng t&ocirc;i nhận ra rằng mọi thứ li&ecirc;n quan đến hai nước sẽ nhanh ch&oacute;ng thay đổi", c&ocirc; n&oacute;i.</p>\r\n<p class="Normal">Cuộc xung đột ở Ukraine đổ th&ecirc;m dầu v&agrave;o lửa cho những lời c&aacute;o buộc của điện Kremlin về việc Mỹ đứng đằng sau vụ lật đổ Tổng thống th&acirc;n Nga, Viktor Yanukovych hồi th&aacute;ng hai, v&agrave; hiện nay đang ủng hộ ch&iacute;nh quyền mới của &ocirc;ng Petro Poroshenko.</p>\r\n<p class="Normal">Trước khi cuộc xung đột ở Ukraine b&ugrave;ng nổ, Nga đ&atilde; đưa ra một số luật chống phương T&acirc;y. Cuối năm 2012, ch&iacute;nh phủ th&ocirc;ng qua một đạo luật, bắt buộc c&aacute;c tổ chức phi ch&iacute;nh phủ nhận t&agrave;i trợ từ c&aacute;c nước kh&aacute;c phải đăng k&yacute; l&agrave; cơ quan nước ngo&agrave;i.</p>\r\n<p class="Normal">Nhiều tổ chức phi lợi nhuận v&agrave; nh&acirc;n đạo phải đối mặt với nhiều &aacute;p lực, hoặc phải rời khỏi nước Nga, trong đ&oacute; c&oacute; Cơ quan Ph&aacute;t triển Quốc tế Mỹ v&agrave; Nh&oacute;m Gi&aacute;m s&aacute;t Bầu cử Golos. Nga cũng cấm người Mỹ nhận nu&ocirc;i trẻ em Nga sau những ca g&acirc;y bất đồng.</p>\r\n<p class="Normal">Phương T&acirc;y đ&atilde; &aacute;p đặt nhiều lệnh trừng phạt với Nga do Moscow tiếp tục hỗ trợ phiến qu&acirc;n Ukraine. Đ&aacute;p trả động th&aacute;i n&agrave;y, Nga ra lệnh cấm nhập khẩu thực phẩm, sữa, tr&aacute;i c&acirc;y, rau quả, thịt lợn, c&aacute; v&agrave; c&aacute;c loại thịt kh&aacute;c từ Mỹ, EU, H&agrave; Lan v&agrave; Australia.</p>\r\n<p class="Normal">Ở nh&agrave;, Gaspar cố gắng giải th&iacute;ch số phận của gia đ&igrave;nh m&igrave;nh bằng c&aacute;ch dễ hiểu nhất cho c&ocirc; con g&aacute;i 5 tuổi. &ldquo;Con c&oacute; nhớ bố v&agrave; mẹ thi thoảng c&atilde;i nhau kh&ocirc;ng, lần n&agrave;y bố mẹ kh&ocirc;ng c&atilde;i nhau, m&agrave; l&agrave; đất nước của bố mẹ. Đất nước của bố n&oacute;i rằng, v&igrave; mẹ đến từ nơi họ đang c&oacute; bất h&ograve;a, n&ecirc;n mẹ phải n&ecirc;n rời đi".</p>\r\n<p class="Normal">Mặc d&ugrave; Gaspar bị sốc trước khả năng kh&ocirc;ng thể trở lại Nga trong tương lai gần, c&ocirc; vẫn giữ l&ograve;ng y&ecirc;u mến với quốc gia trục xuất c&ocirc;. "Sẽ đến l&uacute;c t&ocirc;i phải đối mặt với thực tế", Gaspar n&oacute;i. "Đ&acirc;y l&agrave; nh&agrave; của t&ocirc;i, n&oacute; lu&ocirc;n nh&agrave; của t&ocirc;i, t&ocirc;i c&oacute; những người bạn tuyệt vời ở đ&acirc;y".</p>', 1, 0, 3501, 769, '', 'phonephone', '', 'websitewebsite', 'emailemail', NULL, NULL, NULL, NULL, 'titleChong Nga vo My ket giua con gian cua hai quoc gia p 10 nam truoc Jennifer Gaspar di cu tu My den o lai Nga v', 10, 'admin', '2014-08-20 13:08:21', '2014-10-31 06:24:30', '2014-08-20 13:08:21'),
(5, 516, 'Chồng Nga vợ Mỹ kẹt giữa cơn giận của hai quốc gia', '<p>10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p>', '<p>10 năm trước Jennifer Gaspar di cư từ Mỹ đến, ở lại Nga v&agrave; lập gia đ&igrave;nh. Nay khi quan hệ giữa hai nước ng&agrave;y c&agrave;ng băng gi&aacute;, c&ocirc; được lệnh phải rời đất nước m&agrave; c&ocirc; y&ecirc;u mến.</p><p class="Normal">"Nga kh&ocirc;ng phải l&agrave; một nơi tệ, nhưng những điều tồi tệ đang xảy ra", <em>NBC News </em>dẫn lời Gaspar, cho biết. C&ocirc; đang đ&oacute;ng g&oacute;i đồ đạc trong ng&ocirc;i nh&agrave; của m&igrave;nh tại St. Petersburg. "Gia đ&igrave;nh ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga, bạn b&egrave; ch&uacute;ng t&ocirc;i ở đ&acirc;y l&agrave; người Nga. Đ&oacute; l&agrave; những điều tốt đẹp duy nhất", c&ocirc; n&oacute;i tiếp.</p><p class="Normal">Nh&agrave; chức tr&aacute;ch Nga th&aacute;ng trước thu hồi giấy ph&eacute;p cư tr&uacute; của Gaspar. Một bức thư gửi v&agrave;o ng&agrave;y 21/7 c&aacute;o buộc c&ocirc; c&oacute; h&agrave;nh vi hoặc c&oacute; &yacute; định vi phạm hiến ph&aacute;p, v&agrave; l&agrave; mối đe dọa cho an ninh quốc gia.</p><p class="Normal">C&ocirc; đ&atilde; gửi đi nhiều đơn khiếu nại nhưng kh&ocirc;ng c&oacute; kết quả. V&igrave; vậy c&ocirc;, chồng c&ocirc; Ivan Pavlov, v&agrave; con g&aacute;i sẽ rời khỏi Nga trong tuần n&agrave;y. Điểm đến của họ được giữ k&iacute;n.</p><p class="Normal">Gaspar cho biết c&ocirc; kh&ocirc;ng nghĩ rằng ch&iacute;nh quyền Nga ra quyết định n&agrave;y do nghề nghiệp của c&ocirc;. C&ocirc;ng việc gần đ&acirc;y nhất của c&ocirc; l&agrave; về giao lưu văn h&oacute;a giữa Anh v&agrave; Bảo t&agrave;ng Hermitage danh tiếng. C&ocirc; tin rằng chồng c&ocirc;, một luật sư nh&acirc;n quyền v&agrave; người ủng hộ tự do b&aacute;o ch&iacute; mới l&agrave; mục ti&ecirc;u thực sự.</p><p class="Normal">Pavlov, người từng biện hộ cho một số kh&aacute;ch h&agrave;ng vi phạm quy định về an ninh của Nga, đồng &yacute; rằng c&ocirc;ng việc của anh c&oacute; thể l&agrave; một phần l&yacute; do c&ocirc; bị trục xuất. Tuy nhi&ecirc;n, c&ograve;n một yếu tố quan trọng kh&aacute;c, Gasper l&agrave; người Mỹ.</p><p class="Normal">"Đ&oacute; l&agrave; một giải ph&aacute;p dễ d&agrave;ng cho c&aacute;c vấn đề phức tạp", Pavlov nhận x&eacute;t về quyết định của ch&iacute;nh phủ. "Họ kh&ocirc;ng cần giải th&iacute;ch bất cứ điều g&igrave;", anh n&oacute;i th&ecirc;m. Trong khi đ&oacute;, c&aacute;c quan chức Nga từ chối b&igrave;nh luận về vụ việc.</p><p class="Normal">Tai họa ập đến gia đ&igrave;nh Gaspar v&agrave; Pavlov khi mối quan hệ Nga - Mỹ đang trong giai đoạn căng thẳng nhất kể từ sau Chiến tranh Lạnh. "Ivan v&agrave; t&ocirc;i bắt đầu cảm thấy lo lắng khi Nga quyết định s&aacute;p nhập Crimea, ch&uacute;ng t&ocirc;i nhận ra rằng mọi thứ li&ecirc;n quan đến hai nước sẽ nhanh ch&oacute;ng thay đổi", c&ocirc; n&oacute;i.</p><p class="Normal">Cuộc xung đột ở Ukraine đổ th&ecirc;m dầu v&agrave;o lửa cho những lời c&aacute;o buộc của điện Kremlin về việc Mỹ đứng đằng sau vụ lật đổ Tổng thống th&acirc;n Nga, Viktor Yanukovych hồi th&aacute;ng hai, v&agrave; hiện nay đang ủng hộ ch&iacute;nh quyền mới của &ocirc;ng Petro Poroshenko.</p><p class="Normal">Trước khi cuộc xung đột ở Ukraine b&ugrave;ng nổ, Nga đ&atilde; đưa ra một số luật chống phương T&acirc;y. Cuối năm 2012, ch&iacute;nh phủ th&ocirc;ng qua một đạo luật, bắt buộc c&aacute;c tổ chức phi ch&iacute;nh phủ nhận t&agrave;i trợ từ c&aacute;c nước kh&aacute;c phải đăng k&yacute; l&agrave; cơ quan nước ngo&agrave;i.</p><p class="Normal">Nhiều tổ chức phi lợi nhuận v&agrave; nh&acirc;n đạo phải đối mặt với nhiều &aacute;p lực, hoặc phải rời khỏi nước Nga, trong đ&oacute; c&oacute; Cơ quan Ph&aacute;t triển Quốc tế Mỹ v&agrave; Nh&oacute;m Gi&aacute;m s&aacute;t Bầu cử Golos. Nga cũng cấm người Mỹ nhận nu&ocirc;i trẻ em Nga sau những ca g&acirc;y bất đồng.</p><p class="Normal">Phương T&acirc;y đ&atilde; &aacute;p đặt nhiều lệnh trừng phạt với Nga do Moscow tiếp tục hỗ trợ phiến qu&acirc;n Ukraine. Đ&aacute;p trả động th&aacute;i n&agrave;y, Nga ra lệnh cấm nhập khẩu thực phẩm, sữa, tr&aacute;i c&acirc;y, rau quả, thịt lợn, c&aacute; v&agrave; c&aacute;c loại thịt kh&aacute;c từ Mỹ, EU, H&agrave; Lan v&agrave; Australia.</p><p class="Normal">Ở nh&agrave;, Gaspar cố gắng giải th&iacute;ch số phận của gia đ&igrave;nh m&igrave;nh bằng c&aacute;ch dễ hiểu nhất cho c&ocirc; con g&aacute;i 5 tuổi. &ldquo;Con c&oacute; nhớ bố v&agrave; mẹ thi thoảng c&atilde;i nhau kh&ocirc;ng, lần n&agrave;y bố mẹ kh&ocirc;ng c&atilde;i nhau, m&agrave; l&agrave; đất nước của bố mẹ. Đất nước của bố n&oacute;i rằng, v&igrave; mẹ đến từ nơi họ đang c&oacute; bất h&ograve;a, n&ecirc;n mẹ phải n&ecirc;n rời đi".</p><p class="Normal">Mặc d&ugrave; Gaspar bị sốc trước khả năng kh&ocirc;ng thể trở lại Nga trong tương lai gần, c&ocirc; vẫn giữ l&ograve;ng y&ecirc;u mến với quốc gia trục xuất c&ocirc;. "Sẽ đến l&uacute;c t&ocirc;i phải đối mặt với thực tế", Gaspar n&oacute;i. "Đ&acirc;y l&agrave; nh&agrave; của t&ocirc;i, n&oacute; lu&ocirc;n nh&agrave; của t&ocirc;i, t&ocirc;i c&oacute; những người bạn tuyệt vời ở đ&acirc;y".</p>', 1, 0, 3501, 769, '', 'phonephone', '', 'websitewebsite', 'emailemail', NULL, NULL, NULL, NULL, 'titleChong Nga vo My ket giua con gian cua hai quoc gia p 10 nam truoc Jennifer Gaspar di cu tu My den o lai Nga v', 10, 'admin', '2014-08-20 13:08:21', '2014-10-31 06:24:30', '2014-08-20 13:08:21'),
(15, 542, 'nha hang sang tiem', 'Mô tả (*)', 'Nội dung chi tiết (*)', 1, 0, 3690, 768, '', 'pandog', '', 'website', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog fdafd california ca 0937 nha hang sang tiem mo ta noi dung chi tiet', 8, 'user', '2014-09-01 06:24:30', '2014-10-31 06:24:30', '2014-09-07 09:09:06'),
(19, 538, 'can tho nail 1', 'can tho nail mo ta', '<p>can tho nail chi tiet</p>', 0, 0, 3696, 769, '5812 Yadkin Rd', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'can tho nail 1 can tho nail mo ta p can tho nail chi tiet p', 8, 'user', '2014-09-01 00:00:00', '2014-09-30 00:00:00', '2014-09-07 11:09:38'),
(16, 542, 'nha hang sang tiem', 'Mô tả (*)', 'Nội dung chi tiết (*)', 1, 0, 3690, 768, '', 'pandog', '', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog road 6 california ca 90005 nha hang sang tiem mo ta noi dung chi tiet', 8, 'user', '2014-09-01 06:24:30', '2014-10-31 06:24:30', '2014-09-07 09:09:47'),
(17, 542, 'nha hang sang tiem', 'Mô tả (*)', 'Nội dung chi tiết (*)', 2, 0, 3690, 768, '', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog road 6 california ca 90005 nha hang sang tiem mo ta noi dung chi tiet', 8, 'user', '2014-09-01 06:24:30', '2014-10-31 06:24:30', '2014-09-07 09:09:34'),
(18, 539, 'can tho nail', 'can tho nail mo ta', 'can tho nail chi tiet', 2, 0, 3691, 768, '', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog road 6 california ca 90005 can tho nail can tho nail mo ta can tho nail chi tiet', 8, 'user', '2014-09-01 06:24:30', '2014-10-31 06:24:30', '2014-09-07 10:09:32'),
(20, 538, '20/9 test', '20/9 test', '20/9 test', 1, 0, 3698, 769, '5812 Yadkin Rd', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog 5812 yadkin rd nail 0 90005 20 9 test 20 9 test 20 9 test', 10, 'admin', '2014-09-01 06:24:30', '2014-10-31 06:24:30', '2014-09-20 04:09:06'),
(21, 538, '20/9 test 2', '20/9 test 2', '20/9 test 2', 2, 0, 3707, 769, '5812 Yadkin Rd', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog 5812 yadkin rd adamsville 35005 90005 20 9 test 2 20 9 test 2 20 9 test 2', 8, 'user', '2014-09-01 06:24:30', '2014-10-31 06:24:30', '2014-09-20 07:09:21'),
(22, 538, 'test', 'test', '&lt;p&gt;fdsafad&lt;/p&gt;', 99, 0, 3751, 769, '5812 Yadkin Rd', 'pandog', 'pandog nail', 'pandog.net', 'yunhaihuang@gmail.com', NULL, NULL, NULL, NULL, 'pandog nail pandog 5812 yadkin rd adamsville 35005 90005 test test p fdsafad p', 8, 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-09-26 16:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_postposition`
--

CREATE TABLE IF NOT EXISTS `vsf_postposition` (
`id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `index` int(11) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `vsf_postposition`
--

INSERT INTO `vsf_postposition` (`id`, `title`, `code`, `index`, `image`) VALUES
(1, 'Trang chủ', 'home', 1, 378),
(2, 'Hot', 'hot', 2, 377),
(3, 'Tiêu điểm', 'focus', 3, 376),
(4, 'Đầu trang', 'first', 4, 375),
(5, 'Trang chủ bên phải', 'home_right', 5, 373),
(6, 'Tin header', 'global_header', 5, 372);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_postpositionrel`
--

CREATE TABLE IF NOT EXISTS `vsf_postpositionrel` (
  `postId` int(11) NOT NULL,
  `positionId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_product`
--

CREATE TABLE IF NOT EXISTS `vsf_product` (
`id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `label` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `promotionPrice` bigint(20) NOT NULL DEFAULT '0',
  `shipping` tinyint(1) NOT NULL,
  `manufacturer` text COLLATE utf8_unicode_ci NOT NULL,
  `postDate` int(11) NOT NULL,
  `dateStart` int(11) NOT NULL,
  `dateEnd` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `removedText` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `code` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `vote` float NOT NULL,
  `type` int(11) NOT NULL,
  `style` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `hot` tinyint(1) DEFAULT '0',
  `mTitle` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mIntro` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mKeyword` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mUrl` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=169 ;

--
-- Dumping data for table `vsf_product`
--

INSERT INTO `vsf_product` (`id`, `catId`, `label`, `title`, `intro`, `content`, `price`, `promotionPrice`, `shipping`, `manufacturer`, `postDate`, `dateStart`, `dateEnd`, `detail`, `status`, `state`, `removedText`, `image`, `index`, `code`, `vote`, `type`, `style`, `group`, `brand`, `hot`, `mTitle`, `mIntro`, `mKeyword`, `mUrl`, `info`) VALUES
(168, 20, '', '6y6h', '', '', 0, 0, 0, '', 1396580030, -25200, -25200, '', 1, 1, '', 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', NULL, NULL),
(167, 20, '', '6y6h', '', '', 0, 0, 0, '', 1396580030, -25200, -25200, '', 1, 1, '', 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_productlabel`
--

CREATE TABLE IF NOT EXISTS `vsf_productlabel` (
`id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `index` int(11) NOT NULL,
  `content` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vsf_productlabel`
--

INSERT INTO `vsf_productlabel` (`id`, `title`, `status`, `index`, `content`) VALUES
(1, 'Hàng mới về', 1, 0, 0),
(2, 'Giày', 1, 0, 0),
(3, 'Túi xách', 1, 0, 0),
(4, 'Phụ kiện', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_seo`
--

CREATE TABLE IF NOT EXISTS `vsf_seo` (
`id` int(10) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL,
  `aliasUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `realUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `flag` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_setting`
--

CREATE TABLE IF NOT EXISTS `vsf_setting` (
`id` int(10) NOT NULL,
  `catId` int(10) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `htmlValue` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '<input type="text" name="value[{id}]"  value="{value}" />',
  `value` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `inputType` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `root` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) NOT NULL DEFAULT 'systemsettings',
  `index` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2656 ;

--
-- Dumping data for table `vsf_setting`
--

INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(2, 14, 'Website address', 'Example: www.vietsol.net', '', 'shopnail.com', 'text', 'global_websiteaddress', 0, 0, 'settings', 0),
(4, 0, 'System Email', 'Example: admin@vietsol.net', '', 'yunhaihuang@gmail.com', 'text', 'global_systememail', 0, 0, 'global', 0),
(3, 0, 'Cache for menus', 'Enable this for better performance. But everytime you add new menu for user, you have to build cache again.', '<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', 'radio', 'public_menu_cache', 1, 1, 'global', 0),
(5, 0, 'SMTP user', 'Example: admin@vietsol.net', '', '', 'text', 'email_smtp_user', 1, 0, 'global', 0),
(6, 0, 'SMTP Password', '', '', '', 'text', 'email_smtp_password', 1, 0, 'global', 0),
(7, 0, 'Mail method as SMTP', 'Use local PHP method or SMTP.', '', '', 'text', 'email_method', 1, 0, 'global', 0),
(8, 0, 'SMTP host', 'Example: smtp.vietsol.net', '', '', 'text', 'email_smtp_host', 1, 0, 'global', 0),
(9, 0, 'SMTP port', 'Example: 25', '', '', 'text', 'email_smtp_port', 1, 1, 'global', 0),
(10, 0, 'Email Wrap Brackets', 'Email Wrap Brackets', '', '0', 'radio', 'mail_wrap_brackets', 1, 0, 'global', 0),
(11, 0, 'Lifetime of Admin session', 'Number of minutes for admin time out (Example: 30 minutes)', '', '1000', 'text', 'admin_timeout', 1, 1, 'global', 0),
(12, 0, 'Type of redirect', 'Use for different OS when you got problem with redirect feature', '', '', 'text', 'header_redirect', 1, 0, 'global', 0),
(13, 0, 'Admin default page', 'The first page when load admin system', '', 'posts/', 'text', 'admin_frontpage', 1, 1, 'global', 0),
(14, 0, 'User default page', 'The first page when load the public user page', '', 'posts/category/state', 'text', 'public_frontpage', 1, 2, 'global', 0),
(15, 0, 'Server time zone', 'Time zone of the server', '', '7', 'text', 'global_server_timezone', 1, 1, 'global', 0),
(16, 14, 'Use clean url', 'Rewrite url more friendly', '<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', 'text', 'public_cleanurl', 1, 0, 'settings', 0),
(17, 0, 'Multi Languages for User', 'Multi Languages for User', '<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', 'text', 'user_multi_lang', 1, 1, 'global', 0),
(18, 0, 'Multi Languages for Admin', 'Multi Languages for Admin', '<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', 'text', 'admin_multi_lang', 1, 1, 'global', 0),
(19, 0, 'Cache skin wrapper', 'Cache skin wrapper', '<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', 'text', 'use_cache_skin_wrapper', 1, 0, 'global', 0),
(20, 0, 'Public menu cache', 'Public menu cache', '<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', 'text', 'public_menu_cache', 1, 1, 'global', 0),
(295, 53, 'Products Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_value', 1, 0, 'menus', 0),
(294, 53, 'Products Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_status', 1, 0, 'menus', 0),
(292, 50, 'Home Keywords', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'home_keywords', 1, 0, 'seos', 0),
(293, 54, 'Post Page Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '8', '', 'post_page_limit', 1, 0, 'posts', 0),
(290, 50, 'Home Title', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'Home', '', 'home_title', 1, 0, 'seos', 0),
(291, 50, 'Home Description', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'home_description', 1, 0, 'seos', 0),
(289, 0, 'Google Analysis Key', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', 'UA-42288880-1', '', 'google_analysis_key', 1, 0, 'global', 0),
(287, 53, ' Image Size', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', '_image_size', 1, 0, 'menus', 0),
(288, 0, 'Google Analysiss', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'google_analysiss', 1, 0, 'global', 0),
(286, 178, 'Products Cat Seo Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_cat_seo_option', 1, 0, 'products', 0),
(285, 178, 'Products Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_cat_file', 1, 0, 'products', 0),
(284, 178, 'Products Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_cat_index', 1, 0, 'products', 0),
(283, 178, 'Products Cat Dropdown', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_dropdown', 1, 0, 'products', 0),
(282, 178, 'Products Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_intro', 1, 0, 'products', 0),
(280, 178, 'Products Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_cat_status', 1, 0, 'products', 0),
(281, 178, 'Products Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_value', 1, 0, 'products', 0),
(279, 178, 'Products Cat Template', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_template', 1, 0, 'products', 0),
(278, 178, 'Products Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_intro_editor_type', 1, 0, 'products', 0),
(277, 178, 'Products Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_arrayimg', 1, 0, 'products', 0),
(276, 178, 'Products Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_delete_category', 1, 0, 'products', 0),
(275, 178, 'Products Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_edit_category', 1, 0, 'products', 0),
(274, 178, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_postdate', 1, 0, 'products', 0),
(273, 178, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_title', 1, 0, 'products', 0),
(271, 178, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_id', 1, 0, 'products', 0),
(270, 178, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_index', 1, 0, 'products', 0),
(272, 178, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_image_field', 1, 0, 'products', 0),
(269, 178, 'Products Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_status_trash_action', 1, 0, 'products', 0),
(268, 178, 'Products Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_status_home', 1, 0, 'products', 0),
(267, 178, 'Products Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_button_visible', 1, 0, 'products', 0),
(266, 178, 'Products Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_button_disable', 1, 0, 'products', 0),
(265, 178, 'Products Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_button_delete', 1, 0, 'products', 0),
(264, 178, 'Products Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_button_add', 1, 0, 'products', 0),
(262, 178, 'Products Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_search_form', 1, 0, 'products', 0),
(263, 178, 'Products Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_status', 1, 0, 'products', 0),
(261, 178, 'Products Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '10', '', 'products_paging_limit', 1, 0, 'products', 0),
(260, 178, 'Products Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_category_list', 1, 0, 'products', 0),
(258, 51, 'Settings Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_category_list', 1, 0, 'settings', 0),
(259, 51, 'Settings Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_category_list', 1, 0, 'settings', 0),
(256, 51, 'Settings Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'settings_paging_limit', 1, 0, 'settings', 0),
(257, 51, 'Settings Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_search_form', 1, 0, 'settings', 0),
(255, 50, 'Global Meta Descriptions', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_descriptions', 1, 0, 'seos', 0),
(254, 50, 'Global Meta Keywords', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_keywords', 1, 0, 'seos', 0),
(253, 0, 'Enable Gzip', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'enable_gzip', 1, 0, 'global', 0),
(252, 51, 'Settings Cat Seo Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_seo_option', 1, 0, 'settings', 0),
(251, 51, 'Settings Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_file', 1, 0, 'settings', 0),
(250, 51, 'Settings Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_cat_index', 1, 0, 'settings', 0),
(249, 51, 'Settings Cat Dropdown', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_dropdown', 1, 0, 'settings', 0),
(247, 51, 'Settings Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_value', 1, 0, 'settings', 0),
(248, 51, 'Settings Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_intro', 1, 0, 'settings', 0),
(245, 51, 'Settings Cat Template', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_template', 1, 0, 'settings', 0),
(246, 51, 'Settings Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_status', 1, 0, 'settings', 0),
(244, 51, 'Settings Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_cat_intro_editor_type', 1, 0, 'settings', 0),
(241, 51, 'Settings Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_edit_category', 1, 0, 'settings', 0),
(243, 51, 'Settings Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_arrayimg', 1, 0, 'settings', 0),
(242, 51, 'Settings Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_delete_category', 1, 0, 'settings', 0),
(296, 178, 'Products Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_category_list', 1, 0, 'products', 0),
(2468, 260, 'Supports Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_button_add', 1, 0, 'supports', 0),
(2469, 260, 'Supports Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_button_delete', 1, 0, 'supports', 0),
(2470, 260, 'Supports Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_button_disable', 1, 0, 'supports', 0),
(2471, 260, 'Supports Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_button_visible', 1, 0, 'supports', 0),
(2472, 260, 'Supports Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_status_home', 1, 0, 'supports', 0),
(2473, 260, 'Supports Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_status_trash_action', 1, 0, 'supports', 0),
(2474, 260, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_index', 1, 0, 'supports', 0),
(2475, 260, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_id', 1, 0, 'supports', 0),
(2476, 260, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_image_field', 1, 0, 'supports', 0),
(2477, 260, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_title', 1, 0, 'supports', 0),
(2478, 260, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_postdate', 1, 0, 'supports', 0),
(2479, 260, 'Supports Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_video', 1, 0, 'supports', 0),
(2480, 260, 'Supports Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_album', 1, 0, 'supports', 0),
(2481, 260, 'Supports Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_comment', 1, 0, 'supports', 0),
(2482, 260, 'Supports Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_type', 1, 0, 'supports', 0),
(2483, 260, 'Supports Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_image', 1, 0, 'supports', 0),
(2484, 260, 'Supports Image Size', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'supports_supports_image_size', 1, 0, 'supports', 0),
(316, 37, 'Modules Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'modules_paging_limit', 1, 0, 'modules', 0),
(317, 37, 'Modules Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_search_form', 1, 0, 'modules', 0),
(318, 37, 'Modules Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'modules_modules_category_list', 1, 0, 'modules', 0),
(319, 37, 'Modules Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_status', 1, 0, 'modules', 0),
(320, 37, 'Modules Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_button_add', 1, 0, 'modules', 0),
(321, 37, 'Modules Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_button_delete', 1, 0, 'modules', 0),
(322, 37, 'Modules Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_button_disable', 1, 0, 'modules', 0),
(323, 37, 'Modules Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_button_visible', 1, 0, 'modules', 0),
(324, 37, 'Modules Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'modules_modules_status_home', 1, 0, 'modules', 0),
(325, 37, 'Modules Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_index', 1, 0, 'modules', 0),
(326, 37, 'Modules Class Field', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_class_field', 1, 0, 'modules', 0),
(327, 37, 'Modules Review', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'modules_modules_review', 1, 0, 'modules', 0),
(328, 37, 'Modules Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'modules_modules_video', 1, 0, 'modules', 0),
(329, 37, 'Modules Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'modules_modules_album', 1, 0, 'modules', 0),
(330, 37, 'Modules Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'modules_modules_comment', 1, 0, 'modules', 0),
(331, 37, 'Modules Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'modules_modules_intro', 1, 0, 'modules', 0),
(355, 49, 'Admins Group Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_group_tab', 1, 0, 'admins', 0),
(356, 49, 'Admins Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_settings_tab', 1, 0, 'admins', 0),
(360, 51, 'Settings Key', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_key', 1, 0, 'settings', 0),
(361, 51, 'Settings Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_value', 1, 0, 'settings', 0),
(362, 51, 'Settings Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_status', 1, 0, 'settings', 0),
(363, 51, 'Settings Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_settings_status_home', 1, 0, 'settings', 0),
(364, 51, 'Settings Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_index', 1, 0, 'settings', 0),
(365, 51, 'Settings Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_intro', 1, 0, 'settings', 0),
(366, 51, 'Settings Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'settings_settings_editor_intro', 1, 0, 'settings', 0),
(369, 192, 'Files Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'files_category_list', 1, 0, 'files', 0),
(370, 231, 'Logos Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_category_list', 1, 0, 'logos', 0),
(371, 231, 'Logos Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_settings_tab', 1, 0, 'logos', 0),
(372, 231, 'Logos Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'logos_paging_limit', 1, 0, 'logos', 0),
(373, 231, 'Logos Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_search_form', 1, 0, 'logos', 0),
(374, 231, 'Logos Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_category_list', 1, 0, 'logos', 0),
(375, 231, 'Logos Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_status', 1, 0, 'logos', 0),
(376, 231, 'Logos Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_button_add', 1, 0, 'logos', 0),
(377, 231, 'Logos Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_button_delete', 1, 0, 'logos', 0),
(378, 231, 'Logos Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_button_disable', 1, 0, 'logos', 0),
(379, 231, 'Logos Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_button_visible', 1, 0, 'logos', 0),
(380, 231, 'Logos Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_status_home', 1, 0, 'logos', 0),
(381, 231, 'Logos Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_status_trash_action', 1, 0, 'logos', 0),
(382, 231, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_index', 1, 0, 'logos', 0),
(383, 231, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_id', 1, 0, 'logos', 0),
(384, 231, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_image_field', 1, 0, 'logos', 0),
(385, 231, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_title', 1, 0, 'logos', 0),
(386, 231, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_postdate', 1, 0, 'logos', 0),
(387, 231, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_code', 1, 0, 'logos', 0),
(388, 231, 'Logos Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'logos_logos_image_width', 1, 0, 'logos', 0),
(389, 231, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_intro', 1, 0, 'logos', 0),
(390, 231, 'Logos Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_editor_intro', 1, 0, 'logos', 0),
(391, 231, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_content', 1, 0, 'logos', 0),
(392, 231, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_seo_option', 1, 0, 'logos', 0),
(393, 231, 'Logos Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_video', 1, 0, 'logos', 0),
(394, 231, 'Logos Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_album', 1, 0, 'logos', 0),
(395, 231, 'Logos Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'logos_logos_comment', 1, 0, 'logos', 0),
(396, 231, 'Chọn', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'logos_logos_chose', 1, 0, 'logos', 0),
(397, 231, 'Logos Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'logos_logos_image_height', 1, 0, 'logos', 0),
(398, 52, 'Langs Vslang Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'langs_vslang_tab', 1, 0, 'langs', 0),
(399, 52, 'Langs Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'langs_category_list', 1, 0, 'langs', 0),
(400, 52, 'Langs Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'langs_paging_limit', 1, 0, 'langs', 0),
(2433, 553, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_content', 1, 0, 'posts', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(2434, 553, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_seo_option', 1, 0, 'posts', 0),
(1741, 49, 'Admins Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'admins_admin_paging_limit', 1, 0, 'admins', 0),
(1742, 49, 'Admins Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_search_form', 1, 0, 'admins', 0),
(1743, 49, 'Admins Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admins_category_list', 1, 0, 'admins', 0),
(1744, 49, 'Admins Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_status', 1, 0, 'admins', 0),
(1745, 49, 'Admins Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_button_add', 1, 0, 'admins', 0),
(1746, 49, 'Admins Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_button_delete', 1, 0, 'admins', 0),
(1747, 49, 'Admins Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_button_disable', 1, 0, 'admins', 0),
(1748, 49, 'Admins Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_button_visible', 1, 0, 'admins', 0),
(1749, 49, 'Admins Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admins_status_home', 1, 0, 'admins', 0),
(1750, 49, 'Admins Name', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_name', 1, 0, 'admins', 0),
(1751, 49, 'Admins Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admins_video', 1, 0, 'admins', 0),
(1752, 49, 'Admins Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admins_album', 1, 0, 'admins', 0),
(1753, 49, 'Admins Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admins_comment', 1, 0, 'admins', 0),
(1754, 37, 'Modules Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'modules_admin_paging_limit', 1, 0, 'modules', 0),
(1755, 468, 'Nationals Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_category_list', 1, 0, 'nationals', 0),
(1756, 468, 'Nationals Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_settings_tab', 1, 0, 'nationals', 0),
(1757, 468, 'Nationals Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'nationals_admin_paging_limit', 1, 0, 'nationals', 0),
(1758, 468, 'Nationals Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_search_form', 1, 0, 'nationals', 0),
(1759, 468, 'Nationals Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_category_list', 1, 0, 'nationals', 0),
(1760, 468, 'Nationals Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_status', 1, 0, 'nationals', 0),
(1761, 468, 'Nationals Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_button_add', 1, 0, 'nationals', 0),
(1762, 468, 'Nationals Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_button_delete', 1, 0, 'nationals', 0),
(1763, 468, 'Nationals Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_button_disable', 1, 0, 'nationals', 0),
(1764, 468, 'Nationals Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_button_visible', 1, 0, 'nationals', 0),
(1765, 468, 'Nationals Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_status_home', 1, 0, 'nationals', 0),
(1766, 468, 'Nationals Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_status_trash_action', 1, 0, 'nationals', 0),
(1767, 468, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_index', 1, 0, 'nationals', 0),
(1768, 468, 'Nationals Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_export', 1, 0, 'nationals', 0),
(1769, 468, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_id', 1, 0, 'nationals', 0),
(1770, 468, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_image_field', 1, 0, 'nationals', 0),
(1771, 468, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_title', 1, 0, 'nationals', 0),
(1772, 468, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_postdate', 1, 0, 'nationals', 0),
(1773, 468, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_code', 1, 0, 'nationals', 0),
(1774, 468, 'Nationals Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_image_width', 1, 0, 'nationals', 0),
(1775, 468, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_intro', 1, 0, 'nationals', 0),
(1776, 468, 'Nationals Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_editor_intro', 1, 0, 'nationals', 0),
(1777, 468, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_content', 1, 0, 'nationals', 0),
(1778, 468, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_nationals_seo_option', 1, 0, 'nationals', 0),
(1779, 468, 'Nationals Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_video', 1, 0, 'nationals', 0),
(1780, 468, 'Nationals Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_album', 1, 0, 'nationals', 0),
(1781, 468, 'Nationals Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_nationals_comment', 1, 0, 'nationals', 0),
(1782, 469, 'Leagues Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_category_list', 1, 0, 'leagues', 0),
(1783, 469, 'Leagues Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_settings_tab', 1, 0, 'leagues', 0),
(1784, 469, 'Leagues Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'leagues_admin_paging_limit', 1, 0, 'leagues', 0),
(1785, 469, 'Leagues Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_search_form', 1, 0, 'leagues', 0),
(1786, 469, 'Leagues Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_category_list', 1, 0, 'leagues', 0),
(1787, 469, 'Leagues Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_status', 1, 0, 'leagues', 0),
(1788, 469, 'Leagues Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_button_add', 1, 0, 'leagues', 0),
(1789, 469, 'Leagues Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_button_delete', 1, 0, 'leagues', 0),
(1790, 469, 'Leagues Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_button_disable', 1, 0, 'leagues', 0),
(1791, 469, 'Leagues Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_button_visible', 1, 0, 'leagues', 0),
(1792, 469, 'Leagues Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_status_home', 1, 0, 'leagues', 0),
(1793, 469, 'Leagues Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_status_trash_action', 1, 0, 'leagues', 0),
(1794, 469, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_index', 1, 0, 'leagues', 0),
(1795, 469, 'Leagues Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_export', 1, 0, 'leagues', 0),
(1796, 469, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_id', 1, 0, 'leagues', 0),
(1797, 469, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_image_field', 1, 0, 'leagues', 0),
(1798, 469, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_title', 1, 0, 'leagues', 0),
(1799, 469, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_postdate', 1, 0, 'leagues', 0),
(1800, 469, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_code', 1, 0, 'leagues', 0),
(1801, 469, 'Leagues Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_image_width', 1, 0, 'leagues', 0),
(1802, 469, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_intro', 1, 0, 'leagues', 0),
(1803, 469, 'Leagues Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_editor_intro', 1, 0, 'leagues', 0),
(1804, 469, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_content', 1, 0, 'leagues', 0),
(1805, 469, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'leagues_leagues_seo_option', 1, 0, 'leagues', 0),
(1806, 469, 'Leagues Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_video', 1, 0, 'leagues', 0),
(1807, 469, 'Leagues Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_album', 1, 0, 'leagues', 0),
(1808, 469, 'Leagues Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'leagues_leagues_comment', 1, 0, 'leagues', 0),
(1809, 468, 'Nationals Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_edit_category', 1, 0, 'nationals', 0),
(1810, 468, 'Nationals Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_delete_category', 1, 0, 'nationals', 0),
(1811, 468, 'Nationals Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_arrayimg', 1, 0, 'nationals', 0),
(1812, 468, 'Nationals Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_intro_editor_type', 1, 0, 'nationals', 0),
(1813, 468, 'Nationals Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_cat_title', 1, 0, 'nationals', 0),
(1814, 468, 'Nationals Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_status', 1, 0, 'nationals', 0),
(1815, 468, 'Nationals Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_value', 1, 0, 'nationals', 0),
(1816, 468, 'Nationals Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_desc', 1, 0, 'nationals', 0),
(1817, 468, 'Nationals Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_intro', 1, 0, 'nationals', 0),
(1818, 468, 'Nationals Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'nationals_cat_index', 1, 0, 'nationals', 0),
(1819, 468, 'Nationals Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_file', 1, 0, 'nationals', 0),
(1820, 468, 'Nationals Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'nationals_cat_document', 1, 0, 'nationals', 0),
(1821, 472, 'Clubs Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_category_list', 1, 0, 'clubs', 0),
(1822, 472, 'Clubs Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_settings_tab', 1, 0, 'clubs', 0),
(1823, 472, 'Clubs Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'clubs_admin_paging_limit', 1, 0, 'clubs', 0),
(1824, 472, 'Clubs Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_search_form', 1, 0, 'clubs', 0),
(1825, 472, 'Clubs Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_category_list', 1, 0, 'clubs', 0),
(1826, 472, 'Clubs Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_status', 1, 0, 'clubs', 0),
(1827, 472, 'Clubs Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_button_add', 1, 0, 'clubs', 0),
(1828, 472, 'Clubs Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_button_delete', 1, 0, 'clubs', 0),
(1829, 472, 'Clubs Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_button_disable', 1, 0, 'clubs', 0),
(1830, 472, 'Clubs Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_button_visible', 1, 0, 'clubs', 0),
(1831, 472, 'Clubs Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_status_home', 1, 0, 'clubs', 0),
(1832, 472, 'Clubs Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_status_trash_action', 1, 0, 'clubs', 0),
(1833, 472, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_index', 1, 0, 'clubs', 0),
(1834, 472, 'Clubs Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_export', 1, 0, 'clubs', 0),
(1835, 472, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_id', 1, 0, 'clubs', 0),
(1836, 472, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_image_field', 1, 0, 'clubs', 0),
(1837, 472, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_title', 1, 0, 'clubs', 0),
(1838, 472, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_postdate', 1, 0, 'clubs', 0),
(1839, 472, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_code', 1, 0, 'clubs', 0),
(1840, 472, 'Clubs Image Width', '', '<input id=''el_{id}'' type=''text'' value=''{value}'' name=''value[{id}]'' />', '100', '', 'clubs_clubs_image_width', 1, 0, 'clubs', 0),
(1841, 472, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_intro', 1, 0, 'clubs', 0),
(1842, 472, 'Clubs Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_editor_intro', 1, 0, 'clubs', 0),
(1843, 472, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_content', 1, 0, 'clubs', 0),
(1844, 472, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_seo_option', 1, 0, 'clubs', 0),
(1845, 472, 'Clubs Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_video', 1, 0, 'clubs', 0),
(1846, 472, 'Clubs Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_album', 1, 0, 'clubs', 0),
(1847, 472, 'Clubs Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'clubs_clubs_comment', 1, 0, 'clubs', 0),
(1848, 472, 'Clubs Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '100', '', 'clubs_clubs_image_height', 1, 0, 'clubs', 0),
(1849, 473, 'Games Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'games_category_list', 1, 0, 'games', 0),
(1850, 473, 'Games Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_settings_tab', 1, 0, 'games', 0),
(1851, 473, 'Games Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'games_admin_paging_limit', 1, 0, 'games', 0),
(1852, 473, 'Games Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_search_form', 1, 0, 'games', 0),
(1853, 473, 'Games Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'games_games_category_list', 1, 0, 'games', 0),
(1854, 473, 'Games Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_status', 1, 0, 'games', 0),
(1855, 473, 'Games Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_button_add', 1, 0, 'games', 0),
(1856, 473, 'Games Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_button_delete', 1, 0, 'games', 0),
(1857, 473, 'Games Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_button_disable', 1, 0, 'games', 0),
(1858, 473, 'Games Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_button_visible', 1, 0, 'games', 0),
(1859, 473, 'Games Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'games_games_status_home', 1, 0, 'games', 0),
(1860, 473, 'Games Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'games_games_status_trash_action', 1, 0, 'games', 0),
(1861, 473, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_index', 1, 0, 'games', 0),
(1862, 473, 'Games Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'games_games_export', 1, 0, 'games', 0),
(1863, 473, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_id', 1, 0, 'games', 0),
(1864, 473, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_image_field', 1, 0, 'games', 0),
(1865, 473, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_title', 1, 0, 'games', 0),
(1866, 473, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_postdate', 1, 0, 'games', 0),
(1867, 473, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_code', 1, 0, 'games', 0),
(1868, 473, 'Games Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'games_games_image_width', 1, 0, 'games', 0),
(1869, 473, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_intro', 1, 0, 'games', 0),
(1870, 473, 'Games Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'games_games_editor_intro', 1, 0, 'games', 0),
(1871, 473, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_content', 1, 0, 'games', 0),
(1872, 473, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'games_games_seo_option', 1, 0, 'games', 0),
(1873, 475, 'Matchs Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_category_list', 1, 0, 'matchs', 0),
(1874, 475, 'Matchs Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_settings_tab', 1, 0, 'matchs', 0),
(1875, 475, 'Matchs Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'matchs_admin_paging_limit', 1, 0, 'matchs', 0),
(1876, 475, 'Matchs Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_search_form', 1, 0, 'matchs', 0),
(1877, 475, 'Matchs Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_category_list', 1, 0, 'matchs', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(1878, 475, 'Matchs Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_status', 1, 0, 'matchs', 0),
(1879, 475, 'Matchs Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_button_add', 1, 0, 'matchs', 0),
(1880, 475, 'Matchs Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_button_delete', 1, 0, 'matchs', 0),
(1881, 475, 'Matchs Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_button_disable', 1, 0, 'matchs', 0),
(1882, 475, 'Matchs Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_button_visible', 1, 0, 'matchs', 0),
(1883, 475, 'Matchs Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_status_home', 1, 0, 'matchs', 0),
(1884, 475, 'Matchs Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_status_trash_action', 1, 0, 'matchs', 0),
(1885, 475, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_index', 1, 0, 'matchs', 0),
(1886, 475, 'Matchs Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_export', 1, 0, 'matchs', 0),
(1887, 475, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_id', 1, 0, 'matchs', 0),
(1888, 475, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_image_field', 1, 0, 'matchs', 0),
(1889, 475, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_title', 1, 0, 'matchs', 0),
(1890, 475, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_postdate', 1, 0, 'matchs', 0),
(1891, 475, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_code', 1, 0, 'matchs', 0),
(1892, 475, 'Matchs Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_image_width', 1, 0, 'matchs', 0),
(1893, 475, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_intro', 1, 0, 'matchs', 0),
(1894, 475, 'Matchs Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_editor_intro', 1, 0, 'matchs', 0),
(1895, 475, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_content', 1, 0, 'matchs', 0),
(1896, 475, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'matchs_matchs_seo_option', 1, 0, 'matchs', 0),
(1897, 475, 'Matchs Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_video', 1, 0, 'matchs', 0),
(1898, 475, 'Matchs Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_album', 1, 0, 'matchs', 0),
(1899, 475, 'Matchs Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'matchs_matchs_comment', 1, 0, 'matchs', 0),
(1900, 475, 'Matchs Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'matchs_paging_limit', 1, 0, 'matchs', 0),
(1902, 350, 'Videos Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_settings_tab', 1, 0, 'videos', 0),
(1903, 350, 'Videos Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'videos_admin_paging_limit', 1, 0, 'videos', 0),
(1904, 350, 'Videos Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_search_form', 1, 0, 'videos', 0),
(2343, 54, 'Post User List Number Other', '', '<input type="text" name="value[{id}]"  value="{value}" />', '5', '', 'post_user_list_number_other', 1, 0, 'posts', 0),
(2344, 178, 'Products Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'products_products_image_height', 1, 0, 'products', 0),
(1906, 350, 'Videos Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_status', 1, 0, 'videos', 0),
(1907, 350, 'Videos Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_button_add', 1, 0, 'videos', 0),
(1908, 350, 'Videos Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_button_delete', 1, 0, 'videos', 0),
(1909, 350, 'Videos Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_button_disable', 1, 0, 'videos', 0),
(1910, 350, 'Videos Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_button_visible', 1, 0, 'videos', 0),
(1911, 350, 'Videos Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_status_home', 1, 0, 'videos', 0),
(1912, 350, 'Videos Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_status_trash_action', 1, 0, 'videos', 0),
(1913, 350, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_index', 1, 0, 'videos', 0),
(1914, 350, 'Videos Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_export', 1, 0, 'videos', 0),
(1915, 350, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_id', 1, 0, 'videos', 0),
(1916, 350, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_image_field', 1, 0, 'videos', 0),
(1917, 350, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_title', 1, 0, 'videos', 0),
(1918, 350, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_videos_postdate', 1, 0, 'videos', 0),
(1919, 350, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_code', 1, 0, 'videos', 0),
(1920, 350, 'Videos Image Width', '', '<input id=''el_{id}'' type=''text'' value=''{value}'' name=''value[{id}]'' />', '105', '', 'videos_videos_image_width', 1, 0, 'videos', 0),
(1921, 350, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_intro', 1, 0, 'videos', 0),
(1922, 350, 'Videos Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_editor_intro', 1, 0, 'videos', 0),
(1923, 350, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_content', 1, 0, 'videos', 0),
(1924, 350, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_seo_option', 1, 0, 'videos', 0),
(1925, 350, 'Videos Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_video', 1, 0, 'videos', 0),
(1926, 350, 'Videos Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_album', 1, 0, 'videos', 0),
(1927, 350, 'Videos Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_comment', 1, 0, 'videos', 0),
(1928, 350, 'Videos Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '80', '', 'videos_videos_image_height', 1, 0, 'videos', 0),
(1929, 350, 'Videos Up Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_up_video', 1, 0, 'videos', 0),
(1930, 350, 'Videos Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '6', '', 'videos_paging_limit', 1, 0, 'videos', 0),
(2342, 350, 'Videos Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_videos_category_list', 1, 0, 'videos', 0),
(2341, 350, 'Videos Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_category_list', 1, 0, 'videos', 0),
(1933, 350, 'Videos Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_arrayimg', 1, 0, 'videos', 0),
(1934, 350, 'Videos Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_cat_intro_editor_type', 1, 0, 'videos', 0),
(1935, 350, 'Videos Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_cat_title', 1, 0, 'videos', 0),
(1936, 350, 'Videos Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_cat_status', 1, 0, 'videos', 0),
(1937, 350, 'Videos Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_cat_value', 1, 0, 'videos', 0),
(1938, 350, 'Videos Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_cat_desc', 1, 0, 'videos', 0),
(1939, 350, 'Videos Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_cat_intro', 1, 0, 'videos', 0),
(1940, 350, 'Videos Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_cat_index', 1, 0, 'videos', 0),
(1941, 350, 'Videos Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_cat_file', 1, 0, 'videos', 0),
(1942, 350, 'Videos Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'videos_cat_document', 1, 0, 'videos', 0),
(1943, 53, 'Videos Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_status', 1, 0, 'menus', 0),
(1944, 53, 'Videos Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'videos_value', 1, 0, 'menus', 0),
(1945, 192, 'Files Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'files_settings_tab', 1, 0, 'files', 0),
(1946, 350, 'Video User List Number Other', '', '<input type="text" name="value[{id}]"  value="{value}" />', '5', '', 'video_user_list_number_other', 1, 0, 'videos', 0),
(1947, 350, 'Videos Paging Public Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '6', '', 'videos_paging_public_limit', 1, 0, 'videos', 0),
(1948, 350, 'Videos Paging Limit Detail', '', '<input type="text" name="value[{id}]"  value="{value}" />', '7', '', 'videos_paging_limit_detail', 1, 0, 'videos', 0),
(2488, 260, 'Supporttypes Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'supporttypes_admin_paging_limit', 1, 0, 'supports', 0),
(2489, 260, 'Supports Supporttypes Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_search_form', 1, 0, 'supports', 0),
(2177, 521, 'Partners Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_search_form', 1, 0, 'partners', 0),
(2494, 260, 'Supports Supporttypes Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_button_disable', 1, 0, 'supports', 0),
(2490, 260, 'Supports Supporttypes Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_category_list', 1, 0, 'supports', 0),
(2491, 260, 'Supports Supporttypes Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_status', 1, 0, 'supports', 0),
(2486, 260, 'Supports Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_content', 1, 0, 'supports', 0),
(2485, 260, 'Supports Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_intro', 1, 0, 'supports', 0),
(2436, 553, 'Posts Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_category_list', 1, 0, 'posts', 0),
(2437, 553, 'Posts Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'posts_admin_paging_limit', 1, 0, 'posts', 0),
(2438, 553, 'Posts Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_search_form', 1, 0, 'posts', 0),
(2439, 553, 'Posts Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_category_list', 1, 0, 'posts', 0),
(2440, 553, 'Posts Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_status', 1, 0, 'posts', 0),
(2441, 553, 'Posts Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_button_add', 1, 0, 'posts', 0),
(2442, 553, 'Posts Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_button_delete', 1, 0, 'posts', 0),
(2443, 553, 'Posts Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_button_disable', 1, 0, 'posts', 0),
(2444, 553, 'Posts Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_button_visible', 1, 0, 'posts', 0),
(2445, 553, 'Posts Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_status_home', 1, 0, 'posts', 0),
(2446, 553, 'Posts Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_status_trash_action', 1, 0, 'posts', 0),
(1971, 178, 'Products Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'products_admin_paging_limit', 1, 0, 'products', 0),
(1972, 178, 'Products Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_export', 1, 0, 'products', 0),
(1973, 178, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_code_s', 1, 0, 'products', 0),
(1974, 178, 'Products Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'products_products_image_width', 1, 0, 'products', 0),
(1975, 178, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_intro', 1, 0, 'products', 0),
(1976, 178, 'Products Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_editor_intro', 1, 0, 'products', 0),
(1977, 178, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_content', 1, 0, 'products', 0),
(1978, 178, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_products_seo_option', 1, 0, 'products', 0),
(1979, 178, 'Products Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_video', 1, 0, 'products', 0),
(1980, 178, 'Products Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_album', 1, 0, 'products', 0),
(1981, 178, 'Products Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_comment', 1, 0, 'products', 0),
(1982, 472, 'Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'clubs_clubs_category_list_club', 1, 0, 'clubs', 0),
(1983, 488, 'Expects Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_category_list', 1, 0, 'expects', 0),
(1984, 488, 'Pages Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'pages_admin_paging_limit', 1, 0, 'expects', 0),
(1985, 488, 'Expects Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_search_form', 1, 0, 'expects', 0),
(1986, 488, 'Expects Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_category_list', 1, 0, 'expects', 0),
(1987, 488, 'Expects Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_status', 1, 0, 'expects', 0),
(1988, 488, 'Expects Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_button_add', 1, 0, 'expects', 0),
(1989, 488, 'Expects Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_button_delete', 1, 0, 'expects', 0),
(1990, 488, 'Expects Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_button_disable', 1, 0, 'expects', 0),
(1991, 488, 'Expects Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_button_visible', 1, 0, 'expects', 0),
(1992, 488, 'Expects Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_status_home', 1, 0, 'expects', 0),
(1993, 488, 'Expects Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_status_trash_action', 1, 0, 'expects', 0),
(1994, 488, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_index', 1, 0, 'expects', 0),
(1995, 488, 'Expects Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'expects_pages_export', 1, 0, 'expects', 0),
(1996, 488, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_id', 1, 0, 'expects', 0),
(1997, 488, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_image_field', 1, 0, 'expects', 0),
(1998, 488, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_title', 1, 0, 'expects', 0),
(1999, 488, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'expects_pages_postdate', 1, 0, 'expects', 0),
(2000, 488, 'Expects Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '426', '', 'expects_pages_image_width', 1, 0, 'expects', 0),
(2638, 1121, 'Location Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'location_edit_category', 1, 0, 'location', 0),
(2508, 555, 'Faq Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_category_list', 1, 0, 'faq', 0),
(2507, 555, 'Faq Page List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_page_list', 1, 0, 'faq', 0),
(2098, 294, 'Customers Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_category_list', 1, 0, 'customers', 0),
(2099, 294, 'Customers Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_search_form', 1, 0, 'customers', 0),
(2100, 294, 'Customers Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_category_list', 1, 0, 'customers', 0),
(2101, 294, 'Customers Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_status', 1, 0, 'customers', 0),
(2102, 294, 'Customers Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_button_add', 1, 0, 'customers', 0),
(2103, 294, 'Customers Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_button_delete', 1, 0, 'customers', 0),
(2104, 294, 'Customers Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_button_disable', 1, 0, 'customers', 0),
(2105, 294, 'Customers Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_button_visible', 1, 0, 'customers', 0),
(2106, 294, 'Customers Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_status_home', 1, 0, 'customers', 0),
(2107, 294, 'Customers Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_status_trash_action', 1, 0, 'customers', 0),
(2108, 294, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_index', 1, 0, 'customers', 0),
(2109, 294, 'Customers Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_export', 1, 0, 'customers', 0),
(2110, 294, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_id', 1, 0, 'customers', 0),
(2111, 294, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_image_field', 1, 0, 'customers', 0),
(2112, 294, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_title', 1, 0, 'customers', 0),
(2113, 294, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_postdate', 1, 0, 'customers', 0),
(2114, 294, 'Customers Pages Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'customers_pages_image_height', 1, 0, 'customers', 0),
(2115, 294, 'Customers Pages Link', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_link', 1, 0, 'customers', 0),
(2116, 294, 'Customers Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_album', 1, 0, 'customers', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(2117, 294, 'Customers Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_comment', 1, 0, 'customers', 0),
(2118, 356, 'Services Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_category_list', 1, 0, 'services', 0),
(2119, 356, 'Services Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_search_form', 1, 0, 'services', 0),
(2120, 356, 'Services Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_category_list', 1, 0, 'services', 0),
(2121, 356, 'Services Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_status', 1, 0, 'services', 0),
(2122, 356, 'Services Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_button_add', 1, 0, 'services', 0),
(2123, 356, 'Services Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_button_delete', 1, 0, 'services', 0),
(2124, 356, 'Services Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_button_disable', 1, 0, 'services', 0),
(2125, 356, 'Services Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_button_visible', 1, 0, 'services', 0),
(2126, 356, 'Services Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_status_home', 1, 0, 'services', 0),
(2127, 356, 'Services Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_status_trash_action', 1, 0, 'services', 0),
(2128, 356, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_index', 1, 0, 'services', 0),
(2129, 356, 'Services Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_export', 1, 0, 'services', 0),
(2130, 356, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_id', 1, 0, 'services', 0),
(2131, 356, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_image_field', 1, 0, 'services', 0),
(2132, 356, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_title', 1, 0, 'services', 0),
(2133, 356, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_postdate', 1, 0, 'services', 0),
(2134, 356, 'Services Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_video', 1, 0, 'services', 0),
(2135, 356, 'Services Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_album', 1, 0, 'services', 0),
(2136, 356, 'Services Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_comment', 1, 0, 'services', 0),
(2137, 356, 'Services Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'services_pages_image_width', 1, 0, 'services', 0),
(2138, 356, 'Services Pages Link', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_link', 1, 0, 'services', 0),
(2139, 356, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_intro', 1, 0, 'services', 0),
(2140, 356, 'Services Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_editor_intro', 1, 0, 'services', 0),
(2141, 356, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_content', 1, 0, 'services', 0),
(2142, 356, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'services_pages_seo_option', 1, 0, 'services', 0),
(2143, 294, 'Customers Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'customers_paging_limit', 1, 0, 'customers', 0),
(2144, 519, 'Projects Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_category_list', 1, 0, 'projects', 0),
(2145, 519, 'Projects Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_search_form', 1, 0, 'projects', 0),
(2146, 519, 'Projects Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_category_list', 1, 0, 'projects', 0),
(2147, 519, 'Projects Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_status', 1, 0, 'projects', 0),
(2148, 519, 'Projects Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_button_add', 1, 0, 'projects', 0),
(2149, 519, 'Projects Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_button_delete', 1, 0, 'projects', 0),
(2150, 519, 'Projects Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_button_disable', 1, 0, 'projects', 0),
(2151, 519, 'Projects Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_button_visible', 1, 0, 'projects', 0),
(2152, 519, 'Projects Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_status_home', 1, 0, 'projects', 0),
(2153, 519, 'Projects Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_status_trash_action', 1, 0, 'projects', 0),
(2154, 519, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_index', 1, 0, 'projects', 0),
(2155, 519, 'Projects Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_export', 1, 0, 'projects', 0),
(2156, 519, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_id', 1, 0, 'projects', 0),
(2157, 519, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_image_field', 1, 0, 'projects', 0),
(2158, 519, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_title', 1, 0, 'projects', 0),
(2159, 519, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_postdate', 1, 0, 'projects', 0),
(2160, 519, 'Projects Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '400', '', 'projects_pages_image_width', 1, 0, 'projects', 0),
(2161, 519, 'Projects Pages Link', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_link', 1, 0, 'projects', 0),
(2162, 519, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_intro', 1, 0, 'projects', 0),
(2163, 519, 'Projects Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_editor_intro', 1, 0, 'projects', 0),
(2164, 519, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_content', 1, 0, 'projects', 0),
(2165, 519, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_seo_option', 1, 0, 'projects', 0),
(2166, 519, 'Projects Pages Provin', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_provin', 1, 0, 'projects', 0),
(2167, 519, 'Projects Pages Dis', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_dis', 1, 0, 'projects', 0),
(2168, 519, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_map', 1, 0, 'projects', 0),
(2169, 519, 'Projects Pages Maps', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'projects_pages_maps', 1, 0, 'projects', 0),
(2170, 519, 'Projects Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'projects_paging_limit', 1, 0, 'projects', 0),
(2171, 519, 'Projects Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_video', 1, 0, 'projects', 0),
(2172, 519, 'Projects Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_album', 1, 0, 'projects', 0),
(2173, 519, 'Projects Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'projects_pages_comment', 1, 0, 'projects', 0),
(2174, 519, 'Projects Pages Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '235', '', 'projects_pages_image_height', 1, 0, 'projects', 0),
(2175, 521, 'Partners Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'partners_category_list', 1, 0, 'partners', 0),
(1469, 77, 'Contact Form Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contact_form_title', 1, 0, 'contacts', 0),
(1470, 77, 'Contact Form Address', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contact_form_address', 1, 0, 'contacts', 0),
(1471, 0, 'Global Websitename', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'Nail shop', '', 'global_websitename', 1, 0, 'global', 0),
(2509, 555, 'Faq Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_search_form', 1, 0, 'faq', 0),
(1474, 240, 'Orders Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'orders_orders_button_delete', 1, 0, 'orders', 0),
(1475, 240, 'Orders Review', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'orders_orders_review', 1, 0, 'orders', 0),
(1476, 240, 'Orders Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'orders_orders_video', 1, 0, 'orders', 0),
(1477, 240, 'Orders Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'orders_orders_album', 1, 0, 'orders', 0),
(1478, 240, 'Orders Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'orders_orders_comment', 1, 0, 'orders', 0),
(1479, 240, 'Orders Code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'orders_orders_code', 1, 0, 'orders', 0),
(1480, 240, 'Orders Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'orders_orders_intro', 1, 0, 'orders', 0),
(1481, 240, 'Orders Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'orders_orders_content', 1, 0, 'orders', 0),
(1482, 77, 'Pcontacts Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'pcontacts_admin_paging_limit', 1, 0, 'contacts', 0),
(1483, 77, 'Contacts Pcontacts Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_search_form', 1, 0, 'contacts', 0),
(1484, 77, 'Contacts Pcontacts Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_category_list', 1, 0, 'contacts', 0),
(1485, 77, 'Contacts Pcontacts Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_status', 1, 0, 'contacts', 0),
(1486, 77, 'Contacts Pcontacts Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_button_add', 1, 0, 'contacts', 0),
(1487, 77, 'Contacts Pcontacts Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_button_delete', 1, 0, 'contacts', 0),
(1488, 77, 'Contacts Pcontacts Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_button_disable', 1, 0, 'contacts', 0),
(1489, 77, 'Contacts Pcontacts Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_button_visible', 1, 0, 'contacts', 0),
(1490, 77, 'Contacts Pcontacts Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_status_home', 1, 0, 'contacts', 0),
(1491, 77, 'Contacts Pcontacts Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_status_trash_action', 1, 0, 'contacts', 0),
(1492, 77, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_index', 1, 0, 'contacts', 0),
(1493, 77, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_id', 1, 0, 'contacts', 0),
(1494, 77, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_image_field', 1, 0, 'contacts', 0),
(1495, 77, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_title', 1, 0, 'contacts', 0),
(1496, 77, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_postdate', 1, 0, 'contacts', 0),
(1497, 77, 'Contacts Pcontacts Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_video', 1, 0, 'contacts', 0),
(1498, 77, 'Contacts Pcontacts Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_album', 1, 0, 'contacts', 0),
(1499, 77, 'Contacts Pcontacts Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_comment', 1, 0, 'contacts', 0),
(1500, 77, 'Contacts Pcontacts Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'contacts_pcontacts_image_width', 1, 0, 'contacts', 0),
(1501, 77, 'Contacts Pcontacts Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_intro', 1, 0, 'contacts', 0),
(1502, 77, 'Contacts Pcontacts Google Map', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_pcontacts_google_map', 1, 0, 'contacts', 0),
(1503, 178, 'Products Tags', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_products_tags', 1, 0, 'products', 0),
(1504, 81, 'Tags Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'tags_admin_paging_limit', 1, 0, 'tags', 0),
(1505, 49, 'Admins Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_index', 1, 0, 'admins', 0),
(1506, 49, 'Admins Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_image', 1, 0, 'admins', 0),
(1507, 49, 'Admins Image Size', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'admins_admins_image_size', 1, 0, 'admins', 0),
(1508, 49, 'Admins Email', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_email', 1, 0, 'admins', 0),
(1509, 49, 'Admins Address', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_address', 1, 0, 'admins', 0),
(1510, 49, 'Admins Phone', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_phone', 1, 0, 'admins', 0),
(1511, 49, 'Admins Public Group', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_public_group', 1, 0, 'admins', 0),
(1512, 75, 'Gallerys Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'gallerys_category_list', 1, 0, 'gallerys', 0),
(1513, 75, 'Album Image Size Width Products', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'album_image_size_width_products', 1, 0, 'gallerys', 0),
(1514, 75, 'Album Image Size Height Products', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'album_image_size_height_products', 1, 0, 'gallerys', 0),
(1515, 75, 'Products Limit Files', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_limit_files', 1, 0, 'gallerys', 0),
(1516, 49, 'Admins Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_intro', 1, 0, 'admins', 0),
(1517, 49, 'Admins Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admins_content', 1, 0, 'admins', 0),
(1518, 49, 'Admingroups Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'admingroups_admin_paging_limit', 1, 0, 'admins', 0),
(1519, 49, 'Admins Admingroups Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_search_form', 1, 0, 'admins', 0),
(1520, 49, 'Admins Admingroups Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_category_list', 1, 0, 'admins', 0),
(1521, 49, 'Admins Admingroups Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_status', 1, 0, 'admins', 0),
(1522, 49, 'Admins Admingroups Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_button_add', 1, 0, 'admins', 0),
(1523, 49, 'Admins Admingroups Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_button_delete', 1, 0, 'admins', 0),
(1524, 49, 'Admins Admingroups Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_button_disable', 1, 0, 'admins', 0),
(1525, 49, 'Admins Admingroups Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_button_visible', 1, 0, 'admins', 0),
(1526, 49, 'Admins Admingroups Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_status_home', 1, 0, 'admins', 0),
(1527, 49, 'Admins Admingroups Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_status_trash_action', 1, 0, 'admins', 0),
(1528, 49, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_index', 1, 0, 'admins', 0),
(1529, 49, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_id', 1, 0, 'admins', 0),
(1530, 49, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_image_field', 1, 0, 'admins', 0),
(1531, 49, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_title', 1, 0, 'admins', 0),
(1532, 49, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_postdate', 1, 0, 'admins', 0),
(1533, 49, 'Admins Admingroups Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_video', 1, 0, 'admins', 0),
(1534, 49, 'Admins Admingroups Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_album', 1, 0, 'admins', 0),
(1535, 49, 'Admins Admingroups Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_comment', 1, 0, 'admins', 0),
(1536, 49, 'Admins Admingroups Default', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_default', 1, 0, 'admins', 0),
(1537, 49, 'Admins Admingroups Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_intro', 1, 0, 'admins', 0),
(1538, 49, 'Admins Admingroups Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_content', 1, 0, 'admins', 0),
(1539, 49, 'Admins Admingroups Permission', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'admins_admingroups_permission', 1, 0, 'admins', 0),
(1540, 79, 'Banners Position Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_position_tab', 1, 0, 'banners', 0),
(1541, 79, 'Banners Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_category_list', 1, 0, 'banners', 0),
(1542, 79, 'Banners Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_settings_tab', 1, 0, 'banners', 0),
(1543, 79, 'Banners Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'banners_paging_limit', 1, 0, 'banners', 0),
(1544, 79, 'Banners Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_search_form', 1, 0, 'banners', 0),
(1545, 79, 'Banners Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_category_list', 1, 0, 'banners', 0),
(1546, 79, 'Banners Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_status', 1, 0, 'banners', 0),
(1547, 79, 'Banners Position', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_position', 1, 0, 'banners', 0),
(1548, 79, 'Banners Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_button_add', 1, 0, 'banners', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(1549, 79, 'Banners Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_button_delete', 1, 0, 'banners', 0),
(1550, 79, 'Banners Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_button_disable', 1, 0, 'banners', 0),
(1551, 79, 'Banners Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_button_visible', 1, 0, 'banners', 0),
(1552, 79, 'Banners Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_status_home', 1, 0, 'banners', 0),
(1553, 79, 'Banners Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_status_trash_action', 1, 0, 'banners', 0),
(1554, 79, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_index', 1, 0, 'banners', 0),
(1555, 79, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_id', 1, 0, 'banners', 0),
(1556, 79, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_image_field', 1, 0, 'banners', 0),
(1557, 79, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_title', 1, 0, 'banners', 0),
(1558, 79, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_postdate', 1, 0, 'banners', 0),
(1559, 79, 'Banners Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_banners_image', 1, 0, 'banners', 0),
(1560, 79, 'Banners Image Width', '', '<input id=''el_{id}'' type=''text'' value=''{value}'' name=''value[{id}]'' />', '1400', '', 'banners_banners_image_width', 1, 0, 'banners', 0),
(2176, 521, 'Partners Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'partners_admin_paging_limit', 1, 0, 'partners', 0),
(1561, 79, 'Banners Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_intro', 1, 0, 'banners', 0),
(1562, 79, 'Banners Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_content', 1, 0, 'banners', 0),
(1563, 79, 'Bannerpos Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'bannerpos_admin_paging_limit', 1, 0, 'banners', 0),
(1564, 79, 'Banners Bannerpos Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_search_form', 1, 0, 'banners', 0),
(1565, 79, 'Banners Bannerpos Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_category_list', 1, 0, 'banners', 0),
(1566, 79, 'Banners Bannerpos Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_status', 1, 0, 'banners', 0),
(1567, 79, 'Banners Bannerpos Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_button_add', 1, 0, 'banners', 0),
(1568, 79, 'Banners Bannerpos Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_button_delete', 1, 0, 'banners', 0),
(1569, 79, 'Banners Bannerpos Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_button_disable', 1, 0, 'banners', 0),
(1570, 79, 'Banners Bannerpos Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_button_visible', 1, 0, 'banners', 0),
(1571, 79, 'Banners Bannerpos Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_status_home', 1, 0, 'banners', 0),
(1572, 79, 'Banners Bannerpos Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_status_trash_action', 1, 0, 'banners', 0),
(1573, 79, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_index', 1, 0, 'banners', 0),
(1574, 79, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_id', 1, 0, 'banners', 0),
(1575, 79, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_image_field', 1, 0, 'banners', 0),
(1576, 79, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_title', 1, 0, 'banners', 0),
(1577, 79, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'banners_bannerpos_postdate', 1, 0, 'banners', 0),
(1578, 79, 'Banners Bannerpos Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_video', 1, 0, 'banners', 0),
(1579, 79, 'Banners Bannerpos Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_album', 1, 0, 'banners', 0),
(1580, 79, 'Banners Bannerpos Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_comment', 1, 0, 'banners', 0),
(1581, 79, 'Banners Bannerpos Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_intro', 1, 0, 'banners', 0),
(1582, 79, 'Banners Bannerpos Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_content', 1, 0, 'banners', 0),
(1583, 79, 'Banners Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_video', 1, 0, 'banners', 0),
(1584, 79, 'Banners Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_album', 1, 0, 'banners', 0),
(1585, 79, 'Banners Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_comment', 1, 0, 'banners', 0),
(1586, 255, 'News Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'news_paging_limit', 1, 0, 'news', 0),
(1587, 255, 'News Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '110', '', 'news_pages_image_width', 1, 0, 'news', 0),
(1588, 255, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_intro', 1, 0, 'news', 0),
(1589, 255, 'News Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_editor_intro', 1, 0, 'news', 0),
(1590, 255, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_content', 1, 0, 'news', 0),
(1591, 255, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_seo_option', 1, 0, 'news', 0),
(1592, 255, 'News Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_video', 1, 0, 'news', 0),
(1593, 255, 'News Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_album', 1, 0, 'news', 0),
(1594, 255, 'News Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_comment', 1, 0, 'news', 0),
(1595, 255, 'News Pages Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '75', '', 'news_pages_image_height', 1, 0, 'news', 0),
(1596, 434, 'Lease Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_category_list', 1, 0, 'lease', 0),
(1597, 434, 'Lease Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_search_form', 1, 0, 'lease', 0),
(1598, 434, 'Lease Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_category_list', 1, 0, 'lease', 0),
(1599, 434, 'Lease Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_status', 1, 0, 'lease', 0),
(1600, 434, 'Lease Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_button_add', 1, 0, 'lease', 0),
(1601, 434, 'Lease Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_button_delete', 1, 0, 'lease', 0),
(1602, 434, 'Lease Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_button_disable', 1, 0, 'lease', 0),
(1603, 434, 'Lease Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_button_visible', 1, 0, 'lease', 0),
(1604, 434, 'Lease Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_status_home', 1, 0, 'lease', 0),
(1605, 434, 'Lease Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_status_trash_action', 1, 0, 'lease', 0),
(1606, 434, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_index', 1, 0, 'lease', 0),
(1607, 434, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_id', 1, 0, 'lease', 0),
(1608, 434, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_image_field', 1, 0, 'lease', 0),
(1609, 434, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_title', 1, 0, 'lease', 0),
(1610, 434, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_postdate', 1, 0, 'lease', 0),
(1611, 434, 'Lease Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'lease_pages_image_width', 1, 0, 'lease', 0),
(1612, 434, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_intro', 1, 0, 'lease', 0),
(1613, 434, 'Lease Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_editor_intro', 1, 0, 'lease', 0),
(1614, 434, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_content', 1, 0, 'lease', 0),
(1615, 434, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'lease_pages_seo_option', 1, 0, 'lease', 0),
(1616, 434, 'Lease Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_video', 1, 0, 'lease', 0),
(1617, 434, 'Lease Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_album', 1, 0, 'lease', 0),
(1618, 434, 'Lease Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'lease_pages_comment', 1, 0, 'lease', 0),
(1619, 434, 'Lease Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'lease_paging_limit', 1, 0, 'lease', 0),
(1620, 438, 'Slidebanner Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_category_list', 1, 0, 'slidebanner', 0),
(1621, 438, 'Slidebanner Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_search_form', 1, 0, 'slidebanner', 0),
(1622, 438, 'Slidebanner Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_category_list', 1, 0, 'slidebanner', 0),
(1623, 438, 'Slidebanner Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_status', 1, 0, 'slidebanner', 0),
(1624, 438, 'Slidebanner Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_button_add', 1, 0, 'slidebanner', 0),
(1625, 438, 'Slidebanner Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_button_delete', 1, 0, 'slidebanner', 0),
(1626, 438, 'Slidebanner Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_button_disable', 1, 0, 'slidebanner', 0),
(1627, 438, 'Slidebanner Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_button_visible', 1, 0, 'slidebanner', 0),
(1628, 438, 'Slidebanner Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_status_home', 1, 0, 'slidebanner', 0),
(1629, 438, 'Slidebanner Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_status_trash_action', 1, 0, 'slidebanner', 0),
(1630, 438, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_index', 1, 0, 'slidebanner', 0),
(1631, 438, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_id', 1, 0, 'slidebanner', 0),
(1632, 438, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_image_field', 1, 0, 'slidebanner', 0),
(1633, 438, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_title', 1, 0, 'slidebanner', 0),
(1634, 438, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_postdate', 1, 0, 'slidebanner', 0),
(1635, 438, 'Slidebanner Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '660', '', 'slidebanner_pages_image_width', 1, 0, 'slidebanner', 0),
(1636, 438, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_intro', 1, 0, 'slidebanner', 0),
(1637, 438, 'Slidebanner Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_editor_intro', 1, 0, 'slidebanner', 0),
(1638, 438, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_content', 1, 0, 'slidebanner', 0),
(1639, 438, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'slidebanner_pages_seo_option', 1, 0, 'slidebanner', 0),
(1640, 438, 'Slidebanner Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_video', 1, 0, 'slidebanner', 0),
(1641, 438, 'Slidebanner Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_album', 1, 0, 'slidebanner', 0),
(1642, 438, 'Slidebanner Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'slidebanner_pages_comment', 1, 0, 'slidebanner', 0),
(1643, 294, 'Customers Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '258', '', 'customers_pages_image_width', 1, 0, 'customers', 0),
(1644, 294, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_intro', 1, 0, 'customers', 0),
(1645, 294, 'Customers Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_editor_intro', 1, 0, 'customers', 0),
(1646, 294, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_pages_content', 1, 0, 'customers', 0),
(1647, 294, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_seo_option', 1, 0, 'customers', 0),
(1648, 294, 'Customers Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_video', 1, 0, 'customers', 0),
(2178, 521, 'Partners Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'partners_partners_category_list', 1, 0, 'partners', 0),
(2179, 521, 'Partners Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_status', 1, 0, 'partners', 0),
(2180, 521, 'Partners Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_button_add', 1, 0, 'partners', 0),
(2181, 521, 'Partners Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_button_delete', 1, 0, 'partners', 0),
(2182, 521, 'Partners Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_button_disable', 1, 0, 'partners', 0),
(2183, 521, 'Partners Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_button_visible', 1, 0, 'partners', 0),
(2184, 521, 'Partners Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'partners_partners_status_home', 1, 0, 'partners', 0),
(2185, 521, 'Partners Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'partners_partners_status_trash_action', 1, 0, 'partners', 0),
(2186, 521, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_index', 1, 0, 'partners', 0),
(2187, 521, 'Partners Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'partners_partners_export', 1, 0, 'partners', 0),
(2188, 521, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_id', 1, 0, 'partners', 0),
(2189, 521, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_image_field', 1, 0, 'partners', 0),
(2190, 521, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_title', 1, 0, 'partners', 0),
(2191, 521, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_postdate', 1, 0, 'partners', 0),
(2192, 521, 'codes', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_codess', 1, 0, 'partners', 0),
(2193, 521, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_website', 1, 0, 'partners', 0),
(2194, 521, 'Partners Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'partners_partners_image_width', 1, 0, 'partners', 0),
(2195, 521, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_intro', 1, 0, 'partners', 0),
(2196, 521, 'Partners Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'partners_partners_editor_intro', 1, 0, 'partners', 0),
(2197, 521, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_content', 1, 0, 'partners', 0),
(2198, 521, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'partners_partners_seo_option', 1, 0, 'partners', 0),
(2199, 522, 'Ads Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_category_list', 1, 0, 'ads', 0),
(2200, 522, 'Ads Partners Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_search_form', 1, 0, 'ads', 0),
(2201, 522, 'Ads Partners Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_category_list', 1, 0, 'ads', 0),
(2202, 522, 'Ads Partners Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_status', 1, 0, 'ads', 0),
(2203, 522, 'Ads Partners Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_button_add', 1, 0, 'ads', 0),
(2204, 522, 'Ads Partners Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_button_delete', 1, 0, 'ads', 0),
(2205, 522, 'Ads Partners Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_button_disable', 1, 0, 'ads', 0),
(2206, 522, 'Ads Partners Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_button_visible', 1, 0, 'ads', 0),
(2207, 522, 'Ads Partners Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_status_home', 1, 0, 'ads', 0),
(2208, 522, 'Ads Partners Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_status_trash_action', 1, 0, 'ads', 0),
(2209, 522, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_index', 1, 0, 'ads', 0),
(2210, 522, 'Ads Partners Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_export', 1, 0, 'ads', 0),
(2211, 522, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_id', 1, 0, 'ads', 0),
(2212, 522, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_image_field', 1, 0, 'ads', 0),
(2213, 522, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_title', 1, 0, 'ads', 0),
(2214, 522, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_postdate', 1, 0, 'ads', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(2215, 522, 'codes', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_codess', 1, 0, 'ads', 0),
(2216, 522, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_partners_website', 1, 0, 'ads', 0),
(2217, 522, 'Ads Partners Image Width', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'ads_partners_image_width', 1, 0, 'ads', 0),
(2218, 522, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_intro', 1, 0, 'ads', 0),
(2219, 522, 'Ads Partners Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_editor_intro', 1, 0, 'ads', 0),
(2220, 522, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_content', 1, 0, 'ads', 0),
(2221, 522, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_partners_seo_option', 1, 0, 'ads', 0),
(2222, 522, 'Ads Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_search_form', 1, 0, 'ads', 0),
(2223, 522, 'Ads Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_category_list', 1, 0, 'ads', 0),
(2224, 522, 'Ads Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_status', 1, 0, 'ads', 0),
(2225, 522, 'Ads Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_button_add', 1, 0, 'ads', 0),
(2226, 522, 'Ads Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_button_delete', 1, 0, 'ads', 0),
(2227, 522, 'Ads Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_button_disable', 1, 0, 'ads', 0),
(2228, 522, 'Ads Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_button_visible', 1, 0, 'ads', 0),
(2229, 522, 'Ads Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_status_home', 1, 0, 'ads', 0),
(2230, 522, 'Ads Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_status_trash_action', 1, 0, 'ads', 0),
(2231, 522, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_index', 1, 0, 'ads', 0),
(2232, 522, 'Ads Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_export', 1, 0, 'ads', 0),
(2233, 522, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_id', 1, 0, 'ads', 0),
(2234, 522, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_image_field', 1, 0, 'ads', 0),
(2235, 522, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_title', 1, 0, 'ads', 0),
(2236, 522, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_postdate', 1, 0, 'ads', 0),
(2237, 522, 'Ads Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '305', '', 'ads_pages_image_width', 1, 0, 'ads', 0),
(2238, 522, 'Ads Pages Link', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'ads_pages_link', 1, 0, 'ads', 0),
(2239, 522, 'Ads Pages Provin', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_provin', 1, 0, 'ads', 0),
(2240, 522, 'Ads Pages Dis', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_dis', 1, 0, 'ads', 0),
(2241, 522, 'Ads Pages Maps', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_maps', 1, 0, 'ads', 0),
(2242, 522, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_intro', 1, 0, 'ads', 0),
(2243, 522, 'Ads Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_editor_intro', 1, 0, 'ads', 0),
(2244, 522, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_content', 1, 0, 'ads', 0),
(2245, 522, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_seo_option', 1, 0, 'ads', 0),
(2246, 522, 'Ads Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_video', 1, 0, 'ads', 0),
(2247, 522, 'Ads Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_album', 1, 0, 'ads', 0),
(2248, 522, 'Ads Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'ads_pages_comment', 1, 0, 'ads', 0),
(2249, 522, 'Ads Pages Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '93', '', 'ads_pages_image_height', 1, 0, 'ads', 0),
(2458, 79, 'Banners Bannerpos Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_bannerpos_export', 1, 0, 'banners', 0),
(2457, 79, 'Banners Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_export', 1, 0, 'banners', 0),
(2252, 178, 'Products Paging Public Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'products_paging_public_limit', 1, 0, 'products', 0),
(2253, 255, 'News Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_category_list', 1, 0, 'news', 0),
(2254, 255, 'News Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_search_form', 1, 0, 'news', 0),
(2255, 255, 'News Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_category_list', 1, 0, 'news', 0),
(2256, 255, 'News Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_status', 1, 0, 'news', 0),
(2257, 255, 'News Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_button_add', 1, 0, 'news', 0),
(2258, 255, 'News Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_button_delete', 1, 0, 'news', 0),
(2259, 255, 'News Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_button_disable', 1, 0, 'news', 0),
(2260, 255, 'News Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_button_visible', 1, 0, 'news', 0),
(2261, 255, 'News Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_status_home', 1, 0, 'news', 0),
(2262, 255, 'News Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_status_trash_action', 1, 0, 'news', 0),
(2263, 255, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_index', 1, 0, 'news', 0),
(2264, 255, 'News Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'news_pages_export', 1, 0, 'news', 0),
(2265, 255, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_id', 1, 0, 'news', 0),
(2266, 255, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_image_field', 1, 0, 'news', 0),
(2267, 255, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_title', 1, 0, 'news', 0),
(2268, 255, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'news_pages_postdate', 1, 0, 'news', 0),
(2269, 178, 'Products Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'products_cat_title', 1, 0, 'products', 0),
(2270, 178, 'Products Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_desc', 1, 0, 'products', 0),
(2271, 178, 'Products Cat Image Size', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '67x67', '', 'products_cat_image_size', 1, 0, 'products', 0),
(2272, 178, 'Products Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'products_cat_document', 1, 0, 'products', 0),
(2495, 260, 'Supports Supporttypes Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_button_visible', 1, 0, 'supports', 0),
(2496, 260, 'Supports Supporttypes Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_status_home', 1, 0, 'supports', 0),
(2492, 260, 'Supports Supporttypes Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_button_add', 1, 0, 'supports', 0),
(2493, 260, 'Supports Supporttypes Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_button_delete', 1, 0, 'supports', 0),
(2487, 260, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_seo_option', 1, 0, 'supports', 0),
(2278, 356, 'Services Pages Provin', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_provin', 1, 0, 'services', 0),
(2279, 356, 'Services Pages Dis', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_dis', 1, 0, 'services', 0),
(2280, 356, 'Services Pages Maps', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'services_pages_maps', 1, 0, 'services', 0),
(2281, 77, 'Contacts Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_category_list', 1, 0, 'contacts', 0),
(2282, 77, 'Contacts Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'contacts_paging_limit', 1, 0, 'contacts', 0),
(2283, 77, 'Contacts Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_contacts_button_delete', 1, 0, 'contacts', 0),
(2284, 77, 'Contacts Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_contacts_search_form', 1, 0, 'contacts', 0),
(2285, 77, 'Contacts Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_contacts_button_add', 1, 0, 'contacts', 0),
(2286, 77, 'Contacts Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_contacts_button_disable', 1, 0, 'contacts', 0),
(2287, 77, 'Contacts Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_contacts_button_visible', 1, 0, 'contacts', 0),
(2288, 77, 'Contacts Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_contacts_status_home', 1, 0, 'contacts', 0),
(2289, 77, 'Contacts Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_contacts_status_trash_action', 1, 0, 'contacts', 0),
(2290, 77, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_contacts_index', 1, 0, 'contacts', 0),
(2291, 77, 'Contacts Pcontacts Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_pcontacts_export', 1, 0, 'contacts', 0),
(2292, 50, 'Seos Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_category_list', 1, 0, 'seos', 0),
(2293, 50, 'Seos Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'seos_admin_paging_limit', 1, 0, 'seos', 0),
(2294, 50, 'Seos Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_search_form', 1, 0, 'seos', 0),
(2295, 50, 'Seos Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_status', 1, 0, 'seos', 0),
(2296, 50, 'Seos Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_button_add', 1, 0, 'seos', 0),
(2297, 50, 'Seos Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_button_delete', 1, 0, 'seos', 0),
(2298, 50, 'Seos Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_button_disable', 1, 0, 'seos', 0),
(2299, 50, 'Seos Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_button_visible', 1, 0, 'seos', 0),
(2300, 50, 'Seos Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_seos_status_home', 1, 0, 'seos', 0),
(2301, 50, 'Seos Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_index', 1, 0, 'seos', 0),
(2302, 50, 'Seos Image Field', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_seos_image_field', 1, 0, 'seos', 0),
(2303, 50, 'Seos Postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_postdate', 1, 0, 'seos', 0),
(2304, 356, 'Services Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'services_paging_limit', 1, 0, 'services', 0),
(2305, 50, 'Seos Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'seos_seos_intro', 1, 0, 'seos', 0),
(2306, 50, 'Seos Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_seos_content', 1, 0, 'seos', 0),
(2307, 50, 'Seos Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_seos_video', 1, 0, 'seos', 0),
(2308, 50, 'Seos Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_seos_album', 1, 0, 'seos', 0),
(2309, 50, 'Seos Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'seos_seos_comment', 1, 0, 'seos', 0),
(2310, 49, 'Admins Admingroups Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admins_admingroups_export', 1, 0, 'admins', 0),
(2639, 1121, 'Location Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'location_delete_category', 1, 0, 'location', 0),
(2640, 1121, 'Location Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_arrayimg', 1, 0, 'location', 0),
(2641, 1121, 'Location Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_intro_editor_type', 1, 0, 'location', 0),
(2642, 1121, 'Location Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'location_cat_title', 1, 0, 'location', 0),
(2643, 1121, 'Location Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_status', 1, 0, 'location', 0),
(2644, 1121, 'Location Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_value', 1, 0, 'location', 0),
(2645, 1121, 'Location Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_desc', 1, 0, 'location', 0),
(2646, 1121, 'Location Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_intro', 1, 0, 'location', 0),
(2647, 1121, 'Location Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'location_cat_index', 1, 0, 'location', 0),
(2648, 1121, 'Location Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_file', 1, 0, 'location', 0),
(2649, 1121, 'Location Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'location_cat_document', 1, 0, 'location', 0),
(2650, 555, ' Page List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', '_page_list', 1, 0, 'faq', 0),
(2651, 555, ' Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', '_category_list', 1, 0, 'faq', 0),
(2652, 0, 'Global Company Address', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'A75/6F/14 Bạch Đằng, Phường 2, Quận Tân Bình, TP.HCM', '', 'global_company_address', 1, 0, 'global', 0),
(2653, 0, 'Global Company Phone', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'All nail', '', 'global_company_phone', 1, 0, 'global', 0),
(2654, 0, 'Global Company Email', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'All nail', '', 'global_company_email', 1, 0, 'global', 0),
(2655, 69, 'Configs Facebook', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'configs_facebook', 1, 0, 'configs', 0),
(2338, 294, 'Customers Pages Provin', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_provin', 1, 0, 'customers', 0),
(2339, 294, 'Customers Pages Dis', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_dis', 1, 0, 'customers', 0),
(2340, 294, 'Customers Pages Maps', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'customers_pages_maps', 1, 0, 'customers', 0),
(2345, 545, 'Locations Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_edit_category', 1, 0, 'locations', 0),
(2346, 545, 'Locations Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_delete_category', 1, 0, 'locations', 0),
(2347, 545, 'Locations Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_arrayimg', 1, 0, 'locations', 0),
(2348, 545, 'Locations Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_cat_intro_editor_type', 1, 0, 'locations', 0),
(2349, 545, 'Locations Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_cat_title', 1, 0, 'locations', 0),
(2350, 545, 'Locations Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_cat_status', 1, 0, 'locations', 0),
(2351, 545, 'Locations Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_cat_value', 1, 0, 'locations', 0),
(2637, 545, 'Locations Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_cat_desc', 1, 0, 'locations', 0),
(2353, 545, 'Locations Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_cat_intro', 1, 0, 'locations', 0),
(2354, 545, 'Locations Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_cat_index', 1, 0, 'locations', 0),
(2355, 545, 'Locations Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_cat_file', 1, 0, 'locations', 0),
(2356, 545, 'Locations Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_cat_document', 1, 0, 'locations', 0),
(2357, 545, 'Locations Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_category_list', 1, 0, 'locations', 0),
(2358, 545, 'Locations Pages Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_search_form', 1, 0, 'locations', 0),
(2359, 545, 'Locations Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_pages_category_list', 1, 0, 'locations', 0),
(2360, 545, 'Locations Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_status', 1, 0, 'locations', 0),
(2361, 545, 'Locations Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_button_add', 1, 0, 'locations', 0),
(2362, 545, 'Locations Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_button_delete', 1, 0, 'locations', 0),
(2363, 545, 'Locations Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_button_disable', 1, 0, 'locations', 0),
(2364, 545, 'Locations Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_button_visible', 1, 0, 'locations', 0),
(2365, 545, 'Locations Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_pages_status_home', 1, 0, 'locations', 0),
(2366, 545, 'Locations Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_pages_status_trash_action', 1, 0, 'locations', 0),
(2367, 545, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_pages_index', 1, 0, 'locations', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(2368, 545, 'Locations Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_pages_export', 1, 0, 'locations', 0),
(2369, 545, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_id', 1, 0, 'locations', 0),
(2370, 545, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_image_field', 1, 0, 'locations', 0),
(2371, 545, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_title', 1, 0, 'locations', 0),
(2372, 545, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_pages_postdate', 1, 0, 'locations', 0),
(2373, 545, 'Locations Cat Image Size', '', '<input type="text" name="value[{id}]"  value="{value}" />', '67x67', '', 'locations_cat_image_size', 1, 0, 'locations', 0),
(2374, 53, 'Locations Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_status', 1, 0, 'menus', 0),
(2375, 53, 'Locations Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'locations_value', 1, 0, 'menus', 0),
(2376, 52, 'Langs Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'langs_langs_button_delete', 1, 0, 'langs', 0),
(2377, 52, 'Langs Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'langs_langs_video', 1, 0, 'langs', 0),
(2378, 52, 'Langs Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'langs_langs_album', 1, 0, 'langs', 0),
(2379, 52, 'Langs Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'langs_langs_comment', 1, 0, 'langs', 0),
(2380, 52, 'Langs Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'langs_langs_button_add', 1, 0, 'langs', 0),
(2381, 52, 'Langs Button Update', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'langs_langs_button_update', 1, 0, 'langs', 0),
(2382, 52, 'Langs Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'langs_langs_search_form', 1, 0, 'langs', 0),
(2383, 545, 'Locations Page List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'locations_page_list', 1, 0, 'locations', 0),
(2447, 553, 'Posts Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_export', 1, 0, 'posts', 0),
(2448, 553, 'Posts Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'posts_posts_image_width', 1, 0, 'posts', 0),
(2449, 553, 'Posts Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_editor_intro', 1, 0, 'posts', 0),
(2431, 553, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_intro', 1, 0, 'posts', 0),
(2459, 79, 'Banners Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'banners_banners_image_height', 1, 0, 'banners', 0),
(2460, 79, 'Banners Website', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'banners_banners_website', 1, 0, 'banners', 0),
(2420, 553, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_index', 1, 0, 'posts', 0),
(2455, 75, 'Album Image Size Height Posts', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'album_image_size_height_posts', 1, 0, 'gallerys', 0),
(2456, 75, 'Posts Limit Files', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_limit_files', 1, 0, 'gallerys', 0),
(2422, 553, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_id', 1, 0, 'posts', 0),
(2423, 553, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_image_field', 1, 0, 'posts', 0),
(2424, 553, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_title', 1, 0, 'posts', 0),
(2425, 553, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_postdate', 1, 0, 'posts', 0),
(2453, 553, 'Posts Image Height', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'posts_posts_image_height', 1, 0, 'posts', 0),
(2454, 75, 'Album Image Size Width Posts', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'album_image_size_width_posts', 1, 0, 'gallerys', 0),
(2452, 553, 'Posts Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_comment', 1, 0, 'posts', 0),
(2451, 553, 'Posts Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_posts_album', 1, 0, 'posts', 0),
(2429, 553, 'code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_code', 1, 0, 'posts', 0),
(2450, 553, 'Posts Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_posts_video', 1, 0, 'posts', 0),
(2467, 260, 'Supports Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_status', 1, 0, 'supports', 0),
(2466, 260, 'Supports Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supports_category_list', 1, 0, 'supports', 0),
(2464, 260, 'Supports Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'supports_admin_paging_limit', 1, 0, 'supports', 0),
(2465, 260, 'Supports Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supports_search_form', 1, 0, 'supports', 0),
(2463, 260, 'Supports Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_category_list', 1, 0, 'supports', 0),
(2462, 260, 'Supportssupporttypes Display Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supportssupporttypes_display_tab', 1, 0, 'supports', 0),
(2461, 294, 'Customers Page List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'customers_page_list', 1, 0, 'customers', 0),
(2497, 260, 'Supports Supporttypes Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_status_trash_action', 1, 0, 'supports', 0),
(2498, 260, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_index', 1, 0, 'supports', 0),
(2499, 260, 'Supports Supporttypes Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_export', 1, 0, 'supports', 0),
(2500, 260, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_id', 1, 0, 'supports', 0),
(2501, 260, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_image_field', 1, 0, 'supports', 0),
(2502, 260, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_title', 1, 0, 'supports', 0),
(2503, 260, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'supports_supporttypes_postdate', 1, 0, 'supports', 0),
(2504, 260, 'Supports Supporttypes Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_video', 1, 0, 'supports', 0),
(2505, 260, 'Supports Supporttypes Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_album', 1, 0, 'supports', 0),
(2506, 260, 'Supports Supporttypes Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'supports_supporttypes_comment', 1, 0, 'supports', 0),
(2510, 555, 'Faq Pages Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_category_list', 1, 0, 'faq', 0),
(2511, 555, 'Faq Pages Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_status', 1, 0, 'faq', 0),
(2512, 555, 'Faq Pages Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_button_add', 1, 0, 'faq', 0),
(2513, 555, 'Faq Pages Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_button_delete', 1, 0, 'faq', 0),
(2514, 555, 'Faq Pages Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_button_disable', 1, 0, 'faq', 0),
(2515, 555, 'Faq Pages Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_button_visible', 1, 0, 'faq', 0),
(2516, 555, 'Faq Pages Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_status_home', 1, 0, 'faq', 0),
(2517, 555, 'Faq Pages Status Trash Action', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_status_trash_action', 1, 0, 'faq', 0),
(2518, 555, 'index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_index', 1, 0, 'faq', 0),
(2519, 555, 'Faq Pages Export', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_export', 1, 0, 'faq', 0),
(2520, 555, 'ID', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_id', 1, 0, 'faq', 0),
(2521, 555, 'Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_image_field', 1, 0, 'faq', 0),
(2522, 555, 'Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_title', 1, 0, 'faq', 0),
(2523, 555, 'postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_postdate', 1, 0, 'faq', 0),
(2524, 555, 'Faq Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_edit_category', 1, 0, 'faq', 0),
(2525, 555, 'Faq Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_delete_category', 1, 0, 'faq', 0),
(2526, 555, 'Faq Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_arrayimg', 1, 0, 'faq', 0),
(2527, 555, 'Faq Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_intro_editor_type', 1, 0, 'faq', 0),
(2528, 555, 'Faq Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_cat_title', 1, 0, 'faq', 0),
(2529, 555, 'Faq Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_status', 1, 0, 'faq', 0),
(2530, 555, 'Faq Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_value', 1, 0, 'faq', 0),
(2531, 555, 'Faq Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_desc', 1, 0, 'faq', 0),
(2532, 555, 'Faq Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_intro', 1, 0, 'faq', 0),
(2533, 555, 'Faq Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_cat_index', 1, 0, 'faq', 0),
(2534, 555, 'Faq Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_file', 1, 0, 'faq', 0),
(2535, 555, 'Faq Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_cat_document', 1, 0, 'faq', 0),
(2536, 53, 'Faq Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_status', 1, 0, 'menus', 0),
(2537, 53, 'Faq Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_value', 1, 0, 'menus', 0),
(2538, 555, 'Faq Pages Image Width', '', '<input type="text" name="value[{id}]"  value="{value}" />', '', '', 'faq_pages_image_width', 1, 0, 'faq', 0),
(2539, 555, 'Faq Pages Link', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_link', 1, 0, 'faq', 0),
(2540, 555, 'Faq Pages Provin', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_provin', 1, 0, 'faq', 0),
(2541, 555, 'Faq Pages Dis', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_dis', 1, 0, 'faq', 0),
(2542, 555, 'Faq Pages Maps', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_maps', 1, 0, 'faq', 0),
(2543, 555, 'Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_intro', 1, 0, 'faq', 0),
(2544, 555, 'Faq Pages Editor Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_editor_intro', 1, 0, 'faq', 0),
(2545, 555, 'Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'faq_pages_content', 1, 0, 'faq', 0),
(2546, 555, 'SEO Option', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_seo_option', 1, 0, 'faq', 0),
(2547, 555, 'Faq Pages Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_video', 1, 0, 'faq', 0),
(2548, 555, 'Faq Pages Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_album', 1, 0, 'faq', 0),
(2549, 555, 'Faq Pages Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'faq_pages_comment', 1, 0, 'faq', 0),
(2550, 69, 'Configs Hotline', '', '<input type="text" name="value[{id}]"  value="{value}" />', '0937256242', '', 'configs_hotline', 1, 0, 'configs', 0),
(2551, 69, 'Configs Slogan', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'slogan here!', '', 'configs_slogan', 1, 0, 'configs', 0),
(2552, 555, 'Faq Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'faq_paging_limit', 1, 0, 'faq', 0),
(2553, 0, 'Use Cache Skin Wrapper', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'use_cache_skin_wrapper', 1, 0, 'global', 0),
(2554, 0, 'Use Cache Skin Wrapper', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'use_cache_skin_wrapper', 1, 0, 'global', 0),
(2555, 51, 'Settings Admins Group Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_admins_group_tab', 1, 0, 'settings', 0),
(2556, 51, 'Settings Tab', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'settings_settings_tab', 1, 0, 'settings', 0),
(2557, 0, 'Admin Multi Lang', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admin_multi_lang', 1, 0, 'global', 0),
(2558, 0, 'Enable Gzip', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'enable_gzip', 1, 0, 'global', 0),
(2559, 50, 'Global Meta Keywords', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_keywords', 1, 0, 'seos', 0),
(2560, 50, 'Global Meta Descriptions', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_descriptions', 1, 0, 'seos', 0),
(2561, 0, 'Use Cache Skin Wrapper', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'use_cache_skin_wrapper', 1, 0, 'global', 0),
(2562, 0, 'Google Analysiss', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'google_analysiss', 1, 0, 'global', 0),
(2563, 0, 'Google Analysis Key', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', 'UA-42288880-1', '', 'google_analysis_key', 1, 0, 'global', 0),
(2564, 69, 'Configs Hotline', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0937256242', '', 'configs_hotline', 1, 0, 'configs', 0),
(2565, 0, 'Global Websitename', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', 'All nail', '', 'global_websitename', 1, 0, 'global', 0),
(2566, 69, 'Configs Slogan', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', 'slogan here!', '', 'configs_slogan', 1, 0, 'configs', 0),
(2567, 0, 'Enable Gzip', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'enable_gzip', 1, 0, 'global', 0),
(2568, 50, 'Global Meta Keywords', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_keywords', 1, 0, 'seos', 0),
(2569, 50, 'Global Meta Descriptions', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_descriptions', 1, 0, 'seos', 0),
(2570, 77, 'Contacts Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_edit_category', 1, 0, 'contacts', 0),
(2571, 77, 'Contacts Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_delete_category', 1, 0, 'contacts', 0),
(2572, 77, 'Contacts Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_arrayimg', 1, 0, 'contacts', 0),
(2573, 77, 'Contacts Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_intro_editor_type', 1, 0, 'contacts', 0),
(2574, 77, 'Contacts Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_cat_title', 1, 0, 'contacts', 0),
(2575, 77, 'Contacts Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_status', 1, 0, 'contacts', 0),
(2576, 77, 'Contacts Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_value', 1, 0, 'contacts', 0),
(2577, 77, 'Contacts Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_desc', 1, 0, 'contacts', 0),
(2578, 77, 'Contacts Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_intro', 1, 0, 'contacts', 0),
(2579, 77, 'Contacts Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_cat_index', 1, 0, 'contacts', 0),
(2580, 77, 'Contacts Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_file', 1, 0, 'contacts', 0),
(2581, 77, 'Contacts Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'contacts_cat_document', 1, 0, 'contacts', 0),
(2582, 53, 'Contacts Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_status', 1, 0, 'menus', 0),
(2583, 53, 'Contacts Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contacts_value', 1, 0, 'menus', 0),
(2584, 77, 'Contact Form Name', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'contact_form_name', 1, 0, 'contacts', 0),
(2585, 69, 'Email Receive', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'hieuloc@vietsol.net', '', 'email_receive', 1, 0, 'configs', 0),
(2586, 69, 'Email Sender', '', '<input type="text" name="value[{id}]"  value="{value}" />', 'hieuloc@vietsol.net', '', 'email_sender', 1, 0, 'configs', 0),
(2587, 565, 'Show Location List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'show_location_list', 1, 0, 'users', 0),
(2588, 565, 'Users Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_category_list', 1, 0, 'users', 0),
(2589, 553, 'Posts Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '12', '', 'posts_paging_limit', 1, 0, 'posts', 0),
(2590, 14, 'Normal post duration', '', '', '3', 'text', 'normal_post_duration', 0, 0, 'settings', 0),
(2591, 14, 'Vip post duration', '', '', '7', 'text', 'vip_post_duration', 0, 0, 'settings', 0),
(2592, 0, 'Use Cache Skin Wrapper', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'use_cache_skin_wrapper', 1, 0, 'global', 0),
(2593, 553, 'Posts Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_category_list', 1, 0, 'posts', 0),
(2594, 0, 'Admin Multi Lang', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admin_multi_lang', 1, 0, 'global', 0),
(2595, 0, 'Enable Gzip', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'enable_gzip', 1, 0, 'global', 0),
(2596, 50, 'Global Meta Keywords', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_keywords', 1, 0, 'seos', 0),
(2597, 50, 'Global Meta Descriptions', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_descriptions', 1, 0, 'seos', 0),
(2598, 0, 'Use Cache Skin Wrapper', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'use_cache_skin_wrapper', 1, 0, 'global', 0),
(2599, 553, 'Posts Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_category_list', 1, 0, 'posts', 0),
(2600, 0, 'Admin Multi Lang', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'admin_multi_lang', 1, 0, 'global', 0),
(2601, 0, 'Enable Gzip', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'enable_gzip', 1, 0, 'global', 0);
INSERT INTO `vsf_setting` (`id`, `catId`, `title`, `intro`, `htmlValue`, `value`, `inputType`, `key`, `root`, `type`, `module`, `index`) VALUES
(2602, 50, 'Global Meta Keywords', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_keywords', 1, 0, 'seos', 0),
(2603, 50, 'Global Meta Descriptions', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '', '', 'global_meta_descriptions', 1, 0, 'seos', 0),
(2604, 565, 'Users Admin Paging Limit', '', '<input type="text" name="value[{id}]"  value="{value}" />', '20', '', 'users_admin_paging_limit', 1, 0, 'users', 0),
(2605, 565, 'Users Search Form', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_search_form', 1, 0, 'users', 0),
(2606, 565, 'Users Category List', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_category_list', 1, 0, 'users', 0),
(2607, 565, 'Users Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_status', 1, 0, 'users', 0),
(2608, 565, 'Users Button Add', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_button_add', 1, 0, 'users', 0),
(2609, 565, 'Users Button Delete', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_button_delete', 1, 0, 'users', 0),
(2610, 565, 'Users Button Disable', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_button_disable', 1, 0, 'users', 0),
(2611, 565, 'Users Button Visible', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_button_visible', 1, 0, 'users', 0),
(2612, 565, 'Users Status Home', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_status_home', 1, 0, 'users', 0),
(2613, 565, 'Users Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_index', 1, 0, 'users', 0),
(2614, 565, 'Users Image Field', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_image_field', 1, 0, 'users', 0),
(2615, 565, 'Users Name', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_name', 1, 0, 'users', 0),
(2616, 565, 'Users Postdate', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'users_users_postdate', 1, 0, 'users', 0),
(2617, 565, 'Users Video', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_video', 1, 0, 'users', 0),
(2618, 565, 'Users Album', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_album', 1, 0, 'users', 0),
(2619, 565, 'Users Comment', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_comment', 1, 0, 'users', 0),
(2620, 565, 'Users Code', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_code', 1, 0, 'users', 0),
(2621, 565, 'Users Image', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_image', 1, 0, 'users', 0),
(2622, 565, 'Users Image Size', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_image_size', 1, 0, 'users', 0),
(2623, 565, 'Users Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_intro', 1, 0, 'users', 0),
(2624, 565, 'Users Content', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'users_users_content', 1, 0, 'users', 0),
(2625, 553, 'Posts Edit Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_edit_category', 1, 0, 'posts', 0),
(2626, 553, 'Posts Delete Category', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_delete_category', 1, 0, 'posts', 0),
(2627, 553, 'Posts Arrayimg', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_arrayimg', 1, 0, 'posts', 0),
(2628, 553, 'Posts Cat Intro Editor Type', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_intro_editor_type', 1, 0, 'posts', 0),
(2629, 553, 'Posts Cat Title', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_cat_title', 1, 0, 'posts', 0),
(2630, 553, 'Posts Cat Status', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_status', 1, 0, 'posts', 0),
(2631, 553, 'Posts Cat Value', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_value', 1, 0, 'posts', 0),
(2632, 553, 'Posts Cat Desc', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_desc', 1, 0, 'posts', 0),
(2633, 553, 'Posts Cat Intro', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_intro', 1, 0, 'posts', 0),
(2634, 553, 'Posts Cat Index', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '1', '', 'posts_cat_index', 1, 0, 'posts', 0),
(2635, 553, 'Posts Cat File', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_file', 1, 0, 'posts', 0),
(2636, 553, 'Posts Cat Document', '', ' 	<label><input id=''el_{id}_1'' type=''radio'' value=''1'' name=''value[{id}]'' />Yes</label>\r\n						<label><input id=''el_{id}_0'' type=''radio'' value=''0'' name=''value[{id}]'' />No</label>\r\n						<script> $(''#el_{id}_{value}'').attr(''checked'',''checked''); </script> ', '0', '', 'posts_cat_document', 1, 0, 'posts', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_setting_group`
--

CREATE TABLE IF NOT EXISTS `vsf_setting_group` (
  `group` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vsf_setting_group`
--

INSERT INTO `vsf_setting_group` (`group`, `key`, `value`) VALUES
('posts_posts_list', 'posts_posts_status', '1'),
('posts_posts_list', 'posts_posts_category_list', '0'),
('posts_posts_list', 'posts_posts_title', '1'),
('posts_posts_list', 'posts_posts_image_field', '1'),
('posts_posts_list', 'posts_posts_id', '1'),
('posts_posts_list', 'posts_posts_index', '1'),
('posts_posts_list', 'posts_posts_postdate', '1'),
('products_products_list', 'products_products_index', '1'),
('products_products_list', 'products_products_id', '1'),
('products_products_list', 'products_products_image_field', '1'),
('products_products_list', 'products_products_title', '1'),
('products_products_list', 'products_products_category_list', '1'),
('products_products_list', 'products_products_status', '1'),
('products_products_list', 'products_products_postdate', '1'),
('posts_posts_form', 'posts_posts_status', '1'),
('posts_posts_form', 'posts_posts_category_list', '0'),
('posts_posts_form', 'posts_posts_index', '1'),
('posts_posts_form', 'posts_posts_code', '1'),
('posts_posts_form', 'posts_posts_image_field', '1'),
('posts_posts_form', 'posts_posts_intro', '1'),
('posts_posts_form', 'posts_posts_content', '1'),
('posts_posts_form', 'posts_posts_seo_option', '1'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_index', '0'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_id', '1'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_image_field', '1'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_title', '1'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_category_list', '0'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_status', '1'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_postdate', '1'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_status', '1'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_category_list', '0'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_index', '0'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_code', '0'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_image_field', '1'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_intro', '1'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_content', '1'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_seo_option', '1'),
('kjhkljhlk', 'slidebanners_slidebanners_show_hide', '1'),
('slidebanners_slidebanners_list', 'slidebanners_slidebanners_show_hide', '1'),
('slidebanners_slidebanners_form', 'slidebanners_slidebanners_website', '0'),
('logos_logos_list', 'logos_logos_index', '0'),
('logos_logos_list', 'logos_logos_id', '1'),
('logos_logos_list', 'logos_logos_image_field', '1'),
('logos_logos_list', 'logos_logos_title', '1'),
('logos_logos_list', 'logos_logos_category_list', '0'),
('logos_logos_list', 'logos_logos_status', '0'),
('logos_logos_list', 'logos_logos_postdate', '1'),
('logos_logos_form', 'logos_logos_status', '0'),
('logos_logos_form', 'logos_logos_category_list', '0'),
('logos_logos_form', 'logos_logos_index', '0'),
('logos_logos_form', 'logos_logos_code', '1'),
('logos_logos_form', 'logos_logos_image_field', '1'),
('logos_logos_form', 'logos_logos_intro', '1'),
('logos_logos_form', 'logos_logos_content', '1'),
('logos_logos_form', 'logos_logos_seo_option', '1'),
('logos_logos_list', 'logos_logos_chose', '1'),
('products_products_form', 'products_products_status', '1'),
('products_products_form', 'products_products_category_list', '1'),
('products_products_form', 'products_products_index', '1'),
('products_products_form', 'products_products_code', '1'),
('products_products_form', 'products_products_image_field', '1'),
('products_products_form', 'products_products_intro', '1'),
('products_products_form', 'products_products_content', '1'),
('products_products_form', 'products_products_seo_option', '1'),
('products_products_form', 'products_products_date_start', '1'),
('products_products_form', 'products_products_date_end', '1'),
('products_productlabels_list', 'products_productlabels_index', '1'),
('products_productlabels_list', 'products_productlabels_id', '1'),
('products_productlabels_list', 'products_productlabels_image_field', '0'),
('products_productlabels_list', 'products_productlabels_title', '1'),
('products_productlabels_list', 'products_productlabels_category_list', '0'),
('products_productlabels_list', 'products_productlabels_status', '1'),
('products_productlabels_list', 'products_productlabels_postdate', '0'),
('products_productlabels_form', 'products_productlabels_status', '1'),
('products_productlabels_form', 'products_productlabels_category_list', '0'),
('products_productlabels_form', 'products_productlabels_index', '1'),
('products_productlabels_form', 'products_productlabels_code', '1'),
('products_productlabels_form', 'products_productlabels_image_field', '0'),
('products_productlabels_form', 'products_productlabels_intro', '1'),
('products_productlabels_form', 'products_productlabels_content', '1'),
('products_productlabels_form', 'products_productlabels_seo_option', '1'),
('abouts_pages_list', 'abouts_pages_id', '1'),
('abouts_pages_list', 'abouts_pages_image_field', '1'),
('abouts_pages_list', 'abouts_pages_title', '1'),
('abouts_pages_list', 'abouts_pages_category_list', '0'),
('abouts_pages_list', 'abouts_pages_status', '1'),
('abouts_pages_list', 'abouts_pages_postdate', '1'),
('abouts_pages_list', 'abouts_pages_index', '1'),
('simple_pages_list', 'simple_pages_id', '1'),
('simple_pages_list', 'simple_pages_image_field', '1'),
('simple_pages_list', 'simple_pages_title', '1'),
('simple_pages_list', 'simple_pages_category_list', '0'),
('simple_pages_list', 'simple_pages_status', '1'),
('simple_pages_list', 'simple_pages_postdate', '1'),
('simple_pages_list', 'simple_pages_index', '1'),
('contacts_contacts_list', 'contacts_contacts_index', '1'),
('contacts_pcontacts_list', 'contacts_pcontacts_index', '1'),
('contacts_pcontacts_list', 'contacts_pcontacts_id', '1'),
('contacts_pcontacts_list', 'contacts_pcontacts_image_field', '1'),
('contacts_pcontacts_list', 'contacts_pcontacts_title', '1'),
('contacts_pcontacts_list', 'contacts_pcontacts_category_list', '0'),
('contacts_pcontacts_list', 'contacts_pcontacts_status', '1'),
('contacts_pcontacts_list', 'contacts_pcontacts_postdate', '1'),
('address_pages_list', 'address_pages_id', '1'),
('address_pages_list', 'address_pages_image_field', '1'),
('address_pages_list', 'address_pages_title', '1'),
('address_pages_list', 'address_pages_category_list', '0'),
('address_pages_list', 'address_pages_status', '1'),
('address_pages_list', 'address_pages_postdate', '1'),
('address_pages_list', 'address_pages_index', '1'),
('news_pages_list', 'news_pages_id', '1'),
('news_pages_list', 'news_pages_image_field', '1'),
('news_pages_list', 'news_pages_title', '1'),
('news_pages_list', 'news_pages_category_list', '0'),
('news_pages_list', 'news_pages_status', '1'),
('news_pages_list', 'news_pages_postdate', '1'),
('news_pages_list', 'news_pages_index', '1'),
(' togethers_pages_list', ' togethers_pages_id', '1'),
(' togethers_pages_list', ' togethers_pages_image_field', '1'),
(' togethers_pages_list', ' togethers_pages_title', '1'),
(' togethers_pages_list', ' togethers_pages_category_list', '0'),
(' togethers_pages_list', ' togethers_pages_status', '1'),
(' togethers_pages_list', ' togethers_pages_postdate', '1'),
(' togethers_pages_list', ' togethers_pages_index', '1'),
('togethers_pages_list', 'togethers_pages_id', '1'),
('togethers_pages_list', 'togethers_pages_image_field', '1'),
('togethers_pages_list', 'togethers_pages_title', '1'),
('togethers_pages_list', 'togethers_pages_category_list', '0'),
('togethers_pages_list', 'togethers_pages_status', '1'),
('togethers_pages_list', 'togethers_pages_postdate', '1'),
('togethers_pages_list', 'togethers_pages_index', '1'),
('logolefts_pages_list', 'logolefts_pages_id', '1'),
('logolefts_pages_list', 'logolefts_pages_image_field', '1'),
('logolefts_pages_list', 'logolefts_pages_title', '1'),
('logolefts_pages_list', 'logolefts_pages_category_list', '0'),
('logolefts_pages_list', 'logolefts_pages_status', '1'),
('logolefts_pages_list', 'logolefts_pages_postdate', '1'),
('logolefts_pages_list', 'logolefts_pages_index', '1'),
('admins_admingroups_list', 'admins_admingroups_index', '1'),
('admins_admingroups_list', 'admins_admingroups_id', '1'),
('admins_admingroups_list', 'admins_admingroups_image_field', '1'),
('admins_admingroups_list', 'admins_admingroups_title', '1'),
('admins_admingroups_list', 'admins_admingroups_category_list', '0'),
('admins_admingroups_list', 'admins_admingroups_status', '1'),
('admins_admingroups_list', 'admins_admingroups_postdate', '1'),
('configs_configs_list', 'configs_configs_index', '1'),
('configs_configs_list', 'configs_configs_id', '1'),
('configs_configs_list', 'configs_configs_image_field', '1'),
('configs_configs_list', 'configs_configs_title', '1'),
('configs_configs_list', 'configs_configs_category_list', '0'),
('configs_configs_list', 'configs_configs_status', '1'),
('configs_configs_list', 'configs_configs_postdate', '1'),
('configs_configs_form', 'configs_configs_status', '1'),
('configs_configs_form', 'configs_configs_category_list', '0'),
('configs_configs_form', 'configs_configs_index', '1'),
('configs_configs_form', 'configs_configs_code', '1'),
('configs_configs_form', 'configs_configs_image_field', '1'),
('configs_configs_form', 'configs_configs_intro', '1'),
('configs_configs_form', 'configs_configs_content', '1'),
('configs_configs_form', 'configs_configs_seo_option', '1'),
('customers_pages_list', 'customers_pages_id', '1'),
('customers_pages_list', 'customers_pages_image_field', '1'),
('customers_pages_list', 'customers_pages_title', '1'),
('customers_pages_list', 'customers_pages_category_list', '0'),
('customers_pages_list', 'customers_pages_status', '1'),
('customers_pages_list', 'customers_pages_postdate', '1'),
('customers_pages_list', 'customers_pages_index', '1'),
('supports_supports_list', 'supports_supports_index', '1'),
('supports_supports_list', 'supports_supports_id', '1'),
('supports_supports_list', 'supports_supports_image_field', '1'),
('supports_supports_list', 'supports_supports_title', '1'),
('supports_supports_list', 'supports_supports_category_list', '0'),
('supports_supports_list', 'supports_supports_status', '1'),
('supports_supports_list', 'supports_supports_postdate', '1'),
('supports_supports_form', 'supports_supports_seo_option', '1'),
('togethers_pages_form', 'togethers_pages_status', '1'),
('togethers_pages_form', 'togethers_pages_category_list', '0'),
('togethers_pages_form', 'togethers_pages_index', '1'),
('togethers_pages_form', 'togethers_pages_code', '0'),
('togethers_pages_form', 'togethers_pages_image_field', '0'),
('togethers_pages_form', 'togethers_pages_intro', '0'),
('togethers_pages_form', 'togethers_pages_content', '1'),
('togethers_pages_form', 'togethers_pages_seo_option', '1'),
('logolefts_pages_form', 'logolefts_pages_status', '1'),
('logolefts_pages_form', 'logolefts_pages_category_list', '0'),
('logolefts_pages_form', 'logolefts_pages_index', '1'),
('logolefts_pages_form', 'logolefts_pages_code', '0'),
('logolefts_pages_form', 'logolefts_pages_image_field', '1'),
('logolefts_pages_form', 'logolefts_pages_intro', '0'),
('logolefts_pages_form', 'logolefts_pages_content', '0'),
('logolefts_pages_form', 'logolefts_pages_seo_option', '0'),
('news_pages_form', 'news_pages_status', '1'),
('news_pages_form', 'news_pages_category_list', '1'),
('news_pages_form', 'news_pages_index', '1'),
('news_pages_form', 'news_pages_code', '0'),
('news_pages_form', 'news_pages_image_field', '1'),
('news_pages_form', 'news_pages_intro', '1'),
('news_pages_form', 'news_pages_content', '1'),
('news_pages_form', 'news_pages_seo_option', '1'),
('customers_pages_form', 'customers_pages_status', '1'),
('customers_pages_form', 'customers_pages_category_list', '0'),
('customers_pages_form', 'customers_pages_index', '0'),
('customers_pages_form', 'customers_pages_code', '0'),
('customers_pages_form', 'customers_pages_image_field', '1'),
('customers_pages_form', 'customers_pages_intro', '1'),
('customers_pages_form', 'customers_pages_content', '1'),
('customers_pages_form', 'customers_pages_seo_option', '1'),
('banners_banners_list', 'banners_banners_index', '1'),
('banners_banners_list', 'banners_banners_id', '1'),
('banners_banners_list', 'banners_banners_image_field', '1'),
('banners_banners_list', 'banners_banners_title', '1'),
('banners_banners_list', 'banners_banners_category_list', '0'),
('banners_banners_list', 'banners_banners_status', '1'),
('banners_banners_list', 'banners_banners_postdate', '1'),
('420px x 420px', 'products_products_album', ''),
('abouts_pages_form', 'abouts_pages_status', '1'),
('abouts_pages_form', 'abouts_pages_category_list', '0'),
('abouts_pages_form', 'abouts_pages_index', '0'),
('abouts_pages_form', 'abouts_pages_code', '0'),
('abouts_pages_form', 'abouts_pages_image_field', '0'),
('abouts_pages_form', 'abouts_pages_intro', '1'),
('abouts_pages_form', 'abouts_pages_content', '1'),
('abouts_pages_form', 'abouts_pages_seo_option', '1'),
('products_products_form', 'products_products_code_s', '1'),
('weblinks_pages_list', 'weblinks_pages_index', '1'),
('weblinks_pages_list', 'weblinks_pages_id', '1'),
('weblinks_pages_list', 'weblinks_pages_image_field', '1'),
('weblinks_pages_list', 'weblinks_pages_title', '1'),
('weblinks_pages_list', 'weblinks_pages_category_list', '0'),
('weblinks_pages_list', 'weblinks_pages_status', '1'),
('weblinks_pages_list', 'weblinks_pages_postdate', '1'),
('weblinks_pages_form', 'weblinks_pages_status', '1'),
('weblinks_pages_form', 'weblinks_pages_category_list', '0'),
('weblinks_pages_form', 'weblinks_pages_index', '1'),
('weblinks_pages_form', 'weblinks_pages_code', '1'),
('weblinks_pages_form', 'weblinks_pages_image_field', '1'),
('weblinks_pages_form', 'weblinks_pages_intro', '1'),
('weblinks_pages_form', 'weblinks_pages_content', '1'),
('weblinks_pages_form', 'weblinks_pages_seo_option', '1'),
('weblinks_partners_list', 'weblinks_partners_index', '0'),
('weblinks_partners_list', 'weblinks_partners_id', '1'),
('weblinks_partners_list', 'weblinks_partners_image_field', '0'),
('weblinks_partners_list', 'weblinks_partners_title', '1'),
('weblinks_partners_list', 'weblinks_partners_category_list', '0'),
('weblinks_partners_list', 'weblinks_partners_status', '1'),
('weblinks_partners_list', 'weblinks_partners_postdate', '0'),
('weblinks_partners_form', 'weblinks_partners_status', '1'),
('weblinks_partners_form', 'weblinks_partners_category_list', '0'),
('weblinks_partners_form', 'weblinks_partners_index', '0'),
('weblinks_partners_form', 'weblinks_partners_code', '0'),
('weblinks_partners_form', 'weblinks_partners_image_field', '0'),
('weblinks_partners_form', 'weblinks_partners_intro', '0'),
('weblinks_partners_form', 'weblinks_partners_content', '0'),
('weblinks_partners_form', 'weblinks_partners_seo_option', '1'),
('weblinks_partners_website', 'weblinks_partners_website', '1'),
('learn_pages_list', 'learn_pages_index', '1'),
('learn_pages_list', 'learn_pages_id', '1'),
('learn_pages_list', 'learn_pages_image_field', '1'),
('learn_pages_list', 'learn_pages_title', '1'),
('learn_pages_list', 'learn_pages_category_list', '1'),
('learn_pages_list', 'learn_pages_status', '1'),
('learn_pages_list', 'learn_pages_postdate', '1'),
('learn_pages_form', 'learn_pages_status', '1'),
('learn_pages_form', 'learn_pages_category_list', '1'),
('learn_pages_form', 'learn_pages_index', '1'),
('learn_pages_form', 'learn_pages_code', '1'),
('learn_pages_form', 'learn_pages_image_field', '1'),
('learn_pages_form', 'learn_pages_intro', '1'),
('learn_pages_form', 'learn_pages_content', '1'),
('learn_pages_form', 'learn_pages_seo_option', '1'),
('learn_pages_form', 'learn_pages_codes', '1'),
('videos_partners_form', 'videos_partners_seo_option', '0'),
('videos_partners_form', 'videos_partners_content', '0'),
('videos_partners_form', 'videos_partners_intro', '0'),
('videos_partners_form', 'videos_partners_image_field', '0'),
('videos_partners_form', 'videos_partners_index', '1'),
('videos_partners_form', 'videos_partners_codes', '1'),
('videos_partners_website', 'videos_partners_website', '1'),
('videos_partners_form', 'videos_partners_status', '1'),
('videos_partners_form', 'videos_partners_category_list', '0'),
('videos_partners_list', 'videos_partners_image_field', '0'),
('videos_partners_list', 'videos_partners_id', '1'),
('videos_partners_list', 'videos_partners_index', '1'),
('videos_partners_list', 'videos_partners_title', '1'),
('videos_partners_list', 'videos_partners_category_list', '0'),
('videos_partners_list', 'videos_partners_status', '1'),
('videos_partners_list', 'videos_partners_postdate', '1'),
('videos_partners_form', 'videos_partners_codess', '1'),
('pages_pages_list', 'pages_pages_index', '1'),
('pages_pages_list', 'pages_pages_id', '1'),
('pages_pages_list', 'pages_pages_image_field', '1'),
('pages_pages_list', 'pages_pages_title', '1'),
('pages_pages_list', 'pages_pages_category_list', '0'),
('pages_pages_list', 'pages_pages_status', '1'),
('pages_pages_list', 'pages_pages_postdate', '1'),
('services_pages_list', 'services_pages_index', '1'),
('services_pages_list', 'services_pages_id', '1'),
('services_pages_list', 'services_pages_image_field', '1'),
('services_pages_list', 'services_pages_title', '1'),
('services_pages_list', 'services_pages_category_list', '0'),
('services_pages_list', 'services_pages_status', '1'),
('services_pages_list', 'services_pages_postdate', '1'),
('services_pages_form', 'services_pages_status', '1'),
('services_pages_form', 'services_pages_category_list', '1'),
('services_pages_form', 'services_pages_index', '1'),
('services_pages_form', 'services_pages_code', '1'),
('services_pages_form', 'services_pages_image_field', '1'),
('services_pages_form', 'services_pages_intro', '1'),
('services_pages_form', 'services_pages_content', '1'),
('services_pages_form', 'services_pages_seo_option', '1'),
('callflower_pages_list', 'callflower_pages_index', '1'),
('callflower_pages_list', 'callflower_pages_id', '1'),
('callflower_pages_list', 'callflower_pages_image_field', '1'),
('callflower_pages_list', 'callflower_pages_title', '1'),
('callflower_pages_list', 'callflower_pages_category_list', '0'),
('callflower_pages_list', 'callflower_pages_status', '1'),
('callflower_pages_list', 'callflower_pages_postdate', '1'),
('callflower_pages_form', 'callflower_pages_status', '1'),
('callflower_pages_form', 'callflower_pages_category_list', '0'),
('callflower_pages_form', 'callflower_pages_index', '1'),
('callflower_pages_form', 'callflower_pages_code', '1'),
('callflower_pages_form', 'callflower_pages_image_field', '1'),
('callflower_pages_form', 'callflower_pages_intro', '1'),
('callflower_pages_form', 'callflower_pages_content', '1'),
('callflower_pages_form', 'callflower_pages_seo_option', '1'),
('flower_japan_pages_list', 'flower_japan_pages_index', '1'),
('flower_japan_pages_list', 'flower_japan_pages_id', '1'),
('flower_japan_pages_list', 'flower_japan_pages_image_field', '1'),
('flower_japan_pages_list', 'flower_japan_pages_title', '1'),
('flower_japan_pages_list', 'flower_japan_pages_category_list', '0'),
('flower_japan_pages_list', 'flower_japan_pages_status', '1'),
('flower_japan_pages_list', 'flower_japan_pages_postdate', '1'),
('flower_japan_pages_form', 'flower_japan_pages_status', '1'),
('flower_japan_pages_form', 'flower_japan_pages_category_list', '0'),
('flower_japan_pages_form', 'flower_japan_pages_index', '1'),
('flower_japan_pages_form', 'flower_japan_pages_image_field', '1'),
('flower_japan_pages_form', 'flower_japan_pages_intro', '1'),
('flower_japan_pages_form', 'flower_japan_pages_content', '1'),
('flower_japan_pages_form', 'flower_japan_pages_seo_option', '1'),
('simple_pages_form', 'simple_pages_status', '1'),
('simple_pages_form', 'simple_pages_category_list', '0'),
('simple_pages_form', 'simple_pages_index', '1'),
('simple_pages_form', 'simple_pages_image_field', '1'),
('simple_pages_form', 'simple_pages_intro', '1'),
('simple_pages_form', 'simple_pages_content', '1'),
('simple_pages_form', 'simple_pages_seo_option', '1'),
('banners_bannerpos_list', 'banners_bannerpos_index', '1'),
('banners_bannerpos_list', 'banners_bannerpos_id', '1'),
('banners_bannerpos_list', 'banners_bannerpos_image_field', '0'),
('banners_bannerpos_list', 'banners_bannerpos_title', '1'),
('banners_bannerpos_list', 'banners_bannerpos_category_list', '0'),
('banners_bannerpos_list', 'banners_bannerpos_status', '1'),
('banners_bannerpos_list', 'banners_bannerpos_postdate', '1'),
('lease_pages_list', 'lease_pages_index', '1'),
('lease_pages_list', 'lease_pages_id', '1'),
('lease_pages_list', 'lease_pages_image_field', '1'),
('lease_pages_list', 'lease_pages_title', '1'),
('lease_pages_list', 'lease_pages_category_list', '0'),
('lease_pages_list', 'lease_pages_status', '1'),
('lease_pages_list', 'lease_pages_postdate', '1'),
('lease_pages_form', 'lease_pages_status', '1'),
('lease_pages_form', 'lease_pages_category_list', '0'),
('lease_pages_form', 'lease_pages_index', '1'),
('lease_pages_form', 'lease_pages_image_field', '1'),
('lease_pages_form', 'lease_pages_intro', '1'),
('lease_pages_form', 'lease_pages_content', '1'),
('lease_pages_form', 'lease_pages_seo_option', '1'),
('slidebanner_pages_list', 'slidebanner_pages_index', '1'),
('slidebanner_pages_list', 'slidebanner_pages_id', '1'),
('slidebanner_pages_list', 'slidebanner_pages_image_field', '1'),
('slidebanner_pages_list', 'slidebanner_pages_title', '1'),
('slidebanner_pages_list', 'slidebanner_pages_category_list', '0'),
('slidebanner_pages_list', 'slidebanner_pages_status', '1'),
('slidebanner_pages_list', 'slidebanner_pages_postdate', '1'),
('slidebanner_pages_form', 'slidebanner_pages_status', '1'),
('slidebanner_pages_form', 'slidebanner_pages_category_list', '0'),
('slidebanner_pages_form', 'slidebanner_pages_index', '1'),
('slidebanner_pages_form', 'slidebanner_pages_image_field', '1'),
('slidebanner_pages_form', 'slidebanner_pages_intro', '1'),
('slidebanner_pages_form', 'slidebanner_pages_content', '1'),
('slidebanner_pages_form', 'slidebanner_pages_seo_option', '1'),
('customers_pages_form', 'customers_pages_link', '1'),
('getEmail_pages_list', 'getemail_pages_index', '1'),
('getEmail_pages_list', 'getemail_pages_id', '1'),
('getEmail_pages_list', 'getemail_pages_image_field', '1'),
('getEmail_pages_list', 'getemail_pages_title', '1'),
('getEmail_pages_list', 'getemail_pages_category_list', '0'),
('getEmail_pages_list', 'getemail_pages_status', '1'),
('getEmail_pages_list', 'getemail_pages_postdate', '1'),
('getEmail_pages_form', 'getemail_pages_status', '1'),
('getEmail_pages_form', 'getemail_pages_category_list', '0'),
('getEmail_pages_form', 'getemail_pages_index', '1'),
('getEmail_pages_form', 'getemail_pages_image_field', '1'),
('getEmail_pages_form', 'getemail_pages_intro', '1'),
('getEmail_pages_form', 'getemail_pages_content', '1'),
('getEmail_pages_form', 'getemail_pages_seo_option', '1'),
('nationals_nationals_list', 'nationals_nationals_index', '1'),
('nationals_nationals_list', 'nationals_nationals_id', '1'),
('nationals_nationals_list', 'nationals_nationals_image_field', '1'),
('nationals_nationals_list', 'nationals_nationals_title', '1'),
('nationals_nationals_list', 'nationals_nationals_category_list', '0'),
('nationals_nationals_list', 'nationals_nationals_status', '1'),
('nationals_nationals_list', 'nationals_nationals_postdate', '1'),
('nationals_nationals_form', 'nationals_nationals_status', '1'),
('nationals_nationals_form', 'nationals_nationals_category_list', '0'),
('nationals_nationals_form', 'nationals_nationals_index', '1'),
('nationals_nationals_form', 'nationals_nationals_code', '1'),
('nationals_nationals_form', 'nationals_nationals_image_field', '1'),
('nationals_nationals_form', 'nationals_nationals_intro', '1'),
('nationals_nationals_form', 'nationals_nationals_content', '1'),
('nationals_nationals_form', 'nationals_nationals_seo_option', '1'),
('leagues_leagues_list', 'leagues_leagues_index', '1'),
('leagues_leagues_list', 'leagues_leagues_id', '1'),
('leagues_leagues_list', 'leagues_leagues_image_field', '1'),
('leagues_leagues_list', 'leagues_leagues_title', '1'),
('leagues_leagues_list', 'leagues_leagues_category_list', '0'),
('leagues_leagues_list', 'leagues_leagues_status', '1'),
('leagues_leagues_list', 'leagues_leagues_postdate', '1'),
('leagues_leagues_form', 'leagues_leagues_status', '1'),
('leagues_leagues_form', 'leagues_leagues_category_list', '0'),
('leagues_leagues_form', 'leagues_leagues_index', '1'),
('leagues_leagues_form', 'leagues_leagues_code', '1'),
('leagues_leagues_form', 'leagues_leagues_image_field', '1'),
('leagues_leagues_form', 'leagues_leagues_intro', '1'),
('leagues_leagues_form', 'leagues_leagues_content', '1'),
('leagues_leagues_form', 'leagues_leagues_seo_option', '1'),
('clubs_clubs_list', 'clubs_clubs_index', '1'),
('clubs_clubs_list', 'clubs_clubs_id', '1'),
('clubs_clubs_list', 'clubs_clubs_image_field', '1'),
('clubs_clubs_list', 'clubs_clubs_title', '1'),
('clubs_clubs_list', 'clubs_clubs_category_list', '0'),
('clubs_clubs_list', 'clubs_clubs_status', '1'),
('clubs_clubs_list', 'clubs_clubs_postdate', '1'),
('clubs_clubs_form', 'clubs_clubs_status', '1'),
('clubs_clubs_form', 'clubs_clubs_category_list', '0'),
('clubs_clubs_form', 'clubs_clubs_index', '1'),
('clubs_clubs_form', 'clubs_clubs_code', '1'),
('clubs_clubs_form', 'clubs_clubs_image_field', '1'),
('clubs_clubs_form', 'clubs_clubs_intro', '1'),
('clubs_clubs_form', 'clubs_clubs_content', '1'),
('clubs_clubs_form', 'clubs_clubs_seo_option', '1'),
('games_games_list', 'games_games_index', '1'),
('games_games_list', 'games_games_id', '1'),
('games_games_list', 'games_games_image_field', '1'),
('games_games_list', 'games_games_title', '1'),
('games_games_list', 'games_games_category_list', '0'),
('games_games_list', 'games_games_status', '1'),
('games_games_list', 'games_games_postdate', '1'),
('games_games_form', 'games_games_status', '1'),
('games_games_form', 'games_games_category_list', '0'),
('games_games_form', 'games_games_index', '1'),
('games_games_form', 'games_games_code', '1'),
('games_games_form', 'games_games_image_field', '1'),
('games_games_form', 'games_games_intro', '1'),
('games_games_form', 'games_games_content', '1'),
('games_games_form', 'games_games_seo_option', '1'),
('matchs_matchs_list', 'matchs_matchs_index', '1'),
('matchs_matchs_list', 'matchs_matchs_id', '1'),
('matchs_matchs_list', 'matchs_matchs_image_field', '1'),
('matchs_matchs_list', 'matchs_matchs_title', '1'),
('matchs_matchs_list', 'matchs_matchs_category_list', '0'),
('matchs_matchs_list', 'matchs_matchs_status', '1'),
('matchs_matchs_list', 'matchs_matchs_postdate', '1'),
('matchs_matchs_form', 'matchs_matchs_status', '1'),
('matchs_matchs_form', 'matchs_matchs_category_list', '0'),
('matchs_matchs_form', 'matchs_matchs_index', '1'),
('matchs_matchs_form', 'matchs_matchs_code', '1'),
('matchs_matchs_form', 'matchs_matchs_image_field', '1'),
('matchs_matchs_form', 'matchs_matchs_intro', '1'),
('matchs_matchs_form', 'matchs_matchs_content', '1'),
('matchs_matchs_form', 'matchs_matchs_seo_option', '1'),
('videos_videos_list', 'videos_videos_index', '1'),
('videos_videos_list', 'videos_videos_id', '1'),
('videos_videos_list', 'videos_videos_image_field', '1'),
('videos_videos_list', 'videos_videos_title', '1'),
('videos_videos_list', 'videos_videos_category_list', '0'),
('videos_videos_list', 'videos_videos_status', '1'),
('videos_videos_list', 'videos_videos_postdate', '1'),
('videos_videos_form', 'videos_videos_status', '1'),
('videos_videos_form', 'videos_videos_category_list', '0'),
('videos_videos_form', 'videos_videos_index', '1'),
('videos_videos_form', 'videos_videos_code', '1'),
('videos_videos_form', 'videos_videos_image_field', '1'),
('videos_videos_form', 'videos_videos_intro', '1'),
('videos_videos_form', 'videos_videos_content', '1'),
('videos_videos_form', 'videos_videos_seo_option', '1'),
('posts_posts_form', 'posts_posts_category_list_obj', '1'),
('clubs_clubs_list', 'clubs_clubs_category_list_club', '1'),
('expects_pages_list', 'expects_pages_index', '1'),
('expects_pages_list', 'expects_pages_id', '1'),
('expects_pages_list', 'expects_pages_image_field', '1'),
('expects_pages_list', 'expects_pages_title', '1'),
('expects_pages_list', 'expects_pages_category_list', '0'),
('expects_pages_list', 'expects_pages_status', '1'),
('expects_pages_list', 'expects_pages_postdate', '1'),
('expects_pages_form', 'expects_pages_status', '1'),
('expects_pages_form', 'expects_pages_category_list', '0'),
('expects_pages_form', 'expects_pages_index', '1'),
('expects_pages_form', 'expects_pages_image_field', '1'),
('expects_pages_form', 'expects_pages_intro', '1'),
('expects_pages_form', 'expects_pages_content', '1'),
('expects_pages_form', 'expects_pages_seo_option', '1'),
('expects_pages_form', 'expects_pages_category_list_obj', '1'),
('bxh_pages_list', 'bxh_pages_index', '1'),
('bxh_pages_list', 'bxh_pages_id', '1'),
('bxh_pages_list', 'bxh_pages_image_field', '1'),
('bxh_pages_list', 'bxh_pages_title', '1'),
('bxh_pages_list', 'bxh_pages_category_list', '0'),
('bxh_pages_list', 'bxh_pages_status', '1'),
('bxh_pages_list', 'bxh_pages_postdate', '1'),
('bxh_pages_form', 'bxh_pages_status', '1'),
('bxh_pages_form', 'bxh_pages_category_list_obj', '1'),
('bxh_pages_form', 'bxh_pages_index', '1'),
('bxh_pages_form', 'bxh_pages_image_field', '1'),
('bxh_pages_form', 'bxh_pages_intro', '1'),
('bxh_pages_form', 'bxh_pages_content', '1'),
('bxh_pages_form', 'bxh_pages_seo_option', '1'),
('injurys_injurys_list', 'injurys_injurys_index', '1'),
('injurys_injurys_list', 'injurys_injurys_id', '1'),
('injurys_injurys_list', 'injurys_injurys_image_field', '1'),
('injurys_injurys_list', 'injurys_injurys_title', '1'),
('injurys_injurys_list', 'injurys_injurys_category_list', '0'),
('injurys_injurys_list', 'injurys_injurys_status', '1'),
('injurys_injurys_list', 'injurys_injurys_postdate', '1'),
('injurys_injurys_form', 'injurys_injurys_status', '1'),
('injurys_injurys_form', 'injurys_injurys_category_list', '0'),
('injurys_injurys_form', 'injurys_injurys_index', '1'),
('injurys_injurys_form', 'injurys_injurys_code', '1'),
('injurys_injurys_form', 'injurys_injurys_image_field', '1'),
('injurys_injurys_form', 'injurys_injurys_intro', '1'),
('injurys_injurys_form', 'injurys_injurys_content', '1'),
('injurys_injurys_form', 'injurys_injurys_seo_option', '1'),
('slidebanner_pages_form', 'slidebanner_pages_category_list_obj', '1'),
('projects_pages_list', 'projects_pages_index', '1'),
('projects_pages_list', 'projects_pages_id', '1'),
('projects_pages_list', 'projects_pages_image_field', '1'),
('projects_pages_list', 'projects_pages_title', '1'),
('projects_pages_list', 'projects_pages_category_list', '0'),
('projects_pages_list', 'projects_pages_status', '1'),
('projects_pages_list', 'projects_pages_postdate', '1'),
('projects_pages_form', 'projects_pages_status', '1'),
('projects_pages_form', 'projects_pages_category_list', '0'),
('projects_pages_form', 'projects_pages_index', '1'),
('projects_pages_form', 'projects_pages_image_field', '1'),
('projects_pages_form', 'projects_pages_intro', '1'),
('projects_pages_form', 'projects_pages_content', '1'),
('projects_pages_form', 'projects_pages_seo_option', '1'),
('projects_pages_form', 'projects_pages_map', '1'),
('partners_partners_list', 'partners_partners_index', '1'),
('partners_partners_list', 'partners_partners_id', '1'),
('partners_partners_list', 'partners_partners_image_field', '1'),
('partners_partners_list', 'partners_partners_title', '1'),
('partners_partners_list', 'partners_partners_category_list', '0'),
('partners_partners_list', 'partners_partners_status', '1'),
('partners_partners_list', 'partners_partners_postdate', '1'),
('partners_partners_form', 'partners_partners_status', '1'),
('partners_partners_form', 'partners_partners_category_list', '0'),
('partners_partners_form', 'partners_partners_index', '1'),
('partners_partners_form', 'partners_partners_codess', '1'),
('partners_partners_website', 'partners_partners_website', '1'),
('partners_partners_form', 'partners_partners_image_field', '1'),
('partners_partners_form', 'partners_partners_intro', '1'),
('partners_partners_form', 'partners_partners_content', '1'),
('partners_partners_form', 'partners_partners_seo_option', '1'),
('ads_partners_list', 'ads_partners_index', '1'),
('ads_partners_list', 'ads_partners_id', '1'),
('ads_partners_list', 'ads_partners_image_field', '1'),
('ads_partners_list', 'ads_partners_title', '1'),
('ads_partners_list', 'ads_partners_category_list', '0'),
('ads_partners_list', 'ads_partners_status', '1'),
('ads_partners_list', 'ads_partners_postdate', '1'),
('ads_partners_form', 'ads_partners_status', '1'),
('ads_partners_form', 'ads_partners_category_list', '0'),
('ads_partners_form', 'ads_partners_index', '1'),
('ads_partners_form', 'ads_partners_codess', '1'),
('ads_partners_website', 'ads_partners_website', '1'),
('ads_partners_form', 'ads_partners_image_field', '1'),
('ads_partners_form', 'ads_partners_intro', '1'),
('ads_partners_form', 'ads_partners_content', '1'),
('ads_partners_form', 'ads_partners_seo_option', '1'),
('ads_pages_list', 'ads_pages_index', '1'),
('ads_pages_list', 'ads_pages_id', '1'),
('ads_pages_list', 'ads_pages_image_field', '1'),
('ads_pages_list', 'ads_pages_title', '1'),
('ads_pages_list', 'ads_pages_category_list', '0'),
('ads_pages_list', 'ads_pages_status', '1'),
('ads_pages_list', 'ads_pages_postdate', '1'),
('ads_pages_form', 'ads_pages_status', '1'),
('ads_pages_form', 'ads_pages_category_list', '0'),
('ads_pages_form', 'ads_pages_index', '1'),
('ads_pages_form', 'ads_pages_image_field', '1'),
('ads_pages_form', 'ads_pages_intro', '1'),
('ads_pages_form', 'ads_pages_content', '1'),
('ads_pages_form', 'ads_pages_seo_option', '1'),
('posts_posts_form', 'posts_posts_category_list_add_edit', '1'),
('locations_pages_list', 'locations_pages_index', '1'),
('locations_pages_list', 'locations_pages_id', '1'),
('locations_pages_list', 'locations_pages_image_field', '1'),
('locations_pages_list', 'locations_pages_title', '1'),
('locations_pages_list', 'locations_pages_category_list', '0'),
('locations_pages_list', 'locations_pages_status', '1'),
('locations_pages_list', 'locations_pages_postdate', '1'),
('posts__list', 'posts__index', '1'),
('posts__list', 'posts__id', '1'),
('posts__list', 'posts__image_field', '1'),
('posts__list', 'posts__title', '1'),
('posts__list', 'posts__category_list', '0'),
('posts__list', 'posts__status', '1'),
('posts__list', 'posts__postdate', '1'),
('posts__form', 'posts__status', '1'),
('posts__form', 'posts__category_list', '0'),
('posts__form', 'posts__index', '1'),
('posts__form', 'posts__code', '1'),
('posts__form', 'posts__image_field', '1'),
('posts__form', 'posts__intro', '1'),
('posts__form', 'posts__content', '1'),
('posts__form', 'posts__seo_option', '1'),
('posts_posts_form', 'posts_posts_location_list', '1'),
('supports_supporttypes_list', 'supports_supporttypes_index', '1'),
('supports_supporttypes_list', 'supports_supporttypes_id', '1'),
('supports_supporttypes_list', 'supports_supporttypes_image_field', '1'),
('supports_supporttypes_list', 'supports_supporttypes_title', '1'),
('supports_supporttypes_list', 'supports_supporttypes_category_list', '0'),
('supports_supporttypes_list', 'supports_supporttypes_status', '1'),
('supports_supporttypes_list', 'supports_supporttypes_postdate', '1'),
('faq_pages_list', 'faq_pages_index', '1'),
('faq_pages_list', 'faq_pages_id', '1'),
('faq_pages_list', 'faq_pages_image_field', '1'),
('faq_pages_list', 'faq_pages_title', '1'),
('faq_pages_list', 'faq_pages_category_list', '0'),
('faq_pages_list', 'faq_pages_status', '1'),
('faq_pages_list', 'faq_pages_postdate', '1'),
('faq_pages_form', 'faq_pages_status', '1'),
('faq_pages_form', 'faq_pages_category_list', '0'),
('faq_pages_form', 'faq_pages_index', '1'),
('faq_pages_form', 'faq_pages_image_field', '1'),
('faq_pages_form', 'faq_pages_intro', '1'),
('faq_pages_form', 'faq_pages_content', '1'),
('faq_pages_form', 'faq_pages_seo_option', '1'),
('faq', 'faq_pages_category_list', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_skin`
--

CREATE TABLE IF NOT EXISTS `vsf_skin` (
`skinId` int(10) unsigned NOT NULL,
  `skinTitle` varchar(255) NOT NULL,
  `skinIsAdmin` smallint(1) NOT NULL,
  `skinStatus` smallint(1) NOT NULL,
  `skinAuthorName` varchar(255) NOT NULL,
  `skinDefault` varchar(255) NOT NULL,
  `skinFolder` varchar(155) NOT NULL,
  `skinAuthorEmail` varchar(255) NOT NULL,
  `skinAuthorWebsite` varchar(255) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `vsf_skin`
--

INSERT INTO `vsf_skin` (`skinId`, `skinTitle`, `skinIsAdmin`, `skinStatus`, `skinAuthorName`, `skinDefault`, `skinFolder`, `skinAuthorEmail`, `skinAuthorWebsite`) VALUES
(1, 'VS User Finance', 0, 1, 'designer', '1', 'finance', 'info@vietsol.net', 'http://www.vietsol.net'),
(2, 'VS Admin Blue Old', 1, 1, 'designer', '0', 'blue', 'info@vietsol.net', 'http://www.vietsol.net'),
(3, 'VS Admin Green', 1, 0, 'Imdiu', '0', 'green', 'vanduc@vietsol.net', 'vietsol.net'),
(4, 'VS Admin Blue', 1, 0, 'Imdiu', '0', 'newblue', 'vanduc@vietsol.net', 'vietsol.net'),
(5, 'VS Admin Red', 1, 0, 'ceedos', '1', 'red', 'ceedos.vn@gmail.com', 'vietsol.net');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_slidebanner`
--

CREATE TABLE IF NOT EXISTS `vsf_slidebanner` (
`id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `index` int(11) NOT NULL,
  `video` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Dumping data for table `vsf_slidebanner`
--

INSERT INTO `vsf_slidebanner` (`id`, `catId`, `title`, `intro`, `content`, `website`, `image`, `position`, `status`, `index`, `video`) VALUES
(51, 0, 'dszfdsfsdf', '', '', '', 0, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_statistic`
--

CREATE TABLE IF NOT EXISTS `vsf_statistic` (
`id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `operating` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `during` int(11) NOT NULL,
  `session` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `vsf_statistic`
--

INSERT INTO `vsf_statistic` (`id`, `time`, `ip`, `operating`, `browser`, `source`, `during`, `session`, `usertype`) VALUES
(1, 1380712537, '127.0.0.1', 'Win7', 'Firefox', '', 0, '', ''),
(2, 1380712660, '127.0.0.1', 'Win7', 'Firefox', '', 0, '', ''),
(3, 1380712946, '127.0.0.1', 'Win7', 'Firefox', '', 0, '', ''),
(4, 1380712957, '127.0.0.1', 'Win7', 'Firefox', '', 0, '', ''),
(5, 1380712996, '127.0.0.1', 'Win7', 'Firefox', '', 0, '', ''),
(6, 1380713028, '127.0.0.1', 'Win7', 'Firefox', '', 0, '', ''),
(7, 1380714043, '127.0.0.1', 'Win7', 'Firefox', '', 0, 'ana_524c063b6c6f1', ''),
(8, 1380714102, '127.0.0.1', 'Win7', 'Chrome', '', 0, 'ana_524c067623cd6', ''),
(9, 1380714118, '127.0.0.1', 'Win7', 'Chrome', '', 0, 'ana_524c06860fcdf', ''),
(10, 1380714395, '127.0.0.1', 'Win7', 'Firefox', 'http://localhost/vsf51/', 0, 'ana_524c079bcbc3d', ''),
(11, 1380714402, '127.0.0.1', 'Win7', 'Firefox', 'http://localhost/vsf51/', 0, 'ana_524c07a2d5f47', ''),
(12, 1380714419, '127.0.0.1', 'Win7', 'Firefox', 'http://localhost/vsf51/projealdskfj', 0, 'ana_524c07b3e087f', ''),
(13, 1380813599, '127.0.0.1', 'Win7', 'Firefox', '', 0, 'ana_524d8b1fc6284', ''),
(14, 1380813701, '127.0.0.1', 'Win7', 'Firefox', '', 0, 'ana_524d8b85eeb7d', ''),
(15, 1380813703, '127.0.0.1', 'Win7', 'Firefox', '', 0, 'ana_524d8b877ddfe', ''),
(16, 1381474120, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_52579f48ba8fb', ''),
(17, 1381474305, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_5257a0019cced', ''),
(18, 1381474315, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_5257a00bc36be', ''),
(19, 1381474369, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_5257a041464e4', ''),
(20, 1381474381, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_5257a04ddbc1a', ''),
(21, 1381474389, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_5257a055d93d0', ''),
(22, 1381475209, '127.0.0.1', 'unknown', 'Default Browser', '', 0, 'ana_5257a3897b656', ''),
(29, 1381480173, '127.0.0.1', 'Win7', 'Firefox', '', 0, 'ana_5257b6ed3ec99', ''),
(30, 1381480185, '127.0.0.1', 'Win7', 'Firefox', '', 0, 'ana_5257b6f9b568b', ''),
(31, 1381719514, '115.79.39.164', '', '', '', 0, 'ana_525b5dda7bd56', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_support`
--

CREATE TABLE IF NOT EXISTS `vsf_support` (
`id` int(11) NOT NULL,
  `nickName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `skype` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `index` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `catId` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `vsf_support`
--

INSERT INTO `vsf_support` (`id`, `nickName`, `phone`, `email`, `yahoo`, `skype`, `title`, `index`, `type`, `status`, `catId`) VALUES
(8, '', '0934 179 294', 'dongmai@vietsol.net', 'tinhco100', '', 'Mai Văn Đông', 0, '', 1, NULL),
(9, '', '0909 805 872', '', 'thientinh_su45', 'an.mai90', 'Sales 2', 0, 'phone', 2, 10),
(10, 'an.mai90', '+84 0933076416', 'kimsa41@gmail.com', 'thien.trantu', 'tran.tu.thien', 'Nguyễn Thị Kim Sa', 1, '', 1, 171),
(12, '', '+84 0903750251', 'hoatuoidian@gmail.com', 'thien.trantu', 'tran.tu.thien', 'Trần Từ Thiện', 0, '', 1, 171),
(13, '', '0909391144', 'dichvutrangtri@gmail.com', 'dichvutrangtri', 'dichvutrangtri', 'Sales1', 0, 'skype', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_supporttype`
--

CREATE TABLE IF NOT EXISTS `vsf_supporttype` (
`id` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `offImage` int(11) NOT NULL,
  `onImage` int(11) NOT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `vsf_supporttype`
--

INSERT INTO `vsf_supporttype` (`id`, `title`, `path`, `offImage`, `onImage`, `code`) VALUES
(5, 'Yahoo', 'ymsgr:sendIM?{nickname}', 148, 147, 'yahoo'),
(6, 'Skype', 'skype:{nickname}?chat', 146, 145, 'skype'),
(7, 'Phone', '', 0, 0, 'phone');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_tag`
--

CREATE TABLE IF NOT EXISTS `vsf_tag` (
`id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `trimText` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `postDate` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=99 ;

--
-- Dumping data for table `vsf_tag`
--

INSERT INTO `vsf_tag` (`id`, `title`, `trimText`, `postDate`, `count`) VALUES
(94, 'hoa cuoi', 'hoa cuoi', 1387855207, 1),
(95, 'hoa chia buồn', 'hoa chia buon', 1389603953, 2),
(96, 'hoa tươi', 'hoa tuoi', 1389603953, 11),
(97, 'hoa sinh nhật', 'hoa sinh nhat', 1389604450, 2),
(98, 'hoa khai truong', 'hoa khai truong', 1390298364, 9);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_tagcontent`
--

CREATE TABLE IF NOT EXISTS `vsf_tagcontent` (
  `tagId` int(11) NOT NULL,
  `module` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `contentId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vsf_tagcontent`
--

INSERT INTO `vsf_tagcontent` (`tagId`, `module`, `contentId`) VALUES
(87, 'posts', 11),
(90, 'posts', 26),
(91, 'posts', 26),
(92, 'posts', 28),
(94, 'products', 91),
(95, 'products', 127),
(96, 'products', 127),
(95, 'products', 128),
(96, 'products', 129),
(97, 'products', 129),
(97, 'products', 136),
(98, 'products', 137),
(96, 'products', 137),
(98, 'products', 138),
(96, 'products', 138),
(98, 'products', 139),
(96, 'products', 139),
(98, 'products', 140),
(96, 'products', 140),
(98, 'products', 141),
(96, 'products', 141),
(98, 'products', 142),
(96, 'products', 142),
(98, 'products', 143),
(96, 'products', 143),
(98, 'products', 144),
(96, 'products', 144),
(98, 'products', 145),
(96, 'products', 145);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user`
--

CREATE TABLE IF NOT EXISTS `vsf_user` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_code` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(64) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `location` int(11) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `joinDate` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vsf_user`
--

INSERT INTO `vsf_user` (`id`, `name`, `password`, `group_code`, `email`, `website`, `fullname`, `address`, `city`, `location`, `zipcode`, `lastLogin`, `joinDate`, `status`) VALUES
(8, 'pandog', '99855dc40d4a0a81b83293783165a10c', 1, 'yunhaihuang@gmail.com', 'pandog.net', 'pandog nail', '5812 Yadkin Rd', 'Adamsville', 570, '90005', '0000-00-00 00:00:00', '2014-09-02 21:51:43', 1),
(9, 'vip', '232059cb5361a9336ccf1b8c2ba7657a', 2, 'dongmai@vietsol.net', 'dongmai.net', 'pandog nail', 'Road #6', 'Adamsville', 769, '90005', '0000-00-00 00:00:00', '2014-09-02 21:51:43', 1),
(10, 'normal', 'fea087517c26fadd409bd4b9dc642555', 2, 'normal@vietsol.net', 'normal.net', 'normal nail', 'Road #6', 'Adamsville', 769, '90005', '0000-00-00 00:00:00', '2014-09-02 21:51:43', 1),
(11, '0912256242', 'c16b0858ea9756b3ad5b6076178d634e', 1, 'yunhaihuang@gmail.com', '0912256242', '0912256242', '0912256242', '0912256242', 570, '0912256242', '0000-00-00 00:00:00', '2014-09-27 12:12:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_usergroup`
--

CREATE TABLE IF NOT EXISTS `vsf_usergroup` (
`groupId` smallint(4) unsigned NOT NULL,
  `groupTitle` varchar(64) NOT NULL DEFAULT '',
  `groupIntro` text NOT NULL,
  `groupPermission` text NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_usergroup`
--

INSERT INTO `vsf_usergroup` (`groupId`, `groupTitle`, `groupIntro`, `groupPermission`) VALUES
(1, 'Giám ??c', 'chi tiet', ''),
(2, 'Tr??ng phòng', 'chi tiet', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_group`
--

CREATE TABLE IF NOT EXISTS `vsf_user_group` (
  `objectId` varchar(56) NOT NULL,
  `relId` varchar(56) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vsf_user_group`
--

INSERT INTO `vsf_user_group` (`objectId`, `relId`) VALUES
('1', '1'),
('2', '1'),
('3', '1'),
('4', '1'),
('5', '1'),
('6', '1'),
('7', '1'),
('8', '1'),
('9', '1'),
('10', '1'),
('11', '1'),
('12', '1'),
('13', '1'),
('14', '1'),
('15', '1'),
('16', '1'),
('17', '1'),
('18', '1'),
('19', '1'),
('20', '1'),
('21', '1'),
('22', '1'),
('23', '1'),
('24', '1'),
('25', '1'),
('26', '1'),
('27', '1'),
('28', '1'),
('29', '1'),
('30', '1'),
('31', '1'),
('32', '1'),
('33', '1'),
('34', '1'),
('35', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_session`
--

CREATE TABLE IF NOT EXISTS `vsf_user_session` (
  `sessionCode` varchar(64) NOT NULL,
  `userId` int(11) NOT NULL,
  `userStatus` tinyint(1) NOT NULL,
  `sessionTime` int(10) NOT NULL,
`sessionId` int(32) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6946 ;

--
-- Dumping data for table `vsf_user_session`
--

INSERT INTO `vsf_user_session` (`sessionCode`, `userId`, `userStatus`, `sessionTime`, `sessionId`) VALUES
('46956fcad853dc8b944f85fae4b8b474', 0, 0, 1331264461, 6942),
('f770b6bb6a7f587c10b78849556b656d', 0, 0, 1331264503, 6943),
('3df7e156593c7bb0dffae2b9bca0e122', 0, 0, 1331264456, 6941),
('8c77eefc4f18714525a9478d1d6e25ff', 0, 0, 1331264448, 6939),
('bbb3e2c5d9093a8f9c36976f17dda57c', 0, 0, 1331264452, 6940),
('7161571507adb55e61b604fac1bf31ac', 0, 0, 1331264534, 6945),
('49b76d0732f1346f060bd1b6feb5e36f', 0, 0, 1331264508, 6944),
('47f6f32f051d261cb8cb84e1d155b393', 0, 0, 1331262046, 6935),
('af14e8c0624cdfc76475749f352b02d8', 0, 0, 1331262028, 6934),
('ee3a660eecee4ce22c3630e439130fb2', 0, 0, 1331264405, 6938),
('8d5fd233cd3a1b70693273232e00e2aa', 0, 0, 1331263592, 6937),
('a63cddc0130598866756a1f02ed93d0a', 0, 0, 1331263433, 6936);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_util_exchange`
--

CREATE TABLE IF NOT EXISTS `vsf_util_exchange` (
`exchangeId` tinyint(10) NOT NULL,
  `exchangeCode` varchar(3) NOT NULL,
  `exchangeName` varchar(16) NOT NULL,
  `exchangeBuy` double NOT NULL,
  `exchangeTranfer` double NOT NULL,
  `exchangeSell` double NOT NULL,
  `exchangeGetTime` int(10) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `vsf_util_exchange`
--

INSERT INTO `vsf_util_exchange` (`exchangeId`, `exchangeCode`, `exchangeName`, `exchangeBuy`, `exchangeTranfer`, `exchangeSell`, `exchangeGetTime`) VALUES
(1, 'AUD', 'AUST.DOLLAR', 19711.06, 19830.04, 20148.64, 1288577043),
(2, 'CAD', 'CANADIAN DOLLAR', 19626.51, 19804.75, 20082.74, 1288577043),
(3, 'CHF', 'SWISS FRANCE', 20318.94, 20462.18, 20790.94, 1288577043),
(4, 'DKK', 'DANISH KRONE', 0, 3767.8, 3843.68, 1288577043),
(5, 'EUR', 'EURO', 28077.01, 28161.49, 28556.78, 1288577043),
(6, 'GBP', 'BRITISH POUND', 32138.08, 32364.63, 32818.92, 1288577043),
(7, 'HKD', 'HONGKONG DOLLAR', 2583.56, 2601.77, 2638.29, 1288577043),
(8, 'INR', 'INDIAN RUPEE', 0, 449.3, 469.48, 1288577043),
(9, 'JPY', 'JAPANESE YEN', 247.58, 250.08, 254.1, 1288577043),
(10, 'KRW', 'SOUTH KOREAN WON', 0, 16.47, 20.21, 1288577043),
(11, 'KWD', 'KUWAITI DINAR', 0, 71650.51, 73386.49, 1288577043),
(12, 'MYR', 'MALAYSIAN RINGGI', 0, 6497.29, 6628.15, 1288577043),
(13, 'NOK', 'NORWEGIAN KRONER', 0, 3444.35, 3513.71, 1288577043),
(14, 'RUB', 'RUSSIAN RUBLE', 0, 597.45, 733.1, 1288577043),
(15, 'SEK', 'SWEDISH KRONA', 0, 3035.34, 3096.47, 1288577043),
(16, 'SGD', 'SINGAPORE DOLLAR', 15499.12, 15608.38, 15827.47, 1288577043),
(17, 'THB', 'THAI BAHT', 665.08, 665.08, 694.96, 1288577043),
(18, 'USD', 'US DOLLAR', 19495, 19495, 19500, 1288577043);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_util_weather`
--

CREATE TABLE IF NOT EXISTS `vsf_util_weather` (
`weatherId` tinyint(16) NOT NULL,
  `weatherCityCode` varchar(6) NOT NULL,
  `weatherCity` varchar(64) NOT NULL,
  `weatherTemp` varchar(3) NOT NULL,
  `weatherDesc` varchar(512) NOT NULL,
  `weatherImage` varchar(128) NOT NULL,
  `weatherGetTime` int(10) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `vsf_util_weather`
--

INSERT INTO `vsf_util_weather` (`weatherId`, `weatherCityCode`, `weatherCity`, `weatherTemp`, `weatherDesc`, `weatherImage`, `weatherGetTime`) VALUES
(1, 'Sonla', 'S?n La', '9', '<b>Ít mây</b><br>&#272;&#7897; &#7849;m 98%<br>L?ng gió', 'http://vnexpress.net/Images/Weather/i_troinang.gif', 1288577043),
(2, 'Haipho', 'H?i Phòng', '16', '<b>Ít mây</b><br>&#272;&#7897; &#7849;m 81%<br>Gió b?c<br>t?c ?? 2 m/s', 'http://vnexpress.net/Images/Weather/i_troinang.gif', 1288577043),
(3, 'Hanoi', 'Hà Nôi', '16', '<b>Ít mây</b><br>&#272;&#7897; &#7849;m 85%<br>L?ng gió', 'http://vnexpress.net/Images/Weather/i_troinang.gif', 1288577043),
(4, 'Vinh', 'Vinh', '16', '<b>Nhi?u mây</b><br>&#272;&#7897; &#7849;m 83%<br>Gió tây tây nam<br>t?c ?? 1 m/s', 'http://vnexpress.net/Images/Weather/i_nhieumay.gif', 1288577043),
(5, 'Danang', '?à N?ng', '22', '<b>Có m?a</b><br>&#272;&#7897; &#7849;m 95%<br>Gió b?c<br>t?c ?? 1 m/s', 'http://vnexpress.net/Images/Weather/coluccomua.gif', 1288577043),
(6, 'Nhatra', 'Nha Trang', '25', '<b>Không m?a</b><br>&#272;&#7897; &#7849;m 89%<br>Gió ?ông b?c<br>t?c ?? 7 m/s', 'http://vnexpress.net/Images/Weather/i_nhieumay.gif', 1288577043),
(7, 'Pleicu', 'Pleiku', '21', '<b>Nhi?u mây</b><br>&#272;&#7897; &#7849;m 80%<br>Gió ?ông b?c<br>t?c ?? 5 m/s', 'http://vnexpress.net/Images/Weather/i_nhieumay.gif', 1288577043),
(8, 'HCM', 'Tp. H? Chí Minh', '22', '<b>Có m?a</b><br>&#272;&#7897; &#7849;m 98%<br>Gió b?c ?ông b?c<br>t?c ?? 4 m/s', 'http://vnexpress.net/Images/Weather/coluccomua.gif', 1288577043);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_video`
--

CREATE TABLE IF NOT EXISTS `vsf_video` (
`id` int(10) unsigned NOT NULL,
  `catId` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `clip` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postDate` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `index` tinyint(4) NOT NULL DEFAULT '0',
  `code` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mKeyWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mIntro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=214 ;

--
-- Dumping data for table `vsf_video`
--

INSERT INTO `vsf_video` (`id`, `catId`, `title`, `intro`, `image`, `clip`, `content`, `postDate`, `status`, `index`, `code`, `module`, `mTitle`, `mKeyWord`, `mIntro`, `mUrl`) VALUES
(205, 480, 'Aston Villa 1-2 Arsenal: Trở lại ngôi đầu', 'Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.\r\nJack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.\r\nJack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.', '3432', 3434, '', 1392691768, 2, 0, '', 'videos', '', '', '', 'aston-villa-1-2-arsenal-tro-lai-ngoi-dau'),
(206, 480, 'MU 1-2 Arsenal: Trở lại ngôi đầu', 'Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.\r\nJack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.\r\nJack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.', '3435', 3436, '', 1392693081, 2, 0, '', 'videos', '', '', '', 'mu-1-2-arsenal-tro-lai-ngoi-dau'),
(207, 480, 'Chel 1-2 Arsenal: Trở lại ngôi đầu', 'Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.\r\nJack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.\r\nJack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.Jack Wilshere và Giroud ghi bàn giúp Pháo thủ giành lại ngôi đầu từ Man City.', '3437', 3439, '', 1392693132, 2, 0, '', 'videos', '', '', '', 'chel-1-2-arsenal-tro-lai-ngoi-dau'),
(208, 480, 'Liverpool 1-2 Arsenal: Trở lại ngôi đầu', '', '3440', 0, '', 1392709426, 2, 0, '', 'videos', '', '', '', 'liverpool-1-2-arsenal-tro-lai-ngoi-dau'),
(209, 480, 'Evertonl 1-2 Arsenal: Trở lại ngôi đầu', '', '3441', 0, '', 1392709445, 2, 0, '', 'videos', '', '', '', ''),
(210, 480, 'Newcas 1-2 Arsenal: Trở lại ngôi đầu', '', '3442', 0, '', 1392709523, 2, 0, '', 'videos', '', '', '', ''),
(211, 480, 'ManC 1-2 Arsenal: Trở lại ngôi đầu', '', '3443', 0, '', 1392709571, 2, 0, '', 'videos', '', '', '', ''),
(212, 480, 'Cafri 1-2 Arsenal: Trở lại ngôi đầu', '', '3447', 3446, '', 1392709654, 2, 0, '', 'videos', '', '', '', 'cafri-1-2-arsenal-tro-lai-ngoi-dau'),
(213, 137, 'Video  gcfbhfgbh', '', NULL, 3488, '', 1395570929, 1, 0, 'nCjsWpM9zFU', 'videos', '', '', '', 'video');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_widget`
--

CREATE TABLE IF NOT EXISTS `vsf_widget` (
`id` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `instant` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `index` int(11) NOT NULL,
  `option` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `vsf_widget`
--

INSERT INTO `vsf_widget` (`id`, `title`, `instant`, `position`, `index`, `option`, `status`) VALUES
(7, 'link', 'weblink', 'LEFT', 4, 'a:2:{s:5:"title";s:10:"gì đó 1";s:5:"limit";s:1:"5";}', 1),
(8, 'link', 'text', 'LEFT', 1, 'a:2:{s:7:"content";s:21:"kkkkkkkkkkkkkkkkkkkkk";s:5:"title";s:11:"Text 1 left";}', 1),
(6, 'link', 'weblink', 'LEFT', 2, 'a:1:{s:5:"title";s:7:"Right 1";}', 1),
(9, ';l;akjfl;kjfl;akjdfl;j', 'text', 'LEFT', 6, 'a:2:{s:5:"title";s:6:"text 1";s:7:"content";s:142:"text 1text 1\r\ntext 1text 1text 1text 1text 1text 1text\r\n 1text 1text 1text 1text 1text 1text 1text 1text 1text 1text 1text 1text 1text 1text 1";}', 1),
(10, 'gì đó', 'text', 'LEFT', 3, 'a:2:{s:5:"title";s:8:"Gì đó";s:7:"content";s:0:"";}', 1),
(12, 'kJHFKJHSDKFH KHDSFKJH', 'text', 'BOTTOM', 0, 'a:2:{s:5:"title";s:8:"Gì đó";s:7:"content";s:332:"Ông Nguyễn Trọng Hỷ cho biết thái độ thi đấu thiếu tôn trọng khán giả của cầu thủ buộc ban huấn luyện đội U23 Việt Nam phải chịu trách nhiệm.\r\n\r\n    HLV Hoàng Văn Phúc mất ghế sau trận hòa bất thường\r\n    U23 Việt Nam bị chia điểm sau khi dẫn trước hai bàn";}', 1),
(13, 'Danh mục', 'productcategories', 'LEFT', 5, 'a:3:{s:5:"title";s:23:"Danh mục sản phẩm";s:5:"limit";s:1:"3";s:3:"ten";s:13:"tên gì đó";}', 1),
(14, 'test 3', 'productcategories', 'LEFT', 0, '', 1),
(15, 'test 3', 'text', 'LEFT', 0, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vsf_acp_help`
--
ALTER TABLE `vsf_acp_help`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_admin`
--
ALTER TABLE `vsf_admin`
 ADD PRIMARY KEY (`id`), ADD KEY `Name` (`name`);

--
-- Indexes for table `vsf_admingroup`
--
ALTER TABLE `vsf_admingroup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_admin_session`
--
ALTER TABLE `vsf_admin_session`
 ADD PRIMARY KEY (`sessionId`), ADD KEY `LoginSession` (`sessionCode`);

--
-- Indexes for table `vsf_banner`
--
ALTER TABLE `vsf_banner`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_bannerpo`
--
ALTER TABLE `vsf_bannerpo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `vsf_comment`
--
ALTER TABLE `vsf_comment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_components`
--
ALTER TABLE `vsf_components`
 ADD PRIMARY KEY (`comId`);

--
-- Indexes for table `vsf_config`
--
ALTER TABLE `vsf_config`
 ADD PRIMARY KEY (`id`), ADD KEY `Title` (`title`), ADD KEY `mUrl` (`mUrl`), ADD FULLTEXT KEY `Content` (`content`), ADD FULLTEXT KEY `title_2` (`title`);

--
-- Indexes for table `vsf_contact`
--
ALTER TABLE `vsf_contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_counter`
--
ALTER TABLE `vsf_counter`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_counter_log`
--
ALTER TABLE `vsf_counter_log`
 ADD UNIQUE KEY `time` (`time`);

--
-- Indexes for table `vsf_file`
--
ALTER TABLE `vsf_file`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_file_type`
--
ALTER TABLE `vsf_file_type`
 ADD PRIMARY KEY (`fileTypeId`);

--
-- Indexes for table `vsf_gallery`
--
ALTER TABLE `vsf_gallery`
 ADD PRIMARY KEY (`id`), ADD KEY `code` (`code`);

--
-- Indexes for table `vsf_gallery_file_rel`
--
ALTER TABLE `vsf_gallery_file_rel`
 ADD KEY `galleryId` (`galleryId`);

--
-- Indexes for table `vsf_helper`
--
ALTER TABLE `vsf_helper`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_lang`
--
ALTER TABLE `vsf_lang`
 ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `en` (`en`,`vi`);

--
-- Indexes for table `vsf_langs`
--
ALTER TABLE `vsf_langs`
 ADD PRIMARY KEY (`id`), ADD KEY `langDefault` (`userDefault`,`adminDefault`);

--
-- Indexes for table `vsf_logo`
--
ALTER TABLE `vsf_logo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_menu`
--
ALTER TABLE `vsf_menu`
 ADD PRIMARY KEY (`menuId`);

--
-- Indexes for table `vsf_module`
--
ALTER TABLE `vsf_module`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `moduleClass_2` (`class`), ADD KEY `moduleClass` (`class`);

--
-- Indexes for table `vsf_notification`
--
ALTER TABLE `vsf_notification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_notify`
--
ALTER TABLE `vsf_notify`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_notify_viewstatus`
--
ALTER TABLE `vsf_notify_viewstatus`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_order`
--
ALTER TABLE `vsf_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_order_item`
--
ALTER TABLE `vsf_order_item`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_page`
--
ALTER TABLE `vsf_page`
 ADD PRIMARY KEY (`id`), ADD KEY `Title` (`title`), ADD KEY `mUrl` (`mUrl`), ADD FULLTEXT KEY `Content` (`content`), ADD FULLTEXT KEY `title_2` (`title`);

--
-- Indexes for table `vsf_partner`
--
ALTER TABLE `vsf_partner`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_pcontact`
--
ALTER TABLE `vsf_pcontact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_post`
--
ALTER TABLE `vsf_post`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `vsf_postposition`
--
ALTER TABLE `vsf_postposition`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_product`
--
ALTER TABLE `vsf_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_productlabel`
--
ALTER TABLE `vsf_productlabel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_seo`
--
ALTER TABLE `vsf_seo`
 ADD PRIMARY KEY (`id`), ADD KEY `flag` (`flag`);

--
-- Indexes for table `vsf_setting`
--
ALTER TABLE `vsf_setting`
 ADD PRIMARY KEY (`id`), ADD KEY `SKey` (`key`);

--
-- Indexes for table `vsf_setting_group`
--
ALTER TABLE `vsf_setting_group`
 ADD PRIMARY KEY (`group`,`key`), ADD KEY `group` (`group`), ADD KEY `key` (`key`);

--
-- Indexes for table `vsf_skin`
--
ALTER TABLE `vsf_skin`
 ADD PRIMARY KEY (`skinId`);

--
-- Indexes for table `vsf_slidebanner`
--
ALTER TABLE `vsf_slidebanner`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_statistic`
--
ALTER TABLE `vsf_statistic`
 ADD PRIMARY KEY (`id`), ADD KEY `time` (`time`);

--
-- Indexes for table `vsf_support`
--
ALTER TABLE `vsf_support`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_supporttype`
--
ALTER TABLE `vsf_supporttype`
 ADD PRIMARY KEY (`id`), ADD KEY `code` (`code`);

--
-- Indexes for table `vsf_tag`
--
ALTER TABLE `vsf_tag`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `trimText` (`trimText`);

--
-- Indexes for table `vsf_user`
--
ALTER TABLE `vsf_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vsf_usergroup`
--
ALTER TABLE `vsf_usergroup`
 ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `vsf_user_session`
--
ALTER TABLE `vsf_user_session`
 ADD PRIMARY KEY (`sessionId`);

--
-- Indexes for table `vsf_util_exchange`
--
ALTER TABLE `vsf_util_exchange`
 ADD PRIMARY KEY (`exchangeId`);

--
-- Indexes for table `vsf_util_weather`
--
ALTER TABLE `vsf_util_weather`
 ADD PRIMARY KEY (`weatherId`);

--
-- Indexes for table `vsf_video`
--
ALTER TABLE `vsf_video`
 ADD PRIMARY KEY (`id`), ADD KEY `Title` (`title`), ADD KEY `mUrl` (`mUrl`), ADD FULLTEXT KEY `Content` (`content`), ADD FULLTEXT KEY `title_2` (`title`);

--
-- Indexes for table `vsf_widget`
--
ALTER TABLE `vsf_widget`
 ADD PRIMARY KEY (`id`), ADD KEY `position` (`position`(333));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vsf_acp_help`
--
ALTER TABLE `vsf_acp_help`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vsf_admin`
--
ALTER TABLE `vsf_admin`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `vsf_admingroup`
--
ALTER TABLE `vsf_admingroup`
MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vsf_admin_session`
--
ALTER TABLE `vsf_admin_session`
MODIFY `sessionId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5663;
--
-- AUTO_INCREMENT for table `vsf_banner`
--
ALTER TABLE `vsf_banner`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `vsf_bannerpo`
--
ALTER TABLE `vsf_bannerpo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vsf_comment`
--
ALTER TABLE `vsf_comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `vsf_components`
--
ALTER TABLE `vsf_components`
MODIFY `comId` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vsf_config`
--
ALTER TABLE `vsf_config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `vsf_contact`
--
ALTER TABLE `vsf_contact`
MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vsf_counter`
--
ALTER TABLE `vsf_counter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `vsf_file`
--
ALTER TABLE `vsf_file`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3752;
--
-- AUTO_INCREMENT for table `vsf_file_type`
--
ALTER TABLE `vsf_file_type`
MODIFY `fileTypeId` smallint(4) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vsf_gallery`
--
ALTER TABLE `vsf_gallery`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vsf_helper`
--
ALTER TABLE `vsf_helper`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vsf_lang`
--
ALTER TABLE `vsf_lang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=881;
--
-- AUTO_INCREMENT for table `vsf_langs`
--
ALTER TABLE `vsf_langs`
MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vsf_logo`
--
ALTER TABLE `vsf_logo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `vsf_menu`
--
ALTER TABLE `vsf_menu`
MODIFY `menuId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1122;
--
-- AUTO_INCREMENT for table `vsf_module`
--
ALTER TABLE `vsf_module`
MODIFY `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=580;
--
-- AUTO_INCREMENT for table `vsf_notification`
--
ALTER TABLE `vsf_notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `vsf_notify`
--
ALTER TABLE `vsf_notify`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vsf_notify_viewstatus`
--
ALTER TABLE `vsf_notify_viewstatus`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vsf_order`
--
ALTER TABLE `vsf_order`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vsf_order_item`
--
ALTER TABLE `vsf_order_item`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `vsf_page`
--
ALTER TABLE `vsf_page`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=288;
--
-- AUTO_INCREMENT for table `vsf_partner`
--
ALTER TABLE `vsf_partner`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vsf_pcontact`
--
ALTER TABLE `vsf_pcontact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vsf_post`
--
ALTER TABLE `vsf_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `vsf_postposition`
--
ALTER TABLE `vsf_postposition`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vsf_product`
--
ALTER TABLE `vsf_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `vsf_productlabel`
--
ALTER TABLE `vsf_productlabel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vsf_seo`
--
ALTER TABLE `vsf_seo`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vsf_setting`
--
ALTER TABLE `vsf_setting`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2656;
--
-- AUTO_INCREMENT for table `vsf_skin`
--
ALTER TABLE `vsf_skin`
MODIFY `skinId` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vsf_slidebanner`
--
ALTER TABLE `vsf_slidebanner`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `vsf_statistic`
--
ALTER TABLE `vsf_statistic`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `vsf_support`
--
ALTER TABLE `vsf_support`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `vsf_supporttype`
--
ALTER TABLE `vsf_supporttype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `vsf_tag`
--
ALTER TABLE `vsf_tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `vsf_user`
--
ALTER TABLE `vsf_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vsf_usergroup`
--
ALTER TABLE `vsf_usergroup`
MODIFY `groupId` smallint(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vsf_user_session`
--
ALTER TABLE `vsf_user_session`
MODIFY `sessionId` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6946;
--
-- AUTO_INCREMENT for table `vsf_util_exchange`
--
ALTER TABLE `vsf_util_exchange`
MODIFY `exchangeId` tinyint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `vsf_util_weather`
--
ALTER TABLE `vsf_util_weather`
MODIFY `weatherId` tinyint(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `vsf_video`
--
ALTER TABLE `vsf_video`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=214;
--
-- AUTO_INCREMENT for table `vsf_widget`
--
ALTER TABLE `vsf_widget`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

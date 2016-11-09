-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2013 at 12:51 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin`
--

CREATE TABLE IF NOT EXISTS `vsf_admin` (
  `adminId` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `adminName` varchar(32) NOT NULL,
  `adminPassword` varchar(32) NOT NULL,
  `adminLastLogin` int(10) DEFAULT '0' COMMENT 'Last login time',
  `adminJoinDate` int(10) DEFAULT '0' COMMENT 'Created time',
  `adminStatus` tinyint(1) DEFAULT '1' COMMENT 'Lock or not',
  PRIMARY KEY (`adminId`),
  KEY `Name` (`adminName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_admin`
--

INSERT INTO `vsf_admin` (`adminId`, `adminName`, `adminPassword`, `adminLastLogin`, `adminJoinDate`, `adminStatus`) VALUES
(2, 'vanduc', 'efef06093ce1d35ae279a5076bd5cb5e', 1275535217, 1275449351, 1),
(1, 'vietsol', '4abcc5b120ba80ae490044676628a772', 1341289073, 1276139998, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admingroup`
--

CREATE TABLE IF NOT EXISTS `vsf_admingroup` (
  `groupId` smallint(4) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(64) NOT NULL DEFAULT '0',
  `groupIntro` varchar(255) NOT NULL DEFAULT '0',
  `groupPermission` text,
  PRIMARY KEY (`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_admingroup`
--

INSERT INTO `vsf_admingroup` (`groupId`, `groupName`, `groupIntro`, `groupPermission`) VALUES
(1, 'Root', 'NhÃ³m root', 'a:12:{s:18:"admins/deleteadmin";b:1;s:16:"admins/editadmin";b:1;s:24:"admins/displayadmintable";b:1;s:19:"admins/addeditadmin";b:1;s:19:"admins/displayadmin";b:1;s:18:"admins/deletegroup";b:1;s:16:"admins/editgroup";b:1;s:24:"admins/displaygrouptable";b:1;s:19:"admins/addeditgroup";b:1;s:19:"admins/displaygroup";b:1;s:17:"admins/permission";b:1;s:14:"admins/default";b:1;}'),
(2, 'Normal Adminstrator', '', 'a:23:{s:18:"admins/deleteadmin";b:1;s:16:"admins/editadmin";b:1;s:24:"admins/displayadmintable";b:1;s:19:"admins/addeditadmin";b:1;s:19:"admins/displayadmin";b:1;s:14:"admins/default";b:1;s:23:"users/delete-user-group";b:1;s:16:"users/edit-group";b:1;s:24:"users/display-list-group";b:1;s:15:"users/add-group";b:1;s:23:"users/display-group-tab";b:1;s:20:"users/savepermission";b:1;s:19:"users/getpermission";b:1;s:16:"users/permission";b:1;s:19:"users/edit-obj-form";b:1;s:18:"users/add-obj-form";b:1;s:22:"users/hide-checked-obj";b:1;s:25:"users/visible-checked-obj";b:1;s:18:"users/add-edit-obj";b:1;s:22:"users/display-obj-list";b:1;s:21:"users/display-obj-tab";b:1;s:13:"users/default";b:1;s:17:"users/deleteadmin";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin_group`
--

CREATE TABLE IF NOT EXISTS `vsf_admin_group` (
  `objectId` varchar(56) NOT NULL,
  `relId` varchar(56) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vsf_admin_group`
--

INSERT INTO `vsf_admin_group` (`objectId`, `relId`) VALUES
('1', '1'),
('1', '2'),
('2', '2'),
('4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_admin_session`
--

CREATE TABLE IF NOT EXISTS `vsf_admin_session` (
  `sessionId` int(11) NOT NULL AUTO_INCREMENT,
  `adminId` int(11) NOT NULL,
  `sessionCode` varchar(32) NOT NULL,
  `sessionTime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sessionId`),
  KEY `LoginSession` (`sessionCode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `vsf_admin_session`
--

INSERT INTO `vsf_admin_session` (`sessionId`, `adminId`, `sessionCode`, `sessionTime`) VALUES
(117, 1, '44045d1e3e54f94c6e625422dbf91779', 1341289553);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_article`
--

CREATE TABLE IF NOT EXISTS `vsf_article` (
  `articleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleCatId` int(10) NOT NULL DEFAULT '0',
  `articleTitle` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `articleIntro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `articleImage` int(10) DEFAULT NULL,
  `articleContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `articlePostDate` int(10) NOT NULL DEFAULT '0',
  `articleTime` int(10) NOT NULL DEFAULT '0',
  `articleStatus` tinyint(4) NOT NULL DEFAULT '0',
  `articleIndex` tinyint(4) NOT NULL DEFAULT '0',
  `articleCode` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`articleId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `vsf_article`
--

INSERT INTO `vsf_article` (`articleId`, `articleCatId`, `articleTitle`, `articleIntro`, `articleImage`, `articleContent`, `articlePostDate`, `articleTime`, `articleStatus`, `articleIndex`, `articleCode`) VALUES
(3, 1042, 'News - Are Comments Important to Your B2B Blogâ€™s Success?', '&lt;p&gt;I went against everything I know as a social SEO person a few weeks ago.  It may be a cardinal sin of social media marketing and blogging, but I  decided to close the comments on my companyâ€™s internet marketing blog.&lt;/p&gt;', NULL, '&lt;p&gt;I went against everything I know as a social SEO person a few weeks ago.  It may be a cardinal sin of social media marketing and blogging, but I  decided to close the comments on my companyâ€™s &lt;a href=&quot;http://www.brickmarketing.com/blog/&quot; target=&quot;_blank&quot;&gt;internet marketing blog&lt;/a&gt;.  I had been trying to find a way to better manage the commenting process  on that blog for a while. It had been getting so many spam comments  everyday (anywhere from several hundred a thousand), and even though  most of them were getting caught and filtered by the spam filter, I was  still manually sorting through the ones that snuck. Iâ€™d say that for  every 50 comments that I had to manually approve MAYBE 1 was a good  comment.Â  (forget about the 5,000 spam comments that were already caught  every day&#33;)&lt;/p&gt;', 1319536688, 1319587200, 1, 0, '0'),
(4, 1046, 'Events - Google Introduces â€œBid For Callsâ€ On The PC', '&lt;p&gt;Earlier this summer Google gave an&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;indication&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;this was coming. Now Google is rolling out what itâ€™s calling â€œbid for calls,â€ a pay per call (PPCall) offering on the PC. This is distinct from Click to Call, its successful mobile PPCall product. The program will launch in the US and UK at first and relies on the Call Metrics (Google Voice) infrastructure.&lt;/p&gt;', NULL, '&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;Earlier this summer Google gave an&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;&lt;a href=&quot;http://searchengineland.com/google-opens-up-call-metrics-plans-bid-for-calls-marketplace-online-86222&quot;&gt;indication&lt;/a&gt;&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;this was coming. Now Google is rolling out what itâ€™s calling â€œ&lt;a href=&quot;http://adwords.blogspot.com/2011/10/introducing-bid-per-call-in-adwords.html&quot;&gt;bid for calls&lt;/a&gt;,â€ a pay per call (PPCall) offering on the PC. This is distinct from Click to Call, its successful mobile PPCall product. The program will launch in the US and UK at first and relies on the Call Metrics (Google Voice) infrastructure.&lt;/p&gt;<br />&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;AdWords advertisers must use Call Metrics and a Google Voice-generated call tracking number to participate. But rather than just paying &#036;1 per completed call for call tracking, advertisers can now separately bid on calls.&lt;/p&gt;<br />&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;In the near future, depending on the amount of bids and how many calls are received, Google will begin to include calls in its ads quality score. I spoke to Googleâ€™sÂ Surojit Chatterjee who told me advertisers that donâ€™t participate in bid for calls wonâ€™t be disadvantaged. But advertisers whose paid-search ads are generating lots of calls may see a boost in their AdWords rankings accordingly.&lt;/p&gt;<br />&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;In other words, â€œcall-through rateâ€ will now be a factor in ranking. To participate in bid for calls advertisers enable Call Extensions and Call Metrics:&lt;/p&gt;<br />&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;Last year when Googleâ€™s call tracking program â€œ&lt;a href=&quot;http://adwords.blogspot.com/2011/07/now-all-us-and-canada-advertisers-can.html&quot;&gt;Call Metrics&lt;/a&gt;â€ was first introduced I&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;&lt;a href=&quot;http://www.screenwerk.com/2010/11/02/free-call-tracking-comes-to-adwords-ppcall-not-far-behind/&quot;&gt;suspected&lt;/a&gt;PPCall wouldnâ€™t be far behind. Google experimented with PPCall on the PC years ago but never rolled it out broadly.&lt;/p&gt;<br />&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;Despite its relatively low-key introduction this morning, this is a major development for Google and for AdWords advertisers. Being able to bid on calls separately as well as getting ranking â€œcreditâ€ for calls generated from Google ads will be significant for many advertisers (local and national) that operate call centers or have stores in the real world.&lt;/p&gt;', 1319597451, 1319760000, 1, 0, '0'),
(2, 1040, 'Google Removes The + Search Command pandog', '&lt;p&gt;Google has quietly removed one of the older search operators, the + search operator. Now if you try adding a + sign in your query, Google will ignore it.&lt;/p&gt;', NULL, '&lt;p&gt;Google has quietly removed one of the older &lt;a href=&quot;http://www.google.com/support/websearch/bin/answer.py?answer=136861&quot;&gt;search operators&lt;/a&gt;, the + search operator. Now if you try adding a + sign in your query, Google will ignore it.&lt;/p&gt;<br />&lt;p&gt;Why did Google remove the old search operator? Kelly from Google said in a &lt;a href=&quot;http://www.google.com/support/forum/p/Web%20Search/thread?tid=151ef6cf0a761b74&amp;amp;hl=en&quot;&gt;forum thread&lt;/a&gt; that you can now use the quotation marks operator instead of the + operator. She said:&lt;/p&gt;<br />&lt;blockquote&gt;Weâ€™ve made the ways you can tell Google exactly what you  want more consistent by expanding the functionality of the quotation  marks operator. In addition to using this operator to search for an  exact phrase, you can now add quotation marks around a single word to  tell Google to match that word precisely. So, if in the past you would  have searched for [magazine +latina], you should now search for  [magazine &quot;latina&quot;].&lt;/blockquote&gt;<br />&lt;p&gt;I am feeling Google removed the plus operator because of Google +,  their social network. They do not want Google + confused with the  operator, and now typing in + into Google + will auto complete with your  friendâ€™s names.&lt;/p&gt;<br />&lt;p&gt;I personally rarely used the plus operator, often using quotes instead. But I am personally sad to see it go.&lt;/p&gt;', 1319528011, 0, 1, 0, '0'),
(5, 1046, 'Microsoft Wants You to Search the Web Like Miley Cyrus', '&lt;p&gt;Microsoftâ€™s U.S. patent application, â€œApplying a Model of Persona to  Search Results,â€ outlines a search system that would allow users to  search the web as their favorite celebrity. Other possible uses for the  technology include searching based on a person or groups  characteristics, or even the preferences of a friend.&lt;/p&gt;<br />&lt;p&gt;Published October 13, the application paves the way for Microsoft to &lt;a href=&quot;http://appft1.uspto.gov/netacgi/nph-Parser?Sect1=PTO1&amp;amp;Sect2=HITOFF&amp;amp;d=PG01&amp;amp;p=1&amp;amp;u=%2Fnetahtml%2FPTO%2Fsrchnum.html&amp;amp;r=1&amp;amp;f=G&amp;amp;l=50&amp;amp;s1=%2220110252014%22.PGNR.&amp;amp;OS=DN/20110252014&amp;amp;RS=DN/20110252014&quot; target=&quot;_blank&quot;&gt;develop a search method&lt;/a&gt; that  would bring back results as they would appear to, say, Miley Cyrus,  Anna Wintour, or my own favorite superstar, Mary Catherine Gallagher.&lt;/p&gt;<br />&lt;p&gt;How would it work? Microsoft could design a system that gives users a  list of characteristics that act as identifiers for predetermined  personas, ie.: supermodel, fashionista, football quarterback. The  persona could also be that of a person, such as Lindsay Lohan or Mike  Tyson. A new component in the search stack would generate and filter  results to bring back results as that persona would see.&lt;/p&gt;<br />&lt;p&gt;While this persona model of search could certainly be useful in the fashion and music realms, who else could benefit?&lt;/p&gt;', NULL, '&lt;p&gt;Microsoftâ€™s U.S. patent application, â€œApplying a Model of Persona to  Search Results,â€ outlines a search system that would allow users to  search the web as their favorite celebrity. Other possible uses for the  technology include searching based on a person or groups  characteristics, or even the preferences of a friend.&lt;/p&gt;<br />&lt;p&gt;Published October 13, the application paves the way for Microsoft to &lt;a href=&quot;http://appft1.uspto.gov/netacgi/nph-Parser?Sect1=PTO1&amp;amp;Sect2=HITOFF&amp;amp;d=PG01&amp;amp;p=1&amp;amp;u=%2Fnetahtml%2FPTO%2Fsrchnum.html&amp;amp;r=1&amp;amp;f=G&amp;amp;l=50&amp;amp;s1=%2220110252014%22.PGNR.&amp;amp;OS=DN/20110252014&amp;amp;RS=DN/20110252014&quot; target=&quot;_blank&quot;&gt;develop a search method&lt;/a&gt; that  would bring back results as they would appear to, say, Miley Cyrus,  Anna Wintour, or my own favorite superstar, Mary Catherine Gallagher.&lt;/p&gt;<br />&lt;p&gt;How would it work? Microsoft could design a system that gives users a  list of characteristics that act as identifiers for predetermined  personas, ie.: supermodel, fashionista, football quarterback. The  persona could also be that of a person, such as Lindsay Lohan or Mike  Tyson. A new component in the search stack would generate and filter  results to bring back results as that persona would see.&lt;/p&gt;<br />&lt;p&gt;While this persona model of search could certainly be useful in the fashion and music realms, who else could benefit?&lt;/p&gt;', 1319597875, 1320364800, 1, 0, '0'),
(6, 1046, 'Events - Content &amp; Search Engine Ranking Factors', '&lt;p&gt;Youâ€™ll hear it over and over again. Content is king, when it comes to  aiming for success with search engines. Indeed, thatâ€™s why the Periodic Table Of SEO Ranking Factors begins with the content â€œelements,â€ with the very first element being  about content quality. Get your content right, and youâ€™ve created a  solid foundation to support all your other SEO efforts.&lt;/p&gt;', NULL, '&lt;p&gt;Youâ€™ll hear it over and over again. Content is king, when it comes to  aiming for success with search engines. Indeed, thatâ€™s why the &lt;a href=&quot;http://searchengineland.com/seotable&quot;&gt;Periodic Table Of SEO Ranking Factors&lt;/a&gt; begins with the content â€œelements,â€ with the very first element being  about content quality. Get your content right, and youâ€™ve created a  solid foundation to support all your other SEO efforts.&lt;/p&gt;<br />&lt;h2&gt;Cq: Content Quality&lt;/h2&gt;<br />&lt;p&gt;More than anything else, are you producing quality content? If youâ€™re  selling something, do you go beyond being only a brochure with the same  information that can be found on hundreds of other sites?&lt;/p&gt;<br />&lt;p&gt;Do you provide a reason for people to spend more than a few seconds reading your pages?&lt;/p&gt;<br />&lt;p&gt;Do you offer real value, something of substance to visitors, anything  unique, different, useful and that they wonâ€™t find elsewhere?&lt;/p&gt;<br />&lt;p&gt;These are just some of the questions to ask yourself in assessing  whether youâ€™re providing quality content. Do provide it, because it is  literally the cornerstone upon which other factors depend.&lt;/p&gt;<br />&lt;p&gt;Below, some articles on the topic of content quality from Search Engine Land, to get you thinking in the right direction&lt;/p&gt;', 1319611431, 1322611200, 1, 5, '0'),
(7, 1042, 'News - Content &amp; Search Engine Ranking Factors', '&lt;p&gt;It looks like adding a suggested user list to &lt;a href=&quot;http://searchengineland.com/googles-facebook-competitor-the-google-social-network-finally-arrives-83401&quot;&gt;Google+&lt;/a&gt; has finally paid off in solving its â€œMark Zuckerberg problem.â€  Facebookâ€™s CEO is no longer the most popular person on Google+, having  just now been passed by Google CEO Larry Page.&lt;/p&gt;', NULL, '&lt;p&gt;It looks like adding a suggested user list to &lt;a href=&quot;http://searchengineland.com/googles-facebook-competitor-the-google-social-network-finally-arrives-83401&quot;&gt;Google+&lt;/a&gt; has finally paid off in solving its â€œMark Zuckerberg problem.â€  Facebookâ€™s CEO is no longer the most popular person on Google+, having  just now been passed by Google CEO Larry Page.&lt;/p&gt;<br />&lt;p&gt;Zuckerberg has been the most followed userÂ &lt;a href=&quot;http://searchengineland.com/one-week-in-google-users-are-growing-followers-getting-traffic-84371&quot;&gt;since the first week that Google+ launched&lt;/a&gt;. Thatâ€™s despite never once having posted to Google Plus.&lt;/p&gt;<br />&lt;h2&gt;Suggested User List Launched&lt;/h2&gt;<br />&lt;p&gt;On September 3, Google &lt;a href=&quot;http://searchengineland.com/this-week-on-google-suggested-users-api-delays-measuring-google-influence-91902&quot;&gt;launched a Google+ suggested user list&lt;/a&gt;,Â encouraging Google+ users to â€œfollow public posts from interesting and famous people,â€ as you can see below:&lt;/p&gt;', 1319613643, 1320019200, 1, 0, '0'),
(11, 1042, 'News - Industrial Strength Three Steps To SEM Planning Success', '&lt;p&gt;Ahh, annual planning season. Nothing quite like it. You can almost smell it in the air.&lt;/p&gt;<br />&lt;p&gt;Dozens of spreadsheets packed with endless assumptions, each one more   fantastic than the last, combining to ultimately seal a marketerâ€™s  fate  for the next 12 months. What could be better than that?&lt;/p&gt;<br />&lt;p&gt;Well, how about three steps to make your SEM planning process more successful:&lt;/p&gt;', 526, '&lt;p&gt;Ahh, annual planning season. Nothing quite like it. You can almost smell it in the air.&lt;/p&gt;<br />&lt;p&gt;Dozens of spreadsheets packed with endless assumptions, each one more  fantastic than the last, combining to ultimately seal a marketerâ€™s fate  for the next 12 months. What could be better than that?&lt;/p&gt;<br />&lt;p&gt;Well, how about three steps to make your SEM planning process more successful:&lt;/p&gt;<br />&lt;ol&gt;<br />&lt;li&gt;Align SEM goals with company strategy&lt;/li&gt;<br />&lt;li&gt;Build different scenarios to illustrate tradeoffs&lt;/li&gt;<br />&lt;li&gt;Engage with all stakeholders multiple times throughout the process&lt;/li&gt;<br />&lt;/ol&gt;<br />&lt;p&gt;A couple of years ago, I wrote a &lt;a href=&quot;http://searchengineland.com/planning-for-success-16798&quot;&gt;column about our Monthly Reforecast&lt;/a&gt;,  an internal tool that weâ€™ve foundÂ indispensable; we use it still to  this day. In fact, Iâ€™ve had multiple requests for the reforecast  template we use.&lt;/p&gt;<br />&lt;p&gt;It helps us to communicate unanticipated changes to what we thought  was going to happen when we built this yearâ€™s plan, last year. I wanted  to take a moment to reiterate the importance of that particular tool,  and to look at the basic process that gives rise to the need for the  reforecast â€“ The Plan.&lt;/p&gt;<br />&lt;p&gt;The reforecast, of course, becomes necessary when your SEM Plan of  Record inevitably turns out to be incorrect, and as I mentioned, your  real work around this phenomenon comes less in SEM management and more  in expectation setting and management.&lt;/p&gt;<br />&lt;p&gt;To summarize, the reforecast template should be standardized, and  buy-in on all levels is required before you can roll this out in an  organization of any significant size or complexity.&lt;/p&gt;<br />&lt;p&gt;But back to the planning process â€” because thatâ€™s where most of us  are right now. The planning process, as it turns out, is equal parts  financial analysis and cat-herding.&lt;/p&gt;<br />&lt;p&gt;The most influential factor in the planning process is (and should  be) the overarching business strategy of the company. Depending on  whether youâ€™re a start-up in hyper-growth mode, or a mature,  industry-leading brand (or more likely something in between), you should  align your SEM planning process with your companyâ€™s financial goals.&lt;/p&gt;<br />&lt;p&gt;As an example, a few years ago we &lt;a href=&quot;http://searchengineland.com/making-paid-search-work-for-you-15460&quot;&gt;shifted SEM strategy&lt;/a&gt; from one that focused on average ROI to one that strives to maximize  profit. The resulting metrics, like cost and revenue, diverge pretty  widely in these two scenarios, and thus I canâ€™t overemphasize the need  to work on this topic before you build your plan.&lt;/p&gt;', 1319616031, 1319587200, 1, 2, '0'),
(12, 1042, 'News - Multinational Search Should You Have A Prenup With Your Global Search Vendor?', '&lt;p&gt;Nearly all search vendors have some sort of agreement, and the larger  the client, the more complex the terms of service will be with  procurement as well.&lt;/p&gt;<br />&lt;p&gt;Most of these focus on the standard stuff: how long, how much, scope  and what happens if their vendor screws up and the relationship needs to  be terminated. Unfortunately, few have any language about some of the  unique situations that can occur in search campaigns.&lt;/p&gt;', NULL, '&lt;p&gt;Nearly all search vendors have some sort of agreement, and the larger  the client, the more complex the terms of service will be with  procurement as well.&lt;/p&gt;<br />&lt;p&gt;Most of these focus on the standard stuff: how long, how much, scope  and what happens if their vendor screws up and the relationship needs to  be terminated. Unfortunately, few have any language about some of the  unique situations that can occur in search campaigns.&lt;/p&gt;<br />&lt;p&gt;Getting into the details of the contracts between agencies and  companies is a lot like discussing a prenup with your significant other.  No one wants to even think the relationship wonâ€™t last, but you do have  to be prepared for possibility that it wonâ€™t. The following are some  key considerations you should think about before you enter into that  vendor marriage.&lt;/p&gt;', 1319616476, 1319846400, 1, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_campus`
--

CREATE TABLE IF NOT EXISTS `vsf_campus` (
  `campusId` mediumint(10) NOT NULL AUTO_INCREMENT,
  `campusTitle` varchar(64) NOT NULL,
  `campusAddress` varchar(128) NOT NULL,
  `campusPhone` varchar(16) NOT NULL,
  `campusStatus` tinyint(4) NOT NULL,
  PRIMARY KEY (`campusId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `vsf_campus`
--

INSERT INTO `vsf_campus` (`campusId`, `campusTitle`, `campusAddress`, `campusPhone`, `campusStatus`) VALUES
(4, 'University of California, Berkeley', '110 Sproul Hall #5800 Berkeley, CA 94720-5800', '(510) 642-3175', 1),
(20, 'Mission College', '3000 Mission College Boulevard Santa Clara, CA 95054-1897', '(408) 988-2200', 1),
(19, 'Evergreen Valley College', '3095 Yerba Buena Rd., San Jose, CA 95135', '(408) 274-7900', 1),
(18, 'University of California, Davis', 'One Shields Avenue Davis, CA 95616', '(530) 752-1011', 1),
(17, 'San Jose City College', '2100 Moorpark Avenue San Jose, CA 95128', '(408) 298-2181', 1),
(13, 'San Jose State University', 'One Washington Square # San JosÃ©, Ca 95192', '(408) 924-1000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_components`
--

CREATE TABLE IF NOT EXISTS `vsf_components` (
  `comId` smallint(4) NOT NULL AUTO_INCREMENT,
  `comName` varchar(64) NOT NULL DEFAULT '',
  `comPackage` varchar(32) NOT NULL DEFAULT '',
  `comInstalled` tinyint(1) NOT NULL,
  `comDescription` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`comId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vsf_components`
--

INSERT INTO `vsf_components` (`comId`, `comName`, `comPackage`, `comInstalled`, `comDescription`) VALUES
(1, 'SEO', 'SEO', 1, 'seo site');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_contact`
--

CREATE TABLE IF NOT EXISTS `vsf_contact` (
  `contactId` smallint(4) NOT NULL AUTO_INCREMENT,
  `contactName` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactUser` int(10) NOT NULL,
  `contactEmail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contactTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contactContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contactPostDate` int(10) NOT NULL,
  `contactStatus` tinyint(1) NOT NULL,
  `contactIsReply` smallint(1) NOT NULL,
  `contactType` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contactId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vsf_contact`
--

INSERT INTO `vsf_contact` (`contactId`, `contactName`, `contactUser`, `contactEmail`, `contactTitle`, `contactContent`, `contactPostDate`, `contactStatus`, `contactIsReply`, `contactType`) VALUES
(1, 'pandog', 7, 'yunhaihuang@gmail.com', '', 'ducdoan', 1318575523, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_counter_log`
--

CREATE TABLE IF NOT EXISTS `vsf_counter_log` (
  `time` int(10) unsigned NOT NULL,
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `guests` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `members` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bots` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vsf_counter_log`
--

INSERT INTO `vsf_counter_log` (`time`, `visits`, `guests`, `members`, `bots`) VALUES
(1274659200, 1, 1, 0, 0),
(1274745600, 2, 2, 0, 0),
(1274832000, 2, 2, 0, 0),
(1274918400, 2, 2, 0, 0),
(1275091200, 1, 1, 0, 0),
(1275177600, 2, 2, 0, 0),
(1275264000, 4, 4, 0, 0),
(1275350400, 1, 1, 0, 0),
(1275523199, 1, 1, 0, 0),
(1275609599, 12, 12, 0, 0),
(1275695999, 2, 1, 1, 0),
(1276214399, 4, 3, 1, 0),
(1276300799, 17, 17, 0, 0),
(1276646399, 2, 1, 1, 0),
(1276732799, 3, 3, 0, 0),
(1276819199, 1, 1, 0, 0),
(1276905599, 1, 1, 0, 0),
(1277164799, 11, 11, 0, 0),
(1277251199, 2, 2, 0, 0),
(1277337599, 1, 1, 0, 0),
(1277423999, 1, 1, 0, 0),
(1277510399, 4, 4, 0, 0),
(1277769599, 2, 2, 0, 0),
(1277855999, 5, 5, 0, 0),
(1277942399, 1, 1, 0, 0),
(1278115199, 6, 5, 1, 0),
(1278201599, 6, 6, 0, 0),
(1278287999, 6, 6, 0, 0),
(1278374399, 7, 7, 0, 0),
(1313107199, 5, 5, 0, 0),
(1278547199, 1, 1, 0, 0),
(1278633599, 6, 6, 0, 0),
(1278719999, 3, 3, 0, 0),
(1278806399, 8, 8, 0, 0),
(1278892799, 3, 3, 0, 0),
(1278979199, 3, 3, 0, 0),
(1279065599, 4, 4, 0, 0),
(1279238399, 3, 3, 0, 0),
(1279324799, 2, 2, 0, 0),
(1279411199, 1, 1, 0, 0),
(1279497599, 1, 1, 0, 0),
(1279583999, 11, 11, 0, 0),
(1279670399, 13, 13, 0, 0),
(1279756799, 54, 54, 0, 0),
(1279843199, 19, 19, 0, 0),
(1279929599, 12, 12, 0, 0),
(1280015999, 19, 19, 0, 0),
(1280102399, 11, 11, 0, 0),
(1280188799, 7, 7, 0, 0),
(1280275199, 15, 15, 0, 0),
(1280361599, 9, 9, 0, 0),
(1280447999, 2, 2, 0, 0),
(1280534399, 14, 14, 0, 0),
(1280620799, 25, 25, 0, 0),
(1280707199, 2, 2, 0, 0),
(1280793599, 29, 29, 0, 0),
(1280879999, 15, 15, 0, 0),
(1280966399, 5, 5, 0, 0),
(1281052799, 8, 8, 0, 0),
(1281139199, 8, 8, 0, 0),
(1281225599, 13, 13, 0, 0),
(1281311999, 3, 3, 0, 0),
(1281398399, 19, 19, 0, 0),
(1281484799, 22, 22, 0, 0),
(1281571199, 24, 24, 0, 0),
(1281657599, 24, 24, 0, 0),
(1281743999, 16, 16, 0, 0),
(1281830399, 10, 10, 0, 0),
(1281916799, 10, 10, 0, 0),
(1282003199, 10, 10, 0, 0),
(1282089599, 18, 18, 0, 0),
(1282175999, 26, 26, 0, 0),
(1282262399, 50, 50, 0, 0),
(1282348799, 14, 14, 0, 0),
(1282435199, 15, 15, 0, 0),
(1282521599, 2, 2, 0, 0),
(1282607999, 14, 14, 0, 0),
(1282694399, 15, 15, 0, 0),
(1282780799, 22, 22, 0, 0),
(1282867199, 23, 23, 0, 0),
(1282953599, 33, 32, 1, 0),
(1283039999, 25, 25, 0, 0),
(1283126399, 12, 12, 0, 0),
(1283212799, 33, 33, 0, 0),
(1283299199, 14, 13, 1, 0),
(1283385599, 4, 4, 0, 0),
(1283558399, 16, 16, 0, 0),
(1283644799, 33, 30, 3, 0),
(1283817599, 8, 6, 2, 0),
(1283903999, 2, 2, 0, 0),
(1283990399, 15, 15, 0, 0),
(1284076799, 15, 15, 0, 0),
(1284163199, 12, 12, 0, 0),
(1284249599, 13, 13, 0, 0),
(1284335999, 15, 14, 1, 0),
(1284422399, 12, 11, 1, 0),
(1284508799, 10, 10, 0, 0),
(1284595199, 6, 6, 0, 0),
(1284681599, 12, 12, 0, 0),
(1284767999, 15, 15, 0, 0),
(1284854399, 14, 14, 0, 0),
(1284940799, 6, 6, 0, 0),
(1285027199, 1, 1, 0, 0),
(1285113599, 3, 3, 0, 0),
(1285199999, 6, 6, 0, 0),
(1285286399, 3, 3, 0, 0),
(1285372799, 1, 1, 0, 0),
(1285459199, 1, 1, 0, 0),
(1286323199, 1, 1, 0, 0),
(1286495999, 1, 1, 0, 0),
(1286582399, 3, 3, 0, 0),
(1287187199, 1, 1, 0, 0),
(1287359999, 1, 1, 0, 0),
(1287791999, 2, 2, 0, 0),
(1289001599, 1, 1, 0, 0),
(1289347199, 1, 1, 0, 0),
(1293148799, 3, 3, 0, 0),
(1293235199, 3, 3, 0, 0),
(1293580799, 4, 4, 0, 0),
(1294099199, 3, 3, 0, 0),
(1294185599, 6, 6, 0, 0),
(1294271999, 38, 38, 0, 0),
(1294358399, 4, 4, 0, 0),
(1294444799, 7, 7, 0, 0),
(1294703999, 16, 16, 0, 0),
(1294790399, 7, 7, 0, 0),
(1294876799, 11, 11, 0, 0),
(1294963199, 17, 17, 0, 0),
(1295049599, 16, 16, 0, 0),
(1295135999, 3, 3, 0, 0),
(1295222399, 3, 3, 0, 0),
(1295308799, 7, 7, 0, 0),
(1295395199, 4, 4, 0, 0),
(1295481599, 3, 3, 0, 0),
(1295567999, 14, 14, 0, 0),
(1295654399, 29, 29, 0, 0),
(1295740799, 2, 2, 0, 0),
(1295827199, 3, 3, 0, 0),
(1295913599, 7, 7, 0, 0),
(1295999999, 4, 4, 0, 0),
(1296086399, 11, 11, 0, 0),
(1296172799, 14, 13, 1, 0),
(1296259199, 29, 29, 0, 0),
(1296345599, 1, 1, 0, 0),
(1297209599, 4, 4, 0, 0),
(1297295999, 2, 2, 0, 0),
(1297382399, 4, 4, 0, 0),
(1297468799, 12, 12, 0, 0),
(1297641599, 1, 1, 0, 0),
(1297727999, 10, 10, 0, 0),
(1297814399, 5, 4, 1, 0),
(1297900799, 6, 5, 1, 0),
(1297987199, 20, 15, 5, 0),
(1298073599, 8, 6, 2, 0),
(1298246399, 4, 4, 0, 0),
(1298332799, 12, 12, 0, 0),
(1298419199, 9, 8, 1, 0),
(1298505599, 5, 5, 0, 0),
(1298591999, 8, 8, 0, 0),
(1298678399, 3, 3, 0, 0),
(1298937599, 10, 9, 1, 0),
(1298851199, 1, 1, 0, 0),
(1299023999, 12, 12, 0, 0),
(1299110399, 3, 3, 0, 0),
(1299196799, 7, 7, 0, 0),
(1299283199, 8, 8, 0, 0),
(1299455999, 2, 2, 0, 0),
(1299542399, 11, 11, 0, 0),
(1299628799, 6, 6, 0, 0),
(1299715199, 2, 2, 0, 0),
(1299801599, 16, 16, 0, 0),
(1299887999, 1, 1, 0, 0),
(1300060799, 2, 2, 0, 0),
(1300319999, 1, 1, 0, 0),
(1300406399, 1, 1, 0, 0),
(1302307199, 1, 1, 0, 0),
(1302739199, 1, 1, 0, 0),
(1302825599, 2, 2, 0, 0),
(1302911999, 5, 5, 0, 0),
(1302998399, 4, 4, 0, 0),
(1303171199, 3, 3, 0, 0),
(1303257599, 4, 4, 0, 0),
(1303343999, 5, 5, 0, 0),
(1303430399, 9, 9, 0, 0),
(1303516799, 1, 1, 0, 0),
(1303603199, 1, 1, 0, 0),
(1303689599, 5, 5, 0, 0),
(1303775999, 5, 5, 0, 0),
(1303862399, 2, 2, 0, 0),
(1303948799, 6, 6, 0, 0),
(1304035199, 10, 9, 1, 0),
(1304121599, 1, 1, 0, 0),
(1304294399, 1, 1, 0, 0),
(1304380799, 3, 3, 0, 0),
(1304553599, 2, 2, 0, 0),
(1304639999, 6, 6, 0, 0),
(1304726399, 34, 34, 0, 0),
(1304985599, 6, 5, 1, 0),
(1305158399, 3, 3, 0, 0),
(1305244799, 2, 2, 0, 0),
(1306367999, 1, 1, 0, 0),
(1307750399, 1, 1, 0, 0),
(1308009599, 1, 1, 0, 0),
(1308095999, 1, 1, 0, 0),
(1308182399, 5, 5, 0, 0),
(1308268799, 8, 6, 2, 0),
(1308355199, 2, 2, 0, 0),
(1308614399, 4, 4, 0, 0),
(1308700799, 9, 7, 2, 0),
(1308787199, 2, 2, 0, 0),
(1308873599, 20, 17, 3, 0),
(1308959999, 2, 2, 0, 0),
(1309219199, 5, 4, 1, 0),
(1309305599, 20, 19, 1, 0),
(1309391999, 6, 6, 0, 0),
(1309564799, 3, 3, 0, 0),
(1309651199, 8, 8, 0, 0),
(1309823999, 6, 6, 0, 0),
(1309910399, 3, 3, 0, 0),
(1309996799, 3, 3, 0, 0),
(1310083199, 5, 5, 0, 0),
(1310169599, 3, 3, 0, 0),
(1310428799, 1, 1, 0, 0),
(1310515199, 5, 5, 0, 0),
(1310601599, 5, 5, 0, 0),
(1310687999, 10, 10, 0, 0),
(1310774399, 9, 9, 0, 0),
(1311033599, 7, 7, 0, 0),
(1311119999, 4, 4, 0, 0),
(1311206399, 7, 6, 1, 0),
(1311292799, 3, 3, 0, 0),
(1311379199, 5, 5, 0, 0),
(1311638399, 5, 5, 0, 0),
(1311724799, 3, 3, 0, 0),
(1311811199, 3, 3, 0, 0),
(1311897599, 6, 6, 0, 0),
(1311983999, 3, 3, 0, 0),
(1312156799, 1, 1, 0, 0),
(1312243199, 5, 5, 0, 0),
(1312415999, 4, 4, 0, 0),
(1312502399, 1, 1, 0, 0),
(1312588799, 3, 3, 0, 0),
(1312847999, 2, 0, 2, 0),
(1312934399, 3, 0, 3, 0),
(1313020799, 4, 3, 1, 0),
(1313193599, 4, 4, 0, 0),
(1313452799, 2, 2, 0, 0),
(1313539199, 2, 2, 0, 0),
(1313625599, 4, 3, 1, 0),
(1313711999, 4, 3, 1, 0),
(1313798399, 18, 14, 4, 0),
(1314057599, 2, 2, 0, 0),
(1314143999, 1, 1, 0, 0),
(1314230399, 10, 5, 5, 0),
(1314316799, 8, 7, 1, 0),
(1314403199, 1, 1, 0, 0),
(1314575999, 1, 1, 0, 0),
(1314662399, 5, 5, 0, 0),
(1314748799, 1, 1, 0, 0),
(1314835199, 2, 2, 0, 0),
(1314921599, 2, 2, 0, 0),
(1315007999, 1, 1, 0, 0),
(1315180799, 2, 2, 0, 0),
(1315267199, 1, 1, 0, 0),
(1315353599, 9, 8, 1, 0),
(1315439999, 7, 7, 0, 0),
(1315526399, 12, 12, 0, 0),
(1315612799, 6, 6, 0, 0),
(1315699199, 1, 1, 0, 0),
(1315871999, 10, 10, 0, 0),
(1315958399, 5, 5, 0, 0),
(1316044799, 13, 11, 2, 0),
(1316131199, 15, 13, 2, 0),
(1316217599, 6, 6, 0, 0),
(1316476799, 2, 1, 1, 0),
(1316563199, 4, 2, 2, 0),
(1316649599, 5, 5, 0, 0),
(1316822399, 4, 3, 1, 0),
(1317081599, 2, 2, 0, 0),
(1317167999, 1, 1, 0, 0),
(1317254399, 3, 3, 0, 0),
(1317340799, 1, 1, 0, 0),
(1317427199, 2, 2, 0, 0),
(1317686399, 1, 1, 0, 0),
(1317772799, 5, 2, 3, 0),
(1317859199, 3, 3, 0, 0),
(1317945599, 6, 4, 2, 0),
(1318031999, 3, 3, 0, 0),
(1318118399, 7, 7, 0, 0),
(1318377599, 3, 3, 0, 0),
(1318463999, 4, 4, 0, 0),
(1318550399, 5, 5, 0, 0),
(1318636799, 4, 4, 0, 0),
(1318895999, 7, 7, 0, 0),
(1318982399, 12, 12, 0, 0),
(1319068799, 7, 7, 0, 0),
(1319155199, 6, 6, 0, 0),
(1319500799, 5, 5, 0, 0),
(1319587199, 4, 4, 0, 0),
(1319673599, 3, 3, 0, 0),
(1319759999, 3, 3, 0, 0),
(1319846399, 3, 1, 2, 0),
(1321919999, 1, 1, 0, 0),
(1322783999, 1, 1, 0, 0),
(1323734399, 1, 1, 0, 0),
(1325289599, 1, 1, 0, 0),
(1326239999, 1, 1, 0, 0),
(1326499199, 1, 1, 0, 0),
(1328659199, 1, 1, 0, 0),
(1328745599, 1, 1, 0, 0),
(1329091199, 1, 1, 0, 0),
(1329955199, 1, 1, 0, 0),
(1330214399, 1, 1, 0, 0),
(1333065599, 2, 2, 0, 0),
(1334707199, 1, 1, 0, 0),
(1335311999, 1, 1, 0, 0),
(1335743999, 1, 1, 0, 0),
(1338076799, 1, 1, 0, 0),
(1338595199, 2, 2, 0, 0),
(1340927999, 1, 1, 0, 0),
(1341014399, 1, 1, 0, 0),
(1341100799, 1, 1, 0, 0),
(1341359999, 1, 1, 0, 0),
(1346716799, 1, 1, 0, 0),
(1346371199, 1, 1, 0, 0),
(1351814399, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_file`
--

CREATE TABLE IF NOT EXISTS `vsf_file` (
  `fileId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fileModule` varchar(100) DEFAULT NULL,
  `fileTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fileName` varchar(255) NOT NULL,
  `fileIntro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fileType` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fileSize` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fileUploadTime` int(10) unsigned NOT NULL DEFAULT '0',
  `filePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fileStatus` tinyint(1) DEFAULT NULL,
  `fileIndex` smallint(4) DEFAULT NULL,
  `filePass` varchar(32) DEFAULT NULL,
  `fileUserId` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`fileId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=528 ;

--
-- Dumping data for table `vsf_file`
--

INSERT INTO `vsf_file` (`fileId`, `fileModule`, `fileTitle`, `fileName`, `fileIntro`, `fileType`, `fileSize`, `fileUploadTime`, `filePath`, `fileStatus`, `fileIndex`, `filePass`, `fileUserId`) VALUES
(276, 'textbooks', '~51vFypbVAPL', '~51vFypbVAPL', '', 'jpg', 37088, 1304665205, 'textbooks/', NULL, NULL, NULL, NULL),
(275, NULL, '~51fHlS9vK2L_BO2204203200_PIsitbstickerarrowclickTopRight3576_AA300_SH20_OU01_', '~51fHlS9vK2L_BO2204203200_PIsitbstickerarrowclickTopRight3576_AA300_SH20_OU01_', '', 'jpg', 22182, 1304663643, 'textbooks/', NULL, NULL, NULL, NULL),
(274, 'textbooks', '~415NS3cmtrL', '~415NS3cmtrL', '', 'jpg', 29046, 1304663094, 'textbooks/', NULL, NULL, NULL, NULL),
(273, 'textbooks', '~51Pkt8UcdAL', '~51Pkt8UcdAL', '', 'jpg', 42765, 1304649281, 'textbooks/', NULL, NULL, NULL, NULL),
(272, 'textbooks', '~51Pkt8UcdAL', '~51Pkt8UcdAL', '', 'jpg', 42765, 1304647930, 'textbooks/', NULL, NULL, NULL, NULL),
(271, 'textbooks', '~51Pkt8UcdAL', '~51Pkt8UcdAL', '', 'jpg', 42765, 1304647909, 'textbooks/', NULL, NULL, NULL, NULL),
(270, 'textbooks', '~31HrNnrAyBL', '~31HrNnrAyBL', '', 'jpg', 15752, 1303778289, 'textbooks/', NULL, NULL, NULL, NULL),
(269, 'textbooks', '~31HrNnrAyBL', '~31HrNnrAyBL', '', 'jpg', 15752, 1303778070, 'textbooks/', NULL, NULL, NULL, NULL),
(268, 'textbooks', '~51C2BM6G2BXDL', '~51C2BM6G2BXDL', '', 'jpg', 45783, 1303716536, 'textbooks/', NULL, NULL, NULL, NULL),
(267, 'textbooks', '~51smki7Sa2BL', '~51smki7Sa2BL', '', 'jpg', 36975, 1302841813, 'textbooks/', NULL, NULL, NULL, NULL),
(266, 'textbooks', '~41XCbsYMonL', '~41XCbsYMonL', '', 'jpg', 29159, 1302840380, 'textbooks/', NULL, NULL, NULL, NULL),
(265, 'textbooks', '~41nA2B5xP9aL', '~41nA2B5xP9aL', '', 'jpg', 30905, 1298884363, 'textbooks/', NULL, NULL, NULL, NULL),
(264, 'textbooks', '~51Wws7JI2eL', '~51Wws7JI2eL', '', 'jpg', 41151, 1298441313, 'textbooks/', NULL, NULL, NULL, NULL),
(263, 'messages', '~SanyouCave_ROW164201297', '~SanyouCave_ROW164201297', '', 'jpg', 82194, 1298282937, 'messages/', NULL, NULL, NULL, NULL),
(81, 'partners', '~google_logo', '~google_logo', '', 'jpg', 24813, 1284354249, 'partners/', NULL, NULL, NULL, NULL),
(82, 'partners', '~spring08', '~spring08', '', 'gif', 11934, 1284354277, 'partners/', NULL, NULL, NULL, NULL),
(262, 'messages', '~MerDeGlace_ROW166247093', '~MerDeGlace_ROW166247093', '', 'jpg', 82059, 1298282937, 'messages/', NULL, NULL, NULL, NULL),
(261, 'messages', '~SanyouCave_ROW164201297', '~SanyouCave_ROW164201297', '', 'jpg', 82194, 1298280612, 'messages/', NULL, NULL, NULL, NULL),
(87, NULL, '~panda_dog_2', '~panda_dog_2', '', 'jpg', 110152, 1284454560, 'users/', NULL, NULL, NULL, NULL),
(88, NULL, '~panda_dog_2', '~panda_dog_2', '', 'jpg', 110152, 1284454693, 'users/', NULL, NULL, NULL, NULL),
(89, NULL, '~panda_dog_2', '~panda_dog_2', '', 'jpg', 110152, 1284454721, 'users/', NULL, NULL, NULL, NULL),
(260, 'messages', '~MerDeGlace_ROW166247093', '~MerDeGlace_ROW166247093', '', 'jpg', 82059, 1298280612, 'messages/', NULL, NULL, NULL, NULL),
(92, NULL, '~Tulips', '~Tulips', '', 'jpg', 620888, 1284801361, 'users/', NULL, NULL, NULL, NULL),
(93, 'users', '~Anemonefish_ROW513666688', '~Anemonefish_ROW513666688', '', 'jpg', 81283, 1294737719, 'users/', NULL, NULL, NULL, NULL),
(94, 'users', '~Anemonefish_ROW513666688', '~Anemonefish_ROW513666688', '', 'jpg', 81283, 1294738039, 'users/', NULL, NULL, NULL, NULL),
(95, 'users', '~Anemonefish_ROW513666688', '~Anemonefish_ROW513666688', '', 'jpg', 81283, 1294738477, 'users/', NULL, NULL, NULL, NULL),
(96, 'users', '~Anemonefish_ROW513666688', '~Anemonefish_ROW513666688', '', 'jpg', 81283, 1294738516, 'users/', NULL, NULL, NULL, NULL),
(97, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294794544, 'users/', NULL, NULL, NULL, NULL),
(98, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294795094, 'users/', NULL, NULL, NULL, NULL),
(99, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804176, 'users/', NULL, NULL, NULL, NULL),
(100, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804234, 'users/', NULL, NULL, NULL, NULL),
(101, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804661, 'users/', NULL, NULL, NULL, NULL),
(102, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804667, 'users/', NULL, NULL, NULL, NULL),
(103, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804742, 'users/', NULL, NULL, NULL, NULL),
(104, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804748, 'users/', NULL, NULL, NULL, NULL),
(105, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804973, 'users/', NULL, NULL, NULL, NULL),
(106, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294804986, 'users/', NULL, NULL, NULL, NULL),
(107, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805241, 'users/', NULL, NULL, NULL, NULL),
(108, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805273, 'users/', NULL, NULL, NULL, NULL),
(109, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805316, 'users/', NULL, NULL, NULL, NULL),
(110, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805542, 'users/', NULL, NULL, NULL, NULL),
(111, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805547, 'users/', NULL, NULL, NULL, NULL),
(112, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805610, 'users/', NULL, NULL, NULL, NULL),
(113, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294805613, 'users/', NULL, NULL, NULL, NULL),
(114, 'users', '~LindauHarbor_JAJP1030840031', '~LindauHarbor_JAJP1030840031', '', 'jpg', 81207, 1294809119, 'users/', NULL, NULL, NULL, NULL),
(115, 'users', '~MountHoodSnow_ROW1582877140', '~MountHoodSnow_ROW1582877140', '', 'jpg', 81210, 1294886908, 'users/', NULL, NULL, NULL, NULL),
(116, 'users', '~Dock', '~Dock', '', 'jpg', 316892, 1295041156, 'users/', NULL, NULL, NULL, NULL),
(117, 'users', '~Forest', '~Forest', '', 'jpg', 664489, 1295041199, 'users/', NULL, NULL, NULL, NULL),
(118, 'users', '~Forest', '~Forest', '', 'jpg', 664489, 1295041226, 'users/', NULL, NULL, NULL, NULL),
(119, 'textbooks', '~413tV2BoGsPL', '~413tV2BoGsPL', '', 'jpg', 27971, 1296110117, 'textbooks/', NULL, NULL, NULL, NULL),
(120, 'textbooks', '~413tV2BoGsPL', '~413tV2BoGsPL', '', 'jpg', 27971, 1296110210, 'textbooks/', NULL, NULL, NULL, NULL),
(121, 'textbooks', '~413tV2BoGsPL', '~413tV2BoGsPL', '', 'jpg', 27971, 1296110217, 'textbooks/', NULL, NULL, NULL, NULL),
(122, 'users', '~ScenicSkyway_ROW2786891862', '~ScenicSkyway_ROW2786891862', '', 'jpg', 84023, 1296112826, 'users/', NULL, NULL, NULL, NULL),
(123, 'users', '~ScenicSkyway_ROW2786891862', '~ScenicSkyway_ROW2786891862', '', 'jpg', 84023, 1296112833, 'users/', NULL, NULL, NULL, NULL),
(124, 'users', '~CityofArtsAndSciences_ROW2253312510', '~CityofArtsAndSciences_ROW2253312510', '', 'jpg', 81897, 1296112839, 'users/', NULL, NULL, NULL, NULL),
(125, 'users', '~Bamboo_JAJP22722681', '~Bamboo_JAJP22722681', '', 'jpg', 81408, 1296113203, 'users/', NULL, NULL, NULL, NULL),
(126, 'users', '~ScenicSkyway_ROW2786891862', '~ScenicSkyway_ROW2786891862', '', 'jpg', 84023, 1296113213, 'users/', NULL, NULL, NULL, NULL),
(127, 'users', '~ScenicSkyway_ROW2786891862', '~ScenicSkyway_ROW2786891862', '', 'jpg', 84023, 1296113234, 'users/', NULL, NULL, NULL, NULL),
(128, 'users', '~Desert', '~Desert', '', 'jpg', 845941, 1296114358, 'users/', NULL, NULL, NULL, NULL),
(129, 'users', '~Desert', '~Desert', '', 'jpg', 845941, 1296114362, 'users/', NULL, NULL, NULL, NULL),
(130, 'users', '~Lighthouse', '~Lighthouse', '', 'jpg', 561276, 1296114443, 'users/', NULL, NULL, NULL, NULL),
(131, 'users', '~Penguins', '~Penguins', '', 'jpg', 777835, 1296114489, 'users/', NULL, NULL, NULL, NULL),
(132, 'textbooks', '~51di9OxqjhL', '~51di9OxqjhL', '', 'jpg', 34683, 1296117855, 'textbooks/', NULL, NULL, NULL, NULL),
(133, 'textbooks', '~41EL4h4yhWL', '~41EL4h4yhWL', '', 'jpg', 32703, 1296118090, 'textbooks/', NULL, NULL, NULL, NULL),
(134, 'textbooks', '~41EL4h4yhWL', '~41EL4h4yhWL', '', 'jpg', 32703, 1296118107, 'textbooks/', NULL, NULL, NULL, NULL),
(135, 'textbooks', '~41EL4h4yhWL', '~41EL4h4yhWL', '', 'jpg', 32703, 1296118618, 'textbooks/', NULL, NULL, NULL, NULL),
(136, 'textbooks', '~41EL4h4yhWL', '~41EL4h4yhWL', '', 'jpg', 32703, 1296119336, 'textbooks/', NULL, NULL, NULL, NULL),
(137, 'textbooks', '~41EL4h4yhWL', '~41EL4h4yhWL', '', 'jpg', 32703, 1296119351, 'textbooks/', NULL, NULL, NULL, NULL),
(138, 'textbooks', '~512B9BdYOHdL', '~512B9BdYOHdL', '', 'jpg', 35166, 1296119383, 'textbooks/', NULL, NULL, NULL, NULL),
(139, 'textbooks', '~512B9BdYOHdL', '~512B9BdYOHdL', '', 'jpg', 35166, 1296119414, 'textbooks/', NULL, NULL, NULL, NULL),
(140, 'textbooks', '~51ppu1bxEL', '~51ppu1bxEL', '', 'jpg', 54944, 1296119597, 'textbooks/', NULL, NULL, NULL, NULL),
(141, 'textbooks', '~51ppu1bxEL', '~51ppu1bxEL', '', 'jpg', 54944, 1296119663, 'textbooks/', NULL, NULL, NULL, NULL),
(142, 'textbooks', '~51ppu1bxEL', '~51ppu1bxEL', '', 'jpg', 54944, 1296119695, 'textbooks/', NULL, NULL, NULL, NULL),
(143, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296119865, 'textbooks/', NULL, NULL, NULL, NULL),
(144, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296119919, 'textbooks/', NULL, NULL, NULL, NULL),
(145, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296119931, 'textbooks/', NULL, NULL, NULL, NULL),
(146, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296119941, 'textbooks/', NULL, NULL, NULL, NULL),
(147, 'textbooks', '~512B9BdYOHdL', '~512B9BdYOHdL', '', 'jpg', 35166, 1296120113, 'textbooks/', NULL, NULL, NULL, NULL),
(148, 'textbooks', '~51rSl9EQBgL', '~51rSl9EQBgL', '', 'jpg', 39165, 1296124933, 'textbooks/', NULL, NULL, NULL, NULL),
(149, 'textbooks', '~51rSl9EQBgL', '~51rSl9EQBgL', '', 'jpg', 39165, 1296124956, 'textbooks/', NULL, NULL, NULL, NULL),
(150, 'textbooks', '~51rSl9EQBgL', '~51rSl9EQBgL', '', 'jpg', 39165, 1296124965, 'textbooks/', NULL, NULL, NULL, NULL),
(151, 'textbooks', '~41UWC4kbxGL', '~41UWC4kbxGL', '', 'jpg', 27358, 1296152340, 'textbooks/', NULL, NULL, NULL, NULL),
(152, 'textbooks', '~41UWC4kbxGL', '~41UWC4kbxGL', '', 'jpg', 27358, 1296152356, 'textbooks/', NULL, NULL, NULL, NULL),
(153, 'textbooks', '~41UWC4kbxGL', '~41UWC4kbxGL', '', 'jpg', 27358, 1296152385, 'textbooks/', NULL, NULL, NULL, NULL),
(154, 'textbooks', '~41UWC4kbxGL', '~41UWC4kbxGL', '', 'jpg', 27358, 1296152391, 'textbooks/', NULL, NULL, NULL, NULL),
(155, 'textbooks', '~41UWC4kbxGL', '~41UWC4kbxGL', '', 'jpg', 27358, 1296152429, 'textbooks/', NULL, NULL, NULL, NULL),
(156, 'textbooks', '~41UWC4kbxGL', '~41UWC4kbxGL', '', 'jpg', 27358, 1296152448, 'textbooks/', NULL, NULL, NULL, NULL),
(157, 'textbooks', '~51eg8N8UVsL', '~51eg8N8UVsL', '', 'jpg', 42405, 1296180607, 'textbooks/', NULL, NULL, NULL, NULL),
(158, 'textbooks', '~51eg8N8UVsL', '~51eg8N8UVsL', '', 'jpg', 42405, 1296180612, 'textbooks/', NULL, NULL, NULL, NULL),
(159, 'textbooks', '~51eg8N8UVsL', '~51eg8N8UVsL', '', 'jpg', 42405, 1296180630, 'textbooks/', NULL, NULL, NULL, NULL),
(160, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296180944, 'textbooks/', NULL, NULL, NULL, NULL),
(161, 'textbooks', '~51eg8N8UVsL', '~51eg8N8UVsL', '', 'jpg', 42405, 1296181006, 'textbooks/', NULL, NULL, NULL, NULL),
(162, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296181070, 'textbooks/', NULL, NULL, NULL, NULL),
(163, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296181244, 'textbooks/', NULL, NULL, NULL, NULL),
(164, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296181287, 'textbooks/', NULL, NULL, NULL, NULL),
(165, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296181313, 'textbooks/', NULL, NULL, NULL, NULL),
(166, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296181352, 'textbooks/', NULL, NULL, NULL, NULL),
(167, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296181368, 'textbooks/', NULL, NULL, NULL, NULL),
(168, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296182260, 'textbooks/', NULL, NULL, NULL, NULL),
(169, 'textbooks', '~41fBIep3JlL', '~41fBIep3JlL', '', 'jpg', 27895, 1296182389, 'textbooks/', NULL, NULL, NULL, NULL),
(170, 'textbooks', '~51FtjhQ2D9L', '~51FtjhQ2D9L', '', 'jpg', 44345, 1296182974, 'textbooks/', NULL, NULL, NULL, NULL),
(171, 'textbooks', '~51zO5a5XjNL', '~51zO5a5XjNL', '', 'jpg', 34694, 1296183167, 'textbooks/', NULL, NULL, NULL, NULL),
(172, 'textbooks', '~41A51SV7MML', '~41A51SV7MML', '', 'jpg', 32715, 1296183203, 'textbooks/', NULL, NULL, NULL, NULL),
(173, 'textbooks', '~41A51SV7MML', '~41A51SV7MML', '', 'jpg', 32715, 1296183410, 'textbooks/', NULL, NULL, NULL, NULL),
(174, 'textbooks', '~41A51SV7MML', '~41A51SV7MML', '', 'jpg', 32715, 1296183439, 'textbooks/', NULL, NULL, NULL, NULL),
(175, 'textbooks', '~41A51SV7MML', '~41A51SV7MML', '', 'jpg', 32715, 1296183446, 'textbooks/', NULL, NULL, NULL, NULL),
(176, 'textbooks', '~51izsuuMP2L', '~51izsuuMP2L', '', 'jpg', 42438, 1296213135, 'textbooks/', NULL, NULL, NULL, NULL),
(177, 'textbooks', '~31AjnthTEQL', '~31AjnthTEQL', '', 'jpg', 8336, 1296213136, 'textbooks/', NULL, NULL, NULL, NULL),
(178, 'textbooks', '~51AbQxWxj4L', '~51AbQxWxj4L', '', 'jpg', 35139, 1296213136, 'textbooks/', NULL, NULL, NULL, NULL),
(179, 'textbooks', '~31AjnthTEQL', '~31AjnthTEQL', '', 'jpg', 8336, 1296213154, 'textbooks/', NULL, NULL, NULL, NULL),
(180, 'textbooks', '~51izsuuMP2L', '~51izsuuMP2L', '', 'jpg', 42438, 1296213338, 'textbooks/', NULL, NULL, NULL, NULL),
(181, 'textbooks', '~31AjnthTEQL', '~31AjnthTEQL', '', 'jpg', 8336, 1296213340, 'textbooks/', NULL, NULL, NULL, NULL),
(182, 'textbooks', '~51AbQxWxj4L', '~51AbQxWxj4L', '', 'jpg', 35139, 1296213342, 'textbooks/', NULL, NULL, NULL, NULL),
(183, 'textbooks', '~31AjnthTEQL', '~31AjnthTEQL', '', 'jpg', 8336, 1296213350, 'textbooks/', NULL, NULL, NULL, NULL),
(184, 'textbooks', '~51yEgqyNZvL', '~51yEgqyNZvL', '', 'jpg', 37816, 1296213832, 'textbooks/', NULL, NULL, NULL, NULL),
(185, 'textbooks', '~51yEgqyNZvL', '~51yEgqyNZvL', '', 'jpg', 37816, 1296213855, 'textbooks/', NULL, NULL, NULL, NULL),
(186, 'textbooks', '~41BzAjE5s3L', '~41BzAjE5s3L', '', 'jpg', 22893, 1296213871, 'textbooks/', NULL, NULL, NULL, NULL),
(187, 'textbooks', '~41K10KK4Y2L', '~41K10KK4Y2L', '', 'jpg', 28619, 1296213938, 'textbooks/', NULL, NULL, NULL, NULL),
(188, 'textbooks', '~51yEgqyNZvL', '~51yEgqyNZvL', '', 'jpg', 37816, 1296214591, 'textbooks/', NULL, NULL, NULL, NULL),
(189, 'textbooks', '~5158jyDKmL', '~5158jyDKmL', '', 'jpg', 38881, 1296220757, 'textbooks/', NULL, NULL, NULL, NULL),
(190, 'textbooks', '~5158jyDKmL', '~5158jyDKmL', '', 'jpg', 38881, 1296220838, 'textbooks/', NULL, NULL, NULL, NULL),
(191, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296224897, 'textbooks/', NULL, NULL, NULL, NULL),
(192, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1296224903, 'textbooks/', NULL, NULL, NULL, NULL),
(193, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1296225301, 'textbooks/', NULL, NULL, NULL, NULL),
(194, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1296238393, 'textbooks/', NULL, NULL, NULL, NULL),
(195, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1296238397, 'textbooks/', NULL, NULL, NULL, NULL),
(196, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1296238527, 'textbooks/', NULL, NULL, NULL, NULL),
(197, 'textbooks', '~51lANxLzXgL', '~51lANxLzXgL', '', 'jpg', 39770, 1296244004, 'textbooks/', NULL, NULL, NULL, NULL),
(198, 'textbooks', '~51lANxLzXgL', '~51lANxLzXgL', '', 'jpg', 39770, 1296244054, 'textbooks/', NULL, NULL, NULL, NULL),
(199, 'textbooks', '~512BSWgaRSsL', '~512BSWgaRSsL', '', 'jpg', 56821, 1296244538, 'textbooks/', NULL, NULL, NULL, NULL),
(200, 'textbooks', '~51IgLrZw3vL', '~51IgLrZw3vL', '', 'jpg', 44362, 1296244542, 'textbooks/', NULL, NULL, NULL, NULL),
(201, 'textbooks', '~51ko2BRYAmXL', '~51ko2BRYAmXL', '', 'jpg', 40538, 1296244546, 'textbooks/', NULL, NULL, NULL, NULL),
(202, 'textbooks', '~51cziHUF43L', '~51cziHUF43L', '', 'jpg', 45008, 1296244550, 'textbooks/', NULL, NULL, NULL, NULL),
(203, 'textbooks', '~517pLuRQtoL', '~517pLuRQtoL', '', 'jpg', 50799, 1296244553, 'textbooks/', NULL, NULL, NULL, NULL),
(204, 'textbooks', '~31gZV2tzNHL', '~31gZV2tzNHL', '', 'jpg', 13060, 1296244618, 'textbooks/', NULL, NULL, NULL, NULL),
(205, 'textbooks', '~51RsZunT1JL', '~51RsZunT1JL', '', 'jpg', 39488, 1296244621, 'textbooks/', NULL, NULL, NULL, NULL),
(206, 'textbooks', '~41L3r1J7qAL', '~41L3r1J7qAL', '', 'jpg', 19948, 1296244624, 'textbooks/', NULL, NULL, NULL, NULL),
(207, 'textbooks', '~61oJ5ZDis3L', '~61oJ5ZDis3L', '', 'jpg', 67702, 1296244628, 'textbooks/', NULL, NULL, NULL, NULL),
(208, 'textbooks', '~51PkP2BVG8XL', '~51PkP2BVG8XL', '', 'jpg', 39026, 1296244716, 'textbooks/', NULL, NULL, NULL, NULL),
(209, 'textbooks', '~51sEZqzUIIL', '~51sEZqzUIIL', '', 'jpg', 50886, 1296244719, 'textbooks/', NULL, NULL, NULL, NULL),
(210, 'textbooks', '~51f55JhgLfL', '~51f55JhgLfL', '', 'jpg', 42825, 1296244722, 'textbooks/', NULL, NULL, NULL, NULL),
(211, 'textbooks', '~513BmOOVSiL', '~513BmOOVSiL', '', 'jpg', 50458, 1296244725, 'textbooks/', NULL, NULL, NULL, NULL),
(212, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297147093, 'textbooks/', NULL, NULL, NULL, NULL),
(213, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1297147096, 'textbooks/', NULL, NULL, NULL, NULL),
(214, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297147111, 'textbooks/', NULL, NULL, NULL, NULL),
(215, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1297147114, 'textbooks/', NULL, NULL, NULL, NULL),
(216, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297147137, 'textbooks/', NULL, NULL, NULL, NULL),
(217, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297147144, 'textbooks/', NULL, NULL, NULL, NULL),
(218, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297147276, 'textbooks/', NULL, NULL, NULL, NULL),
(219, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1297147279, 'textbooks/', NULL, NULL, NULL, NULL),
(220, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1297147295, 'textbooks/', NULL, NULL, NULL, NULL),
(221, 'textbooks', '~51mngzUNumL', '~51mngzUNumL', '', 'jpg', 51547, 1297147427, 'textbooks/', NULL, NULL, NULL, NULL),
(222, 'textbooks', '~512BSWgaRSsL', '~512BSWgaRSsL', '', 'jpg', 56821, 1297147431, 'textbooks/', NULL, NULL, NULL, NULL),
(223, 'textbooks', '~51IgLrZw3vL', '~51IgLrZw3vL', '', 'jpg', 44362, 1297147435, 'textbooks/', NULL, NULL, NULL, NULL),
(224, 'textbooks', '~51e5Nr8u2BOL', '~51e5Nr8u2BOL', '', 'jpg', 49199, 1297147439, 'textbooks/', NULL, NULL, NULL, NULL),
(225, 'textbooks', '~51DzG5ginsL', '~51DzG5ginsL', '', 'jpg', 59817, 1297147444, 'textbooks/', NULL, NULL, NULL, NULL),
(226, 'textbooks', '~51mngzUNumL', '~51mngzUNumL', '', 'jpg', 51547, 1297147907, 'textbooks/', NULL, NULL, NULL, NULL),
(227, 'textbooks', '~512BSWgaRSsL', '~512BSWgaRSsL', '', 'jpg', 56821, 1297147910, 'textbooks/', NULL, NULL, NULL, NULL),
(228, 'textbooks', '~51IgLrZw3vL', '~51IgLrZw3vL', '', 'jpg', 44362, 1297147913, 'textbooks/', NULL, NULL, NULL, NULL),
(229, 'textbooks', '~51e5Nr8u2BOL', '~51e5Nr8u2BOL', '', 'jpg', 49199, 1297147915, 'textbooks/', NULL, NULL, NULL, NULL),
(230, 'textbooks', '~51DzG5ginsL', '~51DzG5ginsL', '', 'jpg', 59817, 1297147918, 'textbooks/', NULL, NULL, NULL, NULL),
(231, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297148251, 'textbooks/', NULL, NULL, NULL, NULL),
(232, 'textbooks', '~41QNCLYHNBL', '~41QNCLYHNBL', '', 'jpg', 30654, 1297148253, 'textbooks/', NULL, NULL, NULL, NULL),
(233, 'textbooks', '~51mngzUNumL', '~51mngzUNumL', '', 'jpg', 51547, 1297148345, 'textbooks/', NULL, NULL, NULL, NULL),
(234, 'textbooks', '~512BSWgaRSsL', '~512BSWgaRSsL', '', 'jpg', 56821, 1297148346, 'textbooks/', NULL, NULL, NULL, NULL),
(235, 'textbooks', '~51IgLrZw3vL', '~51IgLrZw3vL', '', 'jpg', 44362, 1297148348, 'textbooks/', NULL, NULL, NULL, NULL),
(236, 'textbooks', '~51e5Nr8u2BOL', '~51e5Nr8u2BOL', '', 'jpg', 49199, 1297148350, 'textbooks/', NULL, NULL, NULL, NULL),
(237, 'textbooks', '~51DzG5ginsL', '~51DzG5ginsL', '', 'jpg', 59817, 1297148353, 'textbooks/', NULL, NULL, NULL, NULL),
(238, 'textbooks', '~414rVzpHaML', '~414rVzpHaML', '', 'jpg', 25064, 1297148357, 'textbooks/', NULL, NULL, NULL, NULL),
(239, 'textbooks', '~51C36HBF2RL', '~51C36HBF2RL', '', 'jpg', 45436, 1297148393, 'textbooks/', NULL, NULL, NULL, NULL),
(240, 'textbooks', '~41LWW3i45EL', '~41LWW3i45EL', '', 'jpg', 31929, 1297148395, 'textbooks/', NULL, NULL, NULL, NULL),
(241, 'textbooks', '~31gZV2tzNHL', '~31gZV2tzNHL', '', 'jpg', 13060, 1297148541, 'textbooks/', NULL, NULL, NULL, NULL),
(242, 'textbooks', '~41L3r1J7qAL', '~41L3r1J7qAL', '', 'jpg', 19948, 1297148545, 'textbooks/', NULL, NULL, NULL, NULL),
(243, 'textbooks', '~51BJTW10SRL', '~51BJTW10SRL', '', 'jpg', 45161, 1297148548, 'textbooks/', NULL, NULL, NULL, NULL),
(244, 'textbooks', '~21BfoA2jhwL', '~21BfoA2jhwL', '', 'jpg', 8185, 1297148551, 'textbooks/', NULL, NULL, NULL, NULL),
(245, 'textbooks', '~51mngzUNumL', '~51mngzUNumL', '', 'jpg', 51547, 1297148695, 'textbooks/', NULL, NULL, NULL, NULL),
(246, 'textbooks', '~512BSWgaRSsL', '~512BSWgaRSsL', '', 'jpg', 56821, 1297148698, 'textbooks/', NULL, NULL, NULL, NULL),
(247, 'textbooks', '~51IgLrZw3vL', '~51IgLrZw3vL', '', 'jpg', 44362, 1297148699, 'textbooks/', NULL, NULL, NULL, NULL),
(248, 'textbooks', '~51e5Nr8u2BOL', '~51e5Nr8u2BOL', '', 'jpg', 49199, 1297148701, 'textbooks/', NULL, NULL, NULL, NULL),
(249, 'textbooks', '~51DzG5ginsL', '~51DzG5ginsL', '', 'jpg', 59817, 1297148703, 'textbooks/', NULL, NULL, NULL, NULL),
(250, 'textbooks', '~51C5sMBJ2B6L', '~51C5sMBJ2B6L', '', 'jpg', 45218, 1297156096, 'textbooks/', NULL, NULL, NULL, NULL),
(251, 'textbooks', '~51C5sMBJ2B6L', '~51C5sMBJ2B6L', '', 'jpg', 45218, 1297156967, 'textbooks/', NULL, NULL, NULL, NULL),
(252, 'textbooks', '~51vEyYZVhsL', '~51vEyYZVhsL', '', 'jpg', 36413, 1297158436, 'textbooks/', NULL, NULL, NULL, NULL),
(253, 'textbooks', '~51C5sMBJ2B6L', '~51C5sMBJ2B6L', '', 'jpg', 45218, 1297158687, 'textbooks/', NULL, NULL, NULL, NULL),
(254, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297215961, 'textbooks/', NULL, NULL, NULL, NULL),
(255, 'textbooks', '~51xUmFAz2BVL', '~51xUmFAz2BVL', '', 'jpg', 34199, 1297215991, 'textbooks/', NULL, NULL, NULL, NULL),
(256, 'textbooks', '~414rVzpHaML', '~414rVzpHaML', '', 'jpg', 25064, 1297811932, 'textbooks/', NULL, NULL, NULL, NULL),
(257, 'users', '~article128464609EDF8AD000005DC731_634x472', '~article128464609EDF8AD000005DC731_634x472', '', 'jpg', 82492, 1298275051, 'users/', NULL, NULL, NULL, NULL),
(258, 'messages', '~a', '~a', '', 'jpeg', 38969, 1298275164, 'messages/', NULL, NULL, NULL, NULL),
(259, 'messages', '~a', '~a', '', 'jpeg', 38969, 1298275350, 'messages/', NULL, NULL, NULL, NULL),
(278, NULL, '~51fHlS9vK2L', '~51fHlS9vK2L', '', 'jpg', 22182, 1304674378, 'textbooks/', NULL, NULL, NULL, NULL),
(279, 'textbooks', '~41XuGYKUUEL', '~41XuGYKUUEL', '', 'jpg', 31117, 1304674541, 'textbooks/', NULL, NULL, NULL, NULL),
(280, 'textbooks', '~41XuGYKUUEL', '~41XuGYKUUEL', '', 'jpg', 31117, 1304674622, 'textbooks/', NULL, NULL, NULL, NULL),
(281, 'messages', '~BelmontHarbor_ROW65647768', '~BelmontHarbor_ROW65647768', '', 'jpg', 84249, 1307945703, 'messages/', NULL, NULL, NULL, NULL),
(282, 'textbooks', '~512Bj7YLtawL', '~512Bj7YLtawL', '', 'jpg', 45353, 1308815231, 'textbooks/', NULL, NULL, NULL, NULL),
(283, 'textbooks', '~511nmwhtB4L', '~511nmwhtB4L', '', 'jpg', 48095, 1308815237, 'textbooks/', NULL, NULL, NULL, NULL),
(284, 'textbooks', '~512Bj7YLtawL', '~512Bj7YLtawL', '', 'jpg', 45353, 1308815378, 'textbooks/', NULL, NULL, NULL, NULL),
(285, 'textbooks', '~511nmwhtB4L', '~511nmwhtB4L', '', 'jpg', 48095, 1308815383, 'textbooks/', NULL, NULL, NULL, NULL),
(286, 'textbooks', '~512Bj7YLtawL', '~512Bj7YLtawL', '', 'jpg', 45353, 1308815412, 'textbooks/', NULL, NULL, NULL, NULL),
(287, 'textbooks', '~511nmwhtB4L', '~511nmwhtB4L', '', 'jpg', 48095, 1308815417, 'textbooks/', NULL, NULL, NULL, NULL),
(288, 'textbooks', '~512Bj7YLtawL', '~512Bj7YLtawL', '', 'jpg', 45353, 1308815733, 'textbooks/', NULL, NULL, NULL, NULL),
(289, 'textbooks', '~512Bj7YLtawL', '~512Bj7YLtawL', '', 'jpg', 45353, 1308816104, 'textbooks/', NULL, NULL, NULL, NULL),
(290, 'textbooks', '~512Bj7YLtawL', '~512Bj7YLtawL', '', 'jpg', 45353, 1308816167, 'textbooks/', NULL, NULL, NULL, NULL),
(291, 'users', '~article128464609EDF8AD000005DC731_634x472', '~article128464609EDF8AD000005DC731_634x472', '', 'jpg', 82492, 1309168279, 'users/', NULL, NULL, NULL, NULL),
(292, 'textbooks', '~41maartS2zL', '~41maartS2zL', '', 'jpg', 26717, 1309232765, 'textbooks/', NULL, NULL, NULL, NULL),
(293, 'textbooks', '~41g3eRIiqL', '~41g3eRIiqL', '', 'jpg', 25591, 1309232770, 'textbooks/', NULL, NULL, NULL, NULL),
(294, 'textbooks', '~41maartS2zL', '~41maartS2zL', '', 'jpg', 26717, 1309233350, 'textbooks/', NULL, NULL, NULL, NULL),
(295, 'textbooks', '~41maartS2zL', '~41maartS2zL', '', 'jpg', 26717, 1309233439, 'textbooks/', NULL, NULL, NULL, NULL),
(296, 'textbooks', '~51kzba2Bz5oL', '~51kzba2Bz5oL', '', 'jpg', 51371, 1309236958, 'textbooks/', NULL, NULL, NULL, NULL),
(297, 'textbooks', '~51qKdwfH8AL', '~51qKdwfH8AL', '', 'jpg', 51690, 1309236965, 'textbooks/', NULL, NULL, NULL, NULL),
(298, 'textbooks', '~51GQ1QmehwL', '~51GQ1QmehwL', '', 'jpg', 39786, 1309314850, 'textbooks/', NULL, NULL, NULL, NULL),
(299, 'textbooks', '~51n1VAbyk1L', '~51n1VAbyk1L', '', 'jpg', 41326, 1309314852, 'textbooks/', NULL, NULL, NULL, NULL),
(300, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309334916, 'textbooks/', NULL, NULL, NULL, NULL),
(301, 'textbooks', '~51yQQNHdMZL', '~51yQQNHdMZL', '', 'jpg', 34343, 1309334922, 'textbooks/', NULL, NULL, NULL, NULL),
(302, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309335191, 'textbooks/', NULL, NULL, NULL, NULL),
(303, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309335267, 'textbooks/', NULL, NULL, NULL, NULL),
(304, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309335620, 'textbooks/', NULL, NULL, NULL, NULL),
(305, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336087, 'textbooks/', NULL, NULL, NULL, NULL),
(306, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336134, 'textbooks/', NULL, NULL, NULL, NULL),
(307, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336283, 'textbooks/', NULL, NULL, NULL, NULL),
(308, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336348, 'textbooks/', NULL, NULL, NULL, NULL),
(309, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336448, 'textbooks/', NULL, NULL, NULL, NULL),
(310, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336508, 'textbooks/', NULL, NULL, NULL, NULL),
(311, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336586, 'textbooks/', NULL, NULL, NULL, NULL),
(312, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309336741, 'textbooks/', NULL, NULL, NULL, NULL),
(313, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337203, 'textbooks/', NULL, NULL, NULL, NULL),
(314, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337248, 'textbooks/', NULL, NULL, NULL, NULL),
(315, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337333, 'textbooks/', NULL, NULL, NULL, NULL),
(316, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337392, 'textbooks/', NULL, NULL, NULL, NULL),
(317, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337410, 'textbooks/', NULL, NULL, NULL, NULL),
(318, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337434, 'textbooks/', NULL, NULL, NULL, NULL),
(319, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337569, 'textbooks/', NULL, NULL, NULL, NULL),
(320, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337666, 'textbooks/', NULL, NULL, NULL, NULL),
(321, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337762, 'textbooks/', NULL, NULL, NULL, NULL),
(322, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309337998, 'textbooks/', NULL, NULL, NULL, NULL),
(323, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338043, 'textbooks/', NULL, NULL, NULL, NULL),
(324, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338115, 'textbooks/', NULL, NULL, NULL, NULL),
(325, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338133, 'textbooks/', NULL, NULL, NULL, NULL),
(326, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338380, 'textbooks/', NULL, NULL, NULL, NULL),
(327, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338388, 'textbooks/', NULL, NULL, NULL, NULL),
(328, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338577, 'textbooks/', NULL, NULL, NULL, NULL),
(329, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338645, 'textbooks/', NULL, NULL, NULL, NULL),
(330, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309338897, 'textbooks/', NULL, NULL, NULL, NULL),
(331, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309339451, 'textbooks/', NULL, NULL, NULL, NULL),
(332, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309339470, 'textbooks/', NULL, NULL, NULL, NULL),
(333, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309339490, 'textbooks/', NULL, NULL, NULL, NULL),
(334, 'textbooks', '~41ltPHMIdRL', '~41ltPHMIdRL', '', 'jpg', 26956, 1309339619, 'textbooks/', NULL, NULL, NULL, NULL),
(335, 'textbooks', '~51JrrvdP3qL', '~51JrrvdP3qL', '', 'jpg', 41783, 1309486418, 'textbooks/', NULL, NULL, NULL, NULL),
(336, 'textbooks', '~51onH2H6NHL', '~51onH2H6NHL', '', 'jpg', 46304, 1309486424, 'textbooks/', NULL, NULL, NULL, NULL),
(337, 'textbooks', '~51JrrvdP3qL', '~51JrrvdP3qL', '', 'jpg', 41783, 1309486573, 'textbooks/', NULL, NULL, NULL, NULL),
(338, 'textbooks', '~51JrrvdP3qL', '~51JrrvdP3qL', '', 'jpg', 41783, 1309488318, 'textbooks/', NULL, NULL, NULL, NULL),
(339, 'textbooks', '~41gAUNOIfWL', '~41gAUNOIfWL', '', 'jpg', 30683, 1311236389, 'textbooks/', NULL, NULL, NULL, NULL),
(340, 'textbooks', '~51senddjRLL', '~51senddjRLL', '', 'jpg', 34964, 1311236392, 'textbooks/', NULL, NULL, NULL, NULL),
(341, 'textbooks', '~51DIJgj5K2L', '~51DIJgj5K2L', '', 'jpg', 54740, 1311236858, 'textbooks/', NULL, NULL, NULL, NULL),
(342, 'textbooks', '~514f2Q3iI6L', '~514f2Q3iI6L', '', 'jpg', 57363, 1311236861, 'textbooks/', NULL, NULL, NULL, NULL),
(343, 'textbooks', '~51DIJgj5K2L', '~51DIJgj5K2L', '', 'jpg', 54740, 1311237062, 'textbooks/', NULL, NULL, NULL, NULL),
(344, 'textbooks', '~514f2Q3iI6L', '~514f2Q3iI6L', '', 'jpg', 57363, 1311237064, 'textbooks/', NULL, NULL, NULL, NULL),
(345, 'textbooks', '~51DIJgj5K2L', '~51DIJgj5K2L', '', 'jpg', 54740, 1311237231, 'textbooks/', NULL, NULL, NULL, NULL),
(346, 'textbooks', '~514f2Q3iI6L', '~514f2Q3iI6L', '', 'jpg', 57363, 1311237235, 'textbooks/', NULL, NULL, NULL, NULL),
(347, 'textbooks', '~51tvbmn5sKL', '~51tvbmn5sKL', '', 'jpg', 49332, 1311237294, 'textbooks/', NULL, NULL, NULL, NULL),
(348, 'textbooks', '~51kiVSRY3UL', '~51kiVSRY3UL', '', 'jpg', 40048, 1311237295, 'textbooks/', NULL, NULL, NULL, NULL),
(349, 'textbooks', '~51X7MrJd72BL', '~51X7MrJd72BL', '', 'jpg', 47754, 1311237297, 'textbooks/', NULL, NULL, NULL, NULL),
(350, 'textbooks', '~51tvbmn5sKL', '~51tvbmn5sKL', '', 'jpg', 49332, 1311237336, 'textbooks/', NULL, NULL, NULL, NULL),
(351, 'textbooks', '~51kiVSRY3UL', '~51kiVSRY3UL', '', 'jpg', 40048, 1311237342, 'textbooks/', NULL, NULL, NULL, NULL),
(352, 'textbooks', '~51X7MrJd72BL', '~51X7MrJd72BL', '', 'jpg', 47754, 1311237347, 'textbooks/', NULL, NULL, NULL, NULL),
(353, 'messages', '~banner', '~banner', '', 'png', 241165, 1311582833, 'messages/', NULL, NULL, NULL, NULL),
(354, 'users', '~SanBoldoPas', '~SanBoldoPas', '', 'jpg', 82280, 1311673814, 'users/', NULL, NULL, NULL, NULL),
(355, 'users', '~SanBoldoPas', '~SanBoldoPas', '', 'jpg', 82280, 1311673975, 'users/', NULL, NULL, NULL, NULL),
(356, 'users', '~body_bg', '~body_bg', '', 'jpg', 36319, 1311674868, 'classifieds/', NULL, NULL, NULL, NULL),
(357, 'users', '~body_bg', '~body_bg', '', 'jpg', 36319, 1311733022, 'classifieds/', NULL, NULL, NULL, NULL),
(358, 'users', '~body_bg', '~body_bg', '', 'jpg', 36319, 1311733139, 'classifieds/', NULL, NULL, NULL, NULL),
(359, 'users', '~body_bg', '~body_bg', '', 'jpg', 36319, 1311733734, 'classifieds/', NULL, NULL, NULL, NULL),
(360, 'users', '~body_bg', '~body_bg', '', 'jpg', 36319, 1311733734, 'classifieds/', NULL, NULL, NULL, NULL),
(453, NULL, '~ipodshuffle', '~ipodshuffle', '', 'jpg', 117034, 1312442653, 'icMarket/', NULL, NULL, NULL, NULL),
(454, NULL, '~sofa7', '~sofa7', '', 'jpg', 18014, 1312515306, 'icMarket/', NULL, NULL, NULL, NULL),
(447, 'icMarket', '~MacbookAir', '~MacbookAir', '', 'jpg', 66293, 1312343704, 'icMarket/', NULL, NULL, NULL, NULL),
(448, 'icMarket', '~MacbookAir', '~MacbookAir', '', 'jpg', 66293, 1312343721, 'icMarket/', NULL, NULL, NULL, NULL),
(449, 'icMarket', '~MacbookAir', '~MacbookAir', '', 'jpg', 66293, 1312343725, 'icMarket/', NULL, NULL, NULL, NULL),
(450, 'icMarket', '~MacbookAir', '~MacbookAir', '', 'jpg', 66293, 1312343729, 'icMarket/', NULL, NULL, NULL, NULL),
(451, 'icMarket', '~MacbookAir', '~MacbookAir', '', 'jpg', 66293, 1312343733, 'icMarket/', NULL, NULL, NULL, NULL),
(452, 'icMarket', '~MacbookAir', '~MacbookAir', '', 'jpg', 66293, 1312343743, 'icMarket/', NULL, NULL, NULL, NULL),
(455, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776397, 'icMarket/', NULL, NULL, NULL, NULL),
(456, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776514, 'icMarket/', NULL, NULL, NULL, NULL),
(457, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776525, 'icMarket/', NULL, NULL, NULL, NULL),
(458, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776547, 'icMarket/', NULL, NULL, NULL, NULL),
(459, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776569, 'icMarket/', NULL, NULL, NULL, NULL),
(460, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776668, 'icMarket/', NULL, NULL, NULL, NULL),
(461, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776809, 'icMarket/', NULL, NULL, NULL, NULL),
(462, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776826, 'icMarket/', NULL, NULL, NULL, NULL),
(463, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776882, 'icMarket/', NULL, NULL, NULL, NULL),
(464, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312776962, 'icMarket/', NULL, NULL, NULL, NULL),
(465, NULL, '~ladysg', '~ladysg', '', 'jpg', 148364, 1312778011, 'icMarket/', NULL, NULL, NULL, NULL),
(466, NULL, '~1', '~1', '', 'jpg', 112023, 1312945904, 'icMarket/', NULL, NULL, NULL, NULL),
(467, NULL, '~galaxys_2', '~galaxys_2', '', 'jpg', 32839, 1312945904, 'icMarket/', NULL, NULL, NULL, NULL),
(468, NULL, '~SamsungWaveS8500GalaxySi9000DivxHD', '~SamsungWaveS8500GalaxySi9000DivxHD', '', 'jpg', 87692, 1312945904, 'icMarket/', NULL, NULL, NULL, NULL),
(469, 'icMarket', '~galaxys_2', '~galaxys_2', '', 'jpg', 32839, 1312951423, 'icMarket/', NULL, NULL, NULL, NULL),
(470, 'icMarket', '~VerdonGorge_ROW937720075', '~VerdonGorge_ROW937720075', '', 'jpg', 81719, 1312951423, 'icMarket/', NULL, NULL, NULL, NULL),
(471, 'listings', '~VerdonGorge_ROW937720075', '~VerdonGorge_ROW937720075', '', 'jpg', 81719, 1312951661, 'icMarket/', NULL, NULL, NULL, NULL),
(472, 'listings', '~VerdonGorge_ROW937720075', '~VerdonGorge_ROW937720075', '', 'jpg', 81719, 1312951820, 'icMarket/', NULL, NULL, NULL, NULL),
(473, NULL, '~1', '~1', '', 'jpg', 112023, 1312952514, 'icMarket/', NULL, NULL, NULL, NULL),
(474, NULL, '~galaxys_2', '~galaxys_2', '', 'jpg', 32839, 1312952515, 'icMarket/', NULL, NULL, NULL, NULL),
(475, 'listings', '~VerdonGorge_ROW937720075', '~VerdonGorge_ROW937720075', '', 'jpg', 81719, 1312957532, 'icMarket/', NULL, NULL, NULL, NULL),
(476, 'listings', '~VerdonGorge_ROW937720075', '~VerdonGorge_ROW937720075', '', 'jpg', 81719, 1312959165, 'icMarket/', NULL, NULL, NULL, NULL),
(479, NULL, '~galaxys_2', '~galaxys_2', '', 'jpg', 32839, 1312961566, 'icMarket/', NULL, NULL, NULL, NULL),
(480, NULL, '~galaxys_2', '~galaxys_2', '', 'jpg', 32839, 1312961816, 'icMarket/', NULL, NULL, NULL, NULL),
(481, 'textbooks', '~51VmqkPkVhL', '~51VmqkPkVhL', '', 'jpg', 35035, 1313636311, 'textbooks/', NULL, NULL, NULL, NULL),
(482, NULL, '~top_pic_01_VN', '~top_pic_01_VN', '', 'png', 456639, 1313637353, 'icMarket/', NULL, NULL, NULL, NULL),
(483, 'textbooks', '~4111A463xZL', '~4111A463xZL', '', 'jpg', 30648, 1313648663, 'textbooks/', NULL, NULL, NULL, NULL),
(484, 'textbooks', '~41u62sIINHL', '~41u62sIINHL', '', 'jpg', 28875, 1313648668, 'textbooks/', NULL, NULL, NULL, NULL),
(485, 'textbooks', '~41hBjMOs3L', '~41hBjMOs3L', '', 'jpg', 29177, 1313648671, 'textbooks/', NULL, NULL, NULL, NULL),
(486, 'messages', '~BigSur_JAJP174886926', '~BigSur_JAJP174886926', '', 'jpg', 80995, 1314765084, 'messages/', NULL, NULL, NULL, NULL),
(487, 'messages', '~BihoroPass_JAJP1385149', '~BihoroPass_JAJP1385149', '', 'jpg', 74575, 1314765085, 'messages/', NULL, NULL, NULL, NULL),
(488, 'messages', '~Bamboo_JAJP2272268', '~Bamboo_JAJP2272268', '', 'jpg', 81408, 1314765085, 'messages/', NULL, NULL, NULL, NULL),
(489, 'messages', '~BearButte_ROW78051563', '~BearButte_ROW78051563', '', 'jpg', 75493, 1314765085, 'messages/', NULL, NULL, NULL, NULL),
(490, 'messages', '~BeaverFalls_ROW1496038', '~BeaverFalls_ROW1496038', '', 'jpg', 82115, 1314765086, 'messages/', NULL, NULL, NULL, NULL),
(491, NULL, '~SingaporeFlyer_ROW1541232876', '~SingaporeFlyer_ROW1541232876', '', 'jpg', 83111, 1316078923, 'icMarket/', NULL, NULL, NULL, NULL),
(492, 'messages', '~KarijiniNP_ROW71231931', '~KarijiniNP_ROW71231931', '', 'jpg', 81136, 1316768679, 'messages/', NULL, NULL, NULL, NULL),
(493, NULL, '~51ySXyRK5qL_SL500_AA300_', '~51ySXyRK5qL_SL500_AA300_', '', 'jpg', 18636, 1317174555, 'textbooks/', NULL, NULL, NULL, NULL),
(494, 'textbooks', '~512242IrWmL', '~512242IrWmL', '', 'jpg', 36098, 1317178260, 'textbooks/', NULL, NULL, NULL, NULL),
(495, 'textbooks', '~41ygBmdaIfL', '~41ygBmdaIfL', '', 'jpg', 25431, 1317178476, 'textbooks/', NULL, NULL, NULL, NULL),
(496, 'textbooks', '~51AQkBG2BjvL', '~51AQkBG2BjvL', '', 'jpg', 55990, 1317193674, 'textbooks/', NULL, NULL, NULL, NULL),
(497, 'textbooks', '~512qJmTNIXL', '~512qJmTNIXL', '', 'jpg', 37424, 1317194302, 'textbooks/', NULL, NULL, NULL, NULL),
(498, 'textbooks', '~512qJmTNIXL', '~512qJmTNIXL', '', 'jpg', 37424, 1317194931, 'textbooks/', NULL, NULL, NULL, NULL),
(499, 'textbooks', '~41QizTXOm1L', '~41QizTXOm1L', '', 'jpg', 31482, 1317194946, 'textbooks/', NULL, NULL, NULL, NULL),
(500, 'textbooks', '~417PnODxIhL', '~417PnODxIhL', '', 'jpg', 32577, 1317195039, 'textbooks/', NULL, NULL, NULL, NULL),
(501, 'textbooks', '~51Qdw9ufeFL', '~51Qdw9ufeFL', '', 'jpg', 35090, 1317195042, 'textbooks/', NULL, NULL, NULL, NULL),
(502, 'textbooks', '~41qFjxWqMpL', '~41qFjxWqMpL', '', 'jpg', 32101, 1317195239, 'textbooks/', NULL, NULL, NULL, NULL),
(503, 'textbooks', '~510XydwbYOL', '~510XydwbYOL', '', 'jpg', 51350, 1317195733, 'textbooks/', NULL, NULL, NULL, NULL),
(504, 'textbooks', '~51VmqkPkVhL', '~51VmqkPkVhL', '', 'jpg', 35035, 1317633976, 'textbooks/', NULL, NULL, NULL, NULL),
(505, 'textbooks', '~51VmqkPkVhL', '~51VmqkPkVhL', '', 'jpg', 35035, 1317634258, 'textbooks/', NULL, NULL, NULL, NULL),
(506, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317692303, 'textbooks/', NULL, NULL, NULL, NULL),
(507, 'textbooks', '~518mv6tXMML', '~518mv6tXMML', '', 'jpg', 33260, 1317692312, 'textbooks/', NULL, NULL, NULL, NULL),
(508, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693183, 'textbooks/', NULL, NULL, NULL, NULL),
(509, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693409, 'textbooks/', NULL, NULL, NULL, NULL),
(510, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693464, 'textbooks/', NULL, NULL, NULL, NULL),
(511, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693583, 'textbooks/', NULL, NULL, NULL, NULL),
(512, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693624, 'textbooks/', NULL, NULL, NULL, NULL),
(513, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693767, 'textbooks/', NULL, NULL, NULL, NULL),
(514, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693806, 'textbooks/', NULL, NULL, NULL, NULL),
(515, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317693931, 'textbooks/', NULL, NULL, NULL, NULL),
(516, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317694029, 'textbooks/', NULL, NULL, NULL, NULL),
(517, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317694340, 'textbooks/', NULL, NULL, NULL, NULL),
(518, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317694752, 'textbooks/', NULL, NULL, NULL, NULL),
(519, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317695108, 'textbooks/', NULL, NULL, NULL, NULL),
(520, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317695241, 'textbooks/', NULL, NULL, NULL, NULL),
(521, 'textbooks', '~414UsmkTQvL', '~414UsmkTQvL', '', 'jpg', 30743, 1317695344, 'textbooks/', NULL, NULL, NULL, NULL),
(522, 'icMarket', '~overview_design_20111004', '~overview_design_20111004', '', 'jpg', 83058, 1317866388, 'icMarket/', NULL, NULL, NULL, NULL),
(523, 'icMarket', '~iPhone_4S_o_Nhat', '~iPhone_4S_o_Nhat', '', 'jpg', 20616, 1319014598, 'icMarket/', NULL, NULL, NULL, NULL),
(524, 'icMarket', '~logo', '~logo', '', 'png', 19898, 1319015321, 'icMarket/', NULL, NULL, NULL, NULL),
(525, NULL, '~logo', '~logo', '', 'png', 19898, 1319015375, 'icMarket/', NULL, NULL, NULL, NULL),
(526, 'news', '~4437e612ec821010dd5e21', '~4437e612ec821010dd5e21', '', 'jpg', 94049, 1319616030, 'news/', NULL, NULL, NULL, NULL),
(527, 'messages', '~1266706115714525_AUDl7tzZ_', '~1266706115714525_AUDl7tzZ_', '', 'jpg', 40671, 1341057308, 'messages/', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_file_type`
--

CREATE TABLE IF NOT EXISTS `vsf_file_type` (
  `fileTypeId` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `fileTypeMime` varchar(64) NOT NULL DEFAULT '',
  `fileExtension` varchar(32) NOT NULL DEFAULT '',
  `fileShowHTML` text NOT NULL,
  PRIMARY KEY (`fileTypeId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_friend`
--

CREATE TABLE IF NOT EXISTS `vsf_friend` (
  `friendId` int(10) NOT NULL AUTO_INCREMENT,
  `friendUser` int(10) NOT NULL,
  `friendFriend` int(10) NOT NULL,
  `friendStatus` tinyint(2) NOT NULL DEFAULT '0',
  `friendTime` int(10) NOT NULL,
  PRIMARY KEY (`friendId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `vsf_friend`
--

INSERT INTO `vsf_friend` (`friendId`, `friendUser`, `friendFriend`, `friendStatus`, `friendTime`) VALUES
(3, 7, 28, 1, 1310699304),
(4, 28, 7, 1, 1310699304),
(29, 33, 27, 1, 1314154763),
(27, 28, 42, 0, 1313379076),
(28, 27, 33, 1, 1314154763),
(10, 32, 33, 1, 1310713555),
(11, 33, 32, 1, 1310713555),
(24, 28, 41, 0, 1313139940),
(26, 33, 28, 1, 1313378412),
(30, 32, 7, 1, 1314159133),
(31, 7, 32, 1, 1314159133),
(32, 28, 33, 1, 1313378412),
(40, 28, 32, 1, 1316508270),
(39, 32, 28, 1, 1316508270);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_friend_group`
--

CREATE TABLE IF NOT EXISTS `vsf_friend_group` (
  `groupId` int(10) NOT NULL AUTO_INCREMENT,
  `groupUser` int(10) NOT NULL,
  `groupTitle` varchar(128) NOT NULL,
  `groupIndex` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupId`),
  KEY `labelUser` (`groupUser`,`groupTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `vsf_friend_group`
--

INSERT INTO `vsf_friend_group` (`groupId`, `groupUser`, `groupTitle`, `groupIndex`) VALUES
(2, 28, 'khtn', 0),
(47, 28, 'hau giang', 0),
(35, 28, 'su pham', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_friend_group_detail`
--

CREATE TABLE IF NOT EXISTS `vsf_friend_group_detail` (
  `gdId` int(10) NOT NULL AUTO_INCREMENT,
  `gdGroup` int(10) NOT NULL,
  `gdFriend` int(10) NOT NULL,
  PRIMARY KEY (`gdId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `vsf_friend_group_detail`
--

INSERT INTO `vsf_friend_group_detail` (`gdId`, `gdGroup`, `gdFriend`) VALUES
(16, 35, 33),
(26, 35, 32),
(25, 47, 33),
(27, 47, 32),
(28, 47, 7);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_friend_referral`
--

CREATE TABLE IF NOT EXISTS `vsf_friend_referral` (
  `refId` int(10) NOT NULL AUTO_INCREMENT,
  `refUser` int(10) NOT NULL,
  `refEmail` varchar(128) NOT NULL,
  `refTime` int(10) NOT NULL,
  `refStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`refId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vsf_friend_referral`
--

INSERT INTO `vsf_friend_referral` (`refId`, `refUser`, `refEmail`, `refTime`, `refStatus`) VALUES
(1, 28, 'pandogs@yahoo.com', 1310664470, 0),
(2, 28, 'pandogseo@gmail.com', 1310664470, 0),
(3, 28, 'pandogs@hotmail.com', 1310721590, 0),
(4, 28, 'pandogseo@gmail.com', 1310721590, 0),
(5, 28, 'taotest@gmail.com', 1316490565, 0),
(6, 28, 'taotest@gmail.com', 1316490598, 0),
(7, 28, 'taotest@gmail.com', 1316491008, 0),
(8, 28, 'taotest@gmail.com', 1316491036, 0),
(9, 28, 'yunhaihuang@gmail.com', 1316491532, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_gallery`
--

CREATE TABLE IF NOT EXISTS `vsf_gallery` (
  `galleryId` int(10) NOT NULL AUTO_INCREMENT,
  `galleryObj` int(10) DEFAULT '0',
  `galleryObjCat` int(10) DEFAULT '0',
  `galleryIndex` smallint(4) DEFAULT '0',
  `galleryStatus` tinyint(1) DEFAULT '1',
  `galleryTime` int(10) DEFAULT NULL,
  `galleryCode` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `galleryImage` int(10) DEFAULT NULL,
  PRIMARY KEY (`galleryId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `vsf_gallery`
--

INSERT INTO `vsf_gallery` (`galleryId`, `galleryObj`, `galleryObjCat`, `galleryIndex`, `galleryStatus`, `galleryTime`, `galleryCode`, `galleryImage`) VALUES
(9, 2, 1015, 0, 1, 1312343748, '', NULL),
(10, 4, 1015, 0, 1, 1312442653, '', NULL),
(11, 5, 1015, 0, 1, 1312515306, '', NULL),
(12, 8, 1015, 0, 1, 1312776514, '', NULL),
(13, 9, 1015, 0, 1, 1312776525, '', NULL),
(14, 10, 1015, 0, 1, 1312776547, '', NULL),
(15, 11, 1015, 0, 1, 1312776569, '', NULL),
(16, 12, 1015, 0, 1, 1312776668, '', NULL),
(21, 23, 1015, 0, 1, 1312961566, '', NULL),
(22, 25, 1015, 0, 1, 1312961816, '', NULL),
(23, 26, 1015, 0, 1, 1313637353, '', NULL),
(24, 27, 1015, 0, 1, 1316078923, '', NULL),
(25, 36, 1015, 0, 1, 1317866794, '', NULL),
(26, 38, 1015, 0, 1, 1319014705, '', NULL),
(27, 39, 1015, 0, 1, 1319015328, '', NULL),
(28, 40, 1015, 0, 1, 1319015375, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_gallery_detail`
--

CREATE TABLE IF NOT EXISTS `vsf_gallery_detail` (
  `gdId` int(10) NOT NULL AUTO_INCREMENT,
  `gdGallery` int(10) NOT NULL,
  `gdFile` int(10) NOT NULL,
  `gdStatus` tinyint(1) DEFAULT NULL,
  `gdIndex` tinyint(4) DEFAULT NULL,
  `gdTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`gdId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `vsf_gallery_detail`
--

INSERT INTO `vsf_gallery_detail` (`gdId`, `gdGallery`, `gdFile`, `gdStatus`, `gdIndex`, `gdTime`) VALUES
(2, 9, 452, 1, 0, 1312343748),
(3, 10, 453, 1, 0, 1312442653),
(4, 11, 454, 1, 0, 1312515306),
(5, 12, 456, 1, 0, 1312776514),
(6, 13, 457, 1, 0, 1312776525),
(7, 14, 458, 1, 0, 1312776547),
(8, 15, 459, 1, 0, 1312776569),
(9, 16, 460, 1, 0, 1312776668),
(21, 21, 479, 1, 0, 1312961566),
(22, 22, 480, 1, 0, 1312961816),
(23, 23, 482, 1, 0, 1313637353),
(24, 24, 491, 1, 0, 1316078923),
(25, 25, 522, 1, 0, 1317866794),
(26, 26, 523, 1, 0, 1319014705),
(27, 27, 524, 1, 0, 1319015328),
(28, 28, 525, 1, 0, 1319015375);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_gallery_info`
--

CREATE TABLE IF NOT EXISTS `vsf_gallery_info` (
  `giId` int(10) NOT NULL AUTO_INCREMENT,
  `giGallery` int(10) DEFAULT '0',
  `giTitle` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `giContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`giId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_icmarket`
--

CREATE TABLE IF NOT EXISTS `vsf_icmarket` (
  `cfId` int(10) NOT NULL AUTO_INCREMENT,
  `cfCatId` int(10) NOT NULL,
  `cfUser` int(10) NOT NULL,
  `cfTitle` varchar(512) DEFAULT NULL,
  `cfContent` text,
  `cfCondition` int(10) DEFAULT NULL,
  `cfPrice` double DEFAULT NULL,
  `cfCampus` varchar(512) DEFAULT NULL,
  `cfLocation` varchar(256) DEFAULT NULL,
  `cfGallery` int(10) DEFAULT '0',
  `cfTime` int(10) NOT NULL,
  PRIMARY KEY (`cfId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `vsf_icmarket`
--

INSERT INTO `vsf_icmarket` (`cfId`, `cfCatId`, `cfUser`, `cfTitle`, `cfContent`, `cfCondition`, `cfPrice`, `cfCampus`, `cfLocation`, `cfGallery`, `cfTime`) VALUES
(1, 995, 28, 'iphone 3', 'This fast and powerful iPhone features a high-quality 3.0-megapixel digital camera that shoots VGA video with audio, convenient voice-controlled operation and a host of apps that can be tailored to best fit your way of life. Share your answers. ', 1001, 500, 'cambrigde', 'saigon', 1, 1311781320),
(10, 995, 28, 'A multimedia superphone in the palm of your hand ', 'Want to be entertained like never before? On-demand movies look great with a stunning qHD display, and they sound crystal clear with Hi-Fi audio technology. The HTC Sensation also includes an immersive HTC Sense experience making this phone easy-to-use and a top entertainer. The premium design, complete with contoured glass edging, feels great in your hand. The HTC Sensation is a multimedia superphone.', 1002, 300, 'harvard', 'saigon', 1, 1312425841),
(8, 996, 28, 'mac pro', 'mac pro', 1001, 1000, 'cambrige', 'saigon', 2, 1312353552),
(9, 997, 28, 'mac air', 'mac air', 1002, 1000, 'harvard', 'saigon', 3, 1312353674),
(11, 998, 28, 'Bobkona Manhattan Reversible Microfiber 3-Piece Sectional Sofa with Faux Leather Ottoman in Sage Color', 'Bobkona Manhattan Reversible Microfiber 3-Piece Sectional Sofa with Faux Leather Ottoman in Sage Color ', 1002, 300, 'harvard', 'saigon', 2, 1312531601),
(12, 997, 28, 'Ipod shuffle', 'Its main body is crafted from a single piece of aluminum and polished to a beautiful shine, so the new iPod shuffle feels solid, sleek and durable. And the color palette makes it the perfect fashion accessory. Choose gleaming silver, blue, green, orange, or pink. ', 1002, 150, 'harvard', 'saigon', 3, 1312531686),
(13, 995, 7, 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'Phone, iPod, and Internet device in one, iPhone 3G offers desktop-class email, an amazing maps application, and Safari - mobile web browser. With fast 3G wireless technology, GPS mapping, support for enterprise features like Microsoft Exchange, and the App Store, iPhone 3G puts even more features at your fingertips. And like the original iPhone, it combines three products in one - a revolutionary phone, a widescreen iPod, and a breakthrough Internet device with rich HTML email and a desktop-class web browser. iPhone 3G. It redefines what a mobile phone can do - again.', 1001, 300, 'San Jose State University', 'San Jose, CA', 4, 1312585649),
(14, 995, 7, 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'Phone, iPod, and Internet device in one, iPhone 3G offers desktop-class email, an amazing maps application, and Safari - mobile web browser. With fast 3G wireless technology, GPS mapping, support for enterprise features like Microsoft Exchange, and the App Store, iPhone 3G puts even more features at your fingertips. And like the original iPhone, it combines three products in one - a revolutionary phone, a widescreen iPod, and a breakthrough Internet device with rich HTML email and a desktop-class web browser. iPhone 3G. It redefines what a mobile phone can do - again.', 1001, 300, 'San Jose State University', 'San Jose, CA', 5, 1312585772),
(15, 995, 7, 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'Phone, iPod, and Internet device in one, iPhone 3G offers desktop-class email, an amazing maps application, and Safari - mobile web browser. With fast 3G wireless technology, GPS mapping, support for enterprise features like Microsoft Exchange, and the App Store, iPhone 3G puts even more features at your fingertips. And like the original iPhone, it combines three products in one - a revolutionary phone, a widescreen iPod, and a breakthrough Internet device with rich HTML email and a desktop-class web browser. iPhone 3G. It redefines what a mobile phone can do - again.', 1002, 300, 'San Jose State University', 'San Jose, CA', 6, 1312586312),
(16, 995, 7, 'HTC EVO 4G - Black (Sprint) Smartphone', 'The sleek and modern HTC EVO 4G mobile provides excellent performance. This HTC smartphone features the WiFi capability, which allows you to access the internet at a great speed. Featuring the 4.3-inch touchscreen display, this HTC EVO cell phone allows you to access every application smoothly and lets you view photos and videos too. The HTC EVO 4G mobile features 8 megapixel camera with auto Focus and 2x LED Flash, and 1.3 megapixel front facing camera for capturing your special moments. The 2.1 Bluetooth technology of this HTC smartphone allows you quickly share and transfer data with other compatible devices. This HTC EVO cell phone has 4G network, which allows you stream and upload online content from the web faster.', 1002, 256.78878, 'San Jose State University', 'San Jose, CA', 7, 1312587207),
(17, 995, 7, 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'The sleek and modern HTC EVO 4G mobile provides excellent performance. This HTC smartphone features the WiFi capability, which allows you to access the internet at a great speed. Featuring the 4.3-inch touchscreen display, this HTC EVO cell phone allows you to access every application smoothly and lets you view photos and videos too. The HTC EVO 4G mobile features 8 megapixel camera with auto Focus and 2x LED Flash, and 1.3 megapixel front facing camera for capturing your special moments. The 2.1 Bluetooth technology of this HTC smartphone allows you quickly share and transfer data with other compatible devices. This HTC EVO cell phone has 4G network, which allows you stream and upload online content from the web faster.', 1001, 256.423849238941, 'San Jose State University', 'San Jose, CA', 8, 1312587856),
(18, 995, 7, 'Samsung Galaxy S i897 Captivate ', 'Get enhanced performance with the 1GHz Hummingbird processor of the Samsung Galaxy S Captivate smartphone. Integrated with the Android 2.2 operating system, this Samsung smartphone lets you access multiple advanced applications. The threaded messaging feature, virtual QWERTY keyboard, and the Swype technology of this Samsung Android phone provides a flawless texting experience. The AllShare function of the Galaxy S Captivate phone lets you easily share content with DLNA Certified devices. Store your pictures, videos clips, etc., on the expandable 32GB storage of this Samsung Android phone. Stay connected with your friends via Facebook, MySpace, and Twitter, with the help of WiFi connectivity of this Samsung smartphone. The Galaxy S Captivate phone comes with a 5MP camera, letting your capture sharp images and videos.', 1002, 350, 'San Jose State University', 'Milpitas, CA', 9, 1312588722),
(19, 996, 45, 'macbookpro', 'brand new come with blackberry', 1002, 1000, 'san jose state university ', 'san jose', NULL, 1312670206),
(20, 997, 27, 'ipad', 'ipad 2 version', 1002, 450, 'san jose state university ', '', 10, 1312670412),
(21, 995, 7, 'BlackBerry Storm 9530 - 1GB - Black (Unlocked) Smartphone  ', 'Bring your BlackBerry Storm smartphone to life with the power of your touch. Browse, play, share, communicate and organize your world - all from your fingertips.', 1001, 305, 'San Jose State University', 'San Jose, CA', 11, 1312670625),
(22, 995, 27, 'android phone', 'android version 2.2. <br />SAMSUNG phone', 1002, 120, 'CSU east Bay', 'hayward', NULL, 1312670665),
(23, 995, 45, 'iphone5', 'from appla store', 1001, 450, 'san jose state university ', '', NULL, 1312670984),
(24, 996, 45, 'sony vaio', 'sony vaio Tz540', 1002, 450, 'san jose state', '', NULL, 1312672883),
(25, 995, 32, 'Samsung Galaxy S II', 'Taking slim to the next dimension. The Samsung GALAXY S II rides the leading edge with an ultra-slim 8.49mm form factor, a luxurious design and an easy grip. The ultra-slim smartphonealso boasts 3D TouchWiz UX adds to the evolutionary experience with a futuristic user interface.', 1002, 455, 'saigon u', 'saigon', 12, 1312963018),
(26, 998, 7, 'furniture test', 'furniture test', 1002, 10, 'San Jose State University', 'San Jose, CA', 13, 1312995789),
(27, 995, 7, 'BlackBerry Storm 9530 - 1GB - Black (Unlocked) Smartphone', 'BlackBerry Storm 9530 - 1GB - Black (Unlocked) Smartphone', 1002, 10, 'San Jose State University', 'San Jose, CA', 20, 1313043139),
(28, 998, 7, 'furniture test 2', 'furniture test 2. furniture test 2......<br />', 1001, 2000, 'Mission College', 'Santa Clara, CA', 14, 1313103936),
(29, 998, 7, 'furniture test 3', 'furniture test 3, furniture test 3', 1002, 5000, 'San Jose City College', 'San Jose, CA', 15, 1313104092),
(30, 998, 28, 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Mushroom', 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Mushroom', 1002, 200, 'saigon', '', 16, 1313566388),
(31, 997, 28, 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Sage', 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Sage', 1002, 600, 'saigon', 'saigon', 17, 1313566613),
(32, 997, 28, 'Canon Powershot A1200 12.1 MP Digital Camera with 4x Optical Zoom', 'WThe PowerShot A1200 digital camera gives you a choice thatâ€™s getting increasingly hard to find on digital cameras today. Itâ€™s equipped with an Optical Viewfinder in addition to the LCD screen. Many photographers prefer this classic, familiar option that lets you simply hold the camera to your eye and shoot.<br />The cameraâ€™s big, bright LCD screen gives you a wealth of important information about the shot. However, using it to compose and focus requires that you hold the camera away from your body. Many people do this with one hand, arms away from the body, effectively creating camera shake that can distort a shot. Using the Optical Viewfinder helps ensure that the camera is held steady.', 1002, 200, '', '', 18, 1313642036),
(33, 998, 7, 'furniture test 4', 'furniture test 4 furniture test 4 furniture test 4<br />furniture test 4<br />furniture test 4<br />furniture test 4furniture test 4<br /><br />furniture test 4furniture test 4furniture test 4', 1002, 25.8, 'Davis', 'Davis', 19, 1313698410),
(34, 995, 45, 'Motorola Droid 2', 'Android 2.2 OS', 1002, 85, 'San Jose State ', '', NULL, 1314248580),
(36, 996, 28, 'apple ipad 2', 'Two cameras for FaceTime and HD video recording. The dual-core A5 chip. 10-hour battery life.1 Over 200 new software features in iOS 5. And iCloud. All in a remarkably thin, light design. Thereâ€™s so much to iPad, itâ€™s amazing thereâ€™s so little of it.', 1002, 250, 'Mission College', 'saigon', 25, 1317866794),
(37, 996, 28, 'apple ipad 2', 'When you pick up iPad, it becomes an extension of you. Thatâ€™s the idea behind its innovative design. Itâ€™s just 0.34 inch thin and weighs as little as 1.33 pounds, so it feels completely comfortable in your hands.2 And it makes surfing the web, checking email, watching movies, and reading books so natural, youâ€™ll wonder why you ever did it any other way.', 1002, 250, 'Mission College', 'saigon', 0, 1317867146),
(38, 995, 28, 'iphone 4s', 'Siri on iPhone 4S lets you use your voice to send messages, schedule meetings, place phone calls, and more. Ask Siri to do things just by talking the way you talk. Siri understands what you say, knows what you mean, and even talks back. Siri is so easy to use and does so much, youâ€™ll keep finding more and more ways to use it.', 1002, 800, 'Mission College', 'saigon', 26, 1319014705),
(39, 996, 28, 'iphone 4s', 'Siri on iPhone 4S lets you use your voice to send messages, schedule meetings, place phone calls, and more. Ask Siri to do things just by talking the way you talk. Siri understands what you say, knows what you mean, and even talks back. Siri is so easy to use and does so much, youâ€™ll keep finding more and more ways to use it. ', 1002, 800, 'Mission College', 'saigon', 27, 1319015328),
(40, 997, 28, 'iphone 4s', 'Siri on iPhone 4S lets you use your voice to send messages, schedule meetings, place phone calls, and more. Ask Siri to do things just by talking the way you talk. Siri understands what you say, knows what you mean, and even talks back. Siri is so easy to use and does so much, youâ€™ll keep finding more and more ways to use it. ', 1002, 800, 'Mission College', 'saigon', 28, 1319015375);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_langs`
--

CREATE TABLE IF NOT EXISTS `vsf_langs` (
  `langId` smallint(4) NOT NULL AUTO_INCREMENT,
  `langName` varchar(32) NOT NULL,
  `userDefault` tinyint(1) NOT NULL DEFAULT '0',
  `adminDefault` tinyint(1) NOT NULL DEFAULT '0',
  `langFolder` varchar(32) NOT NULL,
  `langStatus` tinyint(1) NOT NULL DEFAULT '1',
  `langSymbol` varchar(32) NOT NULL,
  PRIMARY KEY (`langId`),
  KEY `langDefault` (`userDefault`,`adminDefault`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_langs`
--

INSERT INTO `vsf_langs` (`langId`, `langName`, `userDefault`, `adminDefault`, `langFolder`, `langStatus`, `langSymbol`) VALUES
(1, 'Vietnamese', 0, 0, 'vi', 0, 'vietnam.png'),
(2, 'English', 1, 1, 'en', 1, 'england.png');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_listing_icmarket`
--

CREATE TABLE IF NOT EXISTS `vsf_listing_icmarket` (
  `lcId` int(10) NOT NULL AUTO_INCREMENT,
  `lcObj` int(10) NOT NULL,
  `lcStatus` tinyint(4) NOT NULL DEFAULT '1',
  `lcBuyer` int(10) NOT NULL,
  `lcPrice` double NOT NULL,
  `lcTime` int(10) NOT NULL DEFAULT '0',
  `lcDel` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lcId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `vsf_listing_icmarket`
--

INSERT INTO `vsf_listing_icmarket` (`lcId`, `lcObj`, `lcStatus`, `lcBuyer`, `lcPrice`, `lcTime`, `lcDel`) VALUES
(1, 1, 3, 0, 0, 1316158818, 0),
(2, 2, 3, 0, 0, 1316154382, 1),
(3, 3, 3, 0, 5000, 1312880921, 0),
(4, 4, 3, 0, 0, 1316146171, 1),
(5, 5, 3, 0, 0, 1316145969, 1),
(6, 6, 1, 0, 10000, 0, 1),
(8, 8, 1, 0, 1000, 0, 0),
(9, 9, 1, 0, 1000, 0, 0),
(10, 10, 1, 0, 1000, 0, 0),
(11, 11, 1, 0, 1000, 0, 0),
(12, 12, 1, 0, 1000, 0, 0),
(13, 20, 1, 0, 5, 0, 0),
(14, 21, 1, 0, 500, 0, 0),
(15, 22, 3, 0, 5, 1312964151, 0),
(16, 23, 1, 0, 6, 0, 0),
(17, 24, 1, 0, 6, 0, 0),
(18, 25, 3, 0, 0, 1316145844, 0),
(19, 26, 3, 0, 0, 1316144541, 0),
(20, 27, 3, 0, 0, 1316144118, 0),
(21, 36, 1, 0, 250, 0, 0),
(22, 37, 1, 0, 250, 0, 0),
(23, 38, 1, 0, 800, 0, 0),
(24, 39, 1, 0, 800, 0, 0),
(25, 40, 1, 0, 800, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_listing_textbook`
--

CREATE TABLE IF NOT EXISTS `vsf_listing_textbook` (
  `ltId` int(10) NOT NULL AUTO_INCREMENT,
  `ltTu` int(10) NOT NULL,
  `ltStatus` tinyint(4) NOT NULL,
  `ltBuyer` int(10) NOT NULL,
  `ltPrice` double NOT NULL,
  `ltTime` int(10) NOT NULL,
  `ltDel` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ltId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `vsf_listing_textbook`
--

INSERT INTO `vsf_listing_textbook` (`ltId`, `ltTu`, `ltStatus`, `ltBuyer`, `ltPrice`, `ltTime`, `ltDel`) VALUES
(11, 68, 3, 32, 5, 1309254231, 0),
(12, 69, 3, 32, 10000, 1309254501, 0),
(14, 71, 3, 0, 0, 1309500213, 0),
(17, 74, 3, 0, 0, 1313486474, 0),
(19, 76, 1, 0, 0, 0, 1),
(21, 65, 3, 32, 9999, 1309491278, 0),
(22, 66, 1, 0, 0, 0, 0),
(26, 70, 2, 0, 0, 0, 0),
(28, 72, 2, 0, 0, 0, 1),
(29, 73, 3, 0, 0, 1309499268, 0),
(31, 75, 1, 0, 0, 0, 0),
(33, 77, 2, 0, 0, 0, 0),
(34, 78, 3, 0, 0, 1312211707, 1),
(35, 79, 1, 0, 0, 0, 0),
(36, 80, 1, 0, 0, 0, 0),
(37, 81, 3, 32, 0, 1314072565, 0),
(38, 82, 1, 0, 0, 0, 0),
(39, 83, 2, 0, 0, 0, 0),
(40, 84, 3, 0, 0, 0, 0),
(41, 85, 1, 0, 0, 0, 0),
(42, 86, 1, 0, 0, 0, 0),
(43, 87, 1, 0, 0, 0, 0),
(44, 88, 1, 0, 0, 0, 0),
(45, 89, 1, 0, 0, 0, 0),
(46, 90, 1, 0, 0, 0, 0),
(50, 94, 1, 0, 0, 0, 0),
(49, 93, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_menu`
--

CREATE TABLE IF NOT EXISTS `vsf_menu` (
  `menuId` int(10) NOT NULL AUTO_INCREMENT,
  `langId` smallint(4) unsigned NOT NULL,
  `menuTitle` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuIndex` smallint(4) NOT NULL DEFAULT '0',
  `menuStatus` tinyint(1) NOT NULL DEFAULT '0',
  `menuAlt` varchar(1055) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parentId` int(10) NOT NULL DEFAULT '0',
  `menuIsLink` varchar(60) NOT NULL DEFAULT '0',
  `menuIsDropDown` varchar(20) NOT NULL DEFAULT '0',
  `menuType` varchar(20) NOT NULL DEFAULT '0',
  `menuLevel` tinyint(1) NOT NULL DEFAULT '0',
  `menuPosition` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menuIsAdmin` tinyint(1) DEFAULT '1',
  `menuBackup` varchar(255) NOT NULL,
  `menuFileId` varchar(250) NOT NULL,
  PRIMARY KEY (`menuId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1049 ;

--
-- Dumping data for table `vsf_menu`
--

INSERT INTO `vsf_menu` (`menuId`, `langId`, `menuTitle`, `menuUrl`, `menuIndex`, `menuStatus`, `menuAlt`, `parentId`, `menuIsLink`, `menuIsDropDown`, `menuType`, `menuLevel`, `menuPosition`, `menuIsAdmin`, `menuBackup`, `menuFileId`) VALUES
(2, 1, 'Ná»™i Dung', '', 5, 1, '', 0, '0', '1', '0', 0, '@10000', 1, '', ''),
(3, 1, 'Tiá»‡n Ãch', '', 1, 1, '', 0, '1', '1', '0', 0, '@10000', 1, '', ''),
(81, 2, 'book', 'book', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(6, 1, 'Há»‡ thá»‘ng', 'settings', 25, 1, '', 0, '1', '1', '0', 0, '@10000', 1, '', ''),
(7, 1, 'ThoÃ¡t', 'admins/logout', 30, 1, '', 0, '1', '0', '0', 0, '@10000', 1, '', ''),
(78, 1, 'Quáº£n lÃ½ Campus', 'campuses', 0, 1, '', 2, '1', '0', '0', 1, '@10000', 1, '', ''),
(15, 1, 'Cáº¥u hÃ¬nh há»‡ thá»‘ng', 'settings', 1, 1, 'System vars configuration', 6, '1', '0', '0', 1, '@10000', 1, '', ''),
(16, 1, 'Quáº£n lÃ½ ngÃ´n ngá»¯', 'languages', 5, 1, 'Manage languagues', 6, '1', '0', '0', 1, '@10000', 1, '', ''),
(17, 1, 'Quáº£n lÃ½ giao diá»‡n', 'wrapper', 10, 1, 'Manage skin system', 6, '1', '0', '0', 1, '@1000', 1, '', ''),
(18, 0, 'Categories', '0', 0, 1, 'System categories', 0, '0', '0', '0', 0, '@0000', -1, '', ''),
(21, 1, 'contacts', 'contacts', 0, 0, 'Contacts', 18, '0', '0', '0', 1, '@0000', -1, '', ''),
(28, 1, 'Quáº£n lÃ½ Tin tá»©c', 'news/', 3, 0, '', 2, '1', '0', '0', 1, '@10000', 1, '', ''),
(29, 1, 'Quáº£n lÃ½ Menus', 'menus/', 6, 1, '', 3, '1', '0', '0', 1, '@10000', 1, '', ''),
(23, 1, 'news', 'news', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(45, 1, 'home', 'home', 0, 1, '', 18, '1', '1', '0', 1, '@1', -1, '', ''),
(10, 1, 'supports', 'supports', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(49, 1, 'pages', 'pages', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(57, 1, 'Quáº£n lÃ½ Books', 'books/', 1, 1, '', 2, '1', '0', '0', 1, '@10000', 1, '', ''),
(58, 1, 'gallery', 'gallery', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(66, 1, 'phong kinh doanh', 'supports', 0, 1, '', 10, '1', '0', '0', 2, '@', -1, '', ''),
(62, 1, 'Home', 'home/', 0, 1, '', 0, '1', '0', '0', 0, '@10000', 0, 'pasda', ''),
(67, 1, 'ky thuáº­t', 'supports', 0, 0, '', 10, '1', '0', '0', 2, '@', -1, '', ''),
(68, 1, 'partners', 'partners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(71, 1, 'skins', 'skins', 0, 1, '', 18, '1', '1', '0', 1, '@10000', -1, '', ''),
(72, 1, 'category', 'category', 0, 1, '', 18, '1', '1', '0', 1, '@10000', -1, '', ''),
(75, 1, 'Há»“ bÆ¡i', '', 0, 1, '', 54, '1', '0', '0', 2, '@00000', -1, '', '135'),
(159, 2, 'Fiction &amp; Literature', 'textbooks', 0, 1, '', 153, 'fiction and literature', '0', '0', 2, '@00000', -1, '', ''),
(158, 2, 'Education &amp; Teaching', 'textbooks', 0, 1, '', 153, 'education and teaching', '0', '0', 2, '@00000', -1, '', ''),
(157, 2, 'Cooking', 'textbooks', 0, 1, '', 153, '0', '0', '0', 2, '@00000', -1, '', ''),
(156, 2, 'Computer &amp; Internet', 'textbooks', 0, 1, '', 153, 'computer and internet', '0', '0', 2, '@00000', -1, '', ''),
(106, 2, 'Textbook', 'textbooks', 1, 1, '', 0, '1', '0', '0', 0, '@00001', 0, '', ''),
(107, 2, 'icMarket', 'icMarket', 2, 1, '', 0, '1', '0', '0', 0, '@00001', 0, '', ''),
(95, 2, 'partners', 'partners', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(96, 2, 'pages', 'pages', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(108, 2, 'Ask/Answer Questions', '', 3, 1, '', 0, '1', '0', '0', 0, '@00001', 0, '', ''),
(109, 2, 'Tutor Finder', '', 4, 1, '', 0, '1', '0', '0', 0, '@00001', 0, '', ''),
(110, 2, 'More', '', 5, 1, '', 0, '1', '0', '0', 0, '@00001', 0, '', ''),
(111, 1, 'Quáº£n lÃ½ Users', 'users', 2, 1, '', 2, '1', '0', '0', 1, '@00000', 1, '', ''),
(105, 2, 'Home', 'home', 0, 1, '', 0, '1', '0', '0', 0, '@00001', 0, '', ''),
(119, 1, 'book', 'book', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(125, 2, 'products', 'products', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(128, 2, 'Global', 'partners', 0, 1, '', 95, '0', '0', '0', 2, '@00000', -1, '', ''),
(131, 2, 'Quáº£n lÃ½ Site', '', 0, 1, '', 0, '1', '1', '0', 0, '@10000', 1, '', ''),
(132, 2, 'Quáº£n lÃ½ Textbooks', 'textbooks', 0, 1, '', 131, '1', '0', '0', 1, '@10000', 1, '', ''),
(133, 2, 'Quáº£n lÃ½ Campus', 'campuses', 0, 1, '', 131, '1', '0', '0', 1, '@10000', 1, '', ''),
(134, 2, 'Quáº£n lÃ½ Users', 'users', 0, 1, '', 131, '1', '0', '0', 1, '@10000', 1, '', ''),
(153, 2, 'textbooks', 'textbooks', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(154, 2, 'Business &amp; Economics', 'textbooks', 0, 1, '', 153, 'business and economics', '0', '0', 2, '@00000', -1, '', ''),
(155, 2, 'Children &amp; Teens', 'textbooks', 0, 1, '', 153, 'children and teens', '0', '0', 2, '@00000', -1, '', ''),
(14, 2, 'textbooks', 'textbooks', 0, 1, 'textbooks', 0, '1', '0', '1', 1, '@00000', -1, '', ''),
(248, 2, 'settings', 'settings', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(249, 2, 'settings', 'settings', 0, 1, 'settings', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(250, 2, 'textbooks', 'textbooks', 0, 1, 'textbooks', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(259, 2, 'urlalias', 'urlalias', 0, 1, 'urlalias', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(468, 2, 'type', 'type', 0, 1, 'type', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(464, 2, 'type', 'type', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(447, 2, 'location', 'location', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(448, 2, 'location', 'location', 0, 1, 'location', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(449, 2, 'China', 'location', 0, 1, '', 447, '0', '0', '0', 2, '@00000', -1, '', ''),
(450, 2, 'Beijing', 'location', 0, 1, '', 449, '0', '0', '0', 3, '@00000', -1, '', ''),
(451, 2, 'Shanghai', 'location', 1, 1, '', 449, '0', '0', '0', 3, '@00000', -1, '', ''),
(452, 2, 'Guangzhou', 'location', 2, 1, '', 449, '0', '0', '0', 3, '@00000', -1, '', ''),
(453, 2, 'Hongkong', 'location', 3, 1, '', 449, '0', '0', '0', 3, '@00000', -1, '', ''),
(454, 2, 'Taiwan', 'location', 1, 1, '', 447, '0', '0', '0', 2, '@00000', -1, '', ''),
(455, 2, 'Vietnam', 'location', 2, 1, '', 447, '0', '0', '0', 2, '@00000', -1, '', ''),
(456, 2, 'USA', 'location', 3, 1, '', 447, '0', '0', '0', 2, '@00000', -1, '', ''),
(457, 2, 'Washington', 'location', 0, 1, '', 456, '0', '0', '0', 3, '@00000', -1, '', ''),
(458, 2, 'New York', 'location', 1, 1, '', 456, '0', '0', '0', 3, '@00000', -1, '', ''),
(459, 2, 'California', 'location', 2, 1, '', 456, '0', '0', '0', 3, '@00000', -1, '', ''),
(460, 2, 'condition', 'condition', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(461, 2, 'condition', 'condition', 0, 1, 'condition', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(462, 2, 'Brand new', 'condition', 0, 1, '', 460, '0', '0', '0', 2, '@00000', -1, '', ''),
(463, 2, 'Used', 'condition', 1, 1, '', 460, '0', '0', '0', 2, '@00000', -1, '', ''),
(466, 2, 'Online', 'type', 2, 1, '', 464, 'online', '0', '0', 2, '@00000', -1, '', ''),
(465, 2, 'Local', 'type', 1, 1, '', 464, 'local', '0', '0', 2, '@00000', -1, '', ''),
(467, 2, 'For Rent', 'type', 3, 1, '', 464, 'forrent', '0', '0', 2, '@00000', -1, '', ''),
(299, 2, 'users', 'users', 0, 1, 'users', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(991, 2, 'admins', 'admins', 0, 1, 'admins', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(992, 2, 'friends', 'friends', 0, 1, 'friends', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1014, 2, 'icmarket', 'icmarket', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(993, 2, 'ccategory', 'ccategory', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(994, 2, 'ccategory', 'ccategory', 0, 1, 'ccategory', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(995, 2, 'Cellphones', 'ccategory', 0, 1, '', 993, 'cellphone', '0', '0', 2, '@00000', -1, '', ''),
(996, 2, 'Computers', 'ccategory', 1, 1, '', 993, 'computer', '0', '0', 2, '@00000', -1, '', ''),
(997, 2, 'Electronics', 'ccategory', 2, 1, '', 993, 'electronics', '0', '0', 2, '@00000', -1, '', ''),
(998, 2, 'Funitures', 'ccategory', 3, 1, '', 993, 'funiture', '0', '0', 2, '@00000', -1, '', ''),
(999, 2, 'ccondition', 'ccondition', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1000, 2, 'ccondition', 'ccondition', 0, 1, 'ccondition', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1001, 2, 'New', 'ccondition', 0, 1, '', 999, 'new', '0', '0', 2, '@00000', -1, '', ''),
(1002, 2, 'Used', 'ccondition', 1, 1, '', 999, 'used', '0', '0', 2, '@00000', -1, '', ''),
(1015, 2, 'icmarket', 'icmarket', 0, 1, 'icmarket', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1016, 2, 'relationship', 'relationship', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1017, 2, 'relationship', 'relationship', 0, 1, 'relationship', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1018, 2, 'Single', 'relationship', 0, 1, '', 1016, '0', '0', '0', 2, '@00000', -1, '', ''),
(1019, 2, 'In a relationship', 'relationship', 1, 1, '', 1016, '0', '0', '0', 2, '@00000', -1, '', ''),
(1020, 2, 'Married', 'relationship', 2, 1, '', 1016, '0', '0', '0', 2, '@00000', -1, '', ''),
(1021, 2, 'Divorced', 'relationship', 3, 1, '', 1016, '0', '0', '0', 2, '@00000', -1, '', ''),
(1022, 2, 'Widowed', 'relationship', 4, 1, '', 1016, '0', '0', '0', 2, '@00000', -1, '', ''),
(1023, 2, 'pages', 'pages', 0, 1, 'pages', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1046, 2, 'events', 'events', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1026, 2, 'helpcenter', 'helpcenter', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1027, 2, 'helpcenter', 'helpcenter', 0, 1, 'helpcenter', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1028, 2, 'about', 'about', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1029, 2, 'about', 'about', 0, 1, 'about', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1030, 2, 'home', 'home', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1031, 2, 'About', 'about', 11, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1032, 2, 'Contact', 'contacts', 12, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1033, 2, 'Advertising', '#', 13, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1034, 2, 'Developers', '#', 14, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1035, 2, 'Careers', 'careers', 15, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1036, 2, 'Terms', 'terms', 16, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1037, 2, 'Privacy', 'privacy', 17, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1038, 2, 'Help', 'helpcenter', 18, 1, '', 0, '1', '0', '0', 0, '@00100', 0, '', ''),
(1039, 2, 'contacts', 'contacts', 0, 1, 'contacts', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1040, 2, 'articles', 'articles', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1041, 2, 'articles', 'articles', 0, 1, 'articles', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1042, 2, 'news', 'news', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1043, 2, 'news', 'news', 0, 1, 'news', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1044, 2, 'agreement', 'agreement', 0, 1, '', 18, '1', '1', '0', 1, '@', -1, '', ''),
(1045, 2, 'agreement', 'agreement', 0, 1, 'agreement', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1047, 2, 'events', 'events', 0, 1, 'events', 248, '1', '0', '1', 2, '@00000', -1, '', ''),
(1048, 2, 'partners', 'partners', 0, 1, 'partners', 248, '1', '0', '1', 2, '@00000', -1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message`
--

CREATE TABLE IF NOT EXISTS `vsf_message` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `vsf_message`
--

INSERT INTO `vsf_message` (`messageId`, `messageContent`, `messageFiles`, `messagePostdate`, `messageStatus`, `messageType`, `messageOriginal`, `messageUser`, `messageGroup`) VALUES
(77, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>VAIO E</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/vaio-e-26'' title="VAIO E" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/vaio-e-26</a>. Please check whether the provided information is correct!<br />\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1313637353, 3, 1, 0, -1, 111),
(2, '				Hi yunhaihuang!<br>\n				You have post an textbook, detail at: &nbsp;\n				<a href='''' title=''''>\n					\n				</a>\n				PS: don''t reply this message.', NULL, 1302776680, 3, 1, 0, 0, 36),
(3, '				Hi yunhaihuang!<br>\n				You have post an textbook, detail at: &nbsp;\n				<a href='''' title=''''>\n					\n				</a>\n				PS: don''t reply this message.', NULL, 1302833047, 3, 1, 0, 0, 37),
(4, '				Hi yunhaihuang!<br>\n				You have post an textbook, detail at: &nbsp;\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a>\n				PS: don''t reply this message.', NULL, 1302834416, 3, 1, 0, 0, 38),
(5, '&lt;p&gt;tao test&lt;/p&gt;', NULL, 1302835224, 3, 1, 0, 33, 39),
(6, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838733, 3, 1, 0, 0, 40),
(7, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838748, 3, 1, 0, 0, 41),
(8, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838790, 3, 1, 0, 0, 42),
(9, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838798, 3, 1, 0, 0, 43),
(10, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838811, 3, 1, 0, 0, 44),
(11, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838823, 3, 1, 0, 0, 45),
(12, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838837, 3, 1, 0, 0, 46),
(13, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838881, 3, 1, 0, 0, 47),
(14, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302838894, 3, 1, 0, 0, 48),
(15, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302839014, 3, 1, 0, 0, 49),
(16, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302839131, 3, 1, 0, 0, 50),
(17, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302839162, 3, 1, 0, 0, 51),
(18, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/hello-android-introducing-googles-mobile-development-platform-pragmatic-programmers-22'' title=''Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)''>\n					Hello, Android: Introducing Google&#39;s Mobile Development Platform (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302839206, 3, 1, 0, 0, 52),
(19, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd/textbooks/detail/android-wireless-application-development-2nd-edition-developers-library-'' title="Android Wireless Application Development (2nd Edition) (Developer&#39;s Library)">\n					Android Wireless Application Development (2nd Edition) (Developer&#39;s Library)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1302858043, 3, 1, 0, 0, 53),
(20, '&lt;p&gt;wo aiÂ  ni&lt;/p&gt;', NULL, 1302859192, 3, 1, 0, 28, 54),
(21, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/-'' title="ffafdsafsd">\n					ffafdsafsd\n				</a><br />\n				PS: don''t reply this message.', NULL, 1303202391, 3, 1, 0, 0, 55),
(22, '&lt;p&gt;hello&#33; i want to buy this textbook.&lt;/p&gt;', NULL, 1303351648, -1, 1, 0, 28, 56),
(23, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/pro-drupal-7-development-1'' title="Pro Drupal 7 Development">\n					Pro Drupal 7 Development\n				</a><br />\n				PS: don''t reply this message.', NULL, 1303673932, 3, 1, 0, 0, 57),
(24, '				Hi minhhai!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/pro-drupal-7-development-1'' title="Pro Drupal 7 Development">\n					Pro Drupal 7 Development\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304002626, 3, 1, 0, 0, 58),
(25, '				Hi minhhai!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/android-wireless-application-development-2nd-edition-developers-library-42'' title="Android Wireless Application Development (2nd Edition) (Developer&#39;s Library)">\n					Android Wireless Application Development (2nd Edition) (Developer&#39;s Library)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304009092, 3, 1, 0, 0, 59),
(26, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/agile-web-development-with-rails-pragmatic-programmers-'' title="Agile Web Development with Rails (Pragmatic Programmers)">\n					Agile Web Development with Rails (Pragmatic Programmers)\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304649079, 3, 1, 0, 0, 60),
(27, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/-70'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304667391, 3, 1, 0, 0, 61),
(28, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/-71'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304668883, 3, 1, 0, 0, 62),
(29, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/9781934356081-72'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304669387, 3, 1, 0, 0, 63),
(30, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/9781934356081-73'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304670763, 3, 1, 0, 0, 64),
(31, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/-74'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304670925, 3, 1, 0, 0, 65),
(32, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/9781934356081-75'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304671000, 3, 1, 0, 0, 66),
(33, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/9781934356081-76'' title="9781934356081">\n					9781934356081\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304671226, 3, 1, 0, 0, 67),
(34, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/-64'' title="0321584104">\n					0321584104\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304673175, 3, 1, 0, 0, 68),
(35, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/-65'' title="Ruby on Rails 3 Tutorial: Learn Rails by Example">\n					Ruby on Rails 3 Tutorial: Learn Rails by Example\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304674378, 3, 1, 0, 0, 69),
(36, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/learning-python-powerful-objectoriented-programming-66'' title="Learning Python: Powerful Object-Oriented Programming">\n					Learning Python: Powerful Object-Oriented Programming\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304674716, 3, 1, 0, 0, 70),
(37, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-2967'' title="The Ruby Programming Language">\n					The Ruby Programming Language\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304915997, 3, 1, 0, 0, 71),
(38, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-2968'' title="The Ruby Programming Language">\n					The Ruby Programming Language\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304916357, 3, 1, 0, 0, 72),
(39, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-2969'' title="The Ruby Programming Language">\n					The Ruby Programming Language\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304916400, 3, 1, 0, 0, 73),
(40, '				Hi yunhaihuang!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-2970'' title="The Ruby Programming Language">\n					The Ruby Programming Language\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304916474, 3, 1, 0, 0, 74),
(41, '				Hi minhhai!<br>\n				You have post an textbook.<br />\n				Detail at:\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-2971'' title="The Ruby Programming Language">\n					The Ruby Programming Language\n				</a><br />\n				PS: don''t reply this message.', NULL, 1304917538, 3, 1, 0, 0, 75),
(42, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-art-of-seo-mastering-search-engine-optimization-theory-in-practice-72'' title="The Art of SEO: Mastering Search Engine Optimization (Theory in Practice)" target=''_blank''>\n					The Art of SEO: Mastering Search Engine Optimization (Theory in Practice)\n				</a>', NULL, 1309235078, 3, 1, 0, 0, 76),
(43, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/ranking-number-one-50-essential-seo-tips-to-boost-your-search-engine-results-73'' title="Ranking Number One: 50 Essential SEO Tips To Boost Your Search Engine Results" target=''_blank''>\n					Ranking Number One: 50 Essential SEO Tips To Boost Your Search Engine Results\n				</a>', NULL, 1309237020, 3, 1, 0, 0, 77),
(44, '				Hi yunhaihuang!\r\n				You have post an textbook,\r\n				<a href='''' title="" target=''_blank''>\r\n					\r\n				</a>', NULL, 1309254231, 3, 1, 0, 0, 78),
(45, '				Hi yunhaihuang!\r\n				You have post an textbook,\r\n				<a href='''' title="" target=''_blank''>\r\n					\r\n				</a>', NULL, 1309254501, 3, 1, 0, 0, 79),
(46, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-70/" title="The Ruby Programming Language">The Ruby Programming Language</a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/13" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/13" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/13</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/13" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/13" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/13</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1309254676, 3, 1, 0, 0, 80),
(47, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/search-engine-optimization-seo-secrets-74'' title="Search Engine Optimization (SEO) Secrets" target=''_blank''>\n					Search Engine Optimization (SEO) Secrets\n				</a>', NULL, 1309314914, 3, 1, 0, 0, 81),
(48, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/search-engine-optimization-seo-secrets-74/" title="Search Engine Optimization (SEO) Secrets">Search Engine Optimization (SEO) Secrets</a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/30" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/30" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/30</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/30" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/30" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/30</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1309332029, 3, 1, 0, 0, 82),
(49, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/seo-warrior-75'' title="SEO Warrior" target=''_blank''>\n					SEO Warrior\n				</a>', NULL, 1309339457, 3, 1, 0, 0, 83),
(50, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/seo-warrior-76'' title="SEO Warrior" target=''_blank''>\n					SEO Warrior\n				</a>', NULL, 1309339478, 3, 1, 0, 0, 84),
(51, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/search-engine-optimization-your-visual-blueprint-for-effective-internet-marketing-77'' title="Search Engine Optimization: Your visual blueprint for effective Internet marketing" target=''_blank''>\n					Search Engine Optimization: Your visual blueprint for effective Internet marketing\n				</a>', NULL, 1309486627, 3, 1, 0, 0, 85),
(52, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/seo-warrior-75/" title="SEO Warrior">SEO Warrior</a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/18" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/18" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/18</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/18" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/18" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/18</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1309489195, 3, 1, 0, 0, 86),
(53, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-69/" title="The Ruby Programming Language">The Ruby Programming Language</a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/25" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/25" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/25</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/25" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/25" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/25</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1309491162, 3, 1, 0, 0, 87),
(54, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/ruby-on-rails-3-tutorial-learn-rails-by-example-65/" title="Ruby on Rails 3 Tutorial: Learn Rails by Example">Ruby on Rails 3 Tutorial: Learn Rails by Example</a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/21" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/21" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/21</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/21" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/21" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/21</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1309491278, 3, 1, 0, 0, 88),
(55, '&lt;p&gt;hi hong dao&lt;/p&gt;', NULL, 1311149643, 3, 1, 0, 28, 89),
(56, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/search-engine-optimization-seo-an-hour-a-day-78'' title="Search Engine Optimization (SEO): An Hour a Day" target=''_blank''>\n					Search Engine Optimization (SEO): An Hour a Day\n				</a>', NULL, 1311236686, 3, 1, 0, 0, 90),
(57, '				Hi yunhaihuang!\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/4-79'' title="4" target=''_blank''>\n					4\n				</a>', NULL, 1311666500, 3, 1, 0, 0, 91),
(58, '&lt;p&gt;tao test&lt;/p&gt;', NULL, 1311784600, -1, 1, 0, 28, 92),
(59, '				Hi ducdoan!\n				<a href=''sony vaio'' title="" target=''_blank''>\n					\n				</a>', NULL, 1311787977, 3, 1, 0, 0, 93),
(60, '				Hi ducdoan!\n				<a href=''http://www.icampus.ipd:8080/classifieds/detail/sony-vaio-4'' title="sony vaio" target=''_blank''>\n					sony vaio\n				</a>', NULL, 1311788089, 3, 1, 0, 0, 94),
(61, '				Hi ducdoan!\n				<a href=''http://www.icampus.ipd:8080/classifieds/detail/sony-vaio-4'' title="sony vaio" target=''_blank''>\n					sony vaio\n				</a>', NULL, 1311788161, 3, 1, 0, 0, 95),
(62, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/-/" title=""></a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/1" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/1" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/1</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/1" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/1" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/1</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1312212899, 3, 1, 0, 0, 96),
(63, '&lt;p&gt;tao test&lt;/p&gt;', NULL, 1312338030, -1, 1, 0, 28, 97),
(64, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/-/" title=""></a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/1" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/1" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/1</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/1" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/1" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/1</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1312344389, 3, 1, 0, 0, 98),
(65, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/textbooks/detail/-/" title=""></a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/3" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/3" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/3</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/3" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/3" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/3</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1312426725, 3, 1, 0, 0, 99),
(66, '				Hi !\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>', NULL, 1312964730, 3, 1, 0, 0, 100),
(67, '				Hi minhhai!\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>', NULL, 1312966437, 3, 1, 0, 0, 101),
(68, '				Hi minhhai!\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>', NULL, 1312966457, 3, 1, 0, 0, 102),
(69, '				Hi yunhaihuang!\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>', NULL, 1312966603, 3, 1, 0, 0, 103),
(70, '				Hi minhhai!\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>', NULL, 1312966967, 3, 1, 0, 0, 104),
(71, '				Hi minhhai!\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>', NULL, 1312967103, 3, 1, 0, 0, 105),
(72, '				Hi minhhai!\r\n				yunhai huang wants you to look at this item \r\n				<b>\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>\r\n				</b>\r\n				(<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25\r\n				</a>)\r\n				<br/><br/><br/>\r\n				--iCampux Team--<br/>\r\n				<a href=''http://www.iCampux.com'' title="http://www.iCampux.com" target=''_blank''>http://www.iCampux.com</a>', NULL, 1312967464, 3, 1, 0, 0, 106),
(73, '				Hi hogndoa!\r\n				 wants you to look at this item \r\n				<b>\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>\r\n				</b>\r\n				(<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25\r\n				</a>)\r\n				<br/><br/><br/>\r\n				--iCampux Team--<br/>\r\n				<a href=''http://www.iCampux.com'' title="http://www.iCampux.com" target=''_blank''>http://www.iCampux.com</a>', NULL, 1313142391, 3, 1, 0, 0, 107),
(74, '				Hi fafsadfafd!\r\n				yunhai huang wants you to look at this item \r\n				<b>\r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					Samsung Galaxy S II\r\n				</a>\r\n				</b>\r\n				(<a href=''http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25'' title="Samsung Galaxy S II" target=''_blank''>\r\n					http://www.icampus.ipd:8080/icMarket/detail/samsung-galaxy-s-ii-25\r\n				</a>)\r\n				<br/><br/><br/>\r\n				--iCampux Team--<br/>\r\n				<a href=''http://www.iCampux.com'' title="http://www.iCampux.com" target=''_blank''>http://www.iCampux.com</a>', NULL, 1313142652, 3, 1, 0, 0, 108),
(75, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhaihuang!<br />\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-80'' title="The Ruby Programming Language" target=''_blank''>\n					The Ruby Programming Language\n				</a>', NULL, 1313400220, 3, 1, 0, 0, 109),
(76, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhaihuang!<br />\n				You have post an textbook,\n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/the-ruby-programming-language-81'' title="The Ruby Programming Language" target=''_blank''>\n					The Ruby Programming Language\n				</a>', NULL, 1313401505, 3, 1, 0, 0, 110),
(78, '&lt;p&gt;fsfdaf&lt;/p&gt;', NULL, 1314072182, 3, 1, 0, 32, 112),
(79, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/icMarket/detail/-/" title=""></a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/37" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/37" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/37</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/37" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/37" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/37</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1314072562, 3, 1, 0, 0, 113),
(80, '					Hi minhhai <br />\r\n\r\n					Did you purchase this <b><a href="http://www.icampus.ipd:8080/icMarket/detail/-/" title=""></a></b> from this yunhaihuang? <br />\r\n					\r\n					If YES, Click <a href="http://www.icampus.ipd:8080/listings/transaction/accept/37" title="Click here to verify your purchase">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/accept/37" title="Click here to verify your purchase">http://www.icampus.ipd:8080/listings/transaction/accept/37</a>) to verify your purchase!<br/>\r\n					If NO, Click <a href="http://www.icampus.ipd:8080/listings/transaction/deny/37" title="Click here to report an error">here</a> (<a href="http://www.icampus.ipd:8080/listings/transaction/deny/37" title="Click here to report an error">http://www.icampus.ipd:8080/listings/transaction/deny/37</a>) to report an error! <br /><br />\r\n					<b>If you''ve already done this, please disregard this message! <br /> </b\r\n					Thank you!! <br /> <br />\r\n					\r\n							         \r\n		         	-- iCampux Team -- <br />\r\n		         	<a href="http://www.icampus.ipd:8080" title="http://www.icampus.ipd:8080">http://www.icampus.ipd:8080</a>', NULL, 1314072565, 3, 1, 0, 0, 114),
(81, '&lt;p&gt;fasfasfafds&lt;/p&gt;', NULL, 1314765096, -1, 1, 0, 28, 115),
(82, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>tao test</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/tao-test-27'' title="tao test" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/tao-test-27</a>. Please check whether the provided information is correct!<br /><br />\r\n\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1316078923, 3, 1, 0, -1, 116),
(83, '&lt;p&gt;tao test&lt;/p&gt;', NULL, 1317001017, 3, 1, 0, 28, 117),
(84, '&lt;p&gt;fsafsafdf&lt;/p&gt;', NULL, 1317001359, 3, 1, 0, 28, 118),
(85, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Python Programming: An Introduction to Computer Science</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/python-programming-an-introduction-to-computer-science-82'' title="Python Programming: An Introduction to Computer Science" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/python-programming-an-introduction-to-computer-science-82\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317174555, 3, 1, 0, 0, 119),
(86, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Beginning Ruby: From Novice to Professional</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/beginning-ruby-from-novice-to-professional-83'' title="Beginning Ruby: From Novice to Professional" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/beginning-ruby-from-novice-to-professional-83\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317178449, 3, 1, 0, 0, 120),
(87, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Metaprogramming Ruby: Program Like the Ruby Pros</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/metaprogramming-ruby-program-like-the-ruby-pros-84'' title="Metaprogramming Ruby: Program Like the Ruby Pros" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/metaprogramming-ruby-program-like-the-ruby-pros-84\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317178569, 3, 1, 0, 0, 121),
(88, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Ruby on Rails 3 Tutorial: Learn Rails by Example (Addison-Wesley Professional Ruby Series) </b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/ruby-on-rails-3-tutorial-learn-rails-by-example-addisonwesley-professional-ruby-series-85'' title="Ruby on Rails 3 Tutorial: Learn Rails by Example (Addison-Wesley Professional Ruby Series) " target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/ruby-on-rails-3-tutorial-learn-rails-by-example-addisonwesley-professional-ruby-series-85\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317178621, 3, 1, 0, 0, 122),
(89, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Ruby on Rails 3 Tutorial: Learn Rails by Example</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/ruby-on-rails-3-tutorial-learn-rails-by-example-86'' title="Ruby on Rails 3 Tutorial: Learn Rails by Example" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/ruby-on-rails-3-tutorial-learn-rails-by-example-86\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317178655, 3, 1, 0, 0, 123),
(90, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>ASP.NET 3.5 Application Architecture and Design</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/aspnet-35-application-architecture-and-design-87'' title="ASP.NET 3.5 Application Architecture and Design" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/aspnet-35-application-architecture-and-design-87\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317193968, 3, 1, 0, 0, 124),
(91, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Silverlight 4 Unleashed</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/silverlight-4-unleashed-88'' title="Silverlight 4 Unleashed" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/silverlight-4-unleashed-88\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317194964, 3, 1, 0, 0, 125),
(92, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Microsoft Expression Blend 4 Unleashed</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/microsoft-expression-blend-4-unleashed-89'' title="Microsoft Expression Blend 4 Unleashed" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/microsoft-expression-blend-4-unleashed-89\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317195078, 3, 1, 0, 0, 126),
(93, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>WPF 4 Unleashed</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/wpf-4-unleashed-90'' title="WPF 4 Unleashed" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/wpf-4-unleashed-90\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317195264, 3, 1, 0, 0, 127),
(94, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Programming iOS 4: Fundamentals of iPhone, iPad, and iPod Touch Development</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/programming-ios-4-fundamentals-of-iphone-ipad-and-ipod-touch-development-91'' title="Programming iOS 4: Fundamentals of iPhone, iPad, and iPod Touch Development" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/programming-ios-4-fundamentals-of-iphone-ipad-and-ipod-touch-development-91\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317634070, 3, 1, 0, 0, 128),
(95, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Programming iOS 4: Fundamentals of iPhone, iPad, and iPod Touch Development</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/programming-ios-4-fundamentals-of-iphone-ipad-and-ipod-touch-development-92'' title="Programming iOS 4: Fundamentals of iPhone, iPad, and iPod Touch Development" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/programming-ios-4-fundamentals-of-iphone-ipad-and-ipod-touch-development-92\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317634387, 3, 1, 0, 0, 129);
INSERT INTO `vsf_message` (`messageId`, `messageContent`, `messageFiles`, `messagePostdate`, `messageStatus`, `messageType`, `messageOriginal`, `messageUser`, `messageGroup`) VALUES
(96, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>Microsoft Expression Blend 4 Unleashed</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/microsoft-expression-blend-4-unleashed-93'' title="Microsoft Expression Blend 4 Unleashed" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/microsoft-expression-blend-4-unleashed-93\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1317697024, 3, 1, 0, 0, 130),
(97, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>apple ipad 2</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/apple-ipad-2-36'' title="apple ipad 2" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/apple-ipad-2-36</a>. Please check whether the provided information is correct!<br /><br />\r\n\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1317866794, 3, 1, 0, -1, 131),
(98, '				<img src=''http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg'' alt=''icampux.com'' /> <br><br/>\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>apple ipad 2</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/apple-ipad-2-37'' title="apple ipad 2" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/apple-ipad-2-37</a>. Please check whether the provided information is correct!<br /><br />\r\n\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1317867146, 3, 1, 0, -1, 132),
(99, '				<a href="http://www.icampus.ipd:8080" title=''iCampux''>\r\n				<img src="http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg" alt=''http://www.icampus.ipd:8080''/>\r\n				</a><br />\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>iphone 4s</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/iphone-4s-38'' title="iphone 4s" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/iphone-4s-38</a>. Please check whether the provided information is correct!<br /><br />\r\n\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1319014706, 3, 1, 0, -1, 133),
(100, '				<a href="http://www.icampus.ipd:8080" title=''iCampux''>\r\n				<img src="http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg" alt=''http://www.icampus.ipd:8080''/>\r\n				</a><br />\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>iphone 4s</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/iphone-4s-39'' title="iphone 4s" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/iphone-4s-39</a>. Please check whether the provided information is correct!<br /><br />\r\n\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1319015328, 3, 1, 0, -1, 134),
(101, '				<a href="http://www.icampus.ipd:8080" title=''iCampux''>\r\n				<img src="http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg" alt=''http://www.icampus.ipd:8080''/>\r\n				</a><br />\r\n				\r\n				\r\n				Hi yunhai huang!<br /><br />\r\n				Your item <b>iphone 4s</b> is listed here \r\n				<a href=''http://www.icampus.ipd:8080/icMarket/detail/iphone-4s-40'' title="iphone 4s" target=''_blank''>http://www.icampus.ipd:8080/icMarket/detail/iphone-4s-40</a>. Please check whether the provided information is correct!<br /><br />\r\n\r\n				You can also modify it here \r\n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your item" target=''_blank''>\r\n					http://www.icampus.ipd:8080/listings/mylisting\r\n				</a><br /><br />\r\n				Thank you for using iCampux!\r\n				<br /><br /><br />\r\n				--iCampux Team--<br />\r\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\r\n					http://www.icampus.ipd:8080\r\n				</a>', NULL, 1319015376, 3, 1, 0, -1, 135),
(102, '				<a href="http://www.icampus.ipd:8080" title=''iCampux''>\n				<img src="http://www.icampus.ipd:8080/skins/user/finance/images/logo.jpg" alt=''http://www.icampus.ipd:8080''/>\n				</a><br />\n				\n				Hi yunhai huang!<br /><br />\n				\n				Your textboook <b>ggfds</b> is listed here \n				<a href=''http://www.icampus.ipd:8080/textbooks/detail/ggfds-94'' title="ggfds" target=''_blank''>\n					http://www.icampus.ipd:8080/textbooks/detail/ggfds-94\n				</a>. Please check whether the provided information is correct! <br /><br />\n				\n				You can also modify it here \n				<a href=''http://www.icampus.ipd:8080/listings/mylisting'' title="You can also modify your textbook" target=''_blank''>\n					http://www.icampus.ipd:8080/listings/mylisting\n				</a>\n				<br /><br /><br />\n				--iCampux Team--<br />\n				<a href=''http://www.icampus.ipd:8080'' title="iCampux Team">\n					http://www.icampus.ipd:8080\n				</a>', NULL, 1319082614, 3, 1, 0, 0, 136);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message_deliver`
--

CREATE TABLE IF NOT EXISTS `vsf_message_deliver` (
  `deliverId` int(10) NOT NULL AUTO_INCREMENT,
  `deliverMessage` int(10) NOT NULL,
  `deliverRecipient` int(10) DEFAULT NULL,
  `deliverPostdate` int(10) DEFAULT NULL,
  `deliverStatus` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`deliverId`),
  KEY `deliverReceiver` (`deliverRecipient`),
  KEY `deliverMessage` (`deliverMessage`,`deliverRecipient`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `vsf_message_deliver`
--

INSERT INTO `vsf_message_deliver` (`deliverId`, `deliverMessage`, `deliverRecipient`, `deliverPostdate`, `deliverStatus`) VALUES
(1, 25, 28, 1302776355, 0),
(2, 1, 28, 1302776577, 2),
(3, 2, 28, 1302776680, 0),
(4, 3, 28, 1302833047, 0),
(5, 4, 28, 1302834416, 0),
(6, 5, 28, 1302835224, 0),
(7, 6, 28, 1302838733, 0),
(8, 7, 28, 1302838748, 0),
(9, 8, 28, 1302838790, 0),
(10, 9, 28, 1302838798, 0),
(11, 10, 28, 1302838811, 0),
(12, 11, 28, 1302838823, 0),
(13, 12, 28, 1302838837, 0),
(14, 13, 28, 1302838881, 0),
(15, 14, 28, 1302838894, 0),
(16, 15, 28, 1302839014, 0),
(17, 16, 28, 1302839131, 0),
(18, 17, 28, 1302839162, 0),
(19, 18, 28, 1302839206, 0),
(20, 19, 28, 1302858043, 0),
(21, 20, 33, 1302859192, 2),
(22, 21, 28, 1303202391, 0),
(23, 22, 28, 1303351648, 0),
(24, 23, 28, 1303673932, 0),
(25, 24, 32, 1304002626, 0),
(26, 25, 32, 1304009092, 0),
(27, 26, 28, 1304649079, 0),
(28, 27, 28, 1304667391, 0),
(29, 28, 28, 1304668883, 0),
(30, 29, 28, 1304669387, 0),
(31, 30, 28, 1304670763, 0),
(32, 31, 28, 1304670925, 0),
(33, 32, 28, 1304671000, 0),
(34, 33, 28, 1304671226, 0),
(35, 34, 28, 1304673175, 0),
(36, 35, 28, 1304674378, 0),
(37, 36, 28, 1304674716, 0),
(38, 37, 28, 1304915997, 0),
(39, 38, 28, 1304916357, 0),
(40, 39, 28, 1304916400, 0),
(41, 40, 28, 1304916474, 0),
(42, 41, 32, 1304917538, 0),
(43, 42, 28, 1309235078, 0),
(44, 43, 28, 1309237020, 0),
(45, 44, 32, 1309254231, 0),
(46, 45, 32, 1309254501, 0),
(47, 46, 32, 1309254676, 1),
(48, 47, 28, 1309314914, 0),
(49, 48, 32, 1309332029, 2),
(50, 49, 28, 1309339457, 0),
(51, 50, 28, 1309339478, 0),
(52, 51, 28, 1309486627, 0),
(53, 52, 32, 1309489195, 2),
(54, 53, 32, 1309491162, 2),
(55, 54, 32, 1309491278, 2),
(56, 55, 33, 1311149643, 1),
(57, 56, 28, 1311236686, 0),
(58, 57, 28, 1311666500, 0),
(59, 58, 28, 1311784600, 0),
(60, 59, 7, 1311787977, 1),
(61, 60, 7, 1311788089, 1),
(62, 61, 7, 1311788161, 2),
(63, 62, 32, 1312212899, 2),
(64, 63, 28, 1312338030, 0),
(65, 64, 32, 1312344389, 2),
(66, 65, 32, 1312426725, 2),
(67, 67, 32, 1312966437, 2),
(68, 68, 32, 1312966457, 2),
(69, 69, 28, 1312966603, 0),
(70, 70, 32, 1312966967, 2),
(71, 71, 32, 1312967103, 2),
(72, 72, 32, 1312967464, 1),
(73, 75, 28, 1313400220, 0),
(74, 76, 28, 1313401505, 0),
(75, 77, 28, 1313637353, 0),
(76, 78, 28, 1314072182, 0),
(77, 79, 32, 1314072562, 2),
(78, 80, 32, 1314072565, 2),
(79, 81, 28, 1314765096, 0),
(80, 82, 28, 1316078923, 1),
(81, 83, 33, 1317001017, 2),
(82, 83, 32, 1317001017, 2),
(83, 84, 33, 1317001359, 2),
(84, 84, 28, 1317001359, 1),
(85, 85, 28, 1317174555, 2),
(86, 86, 28, 1317178449, 2),
(87, 87, 28, 1317178569, 2),
(88, 88, 28, 1317178621, 2),
(89, 89, 28, 1317178655, 2),
(90, 90, 28, 1317193968, 2),
(91, 91, 28, 1317194964, 2),
(92, 92, 28, 1317195078, 2),
(93, 93, 28, 1317195264, 2),
(94, 94, 28, 1317634070, 2),
(95, 95, 28, 1317634387, 2),
(96, 96, 28, 1317697024, 2),
(97, 97, 28, 1317866794, 2),
(98, 98, 28, 1317867146, 1),
(99, 99, 28, 1319014706, 2),
(100, 100, 28, 1319015328, 2),
(101, 101, 28, 1319015376, 2),
(102, 102, 28, 1319082614, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message_draft`
--

CREATE TABLE IF NOT EXISTS `vsf_message_draft` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message_file`
--

CREATE TABLE IF NOT EXISTS `vsf_message_file` (
  `objectId` varchar(56) NOT NULL,
  `relId` varchar(56) NOT NULL,
  KEY `objectId` (`objectId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vsf_message_file`
--

INSERT INTO `vsf_message_file` (`objectId`, `relId`) VALUES
('81', '490'),
('81', '489'),
('81', '488'),
('81', '487'),
('81', '486');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message_group`
--

CREATE TABLE IF NOT EXISTS `vsf_message_group` (
  `groupId` int(10) NOT NULL AUTO_INCREMENT,
  `groupTitle` varchar(1024) NOT NULL,
  PRIMARY KEY (`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=137 ;

--
-- Dumping data for table `vsf_message_group`
--

INSERT INTO `vsf_message_group` (`groupId`, `groupTitle`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, ''),
(10, ''),
(11, ''),
(12, ''),
(13, ''),
(14, ''),
(15, ''),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(20, ''),
(21, ''),
(22, ''),
(23, ''),
(24, ''),
(25, ''),
(26, ''),
(27, ''),
(28, ''),
(29, ''),
(30, ''),
(31, ''),
(32, ''),
(33, ''),
(34, ''),
(35, ''),
(36, 'Posted textbook'),
(37, 'Posted textbook'),
(38, 'Posted textbook'),
(39, 'test'),
(40, 'Posted textbook'),
(41, 'Posted textbook'),
(42, 'Posted textbook'),
(43, 'Posted textbook'),
(44, 'Posted textbook'),
(45, 'Posted textbook'),
(46, 'Posted textbook'),
(47, 'Posted textbook'),
(48, 'Posted textbook'),
(49, 'Posted textbook'),
(50, 'Posted textbook'),
(51, 'Posted textbook'),
(52, 'Posted textbook'),
(53, 'Posted textbook'),
(54, 'hongdao'),
(55, 'Posted textbook'),
(56, 'Order textbook: Android Wireless Application Development (2nd Edition) (Developer&#39;s Library)'),
(57, 'Posted textbook'),
(58, 'Posted textbook'),
(59, 'Posted textbook'),
(60, 'Posted textbook'),
(61, 'Posted textbook'),
(62, 'Posted textbook'),
(63, 'Posted textbook'),
(64, 'Posted textbook'),
(65, 'Posted textbook'),
(66, 'Posted textbook'),
(67, 'Posted textbook'),
(68, 'Posted textbook'),
(69, 'Posted textbook'),
(70, 'Posted textbook'),
(71, 'Posted textbook'),
(72, 'Posted textbook'),
(73, 'Posted textbook'),
(74, 'Posted textbook'),
(75, 'Posted textbook'),
(76, 'Posted textbook'),
(77, 'Posted textbook'),
(78, 'Did you purchase a textbook at iCampux?'),
(79, 'Did you purchase a textbook at iCampux?'),
(80, 'Did you purchase a textbook at iCampux?'),
(81, 'Posted textbook'),
(82, 'Did you purchase a textbook at iCampux?'),
(83, 'Posted textbook'),
(84, 'Posted textbook'),
(85, 'Posted textbook'),
(86, 'Did you purchase a textbook at iCampux?'),
(87, 'Did you purchase a textbook at iCampux?'),
(88, 'Did you purchase a textbook at iCampux?'),
(89, 'hi hong dao'),
(90, 'Posted textbook'),
(91, 'Posted textbook'),
(92, 'sony vaio'),
(93, 'Introduce classified''s item'),
(94, 'Introduce classified''s item'),
(95, 'Introduce classified''s item'),
(96, 'Did you purchase a textbook at iCampux?'),
(97, 'iphone 3'),
(98, 'Did you purchase a textbook at iCampux?'),
(99, 'Did you purchase a textbook at iCampux?'),
(100, 'refers you a listing'),
(101, 'refers you a listing'),
(102, 'refers you a listing'),
(103, 'refers you a listing'),
(104, 'refers you a listing'),
(105, 'refers you a listing'),
(106, 'yunhai huang refers you a listing'),
(107, ' refers you a listing'),
(108, 'yunhai huang refers you a listing'),
(109, 'Posted textbook'),
(110, 'Posted textbook'),
(111, 'Your icMarket listing'),
(112, 'Order textbook: The Ruby Programming Language'),
(113, 'Did you purchase from iCampux?'),
(114, 'Did you purchase from iCampux?'),
(115, 'fafsdjfaf'),
(116, 'Your icMarket listing'),
(117, 'tao test'),
(118, 'fsadf'),
(119, 'Posted textbook'),
(120, 'Posted textbook'),
(121, 'Posted textbook'),
(122, 'Posted textbook'),
(123, 'Posted textbook'),
(124, 'Posted textbook'),
(125, 'Posted textbook'),
(126, 'Posted textbook'),
(127, 'Posted textbook'),
(128, 'Posted textbook'),
(129, 'Posted textbook'),
(130, 'Posted textbook'),
(131, 'Your icMarket listing'),
(132, 'Your icMarket listing'),
(133, 'Your icMarket listing'),
(134, 'Your icMarket listing'),
(135, 'Your icMarket listing'),
(136, 'Posted textbook');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message_label`
--

CREATE TABLE IF NOT EXISTS `vsf_message_label` (
  `labelId` int(10) NOT NULL AUTO_INCREMENT,
  `labelUser` int(10) NOT NULL,
  `labelTitle` varchar(128) NOT NULL,
  `labelStatus` tinyint(8) NOT NULL,
  PRIMARY KEY (`labelId`),
  KEY `labelId` (`labelId`,`labelTitle`),
  KEY `labelUser` (`labelUser`,`labelTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vsf_message_label`
--

INSERT INTO `vsf_message_label` (`labelId`, `labelUser`, `labelTitle`, `labelStatus`) VALUES
(1, 28, 'system', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_message_labelm`
--

CREATE TABLE IF NOT EXISTS `vsf_message_labelm` (
  `lmId` int(10) NOT NULL AUTO_INCREMENT,
  `lmLabel` int(10) NOT NULL,
  `lmMessage` int(10) NOT NULL,
  `lmType` int(10) NOT NULL,
  PRIMARY KEY (`lmId`),
  KEY `messageId` (`lmMessage`,`lmType`),
  KEY `lmLabel` (`lmLabel`,`lmMessage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_module`
--

CREATE TABLE IF NOT EXISTS `vsf_module` (
  `moduleId` int(11) NOT NULL AUTO_INCREMENT,
  `moduleTitle` varchar(32) NOT NULL,
  `moduleVersion` varchar(8) NOT NULL,
  `moduleIsAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `moduleIsUser` tinyint(1) NOT NULL DEFAULT '0',
  `moduleIntro` varchar(255) NOT NULL,
  `moduleClass` varchar(32) NOT NULL,
  `moduleVirtual` tinyint(4) NOT NULL,
  `moduleParent` varchar(16) NOT NULL,
  PRIMARY KEY (`moduleId`),
  KEY `moduleClass` (`moduleClass`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `vsf_module`
--

INSERT INTO `vsf_module` (`moduleId`, `moduleTitle`, `moduleVersion`, `moduleIsAdmin`, `moduleIsUser`, `moduleIntro`, `moduleClass`, `moduleVirtual`, `moduleParent`) VALUES
(1, 'Home', '0', 1, 1, 'This module is for home pages in admin or user.', 'home', 0, ''),
(2, 'Modules Management', '0', 1, 0, 'This is a system module for management all modules in VS Framework.', 'modules', 0, ''),
(120, 'events', '0', 1, 1, '', 'events', 1, 'articles'),
(4, 'Languages', '3.3.4', 1, 1, 'This is a system module for management all languages for VS Framework.', 'languages', 0, ''),
(5, 'Menus Manager', '3.4.1', 1, 1, 'This is a system module for management all menu links in VS Framework.', 'menus', 0, ''),
(118, 'Article Manager', '3.3.4.1', 1, 1, 'This is a system module for management all page for VS Framework.', 'articles', 0, ''),
(8, 'Url alias manager', '0', 1, 0, 'This module is for manage alias of url.', 'urlalias', 0, ''),
(119, 'news', '0', 1, 1, '', 'news', 1, 'articles'),
(11, 'support Module', '3.3.4.1', 1, 1, 'This is a system module for management all simple support for VS Framework.', 'supports', 0, ''),
(12, 'Component', '3.3.', 1, 0, 'This is a system module for management all Component for VS Framework.', 'components', 0, ''),
(7, 'Admin', '3.3.4.1', 1, 1, 'This is a system module for management all simple page for VS Framework.', 'admins', 0, ''),
(16, 'File manager', '3.3.4.1', 1, 1, 'This is a system module for management all News for VS Framework.', 'files', 0, ''),
(17, 'Manage Gallery', '3.4.1', 1, 1, 'This is a system module for management all menu links in VS Framework.', 'gallery', 0, ''),
(18, 'Contact', '0', 1, 1, 'This is a system module for management all Contact for VS Framework.', 'contact', 0, ''),
(26, 'Manage Gallerys', '3.4.1', 1, 1, 'This is a system module for management all menu links in VS Framework.', 'galleries', 0, ''),
(115, 'agreement', '0', 1, 1, '', 'agreement', 1, 'pages'),
(28, 'partners manager', '3.3.4.1', 1, 1, 'This is a system module for management all partners  for VS Framework.', 'partners', 0, ''),
(107, 'Manage message', '3.3.4.1', 1, 1, 'This is a system module for management all messages  for VS Framework.', 'messages', 0, ''),
(13, 'User Manager', '3.3.4.1', 1, 1, 'This is a system module for management all simple page for VS Framework.', 'users', 0, ''),
(104, 'Order', '3.3.4.1', 1, 1, 'This is a system module for management all Order for VS Framework.', 'orders', 0, ''),
(102, 'Manage campus', '3.3.4.1', 1, 1, 'This is a system module for management all campuses  for VS Framework.', 'campuses', 0, ''),
(105, 'Manage textbook', '3.3.4.1', 1, 1, 'This is a system module for management all textbooks  for VS Framework.', 'textbooks', 0, ''),
(106, 'Settings', '3.2.1', 1, 0, 'This is a system module for management all system settings for VS Framework configuration.', 'settings', 0, ''),
(108, 'skins manager', '3.3.4.1', 1, 1, 'This is a system module for management all skins  for VS Framework.', 'skins', 0, ''),
(109, 'Listing Manager', '3.3.4.1', 1, 1, '', 'listings', 0, ''),
(110, 'Manage Status', '3.3.4.1', 1, 1, 'This is a system module for management all status  for VS Framework.', 'status', 0, ''),
(111, 'icMarket Manager', '3.3.4.1', 1, 1, '', 'icmarket', 0, ''),
(113, 'Manage Search', '3.4.1', 1, 1, 'Search module', 'search', 0, ''),
(114, 'Page Manager', '3.3.4.1', 1, 1, 'This is a system module for management all page for VS Framework.', 'pages', 0, ''),
(116, 'helpcenter', '0', 1, 1, '', 'helpcenter', 1, 'pages'),
(117, 'about', '0', 1, 1, '', 'about', 1, 'pages');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_notice`
--

CREATE TABLE IF NOT EXISTS `vsf_notice` (
  `noticeId` int(10) NOT NULL AUTO_INCREMENT,
  `noticeUser` int(10) NOT NULL,
  `noticeObj` int(10) NOT NULL,
  `noticeContent` varchar(2048) NOT NULL,
  `noticeType` tinyint(4) NOT NULL DEFAULT '1',
  `noticeStatus` tinyint(2) NOT NULL,
  `noticeTime` int(10) NOT NULL,
  PRIMARY KEY (`noticeId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vsf_notice`
--

INSERT INTO `vsf_notice` (`noticeId`, `noticeUser`, `noticeObj`, `noticeContent`, `noticeType`, `noticeStatus`, `noticeTime`) VALUES
(3, 37, 5, 'request for friend', 3, 0, 1308208114),
(4, 7, 12, 'request for friend', 3, 0, 1310458470);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_order`
--

CREATE TABLE IF NOT EXISTS `vsf_order` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_order_item`
--

CREATE TABLE IF NOT EXISTS `vsf_order_item` (
  `itemId` int(10) NOT NULL AUTO_INCREMENT,
  `orderId` int(10) NOT NULL,
  `itemTitle` varchar(250) NOT NULL,
  `bookId` int(10) NOT NULL,
  `bookUserId` int(10) NOT NULL,
  `bookImage` int(11) NOT NULL,
  `itemQuantity` smallint(5) NOT NULL,
  `itemPrice` double NOT NULL,
  `itemDate` int(10) DEFAULT NULL,
  `itemStatus` varchar(100) DEFAULT NULL,
  `itemInfo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_page`
--

CREATE TABLE IF NOT EXISTS `vsf_page` (
  `pageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pageCatId` int(10) NOT NULL DEFAULT '0',
  `pageTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pageIntro` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pageImage` varchar(256) DEFAULT NULL,
  `pageContent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pagePostDate` int(10) NOT NULL DEFAULT '0',
  `pageStatus` tinyint(4) NOT NULL DEFAULT '0',
  `pageIndex` tinyint(4) NOT NULL DEFAULT '0',
  `pageCode` varchar(16) NOT NULL,
  PRIMARY KEY (`pageId`),
  KEY `Title` (`pageTitle`),
  FULLTEXT KEY `Content` (`pageContent`),
  FULLTEXT KEY `Title_2` (`pageTitle`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vsf_page`
--

INSERT INTO `vsf_page` (`pageId`, `pageCatId`, `pageTitle`, `pageIntro`, `pageImage`, `pageContent`, `pagePostDate`, `pageStatus`, `pageIndex`, `pageCode`) VALUES
(4, 1026, 'Help Center', '', '', '&lt;p&gt;&lt;strong&gt;This is demo content for icampux help center.&lt;/strong&gt;&lt;/p&gt;<br />&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;.&lt;/p&gt;<br />&lt;p&gt;&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.&lt;/p&gt;<br />&lt;p&gt;Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;  &quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.&lt;/p&gt;<br />&lt;p&gt;No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;&lt;/p&gt;', 1318394087, 1, 0, 'helpcenter'),
(5, 1044, 'Terms of Use', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;  &quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.&lt;/p&gt;<br />&lt;p&gt;Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;&lt;/p&gt;', 1318394308, 1, 0, 'terms'),
(6, 1028, 'About iCampux', '', '', '&lt;p&gt;sit amet, consectetur, adipisci velit, sed quia non numquam eius modi  tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.  Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis  suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis  autem vel eum iure reprehenderit qui in ea voluptate velit esse quam  nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;But I must explain to you how all this mistaken idea of denouncing  pleasure and praising pain was born and I will give you a complete  account of the system, and expound the actual teachings of the great  explorer of the truth, the master-builder of human happiness. No one  rejects, dislikes, or avoids pleasure itself, because it is pleasure,  but because those who do not know how to pursue pleasure rationally  encounter consequences that are extremely painful. Nor again is there  anyone who loves or pursues or desires to obtain pain of itself, because  it is pain, but because occasionally circumstances occur in which toil  and pain can procure him some great pleasure. To take a trivial example,  which of us ever undertakes laborious physical exercise, except to  obtain some advantage from it? But who has any right to find fault with a  man who chooses to enjoy a pleasure that has no annoying consequences,  or one who avoids a pain that produces no resultant pleasure?&quot;  &quot;At vero  eos et accusamus et iusto odio dignissimos ducimus qui blanditiis  praesentium voluptatum deleniti atque corrupti quos dolores et quas  molestias excepturi sint occaecati cupiditate non provident, similique  sunt in culpa qui officia deserunt mollitia animi, id est laborum et  dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.&lt;/p&gt;', 1318395462, 1, 1, 'about'),
(7, 1028, 'How iCampux Work', '', '', '&lt;p&gt;Sit amet, consectetur, adipisci velit, sed quia non numquam eius modi  tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.  Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis  suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis  autem vel eum iure reprehenderit qui in ea voluptate velit esse quam  nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;But I must explain to you how all this mistaken idea of denouncing  pleasure and praising pain was born and I will give you a complete  account of the system, and expound the actual teachings of the great  explorer of the truth, the master-builder of human happiness. No one  rejects, dislikes, or avoids pleasure itself, because it is pleasure,  but because those who do not know how to pursue pleasure rationally  encounter consequences that are extremely painful. Nor again is there  anyone who loves or pursues or desires to obtain pain of itself, because  it is pain, but because occasionally circumstances occur in which toil  and pain can procure him some great pleasure.&lt;/p&gt;<br />&lt;p&gt;To take a trivial example,  which of us ever undertakes laborious physical exercise, except to  obtain some advantage from it? But who has any right to find fault with a  man who chooses to enjoy a pleasure that has no annoying consequences,  or one who avoids a pain that produces no resultant pleasure?&quot;  &quot;At vero  eos et accusamus et iusto odio dignissimos ducimus qui blanditiis  praesentium voluptatum deleniti atque corrupti quos dolores et quas  molestias excepturi sint occaecati cupiditate non provident, similique  sunt in culpa qui officia deserunt mollitia animi, id est laborum et  dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.&lt;/p&gt;<br />&lt;p&gt;Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil  impedit quo minus id quod maxime placeat facere possimus, omnis voluptas  assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et  aut officiis debitis aut rerum necessitatibus saepe eveniet ut et  voluptates repudiandae sint et molestiae non recusandae. Itaque earum  rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus  maiores alias consequatur aut perferendis doloribus asperiores  repellat.&quot;&lt;/p&gt;', 1318395615, 1, 2, 'howtowork'),
(8, 1044, 'Privacy Policy', '', '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do  eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad  minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip  ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur  sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem  accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab  illo inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;But I must explain to you how all this mistaken idea of denouncing  pleasure and praising pain was born and I will give you a complete  account of the system, and expound the actual teachings of the great  explorer of the truth, the master-builder of human happiness. No one  rejects, dislikes, or avoids pleasure itself, because it is pleasure,  but because those who do not know how to pursue pleasure rationally  encounter consequences that are extremely painful. Nor again is there  anyone who loves or pursues or desires to obtain pain of itself, because  it is pain, but because occasionally circumstances occur in which toil  and pain can procure him some great pleasure. To take a trivial example,  which of us ever undertakes laborious physical exercise, except to  obtain some advantage from it? But who has any right to find fault with a  man who chooses to enjoy a pleasure that has no annoying consequences,  or one who avoids a pain that produces no resultant pleasure?&quot;  &quot;At vero  eos et accusamus et iusto odio dignissimos ducimus qui blanditiis  praesentium voluptatum deleniti atque corrupti quos dolores et quas  molestias excepturi sint occaecati cupiditate non provident, similique  sunt in culpa qui officia deserunt mollitia animi, id est laborum et  dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.&lt;/p&gt;<br />&lt;p&gt;Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil  impedit quo minus id quod maxime placeat facere possimus, omnis voluptas  assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et  aut officiis debitis aut rerum necessitatibus saepe eveniet ut et  voluptates repudiandae sint et molestiae non recusandae. Itaque earum  rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus  maiores alias consequatur aut perferendis doloribus asperiores  repellat.&quot;&lt;/p&gt;', 1318407764, 1, 0, 'privacy'),
(9, 1044, 'Careers', '', '', '&lt;div class=&quot;content&quot;&gt;<br />&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do  eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad  minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip  ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur  sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt  mollit anim id est laborum.&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem  accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab  illo inventore veritatis et quasi architecto beatae vitae dicta sunt  explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut  odit aut fugit, sed quia consequuntur magni dolores eos qui ratione  voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum  quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam  eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat  voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?  Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse  quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo  voluptas nulla pariatur?&quot;&lt;/p&gt;<br />&lt;p&gt;&quot;But I must explain to you how all this mistaken idea of denouncing  pleasure and praising pain was born and I will give you a complete  account of the system, and expound the actual teachings of the great  explorer of the truth, the master-builder of human happiness. No one  rejects, dislikes, or avoids pleasure itself, because it is pleasure,  but because those who do not know how to pursue pleasure rationally  encounter consequences that are extremely painful. Nor again is there  anyone who loves or pursues or desires to obtain pain of itself, because  it is pain, but because occasionally circumstances occur in which toil  and pain can procure him some great pleasure. To take a trivial example,  which of us ever undertakes laborious physical exercise, except to  obtain some advantage from it? But who has any right to find fault with a  man who chooses to enjoy a pleasure that has no annoying consequences,  or one who avoids a pain that produces no resultant pleasure?&quot;  &quot;At vero  eos et accusamus et iusto odio dignissimos ducimus qui blanditiis  praesentium voluptatum deleniti atque corrupti quos dolores et quas  molestias excepturi sint occaecati cupiditate non provident, similique  sunt in culpa qui officia deserunt mollitia animi, id est laborum et  dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.&lt;/p&gt;<br />&lt;p&gt;Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil  impedit quo minus id quod maxime placeat facere possimus, omnis voluptas  assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et  aut officiis debitis aut rerum necessitatibus saepe eveniet ut et  voluptates repudiandae sint et molestiae non recusandae. Itaque earum  rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus  maiores alias consequatur aut perferendis doloribus asperiores  repellat.&quot;&lt;/p&gt;<br />&lt;/div&gt;', 1318577862, 1, 3, 'careers');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_partner`
--

CREATE TABLE IF NOT EXISTS `vsf_partner` (
  `partnerId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `partnerCatId` int(11) NOT NULL,
  `partnerTitle` varchar(255) NOT NULL,
  `partnerAddress` varchar(255) NOT NULL,
  `partnerIntro` text NOT NULL,
  `partnerWebsite` text NOT NULL,
  `partnerContent` text NOT NULL,
  `partnerFileId` varchar(50) NOT NULL,
  `partnerPrice` int(11) NOT NULL,
  `partnerExpTime` int(11) NOT NULL,
  `partnerIndex` int(11) NOT NULL,
  `partnerPosition` varchar(10) NOT NULL,
  `partnerHits` int(11) NOT NULL,
  `partnerStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`partnerId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `vsf_partner`
--

INSERT INTO `vsf_partner` (`partnerId`, `partnerCatId`, `partnerTitle`, `partnerAddress`, `partnerIntro`, `partnerWebsite`, `partnerContent`, `partnerFileId`, `partnerPrice`, `partnerExpTime`, `partnerIndex`, `partnerPosition`, `partnerHits`, `partnerStatus`) VALUES
(11, 128, 'Flower', '', '', 'http://googlec.om', '', '81', 0, 0, 0, '@01000', 0, 1),
(12, 128, 'Fish', '', '', 'http://google.com', '', '82', 0, 0, 0, '@01000', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_search`
--

CREATE TABLE IF NOT EXISTS `vsf_search` (
  `searchId` int(10) NOT NULL AUTO_INCREMENT,
  `searchModule` varchar(32) NOT NULL,
  `searchObj` int(10) NOT NULL,
  `searchUrl` varchar(512) NOT NULL,
  `searchTitle` varchar(128) NOT NULL,
  `searchIntro` varchar(1024) NOT NULL,
  `searchContent` text NOT NULL,
  `searchOTitle` varchar(128) NOT NULL,
  `searchOIntro` varchar(1024) NOT NULL,
  PRIMARY KEY (`searchId`),
  FULLTEXT KEY `searchContent` (`searchContent`),
  FULLTEXT KEY `searchTitle` (`searchTitle`),
  FULLTEXT KEY `searchIntro` (`searchIntro`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `vsf_search`
--

INSERT INTO `vsf_search` (`searchId`, `searchModule`, `searchObj`, `searchUrl`, `searchTitle`, `searchIntro`, `searchContent`, `searchOTitle`, `searchOIntro`) VALUES
(1, 'textbooks', 28, 'textbooks/listing/the-problems-of-philosophy-28', 'the problems of philosophy', '', '9781603862875 1603862870 the problems of philosophy bertrand russell watchmaker publishing', 'The Problems of Philosophy', '9781603862875 1603862870 Bertrand Russell Watchmaker Publishing'),
(2, 'textbooks', 29, 'textbooks/listing/the-ruby-programming-language-29', 'the ruby programming language', '', '9780596516178 9780596516 the ruby programming language david flanagan yukihiro matsumoto oreilly media', 'The Ruby Programming Language', '9780596516178 9780596516 David Flanagan, Yukihiro Matsumoto O&#39;Reilly Media'),
(3, 'textbooks', 30, 'textbooks/listing/ruby-on-rails-3-tutorial-learn-rails-by-example-addisonwesley-professional-ruby-series-30', 'ruby on rails 3 tutorial learn rails by example addisonwesley professional ruby series', '', '9780321743121 321743121 ruby on rails 3 tutorial learn rails by example addisonwesley professional ruby series michael hartl addisonwesley professional', 'Ruby on Rails 3 Tutorial: Learn Rails by Example (Addison-Wesley Professional Ruby Series)', '9780321743121 321743121 Michael Hartl Addison-Wesley Professional'),
(4, 'textbooks', 31, 'textbooks/listing/programming-ruby-19-the-pragmatic-programmers-guide-facets-of-ruby-31', 'programming ruby 19 the pragmatic programmers guide facets of ruby', '', '978193435608 9781934356 programming ruby 19 the pragmatic programmers guide facets of ruby dave thomas chad fowler andy hunt pragmatic bookshelf', 'Programming Ruby 1.9: The Pragmatic Programmers&#39; Guide (Facets of Ruby)', '978193435608 9781934356 Dave Thomas, Chad Fowler, Andy Hunt Pragmatic Bookshelf'),
(5, 'textbooks', 33, 'textbooks/listing/ruby-on-rails-3-tutorial-learn-rails-by-example-33', 'ruby on rails 3 tutorial learn rails by example', '', '9780321584106 321584104 ruby on rails 3 tutorial learn rails by example michael hartl ', 'Ruby on Rails 3 Tutorial: Learn Rails by Example', '9780321584106 321584104 Michael Hartl'),
(6, 'textbooks', 34, 'textbooks/listing/learning-python-powerful-objectoriented-programming-34', 'learning python powerful objectoriented programming', '', '9780596158064 596158068 learning python powerful objectoriented programming mark lutz oreilly media', 'Learning Python: Powerful Object-Oriented Programming', '9780596158064 596158068 Mark Lutz O&#39;Reilly Media'),
(7, 'textbooks', 35, 'textbooks/listing/the-art-of-seo-mastering-search-engine-optimization-theory-in-practice-35', 'the art of seo mastering search engine optimization theory in practice', '', '9780596518868 596518862 the art of seo mastering search engine optimization theory in practice eric enge stephan spencer rand fishkin jessie stricchiola oreilly media', 'The Art of SEO: Mastering Search Engine Optimization (Theory in Practice)', '9780596518868 596518862 Eric Enge, Stephan Spencer, Rand Fishkin, Jessie Stricchiola O&#39;Reilly Media'),
(8, 'textbooks', 36, 'textbooks/listing/ranking-number-one-50-essential-seo-tips-to-boost-your-search-engine-results-36', 'ranking number one 50 essential seo tips to boost your search engine results', '', '9781452849904 1452849900 ranking number one 50 essential seo tips to boost your search engine results james beswick createspace', 'Ranking Number One: 50 Essential SEO Tips To Boost Your Search Engine Results', '9781452849904 1452849900 James Beswick CreateSpace'),
(9, 'textbooks', 37, 'textbooks/listing/search-engine-optimization-seo-secrets-37', 'search engine optimization seo secrets', '', '9780470554180 470554185 search engine optimization seo secrets danny dover erik dafforn wiley', 'Search Engine Optimization (SEO) Secrets', '9780470554180 470554185 Danny Dover, Erik Dafforn Wiley'),
(10, 'textbooks', 40, 'textbooks/listing/search-engine-optimization-your-visual-blueprint-for-effective-internet-marketing-40', 'search engine optimization your visual blueprint for effective internet marketing', '', '9780470620755 470620757 search engine optimization your visual blueprint for effective internet marketing kristopher b jones visual', 'Search Engine Optimization: Your visual blueprint for effective Internet marketing', '9780470620755 470620757 Kristopher B. Jones Visual'),
(11, 'textbooks', 41, 'textbooks/listing/search-engine-optimization-seo-an-hour-a-day-41', 'search engine optimization seo an hour a day', '', '9780470902592 470902590 search engine optimization seo an hour a day jennifer grappone gradiva couzin sybex', 'Search Engine Optimization (SEO): An Hour a Day', '9780470902592 470902590 Jennifer Grappone, Gradiva Couzin Sybex'),
(12, 'textbooks', 42, 'textbooks/listing/android-in-action-42', 'android in action', '', '9781935182726 9781935182 android in action frank ableson robi sen manning publications', 'Android in Action', '9781935182726 9781935182 Frank Ableson, Robi Sen Manning Publications'),
(13, 'textbooks', 43, 'textbooks/listing/python-programming-an-introduction-to-computer-science-43', 'begin ruby on rails from novice to professional', 'python programming an introduction to computer science', '9781590282410 1590282418 python programming an introduction to computer science john zelle franklin beedle amp associates inc\r\n\r\n', 'Python Programming: An Introduction to Computer Science', '9781590282410 1590282418 John Zelle Franklin, Beedle &amp; Associates Inc.'),
(14, 'textbooks', 44, 'textbooks/listing/beginning-ruby-from-novice-to-professional-44', 'beginning ruby from novice to professional', '', '9781430223634 1430223634 beginning ruby from novice to professional peter cooper apress', 'Beginning Ruby: From Novice to Professional', '9781430223634 1430223634 Peter Cooper Apress'),
(15, 'textbooks', 45, 'textbooks/listing/metaprogramming-ruby-program-like-the-ruby-pros-45', 'metaprogramming ruby program like the ruby pros', '', '9781934356470 1934356476 metaprogramming ruby program like the ruby pros paolo perrotta pragmatic bookshelf', 'Metaprogramming Ruby: Program Like the Ruby Pros', '9781934356470 1934356476 Paolo Perrotta Pragmatic Bookshelf'),
(16, 'textbooks', 46, 'textbooks/listing/aspnet-35-application-architecture-and-design-46', 'aspnet 35 application architecture and design', '', '9781847195500 1847195504 aspnet 35 application architecture and design vivek thakur packt publishing', 'ASP.NET 3.5 Application Architecture and Design', '9781847195500 1847195504 Vivek Thakur Packt Publishing'),
(17, 'textbooks', 47, 'textbooks/listing/silverlight-4-in-action-47', 'silverlight 4 in action', '', '9781935182375 1935182374 silverlight 4 in action pete brown manning publications', 'Silverlight 4 in Action', '9781935182375 1935182374 Pete Brown Manning Publications'),
(18, 'textbooks', 48, 'textbooks/listing/silverlight-4-unleashed-48', 'silverlight 4 unleashed', '', '978067233336 672333368 silverlight 4 unleashed laurent bugnion sams', 'Silverlight 4 Unleashed', '978067233336 672333368 Laurent Bugnion Sams'),
(19, 'textbooks', 49, 'textbooks/listing/microsoft-expression-blend-4-unleashed-49', 'microsoft expression blend 4 unleashed', '', '9780672331077 672331071 microsoft expression blend 4 unleashed brennon williams sams', 'Microsoft Expression Blend 4 Unleashed', '9780672331077 672331071 Brennon Williams Sams'),
(20, 'textbooks', 50, 'textbooks/listing/wpf-4-unleashed-50', 'wpf 4 unleashed', '', '9780672331190 672331195 wpf 4 unleashed adam nathan sams', 'WPF 4 Unleashed', '9780672331190 672331195 Adam Nathan Sams'),
(21, 'icmarket', 1, 'icMarket/detail/iphone-3-1', 'iphone 3', '', 'iphone 3 this fast and powerful iphone features a highquality 30megapixel digital camera that shoots vga video with audio convenient voicecontrolled operation and a host of apps that can be tailored to best fit your way of life share your answers', 'iphone 3', 'This fast and powerful iPhone features a high-quality 3.0-megapixel digital camera that shoots VGA video with audio, convenient voice-controlled operation and a host of apps that can be tailored to best fit your way of life. Share your answers. '),
(22, 'icmarket', 8, 'icMarket/detail/mac-pro-8', 'mac pro', '', 'mac pro mac pro', 'mac pro', 'mac pro'),
(23, 'icmarket', 9, 'icMarket/detail/mac-air-9', 'mac air', '', 'mac air mac air', 'mac air', 'mac air'),
(24, 'icmarket', 10, 'icMarket/detail/a-multimedia-superphone-in-the-palm-of-your-hand-10', 'a multimedia superphone in the palm of your hand', '', 'a multimedia superphone in the palm of your hand want to be entertained like never before ondemand movies look great with a stunning qhd display and they sound crystal clear with hifi audio technology the htc sensation also includes an immersive htc sense experience making this phone easytouse and a top entertainer the premium design complete with contoured glass edging feels great in your hand the htc sensation is a multimedia superphone', 'A multimedia superphone in the palm of your hand ', 'Want to be entertained like never before? On-demand movies look great with a stunning qHD display, and they sound crystal clear with Hi-Fi audio technology. The HTC Sensation also includes an immersive HTC Sense experience making this phone easy-to-use and a top entertainer. The premium design, complete with contoured glass edging, feels great in your hand. The HTC Sensation is a multimedia superphone.'),
(25, 'icmarket', 11, 'icMarket/detail/bobkona-manhattan-reversible-microfiber-3piece-sectional-sofa-with-faux-leather-ottoman-in-sage-color-11', 'bobkona manhattan reversible microfiber 3piece sectional sofa with faux leather ottoman in sage color', '', 'bobkona manhattan reversible microfiber 3piece sectional sofa with faux leather ottoman in sage color bobkona manhattan reversible microfiber 3piece sectional sofa with faux leather ottoman in sage color', 'Bobkona Manhattan Reversible Microfiber 3-Piece Sectional Sofa with Faux Leather Ottoman in Sage Color', 'Bobkona Manhattan Reversible Microfiber 3-Piece Sectional Sofa with Faux Leather Ottoman in Sage Color '),
(26, 'icmarket', 12, 'icMarket/detail/ipod-shuffle-12', 'ipod shuffle', '', 'ipod shuffle its main body is crafted from a single piece of aluminum and polished to a beautiful shine so the new ipod shuffle feels solid sleek and durable and the color palette makes it the perfect fashion accessory choose gleaming silver blue green orange or pink', 'Ipod shuffle', 'Its main body is crafted from a single piece of aluminum and polished to a beautiful shine, so the new iPod shuffle feels solid, sleek and durable. And the color palette makes it the perfect fashion accessory. Choose gleaming silver, blue, green, orange, or pink. '),
(27, 'icmarket', 13, 'icMarket/detail/apple-iphone-3g-8gb-black-atampt-smartphone-13', 'apple iphone 3g 8gb black atampt smartphone', '', 'apple iphone 3g 8gb black atampt smartphone phone ipod and internet device in one iphone 3g offers desktopclass email an amazing maps application and safari mobile web browser with fast 3g wireless technology gps mapping support for enterprise features like microsoft exchange and the app store iphone 3g puts even more features at your fingertips and like the original iphone it combines three products in one a revolutionary phone a widescreen ipod and a breakthrough internet device with rich html email and a desktopclass web browser iphone 3g it redefines what a mobile phone can do again', 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'Phone, iPod, and Internet device in one, iPhone 3G offers desktop-class email, an amazing maps application, and Safari - mobile web browser. With fast 3G wireless technology, GPS mapping, support for enterprise features like Microsoft Exchange, and the App Store, iPhone 3G puts even more features at your fingertips. And like the original iPhone, it combines three products in one - a revolutionary phone, a widescreen iPod, and a breakthrough Internet device with rich HTML email and a desktop-class web browser. iPhone 3G. It redefines what a mobile phone can do - again.'),
(28, 'icmarket', 14, 'icMarket/detail/apple-iphone-3g-8gb-black-atampt-smartphone-14', 'apple iphone 3g 8gb black atampt smartphone', '', 'apple iphone 3g 8gb black atampt smartphone phone ipod and internet device in one iphone 3g offers desktopclass email an amazing maps application and safari mobile web browser with fast 3g wireless technology gps mapping support for enterprise features like microsoft exchange and the app store iphone 3g puts even more features at your fingertips and like the original iphone it combines three products in one a revolutionary phone a widescreen ipod and a breakthrough internet device with rich html email and a desktopclass web browser iphone 3g it redefines what a mobile phone can do again', 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'Phone, iPod, and Internet device in one, iPhone 3G offers desktop-class email, an amazing maps application, and Safari - mobile web browser. With fast 3G wireless technology, GPS mapping, support for enterprise features like Microsoft Exchange, and the App Store, iPhone 3G puts even more features at your fingertips. And like the original iPhone, it combines three products in one - a revolutionary phone, a widescreen iPod, and a breakthrough Internet device with rich HTML email and a desktop-class web browser. iPhone 3G. It redefines what a mobile phone can do - again.'),
(29, 'icmarket', 15, 'icMarket/detail/apple-iphone-3g-8gb-black-atampt-smartphone-15', 'apple iphone 3g 8gb black atampt smartphone', '', 'apple iphone 3g 8gb black atampt smartphone phone ipod and internet device in one iphone 3g offers desktopclass email an amazing maps application and safari mobile web browser with fast 3g wireless technology gps mapping support for enterprise features like microsoft exchange and the app store iphone 3g puts even more features at your fingertips and like the original iphone it combines three products in one a revolutionary phone a widescreen ipod and a breakthrough internet device with rich html email and a desktopclass web browser iphone 3g it redefines what a mobile phone can do again', 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'Phone, iPod, and Internet device in one, iPhone 3G offers desktop-class email, an amazing maps application, and Safari - mobile web browser. With fast 3G wireless technology, GPS mapping, support for enterprise features like Microsoft Exchange, and the App Store, iPhone 3G puts even more features at your fingertips. And like the original iPhone, it combines three products in one - a revolutionary phone, a widescreen iPod, and a breakthrough Internet device with rich HTML email and a desktop-class web browser. iPhone 3G. It redefines what a mobile phone can do - again.'),
(30, 'icmarket', 16, 'icMarket/detail/htc-evo-4g-black-sprint-smartphone-16', 'htc evo 4g black sprint smartphone', '', 'htc evo 4g black sprint smartphone the sleek and modern htc evo 4g mobile provides excellent performance this htc smartphone features the wifi capability which allows you to access the internet at a great speed featuring the 43inch touchscreen display this htc evo cell phone allows you to access every application smoothly and lets you view photos and videos too the htc evo 4g mobile features 8 megapixel camera with auto focus and 2x led flash and 13 megapixel front facing camera for capturing your special moments the 21 bluetooth technology of this htc smartphone allows you quickly share and transfer data with other compatible devices this htc evo cell phone has 4g network which allows you stream and upload online content from the web faster', 'HTC EVO 4G - Black (Sprint) Smartphone', 'The sleek and modern HTC EVO 4G mobile provides excellent performance. This HTC smartphone features the WiFi capability, which allows you to access the internet at a great speed. Featuring the 4.3-inch touchscreen display, this HTC EVO cell phone allows you to access every application smoothly and lets you view photos and videos too. The HTC EVO 4G mobile features 8 megapixel camera with auto Focus and 2x LED Flash, and 1.3 megapixel front facing camera for capturing your special moments. The 2.1 Bluetooth technology of this HTC smartphone allows you quickly share and transfer data with other compatible devices. This HTC EVO cell phone has 4G network, which allows you stream and upload online content from the web faster.'),
(31, 'icmarket', 17, 'icMarket/detail/apple-iphone-3g-8gb-black-atampt-smartphone-17', 'apple iphone 3g 8gb black atampt smartphone', '', 'apple iphone 3g 8gb black atampt smartphone the sleek and modern htc evo 4g mobile provides excellent performance this htc smartphone features the wifi capability which allows you to access the internet at a great speed featuring the 43inch touchscreen display this htc evo cell phone allows you to access every application smoothly and lets you view photos and videos too the htc evo 4g mobile features 8 megapixel camera with auto focus and 2x led flash and 13 megapixel front facing camera for capturing your special moments the 21 bluetooth technology of this htc smartphone allows you quickly share and transfer data with other compatible devices this htc evo cell phone has 4g network which allows you stream and upload online content from the web faster', 'Apple iPhone 3G - 8GB - Black (AT&amp;T) Smartphone', 'The sleek and modern HTC EVO 4G mobile provides excellent performance. This HTC smartphone features the WiFi capability, which allows you to access the internet at a great speed. Featuring the 4.3-inch touchscreen display, this HTC EVO cell phone allows you to access every application smoothly and lets you view photos and videos too. The HTC EVO 4G mobile features 8 megapixel camera with auto Focus and 2x LED Flash, and 1.3 megapixel front facing camera for capturing your special moments. The 2.1 Bluetooth technology of this HTC smartphone allows you quickly share and transfer data with other compatible devices. This HTC EVO cell phone has 4G network, which allows you stream and upload online content from the web faster.'),
(32, 'icmarket', 18, 'icMarket/detail/samsung-galaxy-s-i897-captivate-18', 'samsung galaxy s i897 captivate', '', 'samsung galaxy s i897 captivate get enhanced performance with the 1ghz hummingbird processor of the samsung galaxy s captivate smartphone integrated with the android 22 operating system this samsung smartphone lets you access multiple advanced applications the threaded messaging feature virtual qwerty keyboard and the swype technology of this samsung android phone provides a flawless texting experience the allshare function of the galaxy s captivate phone lets you easily share content with dlna certified devices store your pictures videos clips etc on the expandable 32gb storage of this samsung android phone stay connected with your friends via facebook myspace and twitter with the help of wifi connectivity of this samsung smartphone the galaxy s captivate phone comes with a 5mp camera letting your capture sharp images and videos', 'Samsung Galaxy S i897 Captivate ', 'Get enhanced performance with the 1GHz Hummingbird processor of the Samsung Galaxy S Captivate smartphone. Integrated with the Android 2.2 operating system, this Samsung smartphone lets you access multiple advanced applications. The threaded messaging feature, virtual QWERTY keyboard, and the Swype technology of this Samsung Android phone provides a flawless texting experience. The AllShare function of the Galaxy S Captivate phone lets you easily share content with DLNA Certified devices. Store your pictures, videos clips, etc., on the expandable 32GB storage of this Samsung Android phone. Stay connected with your friends via Facebook, MySpace, and Twitter, with the help of WiFi connectivity of this Samsung smartphone. The Galaxy S Captivate phone comes with a 5MP camera, letting your capture sharp images and videos.'),
(33, 'icmarket', 19, 'icMarket/detail/macbookpro-19', 'macbookpro', '', 'macbookpro brand new come with blackberry', 'macbookpro', 'brand new come with blackberry'),
(34, 'icmarket', 20, 'icMarket/detail/ipad-20', 'ipad', '', 'ipad ipad 2 version', 'ipad', 'ipad 2 version'),
(35, 'icmarket', 21, 'icMarket/detail/blackberry-storm-9530-1gb-black-unlocked-smartphone-21', 'blackberry storm 9530 1gb black unlocked smartphone', '', 'blackberry storm 9530 1gb black unlocked smartphone bring your blackberry storm smartphone to life with the power of your touch browse play share communicate and organize your world all from your fingertips', 'BlackBerry Storm 9530 - 1GB - Black (Unlocked) Smartphone  ', 'Bring your BlackBerry Storm smartphone to life with the power of your touch. Browse, play, share, communicate and organize your world - all from your fingertips.'),
(36, 'icmarket', 22, 'icMarket/detail/android-phone-22', 'android phone', '', 'android phone android version 22 br samsung phone', 'android phone', 'android version 2.2. <br />SAMSUNG phone'),
(37, 'icmarket', 23, 'icMarket/detail/iphone5-23', 'iphone5', '', 'iphone5 from appla store', 'iphone5', 'from appla store'),
(38, 'icmarket', 24, 'icMarket/detail/sony-vaio-24', 'sony vaio', '', 'sony vaio sony vaio tz540', 'sony vaio', 'sony vaio Tz540'),
(39, 'icmarket', 25, 'icMarket/detail/samsung-galaxy-s-ii-25', 'samsung galaxy s ii', '', 'samsung galaxy s ii taking slim to the next dimension the samsung galaxy s ii rides the leading edge with an ultraslim 849mm form factor a luxurious design and an easy grip the ultraslim smartphonealso boasts 3d touchwiz ux adds to the evolutionary experience with a futuristic user interface', 'Samsung Galaxy S II', 'Taking slim to the next dimension. The Samsung GALAXY S II rides the leading edge with an ultra-slim 8.49mm form factor, a luxurious design and an easy grip. The ultra-slim smartphonealso boasts 3D TouchWiz UX adds to the evolutionary experience with a futuristic user interface.'),
(40, 'icmarket', 26, 'icMarket/detail/furniture-test-26', 'furniture test', '', 'furniture test furniture test', 'furniture test', 'furniture test'),
(41, 'icmarket', 27, 'icMarket/detail/blackberry-storm-9530-1gb-black-unlocked-smartphone-27', 'blackberry storm 9530 1gb black unlocked smartphone', '', 'blackberry storm 9530 1gb black unlocked smartphone blackberry storm 9530 1gb black unlocked smartphone', 'BlackBerry Storm 9530 - 1GB - Black (Unlocked) Smartphone', 'BlackBerry Storm 9530 - 1GB - Black (Unlocked) Smartphone'),
(42, 'icmarket', 28, 'icMarket/detail/furniture-test-2-28', 'furniture test 2', '', 'furniture test 2 furniture test 2 furniture test 2br ', 'furniture test 2', 'furniture test 2. furniture test 2......<br />'),
(43, 'icmarket', 29, 'icMarket/detail/furniture-test-3-29', 'furniture test 3', '', 'furniture test 3 furniture test 3 furniture test 3', 'furniture test 3', 'furniture test 3, furniture test 3'),
(44, 'icmarket', 30, 'icMarket/detail/bobkona-hungtinton-microfiberfaux-leather-3piece-sectional-sofa-set-mushroom-30', 'bobkona hungtinton microfiber faux leather 3piece sectional sofa set mushroom', '', 'bobkona hungtinton microfiber faux leather 3piece sectional sofa set mushroom bobkona hungtinton microfiber faux leather 3piece sectional sofa set mushroom', 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Mushroom', 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Mushroom'),
(45, 'icmarket', 31, 'icMarket/detail/bobkona-hungtinton-microfiberfaux-leather-3piece-sectional-sofa-set-sage-31', 'bobkona hungtinton microfiber faux leather 3piece sectional sofa set sage', '', 'bobkona hungtinton microfiber faux leather 3piece sectional sofa set sage bobkona hungtinton microfiber faux leather 3piece sectional sofa set sage', 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Sage', 'Bobkona Hungtinton Microfiber/Faux Leather 3-Piece Sectional Sofa Set, Sage'),
(46, 'icmarket', 32, 'icMarket/detail/canon-powershot-a1200-121-mp-digital-camera-with-4x-optical-zoom-32', 'canon powershot a1200 121 mp digital camera with 4x optical zoom', '', 'canon powershot a1200 121 mp digital camera with 4x optical zoom wthe powershot a1200 digital camera gives you a choice thatâ€™s getting increasingly hard to find on digital cameras today itâ€™s equipped with an optical viewfinder in addition to the lcd screen many photographers prefer this classic familiar option that lets you simply hold the camera to your eye and shootbr the cameraâ€™s big bright lcd screen gives you a wealth of important information about the shot however using it to compose and focus requires that you hold the camera away from your body many people do this with one hand arms away from the body effectively creating camera shake that can distort a shot using the optical viewfinder helps ensure that the camera is held steady', 'Canon Powershot A1200 12.1 MP Digital Camera with 4x Optical Zoom', 'WThe PowerShot A1200 digital camera gives you a choice thatâ€™s getting increasingly hard to find on digital cameras today. Itâ€™s equipped with an Optical Viewfinder in addition to the LCD screen. Many photographers prefer this classic, familiar option that lets you simply hold the camera to your eye and shoot.<br />The cameraâ€™s big, bright LCD screen gives you a wealth of important information about the shot. However, using it to compose and focus requires that you hold the camera away from your body. Many people do this with one hand, arms away from the body, effectively creating camera shake that can distort a shot. Using the Optical Viewfinder helps ensure that the camera is held steady.'),
(47, 'icmarket', 33, 'icMarket/detail/furniture-test-4-33', 'furniture test 4', '', 'furniture test 4 furniture test 4 furniture test 4 furniture test 4br furniture test 4br furniture test 4br furniture test 4furniture test 4br br furniture test 4furniture test 4furniture test 4', 'furniture test 4', 'furniture test 4 furniture test 4 furniture test 4<br />furniture test 4<br />furniture test 4<br />furniture test 4furniture test 4<br /><br />furniture test 4furniture test 4furniture test 4'),
(48, 'icmarket', 34, 'icMarket/detail/motorola-droid-2-34', 'motorola droid 2', '', 'motorola droid 2 android 22 os', 'Motorola Droid 2', 'Android 2.2 OS'),
(49, 'icmarket', 36, 'icMarket/detail/apple-ipad-2-36', 'apple ipad 2', '', 'apple ipad 2 two cameras for facetime and hd video recording the dualcore a5 chip 10hour battery life1 over 200 new software features in ios 5 and icloud all in a remarkably thin light design thereâ€™s so much to ipad itâ€™s amazing thereâ€™s so little of it', 'apple ipad 2', 'Two cameras for FaceTime and HD video recording. The dual-core A5 chip. 10-hour battery life.1 Over 200 new software features in iOS 5. And iCloud. All in a remarkably thin, light design. Thereâ€™s so much to iPad, itâ€™s amazing thereâ€™s so little of it.'),
(50, 'icmarket', 37, 'icMarket/detail/apple-ipad-2-37', 'apple ipad 2', '', 'apple ipad 2 when you pick up ipad it becomes an extension of you thatâ€™s the idea behind its innovative design itâ€™s just 034 inch thin and weighs as little as 133 pounds so it feels completely comfortable in your hands2 and it makes surfing the web checking email watching movies and reading books so natural youâ€™ll wonder why you ever did it any other way', 'apple ipad 2', 'When you pick up iPad, it becomes an extension of you. Thatâ€™s the idea behind its innovative design. Itâ€™s just 0.34 inch thin and weighs as little as 1.33 pounds, so it feels completely comfortable in your hands.2 And it makes surfing the web, checking email, watching movies, and reading books so natural, youâ€™ll wonder why you ever did it any other way.'),
(51, 'icmarket', 38, 'icMarket/detail/iphone-4s-38', 's', '', 's s', 'iphone 4s', 'Siri on iPhone 4S lets you use your voice to send messages, schedule meetings, place phone calls, and more. Ask Siri to do things just by talking the way you talk. Siri understands what you say, knows what you mean, and even talks back. Siri is so easy to use and does so much, youâ€™ll keep finding more and more ways to use it.'),
(52, 'icmarket', 39, 'icMarket/detail/iphone-4s-39', 's', '', 's s', 'iphone 4s', 'Siri on iPhone 4S lets you use your voice to send messages, schedule meetings, place phone calls, and more. Ask Siri to do things just by talking the way you talk. Siri understands what you say, knows what you mean, and even talks back. Siri is so easy to use and does so much, youâ€™ll keep finding more and more ways to use it. '),
(53, 'icmarket', 40, 'icMarket/detail/iphone-4s-40', 'iphone 4s', '', 'iphone 4s siri on iphone 4s lets you use your voice to send messages schedule meetings place phone calls and more ask siri to do things just by talking the way you talk siri understands what you say knows what you mean and even talks back siri is so easy to use and does so much youâ€™ll keep finding more and more ways to use it', 'iphone 4s', 'Siri on iPhone 4S lets you use your voice to send messages, schedule meetings, place phone calls, and more. Ask Siri to do things just by talking the way you talk. Siri understands what you say, knows what you mean, and even talks back. Siri is so easy to use and does so much, youâ€™ll keep finding more and more ways to use it. '),
(54, 'textbooks', 51, 'textbooks/listing/ggfds-51', 'ggfds', '', '1111111111111 111111   ', 'ggfds', '1111111111111 111111'),
(55, 'articles', 1, 'articles/detail/google-puts-a-price-on-privacy-1', 'google puts a price on privacy', '', 'google puts a price on privacy ltpgtgoogle puts a price on privacylt pgt', 'Google Puts A Price On Privacy', '&lt;p&gt;Google Puts A Price On Privacy&lt;/p&gt;'),
(56, 'articles', 4, 'articles/detail/google-puts-a-price-on-privacy-4', 'google puts a price on privacy', '', 'google puts a price on privacy ltpgtgoogle puts a price on privacylt pgt', 'Google Puts A Price On Privacy', '&lt;p&gt;Google Puts A Price On Privacy&lt;/p&gt;'),
(57, 'articles', 5, 'articles/detail/google-puts-a-price-on-privacy-5', 'google puts a price on privacy', '', 'google puts a price on privacy ltpgtgoogle puts a price on privacylt pgt', 'Google Puts A Price On Privacy', '&lt;p&gt;Google Puts A Price On Privacy&lt;/p&gt;'),
(58, 'articles', 6, 'articles/detail/google-puts-a-price-on-privacy-6', 'google puts a price on privacy', '', 'google puts a price on privacy ltpgtgoogle puts a price on privacylt pgt', 'Google Puts A Price On Privacy', '&lt;p&gt;Google Puts A Price On Privacy&lt;/p&gt;'),
(59, 'articles', 1, 'articles/detail/google-removes-the-search-command-1', 'google removes the search command', '', 'google removes the search command ltpgtgoogle removes the search commandlt pgt', 'Google Removes The + Search Command', '&lt;p&gt;Google Removes The + Search Command&lt;/p&gt;'),
(60, 'articles', 2, 'articles/detail/google-removes-the-search-command-pandog-2', 'google removes the search command pandog', '', 'google removes the search command pandog ltpgtgoogle has quietly removed one of the older lta hrefquothttp wwwgooglecom support websearch bin answerpyanswer136861quotgtsearch operatorslt agt the search operator now if you try adding a sign in your query google will ignore itlt pgtbr ltpgtwhy did google remove the old search operator kelly from google said in a lta hrefquothttp wwwgooglecom support forum p web20search threadtid151ef6cf0a761b74ampamphlenquotgtforum threadlt agt that you can now use the quotation marks operator instead of the operator she saidlt pgtbr ltblockquotegtweâ€™ve made the ways you can tell google exactly what you want more consistent by expanding the functionality of the quotation marks operator in addition to using this operator to search for an exact phrase you can now add quotation marks around a single word to tell google to match that word precisely so if in the past you would have searched for magazine latina you should now search for magazine quotlatinaquotlt blockquotegtbr ltpgti am feeling google removed the plus operator because of google  their social network they do not want google confused with the operator and now typing in into google will auto complete with your friendâ€™s nameslt pgtbr ltpgti personally rarely used the plus operator often using quotes instead but i am personally sad to see it golt pgt', 'Google Removes The + Search Command pandog', '&lt;p&gt;Google has quietly removed one of the older &lt;a href=&quot;http://www.google.com/support/websearch/bin/answer.py?answer=136861&quot;&gt;search operators&lt;/a&gt;, the + search operator. Now if you try adding a + sign in your query, Google will ignore it.&lt;/p&gt;<br />&lt;p&gt;Why did Google remove the old search operator? Kelly from Google said in a &lt;a href=&quot;http://www.google.com/support/forum/p/Web%20Search/thread?tid=151ef6cf0a761b74&amp;amp;hl=en&quot;&gt;forum thread&lt;/a&gt; that you can now use the quotation marks operator instead of the + operator. She said:&lt;/p&gt;<br />&lt;blockquote&gt;Weâ€™ve made the ways you can tell Google exactly what you  want more consistent by expanding the functionality of the quotation  marks operator. In addition to using this operator to search for an  exact phrase, you can now add quotation marks around a single word to  tell Google to match that word precisely. So, if in the past you would  have searched for [magazine +latina], you should now .'),
(61, 'articles', 3, 'articles/detail/google-puts-a-price-on-privacy-3', 'google puts a price on privacy', '', 'google puts a price on privacy ltpgtgoogle puts a price on privacylt pgt', 'Google Puts A Price On Privacy', '&lt;p&gt;Google Puts A Price On Privacy&lt;/p&gt;'),
(62, 'articles', 1, 'articles/detail/google-removes-the-search-command-1', 'google removes the search command', '', 'google removes the search command ltpgtearlier this week google made a lta hrefquothttp searchenginelandcom googletobeginencryptingsearchesoutboundclicksbydefault97435quotgtsignificant changelt agt purportedly to better protect the search privacy of users in reality it specifically â€” and deliberately â€” left a gaping hole open to benefit its bottom line if you paytoplay google will share its search data with yoult pgtbr ltpgtgoogleâ€™s a big company that goes after revenue in a variety of ways some critics feel put users second however iâ€™mâ struggling to think of other examples where google has acted in such a crass itâ€™s allabouttherevenue manner as it has this week the best comparison i can think of is when google decided to allow chinese censorship yes this is in the same leaguelt pgtbr ltpgtitâ€™s in that league because google is a company that prides itself by doing right by the user yet in this case it seems perfectly happy to sell out privacy if youâ€™re an advertiser thatâ€™s assuming you believe that caller idlike information thatâ€™s being blocked except for advertisers is a privacy issuelt pgtbr ltpgtgoogle doesnâ€™t as best i can tell instead the blocking is a pesky side effect to a real privacy enhancement google made a side effect google doesnâ€™t seem to want to cure for anyone but advertiserslt pgtbr ltpgtif it had taken a more thoughtful approach ironically google could have pushed many sites across the web to become more secure themselves it missed that opportunitylt pgtbr ltpgtiâ€™ll cover all of this below in detail itâ€™s a long article if you prefer a short summary skip to the last two sections â€œwhy not get everyone to be secureâ€ and â€œmoving forwardâ€lt pgtbr lth2gtdefault encrypted search beginslt h2gtbr ltpgtletâ€™s talk particulars on tuesday google announced that by default it would encrypt the search sessions of anyone signed in to googlecom this means that when someone searches no one can see the results that google is sending back to themlt pgtbr ltpgtthatâ€™s good just as you might want your gmail accountâ encrypted so that no one can see what youâ€™re emailing so you also may want the search results that google is communicated back to you to be kept privatelt pgtbr ltpgtthatâ€™s especially so because those search results are getting more personalized and potentially could be hacked the eff in itsâ lta hrefquothttps wwwefforg deeplinks 2011 10 googleencryptsmoresearchesquotgtpostlt agt about googleâ€™s change pointed to two papers lta hrefquothttp planeteinrialpesfr 7eccastel papers historiopdfquotgtherelt agt and lta hrefquothttp arxivorg pdf 11085864v1quotgtherelt agt about thislt pgt', 'Google Removes The + Search Command', '&lt;p&gt;Earlier this week, Google made a &lt;a href=&quot;http://searchengineland.com/google-to-begin-encrypting-searches-outbound-clicks-by-default-97435&quot;&gt;significant change&lt;/a&gt; purportedly to better protect the search privacy of users. In reality,  it specifically â€” and deliberately â€” left a gaping hole open to benefit  its bottom line. If you pay-to-play, Google will share its search data  with you.&lt;/p&gt;<br />&lt;p&gt;Googleâ€™s a big company that goes after revenue in a variety of ways  some critics feel put users second. However, Iâ€™mÂ struggling to think of  other examples where Google has acted in such a crass, itâ€™s  all-about-the-revenue manner as it has this week. The best comparison I  can think of is when Google decided to allow Chinese censorship. Yes,  this is in the same league.&lt;/p&gt;<br />&lt;p&gt;Itâ€™s in that league because Google is a company that prides itself by  doing right by the user. Yet in this case, it seems perfectly happy to  sell out privacy, if ...'),
(63, 'articles', 2, 'articles/detail/google-removes-the-search-command-pandog-2', 'google removes the search command pandog', '', 'google removes the search command pandog ltpgtgoogle has quietly removed one of the older lta hrefquothttp wwwgooglecom support websearch bin answerpyanswer136861quotgtsearch operatorslt agt the search operator now if you try adding a sign in your query google will ignore itlt pgtbr ltpgtwhy did google remove the old search operator kelly from google said in a lta hrefquothttp wwwgooglecom support forum p web20search threadtid151ef6cf0a761b74ampamphlenquotgtforum threadlt agt that you can now use the quotation marks operator instead of the operator she saidlt pgtbr ltblockquotegtweâ€™ve made the ways you can tell google exactly what you want more consistent by expanding the functionality of the quotation marks operator in addition to using this operator to search for an exact phrase you can now add quotation marks around a single word to tell google to match that word precisely so if in the past you would have searched for magazine latina you should now search for magazine quotlatinaquotlt blockquotegtbr ltpgti am feeling google removed the plus operator because of google  their social network they do not want google confused with the operator and now typing in into google will auto complete with your friendâ€™s nameslt pgtbr ltpgti personally rarely used the plus operator often using quotes instead but i am personally sad to see it golt pgt', 'Google Removes The + Search Command pandog', '&lt;p&gt;Google has quietly removed one of the older &lt;a href=&quot;http://www.google.com/support/websearch/bin/answer.py?answer=136861&quot;&gt;search operators&lt;/a&gt;, the + search operator. Now if you try adding a + sign in your query, Google will ignore it.&lt;/p&gt;<br />&lt;p&gt;Why did Google remove the old search operator? Kelly from Google said in a &lt;a href=&quot;http://www.google.com/support/forum/p/Web%20Search/thread?tid=151ef6cf0a761b74&amp;amp;hl=en&quot;&gt;forum thread&lt;/a&gt; that you can now use the quotation marks operator instead of the + operator. She said:&lt;/p&gt;<br />&lt;blockquote&gt;Weâ€™ve made the ways you can tell Google exactly what you  want more consistent by expanding the functionality of the quotation  marks operator. In addition to using this operator to search for an  exact phrase, you can now add quotation marks around a single word to  tell Google to match that word precisely. So, if in the past you would  have searched for [magazine +latina], you should now .'),
(64, 'news', 3, 'news/detail/news-are-comments-important-to-your-b2b-blogâ€™s-success-3', 'news are comments important to your b2b blogâ€™s success', '', 'news are comments important to your b2b blogâ€™s success ltpgti went against everything i know as a social seo person a few weeks ago it may be a cardinal sin of social media marketing and blogging but i decided to close the comments on my companyâ€™s lta hrefquothttp wwwbrickmarketingcom blog quot targetquot_blankquotgtinternet marketing bloglt agt i had been trying to find a way to better manage the commenting process on that blog for a while it had been getting so many spam comments everyday anywhere from several hundred a thousand and even though most of them were getting caught and filtered by the spam filter i was still manually sorting through the ones that snuck iâ€™d say that for every 50 comments that i had to manually approve maybe 1 was a good commentâ  forget about the 5000 spam comments that were already caught every day33lt pgt', 'News - Are Comments Important to Your B2B Blogâ€™s Success?', '&lt;p&gt;I went against everything I know as a social SEO person a few weeks ago.  It may be a cardinal sin of social media marketing and blogging, but I  decided to close the comments on my companyâ€™s &lt;a href=&quot;http://www.brickmarketing.com/blog/&quot; target=&quot;_blank&quot;&gt;internet marketing blog&lt;/a&gt;.  I had been trying to find a way to better manage the commenting process  on that blog for a while. It had been getting so many spam comments  everyday (anywhere from several hundred a thousand), and even though  most of them were getting caught and filtered by the spam filter, I was  still manually sorting through the ones that snuck. Iâ€™d say that for  every 50 comments that I had to manually approve MAYBE 1 was a good  comment.Â  (forget about the 5,000 spam comments that were already caught  every day&#33;)&lt;/p&gt;'),
(65, 'events', 4, 'events/detail/events-google-introduces-â€œbid-for-callsâ€-on-the-pc-4', 'events google introduces â€œbid for callsâ€ on the pc', '', 'events google introduces â€œbid for callsâ€ on the pc ltp stylequotmargintop 0px marginright 0px marginbottom 10px marginleft 0px padding 0pxquotgtearlier this summer google gave anltspan classquotappleconvertedspacequotgt lt spangtlta hrefquothttp searchenginelandcom googleopensupcallmetricsplansbidforcallsmarketplaceonline86222quotgtindicationlt agtltspan classquotappleconvertedspacequotgt lt spangtthis was coming now google is rolling out what itâ€™s calling â€œlta hrefquothttp adwordsblogspotcom 2011 10 introducingbidpercallinadwordshtmlquotgtbid for callslt agtâ€ a pay per call ppcall offering on the pc this is distinct from click to call its successful mobile ppcall product the program will launch in the us and uk at first and relies on the call metrics google voice infrastructurelt pgtbr ltp stylequotmargintop 0px marginright 0px marginbottom 10px marginleft 0px padding 0pxquotgtadwords advertisers must use call metrics and a google voicegenerated call tracking number to participate but rather than just paying 0361 per completed call for call tracking advertisers can now separately bid on callslt pgtbr ltp stylequotmargintop 0px marginright 0px marginbottom 10px marginleft 0px padding 0pxquotgtin the near future depending on the amount of bids and how many calls are received google will begin to include calls in its ads quality score i spoke to googleâ€™sâ surojit chatterjee who told me advertisers that donâ€™t participate in bid for calls wonâ€™t be disadvantaged but advertisers whose paidsearch ads are generating lots of calls may see a boost in their adwords rankings accordinglylt pgtbr ltp stylequotmargintop 0px marginright 0px marginbottom 10px marginleft 0px padding 0pxquotgtin other words â€œcallthrough rateâ€ will now be a factor in ranking to participate in bid for calls advertisers enable call extensions and call metricslt pgtbr ltp stylequotmargintop 0px marginright 0px marginbottom 10px marginleft 0px padding 0pxquotgtlast year when googleâ€™s call tracking program â€œlta hrefquothttp adwordsblogspotcom 2011 07 nowallusandcanadaadvertiserscanhtmlquotgtcall metricslt agtâ€ was first introduced iltspan classquotappleconvertedspacequotgt lt spangtlta hrefquothttp wwwscreenwerkcom 2010 11 02 freecalltrackingcomestoadwordsppcallnotfarbehind quotgtsuspectedlt agtppcall wouldnâ€™t be far behind google experimented with ppcall on the pc years ago but never rolled it out broadlylt pgtbr ltp stylequotmargintop 0px marginright 0px marginbottom 10px marginleft 0px padding 0pxquotgtdespite its relatively lowkey introduction this morning this is a major development for google and for adwords advertisers being able to bid on calls separately as well as getting ranking â€œcreditâ€ for calls generated from google ads will be significant for many advertisers local and national that operate call centers or have stores in the real worldlt pgt', 'Events - Google Introduces â€œBid For Callsâ€ On The PC', '&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;Earlier this summer Google gave an&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;&lt;a href=&quot;http://searchengineland.com/google-opens-up-call-metrics-plans-bid-for-calls-marketplace-online-86222&quot;&gt;indication&lt;/a&gt;&lt;span class=&quot;Apple-converted-space&quot;&gt; &lt;/span&gt;this was coming. Now Google is rolling out what itâ€™s calling â€œ&lt;a href=&quot;http://adwords.blogspot.com/2011/10/introducing-bid-per-call-in-adwords.html&quot;&gt;bid for calls&lt;/a&gt;,â€ a pay per call (PPCall) offering on the PC. This is distinct from Click to Call, its successful mobile PPCall product. The program will launch in the US and UK at first and relies on the Call Metrics (Google Voice) infrastructure.&lt;/p&gt;<br />&lt;p style=&quot;margin-top: 0px; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px;&quot;&gt;AdWords advertisers must use Call .'),
(66, 'events', 5, 'events/detail/microsoft-wants-you-to-search-the-web-like-miley-cyrus-5', 'microsoft wants you to search the web like miley cyrus', '', 'microsoft wants you to search the web like miley cyrus ltpgtmicrosoftâ€™s us patent application â€œapplying a model of persona to search resultsâ€ outlines a search system that would allow users to search the web as their favorite celebrity other possible uses for the technology include searching based on a person or groups characteristics or even the preferences of a friendlt pgtbr ltpgtpublished october 13 the application paves the way for microsoft to lta hrefquothttp appft1usptogov netacgi nphparsersect1pto1ampampsect2hitoffampampdpg01ampampp1ampampu2fnetahtml2fpto2fsrchnumhtmlampampr1ampampfgampampl50ampamps1222011025201422pgnrampamposdn 20110252014ampamprsdn 20110252014quot targetquot_blankquotgtdevelop a search methodlt agt that would bring back results as they would appear to say miley cyrus anna wintour or my own favorite superstar mary catherine gallagherlt pgtbr ltpgthow would it work microsoft could design a system that gives users a list of characteristics that act as identifiers for predetermined personas ie supermodel fashionista football quarterback the persona could also be that of a person such as lindsay lohan or mike tyson a new component in the search stack would generate and filter results to bring back results as that persona would seelt pgtbr ltpgtwhile this persona model of search could certainly be useful in the fashion and music realms who else could benefitlt pgt', 'Microsoft Wants You to Search the Web Like Miley Cyrus', '&lt;p&gt;Microsoftâ€™s U.S. patent application, â€œApplying a Model of Persona to  Search Results,â€ outlines a search system that would allow users to  search the web as their favorite celebrity. Other possible uses for the  technology include searching based on a person or groups  characteristics, or even the preferences of a friend.&lt;/p&gt;<br />&lt;p&gt;Published October 13, the application paves the way for Microsoft to &lt;a href=&quot;http://appft1.uspto.gov/netacgi/nph-Parser?Sect1=PTO1&amp;amp;Sect2=HITOFF&amp;amp;d=PG01&amp;amp;p=1&amp;amp;u=%2Fnetahtml%2FPTO%2Fsrchnum.html&amp;amp;r=1&amp;amp;f=G&amp;amp;l=50&amp;amp;s1=%2220110252014%22.PGNR.&amp;amp;OS=DN/20110252014&amp;amp;RS=DN/20110252014&quot; target=&quot;_blank&quot;&gt;develop a search method&lt;/a&gt; that  would bring back results as they would appear to, say, Miley Cyrus,  Anna Wintour, or my own favorite superstar, Mary Catherine Gallagher.&lt;/p&gt;<br />&lt;p&gt;How would it work? Microsoft could design a system that gives users ');
INSERT INTO `vsf_search` (`searchId`, `searchModule`, `searchObj`, `searchUrl`, `searchTitle`, `searchIntro`, `searchContent`, `searchOTitle`, `searchOIntro`) VALUES
(67, 'events', 6, 'events/detail/events-content-amp-search-engine-ranking-factors-6', 'events content amp search engine ranking factors', '', 'events content amp search engine ranking factors ltpgtyouâ€™ll hear it over and over again content is king when it comes to aiming for success with search engines indeed thatâ€™s why the lta hrefquothttp searchenginelandcom seotablequotgtperiodic table of seo ranking factorslt agt begins with the content â€œelementsâ€ with the very first element being about content quality get your content right and youâ€™ve created a solid foundation to support all your other seo effortslt pgtbr lth2gtcq content qualitylt h2gtbr ltpgtmore than anything else are you producing quality content if youâ€™re selling something do you go beyond being only a brochure with the same information that can be found on hundreds of other siteslt pgtbr ltpgtdo you provide a reason for people to spend more than a few seconds reading your pageslt pgtbr ltpgtdo you offer real value something of substance to visitors anything unique different useful and that they wonâ€™t find elsewherelt pgtbr ltpgtthese are just some of the questions to ask yourself in assessing whether youâ€™re providing quality content do provide it because it is literally the cornerstone upon which other factors dependlt pgtbr ltpgtbelow some articles on the topic of content quality from search engine land to get you thinking in the right directionlt pgt', 'Events - Content &amp; Search Engine Ranking Factors', '&lt;p&gt;Youâ€™ll hear it over and over again. Content is king, when it comes to  aiming for success with search engines. Indeed, thatâ€™s why the &lt;a href=&quot;http://searchengineland.com/seotable&quot;&gt;Periodic Table Of SEO Ranking Factors&lt;/a&gt; begins with the content â€œelements,â€ with the very first element being  about content quality. Get your content right, and youâ€™ve created a  solid foundation to support all your other SEO efforts.&lt;/p&gt;<br />&lt;h2&gt;Cq: Content Quality&lt;/h2&gt;<br />&lt;p&gt;More than anything else, are you producing quality content? If youâ€™re  selling something, do you go beyond being only a brochure with the same  information that can be found on hundreds of other sites?&lt;/p&gt;<br />&lt;p&gt;Do you provide a reason for people to spend more than a few seconds reading your pages?&lt;/p&gt;<br />&lt;p&gt;Do you offer real value, something of substance to visitors, anything  unique, different, useful and that they wonâ€™t find elsewhere?&lt;/p&gt;<br ...'),
(68, 'news', 7, 'news/detail/news-content-amp-search-engine-ranking-factors-7', 'news content amp search engine ranking factors', '', 'news content amp search engine ranking factors ltpgtit looks like adding a suggested user list to lta hrefquothttp searchenginelandcom googlesfacebookcompetitorthegooglesocialnetworkfinallyarrives83401quotgtgooglelt agt has finally paid off in solving its â€œmark zuckerberg problemâ€ facebookâ€™s ceo is no longer the most popular person on google having just now been passed by google ceo larry pagelt pgtbr ltpgtzuckerberg has been the most followed userâ lta hrefquothttp searchenginelandcom oneweekingoogleusersaregrowingfollowersgettingtraffic84371quotgtsince the first week that google launchedlt agt thatâ€™s despite never once having posted to google pluslt pgtbr lth2gtsuggested user list launchedlt h2gtbr ltpgton september 3 google lta hrefquothttp searchenginelandcom thisweekongooglesuggestedusersapidelaysmeasuringgoogleinfluence91902quotgtlaunched a google suggested user listlt agtâ encouraging google users to â€œfollow public posts from interesting and famous peopleâ€ as you can see belowlt pgt', 'News - Content &amp; Search Engine Ranking Factors', '&lt;p&gt;It looks like adding a suggested user list to &lt;a href=&quot;http://searchengineland.com/googles-facebook-competitor-the-google-social-network-finally-arrives-83401&quot;&gt;Google+&lt;/a&gt; has finally paid off in solving its â€œMark Zuckerberg problem.â€  Facebookâ€™s CEO is no longer the most popular person on Google+, having  just now been passed by Google CEO Larry Page.&lt;/p&gt;<br />&lt;p&gt;Zuckerberg has been the most followed userÂ &lt;a href=&quot;http://searchengineland.com/one-week-in-google-users-are-growing-followers-getting-traffic-84371&quot;&gt;since the first week that Google+ launched&lt;/a&gt;. Thatâ€™s despite never once having posted to Google Plus.&lt;/p&gt;<br />&lt;h2&gt;Suggested User List Launched&lt;/h2&gt;<br />&lt;p&gt;On September 3, Google &lt;a href=&quot;http://searchengineland.com/this-week-on-google-suggested-users-api-delays-measuring-google-influence-91902&quot;&gt;launched a Google+ suggested user list&lt;/a&gt;,Â encouraging Google+ users to â€œfollow ...'),
(69, 'news', 8, 'news/detail/fsffsdfd-8', 'fsffsdfd', '', 'fsffsdfd ltpgt1111lt pgt', 'fsffsdfd', '&lt;p&gt;1111&lt;/p&gt;'),
(70, 'news', 9, 'news/detail/fsdaf1111-9', 'fsdaf1111', '', 'fsdaf1111 ltpgtfsafasdflt pgt', 'fsdaf1111', '&lt;p&gt;fsafasdf&lt;/p&gt;'),
(71, 'news', 10, 'news/detail/fsaf-10', 'fsaf', '', 'fsaf ltpgtfsdaflt pgt', 'fsaf', '&lt;p&gt;fsdaf&lt;/p&gt;'),
(72, 'news', 11, 'news/detail/news-industrial-strength-three-steps-to-sem-planning-success-11', 'news industrial strength three steps to sem planning success', '', 'news industrial strength three steps to sem planning success ltpgtahh annual planning season nothing quite like it you can almost smell it in the airlt pgtbr ltpgtdozens of spreadsheets packed with endless assumptions each one more fantastic than the last combining to ultimately seal a marketerâ€™s fate for the next 12 months what could be better than thatlt pgtbr ltpgtwell how about three steps to make your sem planning process more successfullt pgtbr ltolgtbr ltligtalign sem goals with company strategylt ligtbr ltligtbuild different scenarios to illustrate tradeoffslt ligtbr ltligtengage with all stakeholders multiple times throughout the processlt ligtbr lt olgtbr ltpgta couple of years ago i wrote a lta hrefquothttp searchenginelandcom planningforsuccess16798quotgtcolumn about our monthly reforecastlt agt an internal tool that weâ€™ve foundâ indispensable we use it still to this day in fact iâ€™ve had multiple requests for the reforecast template we uselt pgtbr ltpgtit helps us to communicate unanticipated changes to what we thought was going to happen when we built this yearâ€™s plan last year i wanted to take a moment to reiterate the importance of that particular tool and to look at the basic process that gives rise to the need for the reforecast â€“ the planlt pgtbr ltpgtthe reforecast of course becomes necessary when your sem plan of record inevitably turns out to be incorrect and as i mentioned your real work around this phenomenon comes less in sem management and more in expectation setting and managementlt pgtbr ltpgtto summarize the reforecast template should be standardized and buyin on all levels is required before you can roll this out in an organization of any significant size or complexitylt pgtbr ltpgtbut back to the planning process â€” because thatâ€™s where most of us are right now the planning process as it turns out is equal parts financial analysis and catherdinglt pgtbr ltpgtthe most influential factor in the planning process is and should be the overarching business strategy of the company depending on whether youâ€™re a startup in hypergrowth mode or a mature industryleading brand or more likely something in between you should align your sem planning process with your companyâ€™s financial goalslt pgtbr ltpgtas an example a few years ago we lta hrefquothttp searchenginelandcom makingpaidsearchworkforyou15460quotgtshifted sem strategylt agt from one that focused on average roi to one that strives to maximize profit the resulting metrics like cost and revenue diverge pretty widely in these two scenarios and thus i canâ€™t overemphasize the need to work on this topic before you build your planlt pgt', 'News - Industrial Strength Three Steps To SEM Planning Success', '&lt;p&gt;Ahh, annual planning season. Nothing quite like it. You can almost smell it in the air.&lt;/p&gt;<br />&lt;p&gt;Dozens of spreadsheets packed with endless assumptions, each one more  fantastic than the last, combining to ultimately seal a marketerâ€™s fate  for the next 12 months. What could be better than that?&lt;/p&gt;<br />&lt;p&gt;Well, how about three steps to make your SEM planning process more successful:&lt;/p&gt;<br />&lt;ol&gt;<br />&lt;li&gt;Align SEM goals with company strategy&lt;/li&gt;<br />&lt;li&gt;Build different scenarios to illustrate tradeoffs&lt;/li&gt;<br />&lt;li&gt;Engage with all stakeholders multiple times throughout the process&lt;/li&gt;<br />&lt;/ol&gt;<br />&lt;p&gt;A couple of years ago, I wrote a &lt;a href=&quot;http://searchengineland.com/planning-for-success-16798&quot;&gt;column about our Monthly Reforecast&lt;/a&gt;,  an internal tool that weâ€™ve foundÂ indispensable; we use it still to  this day. In fact, Iâ€™ve had multiple requests for the reforecast  ...'),
(73, 'news', 12, 'news/detail/news-multinational-search-should-you-have-a-prenup-with-your-global-search-vendor-12', 'news multinational search should you have a prenup with your global search vendor', '', 'news multinational search should you have a prenup with your global search vendor ltpgtnearly all search vendors have some sort of agreement and the larger the client the more complex the terms of service will be with procurement as welllt pgtbr ltpgtmost of these focus on the standard stuff how long how much scope and what happens if their vendor screws up and the relationship needs to be terminated unfortunately few have any language about some of the unique situations that can occur in search campaignslt pgtbr ltpgtgetting into the details of the contracts between agencies and companies is a lot like discussing a prenup with your significant other no one wants to even think the relationship wonâ€™t last but you do have to be prepared for possibility that it wonâ€™t the following are some key considerations you should think about before you enter into that vendor marriagelt pgt', 'News - Multinational Search Should You Have A Prenup With Your Global Search Vendor?', '&lt;p&gt;Nearly all search vendors have some sort of agreement, and the larger  the client, the more complex the terms of service will be with  procurement as well.&lt;/p&gt;<br />&lt;p&gt;Most of these focus on the standard stuff: how long, how much, scope  and what happens if their vendor screws up and the relationship needs to  be terminated. Unfortunately, few have any language about some of the  unique situations that can occur in search campaigns.&lt;/p&gt;<br />&lt;p&gt;Getting into the details of the contracts between agencies and  companies is a lot like discussing a prenup with your significant other.  No one wants to even think the relationship wonâ€™t last, but you do have  to be prepared for possibility that it wonâ€™t. The following are some  key considerations you should think about before you enter into that  vendor marriage.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_seo`
--

CREATE TABLE IF NOT EXISTS `vsf_seo` (
  `seoId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `seoType` tinyint(1) NOT NULL,
  `seoAliasUrl` varchar(255) NOT NULL,
  `seoRealUrl` varchar(255) NOT NULL,
  `seoTitle` varchar(255) NOT NULL,
  `seoKeyword` varchar(255) NOT NULL,
  `seoIntro` text NOT NULL,
  `seoStatus` tinyint(1) NOT NULL DEFAULT '1',
  `seoModule` varchar(16) NOT NULL,
  `seoObj` int(10) NOT NULL,
  PRIMARY KEY (`seoId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `vsf_seo`
--

INSERT INTO `vsf_seo` (`seoId`, `seoType`, `seoAliasUrl`, `seoRealUrl`, `seoTitle`, `seoKeyword`, `seoIntro`, `seoStatus`, `seoModule`, `seoObj`) VALUES
(1, 0, 'terms', 'agreement/terms', 'Terms of Use', '', '', 1, '', 0),
(2, 0, 'privacy', 'agreement/privacy', 'Privacy Policy', '', '', 1, '', 0),
(3, 0, 'careers', 'agreement/careers', 'Careers', '', '', 1, '', 0),
(9, 1, 'news-are-comments-important-to-your-b2b-blog-s-success', 'news/detail/news-are-comments-important-to-your-b2b-blogâ€™s-success-3', 'News - Are Comments Important to Your B2B Blogâ€™s Success', 'google, pandog', 'News - Are Comments Important to Your B2B Blogâ€™s Success', 1, 'news', 3),
(10, 1, 'events-google-introduces-bid-for-calls-on-the-pc', 'events/detail/events-google-introduces-â€œbid-for-callsâ€-on-the-pc-4', 'Events - Google Introduces â€œBid For Callsâ€ On The PC', 'google', 'Events - Google Introduces â€œBid For Callsâ€ On The PC', 1, 'events', 4),
(8, 1, 'google-removes-the-search-command-pandog', 'articles/detail/google-removes-the-search-command-2', 'Google Removes The + Search Command', 'google pando', 'Google has quietly removed one of the older search operators, the + search operator. Now if you try adding a + sign in your query, Google will ignore it.', 1, 'articles', 2),
(11, 1, 'microsoft-wants-you-to-search-the-web-like-miley-cyrus', 'events/detail/microsoft-wants-you-to-search-the-web-like-miley-cyrus-5', 'Microsoft Wants You to Search the Web Like Miley Cyrus', '', '', 1, 'events', 5),
(12, 1, 'events-content-search-engine-ranking-factors', 'events/detail/events-content-amp-search-engine-ranking-factors-6', 'Events - Content &amp; Search Engine Ranking Factors', 'seo, content', 'Events - Content &amp; Search Engine Ranking Factors', 1, 'events', 6),
(13, 1, 'news-content-search-engine-ranking-factors', 'news/detail/events-content-amp-search-engine-ranking-factors-7', '', '', '', 1, 'news', 7),
(18, 1, 'news/news-multinational-search-should-you-have-a-prenup-with-your-global-search-vendor--12', 'news/detail/news-multinational-search-should-you-have-a-prenup-with-your-global-search-vendor-12', '', 'seo, content', '', 1, 'news', 12),
(17, 1, 'news/detail/news-industrial-strength-three-steps-to-sem-planning-success', 'news/detail/news-industrial-strength-three-steps-to-sem-planning-success-11', 'News -Industrial Strength Three Steps To SEM Planning Success', 'seo, content', 'Ahh, annual planning season. Nothing quite like it. You can almost smell it in the air.&lt;br /&gt;Dozens of spreadsheets packed with endless assumptions, each one more fantastic than the last, combining to ultimately seal a marketerâ€™s fate for the next 12 months. What could be better than that?', 1, 'news', 11);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_setting`
--

CREATE TABLE IF NOT EXISTS `vsf_setting` (
  `settingId` int(10) NOT NULL AUTO_INCREMENT,
  `settingCatId` int(10) NOT NULL,
  `settingTitle` varchar(255) NOT NULL,
  `settingIntro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `settingValue` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `settingInputType` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `settingKey` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `settingRoot` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `settingType` tinyint(1) NOT NULL DEFAULT '0',
  `settingModule` varchar(50) NOT NULL DEFAULT 'global',
  `settingIndex` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settingId`),
  KEY `SKey` (`settingKey`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=374 ;

--
-- Dumping data for table `vsf_setting`
--

INSERT INTO `vsf_setting` (`settingId`, `settingCatId`, `settingTitle`, `settingIntro`, `settingValue`, `settingInputType`, `settingKey`, `settingRoot`, `settingType`, `settingModule`, `settingIndex`) VALUES
(54, 249, 'Settings Delete Category', '', '1', 'text', 'settings_delete_category', 0, 1, 'settings', 0),
(53, 249, 'Settings Edit Category', '', '1', '', 'settings_edit_category', 0, 1, 'settings', 0),
(52, 250, 'Campus List Number', '', '10', '', 'campus_list_number', 0, 1, 'textbooks', 0),
(20, 0, 'Public menu cache', 'Public menu cache', '1', 'text', 'public_menu_cache', 1, 2, 'global', 0),
(51, 0, 'Admin Use Multi Language', '', '0', '', 'admin_use_multi_language', 1, 1, 'global', 0),
(19, 0, 'Cache skin wrapper', 'Cache skin wrapper', '1', 'text', 'use_cache_skin_wrapper', 1, 1, 'global', 0),
(18, 0, 'Multi Languages for Admin', 'Multi Languages for Admin', '0', 'text', 'admin_multi_lang', 1, 1, 'global', 0),
(17, 0, 'Multi Languages for User', 'Multi Languages for User', '1', 'text', 'user_multi_lang', 1, 1, 'global', 0),
(16, 0, 'Public Clean URL', 'Rewrite url more friendly', '1', 'text', 'public_cleanurl', 1, 0, 'global', 0),
(15, 0, 'Server time zone', 'Time zone of the server', '-7', 'text', 'global_server_timezone', 1, 1, 'global', 0),
(14, 0, 'User default page', 'The first page when load the public user page', 'textbooks', 'text', 'public_frontpage', 1, 2, 'global', 0),
(13, 0, 'Admin default page', 'The first page when load admin system', 'textbooks', 'text', 'admin_frontpage', 1, 1, 'global', 0),
(12, 0, 'Type of redirect', 'Use for different OS when you got problem with redirect feature', 'normal', 'text', 'header_redirect', 1, 0, 'global', 0),
(11, 0, 'Lifetime of Admin session', 'Number of minutes for admin time out (Example: 30 minutes)', '30', 'text', 'admin_timeout', 1, 1, 'global', 0),
(10, 0, 'Email Wrap Brackets', 'Email Wrap Brackets', 'Yes', 'radio', 'mail_wrap_brackets', 1, 1, 'global', 0),
(9, 0, 'SMTP port', 'Example: 25', '25', 'text', 'email_smtp_port', 1, 1, 'global', 0),
(5, 0, 'SMTP user', 'Example: admin@vietsol.net', '', 'text', 'email_smtp_user', 0, 1, 'global', 0),
(6, 0, 'SMTP Password', 'Example: 123456', '', 'text', 'email_smtp_password', 0, 1, 'global', 0),
(7, 0, 'Mail method', 'Use local PHP method or SMTP', 'Yes', 'radio', 'email_method', 1, 1, 'global', 0),
(8, 0, 'SMTP host', 'Example: smtp.vietsol.net', 'localhost', 'text', 'email_smtp_host', 0, 0, 'global', 0),
(98, 299, 'Users Phone', '', '1', '', 'users_phone', 1, 1, 'users', 0),
(97, 299, 'Users FullName', '', '1', '', 'users_fullName', 1, 1, 'users', 0),
(96, 299, 'Users Status', '', '1', '', 'users_status', 1, 1, 'users', 0),
(95, 299, 'Users Email', '', '1', '', 'users_email', 1, 1, 'users', 0),
(94, 299, 'Users Adress', '', '1', '', 'users_adress', 1, 1, 'users', 0),
(93, 448, 'Location Cate Show Seo', '', '0', '', 'location_cate_show_seo', 0, 1, 'location', 0),
(92, 448, 'Location Special ', '', '0', '', 'location_special_', 0, 1, 'location', 0),
(91, 448, 'Location Hotel Display', '', '0', '', 'location_hotel_display', 0, 1, 'location', 0),
(90, 448, 'Location Alias', '', '0', '', 'location_alias', 0, 1, 'location', 0),
(89, 448, 'Location Right', '', '0', '', 'location_right', 0, 1, 'location', 0),
(88, 448, 'Location Area Home', '', '0', '', 'location_area_home', 0, 1, 'location', 0),
(87, 448, 'Location Value', '', '0', '', 'location_value', 0, 1, 'location', 0),
(86, 448, 'Location File', '', '0', '', 'location_file', 0, 1, 'location', 0),
(85, 448, 'Location Index', '', '1', '', 'location_index', 0, 1, 'location', 0),
(84, 448, 'Location DropDown', '', '0', '', 'location_dropDown', 0, 1, 'location', 0),
(83, 448, 'Location Intro', '', '0', '', 'location_intro', 0, 1, 'location', 0),
(82, 448, 'Location Status', '', '1', '', 'location_status', 0, 1, 'location', 0),
(81, 448, 'Location Title', '', '1', '', 'location_title', 0, 1, 'location', 0),
(80, 448, 'Location Delete Category', '', '0', '', 'location_delete_category', 0, 1, 'location', 0),
(79, 448, 'Location Edit Category', '', '1', '', 'location_edit_category', 0, 1, 'location', 0),
(78, 299, 'Admin Users List Number', '', '10', '', 'admin_users_list_number', 0, 1, 'users', 0),
(77, 299, 'Users Group', '', '1', '', 'users_group', 0, 1, 'users', 0),
(76, 299, 'Users Gender', '', '1', '', 'users_gender', 0, 1, 'users', 0),
(75, 299, 'Users Phone', '', '0', 'text', 'users_phone', 0, 1, 'users', 0),
(74, 299, 'Users FullName', '', '0', 'text', 'users_fullName', 0, 1, 'users', 0),
(73, 299, 'Users Status', '', '1', '', 'users_status', 0, 1, 'users', 0),
(72, 299, 'Users Email', '', '1', '', 'users_email', 0, 1, 'users', 0),
(71, 299, 'Users Adress', '', '0', 'text', 'users_adress', 0, 1, 'users', 0),
(70, 299, 'Users Password', '', '1', '', 'users_password', 0, 1, 'users', 0),
(69, 299, 'Users Name', '', '1', '', 'users_name', 0, 1, 'users', 0),
(68, 0, 'Use Cache Skin Wrapper', '', '1', '', 'use_cache_skin_wrapper', 1, 2, 'global', 0),
(67, 249, 'Settings Cate Show Seo', '', '0', '', 'settings_cate_show_seo', 0, 1, 'settings', 0),
(66, 249, 'Settings Special ', '', '0', '', 'settings_special_', 0, 1, 'settings', 0),
(65, 249, 'Settings Hotel Display', '', '0', '', 'settings_hotel_display', 0, 1, 'settings', 0),
(64, 249, 'Settings Alias', '', '0', '', 'settings_alias', 0, 1, 'settings', 0),
(63, 249, 'Settings Right', '', '0', '', 'settings_right', 0, 1, 'settings', 0),
(62, 249, 'Settings Area Home', '', '0', '', 'settings_area_home', 0, 1, 'settings', 0),
(61, 249, 'Settings Value', '', '0', '', 'settings_value', 0, 1, 'settings', 0),
(60, 249, 'Settings File', '', '0', '', 'settings_file', 0, 1, 'settings', 0),
(59, 249, 'Settings Index', '', '1', '', 'settings_index', 0, 1, 'settings', 0),
(58, 249, 'Settings DropDown', '', '0', '', 'settings_dropDown', 0, 1, 'settings', 0),
(57, 249, 'Settings Intro', '', '0', '', 'settings_intro', 0, 1, 'settings', 0),
(56, 249, 'Settings Status', '', '1', '', 'settings_status', 0, 1, 'settings', 0),
(55, 249, 'Settings Title', '', '1', '', 'settings_title', 0, 1, 'settings', 0),
(4, 0, 'Cache for menus', 'Enable this for better performance. But everytime you add new menu for user, you have to build cache again.', 'Yes', 'radio', 'public_menu_cache', 1, 1, 'global', 0),
(3, 0, 'System Email', 'Example: admin@vietsol.net', 'info@icmapux.com', 'text', 'global_systememail', 0, 0, 'global', 0),
(1, 0, 'Website name', 'Example: Viet Solution', 'Viet Solution', 'text', 'global_websitename', 0, 0, 'global', 0),
(2, 0, 'Website address', 'Example: www.vietsol.net', 'www.vietsol.net', 'text', 'global_websiteaddress', 0, 0, 'global', 0),
(99, 299, 'Users Gender', '', '1', '', 'users_gender', 1, 1, 'users', 0),
(100, 299, 'Users Group', '', '1', '', 'users_group', 0, 1, 'users', 0),
(101, 299, 'Admin Users List Number', '', '10', '', 'admin_users_list_number', 0, 1, 'users', 0),
(102, 250, 'Search Book Quality', '', '5', '', 'search_book_quality', 0, 2, 'textbooks', 0),
(103, 981, 'Inbox Quality', '', '10', '', 'inbox_quality', 0, 2, 'message', 0),
(104, 491, 'Draft Quality', '', '10', '', 'draft_quality', 0, 2, 'message', 0),
(105, 250, 'User Book Quality', '', '5', '', 'user_book_quality', 0, 2, 'textbooks', 0),
(106, 250, 'New Book Quality', '', '3', '', 'new_book_quality', 0, 2, 'textbooks', 0),
(107, 250, 'Best Sell Book Quality', '', '3', '', 'best_sell_book_quality', 0, 2, 'textbooks', 0),
(108, 987, 'Admin Pages List Number', '', '10', '', 'admin_pages_list_number', 0, 1, 'pages', 0),
(109, 987, 'Pages AddPage Button', '', '1', '', 'pages_addPage_button', 0, 1, 'pages', 0),
(110, 987, 'Pages DeletePage Button', '', '1', '', 'pages_deletePage_button', 0, 1, 'pages', 0),
(111, 987, 'Pages HidePage Button', '', '1', '', 'pages_hidePage_button', 0, 1, 'pages', 0),
(112, 987, 'Pages DisplayPage Button', '', '1', '', 'pages_displayPage_button', 0, 1, 'pages', 0),
(113, 987, 'Pages Virtual Show ', '', '0', '', 'pages_virtual_show_', 0, 1, 'pages', 0),
(114, 987, 'Pages Intro Editor', '', '0', '', 'pages_intro_editor', 0, 1, 'pages', 0),
(115, 987, 'Pages Title', '', '1', '', 'pages_title', 0, 1, 'pages', 0),
(116, 987, 'Pages Image', '', '1', '', 'pages_image', 0, 1, 'pages', 0),
(117, 987, 'Pages Code', '', '1', '', 'pages_code', 0, 1, 'pages', 0),
(118, 987, 'Pages Advance', '', '0', '', 'pages_advance', 0, 1, 'pages', 0),
(119, 987, 'Pages Address Google', '', '1', '', 'pages_address_google', 0, 1, 'pages', 0),
(120, 987, 'Pages Intro', '', '1', '', 'pages_intro', 0, 1, 'pages', 0),
(121, 987, 'Pages Content', '', '1', '', 'pages_content', 0, 1, 'pages', 0),
(122, 0, 'Global System Message Name', '', 'system', '', 'global_system_message_name', 1, 2, 'global', 0),
(127, 250, 'New Book Quality', '', '3', '', 'new_book_quality', 0, 2, 'textbooks', 0),
(128, 250, 'Best Sell Book Quality', '', '3', '', 'best_sell_book_quality', 0, 2, 'textbooks', 0),
(129, 259, 'Replace Details Alias After Process', '', '0', '', 'replace_details_alias_after_process', 1, 2, 'urlalias', 0),
(130, 250, 'Textbook List Number', '', '10', '', 'textbook_list_number', 0, 1, 'textbooks', 0),
(131, 250, 'Textbook Verify List Number', '', '10', '', 'textbook_verify_list_number', 0, 1, 'textbooks', 0),
(132, 299, 'Login Attempt', '', '5', '', 'login_attempt', 0, 2, 'users', 0),
(133, 299, 'Login Exceed Period', '', '10', '', 'login_exceed_period', 0, 2, 'users', 0),
(134, 0, 'Recaptcha Public Key', '', '6LcvfsMSAAAAACmDwqMWQbK-tQ766sdY2MW2m2lI', '', 'recaptcha_public_key', 1, 2, 'global', 0),
(135, 0, 'Recaptcha Private Key', '', '6LcvfsMSAAAAAFVsqsZaH2iZvMHegG1co4yBe4yU ', '', 'recaptcha_private_key', 1, 2, 'global', 0),
(136, 0, 'Global System Message Alias', '', 'system@icampux.com', '', 'global_system_message_alias', 1, 2, 'global', 0),
(137, 250, 'More Book Quality', '', '5', '', 'more_book_quality', 0, 2, 'textbooks', 0),
(138, 250, 'Listing Textbook Quality', '', '10', 'text', 'listing_textbook_quality', 0, 2, 'textbooks', 0),
(139, 250, 'Isbn Quality', '', '10', '', 'isbn_quality', 0, 2, 'textbooks', 0),
(140, 250, 'Amazon Region', '', 'com', '', 'amazon_region', 1, 2, 'textbooks', 0),
(141, 250, 'Amazon Public Key', '', 'AKIAJZWQWIJEFMMADGOQ', '', 'amazon_public_key', 1, 2, 'textbooks', 0),
(142, 250, 'Amazon Private Key', '', 'eIIzA2B5ihBcD0lDzamI4B4kR6wftqeqbjqwrLZr', '', 'amazon_private_key', 1, 2, 'textbooks', 0),
(143, 461, 'Condition Edit Category', '', '1', '', 'condition_edit_category', 0, 1, 'condition', 0),
(144, 461, 'Condition Delete Category', '', '1', '', 'condition_delete_category', 0, 1, 'condition', 0),
(145, 461, 'Condition Title', '', '1', '', 'condition_title', 0, 1, 'condition', 0),
(146, 461, 'Condition Status', '', '1', '', 'condition_status', 0, 1, 'condition', 0),
(147, 461, 'Condition Intro', '', '0', '', 'condition_intro', 0, 1, 'condition', 0),
(148, 461, 'Condition DropDown', '', '0', '', 'condition_dropDown', 0, 1, 'condition', 0),
(149, 461, 'Condition Index', '', '1', '', 'condition_index', 0, 1, 'condition', 0),
(150, 461, 'Condition File', '', '0', '', 'condition_file', 0, 1, 'condition', 0),
(151, 461, 'Condition Value', '', '0', 'text', 'condition_value', 0, 1, 'condition', 0),
(152, 461, 'Condition Area Home', '', '0', '', 'condition_area_home', 0, 1, 'condition', 0),
(153, 461, 'Condition Right', '', '0', '', 'condition_right', 0, 1, 'condition', 0),
(154, 461, 'Condition Alias', '', '0', '', 'condition_alias', 0, 1, 'condition', 0),
(155, 461, 'Condition Hotel Display', '', '0', '', 'condition_hotel_display', 0, 1, 'condition', 0),
(156, 461, 'Condition Special ', '', '0', '', 'condition_special_', 0, 1, 'condition', 0),
(157, 461, 'Condition Cate Show Seo', '', '0', '', 'condition_cate_show_seo', 0, 1, 'condition', 0),
(158, 468, 'Type Edit Category', '', '1', '', 'type_edit_category', 0, 1, 'type', 0),
(159, 468, 'Type Delete Category', '', '1', '', 'type_delete_category', 0, 1, 'type', 0),
(160, 468, 'Type Title', '', '1', '', 'type_title', 0, 1, 'type', 0),
(161, 468, 'Type Status', '', '1', '', 'type_status', 0, 1, 'type', 0),
(162, 468, 'Type Intro', '', '0', '', 'type_intro', 0, 1, 'type', 0),
(163, 468, 'Type DropDown', '', '0', '', 'type_dropDown', 0, 1, 'type', 0),
(164, 468, 'Type Index', '', '1', '', 'type_index', 0, 1, 'type', 0),
(165, 468, 'Type File', '', '0', '', 'type_file', 0, 1, 'type', 0),
(166, 468, 'Type Value', '', '1', 'text', 'type_value', 0, 1, 'type', 0),
(167, 468, 'Type Area Home', '', '0', '', 'type_area_home', 0, 1, 'type', 0),
(168, 468, 'Type Right', '', '0', '', 'type_right', 0, 1, 'type', 0),
(169, 468, 'Type Alias', '', '0', '', 'type_alias', 0, 1, 'type', 0),
(170, 468, 'Type Hotel Display', '', '0', '', 'type_hotel_display', 0, 1, 'type', 0),
(171, 468, 'Type Special ', '', '0', '', 'type_special_', 0, 1, 'type', 0),
(172, 468, 'Type Cate Show Seo', '', '0', '', 'type_cate_show_seo', 0, 1, 'type', 0),
(173, 991, 'Admin Index', '', '0', '', 'admin_index', 0, 1, 'admins', 0),
(174, 991, 'Admin Admins List Number', '', '10', '', 'admin_admins_list_number', 0, 1, 'admins', 0),
(175, 992, 'Search Friend Quality', '', '5', '', 'search_friend_quality', 0, 2, 'friends', 0),
(176, 250, 'Subject Book Quality', '', '5', '', 'subject_book_quality', 0, 2, 'textbooks', 0),
(177, 0, 'System Noimage Img Path', '', 'styles/images/noimage.jpg', 'text', 'system_noimage_img_path', 1, 0, 'global', 0),
(178, 250, 'Textbooks Edit Category', '', '1', '', 'textbooks_edit_category', 0, 1, 'textbooks', 0),
(179, 250, 'Textbooks Delete Category', '', '1', '', 'textbooks_delete_category', 0, 1, 'textbooks', 0),
(180, 250, 'Textbooks Title', '', '1', '', 'textbooks_title', 0, 1, 'textbooks', 0),
(181, 250, 'Textbooks Status', '', '1', '', 'textbooks_status', 0, 1, 'textbooks', 0),
(182, 250, 'Textbooks Intro', '', '0', '', 'textbooks_intro', 0, 1, 'textbooks', 0),
(183, 250, 'Textbooks DropDown', '', '0', '', 'textbooks_dropDown', 0, 1, 'textbooks', 0),
(184, 250, 'Textbooks Index', '', '1', '', 'textbooks_index', 0, 1, 'textbooks', 0),
(185, 250, 'Textbooks File', '', '0', '', 'textbooks_file', 0, 1, 'textbooks', 0),
(186, 250, 'Textbooks Value', '', '0', '', 'textbooks_value', 0, 1, 'textbooks', 0),
(187, 250, 'Textbooks Area Home', '', '0', '', 'textbooks_area_home', 0, 1, 'textbooks', 0),
(188, 250, 'Textbooks Right', '', '0', '', 'textbooks_right', 0, 1, 'textbooks', 0),
(189, 250, 'Textbooks Alias', '', '0', '', 'textbooks_alias', 0, 1, 'textbooks', 0),
(190, 250, 'Textbooks Hotel Display', '', '0', '', 'textbooks_hotel_display', 0, 1, 'textbooks', 0),
(191, 250, 'Textbooks Special ', '', '0', '', 'textbooks_special_', 0, 1, 'textbooks', 0),
(192, 250, 'Textbooks Cate Show Seo', '', '0', '', 'textbooks_cate_show_seo', 0, 1, 'textbooks', 0),
(193, 299, 'Users Group Tab', '', '1', '', 'users_Group_tab', 1, 1, 'users', 0),
(194, 299, 'Users Setting Tab', '', '1', '', 'users_setting_tab', 1, 1, 'users', 0),
(195, 299, 'Users Location Tab', '', '1', '', 'users_location_tab', 1, 1, 'users', 0),
(196, 994, 'Ccategory Edit Category', '', '1', '', 'ccategory_edit_category', 0, 1, 'ccategory', 0),
(197, 994, 'Ccategory Delete Category', '', '1', '', 'ccategory_delete_category', 0, 1, 'ccategory', 0),
(198, 994, 'Ccategory Title', '', '1', '', 'ccategory_title', 0, 1, 'ccategory', 0),
(199, 994, 'Ccategory Status', '', '1', '', 'ccategory_status', 0, 1, 'ccategory', 0),
(200, 994, 'Ccategory Intro', '', '0', '', 'ccategory_intro', 0, 1, 'ccategory', 0),
(201, 994, 'Ccategory DropDown', '', '0', '', 'ccategory_dropDown', 0, 1, 'ccategory', 0),
(202, 994, 'Ccategory Index', '', '1', '', 'ccategory_index', 0, 1, 'ccategory', 0),
(203, 994, 'Ccategory File', '', '0', '', 'ccategory_file', 0, 1, 'ccategory', 0),
(204, 994, 'Ccategory Value', '', '1', 'text', 'ccategory_value', 0, 1, 'ccategory', 0),
(205, 994, 'Ccategory Area Home', '', '0', '', 'ccategory_area_home', 0, 1, 'ccategory', 0),
(206, 994, 'Ccategory Right', '', '0', '', 'ccategory_right', 0, 1, 'ccategory', 0),
(207, 994, 'Ccategory Alias', '', '0', '', 'ccategory_alias', 0, 1, 'ccategory', 0),
(208, 994, 'Ccategory Hotel Display', '', '0', '', 'ccategory_hotel_display', 0, 1, 'ccategory', 0),
(209, 994, 'Ccategory Special ', '', '0', '', 'ccategory_special_', 0, 1, 'ccategory', 0),
(210, 994, 'Ccategory Cate Show Seo', '', '0', '', 'ccategory_cate_show_seo', 0, 1, 'ccategory', 0),
(211, 1000, 'Ccondition Edit Category', '', '1', '', 'ccondition_edit_category', 0, 1, 'ccondition', 0),
(212, 1000, 'Ccondition Delete Category', '', '1', '', 'ccondition_delete_category', 0, 1, 'ccondition', 0),
(213, 1000, 'Ccondition Title', '', '1', '', 'ccondition_title', 0, 1, 'ccondition', 0),
(214, 1000, 'Ccondition Status', '', '1', '', 'ccondition_status', 0, 1, 'ccondition', 0),
(215, 1000, 'Ccondition Intro', '', '0', '', 'ccondition_intro', 0, 1, 'ccondition', 0),
(216, 1000, 'Ccondition DropDown', '', '0', '', 'ccondition_dropDown', 0, 1, 'ccondition', 0),
(217, 1000, 'Ccondition Index', '', '1', '', 'ccondition_index', 0, 1, 'ccondition', 0),
(218, 1000, 'Ccondition File', '', '0', '', 'ccondition_file', 0, 1, 'ccondition', 0),
(219, 1000, 'Ccondition Value', '', '1', 'text', 'ccondition_value', 0, 1, 'ccondition', 0),
(220, 1000, 'Ccondition Area Home', '', '0', '', 'ccondition_area_home', 0, 1, 'ccondition', 0),
(221, 1000, 'Ccondition Right', '', '0', '', 'ccondition_right', 0, 1, 'ccondition', 0),
(222, 1000, 'Ccondition Alias', '', '0', '', 'ccondition_alias', 0, 1, 'ccondition', 0),
(223, 1000, 'Ccondition Hotel Display', '', '0', '', 'ccondition_hotel_display', 0, 1, 'ccondition', 0),
(224, 1000, 'Ccondition Special ', '', '0', '', 'ccondition_special_', 0, 1, 'ccondition', 0),
(225, 1000, 'Ccondition Cate Show Seo', '', '0', '', 'ccondition_cate_show_seo', 0, 1, 'ccondition', 0),
(226, 1013, 'Listing Classified Quality', '', '10', '', 'listing_classified_quality', 0, 2, 'classifieds', 0),
(227, 1015, 'Listing Icmarket Quality', '', '10', '', 'listing_icmarket_quality', 0, 2, 'icmarket', 0),
(228, 0, 'Global System Message Name Icmarket', '', 'iCampux icMarket', '', 'global_system_message_name_icmarket', 1, 2, 'global', 0),
(229, 299, 'Users Relationship Tab', '', '1', '', 'users_relationship_tab', 1, 1, 'users', 0),
(230, 1017, 'Relationship Edit Category', '', '1', '', 'relationship_edit_category', 0, 1, 'relationship', 0),
(231, 1017, 'Relationship Delete Category', '', '1', '', 'relationship_delete_category', 0, 1, 'relationship', 0),
(232, 1017, 'Relationship Title', '', '1', '', 'relationship_title', 0, 1, 'relationship', 0),
(233, 1017, 'Relationship Status', '', '1', '', 'relationship_status', 0, 1, 'relationship', 0),
(234, 1017, 'Relationship Intro', '', '0', '', 'relationship_intro', 0, 1, 'relationship', 0),
(235, 1017, 'Relationship DropDown', '', '0', '', 'relationship_dropDown', 0, 1, 'relationship', 0),
(236, 1017, 'Relationship Index', '', '1', '', 'relationship_index', 0, 1, 'relationship', 0),
(237, 1017, 'Relationship File', '', '0', '', 'relationship_file', 0, 1, 'relationship', 0),
(238, 1017, 'Relationship Value', '', '0', '', 'relationship_value', 0, 1, 'relationship', 0),
(239, 1017, 'Relationship Area Home', '', '0', '', 'relationship_area_home', 0, 1, 'relationship', 0),
(240, 1017, 'Relationship Right', '', '0', '', 'relationship_right', 0, 1, 'relationship', 0),
(241, 1017, 'Relationship Alias', '', '0', '', 'relationship_alias', 0, 1, 'relationship', 0),
(242, 1017, 'Relationship Hotel Display', '', '0', '', 'relationship_hotel_display', 0, 1, 'relationship', 0),
(243, 1017, 'Relationship Special ', '', '0', '', 'relationship_special_', 0, 1, 'relationship', 0),
(244, 1017, 'Relationship Cate Show Seo', '', '0', '', 'relationship_cate_show_seo', 0, 1, 'relationship', 0),
(245, 1023, 'Pages Category Tab', '', '0', '', 'pages_category_tab', 1, 1, 'pages', 0),
(246, 1023, 'Pages Setting Tab', '', '0', '', 'pages_setting_tab', 1, 1, 'pages', 0),
(247, 1023, 'Pages Category List', '', '0', '', 'pages_category_list', 0, 1, 'pages', 0),
(248, 1023, 'Pages Add Hide Show Delete', '', '1', '', 'pages_add_hide_show_delete', 0, 1, 'pages', 0),
(249, 1023, 'Pages Home', '', '0', '', 'pages_home', 0, 1, 'pages', 0),
(250, 1023, 'Pages Option', '', '0', '', 'pages_option', 1, 1, 'pages', 0),
(251, 1023, 'Pages Image Timthumb Size', '', '(size:100x100px)', '', 'pages_image_timthumb_size', 0, 1, 'pages', 0),
(349, 1047, 'Events Code', '', '0', '', 'events_code', 0, 1, 'events', 0),
(348, 1047, 'Events Intro Editor', '', '1', '', 'events_intro_editor', 0, 1, 'events', 0),
(347, 1047, 'Events Option', '', '0', '', 'events_option', 1, 1, 'events', 0),
(346, 1047, 'Events Home', '', '0', '', 'events_home', 0, 1, 'events', 0),
(345, 1047, 'Events Add Hide Show Delete', '', '1', '', 'events_add_hide_show_delete', 0, 1, 'events', 0),
(344, 1047, 'Events List Quantity', '', '10', '', 'events_list_quantity', 0, 1, 'events', 0),
(341, 1047, 'Events Category Tab', '', '0', '', 'events_category_tab', 1, 1, 'events', 0),
(340, 259, 'Admin Urlalias List Number', '', '10', '', 'admin_urlalias_list_number', 0, 1, 'urlalias', 0),
(265, 1027, 'Helpcenter Category Tab', '', '0', '', 'helpcenter_category_tab', 1, 1, 'helpcenter', 0),
(266, 1027, 'Helpcenter Setting Tab', '', '0', '', 'helpcenter_setting_tab', 1, 1, 'helpcenter', 0),
(267, 1027, 'Helpcenter Category List', '', '0', '', 'helpcenter_category_list', 0, 1, 'helpcenter', 0),
(268, 1027, 'Admin Helpcenter List Number', '', '10', '', 'admin_helpcenter_list_number', 0, 1, 'helpcenter', 0),
(269, 1027, 'Helpcenter Add Hide Show Delete', '', '1', '', 'helpcenter_add_hide_show_delete', 0, 1, 'helpcenter', 0),
(270, 1027, 'Helpcenter Home', '', '0', '', 'helpcenter_home', 0, 1, 'helpcenter', 0),
(271, 1027, 'Helpcenter Option', '', '0', '', 'helpcenter_option', 1, 1, 'helpcenter', 0),
(272, 1027, 'Helpcenter Intro Editor', '', '0', 'text', 'helpcenter_intro_editor', 0, 1, 'helpcenter', 0),
(273, 1027, 'Helpcenter Code', '', '1', 'text', 'helpcenter_code', 0, 1, 'helpcenter', 0),
(274, 1027, 'Helpcenter Image', '', '0', 'text', 'helpcenter_image', 0, 1, 'helpcenter', 0),
(275, 1027, 'Helpcenter Image Timthumb Size', '', '(size:100x100px)', '', 'helpcenter_image_timthumb_size', 0, 1, 'helpcenter', 0),
(276, 1027, 'Helpcenter Intro', '', '0', 'text', 'helpcenter_intro', 0, 1, 'helpcenter', 0),
(277, 1027, 'Helpcenter Content', '', '1', '', 'helpcenter_content', 0, 1, 'helpcenter', 0),
(343, 1047, 'Events Category List', '', '0', '', 'events_category_list', 0, 1, 'events', 0),
(342, 1047, 'Events Setting Tab', '', '0', '', 'events_setting_tab', 1, 1, 'events', 0),
(278, 1029, 'About Category Tab', '', '0', '', 'about_category_tab', 1, 1, 'about', 0),
(279, 1029, 'About Setting Tab', '', '0', '', 'about_setting_tab', 1, 1, 'about', 0),
(280, 1029, 'About Category List', '', '0', '', 'about_category_list', 0, 1, 'about', 0),
(281, 1029, 'Admin About List Number', '', '10', '', 'admin_about_list_number', 0, 1, 'about', 0),
(282, 1029, 'About Add Hide Show Delete', '', '1', '', 'about_add_hide_show_delete', 0, 1, 'about', 0),
(283, 1029, 'About Home', '', '0', '', 'about_home', 0, 1, 'about', 0),
(284, 1029, 'About Option', '', '0', '', 'about_option', 1, 1, 'about', 0),
(285, 1029, 'About Intro Editor', '', '0', 'text', 'about_intro_editor', 0, 1, 'about', 0),
(286, 1029, 'About Code', '', '1', 'text', 'about_code', 0, 1, 'about', 0),
(287, 1029, 'About Image', '', '0', 'text', 'about_image', 0, 1, 'about', 0),
(288, 1029, 'About Image Timthumb Size', '', '(size:100x100px)', '', 'about_image_timthumb_size', 0, 1, 'about', 0),
(289, 1029, 'About Intro', '', '0', 'text', 'about_intro', 0, 1, 'about', 0),
(290, 1029, 'About Content', '', '1', '', 'about_content', 0, 1, 'about', 0),
(291, 1039, 'Contact Form Name', '', '1', '', 'contact_form_name', 1, 2, 'contacts', 0),
(292, 1039, 'Contact Form Email', '', '1', '', 'contact_form_email', 1, 2, 'contacts', 0),
(293, 1039, 'Contact Form Title', '', '1', '', 'contact_form_title', 1, 2, 'contacts', 0),
(294, 0, 'Feedback Email', '', 'feedback@icampux.com', '', 'feedback email', 0, 2, 'global', 0),
(295, 0, 'Support Email', '', 'support@icampux.com', '', 'support email', 0, 2, 'global', 0),
(296, 0, 'Bussiness Development Email', '', 'bizdev@icampux.com', '', 'bussiness development email', 0, 2, 'global', 0),
(297, 0, 'Abuse Email', '', 'abuse@icampux.com', '', 'abuse email', 0, 2, 'global', 0),
(298, 0, 'Support Email', '', 'support@icampux.com', '', 'support_email', 0, 2, 'global', 0),
(299, 0, 'Bussiness Development Email', '', 'bizdev@icampux.com', '', 'bussiness_development email', 0, 2, 'global', 0),
(300, 0, 'Abuse Email', '', 'abuse@icampux.com', '', 'abuse_email', 0, 2, 'global', 0),
(301, 1041, 'Articles Category Tab', '', '0', '', 'articles_category_tab', 1, 1, 'articles', 0),
(302, 1041, 'Articles Setting Tab', '', '0', '', 'articles_setting_tab', 1, 1, 'articles', 0),
(303, 1041, 'Articles Category List', '', '0', '', 'articles_category_list', 0, 1, 'articles', 0),
(304, 1041, 'Admin Articles List Number', '', '10', '', 'admin_articles_list_number', 0, 1, 'articles', 0),
(305, 1041, 'Articles Add Hide Show Delete', '', '1', '', 'articles_add_hide_show_delete', 0, 1, 'articles', 0),
(306, 1041, 'Articles Home', '', '0', '', 'articles_home', 0, 1, 'articles', 0),
(307, 1041, 'Articles Option', '', '0', '', 'articles_option', 1, 1, 'articles', 0),
(308, 1041, 'Articles Intro Editor', '', '1', '', 'articles_intro_editor', 0, 1, 'articles', 0),
(309, 1041, 'Articles Code', '', '0', '', 'articles_code', 0, 1, 'articles', 0),
(310, 1041, 'Articles Image', '', '1', '', 'articles_image', 0, 1, 'articles', 0),
(311, 1041, 'Articles Image Timthumb Size', '', '(size:100x100px)', '', 'articles_image_timthumb_size', 0, 1, 'articles', 0),
(312, 1041, 'Articles Intro', '', '1', '', 'articles_intro', 0, 1, 'articles', 0),
(313, 1041, 'Articles Content', '', '1', '', 'articles_content', 0, 1, 'articles', 0),
(314, 1041, 'Articles List Quantity', '', '10', '', 'articles_list_quantity', 0, 1, 'articles', 0),
(315, 1043, 'News Category Tab', '', '0', '', 'news_category_tab', 1, 1, 'news', 0),
(316, 1043, 'News Setting Tab', '', '0', '', 'news_setting_tab', 1, 1, 'news', 0),
(317, 1043, 'News Category List', '', '0', '', 'news_category_list', 0, 1, 'news', 0),
(318, 1043, 'News List Quantity', '', '10', '', 'news_list_quantity', 0, 1, 'news', 0),
(319, 1043, 'News Add Hide Show Delete', '', '1', '', 'news_add_hide_show_delete', 0, 1, 'news', 0),
(320, 1043, 'News Home', '', '0', '', 'news_home', 0, 1, 'news', 0),
(321, 1043, 'News Option', '', '0', '', 'news_option', 1, 1, 'news', 0),
(322, 1043, 'News Intro Editor', '', '1', '', 'news_intro_editor', 0, 1, 'news', 0),
(323, 1043, 'News Code', '', '0', '', 'news_code', 0, 1, 'news', 0),
(324, 1043, 'News Image', '', '1', '', 'news_image', 0, 1, 'news', 0),
(325, 1043, 'News Intro', '', '1', '', 'news_intro', 0, 1, 'news', 0),
(326, 1043, 'News Content', '', '1', '', 'news_content', 0, 1, 'news', 0),
(327, 1045, 'Agreement Category Tab', '', '0', '', 'agreement_category_tab', 1, 1, 'agreement', 0),
(328, 1045, 'Agreement Setting Tab', '', '0', '', 'agreement_setting_tab', 1, 1, 'agreement', 0),
(329, 1045, 'Agreement Category List', '', '0', '', 'agreement_category_list', 0, 1, 'agreement', 0),
(330, 1045, 'Admin Agreement List Number', '', '10', '', 'admin_agreement_list_number', 0, 1, 'agreement', 0),
(331, 1045, 'Agreement Add Hide Show Delete', '', '1', '', 'agreement_add_hide_show_delete', 0, 1, 'agreement', 0),
(332, 1045, 'Agreement Home', '', '0', '', 'agreement_home', 0, 1, 'agreement', 0),
(333, 1045, 'Agreement Option', '', '0', '', 'agreement_option', 1, 1, 'agreement', 0),
(334, 1045, 'Agreement Intro Editor', '', '0', 'text', 'agreement_intro_editor', 0, 1, 'agreement', 0),
(335, 1045, 'Agreement Code', '', '1', 'text', 'agreement_code', 0, 1, 'agreement', 0),
(336, 1045, 'Agreement Image', '', '0', 'text', 'agreement_image', 0, 1, 'agreement', 0),
(337, 1045, 'Agreement Image Timthumb Size', '', '(size:100x100px)', '', 'agreement_image_timthumb_size', 0, 1, 'agreement', 0),
(338, 1045, 'Agreement Intro', '', '0', 'text', 'agreement_intro', 0, 1, 'agreement', 0),
(339, 1045, 'Agreement Content', '', '1', '', 'agreement_content', 0, 1, 'agreement', 0),
(350, 1047, 'Events Image', '', '1', '', 'events_image', 0, 1, 'events', 0),
(351, 1047, 'Events Intro', '', '1', '', 'events_intro', 0, 1, 'events', 0),
(352, 1047, 'Events Content', '', '1', '', 'events_content', 0, 1, 'events', 0),
(353, 1048, 'Partners Category Tab', '', '1', '', 'partners_category_tab', 0, 1, 'partners', 0),
(354, 1048, 'Partners Setting Tab', '', '1', '', 'partners_setting_tab', 0, 1, 'partners', 0),
(355, 1048, 'Admin Partners List Number', '', '10', '', 'admin_partners_list_number', 0, 1, 'partners', 0),
(356, 1048, 'Partners Category Tab', '', '1', '', 'partners_Category_tab', 0, 1, 'partners', 0),
(357, 1048, 'Partners Title', '', '1', '', 'partners_title', 0, 1, 'partners', 0),
(358, 1048, 'Partners Adress', '', '1', '', 'partners_adress', 0, 1, 'partners', 0),
(359, 1048, 'Partners Website', '', '1', '', 'partners_website', 0, 1, 'partners', 0),
(360, 1048, 'Partners Status', '', '1', '', 'partners_status', 0, 1, 'partners', 0),
(361, 1048, 'Partners Exptime', '', '1', '', 'partners_exptime', 0, 1, 'partners', 0),
(362, 1048, 'Partners Index', '', '1', '', 'partners_index', 0, 1, 'partners', 0),
(363, 1048, 'Partners Price', '', '1', '', 'partners_price', 0, 1, 'partners', 0),
(364, 1048, 'Partners Image', '', '1', '', 'partners_image', 0, 1, 'partners', 0),
(365, 1048, 'Partners Position', '', '1', '', 'partners_position', 0, 1, 'partners', 0),
(366, 1048, 'Partners AdvanceDisplay', '', '1', '', 'partners_advanceDisplay', 0, 1, 'partners', 0),
(367, 1048, 'Partners Intro', '', '1', '', 'partners_intro', 0, 1, 'partners', 0),
(368, 1048, 'Partners Content', '', '1', '', 'partners_content', 0, 1, 'partners', 0),
(369, 1047, 'Events Time', '', '1', '', 'events_time', 0, 1, 'events', 0),
(370, 1043, 'News Time', '', '1', '', 'news_time', 0, 1, 'news', 0),
(371, 1043, 'News User Item Quality', '', '10', '', 'news_user_item_quality', 0, 2, 'news', 0),
(372, 1047, 'Events User Item Quality', '', '10', '', 'events_user_item_quality', 0, 2, 'events', 0),
(373, 1041, 'Articles Time', '', '1', '', 'articles_time', 0, 1, 'articles', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_skin`
--

CREATE TABLE IF NOT EXISTS `vsf_skin` (
  `skinId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `skinTitle` varchar(255) NOT NULL,
  `skinIsAdmin` smallint(1) NOT NULL,
  `skinStatus` smallint(1) NOT NULL,
  `skinAuthorName` varchar(255) NOT NULL,
  `skinDefault` varchar(255) NOT NULL,
  `skinFolder` varchar(155) NOT NULL,
  `skinAuthorEmail` varchar(255) NOT NULL,
  `skinAuthorWebsite` varchar(255) NOT NULL,
  PRIMARY KEY (`skinId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_skin`
--

INSERT INTO `vsf_skin` (`skinId`, `skinTitle`, `skinIsAdmin`, `skinStatus`, `skinAuthorName`, `skinDefault`, `skinFolder`, `skinAuthorEmail`, `skinAuthorWebsite`) VALUES
(1, 'VS Default', 0, 1, 'designer', '1', 'finance', 'info@vietsol.net', 'http://www.vietsol.net'),
(2, 'VS lightgray', 1, 0, 'designer', '1', 'blue', 'info@vietsol.net', 'http://www.vietsol.net');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_status_blacklist`
--

CREATE TABLE IF NOT EXISTS `vsf_status_blacklist` (
  `statusId` int(10) NOT NULL,
  `statusUser` int(10) NOT NULL,
  `statusLevel` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`statusId`,`statusUser`),
  KEY `statusUser` (`statusUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vsf_status_comment`
--

CREATE TABLE IF NOT EXISTS `vsf_status_comment` (
  `commentId` int(10) NOT NULL AUTO_INCREMENT,
  `commentUser` int(10) NOT NULL,
  `commentContent` varchar(2048) NOT NULL,
  `commentOriginal` int(10) NOT NULL DEFAULT '0',
  `commentGroup` int(10) NOT NULL,
  `commentLevel` tinyint(4) NOT NULL DEFAULT '0',
  `commentType` tinyint(4) NOT NULL DEFAULT '0',
  `commentTime` int(10) NOT NULL,
  `commentReply` int(4) NOT NULL DEFAULT '0',
  `commentProfile` int(10) NOT NULL DEFAULT '0',
  `commentLastUpdate` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`commentId`),
  KEY `commentUser` (`commentUser`,`commentOriginal`,`commentGroup`),
  KEY `commentUser_2` (`commentUser`,`commentOriginal`,`commentGroup`,`commentLevel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `vsf_status_comment`
--

INSERT INTO `vsf_status_comment` (`commentId`, `commentUser`, `commentContent`, `commentOriginal`, `commentGroup`, `commentLevel`, `commentType`, `commentTime`, `commentReply`, `commentProfile`, `commentLastUpdate`) VALUES
(26, 32, 'minhhai post yyh', 0, 26, 0, 0, 1311082701, 0, 28, 0),
(27, 28, 'fdsfsf', 0, 27, 0, 0, 1311150443, 1, 28, 1311150504),
(28, 28, 'fasffd', 27, 27, 1, 0, 1311150477, 1, 28, 1311150490),
(30, 28, 'abc<br />123', 0, 30, 0, 0, 1311151221, 0, 28, 1311151935),
(29, 28, 'ffaff', 28, 27, 2, 0, 1311150481, 0, 28, 0),
(31, 28, 'sfadfa', 0, 31, 0, 0, 1311237621, 2, 28, 0),
(33, 33, 'hongdao test nÃ¨', 0, 33, 0, 0, 1313720327, 11, 33, 0),
(60, 27, 'khoa post on yyh', 0, 60, 0, 0, 1314157503, 0, 28, 0),
(59, 7, 'dd post on yyh', 0, 59, 0, 0, 1314156883, 0, 28, 0),
(57, 32, 'minhhai comment', 55, 31, 2, 0, 1314153131, 0, 28, 0),
(55, 33, 'hongdao comment', 31, 31, 1, 0, 1314153089, 1, 28, 0),
(42, 27, 'khoa post', 33, 33, 1, 0, 1313722846, 1, 33, 0),
(56, 32, 'minhhai comment', 31, 31, 1, 0, 1314153123, 0, 28, 0),
(47, 33, 'aaaa', 42, 33, 2, 0, 1313723906, 0, 33, 0),
(58, 28, 'yyh tao post', 0, 58, 0, 0, 1314153594, 0, 28, 0),
(61, 28, 'abc', 0, 61, 0, 0, 1323696986, 2, 28, 0),
(62, 28, 'bbbb', 61, 61, 1, 0, 1323696993, 1, 28, 0),
(63, 28, 'aaaa', 62, 61, 2, 0, 1323696997, 0, 28, 0),
(64, 28, 'fdsfafds', 61, 61, 1, 0, 1323697000, 1, 28, 0),
(65, 28, 'fsdfasfsd', 64, 61, 2, 0, 1323697005, 0, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_status_whitelist`
--

CREATE TABLE IF NOT EXISTS `vsf_status_whitelist` (
  `statusId` int(10) NOT NULL AUTO_INCREMENT,
  `statusRecipient` int(11) NOT NULL,
  PRIMARY KEY (`statusId`,`statusRecipient`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vsf_status_whitelist`
--

INSERT INTO `vsf_status_whitelist` (`statusId`, `statusRecipient`) VALUES
(9, 32),
(9, 34);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_support`
--

CREATE TABLE IF NOT EXISTS `vsf_support` (
  `supportId` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `supportCatId` smallint(4) NOT NULL DEFAULT '0',
  `supportType` smallint(4) NOT NULL DEFAULT '0',
  `supportIndex` smallint(4) NOT NULL DEFAULT '0',
  `supportNick` varchar(564) NOT NULL DEFAULT '',
  `supportImageOffline` varchar(100) NOT NULL DEFAULT '',
  `supportImageOnline` varchar(100) NOT NULL DEFAULT '',
  `supportStatus` tinyint(1) NOT NULL DEFAULT '0',
  `supportProfile` varchar(700) NOT NULL DEFAULT '',
  `supportAvatar` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`supportId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vsf_support`
--

INSERT INTO `vsf_support` (`supportId`, `supportCatId`, `supportType`, `supportIndex`, `supportNick`, `supportImageOffline`, `supportImageOnline`, `supportStatus`, `supportProfile`, `supportAvatar`) VALUES
(1, 66, 2, 0, 'hvduc_86vn', '31', '24', 1, 'a:1:{s:12:"supportIntro";s:0:"";}', '68');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_textbook`
--

CREATE TABLE IF NOT EXISTS `vsf_textbook` (
  `bookId` int(10) NOT NULL AUTO_INCREMENT,
  `bookISBN` varchar(13) NOT NULL,
  `bookISBN10` varchar(10) NOT NULL,
  `bookTitle` varchar(256) NOT NULL,
  `bookAuthor` varchar(256) NOT NULL,
  `bookEdition` varchar(16) NOT NULL,
  `bookPage` int(5) NOT NULL,
  `bookPublisher` varchar(128) NOT NULL,
  `bookRelease` varchar(16) NOT NULL,
  `bookImage` int(10) NOT NULL,
  `bookFormat` text,
  `bookLanguage` varchar(32) DEFAULT NULL,
  `bookStatus` tinyint(1) NOT NULL,
  `bookStar` decimal(5,2) NOT NULL,
  `bookRateValue` int(10) NOT NULL DEFAULT '0',
  `bookRate` mediumint(10) NOT NULL,
  `bookDimension` tinytext NOT NULL,
  `bookDimensionUnit` varchar(1024) NOT NULL,
  `bookWeight` decimal(10,2) NOT NULL,
  `bookWeightUnit` varchar(64) NOT NULL,
  PRIMARY KEY (`bookId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `vsf_textbook`
--

INSERT INTO `vsf_textbook` (`bookId`, `bookISBN`, `bookISBN10`, `bookTitle`, `bookAuthor`, `bookEdition`, `bookPage`, `bookPublisher`, `bookRelease`, `bookImage`, `bookFormat`, `bookLanguage`, `bookStatus`, `bookStar`, `bookRateValue`, `bookRate`, `bookDimension`, `bookDimensionUnit`, `bookWeight`, `bookWeightUnit`) VALUES
(42, '9781935182726', '9781935182', 'Android in Action', 'Frank Ableson, Robi Sen', '2', 592, 'Manning Publications', 'Feb. 2011', 267, 'Paperback', 'English', 1, '0.00', 0, 0, '1.3 X 7.7 X 9.5', 'hundredths-inches X hundredths-inches X hundredths-inches', '2.15', 'hundredths-pounds'),
(28, '9781603862875', '1603862870', 'The Problems of Philosophy', 'Bertrand Russell', '1', 116, 'Watchmaker Publishing', 'Jan. 2010', 270, 'Paperback', 'English', 1, '0.00', 0, 0, '0.4 X 5.9 X 8.8', 'hundredths-inches X hundredths-inches X hundredths-inches', '0.40', 'hundredths-pounds'),
(29, '9780596516178', '9780596516', 'The Ruby Programming Language', 'David Flanagan, Yukihiro Matsumoto', '1', 448, 'O&#39;Reilly Media', 'Feb. 2008', 274, 'Paperback', 'English', 1, '0.00', 0, 0, '1 X 7 X 9.1', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.35', 'hundredths-pounds'),
(30, '9780321743121', '321743121', 'Ruby on Rails 3 Tutorial: Learn Rails by Example (Addison-Wesley Professional Ruby Series) ', 'Michael Hartl', '1', 576, 'Addison-Wesley Professional', 'Dec. 2010', 275, 'Paperback', 'English', 1, '0.00', 0, 0, '', '', '0.00', ''),
(31, '978193435608', '9781934356', 'Programming Ruby 1.9: The Pragmatic Programmers&#39; Guide (Facets of Ruby)', 'Dave Thomas, Chad Fowler, Andy Hunt', '3rd', 1000, 'Pragmatic Bookshelf', 'Apr. 2009', 276, 'Paperback', 'English', 1, '0.00', 0, 0, '1.7 X 7.5 X 9.2', 'hundredths-inches X hundredths-inches X hundredths-inches', '2.40', 'hundredths-pounds'),
(33, '9780321584106', '321584104', 'Ruby on Rails 3 Tutorial: Learn Rails by Example', 'Michael Hartl', '', 0, '', '', 278, '', '', 1, '0.00', 0, 0, '', '', '0.00', ''),
(34, '9780596158064', '596158068', 'Learning Python: Powerful Object-Oriented Programming', 'Mark Lutz', '4th', 1216, 'O&#39;Reilly Media', 'Oct. 2009', 280, 'Paperback', 'English', 1, '0.00', 0, 0, '1.9 X 7.4 X 9.8', 'hundredths-inches X hundredths-inches X hundredths-inches', '3.40', 'hundredths-pounds'),
(35, '9780596518868', '596518862', 'The Art of SEO: Mastering Search Engine Optimization (Theory in Practice)', 'Eric Enge, Stephan Spencer, Rand Fishkin, Jessie Stricchiola', '1', 608, 'O&#39;Reilly Media', 'Oct. 2009', 295, 'Paperback', 'English', 1, '0.00', 0, 0, '1.42 X 7.01 X 9.13', 'hundredths-inches X hundredths-inches X hundredths-inches', '2.16', 'hundredths-pounds'),
(36, '9781452849904', '1452849900', 'Ranking Number One: 50 Essential SEO Tips To Boost Your Search Engine Results', 'James Beswick', '1', 162, 'CreateSpace', 'Jun. 2010', 297, 'Paperback', 'English', 1, '3.00', 0, 1, '0.37 X 8.25 X 8.25', 'hundredths-inches X hundredths-inches X hundredths-inches', '0.75', 'hundredths-pounds'),
(37, '9780470554180', '470554185', 'Search Engine Optimization (SEO) Secrets', 'Danny Dover, Erik Dafforn', '1', 456, 'Wiley', 'Mar. 2011', 298, 'Paperback', 'English', 1, '3.05', 64, 21, '1.02 X 7.32 X 9.21', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.72', 'hundredths-pounds'),
(40, '9780470620755', '470620757', 'Search Engine Optimization: Your visual blueprint for effective Internet marketing', 'Kristopher B. Jones', '2', 336, 'Visual', 'Aug. 2010', 337, 'Paperback', 'English', 1, '4.07', 61, 15, '0.9 X 7.4 X 9', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.45', 'hundredths-pounds'),
(41, '9780470902592', '470902590', 'Search Engine Optimization (SEO): An Hour a Day', 'Jennifer Grappone, Gradiva Couzin', '3', 432, 'Sybex', 'Jan. 2011', 339, 'Paperback', 'English', 1, '0.00', 0, 0, '1.2 X 7.3 X 9', 'hundredths-inches X hundredths-inches X hundredths-inches', '0.90', 'hundredths-pounds'),
(43, '9781590282410', '1590282418', 'Python Programming: An Introduction to Computer Science', 'John Zelle', '2', 528, 'Franklin, Beedle &amp; Associates Inc.', '', 493, '', '', 1, '0.00', 0, 0, '', '', '0.00', ''),
(44, '9781430223634', '1430223634', 'Beginning Ruby: From Novice to Professional', 'Peter Cooper', '2', 656, 'Apress', 'Jul. 2009', 494, 'Paperback', 'English', 1, '0.00', 0, 0, '1.3 X 7 X 9.2', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.95', 'hundredths-pounds'),
(45, '9781934356470', '1934356476', 'Metaprogramming Ruby: Program Like the Ruby Pros', 'Paolo Perrotta', '1', 240, 'Pragmatic Bookshelf', 'Feb. 2010', 495, 'Paperback', 'English', 1, '0.00', 0, 0, '1 X 7.4 X 8.8', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.30', 'hundredths-pounds'),
(46, '9781847195500', '1847195504', 'ASP.NET 3.5 Application Architecture and Design', 'Vivek Thakur', '1', 260, 'Packt Publishing', 'Oct. 2008', 496, 'Paperback', 'English', 1, '0.00', 0, 0, '0.87 X 7.48 X 9.06', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.28', 'hundredths-pounds'),
(47, '9781935182375', '1935182374', 'Silverlight 4 in Action', 'Pete Brown', 'Revised', 800, 'Manning Publications', 'Oct. 2010', 497, 'Paperback', 'English', 1, '0.00', 0, 0, '1.7 X 7.4 X 9.1', 'hundredths-inches X hundredths-inches X hundredths-inches', '2.90', 'hundredths-pounds'),
(48, '978067233336', '672333368', 'Silverlight 4 Unleashed', 'Laurent Bugnion', '1', 736, 'Sams', 'Oct. 2010', 499, 'Paperback', 'English', 1, '0.00', 0, 0, '1.5 X 6.9 X 9', 'hundredths-inches X hundredths-inches X hundredths-inches', '3.05', 'hundredths-pounds'),
(49, '9780672331077', '672331071', 'Microsoft Expression Blend 4 Unleashed', 'Brennon Williams', '1', 384, 'Sams', 'Apr. 2011', 500, 'Paperback', 'English', 1, '0.00', 0, 0, '0.8 X 6.9 X 9', 'hundredths-inches X hundredths-inches X hundredths-inches', '1.60', 'hundredths-pounds'),
(50, '9780672331190', '672331195', 'WPF 4 Unleashed', 'Adam Nathan', '1', 848, 'Sams', 'Jun. 2010', 502, 'Paperback', 'English', 1, '0.00', 0, 0, '1.9 X 7 X 9.3', 'hundredths-inches X hundredths-inches X hundredths-inches', '3.40', 'hundredths-pounds'),
(51, '1111111111111', '111111', 'ggfds', '', '', 0, '', '', 0, '', '', 0, '0.00', 0, 0, '', '', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_textbook_user`
--

CREATE TABLE IF NOT EXISTS `vsf_textbook_user` (
  `tuId` int(11) NOT NULL AUTO_INCREMENT,
  `tuUser` int(11) NOT NULL,
  `tuBook` int(11) NOT NULL,
  `tuSubject` varchar(64) DEFAULT NULL,
  `tuCampus` varchar(128) DEFAULT NULL,
  `tuDepartment` varchar(128) DEFAULT NULL,
  `tuCourse` varchar(128) DEFAULT NULL,
  `tuProfessor` varchar(128) DEFAULT NULL,
  `tuCondition` int(10) DEFAULT NULL,
  `tuLocation` varchar(128) DEFAULT NULL,
  `tuDescription` text,
  `tuComment` text,
  `tuPrice` double DEFAULT '0',
  `tuStatus` tinyint(4) DEFAULT '1',
  `tuType` int(10) NOT NULL DEFAULT '0',
  `tuVerify` tinyint(1) DEFAULT '0',
  `tuPostdate` int(10) NOT NULL,
  PRIMARY KEY (`tuId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `vsf_textbook_user`
--

INSERT INTO `vsf_textbook_user` (`tuId`, `tuUser`, `tuBook`, `tuSubject`, `tuCampus`, `tuDepartment`, `tuCourse`, `tuProfessor`, `tuCondition`, `tuLocation`, `tuDescription`, `tuComment`, `tuPrice`, `tuStatus`, `tuType`, `tuVerify`, `tuPostdate`) VALUES
(90, 28, 50, '156', '20', '', '', '', 462, '', '', '', 35, 1, 465, 0, 1317195264),
(94, 28, 51, '156', '20', '', '', '', 462, '', '', '', 111, 0, 465, 1, 1319082614),
(93, 28, 49, '157', '17', 'Department', 'Course', 'Professor', 463, 'Location', 'Textbook Description', 'Textbook Comments', 8, 1, 465, 0, 1317697024),
(89, 28, 49, '156', '20', '', '', '', 462, '', '', '', 20, 1, 465, 0, 1317195078),
(65, 28, 33, '154', '0', '', '', '', 462, '', '', '', 3, 1, 465, 0, 1304674378),
(66, 28, 34, '157', '13', 'python', 'python', 'pandog', 463, 'saigon, vietnam', 'Google and YouTube use Python because it&#39;s highly adaptable, easy to maintain, and allows for rapid development.', 'Google and YouTube use Python because it&#39;s highly adaptable, easy to maintain, and allows for rapid development.', 3, 1, 465, 0, 1304674716),
(83, 28, 44, '154', '20', '', '', '', 462, 'saigon', '', '', 50, 1, 465, 0, 1317178449),
(84, 28, 45, '156', '20', '', '', '', 463, '', '', '', 10, 1, 465, 0, 1317178569),
(85, 28, 30, '156', '20', '', '', '', 463, '', '', '', 10, 1, 465, 0, 1317178621),
(86, 28, 33, '156', '20', '', '', '', 462, '', '', '', 20, 1, 465, 0, 1317178655),
(87, 28, 46, '156', '20', '', '', '', 462, 'vietnam', '', '', 20, 1, 465, 0, 1317193968),
(88, 28, 48, '156', '20', '', '', '', 463, '', '', '', 35, 1, 465, 0, 1317194964),
(68, 28, 29, '154', '0', 'java', 'ruby on rails', 'pandog', 462, 'saigon, vietnam', 'M.U Ä‘Ã£ hoÃ n thÃ nh xuáº¥t sáº¯c nhiá»‡m vá»¥ cá»§a mÃ¬nh trong tráº­n Ä‘áº¥u Ä‘Æ°á»£c vÃ­ lÃ  chung káº¿t Premier League mÃ¹a giáº£i nÄƒm nay.', 'M.U Ä‘Ã£ hoÃ n thÃ nh xuáº¥t sáº¯c nhiá»‡m vá»¥ cá»§a mÃ¬nh trong tráº­n Ä‘áº¥u Ä‘Æ°á»£c vÃ­ lÃ  chung káº¿t Premier League mÃ¹a giáº£i nÄƒm nay.', 50, 1, 465, 0, 1304916357),
(69, 28, 29, '154', '0', 'java', 'ruby on rails', 'pandog', 462, 'saigon, vietnam', 'M.U Ä‘Ã£ hoÃ n thÃ nh xuáº¥t sáº¯c nhiá»‡m vá»¥ cá»§a mÃ¬nh trong tráº­n Ä‘áº¥u Ä‘Æ°á»£c vÃ­ lÃ  chung káº¿t Premier League mÃ¹a giáº£i nÄƒm nay.', 'M.U Ä‘Ã£ hoÃ n thÃ nh xuáº¥t sáº¯c nhiá»‡m vá»¥ cá»§a mÃ¬nh trong tráº­n Ä‘áº¥u Ä‘Æ°á»£c vÃ­ lÃ  chung káº¿t Premier League mÃ¹a giáº£i nÄƒm nay.', 60, 1, 465, 0, 1304916400),
(70, 28, 29, '154', '0', 'java', 'ruby on rails', 'pandog', 462, 'hcmc, vietnam', 'M.U Ä‘Ã£ hoÃ n thÃ nh xuáº¥t sáº¯c nhiá»‡m vá»¥ cá»§a mÃ¬nh trong tráº­n Ä‘áº¥u Ä‘Æ°á»£c vÃ­ lÃ  chung káº¿t Premier League mÃ¹a giáº£i nÄƒm nay.', 'M.U Ä‘Ã£ hoÃ n thÃ nh xuáº¥t sáº¯c nhiá»‡m vá»¥ cá»§a mÃ¬nh trong tráº­n Ä‘áº¥u Ä‘Æ°á»£c vÃ­ lÃ  chung káº¿t Premier League mÃ¹a giáº£i nÄƒm nay.', 30, 1, 465, 0, 1304916474),
(71, 32, 29, '154', '0', 'java', 'ruby on rails', '', 462, 'hcmc,vietnam', 'test', 'test', 20, 1, 465, 0, 1304917538),
(72, 28, 35, '156', '17', 'marketing online', 'search online', 'pandog', 463, 'saigon, vietnam', 'Rand Fishkin is the CEO &amp; Co-Founder of SEOmoz, a leader in the field of search engine optimization tools, resources &amp; community. In 2009, he was named among the 30 Best Young Tech Entrepreneurs Under 30 by BusinessWeek, and has been written about it in the Seattle Times, Newsweek and the New York Times among others. Rand has keynoted conferences on search from Sydney to Reykjavik, Montreal to Munich and spoken at dozens of shows around the world. He&#39;s particularly passionate about the SEOmoz blog, read by tens of thousands of search professionals each day. In his miniscule spare time, Rand enjoys the company of his amazing wife, Geraldine.', 'Rand Fishkin is the CEO &amp; Co-Founder of SEOmoz, a leader in the field of search engine optimization tools, resources &amp; community. In 2009, he was named among the 30 Best Young Tech Entrepreneurs Under 30 by BusinessWeek, and has been written about it in the Seattle Times, Newsweek and the New York Times among others. Rand has keynoted conferences on search from Sydney to Reykjavik, Montreal to Munich and spoken at dozens of shows around the world. He&#39;s particularly passionate about the SEOmoz blog, read by tens of thousands of search professionals each day. In his miniscule spare time, Rand enjoys the company of his amazing wife, Geraldine.', 100, 1, 465, 0, 1309235078),
(73, 28, 36, '154', '0', '', '', '', 463, '', '', '', 50, 1, 465, 0, 1309237020),
(74, 28, 37, '156', '17', 'pandog', 'pandog', 'pandog', 463, 'pandog', 'pandog', 'pandog', 1000, 1, 465, 0, 1309314914),
(78, 28, 41, '156', '13', 'seo', 'seo', 'pandog', 462, '', 'More timely than ever, this comprehensive, can-do book offers expert advice, practical instructions, and smart tools to help you increase visibility for your website on Google and other major search engines. In this new edition of their bestselling guide, veteran search marketing consultants Jennifer Grappone and Gradiva Couzin give you the very latest SEO and social media strategies and tricks of the trade in a workable, day-by-day plan. Perfect for busy self-starters in organizations large and small, this book will quickly help you increase your visibility and presence on the web.', 'More timely than ever, this comprehensive, can-do book offers expert advice, practical instructions, and smart tools to help you increase visibility for your website on Google and other major search engines. In this new edition of their bestselling guide, veteran search marketing consultants Jennifer Grappone and Gradiva Couzin give you the very latest SEO and social media strategies and tricks of the trade in a workable, day-by-day plan. Perfect for busy self-starters in organizations large and small, this book will quickly help you increase your visibility and presence on the web.', 50, 1, 465, 0, 1311236686),
(77, 28, 40, '159', '18', 'pandog', 'pandog', 'pandog', 462, 'saigon, vietnam', 'pandog', 'pandog', 100, 1, 465, 0, 1309486627),
(79, 28, 42, '155', '13', '', '', '', 462, '', '', '', 4, 1, 465, 1, 1311666500),
(80, 28, 29, '156', '13', 'pandog', 'pandog', 'pandog', 463, '', 'pandog', 'pandog', 35, 1, 465, 0, 1313400220),
(81, 28, 29, '155', '13', '', '', '', 462, '', '', '', 40, 1, 465, 0, 1313401505),
(82, 28, 43, '156', '20', '', '', '', 462, '', '', '', 30, 1, 465, 0, 1317174555);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user`
--

CREATE TABLE IF NOT EXISTS `vsf_user` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(64) NOT NULL DEFAULT '',
  `userAlias` varchar(125) NOT NULL,
  `userFullname` varchar(1024) NOT NULL,
  `userLanguage` int(5) NOT NULL,
  `userTimezone` varchar(8) NOT NULL,
  `userImage` int(10) NOT NULL,
  `userPassword` varchar(64) NOT NULL,
  `userCampusId` int(10) NOT NULL,
  `userEmail` varchar(255) NOT NULL DEFAULT '',
  `userInfo` text NOT NULL,
  `userLastLogin` int(10) NOT NULL DEFAULT '0',
  `userJoinDate` int(10) NOT NULL DEFAULT '0',
  `userStatus` tinyint(1) NOT NULL DEFAULT '0',
  `userReferral` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `vsf_user`
--

INSERT INTO `vsf_user` (`userId`, `userName`, `userAlias`, `userFullname`, `userLanguage`, `userTimezone`, `userImage`, `userPassword`, `userCampusId`, `userEmail`, `userInfo`, `userLastLogin`, `userJoinDate`, `userStatus`, `userReferral`) VALUES
(28, 'yunhaihuang@gmail.com', 'yunhaihuang', 'yunhai huang', 2, '7', 291, '19636b22a79a7d2c50dc789036325026', 20, 'yunhaihuang@gmail.com', 'a:2:{s:13:"userFirstName";s:6:"yunhai";s:12:"userLastName";s:5:"huang";}', 1318824128, 1294237879, 1, 3),
(27, 'npkhoa@gmail.com', 'khoa', 'khoa nguyen', 0, '0', 0, 'e8ed38edd226e6d0bb0f65e07d8f3f55', 19, 'npkhoa@gmail.com', 'a:2:{s:13:"userFirstName";s:4:"khoa";s:12:"userLastName";s:6:"nguyen";}', 1284885132, 1284885132, 1, 0),
(7, 'ducdoan@vietsol.net', 'ducdoan', 'Duc Doan', 0, '0', 354, '5a194123fdfd23ccfb82c2ae797253a3', 13, 'ducdoan@vietsol.net', 'a:2:{s:13:"userFirstName";s:3:"Duc";s:12:"userLastName";s:4:"Doan";}', 1284444450, 1284444450, 1, 0),
(16, 'conan@yahoo.com', 'conan', 'Conan', 0, '0', 0, '19636b22a79a7d2c50dc789036325026', 17, 'conan142002@yahoo.com', 'a:2:{s:13:"userFirstName";s:3:"Duc";s:12:"userLastName";s:4:"Doan";}', 1284658664, 1284658664, 1, 0),
(32, 'minhhai@vietsol.net', 'minhhai', 'minhhai vietsol', 2, '-3', 522, '19636b22a79a7d2c50dc789036325026', 20, 'minhhai@vietsol.net', 'a:2:{s:13:"userFirstName";N;s:12:"userLastName";N;}', 1294637210, 1294637210, 1, 0),
(33, 'hongdao@gmail.com', 'hongdao', 'hong dao', 0, '', 605, '19636b22a79a7d2c50dc789036325026', 17, 'hongdao@gmail.com', 'a:2:{s:13:"userFirstName";N;s:12:"userLastName";N;}', 1297677587, 1297677587, 1, 0),
(34, 'yunhaihuang@ladysg.com', 'ladysg', 'yunhai ladysg', 0, '', 0, '19636b22a79a7d2c50dc789036325026', 13, 'yunhaihuang@ladysg.com', 'a:2:{s:13:"userFirstName";N;s:12:"userLastName";N;}', 1302862448, 1302862448, 1, 0),
(37, 'minhhai@gmail.com', 'minhhaitruong', 'minhhai gmail', 0, '', 0, 'e15f054da572a9e4b177ca6c163bf3a8', 19, 'minhhai@gmail.com', 'a:2:{s:13:"userFirstName";N;s:12:"userLastName";N;}', 1303283344, 1303283344, 1, 0),
(42, 'yunhaihuang@pandog.net', 'pandog', 'pandog net', 0, '', 0, '19636b22a79a7d2c50dc789036325026', 13, 'yunhaihuang@pandog.net', 'a:2:{s:13:"userFirstName";s:6:"pandog";s:12:"userLastName";s:3:"net";}', 1309155161, 1309155161, 1, 0),
(41, 'ngohongdao@gmail.com', 'ngohongdao', 'hongdao ngo', 0, '', 0, '19636b22a79a7d2c50dc789036325026', 19, 'ngohongdao@gmail.com', 'a:2:{s:13:"userFirstName";s:7:"hongdao";s:12:"userLastName";s:3:"ngo";}', 1308194882, 1308194882, 1, 0),
(46, 'pandogs@gmail.com', 'pandogs', 'pandogs huang', 0, '', 0, '19636b22a79a7d2c50dc789036325026', 4, 'pandogs@gmail.com', 'a:2:{s:13:"userFirstName";s:7:"pandogs";s:12:"userLastName";s:5:"huang";}', 1310665331, 1310665331, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_usergroup`
--

CREATE TABLE IF NOT EXISTS `vsf_usergroup` (
  `groupId` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `groupTitle` varchar(64) NOT NULL DEFAULT '',
  `groupIntro` text NOT NULL,
  `groupPermission` text NOT NULL,
  PRIMARY KEY (`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vsf_usergroup`
--

INSERT INTO `vsf_usergroup` (`groupId`, `groupTitle`, `groupIntro`, `groupPermission`) VALUES
(1, 'GiÃ¡m Ä‘á»‘c', 'chi tiet', ''),
(2, 'TrÆ°á»Ÿng phÃ²ng', 'chi tiet', '');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_edu`
--

CREATE TABLE IF NOT EXISTS `vsf_user_edu` (
  `eduId` int(10) NOT NULL AUTO_INCREMENT,
  `eduUser` int(10) NOT NULL,
  `eduSchool` varchar(1024) NOT NULL,
  `eduDegree` varchar(512) DEFAULT '',
  `eduMajor` varchar(512) DEFAULT '',
  `eduStart` char(7) DEFAULT '',
  `eduEnd` char(7) DEFAULT '',
  `eduMain` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eduId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vsf_user_edu`
--

INSERT INTO `vsf_user_edu` (`eduId`, `eduUser`, `eduSchool`, `eduDegree`, `eduMajor`, `eduStart`, `eduEnd`, `eduMain`) VALUES
(1, 46, '4', NULL, NULL, NULL, '0', 1),
(2, 42, '13', NULL, NULL, NULL, '0', 1),
(3, 41, '19', NULL, NULL, NULL, '0', 1),
(4, 37, '19', NULL, NULL, NULL, '0', 1),
(5, 34, '13', NULL, NULL, NULL, '0', 1),
(6, 33, '17', NULL, NULL, NULL, '0', 1),
(7, 32, '13', NULL, NULL, NULL, '0', 1),
(8, 28, '18', 'profressor', 'Internet marketting', '1-2007', '9-2011', 1),
(9, 27, '13', NULL, NULL, NULL, '0', 1),
(10, 16, '17', NULL, NULL, NULL, '0', 1),
(11, 7, '13', NULL, NULL, NULL, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_edu_project`
--

CREATE TABLE IF NOT EXISTS `vsf_user_edu_project` (
  `epId` int(10) NOT NULL AUTO_INCREMENT,
  `epEdu` int(10) NOT NULL,
  `epTitle` varchar(128) NOT NULL,
  `epDetail` varchar(512) NOT NULL,
  `epStart` char(7) NOT NULL,
  `epEnd` char(7) DEFAULT '',
  PRIMARY KEY (`epId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `vsf_user_edu_project`
--

INSERT INTO `vsf_user_edu_project` (`epId`, `epEdu`, `epTitle`, `epDetail`, `epStart`, `epEnd`) VALUES
(20, 8, 'fasfd', 'fsdfd', '2-2010', ''),
(4, 133, 'nguyen hien project', 'nguyen hien project', '2-2010', '2-2011'),
(21, 8, 'fsfd', 'fsdfs', '1-2010', '');

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
('28', '1'),
('2', '1'),
('3', '1'),
('4', '1'),
('6', '1'),
('7', '1'),
('8', '1'),
('9', '1'),
('16', '1'),
('27', '1'),
('29', '1'),
('30', '1'),
('31', '1'),
('32', '1'),
('33', '1'),
('34', '1'),
('35', '1'),
('36', '1'),
('37', '1'),
('41', '1'),
('40', '1'),
('42', '1'),
('43', '1'),
('44', '1'),
('45', '1'),
('46', '1'),
('47', '1'),
('48', '1'),
('49', '1'),
('50', '1'),
('51', '1'),
('52', '1'),
('53', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_profile`
--

CREATE TABLE IF NOT EXISTS `vsf_user_profile` (
  `profileId` int(10) NOT NULL AUTO_INCREMENT,
  `profileUser` int(10) NOT NULL,
  `profileBirthday` char(10) DEFAULT NULL,
  `profileGender` tinyint(1) DEFAULT NULL,
  `profileLocation` varchar(1024) DEFAULT NULL,
  `profileRS` int(10) DEFAULT NULL,
  `profileIntro` text,
  `profileLanguage` text,
  `profileInterest` text,
  `profileGA` text,
  `profileHonor` text,
  `profileSkill` text,
  `profileEmail` varchar(64) DEFAULT NULL,
  `profilePhone` varchar(32) DEFAULT NULL,
  `profileAddress` varchar(1024) DEFAULT NULL,
  `profileWebsite` varchar(128) DEFAULT NULL,
  `profileSN` text,
  PRIMARY KEY (`profileId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `vsf_user_profile`
--

INSERT INTO `vsf_user_profile` (`profileId`, `profileUser`, `profileBirthday`, `profileGender`, `profileLocation`, `profileRS`, `profileIntro`, `profileLanguage`, `profileInterest`, `profileGA`, `profileHonor`, `profileSkill`, `profileEmail`, `profilePhone`, `profileAddress`, `profileWebsite`, `profileSN`) VALUES
(1, 28, '2-24-1985', 1, 'saigon', 1019, 'my name is pandog.', 'en,jp,ch', 'Football, Reading.', 'Groups and Associations.', 'Honors and Awards.', 'my skill is talking. ', 'yunhaihuang@gmail.com', '9552265', 'tan khai', 'http://blog.pandog.net', '[{"value":"yunhai2402@yahoo.com","type":"yahoo"},{"value":"yunhaihuang.work","type":"skype"}]'),
(7, 42, '2-4-1982', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 46, '9-16-1981', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 41, '2-5-1985', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 37, '2-5-1985', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 34, '2-5-1985', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 33, '2-5-1985', 0, NULL, NULL, 'my name is pandog.<br />', '', 'Football, Reading. ', NULL, 'Honors and Awards.<br />', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 32, '2-5-1985', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL),
(13, 28, '2-5-1985', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 27, '1-26-1985', 0, '', 1021, 'about khoa', 'en,vi', '', '', '', NULL, '', '', '', '', ''),
(15, 16, '1-22-1985', 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 7, '3-7-2002', 0, 'San Jose, CA', 1020, 'duc doan', 'Vietnamese,English', 'interests', 'groups and associations', 'Honors and award', NULL, 'ducdoan@vietsol.net', '123456789', 'San Jose, CA', 'http://www.facebook.com/ducdoan', '[{"value":"ducdoan@yahoo.com","type":"yahoo"},{"value":"ducdoan","type":"skype"}]');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_session`
--

CREATE TABLE IF NOT EXISTS `vsf_user_session` (
  `sessionCode` varchar(64) NOT NULL,
  `userId` int(11) NOT NULL,
  `userStatus` tinyint(1) NOT NULL,
  `sessionTime` int(10) NOT NULL,
  `sessionId` int(32) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sessionId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1293 ;

--
-- Dumping data for table `vsf_user_session`
--

INSERT INTO `vsf_user_session` (`sessionCode`, `userId`, `userStatus`, `sessionTime`, `sessionId`) VALUES
('845c8c9abb2039ec21ac65aad703e25e', 0, 0, 1351784023, 1292);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_setting`
--

CREATE TABLE IF NOT EXISTS `vsf_user_setting` (
  `settingId` int(4) NOT NULL AUTO_INCREMENT,
  `settingTitle` varchar(1024) NOT NULL,
  `settingKey` varchar(16) NOT NULL,
  `settingGroup` int(4) NOT NULL,
  `settingIndex` tinyint(4) NOT NULL DEFAULT '0',
  `settingStatus` tinyint(4) NOT NULL,
  PRIMARY KEY (`settingId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vsf_user_setting`
--

INSERT INTO `vsf_user_setting` (`settingId`, `settingTitle`, `settingKey`, `settingGroup`, `settingIndex`, `settingStatus`) VALUES
(1, 'View profile', 'viewprofile', 1, 1, 1),
(2, 'Post / share on profile', 'postonprofile', 1, 2, 1),
(3, 'Comment / Reply to updates', 'replyupdate', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_sgroup`
--

CREATE TABLE IF NOT EXISTS `vsf_user_sgroup` (
  `sgId` int(4) NOT NULL AUTO_INCREMENT,
  `sgTitle` varchar(128) NOT NULL,
  `sgKey` varchar(16) NOT NULL,
  `sgStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`sgId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vsf_user_sgroup`
--

INSERT INTO `vsf_user_sgroup` (`sgId`, `sgTitle`, `sgKey`, `sgStatus`) VALUES
(1, 'profile', 'profile', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_sitem`
--

CREATE TABLE IF NOT EXISTS `vsf_user_sitem` (
  `itemId` int(8) NOT NULL AUTO_INCREMENT,
  `itemSetting` int(4) NOT NULL,
  `itemTitle` varchar(1024) NOT NULL,
  `itemKey` varchar(16) NOT NULL,
  `itemValue` varchar(1024) NOT NULL,
  `itemDefault` tinyint(1) NOT NULL DEFAULT '0',
  `itemIndex` tinyint(4) NOT NULL DEFAULT '0',
  `itemStatus` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`itemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `vsf_user_sitem`
--

INSERT INTO `vsf_user_sitem` (`itemId`, `itemSetting`, `itemTitle`, `itemKey`, `itemValue`, `itemDefault`, `itemIndex`, `itemStatus`) VALUES
(1, 1, 'Friend only', 'friend', '1', 1, 1, 1),
(2, 1, 'Extended Network', 'extended', '2', 0, 2, 1),
(3, 1, 'Everyone', 'everyone', '3', 0, 3, 1),
(4, 2, 'Self', 'self', '1', 0, 1, 1),
(5, 2, 'Friend only', 'friend', '2', 1, 2, 1),
(6, 2, 'Extended Network', 'extended', '3', 0, 3, 1),
(7, 2, 'Everyone', 'everyone', '4', 0, 4, 1),
(8, 3, 'Friend only', 'friend', '1', 1, 1, 1),
(9, 3, 'Extended Network', 'extended', '2', 0, 2, 1),
(10, 3, 'Everyone', 'everyone', '3', 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_suser`
--

CREATE TABLE IF NOT EXISTS `vsf_user_suser` (
  `usId` int(10) NOT NULL AUTO_INCREMENT,
  `usUser` int(10) NOT NULL,
  `usSetting` int(4) NOT NULL,
  `usValue` varchar(64) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `vsf_user_suser`
--

INSERT INTO `vsf_user_suser` (`usId`, `usUser`, `usSetting`, `usValue`) VALUES
(1, 28, 1, '3'),
(2, 28, 2, '6'),
(3, 28, 3, '9'),
(4, 32, 1, '2'),
(5, 32, 2, '5'),
(6, 32, 3, '8'),
(7, 33, 1, '3'),
(8, 33, 2, '7'),
(9, 33, 3, '10'),
(10, 7, 1, '3'),
(11, 7, 2, '7'),
(12, 7, 3, '10');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_work`
--

CREATE TABLE IF NOT EXISTS `vsf_user_work` (
  `workId` int(10) NOT NULL AUTO_INCREMENT,
  `workUser` int(10) NOT NULL,
  `workTitle` varchar(256) NOT NULL,
  `workCompany` varchar(256) NOT NULL,
  `workStart` char(10) NOT NULL,
  `workEnd` char(10) NOT NULL,
  PRIMARY KEY (`workId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `vsf_user_work`
--

INSERT INTO `vsf_user_work` (`workId`, `workUser`, `workTitle`, `workCompany`, `workStart`, `workEnd`) VALUES
(3, 7, 'manager', 'vietsol', '2-1999', '4-2002'),
(4, 7, 'manager', 'vietnamtong', '2-2010', ''),
(24, 27, 'work', 'work', '2-2010', '2-2011');

-- --------------------------------------------------------

--
-- Table structure for table `vsf_user_work_project`
--

CREATE TABLE IF NOT EXISTS `vsf_user_work_project` (
  `wpId` int(10) NOT NULL AUTO_INCREMENT,
  `wpWork` int(10) NOT NULL,
  `wpTitle` varchar(128) NOT NULL,
  `wpDetail` varchar(512) NOT NULL,
  `wpStart` char(10) NOT NULL,
  `wpEnd` char(10) NOT NULL,
  PRIMARY KEY (`wpId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `vsf_user_work_project`
--

INSERT INTO `vsf_user_work_project` (`wpId`, `wpWork`, `wpTitle`, `wpDetail`, `wpStart`, `wpEnd`) VALUES
(13, 24, 'work project', 'work project', '3-2009', '2-2010'),
(8, 3, 'project 1', 'project 1', '9-2009', ''),
(9, 4, 'fsafd', 'fsaf', '10-1999', ''),
(10, 15, 'fdfs', 'fsdf', '9-1999', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2009 at 01:30 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cpbgroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `navIcon` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `tag_id`, `navIcon`, `created`, `modified`) VALUES
(1, 'crispin porter', 1, 'none', '2009-06-02 05:11:28', '2009-06-02 05:11:28'),
(2, 'Volkswagen', 2, 'none', '2009-06-02 05:11:43', '2009-06-02 05:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `datafeeds`
--

CREATE TABLE IF NOT EXISTS `datafeeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contentType` enum('url','plaintext','html','xml') NOT NULL DEFAULT 'url',
  `updateFreqInMinutes` int(11) NOT NULL DEFAULT '0' COMMENT '0 means never update automatically',
  `defaultTags` varchar(255) NOT NULL COMMENT 'Empty uses all search tags, quoted comma delimited list of tag IDs will be automatically applied',
  `authType` enum('none','htauth','apikey') NOT NULL DEFAULT 'none',
  `authUserName` varchar(255) NOT NULL,
  `authPassword` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `crawlerStatus` enum('none','crawling') NOT NULL DEFAULT 'none',
  `crawlerID` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `datafeeds`
--

INSERT INTO `datafeeds` (`id`, `name`, `contentType`, `updateFreqInMinutes`, `defaultTags`, `authType`, `authUserName`, `authPassword`, `created`, `modified`, `crawlerStatus`, `crawlerID`) VALUES
(1, 'twitter', 'plaintext', 5, '', 'none', '', '', '2009-06-02 04:55:54', '2009-06-10 12:41:12', 'none', ''),
(2, 'youtube', 'url', 5, '', 'none', '', '', '2009-06-08 18:49:06', '2009-06-10 13:12:25', 'none', '');

-- --------------------------------------------------------

--
-- Table structure for table `datarows`
--

CREATE TABLE IF NOT EXISTS `datarows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datafeed_id` int(11) NOT NULL,
  `published` datetime NOT NULL,
  `articleId` varchar(255) NOT NULL COMMENT 'unique id tag value',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tags` text NOT NULL COMMENT 'tags provided from the datasource',
  `cpbTags` text NOT NULL COMMENT 'quoted, spaced tags associated by our crawler',
  `flagged` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=310 ;

--
-- Dumping data for table `datarows`
--

INSERT INTO `datarows` (`id`, `datafeed_id`, `published`, `articleId`, `title`, `content`, `thumb`, `author`, `rating`, `created`, `modified`, `tags`, `cpbTags`, `flagged`) VALUES
(243, 1, '2009-06-10 16:50:16', 'tag:search.twitter.com,2005:2105361873', 'RT @bogusky Some huge CP+B news breaks tomorrow in Campaign magazine. I''ve got super excited feelings all mixed up with some scared feelings', 'RT &lt;a href=&quot;http://twitter.com/bogusky&quot;&gt;@bogusky&lt;/a&gt; Some huge &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; news breaks tomorrow in Campaign magazine. I''ve got super excited feelings all mixed up with some scared feelings', 'http://s3.amazonaws.com/twitter_production/profile_images/95502371/Twit_Pic_normal.jpg', 'warrenng', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(244, 1, '2009-06-10 16:40:56', 'tag:search.twitter.com,2005:2105251161', 'RT @bogusky: Some huge CP+B news breaks tomorrow in Campaign magazine. I''ve got super excited feelings all mixed up with some scared fee ...', 'RT &lt;a href=&quot;http://twitter.com/bogusky&quot;&gt;@bogusky&lt;/a&gt;: Some huge &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; news breaks tomorrow in Campaign magazine. I''ve got super excited feelings all mixed up with some scared fee ...', 'http://static.twitter.com/images/default_profile_normal.png', 'eyeblasterjon', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(245, 1, '2009-06-10 16:38:52', 'tag:search.twitter.com,2005:2105226768', 'RT @RickM New #jobs on http://www.talentzoo.com from MSNBC, Blitz Media, McKinney, Publicis, CP+B, DraftFCB, NSA Media, iCrossing, & more.', 'RT &lt;a href=&quot;http://twitter.com/RickM&quot;&gt;@RickM&lt;/a&gt; New &lt;a href=&quot;http://search.twitter.com/search?q=%23jobs&quot;&gt;#jobs&lt;/a&gt; on &lt;a href=&quot;http://www.talentzoo.com&quot;&gt;http://www.talentzoo.com&lt;/a&gt; from MSNBC, Blitz Media, McKinney, Publicis, &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt;, DraftFCB, NSA Media, iCrossing, &amp;amp; more.', 'http://s3.amazonaws.com/twitter_production/profile_images/75573520/IMG_0373_normal.JPG', 'reelspit', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(246, 1, '2009-06-10 16:38:14', 'tag:search.twitter.com,2005:2105219369', 'RT @RickM: New #jobs on http://www.talentzoo.com from MSNBC, Blitz Media, McKinney, Publicis, CP+B, DraftFCB, NSA Media, iCrossing, & more.', 'RT &lt;a href=&quot;http://twitter.com/RickM&quot;&gt;@RickM&lt;/a&gt;: New &lt;a href=&quot;http://search.twitter.com/search?q=%23jobs&quot;&gt;#jobs&lt;/a&gt; on &lt;a href=&quot;http://www.talentzoo.com&quot;&gt;http://www.talentzoo.com&lt;/a&gt; from MSNBC, Blitz Media, McKinney, Publicis, &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt;, DraftFCB, NSA Media, iCrossing, &amp;amp; more.', 'http://s3.amazonaws.com/twitter_production/profile_images/54417999/logo-dog_normal.gif', 'wheresspot', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(247, 1, '2009-06-10 16:26:33', 'tag:search.twitter.com,2005:2105079098', 'New #jobs on http://www.talentzoo.com from MSNBC, Blitz Media, McKinney, Publicis, CP+B, DraftFCB, NSA Media, iCrossing, & more.', 'New &lt;a href=&quot;http://search.twitter.com/search?q=%23jobs&quot;&gt;#jobs&lt;/a&gt; on &lt;a href=&quot;http://www.talentzoo.com&quot;&gt;http://www.talentzoo.com&lt;/a&gt; from MSNBC, Blitz Media, McKinney, Publicis, &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt;, DraftFCB, NSA Media, iCrossing, &amp;amp; more.', 'http://s3.amazonaws.com/twitter_production/profile_images/57845596/For_Twitter_normal.JPG', 'RickM', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(248, 1, '2009-06-10 16:12:58', 'tag:search.twitter.com,2005:2104918407', 'Would whatever CP+B employee who has the first say anything cd please connect to the server, gracias.  I''m FIENDING.', 'Would whatever &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; employee who has the first say anything cd please connect to the server, gracias.  I''m FIENDING.', 'http://s3.amazonaws.com/twitter_production/profile_images/132675608/Wales_normal.JPG', 'bburns21', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(249, 1, '2009-06-10 16:00:55', 'tag:search.twitter.com,2005:2104773700', 'THX! RT @adrants: 24DP Hawks Online Video Skillz Off on eBay: Ripping a sheet outta the playbooks of CP+B .. http://tinyurl.com/le3brm', 'THX! RT &lt;a href=&quot;http://twitter.com/adrants&quot;&gt;@adrants&lt;/a&gt;: 24DP Hawks Online Video Skillz Off on eBay: Ripping a sheet outta the playbooks of &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; .. &lt;a href=&quot;http://tinyurl.com/le3brm&quot;&gt;http://tinyurl.com/le3brm&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/100816550/OFFICIAL_LOGO_24dp_normal.jpg', '24dp', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(250, 1, '2009-06-10 15:39:42', 'tag:search.twitter.com,2005:2104519974', '@bogusky: Some huge #CP+B news breaks tomorrow in Campaign magazine.', '&lt;a href=&quot;http://twitter.com/bogusky&quot;&gt;@bogusky&lt;/a&gt;: Some huge &lt;a href=&quot;http://search.twitter.com/search?q=%23CP&quot;&gt;#&lt;b&gt;CP&lt;/b&gt;&lt;/a&gt;+&lt;b&gt;B&lt;/b&gt; news breaks tomorrow in Campaign magazine.', 'http://s3.amazonaws.com/twitter_production/profile_images/246598837/Cheeky_20Monkey_normal.jpg', 'antburke', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(251, 1, '2009-06-10 15:38:20', 'tag:search.twitter.com,2005:2104503721', 'RT @bogusky: Some huge CP+B news breaks tomorrow in Campaign magazine.', 'RT &lt;a href=&quot;http://twitter.com/bogusky&quot;&gt;@bogusky&lt;/a&gt;: Some huge &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; news breaks tomorrow in Campaign magazine.', 'http://s3.amazonaws.com/twitter_production/profile_images/70312179/turtle_flatSM_normal.jpg', 'Ninjabread', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(252, 1, '2009-06-10 15:33:11', 'tag:search.twitter.com,2005:2104441695', 'CP+B London? RT: @bogusky Some huge CP+B news breaks tomorrow in Campaign magazine.', '&lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; London? RT: &lt;a href=&quot;http://twitter.com/bogusky&quot;&gt;@bogusky&lt;/a&gt; Some huge &lt;b&gt;CP&lt;/b&gt;+&lt;b&gt;B&lt;/b&gt; news breaks tomorrow in Campaign magazine.', 'http://s3.amazonaws.com/twitter_production/profile_images/119183075/brandon300_normal.jpg', 'texturl', 0, '2009-06-10 13:08:40', '2009-06-10 13:08:40', '"cp+b"', '"cp+b"', 'false'),
(253, 1, '2009-06-10 17:05:09', 'tag:search.twitter.com,2005:2105540924', 'www.jesusmchamizo.com  ad photographer  | Car King | (for TOYOTA-SEAT-ROVER-CHRYSLER-HONDA-RENAULT-VOLKSWAGEN...) site developed by Tizedit', '&lt;a href=&quot;http://www.jesusmchamizo.com&quot;&gt;www.jesusmchamizo.com&lt;/a&gt;  ad photographer  | Car King | (for TOYOTA-SEAT-ROVER-CHRYSLER-HONDA-RENAULT-&lt;b&gt;VOLKSWAGEN&lt;/b&gt;...) site developed by Tizedit', 'http://s3.amazonaws.com/twitter_production/profile_images/75400194/Untitled-1_normal.jpg', 'tizedit', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(254, 1, '2009-06-10 16:56:47', 'tag:search.twitter.com,2005:2105439042', 'RECOVERY ALERT: $28,000 2005 Volkswagen Jetta also equipped with an immobilizer and stolen from an underground parking lot in Toronto.', 'RECOVERY ALERT: $28,000 2005 &lt;b&gt;Volkswagen&lt;/b&gt; Jetta also equipped with an immobilizer and stolen from an underground parking lot in Toronto.', 'http://s3.amazonaws.com/twitter_production/profile_images/209070305/generic_normal.jpg', 'BoomRecoveries', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(255, 1, '2009-06-10 16:55:40', 'tag:search.twitter.com,2005:2105425590', 'Low mileage 2002 Volkswagen Passat GLS  ..', 'Low mileage 2002 &lt;b&gt;Volkswagen&lt;/b&gt; Passat GLS  ..', 'http://s3.amazonaws.com/twitter_production/profile_images/98885073/Danny_normal.jpg', 'countryhill', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(256, 1, '2009-06-10 16:52:43', 'tag:search.twitter.com,2005:2105390615', 'plan vamos por partes de volkswagen: una nueva forma de obtener tu propio automóvil.', 'plan vamos por partes de &lt;b&gt;volkswagen&lt;/b&gt;: una nueva forma de obtener tu propio autom&Atilde;&sup3;vil.', 'http://s3.amazonaws.com/twitter_production/profile_images/257375422/VOLKSWAGENPRES2_normal.jpg', 'vamosporpartes', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(257, 1, '2009-06-10 16:49:44', 'tag:search.twitter.com,2005:2105355548', 'This is a sweet 2002 Volkswagen Passat GLS   http://bit.ly/10tc5V', 'This is a sweet 2002 &lt;b&gt;Volkswagen&lt;/b&gt; Passat GLS   &lt;a href=&quot;http://bit.ly/10tc5V&quot;&gt;http://bit.ly/10tc5V&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/98885073/Danny_normal.jpg', 'countryhill', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(258, 1, '2009-06-10 16:47:14', 'tag:search.twitter.com,2005:2105326093', 'Volkswagen Golf: getint glas, gordelspanners, ruitenwisser achter, stuurbekrachtiging, toerenteller, http://tinyurl.com/mlfck8', '&lt;b&gt;Volkswagen&lt;/b&gt; Golf: getint glas, gordelspanners, ruitenwisser achter, stuurbekrachtiging, toerenteller, &lt;a href=&quot;http://tinyurl.com/mlfck8&quot;&gt;http://tinyurl.com/mlfck8&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/182716167/Gratis_Adverteren1_normal.jpg', 'gratisaverteren', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(259, 1, '2009-06-10 16:45:44', 'tag:search.twitter.com,2005:2105308323', 'Volkswagen Golf: getint glas, gordelspanners, ruitenwisser achter, stuurbekrachtiging, toerenteller, http://tinyurl.com/mlfck8', '&lt;b&gt;Volkswagen&lt;/b&gt; Golf: getint glas, gordelspanners, ruitenwisser achter, stuurbekrachtiging, toerenteller, &lt;a href=&quot;http://tinyurl.com/mlfck8&quot;&gt;http://tinyurl.com/mlfck8&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/206168648/oldcar_normal.jpg', 'tweedehandsauto', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(260, 1, '2009-06-10 16:44:48', 'tag:search.twitter.com,2005:2105297076', 'Volkswagen Passat variant: ABS, achterbank neerklapbaar, afdekscherm bagageruimte, airbag bestuurder, airbag pas.. http://tinyurl.com/r8eczj', '&lt;b&gt;Volkswagen&lt;/b&gt; Passat variant: ABS, achterbank neerklapbaar, afdekscherm bagageruimte, airbag bestuurder, airbag pas.. &lt;a href=&quot;http://tinyurl.com/r8eczj&quot;&gt;http://tinyurl.com/r8eczj&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/141231800/mijn-kraampje_normal.jpg', 'biedjeprijs', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(261, 1, '2009-06-10 16:44:38', 'tag:search.twitter.com,2005:2105295153', 'Volkswagen Golf: getint glas, gordelspanners, ruitenwisser achter, stuurbekrachtiging, toerenteller, http://tinyurl.com/mlfck8', '&lt;b&gt;Volkswagen&lt;/b&gt; Golf: getint glas, gordelspanners, ruitenwisser achter, stuurbekrachtiging, toerenteller, &lt;a href=&quot;http://tinyurl.com/mlfck8&quot;&gt;http://tinyurl.com/mlfck8&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/141231800/mijn-kraampje_normal.jpg', 'biedjeprijs', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(262, 1, '2009-06-10 16:41:25', 'tag:search.twitter.com,2005:2105257071', 'Para Stuck, da Volkswagen, montadoras deveriam apenas fornecer motores na Fórmula 1 http://migre.me/21dJ #f1', 'Para Stuck, da &lt;b&gt;Volkswagen&lt;/b&gt;, montadoras deveriam apenas fornecer motores na F&Atilde;&sup3;rmula 1 &lt;a href=&quot;http://migre.me/21dJ&quot;&gt;http://migre.me/21dJ&lt;/a&gt; &lt;a href=&quot;http://search.twitter.com/search?q=%23f1&quot;&gt;#f1&lt;/a&gt;', 'http://s3.amazonaws.com/twitter_production/profile_images/204137246/f1brasil_normal.jpg', 'f1brasil', 0, '2009-06-10 13:08:41', '2009-06-10 13:08:41', '"volkswagen"', '"volkswagen"', 'false'),
(277, 2, '2007-04-29 19:20:19', 'http://gdata.youtube.com/feeds/api/videos/WM3BxIOBumk', 'Mal Moore and Dude Hennessy tell CPB stories', 'http://www.youtube.com/v/WM3BxIOBumk&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/WM3BxIOBumk/2.jpg', 'flybama', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(276, 2, '2009-01-23 21:49:12', 'http://gdata.youtube.com/feeds/api/videos/ALbGD3EC780', 'A CPB ish Bday!', 'http://www.youtube.com/v/ALbGD3EC780&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/ALbGD3EC780/2.jpg', 'royalraja30', 0, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(275, 2, '2008-12-08 16:36:25', 'http://gdata.youtube.com/feeds/api/videos/qepYJKMcEvo', 'TIGSource CPB Entries in 10 Minutes', 'http://www.youtube.com/v/qepYJKMcEvo&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/qepYJKMcEvo/2.jpg', 'mrjedidja', 5, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(274, 2, '2007-06-23 15:56:57', 'http://gdata.youtube.com/feeds/api/videos/Z2pZ3MdykjY', 'Ghetto CPB. ghetto gospel mixtap', 'http://www.youtube.com/v/Z2pZ3MdykjY&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/Z2pZ3MdykjY/2.jpg', 'asoe209', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(273, 2, '2007-04-03 10:17:23', 'http://gdata.youtube.com/feeds/api/videos/4AF5tm1nhkk', 'CPB commander paint ball', 'http://www.youtube.com/v/4AF5tm1nhkk&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/4AF5tm1nhkk/2.jpg', 'aivarasltu', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(272, 2, '2008-10-24 14:55:51', 'http://gdata.youtube.com/feeds/api/videos/T4lhSYTpcAg', 'ClubPenguinNews - New Pin + Cp''s B-Day + Meet 11latios10', 'http://www.youtube.com/v/T4lhSYTpcAg&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/T4lhSYTpcAg/2.jpg', 'ClubPenguinNews08', 3, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(271, 2, '2008-09-18 21:37:24', 'http://gdata.youtube.com/feeds/api/videos/G-Fff8FrTno', 'CP''s B''day', 'http://www.youtube.com/v/G-Fff8FrTno&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/G-Fff8FrTno/2.jpg', 'abhinavbana', 5, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(278, 2, '2008-08-27 14:44:40', 'http://gdata.youtube.com/feeds/api/videos/ZEtCjI5Usts', 'CP+B Summer Party', 'http://www.youtube.com/v/ZEtCjI5Usts&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/ZEtCjI5Usts/2.jpg', 'GermanMurillo', 5, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(279, 2, '2008-09-11 20:25:02', 'http://gdata.youtube.com/feeds/api/videos/a-3ZJmzbFL0', 'Campbell Soup Co. (CPB)', 'http://www.youtube.com/v/a-3ZJmzbFL0&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/a-3ZJmzbFL0/2.jpg', 'wallstrip', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(280, 2, '2007-12-08 13:46:32', 'http://gdata.youtube.com/feeds/api/videos/bNFUyMsQr10', 'Nike Plus Long Time Coming CP+B', 'http://www.youtube.com/v/bNFUyMsQr10&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/bNFUyMsQr10/2.jpg', 'inprovev', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(281, 2, '2008-06-17 20:42:17', 'http://gdata.youtube.com/feeds/api/videos/UpTUMUGeR2E', 'CPB Bus', 'http://www.youtube.com/v/UpTUMUGeR2E&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/UpTUMUGeR2E/2.jpg', 'nednimby', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(282, 2, '2008-02-27 19:08:25', 'http://gdata.youtube.com/feeds/api/videos/czJ4-qF2GeI', 'CPB 2008', 'http://www.youtube.com/v/czJ4-qF2GeI&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/czJ4-qF2GeI/2.jpg', 'djavan123456', 0, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(283, 2, '2009-05-03 12:43:57', 'http://gdata.youtube.com/feeds/api/videos/PXyRePkWtDs', 'VARIOUS BANDS SET 3 @ CPB LURGAN 09', 'http://www.youtube.com/v/PXyRePkWtDs&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/PXyRePkWtDs/2.jpg', 'devilkvfb', 5, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(284, 2, '2007-11-01 01:05:42', 'http://gdata.youtube.com/feeds/api/videos/yPqvZDsb2PE', 'Delilah at CP+B', 'http://www.youtube.com/v/yPqvZDsb2PE&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/yPqvZDsb2PE/2.jpg', 'liadotnette', 0, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(285, 2, '2007-08-17 14:39:36', 'http://gdata.youtube.com/feeds/api/videos/5ghbgURF7Zo', 'Sesame Street Credits-08.17.07-WGBH (Read Description)', 'http://www.youtube.com/v/5ghbgURF7Zo&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/5ghbgURF7Zo/2.jpg', 'hkfreak', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(286, 2, '2009-04-14 20:25:38', 'http://gdata.youtube.com/feeds/api/videos/UrewDtV1puA', 'mr internet - episode 6', 'http://www.youtube.com/v/UrewDtV1puA&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/UrewDtV1puA/2.jpg', 'Mrinternet', 5, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(287, 2, '2009-02-06 11:15:51', 'http://gdata.youtube.com/feeds/api/videos/Sz04DCRdlU4', 'Weezer - Buddy Holly', 'http://www.youtube.com/v/Sz04DCRdlU4&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/Sz04DCRdlU4/2.jpg', 'BVMemoTV', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(288, 2, '2009-05-01 20:50:06', 'http://gdata.youtube.com/feeds/api/videos/Sr1O5_EvMRk', 'CPB- Queensday 2009 Curaçao', 'http://www.youtube.com/v/Sr1O5_EvMRk&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/Sr1O5_EvMRk/2.jpg', 'jojosambre', 0, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(289, 2, '2007-10-29 21:22:23', 'http://gdata.youtube.com/feeds/api/videos/Ajvomca7Ejo', 'tepanje na cpb', 'http://www.youtube.com/v/Ajvomca7Ejo&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/Ajvomca7Ejo/2.jpg', 'icokocev', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(290, 2, '2009-05-30 07:18:24', 'http://gdata.youtube.com/feeds/api/videos/cotUD9o-fFs', 'CP Jaguar demo tuned to B. RAWR.', 'http://www.youtube.com/v/cotUD9o-fFs&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/cotUD9o-fFs/2.jpg', 'theonetrueaen', 5, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"cp+b"', '"cp+b"', 'false'),
(291, 2, '2008-06-16 14:13:41', 'http://gdata.youtube.com/feeds/api/videos/zzmLCARa24o', 'New Volkswagen Scirocco Video', 'http://www.youtube.com/v/zzmLCARa24o&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/zzmLCARa24o/2.jpg', 'worldcarfans', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(292, 2, '2009-04-13 21:54:00', 'http://gdata.youtube.com/feeds/api/videos/3MDnn2btjYo', '2010 Volkswagen Golf and GTI', 'http://www.youtube.com/v/3MDnn2btjYo&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/3MDnn2btjYo/2.jpg', 'Carscom', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(293, 2, '2006-07-16 02:34:50', 'http://gdata.youtube.com/feeds/api/videos/OXOrbo6DX9U', 'Volkswagen Big Day', 'http://www.youtube.com/v/OXOrbo6DX9U&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/OXOrbo6DX9U/2.jpg', 'toomuchtv', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(294, 2, '2008-09-25 21:25:54', 'http://gdata.youtube.com/feeds/api/videos/A2M2STh3JT4', '2009 Volkswagen Jetta TDI Full Test', 'http://www.youtube.com/v/A2M2STh3JT4&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/A2M2STh3JT4/2.jpg', 'InsideLineVideo', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(295, 2, '2006-02-23 00:08:41', 'http://gdata.youtube.com/feeds/api/videos/0I0WfnhVs2s', 'Volkswagen: Un-pimp Your Ride III', 'http://www.youtube.com/v/0I0WfnhVs2s&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/0I0WfnhVs2s/2.jpg', 'leftlanenews', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(296, 2, '2006-06-15 12:34:21', 'http://gdata.youtube.com/feeds/api/videos/5_s5-R_JE4c', 'Sunday Afternoon', 'http://www.youtube.com/v/5_s5-R_JE4c&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/5_s5-R_JE4c/2.jpg', 'fluffyq', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(297, 2, '2007-06-21 08:56:02', 'http://gdata.youtube.com/feeds/api/videos/Mg_X_NjQKjg', 'PILOBOLUS - VOLKSWAGEN AD', 'http://www.youtube.com/v/Mg_X_NjQKjg&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/Mg_X_NjQKjg/2.jpg', 'serginho1961', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(298, 2, '2006-04-17 17:02:22', 'http://gdata.youtube.com/feeds/api/videos/wtaXjzQQGE8', 'Volkswagen - Like', 'http://www.youtube.com/v/wtaXjzQQGE8&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/wtaXjzQQGE8/2.jpg', 'fsamuel', 4, '2009-06-10 13:12:24', '2009-06-10 13:12:24', '"volkswagen"', '"volkswagen"', 'false'),
(299, 2, '2007-05-22 14:49:11', 'http://gdata.youtube.com/feeds/api/videos/5U9I7QrpSkk', 'Volkswagen Night Drive Golf Ad', 'http://www.youtube.com/v/5U9I7QrpSkk&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/5U9I7QrpSkk/2.jpg', 'Pompeyman17', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(300, 2, '2005-12-07 14:34:19', 'http://gdata.youtube.com/feeds/api/videos/arfNofxBtfY', 'Banned VW Commercial', 'http://www.youtube.com/v/arfNofxBtfY&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/arfNofxBtfY/2.jpg', 'Sento', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(301, 2, '2008-03-04 16:51:56', 'http://gdata.youtube.com/feeds/api/videos/le4aUAV1fA4', 'New volkswagen.co.uk TV spot', 'http://www.youtube.com/v/le4aUAV1fA4&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/le4aUAV1fA4/2.jpg', 'volkswagensite', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(302, 2, '2007-06-27 18:29:33', 'http://gdata.youtube.com/feeds/api/videos/G4LzG3XZMUA', 'Volkswagen Golf TV Advert with Gene Kelly', 'http://www.youtube.com/v/G4LzG3XZMUA&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/G4LzG3XZMUA/2.jpg', 'sinkaz1986', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(303, 2, '2008-02-20 16:00:38', 'http://gdata.youtube.com/feeds/api/videos/SIeu7_-iwdw', 'Top Gear - car football - Volkswagen Fox vs. Aygo - BBC', 'http://www.youtube.com/v/SIeu7_-iwdw&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/SIeu7_-iwdw/2.jpg', 'BBCWorldwide', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(304, 2, '2006-07-03 08:11:17', 'http://gdata.youtube.com/feeds/api/videos/SJL15n5P9BU', 'Volkswagen DSG Transmission - "Kids on steps" commercial', 'http://www.youtube.com/v/SJL15n5P9BU&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/SJL15n5P9BU/2.jpg', 'trumanium', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(305, 2, '2007-01-31 17:25:34', 'http://gdata.youtube.com/feeds/api/videos/qf5-9SbnKXM', 'Volkswagen Polo ''Angel''', 'http://www.youtube.com/v/qf5-9SbnKXM&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/qf5-9SbnKXM/2.jpg', 'unjustwilliam', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(306, 2, '2008-06-06 01:03:01', 'http://gdata.youtube.com/feeds/api/videos/qxzxbJ2RZ4Y', 'Modified Volkswagen Beetles', 'http://www.youtube.com/v/qxzxbJ2RZ4Y&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/qxzxbJ2RZ4Y/2.jpg', 'badgerbuddy', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(307, 2, '2006-11-24 23:45:48', 'http://gdata.youtube.com/feeds/api/videos/ybrLT7FLUXY', 'Volkswagen Commercial', 'http://www.youtube.com/v/ybrLT7FLUXY&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/ybrLT7FLUXY/2.jpg', 'Milano1975', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(308, 2, '2006-12-06 23:25:47', 'http://gdata.youtube.com/feeds/api/videos/dVMTOPfzDQc', 'Volkswagen Golf R32 - Mk4', 'http://www.youtube.com/v/dVMTOPfzDQc&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/dVMTOPfzDQc/2.jpg', 'loafy81', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false'),
(309, 2, '2006-11-27 15:46:22', 'http://gdata.youtube.com/feeds/api/videos/tjE7jvGt6UA', 'volkswagen polo', 'http://www.youtube.com/v/tjE7jvGt6UA&f=videos&app=youtube_gdata', 'http://i.ytimg.com/vi/tjE7jvGt6UA/2.jpg', 'gomench', 4, '2009-06-10 13:12:25', '2009-06-10 13:12:25', '"volkswagen"', '"volkswagen"', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('dev','inactive','active') NOT NULL DEFAULT 'dev',
  `minSize` int(11) NOT NULL COMMENT '0 denotes no minimum size',
  `maxSize` int(11) NOT NULL COMMENT '0 defines no maximum size',
  `updateType` enum('prependli','appendli','prependdiv','appenddiv','replace','flashjs','js') NOT NULL,
  `updateid` varchar(255) NOT NULL,
  `updateInMinutes` int(11) NOT NULL DEFAULT '0' COMMENT '0 defines no client side refresh',
  `datafeed_id` int(11) NOT NULL,
  `datafeed_tags` varchar(255) NOT NULL,
  `datafeed_tag_restriction` enum('or','and','not') NOT NULL,
  `layout_tag` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `status`, `minSize`, `maxSize`, `updateType`, `updateid`, `updateInMinutes`, `datafeed_id`, `datafeed_tags`, `datafeed_tag_restriction`, `layout_tag`, `created`, `modified`) VALUES
(1, 'twitter', 'dev', 5, 15, 'appenddiv', '1', 5, 1, 'twitter', 'and', 'twitter', '2009-06-02 14:16:12', '2009-06-02 14:16:18'),
(3, 'youtube', 'dev', 5, 15, 'appenddiv', '2', 3, 2, 'youtube', 'not', 'youtube', '2009-06-08 18:53:08', '2009-06-08 18:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `sitelayouts`
--

CREATE TABLE IF NOT EXISTS `sitelayouts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `smallModules` int(11) NOT NULL DEFAULT '0',
  `mediumModules` int(11) NOT NULL DEFAULT '0',
  `largeModules` int(11) NOT NULL DEFAULT '0',
  `extralargeModules` int(11) NOT NULL DEFAULT '0',
  `xmlSource` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('active','disabled') NOT NULL DEFAULT 'disabled',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sitelayouts`
--


-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('client','search') NOT NULL,
  `crawlType` enum('all','sourcelist','none') NOT NULL DEFAULT 'none',
  `datafeed_ids` varchar(255) NOT NULL COMMENT 'Quoted space delimited list of IDs used by crawlType set to sourcelist',
  `status` enum('crawlable','active','disabled') NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `type`, `crawlType`, `datafeed_ids`, `status`, `created`, `modified`) VALUES
(1, 'cp+b', 'client', 'all', '', 'crawlable', '2009-06-02 05:05:30', '2009-06-02 05:05:30'),
(2, 'volkswagen', 'client', 'all', '', 'crawlable', '2009-06-02 05:10:24', '2009-06-02 05:10:24');

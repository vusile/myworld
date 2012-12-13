-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2012 at 01:49 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `mw_activities`
--

CREATE TABLE IF NOT EXISTS `mw_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link_text` varchar(255) NOT NULL,
  `contact_intro` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mw_activities`
--

INSERT INTO `mw_activities` (`id`, `title`, `description`, `link_text`, `contact_intro`) VALUES
(1, 'Career Guidance Talks', '<p>\r\n	We offer career guidance talks to students at Loyola when needed. We use the experience we&#39;ve gained through our work and other activities to advice students on how they can carefully choose their careers. These talks always leave students informed.</p>\r\n', 'I want to give Career Guidance', '<p>\r\n	Hi there. So what would you like to talk about? Please let us know so we can arrange a day for you.</p>\r\n'),
(2, 'Community Service', '<p>\r\n	The LAA organizes Community Service to help those who are less fortunate. We indentify a group that we&#39;d like to help and we visit them, comfort them, play with them and give them the little we have collected.</p>\r\n', 'When is the next Community Service?', ''),
(3, 'Mbuzi Choma', '<p>\r\n	Mbuzi Choma is one of the most popular alumni events. We usually meet, have fun and most importantly, EAT MBUZI CHOMA.</p>\r\n', 'I want Mbuzi Choma :)', ''),
(4, 'Remedial Classes', '<p>\r\n	Are you good at Maths? Are you good at Geography? Well, there are students who struggle to get through these subjects and many more at the school. If you&#39;re good at these subjects, why not take the time to help out those who can&#39;t?&nbsp;</p>\r\n', 'I want to teach', '');

-- --------------------------------------------------------

--
-- Table structure for table `mw_albums`
--

CREATE TABLE IF NOT EXISTS `mw_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `featured_image` varchar(255) NOT NULL,
  `description` text,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mw_albums`
--

INSERT INTO `mw_albums` (`id`, `title`, `featured_image`, `description`, `link`) VALUES
(1, 'The Bagamoyo Seminar', 'thumb__199f-dsc00350.jpg', '<p>\r\n	We had a seminar in bagamoyo.</p>\r\n', '<a target = "_blank" href = "http://localhost/laa/backend/army_images/1">See Images</a>'),
(2, 'Career Guidance Seminar', 'thumb__a10e-ss853300.jpg', '<p>\r\n	We had a career guidance seminar for Loyola students and friends.</p>\r\n', '<a target = "_blank" href = "http://localhost/laa/backend/army_images/2">See Images</a>'),
(9, 'Easter Monday Party', 'thumb__1b19-img_2674.jpg', '<p>\r\n	We met on Easter Monday 2012, to have some nyama choma together. :)</p>\r\n', '<a target = "_blank" href = "http://localhost/laa/backend/army_images/9">See Images</a>');

-- --------------------------------------------------------

--
-- Table structure for table `mw_captcha`
--

CREATE TABLE IF NOT EXISTS `mw_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=337 ;

--
-- Dumping data for table `mw_captcha`
--

INSERT INTO `mw_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(329, 1351863886, '127.0.0.1', '3UST8FD'),
(330, 1351863911, '127.0.0.1', 'WYCSBHX'),
(331, 1351863915, '127.0.0.1', 'FDNKBY2'),
(332, 1351863971, '127.0.0.1', 'BKMNGZE'),
(333, 1351864463, '127.0.0.1', 'BQ6ZH3D'),
(334, 1351864480, '127.0.0.1', 'JYRD8HS'),
(335, 1353926856, '127.0.0.1', '3QKNUWF'),
(336, 1354025475, '127.0.0.1', '4UK9TNM');

-- --------------------------------------------------------

--
-- Table structure for table `mw_company_sectors`
--

CREATE TABLE IF NOT EXISTS `mw_company_sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mw_company_sectors`
--

INSERT INTO `mw_company_sectors` (`id`, `title`) VALUES
(1, 'Social Development'),
(2, 'Agriculture / Food'),
(3, 'Skills Development'),
(4, 'Other...'),
(5, 'Commercial Enterprise');

-- --------------------------------------------------------

--
-- Table structure for table `mw_company_types`
--

CREATE TABLE IF NOT EXISTS `mw_company_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mw_company_types`
--

INSERT INTO `mw_company_types` (`id`, `title`) VALUES
(1, 'Corporate'),
(2, 'NGO'),
(3, 'Company'),
(5, 'SMME'),
(6, 'NPO / NGO');

-- --------------------------------------------------------

--
-- Table structure for table `mw_directory`
--

CREATE TABLE IF NOT EXISTS `mw_directory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `company_type` int(11) NOT NULL,
  `sector` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mw_directory`
--

INSERT INTO `mw_directory` (`id`, `company_name`, `website`, `logo`, `company_type`, `sector`, `city`, `country`, `phone`) VALUES
(1, 'Swahili Music Notes', 'http://www.swahilimusicsheet.com', '9f51f-Penguins.jpg', 5, 4, 'Dar es Salaam', 'Tanzania', '+255 715 556 327'),
(2, 'ZoomTanzania.com', NULL, NULL, 3, 4, 'Dar es Salaam', 'Tanzania', '+255 784 123 456');

-- --------------------------------------------------------

--
-- Table structure for table `mw_groups`
--

CREATE TABLE IF NOT EXISTS `mw_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mw_groups`
--

INSERT INTO `mw_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `mw_home`
--

CREATE TABLE IF NOT EXISTS `mw_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `link_text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mw_home`
--

INSERT INTO `mw_home` (`id`, `title`, `description`, `image`, `link`, `link_text`) VALUES
(1, 'About Us', '<p>\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; ">The Singing Army - &quot;Jeshi la Uimbaji&quot; In Kiswahili. We are 4 dedicated soldiers of Christ - our main task is singing, singing, and singing again - and again.</span></p>\r\n', '43fb3-singing-army-niacheni-niimbe.jpg', 'about-us', 'Read More');

-- --------------------------------------------------------

--
-- Table structure for table `mw_images`
--

CREATE TABLE IF NOT EXISTS `mw_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `album` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `album` (`album`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `mw_images`
--

INSERT INTO `mw_images` (`id`, `image`, `title`, `album`, `priority`) VALUES
(45, '6ed6-dsc00185.jpg', 'Sharing.', 1, 8),
(46, '7045-dsc00079.jpg', 'Group Photo', 1, 2),
(47, '9381-dsc00207.jpg', 'Facilitator ', 1, 4),
(48, '199f-dsc00350.jpg', 'A group photo  at Msalabani.', 1, 1),
(49, '002a-dsc00240.jpg', 'Participants!', 1, 3),
(50, '48aa-dsc00425.jpg', 'Light moments', 1, 7),
(51, '633a-dsc00441.jpg', 'Chilling :)', 1, 6),
(52, '66d9-dsc00481.jpg', 'Participants receiving certificates', 1, 5),
(53, 'dabd-ss853235.jpg', '', 2, 2),
(54, 'e83b-ss853232.jpg', '', 2, 19),
(55, '07e7-ss853234.jpg', '', 2, 18),
(56, 'cd3c-ss853236.jpg', '', 2, 17),
(57, 'f5a5-ss853237.jpg', '', 2, 16),
(58, '67e8-ss853239.jpg', '', 2, 15),
(59, 'd38b-ss853243.jpg', '', 2, 14),
(60, 'e23b-ss853242.jpg', '', 2, 13),
(61, '75ec-ss853244.jpg', '', 2, 12),
(62, 'c946-ss853245.jpg', '', 2, 11),
(63, 'd0a0-ss853256.jpg', '', 2, 10),
(64, '62c2-ss853262.jpg', '', 2, 9),
(65, '0a4b-ss853263.jpg', '', 2, 8),
(66, '36e1-ss853268.jpg', '', 2, 7),
(67, 'be1c-ss853278.jpg', '', 2, 6),
(68, '9d65-ss853279.jpg', '', 2, 5),
(69, 'b408-ss853288.jpg', '', 2, 4),
(70, '0aa1-ss853296.jpg', '', 2, 3),
(71, 'a10e-ss853300.jpg', '', 2, 1),
(72, '82af-img_2651.jpg', '', 9, 1),
(73, '9032-img_2645.jpg', '', 9, 14),
(74, 'bad3-img_2652.jpg', '', 9, 15),
(75, '9ab8-img_2658.jpg', '', 9, 16),
(76, 'ac00-img_2657.jpg', '', 9, 17),
(77, 'a531-img_2659.jpg', '', 9, 18),
(78, '4e67-img_2661.jpg', '', 9, 19),
(79, '8b8b-img_2662.jpg', '', 9, 20),
(80, '70bf-img_2663.jpg', '', 9, 21),
(81, 'e3fa-img_2667.jpg', '', 9, 22),
(82, '23fa-img_2668.jpg', '', 9, 23),
(83, 'b046-img_2669.jpg', '', 9, 13),
(84, '4a64-img_2670.jpg', '', 9, 12),
(85, '8c9f-img_2671.jpg', '', 9, 2),
(86, 'f777-img_2672.jpg', '', 9, 3),
(87, '1b19-img_2674.jpg', '', 9, 4),
(88, '16a4-img_2678.jpg', '', 9, 5),
(89, 'c87e-img_2681.jpg', '', 9, 6),
(90, '2eca-img_2683.jpg', '', 9, 7),
(91, '4e87-img_2684.jpg', '', 9, 8),
(92, 'bbb8-img_2685.jpg', '', 9, 9),
(93, '67ab-img_2688.jpg', '', 9, 10),
(94, 'ad0e-img_2686.jpg', '', 9, 11),
(95, '7299-img_2687.jpg', '', 9, 24);

-- --------------------------------------------------------

--
-- Table structure for table `mw_image_scroller`
--

CREATE TABLE IF NOT EXISTS `mw_image_scroller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mw_image_scroller`
--

INSERT INTO `mw_image_scroller` (`id`, `photo`, `caption`, `url`) VALUES
(5, '08db3-Koala.jpg', 'Koala Dude', NULL),
(6, '06ae1-Penguins.jpg', 'The Dancing Penguins Dancing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mw_login_attempts`
--

CREATE TABLE IF NOT EXISTS `mw_login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mw_news`
--

CREATE TABLE IF NOT EXISTS `mw_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumb_nail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mw_news`
--

INSERT INTO `mw_news` (`id`, `title`, `text`, `date`, `url`, `thumb_nail`) VALUES
(5, 'We''ve launched our website', '<p>\r\n	<img alt="" src="/myworld/ckfinder/userfiles/images/Penguins.jpg" style="width: 300px; height: 225px; float: left;" />Hello, we&#39;ve just launched our new website.</p>\r\n', '2012-11-29', 'we-have-launched-our-new-website', 'Penguins.jpg'),
(6, 'This is Test News # 2', '<p>\r\n	&quot;Twice.&quot; &quot;But could not fasten?&quot; &quot;Didnt want to try to: ain&#39;t one limb enough? What should I do without this other arm? And I&#39;m thinking Moby Dick doesn&#39;t bite so much as he swallows.&quot; &quot;Well, then,&quot; interrupted Bunger, &quot;give him your left arm for bait to get the right. Do you know, gentlemen&quot;&mdash;very gravely and mathematically bowing to each Captain in succession&mdash;&quot;Do you know, gentlemen, that the digestive organs of the whale are so inscrutably constructed by Divine Providence, that it is quite impossible for him to completely digest even a man&#39;s arm? And he knows it too.</p>\r\n<p>\r\n	<img alt="" src="/myworld/ckfinder/userfiles/images/Hydrangeas.jpg" style="width: 200px; height: 150px; float: left;" />So that what you take for the White Whale&#39;s malice is only his awkwardness. For he never means to swallow a single limb; he only thinks to terrify by feints. But sometimes he is like the old juggling fellow, formerly a patient of mine in Ceylon, that making believe swallow jack-knives, once upon a time let one drop into him in good earnest, and there it stayed for a twelvemonth or more; when I gave him an emetic, and he heaved it up in small tacks, d&#39;ye see. No possible way for him to digest that jack-knife, and fully incorporate it into his general bodily system.&nbsp;</p>\r\n', '2012-11-29', 'this-is-a-test-news', 'Hydrangeas.jpg'),
(7, 'Oh yeah, test', '<p>\r\n	<img alt="" src="/myworld/ckfinder/userfiles/images/Koala.jpg" style="width: 200px; height: 150px; float: right;" />The colonel launched a volley of oaths, denouncing the railway company and the conductor; and Passepartout, who was furious, was not disinclined to make common cause with him. Here was an obstacle, indeed, which all his master&#39;s banknotes could not remove.</p>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	There was a general disappointment among the passengers, who, without reckoning the delay, saw themselves compelled to trudge fifteen miles over a plain covered with snow. They grumbled and protested, and would certainly have thus attracted Phileas Fogg&#39;s attention if he had not been completely absorbed in his game.</div>\r\n<div>\r\n	Passepartout found that he could not avoid telling his master what had occurred, and, with hanging head, he was turning towards the car, when the engineer, a true Yankee, named Forster called out, &quot;Gentlemen, perhaps there is a way, after all, to get over.&quot;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&quot;On the bridge?&quot; asked a passenger.</div>\r\n<div>\r\n	&quot;On the bridge.&quot;</div>\r\n<div>\r\n	&quot;With our train?&quot;</div>\r\n<div>\r\n	&quot;With our train.&quot;</div>\r\n<div>\r\n	<div class="media_embed" style="text-align: center; ">\r\n		<iframe allowfullscreen="" frameborder="0" height="315" scrolling="no" src="http://www.youtube.com/embed/0zPcR7wgh0c?rel=0" width="560"></iframe></div>\r\n</div>\r\n<div>\r\n	Passepartout stopped short, and eagerly listened to the engineer.</div>\r\n<div>\r\n	&quot;But the bridge is unsafe,&quot; urged the conductor.</div>\r\n<div>\r\n	&quot;No matter,&quot; replied Forster; &quot;I think that by putting on the very highest speed we might have a chance of getting over.&quot;</div>\r\n', '2012-11-29', 'oh-yeah-test', 'Koala.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mw_newsletters`
--

CREATE TABLE IF NOT EXISTS `mw_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_subject` varchar(255) NOT NULL,
  `news_articles` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mw_newsletters`
--

INSERT INTO `mw_newsletters` (`id`, `newsletter_subject`, `news_articles`, `url`, `identifier`) VALUES
(1, 'The First Newsletter', '', 'http://localhost/nipe_fagio/nl/the-first-newsletter', 'the-first-newsletter');

-- --------------------------------------------------------

--
-- Table structure for table `mw_newsletter_news`
--

CREATE TABLE IF NOT EXISTS `mw_newsletter_news` (
  `news_id` int(11) NOT NULL,
  `newsletter_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mw_newsletter_news`
--

INSERT INTO `mw_newsletter_news` (`news_id`, `newsletter_id`, `priority`) VALUES
(7, 1, 0),
(6, 1, 1),
(5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mw_options`
--

CREATE TABLE IF NOT EXISTS `mw_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mw_options`
--

INSERT INTO `mw_options` (`id`, `title`) VALUES
(1, 'Yes'),
(2, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `mw_pages`
--

CREATE TABLE IF NOT EXISTS `mw_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `thumb_nail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mw_pages`
--

INSERT INTO `mw_pages` (`id`, `title`, `text`, `identifier`, `thumb_nail`) VALUES
(1, 'About Nipe Fagio', '<p>\r\n	<img alt="" src="/ckfinder/userfiles/images/logo.png" style="width: 206px; height: 224px; float: left; " />While still warm, the oil, like hot punch, is received into the six-barrel casks; and while, perhaps, the ship is pitching and rolling this way and that in the midnight sea, the enormous casks are slewed round and headed over, end for end, and sometimes perilously scoot across the slippery deck, like so many land slides, till at last man-handled and stayed in their course; and all round the hoops, rap, rap, go as many hammers as can play upon them, for now, EX OFFICIO, every sailor is a cooper.</p>\r\n<p>\r\n	At length, when the last pint is casked, and all is cool, then the great hatchways are unsealed, the bowels of the ship are thrown open, and down go the casks to their final rest in the sea. This done, the hatches are replaced, and hermetically closed, like a closet walled up. In the sperm fishery, this is perhaps one of the most remarkable incidents in all the business of whaling.</p>\r\n<p>\r\n	One day the planks stream with freshets of blood and oil; on the sacred quarter-deck enormous masses of the whale&#39;s head are profanely piled; great rusty casks lie about, as in a brewery yard; the smoke from the try-works has besooted all the bulwarks; the mariners go about suffused with unctuousness; the entire ship seems great leviathan himself; while on all hands the din is deafening.</p>\r\n<p>\r\n	But a day or two after, you look about you, and prick your ears in this self-same ship; and were it not for the tell-tale boats and try-works, you would all but swear you trod some silent merchant vessel, with a most scrupulously neat commander. The unmanufactured sperm oil possesses a singularly cleansing virtue. This is the reason why the decks never look so white as just after what they call an affair of oil. Besides, from the ashes of the burned scraps of the whale, a potent lye is readily made; and whenever any adhesiveness from the back of the whale remains clinging to the side, that lye quickly exterminates it. Hands go diligently along the bulwarks, and with buckets of water and rags restore them to their full tidiness.</p>\r\n<p>\r\n	The soot is brushed from the lower rigging. All the numerous implements which have been in use are likewise faithfully cleansed and put away. The great hatch is scrubbed and placed upon the try-works, completely hiding the pots; every cask is out of sight; all tackles are coiled in unseen nooks; and when by the combined and simultaneous industry of almost the entire ship&#39;s company, the whole of this conscientious duty is at last concluded, then the crew themselves proceed to their own ablutions; shift themselves from top to toe; and finally issue to the immaculate deck, fresh and all aglow, as bridegrooms new-leaped from out the daintiest Holland.</p>\r\n<div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'ABOUT', NULL),
(2, 'Contact Nipe Fagio', '<p>\r\n	<span style="color: rgb(51, 51, 51); font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; ">We value your feedback, please say hello!</span></p>\r\n', 'CONTACT', NULL),
(6, 'Message Has Been Sent', '<p>\r\n	Your Message has been sent, we&#39;ll respond to you as soon as possible</p>\r\n', 'MESSAGE_SENT', NULL),
(7, 'Home', '<p>\r\n	Under this head I reckon a monster which, by the various names of Fin-Back, Tall-Spout, and Long-John, has been seen almost in every sea and is commonly the whale whose distant jet is so often descried by passengers crossing the Atlantic, in the New York packet-tracks. In the length he attains, and in his baleen, the Fin-back resembles the right whale, but is of a less portly girth, and a lighter colour, approaching to olive.</p>\r\n', 'HOME', NULL),
(8, 'The Nipe Fagio Team', '<p>\r\n	Don&#39;t we have the best team.</p>\r\n', 'TEAM', '');

-- --------------------------------------------------------

--
-- Table structure for table `mw_projects`
--

CREATE TABLE IF NOT EXISTS `mw_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `featured` int(11) DEFAULT '2',
  `thumb_nail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mw_projects`
--

INSERT INTO `mw_projects` (`id`, `title`, `text`, `url`, `category`, `featured`, `thumb_nail`) VALUES
(1, 'Test Project', '<p>\r\n	<img alt="" src="/nipe_fagio/ckfinder/userfiles/images/Koala.jpg" style="width: 400px; height: 300px; float: left;" /></p>\r\n<div>\r\n	Mr. Fogg and Aouda descended into the cabin at midnight, having been already preceded by Fix, who had lain down on one of the cots. The pilot and crew remained on deck all night.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	At sunrise the next day, which was 8th November, the boat had made more than one hundred miles. The log indicated a mean speed of between eight and nine miles. The Tankadere still carried all sail, and was accomplishing her greatest capacity of speed. If the wind held as it was, the chances would be in her favour. During the day she kept along the coast, where the currents were favourable; the coast, irregular in profile, and visible sometimes across the clearings, was at most five miles distant. The sea was less boisterous, since the wind came off land&mdash;a fortunate circumstance for the boat, which would suffer, owing to its small tonnage, by a heavy surge on the sea.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	The breeze subsided a little towards noon, and set in from the south-west. The pilot put up his poles, but took them down again within two hours, as the wind freshened up anew.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Mr. Fogg and Aouda, happily unaffected by the roughness of the sea, ate with a good appetite, Fix being invited to share their repast, which he accepted with secret chagrin. To travel at this man&#39;s expense and live upon his provisions was not palatable to him. Still, he was obliged to eat, and so he ate.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	When the meal was over, he took Mr. Fogg apart, and said, &quot;sir&quot;&mdash;this &quot;sir&quot; scorched his lips, and he had to control himself to avoid collaring this &quot;gentleman&quot;&mdash;&quot;sir, you have been very kind to give me a passage on this boat. But, though my means will not admit of my expending them as freely as you, I must ask to pay my share&mdash;&quot;</div>\r\n<div>\r\n	&quot;Let us not speak of that, sir,&quot; replied Mr. Fogg.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&quot;But, if I insist&mdash;&quot;</div>\r\n<div>\r\n	&quot;No, sir,&quot; repeated Mr. Fogg, in a tone which did not admit of a reply. &quot;This enters into my general expenses.&quot;</div>\r\n<div>\r\n	Fix, as he bowed, had a stifled feeling, and, going forward, where he ensconced himself, did not open his mouth for the rest of the day.</div>\r\n<div>\r\n	Meanwhile they were progressing famously, and John Bunsby was in high hope. He several times assured Mr. Fogg that they would reach Shanghai in time; to which that gentleman responded that he counted upon it. The crew set to work in good earnest, inspired by the reward to be gained. There was not a sheet which was not tightened not a sail which was not vigorously hoisted; not a lurch could be charged to the man at the helm. They worked as desperately as if they were contesting in a Royal yacht regatta.</div>\r\n', 'test-project', 1, 1, 'Koala.jpg'),
(2, 'This is a test project number 5', '<p>\r\n	Test project number 5</p>\r\n', 'this-is-a-test-project-number-5', 2, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mw_projects_and_publications`
--

CREATE TABLE IF NOT EXISTS `mw_projects_and_publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_category` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mw_projects_and_publications`
--

INSERT INTO `mw_projects_and_publications` (`id`, `title`, `url`, `parent_category`, `section`, `link`) VALUES
(1, 'Projects Category 1', 'project-title-1', '', 1, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_projects/1">Projects</a>'),
(2, 'Projects Category 2', 'project-title-2', '1', 1, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_projects/2">Projects</a>'),
(3, 'Projects Category 3', 'project-title-3', '1', 1, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_projects/3">Projects</a>'),
(4, 'Publications Category 4', 'publication-title-4', '', 2, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_publications/4">Publications</a>'),
(5, 'Projects Category 5', 'project-title-5', '1', 1, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_projects/5">Projects</a>'),
(6, 'Projects Category 6', 'project-title-6', '', 1, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_projects/6">Projects</a>'),
(8, 'Test Category 2', 'test-category-2', '', 1, '<a target = "_blank" href = "http://localhost/nipe_fagio/backend/mw_projects/8">Projects</a>');

-- --------------------------------------------------------

--
-- Table structure for table `mw_publications`
--

CREATE TABLE IF NOT EXISTS `mw_publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `category` int(11) NOT NULL,
  `publication_file` varchar(255) NOT NULL,
  `thumb_nail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mw_publications`
--

INSERT INTO `mw_publications` (`id`, `title`, `description`, `category`, `publication_file`, `thumb_nail`) VALUES
(1, 'This is a Publication', '<p>\r\n	This is random introductory text</p>\r\n', 4, '', NULL),
(2, 'This is a test publication', '<p>\r\n	This is a test publicatioln oh yeah.</p>\r\n', 4, '3225e-test.pdf', NULL),
(3, 'Another Test Publication', '<p>\r\n	adfafaf</p>\r\n', 4, '7f6d6-test.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mw_sections`
--

CREATE TABLE IF NOT EXISTS `mw_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mw_settings`
--

CREATE TABLE IF NOT EXISTS `mw_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mw_settings`
--

INSERT INTO `mw_settings` (`id`, `setting`, `value`) VALUES
(1, 'My World Pre School Prezi Video', 'http://www.youtube.com/watch?v=m1-pHdcMCK8');

-- --------------------------------------------------------

--
-- Table structure for table `mw_team`
--

CREATE TABLE IF NOT EXISTS `mw_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `position_or_title` varchar(255) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mw_team`
--

INSERT INTO `mw_team` (`id`, `name`, `photo`, `position_or_title`, `info`) VALUES
(1, 'Team Member 1', '737b7-ChrysanthemumLR.jpg', 'Team Leader', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget magna elit. Pellentesque eget risus sit amet mi rhoncus pharetra et quis lorem. Maecenas at scelerisque diam. Pellentesque egestas purus ut nunc facilisis non lacinia turpis pretium. Fusce a arcu eleifend massa venenatis egestas ut ut neque. Vivamus eu sagittis urna. Praesent et faucibus libero. Curabitur nec est vitae diam posuere malesuada non et arcu. Nam vulputate mauris quis est adipiscing sit amet fermentum orci luctus. Nulla non dolor tortor.</p>\r\n'),
(2, 'The Penguin', '31c03-Koala.jpg', 'Penguin Guy', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget magna elit. Pellentesque eget risus sit amet mi rhoncus pharetra et quis lorem. Maecenas at scelerisque diam. Pellentesque egestas purus ut nunc facilisis non lacinia turpis pretium. Fusce a arcu eleifend massa venenatis egestas ut ut neque. Vivamus eu sagittis urna. Praesent et faucibus libero. Curabitur nec est vitae diam posuere malesuada non et arcu. Nam vulputate mauris quis est adipiscing sit amet fermentum orci luctus. Nulla non dolor tortor.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mw_users`
--

CREATE TABLE IF NOT EXISTS `mw_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mw_users`
--

INSERT INTO `mw_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1354188456, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '\0\0', 'anton.fouquet@djpa.co.tz', 'ded126212466ac57fea9c2dbab79f42acaa5670b', NULL, 'anton.fouquet@djpa.co.tz', NULL, NULL, NULL, NULL, 1351672322, 1351672358, 1, 'Anton', 'Fouquet', NULL, '+255 753 102 000'),
(3, '\0\0', 'anton2.fouquet@djpa.co.tz', '5ef2cc5b647649523f749a4da095c1a5e3fdae46', NULL, 'anton2.fouquet@djpa.co.tz', NULL, NULL, NULL, NULL, 1353495312, 1353495312, 1, 'Anton', 'Fouquet', NULL, '+255 753 102 000'),
(4, '\0\0', 'anton23.fouquet@djpa.co.tz', '7e06f410a1f61449a70e041e0284265df154924a', NULL, 'anton23.fouquet@djpa.co.tz', NULL, NULL, NULL, NULL, 1353495348, 1353495348, 1, 'Anton', 'Fouquet', NULL, '+255 753 102 000');

-- --------------------------------------------------------

--
-- Table structure for table `mw_users_groups`
--

CREATE TABLE IF NOT EXISTS `mw_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mw_users_groups`
--

INSERT INTO `mw_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mw_images`
--
ALTER TABLE `mw_images`
  ADD CONSTRAINT `mw_images_ibfk_1` FOREIGN KEY (`album`) REFERENCES `mw_albums` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

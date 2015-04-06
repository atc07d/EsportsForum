-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2015 at 03:29 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `messageboard`
--
CREATE DATABASE IF NOT EXISTS `messageboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `messageboard`;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `a_id` int(10) NOT NULL,
  `a_asker` varchar(255) NOT NULL,
  `a_topic` int(10) NOT NULL,
  `a_content` text NOT NULL,
  `a_rating` int(10) NOT NULL,
`a_order` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`a_id`, `a_asker`, `a_topic`, `a_content`, `a_rating`, `a_order`) VALUES
(11, 'thewoz', 0, 'This is the first answer with the new form.', 1, 84),
(11, 'thewoz', 0, 'One more time.', 0, 85),
(10, 'wgates', 0, 'This is B Gates reporting in', 5, 86),
(8, 'wgates', 0, 'Because they are...duh', 0, 87),
(8, 'thewoz', 0, 'Nah uh. You are biased and you stink.', 0, 88),
(8, 'wgates', 0, 'Can we please stay on topic.', 7, 89),
(12, 'wgates', 0, 'Your critique is absolutely correct. Purple is a girly color and not a color for royalty...', 1, 90);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`q_id` int(10) NOT NULL,
  `q_asker` varchar(255) NOT NULL,
  `q_title` varchar(255) NOT NULL,
  `q_content` text NOT NULL,
  `q_type` varchar(255) NOT NULL,
  `q_value` int(10) NOT NULL DEFAULT '0',
  `q_tags` text
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`q_id`, `q_asker`, `q_title`, `q_content`, `q_type`, `q_value`, `q_tags`) VALUES
(8, 'thewoz', 'Scissors OP?!?!?', 'Test TEST TEST', 'D3', 5, NULL),
(9, 'thewoz', 'Why I love my Warrior.', 'WHY THAT LOL TEST', 'WoW', 4, NULL),
(10, 'pallen', 'BeyondTheSummit Rocks', 'They cast so well cause they use da big words.!!!!', 'DoTA2', 3, NULL),
(11, 'tblee', 'Twitch needs competition.', 'It really does. This is getting lame. T', 'D3', 2, NULL),
(12, 'tblee', 'TV sucks', 'Socialism is a social and economic system characterised by social ownership of the means of production and co-operative management of the economy,[1][2] as well as a political theory and movement that aims at the establishment of such a system.[3][4] "Social ownership" may refer to cooperative enterprises, common ownership, state ownership, citizen ownership of equity, or any combination of these.[5] There are many varieties of socialism and there is no single definition encapsulating all of them', 'CSGO', 1, NULL),
(14, 'dknuth', 'Twitch throttling', 'This aint no fun. Thanks Verizon?!?!?', 'D3', 0, NULL),
(15, 'dknuth', 'Alternate streaming sites', 'Check it\r\nhttp://www.reddit.com/r/speedrun/comments/1r4qds/what_are_some_good_alternatives_to_twitch_for/', 'D3', 0, NULL),
(20, 'adam', 'Season 3 crusader', 'OP am rite?', 'D3', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `t_id` int(10) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`t_id`, `t_name`, `t_description`) VALUES
(0, 'D3', 'Diablo 3'),
(1, 'WoW', 'World of Warcraft'),
(2, 'LoL', 'League of Legends'),
(3, 'DoTA2', 'Defense of the Ancients 2'),
(4, 'CSGO', 'Counter-Strike:Global Offensive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pw` varchar(255) NOT NULL,
  `user_date` date NOT NULL,
  `user_avatar` blob NOT NULL,
  `user_score` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pw`, `user_date`, `user_avatar`, `user_score`) VALUES
(0, 'pallen', 'm$ftw', '2015-02-08', '', 3),
(1, 'tblee', '0mGth3WeB!', '2015-02-08', '', 3),
(2, 'bourne', 'bash_$', '2015-02-08', '', 0),
(3, 'edsger', 'st1ll1l11lG0O2', '2015-02-08', '', 0),
(4, 'wgates', '5il3M4X_m$4L', '2015-02-08', '', 0),
(5, 'hopper', 'im4usn', '2015-02-08', '', 0),
(6, 'dknuth', 'tek!tex', '2015-02-08', '', 0),
(7, 'ada', 'wtf15b4b', '2015-02-08', '', 0),
(8, 'cmoore', 'moreM00R3!', '2015-02-08', '', 0),
(9, 'jresig', 'In0JS', '2015-02-08', '', 0),
(10, 'atanen', 'minix!minix', '2015-02-08', '', 0),
(11, 'linus', 'ilUvP3nGu1n5', '2015-02-08', '', 0),
(12, 'aturing', '1nfin1t3TAp3', '2015-02-08', '', 0),
(13, 'thewoz', '4daK1d5', '2015-02-08', '', 9),
(14, 'lwall', 'oysters&camels', '2015-02-08', '', 0),
(15, 'adam', 'ant', '0000-00-00', '', 0),
(16, 'ADMINISTRATOR', 'admin', '0000-00-00', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`a_order`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
 ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `a_order` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `q_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2015 at 04:06 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `messageboard`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`a_id`, `a_asker`, `a_topic`, `a_content`, `a_rating`, `a_order`) VALUES
(0, 'tblee', 0, 'hkjhdjkashdjkas hdjkasdhjkashdjklas ahdjhasl ', 1, 54),
(0, 'thewoz', 0, '', 1, 55);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`q_id` int(10) NOT NULL,
  `q_asker` varchar(255) NOT NULL,
  `q_title` varchar(255) NOT NULL,
  `q_content` text NOT NULL,
  `q_type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`q_id`, `q_asker`, `q_title`, `q_content`, `q_type`) VALUES
(8, 'thewoz', 'Scissors OP?!?!?', 'I think scissors are OP.\r\n\r\n~Paper', 'D3'),
(9, 'thewoz', 'Why I love my Warrior.', 'They are so strong and handsome.', 'WoW'),
(10, 'pallen', 'BeyondTheSummit Rocks', 'They cast so well cause they use da big words.', 'DoTA2'),
(11, 'tblee', 'Twitch needs competition.', 'It really does. This is getting lame. T', 'D3'),
(12, 'tblee', 'TV sucks', 'Socialism is a social and economic system characterised by social ownership of the means of production and co-operative management of the economy,[1][2] as well as a political theory and movement that aims at the establishment of such a system.[3][4] "Social ownership" may refer to cooperative enterprises, common ownership, state ownership, citizen ownership of equity, or any combination of these.[5] There are many varieties of socialism and there is no single definition encapsulating all of them', 'CSGO'),
(14, 'dknuth', 'Twitch throttling', 'This aint no fun. Thanks Verizon?!?!?', 'D3'),
(15, 'dknuth', 'Alternate streaming sites', 'Check it\r\nhttp://www.reddit.com/r/speedrun/comments/1r4qds/what_are_some_good_alternatives_to_twitch_for/', 'D3'),
(16, 'atanen', 'DreamHack Winter', 'Anyone watching this year?!??!', 'CSGO'),
(17, 'atanen', 'Blizzcon Arena Predictions', 'Cdew all the way.', 'WoW'),
(18, 'wgates', 'Spring LCS has started!', 'Yeah ok cool\r\ndsada\r\ndasdas\r\ndasdas\r\ndasda', 'LoL');

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
  `user_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pw`, `user_date`) VALUES
(0, 'pallen', 'm$ftw', '2015-02-08'),
(1, 'tblee', '0mGth3WeB!', '2015-02-08'),
(2, 'bourne', 'bash_$', '2015-02-08'),
(3, 'edsger', 'st1ll1l11lG0O2', '2015-02-08'),
(4, 'wgates', '5il3M4X_m$4L', '2015-02-08'),
(5, 'hopper', 'im4usn', '2015-02-08'),
(6, 'dknuth', 'tek!tex', '2015-02-08'),
(7, 'ada', 'wtf15b4b', '2015-02-08'),
(8, 'cmoore', 'moreM00R3!', '2015-02-08'),
(9, 'jresig', 'In0JS', '2015-02-08'),
(10, 'atanen', 'minix!minix', '2015-02-08'),
(11, 'linus', 'ilUvP3nGu1n5', '2015-02-08'),
(12, 'aturing', '1nfin1t3TAp3', '2015-02-08'),
(13, 'thewoz', '4daK1d5', '2015-02-08'),
(14, 'lwall', 'oysters&camels', '2015-02-08');

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
MODIFY `a_order` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `q_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 03:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crimeleon2`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empNo` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `licensed_idno` varchar(255) NOT NULL,
  `badge_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empNo`, `firstname`, `middlename`, `lastname`, `address`, `contact`, `licensed_idno`, `badge_no`) VALUES
(2, 'Daniel', 'Glory', 'Demaala', 'Tapaz, Capiz', '09291577708', 'PNP172839', '1116'),
(5, 'Daniel', 'Police', 'Demaala', 'Tapaz', '09922131091', 'PNP6679656', '4567'),
(6, 'Daniel', 'Investigator', 'Demaala', 'Capiz', '0992277216', 'PNP304667', '1162'),
(7, 'Brittany Claire', 'Bayo-ang', 'Landero', 'Burgos St., La Paz', '09060646478', 'PNP12345', '1234'),
(15, 'Deniel', 'Domingo', 'Betia ', 'Calinog, Iloilo', '0912312312', 'PNP12345', '2131'),
(83, 'Clethjude', 'Gabucay', 'Arguelles', 'Iloilo', '0921312312', 'PNP1223', '12345'),
(87, 'Admin', '', 'Admin', 'Iloilo City', '09123213123', 'PNP2131', 'PNP1231'),
(88, 'asdas', 'asdsa', 'dsada', 'asdas', 'asdas', 'asdas', 'asdas'),
(90, 'QQQ', 'QQQ', 'QQQ', 'QQQ', 'QQQ', 'QQQ', 'QQQ'),
(95, 'Jynel', 'Galicto', 'Gelilang', 'Tapaz, Capiz', '091299109211', 'PNP01921', '1021');

-- --------------------------------------------------------

--
-- Table structure for table `item_a`
--

CREATE TABLE `item_a` (
  `rpNo` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `repID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_a`
--

INSERT INTO `item_a` (`rpNo`, `personID`, `repID`) VALUES
(30, 33, 48),
(31, 73, 49),
(32, 84, 50),
(34, 84, 52),
(35, 84, 53),
(36, 74, 54),
(37, 74, 55),
(38, 74, 56),
(39, 74, 57),
(40, 33, 58),
(41, 33, 59),
(42, 84, 60),
(43, 84, 61),
(94, 33, 114),
(95, 33, 115),
(96, 33, 116),
(97, 33, 117),
(98, 33, 118),
(104, 33, 124),
(105, 73, 125),
(106, 127, 126),
(107, 84, 127),
(108, 84, 128),
(109, 84, 129),
(110, 84, 130),
(111, 84, 131),
(112, 33, 132),
(113, 33, 133),
(117, 132, 137),
(118, 133, 138),
(119, 93, 139),
(120, 33, 140),
(121, 93, 141),
(122, 93, 142),
(123, 33, 143),
(126, 135, 146),
(127, 135, 147),
(128, 33, 148),
(129, 33, 149),
(130, 73, 150),
(131, 73, 151),
(132, 73, 152),
(133, 73, 153),
(134, 73, 154),
(135, 73, 155),
(136, 93, 156),
(137, 93, 157);

-- --------------------------------------------------------

--
-- Table structure for table `item_b`
--

CREATE TABLE `item_b` (
  `sdNo` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `repID` int(11) NOT NULL,
  `sRank` varchar(255) DEFAULT NULL,
  `sAssign` varchar(255) DEFAULT NULL,
  `sAffiliation` varchar(255) DEFAULT NULL,
  `sCrimRecord` varchar(255) DEFAULT NULL,
  `sStatus` varchar(255) DEFAULT NULL,
  `Height` varchar(255) DEFAULT NULL,
  `Weight` varchar(255) DEFAULT NULL,
  `eyeColor` varchar(255) DEFAULT NULL,
  `eyeDesc` varchar(255) DEFAULT NULL,
  `hairColor` varchar(255) DEFAULT NULL,
  `hairDesc` varchar(255) DEFAULT NULL,
  `sInfluence` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `g_address` varchar(255) DEFAULT NULL,
  `ghome_phone` varchar(255) DEFAULT NULL,
  `gmob_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_b`
--

INSERT INTO `item_b` (`sdNo`, `personID`, `repID`, `sRank`, `sAssign`, `sAffiliation`, `sCrimRecord`, `sStatus`, `Height`, `Weight`, `eyeColor`, `eyeDesc`, `hairColor`, `hairDesc`, `sInfluence`, `guardian_name`, `g_address`, `ghome_phone`, `gmob_phone`) VALUES
(30, 83, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 74, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 74, 50, 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ', 'ZZZ'),
(34, 84, 52, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 84, 53, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, 74, 54, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 74, 55, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 74, 56, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(39, 74, 57, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(40, 33, 58, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(41, 33, 59, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(42, 84, 60, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 84, 61, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(130, 93, 114, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(131, 93, 115, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(132, 93, 116, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(133, 93, 117, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(134, 93, 118, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(135, 73, 124, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(136, 84, 125, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(138, 74, 126, '', '', '', '', '', '', '', '', '', 'Blonde', '', '', '', '', '', ''),
(143, 93, 127, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(144, 93, 128, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(145, 93, 129, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(146, 93, 130, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(147, 93, 131, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(148, 84, 132, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(149, 74, 133, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(153, 73, 137, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(155, 84, 138, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(156, 127, 139, 'asdf', 'asdf', 'asdf', 'asdf', '', '', '', '', '', '', '', '', '', '', '', ''),
(157, 84, 140, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(160, 73, 143, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(162, 33, 144, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(163, 33, 145, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(165, 93, 146, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(166, 93, 147, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(167, 94, 148, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(168, 94, 149, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(169, 73, 150, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(170, 73, 151, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(171, 73, 152, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(172, 73, 153, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(173, 73, 154, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(174, 73, 155, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(175, 94, 156, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(176, 94, 157, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `item_c`
--

CREATE TABLE `item_c` (
  `vdNo` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `repID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_c`
--

INSERT INTO `item_c` (`vdNo`, `personID`, `repID`) VALUES
(30, 84, 48),
(31, 84, 49),
(32, 33, 50),
(34, 84, 52),
(35, 84, 53),
(36, 74, 54),
(37, 74, 55),
(38, 74, 56),
(39, 74, 57),
(40, 33, 58),
(41, 33, 59),
(42, 84, 60),
(43, 84, 61),
(92, 94, 114),
(93, 94, 115),
(94, 94, 116),
(95, 94, 117),
(96, 93, 118),
(97, 84, 124),
(98, 93, 125),
(99, 127, 126),
(100, 74, 127),
(101, 74, 128),
(102, 74, 129),
(103, 74, 130),
(104, 74, 131),
(105, 74, 132),
(106, 84, 133),
(110, 93, 137),
(111, 133, 138),
(112, 33, 139),
(113, 127, 140),
(114, 127, 141),
(115, 127, 142),
(116, 94, 143),
(119, 135, 146),
(120, 135, 147),
(121, 130, 148),
(122, 130, 149),
(123, 73, 150),
(124, 73, 151),
(125, 73, 152),
(126, 73, 153),
(127, 73, 154),
(128, 73, 155),
(129, 94, 156),
(130, 94, 157);

-- --------------------------------------------------------

--
-- Table structure for table `item_d`
--

CREATE TABLE `item_d` (
  `narNo` int(11) NOT NULL,
  `repID` int(11) NOT NULL,
  `narrative` longtext DEFAULT NULL,
  `administering_officer` varchar(100) DEFAULT NULL,
  `rank_name_of_desk_officer` varchar(100) DEFAULT NULL,
  `blotter_number` varchar(50) DEFAULT NULL,
  `police_station_name` varchar(100) DEFAULT NULL,
  `investigator_on_case` varchar(100) DEFAULT NULL,
  `chief_head_of_office` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_d`
--

INSERT INTO `item_d` (`narNo`, `repID`, `narrative`, `administering_officer`, `rank_name_of_desk_officer`, `blotter_number`, `police_station_name`, `investigator_on_case`, `chief_head_of_office`) VALUES
(33, 48, 'ASDF', 'ASD', 'ASD', 'ASD', 'ASD', 'ASD', 'ASD'),
(34, 49, 'ZXC', 'ZXC', 'ZXC', 'ZXC', 'ZXC', 'ZXC', 'ZXC'),
(35, 50, 'QWEQWE', 'EWQEWQQ', 'EWQEQWE', 'QEWEQWE', 'EQWWQEQ', 'WQEQW', 'WQEQWE'),
(37, 52, 'asdfghjkl', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdfghl'),
(38, 53, 'asdfghjkl', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdfghl'),
(39, 54, 'qwewqewqeweq', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qweqwewqwe'),
(40, 55, 'qwewqewqeweq', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qweqwewqwe'),
(41, 56, 'wqewqewq', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qweqweweqq'),
(42, 57, 'wqewqewq', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qweqweweqq'),
(43, 58, 'qwe', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qwewqeq'),
(44, 59, 'qwe', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qwewqeq'),
(45, 60, 'dsada', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'sadas'),
(46, 61, 'dsada', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'sadas'),
(63, 78, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(64, 79, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(65, 80, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(66, 81, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(67, 82, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(68, 83, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(69, 84, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(70, 85, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(71, 86, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(72, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 89, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(75, 90, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(76, 91, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(77, 92, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(78, 93, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(79, 94, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(80, 95, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(81, 96, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(82, 97, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(83, 98, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(84, 99, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(85, 100, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(86, 101, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(87, 102, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(88, 103, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(89, 104, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(90, 105, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(91, 106, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(92, 107, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(93, 108, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(94, 109, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(95, 110, '21312', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'qweqw'),
(96, 111, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(97, 124, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(98, 125, '231', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, '21312'),
(99, 126, 'Mr. Ilangos was harassed in front of ISAT-U by a unknown person with a long blonde hair', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'Ariel Consuelo '),
(100, 127, 'dsadssadaasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdadasdas'),
(101, 128, 'dsadssadaasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdadasdas'),
(102, 129, 'dsadssadaasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdadasdas'),
(103, 130, 'dsadssadaasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdadasdas'),
(104, 131, 'dsadssadaasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'asdadasdas'),
(105, 132, 'qwertyuiop', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(106, 133, 'Wala naman akong nais banggitin\r\n\'Di pag-uusapan lahat na nangyayari sa \'tin\r\nPagkatapos akong lamunin at suyuin ng panahon\r\nPati sa panaginip, \'di man lang huminahon\r\n\r\nSadyang gusto ko lang naman tanungin\r\nAng \'yong mata na madalas nagsisinungaling\r\nAng galing, parang kahapon lang, mahal mo ako\r\nHindi inaasahang ganito ka magbabago\r\n\r\nPero kahit gan\'to (pero kahit gan\'to)\r\nNaiisip mo man lang ba \'ko?\r\nKasi kahit saan magpunta, hinahanap ko ang \'yong mukha\'t\r\nBaka biglang magkita pa tayo\r\n\r\nSa Kyusi, sa UP\r\nSa kalsada ng BGC\r\nPagkalipas ng ilang taon\r\nMakikita mong walang tinapon\r\n\'Di ko binaon, bagkos tinanim\r\nSa aking puso at isip\r\nNo\'ng gabing iniwan mo ako\r\nHabang-buhay na \'kong maghihintay sa \'yo', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(107, 134, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(108, 135, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(109, 136, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(110, 137, 'asddasdsadasdsadsa', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'dsadasd'),
(111, 138, 'pinasokan sa bahay ang biktima habang siya ay tulog, at ang suspect na si Deniel Betia ninakaw ang brief na butas butas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'Padojinog, Lander '),
(112, 139, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(113, 140, 'ASDASDSADASDSADSADSASDDASD', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(114, 141, 'ASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSD', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(115, 142, 'ASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSDASDASDSADASDASDASDASDASDDASDSADSDSGFJAGHJGSHGFDGHSDDGJSJGSGDSD', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(116, 143, '', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(119, 146, 'Pantropiko pantropiko oh', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(120, 147, 'Pantropiko pantropiko oh', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(121, 148, 'Oh hello there misteryoso\r\n\'Di pa rin mabasa ang \'yong tunay na motibo oh\r\nIba\'ng pinapakita taliwas sa\'yong salita\r\nPero ayokong magduda baka lang sa simula\r\nMaghihintay na lang na ika\'y dumaan\r\nSana ay maibsan ang aking pangungulila\r\nTrapped in this fairytale\r\nBut I don\'t wanna wake up in this dream baby\r\nAyokong umasa sa paniniwalang\r\nMay pag-asa nga ba\r\nNa baka ang puso ko\'y mapagbigyan\r\nMahiwagang salamin kailan ba niya aaminin\r\nKaniyang tunay na pagtingin\r\nMahiwagang salamin ano ba\'ng dapat gawin\r\nBakit ang puso\'y nabibitin\r\nSalamin salamin sa dingding nasa\'n na ang pag-ibig\r\nSalamin salamin sa dingding pwede mo bang sabihin\r\nSalamin salamin sa dingding nasa\'n na ang pag-ibig\r\nSalamin salamin kailan niya ba \'ko papansinin', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'PCPT Marlon C. Perez'),
(122, 149, 'Oh hello there misteryoso\r\n\'Di pa rin mabasa ang \'yong tunay na motibo oh\r\nIba\'ng pinapakita taliwas sa\'yong salita\r\nPero ayokong magduda baka lang sa simula\r\nMaghihintay na lang na ika\'y dumaan\r\nSana ay maibsan ang aking pangungulila\r\nTrapped in this fairytale\r\nBut I don\'t wanna wake up in this dream baby\r\nAyokong umasa sa paniniwalang\r\nMay pag-asa nga ba\r\nNa baka ang puso ko\'y mapagbigyan\r\nMahiwagang salamin kailan ba niya aaminin\r\nKaniyang tunay na pagtingin\r\nMahiwagang salamin ano ba\'ng dapat gawin\r\nBakit ang puso\'y nabibitin\r\nSalamin salamin sa dingding nasa\'n na ang pag-ibig\r\nSalamin salamin sa dingding pwede mo bang sabihin\r\nSalamin salamin sa dingding nasa\'n na ang pag-ibig\r\nSalamin salamin kailan niya ba \'ko papansinin', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, 'PCPT Marlon C. Perez'),
(123, 150, 'dasdasdasdasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(124, 151, 'dasdasdasdasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(125, 152, 'sdadasdasdasads', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(126, 153, 'sdadasdasdasads', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(127, 154, 'asdasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(128, 155, 'asdasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 1', NULL, 'PCol Joeresty Coronica'),
(129, 156, 'asdasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, ''),
(130, 157, 'asdasdas', 'Daniel Demaala', NULL, NULL, 'Police Station 2', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `persons_data`
--

CREATE TABLE `persons_data` (
  `personID` int(11) NOT NULL,
  `family_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `qualifier` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `citizenship` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `doBirth` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `poBirth` varchar(255) DEFAULT NULL,
  `hPhone` varchar(255) DEFAULT NULL,
  `mPhone` varchar(255) DEFAULT NULL,
  `cHouseNo` varchar(255) DEFAULT NULL,
  `cSitio` varchar(255) DEFAULT NULL,
  `cBrgy` varchar(255) DEFAULT NULL,
  `cTown` varchar(255) DEFAULT NULL,
  `cProvince` varchar(255) DEFAULT NULL,
  `oHouseNo` varchar(255) DEFAULT NULL,
  `oSitio` varchar(255) DEFAULT NULL,
  `oBrgy` varchar(255) DEFAULT NULL,
  `oTown` varchar(255) DEFAULT NULL,
  `oProvince` varchar(255) DEFAULT NULL,
  `heAttain` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `idCard` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persons_data`
--

INSERT INTO `persons_data` (`personID`, `family_name`, `first_name`, `middle_name`, `qualifier`, `nickname`, `citizenship`, `sex`, `civil_status`, `doBirth`, `age`, `poBirth`, `hPhone`, `mPhone`, `cHouseNo`, `cSitio`, `cBrgy`, `cTown`, `cProvince`, `oHouseNo`, `oSitio`, `oBrgy`, `oTown`, `oProvince`, `heAttain`, `occupation`, `idCard`, `email`) VALUES
(33, 'demaala', 'dan', 'glory', 'jr', 'nonoy', 'filipino', 'male', 'Single', '2024-02-25', 22, 'iloilo', '09291577708', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(73, 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'MALE', 'Married', '2024-03-07', 19, 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA'),
(74, 'Libo-on', 'Rhea', 'Singson', '', 'Pao pao', 'Filipino', 'Female', 'Single', '2024-03-07', 22, 'Iloilo', '0823213123', '032193021', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AAA', 'AA', 'AAA'),
(83, 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'Male', 'Married', '2024-03-14', 22, 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB', 'BBB@gmail.com'),
(84, 'Betia', 'Deniel', 'Domingo', '', 'Denden', 'Filipino', 'Male', 'Single', '2001-03-30', 22, 'Iloilo City, Iloilo', '0912313121', '09123678312', 'ASD', 'ASD', 'ASD', 'ASD', 'ASD', '', '', '', '', '', 'Associate Degree', 'Student', '', ''),
(93, 'Gardose', 'Justine', 'G', '', 'Tintin', 'Filipino', 'Male', 'Married', '2000-12-13', 23, 'Iloilo City', '092312312', '09213131231', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TT', 'TTT', 'Associate Degree', 'Student', '12345', 'justine@gmail.com'),
(94, 'Gardose', 'Justine', 'G', '', 'Tintin', 'Filipino', 'Male', 'Married', '2000-12-13', 23, 'Iloilo City', '092312312', '09213131231', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TTT', 'TT', 'TTT', 'Associate Degree', 'Student', '12345', 'justine@gmail.com'),
(118, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(119, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(120, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(121, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(122, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(123, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(124, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(125, NULL, '', '', '', '', '', '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, ''),
(126, '12312321', '', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(127, 'Ilangos ', 'Reynaldo', 'Hilado', '', 'Bok', 'Filipino', 'Male', 'Married', '1983-11-26', 40, 'Iloilo City', '09291123121', '09231231312', '', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'Graduate or Professional Degree', 'Farmer', '12345', 'ilangos@gmail.com'),
(128, 'GGGGG', 'GGG', 'GG', 'GG', 'GGG', '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(129, 'www', 'ww', 'www', '', '', '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(130, 'asdsadas', 'sadadassda', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(131, 'xxx', 'xxx', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(132, 'Osamu', 'Dazai', '', '', 'Dazz', 'Filipino', 'Male', 'Single', '2001-08-12', 22, 'Iloilo City', '0921312311', '', '', '', '', '', '', '', '', '', '', '', 'Graduate or Professional Degree', 'Teacher', '12345', 'dazai@gmail.com'),
(133, 'Faro', 'Jeriel', 'Cabayloo', '', '', 'Filipino', 'Male', 'Single', '2002-02-05', 22, 'Manila', '', '9999999191', '123', 'broke', 'Pavia Lapaz', 'Pavia', 'Iloilo', '', '', '', '', '', 'Bachelor\'s Degree', 'student', '21461', 'jeri@yuso.com'),
(135, 'Gelilang', 'Jynel', 'Galicto', '', 'Toto', 'Filipino', 'Male', 'Single', '2001-12-30', 22, 'Iloilo City', '', '092001922101', '', '', 'Poblacion', 'Tapaz', 'Capiz', '', '', '', '', '', 'Graduate or Professional Degree', 'Student', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `repID` int(11) NOT NULL,
  `type_of_incident` varchar(100) DEFAULT NULL,
  `datetime_of_incident` datetime DEFAULT NULL,
  `datetime_reported` datetime DEFAULT NULL,
  `place_of_incident` varchar(100) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`repID`, `type_of_incident`, `datetime_of_incident`, `datetime_reported`, `place_of_incident`, `status`, `latitude`, `longitude`) VALUES
(48, 'Homicide', '0000-00-00 00:00:00', '2024-03-31 20:58:00', 'Bantud', 'Approved', 10.70933700, 122.56255300),
(49, 'Traffic Violation', '0000-00-00 00:00:00', '2024-03-31 21:30:00', 'Banuyao', 'Approved', 10.72998100, 122.57812300),
(50, 'Arson', '0000-00-00 00:00:00', '2024-03-31 21:36:00', 'Aguinaldo', 'Approved', 10.70747400, 122.57261600),
(52, 'Drug Offense', '0000-00-00 00:00:00', '2024-03-31 22:21:00', 'Laguda', 'Approved', 10.70769700, 122.56774000),
(53, 'Drug Offense', '0000-00-00 00:00:00', '2024-03-31 22:21:00', 'Laguda', 'Approved', 10.70769700, 122.56774000),
(54, 'Cybercrime', '0000-00-00 00:00:00', '2024-03-31 22:24:00', 'Burgos-Mabini-Plaza', 'Approved', 10.71684000, 122.56658200),
(55, 'Cybercrime', '0000-00-00 00:00:00', '2024-03-31 22:24:00', 'Burgos-Mabini-Plaza', 'Approved', 10.71684000, 122.56658200),
(56, 'Assault', '0000-00-00 00:00:00', '2024-03-31 22:36:00', 'Ingore', 'Approved', 10.72470500, 122.59324600),
(57, 'Assault', '0000-00-00 00:00:00', '2024-03-31 22:36:00', 'Ingore', 'Approved', 10.72470500, 122.59324600),
(58, 'Assault', '0000-00-00 00:00:00', '2024-03-31 22:40:00', 'Aguinaldo', 'Approved', 10.70668100, 122.57277900),
(59, 'Assault', '0000-00-00 00:00:00', '2024-03-31 22:40:00', 'Aguinaldo', 'Approved', 10.70668100, 122.57277900),
(60, 'Assault', '0000-00-00 00:00:00', '2024-03-31 22:46:00', 'Divinagracia', 'Approved', 10.70982600, 122.57214900),
(61, 'Assault', '0000-00-00 00:00:00', '2024-03-31 22:46:00', 'Divinagracia', 'Approved', 10.70982600, 122.57214900),
(62, 'Theft', '0000-00-00 00:00:00', '2024-04-02 17:42:00', 'Aguinaldo', 'Approved', 10.70783000, 122.57240300),
(70, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:22:00', 'Aguinaldo', 'Pending', 10.70770400, 122.57240400),
(75, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:28:00', 'Aguinaldo', 'Approved', 10.70760600, 122.57265900),
(76, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:36:00', 'Aguinaldo', 'Pending', 10.70781500, 122.57265200),
(77, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:43:00', 'Aguinaldo', 'Pending', 10.70778000, 122.57273700),
(78, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:43:00', 'Aguinaldo', 'Pending', 10.70778000, 122.57273700),
(79, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:46:00', 'Aguinaldo', 'Pending', 10.70758600, 122.57288500),
(80, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:46:00', 'Aguinaldo', 'Pending', 10.70758600, 122.57288500),
(81, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:48:00', 'Aguinaldo', 'Pending', 10.70739800, 122.57249600),
(82, 'Theft', '0000-00-00 00:00:00', '2024-04-02 22:48:00', 'Aguinaldo', 'Pending', 10.70739800, 122.57249600),
(83, 'Theft', '0000-00-00 00:00:00', '2024-04-02 23:43:00', 'Aguinaldo', 'Pending', 10.70750900, 122.57251000),
(84, 'Theft', '0000-00-00 00:00:00', '2024-04-02 23:44:00', 'Aguinaldo', 'Pending', 10.70799600, 122.57299800),
(85, 'Burglary', '0000-00-00 00:00:00', '2024-04-02 23:46:00', 'Aguinaldo', 'Pending', 10.70753000, 122.57251700),
(86, 'Burglary', '0000-00-00 00:00:00', '2024-04-02 23:46:00', 'Aguinaldo', 'Pending', 10.70753000, 122.57251700),
(87, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(88, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(89, 'Arson', '0000-00-00 00:00:00', '2024-04-03 00:22:00', 'Aguinaldo', 'Approved', 10.70771100, 122.57291300),
(90, 'Robbery', '0000-00-00 00:00:00', '2024-04-03 00:23:00', 'Aguinaldo', 'Approved', 10.70837200, 122.57256700),
(91, 'Robbery', '0000-00-00 00:00:00', '2024-04-03 00:24:00', 'Aguinaldo', 'Approved', 10.70768700, 122.57225600),
(92, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:15:00', 'Baldoza', 'Approved', 10.71399200, 122.57942300),
(93, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:18:00', 'Aguinaldo', 'Approved', 10.70740500, 122.57276500),
(94, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:21:00', 'Aguinaldo', 'Approved', 10.70734200, 122.57275800),
(95, 'Vandalism', '0000-00-00 00:00:00', '2024-04-03 02:38:00', 'Aguinaldo', 'Approved', 10.70810000, 122.57259500),
(96, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:39:00', 'Aguinaldo', 'Approved', 10.70828100, 122.57260200),
(97, 'Theft', '0000-00-00 00:00:00', '2024-04-03 02:41:00', 'Aguinaldo', 'Approved', 10.70801700, 122.57262300),
(98, 'Domestic Violence', '0000-00-00 00:00:00', '2024-04-03 02:43:00', 'Aguinaldo', 'Approved', 10.70837200, 122.57254500),
(99, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:45:00', 'Aguinaldo', 'Approved', 10.70787800, 122.57278600),
(100, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:45:00', 'Aguinaldo', 'Approved', 10.70787800, 122.57278600),
(101, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:47:00', 'Aguinaldo', 'Approved', 10.70837900, 122.57260900),
(102, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:47:00', 'Aguinaldo', 'Approved', 10.70837900, 122.57260900),
(103, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:49:00', 'Aguinaldo', 'Approved', 10.70768300, 122.57297000),
(104, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:49:00', 'Aguinaldo', 'Approved', 10.70768300, 122.57297000),
(105, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 02:58:00', 'Aguinaldo', 'Approved', 10.70832300, 122.57258100),
(106, 'Theft', '0000-00-00 00:00:00', '2024-04-03 03:00:00', 'Aguinaldo', 'Approved', 10.70841300, 122.57265900),
(107, 'Theft', '0000-00-00 00:00:00', '2024-04-03 03:00:00', 'Aguinaldo', 'Approved', 10.70841300, 122.57265900),
(108, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 03:05:00', 'Aguinaldo', 'Approved', 10.70842000, 122.57265900),
(109, 'Theft', '0000-00-00 00:00:00', '2024-04-03 03:07:00', 'Aguinaldo', 'Approved', 10.70832300, 122.57253100),
(110, 'Theft', '0000-00-00 00:00:00', '2024-04-03 07:21:00', 'Aguinaldo', 'Approved', 10.70836500, 122.57261600),
(111, 'Theft', '0000-00-00 00:00:00', '2024-04-03 07:34:00', 'Aguinaldo', 'Approved', 10.70833700, 122.57251700),
(114, 'Theft', '0000-00-00 00:00:00', '2024-04-03 07:40:00', 'Aguinaldo', 'Approved', 10.70821900, 122.57256700),
(115, 'Theft', '0000-00-00 00:00:00', '2024-04-03 07:40:00', 'Aguinaldo', 'Approved', 10.70821900, 122.57256700),
(116, 'Theft', '0000-00-00 00:00:00', '2024-04-03 07:40:00', 'Aguinaldo', 'Approved', 10.70821900, 122.57256700),
(117, 'Theft', '0000-00-00 00:00:00', '2024-04-03 07:40:00', 'Aguinaldo', 'Approved', 10.70821900, 122.57256700),
(118, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 07:44:00', 'Aguinaldo', 'Approved', 10.70638200, 122.57278600),
(124, 'Burglary', '0000-00-00 00:00:00', '2024-04-03 08:00:00', 'Baldoza', 'Pending', 10.71519200, 122.58261800),
(125, 'Arson', '0000-00-00 00:00:00', '2024-04-03 09:45:00', 'Aguinaldo', 'Pending', 10.70730000, 122.57287800),
(126, 'Other', '2024-04-02 23:00:00', '2024-04-03 11:00:00', 'Burgos-Mabini-Plaza', 'Approved', 10.71579100, 122.56647000),
(127, 'Theft', '2024-04-22 21:00:00', '2024-04-22 21:01:00', 'Bantud', 'Pending', 10.71020200, 122.56542300),
(128, 'Theft', '2024-04-22 21:00:00', '2024-04-22 21:01:00', 'Bantud', 'Pending', 10.71020200, 122.56542300),
(129, 'Theft', '2024-04-22 21:00:00', '2024-04-22 21:01:00', 'Bantud', 'Pending', 10.71020200, 122.56542300),
(130, 'Theft', '2024-04-22 21:00:00', '2024-04-22 21:01:00', 'Bantud', 'Pending', 10.71020200, 122.56542300),
(131, 'Theft', '2024-04-22 21:00:00', '2024-04-22 21:01:00', 'Bantud', 'Pending', 10.71020200, 122.56542300),
(132, 'Fraud', '0000-00-00 00:00:00', '2024-04-22 21:06:00', 'Aguinaldo', 'Approved', 10.70772100, 122.57256500),
(133, 'Arson', '2024-04-22 21:49:00', '2024-04-22 21:48:00', 'Baldoza', 'Pending', 10.71346600, 122.58231500),
(134, 'Theft', '0000-00-00 00:00:00', '2024-04-22 22:17:00', 'Baldoza', 'Pending', 0.00000000, 0.00000000),
(135, 'Vandalism', '0000-00-00 00:00:00', '2024-04-23 08:38:00', 'Ingore', 'Pending', 10.72610700, 122.59194300),
(136, 'Vandalism', '0000-00-00 00:00:00', '2024-04-23 08:39:00', 'Ingore', 'Pending', 10.72610700, 122.59194300),
(137, 'Traffic Violation', '2024-04-23 08:51:00', '2024-04-23 08:52:00', 'Banuyao', 'Pending', 10.73328000, 122.57706100),
(138, 'Robbery', '2024-04-23 03:00:00', '2024-04-23 15:02:00', 'Aguinaldo', 'Approved', 10.70804300, 122.57265900),
(139, 'Arson', '2024-04-29 22:58:00', '2024-04-29 22:59:00', 'Aguinaldo', 'Pending', 10.70754700, 122.57270100),
(140, 'Fraud', '2024-04-29 11:23:00', '2024-04-30 11:24:00', 'Aguinaldo', 'Approved', 10.70780500, 122.57265200),
(141, 'Kidnapping', '2024-04-30 11:39:00', '2024-04-30 11:39:00', 'Caingin', 'Pending', 10.71910000, 122.57560000),
(142, 'Kidnapping', '2024-04-30 11:39:00', '2024-04-30 11:39:00', 'Caingin', 'Pending', 10.71910000, 122.57560000),
(143, 'Theft', '0000-00-00 00:00:00', '2024-04-30 11:50:00', 'Aguinaldo', 'Approved', 10.70651200, 122.57226700),
(144, 'Burglary', '2024-05-07 23:17:00', '2024-05-08 23:22:00', 'Aguinaldo', 'Approved', 10.70660800, 122.57212800),
(145, 'Burglary', '2024-05-07 23:17:00', '2024-05-08 23:22:00', 'Aguinaldo', 'Pending', 10.70660800, 122.57212800),
(146, 'Assault', '2024-05-09 01:57:00', '2024-05-09 11:57:00', 'Aguinaldo', 'Approved', 10.70621900, 122.57264400),
(147, 'Assault', '2024-05-09 01:57:00', '2024-05-09 11:57:00', 'Aguinaldo', 'Pending', 10.70621900, 122.57264400),
(148, 'Theft', '2024-05-17 11:10:00', '2024-05-17 11:11:00', 'Baldoza', 'Pending', 10.71444200, 122.58187000),
(149, 'Theft', '2024-05-17 11:10:00', '2024-05-17 11:11:00', 'Baldoza', 'Pending', 10.71444200, 122.58187000),
(150, 'Fraud', '2024-06-24 10:02:00', '2024-06-24 10:03:00', 'Jereos', 'Pending', 10.71955700, 122.56738300),
(151, 'Fraud', '2024-06-24 10:02:00', '2024-06-24 10:03:00', 'Jereos', 'Pending', 10.71955700, 122.56738300),
(152, 'Vandalism', '2024-06-24 10:05:00', '2024-06-24 10:06:00', 'Ingore', 'Pending', 10.73342400, 122.59682200),
(153, 'Vandalism', '2024-06-24 10:05:00', '2024-06-24 10:06:00', 'Ingore', 'Pending', 10.73342400, 122.59682200),
(154, 'Robbery', '2024-06-24 10:31:00', '2024-06-24 10:31:00', 'Banuyao', 'Pending', 10.72945000, 122.58483100),
(155, 'Robbery', '2024-06-24 10:31:00', '2024-06-24 10:31:00', 'Banuyao', 'Pending', 10.72945000, 122.58483100),
(156, 'Theft', '2024-06-24 10:33:00', '2024-06-24 10:33:00', 'Baldoza', 'Pending', 10.71345700, 122.58324900),
(157, 'Theft', '2024-06-24 10:33:00', '2024-06-24 10:33:00', 'Baldoza', 'Pending', 10.71345700, 122.58324900);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `empNo` int(11) NOT NULL,
  `emailaddr` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `empNo`, `emailaddr`, `userType`, `password`, `status`) VALUES
(1, 2, 'daniel@pnp.gov.ph', 'admin', '$2y$10$wZe1CIlfb/fkEHX5iDXdjupuVco1x6Q6.wjdLTxPJQxLyHLMV6xVS', 'active'),
(4, 5, 'police@pnp.gov.ph', 'police', '$2y$10$Ye4ZuX3Uzygn9UnJo2fKNugZzZPyR9NkensaO1UuSO6mMUyfFMHVG', 'active'),
(5, 6, 'investigator@pnp.gov.ph', 'investigator', '$2y$10$4wVk1OWYEITG2H0rxrPxFOFz0lUWUXKGpb22i2Z0/1Nt4lhofWGNW', 'active'),
(6, 7, 'landero@pnp.gov.ph', 'police', '$2y$10$W9ebXI0mIQ/Sj5GghYAWnuq8HAAwINewMCoaO3uQp/psakSzvTwYW', 'inactive'),
(14, 15, 'deniel@pnp.gov.php', 'admin', '$2y$10$fUxdDPIasJB0xr.zS9AZYuT0D0fDr8RszKQQFG9uiIojhAlfpKtgG', 'inactive'),
(85, 83, 'clethjude@pnp.gov.ph', 'admin', '$2y$10$PeIqTtf1Z9sg5EO8PK6hruId5gP5nJJYfllO8vas7SiqZX.eMt5z2', 'inactive'),
(89, 87, 'admin@pnp.gov.ph', 'admin', '$2y$10$2nEy2qGeUBY/iIsNDbD6eu4qILErxs0i5aqEJfcOAI2mAnLK/IFUa', 'active'),
(90, 88, 'aasda@pnp.gov.ph', 'admin', '$2y$10$he.rMUwWSqg6FMl64fPstefQYzdUzmfqTwWnZt50I8A9ya7bvYtze', 'inactive'),
(92, 90, 'QQQ@pnp.gov.ph', 'admin', '$2y$10$/fahERMXVut4gTjkX8D2QeB.pc4Q2MlELbihvguz8r4ViSHDKePWq', 'active'),
(97, 95, 'gelilang@pnp.gov.ph', 'admin', '$2y$10$lIY4dbAEVyQt8h5ibY5f/OoEuLfuoSOx8Whvhidm2KAuHoIcyUxxS', 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empNo`);

--
-- Indexes for table `item_a`
--
ALTER TABLE `item_a`
  ADD PRIMARY KEY (`rpNo`),
  ADD KEY `personID` (`personID`),
  ADD KEY `repID` (`repID`);

--
-- Indexes for table `item_b`
--
ALTER TABLE `item_b`
  ADD PRIMARY KEY (`sdNo`),
  ADD KEY `personID` (`personID`),
  ADD KEY `repID` (`repID`);

--
-- Indexes for table `item_c`
--
ALTER TABLE `item_c`
  ADD PRIMARY KEY (`vdNo`),
  ADD KEY `personID` (`personID`),
  ADD KEY `repID` (`repID`);

--
-- Indexes for table `item_d`
--
ALTER TABLE `item_d`
  ADD PRIMARY KEY (`narNo`),
  ADD KEY `repID` (`repID`);

--
-- Indexes for table `persons_data`
--
ALTER TABLE `persons_data`
  ADD PRIMARY KEY (`personID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`repID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `users_ibfk_1` (`empNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `item_a`
--
ALTER TABLE `item_a`
  MODIFY `rpNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `item_b`
--
ALTER TABLE `item_b`
  MODIFY `sdNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `item_c`
--
ALTER TABLE `item_c`
  MODIFY `vdNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `item_d`
--
ALTER TABLE `item_d`
  MODIFY `narNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `persons_data`
--
ALTER TABLE `persons_data`
  MODIFY `personID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `repID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_a`
--
ALTER TABLE `item_a`
  ADD CONSTRAINT `item_a_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `persons_data` (`personID`),
  ADD CONSTRAINT `item_a_ibfk_2` FOREIGN KEY (`repID`) REFERENCES `report` (`repID`);

--
-- Constraints for table `item_b`
--
ALTER TABLE `item_b`
  ADD CONSTRAINT `item_b_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `persons_data` (`personID`),
  ADD CONSTRAINT `item_b_ibfk_2` FOREIGN KEY (`repID`) REFERENCES `report` (`repID`);

--
-- Constraints for table `item_c`
--
ALTER TABLE `item_c`
  ADD CONSTRAINT `item_c_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `persons_data` (`personID`),
  ADD CONSTRAINT `item_c_ibfk_2` FOREIGN KEY (`repID`) REFERENCES `report` (`repID`);

--
-- Constraints for table `item_d`
--
ALTER TABLE `item_d`
  ADD CONSTRAINT `item_d_ibfk_1` FOREIGN KEY (`repID`) REFERENCES `report` (`repID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`empNo`) REFERENCES `employee` (`empNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

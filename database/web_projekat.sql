-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 09:39 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_projekat`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `distance` (`lat1` DOUBLE, `lon1` DOUBLE, `lat2` DOUBLE, `lon2` DOUBLE) RETURNS DOUBLE BEGIN
    DECLARE r DOUBLE;
    DECLARE la1 DOUBLE;
    DECLARE ln1 DOUBLE;
    DECLARE la2 DOUBLE;
    DECLARE ln2 DOUBLE;
    DECLARE dlat DOUBLE;
    DECLARE dlng DOUBLE;
    DECLARE a DOUBLE;
    DECLARE c DOUBLE;
    DECLARE km DOUBLE;
    SET r = 6372.797;
    SET la1 = RADIANS(lat1);
    SET ln1 = RADIANS(lon1);
    SET la2 = RADIANS(lat2);
    SET ln2 = RADIANS(lon2);
    SET dlat = la2 - la1;
    SET dlng = ln2 - ln1;
    SET a = SIN(dlat/2)*SIN(dlat/2) + COS(la1)*COS(la2)*SIN(dlng/2)*SIN(dlng/2);
    SET km = 2*r*ASIN(SQRT(a));
    RETURN km;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `busy_tables`
--

CREATE TABLE `busy_tables` (
  `table_id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `busy_tables`
--

INSERT INTO `busy_tables` (`table_id`, `number`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 1),
(9, 7),
(10, 6),
(11, 3),
(12, 4),
(13, 0),
(14, 0),
(15, 0),
(19, 0),
(20, 0),
(21, 0),
(22, 0),
(23, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(37, 0),
(38, 0),
(39, 0),
(40, 0),
(41, 0),
(42, 0),
(43, 0),
(44, 0),
(45, 0),
(46, 0),
(47, 0),
(48, 0),
(49, 0),
(50, 0),
(51, 0),
(52, 0),
(53, 0),
(54, 0),
(55, 0),
(56, 0),
(57, 0),
(58, 0),
(59, 0),
(60, 0),
(61, 0),
(62, 0),
(63, 0),
(64, 0),
(65, 0),
(66, 0),
(67, 0),
(68, 0),
(69, 0),
(70, 0),
(71, 0),
(72, 0),
(73, 0),
(74, 0),
(75, 0),
(76, 0),
(77, 0),
(78, 0),
(79, 0),
(80, 0),
(81, 0),
(88, 6),
(89, 6),
(90, 0),
(91, 1),
(92, 0),
(93, 0),
(94, 0),
(95, 0),
(96, 0),
(97, 0),
(98, 0),
(99, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`) VALUES
(1, 'Niš', 1),
(2, 'Beograd', 1),
(3, 'Soko Banja', 1),
(4, 'Leskovac', 1),
(5, 'Novi Sad', 1),
(6, 'Subotica', 1),
(7, 'Kragujevac', 1),
(8, 'Užice', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `user_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `city_id` int(11) NOT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`user_id`, `name`, `lastname`, `city_id`, `phone`, `gender`) VALUES
(1, 'Lazar', 'Stamenković', 1, '0649473933', 1),
(12, 'Radoica', 'Nikolić', 4, '+381640006667', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients_marks`
--

CREATE TABLE `clients_marks` (
  `client_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients_marks`
--

INSERT INTO `clients_marks` (`client_id`, `company_id`, `value`, `time`) VALUES
(1, 15, 1, '2018-09-26 08:36:34'),
(1, 6, 1, '2018-09-26 08:36:34'),
(1, 17, 1, '2018-09-26 08:37:09'),
(1, 5, 0, '2018-09-26 08:37:09'),
(12, 3, 1, '2018-09-26 08:42:25'),
(12, 9, 0, '2018-09-26 08:42:25'),
(1, 3, 1, '2018-09-26 11:08:49'),
(1, 3, 1, '2018-09-26 11:10:04'),
(1, 3, 1, '2018-09-26 11:10:27'),
(1, 3, 0, '2018-09-26 11:11:19'),
(1, 3, 1, '2018-09-26 11:11:31'),
(1, 3, 0, '2018-09-26 11:11:33'),
(12, 3, 1, '2018-10-03 23:00:25'),
(12, 3, 1, '2018-10-03 23:00:36'),
(12, 3, 1, '2018-10-03 23:00:43'),
(12, 3, 1, '2018-10-03 23:00:43'),
(12, 3, 1, '2018-10-03 23:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `user_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(60) NOT NULL,
  `info` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `company_type` int(11) NOT NULL,
  `phone1` varchar(40) DEFAULT NULL,
  `phone2` varchar(40) DEFAULT NULL,
  `website` varchar(120) DEFAULT NULL,
  `number_images` int(11) NOT NULL DEFAULT '1',
  `next_image` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`user_id`, `name`, `city_id`, `address`, `info`, `latitude`, `longitude`, `company_type`, `phone1`, `phone2`, `website`, `number_images`, `next_image`) VALUES
(3, 'King\'s Extra', 3, 'Gvozdenog puka 23', 'Prava intalijanska receptura. Brzo, efikasno i žestoko-', 43.646408247965, 21.870245792978, 5, '0631820262', NULL, 'www.kingsextra.rs', 3, 5),
(4, 'Riblja Konoba', 2, 'Majdanpećka 22', '', 44.801565336602, 20.469030095065, 1, NULL, NULL, NULL, 4, 6),
(5, 'Candy', 1, 'Bulevar Zorana Đinđića 45', 'Sve vrste vaših omiljenih kolača pripremljenih po staroj goranskoj recepturi.', 43.314684041705, 21.918528181758, 4, '0640023454', '0631201005', 'www.candy.rs', 2, 4),
(6, 'Beer Place', 1, 'Cara Dušana 7', 'sve vrste piva imamo.', 43.317014876139, 21.896452086676, 2, '0645567780', '0601100667', 'www.beerplace.com', 6, 8),
(7, 'Vodopad', 2, 'Kralja Petra I 12', '', 44.820424187745, 20.487359437139, 6, NULL, NULL, NULL, 1, 4),
(8, 'Stara Vodenica', 3, 'Milenka Hadžića 22', '', 43.650165053553, 21.855503583358, 6, NULL, NULL, NULL, 2, 4),
(9, 'Staro Grne', 2, 'Drenovačka 18', '', 44.829893611618, 20.412724480195, 6, NULL, NULL, NULL, 1, 3),
(10, 'Bakina Tajna', 1, 'MIlentija Popovića 3', '', 43.331114083684, 21.928015644543, 4, NULL, NULL, NULL, 2, 4),
(11, 'Kravljevski Užitak', 1, 'Toponički put 76/2', '', 43.384201991597, 21.824351126426, 1, NULL, NULL, NULL, 1, 2),
(15, 'Velika Bruka', 1, 'Mariborska 23', 'Veliki izbor domacih i tradicioalnih specijaliteta. Stari srpski abijent koji odise toplinom i lepotop. Iskusno osoblje je tu da samo upotpuni vas uzitak.', 43.346210161239, 21.886362177187, 6, '+381641256758', '+381606111255', 'www.velikabruka.rs', 3, 6),
(16, 'Lovacka Tajna', 1, 'Bulevar Dr Zorana Đinđića 45', '', 43.316331083894, 21.914936388083, 1, '+381654411176', '+381613356577', 'www.lovackatajna.rs', 2, 5),
(17, 'Cheers Caffe', 1, 'Zanatska 2', 'Dobra kafa i još bolja usluga.', 43.343942422602, 21.889635009237, 3, '0649397877', '+381620001144', 'www.cheerscafe.rs', 2, 8),
(18, 'Berta', 4, 'Donja Jajna bb', 'Nema trenutno opis.', 42.969892451467, 21.939923618508, 2, '+3810649397877', '+3810601100667', 'www.berta.rs', 1, 2),
(20, 'Papa Lui', 7, 'Ljubise Jovanovica 11', 'Nista', 44.023617208904, 20.909403439877, 5, '+381631233400', '+381641233400', 'www.papalui.rs', 1, 2),
(21, 'Kafana Mrak', 1, 'Mariborska 23', 'Restoran je mrak', 43.3094212, 21.9231062, 6, '+381651231231', '+381651234444', 'www.kafanamrak.com', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `company_marks`
--

CREATE TABLE `company_marks` (
  `company_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `text` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_marks`
--

INSERT INTO `company_marks` (`company_id`, `client_id`, `value`, `text`, `time`) VALUES
(15, 1, 9, 'Veoma dobra kafana', '2018-09-19 17:13:03'),
(15, 1, 10, '	Najbolja kafana u gradu!!!					                     ', '2018-09-19 20:50:07'),
(10, 1, 10, 'Prezadovaoljan sam :D						                     ', '2018-09-20 00:10:28'),
(15, 1, 9, '						                     ', '2018-09-24 19:07:25'),
(5, 1, 8, '						                     ', '2018-09-27 21:34:56'),
(8, 1, 3, '		mnogo stara				                     ', '2018-09-29 17:35:05'),
(3, 1, 9, 'Jako dobra picerija. Veoma sam zadovoljan.						                     ', '2018-10-03 15:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `company_types`
--

CREATE TABLE `company_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_types`
--

INSERT INTO `company_types` (`id`, `name`, `description`) VALUES
(1, 'Restoran', 'Neki dobar opis za restoran koji ce Rasa da smislja.'),
(2, 'Pivnica', 'Neki dobar opis za pivnicu koji ce Rasa da smislja.'),
(3, 'Kafić', 'Neki dobar opis za kafić koji ce Raša da smislja.'),
(4, 'Poslastičara', 'Neki dobar opis za poslastičaru koji će Raša da smišlja.'),
(5, 'Picerija', 'Neki dobar opis za piceriju koji će Raša da smišlja.'),
(6, 'Kafana', 'Neki dobar opis za kafanu koji će Raša da smišlja.'),
(7, 'Diskoteka', 'Neki dobar opis za diskoteku koji će Raša da smišlja.');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Srbija');

-- --------------------------------------------------------

--
-- Table structure for table `descriptions`
--

CREATE TABLE `descriptions` (
  `company_id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `descriptions`
--

INSERT INTO `descriptions` (`company_id`, `keyword_id`) VALUES
(3, 1),
(3, 2),
(4, 6),
(4, 5),
(4, 15),
(4, 18),
(4, 14),
(5, 15),
(5, 2),
(5, 7),
(5, 17),
(5, 16),
(6, 13),
(6, 1),
(6, 16),
(6, 4),
(6, 18),
(7, 9),
(7, 16),
(7, 3),
(7, 1),
(7, 13),
(8, 11),
(8, 4),
(8, 1),
(8, 3),
(8, 9),
(9, 9),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(10, 9),
(10, 7),
(10, 17),
(10, 2),
(10, 16),
(11, 7),
(11, 5),
(11, 14),
(11, 1),
(11, 3),
(15, 1),
(15, 4),
(15, 7),
(15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `content` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `content`) VALUES
(1, 'rostilj'),
(2, 'slatkisi'),
(3, 'pecenje'),
(4, 'narodna muzika'),
(5, 'vegetarijanska kuhinja'),
(6, 'riba'),
(7, 'kolaci'),
(8, 'pica'),
(9, 'domaca kuhinja'),
(10, 'pasta'),
(11, 'tamburasi'),
(12, 'kokteli'),
(13, 'pivo'),
(14, 'vino'),
(15, 'pusacka zona'),
(16, 'basta'),
(17, 'torte'),
(18, 'posna kuhinja');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`user_id`, `time`, `ip_address`) VALUES
(1, '2018-10-18 13:14:38', '::1'),
(3, '2018-10-09 14:13:56', '::1'),
(4, '2018-10-08 08:03:26', '::1'),
(5, '2018-10-03 20:37:41', '::1'),
(6, '2018-10-03 15:39:27', '::1'),
(7, '2018-10-03 20:43:55', '::1'),
(8, '2018-09-27 22:22:38', '::1'),
(9, '2018-09-27 21:44:58', '::1'),
(10, '2018-10-08 08:13:14', '::1'),
(11, '2018-09-27 10:18:58', '::1'),
(12, '2018-10-03 22:38:56', '::1'),
(15, '2018-10-02 14:54:18', '::1'),
(16, '2018-10-05 08:37:01', '::1'),
(17, '2018-09-27 19:45:12', '::1'),
(18, '2018-10-03 16:04:16', '::1'),
(20, '2018-10-03 20:56:56', '::1'),
(21, '2018-10-08 08:54:35', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_tables`
--

CREATE TABLE `reserved_tables` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reserved_tables`
--

INSERT INTO `reserved_tables` (`id`, `table_id`, `client_id`, `start_time`, `end_time`) VALUES
(1, 5, 1, '2018-09-30 14:00:00', '2018-09-30 21:00:00'),
(2, 13, 1, '2018-10-02 17:00:00', '2018-10-02 23:00:00'),
(3, 5, 1, '2018-10-03 13:00:00', '2018-10-03 19:00:00'),
(4, 6, 12, '2018-10-03 10:00:00', '2018-10-03 15:00:00'),
(5, 5, 1, '2018-10-05 09:00:00', '2018-10-05 15:00:00'),
(6, 2, 1, '2018-10-04 13:00:00', '2018-10-04 18:00:00'),
(8, 2, 1, '2018-10-19 19:00:00', '2018-10-20 00:00:00'),
(9, 5, 1, '2018-10-03 16:00:00', '2018-10-03 20:00:00'),
(14, 1, 1, '2018-10-08 12:00:00', '2018-10-08 18:00:00'),
(15, 2, 1, '2018-10-09 16:00:00', '2018-10-09 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `company_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `specific_working_time`
--

CREATE TABLE `specific_working_time` (
  `company_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_hour` int(11) NOT NULL,
  `end_hour` int(11) NOT NULL,
  `open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `company_id`, `capacity`, `number`) VALUES
(1, 3, 2, 4),
(2, 3, 4, 6),
(3, 3, 6, 2),
(4, 3, 8, 2),
(5, 15, 2, 6),
(6, 15, 4, 4),
(7, 15, 10, 6),
(8, 16, 2, 2),
(9, 16, 4, 8),
(10, 16, 6, 8),
(11, 16, 8, 4),
(12, 16, 12, 4),
(13, 17, 4, 4),
(14, 17, 6, 2),
(15, 17, 8, 2),
(19, 3, 10, 0),
(20, 3, 12, 0),
(21, 15, 6, 3),
(22, 15, 8, 0),
(23, 15, 12, 0),
(24, 16, 10, 0),
(25, 17, 2, 0),
(26, 17, 10, 0),
(27, 17, 12, 0),
(28, 6, 2, 8),
(29, 6, 4, 4),
(30, 6, 6, 4),
(31, 6, 8, 4),
(32, 6, 10, 0),
(33, 6, 12, 0),
(34, 18, 2, 6),
(35, 18, 4, 6),
(36, 18, 6, 0),
(37, 18, 8, 6),
(38, 18, 10, 0),
(39, 18, 12, 0),
(40, 4, 2, 0),
(41, 4, 4, 6),
(42, 4, 6, 4),
(43, 4, 8, 0),
(44, 4, 10, 0),
(45, 4, 12, 0),
(46, 7, 2, 2),
(47, 7, 4, 8),
(48, 7, 6, 8),
(49, 7, 8, 2),
(50, 7, 10, 2),
(51, 7, 12, 0),
(52, 8, 2, 0),
(53, 8, 4, 0),
(54, 8, 6, 0),
(55, 8, 8, 0),
(56, 8, 10, 0),
(57, 8, 12, 0),
(58, 9, 2, 0),
(59, 9, 4, 0),
(60, 9, 6, 0),
(61, 9, 8, 0),
(62, 9, 10, 0),
(63, 9, 12, 0),
(64, 10, 2, 4),
(65, 10, 4, 4),
(66, 10, 6, 4),
(67, 10, 8, 0),
(68, 10, 10, 0),
(69, 10, 12, 0),
(70, 11, 2, 0),
(71, 11, 4, 0),
(72, 11, 6, 0),
(73, 11, 8, 0),
(74, 11, 10, 0),
(75, 11, 12, 0),
(76, 5, 2, 4),
(77, 5, 4, 8),
(78, 5, 6, 2),
(79, 5, 8, 2),
(80, 5, 10, 2),
(81, 5, 12, 2),
(88, 20, 2, 6),
(89, 20, 4, 6),
(90, 20, 6, 0),
(91, 20, 8, 2),
(92, 20, 10, 0),
(93, 20, 12, 0),
(94, 21, 2, 5),
(95, 21, 4, 5),
(96, 21, 6, 5),
(97, 21, 8, 5),
(98, 21, 10, 5),
(99, 21, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL DEFAULT '1.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `type`, `join_time`, `active`, `password`, `image`) VALUES
(1, 'lazar96', 'stamenkoviclazar96@gmail.com', 0, '2018-07-19 21:08:25', 1, '25d55ad283aa400af464c76d713c07ade39676f6f1b1c949a4e481e63db01112a0007784', '1.jpg'),
(3, 'kingextra', 'kingextra@gmail.com', 1, '2018-07-25 08:33:16', 1, '827ccb0eea8a706c4c34a16891f84e7b0508bafbd63fe5477da3faaf0bfc985c8d7b38b3', '4.jpg'),
(4, 'fishfish', 'fishfish@gmail.com', 1, '2018-07-30 07:03:28', 1, '827ccb0eea8a706c4c34a16891f84e7bc0dd43cd1855a421dcfc03644ab1c50d6d0424db', '3.jpg'),
(5, 'poslasticaracandy', 'poslasticaracandy@gmail.com', 1, '2018-07-30 07:03:28', 1, '827ccb0eea8a706c4c34a16891f84e7b1cfd2f88ed780f2095d49d3fa518e2479c348f6a', '3.jpg'),
(6, 'beerplace', 'beerplace@gmail.com', 1, '2018-07-30 07:05:33', 1, '827ccb0eea8a706c4c34a16891f84e7be1dbd99dde8e30b0a41d9f45c06fdb4d807fa0c2', '2.jpg'),
(7, 'vodopad', 'vodopad@gmail.com', 1, '2018-07-30 07:05:33', 1, '827ccb0eea8a706c4c34a16891f84e7b75b901a248fa12f41580fb9123d139478b2d7f44', '3.jpg'),
(8, 'staravodenica', 'staravodenica@gmail.com', 1, '2018-07-30 07:07:19', 1, '827ccb0eea8a706c4c34a16891f84e7b2102fb63fbba1351e70c49c860919c7419201930', '2.jpg'),
(9, 'starogrne', 'starogrne@gmail.com', 1, '2018-07-30 07:07:19', 1, '827ccb0eea8a706c4c34a16891f84e7b95e87039b39217fc2b7d6a4ae3e2e44b16207c21', '2.jpg'),
(10, 'bakinatajna', 'bakinatajna@hotmail.com', 1, '2018-07-30 07:09:31', 1, '827ccb0eea8a706c4c34a16891f84e7b3c9787c6012b30ac2f774df1440a59cd1c2e256b', '2.jpg'),
(11, 'kraljevskiuzitak', 'kraljevskiuzitak@outlook.com', 1, '2018-07-30 07:09:31', 1, '827ccb0eea8a706c4c34a16891f84e7ba25a93c82ed2c70ea9626be1ba18bed8f430aab7', '1.jpg'),
(12, 'rasa94', 'rasa94@gmail.com', 2, '2018-08-02 16:44:00', 1, '827ccb0eea8a706c4c34a16891f84e7b49652ac7fb8d81596bb827c427ee16dbe14651ec', '1.jpg'),
(15, 'velikabruka', 'velikabruka@gmail.com', 1, '2018-08-02 18:30:03', 1, '827ccb0eea8a706c4c34a16891f84e7b8f68dc9894e09e224548c328f7b8f4da76c55ad5', '2.jpg'),
(16, 'LovackaTajna', 'lazarstamenkovic96@hotmail.com', 1, '2018-09-13 07:56:11', 1, '25d55ad283aa400af464c76d713c07ad478a8572d6f8d2968e6d6a8f0273c0eb036c28e7', '2.jpg'),
(17, 'cheers', 'lazar.stamenkovic@pmf.edu.rs', 1, '2018-09-14 07:39:28', 1, '25d55ad283aa400af464c76d713c07adca07d325057a17a5e25a00805377fa7cfd7d5001', '2.jpg'),
(18, 'bertanis', 'radoica94@gmail.com', 1, '2018-10-03 15:58:29', 1, '25d55ad283aa400af464c76d713c07ad04b8ca5250b702bfb99f66c6a4bbad9efceedf36', '1.jpg'),
(20, 'papa_lui', 'radoica.nikolic1@pmf.edu.rs', 1, '2018-10-03 20:53:18', 1, '25d55ad283aa400af464c76d713c07adcbfb3a45fb62007ad12dc4c27bd43a12e13421c0', '1.jpg'),
(21, 'jovanica', 'jovanamaxb@outlook.com', 1, '2018-10-08 08:50:34', 1, '25d55ad283aa400af464c76d713c07adce7ca6b83b73c2e259ad6fe38d6875dfaec6f0f6', '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `client_id` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`client_id`, `company_id`) VALUES
(NULL, 16),
(1, 15),
(NULL, 16),
(NULL, 16),
(3, 16),
(1, 16),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 16),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(NULL, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 5),
(1, 17),
(1, 15),
(1, 10),
(1, 10),
(1, 10),
(1, 10),
(1, 17),
(1, 17),
(1, 3),
(1, 17),
(1, 5),
(1, 8),
(1, 8),
(1, 15),
(1, 7),
(1, 7),
(1, 7),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 16),
(1, 17),
(1, 17),
(1, 15),
(1, 8),
(1, 15),
(1, 3),
(17, 17),
(17, 17),
(17, 16),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 17),
(1, 17),
(1, 17),
(1, 17),
(1, 17),
(1, 17),
(1, 17),
(1, 17),
(1, 8),
(1, 15),
(1, 10),
(1, 10),
(1, 3),
(1, 16),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 3),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 9),
(1, 9),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(17, 17),
(5, 5),
(5, 5),
(5, 16),
(5, 11),
(17, 17),
(3, 3),
(17, 17),
(17, 17),
(17, 17),
(17, 17),
(17, 17),
(17, 17),
(17, 17),
(5, 5),
(16, 16),
(3, 17),
(3, 16),
(3, 3),
(1, 17),
(1, 17),
(1, 17),
(1, 5),
(1, 5),
(9, 8),
(9, 3),
(15, 15),
(8, 8),
(10, 5),
(10, 10),
(10, 10),
(10, 10),
(10, 10),
(10, 3),
(10, 10),
(10, 10),
(10, 5),
(10, 5),
(10, 10),
(10, 16),
(4, 4),
(4, 9),
(6, 6),
(3, 17),
(3, 4),
(3, 4),
(15, 15),
(15, 15),
(15, 15),
(1, 5),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 16),
(3, 3),
(3, 3),
(3, 3),
(1, 15),
(1, 8),
(1, 8),
(1, 17),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(3, 3),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(15, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 17),
(1, 15),
(1, 15),
(1, 3),
(1, 3),
(1, 3),
(1, 15),
(1, 15),
(1, 15),
(1, 15),
(3, 3),
(3, 3),
(3, 17),
(3, 3),
(6, 6),
(6, 6),
(6, 15),
(6, 7),
(6, 16),
(6, 4),
(18, 18),
(3, 16),
(20, 17),
(20, 15),
(20, 16),
(16, 16),
(1, 3),
(12, 3),
(3, 3),
(3, 20),
(3, 20),
(3, 3),
(3, 3),
(1, 4),
(1, 15),
(1, 20),
(1, 16),
(16, 16),
(16, 16),
(16, 15),
(1, 3),
(3, 3),
(1, 5),
(4, 10),
(10, 10),
(10, 5),
(10, 3),
(10, 10),
(1, 3),
(1, 3),
(21, 21),
(1, 17),
(1, 3),
(1, 3),
(1, 3),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `working_time`
--

CREATE TABLE `working_time` (
  `company_id` int(11) NOT NULL,
  `day` tinyint(4) NOT NULL,
  `start_hour` int(11) NOT NULL,
  `end_hour` int(11) NOT NULL,
  `open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `working_time`
--

INSERT INTO `working_time` (`company_id`, `day`, `start_hour`, `end_hour`, `open`) VALUES
(15, 1, 7, 23, 1),
(15, 2, 7, 23, 1),
(15, 3, 7, 23, 1),
(15, 4, 7, 23, 1),
(15, 5, 7, 23, 1),
(15, 6, 7, 23, 1),
(15, 7, 0, 0, 0),
(3, 1, 7, 2, 1),
(3, 2, 7, 2, 1),
(3, 3, 7, 2, 1),
(3, 4, 7, 2, 1),
(3, 5, 7, 2, 1),
(3, 6, 7, 2, 1),
(3, 7, 7, 16, 1),
(6, 1, 9, 2, 1),
(6, 2, 9, 2, 1),
(6, 3, 9, 2, 1),
(6, 4, 9, 2, 1),
(6, 5, 9, 2, 1),
(6, 6, 9, 2, 1),
(6, 7, 0, 0, 0),
(18, 1, 10, 3, 1),
(18, 2, 10, 3, 1),
(18, 3, 10, 3, 1),
(18, 4, 10, 3, 1),
(18, 5, 10, 3, 1),
(18, 6, 10, 3, 1),
(18, 7, 0, 0, 0),
(5, 1, 8, 1, 1),
(5, 2, 8, 1, 1),
(5, 3, 8, 1, 1),
(5, 4, 8, 1, 1),
(5, 5, 8, 1, 1),
(5, 6, 8, 1, 1),
(5, 7, 8, 21, 1),
(7, 1, 8, 23, 1),
(7, 2, 8, 23, 1),
(7, 3, 8, 23, 1),
(7, 4, 8, 23, 1),
(7, 5, 8, 3, 1),
(7, 6, 10, 3, 1),
(7, 7, 10, 23, 1),
(20, 1, 7, 23, 1),
(20, 2, 7, 23, 1),
(20, 3, 7, 23, 1),
(20, 4, 7, 23, 1),
(20, 5, 7, 23, 1),
(20, 6, 7, 23, 1),
(20, 7, 7, 18, 1),
(16, 1, 9, 1, 1),
(16, 2, 9, 1, 1),
(16, 3, 9, 1, 1),
(16, 4, 9, 1, 1),
(16, 5, 9, 1, 1),
(16, 6, 9, 1, 1),
(16, 7, 9, 1, 1),
(4, 1, 8, 1, 1),
(4, 2, 8, 1, 1),
(4, 3, 8, 1, 1),
(4, 4, 8, 1, 1),
(4, 5, 8, 1, 1),
(4, 6, 8, 1, 1),
(4, 7, 8, 1, 1),
(10, 1, 9, 23, 1),
(10, 2, 9, 23, 1),
(10, 3, 9, 23, 1),
(10, 4, 9, 23, 1),
(10, 5, 9, 23, 1),
(10, 6, 9, 23, 1),
(10, 7, 9, 23, 1),
(21, 1, 8, 15, 1),
(21, 2, 8, 15, 1),
(21, 3, 8, 15, 1),
(21, 4, 8, 15, 1),
(21, 5, 8, 15, 1),
(21, 6, 8, 15, 1),
(21, 7, 8, 15, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `busy_tables`
--
ALTER TABLE `busy_tables`
  ADD KEY `table_bt_fk` (`table_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_city_fk` (`country_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `city_client_fk` (`city_id`);

--
-- Indexes for table `clients_marks`
--
ALTER TABLE `clients_marks`
  ADD KEY `client_clm_fk` (`client_id`),
  ADD KEY `company_clm_fk` (`company_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `city_company_fk` (`city_id`),
  ADD KEY `comp_type_company_fk` (`company_type`);

--
-- Indexes for table `company_marks`
--
ALTER TABLE `company_marks`
  ADD KEY `company_cm_fk` (`company_id`),
  ADD KEY `clients_cm_fk` (`client_id`);

--
-- Indexes for table `company_types`
--
ALTER TABLE `company_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD KEY `desc_company_fk` (`company_id`),
  ADD KEY `desc_keyword_fk` (`keyword_id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `reserved_tables`
--
ALTER TABLE `reserved_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_rt_fk` (`client_id`),
  ADD KEY `table_rt_fk` (`table_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `review_company_fk` (`company_id`);

--
-- Indexes for table `specific_working_time`
--
ALTER TABLE `specific_working_time`
  ADD KEY `company_swt_fk` (`company_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_tables_fk` (`company_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD KEY `company_visited_fk` (`company_id`),
  ADD KEY `users_visited_fk` (`client_id`);

--
-- Indexes for table `working_time`
--
ALTER TABLE `working_time`
  ADD KEY `company_wt_fk` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_types`
--
ALTER TABLE `company_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reserved_tables`
--
ALTER TABLE `reserved_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `busy_tables`
--
ALTER TABLE `busy_tables`
  ADD CONSTRAINT `table_bt_fk` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `country_city_fk` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `city_client_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_client_pk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients_marks`
--
ALTER TABLE `clients_marks`
  ADD CONSTRAINT `client_clm_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_clm_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `city_company_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comp_type_company_fk` FOREIGN KEY (`company_type`) REFERENCES `company_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_company_pk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_marks`
--
ALTER TABLE `company_marks`
  ADD CONSTRAINT `clients_cm_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_cm_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `desc_company_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `desc_keyword_fk` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `login_user_pk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserved_tables`
--
ALTER TABLE `reserved_tables`
  ADD CONSTRAINT `client_rt_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `table_rt_fk` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_company_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specific_working_time`
--
ALTER TABLE `specific_working_time`
  ADD CONSTRAINT `company_swt_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `company_tables_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `company_visited_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_visited_fk` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working_time`
--
ALTER TABLE `working_time`
  ADD CONSTRAINT `company_wt_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

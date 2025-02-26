-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 25, 2025 at 07:04 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team_wales`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_`
--

DROP TABLE IF EXISTS `admin_`;
CREATE TABLE IF NOT EXISTS `admin_` (
  `username` varchar(20) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_`
--

INSERT INTO `admin_` (`username`, `PASSWORD`) VALUES
('Admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `athletes_info`
--

DROP TABLE IF EXISTS `athletes_info`;
CREATE TABLE IF NOT EXISTS `athletes_info` (
  `athlete_id` int NOT NULL AUTO_INCREMENT,
  `athlete_name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `hometown` varchar(255) NOT NULL,
  `sport_name` varchar(100) NOT NULL,
  `upcoming_event` text,
  `past_achievements` text,
  `medals_won` text,
  PRIMARY KEY (`athlete_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events_info`
--

DROP TABLE IF EXISTS `events_info`;
CREATE TABLE IF NOT EXISTS `events_info` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `sport` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `results` text,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sports_info`
--

DROP TABLE IF EXISTS `sports_info`;
CREATE TABLE IF NOT EXISTS `sports_info` (
  `sport_id` int NOT NULL AUTO_INCREMENT,
  `sport_name` varchar(100) NOT NULL,
  `description_para1` text NOT NULL,
  `description_para2` text NOT NULL,
  `athletes` text,
  `medals_won` text,
  PRIMARY KEY (`sport_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `title` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `adress1` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `profile_blob` longblob,
  `profile_url` varchar(100) DEFAULT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `PASSWORD`, `title`, `first_name`, `last_name`, `gender`, `adress1`, `postcode`, `description`, `email`, `telephone`, `profile_blob`, `profile_url`) VALUES
('DanL', 'password1', '', 'Daniel', 'Lord', 'male', '', '', NULL, 'danieljlord2019@gmail.com', '447469238934', 0x494d475f32303233303832355f3131313930315f656469745f323430383534313633373637322e6a7067, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

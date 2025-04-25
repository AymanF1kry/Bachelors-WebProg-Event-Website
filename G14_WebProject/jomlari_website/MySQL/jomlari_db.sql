-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2024 at 09:22 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jomlari_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `password`) VALUES
(1, 'Ayman1234', 'ilovephp123');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Ayman', 'ayman@gmail.com', 'Hiiiiii', 'whatsup'),
(2, 'Ilham', 'ilham@gmail.com', 'Hello from korea', 'Hello I am interested in your website. Do you mind working with us?'),
(3, 'azfar naz', 'azfarnaz@gmail.com', 'WOWWW!!!', 'Very prettyyyy website!!'),
(5, 'azfar', 'azfar@gmail.com', 'Hello from korea', 'hiiiii');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quota` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `category`, `quota`) VALUES
(1, '5 KM Event Marathon(Open)', 2),
(2, '10 KM Event Marathon(Open)', 10),
(3, '5 KM Event Marathon(Junior)', 10),
(4, '10 KM Event Marathon(Junior)', 3),
(5, '5 KM Event Marathon(Elite)', 3),
(6, '10 KM Event Marathon(Elite)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenum` varchar(30) NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `email`, `phonenum`, `category`, `password`) VALUES
(1, 'Azfarnaz123', 'Azfar Nazrin bin Affandi', 'azfar@gmail.com', '0123456789', '5 KM Event Marathon(Open)', 'rinduyoonsoonan1234'),
(2, 'Ayman1809', 'Ayman Fikry bin Asmajuda', 'ayman@gmail.com', '0197784321', '5 KM Event Marathon(Open)', 'a12345'),
(4, 'Ilham1234', 'Ilham Hadi bin Shamsul', 'ilham1234@gmail.com', '01345522310', '5 KM Event Marathon(Junior)', 'manesouvenier'),
(5, 'Harith1234', 'Harith Ibrahim', 'HarithIbrahim@gmail.com', '01877256439', '10 KM Event Marathon(Open)', 'Harith1212'),
(6, 'Thinesh666', 'Thinesh Elamaran', 'Thinesh666@gmail.com', '0129999999', '5 KM Event Marathon(Junior)', 'thinesh1234'),
(7, 'AmericaNo1', 'Logan Sargeant', 'LoganSargeant@gmail.com', '01546378092', '10 KM Event Marathon(Junior)', 'onceyougoblackyounvrgoback'),
(9, 'Akihiko1001', 'Akihiko Hirono', 'Aki1001@gmail.com', '0129987702', '10 KM Event Marathon(Junior)', '12345678');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

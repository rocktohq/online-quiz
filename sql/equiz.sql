-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2022 at 09:30 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'administrator', 'admin@gmail.com', '$2y$10$buBohsH1kV7C9xteOPYVUuPIMKh5TtyVKEwVpOjdWj6CKgsf5xR72', '2022-06-17 21:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `created_at`) VALUES
(1, 'cse', '2022-06-12 15:53:16'),
(2, 'eee', '2022-06-12 15:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `n` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `a` varchar(50) NOT NULL,
  `b` varchar(50) NOT NULL,
  `c` varchar(50) NOT NULL,
  `d` varchar(50) NOT NULL,
  `answer` varchar(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `topic`, `n`, `question`, `a`, `b`, `c`, `d`, `answer`, `created_at`) VALUES
(1, '1', 1, 'What does HTML stand for?', 'Home Tool Markup Language', 'Hyper Text Markup Language', 'Hot Text Markup Language', 'Hyperlinks and Text Markup Language', 'b', '2022-06-12 16:30:27'),
(2, '1', 2, 'Who is making the Web standards?', 'Mozilla', 'Google', 'Microsoft', 'The World Wide Web Consrtium', 'd', '2022-06-12 16:32:02'),
(3, '2', 1, 'What function can be used to free the memory allocated by calloc()?', 'dealloc();', 'strcat();', 'free();', 'memcpy();', 'c', '2022-06-18 18:24:38'),
(4, '1', 3, 'What is H1?', 'Largest Heading', 'First Heading', 'Last Heading', 'Smallest Heading', 'a', '2022-06-18 18:46:05'),
(5, '2', 2, 'In C, what are the various types of real data type (floating point data type)?', 'Float, long double', 'long double, short int', 'float, double, long double', 'short int, double, long int, float', 'c', '2022-06-19 00:49:21'),
(6, '2', 3, 'C programming language was developed in:', '1975', '1972', '1985', '1982', 'b', '2022-06-19 00:51:52'),
(7, '3', 1, 'What\'s the meaning of CSS?', 'Carrosale Style Sheets', ' Concat Style Sheets ', 'Catberry Style Shimps', ' Cascading Style Sheets', 'd', '2022-06-19 00:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(20) NOT NULL,
  `user` int(20) NOT NULL,
  `quiz` int(20) NOT NULL,
  `score` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `user`, `quiz`, `score`, `created_at`) VALUES
(1, 1, 1, '5', '2022-10-21 03:05:59'),
(2, 2, 1, '3', '2022-10-21 12:26:18'),
(3, 2, 1, '1', '2022-10-21 12:26:40'),
(4, 2, 1, '0', '2022-10-21 12:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(10) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `department`, `photo`, `created_at`) VALUES
(1, 'Basic HTML5', 'cse', '6351aa1af32d1.png', '2022-06-12 16:25:24'),
(2, 'Basic C Programming', 'cse', '', '2022-06-18 15:15:06'),
(3, 'CSS3', 'cse', '', '2022-06-18 15:15:13'),
(4, 'OOP JAVA', 'cse', '', '2022-06-18 17:11:59'),
(5, 'Basic Mechanics', 'eee', '', '2022-06-18 17:20:06'),
(6, 'Digital Electronics', 'eee', '', '2022-06-18 17:33:12'),
(7, 'Discrete Mathematics', 'cse', '6351a809cacd5.jpg', '2022-10-21 01:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `institution` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `institution`, `email`, `password`, `created_at`) VALUES
(1, 'Kawser', 'Male', 'SFMU', 'kawser@gmail.com', '$2y$10$buBohsH1kV7C9xteOPYVUuPIMKh5TtyVKEwVpOjdWj6CKgsf5xR72', '2022-06-17 21:09:32'),
(2, 'Fahim', 'Male', 'SFMU', 'fahim@gmail.com', '$2y$10$/jvafNnvDpXG3jo51s/htOVbcVD/dC41Gqu3pFEcgQH8qg/duaR6y', '0000-00-00 00:00:00'),
(3, 'Bishal', 'Male', 'SFMU', 'bishal@gmail.com', '$2y$10$bWFZbeEhfkkXI0iIU9PfmeDz88S.jsZ3PCbOG6scnrC3zbh9ziR56', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

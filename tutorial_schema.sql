-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2017 at 08:55 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k39392_frameme`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `name`, `title`, `description`) VALUES
(1, 'tutorial', 'Tutorial start', 'This page shows an overview of all steps within this tutorial'),
(2, 'authotization', 'Authotization', 'In this page, the setup of PHP Sentry is described.'),
(3, 'route_and_request', 'Routes and Requests', 'How the FrameMe framework handles routes and the request object are illustrated.'),
(4, 'controller_and_module', 'Controllers and Modules', 'Here we will setup the basic logic for logging and registering an user to our framework. '),
(5, 'model', 'Model and Model Generator', 'The concept of \'Models\' are specified here along with the function and mechanics of the Model Generator.'),
(6, 'query_builder', 'Query Builder (Database coupling)', 'This step defines the workings of the Query Builder object using a fictional use case.'),
(7, 'blade', 'Blade (Template Engine)', 'Here we will briefly cover the implemented template engine called \'Blade\'.');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE `tutorial` (
  `tutorial_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`tutorial_id`, `name`, `description`, `hash`) VALUES
(1, 'FrameMe Tutorial', 'This tutorial will walk through all the basic components of this framework with practical examples and show the basic workflow and implementation of FrameMe', '30567567458f4a656f408d0');

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_page`
--

CREATE TABLE `tutorial_page` (
  `tutorial_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `page_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutorial_page`
--

INSERT INTO `tutorial_page` (`tutorial_id`, `page_id`, `page_order`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(1, 5, 5),
(1, 6, 6),
(1, 7, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
  ADD PRIMARY KEY (`tutorial_id`);

--
-- Indexes for table `tutorial_page`
--
ALTER TABLE `tutorial_page`
  ADD PRIMARY KEY (`tutorial_id`,`page_id`),
  ADD KEY `tutorial_id` (`tutorial_id`),
  ADD KEY `page_id` (`page_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tutorial`
--
ALTER TABLE `tutorial`
  MODIFY `tutorial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tutorial_page`
--
ALTER TABLE `tutorial_page`
  ADD CONSTRAINT `FORIEGN_KEY_TUTORIAL_PAGE_TO_PAGE` FOREIGN KEY (`page_id`) REFERENCES `page` (`page_id`),
  ADD CONSTRAINT `FORIEGN_KEY_TUTORIAL_PAGE_TO_TUTORIAL` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`tutorial_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

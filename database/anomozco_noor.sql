-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2019 at 06:51 PM
-- Server version: 10.1.41-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anomozco_noor`
--

-- --------------------------------------------------------

--
-- Table structure for table `fyp_projects`
--

CREATE TABLE `fyp_projects` (
  `id` int(64) NOT NULL,
  `name` varchar(256) NOT NULL,
  `tagLine` varchar(256) NOT NULL,
  `userId` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fyp_users`
--

CREATE TABLE `fyp_users` (
  `id` int(128) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userImg` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fyp_users`
--

INSERT INTO `fyp_users` (`id`, `name`, `email`, `password`, `userImg`) VALUES
(1507327638, 'User', 'sa02908@st.habib.edu.pk', '3cce45bf21f047a954e1861c653a14ba', 'profilePic.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fyp_projects`
--
ALTER TABLE `fyp_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fyp_users`
--
ALTER TABLE `fyp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fyp_projects`
--
ALTER TABLE `fyp_projects`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fyp_users`
--
ALTER TABLE `fyp_users`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1507327639;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

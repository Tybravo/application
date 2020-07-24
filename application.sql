-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2020 at 04:45 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `application`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact_address` text NOT NULL,
  `marital_status` varchar(40) NOT NULL,
  `edu_background` varchar(100) NOT NULL,
  `best_subject` varchar(100) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `state_of_origin` varchar(40) NOT NULL,
  `s_token` varchar(5) NOT NULL,
  `date_of_birth` varchar(60) NOT NULL,
  `image_string` varchar(20) NOT NULL,
  `image_response` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `access_data` int(11) NOT NULL,
  `verify_string` varchar(18) NOT NULL,
  `created` datetime NOT NULL,
  `s_day` int(11) NOT NULL,
  `s_month` int(11) NOT NULL,
  `s_year` int(11) NOT NULL,
  `time_current` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `email`, `firstname`, `lastname`, `contact_address`, `marital_status`, `edu_background`, `best_subject`, `religion`, `state_of_origin`, `s_token`, `date_of_birth`, `image_string`, `image_response`, `user_type`, `access_data`, `verify_string`, `created`, `s_day`, `s_month`, `s_year`, `time_current`) VALUES
(1, 'ade@gmail.com', 'Ade', 'Tayo', 'Flat7, High street, off Babatunde layout, Oba-Ile, Akure.', 'Single', 'University of Toronto', 'Mathematics, English, Government, Computer', 'Christianity', 'Lagos State', '54545', '07/23/2020', '199361515032561162', 1, 'Applicant', 1, '998657942912503478', '2020-07-23 08:13:02', 23, 7, 2020, '8.13am'),
(2, 'kabiru@yahoo.com', 'Kabiru', 'James', 'Flat7, High street, off Babatunde layout, Oba-Ile, Akure.', 'Married', 'Oxford University', 'Mathematics, Science, Art, Computer, History', 'Islam', 'Kwara State', '25350', '09/06/1988', '837392646059928809', 1, 'Applicant', 1, '674393539566476484', '2020-07-23 08:17:25', 23, 7, 2020, '8.17am'),
(3, 'tola@gmail.com', 'Tola', 'Adebisi', 'Flat7, High street, off Babatunde layout, Oba-Ile, Akure.', 'Divorced', 'University of Texas', 'Mathematics, Civic, History, Agriculture', 'Traditional', 'Edo State', '16164', '07/17/1992', '947337187454694104', 1, 'Applicant', 1, '528751131892056959', '2020-07-23 08:19:11', 23, 7, 2020, '8.19am');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `maidenname` varchar(50) NOT NULL,
  `phone_digit` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `s_token` varchar(16) NOT NULL,
  `created` datetime NOT NULL,
  `s_day` int(11) NOT NULL,
  `s_month` int(11) NOT NULL,
  `s_year` int(11) NOT NULL,
  `level_access` int(11) NOT NULL,
  `verify_string` varchar(18) NOT NULL,
  `siteinfo_id` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `verify_email` int(11) NOT NULL,
  `Active_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `maidenname`, `phone_digit`, `email`, `password`, `user_type`, `s_token`, `created`, `s_day`, `s_month`, `s_year`, `level_access`, `verify_string`, `siteinfo_id`, `Active`, `verify_email`, `Active_client`) VALUES
(1, 'Adetayo', 'Michael', 'Caroline', '07032819318', 'teewinebravo@yahoo.com', 'a04ce4f25ad79ff8ba880390edfb1ab4', 'AAplicant', '25350', '2017-12-11 11:12:41', 2, 12, 2020, 2, '416472132595866051', 1, 1, 1, 1),
(3, 'Adeniyi', 'Solomon', 'Comfort', '08030640639', 'adminbravo@yahoo.com', '21232f297a57a5a743894a0e4a801fc3', 'Applicant', '16164', '2017-12-11 12:12:44', 2, 12, 2020, 2, '202535607657281978', 2, 1, 1, 1),
(4, 'Oluwatoyin', 'Stella', 'Esther', '08067728195', 'applicant@gmail.com', '33c0ee425e2c0efe834afc1aa1e33a4c', 'Applicant', '54545', '2017-12-11 12:12:44', 3, 12, 2020, 2, '202535607657281978', 2, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

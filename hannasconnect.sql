-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2023 at 08:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hannasconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(36) NOT NULL,
  `name` varchar(36) DEFAULT NULL,
  `category_id` int(36) DEFAULT NULL,
  `profession` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) NOT NULL,
  `slogan` text DEFAULT NULL,
  `county` varchar(36) DEFAULT NULL,
  `sub_counry` varchar(36) DEFAULT NULL,
  `ward` varchar(36) DEFAULT NULL,
  `email` varchar(36) DEFAULT NULL,
  `bkf` text DEFAULT NULL,
  `physical_address` varchar(36) DEFAULT NULL,
  `location_pin` text DEFAULT NULL,
  `website` varchar(36) DEFAULT NULL,
  `working_days` text DEFAULT NULL,
  `open_at` varchar(36) DEFAULT NULL,
  `clsoing_at` varchar(36) DEFAULT NULL,
  `social_links` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `price_negotiable` varchar(1) DEFAULT NULL,
  `key_words` text DEFAULT NULL,
  `plan` int(1) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `branches` text DEFAULT NULL,
  `looking_for` varchar(36) DEFAULT NULL,
  `experience` varchar(30) DEFAULT NULL,
  `education_level` text DEFAULT NULL,
  `skill` varchar(50) DEFAULT NULL,
  `salary_expectation` double DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `service` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `category_id`, `profession`, `user_id`, `slogan`, `county`, `sub_counry`, `ward`, `email`, `bkf`, `physical_address`, `location_pin`, `website`, `working_days`, `open_at`, `clsoing_at`, `social_links`, `price`, `price_negotiable`, `key_words`, `plan`, `message`, `branches`, `looking_for`, `experience`, `education_level`, `skill`, `salary_expectation`, `image_url`, `service`) VALUES
(49, 'Caryn Crosby', 1, 'Nurse', '88', 'Veniam facilis est ', 'Siaya', 'ugenya', 'ukwala', 'zagyqo@mailinator.com', 'test', '2', 'test', 'test.com', 'Monday', '16:46', '16:47', '', '600', 'Y', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Vernon Higgins', 2, 'Software developer', '89', 'Ut nesciunt vitae d', 'Laikipia', '', '', 'fohahehywu@mailinator.com', '', NULL, 'Sunt architecto qua', '', '', '', '', '', NULL, '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Galena Hawkins', 3, NULL, '91', 'Aspernatur ut duis c', 'Garissa', 'garissa township', 'galbet', 'nejaqiv@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '799', 'N', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(52, 'Chloe Maddox', 2, NULL, '92', 'Nemo et unde eos id ', 'Elgeyo Marakwet', 'marakwet east', 'sambirir', 'magun@mailinator.com', 'None', NULL, '', 'kevin.com', '', '17:49', '', '', NULL, 'N', '', 0, 'Hellos', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Myles George', 2, NULL, '93', 'Do sed omnis ipsam q', 'Garissa', 'garissa township', 'waberi', 'muloqywoj@mailinator.com', 'uilwh', NULL, '', 'none', '', '18:55', '', '', NULL, 'N', '', 0, 'edhie', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Test', 3, NULL, '94', '', 'Mombasa', 'changamwe', 'port reitz', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '499', 'N', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Breakdown/Flatbed'),
(55, 'test', 3, NULL, '95', 'test', 'Mombasa', 'changamwe', 'port reitz', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3000', 'N', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Fire brigade'),
(56, 'test', 3, NULL, '96', 'hello', 'Mombasa', 'mvita', 'tononoka', 'admin2@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3000', 'N', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Breakdown/Flatbed'),
(57, 'test', 3, NULL, '98', 'test', 'Mombasa', 'changamwe', '', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3000', 'N', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ambulance'),
(58, 'yeyey', 3, NULL, '99', 'yeyey', 'Mombasa', 'changamwe', '', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'N', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Breakdown/Flatbed'),
(59, 'kevin', 3, NULL, '106', 'hgfdfgh', 'Marsabit', 'laisamis', 'loiyangalani', 'okombakevin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9000', 'Y', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Fire brigade'),
(60, 'kevin', 1, 'Software developer', '106', 'hgfdfgh', 'Meru', 'igembe south', 'maua', 'okombakevin@gmail.com', 'sysyem dedsign', '2', 'none', 'none', 'Saturday', '23:27', '23:29', 'no', '300', 'N', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'kevin', 2, NULL, '106', 'Hello', 'Kitui', 'mwingi north', 'ngomeni', 'okombakevin@gmail.com', 'test', NULL, 'none', '', '', '23:32', '23:29', '', NULL, 'N', '', 0, 'welcome', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'kevin', 4, 'graphic_designer', '106', 'helllo', 'Kwale', 'lungalunga', 'pongwekikoneni', 'okombakevin@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Attachment', NULL, 'kiambu school', 'cooking', 3000, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(36) NOT NULL,
  `name` varchar(36) NOT NULL,
  `email` varchar(36) NOT NULL,
  `phone` varchar(36) NOT NULL,
  `category_id` varchar(36) NOT NULL,
  `password` varchar(100) NOT NULL,
  `otp` int(4) NOT NULL,
  `verified` int(36) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `role` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `category_id`, `password`, `otp`, `verified`, `created_at`, `updated_at`, `role`) VALUES
(89, 'Vernon Higgins', 'fohahehywu@mailinator.com', '+1 (541) 683-5521', '2', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 0, '2023-08-24 17:22:11', '2023-08-24 17:22:11', '1'),
(90, 'Whoopi Forbes', 'mazola@mailinator.com', '+1 (715) 451-3951', '4', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 0, '2023-08-24 17:22:21', '2023-08-24 17:22:21', '1'),
(91, 'Galena Hawkins', 'nejaqiv@mailinator.com', '+1 (885) 604-1395', '3', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 0, '2023-08-24 17:22:41', '2023-08-24 17:22:41', '1'),
(93, 'Myles George', 'muloqywoj@mailinator.com', '+1 (301) 963-6774', '2', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 0, '2023-08-24 18:51:32', '2023-08-24 18:51:32', '1'),
(94, 'Test', 'admin@admin.com', 'admin@admin.com', '3', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '2023-09-04 11:04:54', '2023-09-04 11:04:54', '1'),
(96, 'test', 'admin2@admin.com', 'admin2@admin.com', '3', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '2023-09-04 11:10:42', '2023-09-04 11:10:42', '1'),
(97, 'sdfgh', 'test@admin.com', '07896756', '3', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, '2023-09-04 11:14:20', '2023-09-04 11:14:20', '1'),
(98, 'test', 'admin@admin.com', '0701564535', '3', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '2023-09-04 11:15:16', '2023-09-04 11:15:16', '1'),
(99, 'yeyey', 'admin@admin.com', '089765766', '3', '21232f297a57a5a743894a0e4a801fc3', 0, 0, '2023-09-04 11:17:31', '2023-09-04 11:17:31', '1'),
(106, 'kevin', 'okombakevin@gmail.com', '0701451519', '', 'e10adc3949ba59abbe56e057f20f883e', 9579, 1, '2023-09-04 22:43:18', '2023-09-04 22:43:18', '1'),
(114, 'Kevin', 'kevindevsltd@gmail.com', '0789141516', '', 'e10adc3949ba59abbe56e057f20f883e', 3166, 0, '2023-09-07 09:46:28', '2023-09-07 09:46:28', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

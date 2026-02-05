-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2026 at 09:07 AM
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
-- Database: `call_billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `call_records`
--

DROP TABLE IF EXISTS `call_records`;
CREATE TABLE IF NOT EXISTS `call_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `call_uuid` varchar(64) NOT NULL,
  `call_date` datetime DEFAULT NULL,
  `direction` varchar(20) DEFAULT NULL,
  `from_number` varchar(30) DEFAULT NULL,
  `to_number` varchar(30) DEFAULT NULL,
  `billsec` int DEFAULT '0',
  `bill_minutes` int DEFAULT '0',
  `rate_per_min` decimal(5,2) DEFAULT '3.00',
  `amount` decimal(10,2) DEFAULT '0.00',
  `status` varchar(20) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_call_uuid` (`call_uuid`),
  KEY `user_id` (`user_id`),
  KEY `call_date` (`call_date`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `call_records`
--

INSERT INTO `call_records` (`id`, `user_id`, `call_uuid`, `call_date`, `direction`, `from_number`, `to_number`, `billsec`, `bill_minutes`, `rate_per_min`, `amount`, `status`, `paid`, `created_at`) VALUES
(71, 1, '87f3b82f-70aa-123f-09ad-02d069b81a19', '2026-01-20 13:55:33', 'inbound', '+919999668250', '08071387150', 70, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:40:05'),
(69, 1, 'hTEYo7gfwlY4br9oxeJyS1iABMv', '2026-01-20 16:07:41', 'outbound', '+918071387150', '+919999668250', 35, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:40:05'),
(70, 1, 'd2a87a32-70aa-123f-09ad-02d069b81a19', '2026-01-20 13:57:39', 'inbound', '+919999668250', '08071387150', 58, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:40:05'),
(62, 1, 'ddkGyTM0Yc5UOaCV1lphBfUmp3A', '2026-01-20 16:09:07', 'outbound', '+918071387150', '+918417830102', 124, 3, 3.00, 9.00, 'Answered', 0, '2026-01-24 11:38:53'),
(61, 1, 'bba79dc4-712c-123f-59ae-02d069b81a19', '2026-01-21 05:27:34', 'inbound', '+919999668250', '08071387150', 45, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(60, 1, '95ff9607-7138-123f-59ae-02d069b81a19', '2026-01-21 06:52:25', 'inbound', '+919999668250', '08071387150', 7, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(59, 1, 'haUe1lC7Tjj2asBePn1iz73IHfOB', '2026-01-21 11:08:18', 'outbound', '+918071387150', '+919559949227', 12, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(58, 1, 'ee193de3-715f-123f-61ae-02d069b81a19', '2026-01-21 11:34:03', 'inbound', '+919999668250', '08071387150', 111, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(57, 1, 'WYefnaAYcUj8L55pjRtcbUfCuTxA', '2026-01-21 11:37:30', 'outbound', '+918071387150', '+919999668250', 94, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(56, 1, 'iI2fRz3YK4phvcP7OejAXo1e2yWA', '2026-01-21 11:54:37', 'outbound', '+918071387150', '+919999668250', 84, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(55, 1, 'd52179c4-7163-123f-61ae-02d069b81a19', '2026-01-21 12:02:00', 'inbound', '+919999668250', '08071387150', 22, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(54, 1, 'uO2HehbGsCfDMwbjhbYeVFckGmQB', '2026-01-21 12:19:10', 'outbound', '+918071387150', '+919999668250', 24, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(53, 1, 'e2d8d227-718a-123f-62ae-02d069b81a19', '2026-01-21 16:41:33', 'inbound', '+919999668250', '08071387150', 59, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(52, 1, 'f5fee426-71f6-123f-c5b3-02d069b81a19', '2026-01-22 05:35:11', 'inbound', '+919999668250', '08071387150', 62, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(51, 1, '68c52356-71fb-123f-c6b3-02d069b81a19', '2026-01-22 06:07:01', 'inbound', '+919999668250', '08071387150', 135, 3, 3.00, 9.00, 'Answered', 0, '2026-01-24 11:38:53'),
(50, 1, 'dda91579-721c-123f-d4b3-02d069b81a19', '2026-01-22 10:06:31', 'inbound', '+919999668250', '08071387150', 93, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(49, 1, 'W0xVRjKbLKZo2g6AiOj05rqvEdA', '2026-01-22 10:59:12', 'outbound', '+918071387150', '+919508949406', 62, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(48, 1, '46osRgEe93rgZDp0a2gLjx0o5bP', '2026-01-22 12:24:15', 'outbound', '+918071387150', '+917398883028', 86, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(47, 1, '7eda3e92-7230-123f-e5b3-02d069b81a19', '2026-01-22 12:27:02', 'inbound', '+919999668250', '08071387150', 163, 3, 3.00, 9.00, 'Answered', 0, '2026-01-24 11:38:53'),
(46, 1, 'lkfgxZ6xkuA3FEfGW9aYfecKRvVA', '2026-01-22 14:50:28', 'outbound', '+918071387150', '+919161446622', 55, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(45, 1, 'e95b8392-7244-123f-e6b3-02d069b81a19', '2026-01-22 14:53:10', 'inbound', '+919999668250', '08071387150', 135, 3, 3.00, 9.00, 'Answered', 0, '2026-01-24 11:38:53'),
(44, 1, '63578a14-72c3-123f-f4a2-02d069b81a19', '2026-01-23 05:58:32', 'inbound', '+919999668250', '08071387150', 54, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(43, 1, 'c50f4dfa-72d5-123f-f7a2-02d069b81a19', '2026-01-23 08:10:06', 'inbound', '+919999668250', '08071387150', 4, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(42, 1, '5bf39f52-72d6-123f-f7a2-02d069b81a19', '2026-01-23 08:14:20', 'inbound', '+919999668250', '08071387150', 39, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(41, 1, 'XHhru78zEQ9wZZ41t9sPQGJonTC', '2026-01-23 08:28:14', 'outbound', '+918071387150', '+919508949406', 151, 3, 3.00, 9.00, 'Answered', 0, '2026-01-24 11:38:53'),
(40, 1, '3lrRg8ZQH7Csgdz6FCya0eJtoAW', '2026-01-23 12:58:06', 'outbound', '+918071387150', '+918318262800', 61, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(39, 1, 'aaf5499a-72fe-123f-6ca7-02d069b81a19', '2026-01-23 13:02:52', 'inbound', '+917800698338', '08071387150', 25, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(38, 1, '5c73bd25-7301-123f-6da7-02d069b81a19', '2026-01-23 13:22:09', 'inbound', '+918134836001', '08071387150', 114, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(37, 1, '7277a9ef-7305-123f-6da7-02d069b81a19', '2026-01-23 13:51:24', 'inbound', '+919999668250', '08071387150', 38, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(36, 1, 'ly6io5t361YNBVTXd5bK9UDptqC', '2026-01-23 14:19:59', 'outbound', '+918071387150', '+918134836001', 187, 4, 3.00, 12.00, 'Answered', 0, '2026-01-24 11:38:53'),
(35, 1, '44Bj7V1MIievSe3kV1YwXgp3Zok', '2026-01-24 09:19:00', 'outbound', '+918071387150', '+919025211078', 29, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(66, 1, '3e4e80c9-70aa-123f-09ad-02d069b81a19', '2026-01-20 13:53:30', 'inbound', '+919999668250', '08071387150', 114, 2, 3.00, 6.00, 'Answered', 0, '2026-01-24 11:38:53'),
(67, 1, 'W66vsihE8OofncY4qxUYsqwf4A2', '2026-01-20 08:46:01', 'outbound', '+918071387150', '+919999668250', 56, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53'),
(68, 1, '179c793d-707f-123f-03ad-02d069b81a19', '2026-01-20 08:44:36', 'inbound', '+919999668250', '08071387150', 6, 1, 3.00, 3.00, 'Answered', 0, '2026-01-24 11:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT '0.00',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

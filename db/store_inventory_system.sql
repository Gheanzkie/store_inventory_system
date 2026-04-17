-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2026 at 01:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Beverages'),
(2, 'Snacks'),
(3, 'Canned Goods'),
(4, 'Personal Care'),
(5, 'Household Items');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `attempt_time` datetime NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `email`, `ip_address`, `attempt_time`, `user_agent`) VALUES
(36, 'glennazuelo1@gmail.com', '::142432432', '2025-04-15 13:15:00', ''),
(93, 'fd@gmail', '::1', '2026-03-31 14:36:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `stock`) VALUES
(1, 1, 'Coke', 20.00, 32),
(2, 2, 'Canton', 13.00, 51),
(3, 1, 'Coke Sakto', 20.00, 46),
(4, 1, 'Sprite Sakto', 20.00, 49),
(5, 1, 'Royal Sakto', 20.00, 48),
(6, 1, 'Zesto Orange', 12.00, 80),
(7, 1, 'Zesto Apple', 12.00, 80),
(8, 1, 'Mineral Water 500ml', 15.00, 99),
(9, 1, 'Energen Vanilla', 25.00, 60),
(10, 1, 'Energen Chocolate', 25.00, 60),
(11, 1, 'Nestea Iced Tea', 20.00, 60),
(12, 1, 'C2 Apple', 18.00, 60),
(13, 1, 'C2 Lemon', 18.00, 59),
(14, 1, 'Gatorade Blue', 35.00, 40),
(15, 1, 'Milo Ready to Drink', 25.00, 50),
(16, 1, 'Bear Brand Milk', 20.00, 70),
(17, 1, 'Nescafe 3in1', 10.00, 120),
(18, 1, 'Kopiko Brown Coffee', 10.00, 120),
(19, 1, 'Great Taste White', 10.00, 120),
(20, 1, 'Lipton Yellow Label', 8.00, 100),
(21, 1, 'Tang Juice Powder', 6.00, 150),
(22, 1, 'Mogu Mogu Drink', 30.00, 50),
(23, 2, 'Lucky Me Pancit Canton Original', 15.00, 120),
(24, 2, 'Lucky Me Pancit Canton Chili', 15.00, 120),
(25, 2, 'Nissin Cup Noodles', 20.00, 79),
(26, 2, 'Piattos Cheese', 20.00, 80),
(27, 2, 'Nova Cheese', 18.00, 80),
(28, 2, 'Chippy BBQ', 15.00, 100),
(29, 2, 'V-Cut Spicy', 15.00, 99),
(30, 2, 'Boy Bawang Garlic', 12.00, 120),
(31, 2, 'Boy Bawang Adobo', 12.00, 120),
(32, 2, 'Oishi Prawn Crackers', 10.00, 100),
(33, 2, 'Skyflakes', 9.00, 120),
(34, 2, 'Fita Crackers', 10.00, 120),
(35, 2, 'Magic Flakes', 8.00, 119),
(36, 2, 'Hansel Sandwich', 10.00, 99),
(37, 2, 'Jack n Jill Roller Coaster', 12.00, 100),
(38, 2, 'Cloud 9 Chocolate', 10.00, 100),
(39, 2, 'Hany Milk Chocolate', 8.00, 100),
(40, 2, 'M&M Small', 25.00, 59),
(41, 2, 'Snickers Mini', 20.00, 60),
(42, 2, 'Lays Chips Small', 35.00, 49),
(43, 3, 'Mega Sardines', 22.00, 99),
(44, 3, '555 Sardines', 21.00, 100),
(45, 3, 'Ligo Sardines', 23.00, 100),
(46, 3, 'Century Tuna Flakes', 35.00, 80),
(47, 3, 'Century Tuna Hot & Spicy', 36.00, 80),
(48, 3, 'Argentina Corned Beef', 45.00, 58),
(49, 3, 'Purefoods Corned Beef', 48.00, 59),
(50, 3, 'Swift Corned Beef', 40.00, 60),
(51, 3, 'Argentina Beef Loaf', 40.00, 59),
(52, 3, 'Holiday Corned Beef', 38.00, 60),
(53, 3, 'Del Monte Corn', 25.00, 80),
(54, 3, 'Del Monte Pineapple', 30.00, 80),
(55, 3, 'Libbys Vienna Sausage', 55.00, 50),
(56, 3, 'Youngs Town Sardines', 20.00, 100),
(57, 3, 'Mega Tuna Chili', 30.00, 80),
(58, 3, '555 Tuna Adobo', 28.00, 80),
(59, 3, '555 Tuna Afritada', 28.00, 80),
(60, 3, 'Century Tuna Light', 35.00, 80),
(61, 3, 'Mega Corned Beef', 42.00, 60),
(62, 3, 'Argentina Meat Loaf', 40.00, 60),
(63, 4, 'Safeguard Soap', 45.00, 100),
(64, 4, 'Dove Soap', 60.00, 79),
(65, 4, 'Colgate Toothpaste', 55.00, 90),
(66, 4, 'Closeup Toothpaste', 50.00, 90),
(67, 4, 'Hapee Toothpaste', 35.00, 100),
(68, 4, 'Sunsilk Shampoo', 65.00, 80),
(69, 4, 'Palmolive Shampoo', 60.00, 80),
(70, 4, 'Head & Shoulders', 120.00, 60),
(71, 4, 'Rexona Deodorant', 75.00, 70),
(72, 4, 'Nivea Deodorant', 90.00, 60),
(73, 4, 'Alcohol 70%', 55.00, 100),
(74, 4, 'Hand Sanitizer', 50.00, 100),
(75, 4, 'Cotton Buds', 20.00, 120),
(76, 4, 'Toothbrush Soft', 25.00, 120),
(77, 4, 'Face Mask Pack', 30.00, 150),
(78, 4, 'Johnson Baby Powder', 85.00, 60),
(79, 4, 'Pantene Shampoo', 120.00, 60),
(80, 4, 'Cream Silk Conditioner', 110.00, 60),
(81, 4, 'Gillette Razor', 45.00, 80),
(82, 4, 'Colgate Mouthwash', 95.00, 60),
(83, 5, 'Dishwashing Liquid', 35.00, 100),
(84, 5, 'Laundry Powder', 60.00, 80),
(85, 5, 'Bleach', 40.00, 80),
(86, 5, 'Trash Bags', 30.00, 120),
(87, 5, 'Broom', 80.00, 50),
(88, 5, 'Dustpan', 25.00, 60),
(89, 5, 'Mop Stick', 120.00, 40),
(90, 5, 'Floor Cleaner', 90.00, 60),
(91, 5, 'Air Freshener', 75.00, 70),
(92, 5, 'Insect Spray', 85.00, 70),
(93, 5, 'Candle Small', 10.00, 200),
(94, 5, 'Matchsticks', 5.00, 200),
(95, 5, 'Sponge', 15.00, 120),
(96, 5, 'Steel Wool', 10.00, 120),
(97, 5, 'Plastic Container', 45.00, 80),
(98, 5, 'Cloth Hanger', 20.00, 120),
(99, 5, 'Laundry Basket', 150.00, 40),
(100, 5, 'Bucket', 70.00, 60),
(101, 5, 'Water Dipper', 25.00, 80),
(102, 5, 'Rubber Gloves', 35.00, 100);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `payment_method` enum('cash','card','gcash','maya') DEFAULT 'cash',
  `amount_received` decimal(10,2) DEFAULT 0.00,
  `change_amount` decimal(10,2) DEFAULT 0.00,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `age` int(30) NOT NULL,
  `contact` int(15) NOT NULL,
  `bday` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `fname`, `mname`, `lname`, `age`, `contact`, `bday`, `email`, `username`, `password`, `role`) VALUES
(1, 'Ghean', 'domingo', 'dela cruz', 34, 2147483647, '2222-03-22', 'Gheanghean09@gmail.com', '123', '$2y$10$cXfhCA/iQqFDhHZZAIp29uk8yiE92WZZwuY5eB/ajE2', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `LOGID` int(11) NOT NULL,
  `USERID` varchar(30) DEFAULT NULL,
  `ACTION` text DEFAULT NULL,
  `DATELOG` varchar(30) DEFAULT NULL,
  `TIMELOG` varchar(30) DEFAULT NULL,
  `user_ip_address` text DEFAULT NULL,
  `device_used` text DEFAULT NULL,
  `USER_NAME` varchar(100) DEFAULT NULL,
  `identifier` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`LOGID`, `USERID`, `ACTION`, `DATELOG`, `TIMELOG`, `user_ip_address`, `device_used`, `USER_NAME`, `identifier`) VALUES
(58, '12', 'New Staff added: Ghean delacruz', '2026-04-01', '00:43:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(59, '12', 'Login: Arnelle', '2026-04-01', '21:44:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(60, '12', 'Logout', '2026-04-01', '22:00:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(61, '12', 'Login: Arnelle', '2026-04-01', '22:00:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(62, '12', 'Logout', '2026-04-01', '22:01:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(63, '12', 'Login: Arnelle', '2026-04-01', '22:01:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(64, '12', 'New Product has been added: Code', '2026-04-01', '23:55:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(65, '12', 'Product has been updated: Coke', '2026-04-01', '23:56:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(66, '12', 'Login: Arnelle', '2026-04-02', '20:18:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(67, '12', 'Product has been updated: Coke', '2026-04-02', '20:23:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(68, '12', 'Deleted product: Coke', '2026-04-02', '20:23:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETED'),
(69, '12', 'New Product has been added: Coke', '2026-04-02', '20:53:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(70, '12', 'Staff updated: Ghean dela cruz', '2026-04-02', '20:57:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(71, '12', 'Login: Arnelle', '2026-04-02', '22:22:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(72, '12', 'Logout', '2026-04-02', '22:41:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(73, '12', 'Login: Arnelle', '2026-04-02', '22:41:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(74, '12', 'Logout', '2026-04-02', '22:41:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(75, '12', 'Login: Arnelle', '2026-04-02', '22:41:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(76, NULL, 'Logout', '2026-04-02', '22:49:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(77, NULL, 'Login: Arnelle', '2026-04-02', '22:58:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', NULL, 'LOGIN'),
(78, NULL, 'Logout', '2026-04-02', '22:58:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', NULL, 'LOGOUT'),
(79, '12', 'Login: Arnelle', '2026-04-02', '23:12:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(80, '12', 'Logout', '2026-04-02', '23:49:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(81, '12', 'Login: Arnelle', '2026-04-03', '00:01:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(82, '12', 'Logout', '2026-04-03', '00:01:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(83, '12', 'Login: Arnelle', '2026-04-04', '14:01:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(84, '12', 'Logout', '2026-04-04', '14:08:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(85, '12', 'Login: Arnelle', '2026-04-04', '14:22:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(86, '12', ';Logout', '2026-04-04', '14:37:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(87, '12', 'Login: Arnelle', '2026-04-04', '14:37:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(88, '12', 'Logoutdf', '2026-04-04', '14:38:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUTfd'),
(89, '12', 'Login: Arnelle', '2026-04-04', '14:38:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(90, '12', 'Logout', '2026-04-04', '14:51:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(91, '12', 'Login: Arnelle', '2026-04-04', '14:51:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(92, '12', 'Logout', '2026-04-04', '14:52:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(93, '12', 'Login: Arnelle', '2026-04-04', '14:52:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(94, '12', 'Logout', '2026-04-04', '14:54:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(95, '12', 'Login: Arnelle', '2026-04-04', '14:54:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(96, '12', 'New User has been apdated: Arnelle', '2026-04-04', '14:54:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(97, '12', 'Logout', '2026-04-04', '14:55:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(98, '12', 'Login: Arnelle', '2026-04-04', '14:55:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(99, '12', 'Logout', '2026-04-04', '14:55:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(100, '12', 'Login: Arnelle', '2026-04-04', '14:55:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(101, '12', 'New User has been added: Ghean', '2026-04-04', '14:56:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(102, '12', 'Logout', '2026-04-04', '14:56:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(103, '13', 'Login: Ghean', '2026-04-04', '14:57:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(104, '13', 'Logout', '2026-04-04', '14:57:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(105, '12', 'Login: Arnelle', '2026-04-04', '14:57:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(106, '12', 'Logout', '2026-04-04', '15:08:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(107, '12', 'Login: Arnelle', '2026-04-04', '15:08:25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(108, '12', 'Logout', '2026-04-04', '15:08:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(109, '12', 'Login: Arnelle', '2026-04-04', '15:08:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(110, '12', 'New User has been apdated: Ghean', '2026-04-04', '15:15:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(111, '12', 'New User has been apdated: Ghean', '2026-04-04', '15:16:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(112, '12', 'New User has been apdated: Ghean', '2026-04-04', '15:17:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(113, '12', 'New Product has been added: Coke', '2026-04-04', '15:29:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(114, '12', 'Product has been updated: Sky Flakes', '2026-04-04', '15:48:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(115, '12', 'Logout', '2026-04-04', '17:09:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(116, '12', 'Login: Arnelle', '2026-04-04', '17:09:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(117, '12', 'Logout', '2026-04-04', '17:30:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(118, '12', 'Login: Arnelle', '2026-04-04', '17:30:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(119, '12', 'New User has been apdated: Ghean', '2026-04-04', '19:12:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(120, '12', 'Logout', '2026-04-04', '19:12:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(121, '13', 'Login: Ghean', '2026-04-04', '19:12:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(122, '13', 'Logout', '2026-04-04', '19:13:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(123, '12', 'Login: Arnelle', '2026-04-04', '19:13:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(124, '12', 'New User has been apdated: Ghean', '2026-04-04', '19:13:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(125, '12', 'Logout', '2026-04-04', '19:14:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(126, '12', 'Login: Arnelle', '2026-04-04', '19:14:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(127, '12', 'Logout', '2026-04-04', '19:15:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(128, '13', 'Login: Ghean', '2026-04-04', '19:15:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(129, '13', 'Product has been updated: Cokes', '2026-04-04', '19:44:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'UPDATED'),
(130, '13', 'Product has been updated: Coke', '2026-04-04', '19:44:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'UPDATED'),
(131, '13', 'Logout', '2026-04-04', '19:44:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(132, '12', 'Login: Arnelle', '2026-04-04', '19:44:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(133, '12', 'New Product has been added: Coke', '2026-04-04', '21:11:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(134, '12', 'Product has been updated: Coke', '2026-04-04', '21:12:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(135, '12', 'Product has been updated: Coke', '2026-04-04', '21:13:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(136, '12', 'New Product has been added: juice', '2026-04-04', '21:15:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(137, '12', 'Deleted product: juice', '2026-04-04', '21:17:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETED'),
(138, '12', 'New Product has been added: haha', '2026-04-04', '21:26:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(139, '12', 'New Product has been added: 54', '2026-04-04', '21:32:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(140, '12', 'Logout', '2026-04-04', '21:43:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(141, '13', 'Login: Ghean', '2026-04-04', '21:43:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(142, '13', 'New Product has been added: Coke', '2026-04-04', '21:43:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'ADD'),
(143, '13', 'Logout', '2026-04-04', '22:03:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(144, '12', 'Login: Arnelle', '2026-04-04', '22:03:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(145, '12', 'Login: Arnelle', '2026-04-05', '20:21:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(146, '12', 'New Sale added: ₱200', '2026-04-05', '20:53:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(147, '12', 'Sale updated ID: 3', '2026-04-05', '21:24:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATE'),
(148, '12', 'New Sale added: ₱2000', '2026-04-05', '21:29:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(149, '12', 'Logout', '2026-04-05', '21:29:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(150, '13', 'Login: Ghean', '2026-04-05', '21:29:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(151, '13', 'New Sale added: ₱500', '2026-04-05', '21:29:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'ADD'),
(152, '13', 'New Sale added: ₱6034', '2026-04-05', '21:29:52', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'ADD'),
(153, '13', 'Logout', '2026-04-05', '21:29:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(154, '12', 'Login: Arnelle', '2026-04-05', '21:30:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(155, '12', 'New User has been apdated: Ghean', '2026-04-05', '21:30:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(156, '12', 'Logout', '2026-04-05', '21:30:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(157, '13', 'Login: Ghean', '2026-04-05', '21:30:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(158, '13', 'Logout', '2026-04-05', '21:30:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(159, '12', 'Login: Arnelle', '2026-04-05', '21:30:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(160, '12', 'New User has been apdated: Ghean', '2026-04-05', '21:31:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(161, '12', 'Sale deleted ID: 3', '2026-04-05', '22:03:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETE'),
(162, '12', 'Sale deleted ID: 4', '2026-04-05', '22:03:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETE'),
(163, '12', 'Sale deleted ID: 5', '2026-04-05', '22:03:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETE'),
(164, '12', 'Login: Arnelle', '2026-04-08', '22:16:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(165, '12', 'Sale deleted ID: 6', '2026-04-08', '22:17:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETE'),
(166, '12', 'New Product has been added: Coke', '2026-04-08', '23:02:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(167, '12', 'New Sale added: ₱100', '2026-04-08', '23:12:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(168, '12', 'New Sale created ID: 3', '2026-04-09', '00:36:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(169, '12', 'Sale deleted ID: 3', '2026-04-09', '00:37:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'DELETE'),
(170, '12', 'Login: Arnelle', '2026-04-09', '13:21:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(171, '12', 'Login: Arnelle', '2026-04-09', '13:21:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(172, '12', 'Login: Arnelle', '2026-04-11', '18:29:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(173, '12', 'Logout', '2026-04-11', '18:29:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(174, '12', 'Login: Arnelle', '2026-04-11', '18:29:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(175, '12', 'Product has been updated: Coke', '2026-04-11', '18:32:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(176, '12', 'New Product has been added: Canton', '2026-04-11', '18:44:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'ADD'),
(177, '12', 'Product has been updated: Coke', '2026-04-11', '19:15:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(178, '12', 'Logout', '2026-04-11', '21:15:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(179, '12', 'Login: Arnelle', '2026-04-11', '21:15:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(180, '12', 'Product has been updated: Coke', '2026-04-11', '21:19:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(181, '12', 'Login: Arnelle', '2026-04-14', '11:21:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(182, NULL, 'Logout', '2026-04-14', '13:27:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', NULL, 'LOGOUT'),
(183, '12', 'Login: Arnelle', '2026-04-14', '13:27:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(184, '12', 'Login: Arnelle', '2026-04-14', '21:02:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(185, '12', 'Login: Arnelle', '2026-04-14', '22:45:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(186, '12', 'Logout', '2026-04-15', '00:20:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(187, '12', 'Login: Arnelle', '2026-04-15', '21:16:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(188, '12', 'Product has been updated: Canton', '2026-04-15', '22:16:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(189, '12', 'Product has been updated: Canton', '2026-04-16', '00:13:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(190, '12', 'Product has been updated: Canton', '2026-04-16', '00:42:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(191, '12', 'Logout', '2026-04-16', '00:49:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(192, '12', 'Login: Arnelle', '2026-04-16', '00:49:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(193, '12', 'Logout', '2026-04-16', '01:12:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(194, '12', 'Login: Arnelle', '2026-04-16', '01:18:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(195, '12', 'New User has been apdated: Ghean', '2026-04-16', '01:49:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(196, '12', 'New User has been apdated: Ghean', '2026-04-16', '01:49:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'UPDATED'),
(197, '12', 'Logout', '2026-04-16', '01:49:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT'),
(198, '13', 'Login: Ghean', '2026-04-16', '01:49:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Ghean', 'LOGIN'),
(199, '13', 'Logout', '2026-04-16', '01:50:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Ghean', 'LOGOUT'),
(200, '12', 'Login: Arnelle', '2026-04-16', '01:50:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGIN'),
(201, '12', 'Logout', '2026-04-16', '01:51:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Arnelle', 'LOGOUT');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `name`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'ghean123', '$2y$10$WeuCOSyW.yRAnBwX1GRMwO2l7Z2RROMZxVDEpOT1f1M2Gge/TFJH6', 'admin', 'Active', 'Arnelle', '09278809655', '2026-02-20 02:35:30', '2026-04-04 07:07:58', '2026-04-03 22:54:58'),
(13, 'ghean1234', '$2y$10$.KGYOupg/dtsOM3ku/.TIOVXUuuquBJI0OOGd..naImFboY5zUAsa', 'Staff', 'Active', 'Ghean', '09278809655', '2026-04-04 06:56:54', '2026-04-15 09:49:39', '2026-04-15 09:49:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sale` (`sale_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`LOGID`),
  ADD KEY `USERID` (`USERID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `LOGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

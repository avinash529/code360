-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 06, 2025 at 11:03 AM
-- Server version: 8.3.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code360test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

DROP TABLE IF EXISTS `tblpayments`;
CREATE TABLE IF NOT EXISTS `tblpayments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(100) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblproductclass`
--

DROP TABLE IF EXISTS `tblproductclass`;
CREATE TABLE IF NOT EXISTS `tblproductclass` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblproductclass`
--

INSERT INTO `tblproductclass` (`id`, `class_name`) VALUES
(1, 'Electronics'),
(2, 'Furniture'),
(3, 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

DROP TABLE IF EXISTS `tblproducts`;
CREATE TABLE IF NOT EXISTS `tblproducts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `subclass_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `subclass_id` (`subclass_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `class_id`, `subclass_id`, `product_name`, `amount`, `created_at`) VALUES
(1, 1, 1, 'iPhone 14', 89999.00, '2025-05-13 14:34:08'),
(2, 1, 2, 'Dell Inspiron 15', 58990.00, '2025-05-13 14:34:08'),
(3, 2, 4, 'Dining Table 6 Seater', 12000.00, '2025-05-13 14:34:08'),
(4, 3, 7, 'Men’s Formal Shirt', 999.00, '2025-05-13 14:34:08'),
(5, 3, 8, 'Women’s Kurti', 799.00, '2025-05-13 14:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductsubclass`
--

DROP TABLE IF EXISTS `tblproductsubclass`;
CREATE TABLE IF NOT EXISTS `tblproductsubclass` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `subclass_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblproductsubclass`
--

INSERT INTO `tblproductsubclass` (`id`, `class_id`, `subclass_name`) VALUES
(1, 1, 'Mobile Phones'),
(2, 1, 'Laptops'),
(3, 1, 'Televisions'),
(4, 2, 'Tables'),
(5, 2, 'Chairs'),
(6, 2, 'Sofas'),
(7, 3, 'Men'),
(8, 3, 'Women'),
(9, 3, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserregistration`
--

DROP TABLE IF EXISTS `tbluserregistration`;
CREATE TABLE IF NOT EXISTS `tbluserregistration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbluserregistration`
--

INSERT INTO `tbluserregistration` (`id`, `name`, `email`, `username`, `password`, `phone`, `image`, `created_at`) VALUES
(7, 'Avinash R', 'avinashraju815@gmail.com', 'avinash', '$2y$10$3EiDaH8VQG30uCVIrtWNw.H3evPbmXKNa6y01KX6fIibjzqlytDjm', '07025523228', 'Snapchat-343423674.jpg', '2025-05-15 20:26:54'),
(-1, 'admin', 'aviz.raju@gmail.com', 'admin', '$2y$10$qp2Ry07oyL52yKyMcLyOyO7iyOCJnrSaXzqCY0PPZlSp.JTq5bm.S', '7025523228', 'user2.jpg', '2025-05-13 19:53:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

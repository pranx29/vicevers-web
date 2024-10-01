-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2024 at 06:45 PM
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
-- Database: `viceversa_db`
--
CREATE DATABASE IF NOT EXISTS `viceversa_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `viceversa_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`) VALUES
(3, 1),
(4, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE IF NOT EXISTS `cart_item` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  PRIMARY KEY (`cart_item_id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_variant_id` (`product_variant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `cart_id`, `product_variant_id`, `quantity`) VALUES
(1, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(1, 'Shirt', 'Collared and non-collared shirts, often made of cotton or other materials, designed for formal and casual wear.'),
(2, 'T-Shirts', 'Casual wear shirts with a round neck and short sleeves, typically made of cotton or blended fabrics.'),
(3, 'Shorts', 'Casual or sporty trousers that cover the legs up to the knees or higher, made from various fabrics.'),
(20, 'Trouser', 'A wide range of trousers designed for comfort and style, including formal pants, chinos, and casual wear. Explore our selection of fits and fabrics, ideal for office wear, special occasions, or relaxed weekends.');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(50) NOT NULL,
  `hex_code` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`color_id`),
  UNIQUE KEY `color_name` (`color_name`),
  UNIQUE KEY `hex_code` (`hex_code`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color_name`, `hex_code`) VALUES
(1, 'Brick', '#B73C37'),
(2, 'Mid Blue', '#276AB2'),
(3, 'Beige', '#F5F5DC'),
(4, 'White', '#FFFFFF'),
(5, 'Khaki', '#757960'),
(6, 'Grey', '#808080'),
(7, 'Black', '#000000'),
(8, 'Pink', '#FFC0CB'),
(9, 'Cream', '#e8dfd4'),
(21, 'Red', '#FF0000'),
(22, 'Dark Green', '#023020'),
(23, 'Sky Blue', '#87CEEB'),
(24, 'Charcoal', '#3b3e47'),
(25, 'Brown', '#745f4d');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `street`, `city`, `postal_code`, `phone_number`, `user_id`) VALUES
(5, '123, Main Street, Colombo 7', 'Colombo', '11200', '0771234567', 1),
(7, '123, Galle Road, Colombo 03', 'Colombo', '11300', '0711234567', 9),
(8, '122 Street', 'Colombo', '32100', '0761234567', 10);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_method` varchar(255) NOT NULL,
  `status` enum('Pending','Shipped','Delivered') NOT NULL DEFAULT 'Pending',
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `delivery_method`, `status`, `contact_id`) VALUES
(32, 'Standard', 'Delivered', 5),
(33, 'Standard', 'Delivered', 5),
(34, 'Standard', 'Shipped', 5),
(35, 'Standard', 'Pending', 5),
(36, 'Standard', 'Delivered', 7),
(37, 'Standard', 'Pending', 8);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_percentage` decimal(5,2) NOT NULL CHECK (`discount_percentage` >= 0 and `discount_percentage` <= 100),
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`discount_id`),
  UNIQUE KEY `unique_active_discount` (`product_id`,`is_active`,`start_date`,`end_date`),
  KEY `product_id` (`product_id`)
) ;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_percentage`, `start_date`, `end_date`, `is_active`, `product_id`) VALUES
(14, 20.00, '2024-09-25', '2024-10-25', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gift_card`
--

CREATE TABLE IF NOT EXISTS `gift_card` (
  `gift_card_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `value` decimal(10,2) NOT NULL CHECK (`value` >= 0),
  `expiry_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`gift_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` date DEFAULT curdate(),
  `total_amount` decimal(10,2) NOT NULL CHECK (`total_amount` >= 0),
  `status` enum('Processing','Delivered','Cancelled') DEFAULT 'Processing',
  `delivery_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_date`, `total_amount`, `status`, `delivery_id`, `user_id`) VALUES
(30, '2024-09-25', 12989.00, 'Delivered', 32, 1),
(31, '2024-09-25', 8799.00, 'Delivered', 33, 1),
(32, '2024-09-25', 8499.00, 'Processing', 34, 1),
(33, '2024-10-01', 13994.00, 'Processing', 35, 1),
(34, '2024-10-01', 6299.00, 'Processing', 36, 9),
(35, '2024-10-01', 6094.00, 'Processing', 37, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL CHECK (`price` >= 0),
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_variant_id` (`product_variant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_variant_id`, `price`, `quantity`) VALUES
(45, 30, 110, 4500.00, 2),
(46, 30, 96, 1795.00, 2),
(48, 31, 110, 3600.00, 1),
(49, 31, 128, 3900.00, 1),
(51, 32, 110, 3600.00, 1),
(52, 32, 8, 4500.00, 1),
(53, 33, 7, 5900.00, 2),
(54, 33, 90, 1795.00, 1),
(56, 34, 7, 5900.00, 1),
(57, 35, 96, 1795.00, 1),
(58, 35, 139, 3900.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` date DEFAULT curdate(),
  `amount` decimal(10,2) NOT NULL CHECK (`amount` >= 0),
  `payment_method` enum('CreditCard','PayPal') NOT NULL,
  `status` enum('Success','Failed') NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `target_gender` enum('Men','Women','Unisex') NOT NULL,
  `price` decimal(10,2) NOT NULL CHECK (`price` >= 0),
  `date_added` date DEFAULT curdate(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `target_gender`, `price`, `date_added`, `is_active`, `category_id`) VALUES
(3, 'DENIM SHIRT', 'Relaxed fit collared shirt made of cotton denim. Featuring short sleeves, a faded effect, and zip fastening at the front', 'Men', 4500.00, '2024-08-10', 0, 1),
(7, 'CARGO BERMUDA SHORTS', 'Regular fit Bermuda shorts made of a cotton blend. Featuring front pockets, back welt pockets, welt pocket appliqués on the legs, and front zip and hidden metal hook fastening.', 'Men', 5900.00, '2024-08-10', 1, 3),
(8, 'FRAYED DENIM SHORTS', 'Wide-leg Bermuda shorts made of cotton denim. Front pleated detail at the waist. Front pockets and back pockets.', 'Men', 4500.00, '2024-08-10', 1, 3),
(9, 'CARGO SHORTS', 'Regular fit Bermuda shorts made of stretchy technical fabric. Featuring an adjustable elasticated waistband with a matching belt.', 'Men', 4500.00, '2024-08-10', 1, 3),
(30, 'BASIC HEAVY WEIGHT T-SHIRT', 'Oversize T-shirt made of compact cotton. Round neck and short sleeves.', 'Men', 1795.00, '2024-09-24', 1, 2),
(31, 'PRINTED T-SHIRT WITH SLOGANS', 'Relaxed fit T-shirt with a round neck and short sleeves. Contrast prints on the front and back.', 'Men', 2200.00, '2024-09-24', 1, 2),
(32, 'DENIM T-SHIRT', 'Relaxed fit T-shirt made of cotton denim. Featuring a round neck, short sleeves, a faded effect and irregular trims.', 'Men', 2900.00, '2024-09-24', 1, 2),
(33, 'COTTON - LINEN SHIRT', 'Relaxed fit shirt made of a linen and cotton blend. Stand-up collar and long sleeves with buttoned cuffs. Button-up front.', 'Men', 3500.00, '2024-09-24', 1, 1),
(35, 'CARROT FIT TROUSERS', 'Carrot fit trousers in cotton corduroy. Featuring front pockets, patch pockets at the back, and zip fly and top button fastening.', 'Men', 3900.00, '2024-09-24', 1, 20),
(36, 'RELAXED FIT TROUSERS', 'Relaxed fit trousers made of a cotton fabric. Featuring an adjustable elasticated waistband with inner drawstring and front pleats. Front pockets and rear welt pockets. Zip fly and top button fastening.', 'Men', 4500.00, '2024-09-24', 1, 20),
(37, 'COMFORT JOGGER TROUSERS', 'Regular fit trousers made of stretchy fabric. Featuring an elasticated drawstring waistband, side pockets and rear welt pockets.', 'Men', 3900.00, '2024-09-24', 1, 20),
(41, 'Denim Shorts', 'daft', 'Men', 3200.00, '2024-10-01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` text DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `image_url`, `product_id`, `color_id`) VALUES
(4, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2Fshorts00001.png?alt=media&token=02917fcf-1a26-4e78-b202-7b52040f3507', 7, 9),
(5, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2Fshorts00002.png?alt=media&token=a461d715-b94e-4d07-81f5-bf21e7b49cd5', 8, 2),
(6, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2Fshorts00003.png?alt=media&token=cae3926a-ea78-4f79-93c9-65640f5c4502', 9, 5),
(26, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F4-p.png?alt=media&token=c43baf72-55bf-45f3-9e81-e4653a727cc8', 30, 22),
(27, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F5-p.png?alt=media&token=bbdf15b2-2db8-4dac-9ab9-52885da61dc9', 30, 21),
(28, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F2-p.png?alt=media&token=3efdb7f8-4623-4524-8de2-a45b0ebd8ca4', 30, 4),
(29, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F6-p.png?alt=media&token=2f50d925-27e4-4414-893b-ca6607115db9', 30, 3),
(30, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F3-p.png?alt=media&token=a38cf45a-e5eb-4d56-82a8-71b0905096cd', 30, 6),
(31, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F1-p.png?alt=media&token=e59d0d16-3fd0-4a4a-84cf-704318d5dae7', 30, 7),
(32, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F8-p.png?alt=media&token=b0a25e85-b85c-41e7-a79b-77936fdc9d75', 31, 4),
(33, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F7-p.png?alt=media&token=9d702ae8-ee82-4730-b6f6-c232f9c723ea', 31, 23),
(34, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F10-p.png?alt=media&token=e0661e9f-85e7-4c97-af45-1b5c586da110', 32, 7),
(35, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F9-p.png?alt=media&token=c4cd5ff7-fe49-429d-bc80-7baf5162d42e', 32, 23),
(36, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F11-p.png?alt=media&token=1044d3d6-7dc6-4532-a32b-f082701eaa8e', 3, 2),
(37, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F14-p.png?alt=media&token=86d85f3b-dafb-4f26-82f8-5a4ae2fb09bf', 33, 4),
(38, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F13-p.png?alt=media&token=5fa461dc-8075-4b94-82a8-f35dfc543ee9', 33, 3),
(39, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F12-p.png?alt=media&token=47e66029-4b12-46c9-a655-6b61c57e34f3', 33, 24),
(40, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F15-p.png?alt=media&token=df98ccfa-f958-47e7-8535-e22c05bfa27e', 34, 6),
(41, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F16-p.png?alt=media&token=f546330b-2387-403b-84a5-8e7c7c852bb8', 34, 3),
(42, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F17-p.png?alt=media&token=ff610166-4e37-4b71-b697-add3ff0048d7', 35, 6),
(43, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F18-p.png?alt=media&token=3645d3be-0040-4ed9-b9cf-5d1bde505e0d', 35, 25),
(44, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F19-p.png?alt=media&token=ba49d774-6ebd-4d45-9784-9c2b2bde72f0', 36, 5),
(45, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F20-p.png?alt=media&token=35f354d3-49dc-4eb1-82bc-7e3f5da8d2ea', 36, 7),
(46, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F23-p.png?alt=media&token=04981510-de9e-4dc1-a07e-3a2754d7227f', 37, 5),
(47, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F21-p.png?alt=media&token=0defe757-9d2e-4eaf-aae4-ddc81379e50c', 37, 25),
(48, 'https://firebasestorage.googleapis.com/v0/b/viceversa-ad128.appspot.com/o/images%2F22-p.png?alt=media&token=cc898348-5c4e-47ef-9cfe-41a8db346284', 37, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE IF NOT EXISTS `product_variant` (
  `product_variant_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `quantity_in_stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_variant_id`),
  UNIQUE KEY `product_id` (`product_id`,`size_id`,`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`product_variant_id`, `product_id`, `size_id`, `color_id`, `quantity_in_stock`) VALUES
(2, 2, 2, 1, 30),
(5, 5, 5, 8, 30),
(7, 7, 3, 9, 20),
(8, 8, 2, 2, 20),
(9, 9, 3, 5, 10),
(10, 10, 2, 6, 20),
(89, 30, 1, 22, 20),
(90, 30, 2, 22, 20),
(91, 30, 1, 21, 20),
(92, 30, 2, 21, 20),
(93, 30, 1, 4, 20),
(94, 30, 2, 4, 29),
(95, 30, 1, 3, 20),
(96, 30, 2, 3, 29),
(97, 30, 1, 6, 20),
(98, 30, 2, 6, 29),
(99, 30, 1, 7, 20),
(100, 30, 2, 7, 29),
(101, 31, 3, 4, 20),
(102, 31, 4, 4, 20),
(103, 31, 3, 23, 20),
(104, 31, 4, 23, 20),
(105, 32, 4, 7, 10),
(106, 32, 5, 7, 20),
(107, 32, 4, 23, 10),
(108, 32, 5, 23, 20),
(109, 3, 5, 2, 30),
(110, 3, 1, 2, 36),
(111, 33, 3, 4, 20),
(112, 33, 4, 4, 25),
(113, 33, 3, 3, 20),
(114, 33, 4, 3, 25),
(115, 33, 3, 24, 20),
(116, 33, 4, 24, 20),
(117, 34, 1, 6, 10),
(118, 34, 2, 6, 20),
(119, 34, 3, 6, 30),
(120, 34, 4, 6, 30),
(121, 34, 5, 6, 20),
(122, 34, 1, 3, 10),
(123, 34, 2, 3, 20),
(124, 34, 3, 3, 30),
(125, 34, 4, 3, 30),
(126, 34, 5, 3, 20),
(127, 35, 3, 6, 24),
(128, 35, 4, 6, 30),
(129, 35, 2, 25, 24),
(130, 35, 3, 25, 40),
(131, 36, 1, 5, 23),
(132, 36, 2, 5, 24),
(133, 36, 1, 7, 23),
(134, 36, 2, 7, 24),
(135, 37, 3, 5, 32),
(136, 37, 4, 5, 32),
(137, 37, 3, 25, 32),
(138, 37, 4, 25, 32),
(139, 37, 3, 4, 32),
(140, 37, 4, 4, 32);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_label` varchar(50) NOT NULL,
  `size_name` varchar(20) NOT NULL,
  PRIMARY KEY (`size_id`),
  UNIQUE KEY `size_label` (`size_label`),
  UNIQUE KEY `size_name` (`size_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_label`, `size_name`) VALUES
(1, 'XS', 'Extra Small'),
(2, 'S', 'Small'),
(3, 'M', 'Medium'),
(4, 'L', 'Large'),
(5, 'XL', 'Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registration_date` date DEFAULT curdate(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_name` varchar(50) DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `password`, `email`, `registration_date`, `is_active`, `last_name`, `role`) VALUES
(1, 'Pranavan', '12345', 'pranavans2003@gmail.com', '2024-08-26', 1, 'Sivakumaran', 'customer'),
(7, 'Peter ', 'admin1234', 'peter.admin@viceversa.com', '2024-09-10', 1, 'Parker', 'admin'),
(9, 'Joel', '54321', 'joel@email.com', '2024-10-01', 1, 'Robert', 'customer'),
(10, 'Minus', '54321', 'minu@email.com', '2024-10-01', 1, 'S', 'customer');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

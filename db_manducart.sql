-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 11:55 AM
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
-- Database: `db_manducart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `fullname`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '1234567890', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, '2023-11-17 06:53:51', '2023-11-17 06:53:51'),
(4, '', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, '2023-12-19 03:23:44', '2023-12-19 03:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_carts`
--

INSERT INTO `tbl_carts` (`cart_id`, `product_id`, `customer_id`, `quantity`, `created_at`) VALUES
(1, 2, 3, 1, '2023-12-18 07:58:23'),
(3, 4, 3, 1, '2023-12-19 04:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `product_category` text NOT NULL,
  `product_color` text NOT NULL,
  `product_size` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `product_category`, `product_color`, `product_size`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Womens', 'Black', 'xxl', NULL, 1, '2023-12-17 14:09:12', 1, '2023-12-17 14:09:12'),
(2, 'Mens', 'White', 'xxl', NULL, 1, '2023-12-17 14:23:54', NULL, '2023-12-17 14:23:54'),
(3, 'Mens', 'Grey', 'xl', NULL, 1, '2023-12-17 14:35:27', NULL, '2023-12-17 14:35:27'),
(5, 'Mens', 'Black', 'xxxl', NULL, 1, '2023-12-18 13:54:05', NULL, '2023-12-18 13:54:05'),
(6, 'Mens', 'Green', 'x', NULL, 1, '2023-12-18 14:05:55', NULL, '2023-12-18 14:05:55'),
(7, 'Mens', 'White', 'xl', NULL, 1, '2023-12-18 14:10:49', NULL, '2023-12-18 14:10:49'),
(18, 'Mens', 'Black', 'xl', NULL, 1, '2023-12-18 14:51:23', NULL, '2023-12-18 14:51:23'),
(36, 'Womens', 'Green', 'xl', NULL, 1, '2023-12-18 15:49:01', NULL, '2023-12-18 15:49:01'),
(37, 'Unisex', 'Green', 'xl', NULL, 1, '2023-12-18 15:52:03', NULL, '2023-12-18 15:52:03'),
(38, 'Womens', 'White', 'xl', NULL, 1, '2023-12-18 15:54:51', NULL, '2023-12-18 15:54:51'),
(39, 'Unisex', 'White', 'xl', NULL, 1, '2023-12-18 15:55:01', NULL, '2023-12-18 15:55:01'),
(40, 'Womens', 'Black', 'x', NULL, 1, '2023-12-18 15:59:48', NULL, '2023-12-18 15:59:48'),
(41, 'Womens', 'Blue', 'xl', NULL, 1, '2023-12-18 16:12:06', NULL, '2023-12-18 16:12:06'),
(42, 'Mens', 'Blue', 'xl', NULL, 1, '2023-12-18 16:26:56', NULL, '2023-12-18 16:26:56'),
(43, 'Unisex', 'Blue', 'xxl', NULL, 1, '2023-12-18 16:28:16', NULL, '2023-12-18 16:28:16'),
(44, 'Mens', 'Black', 'xl', NULL, 1, '2023-12-18 16:36:01', NULL, '2023-12-18 16:36:01'),
(45, 'Mens', 'Green', 'xxl', NULL, 1, '2023-12-18 16:50:51', NULL, '2023-12-18 16:50:51'),
(46, 'Mens', 'White', 'xl', NULL, 1, '2023-12-18 17:11:10', NULL, '2023-12-18 17:11:10'),
(47, 'Unisex', 'White', 'xxl', NULL, 1, '2023-12-18 17:11:56', NULL, '2023-12-18 17:11:56'),
(48, 'Mens', 'Blue', 'xxl', NULL, 1, '2023-12-18 17:19:04', NULL, '2023-12-18 17:19:04'),
(49, 'Womens', 'Black', 'm', NULL, 1, '2023-12-18 17:26:27', NULL, '2023-12-18 17:26:27'),
(50, 'Mens', 'Blue', 'xxl', NULL, 1, '2023-12-18 17:36:43', NULL, '2023-12-18 17:36:43'),
(51, 'Unisex', 'Blue', 'm', NULL, 1, '2023-12-18 17:37:21', NULL, '2023-12-18 17:37:21'),
(52, 'Womens', 'Black', 'xl', NULL, 1, '2023-12-18 17:45:22', NULL, '2023-12-18 17:45:22'),
(53, 'Mens', 'White', 'xl', NULL, 1, '2023-12-18 17:52:43', NULL, '2023-12-18 17:52:43'),
(61, 'Womens', 'Blue', 'xl', NULL, 1, '2023-12-18 18:47:34', NULL, '2023-12-18 18:47:34'),
(62, 'Womens', 'Blue', 'xxl', NULL, 1, '2023-12-18 18:49:15', NULL, '2023-12-18 18:49:15'),
(63, 'Womens', 'Black', 'xxl', NULL, 1, '2023-12-18 18:53:09', NULL, '2023-12-18 18:53:09'),
(64, 'Womens', 'Blue', 'xl', NULL, 1, '2023-12-18 18:59:38', NULL, '2023-12-18 18:59:38'),
(65, 'Womens', 'Blue', 'xxl', NULL, 1, '2023-12-18 19:05:00', NULL, '2023-12-18 19:05:00'),
(66, 'Womens', 'White', 'xxxl', NULL, 1, '2023-12-18 19:13:57', 1, '2023-12-18 19:13:57'),
(67, 'Mens', 'Black', 'xs', NULL, 1, '2023-12-19 03:43:38', 1, '2023-12-19 03:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `issue` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `customer_id`, `fullname`, `email`, `issue`, `message`, `created_at`) VALUES
(1, 3, 'Sanjeev Parajuli', 'sanjeevprjl52310@gmail.com', 'Payment Problems', 'sdknasf;lkasfl;ajs;ldkfjasl;dfjl;adfjlaksdj', '2023-12-16 11:17:42'),
(2, 3, 'Sanjeev Parajuli', 'sanjeevprjl52310@gmail.com', 'Payment Problems', 'lkdfna;dfa', '2023-12-16 11:19:52'),
(3, 3, 'Sanjeev Parajuli', 'sanjeevprjl52310@gmail.com', 'Payment Problems', 'lfan;d', '2023-12-16 11:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `fullname`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Sanjeev Parajuli', 'sanjeevprjl52310@gmail.com', '9863483723', '8cb2237d0679ca88db6464eac60da96345513964', NULL, '2023-11-27 16:50:18', '2023-11-27 16:50:18'),
(4, 'Prabhuram Karki', 'prabhuramkarki4@gmail.com', '9861959776', '8cb2237d0679ca88db6464eac60da96345513964', NULL, '2023-11-28 15:38:21', '2023-11-28 15:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ordered_quantity` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`id`, `customer_id`, `product_id`, `ordered_quantity`, `status`, `created_by`, `created_at`) VALUES
(1, 3, 3, 1, 'Delivered', 1, '2023-12-18 09:04:44'),
(2, 3, 38, 2, 'Delivered', 1, '2023-12-19 04:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `customer_id`, `created_at`) VALUES
(4, 3, '2023-12-19 04:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `payment_method` varchar(250) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_id`, `product_id`, `order_quantity`, `payment_method`, `status`, `created_at`, `updated_by`) VALUES
(4, 2, 1, 'C-O-D', 'Processing', '2023-12-19 04:20:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_details` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` varchar(250) DEFAULT NULL,
  `product_image2` varchar(250) DEFAULT NULL,
  `product_image3` varchar(250) DEFAULT NULL,
  `product_image4` varchar(250) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_details`, `category_id`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_quantity`, `product_price`, `rating`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'Arise Oversized Sweatshirt', 'Live for street art. The Arise Fleece Unisex Oversized Sweatshirt features digitally printed graffiti on it. It is made from fleece material, which will give you a stylish look when you dress it up with your favorite denim, sneakers, and sunglasses.', 1, '1657f01a39cc00.jpg', '1657f01089e97c.jpg', '1657f01a39d278.jpg', '', 22, 1529, 0, 1, '2023-12-17 14:09:12', 1, '2023-12-17 14:09:12', NULL),
(2, 'Arise Oversized Sweatshirt', 'Live for street art. The Arise Fleece Unisex Oversized Sweatshirt features digitally printed graffiti on it. It is made from fleece material, which will give you a stylish look when you dress it up with your favorite denim, sneakers, and sunglasses.', 2, '1657f047a4515f.jpg', '1657f047a47635.jpg', '1657f047a47cf6.jpg', '', 21, 1529, 5, 1, '2023-12-17 14:23:54', NULL, '2023-12-17 14:23:54', NULL),
(3, 'Regular Fit Raglan Tshirt- Dark Grey', 'Regular t-shirts are the classics. They are made from soft, breathable materials, which make them ideal for everyday wear. They allow you to showcase your individual style through accessories or by layering it with other clothing items.', 3, '1657f072fc8d9d.jpg', '1657f072fca0de.jpg', '1657f072fca9e3.jpg', '1657f072fcb277.jpg', 49, 2000, 4, 1, '2023-12-17 14:35:27', NULL, '2023-12-17 14:35:27', NULL),
(4, 'Ultra Soft Oversized Fearless T-shirt', 'Ferocity is unwavering bravery. Our lion print roars in the face of change, symbolizing the courage to speak your mind and stay true to yourself in an ever-evolving world.\r\nThe term \"oversized\" refers to the fact that the t-shirt is intentionally designed to have larger dimensions than standard sizing. It typically involves a looser, extra fabric with longer lengths.', 5, '165804efde6d36.jpg', '165804efde7b1b.jpg', '165804efde8141.jpg', '165804efde8734.jpg', 39, 4000, 0, 1, '2023-12-18 13:54:05', NULL, '2023-12-18 13:54:05', NULL),
(5, 'Combat OverShirt', 'Over shirts are designed to be worn over other clothing items, such as t-shirts or tanks. They are made from thicker, more durable materials which makes them ideal for layering. Additionally, they can add a touch of style and personality to an outfit, allowing the wearer to express their individuality.', 6, '1658051c369b18.jpg', '1658051c36a96b.jpg', '1658051c36af6a.jpg', '1658051c36b566.jpg', 19, 1599, 0, 1, '2023-12-18 14:05:55', NULL, '2023-12-18 14:05:55', NULL),
(6, 'Matrix Opal Polo Tshirt', 'Polo shirts have a classic, sporty style. They are made from soft, breathable fabrics. Polo shirts have a distinctive design that includes a collar and a buttoned placket having two or three buttons at the neck.', 7, '1658052e971ca8.jpg', '1658052e9735b7.jpg', '1658052e974084.jpg', '1658052e9749cd.jpg', 155, 999, 0, 1, '2023-12-18 14:10:49', NULL, '2023-12-18 14:10:49', NULL),
(8, 'Midnight Polo Tshirt', 'Polo shirts have a classic, sporty style. They are made from soft, breathable fabrics. Polo shirts have a distinctive design that includes a collar and a buttoned placket having two or three buttons at the neck.', 18, '165805c6b481c7.jpg', '165805c6b48cfa.jpg', '165805c6b492ab.jpg', '165805c6b49acb.jpg', 40, 650, 0, 1, '2023-12-18 14:51:23', NULL, '2023-12-18 14:51:23', NULL),
(9, 'Relaxed Fit Womens OcTee Tshirt', 'Relaxed fit printed t-shirts have a comfortable fit and feature bold eye-catching prints. The term relaxed refers to the fact that the t-shirt is intentionally designed to be a little larger than the wearers usual size, creating a comfortable look rather than a fitted look.', 36, '1658069ed36fff.jpg', '1658069ed37a16.jpg', '', '', 18, 4000, 0, 1, '2023-12-18 15:49:01', NULL, '2023-12-18 15:49:01', NULL),
(10, 'Relaxed Fit Womens OcTee Tshirt', 'Relaxed fit printed tshirts have a comfortable fit and feature bold eye catching prints. The term relaxed refers to the fact that the tshirt is intentionally designed to be a little larger than the wearers usual size, creating a comfortable look rather than a fitted look', 37, '165806aa3e89ee.jpg', '165806aa3e933d.jpg', '', '', 18, 4000, 0, 1, '2023-12-18 15:52:03', NULL, '2023-12-18 15:52:03', NULL),
(11, 'Relaxed Fit Womens Morph Tshirt', 'Relaxed fit printed t-shirts have a comfortable fit and feature bold eye-catching prints. The term relaxed refers to the fact that the t-shirt is intentionally designed to be a little larger than the wearers usual size, creating a comfortable look rather than a fitted look. ', 38, '165806b4b2f5db.jpg', '165806b4b2ff4b.jpg', '165806b4b3045b.jpg', '', 55, 1529, 0, 1, '2023-12-18 15:54:51', NULL, '2023-12-18 15:54:51', NULL),
(12, 'Relaxed Fit Womens Morph Tshirt', 'Relaxed fit printed t-shirts have a comfortable fit and feature bold eye-catching prints. The term relaxed refers to the fact that the t-shirt is intentionally designed to be a little larger than the wearers usual size, creating a comfortable look rather than a fitted look. ', 39, '165806b55840a4.jpg', '165806b558499a.jpg', '165806b5584e99.jpg', '', 55, 1529, 0, 1, '2023-12-18 15:55:01', NULL, '2023-12-18 15:55:01', NULL),
(13, 'Relaxed Fit Womens Sea Stallion Tshirt', 'Relaxed fit printed t-shirts have a comfortable fit and feature bold eye-catching prints. The term relaxed refers to the fact that the t-shirt is intentionally designed to be a little larger than the wearers usual size, creating a comfortable look rather than a fitted look.', 40, '165806c741b9d7.jpg', '165806c741c3e7.jpg', '165806c741c83a.jpg', '165806c741cc2a.jpg', 14, 5000, 0, 1, '2023-12-18 15:59:48', NULL, '2023-12-18 15:59:48', NULL),
(14, 'Relaxed Fit Womens Free Spirit Tshirt', 'Relaxed fit printed t-shirts have a comfortable fit and feature bold eye-catching prints. The term relaxed refers to the fact that the t-shirt is intentionally designed to be a little larger than the wearers usual size, creating a comfortable look rather than a fitted look.', 41, '165806f560bd66.jpg', '165806f560cf68.jpg', '165806f560d741.jpg', '', 123, 1599, 0, 1, '2023-12-18 16:12:06', NULL, '2023-12-18 16:12:06', NULL),
(15, 'DHRUVI TRENDZ Mens Shirt', 'This Rayon Stylish Shirt features a tropical printed boys shirt with a preppy short sleeve, Hawaii collar, full button placket, and curved hem design. It can be worn for casual, beach, office, formal, evening, work, party, or business wear. Please select the correct size for comfort.', 42, '1658072d03fb0b.jpg', '1658072d040aa7.jpg', '1658072d04310e.jpg', '1658072d043a94.jpg', 66, 999, 0, 1, '2023-12-18 16:26:56', NULL, '2023-12-18 16:26:56', NULL),
(16, 'DHRUVI TRENDZ Mens Shirt', 'This Rayon Stylish Shirt features a tropical printed boys shirt with a preppy short sleeve, Hawaii collar, full button placket, and curved hem design. It can be worn for casual, beach, office, formal, evening, work, party, or business wear. Please select the correct size for comfort.', 43, '165807320e84d2.jpg', '165807320e94b9.jpg', '165807320e9df7.jpg', '165807320ea4ba.jpg', 66, 9999, 0, 1, '2023-12-18 16:28:16', NULL, '2023-12-18 16:28:16', NULL),
(17, 'Midnight Mens Cargo Pants', 'Stay cool and comfortable this summer with our cargo pants. Made from a blend of 100% Cotton Twill. The multiple pockets on the sides of the legs allow you to easily store your essentials, while the relaxed fit and adjustable waistband provide a comfortable and customizable fit. These cargo pants are a versatile addition to your summer wardrobe.', 44, '1658074f181a19.jpg', '1658074f18273e.jpg', '1658074f182f95.jpg', '1658074f183659.jpg', 144, 1444, 0, 1, '2023-12-18 16:36:01', NULL, '2023-12-18 16:36:01', NULL),
(18, 'Olive Green Mens Cargo Pants', 'Stay cool and comfortable this summer with our cargo pants. Made from a blend of 100% Cotton Twill. The multiple pockets on the sides of the legs allow you to easily store your essentials, while the relaxed fit and adjustable waistband provide a comfortable and customizable fit. ', 45, '16580786b077fb.jpg', '16580786b0861d.jpg', '16580786b08cc0.jpg', '16580786b09371.jpg', 166, 1412, 0, 1, '2023-12-18 16:50:51', NULL, '2023-12-18 16:50:51', NULL),
(19, 'Light Grey Mens Cargo Pants', 'Stay cool and comfortable this summer with our cargo pants. Made from a blend of 100% Cotton Twill. The multiple pockets on the sides of the legs allow you to easily store your essentials, while the relaxed fit and adjustable waistband provide a comfortable and customizable fit. ', 46, '165807d2e8baa8.jpg', '165807d2e8ca0b.jpg', '165807d2e8d20e.jpg', '165807d2e8dabf.jpg', 46, 1222, 0, 1, '2023-12-18 17:11:10', NULL, '2023-12-18 17:11:10', NULL),
(20, 'Light Grey Cargo Pants', 'Stay cool and comfortable this summer with our cargo pants. Made from a blend of 100% Cotton Twill. The multiple pockets on the sides of the legs allow you to easily store your essentials, while the relaxed fit and adjustable waistband provide a comfortable and customizable fit. ', 47, '165807d5c33516.jpg', '165807d5c34217.jpg', '165807d5c34889.jpg', '165807d5c34ea5.jpg', 26, 1444, 0, 1, '2023-12-18 17:11:56', NULL, '2023-12-18 17:11:56', NULL),
(21, 'Dennis Lingo Mens Checkered Slim Fit Cotton Casual Shirt', 'Item Weight-500 g\r\nItem Dimensions -LxWxH25 x 20 x 4.5 Centimeters\r\nNet Quantity-1.00 count\r\nGeneric Name-Shirt', 48, '165807f08eca06.jpg', '165807f08ed72f.jpg', '165807f08ede4b.jpg', '165807f08ee550.jpg', 123, 3232, 0, 1, '2023-12-18 17:19:04', NULL, '2023-12-18 17:19:04', NULL),
(22, 'Black Low Neckline T-Shirt ', 'Effortlessly pairs with various outfits for different looks, Perfect for casual wear or as a layering piece, Features a flattering, slightly lowered neckline', 49, '1658080c38fdf2.jpg', '1658080c390ba9.jpg', '1658080c39149f.jpg', '1658080c391c0b.jpg', 36, 8000, 0, 1, '2023-12-18 17:26:27', NULL, '2023-12-18 17:26:27', NULL),
(23, 'Lymio Casual Shirt for Men', 'Enhance your look by wearing this Casual Stylish Mens shirt, Team it with a pair of tapered denims Or Solid Chinos and Loafers for a fun Smart Casual look', 50, '16580832b40414.jpg', '16580832b41352.jpg', '16580832b41bfb.jpg', '16580832b425bd.jpg', 123, 999, 0, 1, '2023-12-18 17:36:43', NULL, '2023-12-18 17:36:43', NULL),
(24, 'Lymio Casual Shirt ', 'Enhance your look by wearing this Casual Stylish Mens shirt, Team it with a pair of tapered denims Or Solid Chinos and Loafers for a fun Smart Casual look', 51, '16580835138c61.jpg', '165808351398cd.jpg', '1658083513a146.jpg', '1658083513aa85.jpg', 144, 4444, 0, 1, '2023-12-18 17:37:21', NULL, '2023-12-18 17:37:21', NULL),
(25, 'Midnight Womens Cargo Pants', 'Stay cool and comfortable this summer with our cargo pants. Made from a blend of 100% Cotton Twill. The relaxed fit and adjustable waistband provides you a comfortable and customizable fit. These cargo pants are a versatile addition to your summer wardrobe.', 52, '165808532cdd73.jpg', '165808532ce94c.jpg', '165808532cf1ad.jpg', '165808532cf801.jpg', 156, 2222, 0, 1, '2023-12-18 17:45:22', NULL, '2023-12-18 17:45:22', NULL),
(26, 'White And Black Splatter-Style Ombre Shirt', 'Suitable for everyday wear, concerts, or art-inspired events, Great for layering in colder weather, Adds a touch of creativity and expression, Creates a cool and laid-back look with an artistic touch', 53, '1658086eb6aaf9.jpg', '1658086eb6b9c5.jpg', '1658086eb6c13e.jpg', '1658086eb6c95e.jpg', 45, 7793, 0, 1, '2023-12-18 17:52:43', NULL, '2023-12-18 17:52:43', NULL),
(32, 'Purple Fitted Crop Top', 'Our Crop Tops are designed to hug the body, creating a sleek and streamlined silhouette. They are made from stretchy, form-fitting materials, which help to accentuate the curves of the wearers body. They can be paired with high-waisted jeans or skirts for a casual daytime look. ', 61, '1658093c650766.jpg', '1658093c650cb0.jpg', '1658093c651169.jpg', '1658093c65168d.jpg', 152, 1599, 0, 1, '2023-12-18 18:47:34', NULL, '2023-12-18 18:47:34', NULL),
(33, 'Sleeveless Orange Crop Top', 'Our Crop Tops are designed to hug the body, creating a sleek and streamlined silhouette. They are made from stretchy, form-fitting materials, which help to accentuate the curves of the wearers body. They can be paired with high-waisted jeans or skirts for a casual daytime look. ', 62, '16580942b06e69.jpg', '16580942b07e34.jpg', '16580942b0850c.jpg', '16580942b08cd7.jpg', 123, 5555, 0, 1, '2023-12-18 18:49:15', NULL, '2023-12-18 18:49:15', NULL),
(34, 'Black Fitted Crop Top', 'Our Crop Tops are designed to hug the body, creating a sleek and streamlined silhouette. They are made from stretchy, form-fitting materials, which help to accentuate the curves of the wearers body. They can be paired with high-waisted jeans or skirts for a casual daytime look.', 63, '16580951575f2f.jpg', '16580951576892.jpg', '16580951576d78.jpg', '1658095157739e.jpg', 159, 3648, 0, 1, '2023-12-18 18:53:09', NULL, '2023-12-18 18:53:09', NULL),
(35, 'Brown Long Sleeves Polo Shirt', 'Allows for effortless pairing with a variety of bottoms and accessories, Maintains a smart-casual appearance while adding a relaxed vibe to your outfit, A convenient choice for your everyday wardrobe, Effortlessly adapts to various settings', 64, '16580969ad1e67.jpg', '16580969ad2a22.jpg', '16580969ad3120.jpg', '16580969ad3651.jpg', 22, 4524, 0, 1, '2023-12-18 18:59:38', NULL, '2023-12-18 18:59:38', NULL),
(36, 'Light Brown Irregular Button Shirt', 'Wear this with fitted jeans, Perfect for brunch dates, With pocket details, Relaxed fit', 65, '1658097dcb539e.jpg', '1658097dcb6199.jpg', '1658097dcb6718.jpg', '1658097dcb6df4.jpg', 225, 4466, 0, 1, '2023-12-18 19:05:00', NULL, '2023-12-18 19:05:00', NULL),
(37, 'White Polo Shirt ', 'Pair it with anything and everything\r\nButton placket\r\nPolo collar\r\nLong sleeves\r\nRelaxed fit', 66, '1658099f511fa2.jpg', '1658099f512b06.jpg', '1658099f5130c6.jpg', '1658099f5136b1.jpg', 124, 10000, 0, 1, '2023-12-18 19:13:57', 1, '2023-12-18 19:13:57', NULL),
(38, 'test1', 'mens product detail example', 67, '1658115a3be206.jpg', '1658115a3bf0c5.jpg', '1658115a3bfd2e.jpg', '1658115a3c098f.jpg', 10, 3000, 0, 1, '2023-12-19 03:43:38', 1, '2023-12-19 03:43:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings_and_reviews`
--

CREATE TABLE `tbl_ratings_and_reviews` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ratings` int(11) NOT NULL,
  `reviews` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ratings_and_reviews`
--

INSERT INTO `tbl_ratings_and_reviews` (`id`, `customers_id`, `product_id`, `ratings`, `reviews`, `created_at`) VALUES
(3, 3, 1, 3, 'Vrey good product. Good product for these amount of money', '2023-12-17 17:26:04'),
(4, 3, 1, 3, 'Vrey good product. Good product for these amount of money', '2023-12-17 17:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shippings`
--

CREATE TABLE `tbl_shippings` (
  `shipping_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shippings`
--

INSERT INTO `tbl_shippings` (`shipping_id`, `order_id`, `customer_name`, `email`, `phone`, `address`, `created_at`) VALUES
(44, 4, 'Sanjeev Parajuli', 'sanjeevprjl52310@gmail.com', '9863483723', 'Kathmandu', '2023-12-19 04:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlists`
--

CREATE TABLE `tbl_wishlists` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_ratings_and_reviews`
--
ALTER TABLE `tbl_ratings_and_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_shippings`
--
ALTER TABLE `tbl_shippings`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_ratings_and_reviews`
--
ALTER TABLE `tbl_ratings_and_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_shippings`
--
ALTER TABLE `tbl_shippings`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD CONSTRAINT `tbl_carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_carts_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD CONSTRAINT `tbl_categories_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admins` (`admin_id`) ON DELETE NO ACTION;

--
-- Constraints for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD CONSTRAINT `tbl_contact_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD CONSTRAINT `tbl_history_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_history_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tbl_admins` (`admin_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_products_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ratings_and_reviews`
--
ALTER TABLE `tbl_ratings_and_reviews`
  ADD CONSTRAINT `tbl_ratings_and_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_shippings`
--
ALTER TABLE `tbl_shippings`
  ADD CONSTRAINT `tbl_shippings_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  ADD CONSTRAINT `tbl_wishlists_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_wishlists_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

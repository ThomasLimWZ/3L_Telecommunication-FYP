-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 01:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3l_telecommunication`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` varchar(10) NOT NULL,
  `adm_profile_pic` text NOT NULL,
  `adm_name` varchar(100) NOT NULL,
  `adm_email` varchar(100) NOT NULL,
  `adm_phone` text NOT NULL,
  `adm_pass` text NOT NULL,
  `adm_status` int(11) NOT NULL DEFAULT 1,
  `adm_position` varchar(50) NOT NULL,
  `adm_join_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `adm_profile_pic`, `adm_name`, `adm_email`, `adm_phone`, `adm_pass`, `adm_status`, `adm_position`, `adm_join_date`) VALUES
('ADM001', 'IMG-62540bf3f1f3c1.01251570.png', 'Lim Wee Zheng', '1201200463@student.mmu.edu.my', '01110612888', 'Wz@200463', 1, 'Manager', '2022-01-31'),
('ADM002', 'IMG-61fbdd85a5e561.00288265.png', 'Law Qian Er', '1201200678@student.mmu.edu.my', '01076638017', 'Qe@200678', 1, 'Staff', '2022-02-03'),
('ADM003', 'IMG-624ee5c7394b12.35184356.jpg', 'Lai Jian Hong', '1201200449@student.mmu.edu.my', '01697041034', 'Jh@200449', 0, 'Staff', '2022-02-07'),
('ADM004', '', 'Jenny Law', 'qianer0216@gmail.com', '0167681123', '&eN$9U89nQW8d44', 1, 'Staff', '2022-04-11'),
('ADM006', 'IMG-625fe9deb6e064.03145032.png', 'Wee Kai Liang', 'weetom00@gmail.com', '0182874552', 'j1%5r6PXG.1g49T', 1, 'Staff', '2022-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_code` int(11) NOT NULL,
  `brand_name` varchar(20) NOT NULL,
  `brand_status` int(11) NOT NULL DEFAULT 1,
  `brand_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_code`, `brand_name`, `brand_status`, `brand_image`) VALUES
(1, 'Apple', 1, 'IMG-61f7897db38cd6.50395197.png'),
(2, 'Samsung', 1, 'IMG-61fbc2e81ca6e8.05497901.png'),
(3, 'Huawei', 1, 'IMG-61fbc2f38509a4.07370659.png'),
(4, 'Xiaomi', 1, 'IMG-61fbc375dc3e92.05769335.png'),
(5, 'Oppo', 0, 'IMG-62288d2383a4c3.72046294.png'),
(6, 'realme', 0, 'IMG-625fe9f3a52fe4.19063836.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_code` int(11) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_detail_code` int(11) DEFAULT NULL,
  `product_color` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` decimal(7,2) NOT NULL,
  `cart_subtotal` decimal(8,2) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 1,
  `cus_email` text NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_code` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_code`, `product_code`, `product_detail_code`, `product_color`, `quantity`, `product_price`, `cart_subtotal`, `cart_status`, `cus_email`, `payment_date`, `payment_code`) VALUES
(1, '10', 23, 'Starlight', 1, '1749.00', '1749.00', 0, 'tzhenglim02@gmail.com', '2022-02-21 23:39:39', 'INV169045'),
(2, '9', 22, 'White', 1, '899.00', '899.00', 0, 'tzhenglim02@gmail.com', '2022-02-21 23:39:39', 'INV169045'),
(3, '4', 11, 'Sierra Blue', 1, '5299.00', '5299.00', 0, 'tzhenglim02@gmail.com', '2022-02-21 23:39:39', 'INV169045'),
(4, '12', 25, 'Ceramic White', 1, '699.00', '699.00', 0, 'tzhenglim02@gmail.com', '2022-02-22 20:21:02', 'INV762453'),
(11, '4', 12, 'Graphite', 1, '5799.00', '5799.00', 0, 'tzhenglim@gmail.com', '2022-03-12 21:07:53', 'INV420173'),
(12, '19', 44, 'Brown Leather Strap', 1, '1099.00', '1099.00', 0, 'tzhenglim@gmail.com', '2022-03-12 21:07:53', 'INV420173'),
(13, '24', 39, 'Black', 1, '179.00', '179.00', 0, 'tzhenglim@gmail.com', '2022-03-12 21:07:53', 'INV420173'),
(14, '7', 19, 'Purple', 1, '2699.00', '2699.00', 0, 'tzhenglim@gmail.com', '2022-03-12 21:21:42', 'INV021369'),
(15, '11', 24, 'White', 1, '549.00', '549.00', 0, 'tzhenglim@gmail.com', '2022-03-12 21:21:42', 'INV021369'),
(16, '17', 31, 'Graphite', 1, '499.00', '499.00', 0, 'tzhenglim@gmail.com', '2022-03-12 21:25:46', 'INV145376'),
(17, '14', 28, 'Awesome Violet', 1, '1499.00', '1499.00', 0, 'devan@gmail.com', '2022-03-13 21:19:21', 'INV403259'),
(18, '17', 31, 'White', 1, '499.00', '499.00', 0, 'devan@gmail.com', '2022-03-13 21:19:21', 'INV403259'),
(20, '24', 39, 'Black', 2, '179.00', '358.00', 0, 'devan@gmail.com', '2022-03-13 21:19:21', 'INV403259'),
(21, '9', 22, 'White', 1, '899.00', '899.00', 1, 'tzhenglim02@gmail.com', NULL, NULL),
(22, '4', 11, 'Sierra Blue', 4, '5299.00', '21196.00', 1, 'tzhenglim02@gmail.com', NULL, NULL),
(24, '28', 48, 'Starlight', 1, '2299.00', '2299.00', 0, 'tzhenglim@gmail.com', '2022-03-25 15:54:30', 'INV801297'),
(28, '28', 47, 'Midnight', 3, '2099.00', '6297.00', 0, '1201200463@student.mmu.edu.my', '2022-04-01 15:56:40', 'INV176482'),
(29, '28', 48, 'Midnight', 1, '2299.00', '2299.00', 0, '1201200463@student.mmu.edu.my', '2022-04-01 15:56:40', 'INV176482'),
(30, '30', 51, 'White', 1, '479.00', '479.00', 0, '1201200463@student.mmu.edu.my', '2022-04-01 15:56:40', 'INV176482'),
(31, '30', 51, 'White', 1, '479.00', '479.00', 0, 'leehong@hotmail.com', '2022-04-01 18:41:33', 'INV258193'),
(32, '22', 36, 'Celestial Blue', 1, '1699.00', '1699.00', 0, 'chianseong020@gmail.com', '2022-04-07 14:47:53', 'INV429508'),
(33, '23', 38, 'Black', 1, '1599.00', '1599.00', 0, 'chianseong020@gmail.com', '2022-04-07 14:47:53', 'INV429508'),
(34, '24', 39, 'Black', 1, '179.00', '179.00', 0, 'linlin@gmail.com', '2022-04-07 14:50:26', 'INV798540'),
(35, '29', 50, 'Midnight', 1, '219.00', '219.00', 0, 'devan@gmail.com', '2022-04-08 17:44:09', 'INV691234'),
(36, '25', 40, 'Black', 1, '189.00', '189.00', 0, 'devan@gmail.com', '2022-04-08 17:44:09', 'INV691234'),
(37, '25', 40, 'Black', 1, '189.00', '189.00', 0, 'shawnsaw@gmail.com', '2022-04-09 20:25:04', 'INV569718'),
(38, '22', 36, 'Moonlight White', 1, '1699.00', '1699.00', 0, 'David@gmail.com', '2022-04-11 11:19:28', 'INV538064'),
(44, '14', 28, 'Awesome Violet', 1, '1499.00', '1499.00', 0, '1201200463@student.mmu.edu.my', '2022-04-15 21:36:58', 'INV176035'),
(45, '1', 1, 'Pink', 1, '3399.00', '3399.00', 0, 'weetom00@gmail.com', '2022-04-20 19:07:56', 'INV298076'),
(46, '46', 69, 'Glowing Green', 2, '494.10', '988.20', 0, 'weetom00@gmail.com', '2022-04-20 19:14:30', 'INV487536'),
(47, '46', 69, 'Glowing Black', 3, '494.10', '1482.30', 0, 'weetom00@gmail.com', '2022-04-20 19:14:30', 'INV487536'),
(48, '46', 70, 'Glowing Green', 1, '584.10', '584.10', 0, 'weetom00@gmail.com', '2022-04-20 19:14:30', 'INV487536'),
(49, '46', 70, 'Glowing Black', 2, '584.10', '1168.20', 0, 'weetom00@gmail.com', '2022-04-20 19:14:30', 'INV487536');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_code` int(11) NOT NULL,
  `cat_name` varchar(20) NOT NULL,
  `cat_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_code`, `cat_name`, `cat_image`) VALUES
(1, 'Phone', 'phone.png'),
(2, 'Tablet', 'tablet.png'),
(3, 'Watch', 'watch.png'),
(4, 'Audio', 'audio.png'),
(5, 'Accessories', 'accessories.png');

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `clearance_code` int(11) NOT NULL,
  `clearance_product_code` int(11) NOT NULL,
  `clearance_product_name` text NOT NULL,
  `clearance_product_start_price` decimal(7,2) NOT NULL,
  `clearance_descrip` text NOT NULL,
  `clearance_product_status` int(11) NOT NULL DEFAULT 0,
  `clearance_brand_name` text NOT NULL,
  `clearance_cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`clearance_code`, `clearance_product_code`, `clearance_product_name`, `clearance_product_start_price`, `clearance_descrip`, `clearance_product_status`, `clearance_brand_name`, `clearance_cat_name`) VALUES
(2, 27, 'Oppo Find X3 Pro', '3869.10', '•	120Hz Dynamic Refresh Rate<br>\r\n•	65W SuperVOOC Flash Charge<br>\r\n•	Sound by Hans Zimmer', 0, 'Oppo', 'Phone'),
(3, 46, 'Realme C35', '494.10', '•	50MP AI Triple Camera<br>\r\n•	16.7cm（6.6\') FHD Fullscreen<br>\r\n•	5000mAh Massive Battery<br>\r\n•	18W Quick Charge<br>\r\n•	Powerful Unisoc T616 Processor', 0, 'realme', 'Phone');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_phone` text NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_gender` varchar(10) DEFAULT NULL,
  `cus_dob` date DEFAULT NULL,
  `cus_pass` text NOT NULL,
  `cus_address` text DEFAULT NULL,
  `cus_city` text DEFAULT NULL,
  `cus_state` text DEFAULT NULL,
  `cus_post_code` int(10) DEFAULT NULL,
  `cus_join_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_phone`, `cus_email`, `cus_gender`, `cus_dob`, `cus_pass`, `cus_address`, `cus_city`, `cus_state`, `cus_post_code`, `cus_join_date`) VALUES
(1, 'Muhammad Samat', '0194457766', 'tzhenglim02@gmail.com', '', '2005-06-10', 'Samat#123', '20 Jalan Cyberjaya 2 Taman Cyberjaya', 'Kuala Lumpur', 'Selangor', 23100, '2022-02-21'),
(2, 'Lim Wee Zheng', '01110612839', 'tzhenglim@gmail.com', '', '2002-08-02', 'Wz@020802', 'No 8 Jalan Bertam Perdana 9', 'Melaka', 'Melaka', 75200, '2022-03-05'),
(3, 'Wee Chian Seong', '0128896512', 'chianseong020@gmail.com', '', '0000-00-00', 'Seong@020', '20 Jalan Kampung Hulu 2 Taman Kampung Hulu', 'Kelantan', 'Kelantan', 34122, '2022-03-11'),
(4, 'Thomas Lim', '01110612839', '1201200463@student.mmu.edu.my', '', '0000-00-00', 'Zheng#1234', 'No 8 Jalan Bertam Perdana 9', 'Melaka', 'Melaka', 75200, '2022-03-11'),
(5, 'Low Lin Lin', '0145619912', 'linlin@gmail.com', NULL, NULL, 'Lin#1234', NULL, NULL, NULL, NULL, '2022-03-11'),
(6, 'Devan Shah', '01945157771', 'devan@gmail.com', NULL, NULL, 'Devan!123', NULL, NULL, NULL, NULL, '2022-03-11'),
(7, 'Lim Lee Hong', '0198134561', 'leehong@hotmail.com', NULL, NULL, 'leeHong#123', NULL, NULL, NULL, NULL, '2022-03-11'),
(8, 'Shawn Saw', '0168913222', 'shawnsaw@gmail.com', NULL, NULL, 'shawnSaw@1234', NULL, NULL, NULL, NULL, '2022-03-24'),
(9, 'Vincent Tam', '0192245512', 'tamtam@gmail.com', NULL, NULL, 'Tamtam@123', NULL, NULL, NULL, NULL, '2022-03-25'),
(10, 'Jianhong', '01444684685', 'jianhong@gmail.com', '', '0000-00-00', 'Jianhong@1234', '13,jalan berlian 31,taman cahaya masai', 'pasir gudang', 'Johor', 86665, '2022-04-07'),
(11, 'David', '01586837575', 'David@gmail.com', '', '0000-00-00', 'David@123456', '13,jalan cerami 33, taman merdeka', 'Nilai', 'Selangor', 86799, '2022-04-09'),
(12, 'Jianhong', '01769483675', 'siti@gmail.com', '', '0000-00-00', 'Siti$321', '144,jalan ciku 8,taman cendana', 'pasir gudang', 'Johor', 87533, '2022-04-11'),
(14, 'Wee Kai Liang', '0182874552', 'weetom00@gmail.com', 'Male', '2002-12-02', 'Kailiang@02', 'No 10 Jalan Klebang Lama Taman Klebang Lama', 'Melaka Tengah', 'Melaka', 75000, '2022-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_code` varchar(9) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `card_holder` varchar(100) NOT NULL,
  `payment_total` decimal(9,2) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `adm_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_code`, `payment_date`, `card_holder`, `payment_total`, `cus_email`, `adm_id`) VALUES
('INV021369', '2022-03-12 21:21:42', 'Lim Wee Zheng', '3248.00', 'tzhenglim@gmail.com', 'ADM002'),
('INV145376', '2022-03-12 21:25:46', 'Lim Wee Zheng', '499.00', 'tzhenglim@gmail.com', 'ADM001'),
('INV169045', '2022-02-21 23:39:39', 'Muhammad Samat', '7947.00', 'tzhenglim02@gmail.com', 'ADM001'),
('INV176035', '2022-04-15 21:36:58', 'Thomas Lim', '1499.00', '1201200463@student.mmu.edu.my', 'ADM002'),
('INV176482', '2022-04-01 15:56:40', 'Lim Wee Zheng', '9075.00', '1201200463@student.mmu.edu.my', 'ADM002'),
('INV258193', '2022-04-01 18:41:33', 'Lim Lee Hong', '479.00', 'leehong@hotmail.com', 'ADM002'),
('INV298076', '2022-04-20 19:07:56', 'Wee Kai Liang', '3399.00', 'weetom00@gmail.com', 'ADM001'),
('INV403259', '2022-03-13 21:19:21', 'Devan Raj', '2356.00', 'devan@gmail.com', 'ADM002'),
('INV420173', '2022-03-12 21:07:53', 'Lim Wee Zheng', '7077.00', 'tzhenglim@gmail.com', 'ADM003'),
('INV429508', '2022-04-07 14:47:53', 'wee chian seong', '3298.00', 'chianseong020@gmail.com', 'ADM002'),
('INV487536', '2022-04-20 19:14:30', 'Wee Kai Liang', '4222.80', 'weetom00@gmail.com', NULL),
('INV538064', '2022-04-11 11:19:28', 'David', '1699.00', 'David@gmail.com', 'ADM001'),
('INV569718', '2022-04-09 20:25:04', 'Shawn Saw', '189.00', 'shawnsaw@gmail.com', 'ADM001'),
('INV691234', '2022-04-08 17:44:09', 'Devan Shah', '408.00', 'devan@gmail.com', 'ADM001'),
('INV762453', '2022-02-22 20:21:02', 'Muhammad Samat', '699.00', 'tzhenglim02@gmail.com', 'ADM003'),
('INV798540', '2022-04-07 14:50:26', 'low lin lin', '179.00', 'linlin@gmail.com', 'ADM002'),
('INV801297', '2022-03-25 15:54:30', 'Lim Wee Zheng', '2299.00', 'tzhenglim@gmail.com', 'ADM002');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_start_price` decimal(7,2) NOT NULL,
  `product_descrip` text NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1,
  `brand_name` varchar(20) NOT NULL,
  `cat_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`, `product_start_price`, `product_descrip`, `product_status`, `brand_name`, `cat_name`) VALUES
(1, 'iPhone 13 mini', '3399.00', '•	5.4-inch Super Retina XDR display<br>\r\n•	Cinematic mode adds shallow depth of field and shifts focus automatically in your videos<br>\r\n•	Advanced dual-camera system with 12MP Wide and Ultra Wide cameras; Photographic Styles, Smart HDR 4, Night mode, 4K Dolby Vision HDR recording<br>\r\n•	12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording<br>\r\n•	A15 Bionic chip for lightning-fast performance<br>\r\n•	Up to 17 hours of video playback<br>\r\n•	Durable design with Ceramic Shield<br>\r\n•	Industry-leading IP68 water resistance<br>\r\n•	iOS 15 packs new features to do more with iPhone than ever before<br>\r\n•	Supports MagSafe accessories for easy attach and faster wireless charging', 1, 'Apple', 'Phone'),
(2, 'iPhone 13', '3899.00', '•	6.1-inch Super Retina XDR display<br>\r\n•	Cinematic mode adds shallow depth of field and shifts focus automatically in your videos<br>\r\n•	Advanced dual-camera system with 12MP Wide and Ultra Wide cameras; Photographic Styles, Smart HDR 4, Night mode, 4K Dolby Vision HDR recording<br>\r\n•	12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording<br>\r\n•	A15 Bionic chip for lightning-fast performance<br>\r\n•	Up to 19 hours of video playback<br>\r\n•	Durable design with Ceramic Shield<br>\r\n•	Industry-leading IP68 water resistance<br>\r\n•	iOS 15 packs new features to do more with iPhone than ever before<br>\r\n•	Supports MagSafe accessories for easy attach and faster wireless charging', 1, 'Apple', 'Phone'),
(3, 'iPhone 13 Pro', '4899.00', '•	6.1 inch Super Retina XDR display with ProMotion for a faster, more responsive feel<br>\r\n•	Cinematic mode adds shallow depth of field and shifts focus automatically in your videos<br>\r\n•	Pro camera system with 12MP Telephoto, Wide and Ultra Wide cameras; LiDAR Scanner; 6x optical zoom range; macro photography; Photographic Styles, ProRes video, Smart HDR , Night mode, Apple ProRAW, 4K Dolby Vision HDR recording<br>\r\n•	12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording<br>\r\n•	A15 Bionic chip for lightning-fast performance<br>\r\n•	 Up to 22 hours of video playback<br>\r\n•	Durable design with Ceramic Shield<br>\r\n•	Industry-leading IP68 water resistance<br>\r\n•	iOS 15 packs new features to do more with iPhone than ever before<br>\r\n•	Supports MagSafe accessories for easy attach and faster wireless charging', 1, 'Apple', 'Phone'),
(4, 'iPhone 13 Pro Max', '5299.00', '•	6.7 inch Super Retina XDR display with ProMotion for a faster, more responsive feel<br>\r\n•	Cinematic mode adds shallow depth of field and shifts focus automatically in your videos<br>\r\n•	Pro camera system with new 12MP Telephoto, Wide and Ultra Wide cameras; LiDAR Scanner; 6x optical zoom range; macro photography; Photographic Styles, ProRes video, Smart HDR 4, Night mode, Apple ProRAW, 4K Dolby Vision HDR recording<br>\r\n•	12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording<br>\r\n•	A15 Bionic for lightning-fast performance<br>\r\n•	Up to 28 hours of video playback. The best battery life ever in an iPhone<br>\r\n•	Durable design with Ceramic Shield<br>\r\n•	Industry-leading IP68 water resistance<br>\r\n•	iOS 15 packs new features to do more with iPhone than ever before<br>\r\n•	Supports MagSafe accessories for easy attach and faster wireless charging', 1, 'Apple', 'Phone'),
(5, 'iPad', '1499.00', '•	Gorgeous 10.2-inch Retina display with True Tone<br>\r\n•	A13 Bionic chip with Neural Engine<br>\r\n•	8MP Wide back camera, 12MP Ultra Wide front camera with Centre Stage<br>\r\n•	Stereo speakers<br>\r\n•	Touch ID for secure authentication<br>\r\n•	802.11ac Wi-Fi and LTE2<br>\r\n•	Up to 10 hours of battery life<br>\r\n•	Lightning connector for charging and accessories<br>\r\n•	Works with Apple Pencil (1st generation) and Smart Keyboard<br>\r\n•	iPadOS 15 is uniquely powerful, easy to use and designed for the versatility of iPad', 0, 'Apple', 'Tablet'),
(6, 'iPad mini', '2299.00', '•	8.3-inch Liquid Retina display with True Tone and wide colour<br>\r\n•	A15 Bionic chip with Neural Engine<br>\r\n•	Touch ID for secure authentication<br>\r\n•	12MP Wide back camera, 12MP Ultra Wide front camera with Centre Stage<br>\r\n•	Available in Purple, Starlight, Pink and Space Grey<br>\r\n•	Landscape stereo speakers<br>\r\n•	Stay connected with ultra-fast Wi-Fi 6 and LTE<br>\r\n•	Up to 10 hours of battery life<br>\r\n•	USB-C connector for charging and accessories<br>\r\n•	Works with Apple Pencil (2nd generation) <br>\r\n•	iPadOS 15 is uniquely powerful, easy to use and designed for the versatility of iPad', 1, 'Apple', 'Tablet'),
(7, 'iPad Air 5th Generation', '2699.00', '•	Stunning 10.9-inch Liquid Retina display with True Tone and P3 wide colour<br>\r\n•	Apple M1 chip<br>\r\n•	Touch ID for secure authentication<br>\r\n•	12MP back camera and 7MP FaceTime HD front camera<br>\r\n•	Available in Silver, Space Grey, Rose Gold, Green and Sky Blue<br>\r\n•	Wide stereo audio<br>\r\n•	Wi-Fi 6 (802.11ax) and Gigabit-class LTE mobile data<br>\r\n•	Up to 10 hours of battery life<br>\r\n•	USB-C connector for charging and accessories<br>\r\n•	Support for Magic Keyboard, Smart Keyboard Folio and Apple Pencil (2nd generation)\r\niPadOS 14 brings new capabilities designed specifically for iPad', 1, 'Apple', 'Tablet'),
(8, 'AirPods 3rd Generation', '829.00', '•	Spatial audio with dynamic head tracking places sound all around you<br>\r\n•	Adaptive EQ automatically tunes music to your ears<br>\r\n•	All-new contoured design<br>\r\n•	Force sensor lets you easily control your entertainment, answer or end calls, and more<br>\r\n•	Sweat and water resistant<br>\r\n•	Up to 6 hours of listening time with one charge<br>\r\n•	Up to 30 hours of total listening time with the MagSafe Charging Case<br>\r\n•	Effortless setup, in-ear detection and automatic switching for a magical experience<br>\r\n•	Easily share audio between two sets of AirPods on your iPhone, iPad, iPod touch or Apple TV', 1, 'Apple', 'Audio'),
(9, 'AirPods Pro', '899.00', '•	Active Noise Cancellation blocks outside noise, so you can immerse yourself in music<br>\r\n•	Transparency mode for hearing and interacting with the world around you<br>\r\n•	Spatial audio with dynamic head tracking places sound all around you<br>\r\n•	Adaptive EQ automatically tunes music to your ears<br>\r\n•	Three sizes of soft, tapered silicone tips for a customisable fit<br>\r\n•	Force sensor lets you easily control your entertainment, answer or end calls, and more<br>\r\n•	Sweat and water resistant<br>\r\n•	More than 24 hours of total listening time with the MagSafe Charging Case<br>\r\n•	Effortless setup, in-ear detection and automatic switching for a magical experience<br>\r\n•	Easily share audio between two sets of AirPods on your iPhone, iPad, iPod touch or Apple TV', 1, 'Apple', 'Audio'),
(10, 'Apple Watch Series 7', '1749.00', '•	Always-on Retina display has nearly 20 per cent more screen area than Series 6, making everything easier to see and use<br>\r\n•	The most crack-resistant front crystal yet on an Apple Watch, IP6X dust resistance and swimproof design<br>\r\n•	Measure your blood oxygen with a powerful sensor and app<br>\r\n•	Take an ECG anytime, anywhere<br>\r\n•	Get high and low heart rate, and irregular heart rhythm notifications<br>\r\n•	Stay in the moment with the new Mindfulness app, and reach your sleep goals with the Sleep app<br>\r\n•	Track new tai chi and pilates workouts, in addition to favourites like running, yoga, swimming and dance<br>\r\n•	Track your daily activity on Apple Watch and see your trends in the Fitness app on iPhone<br>\r\n•	Sync your favourite music and podcasts<br>\r\n•	All-day battery life and faster charging<br>\r\n•	watchOS 8 introduces new workout types, the Mindfulness app, the new Portraits watch face and enhancements to Messages<br>\r\n•	Apple Watch comes with three free months of Fitness+, featuring world-class workouts by the world’s top trainers', 1, 'Apple', 'Watch'),
(11, 'Apple Pencil (2nd generation)', '549.00', '•	Apple Pencil (2nd generation) delivers pixel-perfect precision and industry-leading low latency, making it great for drawing, sketching, coloring, taking notes, marking up email, and more. And it’s as easy and natural to use as a pencil.<br>\r\n•	Apple Pencil (2nd generation) also allows you to change tools without setting it down, thanks to its intuitive touch surface that supports double-tapping.<br>\r\n•	Designed for iPad Pro and iPad Air, it features a flat edge that attaches magnetically for automatic charging and pairing.', 1, 'Apple', 'Accessories'),
(12, 'FreeBuds Pro', '499.00', '•	Intelligent Dynamic ANC<br>\r\n•	Natural Awareness and Voice Mode<br>\r\n•	Seamless Dual Device Connection', 1, 'Huawei', 'Audio'),
(13, 'Samsung Galaxy S22 Ultra 5G', '5099.00', '•	Galaxy’s first 4nm processor<br>\r\n•	Fast charge that lasts all day and more<br>\r\n•	Vision Booster technology defies daylight<br>\r\n•	Make nights epic with Nightography<br>\r\n•	The first Galaxy S with embedded S Pen', 1, 'Samsung', 'Phone'),
(14, 'Samsung Galaxy A52', '1499.00', '•	6.5 FHD+ Super AMOLED Infinity O Display<br>\r\n•	8GB RAM+256GB ROM<br>\r\n•	Snapdragon 720G<br>\r\n•	64MP+12MP+5MP+5MP Rear | 32MP Front<br>\r\n•	4,500mAh', 1, 'Samsung', 'Phone'),
(15, 'Galaxy Tab S7 FE', '1899.00', '•	Second Screen for your PC/Laptop<br>\r\n•	Pen & Touch on your Second Screen<br>\r\n•	Change the way you Game', 1, 'Samsung', 'Tablet'),
(16, 'Samsung Galaxy Watch4 Classic', '1299.00', 'Health monitoring : Body Composition, Blood Oxygen during sleep, Snoring detection', 1, 'Samsung', 'Watch'),
(17, 'Galaxy Buds 2', '499.00', '•	Bluetooth: 5.2<br>\r\n•	BT Profile: HFP, A2DP, AVRCP<br>\r\n•	Codec: Scalable (Samsung proprietary), AAC, SBC', 1, 'Samsung', 'Audio'),
(18, 'HUAWEI nova 9', '1999.00', '•	50 MP Ultra Vision Camera<br>\r\n•	120 Hz Original-Colour Curved Display<br>\r\n•	66W HUAWEI SuperCharge<br>\r\n•	EMUI 12, All-Scenario Seamless AI Life', 1, 'Huawei', 'Phone'),
(19, 'HUAWEI Watch GT 3', '999.00', '•	All-Day SpO2 Monitoring<br>\r\n•	AI Running Coach<br>\r\n•	Durable Battery Life', 1, 'Huawei', 'Watch'),
(20, 'HUAWEI MatePad 10.4', '1299.00', '•	HUAWEI Kirin 820<br>\r\n•	4+128GB<br>\r\n•	10V/2.25A', 1, 'Huawei', 'Tablet'),
(21, 'HUAWEI P50 Pro', '4199.00', '•	True-Form Dual-Matrix Camera<br>\r\n•	Dual HUAWEI SuperCharge, IP68<br>\r\n•	6.6\' True-Chroma Display, 120 Hz', 1, 'Huawei', 'Phone'),
(22, 'Xiaomi Mi 11T', '1699.00', '•	MediaTek Dimensity 1200-Ultra Processor<br>\r\n•	5,000mAh Battery<br>\r\n•	6.67\" AMOLED DotDisplay<br>\r\n•	Refresh rate: 120Hz<br>\r\n•	108MP+8MP+5MP triple camera<br>\r\n•	16MP in-display selfie camera', 1, 'Xiaomi', 'Phone'),
(23, 'Mi Pad 5', '1599.00', '•	Size: 11\" Display<br>\r\n•	Battery: 8720mAh (TYP) <br>\r\n•	Operating System: MIUI For Pad<br>\r\n•	Speaker: Dolby Atmos® Supported<br>\r\n•	Processor: Qualcomm® Snapdragon™ 860', 1, 'Xiaomi', 'Tablet'),
(24, 'Xiaomi Mi True Wireless Earbuds', '179.00', '•	Truly Wire-free Design<br>\r\n•	High-quality Audio<br>\r\n•	Secure and Comfortable Fit<br>\r\n•	Intuitive Touch Control<br>\r\n•	Auto-on, Auto-connect<br>\r\n•	Remove to Pause<br>\r\n•	Advanced Tech for the Best Sound<br>\r\n•	True-to-life Sound with HD Quality', 1, 'Xiaomi', 'Audio'),
(25, 'Xiaomi Mi Band 6', '189.00', 'Message/call notification, App alerts, Calendar, Alarm, Clock, Stopwatch, Timer, Music control, Find phone, Unlock phone(MIUI), Camera remote shutter*, Weather, Set activity goals.', 1, 'Xiaomi', 'Watch'),
(26, 'Xiaomi 11 Lite 5G', '1399.00', '•	8GB + 256GB<br>\r\n•	4250mAh (typ) Battery <br>\r\n•	33W Fast Charging<br>\r\n•	Dolby Vision® supported <br>\r\n•	90Hz AMOLED', 1, 'Xiaomi', 'Phone'),
(27, 'Oppo Find X3 Pro', '4299.00', '•	120Hz Dynamic Refresh Rate<br>\r\n•	65W SuperVOOC Flash Charge<br>\r\n•	Sound by Hans Zimmer', 1, 'Oppo', 'Phone'),
(28, 'iPhone SE (2022)', '2099.00', '•	4.7-inch Retina HD display<br>\r\n•	Advanced single-camera system with 12MP Wide camera; Smart HDR 4, Photographic Styles, Portrait mode and 4K video up to 60 fps<br>\r\n•	7MP FaceTime HD camera with Smart HDR 4, Photographic Styles, Portrait mode and 1080p video recording<br>\r\n•	A15 Bionic chip for lightning-fast performance<br>\r\n•	Up to 15 hours of video playback<br>\r\n•	Durable design and IP67 water resistance<br>\r\n•	Home button with Touch ID for secure authentication<br>\r\n•	iOS 15 packs new features to do more with iPhone than ever before', 1, 'Apple', 'Phone'),
(29, 'iPhone 13 Silicone Case with MagSafe', '219.00', 'Designed by Apple to complement iPhone SE, the form of the silicone case fits snugly over the volume buttons, side button, and curves of your device without adding bulk. A soft microfiber lining on the inside helps protect your iPhone. On the outside, the silky, soft-touch finish of the silicone exterior feels great in your hand. And you can keep it on all the time, even when you’re charging wirelessly. Like every Apple-designed case, it undergoes thousands of hours of testing throughout the design and manufacturing process. So not only does it look great, it’s built to protect your iPhone from scratches and drops.', 1, 'Apple', 'Accessories'),
(30, 'MagSafe Battery Pack', '479.00', '\r\nAttaching the MagSafe Battery Pack is a snap. Its compact, intuitive design makes on-the-go charging easy. The perfectly aligned magnets keep it attached to your iPhone 12 and iPhone 12 Pro or iPhone 13 and iPhone 13 Pro — providing safe and reliable wireless charging. And it automatically charges, so there’s no need to turn it on or off. There’s no interference with your credit cards or key fobs either.\r\n<br>\r\nThe MagSafe Battery Pack can charge even faster when coupled with a 27W or higher charger, like those that ship with MacBook. And when you’re in need of a wireless charger, just plug in a Lightning cable for up to 15W of wireless charging.', 1, 'Apple', 'Accessories'),
(31, 'MagSafe Charger', '179.00', '\r\nThe MagSafe Charger makes wireless charging a snap. The perfectly aligned magnets attach to your iPhone 13, iPhone 13 Pro, iPhone 12, and iPhone 12 Pro and provide faster wireless charging up to 15W.\r\n<br><br>\r\nThe MagSafe Charger maintains compatibility with Qi charging, so it can be used to wirelessly charge your iPhone 8 or later, as well as AirPods models with a wireless charging case, as you would with any Qi-certified charger.', 1, 'Apple', 'Accessories'),
(32, 'Samsung Galaxy A73', '2099.00', '•	Eligible for trade in<br>\r\n•	6.7\" FHD+ Super AMOLED+ Display for Immersive Viewing Experience<br>\r\n•	Multi Role Quad Rear Camera with 108MP OIS main camera<br>\r\n•	5,000mAh Long Lasting Battery for All Day Usage with 25W Fast Charging<br>\r\n•	IP67 Water Resistant', 1, 'Samsung', 'Phone'),
(33, 'Samsung Galaxy Tab S8 Ultra', '5899.00', '•	Clip Studio Paint brings out your inner artist<br>\r\n•	Google Duo gets the gang together<br>\r\n•	Auto Framing makes you the center of attention<br>\r\n•	Multi Window divides your screen<br>\r\n•	A brand new S Pen', 1, 'Samsung', 'Tablet'),
(34, 'Galaxy Buds Pro', '699.00', '•	Control Active Noise Canceling level for immersive sound experience<br>\r\n•	Bring studio sound to you from powerful 2-way speakers with sound by AKG<br>\r\n•	Immerse yourself with cinematic sound surrounding you with 360 Audio*<br>\r\n•	Enjoy clear calling with high functional 3-mic system', 1, 'Samsung', 'Audio'),
(35, 'HUAWEI nova 9 SE', '1099.00', '•	108 MP High-Res Photography<br>\r\n•	66 W HUAWEI SuperCharge<br>\r\n•	Creative Vlog Experience', 1, 'Huawei', 'Phone'),
(36, 'HUAWEI P50 Pocket Premium Edition', '5999.00', '•	Processor: Snapdragon 888 4G<br>\r\n•	Fast Charge: HUAWEI SuperCharge (Max 40 W)<br>\r\n•	Operating System: EMUI 12', 1, 'Huawei', 'Phone'),
(37, 'HUAWEI MatePad 11', '2399.00', '•	Display: 10.95\"<br>\r\n•	Screen Resolution: PPI 275<br>\r\n•	Dimention: 253.8 mm × 165.3 mm × 7.25 mm<br>\r\n•	Weight: 485g<br>\r\n•	Chipset: Qualcomm Snapdragon 865', 1, 'Huawei', 'Tablet'),
(38, 'HUAWEI WATCH 3', '1699.00', '•	Dimensions: 48mm x 49,6mm x 14mm<br>\r\n•	Weight: About 63g (Strap excluded) <br>\r\n•	Size: 1.43 inches<br>\r\n•	Watch Case: Titanium + Ceramic<br>\r\n•	Watch Strap: Leather strap', 1, 'Huawei', 'Watch'),
(39, 'HUAWEI FreeBuds Lipstick', '999.00', '•	High Resolution Sound<br>\r\n•	Air-Like Comfort<br>\r\n•	Open-Fit Active Noise Cancellation 2.0', 1, 'Huawei', 'Audio'),
(40, 'Xiaomi 12', '2999.00', '•	8GB+256GB<br>\r\n•	4500mAh (TYP) <br>\r\n•	MIUI 13, Android 12<br>\r\n•	Snapdragon® 8 Gen 1<br>\r\n•	50W Wireless Turbo Charging', 1, 'Xiaomi', 'Phone'),
(41, 'Xiaomi Watch S1', '899.00', '•	Battery Capacity: 470mAh<br>\r\n•	Display: 1.43\" AMOLED Display<br>\r\n•	Water Resistance Rating: 5 ATM<br>\r\n•	Compatible With: Android 6.0 or iOS 10.0 And Above<br>\r\n•	Wireless Connection: Wi-Fi IEEE 802.11b/g/n 2.4GHz; Bluetooth® 5.2', 1, 'Xiaomi', 'Watch'),
(42, 'Xiaomi Watch S1 Active', '649.00', '•	Battery: 470mAh <br>\r\n•	Display: 1.43\" AMOLED Display<br>\r\n•	Water Resistance Rating: 5 ATM<br>\r\n•	Compatible With: Android 6.0 Or iOS 10.0 And Above<br>\r\n•	Wireless Connection: Wi-Fi IEEE 802.11b/g/n 2.4GHz, Bluetooth 5.2', 1, 'Xiaomi', 'Watch'),
(43, 'Apple Watch Nike Series 7', '1749.00', '•	Use the built-in Nike Run Club app to stay motivated with Challenges and Guided Runs<br>\r\n•	Run in style with the Nike Sport Band and Nike Sport Loop in new colours<br>\r\n•	Get exclusive Nike watch faces', 1, 'Apple', 'Watch'),
(44, '20W USB-C Power Adapter', '99.00', 'The Apple 20W USB‑C Power Adapter offers fast, efficient charging at home, in the office, or on the go. While the power adapter is compatible with any USB‑C-enabled device, Apple recommends pairing it with the iPad Pro and iPad Air for optimal charging performance. You can also pair it with iPhone 8 or later to take advantage of the fast-charging feature.', 1, 'Apple', 'Accessories'),
(45, 'USB-C to Lightning Cable (1m)', '99.00', 'Connect your iPhone, iPad, or iPod with Lightning connector to your USB-C or Thunderbolt 3 (USB-C) enabled Mac for syncing and charging, or to your USB-C enabled iPad for charging.<br><br>\r\nYou can also use this cable with your Apple 18W, 20W, 29W, 30W, 61W, 87W or 96W USB‑C Power Adapter to charge your iOS device and even take advantage of the fast-charging feature on select iPhone and iPad models.', 1, 'Apple', 'Accessories'),
(46, 'Realme C35', '549.00', '•	50MP AI Triple Camera<br>\r\n•	16.7cm（6.6\') FHD Fullscreen<br>\r\n•	5000mAh Massive Battery<br>\r\n•	18W Quick Charge<br>\r\n•	Powerful Unisoc T616 Processor', 1, 'realme', 'Phone');

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `product_detail_code` int(11) NOT NULL,
  `product_capacity` varchar(20) DEFAULT NULL,
  `product_price` decimal(7,2) NOT NULL,
  `product_stock1` int(11) NOT NULL,
  `product_stock2` int(11) NOT NULL DEFAULT 0,
  `product_stock3` int(11) NOT NULL DEFAULT 0,
  `product_stock4` int(11) NOT NULL DEFAULT 0,
  `product_stock5` int(11) NOT NULL DEFAULT 0,
  `product_stock6` int(11) NOT NULL DEFAULT 0,
  `product_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_detail_code`, `product_capacity`, `product_price`, `product_stock1`, `product_stock2`, `product_stock3`, `product_stock4`, `product_stock5`, `product_stock6`, `product_code`) VALUES
(1, '128GB', '3399.00', 3, 3, 2, 2, 2, 0, 1),
(2, '256GB', '3899.00', 3, 2, 1, 1, 1, 0, 1),
(3, '512GB', '4799.00', 2, 1, 1, 0, 0, 0, 1),
(4, '128GB', '3899.00', 5, 2, 1, 1, 0, 0, 2),
(5, '256GB', '4399.00', 4, 3, 2, 2, 0, 0, 2),
(6, '512GB', '5299.00', 2, 2, 1, 1, 0, 0, 2),
(7, '128GB', '4899.00', 10, 5, 5, 5, 0, 0, 3),
(8, '256GB', '5399.00', 2, 2, 1, 1, 0, 0, 3),
(9, '512GB', '6299.00', 1, 1, 0, 0, 0, 0, 3),
(10, '1TB', '7199.00', 2, 1, 0, 0, 0, 0, 3),
(11, '128GB', '5299.00', 4, 3, 2, 3, 0, 0, 4),
(12, '256GB', '5799.00', 3, 3, 2, 1, 0, 0, 4),
(13, '512GB', '6699.00', 1, 1, 1, 1, 0, 0, 4),
(14, '1TB', '7599.00', 1, 0, 0, 1, 0, 0, 4),
(15, '64GB', '1499.00', 5, 5, 0, 0, 0, 0, 5),
(16, '256GB', '2149.00', 2, 2, 0, 0, 0, 0, 5),
(17, '64GB', '2299.00', 5, 5, 5, 4, 0, 0, 6),
(18, '256GB', '2949.00', 2, 2, 1, 1, 0, 0, 6),
(19, '64GB', '2699.00', 2, 2, 1, 0, 1, 0, 7),
(20, '256GB', '3349.00', 1, 0, 0, 1, 0, 0, 7),
(21, NULL, '829.00', 5, 0, 0, 0, 0, 0, 8),
(22, NULL, '899.00', 1, 0, 0, 0, 0, 0, 9),
(23, '41mm', '1749.00', 2, 1, 1, 0, 0, 0, 10),
(24, NULL, '549.00', 1, 0, 0, 0, 0, 0, 11),
(25, NULL, '499.00', 2, 0, 2, 0, 0, 0, 12),
(26, '8+128GB', '5099.00', 2, 1, 1, 2, 0, 0, 13),
(27, '12+256GB', '5499.00', 1, 1, 1, 0, 0, 0, 13),
(28, '8+256GB', '1499.00', 1, 0, 3, 0, 0, 0, 14),
(29, '64GB', '1899.00', 1, 1, 0, 0, 0, 0, 15),
(30, '42mm', '1299.00', 1, 1, 0, 0, 0, 0, 16),
(31, '', '499.00', 0, 0, 0, 0, 0, 0, 17),
(32, '8+256GB', '1999.00', 2, 3, 0, 0, 0, 0, 18),
(33, '42mm', '999.00', 2, 1, 0, 0, 0, 0, 19),
(34, '4+128GB', '1299.00', 1, 0, 0, 0, 0, 0, 20),
(35, '8+256GB', '4199.00', 1, 1, 0, 0, 0, 0, 21),
(36, '8+128GB', '1699.00', 0, 1, 2, 0, 0, 0, 22),
(37, '8+256GB', '1899.00', 1, 1, 0, 0, 0, 0, 22),
(38, '6+256GB', '1599.00', 1, 3, 0, 0, 0, 0, 23),
(39, '', '179.00', 1, 0, 0, 0, 0, 0, 24),
(40, '47.4mm', '189.00', 8, 0, 0, 0, 0, 0, 25),
(41, '8+128GB', '1399.00', 2, 2, 1, 1, 0, 0, 26),
(42, '8+256GB', '1599.00', 1, 1, 0, 1, 0, 0, 26),
(43, '12+256GB', '3869.10', 0, 0, 0, 0, 0, 0, 27),
(44, '46mm', '1099.00', 0, 1, 0, 0, 0, 0, 19),
(45, '45mm', '1899.00', 1, 1, 2, 0, 0, 0, 10),
(46, '46mm', '1399.00', 1, 0, 0, 0, 0, 0, 16),
(47, '64GB', '2099.00', 0, 0, 1, 0, 0, 0, 28),
(48, '128GB', '2299.00', 0, 0, 0, 0, 0, 0, 28),
(49, '256GB', '2799.00', 1, 1, 1, 0, 0, 0, 28),
(50, '', '219.00', 5, 1, 1, 3, 0, 0, 29),
(51, '', '479.00', 3, 0, 0, 0, 0, 0, 30),
(52, '', '179.00', 9, 0, 0, 0, 0, 0, 31),
(53, '8+256GB', '2099.00', 5, 3, 2, 0, 0, 0, 32),
(54, '12+256GB', '5899.00', 2, 0, 0, 0, 0, 0, 33),
(55, '', '699.00', 2, 3, 2, 0, 0, 0, 34),
(56, '8+128GB', '1099.00', 3, 3, 5, 0, 0, 0, 35),
(57, '12+512GB', '7299.00', 2, 2, 0, 0, 0, 0, 36),
(58, '8+256GB', '5999.00', 1, 2, 0, 0, 0, 0, 36),
(59, '8+256GB', '2399.00', 3, 3, 0, 0, 0, 0, 37),
(60, '48mm', '1699.00', 5, 0, 0, 0, 0, 0, 38),
(61, '', '999.00', 10, 0, 0, 0, 0, 0, 39),
(62, '8+256GB', '2999.00', 5, 3, 4, 0, 0, 0, 40),
(63, '46mm', '899.00', 2, 4, 0, 0, 0, 0, 41),
(64, '46mm', '649.00', 1, 3, 0, 0, 0, 0, 42),
(65, '41mm', '1749.00', 5, 4, 0, 0, 0, 0, 43),
(66, '45mm', '1899.00', 2, 1, 0, 0, 0, 0, 43),
(67, '', '99.00', 20, 0, 0, 0, 0, 0, 44),
(68, '', '99.00', 30, 0, 0, 0, 0, 0, 45),
(69, '4+64GB', '494.10', 0, 0, 0, 0, 0, 0, 46),
(70, '4+128GB', '584.10', 0, 0, 0, 0, 0, 0, 46);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_img_code` int(11) NOT NULL,
  `product_img1` text NOT NULL,
  `product_color1` text NOT NULL,
  `product_img2` text DEFAULT NULL,
  `product_color2` text DEFAULT NULL,
  `product_img3` text DEFAULT NULL,
  `product_color3` text DEFAULT NULL,
  `product_img4` text DEFAULT NULL,
  `product_color4` text DEFAULT NULL,
  `product_img5` text DEFAULT NULL,
  `product_color5` text DEFAULT NULL,
  `product_img6` text DEFAULT NULL,
  `product_color6` text DEFAULT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_img_code`, `product_img1`, `product_color1`, `product_img2`, `product_color2`, `product_img3`, `product_color3`, `product_img4`, `product_color4`, `product_img5`, `product_color5`, `product_img6`, `product_color6`, `product_code`) VALUES
(1, 'IMG-625fea47b487d1.25708955.png', 'Pink', 'IMG-62284d1bbc5e02.72750988.png', 'Blue', 'IMG-62284d4d8b5374.59978544.png', 'Startlight', 'IMG-62284d5aa948e0.17581773.png', 'Midnight', 'IMG-62284d63bef1d4.25361924.png', '(PRODUCT) RED', 'IMG-622841da3f0071.75268041.png', 'Green', '1'),
(2, 'IMG-62284d855d4ec9.54301272.png', 'Pink', 'IMG-62284d90f326a3.83273045.png', 'Blue', 'IMG-62284da8a5bf35.49585268.png', 'Starlight', 'IMG-62284dc1d9b268.88268449.png', 'Midnight', 'IMG-62284dcc20c290.01623902.png', '(PRODUCT) RED', 'IMG-62284db610b3a9.41745669.png', 'Green', '2'),
(3, 'IMG-62284e03a15685.18124539.png', 'Sierra Blue', 'IMG-62284f022fd679.47504395.png', 'Silver', 'IMG-62284f0c331a84.50910057.png', 'Gold', 'IMG-62284f16ee7e72.31607442.png', 'Graphite', 'IMG-62284ef4731f30.70276250.png', 'Alpine Green', NULL, NULL, '3'),
(4, 'IMG-62284f7dee58b8.27919639.png', 'Sierra Blue', 'IMG-62284fe07fecd7.92480078.png', 'Silver', 'IMG-62284feaaf7386.42987382.png', 'Gold', 'IMG-62284ff81a0fd9.79313864.png', 'Graphite', 'IMG-6228500b7453f3.94707659.png', 'Alpine Green', NULL, NULL, '4'),
(5, 'IMG-620fa5de8c0b10.40916709.png', 'Space Grey', 'IMG-620fa5de8c4799.97452796.png', 'Silver', '', '', '', '', '', '', NULL, NULL, '5'),
(6, 'IMG-620fa7aabc7398.31950291.png', 'Purple', 'IMG-620fa7aabca710.66100520.png', 'Pink', 'IMG-620fa7aabcd502.65967127.png', 'Starlight', 'IMG-620fa7aabd1300.55248816.png', 'Space Grey', '', '', NULL, NULL, '6'),
(7, 'IMG-6228505b35f585.50503774.png', 'Space Gray', 'IMG-622850bc445e22.77352348.png', 'Pink', 'IMG-622850c6b3f119.73466490.png', 'Blue', 'IMG-622850cfcd2af7.40467099.png', 'Purple', 'IMG-622850e0dfcb93.71412175.png', 'Starlight', NULL, '', '7'),
(8, 'IMG-620fa9407f78e6.19862011.png', 'White', '', '', '', '', '', '', '', '', NULL, NULL, '8'),
(9, 'IMG-620fa9eaa73e32.69141714.png', 'White', '', '', '', '', '', '', '', '', NULL, NULL, '9'),
(10, 'IMG-620fabef132166.97826447.png', 'Clover', 'IMG-620fabef1352c4.05183588.png', 'Midnight', 'IMG-620fabef1387a5.81275069.png', 'Starlight', '', '', '', '', NULL, '', '10'),
(11, 'IMG-620fadc2f37548.62108257.png', 'White', '', '', '', '', '', '', '', '', NULL, NULL, '11'),
(12, 'IMG-62137a8985b318.52254067.png', 'Silver Frost', 'IMG-62137a8985b318.53354067.png', 'Ceramic White', 'IMG-62137a8984dd06.29564934.png', 'Carbon Black', '', '', '', '', NULL, NULL, '12'),
(13, 'IMG-6228ac03c41389.79451036.png', 'Burgundy', 'IMG-6228ac12e92726.25894517.png', 'Green', 'IMG-6228ac2b3b7805.13398275.png', 'Phantom White', 'IMG-6228ac47031aa9.75004579.png', 'Phantom Black', '', '', '', '', '13'),
(14, 'IMG-62286b12e344e4.41641962.png', 'Awesome Blue', 'IMG-62286b12e399f1.47757092.png', 'Awesome Violet', 'IMG-62286b12e3db55.77344117.png', 'Awesome Black', '', '', '', '', '', '', '14'),
(15, 'IMG-62286d51a785e6.43805181.png', 'Light Pink', 'IMG-62286d51a7b461.70277109.png', 'Silver', 'IMG-62286d51a8cc25.05709599.png', 'Black', '', '', '', '', '', '', '15'),
(16, 'IMG-622870ce152982.49960367.png', 'Black', 'IMG-622870ce157199.34208194.png', 'Silver', '', '', '', '', '', '', '', '', '16'),
(17, 'IMG-622873b8170ee7.06133153.png', 'Graphite', 'IMG-622873b8172c25.13445017.png', 'White', '', '', '', '', '', '', '', '', '17'),
(18, 'IMG-622875d38f0222.76933669.png', 'Starry Blue', 'IMG-622875d38f1f87.11920254.png', 'Black', '', '', '', '', '', '', '', '', '18'),
(19, 'IMG-622878051bfb49.61348880.png', 'Brown Leather Strap', 'IMG-622878051c3120.95904257.png', 'Black', '', '', '', '', '', '', '', '', '19'),
(20, 'IMG-62287a163463c6.47713799.png', 'Midnight Grey', '', '', '', '', '', '', '', '', '', '', '20'),
(21, 'IMG-6228ab3c8cd6d4.57232467.png', 'Cocoa Gold', 'IMG-6228ab47166de9.70237478.png', 'Golden Black', '', '', '', '', '', '', '', '', '21'),
(22, 'IMG-62287cfed4ac67.01242135.png', 'Celestial Blue', 'IMG-62287cfed4e497.86197225.png', 'Moonlight White', 'IMG-62287cfed518e5.56052357.png', 'Black', '', '', '', '', '', '', '22'),
(23, 'IMG-62288053403ef1.12908764.png', 'Black', 'IMG-62288053407f20.61025944.png', 'White', '', '', '', '', '', '', '', '', '23'),
(24, 'IMG-622884b1340ed1.95832095.png', 'Black', '', '', '', '', '', '', '', '', '', '', '24'),
(25, 'IMG-6228864fd2e5c2.11641394.png', 'Black', '', '', '', '', '', '', '', '', '', '', '25'),
(26, 'IMG-62288a9c517c70.98212020.png', 'Bubblegum Blue', 'IMG-62288a9c51aa16.20339674.png', 'Truffle Black', 'IMG-62288a9c51d404.46215217.png', 'Peach Pink', 'IMG-62288a9c51fac5.24668764.png', 'Snowflake White', '', '', '', '', '26'),
(27, 'IMG-62288f4eb1ead5.25205109.png', 'Gloss Black', 'IMG-62288f4eb21a28.53895751.png', 'Blue', '', '', '', '', '', '', '', '', '27'),
(28, 'IMG-623d5928a664f1.74209441.png', 'Midnight', 'IMG-623d5928a6a3e7.64251678.png', 'Starlight', 'IMG-623d5928a6d811.50944475.png', '(PRODUCT)RED', '', '', '', '', '', '', '28'),
(29, 'IMG-623d5c7e5f13b1.54173382.png', 'Chalk Pink', 'IMG-623d5c7e5fec99.44253318.png', 'Midnight', 'IMG-623d5c7e601f15.60607096.png', 'Red', 'IMG-623d5c7e6045a9.47106065.png', 'Blue Fog', '', '', '', '', '29'),
(30, 'IMG-6245ddbae16099.83741691.png', 'White', '', '', '', '', '', '', '', '', '', '', '30'),
(31, 'IMG-6245df7a4ea967.00767250.png', 'White', '', '', '', '', '', '', '', '', '', '', '31'),
(32, 'IMG-625cf1c5320530.08446170.png', 'Awesome Mint', 'IMG-625cf1c53250f3.86942689.png', 'Awesome Gray', 'IMG-625cf1c532be40.74699356.png', 'Awesome White', '', '', '', '', '', '', '32'),
(33, 'IMG-625cf70b1cd5c7.69415891.png', 'Graphite', '', '', '', '', '', '', '', '', '', '', '33'),
(34, 'IMG-625cf948810f15.50607885.png', 'Phantom Violet', 'IMG-625cf9488172c1.54221616.png', 'Black', 'IMG-625cf94881d294.97365345.png', 'Silver', '', '', '', '', '', '', '34'),
(35, 'IMG-625cfc080c8276.02507618.png', 'Crystal Blue', 'IMG-625cfc080def20.35083878.png', 'Midnight Black', 'IMG-625cfc080e1ae4.65094614.png', 'Pearl White', '', '', '', '', '', '', '35'),
(36, 'IMG-625cfe151a12a6.39682543.png', 'Premium Gold', 'IMG-625cfe151a4358.97193638.png', 'White', '', '', '', '', '', '', '', '', '36'),
(37, 'IMG-625cffdae5ef01.84824823.png', 'Matte Grey', 'IMG-625cffdae66d78.43938239.png', 'Olive Green', '', '', '', '', '', '', '', '', '37'),
(38, 'IMG-625d029e511278.66138006.png', 'Titanium Grey Brown Leather Strap', '', '', '', '', '', '', '', '', '', '', '38'),
(39, 'IMG-625d0802709206.91946676.png', 'Red', '', '', '', '', '', '', '', '', '', '', '39'),
(40, 'IMG-625d0d1be1a9e0.36112544.png', 'Purple', 'IMG-625d0d1be1e704.46112022.png', 'Gray', 'IMG-625d0d1be21b58.83436519.png', 'Blue', '', '', '', '', '', '', '40'),
(41, 'IMG-625d0f76579790.34010920.png', ' Black (black leather strap + black fluororubber strap)', 'IMG-625d0f7657c970.63688672.png', 'Silver (brown leather strap + grey fluororubber strap)', '', '', '', '', '', '', '', '', '41'),
(42, 'IMG-625d122fd18da0.54775870.png', 'Space Black', 'IMG-625d122fd2bb86.51726835.png', 'Moon White', '', '', '', '', '', '', '', '', '42'),
(43, 'IMG-625d147bc81803.38581989.png', 'Pure Platinum/Black', 'IMG-625d147bc8dd47.09734580.png', 'Anthracite/Black', '', '', '', '', '', '', '', '', '43'),
(44, 'IMG-625d17e84b5fe8.52175851.png', 'White', '', '', '', '', '', '', '', '', '', '', '44'),
(45, 'IMG-625d18599c8e07.42613199.png', 'White', '', '', '', '', '', '', '', '', '', '', '45'),
(46, 'IMG-625fea3f09deb3.98321842.png', 'Glowing Green', 'IMG-625fea3f0a1ba5.75791784.png', 'Glowing Black', '', '', '', '', '', '', '', '', '46');

-- --------------------------------------------------------

--
-- Table structure for table `product_specification`
--

CREATE TABLE `product_specification` (
  `product_spec_code` int(11) NOT NULL,
  `product_display` text DEFAULT NULL,
  `product_chip` text DEFAULT NULL,
  `product_back_cam` text DEFAULT NULL,
  `product_front_cam` text DEFAULT NULL,
  `product_battery` text DEFAULT NULL,
  `others` text DEFAULT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_specification`
--

INSERT INTO `product_specification` (`product_spec_code`, `product_display`, `product_chip`, `product_back_cam`, `product_front_cam`, `product_battery`, `others`, `product_code`) VALUES
(1, '•	Super Retina XDR display<br>\r\n•	5.4‑inch (diagonal) all‑screen OLED display<br>\r\n•	2340x1080-pixel resolution at 476 ppi', '•	A15 Bionic chip<br>\r\n•	New 6 core CPU with two performance and four efficiency cores<br>\r\n•	New 4 core GPU<br>\r\n•	New 16 core Neural Engine', '•	Dual 12MP camera system: Wide and Ultra Wide cameras<br>\r\n•	Wide: ƒ/1.6 aperture<br>\r\n•	Ultra Wide: ƒ/2.4 aperture and 120° field of view', '12MP camera: ƒ/2.2 aperture', '•	Built-in rechargeable lithium-ion battery<br>\r\n•	MagSafe wireless charging up to 15W<br>\r\n•	Fast-charge capable: Up to 50% charge in 30 minutes with 20W adapter or higher (available separately)', '', '1'),
(2, '•	Super Retina XDR display<br>\r\n•	6.1 inch (diagonal) all screen OLED display<br>\r\n•	2532x1170-pixel resolution at 460 ppi', '•	A15 Bionic chip<br>\r\n•	New 6 core CPU with two performance and four efficiency cores<br>\r\n•	New 4 core GPU<br>\r\n•	New 16 core Neural Engine', '•	Dual 12MP camera system: Wide and Ultra Wide cameras<br>\r\n•	Wide: ƒ/1.6 aperture<br>\r\n•	Ultra Wide: ƒ/2.4 aperture and 120° field of view', '12MP camera: ƒ/2.2 aperture', '•	Built-in rechargeable lithium-ion battery<br>\r\n•	MagSafe wireless charging up to 15W<br>\r\n•	Fast-charge capable: Up to 50% charge in 30 minutes with 20W adapter or higher (available separately)', '', '2'),
(3, '•	Super Retina XDR display with ProMotion<br>\r\n•	6.1 inch (diagonal) all screen OLED display<br>\r\n•	2532x1170-pixel resolution at 460 ppi', '•	A15 Bionic chip<br>\r\n•	New 6 core CPU with two performance and four efficiency cores<br>\r\n•	New 5 core GPU<br>\r\n•	New 16 core Neural Engine', '•	Pro 12MP camera system: Telephoto, Wide and Ultra Wide cameras<br>\r\n•	Telephoto: ƒ/2.8 aperture<br>\r\n•	Wide: ƒ/1.5 aperture<br>\r\n•	Ultra Wide: ƒ/1.8 aperture and 120° field of view', '12MP camera: ƒ/2.2 aperture', '•	Built-in rechargeable lithium-ion battery<br>\r\n•	MagSafe wireless charging up to 15W<br>\r\n•	Fast-charge capable: Up to 50% charge in 30 minutes with 20W adapter or higher (available separately)', '', '3'),
(4, '•	Super Retina XDR display with ProMotion<br>\r\n•	6.7 inch (diagonal) all screen OLED display<br>\r\n•	2778x1284-pixel resolution at 458 ppi', '•	A15 Bionic chip<br>\r\n•	New 6 core CPU with two performance and four efficiency cores<br>\r\n•	New 5 core GPU<br>\r\n•	New 16 core Neural Engine', '•	Pro 12MP camera system: Telephoto, Wide and Ultra Wide cameras<br>\r\n•	Telephoto: ƒ/2.8 aperture<br>\r\n•	Wide: ƒ/1.5 aperture<br>\r\n•	Ultra Wide: ƒ/1.8 aperture and 120° field of view', '12MP camera: ƒ/2.2 aperture', '•	Built-in rechargeable lithium-ion battery<br>\r\n•	MagSafe wireless charging up to 15W<br>\r\n•	Fast-charge capable: Up to 50% charge in 30 minutes with 20W adapter or higher (available separately)', '', '4'),
(5, '•	10.2-inch (diagonal) LED-backlit Multi-Touch display with IPS technology<br>\r\n•	2160x1620-pixel resolution at 264 pixels per inch (ppi) <br>\r\n•	True Tone display<br>\r\n•	500 nits brightness<br>\r\n•	Fingerprint-resistant oleophobic coating<br>\r\n•	Supports Apple Pencil (1st generation)', '•	A13 Bionic chip with 64-bit architecture<br>\r\n•	Neural Engine', '8MP Wide camera: ƒ/2.4 aperture', '•	12MP Ultra Wide camera, 122° field of view<br>\r\n•	ƒ/2.4 aperture', '•	Built‐in 32.4‐watt‐hour rechargeable lithium polymer battery<br>\r\n•	Up to 10 hours of surfing the web on Wi‐Fi or watching video<br>\r\n•	Charging via power adapter or USB-C to computer system', '', '5'),
(6, '•	8.3-inch (diagonal) LED-backlit Multi-Touch display with IPS technology<br>\r\n•	2266x1488 resolution at 326 pixels per inch (ppi) <br>\r\n•	Wide colour display (P3) <br>\r\n•	True Tone display<br>\r\n•	Fingerprint-resistant oleophobic coating<br>\r\n•	Fully laminated display<br>\r\n•	Anti-reflective coating<br>\r\n•	1.8% reflectivity<br>\r\n•	500 nits brightness<br>\r\n•	Supports Apple Pencil (2nd generation)', '•	A15 Bionic chip with 64-bit architecture<br>\r\n•	6-core CPU<br>\r\n•	5-core graphics<br>\r\n•	16 core Neural Engine', '12MP Wide camera, ƒ/1.8 aperture', '•	12MP Ultra Wide front camera, 122° field of view<br>\r\n•	ƒ/2.4 aperture', '•	Built-in 19.3-watt-hour rechargeable lithium-polymer battery<br>\r\n•	Up to 10 hours of surﬁng the web on Wi Fi or watching video<br>\r\n•	Charging via power adapter or USB-C to computer system', '', '6'),
(7, '•	Liquid Retina display<br>\r\n•	10.9-inch (diagonal) LED backlit Multi Touch display with IPS technology<br>\r\n•	2360x1640 pixel resolution at 264 pixels per inch (ppi) <br>\r\n•	Wide colour display (P3) <br>\r\n•	True Tone display<br>\r\n•	Fingerprint-resistant oleophobic coating<br>\r\n•	Fully laminated display<br>\r\n•	Anti-reflective coating<br>\r\n•	1.8% reflectivity<br>\r\n•	500 nits brightness<br>\r\n•	Supports Apple Pencil (2nd generation)', '•	Apple M1 chip<br>\r\n•	8-core CPU<br>\r\n•	8-core graphics<br>\r\n•	Apple Neural Engine<br>\r\n•	8GB RAM', '•	12MP Wide camera, ƒ/1.8 aperture<br>\r\n•	Digital zoom up to 5x<br>', '•	12MP Ultra Wide front camera, 122° field of view<br>\r\n•	ƒ/2.4 aperture', '•	Built‐in 28.6‐watt‐hour rechargeable lithium polymer battery<br>\r\n•	Up to 10 hours of surfing the web on Wi‐Fi or watching video<br>\r\n•	Charging via power adapter or USB-C to computer system', '', '7'),
(8, '', 'H1 headphone chip', '', '', '•	Up to 30 hours of listening time<br>\r\n•	Up to 20 hours of talk time<br>\r\n•	5 minutes in the case provides around 1 hour of listening time or around 1 hour of talk time', '•	Custom high-excursion Apple driver<br>\r\n•	Custom high dynamic range amplifier<br>\r\n•	Spatial audio with dynamic head tracking1<br>\r\n•	Adaptive EQ', '8'),
(9, '', 'H1 headphone chip', '', '', '•	More than 24 hours of listening time<br>\r\n•	More than 18 hours of talk time<br>\r\n•	5 minutes in the case provides around 1 hour of listening time8 or around 1 hour of talk time', '•	Custom high-excursion Apple driver<br>\r\n•	Custom high dynamic range amplifier<br>\r\n•	Active Noise Cancellation<br>\r\n•	Transparency mode<br>\r\n•	Vent system for pressure equalisation<br>\r\n•	Spatial audio with dynamic head tracking<br>\r\n•	Adaptive EQ', '9'),
(10, '•	Retina LTPO OLED, 1000 nits (peak)<br>\r\n•	1.9 inches<br>\r\n•	484 x 396 pixels (~326 ppi density)<br>\r\n•	Sapphire crystal glass<br>\r\n•	Always-on display<br>', 'Apple S7', '', '', '•	Li-Ion 309 mAh (1.19 Wh), non-removable<br>\r\n•	Charging Wireless charging', '', '10'),
(11, '', '', '', '', 'Battery life: 12 hours', '•	Length: 6.53 inches (166 mm)<br>\r\n•	Diameter: 0.35 inch (8.9 mm) <br>\r\n•	Weight: 0.73 ounce (20.7 grams) <br>\r\n•	Connections: Bluetooth<br>\r\n•	Other Features: Magnetically attaches and pairs', '11'),
(12, '', '11 mm dynamic', '', '', 'Battery capacity:<br>\r\n•	Per earbud: 55 mAh (min.)<br>\r\n•	Charging case: 580 mAh (min.)', '•	Active noise cancellation<br>\r\n•	Call noise cancellation<br>\r\n•	Awarness mode<br>\r\n•	Voice mode', '12'),
(13, '•	Dynamic AMOLED 2X, 120Hz, HDR10+, 1750 nits (peak)<br>\r\n•	6.8 inches, 114.7 cm2 (~90.2% screen-to-body ratio)<br>\r\n•	1440 x 3088 pixels (~500 ppi density)<br>\r\n•	Always-on display', 'Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm)', '•	108 MP, f/1.8, 23mm (wide), 1/1.33\", 0.8µm, PDAF, Laser AF, OIS<br>\r\n•	10 MP, f/4.9, 230mm (periscope telephoto), 1/3.52\", 1.12µm, dual pixel PDAF, OIS, 10x optical zoom<br>\r\n•	10 MP, f/2.4, 70mm (telephoto), 1/3.52\", 1.12µm, dual pixel PDAF, OIS, 3x optical zoom<br>\r\n•	12 MP, f/2.2, 13mm, 120˚ (ultrawide), 1/2.55\", 1.4µm, dual pixel PDAF, Super Steady video', '40 MP, f/2.2, 26mm (wide), 1/2.82\", 0.7µm, PDAF', '•	Li-Ion 5000 mAh, non-removable<br>\r\n•	Fast charging 45W', '', '13'),
(14, 'Super AMOLED, 90Hz, 800 nits (HBM)<br>\r\n6.5 inches, 101.0 cm2 (~84.1% screen-to-body ratio) <br>\r\n1080 x 2400 pixels, 20:9 ratio (~407 ppi density) <br>\r\nCorning Gorilla Glass 5', 'Qualcomm SM7125 Snapdragon 720G (8 nm)', '•	64 MP, f/1.8, 26mm (wide), 1/1.7X\", 0.8µm, PDAF, OIS<br>\r\n•	12 MP, f/2.2, 123˚ (ultrawide), 1.12µm<br>\r\n•	5 MP, f/2.4, (macro) <br>\r\n•	5 MP, f/2.4, (depth)', '32 MP, f/2.2, 26mm (wide), 1/2.8\", 0.8µm', '•	Li-Po 4500 mAh, non-removable<br>\r\n•	Fast charging 25W, 50% in 30 min (advertised)', '', '14'),
(15, '•	12.4 inches, 445.8 cm2 (~84.6% screen-to-body ratio)<br>\r\n•	1600 x 2560 pixels, 16:10 ratio (~243 ppi density)', 'Qualcomm SM7325 Snapdragon 778G 5G (6 nm)', '8 MP, AF', '5 MP', '•	Li-Po 10090 mAh, non-removable<br>\r\n•	Fast charging 45W, 100% in 190 min (advertised)', '', '15'),
(16, '•	Super AMOLED<br>\r\n•	1.4 inches<br>\r\n•	450 x 450 pixels (~321 ppi density)', 'Exynos W920 (5 nm)', '', '', 'Li-Ion 361 mAh, non-removable', 'Sensor<br>\r\nAccelerometer, Barometer, Gyro Sensor, Geomagnetic Sensor, Light Sensor, Optical Heart Rate Sensor, Electrical heart sensor, Bioelectrical Impedance Analysis Sensor, Hall Sensor', '16'),
(17, '', 'BES2500ZP', '', '', 'Play time<br>\r\n5h / TTL 20h (ANC ON)', 'Dynamic 2 Way: Woofer & Tweeter', '17'),
(18, '•	OLED, 1B colors, 120Hz, HDR10<br>\r\n•	6.57 inches, 106.0 cm2 (~89.9% screen-to-body ratio)', 'Qualcomm SM7325 Snapdragon 778G 4G (6 nm)', '•	32 MP, f/2.0, (wide)<br>\r\n•	8 MP, f/2.2, (ultrawide)<br>\r\n•	2 MP, f/2.4, (depth)<br>\r\n•	2 MP, f/2.4, (macro)<br>', '32 MP, f/2.0, (wide)', '•	Li-Po 4300 mAh, non-removable<br>\r\n•	Fast charging 66W,', '', '18'),
(19, '1.43 inches AMOLED Colour Screen', '', '', '', 'Li-Po 455 mAh, non-removable', '50m water resistant', '19'),
(20, '•	IPS LCD<br>\r\n•	10.4 inches, 307.9 cm2 (~81.0% screen-to-body ratio)', 'Kirin 810 (7 nm)', '8 MP, AF', '8 MP', '•	Li-Po 7250 mAh, non-removable<br>\r\n•	Fast charging 18W', '', '20'),
(21, '•	OLED, 1B colors, 120Hz<br>\r\n•	6.6 inches, 105.4 cm2 (~91.2% screen-to-body ratio)<br>\r\n•	1228 x 2700 pixels (~450 ppi density)', 'Kirin 9000 (5 nm)', '•	50 MP, f/1.8, 23mm (wide), PDAF, Laser AF, OIS<br>\r\n•	64 MP, f/3.5, 90mm (periscope telephoto), PDAF, OIS, 3.5x optical zoom, 7x lossless zoom<br>\r\n•	13 MP, f/2.2, 13mm (ultrawide), AF<br>\r\n•	40 MP, f/1.6, 23mm (B/W), AF', '13 MP, f/2.4, (wide), AF', '•	Li-Po 4360 mAh, non-removable<br>\r\n•	Fast charging 66W<br>\r\n•	Fast wireless charging 50W', '', '21'),
(22, '•	AMOLED, 1B colors, 120Hz, HDR10+, 800 nits (typ), 1000 nits (peak)<br>\r\n•	6.67 inches, 107.4 cm2 (~85.1% screen-to-body ratio)<br>\r\n•	1080 x 2400 pixels, 20:9 ratio (~395 ppi density)', 'MediaTek MT6893 Dimensity 1200 5G (6 nm)', '•	108 MP, f/1.8, 26mm (wide), 1/1.52\", 0.7µm, PDAF<br>\r\n•	8 MP, f/2.2, 120˚ (ultrawide), 1/4\", 1.12µm<br>\r\n•	5 MP, f/2.4, 50mm (telephoto macro), 1/5.0\", 1.12µm, AF', '16 MP, f/2.5, (wide), 1/3.06\", 1.0µm', '•	Li-Po 5000 mAh, non-removable<br>\r\n•	Fast charging 67W, 100% in 36 min (advertised)', '', '22'),
(23, '•	IPS LCD, 1B colors, 120Hz, HDR10, Dolby Vision<br>\r\n•	11.0 inches, 350.9 cm2 (~82.8% screen-to-body ratio)<br>\r\n•	1600 x 2560 pixels, 16:10 ratio (~274 ppi density)', 'Qualcomm Snapdragon 860 (7 nm)', '13 MP, f/2.0', '8 MP, f/2.0', '•	Li-Po 8720 mAh, non-removable<br>\r\n•	Fast charging 33W', '', '23'),
(24, '', '', '', '', 'Earphones<br>\r\n•	Up to 4 hours<br>\r\nCharging Case<br>\r\n•	3x Full Charge (total 12 hours)', '', '24'),
(25, '1.56\" AMOLED display', '', '', '', '14-day extra-long battery life with a magnetic charger', '', '25'),
(26, '•	AMOLED, 1B colors, Dolby Vision, HDR10+, 90Hz, 500 nits (typ), 800 nits (HBM)<br>\r\n•	6.55 inches, 103.6 cm2 (~85.3% screen-to-body ratio)<br>\r\n•	1080 x 2400 pixels, 20:9 ratio (~402 ppi density)', 'Qualcomm SM7325 Snapdragon 778G 5G (6 nm)', '•	64 MP, f/1.8, 26mm (wide), 1/1.97\", 0.7µm, PDAF<br>\r\n•	8 MP, f/2.2, 119˚ (ultrawide), 1/4.0\", 1.12µm<br>\r\n•	5 MP, f/2.4, 50mm (telephoto macro), 1/5.0\", 1.12µm, AF', '20 MP, f/2.2, 27mm (wide), 1/3.4\", 0.8µm', '•	Li-Po 4250 mAh, non-removable<br>\r\n•	Fast charging 33W', '', '26'),
(27, '•	LTPO AMOLED, 1B colors, 120Hz, HDR10+, BT.2020, 500 nits (typ), 1300 nits (peak)<br>\r\n•	6.7 inches, 108.4 cm2 (~89.6% screen-to-body ratio) <br>\r\n•	1440 x 3216 pixels, 20:9 ratio (~525 ppi density)', 'Qualcomm SM8350 Snapdragon 888 5G (5 nm)', '•	50 MP, f/1.8, 26mm (wide), 1/1.56\", 1.0µm, multi-directional PDAF, OIS<br>\r\n•	13 MP, f/2.4, 52mm (telephoto), 1/3.4\", 1.0µm, 2x optical zoom, PDAF<br>\r\n•	50 MP, f/2.2, 16mm, 110˚ (ultrawide), 1/1.56\", 1.0µm, multi-directional PDAF<br>\r\n•	3 MP, f/3.0, (microscope), AF, ring flash, 60x magnification', '32 MP, f/2.4, 26mm (wide), 1/2.8\", 0.8µm', '•	Li-Po 4500 mAh, non-removable<br>\r\n•	Fast charging 65W, 40% in 10 min (advertised)<br>\r\n•	Fast wireless charging 30W, 100% in 80 min (advertised)<br>\r\n•	Reverse wireless charging 10W', '', '27'),
(28, '•	Retina HD display<br>\r\n•	4.7-inch (diagonal) widescreen LCD Multi‑Touch display with IPS technology<br>\r\n•	1334x750-pixel resolution at 326 ppi<br>\r\n•	625 nits max brightness (typical) <br>\r\n•	Fingerprint-resistant oleophobic coating', '•	A15 Bionic chip<br>\r\n•	6-core CPU with 2 performance and 4 efficiency cores<br>\r\n•	4-core GPU<br>\r\n•	16-core Neural Engine', '12MP Wide camera: ƒ/1.8 aperture', '7MP camera: ƒ/2.2 aperture', 'Fast charging 18W, 50% in 30 min (advertised)', '', '28'),
(29, '', '', '', '', '', 'Only for IPhone 13 model.', '29'),
(30, '', '', '', '', '', 'Only for iPhone 12 and iPhone 13 series.', '30'),
(31, '', '', '', '', '', 'Only for iPhone 12 and iPhone 13 series.', '31'),
(32, '•	Super AMOLED Plus, 120Hz, 800 nits (HBM) <br>\r\n•	6.7 inches, 108.4 cm2 (~87.0% screen-to-body ratio) <br>\r\n•	1080 x 2400 pixels, 20:9 ratio (~393 ppi density)', 'Qualcomm SM7325 Snapdragon 778G 5G (6 nm)', '•	108 MP, f/1.8, (wide), PDAF, OIS<br>\r\n•	12 MP, f/2.2, (ultrawide) <br>\r\n•	5 MP, f/2.4, (macro) <br>\r\n•	5 MP, f/2.4, (depth)', '32 MP, f/2.2, 26mm (wide), 1/2.8\", 0.8µm', 'Li-Po 5000 mAh, non-removable, Fast charging 25W', '', '32'),
(33, '•	Super AMOLED, 120Hz, HDR10+<br>\r\n•	14.6 inches, 612.6 cm2 (~90.0% screen-to-body ratio) <br>\r\n•	1848 x 2960 pixels, 16:10 ratio (~240 ppi density)', 'Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm)', '•	13 MP, f/2.0, 26mm (wide), 1/3.4\", 1.0µm, AF<br>\r\n•	6 MP, f/2.2, (ultrawide)', '•	12 MP, f/2.2, 26mm (wide) <br>\r\n•	12 MP, f/2.4, 120˚ (ultrawide)', '•	Li-Po 11200 mAh, non-removable<br>\r\n•	Fast charging 45W, 100% in 82 min', '', '33'),
(34, '', 'BCM 43015', '', '', 'Play time<br>\r\n5h / TTL 18h (ANC ON) 8h / TTL 28h (ANC OFF) <br>\r\n*Bixby voice wake-up OFF', 'Auto Switch, Bixby voice wake-up, Voice Detect', '34'),
(35, '•	IPS LCD, 90Hz<br>\r\n•	6.78 inches, 111.4 cm2 (~89.5% screen-to-body ratio)<br>\r\n•	1080 x 2388 pixels (~387 ppi density)', 'Qualcomm SM6225 Snapdragon 680 4G (6 nm)', '•	108 MP, f/1.9, (wide), 1/1.52\", 0.7µm, PDAF<br>\r\n•	8 MP, f/2.2, 112˚ (ultrawide) <br>\r\n•	2 MP, f/2.4, (macro) <br>\r\n•	2 MP, f/2.4, (depth)', '16 MP, f/2.2, 22mm (wide)', '•	Li-Po 4000 mAh, non-removable<br>\r\n•	Fast charging 66W, 75% in 20 min (advertised)', '', '35'),
(36, '•	Foldable OLED, 1B colors, 120Hz<br>\r\n•	6.9 inches, 109.2 cm2 (~85.1% screen-to-body ratio) <br>\r\n•	1188 x 2790 pixels, 21:9 ratio (~442 ppi density) <br>\r\n•	OLED, 1.04 inch, 340 x 340 pixels, 328 ppi', 'Qualcomm SM8350 Snapdragon 888 4G (5 nm)', '•	40 MP, f/1.8, (wide), PDAF, Laser AF<br>\r\n•	13 MP, f/2.2, 120˚ (ultrawide), AF<br>\r\n•	32 MP, f/1.8, (wide), 1/3.14\", 0.7µm, AF', '10.7 MP, f/2.2, (ultrawide)', '•	Li-Po 4000 mAh, non-removable<br>\r\n•	Fast charging 40W<br>\r\n•	Reverse charging 5W', '', '36'),
(37, '•	IPS LCD, 120Hz<br>\r\n•	10.95 inches, 347.7 cm2 (~82.9% screen-to-body ratio)<br>\r\n•	2560 x 1600 pixels, 16:10 ratio (~276 ppi density)', 'Qualcomm SM8250 Snapdragon 865 (7 nm+)', '13 MP, f/1.8, PDAF', '8 MP, f/2.0', '•	Li-Po 7250 mAh, non-removable<br>\r\n•	Fast charging 22.5W<br>\r\n•	Reverse charging 5W', '', '37'),
(38, '•	1.43 inches<br>\r\n•	AMOLED color screen<br>\r\n•	Support full-screen touch operations, including swiping, tapping, and pressing and holding.', '', '', '', '•	Li-Ion, non-removable<br>\r\n•	Wireless charging 10W', '5 ATM water-resistant', '38'),
(39, '', '', '', '', 'Battery capacity<br>\r\n•	Per earbud: 30 mAh (min.)*<br>\r\n•	Charging case: 410 mAh (min.)*', '•	Open-fit active noise cancellation<br>\r\n•	Call noise cancellation', '39'),
(40, '•	AMOLED, 68B colors, 120Hz, Dolby Vision, HDR10+, 1100 nits (peak)<br>\r\n•	6.28 inches, 95.2 cm2 (~89.2% screen-to-body ratio)<br>\r\n•	1080 x 2400 pixels, 20:9 ratio (~419 ppi density)', 'Qualcomm SM8450 Snapdragon 8 Gen 1 (4 nm)', '•	50 MP, f/1.9, 26mm (wide), 1/1.56\", 1.0µm, PDAF, OIS<br>\r\n•	13 MP, f/2.4, 12mm, 123˚ (ultrawide), 1/3.06\", 1.12µm<br>\r\n•	5 MP, f/2.4, 50mm (telephoto macro), AF', '32 MP, f/2.5, 26mm (wide), 0.7µm', '•	Li-Po 4500 mAh, non-removable<br>\r\n•	Fast charging 67W, 100% in 39 min (advertised) <br>\r\n•	Fast wireless charging 50W, 100% in 53 min (advertised) <br>\r\n•	Reverse wireless charging 10W<br>\r\n•	Power Delivery 3.0', '', '40'),
(41, '1.43\" AMOLED display', '', '', '', '•	470mAh<br>\r\n•	Wireless Charging', '5 ATM Water Resistance', '41'),
(42, '1.43\" AMOLED display', '', '', '', '•	470mAh<br>\r\n•	Wireless Charging', '5 ATM Water Resistance', '42'),
(43, '•	Always-On Retina LTPO OLED display, 1,000 nits<br>\r\n•	Ion-X glass display on aluminum cases<br>\r\n•	Sapphire crystal display on stainless steel cases', '•	S7 SiP with 64-bit dual-core processor<br>\r\n•	W3 wireless chip<br>\r\n•	U1 chip (Ultra Wideband)', '', '', '•	Li-Ion 309 mAh (1.19 Wh), non-removable<br>\r\n•	Charging Wireless charging', '', '43'),
(44, '', '', '', '', '', 'USB-C, Charging cable sold separately.', '44'),
(45, '', '', '', '', '', 'Apple USB-C to Lightning Cable (1 m)', '45'),
(46, '•	Resolution: 2408*1080<br>\r\n•	Screen-to-body ratio: 90.7%<br>\r\n•	Touch sampling rate: 180Hz<br>\r\n•	Peak Brightness: 600nits<br>\r\n•	PPI: 401', 'Unisoc T616 Processor', '•	50MP AI Triple Camera, f/1.8 aperture<br>\r\n•	Macro Lens, f/2.4 aperture<br>\r\n•	B&W Lens, f/2.8 aperture', '8MP AI Selfie, f/2.0 aperture', '•	18W Quick Charge<br>\r\n•	5000mAh(Typ) Massive Battery', '', '46');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_code` int(11) NOT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `contact_phone` text NOT NULL,
  `special_notes` text DEFAULT NULL,
  `delivery_status` int(11) NOT NULL DEFAULT 0,
  `tracking_number` text DEFAULT NULL,
  `cus_email` varchar(50) NOT NULL,
  `adm_id` varchar(10) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_code` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_code`, `receiver_name`, `address`, `city`, `state`, `post_code`, `contact_phone`, `special_notes`, `delivery_status`, `tracking_number`, `cus_email`, `adm_id`, `payment_date`, `payment_code`) VALUES
(1, 'Muhammad Samat', '52 Block B Ixora Apartment Ayer Keroh Lama', 'Melaka Tengah', 'Melaka', '70000', '0134456233', '', 3, 'T41237059MY', 'tzhenglim02@gmail.com', 'ADM001', '2022-02-21 23:39:39', 'INV169045'),
(2, 'Muhammad Rafizi', '20 Jalan Malim Permai 2 Taman Malim Permai', 'Melaka Tengah', 'Melaka', '75250', '0167783112', '', 3, 'T36201875MY', 'tzhenglim02@gmail.com', 'ADM001', '2022-03-04 00:15:16', 'INV762453'),
(3, 'Lim Wee Xuan', '40 Jalan Puchong Lama 2 Taman Puchong Lama', 'Kuala Lumpur', 'Selangor', '54100', '0197543322', '', 3, 'T41387259MY', 'tzhenglim@gmail.com', 'ADM001', '2022-03-12 21:07:53', 'INV420173'),
(4, 'Lim Wee Zheng', '10 Jalan Malim Jaya 2 Taman Malim Jaya', 'Melaka Tengah', 'Melaka', '75000', '0166916223', 'Please call me before dispatch. Thank you.', 3, 'T59736041MY', 'tzhenglim@gmail.com', 'ADM002', '2022-03-12 21:21:42', 'INV021369'),
(5, 'Lim Wee Zheng', '10 Jalan Malim Jaya 2 Taman Malim Jaya', 'Melaka Tengah', 'Melaka', '71000', '0166916223', '', 3, 'T98360752MY', 'tzhenglim@gmail.com', 'ADM002', '2022-03-12 21:25:46', 'INV145376'),
(6, 'Devan Raj', '79 Jalan Pokok Mangga 10 Taman Pokok Mangga', 'Melaka Tengah', 'Melaka', '54217', '0197278917', '', 3, 'T46570138MY', 'devan@gmail.com', 'ADM001', '2022-03-13 21:19:21', 'INV403259'),
(7, 'Lim Wee Khang', '12 Jalan Malim ', 'Melaka', 'Melaka', '31231', '01234567899', '', 3, 'T60592473MY', 'tzhenglim@gmail.com', 'ADM002', '2022-03-25 15:54:30', 'INV801297'),
(8, 'Thomas Lim', 'No 8 Jalan Bertam Perdana 9', 'Melaka', 'Melaka', '75200', '01110612839', '', 3, 'T92710534MY', '1201200463@student.mmu.edu.my', 'ADM001', '2022-04-01 15:56:40', 'INV176482'),
(9, 'Lim Lee Hong', '13,jalan durian 1, taman masai', 'pasir gudang', 'Johor', '81700', '01389493333', '', 3, 'T53876109MY', 'leehong@hotmail.com', 'ADM001', '2022-04-01 18:41:33', 'INV258193'),
(10, 'Wee Chian Seong', '20 Jalan Kampung Hulu 2 Taman Kampung Hulu', 'Kelantan', 'Kelantan', '34122', '0128896512', '', 3, 'T16534709MY', 'chianseong020@gmail.com', 'ADM001', '2022-04-07 14:47:53', 'INV429508'),
(11, 'Low Lin Lin', '23,jalan delima 5,taman keembong 1', 'Pontian', 'Johor', '82000', '0145619912', '', 3, 'T42791530MY', 'linlin@gmail.com', 'ADM001', '2022-04-07 14:50:26', 'INV798540'),
(12, 'Devan', '97,jalan durian 3, taman cendana 2', 'bagan serai', 'Perak', '34300', '0146859369', '', 3, 'T18459062MY', 'devan@gmail.com', 'ADM004', '2022-04-08 17:44:09', 'INV691234'),
(13, 'Shawn Saw', '56,jalan tembikai 5, taman cendana 6', 'Labis', 'Johor', '85300', '01486839697', '', 3, 'T01869254MY', 'shawnsaw@gmail.com', 'ADM002', '2022-04-09 20:25:04', 'INV569718'),
(14, 'David', '13,jalan cerami 33, taman merdeka', 'Nilai', 'Selangor', '86799', '01586837575', '', 2, 'T54809273MY', 'David@gmail.com', 'ADM001', '2022-04-11 11:19:28', 'INV538064'),
(16, 'Thomas Lim', 'No 8 Jalan Bertam Perdana 9', 'Melaka', 'Melaka', '75200', '01110612839', '', 1, 'T23170485MY', '1201200463@student.mmu.edu.my', 'ADM002', '2022-04-15 21:36:58', 'INV176035'),
(17, 'Wee Kai Liang', 'No 10 Jalan Klebang Lama Taman Klebang Lama', 'Melaka Tengah', 'Melaka', '75000', '0182874552', '', 1, 'T87390542MY', 'weetom00@gmail.com', 'ADM001', '2022-04-20 19:07:56', 'INV298076'),
(18, 'Wee Kai Liang', 'No 10 Jalan Klebang Lama Taman Klebang Lama', 'Melaka Tengah', 'Melaka', '75000', '0182874552', '', 0, NULL, 'weetom00@gmail.com', NULL, '2022-04-20 19:14:30', 'INV487536');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_code` int(11) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_detail_code` int(11) DEFAULT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_price` decimal(7,2) NOT NULL,
  `cus_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wish_code`, `product_code`, `product_detail_code`, `product_color`, `product_price`, `cus_email`) VALUES
(2, '27', 43, 'Gloss Black', '4299.00', 'tzhenglim02@gmail.com'),
(3, '27', 43, 'Blue', '4299.00', 'tzhenglim02@gmail.com'),
(5, '28', 48, '(PRODUCT)RED', '2299.00', 'tzhenglim@gmail.com'),
(6, '4', 14, 'Alpine Green', '7599.00', '1201200463@student.mmu.edu.my'),
(9, '1', 3, '(PRODUCT) RED', '4799.00', 'weetom00@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_code`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_code`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_code`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`clearance_code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_code`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`product_detail_code`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_img_code`);

--
-- Indexes for table `product_specification`
--
ALTER TABLE `product_specification`
  ADD PRIMARY KEY (`product_spec_code`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_code`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `clearance_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `product_detail_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_img_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_specification`
--
ALTER TABLE `product_specification`
  MODIFY `product_spec_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

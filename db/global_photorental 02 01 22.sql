-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2022 at 02:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global_photorental`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`id`, `category_name`) VALUES
(1, 'Action Cam'),
(2, 'Audio'),
(3, 'Drone'),
(4, 'Gimbal'),
(5, 'Kamera'),
(6, 'Lensa'),
(7, 'Lighting'),
(8, 'Stabilizer'),
(9, 'Tripod'),
(10, 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `customer_id` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `mobile_2` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `job` varchar(225) DEFAULT NULL,
  `office_address` text DEFAULT NULL,
  `instagram_id` varchar(100) DEFAULT NULL,
  `emergency_contact_mobile` varchar(20) DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(50) DEFAULT NULL,
  `identity_id` varchar(50) DEFAULT NULL,
  `identity_type` varchar(100) DEFAULT NULL,
  `member_id` varchar(20) DEFAULT NULL,
  `registered_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_id`, `fullname`, `address`, `mobile`, `mobile_2`, `email`, `job`, `office_address`, `instagram_id`, `emergency_contact_mobile`, `emergency_contact_name`, `emergency_contact_relation`, `identity_id`, `identity_type`, `member_id`, `registered_date`) VALUES
('C0001', 'Yusliana Gadis Buata', 'Jalan Mangga No. 182', '081231581628', '', 'yuslianagadis@gmail.com', 'Pegawai Swasta', 'Jl. Menanggal Timur No.1', 'yuslianagadis', '08123460399', 'Rian Wahyu Sahadah', 'Spouse', '12345', 'KTP', 'M0001', '2021-12-13'),
('C0002', 'Adelya Nara Athilla Kumadji', 'Perum. Sekarsari Indah B. 16 Dau', '08563212366', '0341-365899', 'adelyanara@gmail.com', 'Kuliah', 'Polinema', 'adelya_nara', '089566693311', 'YulAmalya Gladys Buata', 'Mother', '16458', 'KTP', 'M0002', '2021-12-13'),
('C0003', 'Rian Wahyu Sahadah', 'Jalan Raya Belung No. 5', '08123460399', '', 'rianwahyu26@gmail.com', 'Pegawai Swasta', 'Jalan Muncul No. 1', 'rian_wahyusahadah', '081231581628', 'Gadis', 'Spouse', '3508889444563', 'KTP', 'M0003', '2021-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `item_tbl`
--

CREATE TABLE `item_tbl` (
  `item_id` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `merk` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `stock` int(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tgl_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_tbl`
--

INSERT INTO `item_tbl` (`item_id`, `item_name`, `merk`, `category`, `price`, `stock`, `status`, `tgl_pembelian`) VALUES
('A0001', 'Sony a6300123', 3, 5, '100000.00', 1, 'Booked', '0000-00-00'),
('A0002', 'Sony a6300', 3, 5, '100000.00', 1, 'Booked', '0000-00-00'),
('A0003', 'Sony a6300', 3, 5, '100000.00', 1, 'Booked', '0000-00-00'),
('A0004', 'Sony a6400', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0005', 'Sony a6400', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0006', 'Sony a6400', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0007', 'Sony a6500', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0008', 'Sony A7 Mark IIi', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0009', 'Sony A7 Mark III', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0010', 'Sony A7 Mark III', 3, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0011', 'Canon 60d Body', 1, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0012', 'Canon 70d Body', 1, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0013', 'Canon 80d Body', 1, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0014', 'Canon M6', 1, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0015', 'Canon M100', 1, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0016', 'Fujifilm xa5 Kit Lens', 2, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0017', 'Fujifilm xt100 Kit Lens', 2, 5, '100000.00', 1, 'Ready', '0000-00-00'),
('A0018', 'Lensa kit Sony 16-50mm F3.5-5.6 for APSC', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0019', 'Lensa kit Sony 16-50mm F3.5-5.6 for APSC', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0020', 'Lensa kit Sony 16-50mm F3.5-5.6 for APSC', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0021', 'Sony E PZ 18-105mm F4 G OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0022', 'Sony E 10-18mm F4 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0023', 'Sony E 20mm F2.8', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0024', 'Sony E 35mm F1.8 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0025', 'Sony E 50mm F1.8 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0026', 'Sony E 50mm F1.8 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0027', 'Sigma 16mm f1.4 DC DN', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0028', 'Sigma 16mm f1.4 DC DN', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0029', 'Sigma 30mm F1.4 DC DN AF for Sony E-Mount', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0030', 'Sigma 30mm F1.4 DC DN AF for Sony E-Mount', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0031', 'Sony FE 28-70mm f/3.5-5.6 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0032', 'Sony FE 28-70mm f/3.5-5.6 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0033', 'Sony FE 28-70mm f/3.5-5.6 OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0034', 'Sony FE 16-35mm f/4 ZA OSS Vario-Tessar T*', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0035', 'Sony FE 28mm F2', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0036', 'Sony FE 50mm F1.8', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0037', 'Sony FE 50mm F1.8', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0038', 'Sony FE 85mm F1.8', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0039', 'Sony FE 90mm F2.8 Macro G OSS', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0040', 'Sigma 35mm F1.4 DG DN ART for Sony', 3, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0041', 'Lensa Kit Canon DSLR', 1, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0042', 'Lensa Kit Canon DSLR', 1, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0043', 'Canon 18-135mm F/3.5-5.6 IS STM', 1, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0044', 'Canon EF 50mm f/1.8 STM', 1, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0045', 'Canon EF 50mm f/1.8 STM', 1, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0046', 'Canon EF 50mm f/1.4 STM', 1, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0047', 'Fujifilm Fujinon Lensa XC 15-45mm f/3.5-5.6 OIS', 2, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0048', 'Fujinon XF 35mm f/2 R WR', 2, 6, '100000.00', 1, 'Ready', '0000-00-00'),
('A0049', 'Takara Rover 66 -2-in-1', NULL, 9, '100000.00', 1, 'Ready', '0000-00-00'),
('A0050', 'Tripod Beike q999H', NULL, 9, '100000.00', 1, 'Ready', '0000-00-00'),
('A0051', 'Godox TT600 Universal Flash Speedlite', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0052', 'Godox TT600 Universal Flash Speedlite', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0053', 'Godox TT600 Universal Flash Speedlite', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0054', 'Trigger Godox X1T-S X1T For Sony Wireless Trigger ', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0055', 'Godox SL60W', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0056', 'Godox SL60W', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0057', 'Paket Godox SL60W', NULL, 7, '100000.00', 1, 'Ready', '0000-00-00'),
('A0058', 'RODE VideoMic Pro Rycote', NULL, 2, '100000.00', 1, 'Ready', '0000-00-00'),
('A0059', 'BOYA BY-MM1 Universal Cardioid Microphone', NULL, 2, '100000.00', 1, 'Ready', '0000-00-00'),
('A0060', 'Saramonic BLINK 500 B2 UltraCompact 2-PERSON Wirel', NULL, 2, '100000.00', 1, 'Ready', '0000-00-00'),
('A0061', 'Zoom h1n Handy Recorder', NULL, 2, '100000.00', 1, 'Ready', '0000-00-00'),
('A0062', 'Zhiyun Tech Weebill S', NULL, 4, '100000.00', 1, 'Ready', '0000-00-00'),
('A0063', 'DJI Ronin S', NULL, 4, '100000.00', 1, 'Ready', '0000-00-00'),
('A0064', 'Zhiyun Crane M2', 0, 4, '100000.00', 1, 'Ready', '0000-00-00'),
('A0065', 'Canon A9000', 1, 1, '150000.00', 0, 'Ready', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `merk_tbl`
--

CREATE TABLE `merk_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk_tbl`
--

INSERT INTO `merk_tbl` (`id`, `name`) VALUES
(1, 'Canon'),
(2, 'Fujifilm'),
(3, 'Sony');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `pick_up_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `item_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `denda` decimal(15,2) DEFAULT NULL,
  `diskon` decimal(15,2) DEFAULT NULL,
  `dp` decimal(15,2) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `order_date`, `customer_id`, `pick_up_date`, `return_date`, `item_id`, `quantity`, `total_price`, `denda`, `diskon`, `dp`, `status`) VALUES
('ORD0000001', '2022-01-02 20:05:00', 'C0003', '2022-01-02 20:05:00', '2022-01-05 20:05:00', 'A0002', 0, '100000.00', '0.00', '0.00', '45000.00', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fullname`, `username`, `password`) VALUES
(1, 'Global Photorental', 'admin', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `item_tbl`
--
ALTER TABLE `item_tbl`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `merk_tbl`
--
ALTER TABLE `merk_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `merk_tbl`
--
ALTER TABLE `merk_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD CONSTRAINT `order_tbl_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

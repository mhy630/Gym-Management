-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 01:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment1`
--

CREATE TABLE `equipment1` (
  `equipment_id` varchar(10) NOT NULL,
  `equipment_weight` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment1`
--

INSERT INTO `equipment1` (`equipment_id`, `equipment_weight`, `quantity`, `purchase_date`, `purchase_cost`) VALUES
('EQUIP0LKHV', 25, 5, '2023-06-06', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `equipment2`
--

CREATE TABLE `equipment2` (
  `equipment_id` varchar(10) NOT NULL,
  `maximum_speed` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment2`
--

INSERT INTO `equipment2` (`equipment_id`, `maximum_speed`, `quantity`, `purchase_date`, `purchase_cost`) VALUES
('EQUIPERV9P', '35', 10, '2023-06-13', 20000),
('EQUIPF88OY', '25', 5, '2023-06-07', 2100);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` varchar(10) NOT NULL,
  `member_name` varchar(20) NOT NULL,
  `member_phone` varchar(20) NOT NULL,
  `member_email` varchar(30) NOT NULL,
  `member_birthdate` date NOT NULL,
  `member_startdate` date NOT NULL,
  `member_membershiptype` varchar(10) NOT NULL,
  `member_weight` int(10) NOT NULL,
  `member_height` int(10) NOT NULL,
  `member_trainer` varchar(20) NOT NULL,
  `member_course` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_phone`, `member_email`, `member_birthdate`, `member_startdate`, `member_membershiptype`, `member_weight`, `member_height`, `member_trainer`, `member_course`) VALUES
('MEM4TZ4Y4', 'Ayesha', '+923363452500', 'asamra010@gmail.com', '2005-09-04', '2023-06-15', 'Basic', 60, 5, 'Trainer2', 'yoga'),
('MEMUBS9O8', 'Humza Fazal Abbasi', '03365419188', 'abbasisaud99@gmail.com', '2023-06-12', '2023-06-12', 'Basic', 63, 5, 'Trainer2', 'yoga');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(10) NOT NULL,
  `member_id` varchar(10) NOT NULL,
  `member_name` varchar(20) NOT NULL,
  `member_amount` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `member_id`, `member_name`, `member_amount`, `status`, `payment_date`) VALUES
('PAY9VR6YS', 'MEMUBS9O8', 'Humza Fazal Abbasi', 11, 'Paid', '2023-06-12'),
('PAYE1OU1P', 'MEM4TZ4Y4', 'Ayesha', 1500, 'Unpaid', '2023-06-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment1`
--
ALTER TABLE `equipment1`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `equipment2`
--
ALTER TABLE `equipment2`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `Test` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

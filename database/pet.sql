-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 09:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `prize` float DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `pet_type` varchar(20) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `qty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `vendor_id`, `name`, `prize`, `description`, `type`, `pet_type`, `image`, `qty`) VALUES
(13, 1, 'Playing keys 2', 20, 'lorem ipsum', 'toy', 'dog, cat, bird', 'admin.png', 84),
(14, 1, 'Playing keys 3', 100, 'lorem ipsum', 'toy', 'dog, cat, bird', 'admin.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `adopts`
--

CREATE TABLE `adopts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phn_num` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `proffession` varchar(70) NOT NULL,
  `have_prev_pets` varchar(3) NOT NULL,
  `budget` int(11) NOT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=Pending, 1=confirmed, 2=completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adopts`
--

INSERT INTO `adopts` (`id`, `username`, `pet_id`, `name`, `email`, `phn_num`, `address`, `age`, `proffession`, `have_prev_pets`, `budget`, `status`) VALUES
(4, 'galib', 4, 'jbj', 'jbkjb@jbv.jbfkj', '12132254465', 'jjbkfdjb', 12, 'jbkjb', 'no', 1200, 0),
(5, 'galib', 1, 'hgvj', 'jfj@htdhg.vjv', '5367586', 'hfjmvhn', 22, 'tdhv', 'no', 1232, 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phn_num` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_breed` varchar(50) NOT NULL,
  `pet_species` varchar(30) NOT NULL,
  `pet_age` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(20) NOT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0=Pending, 1=confirmed, 2=rejected_admin,\r\n3=rejected_user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `username`, `vet_id`, `name`, `email`, `phn_num`, `address`, `pet_name`, `pet_breed`, `pet_species`, `pet_age`, `appointment_date`, `appointment_time`, `status`) VALUES
(18, 'galib', 2, 'jhbkrjbt', 'jbr@jkbkj.jbh', '98269736298', 'jhbksjbrJjkbkjb', 'jkjh', 'gjgj,mg', 'g', 12, '2024-08-20', '83200', 0),
(20, 'galib', 2, 'mnjbtrj', 'jhbjh@jhb.jehb', '132435657', 'jvyjtbmyn', 'jhbkjbt', 'jbkvjty rj', 'jbckjrbt', 12, '2024-08-20', '95500', 0),
(21, 'galib', 2, 'fvybrkj', 'jhbvj@jkbv.bkjce', '892365', 'hckjt', 'jbkrthn', 'jgckth', 'jhbvrtj', 231, '2024-08-20', '112400', 0),
(22, 'galib', 2, 'sytdu', 'hvjm@jf.scerhvj', '12143957498', 'bjsebkcdrtb', 'jvcejktrbk', 'jecktjrbrj', 'jsvfkejvrb', 12, '2024-08-20', '2400', 0),
(25, 'galib', 3, 'ectry', 'hvjh@kbjdr.ejv', '9824904389', 'jhsvxekjrb', 'jvxwkjrb', 'jvckejtrbkj', 'jkxw,b', 12, '2024-09-18', '08:01 AM ~ 08:30 AM', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` float NOT NULL,
  `pic` varchar(100) NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '0 = adopted, 1 = available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `name`, `age`, `pic`, `status`) VALUES
(1, 'Nala', 2.5, 'dog.jpg', 0),
(2, 'Michel', 5.3, 'cat.jpg', 1),
(3, 'Jimmy', 2, 'bird.jpg', 1),
(4, 'Dull-head', 9, 'fish.jfif', 0),
(6, 'avc', 4.3, 'b.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `trans_id` varchar(70) NOT NULL,
  `trans_amount` int(11) NOT NULL,
  `card_no` varchar(70) NOT NULL,
  `val_id` varchar(70) NOT NULL,
  `card_type` varchar(30) NOT NULL,
  `trans_date` datetime DEFAULT current_timestamp(),
  `pay_type` int(11) NOT NULL COMMENT '1 = COD, 2 = Online pay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `username`, `prod_id`, `qty`, `address`, `trans_id`, `trans_amount`, `card_no`, `val_id`, `card_type`, `trans_date`, `pay_type`) VALUES
(3, 'galib', 13, 5, '', 'SSLCZ_TEST_66aa172ce8b65', 500, '', '24073116513407VCQ1SH6TqZpk0', 'IBBL-Islami Bank', '2024-07-31 16:53:29', 0),
(4, 'galib', 14, 2, '', 'SSLCZ_TEST_66aa1828465e6', 200, '', '240731165714KNEHiU5ZvvJ4Qg2', 'ABBANKIB-AB Bank', '2024-07-31 16:57:22', 0),
(11, 'galib', 13, 2, 'jhsja', '', 40, '', '', '', '2024-08-15 20:40:28', 1),
(12, 'galib', 14, 5, 'jhsja', '', 500, '', '', '', '2024-08-15 20:40:28', 1),
(13, 'galib', 13, 5, 'chgfc', 'SSLCZ_TEST_66be1a0042a89', 100, '', '2408152108550l2lDNndoMAKlUG', 'BKASH-BKash', '2024-08-15 21:09:17', 0),
(14, 'galib', 14, 1, 'chgfc', 'SSLCZ_TEST_66be1a0042a89', 100, '', '2408152108550l2lDNndoMAKlUG', 'BKASH-BKash', '2024-08-15 21:09:17', 0),
(15, 'galib', 13, 3, 'chgjn', '', 60, '', '', '', '2024-08-15 21:10:15', 1),
(16, 'galib', 13, 1, 'cgfgugy', '', 20, '', '', '', '2024-08-15 21:12:55', 1),
(17, 'galib', 13, 2, 'gchbggh', 'SSLCZ_TEST_66be1b0d32af4', 40, '', '24081521132004wwq1dlIIdLYoF', 'DBBLMOBILEB-Dbbl Mobile Bankin', '2024-08-15 21:13:23', 0),
(18, 'galib', 13, 1, 'dfgtu', '', 20, '', '', '', '2024-08-20 09:32:38', 1),
(19, 'galib', 14, 3, 'dfgfh', '', 300, '', '', '', '2024-08-26 00:20:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `profile_pic` varchar(50) NOT NULL DEFAULT 'ad.jfif',
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact`, `email`, `username`, `password`, `profile_pic`, `is_admin`) VALUES
(1, 'Tanjina Islam Proma', '01859385952', 'islamtanjina645@gmail.com', 'admin', '1112', 'house.png', 1),
(2, 'Tanjina Islam Proma', '01859385952', 'islamtanjina645@gmail.com', 'proma', '1112', 'house.png', 0),
(3, 'Galib', '12345678654', 'galib@gmail.com', 'galib', '1112', 'ad.jfif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `contact`, `email`) VALUES
(1, 'cbvhg', 'setcreytv', '32425454456', 'vtht@ghb.fty'),
(2, 'XYZ', 'Xyz, Xyz', '12345678900', 'xyz@xyz.xyz');

-- --------------------------------------------------------

--
-- Table structure for table `vets`
--

CREATE TABLE `vets` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `service_start` time NOT NULL,
  `service_end` time NOT NULL,
  `fee` int(11) NOT NULL,
  `profile_pic` varchar(100) DEFAULT 'house.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vets`
--

INSERT INTO `vets` (`id`, `name`, `email`, `address`, `service_start`, `service_end`, `fee`, `profile_pic`) VALUES
(1, 'jhgejh', 'jhfbrj@jhgf.vjhev', 'Dhaka', '14:00:00', '17:00:00', 100, 'house.png'),
(2, 'Galib', 'galib@gmail.com', '', '08:00:00', '12:00:00', 500, 'house.png'),
(3, 'ABC', 'abc@gmail.com', '', '08:00:00', '22:00:00', 1200, 'lost file name (274).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adopts`
--
ALTER TABLE `adopts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vets`
--
ALTER TABLE `vets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `adopts`
--
ALTER TABLE `adopts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vets`
--
ALTER TABLE `vets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

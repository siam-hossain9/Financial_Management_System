-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2026 at 08:02 AM
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
-- Database: `financialmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `personal_user`
--

CREATE TABLE `personal_user` (
  `P_id` int(11) NOT NULL,
  `P_fname` varchar(100) NOT NULL,
  `P_lname` varchar(100) NOT NULL,
  `P_mail` varchar(150) NOT NULL,
  `P_Username` varchar(100) NOT NULL,
  `P_password` varchar(200) NOT NULL,
  `P_gender` varchar(10) NOT NULL,
  `P_montlyIncome` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_user`
--

INSERT INTO `personal_user` (`P_id`, `P_fname`, `P_lname`, `P_mail`, `P_Username`, `P_password`, `P_gender`, `P_montlyIncome`) VALUES
(2, 'Ashiqur ', 'Rahman', 'abir@gmail.com', 'abir', '$2y$10$d4FRk5tOH8K7yZKupIlekOhwG5827At25rN9nxZxdq.e65B1q8bLC', 'Male', 99999999.99),
(3, 'Ashiqur ', 'hossain', 'ashiq@gmail.com', 'Ashiq', '$2y$10$m/JvtjkE1.nMnxGbqOCVLOWBM.a3eSh8XRqjlhp0IVWXaHVo2nJpK', 'Male', 99999999.99);

-- --------------------------------------------------------

--
-- Table structure for table `personal_user_expense`
--

CREATE TABLE `personal_user_expense` (
  `ex_id` int(11) NOT NULL,
  `ex_name` varchar(150) NOT NULL,
  `ex_amount` decimal(10,2) NOT NULL,
  `ex_type` varchar(100) NOT NULL,
  `ex_date` date NOT NULL,
  `P_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_user_expense`
--

INSERT INTO `personal_user_expense` (`ex_id`, `ex_name`, `ex_amount`, `ex_type`, `ex_date`, `P_id`) VALUES
(3, 'meow', 1000.00, 'others', '2026-01-21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `personal_user_savings`
--

CREATE TABLE `personal_user_savings` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(150) NOT NULL,
  `s_amount` decimal(10,2) NOT NULL,
  `s_type` varchar(100) NOT NULL,
  `s_date` date NOT NULL,
  `P_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_user_savings`
--

INSERT INTO `personal_user_savings` (`s_id`, `s_name`, `s_amount`, `s_type`, `s_date`, `P_id`) VALUES
(5, 'alu', 20.00, 'others', '2026-01-21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `small_business`
--

CREATE TABLE `small_business` (
  `B_id` int(11) NOT NULL,
  `Bussiness_type` varchar(150) NOT NULL,
  `Bussiness_name` varchar(150) NOT NULL,
  `BIN_number` varchar(50) NOT NULL,
  `B_montlyincome` decimal(10,2) NOT NULL,
  `B_mail` varchar(150) NOT NULL,
  `B_password` varchar(250) NOT NULL,
  `B_tax` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `small_business`
--

INSERT INTO `small_business` (`B_id`, `Bussiness_type`, `Bussiness_name`, `BIN_number`, `B_montlyincome`, `B_mail`, `B_password`, `B_tax`) VALUES
(1, 'food', 'ALU Porota', '12345678', 10000.00, 'alu@gmail.com', '$2y$10$0xF.3CvksnYJzS3Udzhxbe9QhTcq9bSiikGx.go9VBvC9luzF6A8C', 0.00),
(5, 'food', 'ALu', '12345687', 10000.00, 'alu12@gmail.com', '$2y$10$9Cdom5p2qfLaXvFuXV3XK.dF1PTHnabEmJfUMgAZiwJJ/tcETdR1K', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `small_business_expense`
--

CREATE TABLE `small_business_expense` (
  `ex_id` int(11) NOT NULL,
  `ex_name` varchar(150) NOT NULL,
  `ex_amount` decimal(10,2) NOT NULL,
  `ex_type` varchar(100) NOT NULL,
  `ex_date` date NOT NULL,
  `B_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `small_business_expense`
--

INSERT INTO `small_business_expense` (`ex_id`, `ex_name`, `ex_amount`, `ex_type`, `ex_date`, `B_id`) VALUES
(1, 'alu', 20.00, 'others', '2026-01-21', 5);

-- --------------------------------------------------------

--
-- Table structure for table `small_business_savings`
--

CREATE TABLE `small_business_savings` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(150) NOT NULL,
  `s_amount` decimal(10,2) NOT NULL,
  `s_type` varchar(100) NOT NULL,
  `s_date` date NOT NULL,
  `B_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `small_business_savings`
--

INSERT INTO `small_business_savings` (`s_id`, `s_name`, `s_amount`, `s_type`, `s_date`, `B_id`) VALUES
(2, 'alu', 10.00, 'others', '2026-01-21', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `money` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `user_name`, `email`, `password`, `user_type`, `money`) VALUES
(1, 'PersonalUser', 'personal@test.com', 'pass123', 'Personal User', 0.00),
(2, 'BusinessOwner', 'business@test.com', 'pass123', 'Small Business Owner', 0.00),
(3, 'siam', 'syam@gmail.com', 'Siam123456', 'Personal User', 0.00),
(4, 'abir', 'abir@gmail.com', '$2y$10$d4FRk5tOH8K7yZKupIlekOhwG5827At25rN9nxZxdq.e65B1q8bLC', 'personal', 0.00),
(5, 'Ashiq', 'ashiq@gmail.com', '$2y$10$m/JvtjkE1.nMnxGbqOCVLOWBM.a3eSh8XRqjlhp0IVWXaHVo2nJpK', 'personal', 0.00),
(6, 'Siam', 'alu@gmail.com', '$2y$10$qWhL1p4nhPmz3EsbcuQXYOgpAMKvYXuZ2LHnLL1Q8MO3VOfmIrHcK', 'business', 0.00),
(16, 'Abir', 'alu12@gmail.com', '$2y$10$9Cdom5p2qfLaXvFuXV3XK.dF1PTHnabEmJfUMgAZiwJJ/tcETdR1K', 'business', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_user`
--
ALTER TABLE `personal_user`
  ADD PRIMARY KEY (`P_id`),
  ADD UNIQUE KEY `P_mail` (`P_mail`),
  ADD UNIQUE KEY `P_Username` (`P_Username`);

--
-- Indexes for table `personal_user_expense`
--
ALTER TABLE `personal_user_expense`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `P_id` (`P_id`);

--
-- Indexes for table `personal_user_savings`
--
ALTER TABLE `personal_user_savings`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `P_id` (`P_id`);

--
-- Indexes for table `small_business`
--
ALTER TABLE `small_business`
  ADD PRIMARY KEY (`B_id`),
  ADD UNIQUE KEY `BIN_number` (`BIN_number`),
  ADD UNIQUE KEY `B_mail` (`B_mail`);

--
-- Indexes for table `small_business_expense`
--
ALTER TABLE `small_business_expense`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `B_id` (`B_id`);

--
-- Indexes for table `small_business_savings`
--
ALTER TABLE `small_business_savings`
  ADD KEY `s_id` (`s_id`),
  ADD KEY `B_id` (`B_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal_user`
--
ALTER TABLE `personal_user`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_user_expense`
--
ALTER TABLE `personal_user_expense`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_user_savings`
--
ALTER TABLE `personal_user_savings`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `small_business`
--
ALTER TABLE `small_business`
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `small_business_expense`
--
ALTER TABLE `small_business_expense`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `small_business_savings`
--
ALTER TABLE `small_business_savings`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personal_user_expense`
--
ALTER TABLE `personal_user_expense`
  ADD CONSTRAINT `personal_user_expense_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `personal_user` (`P_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personal_user_savings`
--
ALTER TABLE `personal_user_savings`
  ADD CONSTRAINT `personal_user_savings_ibfk_1` FOREIGN KEY (`P_id`) REFERENCES `personal_user` (`P_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `small_business_expense`
--
ALTER TABLE `small_business_expense`
  ADD CONSTRAINT `small_business_expense_ibfk_1` FOREIGN KEY (`B_id`) REFERENCES `small_business` (`B_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `small_business_savings`
--
ALTER TABLE `small_business_savings`
  ADD CONSTRAINT `small_business_savings_ibfk_1` FOREIGN KEY (`B_id`) REFERENCES `small_business` (`B_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

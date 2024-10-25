-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 06:13 AM
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
-- Database: `417db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `AcceptDate` varchar(45) DEFAULT NULL,
  `ScheduledDate` varchar(45) DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `Technician_id` int(11) NOT NULL,
  `RepairRequest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `QuantityAvailable` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipmentrequest`
--

CREATE TABLE `equipmentrequest` (
  `id` int(11) NOT NULL,
  `NameEquipmentRequest` varchar(45) DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Assignment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issuerequisition`
--

CREATE TABLE `issuerequisition` (
  `id` int(11) NOT NULL,
  `EquipmentRequest_id` int(11) NOT NULL,
  `Equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repairrequest`
--

CREATE TABLE `repairrequest` (
  `id` int(11) NOT NULL,
  `topic` varchar(45) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `RequestedDate` datetime DEFAULT NULL,
  `ScheduleDate` datetime DEFAULT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repairrequest`
--

INSERT INTO `repairrequest` (`id`, `topic`, `Description`, `Status`, `RequestedDate`, `ScheduleDate`, `User_id`) VALUES
(7, 'PHP', 'PHP , JS', 'แจ้งซ่อม', '2024-10-25 06:27:21', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `id` int(11) NOT NULL,
  `Specialization` varchar(45) DEFAULT NULL,
  `Availbaility` varchar(45) DEFAULT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`id`, `Specialization`, `Availbaility`, `User_id`) VALUES
(1, 'Specialization', 'Availbaility', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'test', 'test', 'test@test.com', '2024-10-24 23:15:10'),
(2, 'admin', 'admin', 'admin@admin.com', '2024-10-24 23:15:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Assignment_Technician1_idx` (`Technician_id`),
  ADD KEY `fk_Assignment_RepairRequest1_idx` (`RepairRequest_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmentrequest`
--
ALTER TABLE `equipmentrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_EquipmentRequest_Assignment1_idx` (`Assignment_id`);

--
-- Indexes for table `issuerequisition`
--
ALTER TABLE `issuerequisition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_IssueRequisition_EquipmentRequest1_idx` (`EquipmentRequest_id`),
  ADD KEY `fk_IssueRequisition_Equipment1_idx` (`Equipment_id`);

--
-- Indexes for table `repairrequest`
--
ALTER TABLE `repairrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_RepairRequest_User_idx` (`User_id`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Technician_User1_idx` (`User_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipmentrequest`
--
ALTER TABLE `equipmentrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issuerequisition`
--
ALTER TABLE `issuerequisition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repairrequest`
--
ALTER TABLE `repairrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `fk_Assignment_RepairRequest1` FOREIGN KEY (`RepairRequest_id`) REFERENCES `repairrequest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assignment_Technician1` FOREIGN KEY (`Technician_id`) REFERENCES `technician` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `equipmentrequest`
--
ALTER TABLE `equipmentrequest`
  ADD CONSTRAINT `fk_EquipmentRequest_Assignment1` FOREIGN KEY (`Assignment_id`) REFERENCES `assignment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `issuerequisition`
--
ALTER TABLE `issuerequisition`
  ADD CONSTRAINT `fk_IssueRequisition_Equipment1` FOREIGN KEY (`Equipment_id`) REFERENCES `equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IssueRequisition_EquipmentRequest1` FOREIGN KEY (`EquipmentRequest_id`) REFERENCES `equipmentrequest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `repairrequest`
--
ALTER TABLE `repairrequest`
  ADD CONSTRAINT `fk_RepairRequest_User` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `technician`
--
ALTER TABLE `technician`
  ADD CONSTRAINT `fk_Technician_User1` FOREIGN KEY (`User_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

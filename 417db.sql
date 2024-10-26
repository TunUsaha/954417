-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 11:04 PM
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

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `AcceptDate`, `ScheduledDate`, `Status`, `Technician_id`, `RepairRequest_id`) VALUES
(8, '2024-10-26 21:09:53', NULL, 'เสร็จสิ้น', 1, 10),
(9, '2024-10-26 21:21:00', '2024-10-26', 'เสร็จสิ้น', 1, 11),
(10, '2024-10-26 21:26:36', '2024-10-26 21:26:53', 'เสร็จสิ้น', 1, 12),
(11, '2024-10-26 21:57:06', '2024-10-26 21:57:33', 'เสร็จสิ้น', 1, 13),
(12, '2024-10-26 22:00:50', '2024-10-26 22:01:08', 'เสร็จสิ้น', 1, 14),
(13, '2024-10-26 22:30:49', '2024-10-27 03:31:58', 'เสร็จสิ้น', 1, 15),
(14, '2024-10-26 22:51:35', '2024-10-27 03:55:53', 'เสร็จสิ้น', 1, 16),
(15, '2024-10-26 22:57:30', NULL, 'กำลังดำเนินการ', 1, 17),
(16, '2024-10-27 04:02:10', '2024-10-27 04:02:30', 'เสร็จสิ้น', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `QuantityAvailable` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `Name`, `QuantityAvailable`) VALUES
(1, 'สายไฟ', '170'),
(2, 'สายแลน', '194');

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

--
-- Dumping data for table `equipmentrequest`
--

INSERT INTO `equipmentrequest` (`id`, `NameEquipmentRequest`, `Description`, `Assignment_id`) VALUES
(18, 'ซ่อมPOS', 'เปลี่ยนสายแลน สายขาด', 8),
(19, 'เปลี่ยนสายแลน', 'โดดนหนูกัด', 9),
(20, 'เปลี่ยนสายแลนกกกกก', 'ฟหกฟหกฟหกฟหกฟหกฟหกฟหฟหกฟหกฟหก', 10),
(21, 'เปลี่ยนสายแลยกับสายไฟ', 'เปลี่ยนสายแลยกับสายไฟเปลี่ยนสายแลยกับสายไฟเปล', 11),
(22, 'aaaaaaaaaa', 'vbbbbbbbbbb', 12),
(23, 'ฟกหกฟหฟกห', 'ฟหกฟหกฟหกหฟก', 13),
(24, 'ฟหกฟหกฟหก', 'ฟหกฟหกฟหก', 14),
(25, 'adsasdsad', 'adsasdasd', 16);

-- --------------------------------------------------------

--
-- Table structure for table `issuerequisition`
--

CREATE TABLE `issuerequisition` (
  `id` int(11) NOT NULL,
  `EquipmentRequest_id` int(11) NOT NULL,
  `Equipment_id` int(11) NOT NULL,
  `QuantityUsed` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuerequisition`
--

INSERT INTO `issuerequisition` (`id`, `EquipmentRequest_id`, `Equipment_id`, `QuantityUsed`) VALUES
(18, 18, 2, '1'),
(19, 19, 2, '1'),
(20, 20, 2, '1'),
(21, 21, 1, '1'),
(22, 21, 2, '2'),
(23, 22, 1, '10'),
(24, 22, 2, '10'),
(25, 23, 1, '5'),
(26, 24, 1, '10'),
(27, 25, 1, '10');

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
(10, 'เน็ตเน่า POS', 'เน็ตเน่าขึ้น POS ', 'เสร็จสิ้น', '2024-10-27 02:09:30', NULL, 2),
(11, 'เน็ตสายขาด', 'สายขาดจากไหนไม่ทราบบบบ', 'เสร็จสิ้น', '2024-10-27 02:20:18', NULL, 2),
(12, 'เน็ตสายขาดรุ่งรั่ง', 'เน็ตสายขาดรุ่งรั่งเน็ตสายขาดรุ่งรั่งเน็ตสายขา', 'เสร็จสิ้น', '2024-10-27 02:26:29', NULL, 2),
(13, 'เน็ตสายขาดรุ่งรั่งมากกกกกกก', 'เน็ตสายขาดรุ่งรั่งมากกกกกกกเน็ตสายขาดรุ่งรั่ง', 'เสร็จสิ้น', '2024-10-27 02:33:04', NULL, 2),
(14, 'เน็ตสายขาดรุ่งรั่งมากกกกกกก', 'เน็ตสายขาดรุ่งรั่งมากกกกกกกเน็ตสายขาดรุ่งรั่ง', 'เสร็จสิ้น', '2024-10-27 03:00:45', NULL, 2),
(15, 'ฟฟฟฟฟฟ', 'ฟฟฟฟ', 'เสร็จสิ้น', '2024-10-27 03:29:47', NULL, 2),
(16, 'เน็ตสายขาดรุ่งรั่งมากกกกกกก', 'เน็ตสายขาดรุ่งรั่งมากกกกกกกเน็ตสายขาดรุ่งรั่ง', 'เสร็จสิ้น', '2024-10-27 03:44:37', NULL, 1),
(17, 'ฟหกฟหกฟหกฟห', 'กฟหกฟหก', 'กำลังดำเนินการ', '2024-10-27 03:56:36', NULL, 1),
(18, 'asddasasd', 'adsadsasd', 'เสร็จสิ้น', '2024-10-27 04:02:05', NULL, 1);

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
  `address` varchar(90) NOT NULL,
  `post` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `address`, `post`, `created_at`) VALUES
(1, 'test', 'test', 'test@test.com', '', '', '2024-10-24 23:15:10'),
(2, 'admin', 'admin', 'admin@admin.com', '', '', '2024-10-24 23:15:16'),
(6, 'admins', '$2y$10$qDW7wFh8uIWJGlbvCjJfH.SndqvzrRbXFXGJeq', 'admins@admins.com', 'admins Studio ADmin 654123\r\n', '', '2024-10-25 14:50:36');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipmentrequest`
--
ALTER TABLE `equipmentrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `issuerequisition`
--
ALTER TABLE `issuerequisition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `repairrequest`
--
ALTER TABLE `repairrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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

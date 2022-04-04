-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 12:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bowser_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `Area_ID` int(11) NOT NULL,
  `Area_Name` varchar(100) NOT NULL,
  `Area_Mains_Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`Area_ID`, `Area_Name`, `Area_Mains_Status`) VALUES
(1, 'Cheltenham', 'Operational'),
(2, 'Oxford', 'Operational'),
(3, 'Gloucester', 'Operational');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowsers`
--

CREATE TABLE `tbl_bowsers` (
  `BowserID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Bowser_Cost` int(11) NOT NULL,
  `Bowser_Description` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Longitude` float(10,6) NOT NULL,
  `Latitude` float(10,6) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowsers`
--

INSERT INTO `tbl_bowsers` (`BowserID`, `Bowser_Capacity`, `Bowser_Cost`, `Bowser_Description`, `Status`, `Longitude`, `Latitude`, `Location`) VALUES
(1, 500, 500, '15kg new shape model', 'Lent', 0.000000, 0.000000, ''),
(2, 500, 500, '', 'Lent', 0.000000, 0.000000, ''),
(3, 500, 500, '', 'Stock', 0.000000, 0.000000, ''),
(4, 1000, 1000, '', 'Lent', 0.000000, 0.000000, ''),
(5, 1000, 1000, '', 'Lent', 0.000000, 0.000000, ''),
(6, 5000, 5000, '', 'Deployed', 0.000000, 0.000000, ''),
(7, 5000, 5000, '', 'Lent', 0.000000, 0.000000, ''),
(8, 10000, 10000, '', 'Stock', 0.000000, 0.000000, ''),
(9, 15000, 15000, '', 'Lent', 0.000000, 0.000000, ''),
(10, 1000, 1000, '', 'Lent', 0.000000, 0.000000, ''),
(11, 1000, 1000, '', 'Lent', 0.000000, 0.000000, ''),
(12, 1000, 1000, '', 'Lent', 0.000000, 0.000000, ''),
(13, 1000, 1000, '', 'Lent', 0.000000, 0.000000, ''),
(14, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(15, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(16, 10000, 10000, '', 'Stock', 0.000000, 0.000000, ''),
(17, 10000, 10000, '', 'Stock', 0.000000, 0.000000, ''),
(18, 10000, 10000, '', 'Stock', 0.000000, 0.000000, ''),
(19, 10000, 10000, '', 'Stock', 0.000000, 0.000000, ''),
(20, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(21, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(22, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(23, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(24, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(25, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(26, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(27, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(28, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(29, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(30, 500, 500, '', 'Stock', 0.000000, 0.000000, ''),
(31, 500, 500, '', 'Stock', 0.000000, 0.000000, ''),
(32, 500, 500, '', 'Stock', 0.000000, 0.000000, ''),
(33, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(34, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(35, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(36, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(37, 5000, 5000, '', 'Lent', 0.000000, 0.000000, ''),
(38, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(39, 500, 500, '', 'Stock', 0.000000, 0.000000, ''),
(40, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(41, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(42, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(43, 15000, 15000, '', 'Stock', 0.000000, 0.000000, ''),
(44, 15000, 15000, '', 'Stock', 0.000000, 0.000000, ''),
(45, 15000, 15000, '', 'Stock', 0.000000, 0.000000, ''),
(46, 15000, 15000, '', 'Stock', 0.000000, 0.000000, ''),
(47, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(48, 1000, 1000, '', 'Stock', 0.000000, 0.000000, ''),
(49, 15000, 15000, '', 'Stock', 0.000000, 0.000000, ''),
(50, 15000, 15000, '', 'Stock', 0.000000, 0.000000, ''),
(51, 1000, 1000, '', 'Stock', 0.000000, 0.000000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_inuse`
--

CREATE TABLE `tbl_bowser_inuse` (
  `Bowser_ID` int(11) NOT NULL,
  `Bowser_Longitude` float(10,6) DEFAULT NULL,
  `Bowser_Latitude` float(10,6) DEFAULT NULL,
  `Area_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bowser_inuse`
--

INSERT INTO `tbl_bowser_inuse` (`Bowser_ID`, `Bowser_Longitude`, `Bowser_Latitude`, `Area_ID`) VALUES
(100, 22.000000, 22.000000, 2),
(101, 22.000000, 22.000000, 3),
(102, 22.000000, 22.000000, 2),
(103, 22.000000, 22.000000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_invoices`
--

CREATE TABLE `tbl_bowser_invoices` (
  `InvoiceID` int(11) NOT NULL,
  `Transaction_Type` varchar(100) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BowserID` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_invoices`
--

INSERT INTO `tbl_bowser_invoices` (`InvoiceID`, `Transaction_Type`, `UserID`, `BowserID`, `Organisation_Name`, `Price`, `Date`) VALUES
(1, 'Lend', 7, 4, 'CompanyA', 1000, '2022-04-03 09:41:06'),
(5, 'Lend', 7, 7, 'CompanyB', 5000, '2022-04-10 10:40:06'),
(6, 'Lend', 7, 5, 'CompanyB', 1000, '2022-04-04 10:41:09'),
(7, 'Lend', 7, 10, 'CompanyB', 1000, '2022-04-04 10:42:05'),
(8, 'Lend', 7, 11, 'CompanyA', 1000, '2022-04-04 10:45:06'),
(9, 'Lend', 7, 12, 'CompanyA', 1000, '2022-04-04 10:45:12'),
(10, 'Lend', 7, 1, 'CompanyA', 500, '2022-04-04 10:46:16'),
(11, 'Lend', 7, 13, 'CompanyB', 1000, '2022-04-04 11:47:06'),
(12, 'Lend', 7, 37, 'CompanyA', 5000, '2022-04-04 11:48:22'),
(13, 'Lend', 7, 9, 'CompanyA', 15000, '2022-04-04 11:49:06'),
(14, 'Lend', 7, 2, 'CompanyC', 500, '2022-04-04 11:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_requests`
--

CREATE TABLE `tbl_bowser_requests` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Request_Reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_requests`
--

INSERT INTO `tbl_bowser_requests` (`RequestID`, `UserID`, `Bowser_Capacity`, `Organisation_Name`, `Priority`, `Status`, `Request_Reason`) VALUES
(1, 7, 1000, 'CompanyA', 3, '', 'test loan '),
(2, 7, 10000, 'CompanyB', 3, '', 'test loan 2'),
(3, 7, 15000, 'CompanyC', 1, '', 'test 3'),
(4, 7, 10000, 'CompanyA', 3, '', 'test Loan'),
(5, 7, 1000, 'CompanyC', 2, '', 'testing123'),
(6, 7, 1000, 'CompanyA', 3, '', 'loan 1000l '),
(7, 7, 1000, 'CompanyA', 3, '', 'test'),
(8, 7, 1000, 'CompanyA', 3, '', 'loan 500'),
(9, 7, 1000, 'CompanyB', 1, '', 'loaning 500'),
(10, 7, 1000, 'CompanyB', 2, '', 'request'),
(11, 7, 1000, 'CompanyA', 3, '', 'requesting 1000 from company a'),
(12, 7, 1000, 'CompanyB', 3, '', 'requesting 1000l from company b'),
(13, 7, 15000, 'CompanyA', 3, '', '15,000'),
(14, 7, 500, 'CompanyB', 2, '', '500l');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_stock`
--

CREATE TABLE `tbl_bowser_stock` (
  `Bowser_Capacity` int(11) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_stock`
--

INSERT INTO `tbl_bowser_stock` (`Bowser_Capacity`, `Stock`) VALUES
(500, 11),
(1000, 6),
(5000, 4),
(10000, 4),
(15000, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maintenance_schedule`
--

CREATE TABLE `tbl_maintenance_schedule` (
  `Maintenance_ID` int(11) NOT NULL,
  `Bowser_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Assigned_To` int(11) NOT NULL,
  `Area_ID` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Task_Type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_maintenance_schedule`
--

INSERT INTO `tbl_maintenance_schedule` (`Maintenance_ID`, `Bowser_ID`, `User_ID`, `Description`, `Status`, `Date`, `Assigned_To`, `Area_ID`, `Priority`, `Task_Type`) VALUES
(3, 1, 1, 'Broken tap to be replaced', 'Incomplete', '2022-03-22 15:58:08', 1, 1, 3, 'Repair'),
(2, 1, 1, 'Crack in bowser side', 'Incomplete', '2022-03-22 15:58:13', 1, 1, 3, 'Repair'),
(1, 1, 1, 'Refill required', 'Incomplete', '2022-03-22 15:58:18', 1, 1, 2, 'Refill'),
(11, 3, 6, 'Faulty tap', 'Incomplete', '2022-03-22 15:58:22', 4, 2, 1, 'Repair'),
(12, 4, 6, 'Leaking', 'Incomplete', '2022-03-22 15:58:26', 6, 5, 3, 'Repair'),
(13, 3, 5, 'Broken tap', 'Incomplete', '2022-03-22 15:58:32', 5, 7, 2, 'Repair'),
(14, 1, 7, 'Loose fitting', 'Incomplete', '2022-03-22 15:58:36', 6, 2, 1, 'Repair'),
(15, 2, 7, 'Broken nozzel', 'Incomplete', '2022-03-22 15:58:41', 5, 3, 3, 'Repair'),
(19, 3, 7, 'Bowser requires service', 'Incomplete', '2022-04-03 10:08:43', 5, 2, 1, 'Service'),
(22, 10, 7, 'repair of bowser 10', 'Incomplete', '2022-04-03 10:08:46', 5, 2, 1, 'Repair');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `Notice_ID` int(11) NOT NULL,
  `Notice_Text` varchar(250) NOT NULL,
  `Area_ID` int(11) NOT NULL,
  `Task_Type` varchar(100) DEFAULT NULL,
  `Bowser_ID` int(11) DEFAULT NULL,
  `Notice_DateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `Report_ID` int(11) NOT NULL,
  `Report_Type` int(11) DEFAULT NULL,
  `Bowser_ID` int(11) DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_type`
--

CREATE TABLE `tbl_report_type` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `is_bowser` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_account`
--

CREATE TABLE `tbl_user_account` (
  `User_ID` int(11) NOT NULL,
  `User_Type` varchar(100) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserLevel` varchar(100) NOT NULL,
  `IsVerified` tinyint(4) DEFAULT NULL,
  `Verification_Code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_account`
--

INSERT INTO `tbl_user_account` (`User_ID`, `User_Type`, `Password`, `Email`, `UserLevel`, `IsVerified`, `Verification_Code`) VALUES
(2, 'Operations\r\n', '!1Ppaaaaaa', 'testop@email.com', '1', 1, '4e1293771cba81ae'),
(3, 'Customer', '!1Ppaaaaaa', 'testUser@email.com', '1', 1, '97e7fd08f1483816'),
(4, 'Maintenance', '!1Ppaaaaaa', 'testMain2@email.com', '1', 1, ''),
(5, 'Maintenance', '!1Ppaaaaaa', 'testMain@email.com', '1', 1, ''),
(7, 'Operations', '!1Ppaaaaaa', 'testOps@email.com', '1', 1, ''),
(8, 'Maintenance', '!1Ppaaaaaa', 'testMain3@email.com', '1', 1, ''),
(9, 'Maintenance', '!1Ppaaaaaa', 'testMain4@email.com', '1', 1, ''),
(10, 'Maintenance', '!1Ppaaaaaa', 'testMain5@email.com', '1', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`Area_ID`);

--
-- Indexes for table `tbl_bowsers`
--
ALTER TABLE `tbl_bowsers`
  ADD PRIMARY KEY (`BowserID`);

--
-- Indexes for table `tbl_bowser_inuse`
--
ALTER TABLE `tbl_bowser_inuse`
  ADD KEY `Bowser_ID` (`Bowser_ID`);

--
-- Indexes for table `tbl_bowser_invoices`
--
ALTER TABLE `tbl_bowser_invoices`
  ADD PRIMARY KEY (`InvoiceID`);

--
-- Indexes for table `tbl_bowser_requests`
--
ALTER TABLE `tbl_bowser_requests`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `tbl_maintenance_schedule`
--
ALTER TABLE `tbl_maintenance_schedule`
  ADD PRIMARY KEY (`Maintenance_ID`),
  ADD KEY `Bowser_ID` (`Bowser_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Area_ID` (`Area_ID`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`Notice_ID`),
  ADD KEY `bowser_database` (`Area_ID`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`Report_ID`);

--
-- Indexes for table `tbl_report_type`
--
ALTER TABLE `tbl_report_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `Area_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_bowsers`
--
ALTER TABLE `tbl_bowsers`
  MODIFY `BowserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_bowser_invoices`
--
ALTER TABLE `tbl_bowser_invoices`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_bowser_requests`
--
ALTER TABLE `tbl_bowser_requests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_maintenance_schedule`
--
ALTER TABLE `tbl_maintenance_schedule`
  MODIFY `Maintenance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `Notice_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `Report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_report_type`
--
ALTER TABLE `tbl_report_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD CONSTRAINT `bowser_database` FOREIGN KEY (`Area_ID`) REFERENCES `tbl_area` (`Area_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

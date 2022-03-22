-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 05:06 PM
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
-- Table structure for table `tbl_bowser_inuse`
--

CREATE TABLE `tbl_bowser_inuse` (
  `Bowser_ID` int(11) NOT NULL,
  `Bowser_Longitude` float(10,6) DEFAULT NULL,
  `Bowser_Latitude` float(10,6) DEFAULT NULL,
  `Area_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_lent`
--

CREATE TABLE `tbl_bowser_lent` (
  `Bowser_ID` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Hire_or_Loan` varchar(100) NOT NULL,
  `Invoice_Number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_loaned`
--

CREATE TABLE `tbl_bowser_loaned` (
  `UserID` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Request_Reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bowser_loaned`
--

INSERT INTO `tbl_bowser_loaned` (`UserID`, `Organisation_Name`, `Bowser_Capacity`, `Priority`, `Status`, `Request_Reason`) VALUES
(2, 'CompanyB', 1000, 3, '', 'lllll');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_stock`
--

CREATE TABLE `tbl_bowser_stock` (
  `Bowser_ID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Bowser_Status` varchar(100) NOT NULL,
  `Bowser_Quantity` int(11) NOT NULL,
  `Bowser_Model` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE `tbl_invoices` (
  `Invoice_Number` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Invoice_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Invoice_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(15, 2, 7, 'Broken nozzel', 'Incomplete', '2022-03-22 15:58:41', 5, 3, 3, 'Repair');

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
(2, 'Operations\r\n', '!1Ppaaaaaa', 'testOpsOld@email.com', '1', 1, '4e1293771cba81ae'),
(3, 'Customer', '!1Ppaaaaaa', 'testUser@email.com', '1', 1, '97e7fd08f1483816'),
(4, 'Maintenance', '!1Ppaaaaaa', 'testMain2@email.com', '1', 1, ''),
(5, 'Maintenance', '414cd476', 'testMain3@email.com', '1', 1, ''),
(6, 'Maintenance', 'da5699a0', 'testMain4@email.com', '1', 1, ''),
(7, 'Operations', '!1Ppaaaaaa', 'testOps2@email.com', '1', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`Area_ID`);

--
-- Indexes for table `tbl_bowser_inuse`
--
ALTER TABLE `tbl_bowser_inuse`
  ADD KEY `Bowser_ID` (`Bowser_ID`);

--
-- Indexes for table `tbl_bowser_lent`
--
ALTER TABLE `tbl_bowser_lent`
  ADD KEY `Bowser_ID` (`Bowser_ID`),
  ADD KEY `Invoice_Number` (`Invoice_Number`),
  ADD KEY `Organisation_Name` (`Organisation_Name`);

--
-- Indexes for table `tbl_bowser_loaned`
--
ALTER TABLE `tbl_bowser_loaned`
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tbl_bowser_stock`
--
ALTER TABLE `tbl_bowser_stock`
  ADD UNIQUE KEY `Bowser_ID` (`Bowser_ID`);

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
-- AUTO_INCREMENT for table `tbl_maintenance_schedule`
--
ALTER TABLE `tbl_maintenance_schedule`
  MODIFY `Maintenance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bowser_loaned`
--
ALTER TABLE `tbl_bowser_loaned`
  ADD CONSTRAINT `tbl_Bowser_Requests_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_user_account` (`User_ID`);

--
-- Constraints for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD CONSTRAINT `bowser_database` FOREIGN KEY (`Area_ID`) REFERENCES `tbl_area` (`Area_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

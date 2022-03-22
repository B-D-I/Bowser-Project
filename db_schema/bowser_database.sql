-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 09:04 PM
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
-- Table structure for table `tbl_bowser_borrowed`
--

CREATE TABLE `tbl_bowser_borrowed` (
  `TransactionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BowserID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Request_Reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_borrowed`
--

INSERT INTO `tbl_bowser_borrowed` (`TransactionID`, `UserID`, `BowserID`, `Bowser_Capacity`, `Organisation_Name`, `Priority`, `Status`, `Request_Reason`) VALUES
(1, 7, 9, 5000, 'CompanyC', 2, '', 'testing loaned 001'),
(2, 7, 10, 1000, 'CompanyB', 3, '', 'test loan 1000L');

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
  `TransactionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BowserID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Request_Reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_lent`
--

INSERT INTO `tbl_bowser_lent` (`TransactionID`, `UserID`, `BowserID`, `Bowser_Capacity`, `Organisation_Name`, `Priority`, `Status`, `Request_Reason`) VALUES
(1, 7, 5, 10000, 'CompanyB', 2, '', 'test lend'),
(3, 7, 6, 1000, 'CompanyB', 2, '', 'test lend '),
(5, 7, 7, 10000, 'CompanyC', 3, '', 'test lend 10000L'),
(6, 7, 8, 5000, 'CompanyB', 2, '', 'test lend 5000L');

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

--
-- Dumping data for table `tbl_bowser_stock`
--

INSERT INTO `tbl_bowser_stock` (`Bowser_ID`, `Bowser_Capacity`, `Bowser_Status`, `Bowser_Quantity`, `Bowser_Model`) VALUES
(1, 5000, 'Stock', 1, 'Medium'),
(2, 1000, 'Stock', 1, 'Small'),
(3, 10000, 'Stock', 1, 'Large'),
(4, 10000, 'Stock', 1, 'Large'),
(11, 5000, 'Stock', 1, 'Medium'),
(12, 5000, 'Stock', 1, 'Medium'),
(13, 5000, 'Stock', 1, 'Medium'),
(14, 5000, 'Stock', 1, 'Medium'),
(15, 5000, 'Stock', 1, 'Medium'),
(16, 5000, 'Stock', 1, 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE `tbl_invoices` (
  `Invoice_Number` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Invoice_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Invoice_Price` int(11) NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `TransactionType` varchar(100) NOT NULL,
  `BowserID` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL
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
(15, 2, 7, 'Broken nozzel', 'Incomplete', '2022-03-22 15:58:41', 5, 3, 3, 'Repair'),
(19, 3, 7, 'Bowser requires service', 'Incomplete', '2022-03-24 00:00:00', 5, 0, 1, 'Service');

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
-- Indexes for table `tbl_bowser_borrowed`
--
ALTER TABLE `tbl_bowser_borrowed`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `tbl_bowser_inuse`
--
ALTER TABLE `tbl_bowser_inuse`
  ADD KEY `Bowser_ID` (`Bowser_ID`);

--
-- Indexes for table `tbl_bowser_lent`
--
ALTER TABLE `tbl_bowser_lent`
  ADD PRIMARY KEY (`TransactionID`);

--
-- Indexes for table `tbl_bowser_stock`
--
ALTER TABLE `tbl_bowser_stock`
  ADD UNIQUE KEY `Bowser_ID` (`Bowser_ID`),
  ADD UNIQUE KEY `Bowser_ID_2` (`Bowser_ID`);

--
-- Indexes for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  ADD PRIMARY KEY (`Invoice_Number`);

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
-- AUTO_INCREMENT for table `tbl_bowser_borrowed`
--
ALTER TABLE `tbl_bowser_borrowed`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_bowser_lent`
--
ALTER TABLE `tbl_bowser_lent`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_bowser_stock`
--
ALTER TABLE `tbl_bowser_stock`
  MODIFY `Bowser_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  MODIFY `Invoice_Number` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_maintenance_schedule`
--
ALTER TABLE `tbl_maintenance_schedule`
  MODIFY `Maintenance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Constraints for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD CONSTRAINT `bowser_database` FOREIGN KEY (`Area_ID`) REFERENCES `tbl_area` (`Area_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

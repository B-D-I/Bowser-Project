-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 08:20 PM
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
  `Area_Mains_Status` varchar(100) NOT NULL,
  `Last_Modified` date NOT NULL DEFAULT '2022-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`Area_ID`, `Area_Name`, `Area_Mains_Status`, `Last_Modified`) VALUES
(1, 'Cheltenham', 'Non-Operational', '2022-01-01'),
(2, 'Oxford', 'Operational', '2022-01-01'),
(3, 'Gloucester', 'Operational', '2022-01-01'),
(4, 'Evesham', 'Operational', '2022-01-01'),
(5, 'Stratford Upon Avon', 'Operational', '2022-01-01'),
(6, 'Burford', 'Operational', '2022-01-01'),
(7, 'Witney', 'Operational', '2022-01-01'),
(100, 'National', 'N/A', '2022-01-01');

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
  `Lat` varchar(30) NOT NULL,
  `Lng` varchar(30) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowsers`
--

INSERT INTO `tbl_bowsers` (`BowserID`, `Bowser_Capacity`, `Bowser_Cost`, `Bowser_Description`, `Status`, `Lat`, `Lng`, `Location`) VALUES
(1, 500, 500, '15kg new shape model', 'Lent', '0.000000', '0.000000', ''),
(2, 500, 500, '', 'Stock', '0.000000', '0.000000', ''),
(3, 500, 500, '', 'Lent', '0.000000', '0.000000', ''),
(4, 1000, 1000, '', 'Deployed', '51.8979988098144', '-2.0838599205017', ''),
(5, 1000, 1000, '', 'Deployed', '51.90999129223681', '-2.0268155164085266', ''),
(6, 5000, 5000, '', 'Deployed', '51.92797399363294', '-2.0335763175971744', ''),
(7, 5000, 5000, '', 'Deployed', '51.957668776116215', '-1.9809952140785692', ''),
(8, 10000, 10000, '', 'Deployed', '51.76142438181465', '-2.2685147142037687', ''),
(9, 15000, 15000, '', 'Lent', '0.000000', '0.000000', ''),
(10, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(11, 1000, 1000, '', 'Deployed', '51.939323519208145', '-2.14808769943192', ''),
(12, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(13, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(14, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(15, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(16, 10000, 10000, '', 'Lent', '0.000000', '0.000000', ''),
(17, 10000, 10000, '', 'Lent', '0.000000', '0.000000', ''),
(18, 10000, 10000, '', 'Lent', '0.000000', '0.000000', ''),
(19, 10000, 10000, '', 'Stock', '0.000000', '0.000000', ''),
(20, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(21, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(22, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(23, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(24, 1000, 1000, '', 'Lent', '0.000000', '0.000000', ''),
(25, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(26, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(27, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(28, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(29, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(30, 500, 500, '', 'Lent', '0.000000', '0.000000', ''),
(31, 500, 500, '', 'Stock', '0.000000', '0.000000', ''),
(32, 500, 500, '', 'Stock', '0.000000', '0.000000', ''),
(33, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(34, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(35, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(36, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(37, 5000, 5000, '', 'Lent', '0.000000', '0.000000', ''),
(38, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(39, 500, 500, '', 'Stock', '0.000000', '0.000000', ''),
(40, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(41, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(42, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(43, 15000, 15000, '', 'Lent', '0.000000', '0.000000', ''),
(44, 15000, 15000, '', 'Lent', '0.000000', '0.000000', ''),
(45, 15000, 15000, '', 'Lent', '0.000000', '0.000000', ''),
(46, 15000, 15000, '', 'Lent', '0.000000', '0.000000', ''),
(47, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(48, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(49, 15000, 15000, '', 'Stock', '0.000000', '0.000000', ''),
(50, 15000, 15000, '', 'Stock', '0.000000', '0.000000', ''),
(51, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(52, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(53, 500, 500, '', 'Stock', '0.000000', '0.000000', ''),
(54, 5000, 5000, '', 'Lent', '0.000000', '0.000000', ''),
(55, 10000, 10000, '', 'Stock', '0.000000', '0.000000', ''),
(56, 15000, 15000, '', 'Stock', '0.000000', '0.000000', ''),
(57, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(58, 1000, 1000, '', 'Stock', '0.000000', '0.000000', ''),
(59, 1000, 1000, '', 'Stock', '0.000000', '0.000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_inuse`
--

CREATE TABLE `tbl_bowser_inuse` (
  `Bowser_ID` int(11) NOT NULL,
  `Lat` varchar(30) NOT NULL,
  `Lng` varchar(30) NOT NULL,
  `Area_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bowser_inuse`
--

INSERT INTO `tbl_bowser_inuse` (`Bowser_ID`, `Lat`, `Lng`, `Area_ID`, `User_ID`) VALUES
(1, '51.89797232832006', '-2.0842461585998535', 0, 7),
(2, '51.89666047580352', '-2.0848469734191895', 0, 7),
(3, '51.887616867833856', '-2.0905688835144043', 0, 7),
(4, '51.887351991000344', '-2.0906834602355957', 0, 7),
(5, '51.884351991000344', '-2.08982515335083', 0, 7),
(6, '51.92797399363294', '-2.0335763175971744', 0, 7),
(7, '51.957668776116215', '-1.9809952140785692', 0, 7),
(8, '51.76142438181465', '-2.2685147142037687', 0, 7),
(9, '51.883577275950034', '-2.089782238006592', 0, 7),
(10, '51.8979988098144', '-2.0838599205017', 0, 7),
(11, '51.88678555932836', '-2.073929974110791', 0, 7),
(12, '51.9347482190218', '-2.0411822241730926', 0, 7);

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
  `Organisation_From` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_invoices`
--

INSERT INTO `tbl_bowser_invoices` (`InvoiceID`, `Transaction_Type`, `UserID`, `BowserID`, `Organisation_Name`, `Organisation_From`, `Price`, `Date`) VALUES
(1, 'Lend', 7, 4, 'CompanyA', 'CompanyB', 1000, '2022-04-05 10:15:14'),
(5, 'Lend', 7, 7, 'CompanyB', 'CompanyA', 5000, '2022-04-05 10:14:43'),
(6, 'Lend', 7, 5, 'CompanyB', 'CompanyA', 1000, '2022-04-05 10:14:47'),
(7, 'Lend', 7, 10, 'CompanyB', 'CompanyA', 1000, '2022-04-05 10:14:50'),
(8, 'Lend', 7, 11, 'CompanyA', 'CompanyC', 1000, '2022-04-05 10:15:36'),
(9, 'Lend', 7, 12, 'CompanyA', 'CompanyC', 1000, '2022-04-05 10:15:41'),
(10, 'Lend', 7, 1, 'CompanyA', 'CompanyB', 500, '2022-04-05 10:15:49'),
(11, 'Lend', 7, 13, 'CompanyB', 'CompanyA', 1000, '2022-04-05 10:14:55'),
(12, 'Lend', 7, 37, 'CompanyA', 'CompanyB', 5000, '2022-04-05 10:15:58'),
(13, 'Lend', 7, 9, 'CompanyA', 'CompanyC', 15000, '2022-04-05 10:16:06'),
(14, 'Lend', 7, 2, 'CompanyC', 'CompanyA', 500, '2022-04-05 10:14:58'),
(15, 'Lend', 7, 14, 'CompanyC', 'CompanyA', 1000, '2022-04-05 10:22:53'),
(16, 'Lend', 7, 43, 'CompanyB', 'CompanyA', 15000, '2022-04-05 10:23:36'),
(17, 'Lend', 7, 44, 'CompanyB', 'CompanyA', 15000, '2022-04-05 10:36:00'),
(18, 'Lend', 7, 45, 'CompanyB', 'CompanyA', 15000, '2022-04-05 10:57:08'),
(19, 'Lend', 7, 30, 'CompanyB', 'CompanyA', 500, '2022-04-05 10:57:48'),
(20, 'Lend', 7, 46, 'CompanyB', 'CompanyA', 15000, '2022-04-05 11:01:48'),
(21, 'Lend', 7, 16, 'CompanyB', 'CompanyA', 10000, '2022-04-05 11:18:20'),
(22, 'Lend', 7, 15, 'CompanyB', 'CompanyA', 1000, '2022-04-05 11:16:04'),
(23, 'Lend', 7, 20, 'CompanyC', 'CompanyA', 1000, '2022-04-05 11:18:53'),
(24, 'Lend', 7, 21, 'CompanyB', 'CompanyA', 1000, '2022-04-05 11:23:41'),
(25, 'Lend', 7, 22, 'CompanyB', 'CompanyA', 1000, '2022-04-05 11:24:31'),
(26, 'Lend', 7, 23, 'CompanyB', 'CompanyA', 1000, '2022-04-05 11:26:28'),
(27, 'Lend', 7, 24, 'CompanyC', 'CompanyA', 1000, '2022-04-05 11:28:56'),
(28, 'Lend', 7, 17, 'CompanyB', 'CompanyA', 10000, '2022-04-05 13:22:45'),
(29, 'Lend', 7, 54, 'CompanyE', 'CompanyA', 5000, '2022-04-19 18:28:43'),
(30, 'Lend', 7, 18, 'CompanyD', 'CompanyA', 10000, '2022-04-30 13:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bowser_requests`
--

CREATE TABLE `tbl_bowser_requests` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Organisation_From` varchar(100) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Request_Reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bowser_requests`
--

INSERT INTO `tbl_bowser_requests` (`RequestID`, `UserID`, `Bowser_Capacity`, `Organisation_Name`, `Organisation_From`, `Priority`, `Status`, `Request_Reason`) VALUES
(1, 7, 1000, 'CompanyA', 'CompanyB', 3, 'Pending', 'test loan '),
(2, 7, 10000, 'CompanyB', 'CompanyA', 3, 'Pending', 'test loan 2'),
(3, 7, 15000, 'CompanyC', 'CompanyA', 1, 'Pending', 'test 3'),
(4, 7, 10000, 'CompanyA', 'CompanyB', 1, 'Accepted', 'test Loan'),
(5, 7, 1000, 'CompanyC', 'CompanyA', 2, 'Pending', 'testing123'),
(6, 7, 1000, 'CompanyA', 'CompanyC', 3, 'Pending', 'loan 1000l '),
(7, 7, 1000, 'CompanyA', 'CompanyB', 3, 'Pending', 'test'),
(9, 7, 1000, 'CompanyB', 'CompanyA', 1, 'Pending', 'loaning 500'),
(10, 7, 1000, 'CompanyB', 'CompanyA', 2, 'Pending', 'request'),
(12, 7, 1000, 'CompanyB', 'CompanyA', 3, 'Pending', 'requesting 1000l from company b'),
(14, 7, 500, 'CompanyB', 'CompanyA', 2, 'Pending', '500l'),
(15, 7, 10000, 'CompanyC', 'CompanyA', 1, 'Pending', 'loan 10000l'),
(16, 7, 15000, 'CompanyB', 'CompanyC', 2, 'Pending', 'loan 15000'),
(17, 7, 15000, 'CompanyC', 'CompanyA', 3, 'Pending', 'loan 15k'),
(18, 7, 500, 'CompanyB', 'CompanyA', 3, 'Denied', 'loan from B'),
(19, 7, 1000, 'CompanyE', 'CompanyA', 3, 'Pending', 'company E 1000l'),
(20, 12, 5000, 'CompanyA', 'CompanyB', 2, 'Pending', 'Need bowser'),
(21, 13, 1000, 'CompanyA', 'CompanyC', 2, 'Denied', 'Requirement for a bowser'),
(22, 12, 5000, 'CompanyA', 'CompanyB', 2, 'Denied', 'Need 5000 L bowser'),
(23, 13, 1000, 'CompanyA', 'CompanyC', 2, 'Denied', 'Requirement for bowser'),
(24, 13, 10000, 'CompanyA', 'CompanyD', 2, 'Accepted', 'CompanyD need 10,000 bowser'),
(25, 14, 5000, 'CompanyA', 'CompanyE', 2, 'Denied', 'CompanyE needs bowser'),
(26, 13, 10000, 'CompanyA', 'CompanyD', 2, 'Denied', 'CompanyD needs bowser'),
(27, 14, 5000, 'CompanyA', 'CompanyE', 2, 'Accepted', 'CompanyE need 5000L bowser');

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
(1000, 3),
(5000, 4),
(10000, 2),
(15000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_representative`
--

CREATE TABLE `tbl_company_representative` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_company_representative`
--

INSERT INTO `tbl_company_representative` (`UserID`, `Email`, `Organisation_Name`) VALUES
(7, 'testOps@email.com', 'CompanyA'),
(11, 'CompanyB_ops@email.com', 'CompanyB'),
(12, 'CompanyC_ops@email.com', 'CompanyC'),
(13, 'CompanyD_ops@email.com', 'CompanyD'),
(14, 'CompanyE_ops@email.com', 'CompanyE');

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
  `Date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Assigned_To` int(11) NOT NULL,
  `Area_ID` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Task_Type` varchar(100) NOT NULL,
  `Completed_Date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_maintenance_schedule`
--

INSERT INTO `tbl_maintenance_schedule` (`Maintenance_ID`, `Bowser_ID`, `User_ID`, `Description`, `Status`, `Date`, `Assigned_To`, `Area_ID`, `Priority`, `Task_Type`, `Completed_Date`) VALUES
(3, 1, 1, 'Broken tap to be replaced', 'Incomplete', '2022-03-22 15:58:08', 1, 1, 3, 'Repair', NULL),
(2, 1, 1, 'Crack in bowser side', 'Incomplete', '2022-03-22 15:58:13', 1, 1, 3, 'Repair', NULL),
(1, 1, 1, 'Refill required', 'Incomplete', '2022-03-22 15:58:18', 1, 1, 2, 'Refill', NULL),
(11, 3, 6, 'Faulty tap', 'Incomplete', '2022-03-22 15:58:22', 4, 2, 1, 'Repair', NULL),
(12, 4, 6, 'Leaking', 'Incomplete', '2022-03-22 15:58:26', 6, 5, 3, 'Repair', NULL),
(13, 15, 5, 'Broken tap', 'Completed', '2022-04-19 10:27:19', 5, 7, 2, 'Repair', '2022-04-29 09:33:19'),
(14, 1, 7, 'Loose fitting', 'Completed', '2022-04-19 18:14:38', 5, 2, 1, 'Repair', NULL),
(15, 2, 7, 'Broken nozzel', 'Completed', '2022-04-19 10:27:12', 5, 3, 3, 'Repair', '2022-04-29 09:27:12'),
(19, 16, 7, 'Bowser requires service', 'Completed', '2022-03-22 15:58:13', 5, 2, 1, 'Service', '2022-04-29 09:33:25'),
(22, 10, 7, 'repair of bowser 10', 'Completed', '2022-04-19 18:14:12', 5, 2, 1, 'Repair', NULL),
(24, 2, 7, 'deploy bowser 2 to location', 'Incomplete', '2022-04-30 23:00:00', 5, 0, 3, 'Deliver', NULL),
(25, 21, 7, 'refill bowser 21', 'Incomplete', '2022-05-01 23:00:00', 5, 0, 2, 'Refill', NULL),
(26, 7, 7, 'bowser 7 collection', 'Incomplete', '2022-05-01 23:00:00', 5, 0, 1, 'Collect', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `Notice_ID` int(11) NOT NULL,
  `Notice_Text` varchar(250) NOT NULL,
  `Area_ID` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Type` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`Notice_ID`, `Notice_Text`, `Area_ID`, `Date`, `Type`) VALUES
(1, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 102&nbsp;will be undergoing a Repair', 1, '2022-04-26 10:06:58', 1),
(3, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 103&nbsp;will be undergoing a Refill', 1, '2022-04-26 10:07:01', 1),
(4, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 102&nbsp;will be undergoing a Repair', 1, '2022-04-26 10:07:04', 1),
(5, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 100&nbsp;will be undergoing a Refill', 1, '2022-04-26 10:07:07', 1),
(6, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 103&nbsp;will be undergoing a Repair', 1, '2022-04-26 10:08:29', 1),
(7, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 102&nbsp;will be undergoing a Refill', 2, '2022-04-19 17:04:55', 1),
(8, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 103&nbsp;will be undergoing a Repair', 2, '2022-04-19 17:04:59', 1),
(9, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 100&nbsp;will be undergoing a Refill', 2, '2022-04-19 17:05:02', 1),
(10, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 100&nbsp;will be undergoing a Refill', 2, '2022-04-19 17:05:04', 1),
(11, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 101&nbsp;will be undergoing a Repair', 1, '2022-04-26 10:07:11', 1),
(12, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 103&nbsp;will be undergoing a Repair', 2, '2022-04-19 17:05:10', 1),
(13, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 100&nbsp;will be undergoing a Refill', 1, '2022-04-26 10:08:33', 1),
(14, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 103&nbsp;will be undergoing a Repair', 2, '2022-04-19 17:05:14', 1),
(15, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 103&nbsp;will be undergoing a Repair', 2, '2022-04-19 17:05:17', 1),
(16, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 2&nbsp;will be undergoing a Repair', 2, '2022-04-19 17:05:20', 1),
(17, 'From 2022-04-06 &nbsp;&nbsp;Bowser: 55&nbsp;will be undergoing a Repair', 1, '2022-04-26 10:08:36', 1),
(20, 'On 2022-04-03 11:08:43&nbsp;&nbsp;Bowser: 3&nbsp;has undertaken a Service', 2, '2022-04-19 18:03:01', 2),
(22, 'On 2022-04-19 19:11:13&nbsp;&nbsp;Bowser: 10&nbsp;has undertaken a Repair', 2, '2022-04-19 18:14:12', 2),
(23, 'On 2022-04-19 19:11:09&nbsp;&nbsp;Bowser: 3&nbsp;has undertaken a Service', 2, '2022-04-19 18:14:38', 2),
(24, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 08:56:10', 2),
(25, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 08:56:18', 2),
(26, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:11:58', 2),
(27, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:12:03', 2),
(28, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:13:48', 2),
(29, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:15:16', 2),
(30, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:21:46', 2),
(31, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:21:51', 2),
(33, 'On 2022-04-29 10:23:08&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:23:12', 2),
(34, 'On 2022-04-29 10:23:04&nbsp;&nbsp;Bowser: 2&nbsp;has undertaken a Repair', 3, '2022-04-29 09:23:16', 2),
(35, 'On 2022-04-29 09:23:04&nbsp;&nbsp;Bowser: 2&nbsp;has undertaken a Repair', 3, '2022-04-29 09:24:19', 2),
(36, 'On 2022-04-29 09:23:04&nbsp;&nbsp;Bowser: 2&nbsp;has undertaken a Repair', 3, '2022-04-29 09:24:22', 2),
(38, 'On 2022-03-22 15:58:13&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:27:12', 2),
(39, 'On 2022-03-22 15:58:13&nbsp;&nbsp;Bowser: 11&nbsp;has undertaken a Service', 2, '2022-04-30 13:29:35', 2),
(40, 'On 2022-03-22 15:58:13&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-29 09:33:19', 2),
(41, 'On 2022-03-22 15:58:13&nbsp;&nbsp;Bowser: 17&nbsp;has undertaken a Service', 2, '2022-04-30 13:29:19', 2),
(43, 'From 2022-04-30&nbsp;&nbsp;Bowser: 100&nbsp;will be undergoing a Repair', 2, '2022-04-30 13:28:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `Report_ID` int(11) NOT NULL,
  `Report_Type` int(11) DEFAULT NULL,
  `Bowser_ID` int(11) DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(100) NOT NULL,
  `Lat` varchar(30) NOT NULL,
  `Lng` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reports`
--

INSERT INTO `tbl_reports` (`Report_ID`, `Report_Type`, `Bowser_ID`, `Description`, `User_ID`, `Date`, `Status`, `Lat`, `Lng`) VALUES
(4, 1, 10, 'bowser refill required', NULL, '2022-04-06 08:35:21', 'Pending', '', ''),
(5, 2, 102, '102 damaged', NULL, '2022-04-06 09:20:07', 'Actioned', '', ''),
(6, 3, 0, 'i am angry about bowsers', NULL, '2022-04-06 09:29:34', 'Actioned', '', ''),
(7, 1, 103, 'bowser needs refill', NULL, '2022-04-06 09:29:37', 'Actioned', '', ''),
(8, 2, 102, 'broken', NULL, '2022-04-06 09:29:40', 'Actioned', '', ''),
(9, 1, 100, 'this bowser needs refill', NULL, '2022-04-06 09:29:44', 'Actioned', '', ''),
(10, 2, 103, 'bowser looks damaged', NULL, '2022-04-06 09:29:47', 'Actioned', '', ''),
(11, 1, 102, 'refill', NULL, '2022-04-06 09:29:50', 'Actioned', '', ''),
(12, 2, 103, 'damaged', NULL, '2022-04-06 09:29:53', 'Actioned', '', ''),
(13, 1, 100, 'sort out refill', NULL, '2022-04-06 09:29:55', 'Actioned', '', ''),
(14, 1, 100, 'need refill', NULL, '2022-04-06 09:34:29', 'Actioned', '', ''),
(15, 2, 101, 'looks broken', NULL, '2022-04-06 09:34:31', 'Actioned', '', ''),
(16, 2, 103, 'dodgy tap', NULL, '2022-04-06 09:34:34', 'Actioned', '', ''),
(17, 1, 100, 'needs refill', NULL, '2022-04-06 09:34:36', 'Actioned', '', ''),
(18, 2, 103, 'broken', NULL, '2022-04-06 09:34:38', 'Actioned', '', ''),
(19, 2, 103, 'not working', NULL, '2022-04-06 09:34:40', 'Actioned', '', ''),
(20, 2, 2, 'broken tap', NULL, '2022-04-06 09:40:50', 'Actioned', '', ''),
(21, 2, 55, 'broken tap !!!', NULL, '2022-04-19 17:19:59', 'Actioned', '', ''),
(22, 1, 102, 'need refill immediately ', NULL, '2022-04-19 17:20:25', 'Pending', '', ''),
(23, 2, 10, 'damaged nozzle!!!', NULL, '2022-04-28 09:20:38', 'Actioned', '', ''),
(24, 1, 10, 'refill the bowser !', NULL, '2022-04-19 17:19:41', 'Pending', '', ''),
(25, 2, 100, 'damaged - needs fixing!!!', NULL, '2022-04-30 13:28:34', 'Actioned', '', ''),
(26, 2, 103, 'damage to the side of bowser', NULL, '2022-04-28 09:21:36', 'Actioned', '', ''),
(44, 1, 1, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.89797232832006', '-2.0842461585998535'),
(45, 1, 2, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.89666047580352', '-2.0848469734191895'),
(46, 1, 3, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.887616867833856', '-2.0905688835144043'),
(47, 1, 4, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.887351991000344', '-2.0906834602355957'),
(48, 1, 5, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.884351991000344', '-2.08982515335083'),
(49, 1, 6, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.92797399363294', '-2.0335763175971744'),
(50, 1, 7, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.957668776116215', '-1.9809952140785692'),
(51, 1, 8, 'Refill', NULL, '2022-04-27 17:58:51', 'Actioned', '51.76142438181465', '-2.2685147142037687'),
(52, 1, 9, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.883577275950034', '-2.089782238006592'),
(53, 1, 10, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.8979988098144', '-2.0838599205017'),
(54, 2, 11, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.88678555932836', '-2.073929974110791'),
(55, 2, 12, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.9347482190218', '-2.0411822241730926'),
(56, 2, 18, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.90668389780666', '-2.0000891685485778'),
(57, 2, 19, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '52.00770977960023', '-1.694188594818109'),
(58, 2, 25, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.98847423617575', '-1.7027716636657653'),
(59, 2, 26, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '52.00496235084007', '-1.7292075157165465'),
(60, 2, 27, 'Repair', NULL, '2022-04-27 17:58:51', 'Actioned', '51.98445698078115', '-1.7343573570251403'),
(61, 1, 11, 'Bowser 11 needs refill', NULL, '2022-04-28 11:13:05', 'Actioned', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_type`
--

CREATE TABLE `tbl_report_type` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `is_bowser` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_report_type`
--

INSERT INTO `tbl_report_type` (`id`, `description`, `is_bowser`) VALUES
(1, 'Refill', 1),
(2, 'Damaged', 1),
(3, 'Complaint', 0),
(4, 'Other Issue', 0);

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
  `Verification_Code` varchar(250) NOT NULL,
  `Location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_account`
--

INSERT INTO `tbl_user_account` (`User_ID`, `User_Type`, `Password`, `Email`, `UserLevel`, `IsVerified`, `Verification_Code`, `Location`) VALUES
(2, 'Operations\r\n', '!1Ppaaaaaa', 'testop@email.com', '1', 1, '4e1293771cba81ae', 100),
(3, 'Customer', '!1Ppaaaaaa', 'testUser@email.com', '1', 1, '97e7fd08f1483816', 1),
(4, 'Maintenance', '!1Ppaaaaaa', 'testMain2@email.com', '1', 1, '', 100),
(5, 'Maintenance', '!1Ppaaaaaa', 'testMain@email.com', '1', 1, '', 100),
(7, 'Operations', '!1Ppaaaaaa', 'testOps@email.com', '1', 1, '', 100),
(8, 'Maintenance', '!1Ppaaaaaa', 'testMain3@email.com', '1', 1, '', 100),
(9, 'Maintenance', '!1Ppaaaaaa', 'testMain4@email.com', '1', 1, '', 100),
(10, 'Maintenance', '!1Ppaaaaaa', 'testMain5@email.com', '1', 1, '', 100),
(11, 'Operations', '!1Ppaaaaaa', 'CompanyB_ops@email.com', '1', 1, '02f016efe', 100),
(12, 'Operations', '!1Ppaaaaaa', 'CompanyC_ops@email.com', '1', 1, '35492f4f9', 100),
(13, 'Operations', '!1Ppaaaaaa', 'CompanyD_ops@email.com', '1', 1, '6a23f896b', 100),
(14, 'Operations', '!1Ppaaaaaa', 'CompanyE_ops@email.com', '1', 1, '07cad98af', 100),
(17, 'Customer', '!1Ppaaaaaa', 'testUser2@email.com', '1', 1, '84b479a0058e82de', 2),
(18, 'Customer', '!1Ppaaaaaa', 'testUser3@email.com', '1', 1, '6941b77e04f100c2', 7),
(19, 'Customer', '!1Ppaaaaaa', 'testUser4@email.com', '1', 1, 'fcca6f28bfe47178', 2),
(20, 'Customer', '!1Ppaaaaaa', 'testUser5@email.com', '1', 1, 'f711b21917df90ad', 2);

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
  ADD UNIQUE KEY `Bowser_ID_2` (`Bowser_ID`),
  ADD UNIQUE KEY `Bowser_ID_3` (`Bowser_ID`),
  ADD UNIQUE KEY `Bowser_ID_4` (`Bowser_ID`),
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
  ADD PRIMARY KEY (`Notice_ID`);

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
  MODIFY `Area_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbl_bowsers`
--
ALTER TABLE `tbl_bowsers`
  MODIFY `BowserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_bowser_invoices`
--
ALTER TABLE `tbl_bowser_invoices`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_bowser_requests`
--
ALTER TABLE `tbl_bowser_requests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_maintenance_schedule`
--
ALTER TABLE `tbl_maintenance_schedule`
  MODIFY `Maintenance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `Notice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `Report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_report_type`
--
ALTER TABLE `tbl_report_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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

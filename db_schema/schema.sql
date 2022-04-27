-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2022 at 05:40 PM
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
CREATE DATABASE IF NOT EXISTS `bowser_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bowser_database`;

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
(18, 10000, 10000, '', 'Stock', '0.000000', '0.000000', ''),
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
(29, 'Lend', 7, 54, 'CompanyE', 'CompanyA', 5000, '2022-04-19 18:28:43');

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
(21, 13, 1000, 'CompanyA', 'CompanyC', 2, 'Pending', 'Requirement for a bowser'),
(22, 12, 5000, 'CompanyA', 'CompanyB', 2, 'Pending', 'Need 5000 L bowser'),
(23, 13, 1000, 'CompanyA', 'CompanyC', 2, 'Pending', 'Requirement for bowser'),
(24, 13, 10000, 'CompanyA', 'CompanyD', 2, 'Pending', 'CompanyD need 10,000 bowser'),
(25, 14, 5000, 'CompanyA', 'CompanyE', 2, 'Pending', 'CompanyE needs bowser'),
(26, 13, 10000, 'CompanyA', 'CompanyD', 2, 'Pending', 'CompanyD needs bowser'),
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
(10000, 3),
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
(13, 15, 5, 'Broken tap', 'Completed', '2022-04-27 12:25:11', 5, 7, 2, 'Repair'),
(14, 1, 7, 'Loose fitting', 'Completed', '2022-04-19 18:14:38', 5, 2, 1, 'Repair'),
(15, 2, 7, 'Broken nozzel', 'Incomplete', '2022-04-19 18:11:02', 5, 3, 3, 'Repair'),
(19, 16, 7, 'Bowser requires service', 'Incomplete', '2022-04-19 18:15:29', 5, 2, 1, 'Service'),
(22, 10, 7, 'repair of bowser 10', 'Completed', '2022-04-19 18:14:12', 5, 2, 1, 'Repair');

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
(24, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:25:11', 2),
(25, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:25:14', 2),
(26, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:27:16', 2),
(27, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:39:54', 2),
(28, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:40:23', 2),
(29, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:42:41', 2),
(30, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:43:40', 2),
(31, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:45:13', 2),
(32, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:45:30', 2),
(33, 'On 2022-04-19 19:15:29&nbsp;&nbsp;Bowser: 16&nbsp;has undertaken a Service', 2, '2022-04-27 12:45:40', 2);

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
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reports`
--

INSERT INTO `tbl_reports` (`Report_ID`, `Report_Type`, `Bowser_ID`, `Description`, `User_ID`, `Date`, `Status`) VALUES
(4, 1, 10, 'bowser refill required', NULL, '2022-04-06 09:35:21', 'Pending'),
(5, 2, 102, '102 damaged', NULL, '2022-04-06 10:20:07', 'Actioned'),
(6, 3, 0, 'i am angry about bowsers', NULL, '2022-04-06 10:29:34', 'Actioned'),
(7, 1, 103, 'bowser needs refill', NULL, '2022-04-06 10:29:37', 'Actioned'),
(8, 2, 102, 'broken', NULL, '2022-04-06 10:29:40', 'Actioned'),
(9, 1, 100, 'this bowser needs refill', NULL, '2022-04-06 10:29:44', 'Actioned'),
(10, 2, 103, 'bowser looks damaged', NULL, '2022-04-06 10:29:47', 'Actioned'),
(11, 1, 102, 'refill', NULL, '2022-04-06 10:29:50', 'Actioned'),
(12, 2, 103, 'damaged', NULL, '2022-04-06 10:29:53', 'Actioned'),
(13, 1, 100, 'sort out refill', NULL, '2022-04-06 10:29:55', 'Actioned'),
(14, 1, 100, 'need refill', NULL, '2022-04-06 10:34:29', 'Actioned'),
(15, 2, 101, 'looks broken', NULL, '2022-04-06 10:34:31', 'Actioned'),
(16, 2, 103, 'dodgy tap', NULL, '2022-04-06 10:34:34', 'Actioned'),
(17, 1, 100, 'needs refill', NULL, '2022-04-06 10:34:36', 'Actioned'),
(18, 2, 103, 'broken', NULL, '2022-04-06 10:34:38', 'Actioned'),
(19, 2, 103, 'not working', NULL, '2022-04-06 10:34:40', 'Actioned'),
(20, 2, 2, 'broken tap', NULL, '2022-04-06 10:40:50', 'Actioned'),
(21, 2, 55, 'broken tap !!!', NULL, '2022-04-19 18:19:59', 'Actioned'),
(22, 1, 102, 'need refill immediately ', NULL, '2022-04-19 18:20:25', 'Pending'),
(23, 2, 10, 'damaged nozzle!!!', NULL, '2022-04-19 18:19:53', 'Pending'),
(24, 1, 10, 'refill the bowser !', NULL, '2022-04-19 18:19:41', 'Pending'),
(25, 2, 100, 'damaged - needs fixing!!!', NULL, '2022-04-19 18:19:35', 'Pending'),
(26, 2, 103, 'damage to the side of bowser', NULL, '2022-04-19 18:20:36', 'Pending');

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
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_bowser_requests`
--
ALTER TABLE `tbl_bowser_requests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_maintenance_schedule`
--
ALTER TABLE `tbl_maintenance_schedule`
  MODIFY `Maintenance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `Notice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `Report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'bowser_database.sql', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"tbl_area\",\"tbl_bowser_inuse\",\"tbl_bowser_onhire\",\"tbl_bowser_requests\",\"tbl_bowser_stock\",\"tbl_invoices\",\"tbl_maintenance_schedule\",\"tbl_reports\",\"tbl_report_type\",\"tbl_user_account\"],\"table_structure[]\":[\"tbl_area\",\"tbl_bowser_inuse\",\"tbl_bowser_onhire\",\"tbl_bowser_requests\",\"tbl_bowser_stock\",\"tbl_invoices\",\"tbl_maintenance_schedule\",\"tbl_reports\",\"tbl_report_type\",\"tbl_user_account\"],\"table_data[]\":[\"tbl_area\",\"tbl_bowser_inuse\",\"tbl_bowser_onhire\",\"tbl_bowser_requests\",\"tbl_bowser_stock\",\"tbl_invoices\",\"tbl_maintenance_schedule\",\"tbl_reports\",\"tbl_report_type\",\"tbl_user_account\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"bowser_database\",\"table\":\"tbl_area\"},{\"db\":\"bowser_database\",\"table\":\"tbl_maintenance_schedule\"},{\"db\":\"bowser_database\",\"table\":\"tbl_user_account\"},{\"db\":\"bowser_database\",\"table\":\"tbl_report_type\"},{\"db\":\"bowser_database\",\"table\":\"tbl_reports\"},{\"db\":\"bowser_database\",\"table\":\"tbl_bowser_invoices\"},{\"db\":\"bowser_database\",\"table\":\"tbl_notifications\"},{\"db\":\"bowser_database\",\"table\":\"tbl_bowser_inuse\"},{\"db\":\"bowser_database\",\"table\":\"tbl_bowser_requests\"},{\"db\":\"bowser_database\",\"table\":\"tbl_invoices\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2022-04-27 15:40:19', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

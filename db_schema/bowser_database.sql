/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.22-MariaDB : Database - bowser_database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bowser_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bowser_database`;


/*Table structure for table `tbl_user_account` */

DROP TABLE IF EXISTS `tbl_user_account`;

CREATE TABLE `tbl_user_account` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Type` varchar(100) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserLevel` varchar(100) NOT NULL,
  `IsVerified` tinyint(4) DEFAULT NULL,
  `Verification_Code` varchar(250) NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_area` */

DROP TABLE IF EXISTS `tbl_area`;

CREATE TABLE `tbl_area` (
  `Area_ID` int(11) NOT NULL,
  `Area_Mains_Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_bowser_inuse` */

DROP TABLE IF EXISTS `tbl_bowser_inuse`;

CREATE TABLE `tbl_bowser_inuse` (
  `Bowser_ID` int(11) NOT NULL,
  `Bowser_Longitude` float(10,6) DEFAULT NULL,
  `Bowser_Latitude` float(10,6) DEFAULT NULL,
  `Area_ID` int(11) NOT NULL,
  KEY `Bowser_ID` (`Bowser_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_bowser_onhire` */

DROP TABLE IF EXISTS `tbl_bowser_onhire`;

CREATE TABLE `tbl_bowser_onhire` (
  `Bowser_ID` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Hire_or_Loan` varchar(100) NOT NULL,
  `Invoice_Number` int(11) NOT NULL,
  KEY `Bowser_ID` (`Bowser_ID`),
  KEY `Invoice_Number` (`Invoice_Number`),
  KEY `Organisation_Name` (`Organisation_Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_bowser_requests` */

DROP TABLE IF EXISTS `tbl_bowser_requests`;

CREATE TABLE `tbl_bowser_requests` (
  `UserID` int(11) NOT NULL,
  `Organisation_Name` varchar(100) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Request_Reason` varchar(100) NOT NULL,
  KEY `UserID` (`UserID`),
  CONSTRAINT `tbl_Bowser_Requests_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `tbl_user_account` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_bowser_stock` */

DROP TABLE IF EXISTS `tbl_bowser_stock`;

CREATE TABLE `tbl_bowser_stock` (
  `Bowser_ID` int(11) NOT NULL,
  `Bowser_Capacity` int(11) NOT NULL,
  `Bowser_Status` varchar(100) NOT NULL,
  `Bowser_Model` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_invoices` */

DROP TABLE IF EXISTS `tbl_invoices`;

CREATE TABLE `tbl_invoices` (
  `Invoice_Number` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Invoice_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Invoice_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_maintenance_schedule` */

DROP TABLE IF EXISTS `tbl_maintenance_schedule`;

CREATE TABLE `tbl_maintenance_schedule` (
  `Bowser_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Report_Type_ID` varchar(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `Bowser_ID` (`Bowser_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tbl_report_type` */

DROP TABLE IF EXISTS `tbl_report_type`;

CREATE TABLE `tbl_report_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `is_bowser` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tbl_reports` */

DROP TABLE IF EXISTS `tbl_reports`;

CREATE TABLE `tbl_reports` (
  `Report_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Report_Type` int(11) DEFAULT NULL,
  `Bowser_ID` int(11) DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Report_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

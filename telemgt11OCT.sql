-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2017 at 08:36 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telemgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adname` varchar(20) NOT NULL,
  `adpassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adname`, `adpassword`) VALUES
('adminaura', 'admin'),
('admingau', 'admin'),
('adminmel', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `change_plan` int(11) DEFAULT NULL,
  `delete_flag` enum('True','False') NOT NULL DEFAULT 'False',
  `changeplan_flag` enum('True','False') NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `change_plan`, `delete_flag`, `changeplan_flag`) VALUES
(5, 'aura', NULL, 'False', 'False'),
(6, 'gau', NULL, 'False', 'False'),
(7, 'mel', NULL, 'False', 'False');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `month` enum('January','February','March','April','May','June','July','August','September','October','November','December') NOT NULL DEFAULT 'January',
  `year` year(4) NOT NULL,
  `plan` varchar(15) DEFAULT NULL,
  `charge` decimal(6,2) DEFAULT NULL,
  `status` enum('Paid','NotPaid') NOT NULL DEFAULT 'NotPaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `phone_no`, `month`, `year`, `plan`, `charge`, `status`) VALUES
(1, 1234567890, 'January', 2017, NULL, NULL, 'NotPaid'),
(48, 8407992629, 'October', 2017, '2', '67.70', 'NotPaid'),
(49, 8407992629, 'November', 2017, '2', '0.00', 'NotPaid'),
(50, 8407992629, 'December', 2017, '2', '0.00', 'NotPaid'),
(51, 8407992629, 'January', 2018, '2', '0.00', 'NotPaid'),
(52, 8407992629, 'February', 2018, '2', '0.00', 'NotPaid'),
(53, 8407992629, 'March', 2018, '2', '0.00', 'NotPaid'),
(54, 8407992629, 'April', 2018, '2', '0.00', 'NotPaid'),
(55, 8407992629, 'May', 2018, '2', '0.00', 'NotPaid'),
(56, 8407992629, 'June', 2018, '2', '0.00', 'NotPaid'),
(57, 8407992629, 'July', 2018, '2', '0.00', 'NotPaid'),
(58, 8407992629, 'August', 2018, '2', '0.00', 'NotPaid'),
(59, 8407992629, 'September', 2018, '2', '0.00', 'NotPaid'),
(60, 9765565465, 'October', 2017, '3', '31.66', 'NotPaid'),
(61, 9765565465, 'November', 2017, '3', '0.00', 'NotPaid'),
(62, 9765565465, 'December', 2017, '3', '0.00', 'NotPaid'),
(63, 9765565465, 'January', 2018, '3', '0.00', 'NotPaid'),
(64, 9765565465, 'February', 2018, '3', '0.00', 'NotPaid'),
(65, 9765565465, 'March', 2018, '3', '0.00', 'NotPaid'),
(66, 9765565465, 'April', 2018, '3', '0.00', 'NotPaid'),
(67, 9765565465, 'May', 2018, '3', '0.00', 'NotPaid'),
(68, 9765565465, 'June', 2018, '3', '0.00', 'NotPaid'),
(69, 9765565465, 'July', 2018, '3', '0.00', 'NotPaid'),
(70, 9765565465, 'August', 2018, '3', '0.00', 'NotPaid'),
(71, 9765565465, 'September', 2018, '3', '0.00', 'NotPaid'),
(72, 9763550420, 'October', 2017, '4', '139.27', 'NotPaid'),
(73, 9763550420, 'November', 2017, '4', '0.00', 'NotPaid'),
(74, 9763550420, 'December', 2017, '4', '0.00', 'NotPaid'),
(75, 9763550420, 'January', 2018, '4', '0.00', 'NotPaid'),
(76, 9763550420, 'February', 2018, '4', '0.00', 'NotPaid'),
(77, 9763550420, 'March', 2018, '4', '0.00', 'NotPaid'),
(78, 9763550420, 'April', 2018, '4', '0.00', 'NotPaid'),
(79, 9763550420, 'May', 2018, '4', '0.00', 'NotPaid'),
(80, 9763550420, 'June', 2018, '4', '0.00', 'NotPaid'),
(81, 9763550420, 'July', 2018, '4', '0.00', 'NotPaid'),
(82, 9763550420, 'August', 2018, '4', '0.00', 'NotPaid'),
(83, 9763550420, 'September', 2018, '4', '0.00', 'NotPaid');

-- --------------------------------------------------------

--
-- Table structure for table `calldetails`
--

CREATE TABLE `calldetails` (
  `call_id` int(11) NOT NULL,
  `fromnumber` bigint(10) NOT NULL,
  `tonumber` bigint(10) DEFAULT NULL,
  `billid` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `month` enum('January','February','March','April','May','June','July','August','September','October','November','December') NOT NULL DEFAULT 'January',
  `day` varchar(15) NOT NULL,
  `time` time NOT NULL,
  `duration` decimal(6,2) DEFAULT NULL,
  `costofcall` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calldetails`
--

INSERT INTO `calldetails` (`call_id`, `fromnumber`, `tonumber`, `billid`, `year`, `month`, `day`, `time`, `duration`, `costofcall`) VALUES
(27, 9765565465, 8407992629, 60, 2017, 'October', '11', '01:11:02', '6.33', '31.66'),
(28, 9763550420, 8407992629, 72, 2017, 'October', '11', '01:13:40', '13.51', '121.58'),
(29, 9763550420, 9765565465, 72, 2017, 'October', '11', '01:14:38', '1.97', '17.69'),
(30, 8407992629, 9763550420, 48, 2017, 'October', '11', '01:15:08', '19.71', '59.14'),
(31, 8407992629, 9765565465, 48, 2017, 'October', '11', '01:15:37', '2.85', '8.56'),
(32, 9765565465, 9763550420, 60, 2017, 'October', '11', '01:27:49', '18.27', '91.34'),
(33, 9763550420, 8407992629, 72, 2017, 'October', '11', '01:35:03', '17.74', '159.69'),
(34, 8407992629, 9763550420, 48, 2017, 'October', '11', '11:50:07', '17.00', '50.99');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `name` varchar(20) DEFAULT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `phone_no` bigint(10) NOT NULL,
  `plan_id` varchar(5) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `bill_address` varchar(50) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(15) DEFAULT NULL,
  `country` varchar(15) DEFAULT NULL,
  `status` enum('Exist','DoesnotExist') NOT NULL DEFAULT 'Exist'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`name`, `uname`, `password`, `phone_no`, `plan_id`, `email`, `dob`, `bill_address`, `city`, `state`, `country`, `status`) VALUES
('default', NULL, NULL, 1234567890, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DoesnotExist'),
('Valay Gundecha', 'aura', 'aura123', 8407992629, '2', 'valay.aura21@gmail.com', '1997-05-21', '393/B, Narayan Peth', 'Pune', 'Maharashtra', 'India', 'Exist'),
('Melvyn Binoy', 'mel', 'mel123', 9763550420, '4', 'melvyn.binoy@gmail.com', '1997-09-14', 'A-12, Amar Heights, Aundh Road', 'Pune', 'Maharashtra', 'India', 'Exist'),
('Gaurang Londhe', 'gau', 'gau123', 9765565465, '3', 'gaurya.05@gmail.com', '1997-01-23', 'Mahalaxminagar, Chaitraban near Lake Town', 'Pune', 'Maharashtra', 'India', 'Exist');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `insert_aduser` AFTER INSERT ON `customer` FOR EACH ROW BEGIN
INSERT INTO admin_users VALUES(NULL,new.uname,NULL,'False','False');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatelogin` AFTER UPDATE ON `customer` FOR EACH ROW BEGIN
update login
set username=new.uname,
password=new.password
where username=old.uname;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('aura', 'aura123'),
('gau', 'gau123'),
('mel', 'mel123');

--
-- Triggers `login`
--
DELIMITER $$
CREATE TRIGGER `delete_aduser` AFTER DELETE ON `login` FOR EACH ROW BEGIN
DELETE FROM admin_users WHERE username = old.username;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` varchar(5) NOT NULL,
  `name` varchar(15) DEFAULT NULL,
  `call_rate` decimal(5,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `name`, `call_rate`) VALUES
('1', 'Basic', '1.0'),
('2', 'Moderate', '3.0'),
('3', 'Advanced', '5.0'),
('4', 'Professional', '9.0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adname`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username foreign key` (`username`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_name foreign key` (`plan`),
  ADD KEY `phone_no forign key` (`phone_no`);

--
-- Indexes for table `calldetails`
--
ALTER TABLE `calldetails`
  ADD PRIMARY KEY (`call_id`),
  ADD KEY `bill foreign key` (`billid`),
  ADD KEY `phone_no foreign key` (`fromnumber`),
  ADD KEY `tonumber foreign key` (`tonumber`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`phone_no`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `myusername` (`username`),
  ADD UNIQUE KEY `mypassword` (`password`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `calldetails`
--
ALTER TABLE `calldetails`
  MODIFY `call_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD CONSTRAINT `username foreign key` FOREIGN KEY (`username`) REFERENCES `customer` (`uname`) ON UPDATE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `phone_no forign key` FOREIGN KEY (`phone_no`) REFERENCES `customer` (`phone_no`) ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_name foreign key` FOREIGN KEY (`plan`) REFERENCES `plan` (`plan_id`) ON UPDATE CASCADE;

--
-- Constraints for table `calldetails`
--
ALTER TABLE `calldetails`
  ADD CONSTRAINT `bill foreign key` FOREIGN KEY (`billid`) REFERENCES `bill` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `phone_no foreign key` FOREIGN KEY (`fromnumber`) REFERENCES `customer` (`phone_no`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tonumber foreign key` FOREIGN KEY (`tonumber`) REFERENCES `customer` (`phone_no`) ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`plan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

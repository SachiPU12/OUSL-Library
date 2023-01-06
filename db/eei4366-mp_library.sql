-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 09:24 AM
-- Server version: 5.7.17-log
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eei4366-mp_library`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `avgAllResources` ()  NO SQL
SELECT AVG(price)
FROM resources$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrowDetails` ()  NO SQL
BEGIN
	SELECT * FROM users_details;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `borrowISBN` ()  NO SQL
BEGIN
	SELECT * FROM borrow 
    WHERE returnDate BETWEEN '2021-10-1 00:00:00' AND '2021-10-31 00:00:00';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `famResource` ()  NO SQL
BEGIN
	SELECT MAX(name) FROM orders 
    WHERE orderDate BETWEEN '2021-10-1 00:00:00' AND '2021-10-31 00:00:00';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserDetails` (IN `adminId` INT)  NO SQL
BEGIN
    SELECT * FROM admins WHERE id = adminId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsersCounts` ()  NO SQL
BEGIN
    SELECT COUNT(id) AS Total_Admins FROM admins;
    SELECT COUNT(sId) AS Total_Students FROM students;
    SELECT COUNT(staffId) AS Total_Staff FROM staff;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `notBorrow` ()  NO SQL
BEGIN
	SELECT resources.name
	FROM resources
	LEFT JOIN borrow ON resources.rId = borrow.rId
	ORDER BY resources.name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `payMoney` (IN `userId` INT)  NO SQL
BEGIN
	SELECT 10 * noOfDays + return_res.price * users_details.payBookPrice
    FROM users_details, return_res
    WHERE users_details.userId = userId;
    
    SELECT return_res.price * users_details.payBookPrice
    FROM users_details, return_res
    WHERE users_details.userId = userId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `specificBorrow` (IN `memberId` INT)  NO SQL
BEGIN
    SELECT borrow.memName FROM borrow WHERE borrow.memId = memberId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `totalFine` ()  NO SQL
BEGIN
	SELECT * FROM return_res 
    WHERE returnDate BETWEEN '2021-10-1 00:00:00' AND '2021-10-31 00:00:00';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `gender`, `address`, `phone`, `email`, `password`) VALUES
(1, 'Jone', 'harward', 'F', 'Lacknow', 114567892, 'jone@gmail.com', 'jone'),
(2, 'Kamal', 'Nelson', 'M', 'Haputhale', 674532789, 'kamal@gmail.com', 'kamal'),
(3, 'Namal', 'Gamlath', 'F', 'Dehiwala', 674523789, 'namal@gmail.com', 'namal'),
(4, 'Amal', 'Khan', 'M', 'Kadhana', 562346783, 'amal@gmail.com', 'amal'),
(5, 'Sudha', 'Krishnan', 'F', 'Jaffna', 645623765, 'sudha@gmail.com', 'sudha');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borId` int(11) NOT NULL,
  `rId` int(11) NOT NULL,
  `memId` int(11) NOT NULL,
  `memName` varchar(50) NOT NULL,
  `position` varchar(25) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `borDate` date NOT NULL,
  `returnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borId`, `rId`, `memId`, `memName`, `position`, `isbn`, `borDate`, `returnDate`) VALUES
(2, 1, 3, 'Hemal Geganage', 'staff', '451-kio-456', '2021-08-28', '2021-10-30'),
(200, 5, 634567098, 'Kasun Desilva', 'student', '457-bvc-890', '2021-10-03', '2021-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `resId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `orderDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `resId`, `name`, `isbn`, `orderDate`) VALUES
(1, 3, 'Home cooking', '341-bnm-690', '2021-10-10'),
(2, 2, 'English Grammer', '765-hnj-234', '2021-10-06'),
(3, 3, 'Home cooking', '341-bnm-690', '2021-10-20'),
(4, 3, 'Home cooking', '341-bnm-690', '2021-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `rId` int(10) NOT NULL,
  `categary` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `isbn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`rId`, `categary`, `name`, `subject`, `price`, `isbn`) VALUES
(1, 'Books', 'Ama wathura', 'Buddhisam', 1050, '124-vbn-456'),
(2, 'Books', 'English Grammer', 'English', 150, '765-hnj-234'),
(3, 'Journals', 'Home cooking', 'Science', 150, '341-bnm-690'),
(4, 'Journals', 'Nuga Sewana', 'Science', 600, '123-poi-367'),
(5, 'Books', 'Madol Duwa', 'Sinhala Story', 180, '347-thd-098'),
(7, 'Course materials', 'Software II', 'Engineering', 1050, '234-ghj-347'),
(8, 'Books', 'Poems', 'English', 1010, '567-sdf-234'),
(9, 'Course materials', 'Python Basics', 'Engineering', 340, '234-yhj-590'),
(10, 'Books', 'Nova', 'English Story', 260, '123-edf-368');

-- --------------------------------------------------------

--
-- Table structure for table `return_res`
--

CREATE TABLE `return_res` (
  `returnId` int(11) NOT NULL,
  `borId` int(11) NOT NULL,
  `rId` int(11) NOT NULL,
  `memId` int(11) NOT NULL,
  `memName` varchar(50) NOT NULL,
  `position` varchar(25) NOT NULL,
  `returnDate` date NOT NULL,
  `price` int(10) NOT NULL,
  `fineMoney` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `return_res`
--

INSERT INTO `return_res` (`returnId`, `borId`, `rId`, `memId`, `memName`, `position`, `returnDate`, `price`, `fineMoney`) VALUES
(1, 10, 15, 345672345, 'Kamal Perera', 'student', '2021-10-13', 1000, 420),
(2, 5, 28, 2, 'Sachini Waduge', 'staff', '2021-10-17', 250, 100);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` varchar(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `depart` varchar(20) NOT NULL,
  `phone` int(9) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `fname`, `lname`, `gender`, `address`, `depart`, `phone`, `email`) VALUES
('1', 'Kamala', 'Perera', 'F', 'Kahathuduwa', 'Electrical', 348712345, 'kamala@gmail.com'),
('2', 'Sachini', 'Waduge', 'F', 'Mahara', 'Finance', 450456784, 'sachi@gmail.com'),
('3', 'Hemal', 'Geganage', 'M', 'Kaduwela', 'Civil', 346723450, 'hemal@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sId` varchar(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `regNum` int(9) NOT NULL,
  `gender` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `degree` varchar(40) NOT NULL,
  `phone` int(9) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sId`, `fname`, `lname`, `regNum`, `gender`, `address`, `degree`, `phone`, `email`) VALUES
('1', 'Kamal', 'Perera', 345672345, 'M', 'Mathale', 'undergraduate', 782345678, 'kamal@gmail.com'),
('2', 'Sachi', 'Perera', 562345086, 'F', 'Mathara', 'masters', 306743459, 'sachi@gmail.com'),
('3', 'Sudath', 'Perera', 560345762, 'M', 'Padukka', 'undergraduate', 423323456, 'sudath@gmail.com'),
('4', 'Kavidu', 'Mahawaththa', 456981345, 'M', 'Mirigama', 'Masters', 567123678, 'kavidu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `userId` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `noOfResources` int(11) NOT NULL,
  `noOfDays` int(11) NOT NULL,
  `payBookPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`userId`, `user`, `noOfResources`, `noOfDays`, `payBookPrice`) VALUES
(1, 'admin', 5, 90, 1),
(2, 'staff', 5, 90, 1),
(3, 'student', 3, 14, 0.05);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`rId`);

--
-- Indexes for table `return_res`
--
ALTER TABLE `return_res`
  ADD PRIMARY KEY (`returnId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sId`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

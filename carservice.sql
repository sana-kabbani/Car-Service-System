-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 11:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
CREATE DATABASE `carservice`;
USE `carservice`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'sa990324@gmail.com', '$2y$10$xTCGDpvhiIxdy0/HoW6Ng.Y2q32vI00CLrIVmU'),
(2, 'nazir@gmail.com', '$2y$10$DClaoU2alshxERfx2RaHGecG7ppS1LUw/ZT/vb'),
(3, 'test@gmail.com', '$2y$10$zbcRXaCEzoQKkyd8Nr1mYO6lwcQRinYddV6Xog'),
(4, 't@gmail.com', '12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_spending`
-- (See below for the actual view)
--
CREATE TABLE `customer_spending` (
`customer_id` int(11)
,`customer_name` varchar(45)
,`Email` varchar(45)
,`Phone` int(11)
,`total_spending` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `Model_id` int(11) NOT NULL,
  `Brand` varchar(45) NOT NULL,
  `ModelName` varchar(45) NOT NULL,
  `Year` year(4) NOT NULL,
  `KM` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`Model_id`, `Brand`, `ModelName`, `Year`, `KM`) VALUES
(3, 'Mercedes', 'Merc-2019', '2019', 120),
(7, 'Ford', 'Mustang', '1945', 7854);

-- --------------------------------------------------------

--
-- Table structure for table `musteri`
--

CREATE TABLE `musteri` (
  `Customer_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Phone` int(11) NOT NULL,
  `City` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `musteri`
--

INSERT INTO `musteri` (`Customer_id`, `Name`, `Email`, `Phone`, `City`) VALUES
(9, 'Sana kabbani', 'sa990324@gmail.com', 2147483647, 'İZMİT'),
(10, 'test', 'test@gmail.com', 5363454, 'Şehitkamil');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CarModelID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(45) NOT NULL,
  `TotalAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `CarModelID`, `ServiceID`, `OrderDate`, `order_status`, `TotalAmount`) VALUES
(20, 9, 3, 5, '2024-05-04 23:05:33', 'Order Taken', 564),
(21, 9, 3, 5, '2024-05-04 23:59:39', 'Order Taken', 564),
(22, 9, 7, 6, '2024-05-04 23:59:50', 'Order Taken', 340),
(23, 10, 3, 5, '2024-05-05 00:03:59', 'Order Taken', 564);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `order_price` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
    DECLARE price DECIMAL(10, 2);
    
    -- Get the price of the service for the current order
    SELECT s.Price INTO price
    FROM services s
    WHERE s.serviceID = NEW.serviceID;
    
    -- Set the total amount of the order to the price of the service
    SET NEW.TotalAmount = price;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(45) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `ServiceName`, `Description`, `Price`) VALUES
(5, 'Gas', '1', 564),
(6, 'Oil Change', 'Test Description', 340);

-- --------------------------------------------------------

--
-- Structure for view `customer_spending`
--
DROP TABLE IF EXISTS `customer_spending`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_spending`  AS SELECT `c`.`Customer_id` AS `customer_id`, `c`.`Name` AS `customer_name`, `c`.`Email` AS `Email`, `c`.`Phone` AS `Phone`, coalesce(sum(`o`.`TotalAmount`),0) AS `total_spending` FROM (`musteri` `c` left join `orders` `o` on(`c`.`Customer_id` = `o`.`CustomerID`)) GROUP BY `c`.`Customer_id`, `c`.`Name`, `c`.`Email`, `c`.`Phone` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`Model_id`);

--
-- Indexes for table `musteri`
--
ALTER TABLE `musteri`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `costumer` (`CustomerID`),
  ADD KEY `model` (`CarModelID`),
  ADD KEY `service` (`ServiceID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `Model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `musteri`
--
ALTER TABLE `musteri`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `costumer` FOREIGN KEY (`CustomerID`) REFERENCES `musteri` (`Customer_id`),
  ADD CONSTRAINT `model` FOREIGN KEY (`CarModelID`) REFERENCES `models` (`Model_id`),
  ADD CONSTRAINT `service` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

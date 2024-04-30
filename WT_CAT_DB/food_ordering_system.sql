-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 02:24 PM
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
-- Database: `food_ordering_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `martial_status` varchar(40) NOT NULL,
  `DoB` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(12) NOT NULL,
  `name` varchar(59) NOT NULL,
  `address` varchar(34) NOT NULL,
  `phone` int(67) NOT NULL,
  `Email` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `phone`, `Email`) VALUES
(2, 'kamanzi', 'kigali', 78999, 'kk@gmail.c'),
(3, 'gentille', 'rubavu', 78543322, 'genti@gmai'),
(6, 'gentille', 'gggg', 99999, 'bhh@gmail.');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `price` int(30) NOT NULL,
  `availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `price`, `availability`) VALUES
(15, 9000, 'juice'),
(8, 5000, 'food'),
(1, 5000, 'food and drinks'),
(9, 3000, 'drinks'),
(11, 12000, 'water');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `quantity` int(50) NOT NULL,
  `item` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `quantity`, `item`) VALUES
(23, 34, 'sdc'),
(889, 34, 'bnm'),
(7, 8, 'vbbnn'),
(78, 5, 'food'),
(33, 3, 'food and drinks');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(30) NOT NULL,
  `date` date NOT NULL,
  `amaunt` int(50) NOT NULL,
  `method` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `date`, `amaunt`, `method`) VALUES
(5, '2024-04-29', 9000, 'check'),
(70, '2024-04-29', 7000, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` int(30) NOT NULL,
  `number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`, `number`) VALUES
(16, 'umucyo', 134, 10),
(12, 'ange', 12, 123),
(444, 'Umucyo', 0, 7),
(89, 'Visit Rwanda', 0, 1),
(7, 'teste', 0, 25),
(8, 'solution', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telefone` int(50) NOT NULL,
  `activation_code` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `email`, `username`, `password`, `telefone`, `activation_code`) VALUES
('gentille', 'Ndatimana', 'ndatimanagentille@gmail.com', 'sdffg@df', '$2y$10$2UkEvxGFY.Uz8NRtTXmNVe.ubYL6Ta.m.R841TKexXg', 782663366, 34),
('gentille', 'Ndatimana', 'ndatimanagentille@gmail.com', 'ndatimana', '$2y$10$ES3.b4TrYUzo04o/Q5atK.fzNcnxVLK6E7HbsbTXr.a', 782663366, 34),
('gentille', 'Ndatimana', 'ndatimanagentille@gmail.com', 'ndatimana', '$2y$10$7aAC1ZwiuoozVMm/0o6UIeNsqPhP/8Y1fYpD5ErpqgQ', 782663366, 34),
('gentille', 'Ndatimana', 'ndatimanagentille@gmail.com', 'ndatimana', '$2y$10$62gCVAy6Ac3tIzuwBYPtcu4.ne7Oy.Sq48xffjDU9ds', 782663366, 34),
('GAD', 'KEVIN', 'gentille222007958@gmail.com', 'ndatimanagentille@gmail.com', '$2y$10$ajsxxolUL3pS0DUaRTZxb.f0oHZegw.kouOmLGLV.XT', 7856778, 666),
('anne', 'uwizeye', 'anne@gmail.com', 'aaa', '$2y$10$kLwqVDxMg0hCCrhSzxZIduxKRD4DDjCjvro65CP74T5', 7856421, 50),
('gentille', 'ndatimana', 'ndatimanagentille@gmail.com', 'gentille', '$2y$10$QrsOHY85rJrP0z3K.DaWCukKvYfZrCHHTMNl5zlxfhz', 2147483647, 45),
('', '', '', '', '', 0, 0),
('ndatimana', 'gentille', 'ndatimanagentille@gmail.com', 'gentille', '222007958', 789999, 45),
('fidele', 'uwimana', 'fuwimana@gmail.com', 'fidele', '123', 3445, 100),
('kjuygfghjuygf', 'fghjgjkh', 'sdffg@df', 'fffff', 'mmmmm', 12345, 1),
('sam', 'niyo', 'samniyo@gmail.com', 'niyo', '1234', 789654, 67),
('anna', 'uwera', 'anna@gmail.com', 'UweraAnna', '123', 78990000, 444);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

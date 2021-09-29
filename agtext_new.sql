-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2017 at 05:15 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agtext`
--

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(50) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `name`, `date`) VALUES
(1, 'Red - &#2970;&#3007;&#2997;&#2986;&#3021;&#2986;&#3009;(6)', '1492351454'),
(2, 'Black - &#2965;&#2992;&#3009;&#2986;&#3021;&#2986;&#3009;', '1492351633'),
(3, 'Brown - &#2965;&#3006;&#2986;&#3021;&#2986;&#3007;', '1492351754'),
(4, 'White - &#2997;&#3014;&#2995;&#3021;&#2995;&#3016;', '1492351781'),
(5, 'Yellow - &#2990;&#2974;&#3021;&#2970;&#2995;&#3021;', '1492351809');

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`id`, `name`, `date`) VALUES
(1, '54 - Checked', '1492352724'),
(2, '48 - Checked', '1492352733'),
(3, '40 - Checked', '1492352744'),
(4, '54 - Lalbag', '1492352757');

-- --------------------------------------------------------

--
-- Table structure for table `paavudetails`
--

CREATE TABLE `paavudetails` (
  `id` int(11) NOT NULL,
  `paavuid` int(11) NOT NULL,
  `carry_paavuid` int(10) NOT NULL,
  `kg` double NOT NULL,
  `color` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `printno` int(20) NOT NULL,
  `threadid` int(20) NOT NULL,
  `yarnprintno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paavudetails`
--

INSERT INTO `paavudetails` (`id`, `paavuid`, `carry_paavuid`, `kg`, `color`, `date`, `printno`, `threadid`, `yarnprintno`) VALUES
(1, 1, 0, 120, 1, '1492352816', 1, 0, 0),
(2, 1, 0, 120, 4, '1492353156', 1, 4, 0),
(3, 2, 0, 100, 1, '1492354515', 1, 0, 0),
(4, 3, 0, 100, 1, '1492355213', 2, 0, 0),
(5, 3, 0, 120, 2, '1492355221', 2, 0, 0),
(6, 4, 3, 99.7, 0, '1492355331', 0, 0, 0),
(7, 4, 0, 500, 1, '1492355608', 3, 5, 0),
(8, 4, 0, 20, 5, '1492355728', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `paavus`
--

CREATE TABLE `paavus` (
  `id` int(50) NOT NULL,
  `paavuno` int(20) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userid` int(50) NOT NULL,
  `price` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` int(10) NOT NULL,
  `statusupdate` varchar(50) NOT NULL,
  `carry_paavuid` int(20) NOT NULL,
  `closeamount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paavus`
--

INSERT INTO `paavus` (`id`, `paavuno`, `name`, `userid`, `price`, `date`, `color`, `status`, `statusupdate`, `carry_paavuid`, `closeamount`) VALUES
(1, 1, '2', 1, 5, '2017-04-16 14:26:30', 'Blue', 1, 'close', 0, -70),
(2, 2, '1', 1, 7, '2017-04-16 14:55:01', 'Blue', 1, 'close', 0, -85),
(3, 1, '4', 2, 8, '2017-04-16 15:05:45', 'Blue', 1, 'carryforward', 4, 0),
(4, 2, '1', 2, 8, '2017-04-16 15:08:24', 'Red - &#2970;&#3007;&#2997;&#2986;&#3021;&#2986;&#', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `returnpavudetails`
--

CREATE TABLE `returnpavudetails` (
  `id` int(10) NOT NULL,
  `paavuid` int(10) NOT NULL,
  `carry_paavuid` int(10) NOT NULL,
  `roles` varchar(223) NOT NULL,
  `weight` double NOT NULL,
  `meter` double NOT NULL,
  `amount` double NOT NULL,
  `date` varchar(50) NOT NULL,
  `design` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returnpavudetails`
--

INSERT INTO `returnpavudetails` (`id`, `paavuid`, `carry_paavuid`, `roles`, `weight`, `meter`, `amount`, `date`, `design`) VALUES
(1, 1, 0, '12', 120, 360, 7, '1492034400', 4),
(2, 1, 0, '12', 85.5, 378.5, 6.25, '1491861600', 2),
(3, 2, 0, '10', 90, 300, 6.25, '1491861600', 1),
(4, 3, 0, '15', 120.3, 410.8, 7, '1491948000', 4),
(5, 1, 0, '12', 20, 5, 20, '1492725600', 1);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(50) NOT NULL,
  `threadno` int(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `kg` int(50) NOT NULL,
  `price` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `color` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `count` int(20) NOT NULL,
  `yarn` int(10) NOT NULL,
  `yarnprintno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `threadno`, `date`, `kg`, `price`, `color`, `count`, `yarn`, `yarnprintno`) VALUES
(1, 12255, '1491775200', 400, '85', '2', 0, 1, 0),
(2, 1212, '1492293600', 450, '69', '1', 0, 2, 0),
(3, 45221, '1491775200', 500, '85', '5', 0, 3, 0),
(5, 12, '1492293600', 370, '34', '1', 0, 1, 2),
(6, 0, '', 0, '', '1', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `paavudetailid` int(11) NOT NULL,
  `amount` double NOT NULL,
  `paavu_amount` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `voucherid` int(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `userid`, `paavudetailid`, `amount`, `paavu_amount`, `type`, `voucherid`, `date`) VALUES
(6, 1, 1, 0, 2520, '', 0, '1492353993'),
(7, 1, 2, 0, 2365.625, '', 0, '1492354135'),
(8, 1, 1, 0, -70, '', 0, '1492354158'),
(9, 1, 3, 0, 1875, '', 0, '1492354543'),
(10, 1, 2, 0, -85, '', 0, '1492354564'),
(11, 1, 0, 5000, 0, '', 1, '1492354736'),
(12, 2, 4, 0, 2875.6, '', 0, '1492355281'),
(13, 1, 0, 2000, 0, '', 2, '1492355385'),
(14, 1, 5, 0, 100, '', 0, '1492746071');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `emailid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mobileno` varchar(50) NOT NULL,
  `address` varchar(150) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `date` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `emailid`, `mobileno`, `address`, `date`) VALUES
(1, 'Dhayan Tex', '', '9898269590', 'Povai', '1492352690'),
(2, 'karthik tex', '', '99822222222', 'povai', '1492355128');

-- --------------------------------------------------------

--
-- Table structure for table `yarns`
--

CREATE TABLE `yarns` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yarns`
--

INSERT INTO `yarns` (`id`, `name`, `address`, `date`) VALUES
(1, 'PSG Yarns', 'Karur', '1492351831'),
(2, 'Lotus Agency', 'Karur', '1492351842'),
(3, 'GSS Yarns', 'Karur', '1492351854');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paavudetails`
--
ALTER TABLE `paavudetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paavus`
--
ALTER TABLE `paavus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returnpavudetails`
--
ALTER TABLE `returnpavudetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yarns`
--
ALTER TABLE `yarns`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `paavudetails`
--
ALTER TABLE `paavudetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `paavus`
--
ALTER TABLE `paavus`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `returnpavudetails`
--
ALTER TABLE `returnpavudetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `yarns`
--
ALTER TABLE `yarns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

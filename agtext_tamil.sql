-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 07:05 PM
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
(1, '10-Red-&#2970;&#3007;&#2997;&#2986;&#3021;&#2986;&#3009;', '1496334580'),
(2, '10-R Blue-R &#2986;&#3009;&#2995;&#3009;', '1496335755'),
(3, '10-T Blue-T &#2986;&#3009;&#2995;&#3009;', '1496335795'),
(4, '10-N Blue-N &#2986;&#3009;&#2995;&#3009;', '1496335817'),
(5, '10-Maroon-&#2990;&#2992;&#3010;&#2985;&#3021;', '1496335923'),
(6, '10-Lemon Yellow-L &#2990;&#2974;&#3021;&#2970;&#2995;&#3021;', '1496335988'),
(7, '10-White-&#2970;&#2994;&#2997;&#3016;', '1496336058'),
(8, '10-Black-&#2965;&#2992;&#3009;&#2986;&#3021;&#2986;&#3009;', '1496336097'),
(9, '10-Golden Yellow-G &#2990;&#2974;&#3021;&#2970;&#2995;&#3021;', '1496336137'),
(10, '10-coppie-&#2965;&#3006;&#2986;&#3021;&#2986;&#3007;', '1496336193'),
(11, '10 Lemon Orange-L &#2950;&#2992;&#2974;&#3021;&#2970;&#3009;', '1496336238'),
(12, '10-Green-&#2986;&#2970;&#3021;&#2970;&#3016;', '1496336291'),
(13, '6-White-&#2970;&#2994;&#2997;&#3016;', '1496336345'),
(14, '6-Black-&#2965;&#2992;&#3009;&#2986;&#3021;&#2986;&#3009;', '1496336382'),
(15, '6-Red-&#2970;&#3007;&#2997;&#2986;&#3021;&#2986;&#3009;', '1496336430'),
(16, '6-Maroon-&#2990;&#2992;&#3010;&#2985;&#3021;', '1496336479'),
(17, '6-Coppie-&#2965;&#3006;&#2986;&#3021;&#2986;&#3007;', '1496336530'),
(18, '6-Green-&#2986;&#2970;&#3021;&#2970;&#3016;', '1496336560'),
(19, '6-R Blue-R &#2986;&#3009;&#2995;&#3009;', '1496336615'),
(20, '150-Poly Black', '1496336643');

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
(1, '40-Checked', '1496333201'),
(2, '48-Checked', '1496333236'),
(3, '54-Checked', '1496333261'),
(4, '56-Checked', '1496333329'),
(5, '48-Lalbag Jacd', '1496333433'),
(6, '54-Lalbag Jacd', '1496333478'),
(7, '60-Lalbag Jacd', '1496333551'),
(8, '63-Lalbag Jacd', '1496333575'),
(9, '74-Lalbag Jacd', '1496333625'),
(10, '48-Kamal Jacd', '1496333671'),
(11, '54-Kamal Jacd', '1496333696'),
(12, '63-Kamal Jacd', '1496333720'),
(13, '60-Sixer Jacd', '1496333740'),
(14, '63-Sixer Jacd', '1496333856'),
(15, '56-Omega Jacd', '1496333889'),
(16, '54-Reliance', '1496333914'),
(17, '90-Poly Mini Check', '1496333947');

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
(1, 1, '3', 1, 6, '2017-06-01 16:33:23', 'Blue', 0, '', 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(50) NOT NULL,
  `threadno` int(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `kg` double NOT NULL,
  `price` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `color` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `count` int(20) NOT NULL,
  `yarn` int(10) NOT NULL,
  `yarnprintno` int(20) NOT NULL,
  `outsideyarn` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'TMS Tex', '', '9442781020', 'Gurusamipalayam', '1496331572'),
(2, 'Mohan Tex', '', '7502113844', 'Gurusamipalayam\r\n', '1496331610'),
(3, 'Vimala Tex', '', '9095290418', 'Gurusamipalayam\r\n', '1496331625'),
(4, 'Kavitha Tex', '', '9715749034', 'Gurusamipalayam\r\n', '1496331641'),
(5, 'Saravanan Tex', '', '9578950635', 'Gurusamipalayam\r\n', '1496331699'),
(6, 'Selvi Tex', '', '9894628531', 'Gurusamipalayam\r\n', '1496331777'),
(7, 'Kandasamy Tex', '', '9842202170', 'Gurusamipalayam\r\n', '1496331848'),
(8, 'Hariharan Tex', '', '1', 'Gurusamipalayam\r\n', '1496331934'),
(9, 'Shanthi Tex', '', '9976109024', 'Gurusamipalayam\r\n', '1496331973'),
(10, 'Annamar Tex', '', '8190029090', 'Thoppampatti\r\n', '1496332011'),
(11, 'Deepika Tex', '', '9976399926', 'Naranavalasu\r\n', '1496332044'),
(12, 'Rathi Tex', '', '9003324084', 'Ellamedu\r\n', '1496332240'),
(13, 'Ponnachiamman Tex', '', '9445490765', 'Mettur\r\n', '1496332281'),
(14, 'Kavin Tex', '', '9944765356', 'Maylirangam\r\n', '1496332311'),
(15, 'Kandiamman Tex', '', '0', 'Orathupalayam\r\n', '1496332338'),
(16, 'PRT Tex', '', '9715146866', 'Perumalpalayam\r\n', '1496332380'),
(17, 'Priya Tex', '', '9629433693', 'Vellakovil\r\n', '1496332431'),
(18, 'Theivam Tex', '', '9865667688', 'Vellakovil\r\n', '1496332458'),
(19, 'SenthilMurugan Tex', '', '9750890334', 'Kidaikarampalayam\r\n', '1496332485'),
(20, 'Palanivel Tex', '', '9443757425', 'Meenachivalasu\r\n', '1496332531'),
(21, 'S.P Tex', '', '9442596923', 'Meenachivalasu\r\n', '1496332561'),
(22, 'Laxshmi Tex', '', '8344850279', 'Vellakovil\r\n', '1496332592'),
(23, 'Nithya Tex', '', '9952866499', 'Servakaranpalayam\r\n', '1496332619'),
(24, 'Karuppusamy Tex', '', '9786808631', 'Kidaikaranpalayam\r\n', '1496332655'),
(25, 'M.M Tex', '', '9629690026', 'Vellakovil\r\n', '1496332683'),
(26, 'Annoramman Tex', '', '9865019473', 'Vellakovil\r\n', '1496332712'),
(27, 'Venkateshwara Tex', '', '9789460122', 'Vellakovil\r\n', '1496332748'),
(28, 'Sivaranjini Tex', '', '9865485126', 'Vellakovil\r\n', '1496332777'),
(29, 'Moorthy Tex', '', '9865183121', 'Vellakovil\r\n\r\n\r\n', '1496332847'),
(30, 'Aandavar Tex', '', '9715283403', 'Vellakovil\r\n', '1496332875'),
(31, 'Annai Tex', '', '9489813351', 'Servakaranpalayam\r\n', '1496332905'),
(32, 'Mathi Tex', '', '8098735151', 'Athipalayam pudur\r\n', '1496332952'),
(33, 'Gopinath', '', '9751004006', 'Molapalayam\r\n', '1496332986'),
(34, 'P.Kumar Tex', '', '9442208586', 'Gurusamipalayam\r\n', '1496333022');

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
(1, 'Lotus Agency', 'Karur', '1496334369'),
(2, 'P.S.G Yarn Traders', 'Karur', '1496334384'),
(3, 'SPR Yarn Agenncy', 'Vellakovil', '1496334418'),
(4, 'Sri Pillayaar Tex', 'Tirupur', '1496334442'),
(5, 'Mehra Poly Tex India Pvt Ltd', 'Silvassa', '1496334473'),
(6, 'Wellknown polysters Ltd', 'Daman', '1496334497'),
(7, 'Thilaga Traders', 'Karur', '1496334512'),
(8, 'Aathika Traders', 'Karur', '1496334526'),
(9, 'New Star Spinning Mill', 'Vellakovil', '1496334548');

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `paavudetails`
--
ALTER TABLE `paavudetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paavus`
--
ALTER TABLE `paavus`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `returnpavudetails`
--
ALTER TABLE `returnpavudetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `yarns`
--
ALTER TABLE `yarns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

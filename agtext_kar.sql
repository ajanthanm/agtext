-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 03:25 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
(1, '10-Red-à®šà®¿à®µà®ªà¯à®ªà¯', '1496312315'),
(2, '10-R Blue-R à®ªà¯à®³à¯', '1496312915'),
(3, '10-T Blue-T à®ªà¯à®³à¯', '1496312983'),
(4, '10-Maroon-à®®à®°à¯‚à®©à¯', '1496313144'),
(5, '10-Lemon Yellow-L à®®à®žà¯à®šà®³à¯', '1496313258'),
(6, '10-N Blue-N à®ªà¯à®³à¯', '1496313317'),
(7, '10-White-à®šà®²à®µà¯ˆ', '1496313403'),
(8, '10-Black-à®•à®°à¯à®ªà¯à®ªà¯', '1496313489'),
(9, '10-Golden yellow -G à®®à®žà¯à®šà®³à¯', '1496313534'),
(10, '10-Coppie-à®•à®¾à®ªà¯à®ªà®¿', '1496313803'),
(11, '10-Lemon Orange-L à®†à®°à®žà¯à®šà¯', '1496313969'),
(12, '10-Green-à®ªà®šà¯à®šà¯ˆ', '1496314175'),
(13, '6-White-à®šà®²à®µà¯ˆ', '1496314334'),
(14, '6-Black-à®•à®°à¯à®ªà¯à®ªà¯', '1496314371'),
(15, '6-Red-à®šà®¿à®µà®ªà¯à®ªà¯', '1496314436'),
(16, '6-Maroon-à®®à®°à¯‚à®©à¯', '1496314513'),
(17, '6-Coppie-à®•à®¾à®ªà¯à®ªà®¿', '1496314536'),
(18, '6-Green-à®ªà®šà¯à®šà¯ˆ', '1496314604'),
(19, '6-R Blue-R à®ªà¯à®³à¯', '1496314681'),
(20, '150-Poly Black', '1496314875'),
(21, '150-Poly Grey', '1496314898'),
(22, '150-Poly Maroon', '1496314917'),
(23, '150-Poly R Blue', '1496314932'),
(24, '150-Poly Red', '1496314981'),
(25, '150-Poly Coppie', '1496315001'),
(26, '150-Poly Sammanki', '1496315058'),
(27, '300-Poly Red', '1496315113'),
(28, '300-Poly S Blue', '1496315127'),
(29, '300-Poly N Brown', '1496315151'),
(30, '300-Poly Gold', '1496315163'),
(31, '300-Poly Green', '1496315174'),
(32, '300-Poly Maroon', '1496315192'),
(33, 'Transfer', '1496322975');

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
(1, '40-Checked', '1496311730'),
(2, '48-Checked', '1496311737'),
(3, '54-Checked', '1496311743'),
(4, '56-Checked', '1496311762'),
(5, '48-Lalbag Jacd', '1496311797'),
(6, '54-Lalbag Jacd', '1496311824'),
(7, '60-Lalbag Jacd', '1496311836'),
(8, '63-Lalbag Jacd', '1496311845'),
(9, '74-Lalbag Jacd', '1496311853'),
(10, '48-Kamal Jacd', '1496311879'),
(11, '54-Kamal Jacd', '1496311891'),
(12, '63-Kamal Jacd', '1496311905'),
(13, '60-Sixer Jacd', '1496311939'),
(14, '63-Sixer Jacd', '1496311948'),
(15, '56-Omega Jacd', '1496311984'),
(16, '54-Reliance', '1496312013'),
(17, '90-Poly Mini Check', '1496312037');

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
(1, 1, 0, 0.1, 33, '1496323097', 0, 0, 0),
(2, 2, 0, 1234.2, 33, '1496323227', 0, 3, 0);

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
(1, 1, '3', 7, 7, '2017-06-01 13:16:59', 'Blue', 1, 'close', 0, -5362),
(2, 2, '3', 7, 7, '2017-06-01 13:19:16', 'Blue', 0, '', 0, 0),
(3, 1, '3', 9, 7, '2017-06-01 13:21:30', 'blue', 0, '', 0, 0);

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

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `threadno`, `date`, `kg`, `price`, `color`, `count`, `yarn`, `yarnprintno`, `outsideyarn`) VALUES
(1, 0, '1496323050', 0.1, '0', '33', 0, 10, 1, 1),
(2, 0, '1496323186', 869.7, '', '33', 0, 10, 0, 0),
(3, 0, '1496323227', 364.5, '', '33', 0, 10, 0, 0);

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
(1, 7, 1, 0, -5362, '', 0, '1496323140');

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
(1, 'TMS Tex', '', '9442781020', 'Gurusamipalayam', '1496305937'),
(2, 'Mohan Tex', '', '7502113844', 'Gurusamipalayam', '1496306010'),
(3, 'Vimala Tex', '', '9095290418', 'Gurusamipalayam', '1496306052'),
(4, 'Kavitha Tex', '', '9715749034', 'Gurusamipalayam', '1496306247'),
(5, 'Saravanan Tex', '', '9578950635', 'Gurusamipalayam', '1496306312'),
(6, 'Selvi Tex', '', '9894628531', 'Gurusamipalayam', '1496306372'),
(7, 'Kandasamy Tex', '', '9842202170', 'Gurusamipalayam', '1496306439'),
(8, 'Hariharan Tex', '', '1', 'Gurusamipalayam', '1496306510'),
(9, 'Shanthi Tex', '', '9976109024', 'Gurusamipalayam', '1496306626'),
(10, 'Annamar Tex', '', '8190029090', 'Thoppampatti', '1496309694'),
(11, 'Deepika Tex', '', '9976399926', 'Naranavalasu', '1496309779'),
(12, 'Rathi Tex', '', '9003324084', 'Ellamedu', '1496309830'),
(13, 'Ponnachiamman Tex', '', '9445490765', 'Mettur', '1496309923'),
(14, 'Kavin Tex', '', '9944765356', 'Maylirangam', '1496310015'),
(15, 'Kandiamman Tex', '', '0', 'Orathupalayam', '1496310077'),
(16, 'Saraswathi Tex', '', '9791228386', 'Malannur', '1496310180'),
(17, 'PRT Tex', '', '9715146866', 'Perumalpalayam', '1496310259'),
(18, 'Priya Tex', '', '9629433693', 'Vellakovil', '1496310335'),
(19, 'Theivam Tex', '', '9865667688', 'Vellakovil', '1496310465'),
(20, 'SenthilMurugan Tex', '', '9750890334', 'Kidaikarampalayam', '1496310572'),
(21, 'Palanivel Tex', '', '9443757425', 'Meenachivalasu', '1496310670'),
(22, 'S.P Tex', '', '9442596923', 'Meenachivalasu', '1496310713'),
(23, 'Laxshmi Tex', '', '8344850279', 'Vellakovil', '1496310755'),
(24, 'Nithya Tex', '', '9952866499', 'Servakaranpalayam', '1496310840'),
(25, 'Karuppusamy Tex', '', '9786808631', 'Kidaikaranpalayam', '1496310887'),
(26, 'M.M Tex', '', '9629690026', 'Vellakovil', '1496310939'),
(27, 'Annoramman Tex', '', '9865019473', 'Vellakovil', '1496310986'),
(28, 'Venkateshwara Tex', '', '9789460122', 'Vellakovil', '1496311030'),
(29, 'Sivaranjini Tex', '', '9865485126', 'Vellakovil', '1496311071'),
(30, 'Moorthy Tex', '', '9865183121', 'Vellakovil', '1496311125'),
(31, 'Aandavar Tex', '', '9715283403', 'Vellakovil', '1496311178'),
(32, 'Annai Tex', '', '9489813351', 'Servakaranpalayam', '1496311261'),
(33, 'Mathi Tex', '', '8098735151', 'Athipalayam pudur', '1496311401'),
(34, 'Gopinath', '', '9751004006', 'Molapalayam', '1496311505'),
(35, 'P.Kumar Tex', '', '9442208586', 'Gurusamipalayam', '1496311593');

-- --------------------------------------------------------

--
-- Table structure for table `yarns`
--

CREATE TABLE `yarns` (
  `id` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `address` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `yarns`
--

INSERT INTO `yarns` (`id`, `name`, `address`, `date`) VALUES
(1, 'Lotus Agency', 'Karur', '1496315246'),
(2, 'P.S.G Yarn Trader', 'Karur', '1496315276'),
(3, 'SPR Yarn Agenncy', 'Vellakovil', '1496315896'),
(4, 'Sri Pillayaar Tex', 'Tirupur', '1496315933'),
(5, 'Mehra polyTex India Pvt Ltd', 'Silvassa', '1496316202'),
(6, 'WellKnown Polysters Ltd', 'Daman', '1496316249'),
(7, 'Thilaga Traders', 'Karur', '1496316342'),
(8, 'Aathika Textiles', 'Karur', '1496316376'),
(9, 'New Star Spinning Mill', 'Vellakovil', '1496316413'),
(10, 'Transfer', 'Karur', '1496322994');

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `paavudetails`
--
ALTER TABLE `paavudetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `paavus`
--
ALTER TABLE `paavus`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `returnpavudetails`
--
ALTER TABLE `returnpavudetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `yarns`
--
ALTER TABLE `yarns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

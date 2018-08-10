-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 08:19 AM
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
-- Database: `secresultcomp`
--

-- --------------------------------------------------------

--
-- Table structure for table `carry_overs`
--

CREATE TABLE `carry_overs` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `c_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `grade` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id` int(11) NOT NULL,
  `fromi` double NOT NULL,
  `toi` double NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id`, `fromi`, `toi`, `name`) VALUES
(1, 3.5, 4, 'DISTINCTION'),
(2, 3, 3.49, 'UPPER CREDIT'),
(3, 2.5, 2.99, 'LOWER CREDIT'),
(4, 2, 2.49, 'PASS'),
(5, 1.75, 1.99, 'PROBATION'),
(6, 1.5, 1.74, 'WARNING'),
(7, 0, 1.49, 'WITHDRAW');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(40) NOT NULL,
  `unit` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dpt`
--

CREATE TABLE `dpt` (
  `id` int(11) NOT NULL,
  `dpt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dpt`
--

INSERT INTO `dpt` (`id`, `dpt`) VALUES
(1, 'Rufus Giwa Staff School'),
(2, 'Food Science and Technology (FST)'),
(3, 'Science Laboratory Technology  (SLT)'),
(4, 'Nutrition and Dietetics (ND)');

-- --------------------------------------------------------

--
-- Table structure for table `flag`
--

CREATE TABLE `flag` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `scoresheet_save_flag` int(11) NOT NULL,
  `result_processed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

CREATE TABLE `gps` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `last_gp` double NOT NULL,
  `course_id` int(11) NOT NULL,
  `date_logged` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gps_archieve`
--

CREATE TABLE `gps_archieve` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `last_gp` double NOT NULL,
  `date_logged` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `test` varchar(20) NOT NULL,
  `ca` int(20) NOT NULL,
  `exam` int(11) NOT NULL,
  `grade` varchar(15) NOT NULL,
  `carry_over` int(11) NOT NULL,
  `abs` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_archieve`
--

CREATE TABLE `grade_archieve` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `test` varchar(20) NOT NULL,
  `ca` int(20) NOT NULL,
  `exam` int(11) NOT NULL,
  `grade` varchar(15) NOT NULL,
  `tag` text NOT NULL,
  `abs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade_calc_predicate`
--

CREATE TABLE `grade_calc_predicate` (
  `id` int(11) NOT NULL,
  `fromi` float NOT NULL,
  `toi` float NOT NULL,
  `eq_grade` varchar(40) NOT NULL,
  `strata` int(11) NOT NULL,
  `xpoint` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_calc_predicate`
--

INSERT INTO `grade_calc_predicate` (`id`, `fromi`, `toi`, `eq_grade`, `strata`, `xpoint`) VALUES
(1, 0, 39.99, 'F', 2, 'FAIL'),
(2, 40, 44.99, 'E8', 2, 'PASS'),
(3, 45, 49.99, 'D7', 2, 'PASS'),
(4, 50, 54.99, 'C6', 2, 'CREDIT'),
(5, 55, 59.99, 'C5', 2, 'CREDIT'),
(6, 60, 64.99, 'C4', 2, 'CREDIT'),
(7, 65, 69.99, 'B3', 2, 'GOOD'),
(8, 70, 74.99, 'B2', 2, 'VERY GOOD'),
(9, 75, 100, 'A1', 2, 'EXCELLENT'),
(10, 0, 39.99, 'F', 1, 'FAIL'),
(11, 40, 44.99, 'E', 1, 'PASS'),
(12, 45, 49.99, 'D', 1, 'PASS'),
(13, 50, 59.99, 'C', 1, 'GOOD'),
(14, 60, 74.99, 'B', 1, 'VERY GOOD'),
(15, 75, 100, 'A', 1, 'EXCELLENT');

-- --------------------------------------------------------

--
-- Table structure for table `inherited_course`
--

CREATE TABLE `inherited_course` (
  `id` int(11) NOT NULL,
  `inherited_cos_id` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `lv` varchar(50) NOT NULL,
  `strata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `lv`, `strata`) VALUES
(1, 'J.S.S. 1', 1),
(2, 'J.S.S. 2', 1),
(3, 'J.S.S. 3', 1),
(4, 'S.S.S. 1 GENERAL', 2),
(5, 'S.S.S. 2 SCIENCE', 2),
(6, 'S.S.S. 2 ART', 2),
(7, 'S.S.S. 2 COMMERCIAL', 2),
(8, 'S.S.S. 3 SCIENCE', 2),
(9, 'S.S.S. 3 ART', 2),
(10, 'S.S.S. 3 COMMERCIAL', 2),
(11, 'S.S.S. 1 SCIENCE', 2),
(12, 'S.S.S. 1 ART', 2),
(13, 'S.S.S. 1 COMMERCIAL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mapping`
--

CREATE TABLE `mapping` (
  `id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `performancetab`
--

CREATE TABLE `performancetab` (
  `id` int(11) NOT NULL,
  `ifr` binary(255) NOT NULL,
  `tg` binary(255) NOT NULL,
  `st` int(11) NOT NULL,
  `lm` binary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_range`
--

CREATE TABLE `promotion_range` (
  `id` int(11) NOT NULL,
  `lv_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `sem` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `sem`) VALUES
(1, 'FIRST TERM'),
(2, 'SECOND TERM'),
(3, 'THIRD TERM');

-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

CREATE TABLE `stud` (
  `id` bigint(20) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `fullname` text NOT NULL,
  `sex` text NOT NULL,
  `photo` text NOT NULL,
  `lv_id` varchar(8) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud`
--

INSERT INTO `stud` (`id`, `matric_no`, `fullname`, `sex`, `photo`, `lv_id`, `sem_id`, `dpt_id`, `fac_id`) VALUES
(1, 'SO6/CTE/2013/145', 'Babatunde kilani samuel', 'M', 'MSO5FST2012581.jpg', '1', 1, 1, 0),
(2, 'SO6/CTE/2013/289', 'Arowosewa Babatunde samuel', 'M', 'MSO5COM2012517.jpg', '1', 1, 1, 0),
(3, 'SO6/CTE/2013/309', 'Arowosewa Kilani Desmond', 'M', 'MSO5COM2012512.jpg', '1', 1, 1, 0),
(4, 'SO6/CTE/2013/158', 'Akinbulma timileyin Desmond', 'M', 'MSO5COM2012509.jpg', '1', 1, 1, 0),
(66, 'SO1/RUF/2016/66', 'Omopariola Seyifunmi', 'M', 'NULL', '1', 1, 1, 0),
(6, 'SO6/CTE/2013/310', 'Babatunde Bayo M.', 'M', 'MSO5COM2012475.jpg', '1', 1, 1, 0),
(7, 'SO6/CTE/2013/373', 'Akintan Desmond D.', 'M', 'MSO5COM2012542.jpg', '1', 1, 1, 0),
(9, 'SO6/CTE/2013/318', 'Olu Desmond D.', 'M', 'MSO5COM2012585.jpg', '1', 1, 1, 0),
(10, 'SO6/CTE/2013/378', 'Akinbulma Ayo D.', 'M', 'MSO5COM2012466.jpg', '1', 1, 1, 0),
(11, 'SO6/CTE/2013/383', 'Akin Joy J.', 'M', 'MSO5COM2012557.jpg', '1', 1, 1, 0),
(12, 'SO6/CTE/2013/253', 'Akin Paul J.', 'M', 'MSO5COM2012528.jpg', '1', 1, 1, 0),
(13, 'SO6/CTE/2013/245', 'Paul John J.', 'M', 'MSO5COM2012542.jpg', '1', 1, 1, 0),
(14, 'SO6/CTE/2013/181', 'Pascal John J.', 'M', 'MSO5COM2012569.jpg', '1', 1, 1, 0),
(15, 'SO6/CTE/2013/215', 'Omiwale Joseph J.', 'M', 'MSO5COM2012520.jpg', '1', 1, 1, 0),
(16, 'SO6/CTE/2013/156', 'Joseph Goodness S.', 'M', 'MSO5COM2012490.jpg', '1', 1, 1, 0),
(17, 'SO6/CTE/2013/254', 'Samuel Josephine J.', 'F', 'FSO5MTH2012716.jpg', '1', 1, 1, 0),
(18, 'SO6/CTE/2013/163', 'Akintan Grace J.', 'F', 'FSO5MTH2012742.jpg', '1', 1, 1, 0),
(19, 'SO6/CTE/2013/200', 'Akintan Bola A.', 'F', 'FSO5MTH2012764.jpg', '1', 1, 1, 0),
(20, 'SO6/CTE/2013/101', 'Akinyemi Joy M.', 'F', 'FSO5MTH2012679.jpg', '1', 1, 1, 0),
(21, 'SO6/CTE/2013/297', 'AkinyeLE Joyce k.', 'F', 'FSO5MTH2012712.jpg', '1', 1, 1, 0),
(22, 'SO6/CTE/2013/314', 'Jimoh Pelumi M.', 'M', 'MSO5MAC2012988.jpg', '1', 1, 1, 0),
(24, 'SO6/CTE/2013/305', 'Jimoh Lamidi L.', 'M', 'MSO5MAC20121328.jpg', '1', 1, 1, 0),
(25, 'SO6/CTE/2013/178', 'Salah Sharafat T.', 'M', 'MSO5MAC20121147.jpg', '1', 1, 1, 0),
(26, 'SO6/CTE/2013/172', 'Gani Tajudeen L.', 'M', 'MSO5MAC20121201.jpg', '1', 1, 1, 0),
(27, 'SO6/CTE/2013/288', 'Jimoh Tajudeen T.', 'M', 'MSO5MAC2012528.jpg', '1', 1, 1, 0),
(28, 'SO6/CTE/2013/230', 'Akindutire Alade L.', 'M', 'MSO5MAC2012771.jpg', '1', 1, 1, 0),
(29, 'SO6/CTE/2013/149', 'Orimolade Goodness I.', 'M', 'MSO5MAC2012850.jpg', '1', 1, 1, 0),
(30, 'SO6/CTE/2013/331', 'Orimolade Isreal T.', 'M', 'MSO5MAC2012801.jpg', '1', 1, 1, 0),
(32, 'SO6/CTE/2013/394', 'Akindutire Isreal M.', 'M', 'MSO1BFN20123118.jpg', '1', 1, 1, 0),
(33, 'SO6/CTE/2013/315', 'Akintade Folayemi L.', 'M', 'MSO1BFN20122839.jpg', '1', 1, 1, 0),
(34, 'SO6/CTE/2013/329', 'Zachariah Sunday R.', 'M', 'MSO1BFN20122687.jpg', '1', 1, 1, 0),
(35, 'SO6/CTE/2013/270', 'Rolins Zachariah S.', 'M', 'MSO1BFN20122805.jpg', '3', 1, 1, 0),
(36, 'SO6/CTE/2013/261', 'Aknbuluma Rolins Z.', 'M', 'MSO1BFN20123103.jpg', '2', 1, 2, 0),
(37, 'SO6/CTE/2013/328', 'Akintan Zachariah S.', 'M', 'MSO1BFN20122577.jpg', '2', 1, 2, 0),
(39, 'SO6/CTE/2013/386', 'Ganiyat Monirat V.', 'F', 'FSO6CTE2012395.jpg', '2', 1, 2, 0),
(40, 'SO6/CTE/2013/349', 'Suleman Monirat V.', 'F', 'FSO6CTE2012396.jpg', '2', 1, 2, 0),
(41, 'SO6/CTE/2013/291', 'Akinde Vivian C.', 'F', 'FSO6CTE2012399.jpg', '2', 1, 2, 0),
(42, 'SO6/CTE/2013/258', 'Jegede Toyin B.', 'F', 'FSO6CTE2012409.jpg', '2', 1, 2, 0),
(43, 'SO6/CTE/2013/372', 'Akin tunde R.', 'M', 'MSO6MEC2012424.jpg', '2', 1, 2, 0),
(44, 'SO6/CTE/2013/121', 'Akindele Bayo I.', 'M', 'MSO6MEC2012404.jpg', '2', 1, 2, 0),
(45, 'SO6/CTE/2013/157', 'Akindele Goodness I.', 'M', 'MSO6MEC2012465.jpg', '2', 1, 2, 0),
(46, 'SO6/CTE/2013/137', 'Alade Isreal B.', 'M', 'MSO6MEC2012489.jpg', '2', 1, 2, 0),
(47, 'SO6/CTE/2013/180', 'Origadade Dare A.', 'M', 'MSO3ARC2012721.jpg', '2', 1, 4, 0),
(49, 'SO6/CTE/2013/105', 'Asa Dare A.', 'M', 'MSO3ARC2012713.jpg', '2', 1, 4, 0),
(50, 'SO6/CTE/2013/296', 'Maloma Tunde G.', 'M', 'MSO3URP2012678.jpg', '2', 1, 4, 0),
(51, 'SO6/CTE/2013/130', 'Maloma John G.', 'M', 'MSO3URP2012666.jpg', '2', 1, 4, 0),
(52, 'SO6/CTE/2013/625', 'Adefela George M.', 'M', 'MSO3EST2012612.jpg', '3', 1, 4, 0),
(53, 'SO6/CTE/2013/147', 'Akinlo Segun I.', 'M', 'MSO3EST2012610.jpg', '3', 1, 4, 0),
(54, 'SO6/CTE/2013/259', 'Demola Dare D.', 'M', 'MSO6EET2012762.jpg', '3', 1, 4, 0),
(55, 'SO6/CTE/2013/112', 'Balogun Kehinde S.', 'M', 'MSO6EET2012759.jpg', '3', 1, 4, 0),
(56, 'SO6/CTE/2013/111', 'Eniola Seun T.', 'M', 'MSO6EET2012760.jpg', '3', 1, 4, 0),
(57, 'SO6/CTE/2013/273', 'Abiola Eniola T.', 'M', 'MSO6EET2012799.jpg', '3', 1, 4, 0),
(58, 'SO6/CTE/2013/355', 'Kareem Kabiru F.', 'M', 'MSO6EET2012786.jpg', '3', 1, 4, 0),
(59, 'SO6/CTE/2013/192', 'Falonipe Christain G.', 'M', 'MSO6EET2012784.jpg', '3', 1, 4, 0),
(60, 'SO6/CTE/2013/144', 'Segun Christain G.', 'M', 'MSO6EET2012771.jpg', '3', 1, 4, 0),
(61, 'SO6/CTE/2013/173', 'Raymond Collins D.', 'M', 'MSO6EET2012766.jpg', '3', 1, 4, 0),
(62, 'SO6/CTE/2013/162', 'Atiwaye kehinde', 'F', 'FSO5COM2012600.jpg', '3', 1, 4, 0),
(63, 'SO6/CTE/2013/286', 'Akinde Samson L.', 'M', 'MSO5COM2012601.jpg', '3', 1, 4, 0),
(64, 'SO1/Emm/2016/36', 'Ayanfe Oluwatuyi', 'Male', 'NULL', '0', 0, 1, 0),
(65, 'SO1/EMM/2016/65', 'john', 'M', 'NULL', '0', 0, 1, 0),
(67, 'SO1/RUF/2016/67', 'Dele Moshood', 'M', 'NULL', '3', 1, 1, 0),
(68, 'SO1/RUF/2016/68', 'Fela Grace', 'F', 'NULL', '1', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stud_archieve`
--

CREATE TABLE `stud_archieve` (
  `id` bigint(20) NOT NULL,
  `matric_no` varchar(35) NOT NULL,
  `fullname` text NOT NULL,
  `sex` text NOT NULL,
  `photo` text NOT NULL,
  `lv_id` varchar(8) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `syspmin`
--

CREATE TABLE `syspmin` (
  `syspmin` text NOT NULL,
  `used` int(11) NOT NULL,
  `byi` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_setting`
--

CREATE TABLE `sys_setting` (
  `id` int(11) NOT NULL,
  `result_header` text NOT NULL,
  `result_footer` text NOT NULL,
  `dpt_logo` text NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `next_term_begins` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` text NOT NULL,
  `name` text NOT NULL,
  `mat` text NOT NULL,
  `password` text NOT NULL,
  `pix` text NOT NULL,
  `sex` text NOT NULL,
  `bk` int(2) NOT NULL,
  `dpt` text NOT NULL,
  `extrights` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `mat`, `password`, `pix`, `sex`, `bk`, `dpt`, `extrights`) VALUES
(1, 'hod', 'Akinsuyi Allison Wilson', 'createaccount@cliqs.com', 'cbaac6303676c08e8dfa39d51d0d09e947878ad5', '1274882akinsuyi.jpg', 'Male', 0, '2', 1),
(8, 'hod', 'Osadare Ayo', 'osadareayo442@gmail.com', 'cbaac6303676c08e8dfa39d51d0d09e947878ad5', '1274882akinsuyi.jpg', 'Male', 0, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_extension_tab`
--

CREATE TABLE `users_extension_tab` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `dpt_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_extension_tab`
--

INSERT INTO `users_extension_tab` (`id`, `uid`, `dpt_id`, `fac_id`) VALUES
(1, 2, 1, 0),
(2, 8, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carry_overs`
--
ALTER TABLE `carry_overs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dpt`
--
ALTER TABLE `dpt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flag`
--
ALTER TABLE `flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gps_archieve`
--
ALTER TABLE `gps_archieve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_archieve`
--
ALTER TABLE `grade_archieve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_calc_predicate`
--
ALTER TABLE `grade_calc_predicate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inherited_course`
--
ALTER TABLE `inherited_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapping`
--
ALTER TABLE `mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performancetab`
--
ALTER TABLE `performancetab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_range`
--
ALTER TABLE `promotion_range`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud`
--
ALTER TABLE `stud`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matric_no` (`matric_no`);

--
-- Indexes for table `stud_archieve`
--
ALTER TABLE `stud_archieve`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matric_no` (`matric_no`);

--
-- Indexes for table `sys_setting`
--
ALTER TABLE `sys_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_extension_tab`
--
ALTER TABLE `users_extension_tab`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carry_overs`
--
ALTER TABLE `carry_overs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dpt`
--
ALTER TABLE `dpt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flag`
--
ALTER TABLE `flag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gps`
--
ALTER TABLE `gps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gps_archieve`
--
ALTER TABLE `gps_archieve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_archieve`
--
ALTER TABLE `grade_archieve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_calc_predicate`
--
ALTER TABLE `grade_calc_predicate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inherited_course`
--
ALTER TABLE `inherited_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mapping`
--
ALTER TABLE `mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performancetab`
--
ALTER TABLE `performancetab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotion_range`
--
ALTER TABLE `promotion_range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stud`
--
ALTER TABLE `stud`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `stud_archieve`
--
ALTER TABLE `stud_archieve`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_setting`
--
ALTER TABLE `sys_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_extension_tab`
--
ALTER TABLE `users_extension_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

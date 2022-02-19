-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 10:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `6375_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_banks`
--

CREATE TABLE `tb_banks` (
  `id_bank` int(11) NOT NULL,
  `id_bankth` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_banks`
--

INSERT INTO `tb_banks` (`id_bank`, `id_bankth`, `name`, `number`) VALUES
(10, '006', 'สมชาย กายเงิน', '0123456788'),
(12, '014', 'สมชาย กายเงิน', '1234567791');

-- --------------------------------------------------------

--
-- Table structure for table `tb_banks_th`
--

CREATE TABLE `tb_banks_th` (
  `id_bankth` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_banks_th`
--

INSERT INTO `tb_banks_th` (`id_bankth`, `name`) VALUES
('025', 'ธนาคารกรุงศรีอยุธยา'),
('002', 'ธนาคารกรุงเทพ'),
('006', 'ธนาคารกรุงไทย'),
('004', 'ธนาคารกสิกรไทย'),
('022', 'ธนาคารซีไอเอ็มบีไทย'),
('011', 'ธนาคารทหารไทย'),
('067', 'ธนาคารทิสโก้'),
('065', 'ธนาคารธนชาต'),
('098', 'ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไท'),
('024', 'ธนาคารยูโอบี'),
('030', 'ธนาคารออมสิน'),
('033', 'ธนาคารอาคารสงเคราะห์'),
('066', 'ธนาคารอิสลามแห่งประเทศไทย'),
('069', 'ธนาคารเกียรตินาคินภัทร'),
('035', 'ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย'),
('034', 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร'),
('073', 'ธนาคารแลนด์แอนด์ เฮ้าส์'),
('001', 'ธนาคารแห่งประเทศไทย'),
('014', 'ธนาคารไทยพาณิชย์'),
('071', 'ธนาคารไทยเครดิตเพื่อรายย่อย'),
('070', 'ธนาคารไอซีบีซี (ไทย)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`id_cart`, `id_user`, `id_product`, `qty`) VALUES
(189, 3, 26, 1),
(223, 18, 30, 4),
(232, 23, 67, 2),
(238, 3, 70, 1),
(282, 10, 75, 1),
(340, 36, 69, 1),
(373, 3, 25, 1),
(403, 69, 28, 1),
(404, 69, 27, 1),
(407, 69, 72, 1),
(408, 69, 68, 3),
(410, 69, 80, 3),
(411, 69, 69, 1),
(412, 69, 74, 2),
(426, 85, 71, 6),
(427, 85, 81, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id_category`, `name`) VALUES
(6, 'การ์ดจอ'),
(25, 'คีย์บอร์ด'),
(51, 'จอคอมพิวเตอร์'),
(53, 'ชุดน้ำระบายความร้อน'),
(5, 'ซีพียู'),
(34, 'เคสคอมพิวเตอร์'),
(55, 'เมาส์'),
(27, 'แรม');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orders`
--

CREATE TABLE `tb_orders` (
  `id` int(11) NOT NULL,
  `id_order` int(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` int(11) DEFAULT 1,
  `tracking` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_orders`
--

INSERT INTO `tb_orders` (`id`, `id_order`, `id_user`, `id_product`, `qty`, `total`, `date`, `status`, `tracking`) VALUES
(1, 155704550, 4, 27, 1, 31900, '2021-11-24 12:36', 5, 'KJ37647893'),
(2, 267354620, 4, 25, 1, 15000, '2021-06-20 02:18', 5, 'JF8739402'),
(3, 299195468, 18, 31, 1, 3390, '2021-11-30 17:32', 7, ''),
(4, 391056446, 4, 33, 1, 4050, '2021-11-25 16:50', 5, 'KJ37647893'),
(5, 432180274, 19, 27, 1, 31900, '2021-11-24 10:01', 5, 'KK9282784'),
(6, 503970428, 22, 27, 1, 31900, '2021-09-20 15:05', 6, 'CP12456464'),
(7, 528385645, 23, 67, 3, 3870, '2021-12-01 15:31', 7, ''),
(8, 794413574, 23, 67, 3, 3870, '2021-12-01 13:18', 6, 'YU1234FG25'),
(9, 832641561, 19, 64, 1, 2590, '2021-10-23 01:50', 6, 'FS45441354'),
(10, 1110686952, 23, 67, 1, 1290, '2021-12-01 15:31', 5, ''),
(11, 391056446, 4, 26, 1, 7190, '2021-11-25 16:50', 5, 'KJ37647893'),
(12, 1241131871, 4, 64, 1, 2590, '2021-10-24 09:06', 5, 'QQ3563224'),
(13, 1271682749, 26, 72, 1, 3890, '2020-12-06 00:24', 6, 'YU1234FG25'),
(14, 1340170194, 22, 25, 1, 15000, '2021-08-20 15:05', 7, ''),
(15, 1369889622, 26, 67, 1, 1290, '2021-12-08 09:35', 6, 'OP8896766'),
(16, 1415797664, 19, 30, 1, 3290, '2021-11-30 15:09', 5, 'KK9282784'),
(17, 1523518906, 4, 30, 1, 3290, '2021-03-19 12:23', 6, 'KL375893725'),
(18, 1529507820, 22, 34, 1, 7350, '2021-07-20 15:05', 7, ''),
(19, 1551058119, 4, 31, 1, 3390, '2021-05-20 01:59', 5, 'QA87631556'),
(20, 1593423224, 18, 32, 1, 4890, '2021-11-30 15:19', 5, 'QS123465'),
(21, 1666496637, 19, 27, 2, 63800, '2021-10-24 09:50', 5, 'KJ37647893'),
(23, 1779208116, 18, 33, 1, 4050, '2021-11-30 16:03', 5, 'JF8739402'),
(24, 1850496685, 19, 28, 1, 47900, '2021-02-18 16:16', 5, 'VH9888766555'),
(25, 2017728391, 4, 31, 1, 3390, '2021-11-25 11:44', 5, 'JF8739402'),
(26, 2105679172, 4, 32, 1, 9780, '2021-04-20 01:44', 5, 'KK9282784'),
(27, 2142834755, 4, 25, 1, 15000, '2021-12-09 18:50', 7, ''),
(28, 2142834755, 4, 72, 2, 7780, '2021-12-09 18:50', 7, ''),
(29, 785799241, 4, 30, 1, 3290, '2021-12-09 18:56', 5, 'JF8739402'),
(30, 785799241, 4, 64, 3, 7770, '2021-12-09 18:56', 5, 'JF8739402'),
(31, 785799241, 4, 71, 1, 2570, '2021-12-09 18:56', 5, 'JF8739402'),
(32, 785799241, 4, 76, 1, 23500, '2021-12-09 18:56', 5, 'JF8739402'),
(33, 785799241, 4, 74, 2, 20520, '2021-12-09 18:56', 5, 'JF8739402'),
(34, 785799241, 4, 73, 2, 19800, '2021-12-09 18:56', 5, 'JF8739402'),
(35, 69404130, 4, 73, 1, 9900, '2021-12-11 01:50', 6, '๋DK873957'),
(36, 2105064951, 26, 70, 2, 7980, '2021-12-20 20:53', 6, 'VHP77649784'),
(37, 1344822639, 26, 72, 1, 3890, '2021-12-21 16:41', 6, 'JK283834566'),
(38, 2012121884, 26, 74, 2, 20520, '2021-12-29 08:56', 6, 'KK9282784'),
(39, 1726333449, 26, 33, 2, 8100, '2021-12-29 09:02', 5, 'KJ37647893'),
(40, 721085751, 26, 28, 1, 47900, '2021-12-29 09:11', 5, 'JF8739402'),
(41, 721085751, 26, 73, 2, 19800, '2021-12-29 09:11', 5, 'JF8739402'),
(42, 721085751, 26, 64, 4, 10360, '2021-12-29 09:11', 5, 'JF8739402'),
(43, 721085751, 26, 30, 1, 3290, '2021-12-29 09:11', 5, 'JF8739402'),
(44, 721085751, 26, 71, 3, 7710, '2021-12-29 09:11', 5, 'JF8739402'),
(45, 721085751, 26, 72, 3, 11670, '2021-12-29 09:11', 5, 'JF8739402'),
(47, 288248263, 26, 76, 2, 47000, '2021-12-30 01:02', 5, 'NJ475893042'),
(99, 740480017, 87, 71, 1, 2570, '2022-02-13 23:09', 5, 'OP3784654'),
(100, 740480017, 87, 85, 1, 3990, '2022-02-13 23:09', 5, 'OP3784654'),
(101, 141800999, 4, 34, 100, 735000, '2022-02-18 23:21', 4, ''),
(102, 141800999, 4, 82, 1, 15900, '2022-02-18 23:21', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pay`
--

CREATE TABLE `tb_pay` (
  `id_pay` int(11) NOT NULL,
  `id_order` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `slip` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `member_id_bank` varchar(50) NOT NULL,
  `store_id_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pay`
--

INSERT INTO `tb_pay` (`id_pay`, `id_order`, `total`, `slip`, `date`, `member_id_bank`, `store_id_bank`) VALUES
(27, '1850496685', 0, 'Paw_Paw-01.jpg', '2021-11-18T16:16', '025', '014'),
(28, '1523518906', 0, 'fe3a6e7c20865938d445f6e4061490ad.jfif', '2021-11-19T12:23', '025', '014'),
(29, '2105679172', 0, 'vayu_7_-_073.jpg', '2021-11-20T01:44', '025', '014'),
(30, '1551058119', 0, 'fbb85ed0683ca24c946eb03360b5216a.jpg', '2021-11-20T01:59', '025', '014'),
(31, '511181695', 0, '246447142_288463016358094_7905618442199815279_n.jpg', '2021-11-20T02:07', '025', '014'),
(32, '267354620', 0, '246447142_288463016358094_7905618442199815279_n.jpg', '2021-11-20T02:18', '025', '014'),
(33, '503970428', 0, 'คัมภีร์วิถีเซียน-2.jpg', '2021-11-20T15:06', '014', '014'),
(34, '832641561', 0, 'madison.jpg', '2021-11-23T01:50', '025', '014'),
(36, '2017728391', 0, '10-background-for-zoom-005-800x450.jpg', '2021-11-25T11:45', '006', '014'),
(37, '1220411018', 0, 'madison.jpg', '2021-11-25T16:50', '025', '014'),
(38, '391056446', 0, 'madison.jpg', '2021-11-25T16:50', '025', '014'),
(39, '1415797664', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '2021-11-30T15:12', '014', '014'),
(40, '432180274', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '2021-11-30T15:12', '025', '014'),
(41, '1666496637', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '2021-11-30T15:12', '025', '014'),
(42, '1593423224', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '2021-11-30T15:26', '006', '014'),
(43, '', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '2021-11-30T16:04', '025', '014'),
(44, '1779208116', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '2021-11-30T16:07', '025', '014'),
(45, '794413574', 0, '563000003170804.jpg', '2021-12-01T13:19', '025', '014'),
(46, '1271682749', 0, 'images.jfif', '2021-12-06T00:25', '014', '006'),
(47, '1369889622', 0, 'images.jfif', '2021-12-08T09:36', '006', '006'),
(49, '785799241', 0, 'images.jfif', '2021-12-09T19:29', '006', '014'),
(50, '69404130', 0, 'images.jfif', '2021-12-11T01:54', '025', '014'),
(51, '2142834755', 0, 'images.jfif', '2021-12-11T01:55', '025', '014'),
(52, '155704550', 0, 'images.jfif', '2021-12-11T01:55', '025', '014'),
(53, '2105064951', 0, 'java.png', '2021-12-20T20:53', '030', '006'),
(54, '1344822639', 0, 'ou20kw2efXvlUQ24J4f-o.jpg', '', '025', '014'),
(55, '2012121884', 0, 'tono_1.jpg', '2021-12-29T08:57', '004', '014'),
(56, '1726333449', 0, 'tono_1.jpg', '2021-12-29T09:03', '001', '014'),
(65, '1088253839', 0, 'tono_1.jpg', '2021-12-29T09:55', '025', '014'),
(66, '288248263', 0, 'tono_1.jpg', '2021-12-30T01:08', '025', '006'),
(67, '1579598957', 0, 'tono_1.jpg', '2022-01-03T05:49', '025', '014'),
(68, '1154867253', 0, 'tono_1.jpg', '2022-01-03T06:42', '014', '014'),
(69, '914768351', 0, 'tono_1.jpg', '2022-01-03T07:05', '025', '014'),
(70, '96477453', 0, 'tono_1.jpg', '2022-01-06T19:18', '034', '006'),
(71, '102799617', 0, 'tono_1.jpg', '2022-01-07T10:26', '014', '014'),
(72, '805709740', 0, 'tono_1.jpg', '2022-01-09T19:23', '030', '014'),
(73, '1313365463', 0, 'tono_1.jpg', '2022-01-09T21:58', '030', '006'),
(74, '115756703', 0, 'tono_1.jpg', '2022-01-10T13:50', '004', '006'),
(75, '960444740', 0, 'ENm-Nw7VUAAsGQG.jpg', '2022-01-10T18:53', '006', '006'),
(76, '157376303', 0, 'Screenshot_2022-01-07-15-04-02-426_lockscreen.jpg', '2022-01-10T18:54', '002', '006'),
(77, '1608076130', 0, 'ENm-Nw7VUAAsGQG.jpg', '2022-01-11T19:39', '065', '014'),
(79, '1826964350', 0, 'wearecats.jpg', '2022-01-26T21:27', '030', '006'),
(80, '1381013011', 0, 'tono_1.jpg', '2022-01-27T10:00', '014', '006'),
(81, '1256091047', 0, 'tono_1.jpg', '2022-01-27T18:21', '014', '006'),
(82, '544839771', 0, 'tono_1.jpg', '2022-02-05T17:38', '030', '006'),
(83, '698604365', 0, 'tono_1.jpg', '2022-02-08T20:11', '006', '014'),
(84, '2024145556', 0, 'tono_1.jpg', '2022-02-09T09:06', '002', '006'),
(85, '1320629227', 0, 'tono_1.jpg', '2022-02-09T09:57', '002', '014'),
(86, '1684840717', 3962500, 'tono_1.jpg', '2022-02-09T23:35', '034', '014'),
(87, '703298860', 199500, '630990-img-2.jpg', '2022-02-10T00:23', '001', '014'),
(88, '76476581', 650000, '630990-img-2.jpg', '2022-02-10T00:24', '067', '014'),
(89, '740480017', 6560, 'tono_1.jpg', '2022-02-13T23:14', '073', '014'),
(90, '141800999', 750900, 'ENm-Nw7VUAAsGQG.jpg', '2022-02-18T23:21', '014', '014');

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `id_product` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `spec` text NOT NULL,
  `img` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_products`
--

INSERT INTO `tb_products` (`id_product`, `category`, `name`, `cost`, `price`, `qty`, `spec`, `img`, `created_at`) VALUES
(25, 5, 'CPU AMD AM4 RYZEN7 5800X', 13500, 15000, 999, '<p><strong><em>Socket : AM4 </em></strong></p>\r\n\r\n<p><strong><em># of CPU Cores : 8 </em></strong></p>\r\n\r\n<p><strong><em># of Threads : 16 </em></strong></p>\r\n\r\n<p><strong><em>Processor Base Frequency : 3.8 GHz </em></strong></p>\r\n\r\n<p><strong><em>Max Turbo Frequency : 4.7 GHz</em></strong></p>\r\n', '723f5c58a3dd8e5556bad6e5aa717e46.jfif', '2021-12-09 16:48:34'),
(26, 5, 'INTEL CPU (ซีพียู) Core i5-10400F', 7000, 7190, 1000, '<p>โปรเซสเซอร์เดสก์ท็อป Gen 10 Intel Core i5-10400F รุ่นล่าสุดจาก Intel มี Socket LGA1200 มี 6 คอร์ 12 เทรด รวดเร็วและทรงพลังต่อการใช้งานพื้นฐานทั่วไป โดยความเร็วจะอยู่ที่ 2.90 GHz สามารถเพิ่มความเร็วได้ถึง 4.30 GHz ใช้พลังงานเพียง 65 วัตต์ รับประกัน 3 ปี เต็ม</p>\r\n\r\n<p>CPU Brand : Intel</p>\r\n\r\n<p>CPU Series : 10th Generation Intel Core i5 Processors</p>\r\n\r\n<p>CPU Model : Core i5-10400F</p>\r\n\r\n<p>CPU Socket Type : LGA 1200</p>\r\n\r\n<p>Core Name : Comet Lake</p>\r\n\r\n<p># of Cores : 6 Core 12 Threads</p>\r\n\r\n<p>Operating Frequency : 2.90 GHz upto 4.30 GHz</p>\r\n\r\n<p>L2 Cache : N/A</p>\r\n\r\n<p>L3 Cache : 12MB SmartCache</p>\r\n\r\n<p>Manufacturing Tech : N/A 64Bit</p>\r\n\r\n<p>Support : Yes Virtualization Technology</p>\r\n\r\n<p>Support : Yes Thermal Design Power : 65W</p>\r\n\r\n<p>Warranty 3 Years</p>\r\n', '4ea4d142e1f0b0ba6dc42514f57c5ea0.jfif', '2022-02-11 08:36:35'),
(27, 6, 'VGA (การ์ดแสดงผล) MSI GEFORCE RTX 3060', 30000, 31900, 900, '<ul>\r\n	<li>VGA (การ์ดแสดงผล) MSI GEFORCE RTX 3060 GAMING X 12G - 12GB GDDR6 192BIT - ประกัน 3 ปี</li>\r\n	<li>GeForce RTX &trade; 3060 ให้คุณเล่นเกมล่าสุดโดยใช้พลังของ Ampere ซึ่งเป็นสถาปัตยกรรม RTX รุ่นที่ 2 ของ NVIDIA รับประสิทธิภาพที่น่าทึ่งด้วย Ray Tracing Cores และ Tensor Cores ที่ได้รับการปรับปรุงมัลติโปรเซสเซอร์สตรีมมิ่งใหม่และหน่วยความจำ G6 ความเร็วสูง</li>\r\n	<li>เพิ่มความเร็วนาฬิกา / หน่วยความจำ</li>\r\n	<li>- 1837 MHz / 15 Gbps</li>\r\n	<li>- GDDR ขนาด 12GB 6</li>\r\n	<li>- DisplayPort x 3</li>\r\n	<li>HDMI x 1 (รองรับ 4K @ 120Hz ตามที่ระบุใน HDMI 2.1)</li>\r\n	<li>TWIN FROZR 8 การออกแบบระบายความร้อน</li>\r\n	<li>- TORX Fan 4.0:ผลงานชิ้นเอกของการทำงานเป็นทีมใบพัดลมทำงานเป็นคู่เพื่อสร้างความดันอากาศที่มุ่งเน้นในระดับที่ไม่เคยมีมาก่อน</li>\r\n	<li>- Core Pipe:ท่อความร้อนที่สร้างขึ้นอย่างแม่นยำช่วยให้มั่นใจได้ว่าจะสัมผัสกับ GPU ได้สูงสุดและกระจายความร้อนไปตลอดความยาวของฮีทซิงค์</li>\r\n	<li>- การควบคุมการไหลของอากาศ:ไม่ให้เหงื่อออก Airflow Control จะนำอากาศไปยังที่ที่ต้องการเพื่อความเย็นสูงสุด</li>\r\n	<li>RGB Mystic Light</li>\r\n	<li>- Mystic Light ช่วยให้คุณควบคุมแสง RGB สำหรับอุปกรณ์ MSI และผลิตภัณฑ์ RGB ที่เข้ากันได้อย่างสมบูรณ์</li>\r\n	<li>ศูนย์มังกร</li>\r\n	<li>- ซอฟต์แวร์ Dragon Center เอกสิทธิ์เฉพาะของ MSI ช่วยให้คุณตรวจสอบปรับแต่งและปรับแต่งผลิตภัณฑ์ MSI แบบเรียลไทม์</li>\r\n	<li>Brand MSI</li>\r\n	<li>Model GeForce RTX 3060 GAMING X 12G</li>\r\n	<li>GPU NVIDIA GeForce RTX 3060</li>\r\n	<li>CUDA Core 3584</li>\r\n	<li>Core Clock Boost: 1837 MHz</li>\r\n	<li>Memory Clock 15 Gbps</li>\r\n	<li>Memory Size 12GB</li>\r\n	<li>Memory Type GDDR6</li>\r\n	<li>Memory Interface 192-bit</li>\r\n	<li>Bus Interface PCI Express 4.0</li>\r\n	<li>HDMI 1 Port (HDMI 2.1)</li>\r\n	<li>DisplayPort 3 Ports (DP 1.4a)</li>\r\n	<li>DVI None</li>\r\n	<li>D-Sub (VGA) None</li>\r\n	<li>Mini HDMI None</li>\r\n	<li>Mini DisplayPort None</li>\r\n	<li>USB None</li>\r\n	<li>Microsoft DirectX Support 12 API</li>\r\n	<li>OpenGL 4.6</li>\r\n	<li>Maximum Resolution 7680 x 4320</li>\r\n	<li>Power Supply Requirement 550W</li>\r\n	<li>Windows Support N/A</li>\r\n	<li>Dimension (W x D x H) : 13.10 x 27.60 x 5.10 cm</li>\r\n	<li>Net Weight 0.99 KG</li>\r\n	<li>Package Dimension (W x D x H) : 26.60 x 38.00 x 8.40 cm</li>\r\n	<li>Gross Weight 1.56 KG</li>\r\n	<li>Volume 8,490.72 cm3</li>\r\n	<li>Warranty</li>\r\n	<li>การรับประกัน 3 ปี</li>\r\n	<li>*ราคารวมภาษีมูลค่าเพิ่มแล้ว*</li>\r\n</ul>\r\n', '2021092213214748784_1.jpg', '2021-12-09 16:48:34'),
(28, 6, 'VGA (การ์ดแสดงผล) GIGABYTE GEFORCE RTX 3070', 45000, 47900, 1000, '<ul>\r\n	<li>\r\n	<h3>GeForce RTX 3070&nbsp;</h3>\r\n	</li>\r\n	<li>\r\n	<h3>8GB GDDR6&nbsp;</h3>\r\n	</li>\r\n	<li>\r\n	<h3>2 x DP&nbsp;</h3>\r\n	</li>\r\n	<li>\r\n	<h3>2 x HDMI</h3>\r\n	</li>\r\n</ul>\r\n', 'ddebe02e-6576-489a-80d5-58e32590127d.jpg', '2021-12-09 16:48:34'),
(30, 25, 'คีย์บอร์ด HyperX Alloy Origin 60 Red Switch Mechanical Keyboard', 3000, 3290, 1000, '<p>Anti-Ghosting 100% พร้อม N-Key Rollover สวิตซ์ HyperX Red Switch เคสวัสดุอลูมิเนียม แข็งแรงทนทานสูง รองรับการใช้งาน PC, PS5, PS4, Xbox Series X / S, Xbox One</p>\r\n', 'hyperX-alloy-60.jpg', '2021-12-09 16:48:34'),
(31, 25, 'คีย์บอร์ด Loga RAVANA Wireless Mechanical Keyboard', 3000, 3390, 1000, '<ul>\r\n	<li>\r\n	<p><strong>คีย์บอร์ดขนาด Layout 96%</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>สามารถใช้งานได้ทั้งแบบมีสายและไร้สาย</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Hot-Swappable เปลี่ยนสวิตซ์ได้</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>คีย์แคปภาษาไทย-อังกฤษ ABS Double shot</strong></p>\r\n	</li>\r\n</ul>\r\n', 'Loga-RAVANA-1.jpg', '2021-12-09 16:48:34'),
(32, 25, 'คีย์บอร์ด Leopold FC750RS Stickpoint Mechanical Keyboard', 4700, 4890, 1000, '<p>Leopold FC750RS Stickpoint Mechanical Keyboard คีย์บอร์ด Mechanical จากประเทศเกาหลี สีคีย์แคปน่ารัก ดีไซน์น่าใช้งาน คีย์บอร์ดเป็นแบบ TKL 89 ปุ่มโดยตัดชุดปุ่มตัวเลขหรือ Numpad ออกไปเพื่อประหยัดพื้นที่และพกพาสะดวกมากยิ่งขึ้น วัสดุคีย์แคปจะเป็น PBT มีความบางเพียง 1.5 มม. เหมาะสำหรับใครที่ชอบคีย์แคปแบบไม่หนามาก คีย์แคปมีความลาดเอียงเข้านิ้วมือเป็นอย่างดี เหมาะสำหรับใครที่พิมพ์สัมผัสเป็นประจำ Leopold FC750RS Stickpoint Mechanical Keyboard ใช้สวิตซ์จากแบรนด์ Cherry MX มีให้เลือกมากถึง 8 ประเภทด้วยกัน จุดเด่นอีกอย่างของคีย์บอร์ดรุ่นนี้คือมี Stick Point ตรงกลางของคีย์บอร์ด เป็นปุ่มสำหรับการควบคุมเคอร์เซอร์ บางคนอาจไม่เคยใช้ปุ่มแบบนี้ แต่ถ้าได้ลองใช้ก็จะช่วยให้ควบคุมเคอร์เซอร์ผ่านคีย์บอร์ดได้โดยตรงเลยครับ การเชื่อมต่อเป็นแบบมีสายผ่านพอร์ต USB จึงสามารถใช้งานร่วมกับหลากหลายอุปกรณ์ ทั้งคอมพิวเตอร์ตั้งโต๊ะ และ คอมพิวเตอร์พกพา Leopold FC750RS Stickpoint Mechanical Keyboard เหมาะสำหรับใครที่กำลังมองหาคีย์บอร์ดแบบ Mechanical ที่มีสวิตซ์ให้เลือกเยอะ ไม่ได้ใช้ปุ่ม Numpad บ่อยครั้ง ดีไซน์สวยน่าใช้งาน และมีปุ่ม Stick Point สำหรับควบคุมเคอร์เซอร์ เป็นได้ทั้งคีย์บอร์ดเล่นเกม และคีย์บอร์ดทำงานครับ</p>\r\n', 'Leopold_C750RS_1(1).png', '2021-12-09 16:48:34'),
(33, 27, 'Corsair 16GB (8GBx2) VENGEANCE Pro SL 3200MHz', 3900, 4050, 998, '<p>หน่วยความจำ CORSAIR VENGEANCE RGB PRO SL DDR4 ทำให้พีซีของคุณสว่างโดดเด่นขึ้นด้วยแสง RGB แบบไดนามิกที่สามารถระบุแอดเดรสแยกกันได้ในขณะที่ให้ประสิทธิภาพสูงสุดในโมดูลหน่วยความจำขนาดกะทัดรัดสูง 44 มม.</p>\r\n', 'Corsair-VENGEANCE-Pro-DDR4-3200-1.jpg', '2021-12-09 16:48:34'),
(34, 27, 'Kingston 32GB (16GBx2) HyperX FURY RGB 3466MHz', 7000, 7350, 900, '<p>HyperX&reg; FURY DDR4 RGB&nbsp;ช่วยให้การทำงานรวดเร็วและยังสะท้อนสไตล์เฉพาะตัว กับความเร็วในการทำงานที่สูงถึง&nbsp;3466Mhz,&nbsp;ดุดดันและโดดเด่นด้วยไฟ&nbsp;RGB&nbsp;ที่แสดงผลตลอดแนวของหน่วยความจำเพื่อให้ได้เอฟเฟกต์แสงสีที่ราบรื่น สะดุดตาและสวยงาม&nbsp;FURY DDR4 RGB&nbsp;รองรับมาตรฐาน&nbsp;XMP&nbsp;มีจำหน่ายที่ความเร็ว&nbsp;2400MHz&ndash;3466MHz&nbsp;ค่าหน่วงเวลาที่&nbsp;CL15&ndash;16&nbsp;ความจุต่อแถวที่&nbsp;8GB&nbsp;และ&nbsp;16GB&nbsp;หรือแบบจำหน่ายเป็นชุดขนาดรวม&nbsp;16GB-64GB&nbsp;เพื่อให้คุณเพิ่มประสิทธิภาพในการทำงานของเครื่อง ทั้งสำหรับเล่นเกม ตัดต่อวิดีโอหรือเรนเดอร์ภาพได้อย่างเต็มที่ รองรับการโอเวอร์คล็อกอัตโนมัติแบบ&nbsp;Plug N Play&nbsp;ที่ความเร็ว&nbsp;2400Mhz&nbsp;และ&nbsp;2600Mhz&nbsp;สามารถใช้งานร่วมกับ&nbsp;CPU&nbsp;ใหม่ล่าสุดจาก&nbsp;Intel&nbsp;และ&nbsp;AMD&nbsp;ผ่านการทดสอบ&nbsp;100%&nbsp;ที่ความเร็วระดับสูงสุด รับประกันตลอดอายุการใช้งาน&nbsp;FURY DDR4 RGB&nbsp;ถือเป็นอุปกรณ์อัพเกรดราคาประหยัดที่คุณมั่นใจได้เต็มที่<br />\r\n<br />\r\n<strong>คุณสมบัติ</strong></p>\r\n\r\n<ul>\r\n	<li>เอฟเฟกต์ไฟ&nbsp;RGB&nbsp;กับสไตล์ที่ดุดัน</li>\r\n	<li>เทคโนโลยี&nbsp;HyperX Infrared Sync&nbsp;ที่กำลังจดสิทธิบัตร</li>\r\n	<li>รองรับมาตรฐาน&nbsp;Intel XMP&nbsp;สำหรับชิปเซ็ตใหม่ล่าสุดจาก&nbsp;Intel</li>\r\n	<li>ฟังก์ชั่น&nbsp;Plug N Play&nbsp;ที่ความเร็ว&nbsp;2400MHz&nbsp;และ&nbsp;2666MHz</li>\r\n</ul>\r\n', 'Kingston-32GB-(Kit-of-2)-HyperX-FURY-RGB-3466MHz.jpg', '2022-02-18 16:22:05'),
(64, 25, 'คีย์บอร์ด Royal Kludge RK84 White Wireless Mechanical Keyboard', 2300, 2590, 1000, '<p>Royal Kludge ของแท้ ประกันศูนย์ไทย 1 เดือน&nbsp;</p>\r\n\r\n<ul>\r\n	<li>ใหม่ล่าสุด RK84 Hot swap เปลี่ยนสวิตซ์ได้</li>\r\n	<li>มีคีย์ภาษาไทย - อังกฤษ ยิง &quot;เลเซอร์ &quot; สวย ตัวหนังสือคมกริบ</li>\r\n	<li>RK Royal Kludge RK84 เป็นคีย์บอร์ด Mechanical มีไฟ RGB ปรับได้หลากหลายสี มีปุ่ม 84 คีย์</li>\r\n	<li>การเชื่อมต่อแบบ 3 Modes รองรับบลูทูธ และใช้สาย และไร้สาย 2.4Ghz (สัญญาณรองรับอุปกรณ์ที่ใช้ได้กับ Windows / MacOS / Android และระบบอื่น ๆ&nbsp;</li>\r\n	<li>ใช้สวิตช์ RK และมีการออกแบบแอปพลิเคชันต่างๆ เช่น All Keys Without Conflict, การปรับแสง RGB Backlit, การควบคุม Hardware Backlit,&nbsp;</li>\r\n	<li>USB PASSTHROUGH x 2 ports (USB HUB) สำหรับการชาร์จไฟและข้อมูล</li>\r\n	<li>มีซอร์ฟแวร์ปรับค่าต่างๆ ได้ เช่น ตั้งค่าฟังก์ชันคีย์, ตั้งค่าแสงแบบต่างๆ และตั้งค่าเกมส์โหมด</li>\r\n	<li>ไฟ RGB 18 mode</li>\r\n	<li>ใช้ได้ทั้งพีซี โน้ตบุ้ค แท้ปเล็ต มือถือ Android, iPhone, iPad*** สัญลักษณ์บนตีย์แคปของจริงกับรูปโฆษณา อาจแตกต่างเล็กน้อยเนื่องจากล้อตการผลิต*</li>\r\n</ul>\r\n\r\n<p>Specifications:</p>\r\n\r\n<ul>\r\n	<li>สีขาว&nbsp;</li>\r\n	<li>คีย์บอร์ด ขนาด 75% มีคีย์ 84 ปุ่ม</li>\r\n	<li>เชื่อมต่อผ่านสาย USB แบบ type-c ถอดสายได้ / wireless 2.4ghz และไร้สายผ่าน bluetooth 5.0 ต่อกับอุปกรณ์ได้มากถึง 5 เครื่อง</li>\r\n	<li>Battery: 3750 mAh ใช้งานต่อเนื่องได้กว่า 15 ชั่วโมง ใช้เวลาชาร์จ 6-8 ชม. stand by นานกว่า 200 ชม.</li>\r\n	<li>รองรับ Windows, Mac, iOS, Android</li>\r\n	<li>RK Switch (Brand : Huanno) : Blue, Red, Brown แบบ Hot-swap</li>\r\n	<li>ไฟ RGB 18 mode</li>\r\n	<li>คีย์แคป ABS ไฟลอด</li>\r\n	<li>N-Key Rollover (NKRO) กดพร้อมกันได้เกิน 20 ปุ่ม</li>\r\n	<li>มีที่ปรับความสูงแบบแม่เหล็ก 2 อัน และ แผ่นยางกันลื่น 4 จุด</li>\r\n	<li>ขนาด 289 mm x 103 mm x 39 mm</li>\r\n	<li>น้ำหนัก 790 กรัม โดยประมาณ</li>\r\n</ul>\r\n', 'royal-kludge-rk84-mechanical-gaming-keyboard-white-01.jpg', '2021-12-09 16:48:34'),
(67, 34, 'CASE TSUNAMI COOLMAN 190-1 PP (LIQUID COMBO) ABLAZE PINK', 1000, 1290, 1000, '<table cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>โครงสร้างเคส แข็งแรง ทนทาน<br />\r\n			เคสออกแบบมาโดยคำนึงถึงความปลอดภัยของผู้ใช้เป็นหลัก<br />\r\n			มาพร้อมกระจกนิรภัยด้านข้าง<br />\r\n			รองรับเมนบอร์ด : ATX, Micro ATX, Mini ITX<br />\r\n			120mm ARGB Liquid Cooling x 1<br />\r\n			ARGB Cooling Fan x 2<br />\r\n			VGA Card Length : 305mm<br />\r\n			CPU Cooler Height : 165mm</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'CASE TSUNAMI COOLMAN 190-1 PP (LIQUID COMBO) ABLAZE PINK.jpg', '2021-12-09 16:48:34'),
(68, 34, 'CASE NZXT H510 FLOW (BLACK)', 1500, 1590, 1000, '<p>NZXT H510 Design เคสคอมพิวเตอร์ที่โดดเด่นเรียบง่ายออกมาให้สามารถระบายความร้อนได้อย่างดี ด้วยขนาดกะทัดรัดนี้เป็นเคสในอุดมคติสำหรับโครงสร้างที่มีประสิทธิภาพสูง และมีแผงด้านหน้าแบบมีรูพรุนเพื่อการไหลเวียนของอากาศสูงสุด H510 นั้นง่ายต่อการประกอบและให้ความยืดหยุ่นสำหรับชิ้นส่วน ATX ที่หลากหลาย</p>\r\n', 'CASE NZXT H510 FLOW (BLACK).png', '2021-12-09 16:48:34'),
(69, 34, 'CASE ITSONAS VAMPIRE TG ARGB WHITE', 1800, 1990, 1000, '<ul>\r\n	<li>มีพัดลม 3 ตัว ( ARGB Fan)</li>\r\n	<li>Side Panel 9 H Tempered Glass</li>\r\n	<li>แผงหน้ากาก : ผลิตจากวัสดุ เกรดA ABS กับ ARGB Strip</li>\r\n	<li>Sync-multi colors support- สามารถปรับไฟพร้อมกันได้</li>\r\n	<li>ARGB พัดลม กับ แผงหน้ากาก สามารถปรับไฟพร้อมกันได้</li>\r\n	<li>Support cable management</li>\r\n	<li>รองรับเมนบอร์ด : ATX / Micro ATX / ITX</li>\r\n	<li>พัดลม ด้านหลัง : 12 ซม x 1 ( ARGB Fan)</li>\r\n	<li>พัดลมด้านบน : 12 ซม x 2 (ARGB Fan)</li>\r\n	<li>แผงข้างหน้ามี&nbsp;USB ให้ 3 Port : USB 2.0 x 2, USB 3.0 x 1</li>\r\n</ul>\r\n', 'CASE ITSONAS VAMPIRE TG ARGB WHITE.jpg', '2021-12-09 16:48:34'),
(70, 34, 'CASE COOLER MASTER MASTERBOX NR200P MINI-ITX -FLAMINGO PINK', 3800, 3990, 950, '<ul>\r\n	<li>NR200P&nbsp;มาพร้อมกับตัวเลือกของแผงด้านข้างที่เป็นเหล็กระบายอากาศสำหรับการไหลเวียนของอากาศที่ไม่ถูก จำกัด หรือแผงด้านข้างกระจกนิรภัยใสเพื่อเผยให้เห็นความงามของอุปกรณ์คอมพิวเตอร์</li>\r\n	<li>มีพัดลม&nbsp;Sickleflow&nbsp;ขนาด&nbsp;120&nbsp;มม.&nbsp;สองตัว</li>\r\n	<li>โครงสร้างที่กะทัดรัดสามารถรองรับตัวระบายความร้อนซีพียูที่มีความสูง&nbsp;155&nbsp;มม.&nbsp;และหม้อน้ำที่มีความยาวสูงสุด&nbsp;280&nbsp;มม.&nbsp;ได้อย่างมีประสิทธิภาพ</li>\r\n	<li>รองรับ&nbsp;Mainboard Mini ITX</li>\r\n</ul>\r\n', 'CASE COOLER MASTER MASTERBOX NR200P MINI-ITX -FLAMINGO PINK.png', '2022-02-09 17:23:52'),
(71, 34, 'CASE NZXT H710 BLACKRED', 2400, 2570, 999, '<p>เคสคอมพิวเตอร์ H710 และ H710i ขนาด mid-tower ถือเป็นเคส ATX ที่จัดสรรพื้นที่ภายในอย่างเหลือเฟือสำหรับงานเกือบทุกประเภท มีตำแหน่งรองรับชุดหม้อน้ำ ขนาด 360 มม. 2 ตำแหน่ง (ด้านบนและด้านหน้า), ฐานยึดพัดลมขนาด 120/140 มม. จำนวน 7 ตัว, โครงยึดตำแหน่ง HDD ขนาด 3.5 นิ้ว จำนวน 3+1 ที่ถอดออกได้ / ปรับเปลี่ยนเป็นถาดใส่ไดรฟ์ 2.5 นิ้ว ได้ 5 ตัว และพอร์ต USB 3.1 Gen 2 type-C ที่ด้านหน้าเคส</p>\r\n', 'CASE NZXT H710 BLACKRED.png', '2022-02-13 16:14:06'),
(72, 25, 'Keychron K2 V.2 Wireless Hot-swappable Mechanical Keyboard', 3800, 3890, 1000, '<p><q>Keychron K2 เป็นคีย์บอร์ดที่รองรับทั้งการใช้งานแบบไร้สาย (Bluetooth) และแบบใช้สาย (Type-C Cable) ออกแบบมาเพื่อประสบการณ์การพิมพ์ที่เหนือระดับ ครบครันทั้งปุ่มอักษรและปุ่มฟังก์ชั่นทั้งหมดที่คุณต้องการ K2 ถูกออกแบบมาในขนาดที่กะทัดรัดแต่สามารถบรรจุแบตเตอรี่ขนาดใหญ่ที่หาไม่ได้ใน Mechanical Keyboard ทั่วไป มาพร้อมกับฟังก์ชัน Hot-swapping ที่ทำให้คุณสามารถปรับแต่งประสบการณ์ได้ตามต้องการ</q></p>\r\n\r\n<hr />\r\n<p><strong>มีอะไรใหม่ ใน K2v2 ?</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<pre>\r\nBluetooth 5.1</pre>\r\n	</li>\r\n	<li>\r\n	<pre>\r\nInclined bottom frame</pre>\r\n	</li>\r\n	<li>\r\n	<pre>\r\nDedicated caps lock backlight</pre>\r\n	</li>\r\n	<li>\r\n	<pre>\r\nHot-swappable</pre>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong>&nbsp;Hot-Swappable Keychron K2</strong></p>\r\n\r\n<p>สามารถถอดและเปลี่ยนสวิตช์ได้โดยที่ไม่ต้องบัดกรี (Soldering) เพียงแค่ถอดสวิตช์ที่จะเปลี่ยนออกแล้วใส่สวิตช์ใหม่ลงไปให้เข้าล็อก เพียงเท่านี้ก็สามารถใช้งานต่อได้ในทันที Keychron K2 จึงทำให้ผู้ใช้งานสามารถเลือกผสมสวิตช์รูปแบบต่าง ๆ ได้ง่าย สะดวก รวดเร็ว และปรับแต่งคีย์บอร์ดได้ตามความต้องการ</p>\r\n', 'Keychron K2v2.jpg', '2021-12-09 16:48:34'),
(73, 5, 'CPU (ซีพียู) INTEL 1200 CORE I7-10700F', 9000, 9900, 989, '<p>Model</p>\r\n\r\n<p>BrandIntel</p>\r\n\r\n<p>ModelIntel Core i7</p>\r\n\r\n<p>Specification Socket1200 Comet Lake 400 Series</p>\r\n\r\n<p>CPU Core / Thread8/16</p>\r\n\r\n<p>Frequency 2.9 GHz</p>\r\n\r\n<p>Turbo 4.8 GHz</p>\r\n\r\n<p>Integrated Graphics</p>\r\n\r\n<p>CPU Bus- Architecture14 nm</p>\r\n\r\n<p>Cache L2- Cache L316 MB</p>\r\n\r\n<p>TDP65 W</p>\r\n\r\n<p>CPU Cooler</p>\r\n\r\n<p>Warranty3 Years</p>\r\n', 'bf884b1702672a2e9ca74678e7d50c9a.jfif', '2021-12-09 16:48:34'),
(74, 5, 'AMD AM4 RYZEN 5 CPU (ซีพียู) 5600X 3.7 GHz', 10000, 10260, 1000, '<p>Sub description CORES : 6 THREADS : 12 DISCRETE GRAPHICS REQUIRED, NO INTEGRATED GRAPHICS. Home COMPUTER HARDWARE (DIY) CPU AMD AM4 : Item#: 0199002919 [ 15,814 view ] CPU (ซีพียู) AMD AM4 RYZEN 5 5600X 3.7 GHz CPU (ซีพียู) AMD AM4 RYZEN 5 5600X 3.7 GHz Sub description CORES : 6 THREADS : 12 DISCRETE GRAPHICS REQUIRED, NO INTEGRATED GRAPHICS. Property Model Brand : AMD Model : AMD Ryzen&trade; 5 Specification CPU Cooler ✔ Socket : AM4 5000 Series CPU Core / Thread : 6/12 Frequency : 3.7 GHz Turbo : 4.6 GHz Architecture : 7 nm Cache L2 : 3 MB Cache L3 : 32 MB TDP : 65 W Warranty Warranty : 3 Years</p>\r\n', '39602819bae6330af120cf262e9063e5.jfif', '2022-01-09 16:48:34'),
(75, 5, 'CPU (ซีพียู) AM4 AMD RYZEN 7 2700X', 7500, 7725, 901, '<p>CPU (ซีพียู) AM4 AMD RYZEN 7 2700X 3.7 GHz 8C 16T ของใหม่ ประกัน 3 ปี *** สินค้าใหม่ รับประกันศูนย์ 3 ปี *** Specification AMD Ryzen 7 2700x 8 Core 16 Thread Base Clock 3.7 GHz Max Boost Clock 4.3 GHz Cache 16 MB Default TDP / TDP 105W Socket AM4 System Memory Type DDR4</p>\r\n', 'c9d7bfaa0228f3e05048362931bff56c.jfif', '2022-01-09 16:48:34'),
(76, 6, 'GALAX GEFORCE GTX 1660 TI 1-CLICK OC 6GB GDDR6', 20000, 23500, 7, '<p><strong>GALAX GTX 1660 TI 1-CLICK OC 6GB GDDR6 - ประกันศูนย์ไทย 3 ปี | VGA การ์ดจอ Galax 1660Ti</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>GRAPHICS ENGINE : GEFORCE GTX 1660 TI</p>\r\n\r\n<p>MEMORY : 6 GB GDDR5 192 BIT</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>NVIDIA&reg; Turing&trade;</p>\r\n\r\n<p>NVIDIA&reg; GeForce Experience</p>\r\n\r\n<p>NVIDIA&reg; Ansel</p>\r\n\r\n<p>NVIDIA&reg; G-SYNC&trade; Compatible</p>\r\n\r\n<p>NVIDIA&reg; Highlights Game Ready Drivers</p>\r\n\r\n<p>Microsoft&reg; DirectX&reg; 12 API, Vulkan API, OpenGL 4.6</p>\r\n\r\n<p>DisplayPort 1.4, HDMI 2.0b, DVI-D</p>\r\n\r\n<p>HDCP 2.2</p>\r\n\r\n<p>NVIDIA&reg; GPU Boost&trade;</p>\r\n\r\n<p>VR Ready</p>\r\n', '81bafc2bac456c589a72ed68b4d17a38.jfif', '2022-01-09 16:48:34'),
(79, 51, 'Acer QG241YSbmiipx 23.8\" VA Gaming Monitor 165Hz', 6400, 6500, 900, '<p>รายละเอียดสินค้า จอคอม Acer QG241YSbmiipx 23.8&quot; VA Gaming Monitor 165Hz จอคอมพิวเตอร์สำหรับการเล่นเกมโดยเฉพาะที่มาด้วยราคาน่าคบหา หน้าจอขนาด 23.8 นิ้ว ดีไซน์ไร้ขอบจอทั้ง 3 ด้าน พาเนลจอ VA ภาพสวย อัตราการรีเฟรชหน้าจอสูงถึง 165 Hz อัตราการตอบสนองหน้าจอที่ 1 มิลลิวินาที เล่นเกมได้สุดมัน จังหวะเคลื่อนไหวไหน ๆ ก็มองเห็น Acer QG241YSbmiipx 23.8&quot; VA Gaming Monitor 165Hz มีฟีเจอร์และเทคโนโลยีเพียบที่ช่วยเสริมประสิทธิภาพการเล่นเกมให้ดียิ่งขึ้น AMD FreeSync&trade; Premium ที่ช่วยลดการฉีกขาดของภาพ สามารถปรับแต่งโหมดภาพตามประเภทเกมที่เล่น สำหรับเกมเมอร์ที่ใช้เวลาเล่นเกมหลายชั่วโมงต่อวันก็สบายตามากยิ่งขึ้นด้วย Blue Light Shield ตัวจอมีลำโพงสองด้าน มีพอร์ตการเชื่อมต่อครบครัน จอคอม Acer QG241YSbmiipx 23.8&quot; VA Gaming Monitor 165Hz เหมาะสำหรับใครที่กำลังมองหาจอคอมเกมมิ่งที่ดีไซน์สวย ประสิทธิภาพดี ราคาสุดคุ้ม ตัวนี้ไม่ควรพลาดเลยครับ</p>\r\n', 'Acer-QG241YSbmiipx-23_8-VA-Gaming-Monitor-165Hz.jpg', '2022-02-09 17:24:36'),
(80, 51, 'MSI 27 VA 2K @ 165Hz G27CQ4 Monitor', 12400, 12500, 998, '<p>MSI 27&quot; VA 2K @ 165Hz G27CQ4 Monitor เป็น<a href=\"https://www.mercular.com/computers-accessories/computer-monitors/\" target=\"_blank\">จอเกมมิ่ง</a>จากแบรนด์ MSI ที่มีชื่อเสียงโด่งดังในเรื่องของฮาร์ดแวร์คอมพิวเตอร์และโน้ตบุ๊ก โดยหน้าจอรุ่นนี้เป็นจอแบบโค้งระดับ 1500R ขนาดหน้าจอกว้าง 27 นิ้วใช้พาเนลการแสดงผลแบบ VA ความละเอียดสูงสุด 2560 x 1440 (2K)&nbsp;อัตราส่วนภาพ 16:9, อัตราส่วนคอนทราสต์ 3000:1, อัตราการตอบสนองต่ำเพียง 1ms, รีเฟรชเรทมากถึง 165Hz&nbsp;นอกจากนั้นยังอัดแน่นมาด้วยฟีเจอร์ รวมไปถึงเทคโนโลยีสมัยใหม่ที่หลากหลาย เช่น เทคโนโลยี AMD FreeSync ,โหมด Night Vision, โหมด Anti-Flicker และ Less Blue Light ซึ่งจะช่วยอำนวยความสะดวกให้แก่ผู้ใช้งานได้มากยิ่งขึ้น เหมาะสำหรับการใช้งานทุกรูปแบบไม่ว่าจะเป็น เล่นเกมหรือสตรีมมิ่ง ใช้รับชมความบันเทิง ทำกราฟิก หรือว่าใช้เป็นจอแสดงผลภาพความละเอียดสูงก็สามารถทำได้ดีเช่นเดียวกัน ในราคาสุดคุ้มค่าครับ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Key Highlight</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>จอเกมมิ่งแบบโค้งพาเนล VA ขนาด 27 นิ้ว</li>\r\n	<li>หน้าจอโค้งระดับ 1500R&nbsp;</li>\r\n	<li>ความละเอียดสูงสุด 2560 x 1440</li>\r\n	<li>อัตราส่วนภาพ 16:9</li>\r\n	<li>อัตราส่วนคอนทราสต์สูงสุด 3000:1</li>\r\n	<li>อัตราการตอบสนอง 1ms</li>\r\n	<li>รีเฟรชเรท 165Hz</li>\r\n	<li>ความสว่าง 250 nits</li>\r\n	<li>เทคโนโลยี AMD FreeSync</li>\r\n	<li>โหมด Anti-Flicker</li>\r\n	<li>โหมด Less Blue Light</li>\r\n	<li>โหมด Night Vision</li>\r\n	<li>178&deg; wide view angle</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n\r\n<h3><strong>การเชื่อมต่อ</strong></h3>\r\n\r\n<p>1x DisplayPort</p>\r\n\r\n<p>2x HDMI</p>\r\n\r\n<p>1x Earphone-Out</p>\r\n', 'MSI-G27CQ4-27-VA-2K-Curved-Gaming-Monitor-165Hz.jpg', '2022-02-09 16:48:34'),
(81, 51, 'Mi Curved BHR5133GL 34\" 2K Curved Gaming Monitor 144Hz', 15900, 15999, 1000, '<p>Mi Curved 34&quot; @144Hz BHR5133GL เป็น<a href=\"https://www.mercular.com/computers-accessories/computer-monitors/\" target=\"_blank\">จอมอนิเตอร์</a>หน้าจอโค้ง จากแบรนด์ Xiaomi โดยมาพร้อมกับขนาดความกว้างมากถึง 34 นิ้ว แต่ขอบบางเพียงแค่ 2 มิลลิเมตร ทำให้สามารถโฟกัสอยู่กับจอได้เป็นอย่างดี หน้าจอโค้งถึง 1500 R&nbsp;ให้มุมมองของภาพแบบพาโนรามา ช่วงสีกว้าง 121% sRGB ความละเอียดภาพสูงสุด 3440 x 1440 (WQHD) เรียกได้ว่าให้รายละเอียดของภาพได้อย่างสมจริง อัตราส่วนของภาพ 21:9 เพื่อรองรับการมัลติทาสก์หลายหน้าจอ อัตราการตอบสนอง 4ms รีเฟรชเรท 144Hz มาพร้อมกับฟีเจอร์การใช้งานที่หลากหลาย ไม่ว่าจะเป็น AMD FreeSync Premium, โหมดแสงสีฟ้าต่ำ นอกจากนี้ตัวฐานยังสามารถหมุน/เอียง ปรับความสูงได้ตามต้องการ เพื่อลดความเมื่อยล้าของคอ รวมไปถึงการติดตั้งบนผนังก็สามารถทำได้อย่างง่ายดาย เหมาะสำหรับผู้ที่กำลังมองหาจอมอนิเตอร์ที่คุ้มค่าในการใช้งานได้อย่างหลากหลาย ไม่ว่าจะเป็นผู้ที่ทำงานกราฟิก ใช้ดูหุ้น ใช้รับชมภาพยนตร์หรือว่าเล่นเกม ก็สามารถตอบสนองทุกความต้องการได้เป็นอย่างดี ในราคาไม่ถึง 16,000 บาท</p>\r\n', 'Mi-Curved-BHR5133GL-34-2K-Curved-Gaming-Monitor-144Hz.jpg', '2022-02-09 16:48:34'),
(82, 51, 'Zowie 24.5\" TN @ 240Hz XL2546 Monitor', 15800, 15900, 999, '<p>จอคอม Zowie 24.5&quot; TN @ 240Hz XL2546 Monitor เป็นจอเกมมิ่งจากแบรนด์ Zowie ในซีรี่ส์ XL ที่ได้รับความนิยมจากเกมเมอร์ระดับมืออาชีพและผ่านการยอมรับโดยทัวร์นาเมนต์เกมมิ่งทั่วโลก&nbsp;จึงการันตรีได้ถึงคุณภาพของสินค้า โดยเป็นจอพาเนล TN ขนาดหน้าจอกว้าง 24.5 นิ้ว ความละเอียดสูงสุด 1920 x 1080 อัตราส่วนภาพ 16:9 อัตรารีเฟรช 240 Hz อัตราการตอบสนองต่ำเพียง 1ms เท่านั้น ติดตั้งฟีเจอร์ในการใช้งานที่หลากหลาย เช่น เทคโนโลยี DyAc&trade;,&nbsp;โหมด Black eQualizer,โหมด Color Vibrance, ปุ่มสำหรับตั้งค่า S-Switch, Game Modes และอื่นๆ อีกมากหมายภายในอุปกรณ์ ด้วยรีเฟรชเรทที่มากถึง 240 Hz ให้ภาพภายในเกมที่ไหลลื่นกว่าจอ 144 Hz เสียอีก จึงทำให้เป็นจอที่เหมาะสำหรับการเล่นเกมประเภท FPS เป็นอย่างมาก ด้านข้างติดตั้งแผ่นกำบังเพื่อเพิ่มการโฟกัสขณะเล่นเกม เรียกได้ว่าเป็นจอ<a href=\"https://www.mercular.com/computers-accessories\" target=\"_blank\">คอมพิวเตอร์</a>ที่ได้รับการยอมรับให้ใช้ในการแข่งขันที่สำคัญหลายรายการสำหรับเกม CS: GO และ PUBG&nbsp;ในปัจจุบันเลยทีเดียว คุ้มค่ากับราคาเป็นอย่างมากครับ</p>\r\n', 'Zowie-XL2546-24_5-TN-Gaming-Monitor-240Hz.jpg', '2022-02-18 16:22:05'),
(83, 51, 'Samsung Odyssey G9 49\" Curved Monitor 240Hz', 49000, 49900, 2511, '<p>หลังจากเปิดตัวอย่างเป็นทางการที่งาน CES 2020 ก็สามารถเรียกกระแสฮือฮาได้เป็นอย่างดีกับ Samsung Odyssey G9 49&quot; Curved @ 240Hz Monitor จอเกมมิ่งระดับไฮเอนด์จากแบรนด์&nbsp;<a href=\"https://www.mercular.com/samsung\" target=\"_blank\">Samsung</a>&nbsp;โดยเป็นจอโค้งขนาดหน้าจอกว้างถึง 49 นิ้ว ใช้พาเนล VA การแสดงผลแบบ QLED ที่งดงามยิ่งกว่า IPS ความละเอียดสูงสุดมากถึง 5120 x 1440 (DQHD) จึงให้ภาพที่คมชัดทุกรายละเอียด อัตราส่วนภาพ 32:9 อัตราส่วนคอนทราสต์ 2,500:1 อัตราการตอบสนองต่ำเพียง 1ms Color Gamut sRGB 125% รีเฟรชเรทมากถึง 240Hz ชูจุดเด่น 4 อย่างด้วยกัน 1.ความโค้งถึงระดับ 1000R 2.หน้าจอสวยงามด้วยเทคโนโลยี QLED, HDR1000 3.แสงไฟ Infinity Core ที่ล้ำสมัย 4.รองรับซอฟต์แวร์ NVIDIA G-Sync และ AMD FreeSync นอกจากนั้นยังอัดแน่นมาด้วยฟีเจอร์ รวมไปถึงเทคโนโลยีสมัยใหม่ที่หลากหลาย ซึ่งจะช่วยอำนวยความสะดวกให้แก้ผู้ใช้งานได้มากยิ่งขึ้น เหมาะสำหรับการใช้งานทุกรูปแบบไม่ว่าจะเป็น เล่นเกมหรือสตรีมมิ่ง ใช้รับชมความบันเทิง ทำกราฟิก หรือว่าใช้เป็นจอแสดงผลภาพความละเอียดสูงก็สามารถทำได้อย่างสมบูรณ์แบบ ราคา 45,990 บาท</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Key Highlight</strong></h3>\r\n\r\n<ul>\r\n	<li>จอมอนิเตอร์ VA แบบโค้ง ขนาดหน้าจอ 49 นิ้ว</li>\r\n	<li>หน้าจอโค้งระดับ 1000R</li>\r\n	<li>ความละเอียด 5120 x 1440</li>\r\n	<li>อัตราส่วนภาพ 32:9</li>\r\n	<li>อัตราการตอบสนอง 1ms</li>\r\n	<li>อัตราส่วนคอนทราสต์ 2,500:1</li>\r\n	<li>ความสว่างสูงสุด 1000 cd/m2</li>\r\n	<li>Color Gamut Srgb 125%</li>\r\n	<li>รีเฟรชเรท 240Hz</li>\r\n	<li>รองรับ HDR1000 และ HDR10+</li>\r\n	<li>Viewing Angle 178 /178 &deg;&nbsp;</li>\r\n	<li>1.07 Billion Colours</li>\r\n	<li>ไฟแสดงผล Infinity Core</li>\r\n	<li>เทคโนโลยี NVIDIA G-Sync</li>\r\n	<li>เทคโนโลยี AMD FreeSync</li>\r\n	<li>โหมด Picture-in-Picture</li>\r\n	<li>หมุน/เอียง/ปรับความสูงได้</li>\r\n</ul>\r\n\r\n<p><strong>﻿การเชื่อมต่อ</strong></p>\r\n\r\n<ul>\r\n	<li>2x DisplayPort</li>\r\n	<li>1x HDMI</li>\r\n	<li>1x USB-B</li>\r\n	<li>1x Earphone Jack 3.5 mm.</li>\r\n	<li>2x USB 3.0</li>\r\n</ul>\r\n', 'Samsung-Odyssey-G9-49-Curved-Monitor-240Hz.jpg', '2022-02-11 08:36:35'),
(85, 53, 'ALPHACOOL EISBAER AURORA 240 MM (120 X 2) DIGITAL RGB *ชุดน้ำปิด', 3900, 3990, 19, '<p>เครื่องทำน้ำเย็นซีพียู Alphacool Eisbaer Aurora AIO เป็นการพัฒนาล่าสุดของเครื่องทำความเย็น Eisbaer ที่เป็นที่นิยมและเป็นที่รู้จักกันดี Alphacool มีการปรับปรุงคุณสมบัติมากมาย แต่ความสามารถในการขยายตัวคูลเลอร์ผ่านทางตัวปลดอย่างรวดเร็วและหม้อน้ำทองแดงคุณภาพสูงที่มีชื่อเสียงได้ถูกรักษาไว้ อ่างเก็บน้ำความจุขนาดใหญ่และความสามารถในการเติมความเย็นก็ยังคงเหมือนเดิม</p>\r\n', 'cooling.jpg', '2022-02-13 16:14:06'),
(86, 53, 'ชุดน้ำปิด DARKFLASH COOLING DT-240 [RGB]', 1800, 1890, 20, '<p>&ldquo;ชุดน้ำปิด DARKFLASH COOLING DT-240 [RGB]&rdquo;</p>\r\n', 'ชุดน้ำปิด DARKFLASH COOLING DT-240 [RGB].jpg', '2022-02-09 16:48:34'),
(87, 53, 'ARCTIC LIQUID FREEZER II - 240 (120 X 2) ชุดน้ำปิด', 1850, 1900, 10, '<p>ARCTIC LIQUID FREEZER II - 240 คุณภาพวัสดุพรีเมี่ยมที่มอบประสิทธิภาพในการระบายความร้อนที่โดดเด่นผ่านการระบายความร้อนด้วยของเหลว ในราคาปานกลาง และยังเป็นออล - อิน - วันคูลเลอร์ที่ไม่ต้องบำรุงรักษาเหมาะสำหรับเคสขนาดเล็กและใหญ่ รวมทั้งครอบคลุมซ็อกเก็ต CPU ที่สำคัญที่สุดในปัจจุบันทั้งหมด นอกจากนี้ยังมีพัดลมที่ตัวปั๊มน้ำ เพื่อช่วยระบายความร้อนที่เมนบอร์ดได้อย่างดีอีกด้วย</p>\r\n', 'ARCTIC LIQUID FREEZER II - 240 (120 X 2) ชุดน้ำปิด.png', '2022-02-09 16:48:34'),
(88, 55, 'ONIKUMA RAIJIN RGB Gaming Mouse', 400, 450, 10, '<p>ONIKUMA RAIJIN เมาส์สำหรับเล่นเกม เมาส์ออฟติคอลพอยเตอร์แม่นยำ สามารถปรับระดับความไวเมาส์ได้ 6 ระดับ 800 / 1,600 / 2,400 / 3,200 / 4,800 / 6,400 เหมาะกับการเล่นเกมประเภท FPS เป็นตัวช่วยในทุกสมรภูมิรบ มีแสงไฟ RGB สามารถสลับเอฟเฟกต์แสงไฟได้ 7 แบบ ตัวเมาส์ออกแบบตามสรีรศาสตร์ รูปทรงกระทัดรัด น้ำหนักเบา ออกแบบเหมือนรังผึ้งทำให้จับกระชับมือขึ้นและใช้งานไปนานๆไม่ทำให้เมื่อยมือ ตัวเมาส์มีถึง 6 ปุ่ม ใช้งานได้คล่องแคล่วมากขึ้น รับประกันสินค้า 2 ปี ไดร์เวอร์ https://www.onikumagaming.com/pages/copy-of-privacy-policy คุณสมบัติ &bull; เมาส์ออฟติคอลพอยเตอร์แม่นยำ &bull; สามารถปรับระดับความไวเมาส์ได้ 6 ระดับ 800 / 1,600 / 2,400 / 3,200 / 4,800 / 6,400 &bull; มีแสงไฟ RGB สามารถสลับเอฟเฟกต์แสงไฟได้ 7 แบบ &bull; ตัวเมาส์ออกแบบตามสรีรศาสตร์ รูปทรงกระทัดรัด น้ำหนักเบา &bull; ออกแบบเหมือนรังผึ้งทำให้จับกระชับมือขึ้นและใช้งานไปนานๆไม่ทำให้เมื่อยมือ &bull; ตัวเมาส์มีถึง 6 ปุ่ม ใช้งานได้คล่องแคล่วมากขึ้น &bull; รับประกันสินค้า 2 ปี คำแนะนำการใช้ นำเมาส์เสียบ USB รับสัญญาณเข้ากับคอมพิวเตอร์ ระบบจะค้นหาไดร์เวอร์ติดตั้งลงคอมพิวเตอร์ให้โดยอัตโนมัติ การใช้งาน 1.การเปลี่ยนสีไฟ : กดปุ่ม DPI + ปุ่มคลิกซ้าย พร้อมกัน เพื่อสลับเอฟเฟกต์แสงไฟ 7 แบบที่แตกต่างกัน 2.การปรับ DPI : กดปุ่ม DPI สั้นๆ เพื่อปรับค่า DPI ค่าเริ่มต้น 800 DPI (DPI 6 สี : เขียว - 800 / ม่วง - 1,600 / ฟ้า -2,400 / แดง - 3,200 / ฟ้าอมเขียว - 4,800 / เหลือง - 6,400) หมายเหตุ 1.ห้ามใช้เมาส์บนแก้วหรือกระจก 2.ฟังก์ชั่นโปรแกรมมีเฉพาะในระบบปฎิบัติการณ์ Windows 3.ปุ่มไปข้างหน้าและย้อนกลับ ไม่รองรับในระบบ Mac OS Product Parameters Type : Wired Gaming Mouse For PC / Laptop Product Dimension : 125.86x63.30x38.95mm Support System : Windows XP / 7 / 8 / 10 MAC , or latest Default DPI : 800 Green / 1,600 Purple / 2,400 Blue / 3,200 Red / 4,800 Cyan / 6,400 Yellow Light Color : RGB Working Voltage : 5V Interface : USB Working Current : Less Than 100MA Material : PC Cable Length : 1.5 M Weight : 110 g</p>\r\n', 'd9ca7379602b97e9c6c1768f4f8a1be8.jfif', '2022-02-09 16:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `name_first` varchar(50) NOT NULL,
  `name_second` varchar(50) NOT NULL,
  `name_third` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `name_first`, `name_second`, `name_third`) VALUES
(1, 'ที่ต้องชำระ', 'รอชำระเงิน', 'ชำระเงิน'),
(2, 'สลิปผิด', 'รอแก้สลิป', 'สลิปผิด'),
(3, 'รอดำเนินการ', 'ตรวจสอบ', 'รอการตรวจสอบ'),
(4, 'ที่ต้องจัดส่ง', 'กรอกเลขพัสดุ', 'รอการจัดส่ง'),
(5, 'ที่ต้องได้รับ', 'ส่งของแล้ว', 'ตรวจสอบเลขพัสดุ'),
(6, 'สำเร็จ', 'ยืนยันแล้ว', 'ส่งของสำเร็จ'),
(7, 'ยกเลิก', 'ยกเลิกแล้ว', 'โดนยกเลิก'),
(8, 'คืนเงิน', 'คืนเงินแล้ว', 'ขอคืนเงินสำเร็จ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `username`, `password`, `fullname`, `tel`, `email`, `address`, `role`, `created_at`) VALUES
(3, 'payut55', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', 'ประยุท สุดจริง', '0853142565', 'payut556@hotmail.com', '416/27 ถ.ยอสนยา ต.ในเมือง อ.เมือง จ.นครราชสีมา 99858\r\n', 'member', '2022-01-05 15:34:57'),
(4, 'tanyalnw123', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', 'ธันยาเทพ นักรน', '0852432168', 'tanyalnw123@gmail.com', '417/27 ถ.ยอสนยา ต.ในเมือง อ.เมือง จ.นครราชสีมา 998565', 'member', '2022-01-06 13:03:34'),
(5, 'superman', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '0952135467', 'superman@hotmail.com', '', 'member', '2022-01-05 15:35:00'),
(13, 'ironman', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', 'ไอรอน แมน', '0751234555', 'ironman@hotmail.com', '', 'member', '2022-01-05 15:35:01'),
(14, 'eternal123', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', '', '0845625819', 'eternal123@gmail.com', '', 'member', '2022-01-05 15:35:02'),
(15, 'spiderman123', '777056d935845cae10ba6e562a4b0efec640dba7394728310af53df2b683a39f', '', '0545424546', 'spiderman123@gmail.com', '', 'member', '2022-01-05 15:35:03'),
(17, 'spiderman555', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', '', '05121545', 'spiderman555@gmail.com', '', 'member', '2022-01-05 15:35:04'),
(18, 'eternal555', '56d1e541c850b015e5a669edeb0dcd7fda9d66ee73d71868e25e3a13be783ede', 'ทดสอบ oop', '02151515', 'eternal555@gmail.com', 'ดวงจันทร์ ซอย 8', 'member', '2022-01-05 15:35:05'),
(19, 'prawit555', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', 'สมชาย นายเดน', '0974512384', 'prawit555@gmail.com', 'กทม 90786', 'member', '2022-01-05 15:35:07'),
(20, 'tanyalnw555', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', '', '555', 'tanyalnw555@gmail.com', '', 'admin', '2021-12-16 05:16:50'),
(21, 'tanyalnw666', '$2b$10$qYs4j5TtP42jaQJkUSajQOMfGJOSQgmv1GahzKCw/BXswpUMZBOii', '', '12413', 'tanyalnw666@gamil.conm', '', 'member', '2022-01-05 15:35:09'),
(22, 'captain', 'f0aae7f9ffce712e2afb4b05409b2b32cc2d6fefd86bac81896df5cc48c7980c', '', '123456789', 'captain@htc.ac.th', '', 'member', '2022-01-05 15:35:11'),
(23, 'zeronice', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', 'สรพล สงสัย', '095344468', 'zeronice@xyz.com', 'ท่าช้าง เกสมพง 4789', 'member', '2022-01-05 15:35:12'),
(24, 'freeguy', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', 'ฟรีกาย ใจงาม', '12345', 'weerawat4331@gmail.com', 'ในใจคุณ 911', 'member', '2022-01-05 15:35:13'),
(25, 'jojo123', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '12345', 'jojo@gmail.com', '', 'member', '2022-01-05 15:35:16'),
(26, 'topfive', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', 'สมใจ ทองคำ', '0852432168', '63309010075@htc.ac.th', 'ซอยรักบาง9/1 91107', 'member', '2022-01-05 15:35:17'),
(27, 'freeguyfff', 'fca9217c8d5d97cd26820f1f220ca46cd43e6180275248f5961cad747265bc73', '', '0421847109', 'fdakjk@mail.com', '', 'member', '2022-01-05 15:35:18'),
(32, 'abc', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '2777', 'acb@GG.com', '', 'member', '2022-01-05 15:35:21'),
(33, 'qq', 'e2f7cab7507c2d5a7f84e11a35f813eca82d89dc385561a196f2cc7f30b2ed18', '', '0987284771', 'qq@s', '', 'admin', '2022-01-05 02:39:01'),
(34, 'as', 'e2f7cab7507c2d5a7f84e11a35f813eca82d89dc385561a196f2cc7f30b2ed18', '', '1', '1@s', '', 'member', '2022-01-05 15:35:24'),
(35, 'admin', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', '', '1234', 'admin@vhavecpu.com', '', 'admin', '2021-12-18 12:00:35'),
(36, 'kk123', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '4781289674', 'kk123@gmail.com', '', 'member', '2022-01-05 15:35:26'),
(37, 'jk', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '123', 'jk@s', '', 'admin', '2022-01-05 02:58:26'),
(38, 'ok', 'e9b9718b3a5fd07385e10a024c15bffd3af9e38b7abf2350f02e83d5fa4df670', '', '123', 'ok@sk', '', 'admin', '2022-01-05 03:02:01'),
(45, 'sss', '09b4c69d1a9530556dbc7ca5286f179660632f2bda0a5804dda60709733a775c', '', '1', '2@f', '', 'member', '2022-01-09 08:20:45'),
(49, 'superbuss_', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', 'บัส สาน', '123', '123@fg', '87 ถ.สุขมุวิท ต.ปากน้า อ.เมือง จ.สมทุรปราการ 10270', 'member', '2022-01-09 08:55:02'),
(66, 'superwoman_p', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '123', 's@s', '', 'admin', '2022-01-09 08:48:30'),
(67, 'topten', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', 'ชวน ไชย', '478344', 'h@k', 'สมมติ', 'member', '2022-01-10 06:48:58'),
(68, 'mobile', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', 'มือถือ', '0956484648', 'g@wm.op', 'ไม่งอก 273636', 'member', '2022-01-10 11:52:19'),
(69, 'iamaboy123', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '4618467891', 'k@fg', '', 'member', '2022-01-15 20:59:47'),
(72, 'iamaman678', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '3679847893', 'fff@f', '', 'member', '2022-01-15 21:12:16'),
(73, 'iamaboy123mm', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '1231231', 'g@d', '', 'member', '2022-01-15 21:14:34'),
(74, 'iamaboy123pp', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '123131', 'fg@d', '', 'member', '2022-01-15 21:16:40'),
(75, 'iamaboy123pps', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '123131', 'fg@d', '', 'member', '2022-01-15 21:17:58'),
(76, 'iamaboy123ppsq', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '123131', 'fg@d', '', 'member', '2022-01-15 21:19:20'),
(77, 'iamaboy123ppsqaa', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '123131', 'fg@d', '', 'member', '2022-01-15 21:19:40'),
(78, 'tanyalnw123kkkk', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '12313', 'ff@jk', '', 'member', '2022-01-15 22:40:10'),
(85, 'lovejsu', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', 'วี', '4763892748', 'jsu@gmail.com', 'ในน้ำ', 'member', '2022-02-08 13:10:39'),
(87, 'user88', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', 'วีรวัฒน์ สุขบัวแก้ว', '2387128937', 'admin@admin.com', 'สงขลา', 'member', '2022-02-09 02:54:50'),
(88, 'vokath', '7c7fabfa9180f3bbb31590f0c47f901b224f17ac539783010b231bd73478c9dc', '', '0978461624', 'vokath@gmail.com', '', 'member', '2022-02-18 16:26:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_banks`
--
ALTER TABLE `tb_banks`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_banks_th`
--
ALTER TABLE `tb_banks_th`
  ADD PRIMARY KEY (`id_bankth`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pay`
--
ALTER TABLE `tb_pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `name` (`name_first`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_banks`
--
ALTER TABLE `tb_banks`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `tb_pay`
--
ALTER TABLE `tb_pay`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

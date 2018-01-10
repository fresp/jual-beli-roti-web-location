-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2017 at 04:30 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbroit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(11) NOT NULL,
  `adm_fullname` varchar(100) DEFAULT NULL,
  `adm_username` varchar(15) DEFAULT NULL,
  `adm_password` varchar(50) DEFAULT NULL,
  `adm_status` char(1) DEFAULT NULL,
  `adm_created` datetime DEFAULT NULL,
  `adm_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `adm_fullname`, `adm_username`, `adm_password`, `adm_status`, `adm_created`, `adm_modified`) VALUES
(1, 'Freza Nugraha', 'admin', '88d7d2c14c40c67d58cad343eb93dcf6', 'Y', '2017-07-03 03:53:00', NULL),
(2, 'Nuri Amalia Putri', 'adminputri', '88d7d2c14c40c67d58cad343eb93dcf6', 'Y', '2017-07-03 03:53:00', NULL),
(7, 'Linda Sari Dewi', 'linda170802', '620aae17b3ad00510827861697dde4cf', 'Y', '2017-08-02 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `cart_qty` int(11) DEFAULT NULL,
  `cart_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ctgr_id` int(11) NOT NULL,
  `ctgr_name` varchar(255) DEFAULT NULL,
  `ctgr_created` datetime DEFAULT NULL,
  `ctgr_modifed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ctgr_id`, `ctgr_name`, `ctgr_created`, `ctgr_modifed`) VALUES
(1, 'Kue Tradisional', '2017-05-10 23:58:00', NULL),
(2, 'Roti Tawar', '2017-05-10 23:58:00', NULL),
(3, 'Roti Manis', '2017-05-10 23:58:00', NULL),
(4, 'Donat', '2017-05-10 23:58:00', NULL),
(5, 'Cake', '2017-05-10 23:58:00', NULL),
(6, 'Tart', '2017-05-10 23:58:00', NULL),
(7, 'Keringan', '2017-05-10 23:58:00', NULL),
(8, 'Lain lain', '2017-05-10 23:58:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `cust_lat` float(10,6) DEFAULT NULL,
  `cust_long` float(10,6) DEFAULT NULL,
  `cust_receivedname` text,
  `cust_address` text,
  `cust_phone` varchar(25) DEFAULT NULL,
  `cust_nerbie` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `mem_id`, `cust_lat`, `cust_long`, `cust_receivedname`, `cust_address`, `cust_phone`, `cust_nerbie`) VALUES
(5, 1, -6.267890, 106.827507, 'Freza Nugraha', 'Jl.Terusan Pejaten Barat Rt : 011/008 No.23\r\npatokan rumah ool sdam', '081212213427', 'Jl. Terusan Pejaten Barat II, Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510, Indonesia'),
(6, 1, -6.289611, 106.839958, 'Nuri Amalia Putri', 'Jl.Raya Margonda', '081212213427', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia'),
(7, 14, -6.302409, 106.840836, 'Freza Nugraha', 'Gang Haji Mahmud Rt : 011/008 No.23', '+629999999999', 'Universitas Tama Jagakarsa, Jl. Tj. Barat Raya, Tj. Bar., Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12530, Indonesia'),
(8, 14, -6.302409, 106.840836, 'Freza Nugraha', 'Gang Haji Shodik Rt : 011/008 No.23', '+629999999999', 'Universitas Tama Jagakarsa, Jl. Tj. Barat Raya, Tj. Bar., Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12530, Indonesia'),
(9, 1, -6.270480, 106.837997, '', '', '', 'Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia'),
(10, 1, -6.270480, 106.837997, 'Freza Nugraha', 'Jl.Terusan Pejaten Barat II', '081212213427', 'Pejaten Bar., Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia'),
(12, 17, -6.289610, 106.839996, 'Putri', 'Depan Ramayana Pasar Minggu', '81212213427', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia'),
(13, 17, -6.289610, 106.839996, 'Freza Nugraha', 'Depan Robinson Pasar Minggu', '81212213427', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia'),
(14, 17, -6.289610, 106.839996, 'Freza Nugraha', 'Depan Ramayana Pasar Minggu', '81212213427', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `inv_id` int(11) NOT NULL,
  `inv_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `inv_duedate` datetime DEFAULT CURRENT_TIMESTAMP,
  `mem_id` int(11) DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `inv_note` text NOT NULL,
  `inv_totalpayment` int(11) DEFAULT NULL,
  `inv_method` varchar(10) NOT NULL,
  `inv_status` varchar(25) DEFAULT NULL,
  `inv_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `lapak`
--

CREATE TABLE `lapak` (
  `lpk_id` int(11) NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `lpk_name` varchar(50) DEFAULT NULL,
  `lpk_username` varchar(12) NOT NULL,
  `lpk_picture` text,
  `lpk_freeongkir` int(11) DEFAULT NULL,
  `lpk_activehour` varchar(12) NOT NULL,
  `lpk_lat` float(10,6) DEFAULT NULL,
  `lpk_long` float(10,6) DEFAULT NULL,
  `lpk_nerbie` text NOT NULL,
  `lpk_status` char(1) DEFAULT NULL,
  `lpk_created` datetime DEFAULT NULL,
  `lpk_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `lapak`
--

INSERT INTO `lapak` (`lpk_id`, `mem_id`, `lpk_name`, `lpk_username`, `lpk_picture`, `lpk_freeongkir`, `lpk_activehour`, `lpk_lat`, `lpk_long`, `lpk_nerbie`, `lpk_status`, `lpk_created`, `lpk_modified`) VALUES
(1, 2, 'Roti aisya', 'rotiaisya', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.356838, 106.833511, '', 'Y', '2017-04-24 00:00:00', NULL),
(2, 3, 'Roti pok ningsih', 'rotiningsih', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.353729, 106.838547, '', 'Y', '2017-04-24 00:00:00', NULL),
(3, 4, 'Roti fadhilah', 'rotifadhilah', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.359752, 106.833229, '', 'Y', '2017-04-24 00:00:00', NULL),
(4, 5, 'Toko Kue Bang putra', 'kueputra', 'Resep-Kue-Kering-Lebaran.jpg', 1, '07:00-19:00', -6.352183, 106.832878, '', 'Y', '2017-04-24 00:00:00', NULL),
(5, 6, 'Roti pok lehan', 'rotilehan', 'Resep-Kue-Kering-Lebaran.jpg', 1, '07:00-19:00', -6.357231, 106.837784, '', 'Y', '2017-04-24 00:00:00', NULL),
(6, 7, 'Toko Kue Bang ulandari', 'kueulandari', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.354728, 106.839500, '', 'Y', '2017-04-24 00:00:00', NULL),
(7, 8, 'Roti Bang saputra', 'rotiputra', 'Resep-Kue-Kering-Lebaran.jpg', 1, '07:00-19:00', -6.280509, 106.829063, '', 'Y', '2017-04-24 00:00:00', NULL),
(8, 9, 'marlina cake factory', 'marlifactory', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.280534, 106.820023, '', 'Y', '2017-04-24 00:00:00', NULL),
(9, 10, 'Roti sutomo', 'rotisutomo', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.277036, 106.820335, '', 'N', '2017-04-24 00:00:00', NULL),
(10, 11, 'Toko Kue dwiputri', 'kuedwiputri', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.258906, 106.825172, '', 'Y', '2017-04-24 00:00:00', NULL),
(11, 12, 'Toko Kue sari', 'kuesari', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.264782, 106.827858, '', 'Y', '2017-04-24 00:00:00', NULL),
(12, 13, 'faisal Cake', 'faisalcake', 'Resep-Kue-Kering-Lebaran.jpg', 0, '07:00-19:00', -6.264782, 106.827858, '', 'Y', '2017-04-24 00:00:00', NULL),
(13, 1, 'Roti Unyil', 'frezanugraha', 'bakground-frezanugraha-36676.png', 0, '08:00-13:00', -6.289611, 106.839958, 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', 'Y', '2017-04-28 00:00:00', NULL),
(14, 15, 'Tori Backery', 'toritori', 'Resep-Kue-Kering-Lebaran.jpg', 1, '07:00-19:00', -6.307920, 106.838364, '', 'Y', '2017-05-04 00:00:00', NULL),
(15, 14, 'muhammad Cake', 'shehcake', 'Scan.jpg', 0, '07:00-19:00', -6.289611, 106.839958, '', 'Y', '2017-06-15 00:00:00', NULL),
(16, 16, 'Roti mang ujang', 'lapakeza', 'Scan.jpg', 1, '', -6.356831, 106.833412, '', 'Y', '2017-06-30 00:00:00', NULL),
(17, 19, 'bulinda', 'bulinda', 'm.facebook.com.jpg', NULL, '', -6.289611, 106.839958, '', 'Y', '2017-07-12 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` int(11) NOT NULL,
  `mem_firstname` varchar(50) DEFAULT NULL,
  `mem_lastname` varchar(50) DEFAULT NULL,
  `mem_email` varchar(100) DEFAULT NULL,
  `mem_phone` varchar(13) DEFAULT NULL,
  `mem_password` varchar(50) DEFAULT NULL,
  `mem_status` char(1) DEFAULT NULL,
  `mem_nerbie` text NOT NULL,
  `mem_lat` float NOT NULL,
  `mem_long` float NOT NULL,
  `mem_verification` varchar(10) DEFAULT NULL,
  `mem_tmpphone` varchar(13) DEFAULT NULL,
  `mem_expotp` datetime DEFAULT NULL,
  `mem_created` datetime DEFAULT NULL,
  `mem_modified` datetime DEFAULT NULL,
  `mem_lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `mem_firstname`, `mem_lastname`, `mem_email`, `mem_phone`, `mem_password`, `mem_status`, `mem_nerbie`, `mem_lat`, `mem_long`, `mem_verification`, `mem_tmpphone`, `mem_expotp`, `mem_created`, `mem_modified`, `mem_lastlogin`) VALUES
(1, 'Freza', 'Nugraha', 'frezanugraha404@gmail.com', '081212213427', '88d7d2c14c40c67d58cad343eb93dcf6', 'Y', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', -6.28961, 106.84, 'P8CI4017', '089652448408', '2017-07-18 05:13:17', '2017-04-24 00:00:00', NULL, '2017-08-02 02:54:06'),
(2, 'marqo', 'aisya', 'marqoaisya@gmail.com', '081212213420', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, '2017-04-28 04:42:35'),
(3, 'yulaini', 'ningsih', 'yulaininingsih@gmail.com', '081212213421', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(4, 'noor', 'fadhilah', 'noorfadhilah@gmail.com', '081212213422', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(5, 'opiansyah', 'putra', 'opiansyahputra@gmail.com', '081212213423', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(6, 'muhammad', 'lehan', 'muhammadlehan@gmail.com', '081212213424', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(7, 'yessi', 'ulandari', 'yessiulandari@gmail.com', '081212213425', 'ba690a1d340660095dc1dbd0053052b7', 'N', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(8, 'wisnu', 'saputra', 'wisnusaputra@gmail.com', '081212213426', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(9, 'marlina', 'putri', 'marlinaputri@gmail.com', '081212213428', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(10, 'zakaria', 'sutomo', 'zakariasutomo@gmail.com', '081212213427', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(11, 'astri', 'dwiputri', 'astridwiputri@gmail.com', '081212213429', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(12, 'puspita', 'sari', 'puspitasari@gmail.com', '081212213430', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(13, 'ahmad', 'faisal', 'ahmadfaisal@gmail.com', '081212213431', 'ba690a1d340660095dc1dbd0053052b7', 'Y', '', 0, 0, '', NULL, NULL, '2017-04-24 00:00:00', NULL, NULL),
(14, 'sheh', 'muhammad', 'shehmuhammad@gmail.com', '081212213427', '8164f3538736833bc491babe10734a27', 'Y', '', 0, 0, '', NULL, '2017-07-16 06:26:31', '2017-04-24 00:00:00', NULL, '2017-07-15 02:57:58'),
(15, 'tori', 'tori', 'toritori@gmail.com', '081212213432', '88d7d2c14c40c67d58cad343eb93dcf6', 'Y', '', 0, 0, '', NULL, NULL, '2017-05-04 00:00:00', NULL, '2017-07-05 01:33:15'),
(16, 'Ini.', 'Freza', 'inifreza@gmail.com', '085716527906', '88d7d2c14c40c67d58cad343eb93dcf6', 'Y', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', -6.28961, 106.84, '', NULL, NULL, '2017-06-29 00:00:00', NULL, '2017-06-30 16:39:27'),
(17, 'Nuri', 'Amalia', 'nuriamaliaputri@gmail.com', '08229946815', '88d7d2c14c40c67d58cad343eb93dcf6', 'Y', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', -6.28961, 106.84, 'CS2EK0JK', NULL, NULL, '2017-07-05 00:00:00', NULL, '2017-08-02 03:25:39'),
(18, 'dhea', 'anisa', 'dheaanisapuri@gmail.com', '081213456548', 'd3a07cfe44214ab831f1aca848970df2', 'N', '', 0, 0, 'XKUYEK4W', NULL, NULL, '2017-07-06 00:00:00', NULL, NULL),
(19, 'Bulinda', 'Sari', 'bulinda@gmail.com', '089652448408', '5e0b90a39ea54e37ca699b9eb33d50d6', 'Y', 'Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', -6.28961, 106.84, '5MQJOVZE', NULL, '2017-07-17 02:02:49', '2017-07-12 00:00:00', NULL, '2017-07-19 05:03:09'),
(20, 'dasd asd', '', '', '', '569208097dd73e5faf04db2220bc8628', 'N', '', 0, 0, '0TI098KF', NULL, NULL, '2017-07-18 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `lpk_id` int(11) DEFAULT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `order_shippingtotal` int(11) DEFAULT NULL,
  `order_grandtotal` int(11) DEFAULT NULL,
  `order_status` varchar(35) NOT NULL,
  `order_shipstat` varchar(25) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `dtl_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `pro_price` int(11) DEFAULT NULL,
  `dtl_qty` int(11) DEFAULT NULL,
  `dtl_subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `pro_id` int(11) NOT NULL,
  `lpk_id` int(11) DEFAULT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `ctgr_id` int(11) DEFAULT NULL,
  `pro_image` text,
  `pro_saleprice` int(11) DEFAULT NULL,
  `pro_discountprice` int(11) DEFAULT NULL,
  `pro_status` varchar(8) DEFAULT NULL,
  `pro_description` text,
  `pro_freeongkir` text,
  `pro_created` datetime DEFAULT NULL,
  `pro_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`pro_id`, `lpk_id`, `pro_name`, `ctgr_id`, `pro_image`, `pro_saleprice`, `pro_discountprice`, `pro_status`, `pro_description`, `pro_freeongkir`, `pro_created`, `pro_modified`) VALUES
(1, 13, 'Cake Karino', 5, 'kirino-frezanugraha-590276.png', 10000, NULL, 'dijual', NULL, '1', '2017-05-01 00:00:00', NULL),
(2, 13, 'Kue Kering Lebaran', 1, 'Resep-Kue-Kering-Lebaran.jpg', 10000, NULL, 'dijual', 'ini isi deskirpsinya', '1', '2017-05-01 00:00:00', NULL),
(3, 13, 'Kue Sadis', 3, 'koala-frezanugraha-874256.jpg', 123123, NULL, 'tidak', '1asdasdad', '1', '2017-05-01 00:00:00', NULL),
(4, 15, 'Kue Modern', 1, 'lighthouse-frezanugraha-287648.jpg', 5000, NULL, 'dijual', 'asdasd 131 dasd as\r\ndasdasdsa asdasd 131 dasd as\r\ndasdasdsa asdasd 131 dasd as\r\ndasdasdsaasdasd 131 dasd as\r\ndasdasdsa', '2', '2017-05-01 00:00:00', NULL),
(5, 13, 'Kue Tradisional', 1, '1111-frezanugraha-235430.png', 50000, NULL, 'review', 'asdasdasdsadsa', '1', '2017-05-06 00:00:00', NULL),
(6, 13, 'Kue Lelah', 3, '', 1000, NULL, 'dijual', 'lelah capekasdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '', '2017-05-06 00:00:00', NULL),
(15, 13, 'Kue dunia', 7, 'www-icon-seo-browser-development-www-symbol-ui-web-logo-sign-flat-design-app-stock-vector-80145197-frezanugraha-611077.jpg', 40000, NULL, 'review', 'Kue dunia dengan cita rasa bintang 10', '2', '2017-06-16 00:00:00', NULL),
(16, 13, 'Kue Hambalang', 1, '204398-kondisi-hambalang-sekarang-frezanugraha-263249.jpg', 10000, NULL, 'review', 'asdasdasdasd', '2', '2017-06-25 00:00:00', NULL),
(17, 13, 'Kue BSI', 1, 'atmmandiri-frezanugraha-864058.gif', 10000, NULL, 'review', 'asdsadasd', '2', '2017-06-25 00:00:00', NULL),
(18, 13, 'asdsa', 1, 'female-fashion-trend-of-shopping-bags-vector-illustration-silhouettes-243794-frezanugraha-341784.jpg', 10000, NULL, 'review', 'asdasd', '1', '2017-06-25 00:00:00', NULL),
(19, 15, 'asdsad', 1, 'hambalang-frezanugraha-154014.jpg', 10000, NULL, 'dijual', '123123123', '1', '2017-06-25 00:00:00', NULL),
(20, 14, 'sdasd', 1, 'twitter-sby-nih2_20170120_154649-frezanugraha-525621.jpg', 50000, NULL, 'dijual', 'asdasdsad', '2', '2017-06-25 00:00:00', NULL),
(21, 14, 'Kue Fashion', 1, 'fashion-women-shopping-17-792879519-frezanugraha-742963.jpg', 5500, NULL, 'dijual', 'huehuedasdsad', '2', '2017-06-25 00:00:00', NULL),
(22, 13, 'fREZAAA', 1, 'scan-frezanugraha-963811.jpg', 50000, NULL, 'review', 'ASDASDASDASD', '1', '2017-06-29 00:00:00', NULL),
(23, 13, '', 1, '15585201_1717425178283699_96219660996607684_o-frezanugraha-733665.jpg', 0, NULL, 'review', '', '2', '2017-07-12 00:00:00', NULL),
(24, 13, '', 1, '20117086_1479510578777007_8947972934193813113_o-frezanugraha-450897.jpg', 0, NULL, 'review', '', '2', '2017-07-18 00:00:00', NULL),
(25, 13, '', 1, 'mobile.facebook.com-frezanugraha-957074.jpg', 0, NULL, 'review', '', '2', '2017-07-18 00:00:00', NULL),
(26, 13, '', 1, '15585201_1717425178283699_96219660996607684_o-frezanugraha-172215.jpg', 0, NULL, 'review', '', '', '2017-07-18 00:00:00', NULL),
(27, 13, 'asdasdasd', 3, '20117086_1479510578777007_8947972934193813113_o-frezanugraha-16304.jpg', 10000, NULL, 'review', 'asdasdadasdasdadasdasdadasdasdadasdasdadasdasdadasdasdad\r\nasdasdadasdasdadasdasdadasdasdadasdasdad\r\n\r\n\r\nasdasdadasdasdad\r\nasdasdad', '', '2017-07-18 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `sld_id` int(11) NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `sld_desc` varchar(100) NOT NULL,
  `sld_amount` int(11) DEFAULT NULL,
  `sld_status` varchar(255) DEFAULT NULL,
  `sld_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `wdr_id` int(11) NOT NULL,
  `sld_id` int(11) NOT NULL,
  `wdr _amount` int(11) NOT NULL,
  `wdr _bank` varchar(50) NOT NULL,
  `wdr _accountname` varchar(50) NOT NULL,
  `wdr _accountnumber` varchar(20) NOT NULL,
  `wdr _status` varchar(10) NOT NULL,
  `wdr _created` datetime NOT NULL,
  `wdr _modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ctgr_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `lapak`
--
ALTER TABLE `lapak`
  ADD PRIMARY KEY (`lpk_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`dtl_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`sld_id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`wdr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ctgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lapak`
--
ALTER TABLE `lapak`
  MODIFY `lpk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `dtl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `sld_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `wdr_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

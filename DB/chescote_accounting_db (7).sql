-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 10:49 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chescote_accounting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_payments_tb`
--

CREATE TABLE `advance_payments_tb` (
  `advace_id` int(12) NOT NULL,
  `amount` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `qty` int(12) NOT NULL,
  `branch_id` int(12) NOT NULL,
  `order_no` int(12) NOT NULL,
  `customer_name` text NOT NULL,
  `price` int(12) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advance_payments_tb`
--

INSERT INTO `advance_payments_tb` (`advace_id`, `amount`, `date_added`, `user_id`, `prod_id`, `qty`, `branch_id`, `order_no`, `customer_name`, `price`, `status`) VALUES
(1, '2', '2019-10-11 11:09:01', 8, 618, 1, 1, 1998, 'Test', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `tpin` varchar(222) NOT NULL,
  `logo` varchar(222) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `branch_contact` varchar(50) NOT NULL,
  `reciept_footer_text` text NOT NULL,
  `notification_count` int(12) NOT NULL,
  `skin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `tpin`, `logo`, `branch_name`, `branch_address`, `branch_contact`, `reciept_footer_text`, `notification_count`, `skin`) VALUES
(1, 'TPIN : 1002938663', 'qualitech.JPG', 'Builders Village', 'Lusaka,\r\nZambia.', '260976697900/+260975280558', 'Thank you for shopping with us. ', 5, 'red');

-- --------------------------------------------------------

--
-- Table structure for table `cashout_limits_tb`
--

CREATE TABLE `cashout_limits_tb` (
  `id` int(12) NOT NULL,
  `cashoutlimit` text NOT NULL,
  `status` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashout_limits_tb`
--

INSERT INTO `cashout_limits_tb` (`id`, `cashoutlimit`, `status`, `date_added`) VALUES
(1, '10', 'Not Active', '2020-11-29 15:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(59, 'HARDWARE'),
(60, 'SOFTWARE'),
(61, 'OTHER SERVICES');

-- --------------------------------------------------------

--
-- Table structure for table `credit_outgoing_stock`
--

CREATE TABLE `credit_outgoing_stock` (
  `id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` text NOT NULL,
  `customer` text NOT NULL,
  `user_id` int(12) NOT NULL,
  `order_no` int(12) NOT NULL,
  `price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_outgoing_stock`
--

INSERT INTO `credit_outgoing_stock` (`id`, `prod_id`, `date_added`, `qty`, `customer`, `user_id`, `order_no`, `price`) VALUES
(20, 99, '2019-10-15 16:06:07', '1', 'FADAK-NEW', 8, 1364, '55.00'),
(21, 100, '2019-10-15 16:06:07', '1', 'FADAK-NEW', 8, 1364, '55.00'),
(22, 103, '2019-10-15 16:11:18', '1', 'FADAK-NEW', 8, 1364, '55');

-- --------------------------------------------------------

--
-- Table structure for table `credit_payments`
--

CREATE TABLE `credit_payments` (
  `credit_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `amount` text NOT NULL,
  `invoice_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_payments`
--

INSERT INTO `credit_payments` (`credit_id`, `user_id`, `amount`, `invoice_no`) VALUES
(7, 8, '5600', '1402');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_first` varchar(50) NOT NULL,
  `cust_last` varchar(30) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `cust_contact` varchar(30) NOT NULL,
  `balance` text NOT NULL,
  `cust_pic` varchar(300) NOT NULL,
  `bday` date NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `house_status` varchar(30) NOT NULL,
  `years` varchar(20) NOT NULL,
  `rent` varchar(10) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_no` varchar(30) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_year` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `spouse` varchar(30) NOT NULL,
  `spouse_no` varchar(30) NOT NULL,
  `spouse_emp` varchar(50) NOT NULL,
  `spouse_details` varchar(100) NOT NULL,
  `spouse_income` decimal(10,2) NOT NULL,
  `comaker` varchar(30) NOT NULL,
  `comaker_details` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `credit_status` varchar(10) NOT NULL,
  `ci_remarks` varchar(1000) NOT NULL,
  `ci_name` varchar(50) NOT NULL,
  `ci_date` date NOT NULL,
  `payslip` int(11) NOT NULL,
  `valid_id` int(11) NOT NULL,
  `cert` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `email` text NOT NULL,
  `account_no` text NOT NULL,
  `price_tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_first`, `cust_last`, `cust_address`, `cust_contact`, `balance`, `cust_pic`, `bday`, `nickname`, `house_status`, `years`, `rent`, `emp_name`, `emp_no`, `emp_address`, `emp_year`, `occupation`, `salary`, `spouse`, `spouse_no`, `spouse_emp`, `spouse_details`, `spouse_income`, `comaker`, `comaker_details`, `branch_id`, `credit_status`, `ci_remarks`, `ci_name`, `ci_date`, `payslip`, `valid_id`, `cert`, `cedula`, `income`, `email`, `account_no`, `price_tag`) VALUES
(1, 'Musa', 'muyunda', 'Lusaka.\r\nChilenge', '+260975704991', '0', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(2, 'Chesco', 'Tech', '', '012121', '0', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(3, 'Ndeke Hotel', '', '2121', '12121', '0', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` int(12) NOT NULL,
  `amount` text NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_id` int(12) NOT NULL,
  `old_balance` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payments`
--

INSERT INTO `customer_payments` (`id`, `amount`, `date_paid`, `customer_id`, `old_balance`) VALUES
(1, '40000', '2019-09-17 15:11:15', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `damages_log_tb`
--

CREATE TABLE `damages_log_tb` (
  `id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `qty_damage` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_tb`
--

CREATE TABLE `delivery_tb` (
  `id` int(12) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_tb`
--

INSERT INTO `delivery_tb` (`id`, `date_created`, `order_no`) VALUES
(1, '2020-10-21 07:53:24', ''),
(2, '2020-10-21 08:07:41', ''),
(3, '2020-10-26 13:21:41', ''),
(4, '2020-10-26 13:25:58', '');

-- --------------------------------------------------------

--
-- Table structure for table `discount_tb`
--

CREATE TABLE `discount_tb` (
  `id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `discount_price` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `discount_from` text NOT NULL,
  `discount_to` text NOT NULL,
  `status` text NOT NULL,
  `price_before_disc` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `draft_sales_tb`
--

CREATE TABLE `draft_sales_tb` (
  `sales_details_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_no` int(12) NOT NULL,
  `client_name` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draft_temp_trans`
--

CREATE TABLE `draft_temp_trans` (
  `temp_trans_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `order_no` int(12) NOT NULL,
  `customer_name` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `is_printed` int(11) NOT NULL,
  `price_tag` text NOT NULL,
  `invoice_no` text NOT NULL,
  `cust_id` text NOT NULL,
  `description` text NOT NULL,
  `discount_type` varchar(222) NOT NULL,
  `amount` varchar(222) NOT NULL,
  `date2collect` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `draft_temp_trans`
--

INSERT INTO `draft_temp_trans` (`temp_trans_id`, `prod_id`, `price`, `qty`, `branch_id`, `order_no`, `customer_name`, `date`, `user_id`, `is_printed`, `price_tag`, `invoice_no`, `cust_id`, `description`, `discount_type`, `amount`, `date2collect`) VALUES
(48, 9, '3000.00', 1, 1, 2311, 'Musa', '2021-10-26 15:58:22', 8, 0, '', '', '1', '', '', '', '2021-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rates_tb`
--

CREATE TABLE `exchange_rates_tb` (
  `exchange_id` int(12) NOT NULL,
  `rate` text NOT NULL,
  `name` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exchange_rates_tb`
--

INSERT INTO `exchange_rates_tb` (`exchange_id`, `rate`, `name`, `date_added`) VALUES
(1, '23', 'USD (Dollar)', '2021-04-21 09:28:14'),
(2, '0', 'ZMW', '2020-06-14 06:22:07'),
(4, '20', 'UK (Pound)', '2020-06-14 06:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_tb`
--

CREATE TABLE `expenses_tb` (
  `id` int(12) NOT NULL,
  `description` text NOT NULL,
  `amount` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_tb`
--

INSERT INTO `expenses_tb` (`id`, `description`, `amount`, `date`) VALUES
(1, 'Zesco', 150, '2020-12-14 20:44:53'),
(2, 'QuickBooks Intuit', 1700, '2020-12-14 20:44:53'),
(3, 'Zamtel Telecommunications', 800, '2020-12-14 20:44:53'),
(4, 'ZRA', 1094, '2020-12-14 20:44:53'),
(5, 'Chesco Tech', 450, '2020-12-14 20:44:53'),
(6, 'Chesco Tech', 1850, '2020-12-14 20:44:53'),
(7, 'Best Provider Zambia Ltd', 4999, '2020-12-14 20:44:53'),
(8, 'Chesco Tech', 2420, '2020-12-14 20:44:53'),
(9, 'Mainza', 250, '2020-12-14 20:44:53'),
(11, 'Best Provider Zambia Ltd', 700, '2020-12-14 20:44:53'),
(12, 'Best Provider Zambia Ltd', 700, '2020-12-14 20:44:53'),
(13, 'Facebook', 1500, '2020-12-14 20:44:53'),
(14, 'Best Provider Zambia Ltd', 3165, '2020-12-14 20:44:53'),
(15, 'Best Provider Zambia Ltd', 3165, '2020-12-14 20:44:53'),
(16, 'Fuel 17 Dec - Mainza', 200, '2020-12-17 06:28:03'),
(17, 'Name Hero Server Hosting - Dec', 450, '2020-12-20 09:48:26'),
(18, 'Cash Drawers - Purchase', 2000, '2020-12-22 12:40:55'),
(19, 'Desktop pc - Purchase', 2300, '2020-12-22 12:41:29'),
(20, 'Barcode Scanner - Purchase', 1400, '2020-12-22 12:41:54'),
(21, ' Fuel - Mainza', 250, '2020-12-23 14:43:05'),
(22, 'Facebook Advertising - Dec', 300, '2020-12-24 14:20:02'),
(23, 'Salaries December 31.', 8709, '2020-12-24 14:21:13'),
(24, ' Purchase Printer', 600, '2020-12-26 06:52:26'),
(25, ' Rooms - Livingstone CEO', 800, '2020-12-27 15:07:42'),
(26, 'Cash Drawers Hardware Purchase for Lstone', 5500, '2020-12-27 15:11:35'),
(27, 'Barcode Scanner Purchase  for Lstone', 400, '2020-12-27 15:11:57'),
(28, ' Fuel Lstone', 1500, '2020-12-27 15:12:36'),
(29, ' Desktop PC and Accessories for Lstone.', 1500, '2020-12-27 15:23:56'),
(30, 'CEO Car Spares , OIL, others', 950, '2020-12-27 15:33:00'),
(32, ' Phiri Payment for Cleaning Dec', 200, '2020-12-28 15:33:32'),
(33, 'Car Branding and office Accesories', 1000, '2021-01-04 18:34:06'),
(34, 'David and Muleya Transport', 100, '2021-01-08 17:03:05'),
(35, 'Rent Dec 2020', 3500, '2021-01-08 17:05:48'),
(36, 'ZRA TAX Dec', 500, '2021-01-08 22:58:18'),
(37, 'RAM Chip for David Machine.', 600, '2021-01-11 19:52:57'),
(38, ' Fuel', 300, '2021-01-12 15:27:58'),
(39, 'Hand sanitizers ', 70, '2021-01-12 15:28:22'),
(40, 'Internet for January ', 820, '2021-01-13 14:51:08'),
(41, 'Desktop pc, WIFi DLink, others for Ekab Lodge - Purchase', 3000, '2021-01-19 02:09:52'),
(42, 'Purchase POS Machine Elo', 2200, '2021-01-23 01:49:28'),
(43, 'Receipt Printers', 2000, '2021-01-23 01:49:45'),
(44, 'Facebook Advertising - Jan 2021', 250, '2021-01-24 02:56:40'),
(45, 'Cat 5 cables ', 1200, '2021-01-26 17:57:14'),
(46, 'Office groceries ', 250, '2021-01-26 17:57:39'),
(47, ' Salaries', 9000, '2021-01-28 20:20:49'),
(48, 'Router Kafue Gorge Installation.', 1000, '2021-01-28 22:35:57'),
(49, 'Office Accessories ( Mouse and Keyboards)', 400, '2021-01-30 15:53:49'),
(50, ' Fuel', 250, '2021-02-01 13:06:22'),
(51, 'Petty cash for buying pos Hrdware ', 7000, '2021-02-01 13:16:25'),
(52, 'POS Video Advert', 400, '2021-02-03 13:52:21'),
(53, 'POS Hardware Purchase Scanner and POS Machine.', 3600, '2021-02-06 14:59:33'),
(54, ' Fuel', 250, '2021-02-09 13:55:04'),
(55, 'Printer purchase ', 900, '2021-02-09 13:55:26'),
(56, 'Tax returns Francis ', 300, '2021-02-09 13:55:57'),
(57, 'Rent', 3500, '2021-02-09 17:43:27'),
(58, 'Pos purchase Shaarz ', 1000, '2021-02-10 19:46:13'),
(59, 'Purchase pos touch screens ', 2200, '2021-02-11 02:12:39'),
(60, 'Printing of brochures and pens for clients ', 1400, '2021-02-11 15:52:28'),
(61, 'Purchase POS Machine CPU', 4400, '2021-02-12 03:23:47'),
(62, 'Fuel and others to Kitwe for POS Installation.', 1000, '2021-02-12 03:31:21'),
(63, 'Cash Drawers and Scanner Purchase for Kitwe POS,', 7700, '2021-02-12 03:32:20'),
(64, 'Purchase POS CPU', 1900, '2021-02-14 16:02:09'),
(65, ' Fuel', 700, '2021-02-14 16:04:36'),
(66, 'Purchase of Printer.', 1000, '2021-02-14 16:42:50'),
(67, 'Taxes and NAPSA for Jan 2021', 1000, '2021-02-14 17:37:49'),
(68, 'Internet bundles ', 800, '2021-02-15 15:15:04'),
(69, 'Purchase pos hardware ', 3600, '2021-02-16 15:02:32'),
(70, 'Printer cables for kitwe pos man', 550, '2021-02-16 16:33:23'),
(71, 'Napsa January ', 1000, '2021-02-16 19:47:05'),
(72, ' POS Purchase Hardware', 7500, '2021-02-20 14:50:11'),
(73, 'Web hosting ', 450, '2021-02-21 14:13:26'),
(74, 'Receipt Printers', 3500, '2021-02-26 03:00:22'),
(75, 'Salaries February ', 13780, '2021-02-26 19:22:36'),
(76, 'Rent', 3500, '2021-02-26 19:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `expense_types_tb`
--

CREATE TABLE `expense_types_tb` (
  `id` int(12) NOT NULL,
  `description` text NOT NULL,
  `exp_name` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_types_tb`
--

INSERT INTO `expense_types_tb` (`id`, `description`, `exp_name`, `date_added`, `added_by`) VALUES
(1, '', ' Fuel', '2020-11-29 19:06:16', 4),
(2, '', ' Salaries', '2020-11-29 19:06:22', 4),
(3, '', ' Rent', '2021-03-01 08:41:38', 4);

-- --------------------------------------------------------

--
-- Table structure for table `history_log`
--

CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_log`
--

INSERT INTO `history_log` (`log_id`, `user_id`, `action`, `date`) VALUES
(1, 4, 'has logged in the system at ', '2019-08-17 11:59:27'),
(2, 4, 'has logged out the system at ', '2019-08-17 13:14:19'),
(3, 8, 'has logged in the system at ', '2019-08-17 13:14:24'),
(4, 4, 'has logged in the system at ', '2019-08-20 13:13:38'),
(5, 4, 'has logged in the system at ', '2019-08-20 17:48:30'),
(6, 4, 'has logged out the system at ', '2019-08-20 17:49:06'),
(7, 10, 'has logged in the system at ', '2019-08-20 17:49:13'),
(8, 4, 'has logged in the system at ', '2019-08-21 18:01:44'),
(9, 4, 'has logged out the system at ', '2019-08-21 18:01:52'),
(10, 10, 'has logged in the system at ', '2019-08-21 18:01:58'),
(11, 10, 'has logged out the system at ', '2019-08-22 10:23:34'),
(12, 4, 'has logged in the system at ', '2019-08-22 10:23:40'),
(13, 4, 'has logged out the system at ', '2019-08-22 11:10:03'),
(14, 10, 'has logged in the system at ', '2019-08-22 11:10:36'),
(15, 10, 'has logged out the system at ', '2019-08-22 11:56:10'),
(16, 4, 'has logged in the system at ', '2019-08-22 11:58:19'),
(17, 4, 'has logged out the system at ', '2019-08-22 12:36:40'),
(18, 10, 'has logged in the system at ', '2019-08-22 12:36:46'),
(19, 10, 'has logged out the system at ', '2019-08-22 12:46:02'),
(20, 4, 'has logged in the system at ', '2019-08-22 12:46:07'),
(21, 4, 'has logged out the system at ', '2019-08-22 13:01:54'),
(22, 8, 'has logged in the system at ', '2019-08-22 13:01:59'),
(23, 8, 'has logged out the system at ', '2019-08-22 13:26:44'),
(24, 4, 'has logged in the system at ', '2019-08-22 13:26:49'),
(25, 4, 'has logged out the system at ', '2019-08-22 13:41:26'),
(26, 8, 'has logged in the system at ', '2019-08-22 13:41:40'),
(27, 8, 'has logged out the system at ', '2019-08-22 14:49:26'),
(28, 10, 'has logged in the system at ', '2019-08-22 14:49:41'),
(29, 10, 'has logged out the system at ', '2019-08-22 15:03:14'),
(30, 4, 'has logged in the system at ', '2019-08-22 15:03:19'),
(31, 4, 'has logged out the system at ', '2019-08-22 15:08:44'),
(32, 10, 'has logged in the system at ', '2019-08-22 15:10:18'),
(33, 10, 'has logged out the system at ', '2019-08-22 15:17:41'),
(34, 4, 'has logged in the system at ', '2019-08-22 15:17:45'),
(35, 4, 'has logged out the system at ', '2019-08-22 15:21:55'),
(36, 10, 'has logged in the system at ', '2019-08-22 15:21:59'),
(37, 10, 'has logged out the system at ', '2019-08-22 15:23:22'),
(38, 4, 'has logged in the system at ', '2019-08-22 15:23:27'),
(39, 4, 'has logged out the system at ', '2019-08-22 15:25:05'),
(40, 10, 'has logged in the system at ', '2019-08-22 15:25:11'),
(41, 10, 'has logged out the system at ', '2019-08-22 15:34:15'),
(42, 8, 'has logged in the system at ', '2019-08-22 15:34:41'),
(43, 8, 'has logged out the system at ', '2019-08-22 15:34:55'),
(44, 4, 'has logged in the system at ', '2019-08-22 15:35:08'),
(45, 4, 'has logged out the system at ', '2019-08-22 15:35:14'),
(46, 10, 'has logged in the system at ', '2019-08-22 15:35:26'),
(47, 10, 'has logged out the system at ', '2019-08-22 15:46:43'),
(48, 10, 'has logged in the system at ', '2019-08-22 15:46:50'),
(49, 10, 'has logged out the system at ', '2019-08-22 15:46:52'),
(50, 4, 'has logged in the system at ', '2019-08-22 15:47:00'),
(51, 4, 'has logged in the system at ', '2019-08-23 09:36:53'),
(52, 4, 'has logged in the system at ', '2019-08-23 16:09:01'),
(53, 4, 'has logged out the system at ', '2019-08-24 14:10:55'),
(54, 4, 'has logged in the system at ', '2019-08-25 14:10:50'),
(55, 4, 'has logged out the system at ', '2019-08-25 14:15:30'),
(56, 8, 'has logged in the system at ', '2019-08-25 14:15:36'),
(57, 8, 'has logged in the system at ', '2019-08-25 15:24:09'),
(58, 8, 'has logged in the system at ', '2019-08-26 13:33:51'),
(59, 10, 'has logged in the system at ', '2019-08-26 14:27:49'),
(60, 8, 'has logged in the system at ', '2019-08-27 11:40:28'),
(61, 4, 'has logged in the system at ', '2019-09-03 09:44:08'),
(62, 4, 'has logged in the system at ', '2019-09-03 09:44:47'),
(63, 4, 'has logged out the system at ', '2019-09-03 09:46:00'),
(64, 8, 'has logged in the system at ', '2019-09-03 09:46:04'),
(65, 8, 'has logged out the system at ', '2019-09-03 09:46:31'),
(66, 4, 'has logged in the system at ', '2019-09-03 09:46:36'),
(67, 4, 'has logged out the system at ', '2019-09-03 09:51:57'),
(68, 4, 'has logged in the system at ', '2019-09-03 09:52:31'),
(69, 4, 'has logged out the system at ', '2019-09-03 11:47:15'),
(70, 8, 'has logged in the system at ', '2019-09-03 11:47:28'),
(71, 8, 'has logged in the system at ', '2019-09-03 11:53:04'),
(72, 8, 'has logged in the system at ', '2019-09-03 12:07:28'),
(73, 8, 'has logged in the system at ', '2019-09-04 16:58:09'),
(74, 8, 'has logged out the system at ', '2019-09-04 18:42:00'),
(75, 4, 'has logged in the system at ', '2019-09-04 18:42:05'),
(76, 4, 'has logged out the system at ', '2019-09-04 18:42:24'),
(77, 8, 'has logged in the system at ', '2019-09-04 18:42:36'),
(78, 10, 'has logged in the system at ', '2019-09-05 12:58:11'),
(79, 10, 'has logged out the system at ', '2019-09-05 12:58:46'),
(80, 4, 'has logged in the system at ', '2019-09-05 12:58:50'),
(81, 4, 'has logged out the system at ', '2019-09-05 12:59:54'),
(82, 10, 'has logged in the system at ', '2019-09-05 13:00:00'),
(83, 4, 'has logged in the system at ', '2019-09-06 08:10:53'),
(84, 4, 'has logged out the system at ', '2019-09-06 08:12:39'),
(85, 8, 'has logged in the system at ', '2019-09-06 08:12:46'),
(86, 8, 'has logged out the system at ', '2019-09-06 08:13:55'),
(87, 8, 'has logged in the system at ', '2019-09-06 08:14:30'),
(88, 8, 'has logged out the system at ', '2019-09-06 08:55:26'),
(89, 4, 'has logged in the system at ', '2019-09-06 08:55:31'),
(90, 4, 'has logged out the system at ', '2019-09-06 08:55:48'),
(91, 8, 'has logged in the system at ', '2019-09-06 08:56:58'),
(92, 8, 'has logged out the system at ', '2019-09-06 09:06:41'),
(93, 8, 'has logged in the system at ', '2019-09-06 16:03:33'),
(94, 8, 'has logged out the system at ', '2019-09-06 17:01:39'),
(95, 4, 'has logged in the system at ', '2019-09-06 17:01:45'),
(96, 4, 'has logged out the system at ', '2019-09-06 17:01:53'),
(97, 8, 'has logged in the system at ', '2019-09-06 17:01:59'),
(98, 8, 'has logged in the system at ', '2019-09-06 17:05:34'),
(99, 8, 'has logged in the system at ', '2019-09-06 22:21:33'),
(100, 8, 'has logged out the system at ', '2019-09-06 22:26:50'),
(101, 8, 'has logged in the system at ', '2019-09-06 22:26:58'),
(102, 8, 'has logged in the system at ', '2019-09-07 09:49:14'),
(103, 8, 'has logged in the system at ', '2019-09-10 16:59:26'),
(104, 8, 'has logged in the system at ', '2019-09-12 09:42:57'),
(105, 8, 'has logged out the system at ', '2019-09-12 10:21:13'),
(106, 4, 'has logged in the system at ', '2019-09-12 10:56:25'),
(107, 4, 'has logged out the system at ', '2019-09-12 12:10:18'),
(108, 8, 'has logged in the system at ', '2019-09-12 12:10:25'),
(109, 8, 'has logged in the system at ', '2019-09-12 14:17:26'),
(110, 4, 'has logged in the system at ', '2019-09-17 16:51:43'),
(111, 4, 'has logged in the system at ', '2019-09-20 11:05:37'),
(112, 8, 'has logged in the system at ', '2019-09-30 17:46:50'),
(113, 8, 'has logged out the system at ', '2019-09-30 17:51:56'),
(114, 4, 'has logged in the system at ', '2019-09-30 17:52:02'),
(115, 4, 'has logged out the system at ', '2019-09-30 18:08:34'),
(116, 8, 'has logged in the system at ', '2019-09-30 18:08:43'),
(117, 8, 'has logged out the system at ', '2019-09-30 19:03:04'),
(118, 4, 'has logged in the system at ', '2019-09-30 19:03:09'),
(119, 4, 'has logged out the system at ', '2019-09-30 19:04:28'),
(120, 8, 'has logged in the system at ', '2019-09-30 19:04:34'),
(121, 8, 'has logged out the system at ', '2019-09-30 19:13:44'),
(122, 8, 'has logged in the system at ', '2019-09-30 19:25:36'),
(123, 8, 'has logged in the system at ', '2019-10-07 10:48:37'),
(124, 8, 'has logged in the system at ', '2019-10-07 11:06:56'),
(125, 8, 'has logged in the system at ', '2019-10-08 10:31:17'),
(126, 8, 'has logged out the system at ', '2019-10-08 10:41:48'),
(127, 4, 'has logged in the system at ', '2019-10-08 10:42:04'),
(128, 4, 'has logged out the system at ', '2019-10-08 10:54:20'),
(129, 8, 'has logged in the system at ', '2019-10-08 10:54:28'),
(130, 8, 'has logged in the system at ', '2019-10-09 00:14:57'),
(131, 8, 'has logged in the system at ', '2019-10-09 08:54:00'),
(132, 8, 'has logged out the system at ', '2019-10-09 09:01:08'),
(133, 4, 'has logged in the system at ', '2019-10-09 09:01:12'),
(134, 4, 'has logged out the system at ', '2019-10-09 09:01:34'),
(135, 8, 'has logged in the system at ', '2019-10-09 09:01:56'),
(136, 10, 'has logged in the system at ', '2019-10-09 14:54:30'),
(137, 10, 'has logged out the system at ', '2019-10-09 15:01:08'),
(138, 8, 'has logged in the system at ', '2019-10-09 15:01:13'),
(139, 4, 'has logged in the system at ', '2019-10-11 12:15:39'),
(140, 4, 'has logged out the system at ', '2019-10-11 12:36:21'),
(141, 8, 'has logged in the system at ', '2019-10-11 12:36:29'),
(142, 8, 'has logged out the system at ', '2019-10-11 14:44:33'),
(143, 4, 'has logged in the system at ', '2019-10-11 14:44:38'),
(144, 4, 'has logged out the system at ', '2019-10-11 14:45:18'),
(145, 8, 'has logged in the system at ', '2019-10-11 14:45:23'),
(146, 8, 'has logged out the system at ', '2019-10-11 14:53:35'),
(147, 4, 'has logged in the system at ', '2019-10-11 14:53:40'),
(148, 4, 'has logged out the system at ', '2019-10-11 15:01:24'),
(149, 8, 'has logged in the system at ', '2019-10-11 15:01:31'),
(150, 8, 'has logged in the system at ', '2019-10-12 19:24:58'),
(151, 4, 'has logged in the system at ', '2019-10-13 00:15:14'),
(152, 4, 'has logged out the system at ', '2019-10-13 00:20:04'),
(153, 8, 'has logged in the system at ', '2019-10-13 00:20:12'),
(154, 8, 'has logged in the system at ', '2019-10-13 18:29:34'),
(155, 8, 'has logged in the system at ', '2019-10-14 19:57:32'),
(156, 8, 'has logged in the system at ', '2019-10-14 21:42:22'),
(157, 8, 'has logged out the system at ', '2019-10-14 21:42:50'),
(158, 4, 'has logged in the system at ', '2019-10-14 21:42:56'),
(159, 4, 'has logged out the system at ', '2019-10-14 21:57:07'),
(160, 8, 'has logged in the system at ', '2019-10-14 21:57:13'),
(161, 8, 'has logged in the system at ', '2019-10-15 15:49:13'),
(162, 8, 'has logged out the system at ', '2019-10-15 17:57:44'),
(163, 4, 'has logged in the system at ', '2019-10-15 17:58:01'),
(164, 4, 'has logged out the system at ', '2019-10-15 18:05:51'),
(165, 8, 'has logged in the system at ', '2019-10-15 18:05:56'),
(166, 8, 'has logged out the system at ', '2019-10-15 18:06:10'),
(167, 4, 'has logged in the system at ', '2019-10-15 18:06:41'),
(168, 4, 'has logged out the system at ', '2019-10-15 18:11:03'),
(169, 8, 'has logged in the system at ', '2019-10-15 18:11:08'),
(170, 8, 'has logged out the system at ', '2019-10-15 18:11:21'),
(171, 4, 'has logged in the system at ', '2019-10-15 18:11:26'),
(172, 4, 'has logged in the system at ', '2019-10-15 21:37:11'),
(173, 4, 'has logged out the system at ', '2019-10-15 21:47:16'),
(174, 8, 'has logged in the system at ', '2019-10-16 11:04:08'),
(175, 8, 'has logged out the system at ', '2019-10-16 11:08:07'),
(176, 8, 'has logged in the system at ', '2019-10-16 11:12:39'),
(177, 8, 'has logged in the system at ', '2019-10-18 19:29:38'),
(178, 8, 'has logged in the system at ', '2019-10-21 09:31:40'),
(179, 8, 'has logged out the system at ', '2019-10-21 10:28:31'),
(180, 4, 'has logged in the system at ', '2019-10-21 10:28:35'),
(181, 4, 'has logged out the system at ', '2019-10-21 10:28:55'),
(182, 8, 'has logged in the system at ', '2019-10-21 13:07:18'),
(183, 4, 'has logged in the system at ', '2019-11-15 10:38:32'),
(184, 4, 'has logged out the system at ', '2019-11-15 10:57:41'),
(185, 8, 'has logged in the system at ', '2019-11-15 10:57:46'),
(186, 8, 'has logged out the system at ', '2019-11-15 11:10:31'),
(187, 4, 'has logged in the system at ', '2019-11-15 11:10:37'),
(188, 4, 'has logged in the system at ', '2019-12-30 14:17:49'),
(189, 4, 'has logged out the system at ', '2019-12-30 14:53:18'),
(190, 8, 'has logged in the system at ', '2019-12-30 14:53:26'),
(191, 8, 'has logged out the system at ', '2019-12-30 17:25:18'),
(192, 8, 'has logged in the system at ', '2020-01-14 10:20:47'),
(193, 8, 'has logged out the system at ', '2020-01-14 10:33:45'),
(194, 8, 'has logged in the system at ', '2020-01-14 10:33:49'),
(195, 4, 'has logged in the system at ', '2020-01-26 07:04:49'),
(196, 4, 'has logged out the system at ', '2020-01-26 07:05:07'),
(197, 8, 'has logged in the system at ', '2020-01-26 07:05:12'),
(198, 4, 'has logged in the system at ', '2020-01-27 10:13:05'),
(199, 4, 'has logged out the system at ', '2020-01-27 10:14:53'),
(200, 8, 'has logged in the system at ', '2020-01-27 10:14:58'),
(201, 8, 'has logged out the system at ', '2020-01-27 10:16:24'),
(202, 4, 'has logged in the system at ', '2020-01-27 10:16:29'),
(203, 4, 'has logged out the system at ', '2020-01-27 10:21:40'),
(204, 8, 'has logged in the system at ', '2020-01-27 10:22:56'),
(205, 8, 'has logged out the system at ', '2020-01-27 11:43:01'),
(206, 4, 'has logged in the system at ', '2020-01-27 11:43:07'),
(207, 4, 'has logged out the system at ', '2020-01-27 11:43:34'),
(208, 8, 'has logged in the system at ', '2020-01-27 11:43:40'),
(209, 8, 'has logged in the system at ', '2020-01-28 18:07:27'),
(210, 8, 'has logged out the system at ', '2020-01-28 18:25:09'),
(211, 4, 'has logged in the system at ', '2020-01-28 18:25:15'),
(212, 4, 'has logged out the system at ', '2020-01-28 18:28:36'),
(213, 8, 'has logged in the system at ', '2020-01-28 18:28:39'),
(214, 8, 'has logged in the system at ', '2020-01-28 18:43:40'),
(215, 8, 'has logged out the system at ', '2020-01-28 18:43:50'),
(216, 8, 'has logged in the system at ', '2020-01-28 18:43:55'),
(217, 8, 'has logged out the system at ', '2020-01-28 18:44:09'),
(218, 4, 'has logged in the system at ', '2020-01-28 18:44:15'),
(219, 8, 'has logged out the system at ', '2020-01-28 20:18:29'),
(220, 8, 'has logged in the system at ', '2020-01-28 20:18:34'),
(221, 8, 'has logged out the system at ', '2020-01-28 20:19:48'),
(222, 4, 'has logged in the system at ', '2020-01-28 20:19:54'),
(223, 4, 'has logged out the system at ', '2020-01-28 20:32:32'),
(224, 8, 'has logged in the system at ', '2020-01-28 20:34:39'),
(225, 8, 'has logged out the system at ', '2020-01-28 20:37:35'),
(226, 4, 'has logged in the system at ', '2020-01-28 20:38:03'),
(227, 4, 'has logged out the system at ', '2020-01-28 20:38:58'),
(228, 8, 'has logged in the system at ', '2020-01-28 20:39:03'),
(229, 8, 'has logged out the system at ', '2020-01-28 20:40:08'),
(230, 4, 'has logged in the system at ', '2020-01-28 20:40:13'),
(231, 4, 'has logged out the system at ', '2020-01-28 20:40:40'),
(232, 8, 'has logged in the system at ', '2020-01-28 20:40:45'),
(233, 4, 'has logged in the system at ', '2020-01-28 22:58:07'),
(234, 4, 'has logged out the system at ', '2020-01-28 22:58:42'),
(235, 8, 'has logged in the system at ', '2020-01-28 22:58:48'),
(236, 8, 'has logged out the system at ', '2020-01-29 09:58:55'),
(237, 4, 'has logged in the system at ', '2020-01-29 09:59:00'),
(238, 4, 'has logged out the system at ', '2020-01-29 10:05:51'),
(239, 8, 'has logged in the system at ', '2020-01-29 15:14:14'),
(240, 8, 'has logged out the system at ', '2020-01-29 15:14:17'),
(241, 8, 'has logged in the system at ', '2020-01-30 11:28:46'),
(242, 8, 'has logged out the system at ', '2020-01-30 11:28:52'),
(243, 8, 'has logged in the system at ', '2020-01-30 11:28:57'),
(244, 4, 'has logged out the system at ', '2020-01-30 17:52:25'),
(245, 8, 'has logged in the system at ', '2020-01-30 17:52:34'),
(246, 8, 'has logged out the system at ', '2020-01-30 18:01:31'),
(247, 8, 'has logged in the system at ', '2020-01-30 18:01:37'),
(248, 8, 'has logged in the system at ', '2020-01-31 11:40:20'),
(249, 8, 'has logged out the system at ', '2020-01-31 11:40:23'),
(250, 4, 'has logged in the system at ', '2020-01-31 11:40:29'),
(251, 4, 'has logged out the system at ', '2020-01-31 11:45:49'),
(252, 4, 'has logged in the system at ', '2020-01-31 11:45:59'),
(253, 4, 'has logged out the system at ', '2020-01-31 11:53:20'),
(254, 8, 'has logged in the system at ', '2020-01-31 11:53:26'),
(255, 8, 'has logged in the system at ', '2020-01-31 16:13:10'),
(256, 8, 'has logged out the system at ', '2020-10-21 10:15:58'),
(257, 4, 'has logged in the system at ', '2020-10-21 10:16:03'),
(258, 4, 'has logged out the system at ', '2020-10-21 10:19:58'),
(259, 4, 'has logged in the system at ', '2020-10-21 10:32:28'),
(260, 4, 'has logged out the system at ', '2020-10-21 10:32:49'),
(261, 10, 'has logged in the system at ', '2020-10-21 10:32:55'),
(262, 10, 'has logged out the system at ', '2020-10-21 10:33:34'),
(263, 4, 'has logged in the system at ', '2020-10-21 10:33:42'),
(264, 8, 'has logged in the system at ', '2020-10-26 11:31:54'),
(265, 8, 'has logged out the system at ', '2020-10-26 11:32:54'),
(266, 4, 'has logged in the system at ', '2020-10-26 11:32:58'),
(267, 4, 'has logged in the system at ', '2020-10-26 14:53:44'),
(268, 4, 'has logged out the system at ', '2020-10-26 14:55:17'),
(269, 10, 'has logged in the system at ', '2020-10-26 14:55:23'),
(270, 10, 'has logged out the system at ', '2020-10-26 15:07:41'),
(271, 4, 'has logged in the system at ', '2020-10-26 15:07:45'),
(272, 4, 'has logged out the system at ', '2020-10-26 15:09:03'),
(273, 10, 'has logged in the system at ', '2020-10-26 15:09:10'),
(274, 10, 'has logged out the system at ', '2020-10-26 15:15:24'),
(275, 8, 'has logged in the system at ', '2020-10-26 15:15:31'),
(276, 8, 'has logged out the system at ', '2020-10-26 15:29:39'),
(277, 4, 'has logged in the system at ', '2020-10-26 15:29:44'),
(278, 4, 'has logged out the system at ', '2020-10-26 15:41:21'),
(279, 8, 'has logged in the system at ', '2020-10-30 11:57:56'),
(280, 4, 'has logged in the system at ', '2020-11-07 19:12:54'),
(281, 4, 'has logged in the system at ', '2020-11-29 16:24:15'),
(282, 4, 'has logged out the system at ', '2020-11-29 16:24:28'),
(283, 8, 'has logged in the system at ', '2020-11-29 16:24:35'),
(284, 8, 'has logged out the system at ', '2020-11-29 17:00:28'),
(285, 4, 'has logged in the system at ', '2020-11-29 17:00:33'),
(286, 4, 'has logged out the system at ', '2020-11-29 17:01:35'),
(287, 8, 'has logged in the system at ', '2020-11-29 17:01:41'),
(288, 8, 'has logged out the system at ', '2020-11-29 17:05:21'),
(289, 4, 'has logged in the system at ', '2020-11-29 17:05:26'),
(290, 4, 'has logged out the system at ', '2020-11-29 17:07:07'),
(291, 8, 'has logged in the system at ', '2020-11-29 17:07:15'),
(292, 13, 'has logged out the system at ', '2020-11-29 17:15:24'),
(293, 8, 'has logged in the system at ', '2020-11-29 17:15:31'),
(294, 8, 'has logged out the system at ', '2020-11-29 18:28:22'),
(295, 4, 'has logged in the system at ', '2020-11-29 18:28:28'),
(296, 4, 'has logged out the system at ', '2020-11-29 20:21:16'),
(297, 8, 'has logged in the system at ', '2020-11-29 20:21:21'),
(298, 8, 'has logged out the system at ', '2020-11-29 20:50:18'),
(299, 4, 'has logged in the system at ', '2020-11-29 20:50:23'),
(300, 4, 'has logged out the system at ', '2020-11-29 20:53:20'),
(301, 8, 'has logged in the system at ', '2020-11-29 20:54:07'),
(302, 8, 'has logged in the system at ', '2020-11-29 20:55:27'),
(303, 8, 'has logged out the system at ', '2020-11-29 21:02:55'),
(304, 4, 'has logged in the system at ', '2020-11-29 21:03:00'),
(305, 4, 'has logged out the system at ', '2020-11-29 21:06:24'),
(306, 8, 'has logged in the system at ', '2020-11-29 21:06:29'),
(307, 8, 'has logged out the system at ', '2020-11-29 23:13:23'),
(308, 8, 'has logged in the system at ', '2020-11-30 15:35:26'),
(309, 8, 'has logged in the system at ', '2020-12-02 11:11:31'),
(310, 8, 'has logged out the system at ', '2020-12-02 14:36:55'),
(311, 8, 'has logged in the system at ', '2020-12-02 15:22:42'),
(312, 8, 'has logged out the system at ', '2020-12-02 16:25:06'),
(313, 4, 'has logged in the system at ', '2020-12-14 14:44:26'),
(314, 4, 'has logged out the system at ', '2020-12-14 14:44:40'),
(315, 8, 'has logged in the system at ', '2020-12-14 14:44:46'),
(316, 8, 'has logged out the system at ', '2020-12-14 14:47:26'),
(317, 4, 'has logged in the system at ', '2020-12-14 14:47:37'),
(318, 4, 'has logged in the system at ', '2020-12-14 22:19:56'),
(319, 4, 'has logged out the system at ', '2020-12-14 23:09:59'),
(320, 8, 'has logged in the system at ', '2020-12-14 23:10:04'),
(321, 8, 'has logged in the system at ', '2020-12-15 15:14:07'),
(322, 8, 'has logged out the system at ', '2020-12-15 15:27:56'),
(323, 0, 'has logged out the system at ', '2020-12-15 15:28:20'),
(324, 8, 'has logged in the system at ', '2020-12-15 15:40:48'),
(325, 8, 'has logged out the system at ', '2020-12-15 15:58:35'),
(326, 4, 'has logged out the system at ', '2020-12-15 16:05:32'),
(327, 8, 'has logged in the system at ', '2020-12-15 17:34:52'),
(328, 8, 'has logged out the system at ', '2020-12-15 17:36:39'),
(329, 4, 'has logged in the system at ', '2020-12-15 17:36:47'),
(330, 4, 'has logged out the system at ', '2020-12-15 17:43:05'),
(331, 8, 'has logged in the system at ', '2020-12-15 17:43:10'),
(332, 8, 'has logged out the system at ', '2020-12-15 17:49:34'),
(333, 4, 'has logged in the system at ', '2020-12-15 17:49:40'),
(334, 4, 'has logged out the system at ', '2020-12-15 17:51:41'),
(335, 4, 'has logged in the system at ', '2020-12-15 17:52:07'),
(336, 4, 'has logged out the system at ', '2020-12-15 21:32:07'),
(337, 8, 'has logged in the system at ', '2020-12-16 10:41:02'),
(338, 8, 'has logged out the system at ', '2020-12-16 10:50:29'),
(339, 0, 'has logged out the system at ', '2020-12-16 11:02:04'),
(340, 4, 'has logged in the system at ', '2020-12-16 11:02:08'),
(341, 8, 'has logged in the system at ', '2020-12-17 08:23:19'),
(342, 8, 'has logged out the system at ', '2020-12-17 08:38:59'),
(343, 4, 'has logged in the system at ', '2020-12-17 08:39:05'),
(344, 8, 'has logged in the system at ', '2020-12-17 10:03:04'),
(345, 8, 'has logged out the system at ', '2020-12-17 10:04:22'),
(346, 4, 'has logged in the system at ', '2020-12-17 10:06:10'),
(347, 8, 'has logged in the system at ', '2020-12-17 17:35:05'),
(348, 8, 'has logged in the system at ', '2020-12-17 17:49:36'),
(349, 8, 'has logged out the system at ', '2020-12-17 18:07:25'),
(350, 4, 'has logged in the system at ', '2020-12-17 18:07:33'),
(351, 4, 'has logged out the system at ', '2020-12-17 18:08:15'),
(352, 8, 'has logged in the system at ', '2020-12-17 18:08:21'),
(353, 8, 'has logged out the system at ', '2020-12-17 18:08:31'),
(354, 8, 'has logged in the system at ', '2020-12-20 11:47:38'),
(355, 8, 'has logged out the system at ', '2020-12-20 12:02:41'),
(356, 8, 'has logged in the system at ', '2020-12-22 14:21:09'),
(357, 8, 'has logged out the system at ', '2020-12-22 14:37:40'),
(358, 4, 'has logged in the system at ', '2020-12-22 14:37:51'),
(359, 4, 'has logged out the system at ', '2020-12-22 14:40:27'),
(360, 8, 'has logged in the system at ', '2020-12-22 14:40:32'),
(361, 8, 'has logged in the system at ', '2020-12-22 17:37:44'),
(362, 8, 'has logged out the system at ', '2020-12-22 17:56:42'),
(363, 4, 'has logged in the system at ', '2020-12-22 17:56:48'),
(364, 4, 'has logged in the system at ', '2020-12-22 17:58:27'),
(365, 4, 'has logged in the system at ', '2020-12-22 21:25:29'),
(366, 4, 'has logged out the system at ', '2020-12-22 21:25:34'),
(367, 8, 'has logged in the system at ', '2020-12-22 21:25:46'),
(368, 8, 'has logged out the system at ', '2020-12-22 21:37:55'),
(369, 8, 'has logged in the system at ', '2020-12-22 21:38:00'),
(370, 8, 'has logged out the system at ', '2020-12-22 21:38:02'),
(371, 4, 'has logged in the system at ', '2020-12-22 21:38:08'),
(372, 8, 'has logged in the system at ', '2020-12-23 16:14:01'),
(373, 8, 'has logged out the system at ', '2020-12-23 16:42:36'),
(374, 4, 'has logged in the system at ', '2020-12-23 16:42:42'),
(375, 8, 'has logged in the system at ', '2020-12-24 16:19:42'),
(376, 8, 'has logged out the system at ', '2020-12-24 16:21:25'),
(377, 4, 'has logged in the system at ', '2020-12-24 16:21:31'),
(378, 4, 'has logged out the system at ', '2020-12-24 16:21:44'),
(379, 4, 'has logged in the system at ', '2020-12-24 16:21:50'),
(380, 4, 'has logged in the system at ', '2020-12-26 08:51:36'),
(381, 4, 'has logged in the system at ', '2020-12-27 17:06:15'),
(382, 4, 'has logged out the system at ', '2020-12-27 17:24:15'),
(383, 8, 'has logged in the system at ', '2020-12-27 17:24:21'),
(384, 8, 'has logged out the system at ', '2020-12-27 17:31:14'),
(385, 4, 'has logged in the system at ', '2020-12-27 17:31:19'),
(386, 4, 'has logged out the system at ', '2020-12-27 17:31:52'),
(387, 8, 'has logged in the system at ', '2020-12-27 17:32:04'),
(388, 8, 'has logged in the system at ', '2020-12-28 16:52:18'),
(389, 8, 'has logged out the system at ', '2020-12-28 16:53:34'),
(390, 4, 'has logged in the system at ', '2020-12-28 16:53:39'),
(391, 4, 'has logged out the system at ', '2020-12-28 16:54:17'),
(392, 8, 'has logged in the system at ', '2020-12-28 16:54:22'),
(393, 8, 'has logged out the system at ', '2020-12-28 17:29:10'),
(394, 4, 'has logged in the system at ', '2020-12-28 17:29:15'),
(395, 4, 'has logged out the system at ', '2020-12-28 17:29:42'),
(396, 8, 'has logged in the system at ', '2020-12-28 17:29:47'),
(397, 8, 'has logged out the system at ', '2020-12-28 17:32:44'),
(398, 4, 'has logged in the system at ', '2020-12-28 17:32:49'),
(399, 4, 'has logged out the system at ', '2020-12-28 17:33:35'),
(400, 8, 'has logged in the system at ', '2020-12-31 09:13:34'),
(401, 8, 'has logged out the system at ', '2020-12-31 09:23:57'),
(402, 4, 'has logged in the system at ', '2020-12-31 09:24:03'),
(403, 8, 'has logged in the system at ', '2020-12-31 11:07:13'),
(404, 8, 'has logged out the system at ', '2020-12-31 13:04:37'),
(405, 8, 'has logged in the system at ', '2020-12-31 13:04:43'),
(406, 8, 'has logged in the system at ', '2021-01-01 10:08:50'),
(407, 8, 'has logged out the system at ', '2021-01-01 10:11:15'),
(408, 4, 'has logged in the system at ', '2021-01-01 10:11:20'),
(409, 4, 'has logged out the system at ', '2021-01-01 10:12:38'),
(410, 8, 'has logged in the system at ', '2021-01-01 10:12:44'),
(411, 8, 'has logged out the system at ', '2021-01-01 13:58:54'),
(412, 8, 'has logged in the system at ', '2021-01-01 13:59:00'),
(413, 8, 'has logged out the system at ', '2021-01-01 19:12:02'),
(414, 4, 'has logged in the system at ', '2021-01-01 19:12:25'),
(415, 4, 'has logged out the system at ', '2021-01-01 19:14:08'),
(416, 8, 'has logged in the system at ', '2021-01-01 19:14:13'),
(417, 8, 'has logged out the system at ', '2021-01-01 19:21:18'),
(418, 4, 'has logged in the system at ', '2021-01-01 23:01:44'),
(419, 4, 'has logged out the system at ', '2021-01-01 23:03:02'),
(420, 4, 'has logged in the system at ', '2021-01-01 23:03:10'),
(421, 4, 'has logged out the system at ', '2021-01-01 23:07:40'),
(422, 8, 'has logged in the system at ', '2021-01-01 23:07:48'),
(423, 8, 'has logged out the system at ', '2021-01-01 23:11:56'),
(424, 8, 'has logged in the system at ', '2021-01-01 23:13:57'),
(425, 8, 'has logged out the system at ', '2021-01-01 23:14:03'),
(426, 4, 'has logged in the system at ', '2021-01-01 23:14:11'),
(427, 4, 'has logged out the system at ', '2021-01-01 23:16:01'),
(428, 8, 'has logged in the system at ', '2021-01-01 23:16:23'),
(429, 8, 'has logged out the system at ', '2021-01-01 23:26:51'),
(430, 8, 'has logged in the system at ', '2021-01-03 11:26:24'),
(431, 8, 'has logged out the system at ', '2021-01-03 11:33:43'),
(432, 4, 'has logged in the system at ', '2021-01-03 11:33:55'),
(433, 8, 'has logged in the system at ', '2021-01-04 13:33:34'),
(434, 8, 'has logged out the system at ', '2021-01-04 13:35:22'),
(435, 4, 'has logged in the system at ', '2021-01-04 13:35:40'),
(436, 8, 'has logged in the system at ', '2021-01-04 14:31:50'),
(437, 8, 'has logged out the system at ', '2021-01-04 14:36:04'),
(438, 4, 'has logged in the system at ', '2021-01-04 14:36:16'),
(439, 8, 'has logged in the system at ', '2021-01-04 17:12:52'),
(440, 8, 'has logged out the system at ', '2021-01-04 17:17:37'),
(441, 8, 'has logged in the system at ', '2021-01-04 17:52:53'),
(442, 8, 'has logged in the system at ', '2021-01-05 14:04:16'),
(443, 8, 'has logged out the system at ', '2021-01-05 14:16:30'),
(444, 8, 'has logged in the system at ', '2021-01-08 12:02:20'),
(445, 8, 'has logged out the system at ', '2021-01-08 12:06:09'),
(446, 4, 'has logged in the system at ', '2021-01-08 12:07:08'),
(447, 4, 'has logged out the system at ', '2021-01-08 12:07:57'),
(448, 8, 'has logged in the system at ', '2021-01-08 17:55:53'),
(449, 8, 'has logged in the system at ', '2021-01-08 17:57:51'),
(450, 8, 'has logged out the system at ', '2021-01-08 17:58:27'),
(451, 8, 'has logged in the system at ', '2021-01-10 11:48:45'),
(452, 8, 'has logged out the system at ', '2021-01-10 11:49:32'),
(453, 4, 'has logged in the system at ', '2021-01-10 11:49:38'),
(454, 4, 'has logged out the system at ', '2021-01-10 11:49:57'),
(455, 8, 'has logged in the system at ', '2021-01-10 11:50:02'),
(456, 8, 'has logged out the system at ', '2021-01-10 11:55:47'),
(457, 8, 'has logged in the system at ', '2021-01-11 14:51:06'),
(458, 8, 'has logged out the system at ', '2021-01-11 14:53:02'),
(459, 8, 'has logged in the system at ', '2021-01-11 20:40:21'),
(460, 8, 'has logged in the system at ', '2021-01-11 20:53:09'),
(461, 8, 'has logged out the system at ', '2021-01-11 21:06:08'),
(462, 8, 'has logged in the system at ', '2021-01-11 21:38:08'),
(463, 8, 'has logged out the system at ', '2021-01-11 21:39:03'),
(464, 4, 'has logged in the system at ', '2021-01-11 21:39:10'),
(465, 8, 'has logged in the system at ', '2021-01-12 10:27:38'),
(466, 8, 'has logged in the system at ', '2021-01-13 09:50:45'),
(467, 8, 'has logged in the system at ', '2021-01-14 08:28:41'),
(468, 8, 'has logged in the system at ', '2021-01-14 08:33:11'),
(469, 8, 'has logged out the system at ', '2021-01-14 08:33:20'),
(470, 8, 'has logged in the system at ', '2021-01-14 20:19:35'),
(471, 8, 'has logged in the system at ', '2021-01-18 20:34:30'),
(472, 8, 'has logged out the system at ', '2021-01-18 21:10:11'),
(473, 4, 'has logged in the system at ', '2021-01-18 21:10:18'),
(474, 4, 'has logged out the system at ', '2021-01-18 21:12:29'),
(475, 8, 'has logged in the system at ', '2021-01-19 20:38:15'),
(476, 8, 'has logged in the system at ', '2021-01-21 20:48:41'),
(477, 8, 'has logged out the system at ', '2021-01-21 20:51:35'),
(478, 4, 'has logged in the system at ', '2021-01-21 20:51:44'),
(479, 8, 'has logged in the system at ', '2021-01-22 20:48:55'),
(480, 8, 'has logged in the system at ', '2021-01-23 21:56:12'),
(481, 8, 'has logged in the system at ', '2021-01-26 12:56:48'),
(482, 8, 'has logged in the system at ', '2021-01-28 15:10:08'),
(483, 8, 'has logged in the system at ', '2021-01-28 17:35:00'),
(484, 8, 'has logged in the system at ', '2021-01-29 09:11:46'),
(485, 8, 'has logged in the system at ', '2021-01-30 10:52:49'),
(486, 8, 'has logged out the system at ', '2021-01-30 11:21:00'),
(487, 8, 'has logged in the system at ', '2021-02-01 08:06:07'),
(488, 8, 'has logged in the system at ', '2021-02-03 08:52:05'),
(489, 8, 'has logged out the system at ', '2021-02-03 08:53:16'),
(490, 4, 'has logged in the system at ', '2021-02-03 08:53:49'),
(491, 8, 'has logged in the system at ', '2021-02-03 17:47:35'),
(492, 8, 'has logged out the system at ', '2021-02-03 17:57:58'),
(493, 4, 'has logged in the system at ', '2021-02-03 17:58:07'),
(494, 8, 'has logged in the system at ', '2021-02-06 09:57:40'),
(495, 8, 'has logged out the system at ', '2021-02-06 10:00:39'),
(496, 4, 'has logged in the system at ', '2021-02-06 10:00:52'),
(497, 4, 'has logged out the system at ', '2021-02-06 10:04:17'),
(498, 8, 'has logged in the system at ', '2021-02-06 10:04:25'),
(499, 8, 'has logged out the system at ', '2021-02-06 10:05:44'),
(500, 4, 'has logged in the system at ', '2021-02-06 10:15:07'),
(501, 8, 'has logged in the system at ', '2021-02-09 08:54:43'),
(502, 8, 'has logged in the system at ', '2021-02-09 12:43:10'),
(503, 8, 'has logged in the system at ', '2021-02-10 14:35:21'),
(504, 8, 'has logged in the system at ', '2021-02-10 14:45:18'),
(505, 8, 'has logged in the system at ', '2021-02-10 14:50:41'),
(506, 8, 'has logged out the system at ', '2021-02-10 14:51:26'),
(507, 4, 'has logged in the system at ', '2021-02-10 14:51:33'),
(508, 8, 'has logged out the system at ', '2021-02-10 14:55:13'),
(509, 4, 'has logged in the system at ', '2021-02-10 14:55:27'),
(510, 8, 'has logged in the system at ', '2021-02-10 21:12:07'),
(511, 8, 'has logged in the system at ', '2021-02-11 10:21:11'),
(512, 8, 'has logged in the system at ', '2021-02-11 22:23:05'),
(513, 8, 'has logged out the system at ', '2021-02-11 22:29:04'),
(514, 4, 'has logged in the system at ', '2021-02-11 22:29:16'),
(515, 8, 'has logged in the system at ', '2021-02-11 22:31:00'),
(516, 8, 'has logged in the system at ', '2021-02-14 11:01:49'),
(517, 8, 'has logged out the system at ', '2021-02-14 11:04:40'),
(518, 4, 'has logged in the system at ', '2021-02-14 11:05:44'),
(519, 8, 'has logged in the system at ', '2021-02-14 11:42:25'),
(520, 8, 'has logged in the system at ', '2021-02-14 12:37:22'),
(521, 8, 'has logged in the system at ', '2021-02-15 10:14:11'),
(522, 8, 'has logged in the system at ', '2021-02-16 10:02:10'),
(523, 8, 'has logged in the system at ', '2021-02-16 11:32:59'),
(524, 8, 'has logged in the system at ', '2021-02-16 14:46:40'),
(525, 8, 'has logged in the system at ', '2021-02-17 16:04:26'),
(526, 8, 'has logged out the system at ', '2021-02-17 16:19:58'),
(527, 4, 'has logged in the system at ', '2021-02-17 16:20:05'),
(528, 4, 'has logged out the system at ', '2021-02-17 16:20:18'),
(529, 8, 'has logged in the system at ', '2021-02-17 16:20:24'),
(530, 8, 'has logged out the system at ', '2021-02-17 16:22:09'),
(531, 4, 'has logged in the system at ', '2021-02-17 16:26:36'),
(532, 8, 'has logged in the system at ', '2021-02-19 11:12:28'),
(533, 8, 'has logged out the system at ', '2021-02-19 11:46:08'),
(534, 4, 'has logged in the system at ', '2021-02-19 11:46:45'),
(535, 8, 'has logged in the system at ', '2021-02-19 16:56:27'),
(536, 4, 'has logged in the system at ', '2021-02-19 17:27:23'),
(537, 4, 'has logged in the system at ', '2021-02-20 09:48:48'),
(538, 8, 'has logged in the system at ', '2021-02-21 09:13:04'),
(539, 8, 'has logged in the system at ', '2021-02-25 21:59:51'),
(540, 8, 'has logged out the system at ', '2021-02-25 22:06:40'),
(541, 4, 'has logged in the system at ', '2021-02-25 22:09:32'),
(542, 4, 'has logged in the system at ', '2021-02-26 08:55:51'),
(543, 4, 'has logged out the system at ', '2021-02-26 08:58:21'),
(544, 8, 'has logged in the system at ', '2021-02-26 08:58:28'),
(545, 8, 'has logged out the system at ', '2021-02-26 09:04:48'),
(546, 4, 'has logged in the system at ', '2021-02-26 09:05:51'),
(547, 8, 'has logged in the system at ', '2021-02-26 14:22:09'),
(548, 4, 'has logged in the system at ', '2021-02-27 09:37:06'),
(549, 8, 'has logged in the system at ', '2021-02-27 14:27:16'),
(550, 8, 'has logged out the system at ', '2021-02-27 14:30:51'),
(551, 4, 'has logged in the system at ', '2021-02-27 14:31:06'),
(552, 8, 'has logged in the system at ', '2021-02-28 12:24:34'),
(553, 8, 'has logged out the system at ', '2021-02-28 12:25:08'),
(554, 4, 'has logged in the system at ', '2021-02-28 12:28:38'),
(555, 8, 'has logged in the system at ', '2021-03-01 10:36:21'),
(556, 8, 'has logged out the system at ', '2021-03-01 10:40:10'),
(557, 4, 'has logged in the system at ', '2021-03-01 10:40:18'),
(558, 8, 'has logged in the system at ', '2021-03-07 20:43:12'),
(559, 4, 'has logged in the system at ', '2021-03-09 09:04:42'),
(560, 4, 'has logged in the system at ', '2021-03-19 14:46:46'),
(561, 4, 'has logged out the system at ', '2021-03-19 14:52:40'),
(562, 8, 'has logged in the system at ', '2021-03-19 14:52:45'),
(563, 8, 'has logged out the system at ', '2021-03-19 14:58:06'),
(564, 4, 'has logged in the system at ', '2021-03-19 14:58:13'),
(565, 4, 'has logged in the system at ', '2021-03-26 09:10:09'),
(566, 4, 'has logged out the system at ', '2021-03-26 09:15:34'),
(567, 8, 'has logged in the system at ', '2021-03-26 09:15:42'),
(568, 8, 'has logged in the system at ', '2021-03-27 09:15:45'),
(569, 8, 'has logged out the system at ', '2021-03-27 09:56:51'),
(570, 4, 'has logged in the system at ', '2021-03-27 09:57:02'),
(571, 4, 'has logged out the system at ', '2021-03-27 12:23:50'),
(572, 8, 'has logged in the system at ', '2021-03-27 12:23:55'),
(573, 8, 'has logged in the system at ', '2021-03-31 10:50:27'),
(574, 8, 'has logged in the system at ', '2021-04-01 08:55:56'),
(575, 8, 'has logged in the system at ', '2021-04-05 09:06:25'),
(576, 8, 'has logged in the system at ', '2021-04-05 10:12:20'),
(577, 8, 'has logged out the system at ', '2021-04-05 14:30:56'),
(578, 8, 'has logged in the system at ', '2021-04-05 14:31:02'),
(579, 8, 'has logged out the system at ', '2021-04-05 14:58:35'),
(580, 8, 'has logged in the system at ', '2021-04-08 11:29:22'),
(581, 4, 'has logged in the system at ', '2021-04-08 12:39:39'),
(582, 8, 'has logged in the system at ', '2021-04-09 08:53:47'),
(583, 8, 'has logged out the system at ', '2021-04-09 08:53:57'),
(584, 4, 'has logged in the system at ', '2021-04-09 08:54:08'),
(585, 4, 'has logged out the system at ', '2021-04-09 08:56:50'),
(586, 8, 'has logged in the system at ', '2021-04-09 08:56:55'),
(587, 8, 'has logged out the system at ', '2021-04-09 09:14:22'),
(588, 4, 'has logged in the system at ', '2021-04-09 09:14:35'),
(589, 8, 'has logged out the system at ', '2021-04-09 16:06:38'),
(590, 8, 'has logged in the system at ', '2021-04-09 16:06:43'),
(591, 8, 'has logged in the system at ', '2021-04-13 14:50:52'),
(592, 8, 'has logged in the system at ', '2021-04-16 08:35:15'),
(593, 8, 'has logged out the system at ', '2021-04-16 09:22:01'),
(594, 8, 'has logged in the system at ', '2021-04-21 10:10:11'),
(595, 8, 'has logged in the system at ', '2021-04-30 09:08:25'),
(596, 8, 'has logged out the system at ', '2021-04-30 12:26:24'),
(597, 8, 'has logged in the system at ', '2021-04-30 12:26:48'),
(598, 8, 'has logged in the system at ', '2021-05-01 09:34:40'),
(599, 8, 'has logged in the system at ', '2021-05-04 16:08:25'),
(600, 8, 'has logged in the system at ', '2021-06-23 09:40:06'),
(601, 8, 'has logged in the system at ', '2021-06-23 09:41:23'),
(602, 8, 'has logged in the system at ', '2021-07-26 10:07:36'),
(603, 8, 'has logged in the system at ', '2021-09-07 17:14:27'),
(604, 4, 'has logged in the system at ', '2021-09-14 11:10:16'),
(605, 8, 'has logged in the system at ', '2021-09-14 12:15:02'),
(606, 8, 'has logged out the system at ', '2021-09-14 14:00:23'),
(607, 4, 'has logged in the system at ', '2021-09-14 14:00:34'),
(608, 4, 'has logged in the system at ', '2021-09-14 16:10:15'),
(609, 8, 'has logged in the system at ', '2021-09-14 19:12:41'),
(610, 8, 'has logged in the system at ', '2021-09-14 19:27:20'),
(611, 4, 'has logged in the system at ', '2021-09-14 20:12:32'),
(612, 4, 'has logged in the system at ', '2021-09-14 20:37:24'),
(613, 4, 'has logged in the system at ', '2021-09-15 09:07:06'),
(614, 8, 'has logged in the system at ', '2021-09-15 10:46:03'),
(615, 4, 'has logged in the system at ', '2021-09-15 16:14:33'),
(616, 4, 'has logged out the system at ', '2021-09-15 17:20:29'),
(617, 8, 'has logged in the system at ', '2021-09-15 17:20:35'),
(618, 8, 'has logged in the system at ', '2021-09-16 14:47:18'),
(619, 4, 'has logged in the system at ', '2021-09-17 08:54:27'),
(620, 4, 'has logged out the system at ', '2021-09-17 09:52:13'),
(621, 4, 'has logged in the system at ', '2021-09-17 09:52:30'),
(622, 8, 'has logged in the system at ', '2021-09-17 17:25:40'),
(623, 8, 'has logged in the system at ', '2021-09-18 12:20:32'),
(624, 8, 'has logged in the system at ', '2021-09-18 12:49:02'),
(625, 4, 'has logged in the system at ', '2021-09-18 16:24:23'),
(626, 4, 'has logged out the system at ', '2021-09-18 16:25:02'),
(627, 8, 'has logged in the system at ', '2021-09-18 16:25:07'),
(628, 8, 'has logged out the system at ', '2021-09-18 16:25:13'),
(629, 4, 'has logged in the system at ', '2021-09-18 16:25:18'),
(630, 4, 'has logged out the system at ', '2021-09-18 16:25:32'),
(631, 8, 'has logged in the system at ', '2021-09-18 16:25:37'),
(632, 8, 'has logged out the system at ', '2021-09-19 09:39:50'),
(633, 4, 'has logged in the system at ', '2021-09-19 09:39:56'),
(634, 4, 'has logged out the system at ', '2021-09-19 09:40:29'),
(635, 8, 'has logged in the system at ', '2021-09-19 09:40:34'),
(636, 8, 'has logged out the system at ', '2021-09-19 09:41:41'),
(637, 4, 'has logged in the system at ', '2021-09-19 09:41:47'),
(638, 4, 'has logged out the system at ', '2021-09-19 09:42:32'),
(639, 8, 'has logged in the system at ', '2021-09-19 09:42:37'),
(640, 8, 'has logged out the system at ', '2021-09-19 11:42:29'),
(641, 4, 'has logged in the system at ', '2021-09-19 11:42:36'),
(642, 4, 'has logged out the system at ', '2021-09-19 12:02:38'),
(643, 8, 'has logged in the system at ', '2021-09-19 12:41:14'),
(644, 8, 'has logged in the system at ', '2021-09-19 14:19:32'),
(645, 8, 'has logged out the system at ', '2021-09-19 15:14:18'),
(646, 4, 'has logged in the system at ', '2021-09-19 15:14:26'),
(647, 8, 'has logged in the system at ', '2021-09-23 18:11:48'),
(648, 8, 'has logged out the system at ', '2021-09-23 18:16:30'),
(649, 4, 'has logged in the system at ', '2021-09-23 18:16:37'),
(650, 8, 'has logged in the system at ', '2021-10-13 16:34:38'),
(651, 8, 'has logged out the system at ', '2021-10-13 16:57:52'),
(652, 4, 'has logged in the system at ', '2021-10-13 16:57:59'),
(653, 4, 'has logged out the system at ', '2021-10-13 16:58:50'),
(654, 8, 'has logged in the system at ', '2021-10-13 16:59:45'),
(655, 8, 'has logged out the system at ', '2021-10-13 17:26:56'),
(656, 4, 'has logged in the system at ', '2021-10-13 17:27:04'),
(657, 4, 'has logged out the system at ', '2021-10-13 17:38:10'),
(658, 8, 'has logged in the system at ', '2021-10-13 17:38:16'),
(659, 4, 'has logged in the system at ', '2021-10-14 12:17:59'),
(660, 8, 'has logged in the system at ', '2021-10-16 19:12:22'),
(661, 8, 'has logged out the system at ', '2021-10-16 19:12:35'),
(662, 8, 'has logged in the system at ', '2021-10-16 19:13:15'),
(663, 8, 'has logged out the system at ', '2021-10-16 19:19:16'),
(664, 4, 'has logged in the system at ', '2021-10-16 19:19:27'),
(665, 8, 'has logged in the system at ', '2021-10-18 10:24:02'),
(666, 8, 'has logged in the system at ', '2021-10-18 10:49:57'),
(667, 8, 'has logged out the system at ', '2021-10-18 10:49:59'),
(668, 4, 'has logged in the system at ', '2021-10-18 10:50:09'),
(669, 4, 'has logged out the system at ', '2021-10-18 10:53:24'),
(670, 8, 'has logged in the system at ', '2021-10-18 10:53:30'),
(671, 8, 'has logged out the system at ', '2021-10-18 10:59:41'),
(672, 4, 'has logged in the system at ', '2021-10-18 10:59:47'),
(673, 4, 'has logged out the system at ', '2021-10-18 11:04:21'),
(674, 8, 'has logged in the system at ', '2021-10-18 11:04:27'),
(675, 8, 'has logged in the system at ', '2021-10-23 09:54:45'),
(676, 8, 'has logged in the system at ', '2021-10-26 09:02:03'),
(677, 8, 'has logged out the system at ', '2021-10-26 10:17:17'),
(678, 8, 'has logged in the system at ', '2021-10-26 10:18:23'),
(679, 8, 'has logged in the system at ', '2021-10-26 10:19:06'),
(680, 8, 'has logged out the system at ', '2021-10-26 17:37:48'),
(681, 8, 'has logged in the system at ', '2021-10-26 17:37:54'),
(682, 8, 'has logged in the system at ', '2021-10-28 16:53:38'),
(683, 8, 'has logged in the system at ', '2021-10-28 17:51:24'),
(684, 8, 'has logged out the system at ', '2021-10-30 11:08:01'),
(685, 8, 'has logged in the system at ', '2021-10-30 11:08:09'),
(686, 8, 'has logged in the system at ', '2021-11-15 09:01:30'),
(687, 8, 'has logged out the system at ', '2021-11-15 09:03:02'),
(688, 8, 'has logged in the system at ', '2021-11-15 09:03:07'),
(689, 8, 'has logged out the system at ', '2021-11-15 12:30:01'),
(690, 8, 'has logged in the system at ', '2021-11-15 12:36:31'),
(691, 8, 'has logged in the system at ', '2021-11-15 14:14:51'),
(692, 8, 'has logged out the system at ', '2021-11-15 17:40:50'),
(693, 8, 'has logged in the system at ', '2021-11-15 17:40:57'),
(694, 8, 'has logged out the system at ', '2021-11-16 09:14:32'),
(695, 8, 'has logged in the system at ', '2021-11-16 09:16:06'),
(696, 8, 'has logged out the system at ', '2021-11-16 15:48:07'),
(697, 8, 'has logged in the system at ', '2021-11-16 15:48:13'),
(698, 8, 'has logged in the system at ', '2021-11-17 18:26:27'),
(699, 8, 'has logged out the system at ', '2021-11-17 18:26:43'),
(700, 12, 'has logged in the system at ', '2021-11-17 18:26:48'),
(701, 12, 'has logged out the system at ', '2021-11-17 18:40:21'),
(702, 4, 'has logged in the system at ', '2021-11-18 08:17:54'),
(703, 8, 'has logged in the system at ', '2021-11-25 08:31:44'),
(704, 8, 'has logged out the system at ', '2021-11-25 08:32:36'),
(705, 12, 'has logged in the system at ', '2021-11-25 08:32:41'),
(706, 12, 'has logged out the system at ', '2021-11-25 08:37:30'),
(707, 8, 'has logged in the system at ', '2021-11-25 08:37:35'),
(708, 12, 'has logged in the system at ', '2021-11-25 09:04:27'),
(709, 8, 'has logged in the system at ', '2021-11-27 09:10:39'),
(710, 8, 'has logged out the system at ', '2021-11-27 09:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tb`
--

CREATE TABLE `inventory_tb` (
  `id` int(12) NOT NULL,
  `name` text NOT NULL,
  `quantity` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices_tb`
--

CREATE TABLE `invoices_tb` (
  `id` int(12) NOT NULL,
  `order_no` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices_tb`
--

INSERT INTO `invoices_tb` (`id`, `order_no`) VALUES
(91, 2383),
(92, 2383),
(93, 2383),
(94, 2383),
(95, 2383),
(96, 2307),
(97, 1256),
(98, 4565),
(99, 1165),
(100, 207),
(101, 1070),
(102, 2062),
(103, 0),
(104, 0),
(105, 0),
(106, 0),
(107, 0),
(108, 0),
(109, 0),
(110, 0),
(111, 0),
(112, 0),
(113, 0),
(114, 752),
(115, 752),
(116, 1393),
(117, 1393),
(118, 1393),
(119, 1393),
(120, 1393),
(121, 1393),
(122, 1393),
(123, 4611),
(124, 4611),
(125, 4611),
(126, 4611),
(127, 4611),
(128, 4611),
(129, 4611),
(130, 4611),
(131, 4611),
(132, 4611),
(133, 4611),
(134, 3197),
(135, 3197),
(136, 3197),
(137, 3197),
(138, 3197),
(139, 3197),
(140, 3197),
(141, 3197),
(142, 3197),
(143, 3197),
(144, 1865),
(145, 1865),
(146, 1865),
(147, 1865),
(148, 2692),
(149, 1737),
(150, 1737),
(151, 4089),
(152, 1082),
(153, 1082),
(154, 807),
(155, 2203),
(156, 3341),
(157, 4087),
(158, 1719),
(159, 348),
(160, 3039),
(161, 3039),
(162, 3136),
(163, 4598),
(164, 4893),
(165, 1609),
(166, 212),
(167, 812),
(168, 812),
(169, 3692),
(170, 4518),
(171, 0),
(172, 0),
(173, 1641),
(174, 1805),
(175, 1805),
(176, 3393),
(177, 4879),
(178, 1827),
(179, 159),
(180, 4752),
(181, 2982),
(182, 3302),
(183, 1402),
(184, 1881),
(185, 2618),
(186, 1377),
(187, 1878),
(188, 383),
(189, 84),
(190, 749),
(191, 4322),
(192, 1170),
(193, 978),
(194, 4821),
(195, 3640),
(196, 4218),
(197, 1540),
(198, 2757),
(199, 2757),
(200, 2757),
(201, 1075),
(202, 1075),
(203, 3476),
(204, 2018),
(205, 879),
(206, 2446),
(207, 4443),
(208, 2307),
(209, 1344),
(210, 3631),
(211, 3631),
(212, 1708),
(213, 3431),
(214, 2182),
(215, 2700),
(216, 1498),
(217, 1085),
(218, 1178),
(219, 353),
(220, 4819),
(221, 4819),
(222, 4323),
(223, 511),
(224, 511),
(225, 4531),
(226, 812),
(227, 1422),
(228, 442),
(229, 4438),
(230, 4126),
(231, 3095),
(232, 2277),
(233, 2784),
(234, 1218),
(235, 1617),
(236, 1617),
(237, 3399),
(238, 4617),
(239, 4181),
(240, 4181),
(241, 4181),
(242, 637),
(243, 637),
(244, 637),
(245, 1940),
(246, 1940),
(247, 1389),
(248, 1389),
(249, 391),
(250, 391),
(251, 391),
(252, 2486),
(253, 2486),
(254, 2486),
(255, 131),
(256, 2984),
(257, 2984),
(258, 892),
(259, 892),
(260, 4069),
(261, 4069),
(262, 2752),
(263, 2440),
(264, 2446),
(265, 2688),
(266, 2485),
(267, 1222),
(268, 588),
(269, 915),
(270, 3974),
(271, 3974),
(272, 3974),
(273, 3974),
(274, 4300),
(275, 699),
(276, 4703),
(277, 4494),
(278, 2254),
(279, 2911),
(280, 3146),
(281, 3608),
(282, 0),
(283, 3836),
(284, 2680),
(285, 3657),
(286, 1072),
(287, 4464),
(288, 3391),
(289, 3951),
(290, 3398),
(291, 3398),
(292, 3398),
(293, 653),
(294, 653),
(295, 2413),
(296, 286),
(297, 4499),
(298, 1036),
(299, 3394),
(300, 3519),
(301, 3519),
(302, 3519),
(303, 2595),
(304, 2595),
(305, 3808),
(306, 4275),
(307, 4275),
(308, 0),
(309, 0),
(310, 1816),
(311, 1816),
(312, 1899),
(313, 1899),
(314, 3778),
(315, 693),
(316, 3647),
(317, 3549),
(318, 3100),
(319, 168),
(320, 168),
(321, 4731),
(322, 4731),
(323, 497),
(324, 497),
(325, 220),
(326, 220),
(327, 2995),
(328, 2995),
(329, 1760),
(330, 1760),
(331, 1486),
(332, 642),
(333, 2133),
(334, 2133),
(335, 3488),
(336, 3091),
(337, 4196),
(338, 4196),
(339, 544),
(340, 3713),
(341, 3713),
(342, 4074),
(343, 184),
(344, 420),
(345, 3102),
(346, 3102),
(347, 3770),
(348, 1047),
(349, 1149),
(350, 138),
(351, 138),
(352, 2261),
(353, 2261),
(354, 2261),
(355, 2526),
(356, 2526),
(357, 1967),
(358, 1967),
(359, 2081),
(360, 1554),
(361, 2411),
(362, 1624),
(363, 2567),
(364, 2567),
(365, 1487),
(366, 233),
(367, 4357),
(368, 4862),
(369, 4862),
(370, 306),
(371, 3632),
(372, 3470),
(373, 3470),
(374, 3470),
(375, 3470),
(376, 3470),
(377, 3938),
(378, 3938),
(379, 4685),
(380, 3715),
(381, 1023),
(382, 1005),
(383, 4867),
(384, 1613),
(385, 2917),
(386, 4087),
(387, 4952),
(388, 4534),
(389, 1937),
(390, 1937),
(391, 660),
(392, 3285),
(393, 3285),
(394, 743),
(395, 743),
(396, 1316),
(397, 658),
(398, 912),
(399, 789),
(400, 4114),
(401, 3777),
(402, 3777),
(403, 2616),
(404, 4904),
(405, 1963),
(406, 1126),
(407, 1835),
(408, 2012),
(409, 2012),
(410, 2012),
(411, 2012),
(412, 4392),
(413, 2529),
(414, 2965),
(415, 2965),
(416, 3495),
(417, 3495),
(418, 2121),
(419, 3664),
(420, 3664),
(421, 4271),
(422, 1955),
(423, 1955),
(424, 4708),
(425, 4708),
(426, 553),
(427, 553),
(428, 629),
(429, 4166),
(430, 4326),
(431, 976),
(432, 2912),
(433, 4255),
(434, 4255),
(435, 662),
(436, 1090),
(437, 106),
(438, 2661),
(439, 813),
(440, 2042),
(441, 2042),
(442, 1195),
(443, 2126),
(444, 3624),
(445, 4427),
(446, 4427),
(447, 4427),
(448, 2890),
(449, 619),
(450, 3800),
(451, 3800),
(452, 4375),
(453, 2080),
(454, 2080),
(455, 2080),
(456, 1964),
(457, 3032),
(458, 1038),
(459, 1736),
(460, 1736),
(461, 2884),
(462, 980),
(463, 3142),
(464, 1737),
(465, 3570),
(466, 175),
(467, 4139),
(468, 2000),
(469, 2085),
(470, 2240),
(471, 1786),
(472, 1786),
(473, 1576),
(474, 1576),
(475, 402),
(476, 3397),
(477, 1318),
(478, 1411),
(479, 3078),
(480, 975),
(481, 1337),
(482, 1072),
(483, 1339),
(484, 1912),
(485, 2166),
(486, 370),
(487, 3931),
(488, 3340),
(489, 2272),
(490, 1747),
(491, 4076),
(492, 3523),
(493, 3617),
(494, 2526),
(495, 2067),
(496, 2440),
(497, 3468),
(498, 4434),
(499, 4434),
(500, 4434),
(501, 4434),
(502, 4434),
(503, 4649),
(504, 4711),
(505, 4272),
(506, 4347),
(507, 1139),
(508, 1252),
(509, 474),
(510, 4486),
(511, 4486),
(512, 1716),
(513, 1877),
(514, 431),
(515, 247),
(516, 1732),
(517, 1732),
(518, 472),
(519, 472),
(520, 2283),
(521, 1875),
(522, 4680),
(523, 3444),
(524, 3950),
(525, 4586),
(526, 1446),
(527, 3834),
(528, 2864),
(529, 4764),
(530, 879),
(531, 4502),
(532, 4467),
(533, 1762),
(534, 3062),
(535, 1627),
(536, 2960),
(537, 3403),
(538, 1976),
(539, 2452),
(540, 4366),
(541, 3643),
(542, 320),
(543, 320),
(544, 2605),
(545, 3651),
(546, 3390),
(547, 2427),
(548, 2427),
(549, 614),
(550, 2535),
(551, 1882),
(552, 1832),
(553, 4106),
(554, 4100),
(555, 1979),
(556, 3914),
(557, 1145),
(558, 1650),
(559, 1282),
(560, 4994),
(561, 3580),
(562, 1718),
(563, 436),
(564, 2765),
(565, 2295),
(566, 1008),
(567, 1017),
(568, 2747),
(569, 4118),
(570, 931),
(571, 1262),
(572, 1927),
(573, 4268),
(574, 2786),
(575, 466),
(576, 4851),
(577, 446),
(578, 687),
(579, 3528),
(580, 4931),
(581, 4794),
(582, 1868),
(583, 871),
(584, 3773),
(585, 2398),
(586, 1830),
(587, 1830),
(588, 1888),
(589, 4488),
(590, 4488),
(591, 4374),
(592, 1272),
(593, 269),
(594, 2151),
(595, 2864),
(596, 368),
(597, 3878),
(598, 327),
(599, 4304),
(600, 2435),
(601, 1703),
(602, 1084),
(603, 1084),
(604, 1084),
(605, 4904),
(606, 4120),
(607, 1354),
(608, 2977),
(609, 1434),
(610, 1434),
(611, 1434),
(612, 3867),
(613, 3892),
(614, 3556),
(615, 3981),
(616, 4223),
(617, 402),
(618, 524),
(619, 3997),
(620, 318),
(621, 1464),
(622, 4239),
(623, 4075),
(624, 4782),
(625, 1894),
(626, 1443),
(627, 3190),
(628, 3722),
(629, 2381),
(630, 781),
(631, 983),
(632, 2813),
(633, 76),
(634, 307),
(635, 1068),
(636, 3085),
(637, 2436),
(638, 4643),
(639, 1219),
(640, 4573),
(641, 3185),
(642, 4766),
(643, 269),
(644, 765),
(645, 804),
(646, 4669),
(647, 3413),
(648, 2285),
(649, 4576),
(650, 1380),
(651, 4852),
(652, 4163),
(653, 3841),
(654, 2017),
(655, 3271),
(656, 2072),
(657, 4496),
(658, 4837),
(659, 430),
(660, 4309),
(661, 3180),
(662, 4611),
(663, 3847),
(664, 2499),
(665, 430),
(666, 655),
(667, 3478),
(668, 4958),
(669, 814),
(670, 2489),
(671, 4282),
(672, 2545),
(673, 1252),
(674, 1748),
(675, 3724),
(676, 383),
(677, 3084),
(678, 647),
(679, 1054),
(680, 2812),
(681, 1001),
(682, 4142),
(683, 1514),
(684, 1514),
(685, 4729),
(686, 4286),
(687, 4631),
(688, 1717),
(689, 1717),
(690, 2845),
(691, 2808),
(692, 4458),
(693, 4722),
(694, 2882),
(695, 4817),
(696, 4270),
(697, 2628),
(698, 966),
(699, 2651),
(700, 1680),
(701, 1506),
(702, 1506),
(703, 797),
(704, 547),
(705, 3676),
(706, 3327),
(707, 1913),
(708, 2942),
(709, 2692),
(710, 687),
(711, 3007),
(712, 2271),
(713, 301),
(714, 1088),
(715, 1746),
(716, 1994),
(717, 4245),
(718, 3617),
(719, 4953),
(720, 3617),
(721, 1624),
(722, 4908),
(723, 1688),
(724, 1410),
(725, 1900),
(726, 823),
(727, 2530),
(728, 2530),
(729, 560),
(730, 3618),
(731, 1619),
(732, 1618),
(733, 874),
(734, 331),
(735, 3674),
(736, 3194),
(737, 4003),
(738, 718),
(739, 1829),
(740, 2197),
(741, 2009),
(742, 4866),
(743, 4549),
(744, 4420),
(745, 4737),
(746, 1874),
(747, 1874),
(748, 3606),
(749, 3606),
(750, 3685),
(751, 2433),
(752, 529),
(753, 2526),
(754, 801),
(755, 4435),
(756, 1449),
(757, 149),
(758, 3554),
(759, 2261),
(760, 781),
(761, 1613),
(762, 4333),
(763, 4333),
(764, 2066),
(765, 1689),
(766, 2517),
(767, 263),
(768, 3059),
(769, 3350),
(770, 4188),
(771, 4919),
(772, 1544),
(773, 3500),
(774, 4667),
(775, 3347),
(776, 4874),
(777, 3225),
(778, 4924),
(779, 1608),
(780, 4886),
(781, 3699),
(782, 2892),
(783, 3481),
(784, 1203),
(785, 3497),
(786, 2142),
(787, 3560),
(788, 2236),
(789, 590),
(790, 3829),
(791, 3219),
(792, 2937),
(793, 4312),
(794, 3630),
(795, 3367),
(796, 2538),
(797, 753),
(798, 1251),
(799, 3302),
(800, 686),
(801, 1957),
(802, 3645),
(803, 1982),
(804, 2988),
(805, 2093),
(806, 3974),
(807, 1405),
(808, 4697),
(809, 666),
(810, 232),
(811, 4984),
(812, 3073),
(813, 1049),
(814, 3941),
(815, 1575),
(816, 1575),
(817, 522),
(818, 4285),
(819, 880),
(820, 1699),
(821, 4191),
(822, 2708),
(823, 1644),
(824, 1053),
(825, 2905),
(826, 2190),
(827, 3094),
(828, 3664),
(829, 1601),
(830, 1648),
(831, 2611),
(832, 2712),
(833, 2851),
(834, 3252),
(835, 3978),
(836, 2974),
(837, 400),
(838, 400),
(839, 3274),
(840, 212),
(841, 3602),
(842, 2341),
(843, 3549),
(844, 143),
(845, 3426),
(846, 192),
(847, 1683),
(848, 567),
(849, 2042),
(850, 2329),
(851, 4110),
(852, 4110),
(853, 677),
(854, 4896),
(855, 4896),
(856, 4418),
(857, 4418),
(858, 4418),
(859, 627),
(860, 4302),
(861, 3025),
(862, 855),
(863, 1363),
(864, 1946),
(865, 2580),
(866, 2045),
(867, 3711),
(868, 1962),
(869, 4967),
(870, 2289),
(871, 1845),
(872, 4508),
(873, 2366),
(874, 3176),
(875, 3237),
(876, 4834),
(877, 1387),
(878, 4608),
(879, 4992),
(880, 4992),
(881, 2703),
(882, 2303),
(883, 3983),
(884, 393),
(885, 395),
(886, 1655),
(887, 827),
(888, 4895),
(889, 3010),
(890, 2167),
(891, 1088),
(892, 1942),
(893, 3477),
(894, 3904),
(895, 4020),
(896, 4732),
(897, 4800),
(898, 2417),
(899, 1801),
(900, 4191),
(901, 4178),
(902, 1866),
(903, 1912),
(904, 2761),
(905, 2840),
(906, 2977),
(907, 2977),
(908, 1994),
(909, 2542),
(910, 1117),
(911, 4356),
(912, 358),
(913, 4229),
(914, 4199),
(915, 1419),
(916, 3768),
(917, 3255),
(918, 4137),
(919, 1962),
(920, 2434),
(921, 1488),
(922, 161),
(923, 4911),
(924, 2513),
(925, 4661),
(926, 86),
(927, 4224),
(928, 3387),
(929, 1719),
(930, 2735),
(931, 4440),
(932, 3335),
(933, 4202),
(934, 1466),
(935, 4388),
(936, 196),
(937, 78),
(938, 1167),
(939, 4264),
(940, 1657),
(941, 3449),
(942, 4114),
(943, 2367),
(944, 2513),
(945, 2941),
(946, 776),
(947, 202),
(948, 4584),
(949, 4317),
(950, 2268),
(951, 3034),
(952, 3930),
(953, 2192),
(954, 3052),
(955, 2235),
(956, 2943),
(957, 1601),
(958, 1601),
(959, 1601),
(960, 1601),
(961, 1601),
(962, 1601),
(963, 1601),
(964, 1601),
(965, 1601),
(966, 1601),
(967, 1601),
(968, 1601),
(969, 1601),
(970, 1601),
(971, 1601),
(972, 1601),
(973, 1601),
(974, 1601),
(975, 1601),
(976, 3004),
(977, 3004),
(978, 744),
(979, 1818),
(980, 1818),
(981, 1818),
(982, 1818),
(983, 2193),
(984, 517),
(985, 4771),
(986, 4771),
(987, 3672),
(988, 1685),
(989, 251),
(990, 1484),
(991, 4183),
(992, 2653),
(993, 2727),
(994, 2727),
(995, 2321),
(996, 3097),
(997, 0),
(998, 4998),
(999, 1794),
(1000, 0),
(1001, 2271),
(1002, 1599),
(1003, 3167),
(1004, 3167),
(1005, 461),
(1006, 5000),
(1007, 5000),
(1008, 1224),
(1009, 727),
(1010, 2506),
(1011, 3061),
(1012, 3061),
(1013, 3061),
(1014, 3061),
(1015, 3061),
(1016, 3061),
(1017, 2216),
(1018, 2216),
(1019, 2216),
(1020, 219),
(1021, 3675),
(1022, 3675),
(1023, 3675),
(1024, 3675),
(1025, 3675),
(1026, 3675),
(1027, 3675),
(1028, 3675),
(1029, 3675),
(1030, 3675),
(1031, 3675),
(1032, 3675),
(1033, 0),
(1034, 0),
(1035, 0),
(1036, 537),
(1037, 0),
(1038, 0),
(1039, 4760),
(1040, 4760),
(1041, 0),
(1042, 0),
(1043, 0),
(1044, 0),
(1045, 0),
(1046, 0),
(1047, 0),
(1048, 0),
(1049, 0),
(1050, 0),
(1051, 0),
(1052, 1998),
(1053, 0),
(1054, 1847),
(1055, 1526),
(1056, 0),
(1057, 0),
(1058, 0),
(1059, 0),
(1060, 0),
(1061, 0),
(1062, 0),
(1063, 0),
(1064, 0),
(1065, 0),
(1066, 0),
(1067, 0),
(1068, 0),
(1069, 3120),
(1070, 2591),
(1071, 2591),
(1072, 2591),
(1073, 3155),
(1074, 3155),
(1075, 3155),
(1076, 3155),
(1077, 3155),
(1078, 3155),
(1079, 3155),
(1080, 3155),
(1081, 3155),
(1082, 3155),
(1083, 3155),
(1084, 3155),
(1085, 3155),
(1086, 3155),
(1087, 3155),
(1088, 3155),
(1089, 3155),
(1090, 3155),
(1091, 3155),
(1092, 3155),
(1093, 3155),
(1094, 3155),
(1095, 4216),
(1096, 4216),
(1097, 145),
(1098, 145),
(1099, 145),
(1100, 145),
(1101, 145),
(1102, 0),
(1103, 0),
(1104, 2192),
(1105, 2192),
(1106, 0),
(1107, 0),
(1108, 0),
(1109, 763),
(1110, 763),
(1111, 763),
(1112, 763),
(1113, 763),
(1114, 763),
(1115, 0),
(1116, 0),
(1117, 0),
(1118, 0),
(1119, 0),
(1120, 0),
(1121, 0),
(1122, 0),
(1123, 2087),
(1124, 2087),
(1125, 2087),
(1126, 2087),
(1127, 2087),
(1128, 2087),
(1129, 2087),
(1130, 2087),
(1131, 2087),
(1132, 2087),
(1133, 2087),
(1134, 2087),
(1135, 2087),
(1136, 2087),
(1137, 2087),
(1138, 2087),
(1139, 2087),
(1140, 2087),
(1141, 2087),
(1142, 2087),
(1143, 2087),
(1144, 2087),
(1145, 2087),
(1146, 2087),
(1147, 0),
(1148, 0),
(1149, 0),
(1150, 0),
(1151, 0),
(1152, 0),
(1153, 772),
(1154, 772),
(1155, 772),
(1156, 772),
(1157, 772),
(1158, 772),
(1159, 199),
(1160, 199),
(1161, 199),
(1162, 0),
(1163, 2127),
(1164, 1609),
(1165, 1609),
(1166, 1609),
(1167, 1609),
(1168, 1609),
(1169, 1609),
(1170, 155),
(1171, 155),
(1172, 155),
(1173, 0),
(1174, 448),
(1175, 448),
(1176, 1061),
(1177, 1061),
(1178, 3986),
(1179, 3986),
(1180, 3986),
(1181, 3986),
(1182, 3986),
(1183, 3986),
(1184, 3986),
(1185, 3986),
(1186, 3986),
(1187, 810),
(1188, 1634),
(1189, 1634),
(1190, 1634),
(1191, 1634),
(1192, 1634),
(1193, 1634),
(1194, 1634),
(1195, 1634),
(1196, 1634),
(1197, 1634),
(1198, 1634),
(1199, 1634),
(1200, 1634),
(1201, 1634),
(1202, 1634),
(1203, 1634),
(1204, 1634),
(1205, 1844),
(1206, 1844),
(1207, 1844),
(1208, 1844),
(1209, 1844),
(1210, 1844),
(1211, 0),
(1212, 2340),
(1213, 0),
(1214, 0),
(1215, 0),
(1216, 0),
(1217, 0),
(1218, 0),
(1219, 0),
(1220, 0),
(1221, 0),
(1222, 0),
(1223, 0),
(1224, 0),
(1225, 0),
(1226, 0),
(1227, 0),
(1228, 0),
(1229, 0),
(1230, 0),
(1231, 0),
(1232, 0),
(1233, 0),
(1234, 0),
(1235, 0),
(1236, 0),
(1237, 0),
(1238, 0),
(1239, 0),
(1240, 0),
(1241, 0),
(1242, 0),
(1243, 0),
(1244, 0),
(1245, 0),
(1246, 0),
(1247, 0),
(1248, 0),
(1249, 0),
(1250, 0),
(1251, 0),
(1252, 0),
(1253, 0),
(1254, 0),
(1255, 0),
(1256, 0),
(1257, 0),
(1258, 0),
(1259, 0),
(1260, 0),
(1261, 0),
(1262, 0),
(1263, 0),
(1264, 0),
(1265, 0),
(1266, 0),
(1267, 0),
(1268, 0),
(1269, 0),
(1270, 0),
(1271, 0),
(1272, 0),
(1273, 0),
(1274, 0),
(1275, 0),
(1276, 0),
(1277, 0),
(1278, 0),
(1279, 0),
(1280, 0),
(1281, 0),
(1282, 0),
(1283, 0),
(1284, 0),
(1285, 0),
(1286, 0),
(1287, 0),
(1288, 0),
(1289, 0),
(1290, 0),
(1291, 0),
(1292, 0),
(1293, 0),
(1294, 0),
(1295, 0),
(1296, 0),
(1297, 0),
(1298, 0),
(1299, 0),
(1300, 0),
(1301, 0),
(1302, 0),
(1303, 0),
(1304, 0),
(1305, 0),
(1306, 0),
(1307, 0),
(1308, 0),
(1309, 0),
(1310, 0),
(1311, 0),
(1312, 0),
(1313, 0),
(1314, 0),
(1315, 0),
(1316, 0),
(1317, 0),
(1318, 0),
(1319, 0),
(1320, 0),
(1321, 0),
(1322, 0),
(1323, 0),
(1324, 0),
(1325, 0),
(1326, 0),
(1327, 0),
(1328, 0),
(1329, 0),
(1330, 0),
(1331, 0),
(1332, 0),
(1333, 0),
(1334, 0),
(1335, 0),
(1336, 0),
(1337, 0),
(1338, 0),
(1339, 0),
(1340, 0),
(1341, 0),
(1342, 0),
(1343, 0),
(1344, 0),
(1345, 0),
(1346, 0),
(1347, 0),
(1348, 0),
(1349, 0),
(1350, 111),
(1351, 111),
(1352, 0),
(1353, 0),
(1354, 0),
(1355, 0),
(1356, 111),
(1357, 111),
(1358, 0),
(1359, 0),
(1360, 149),
(1361, 3085),
(1362, 2695),
(1363, 4706),
(1364, 1949),
(1365, 2133),
(1366, 4601),
(1367, 1822),
(1368, 237),
(1369, 0),
(1370, 0),
(1371, 0),
(1372, 0),
(1373, 0),
(1374, 0),
(1375, 0),
(1376, 0),
(1377, 0),
(1378, 0),
(1379, 0),
(1380, 0),
(1381, 0),
(1382, 0),
(1383, 0),
(1384, 0),
(1385, 0),
(1386, 0),
(1387, 4393),
(1388, 3785),
(1389, 2527),
(1390, 769),
(1391, 1897),
(1392, 3762),
(1393, 1463),
(1394, 1673),
(1395, 0),
(1396, 0),
(1397, 0),
(1398, 0),
(1399, 0),
(1400, 0),
(1401, 0),
(1402, 3008),
(1403, 3386),
(1404, 917),
(1405, 3457),
(1406, 4670),
(1407, 880),
(1408, 72),
(1409, 896),
(1410, 4788),
(1411, 3398),
(1412, 3407),
(1413, 4780),
(1414, 4969),
(1415, 4573),
(1416, 2411),
(1417, 4827),
(1418, 246),
(1419, 1789),
(1420, 3124),
(1421, 3167),
(1422, 2267),
(1423, 4139),
(1424, 1752),
(1425, 0),
(1426, 2983),
(1427, 3454),
(1428, 4040),
(1429, 4963),
(1430, 1861),
(1431, 2245),
(1432, 1197),
(1433, 855),
(1434, 2417),
(1435, 2996),
(1436, 2677),
(1437, 4381),
(1438, 3247),
(1439, 895),
(1440, 2025),
(1441, 3716),
(1442, 3037),
(1443, 3631),
(1444, 3520),
(1445, 2171),
(1446, 3264),
(1447, 2911),
(1448, 532),
(1449, 3930),
(1450, 1861),
(1451, 409),
(1452, 4152),
(1453, 1133),
(1454, 2179),
(1455, 3963),
(1456, 3638),
(1457, 2142),
(1458, 2778),
(1459, 2029),
(1460, 1839),
(1461, 4936),
(1462, 1149),
(1463, 644),
(1464, 2131),
(1465, 3443),
(1466, 1283),
(1467, 2838),
(1468, 3749),
(1469, 1265),
(1470, 3966),
(1471, 2651),
(1472, 1872),
(1473, 3096),
(1474, 2563),
(1475, 348),
(1476, 4489),
(1477, 3341),
(1478, 2618),
(1479, 775),
(1480, 4762),
(1481, 1250),
(1482, 4711),
(1483, 382),
(1484, 3320),
(1485, 3696),
(1486, 1598),
(1487, 3643),
(1488, 921),
(1489, 0),
(1490, 0),
(1491, 0),
(1492, 1753),
(1493, 2970),
(1494, 2827);

-- --------------------------------------------------------

--
-- Table structure for table `inv_damages_tb`
--

CREATE TABLE `inv_damages_tb` (
  `id` int(12) NOT NULL,
  `inv_id` int(12) NOT NULL,
  `quantity` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `licience_reg_tb`
--

CREATE TABLE `licience_reg_tb` (
  `id` int(12) NOT NULL,
  `exp_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `licience_key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `licience_reg_tb`
--

INSERT INTO `licience_reg_tb` (`id`, `exp_date`, `licience_key`) VALUES
(1, '2022-12-31 22:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `modes_of_payment_tb`
--

CREATE TABLE `modes_of_payment_tb` (
  `payment_mode_id` int(12) NOT NULL,
  `name` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modes_of_payment_tb`
--

INSERT INTO `modes_of_payment_tb` (`payment_mode_id`, `name`, `date`) VALUES
(1, 'Cash', '2019-11-03 16:29:35'),
(3, 'MTN Mobile Money', '2019-11-03 16:40:42'),
(5, 'Cheque', '2020-12-15 15:40:14'),
(6, 'EFT', '2020-12-15 15:41:17'),
(7, 'Airtel Mobile Money', '2020-12-15 15:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_settings_tb`
--

CREATE TABLE `notifications_settings_tb` (
  `id` int(12) NOT NULL,
  `not_count` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `open_close_cashout_tb`
--

CREATE TABLE `open_close_cashout_tb` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `login` text NOT NULL,
  `logout` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_close_cashout_tb`
--

INSERT INTO `open_close_cashout_tb` (`id`, `user_id`, `login`, `logout`, `status`) VALUES
(1, 8, '2019-08-17 13:14:24', '2019-08-22 13:26:44', 'closed'),
(2, 8, '2019-08-22 13:41:40', '2019-08-22 14:49:26', 'closed'),
(3, 8, '2019-08-22 15:34:41', '2019-08-22 15:34:55', 'closed'),
(4, 8, '2019-08-25 14:15:36', '2019-09-03 09:46:31', 'closed'),
(5, 8, '2019-09-03 11:47:28', '2019-09-04 18:42:00', 'closed'),
(6, 8, '2019-09-04 18:42:36', '2019-09-06 08:13:55', 'closed'),
(7, 8, '2019-09-06 08:14:30', '2019-09-06 08:55:26', 'closed'),
(8, 8, '2019-09-06 08:56:58', '2019-09-06 09:06:41', 'closed'),
(9, 8, '2019-09-06 16:03:33', '2019-09-06 17:01:39', 'closed'),
(10, 8, '2019-09-06 17:01:59', '2019-09-06 22:26:50', 'closed'),
(11, 8, '2019-09-06 22:26:58', '2019-09-12 10:21:13', 'closed'),
(12, 8, '2019-09-12 12:10:25', '2019-09-30 17:51:56', 'closed'),
(13, 8, '2019-09-30 18:08:43', '2019-09-30 19:03:04', 'closed'),
(14, 8, '2019-09-30 19:04:34', '2019-09-30 19:13:44', 'closed'),
(15, 8, '2019-09-30 19:25:36', '2019-10-08 10:41:48', 'closed'),
(16, 8, '2019-10-08 10:54:28', '2019-10-09 09:01:08', 'closed'),
(17, 8, '2019-10-09 09:01:56', '2019-10-11 14:44:33', 'closed'),
(18, 8, '2019-10-11 14:45:23', '2019-10-11 14:53:35', 'closed'),
(19, 8, '2019-10-11 15:01:31', '2019-10-14 21:42:50', 'closed'),
(20, 8, '2019-10-14 21:57:13', '2019-10-15 17:57:44', 'closed'),
(21, 8, '2019-10-15 18:05:56', '2019-10-15 18:06:10', 'closed'),
(22, 8, '2019-10-15 18:11:08', '2019-10-15 18:11:21', 'closed'),
(23, 8, '2019-10-16 11:04:08', '2019-10-16 11:08:07', 'closed'),
(24, 8, '2019-10-16 11:12:39', '2019-10-21 10:28:31', 'closed'),
(25, 8, '2019-10-21 13:07:18', '2019-11-15 11:10:31', 'closed'),
(26, 8, '2019-12-30 14:53:26', '2019-12-30 17:25:18', 'closed'),
(27, 8, '2020-01-14 10:20:47', '2020-01-14 10:33:45', 'closed'),
(28, 8, '2020-01-14 10:33:49', '2020-01-27 10:16:24', 'closed'),
(29, 8, '2020-01-27 10:22:56', '2020-01-27 11:43:01', 'closed'),
(30, 8, '2020-01-27 11:43:40', '2020-01-28 18:25:09', 'closed'),
(31, 8, '2020-01-28 18:28:39', '2020-01-28 18:43:50', 'closed'),
(32, 8, '2020-01-28 18:43:55', '2020-01-28 18:44:09', 'closed'),
(33, 8, '2020-01-28 20:18:34', '2020-01-28 20:19:48', 'closed'),
(34, 8, '2020-01-28 20:34:39', '2020-01-28 20:37:35', 'closed'),
(35, 8, '2020-01-28 20:39:03', '2020-01-28 20:40:08', 'closed'),
(36, 8, '2020-01-28 20:40:45', '2020-01-29 09:58:55', 'closed'),
(37, 8, '2020-01-29 15:14:14', '2020-01-29 15:14:17', 'closed'),
(38, 8, '2020-01-30 11:28:46', '2020-01-30 11:28:52', 'closed'),
(39, 8, '2020-01-30 11:28:57', '2020-01-30 18:01:31', 'closed'),
(40, 8, '2020-01-30 18:01:37', '2020-01-31 11:40:23', 'closed'),
(41, 8, '2020-01-31 11:53:26', '2020-10-21 10:15:58', 'closed'),
(42, 8, '2020-10-26 11:31:54', '2020-10-26 11:32:54', 'closed'),
(43, 8, '2020-10-26 15:15:31', '2020-10-26 15:29:39', 'closed'),
(44, 8, '2020-10-30 11:57:56', '2020-11-29 17:00:28', 'closed'),
(45, 8, '2020-11-29 17:01:41', '2020-11-29 17:05:21', 'closed'),
(46, 8, '2020-11-29 17:07:15', '2020-11-29 18:28:22', 'closed'),
(47, 8, '2020-11-29 20:21:21', '2020-11-29 20:50:18', 'closed'),
(48, 8, '2020-11-29 20:54:07', '2020-11-29 21:02:55', 'closed'),
(49, 8, '2020-11-29 21:06:29', '2020-11-29 23:13:23', 'closed'),
(50, 8, '2020-11-30 15:35:26', '2020-12-02 14:36:55', 'closed'),
(51, 8, '2020-12-02 15:22:42', '2020-12-02 16:25:06', 'closed'),
(52, 8, '2020-12-14 14:44:46', '2020-12-14 14:47:26', 'closed'),
(53, 8, '2020-12-14 23:10:04', '2020-12-15 15:27:56', 'closed'),
(54, 8, '2020-12-15 15:40:48', '2020-12-15 15:58:35', 'closed'),
(55, 8, '2020-12-15 17:34:52', '2020-12-15 17:36:39', 'closed'),
(56, 8, '2020-12-15 17:43:10', '2020-12-15 17:49:34', 'closed'),
(57, 8, '2020-12-16 10:41:02', '2020-12-16 10:50:29', 'closed'),
(58, 8, '2020-12-17 08:23:19', '2020-12-17 08:38:59', 'closed'),
(59, 8, '2020-12-17 10:03:04', '2020-12-17 10:04:22', 'closed'),
(60, 8, '2020-12-17 17:35:05', '2020-12-17 18:07:25', 'closed'),
(61, 8, '2020-12-17 18:08:21', '2020-12-17 18:08:31', 'closed'),
(62, 8, '2020-12-20 11:47:38', '2020-12-20 12:02:41', 'closed'),
(63, 8, '2020-12-22 14:21:09', '2020-12-22 14:37:40', 'closed'),
(64, 8, '2020-12-22 14:40:32', '2020-12-22 17:56:42', 'closed'),
(65, 8, '2020-12-22 21:25:46', '2020-12-22 21:37:55', 'closed'),
(66, 8, '2020-12-22 21:38:00', '2020-12-22 21:38:02', 'closed'),
(67, 8, '2020-12-23 16:14:01', '2020-12-23 16:42:36', 'closed'),
(68, 8, '2020-12-24 16:19:42', '2020-12-24 16:21:25', 'closed'),
(69, 8, '2020-12-27 17:24:21', '2020-12-27 17:31:14', 'closed'),
(70, 8, '2020-12-27 17:32:04', '2020-12-28 16:53:34', 'closed'),
(71, 8, '2020-12-28 16:54:22', '2020-12-28 17:29:10', 'closed'),
(72, 8, '2020-12-28 17:29:47', '2020-12-28 17:32:44', 'closed'),
(73, 8, '2020-12-31 09:13:34', '2020-12-31 09:23:57', 'closed'),
(74, 8, '2020-12-31 11:07:13', '2020-12-31 13:04:37', 'closed'),
(75, 8, '2020-12-31 13:04:43', '2021-01-01 10:11:15', 'closed'),
(76, 8, '2021-01-01 10:12:44', '2021-01-01 19:12:02', 'closed'),
(77, 8, '2021-01-01 19:14:13', '2021-01-01 19:21:18', 'closed'),
(78, 8, '2021-01-01 23:07:48', '2021-01-01 23:11:56', 'closed'),
(79, 8, '2021-01-01 23:13:57', '2021-01-01 23:14:03', 'closed'),
(80, 8, '2021-01-01 23:16:23', '2021-01-01 23:26:51', 'closed'),
(81, 8, '2021-01-03 11:26:24', '2021-01-03 11:33:43', 'closed'),
(82, 8, '2021-01-04 13:33:34', '2021-01-04 13:35:22', 'closed'),
(83, 8, '2021-01-04 14:31:50', '2021-01-04 14:36:04', 'closed'),
(84, 8, '2021-01-04 17:12:52', '2021-01-04 17:17:37', 'closed'),
(85, 8, '2021-01-04 17:52:53', '2021-01-05 14:16:30', 'closed'),
(86, 8, '2021-01-08 12:02:20', '2021-01-08 12:06:09', 'closed'),
(87, 8, '2021-01-08 17:55:53', '2021-01-08 17:58:27', 'closed'),
(88, 8, '2021-01-10 11:48:45', '2021-01-10 11:49:32', 'closed'),
(89, 8, '2021-01-10 11:50:02', '2021-01-10 11:55:47', 'closed'),
(90, 8, '2021-01-11 14:51:06', '2021-01-11 14:53:02', 'closed'),
(91, 8, '2021-01-11 20:40:21', '2021-01-11 21:06:08', 'closed'),
(92, 8, '2021-01-11 21:38:08', '2021-01-11 21:39:03', 'closed'),
(93, 8, '2021-01-12 10:27:38', '2021-01-14 08:33:20', 'closed'),
(94, 8, '2021-01-14 20:19:35', '2021-01-18 21:10:11', 'closed'),
(95, 8, '2021-01-19 20:38:15', '2021-01-21 20:51:35', 'closed'),
(96, 8, '2021-01-22 20:48:55', '2021-01-30 11:21:00', 'closed'),
(97, 8, '2021-02-01 08:06:07', '2021-02-03 08:53:16', 'closed'),
(98, 8, '2021-02-03 17:47:35', '2021-02-03 17:57:58', 'closed'),
(99, 8, '2021-02-06 09:57:40', '2021-02-06 10:00:39', 'closed'),
(100, 8, '2021-02-06 10:04:25', '2021-02-06 10:05:44', 'closed'),
(101, 8, '2021-02-09 08:54:43', '2021-02-10 14:51:26', 'closed'),
(102, 8, '2021-02-10 21:12:07', '2021-02-11 22:29:04', 'closed'),
(103, 8, '2021-02-11 22:31:00', '2021-02-14 11:04:40', 'closed'),
(104, 8, '2021-02-14 11:42:25', '2021-02-17 16:19:58', 'closed'),
(105, 8, '2021-02-17 16:20:24', '2021-02-17 16:22:09', 'closed'),
(106, 8, '2021-02-19 11:12:28', '2021-02-19 11:46:08', 'closed'),
(107, 8, '2021-02-19 16:56:27', '2021-02-25 22:06:40', 'closed'),
(108, 8, '2021-02-26 08:58:28', '2021-02-26 09:04:48', 'closed'),
(109, 8, '2021-02-26 14:22:09', '2021-02-27 14:30:51', 'closed'),
(110, 8, '2021-02-28 12:24:34', '2021-02-28 12:25:08', 'closed'),
(111, 8, '2021-03-01 10:36:21', '2021-03-01 10:40:10', 'closed'),
(112, 8, '2021-03-07 20:43:12', '2021-03-19 14:58:06', 'closed'),
(113, 8, '2021-03-26 09:15:42', '2021-03-27 09:56:51', 'closed'),
(114, 8, '2021-03-27 12:23:55', '2021-04-05 14:30:56', 'closed'),
(115, 8, '2021-04-05 14:31:02', '2021-04-05 14:58:35', 'closed'),
(116, 8, '2021-04-08 11:29:22', '2021-04-09 08:53:57', 'closed'),
(117, 8, '2021-04-09 08:56:55', '2021-04-09 09:14:22', 'closed'),
(118, 8, '2021-04-09 16:06:43', '2021-04-16 09:22:01', 'closed'),
(119, 8, '2021-04-21 10:10:11', '2021-04-30 12:26:24', 'closed'),
(120, 8, '2021-04-30 12:26:48', '2021-09-14 14:00:23', 'closed'),
(121, 8, '2021-09-14 19:12:41', '2021-09-18 16:25:13', 'closed'),
(122, 8, '2021-09-18 16:25:37', '2021-09-19 09:39:50', 'closed'),
(123, 8, '2021-09-19 09:40:34', '2021-09-19 09:41:41', 'closed'),
(124, 8, '2021-09-19 09:42:37', '2021-09-19 11:42:29', 'closed'),
(125, 8, '2021-09-19 12:41:14', '2021-09-19 15:14:18', 'closed'),
(126, 8, '2021-09-23 18:11:48', '2021-09-23 18:16:30', 'closed'),
(127, 8, '2021-10-13 16:34:38', '2021-10-13 16:57:52', 'closed'),
(128, 8, '2021-10-13 16:59:45', '2021-10-13 17:26:56', 'closed'),
(129, 8, '2021-10-13 17:38:16', '2021-10-16 19:12:35', 'closed'),
(130, 8, '2021-10-16 19:13:15', '2021-10-16 19:19:16', 'closed'),
(131, 8, '2021-10-18 10:24:02', '2021-10-18 10:49:59', 'closed'),
(132, 8, '2021-10-18 10:53:30', '2021-10-18 10:59:41', 'closed'),
(133, 8, '2021-10-18 11:04:27', '2021-10-26 10:17:17', 'closed'),
(134, 8, '2021-10-26 10:18:23', '2021-10-30 11:08:01', 'closed'),
(135, 8, '2021-11-15 09:03:07', '2021-11-15 12:30:01', 'closed');

-- --------------------------------------------------------

--
-- Table structure for table `open_close_tb`
--

CREATE TABLE `open_close_tb` (
  `id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `open_bal` int(12) NOT NULL,
  `close_bal` int(12) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_close_tb`
--

INSERT INTO `open_close_tb` (`id`, `prod_id`, `open_bal`, `close_bal`, `date`) VALUES
(1, 76, 18350, 0, '2019-08-17'),
(2, 110, 399, 0, '2019-08-22'),
(3, 99, 4450, 4446, '2019-08-22'),
(4, 99, 4445, 4443, '2019-08-25'),
(5, 106, 198, 0, '2019-08-25'),
(6, 99, 4442, 0, '2019-08-26'),
(7, 99, 4440, 0, '2019-08-27'),
(8, 106, 197, 0, '2019-08-27'),
(9, 76, 18347, 0, '2019-08-27'),
(10, 99, 4439, 4435, '2019-09-03'),
(11, 62, 33282, 0, '2019-09-03'),
(12, 599, 653, 0, '2019-09-03'),
(13, 100, 109, 0, '2019-09-03'),
(14, 99, 4433, 4430, '2019-09-06'),
(15, 106, 196, 0, '2019-09-06'),
(16, 110, 398, 0, '2019-09-06'),
(17, 76, 18346, 0, '2019-09-06'),
(18, 75, 26988, 0, '2019-09-06'),
(19, 99, 4428, 0, '2019-09-07'),
(20, 99, 4425, 4417, '2019-09-30'),
(21, 103, 355, 352, '2019-09-30'),
(22, 106, 195, 0, '2019-09-30'),
(23, 76, 18345, 18344, '2019-09-30'),
(24, 99, 4415, 0, '2019-10-08'),
(25, 110, 397, 0, '2019-10-09'),
(26, 106, 194, 192, '2019-10-09'),
(27, 76, 18343, 18342, '2019-10-09'),
(28, 99, 4413, 4409, '2019-10-09'),
(29, 103, 351, 350, '2019-10-09'),
(30, 99, 4407, 4378, '2019-10-11'),
(31, 106, 191, 180, '2019-10-11'),
(32, 76, 18341, 18336, '2019-10-11'),
(33, 519, 5, 0, '2019-10-11'),
(34, 570, 250, 0, '2019-10-11'),
(35, 615, 34, 0, '2019-10-11'),
(36, 618, 342, 334, '2019-10-11'),
(37, 100, 108, 0, '2019-10-11'),
(38, 626, 77, 74, '2019-10-11'),
(39, 146, 801, 0, '2019-10-11'),
(40, 611, 1, 0, '2019-10-11'),
(41, 544, 30, 0, '2019-10-11'),
(42, 410, 250, 0, '2019-10-11'),
(43, 99, 4377, 0, '2019-10-12'),
(44, 106, 179, 0, '2019-10-12'),
(45, 76, 18335, 0, '2019-10-12'),
(46, 637, 10, 0, '2019-10-13'),
(47, 106, 178, 0, '2019-10-13'),
(48, 615, 33, 0, '2019-10-13'),
(49, 637, 9, 0, '2019-10-14'),
(50, 100, 107, 0, '2019-10-14'),
(51, 544, 29, 0, '2019-10-14'),
(52, 618, 333, 0, '2019-10-14'),
(53, 637, 10, 0, '2019-10-18'),
(54, 100, 105, 0, '2019-10-18'),
(55, 618, 331, 0, '2019-10-18'),
(56, 637, 9, 7, '2019-10-21'),
(57, 103, 349, 348, '2019-10-21'),
(58, 618, 330, 329, '2019-10-21'),
(59, 100, 104, 103, '2019-10-21'),
(60, 99, 4366, 0, '2019-10-21'),
(61, 110, 395, 0, '2019-10-21'),
(62, 99, 4365, 0, '2019-12-30'),
(63, 103, 347, 0, '2019-12-30'),
(64, 69, 4650, 0, '2019-12-30'),
(65, 142, 4204, 0, '2019-12-30'),
(66, 637, 6, 2, '2020-01-14'),
(67, 106, 176, 174, '2020-01-14'),
(68, 74, 50, 0, '2020-01-14'),
(69, 192, 200, 0, '2020-01-14'),
(70, 100, 102, 0, '2020-01-14'),
(71, 99, 4364, 4363, '2020-01-27'),
(72, 103, 335, 334, '2020-01-27'),
(73, 76, 18334, 0, '2020-01-27'),
(74, 106, 173, 0, '2020-01-27'),
(75, 2, 140, 131, '2020-01-28'),
(76, 1, 1222, 1219, '2020-01-28'),
(77, 2, 130, 0, '2020-01-29'),
(78, 1, 1218, 0, '2020-01-29'),
(79, 2, 128, 123, '2020-01-30'),
(80, 1, 1217, 1216, '2020-01-30'),
(81, 2, 121, 0, '2020-10-21'),
(82, 2, 120, 116, '2020-10-26'),
(83, 1, 1214, 0, '2020-10-26'),
(84, 1, 1213, 1211, '2020-11-29'),
(85, 2, 115, 108, '2020-11-29'),
(86, 0, 0, 0, '2020-11-29'),
(87, 0, 0, 0, '2020-11-30'),
(88, 2, 98, 90, '2020-11-30'),
(89, 1, 1210, 1208, '2020-11-30'),
(90, 0, 0, 0, '2020-12-14'),
(91, 0, 0, 0, '2020-12-15'),
(92, 0, 0, 0, '2020-12-16'),
(93, 0, 0, 0, '2020-12-17'),
(94, 0, 0, 0, '2020-12-22'),
(95, 8, 1, 0, '2020-12-23'),
(96, 0, 0, 0, '2020-12-23'),
(97, 0, 0, 0, '2020-12-27'),
(98, 0, 0, 0, '2020-12-28'),
(99, 0, 0, 0, '2020-12-31'),
(100, 0, 0, 0, '2021-01-01'),
(101, 0, 0, 0, '2021-01-03'),
(102, 0, 0, 0, '2021-01-04'),
(103, 0, 0, 0, '2021-01-05'),
(104, 0, 0, 0, '2021-01-08'),
(105, 0, 0, 0, '2021-01-11'),
(106, 0, 0, 0, '2021-01-14'),
(107, 0, 0, 0, '2021-01-18'),
(108, 0, 0, 0, '2021-01-19'),
(109, 4, 8, 0, '2021-01-19'),
(110, 0, 0, 0, '2021-01-21'),
(111, 0, 0, 0, '2021-02-01'),
(112, 0, 0, 0, '2021-02-03'),
(113, 0, 0, 0, '2021-02-06'),
(114, 9, 10000000, 0, '2021-02-06'),
(115, 0, 0, 0, '2021-02-10'),
(116, 0, 0, 0, '2021-02-11'),
(117, 0, 0, 0, '2021-02-14'),
(118, 0, 0, 0, '2021-02-17'),
(119, 0, 0, 0, '2021-02-19'),
(120, 0, 0, 0, '2021-02-25'),
(121, 0, 0, 0, '2021-02-26'),
(122, 0, 0, 0, '2021-02-27'),
(123, 3, 2, -5, '2021-03-07'),
(124, 3, -6, 0, '2021-03-27'),
(125, 6, 1, 0, '2021-04-05'),
(126, 5, 1, 0, '2021-04-08'),
(127, 4, 6, 0, '2021-04-08'),
(128, 0, 0, 0, '2021-04-08'),
(129, 10, 10, 0, '2021-09-07'),
(130, 4, 5, 0, '2021-09-07'),
(131, 7, 2, 0, '2021-09-07'),
(132, 10, 9, 6, '2021-09-14'),
(133, 4, 4, 0, '2021-09-14'),
(134, 7, 1, 0, '2021-09-14'),
(135, 10, 8, 7, '2021-09-15'),
(136, 9, 9999999, 0, '2021-09-15'),
(137, 4, 3, 0, '2021-09-15'),
(138, 0, 0, 0, '2021-09-16'),
(139, 10, 6, 4, '2021-09-18'),
(140, 9, 9999998, 0, '2021-09-18'),
(141, 14, 100, 94, '2021-09-19'),
(142, 13, 1, 0, '2021-09-19'),
(143, 10, 2, 0, '2021-09-19'),
(144, 4, 2, 0, '2021-09-19'),
(145, 14, 94, 0, '2021-09-23'),
(146, 10, 1, 0, '2021-09-23'),
(147, 4, 1, 0, '2021-09-23'),
(148, 14, 93, 87, '2021-10-13'),
(149, 9, 9999997, 9999995, '2021-10-13'),
(150, 14, 89, 0, '2021-10-16'),
(151, 9, 9999994, 9999993, '2021-10-18'),
(152, 0, 0, 0, '2021-10-18'),
(153, 14, 87, 86, '2021-10-23'),
(154, 14, 85, 0, '2021-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `part_payments_tb`
--

CREATE TABLE `part_payments_tb` (
  `payment_id` int(12) NOT NULL,
  `amount` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_no` int(11) NOT NULL,
  `user_id` int(12) NOT NULL,
  `payment_mode_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_payments_tb`
--

INSERT INTO `part_payments_tb` (`payment_id`, `amount`, `date_added`, `order_no`, `user_id`, `payment_mode_id`) VALUES
(1, '50', '2021-02-01 14:25:50', 1685, 8, 1),
(2, '100', '2021-02-01 14:25:50', 3081, 8, 1),
(3, '60', '2021-02-01 14:25:50', 469, 8, 1),
(4, '100', '2021-02-01 14:25:50', 2226, 8, 1),
(5, '10', '2021-02-01 14:25:50', 635, 8, 1),
(6, '50', '2021-02-01 14:25:50', 4123, 8, 1),
(7, '100', '2021-02-01 14:25:50', 1547, 8, 1),
(8, '100', '2021-02-01 14:25:50', 2073, 8, 1),
(9, '5500', '2021-02-01 14:25:50', 484, 8, 1),
(10, '20000', '2021-02-01 14:25:50', 3312, 8, 1),
(11, '7400', '2021-02-17 14:18:07', 4016, 8, 5),
(12, '1000', '2021-10-30 11:00:33', 2311, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_for` date NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `or_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `cust_id`, `sales_id`, `payment`, `payment_date`, `user_id`, `branch_id`, `payment_for`, `due`, `interest`, `remaining`, `status`, `rebate`, `or_no`) VALUES
(1, 0, 1, '0.00', '2019-08-17 13:16:20', 8, 1, '2019-08-17', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(2, 0, 2, '0.00', '2019-08-22 13:02:15', 8, 1, '2019-08-22', '0.00', '0.00', '0.00', 'paid', '0.00', 1902),
(3, 0, 3, '55.00', '2019-08-22 13:45:16', 8, 1, '2019-08-22', '55.00', '0.00', '0.00', 'paid', '0.00', 1903),
(4, 0, 4, '55.00', '2019-08-22 13:52:18', 8, 1, '2019-08-22', '55.00', '0.00', '0.00', 'paid', '0.00', 1904),
(5, 0, 5, '55.00', '2019-08-22 13:54:18', 8, 1, '2019-08-22', '55.00', '0.00', '0.00', 'paid', '0.00', 1905),
(6, 0, 6, '55.00', '2019-08-22 13:54:55', 8, 1, '2019-08-22', '55.00', '0.00', '0.00', 'paid', '0.00', 1906),
(7, 0, 7, '55.00', '2019-08-22 14:06:29', 8, 1, '2019-08-22', '55.00', '0.00', '0.00', 'paid', '0.00', 1907),
(8, 0, 8, '165.00', '2019-08-25 14:15:53', 8, 1, '2019-08-25', '165.00', '0.00', '0.00', 'paid', '0.00', 1908),
(9, 0, 9, '55.00', '2019-08-25 15:24:20', 8, 1, '2019-08-25', '55.00', '0.00', '0.00', 'paid', '0.00', 1909),
(10, 0, 10, '110.00', '2019-08-26 13:43:34', 8, 1, '2019-08-26', '110.00', '0.00', '0.00', 'paid', '0.00', 1910),
(11, 0, 11, '115.00', '2019-08-27 11:40:45', 8, 1, '2019-08-27', '115.00', '0.00', '0.00', 'paid', '0.00', 1911),
(12, 0, 12, '60.00', '2019-09-03 11:47:39', 8, 1, '2019-09-03', '60.00', '0.00', '0.00', 'paid', '0.00', 1912),
(13, 0, 13, '0.00', '2019-09-03 11:51:04', 8, 1, '2019-09-03', '0.00', '0.00', '0.00', 'paid', '0.00', 1913),
(14, 0, 14, '165.00', '2019-09-03 11:51:32', 8, 1, '2019-09-03', '165.00', '0.00', '0.00', 'paid', '0.00', 1914),
(15, 0, 15, '54.00', '2019-09-03 11:53:13', 8, 1, '2019-09-03', '54.00', '0.00', '0.00', 'paid', '0.00', 1915),
(16, 0, 16, '110.00', '2019-09-03 11:53:40', 8, 1, '2019-09-03', '110.00', '0.00', '0.00', 'paid', '0.00', 1916),
(17, 0, 17, '110.00', '2019-09-06 08:12:59', 8, 1, '2019-09-06', '110.00', '0.00', '0.00', 'paid', '0.00', 1917),
(18, 0, 18, '55.00', '2019-09-06 08:57:12', 8, 1, '2019-09-06', '55.00', '0.00', '0.00', 'paid', '0.00', 1918),
(19, 0, 19, '165.00', '2019-09-06 09:01:55', 8, 1, '2019-09-06', '165.00', '0.00', '0.00', 'paid', '0.00', 1919),
(20, 0, 20, '65.00', '2019-09-06 22:26:32', 8, 1, '2019-09-06', '65.00', '0.00', '0.00', 'paid', '0.00', 1920),
(21, 0, 21, '165.00', '2019-09-07 09:50:24', 8, 1, '2019-09-07', '165.00', '0.00', '0.00', 'paid', '0.00', 1921),
(22, 0, 22, '0.00', '2019-09-10 17:53:05', 8, 1, '2019-09-10', '0.00', '0.00', '0.00', 'paid', '0.00', 1922),
(23, 0, 23, '165.00', '2019-09-30 17:47:04', 8, 1, '2019-09-30', '165.00', '0.00', '0.00', 'paid', '0.00', 1923),
(24, 0, 24, '165.00', '2019-09-30 18:09:09', 8, 1, '2019-09-30', '165.00', '0.00', '0.00', 'paid', '0.00', 1924),
(25, 0, 25, '165.00', '2019-09-30 18:27:10', 8, 1, '2019-09-30', '165.00', '0.00', '0.00', 'paid', '0.00', 1925),
(26, 0, 26, '170.00', '2019-09-30 19:04:48', 8, 1, '2019-09-30', '170.00', '0.00', '0.00', 'paid', '0.00', 1926),
(27, 0, 27, '170.00', '2019-09-30 19:25:55', 8, 1, '2019-09-30', '170.00', '0.00', '0.00', 'paid', '0.00', 1927),
(28, 0, 28, '108.00', '2019-10-08 11:01:17', 8, 1, '2019-10-08', '108.00', '0.00', '0.00', 'paid', '0.00', 1928),
(29, 0, 29, '114.00', '2019-10-09 08:57:47', 8, 1, '2019-10-09', '114.00', '0.00', '0.00', 'paid', '0.00', 1929),
(30, 0, 30, '163.00', '2019-10-09 08:59:12', 8, 1, '2019-10-09', '163.00', '0.00', '0.00', 'paid', '0.00', 1930),
(31, 0, 31, '114.00', '2019-10-09 15:02:21', 8, 1, '2019-10-09', '114.00', '0.00', '0.00', 'paid', '0.00', 1931),
(32, 0, 32, '109.00', '2019-10-09 15:05:08', 8, 1, '2019-10-09', '109.00', '0.00', '0.00', 'paid', '0.00', 1932),
(33, 0, 33, '275.00', '2019-10-09 15:07:27', 8, 1, '2019-10-09', '275.00', '0.00', '0.00', 'paid', '0.00', 1933),
(34, 0, 34, '165.00', '2019-10-11 12:36:53', 8, 1, '2019-10-11', '165.00', '0.00', '0.00', 'paid', '0.00', 1934),
(35, 0, 35, '165.00', '2019-10-11 13:00:31', 8, 1, '2019-10-11', '165.00', '0.00', '0.00', 'paid', '0.00', 1935),
(36, 0, 36, '225.00', '2019-10-11 14:02:58', 8, 1, '2019-10-11', '225.00', '0.00', '0.00', 'paid', '0.00', 1936),
(37, 0, 37, '110.00', '2019-10-11 14:17:01', 8, 1, '2019-10-11', '110.00', '0.00', '0.00', 'paid', '0.00', 1937),
(38, 0, 38, '115.00', '2019-10-11 14:23:41', 8, 1, '2019-10-11', '115.00', '0.00', '0.00', 'paid', '0.00', 1938),
(39, 0, 39, '555.00', '2019-10-11 14:32:41', 8, 1, '2019-10-11', '555.00', '0.00', '0.00', 'paid', '0.00', 1939),
(40, 0, 40, '275.00', '2019-10-11 14:37:22', 8, 1, '2019-10-11', '275.00', '0.00', '0.00', 'paid', '0.00', 1940),
(41, 0, 41, '195.00', '2019-10-11 14:42:17', 8, 1, '2019-10-11', '195.00', '0.00', '0.00', 'paid', '0.00', 1941),
(42, 0, 42, '225.00', '2019-10-11 14:45:56', 8, 1, '2019-10-11', '225.00', '0.00', '0.00', 'paid', '0.00', 1942),
(43, 0, 43, '110.00', '2019-10-11 15:01:45', 8, 1, '2019-10-11', '110.00', '0.00', '0.00', 'paid', '0.00', 1943),
(44, 0, 44, '60.00', '2019-10-11 15:05:00', 8, 1, '2019-10-11', '60.00', '0.00', '0.00', 'paid', '0.00', 1944),
(45, 0, 45, '110.00', '2019-10-11 15:07:10', 8, 1, '2019-10-11', '110.00', '0.00', '0.00', 'paid', '0.00', 1945),
(46, 0, 46, '115.00', '2019-10-11 15:09:00', 8, 1, '2019-10-11', '115.00', '0.00', '0.00', 'paid', '0.00', 1946),
(47, 0, 47, '115.00', '2019-10-12 19:25:12', 8, 1, '2019-10-12', '115.00', '0.00', '0.00', 'paid', '0.00', 1947),
(48, 0, 48, '85.00', '2019-10-13 18:30:08', 8, 1, '2019-10-13', '85.00', '0.00', '0.00', 'paid', '0.00', 1948),
(49, 0, 49, '115.00', '2019-10-14 19:57:38', 8, 1, '2019-10-14', '115.00', '0.00', '0.00', 'paid', '0.00', 1949),
(50, 0, 50, '85.00', '2019-10-18 19:29:52', 8, 1, '2019-10-18', '85.00', '0.00', '0.00', 'paid', '0.00', 1950),
(51, 0, 51, '115.00', '2019-10-21 09:31:54', 8, 1, '2019-10-21', '115.00', '0.00', '0.00', 'paid', '0.00', 1951),
(52, 0, 52, '55.00', '2019-10-21 09:55:34', 8, 1, '2019-10-21', '55.00', '0.00', '0.00', 'paid', '0.00', 1952),
(53, 0, 53, '165.00', '2019-10-21 10:14:38', 8, 1, '2019-10-21', '165.00', '0.00', '0.00', 'paid', '0.00', 1953),
(54, 0, 54, '85.00', '2019-10-21 10:27:58', 8, 1, '2019-10-21', '85.00', '0.00', '0.00', 'paid', '0.00', 1954),
(55, 0, 55, '750.00', '2019-12-30 14:54:56', 8, 1, '2019-12-30', '750.00', '0.00', '0.00', 'paid', '0.00', 1955),
(56, 0, 56, '30.00', '2020-01-14 10:24:48', 8, 1, '2020-01-14', '30.00', '0.00', '0.00', 'paid', '0.00', 1956),
(57, 0, 57, '90.00', '2020-01-14 10:30:41', 8, 1, '2020-01-14', '90.00', '0.00', '0.00', 'paid', '0.00', 1957),
(58, 0, 58, '170.00', '2020-01-14 10:34:05', 8, 1, '2020-01-14', '170.00', '0.00', '0.00', 'paid', '0.00', 1958),
(59, 0, 59, '115.00', '2020-01-14 10:38:26', 8, 1, '2020-01-14', '115.00', '0.00', '0.00', 'paid', '0.00', 1959),
(60, 0, 60, '115.00', '2020-01-27 12:02:08', 8, 1, '2020-01-27', '115.00', '0.00', '0.00', 'paid', '0.00', 1960),
(61, 0, 61, '165.00', '2020-01-27 12:09:23', 8, 1, '2020-01-27', '165.00', '0.00', '0.00', 'paid', '0.00', 1961),
(62, 0, 62, '0.00', '2020-01-28 18:44:54', 8, 1, '2020-01-28', '0.00', '0.00', '0.00', 'paid', '0.00', 1962),
(63, 0, 1, '0.00', '2020-01-28 20:18:50', 8, 1, '2020-01-28', '0.00', '0.00', '0.00', 'paid', '0.00', 1902),
(64, 0, 2, '20.00', '2020-01-28 20:19:28', 8, 1, '2020-01-28', '20.00', '0.00', '0.00', 'paid', '0.00', 1903),
(65, 0, 3, '0.00', '2020-01-28 20:37:29', 8, 1, '2020-01-28', '0.00', '0.00', '0.00', 'paid', '0.00', 1904),
(66, 0, 4, '30.00', '2020-01-28 20:39:53', 8, 1, '2020-01-28', '30.00', '0.00', '0.00', 'paid', '0.00', 1901),
(67, 0, 5, '0.00', '2020-01-28 21:04:03', 8, 1, '2020-01-28', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(68, 0, 6, '0.00', '2020-01-28 23:02:52', 8, 1, '2020-01-28', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(69, 0, 7, '0.00', '2020-01-29 09:52:19', 8, 1, '2020-01-29', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(70, 0, 8, '0.00', '2020-01-30 11:29:25', 8, 1, '2020-01-30', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(71, 0, 9, '0.00', '2020-01-30 17:52:52', 8, 1, '2020-01-30', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(72, 0, 10, '0.00', '2020-01-30 18:22:22', 8, 1, '2020-01-30', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(73, 0, 11, '80.00', '2020-10-21 10:15:06', 8, 1, '2020-10-21', '80.00', '0.00', '0.00', 'paid', '0.00', 1901),
(74, 0, 12, '0.00', '2020-10-26 11:32:21', 8, 1, '2020-10-26', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(75, 0, 13, '0.00', '2020-10-26 15:20:08', 8, 1, '2020-10-26', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(76, 0, 14, '0.00', '2020-10-26 15:21:40', 8, 1, '2020-10-26', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(77, 0, 15, '670.00', '2020-10-26 15:29:21', 8, 1, '2020-10-26', '670.00', '0.00', '0.00', 'paid', '0.00', 1901),
(78, 1, 16, '110.00', '2020-11-29 16:47:52', 8, 1, '2020-11-29', '110.00', '0.00', '0.00', 'paid', '0.00', 1901),
(79, 1, 18, '700.00', '2020-11-29 16:48:59', 8, 1, '2020-11-29', '700.00', '0.00', '0.00', 'paid', '0.00', 1901),
(80, 1, 20, '80.00', '2020-11-29 16:51:50', 8, 1, '2020-11-29', '80.00', '0.00', '0.00', 'paid', '0.00', 1901),
(81, 1, 21, '940.00', '2020-11-29 16:52:21', 8, 1, '2020-11-29', '940.00', '0.00', '0.00', 'paid', '0.00', 1901),
(82, 1, 22, '780.00', '2020-11-29 17:02:02', 8, 1, '2020-11-29', '780.00', '0.00', '0.00', 'paid', '0.00', 1901),
(83, 1, 23, '1060.00', '2020-11-29 17:48:00', 8, 1, '2020-11-29', '1060.00', '0.00', '0.00', 'paid', '0.00', 1901),
(84, 1, 24, '500.00', '2020-11-29 20:24:09', 8, 1, '2020-11-29', '500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(85, 0, 25, '800.00', '2020-11-29 21:19:27', 8, 1, '2020-11-29', '800.00', '0.00', '0.00', 'paid', '0.00', 1926),
(86, 0, 26, '480.00', '2020-11-30 16:00:51', 8, 1, '2020-11-30', '480.00', '0.00', '0.00', 'paid', '0.00', 1927),
(87, 0, 27, '480.00', '2020-11-30 16:01:15', 8, 1, '2020-11-30', '480.00', '0.00', '0.00', 'paid', '0.00', 1928),
(88, 0, 28, '480.00', '2020-11-30 16:03:19', 8, 1, '2020-11-30', '480.00', '0.00', '0.00', 'paid', '0.00', 1929),
(89, 0, 29, '1980.00', '2020-11-30 16:05:37', 8, 1, '2020-11-30', '1980.00', '0.00', '0.00', 'paid', '0.00', 1930),
(90, 0, 30, '940.00', '2020-11-30 16:49:35', 8, 1, '2020-11-30', '940.00', '0.00', '0.00', 'paid', '0.00', 1931),
(91, 0, 31, '940.00', '2020-11-30 16:50:35', 8, 1, '2020-11-30', '940.00', '0.00', '0.00', 'paid', '0.00', 1932),
(92, 0, 32, '2000.00', '2020-11-30 16:58:15', 8, 1, '2020-11-30', '2000.00', '0.00', '0.00', 'paid', '0.00', 1933),
(93, 0, 33, '3410.00', '2020-11-30 22:09:25', 8, 1, '2020-11-30', '3410.00', '0.00', '0.00', 'paid', '0.00', 1934),
(94, 0, 1, '8500.00', '2020-12-14 23:16:30', 8, 1, '2020-12-14', '8500.00', '0.00', '0.00', 'paid', '0.00', 1903),
(95, 1, 2, '4600.00', '2020-12-14 23:21:20', 8, 1, '2020-12-14', '4600.00', '0.00', '0.00', 'paid', '0.00', 1904),
(96, 1, 3, '3200.00', '2020-12-15 15:22:53', 8, 1, '2020-12-15', '3200.00', '0.00', '0.00', 'paid', '0.00', 1904),
(97, 1, 4, '9000.00', '2020-12-15 17:43:26', 8, 1, '2020-12-15', '9000.00', '0.00', '0.00', 'paid', '0.00', 1904),
(98, 1, 5, '1500.00', '2020-12-16 10:48:47', 8, 1, '2020-12-16', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(99, 1, 6, '2000.00', '2020-12-17 08:26:53', 8, 1, '2020-12-17', '2000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(100, 1, 7, '2500.00', '2020-12-17 10:03:56', 8, 1, '2020-12-17', '2500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(101, 1, 8, '2050.00', '2020-12-17 17:51:31', 8, 1, '2020-12-17', '2050.00', '0.00', '0.00', 'paid', '0.00', 1901),
(102, 1, 9, '14000.00', '2020-12-22 17:56:06', 8, 1, '2020-12-22', '14000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(103, 0, 10, '2600.00', '2020-12-22 21:25:57', 8, 1, '2020-12-22', '2600.00', '0.00', '0.00', 'paid', '0.00', 1902),
(104, 0, 11, '2500.00', '2020-12-23 16:23:46', 8, 1, '2020-12-23', '2500.00', '0.00', '0.00', 'paid', '0.00', 1903),
(105, 1, 12, '5600.00', '2020-12-23 16:41:50', 8, 1, '2020-12-23', '5600.00', '0.00', '0.00', 'paid', '0.00', 1901),
(106, 1, 13, '14500.00', '2020-12-27 17:30:54', 8, 1, '2020-12-27', '14500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(107, 1, 14, '8000.00', '2020-12-28 16:54:42', 8, 1, '2020-12-28', '8000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(108, 1, 15, '1500.00', '2020-12-28 17:28:49', 8, 1, '2020-12-28', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(109, 1, 16, '1500.00', '2020-12-28 17:30:29', 8, 1, '2020-12-28', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(110, 1, 17, '1500.00', '2020-12-31 09:21:33', 8, 1, '2020-12-31', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(111, 1, 18, '500.00', '2020-12-31 09:23:39', 8, 1, '2020-12-31', '500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(112, 1, 19, '1500.00', '2020-12-31 11:08:58', 8, 1, '2020-12-31', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(113, 1, 20, '1000.00', '2020-12-31 13:12:43', 8, 1, '2020-12-31', '1000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(114, 1, 21, '2000.00', '2021-01-01 10:10:31', 8, 1, '2021-01-01', '2000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(115, 1, 22, '2500.00', '2021-01-01 10:21:25', 8, 1, '2021-01-01', '2500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(116, 1, 23, '2000.00', '2021-01-01 12:28:39', 8, 1, '2021-01-01', '2000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(117, 1, 24, '1500.00', '2021-01-01 23:10:14', 8, 1, '2021-01-01', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(118, 1, 25, '1500.00', '2021-01-01 23:24:07', 8, 1, '2021-01-01', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(119, 1, 26, '750.00', '2021-01-01 23:26:36', 8, 1, '2021-01-01', '750.00', '0.00', '0.00', 'paid', '0.00', 1901),
(120, 1, 27, '1500.00', '2021-01-03 11:30:32', 8, 1, '2021-01-03', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(121, 1, 28, '900.00', '2021-01-03 11:33:12', 8, 1, '2021-01-03', '900.00', '0.00', '0.00', 'paid', '0.00', 1901),
(122, 1, 29, '1500.00', '2021-01-04 13:35:11', 8, 1, '2021-01-04', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(123, 1, 30, '1000.00', '2021-01-04 14:33:10', 8, 1, '2021-01-04', '1000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(124, 1, 31, '1500.00', '2021-01-04 17:14:28', 8, 1, '2021-01-04', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(125, 1, 32, '0.00', '2021-01-05 14:08:56', 8, 1, '2021-01-05', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(126, 1, 33, '2200.00', '2021-01-05 14:11:19', 8, 1, '2021-01-05', '2200.00', '0.00', '0.00', 'paid', '0.00', 1901),
(127, 1, 34, '2500.00', '2021-01-08 12:04:19', 8, 1, '2021-01-08', '2500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(128, 0, 35, '6150.00', '2021-01-11 14:51:46', 8, 1, '2021-01-11', '6150.00', '0.00', '0.00', 'paid', '0.00', 1901),
(129, 1, 36, '2000.00', '2021-01-11 21:00:56', 8, 1, '2021-01-11', '2000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(130, 1, 37, '1250.00', '2021-01-11 21:05:52', 8, 1, '2021-01-11', '1250.00', '0.00', '0.00', 'paid', '0.00', 1901),
(131, 1, 38, '4500.00', '2021-01-14 20:21:54', 8, 1, '2021-01-14', '4500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(132, 1, 39, '3000.00', '2021-01-18 21:08:52', 8, 1, '2021-01-18', '3000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(133, 1, 40, '23000.00', '2021-01-19 20:50:45', 8, 1, '2021-01-19', '23000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(134, 1, 41, '1500.00', '2021-01-21 20:50:58', 8, 1, '2021-01-21', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(135, 1, 42, '1000.00', '2021-02-01 08:17:39', 8, 1, '2021-02-01', '1000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(136, 1, 43, '10000.00', '2021-02-01 08:21:45', 8, 1, '2021-02-01', '10000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(137, 1, 44, '3500.00', '2021-02-03 08:52:58', 8, 1, '2021-02-03', '3500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(138, 1, 45, '3500.00', '2021-02-03 17:48:26', 8, 1, '2021-02-03', '3500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(139, 1, 46, '5000.00', '2021-02-06 10:00:23', 8, 1, '2021-02-06', '5000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(140, 1, 47, '5200.00', '2021-02-06 10:05:25', 8, 1, '2021-02-06', '5200.00', '0.00', '0.00', 'paid', '0.00', 1901),
(141, 1, 48, '0.00', '2021-02-10 14:45:53', 8, 1, '2021-02-10', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(142, 1, 49, '1500.00', '2021-02-10 14:52:34', 8, 1, '2021-02-10', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(143, 1, 50, '750.00', '2021-02-11 10:22:09', 8, 1, '2021-02-11', '750.00', '0.00', '0.00', 'paid', '0.00', 1901),
(144, 1, 51, '4200.00', '2021-02-11 22:26:04', 8, 1, '2021-02-11', '4200.00', '0.00', '0.00', 'paid', '0.00', 1901),
(145, 1, 52, '20800.00', '2021-02-14 11:03:48', 8, 1, '2021-02-14', '20800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(146, 1, 53, '10700.00', '2021-02-14 11:04:24', 8, 1, '2021-02-14', '10700.00', '0.00', '0.00', 'paid', '0.00', 1901),
(147, 1, 54, '1500.00', '2021-02-17 16:20:55', 8, 1, '2021-02-17', '1500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(148, 1, 55, '2000.00', '2021-02-19 11:43:07', 8, 1, '2021-02-19', '2000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(149, 1, 56, '15600.00', '2021-02-19 16:59:56', 8, 1, '2021-02-19', '15600.00', '0.00', '0.00', 'paid', '0.00', 1901),
(150, 1, 57, '12000.00', '2021-02-25 22:05:17', 8, 1, '2021-02-25', '12000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(151, 1, 58, '15600.00', '2021-02-26 09:02:39', 8, 1, '2021-02-26', '15600.00', '0.00', '0.00', 'paid', '0.00', 1901),
(152, 1, 59, '2500.00', '2021-02-27 14:27:59', 8, 1, '2021-02-27', '2500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(153, 1, 60, '1800.00', '2021-03-07 22:41:36', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(154, 1, 61, '1800.00', '2021-03-07 22:44:32', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(155, 1, 62, '1800.00', '2021-03-07 23:07:09', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(156, 1, 63, '1800.00', '2021-03-07 23:07:45', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(157, 1, 64, '1800.00', '2021-03-07 23:51:22', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(158, 1, 65, '1800.00', '2021-03-07 23:51:55', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(159, 1, 66, '1800.00', '2021-03-07 23:53:44', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(160, 1, 67, '1800.00', '2021-03-07 23:55:05', 8, 1, '2021-03-07', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(161, 1, 68, '1800.00', '2021-03-27 15:02:50', 8, 1, '2021-03-27', '1800.00', '0.00', '0.00', 'paid', '0.00', 1901),
(162, 1, 69, '8500.00', '2021-04-05 10:17:19', 8, 1, '2021-04-05', '8500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(163, 1, 70, '10300.00', '2021-04-08 11:40:32', 8, 1, '2021-04-08', '10300.00', '0.00', '0.00', 'paid', '0.00', 1901),
(164, 1, 71, '100.00', '2021-04-08 11:46:23', 8, 1, '2021-04-08', '100.00', '0.00', '0.00', 'paid', '0.00', 1901),
(165, 1, 72, '9850.00', '2021-09-07 17:17:18', 8, 1, '2021-09-07', '9850.00', '0.00', '0.00', 'paid', '0.00', 1901),
(166, 1, 1, '9850.00', '2021-09-14 12:16:02', 8, 1, '2021-09-14', '9850.00', '0.00', '0.00', 'paid', '0.00', 1901),
(167, 1, 2, '50.00', '2021-09-14 12:55:12', 8, 1, '2021-09-14', '50.00', '0.00', '0.00', 'paid', '0.00', 1901),
(168, 1, 3, '50.00', '2021-09-14 19:35:38', 8, 1, '2021-09-14', '50.00', '0.00', '0.00', 'paid', '0.00', 1901),
(169, 1, 4, '5900.00', '2021-09-15 11:08:11', 8, 1, '2021-09-15', '5900.00', '0.00', '0.00', 'paid', '0.00', 1901),
(170, 1, 5, '1.00', '2021-09-16 14:48:00', 8, 1, '2021-09-16', '1.00', '0.00', '0.00', 'paid', '0.00', 1901),
(171, 1, 6, '3100.00', '2021-09-18 12:54:45', 8, 1, '2021-09-18', '3100.00', '0.00', '0.00', 'paid', '0.00', 1901),
(172, 1, 7, '90.00', '2021-09-18 13:08:00', 8, 1, '2021-09-18', '90.00', '0.00', '0.00', 'paid', '0.00', 1901),
(173, 1, 8, '24.00', '2021-09-19 10:42:41', 8, 1, '2021-09-19', '24.00', '0.00', '0.00', 'paid', '0.00', 1901),
(174, 1, 9, '24.00', '2021-09-19 10:49:57', 8, 1, '2021-09-19', '24.00', '0.00', '0.00', 'paid', '0.00', 1901),
(175, 1, 10, '23.00', '2021-09-19 10:56:33', 8, 1, '2021-09-19', '23.00', '0.00', '0.00', 'paid', '0.00', 1901),
(176, 1, 11, '23.00', '2021-09-19 10:58:31', 8, 1, '2021-09-19', '23.00', '0.00', '0.00', 'paid', '0.00', 1901),
(177, 1, 12, '23.00', '2021-09-19 11:01:01', 8, 1, '2021-09-19', '23.00', '0.00', '0.00', 'paid', '0.00', 1901),
(178, 1, 13, '62566.80', '2021-09-19 11:21:01', 8, 1, '2021-09-19', '62566.80', '0.00', '0.00', 'paid', '0.00', 1901),
(179, 1, 14, '26405.20', '2021-09-19 11:23:21', 8, 1, '2021-09-19', '26405.20', '0.00', '0.00', 'paid', '0.00', 1901),
(180, 1, 15, '23407.00', '2021-09-19 12:53:31', 8, 1, '2021-09-19', '23407.00', '0.00', '0.00', 'paid', '0.00', 1901),
(181, 1, 16, '26405.20', '2021-09-23 18:15:16', 8, 1, '2021-09-23', '26405.20', '0.00', '0.00', 'paid', '0.00', 1901),
(182, 1, 17, '55100.00', '2021-10-13 16:55:07', 8, 1, '2021-10-13', '55100.00', '0.00', '0.00', 'paid', '0.00', 1901),
(183, 1, 18, '55100.00', '2021-10-13 17:09:08', 8, 1, '2021-10-13', '55100.00', '0.00', '0.00', 'paid', '0.00', 1901),
(184, 1, 19, '47500.00', '2021-10-13 17:14:20', 8, 1, '2021-10-13', '47500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(185, 1, 20, '43500.00', '2021-10-13 17:20:50', 8, 1, '2021-10-13', '43500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(186, 1, 21, '44500.00', '2021-10-16 19:18:45', 8, 1, '2021-10-16', '44500.00', '0.00', '0.00', 'paid', '0.00', 1901),
(187, 1, 22, '2400.00', '2021-10-18 10:25:37', 8, 1, '2021-10-18', '2400.00', '0.00', '0.00', 'paid', '0.00', 1901),
(188, 1, 23, '3000.00', '2021-10-18 10:53:46', 8, 1, '2021-10-18', '3000.00', '0.00', '0.00', 'paid', '0.00', 1901),
(189, 1, 24, '2700.00', '2021-10-18 10:54:29', 8, 1, '2021-10-18', '2700.00', '0.00', '0.00', 'paid', '0.00', 1901),
(190, 1, 25, '300.00', '2021-10-18 11:07:48', 8, 1, '2021-10-18', '300.00', '0.00', '0.00', 'paid', '0.00', 1901),
(191, 1, 26, '21750.00', '2021-10-23 14:08:55', 8, 1, '2021-10-23', '21750.00', '0.00', '0.00', 'paid', '0.00', 1901),
(192, 0, 27, '22250.00', '2021-10-23 14:12:52', 8, 1, '2021-10-23', '22250.00', '0.00', '0.00', 'paid', '0.00', 1901),
(193, 0, 28, '0.00', '2021-10-29 14:02:08', 8, 1, '2021-10-29', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(194, 1, 29, '0.00', '2021-10-29 14:05:39', 8, 1, '2021-10-29', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(195, 1, 30, '0.00', '2021-10-29 17:13:54', 8, 1, '2021-10-29', '0.00', '0.00', '0.00', 'paid', '0.00', 1901),
(196, 1, 31, '22250.00', '2021-11-15 10:07:31', 8, 1, '2021-11-15', '22250.00', '0.00', '0.00', 'paid', '0.00', 1901);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_sell_price` text NOT NULL,
  `prod_pic` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `belongs_to` int(12) NOT NULL,
  `stock_branch_id` int(12) NOT NULL,
  `barcode` text NOT NULL,
  `manufactor_date` text NOT NULL,
  `expire_date` text NOT NULL,
  `wholesale_price` text,
  `discount_price` int(12) NOT NULL,
  `special_price` text,
  `pack_size` text NOT NULL,
  `vat_status` text NOT NULL,
  `currency_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_desc`, `prod_price`, `prod_sell_price`, `prod_pic`, `cat_id`, `prod_qty`, `branch_id`, `reorder`, `supplier_id`, `serial`, `date_added`, `belongs_to`, `stock_branch_id`, `barcode`, `manufactor_date`, `expire_date`, `wholesale_price`, `discount_price`, `special_price`, `pack_size`, `vat_status`, `currency_id`) VALUES
(3, 'Barcode scanners', '', '500.00', '1800', 'default.gif', 59, -7, 1, 0, 11, '0', '2021-09-14 09:30:12', 1, 1, '0.0', '', '', '0', 0, '0', '0', '', 2),
(4, 'Reciept Printer', '', '700.00', '2800', 'default.gif', 59, 0, 1, 0, 16, 'Non', '2021-09-23 16:15:16', 1, 1, '0.0', '', '', '0', 0, '0', '0', '', 2),
(5, 'POS Elo Machine', '', '2500.00', '7500', 'default.gif', 59, 0, 1, 0, 11, 'Non', '2021-09-14 09:30:12', 1, 1, '0.0', '', '', '0', 0, '0', '0', '', 2),
(6, 'CPU And IBM Touch NEW', '', '5500.00', '8500', 'default.gif', 59, 0, 1, 0, 11, 'Non', '2021-09-14 09:30:12', 1, 1, '0.0', '', '', '0', 0, '0', '0', '', 2),
(7, 'Second Hand IBM with CPUs', '', '3500.00', '7000', 'default.gif', 59, 0, 1, 0, 11, 'Non', '2021-09-14 10:16:02', 1, 1, '0.0', '', '', '0', 0, '0', '0', '', 2),
(8, '3 D Scanner', '', '800.00', '2500', 'default.gif', 59, -1, 1, 0, 11, 'Non', '2021-09-14 15:02:42', 1, 1, '0.0', '', '', '0', 0, '0', '0', '', 2),
(9, 'POS Software', '', '0.00', '3000', 'default.gif', 60, 9999992, 1, 0, 17, 'Non', '2021-10-18 08:53:46', 1, 1, '0.0', '', '', '0', 0, '0', 'NA', '', 2),
(10, 'Hole 96mm black nickel', '', '5.00', '50', 'default.gif', 59, 0, 1, 0, 11, '0', '2021-09-23 16:15:16', 1, 1, 'MT015', '', '', '0', 0, '0', 'NA', '', 2),
(11, 'Hole 96mm black nickel', '', '5.00', '50', 'default.gif', 59, 0, 0, 0, 11, 'Non', '2021-09-14 14:50:19', 59, 0, 'MT015', '', '', NULL, 0, NULL, '', '', 0),
(12, 'Hole 96mm black nickel', '', '5.00', '50', 'default.gif', 59, 0, 1, 0, 11, 'Non', '2021-09-14 14:52:21', 59, 0, 'MT015', '', '', NULL, 0, NULL, '', '', 0),
(13, 'Hole 96mm black nickel', '', '5.00', '59474.14', 'default.gif', 59, 0, 1, 0, 11, '0', '2021-09-19 09:21:01', 1, 1, 'MT015', '', '', '0', 0, '0', 'meters', '', 0),
(14, '3 D Scanner', '', '800.00', ' 22250', 'default.gif', 59, 84, 1, 0, 11, '0', '2021-11-15 08:07:31', 1, 1, '0.0', '', '', '1', 0, '1', 'WE', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prospects`
--

CREATE TABLE `prospects` (
  `id` int(11) NOT NULL,
  `name` varchar(222) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(222) NOT NULL,
  `type` varchar(222) NOT NULL,
  `comment` text NOT NULL,
  `comment2` text NOT NULL,
  `date` varchar(222) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prospects`
--

INSERT INTO `prospects` (`id`, `name`, `phone`, `email`, `type`, `comment`, `comment2`, `date`, `user_id`, `status`) VALUES
(1, 'p_name', '12121212', 'ded@il.co', 'Insuarance', '1212121212122', '', '2021-11-15', 8, 'closed'),
(2, 'Genesis2.0', '22112220993', 'ded@il.co', 'Technocrats', '0', 'the wise will refuse', '2021-11-15', 8, 'closed'),
(3, 'GenV', '213242', 'ded@il.co', 'Technocrats', 'qwedqweqw', 'Now we did digs', '2021-11-17', 8, 'pending'),
(4, 'Choolwe', '2121', 'nsa', 'POS', '', '', '2021-11-12', 12, 'closed'),
(5, 'choolwe ngandu', '0955104708', 'choolwe1992@gmail.com', 'Examinations Council of Zambia', '', '', '2021-11-15', 12, 'pending'),
(6, 'choolwe ngandu', '0975704991', 'choolwe1992@gmail.com', 'Examinations Council of Zambia', '', '', '2021-11-25', 12, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `prospect_comments`
--

CREATE TABLE `prospect_comments` (
  `id` int(11) NOT NULL,
  `pros_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prospect_comments`
--

INSERT INTO `prospect_comments` (`id`, `pros_id`, `comment`, `date`) VALUES
(1, 3, 'New meeting today', '2021-11-16'),
(2, 3, 'Another one', '2021-11-23'),
(4, 3, 'boo foo', '2021-12-11'),
(5, 4, 'met on friday', '2021-11-12'),
(6, 4, 'Met him on thursday also', '2021-11-18'),
(7, 5, 'SENT EMAIL', '2021-11-15'),
(8, 6, 'SENT EMAIL', '2021-11-25'),
(9, 6, 'Said hes not yet ready.', '2021-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `pr_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_tb`
--

CREATE TABLE `quotation_tb` (
  `prod_id` int(12) NOT NULL,
  `price` text NOT NULL,
  `qty` text NOT NULL,
  `branch_id` text NOT NULL,
  `user_id` text NOT NULL,
  `price_tag` text NOT NULL,
  `customer` text NOT NULL,
  `description` text NOT NULL,
  `quote_description` text NOT NULL,
  `validity` text NOT NULL,
  `status` text NOT NULL,
  `quote_identity` int(12) NOT NULL,
  `quote_id` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `discount` text NOT NULL,
  `currency` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_tb`
--

INSERT INTO `quotation_tb` (`prod_id`, `price`, `qty`, `branch_id`, `user_id`, `price_tag`, `customer`, `description`, `quote_description`, `validity`, `status`, `quote_identity`, `quote_id`, `date_added`, `discount`, `currency`) VALUES
(14, ' 22250', '1', '1', '8', '', 'none', '', '', '', 'printed', 10, 20, '2021-09-19 08:09:56', '5', 'ZMW'),
(13, '59474.14', '1', '1', '8', '', 'Musa', '', '', '', 'printed', 11, 21, '2021-09-19 08:13:24', '5', 'ZMW'),
(14, ' 22250', '1', '1', '8', '', 'Musa', '', '', '', 'printed', 12, 22, '2021-09-19 09:22:20', '5', 'ZMW'),
(10, '50', '1', '1', '8', '', 'Musa', '', '', '', 'printed', 13, 22, '2021-09-19 09:22:20', '5', 'ZMW'),
(4, '2800', '1', '1', '8', '', 'Musa', '', '', '', 'printed', 14, 22, '2021-09-19 09:22:20', '5', 'ZMW'),
(0, '100', '1', '1', '8', '', 'Musa', 'Burgers', '', '', 'printed', 15, 23, '2021-09-23 16:13:18', '', 'ZMW'),
(14, ' 22250', '1', '1', '8', '', 'none', '', '', '', 'printed', 16, 24, '2021-10-13 14:34:48', '', 'ZMW'),
(14, ' 22250', '1', '1', '8', '', 'none', '', '', '', 'printed', 17, 27, '2021-10-13 14:46:30', '', 'ZMW'),
(14, ' 22250', '2', '1', '8', '', 'none', '', '', '', 'printed', 18, 28, '2021-10-13 14:49:10', '', 'ZMW'),
(9, '3000', '1', '1', '8', '', 'none', '', '', '', 'printed', 19, 28, '2021-10-13 14:49:10', '', 'ZMW'),
(14, ' 22250', '2', '1', '8', '', 'Musa', '', '', '', 'printed', 21, 29, '2021-10-16 17:15:57', '', 'ZMW'),
(9, '3000', '1', '1', '8', '', 'Ndeke Hotel', '', '', '', 'printed', 22, 30, '2021-10-18 08:36:46', '10', 'ZMW'),
(0, '300', '1', '1', '8', '', 'Musa', 'ok', '', '', 'printed', 23, 32, '2021-10-18 09:06:38', '', 'ZMW'),
(0, '3000', '1', '1', '12', '', 'Musa', 'POS Software', '', '', 'printed', 24, 33, '2021-11-25 06:34:00', '', 'ZMW');

-- --------------------------------------------------------

--
-- Table structure for table `rawdata_tb`
--

CREATE TABLE `rawdata_tb` (
  `id` int(12) NOT NULL,
  `class` text NOT NULL,
  `description` text NOT NULL,
  `colour` text NOT NULL,
  `category_id` int(12) NOT NULL,
  `origin` text NOT NULL,
  `qty` int(12) NOT NULL,
  `type` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawdata_tb`
--

INSERT INTO `rawdata_tb` (`id`, `class`, `description`, `colour`, `category_id`, `origin`, `qty`, `type`, `date`) VALUES
(1, 'PP', 'PP', 'Black', 59, 'USA', 44, 'RAW', '2019-09-05 11:07:32'),
(2, 'PP SUB', 'PP SUB', '', 59, 'SA', 23, 'SUB', '2019-09-05 11:02:05'),
(3, 'PP', 'sup ', '1', 59, 'mm', 50, 'RAW', '2019-09-05 11:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `rawdata_updates_tb`
--

CREATE TABLE `rawdata_updates_tb` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `status` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_id` int(12) NOT NULL,
  `action_status` text NOT NULL,
  `value` int(12) NOT NULL,
  `job` text NOT NULL,
  `source` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawdata_updates_tb`
--

INSERT INTO `rawdata_updates_tb` (`id`, `user_id`, `status`, `date_added`, `item_id`, `action_status`, `value`, `job`, `source`) VALUES
(6, 10, 'IN', '2019-08-22 13:44:48', 5, 'updated', 1, 'DMC', 'KOREA'),
(7, 10, 'IN', '2019-09-05 11:02:05', 1, 'updated', 1, 'PVC', 'KOREA'),
(8, 10, 'IN', '2019-09-05 11:02:05', 2, 'updated', 1, 'DMC', 'KOREA'),
(9, 10, 'OUT', '2019-09-05 11:07:32', 1, 'updated', 12, 'DMC', 'KOREA'),
(10, 10, 'IN', '2020-10-26 13:00:59', 1, '', 10, 'N/A', 'KOREA');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_tendered` decimal(10,2) DEFAULT NULL,
  `discount` text NOT NULL,
  `amount_due` text NOT NULL,
  `cash_change` decimal(10,2) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `modeofpayment` varchar(15) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total` text NOT NULL,
  `order_no` int(12) NOT NULL,
  `customer_id` text NOT NULL,
  `invoice_no` text NOT NULL,
  `rate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `cust_id`, `user_id`, `cash_tendered`, `discount`, `amount_due`, `cash_change`, `date_added`, `modeofpayment`, `branch_id`, `total`, `order_no`, `customer_id`, `invoice_no`, `rate`) VALUES
(20, 1, 8, '46000.00', '500', '44000', '2500.00', '2021-10-13 17:20:50', '1', 1, '43500', 4711, '0', '1482', ''),
(21, 1, 8, '45000.00', '0', '44500', '500.00', '2021-10-16 19:18:45', '3', 1, '44500', 382, '2', '1483', ''),
(22, 1, 8, '2700.00', '300', '2700', '300.00', '2021-10-18 10:25:37', '1', 1, '2400', 3320, '1', '1484', ''),
(23, 1, 8, '3000.00', '0', '3000', '0.00', '2021-10-18 10:53:46', '1', 1, '3000', 3696, '1', '1485', ''),
(24, 1, 8, '2700.00', '0', '2700', '0.00', '2021-10-18 10:54:29', '1', 1, '2700', 1598, '2', '1486', ''),
(25, 1, 8, '300.00', '0', '300', '0.00', '2021-10-18 11:07:48', '1', 1, '300', 3643, '0', '1487', ''),
(26, 1, 8, '22000.00', '250', '22000', '250.00', '2021-10-23 14:08:55', '1', 1, '21750', 921, '0', '1488', ''),
(27, 0, 8, '22250.00', '0', '22250.00', '0.00', '2021-10-23 14:12:52', '1', 1, '22250', 2796, '', '', ''),
(28, 0, 8, '222.00', '0', '0', '222.00', '2021-10-29 14:02:08', '1', 1, '0', 4711, '<br /><b>Notice</b>:  Undefined variable: cust_id in <b>C:xampphtdocsAccountingusercomplete-draft-order.php</b> on line <b>213</b><br />', '', ''),
(29, 1, 8, '111.00', '0', '0', '111.00', '2021-10-29 14:05:39', '1', 1, '0', 1753, '0', '1492', ''),
(30, 1, 8, '111.00', '0', '0', '111.00', '2021-10-29 17:13:54', '1', 1, '0', 2970, '0', '1493', ''),
(31, 1, 8, '122222.00', '0', '22250', '99972.00', '2021-11-15 10:07:31', '1', 1, '22250', 2827, '0', '1494', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sales_details_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_no` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `discount` text NOT NULL,
  `discount_type` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`sales_details_id`, `sales_id`, `prod_id`, `price`, `qty`, `order_no`, `user_id`, `discount`, `discount_type`, `description`) VALUES
(33, 20, 14, '22250.00', 2, 4711, 8, '500', 'Amount', ''),
(34, 21, 14, '22250.00', 2, 382, 8, '', '', ''),
(35, 22, 9, '3000.00', 1, 3320, 8, '10', 'Percentage', ''),
(36, 23, 9, '3000.00', 1, 3696, 8, '', '', ''),
(37, 24, 0, '2700.00', 1, 1598, 8, '', '', 'Ok'),
(38, 25, 0, '300.00', 1, 3643, 8, '', '', ''),
(39, 26, 14, '22250.00', 1, 921, 8, '250', 'Amount', ''),
(40, 27, 14, '22250.00', 1, 2796, 8, '', '', ''),
(41, 31, 14, '22250.00', 1, 2827, 8, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_tb`
--

CREATE TABLE `sales_tb` (
  `id` int(12) NOT NULL,
  `item_sold_id` int(12) NOT NULL,
  `quantity` int(12) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(12) NOT NULL,
  `price` int(12) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_tb`
--

INSERT INTO `sales_tb` (`id`, `item_sold_id`, `quantity`, `sales_date`, `added_by`, `price`, `date`) VALUES
(1, 0, 0, '2021-11-15 14:19:28', 8, 0, ''),
(2, 0, 0, '2021-11-15 14:20:08', 8, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category_tb`
--

CREATE TABLE `shop_category_tb` (
  `id` int(12) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_category_tb`
--

INSERT INTO `shop_category_tb` (`id`, `name`) VALUES
(1, 'Bar'),
(2, 'Restruant');

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockin_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `date` datetime NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stockin_id`, `prod_id`, `qty`, `date`, `branch_id`) VALUES
(1, 5, 5, '2017-02-04 01:10:41', 1),
(2, 15, 100, '2017-02-04 01:10:49', 1),
(3, 13, 10, '2017-02-04 01:10:55', 1),
(4, 14, 5, '2017-02-04 01:11:07', 1),
(5, 5, 0, '2017-12-03 00:29:21', 1),
(6, 14, 0, '2017-12-03 00:29:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_audit_tb`
--

CREATE TABLE `stock_audit_tb` (
  `id` int(12) NOT NULL,
  `prod_id` text NOT NULL,
  `count` int(12) NOT NULL,
  `added_to` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_audit_tb`
--

INSERT INTO `stock_audit_tb` (`id`, `prod_id`, `count`, `added_to`, `date_added`, `action`) VALUES
(62, 'Boom Laundry', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(63, 'Boom 250 Grams', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(64, 'Boom 150 Grams', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(65, 'Boom 500 Grams', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(66, 'Maq Small Bucket', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(67, 'Maq Big Bucket', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(68, 'Boom Big Bucket', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(69, 'Maq 500 Grams', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(70, 'Maq 250 Grams', 9, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(71, 'MAQ 150 Grams', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(72, 'Bullet Paste Big', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(73, 'Bulle paste small', 18, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(74, 'MAQ 250 Grams', 10, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(75, 'Maq 150 Grams', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(76, 'Bullet  Powder 500 Grams', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(77, 'Extra Powder', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(78, 'Cobra Polish', 15, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(79, 'Cobra Polish', 16, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(80, 'Washa Paste', 18, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(81, 'Washa Small Paste', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(82, 'Boom Paste Big', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(83, 'Boom Small Paste', 33, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(84, 'Maq Big Paste', 15, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(85, 'Maq Big Paste', 16, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(86, 'Maq Small paste', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(87, 'Boom Sparkle', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(88, 'Boom Sparkle Small', 15, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(89, 'Ajax', 9, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(90, 'Sunlight ', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(91, 'Spirit ', 23, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(92, 'Cobra Polish', 23, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(93, 'SurnBerm', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(94, 'Yebo Soap', 12, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(95, 'Romeo Buety Soap', 15, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(96, 'Yebo Soap', 12, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(97, 'Romeo Old Beuty Pink', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(98, 'Mother and baby Cream', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(99, 'Protect Deep Clean Big', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(100, 'Protex Herbal', 13, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(101, 'Deep Clean Small', 9, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(102, 'Herbal Small', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(103, 'Jik Lemon', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(104, 'Jik Regular', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(105, 'Clorin ', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(106, 'harpic ', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(107, 'Imperial Leather', 24, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(108, 'Lux Soap', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(109, 'Light Bulb', 56, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(110, 'Long life Bulbs', 15, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(111, 'Long Life Round Bulb', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(112, 'Life Boy Small', 14, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(113, 'Bu Tone', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(114, 'Life Boy Big', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(115, 'Life Boy Fresh', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(116, 'Life Boy Herbal', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(117, 'Baby Powder Big', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(118, 'John Son Powder', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(119, 'Baby Powder  Meduim', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(120, 'Talcum Powder', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(121, 'Vest line Powder ', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(122, 'John son baby Cream', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(123, 'Tiger Head Batry', 60, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(124, 'Tuff Stuff Mosquito ', 30, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(125, 'Tuff Stuff Mosquito ', 32, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(126, 'Big Candles', 154, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(127, 'Tissue ', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(128, 'Tissue ', 10, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(129, 'Tissue Yunda', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(130, 'Ferri Tissue', 58, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(131, 'Sunrise Tissue', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(132, 'Jumbo Tissue', 21, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(133, 'Sunrise Tissue', 24, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(134, 'Sunrise Tissue', 13, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(135, 'Mr Min', 15, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(136, 'Raid', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(137, 'Detol Small', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(138, 'Romeo hand Wash', 1, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(139, 'Mortein Spray', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(140, 'Mortein Spray Floral', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(141, 'Mortein Spray Low odoor', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(142, 'Doom Spray', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(143, 'Doom Small ', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(144, 'Romeo Small', 12, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(145, 'Romeo herbal', 23, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(146, 'Romeo Classic Soap', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(147, 'Detol Soap', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(148, 'Detol Fresh', 1, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(149, 'Detol Original', 7, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(150, 'Detol Herbal ', 9, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(151, 'Detol Herbal Small', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(152, 'Detol Original Small', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(153, 'Madam small Jelly', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(154, 'Baby Care', 22, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(155, 'Baby Care meduim ', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(156, 'Kwik Shine', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(157, 'Kiwi Polish', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(158, 'Baby Soap', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(159, 'Johnson Baby Soap', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(160, 'Baby Soap', 2, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(161, 'Colgate', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(162, 'Colgate Small', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(163, 'White Dent Colgate', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(164, 'Colgate Herbal Big', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(165, 'Tooth Brush', 14, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(166, 'Tooth Brush', 14, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(167, 'Sugar', 20, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(168, 'Sugar White Sugar', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(169, 'Salt', 33, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(170, 'Salt Big', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(171, 'Best Salt Small', 21, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(172, 'Diapers', 51, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(173, 'Panda size 3 Dippers', 120, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(174, 'Mirinda Drink 2 L', 18, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(175, 'Black Merinda 2L', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(176, 'Cream It 1 Kg', 13, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(177, 'Cremora', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(178, 'Just Orange', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(179, 'Just Orange', 5, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(180, 'Just Pinapple', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(181, 'Granadilla', 1, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(182, 'Go Fresh Fruit cock tail', 1, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(183, 'Go Fresh Peach ', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(184, 'Go Fresh Orange', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(185, 'Go Fresh Granadilla', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(186, 'Smooth Side Orange', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(187, 'Mazoe', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(188, 'Peneat Butter Big', 2, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(189, 'Peneat Butter Meduim', 17, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(190, 'Peneat Butter Small', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(191, 'Blue Brand', 26, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(192, 'Mixed Jam', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(193, 'Hugos', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(194, 'Fatties Spagheti', 12, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(195, 'Delicia Sphagethi', 12, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(196, 'Pastraelli Macaroni', 1, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(197, 'Delicia Pasta', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(198, 'Fresh Pak', 16, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(199, 'Quick Brew', 22, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(200, 'Cream It 1 Kg', 15, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(201, 'Ricofy', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(202, 'cocoa', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(203, 'tennis biscuit', 14, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(204, 'EET SUM MORE', 18, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(205, 'CHELSEA BISCUIT', 12, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(206, 'FINTA BIG', 44, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(207, 'FINTA SMALL', 44, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(208, 'PAMALAT SMALL MILK', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(209, 'PAMALAT BIG MILK', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(210, 'SWEET AID', 50, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(211, 'CHIPSY', 18, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(212, 'Piknik Vannila Cream', 26, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(213, 'Piknik Lemon Cream', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(214, 'Piknik Lemon Cream', 7, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(215, 'Sebas Soya', 35, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(216, 'Amazon Baby biscuits', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(217, 'Zamgold', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(218, 'Dlite oil 750ml', 4, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(219, 'Dlite Oil 2ltr', 12, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(220, 'Zamanita Oil 750ml', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(221, 'Zamgold Oil 2.5Ltr', 8, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(222, 'Ole Oil 2.5Ltr', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(223, 'Ole Oil 750ml', 10, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(224, 'Dlite Baby Cereals 250g', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(225, 'Dlite Cereals- Banana 250g', 3, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(226, 'Dlite Cereals Wheat 250g', 6, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(227, 'Mayonaise C&B 750g', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(228, 'Mayonaise C&B 375g', 3, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(229, 'eezee Noodles', 55, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(230, 'Dlite Rice 1kg', 11, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(231, 'Dlite Rice 2kg', 5, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(232, 'Katunjilas Rice1kg', 7, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(233, 'Shortbread Biscuits', 9, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(234, 'Sumo Biscuits', 34, 'Main Branch', '2019-03-16 10:49:59', 'Added'),
(235, 'Boom Laundry', 1, 'Main Branch', '2019-03-16 10:49:59', 'Deleted'),
(236, 'Boom 250 Grams', 10, 'Main Branch', '2019-03-16 10:49:59', 'Edited'),
(237, 'Seed ', 20, 'Main Branch', '2019-03-19 12:22:36', 'Added'),
(238, 'ew', 3, 'Warehouse', '2019-03-19 17:51:28', 'Added'),
(239, 'ew', 1, 'Warehouse', '2019-03-19 17:52:04', 'Deleted'),
(240, 'ds', 3, 'Warehouse', '2019-03-19 17:52:42', 'Added'),
(241, 'ds', 3, 'Warehouse', '2019-03-19 17:54:03', 'Transfer'),
(242, 'ds', 10, 'Warehouse', '2019-03-19 17:54:12', 'Edit'),
(243, 'Boom 250 Grams', 10, 'Main Branch', '2019-03-24 11:09:28', 'Edited'),
(244, 'ds', 1, 'Warehouse', '2019-03-25 13:31:14', 'Deleted'),
(245, 'Colgate', 13, 'Main Branch', '2019-03-27 10:32:56', 'Edited'),
(246, 'PAMALAT SMALL MILK', 1, 'Main Branch', '2019-04-16 06:29:00', 'Deleted'),
(247, 'Angle Line 25 x 25', 30, 'Main Branch', '2019-05-02 06:30:42', 'Edited'),
(248, 'Angle Line 30 x 30', 29, 'Main Branch', '2019-05-02 06:32:02', 'Edited'),
(249, 'Angle Line 40 x 40 X 5', 54, 'Main Branch', '2019-05-02 06:34:15', 'Edited'),
(250, 'Angle Line 50 x 50 x 5', 20, 'Main Branch', '2019-05-02 06:36:07', 'Edited'),
(251, 'Square Tube 16 x 16', 17, 'Main Branch', '2019-05-02 06:53:22', 'Edited'),
(252, 'Square Tube 20 x 20', 47, 'Main Branch', '2019-05-02 06:55:26', 'Edited'),
(253, 'Square Tube 25 x 25', 120, 'Main Branch', '2019-05-02 06:58:31', 'Edited'),
(254, 'Square Tube 30 x 30', 57, 'Main Branch', '2019-05-02 07:07:20', 'Edited'),
(255, 'Square Tube 40 x 40', 27, 'Main Branch', '2019-05-02 07:10:00', 'Edited'),
(256, 'R8', 29, 'Main Branch', '2019-05-06 14:28:48', 'Edited'),
(257, 'Ms Welding Rods', 97, 'Main Branch', '2019-05-07 07:05:39', 'Added'),
(258, 'Ms Welding Rods', 103, 'Main Branch', '2019-05-07 07:10:59', 'Edited'),
(259, 'PVC Cement', 16, 'Main Branch', '2019-05-07 07:20:43', 'Edited'),
(260, 'Cement 32.5', 601, 'Main Branch', '2019-05-08 06:24:01', 'Edited'),
(261, 'Cement 32.5', 601, 'Main Branch', '2019-05-08 06:26:03', 'Edited'),
(262, 'Flat Bar 20 x 3', 24, 'Main Branch', '2019-05-08 08:19:03', 'Edited'),
(263, 'Flat Bar 23 x 3', 4, 'Main Branch', '2019-05-08 08:19:39', 'Edited'),
(264, 'Flat Bar 20 x 3', 24, 'Main Branch', '2019-05-08 08:20:47', 'Edited'),
(265, 'Flat Bar 23 x 3', 4, 'Main Branch', '2019-05-08 08:21:37', 'Edited'),
(266, 'Screw Driver 8Inch', 21, 'Main Branch', '2019-05-08 08:22:49', 'Edited'),
(267, 'Gloss Black 5Ltrs ', 2, 'Main Branch', '2019-05-09 09:07:13', 'Added'),
(268, 'Chicken Wire 1.8 Mtrs', 40, 'Main Branch', '2019-05-09 09:10:23', 'Edited'),
(269, 'Cutting Disk 9', 18, 'Main Branch', '2019-05-09 10:09:56', 'Edited'),
(270, 'Cutting Disk 9', 18, 'Main Branch', '2019-05-09 10:11:26', 'Edited'),
(271, 'Cement 32.5', 440, 'Main Branch', '2019-05-15 07:35:30', 'Edited'),
(272, 'Red Oxide 1L', 0, 'Main Branch', '2019-05-16 07:35:28', 'Edited'),
(273, 'Red Oxide 5L', 1, 'Main Branch', '2019-05-16 07:36:12', 'Edited'),
(274, 'PVA Paint Charcoal Grey  20L', 0, 'Main Branch', '2019-05-16 07:37:19', 'Edited'),
(275, 'PVA Banana Cream 20 Ltrs', 0, 'Main Branch', '2019-05-16 07:38:13', 'Edited'),
(276, 'Gloss Black 5ltrs', 2, 'Main Branch', '2019-05-16 07:39:20', 'Edited'),
(277, 'Gloss Green Dome', 0, 'Main Branch', '2019-05-16 07:40:00', 'Edited'),
(278, 'Gloss Cream Banana 5Ltr', 0, 'Main Branch', '2019-05-16 07:42:03', 'Added'),
(279, 'Gloss Paint Charcoal Grey 5L', 0, 'Main Branch', '2019-05-16 07:42:47', 'Edited'),
(280, 'Gloss Paint Charcoal Grey 5L', 0, 'Main Branch', '2019-05-16 07:43:29', 'Edited'),
(281, 'PVA Paint Charcoal Grey  20L', 0, 'Main Branch', '2019-05-16 07:45:05', 'Edited'),
(282, 'Gloss Black 1Ltr', 0, 'Main Branch', '2019-05-16 07:46:59', 'Added'),
(283, 'Gloss White 1Ltr', 0, 'Main Branch', '2019-05-16 07:50:27', 'Added'),
(284, 'Thinners 2.5Ltr', 0, 'Main Branch', '2019-05-16 07:53:11', 'Added'),
(285, 'Gloss Black 5Ltrs ', 1, 'Main Branch', '2019-05-16 08:16:58', 'Deleted'),
(286, 'Gloss Black 1Ltr', 0, 'Main Branch', '2019-05-16 08:21:49', 'Edited'),
(287, 'Roofing Sheet 10F (3.0m)', 0, 'Main Branch', '2019-05-16 08:23:22', 'Edited'),
(288, 'Roofing Sheet 8F (2.5m)', 3, 'Main Branch', '2019-05-16 08:24:05', 'Edited'),
(289, 'Round Tube 50 x  1.2 mm', 0, 'Main Branch', '2019-05-16 08:24:57', 'Edited'),
(290, 'Y12 X 12 MTRS', 0, 'Main Branch', '2019-05-16 08:33:29', 'Edited'),
(291, 'Fencing Wire  (Diamond)', 1, 'Main Branch', '2019-05-16 08:35:45', 'Edited'),
(292, 'Game Wire 1.19 Mtr', 0, 'Main Branch', '2019-05-16 08:37:56', 'Edited'),
(293, 'Game Wire 1.8 Mtr', 0, 'Main Branch', '2019-05-16 08:38:57', 'Edited'),
(294, 'Gloss Black 1Ltr', 0, 'Main Branch', '2019-05-16 08:47:34', 'Edited'),
(295, 'Red Oxide 1L', 0, 'Main Branch', '2019-05-16 08:49:55', 'Edited'),
(296, 'Red Oxide 5L', 1, 'Main Branch', '2019-05-16 08:57:19', 'Edited'),
(297, 'Red Oxide 5L', 1, 'Main Branch', '2019-05-16 09:34:32', 'Edited'),
(298, 'FX7', 8, 'Main Branch', '2019-05-16 12:56:33', 'Edited'),
(299, 'Y16 X 12 MTRS', 23, 'Main Branch', '2019-05-16 12:58:46', 'Edited'),
(300, 'Y12 X 12 MTRS', 0, 'Main Branch', '2019-05-16 13:01:58', 'Edited'),
(301, 'Y12 X 6 MTRS', 0, 'Main Branch', '2019-05-16 13:02:56', 'Edited'),
(302, 'Spray Paint White', 1, 'Main Branch', '2019-05-16 13:42:37', 'Edited'),
(303, 'Spray Piant Silver', 0, 'Main Branch', '2019-05-16 13:43:38', 'Edited'),
(304, 'Spray Paint Gold', 5, 'Main Branch', '2019-05-16 13:45:02', 'Edited'),
(305, 'Mortice Lock Manchester', 1, 'Main Branch', '2019-05-16 13:45:43', 'Edited'),
(306, 'Mortice Lock Mecco', 3, 'Main Branch', '2019-05-16 13:46:37', 'Edited'),
(307, 'Mortice Lock Union', 0, 'Main Branch', '2019-05-16 13:47:23', 'Edited'),
(308, 'Single Socket', 25, 'Main Branch', '2019-05-16 13:49:54', 'Edited'),
(309, 'Single Socket', 25, 'Main Branch', '2019-05-16 13:51:18', 'Edited'),
(310, 'Double Socket', 5, 'Main Branch', '2019-05-16 14:29:36', 'Edited'),
(311, 'PK Trust-Extension Adapter 5 Way', 1, 'Main Branch', '2019-05-16 14:32:15', 'Edited'),
(312, 'PK Trust-Extension Adapter 6 Way', 2, 'Main Branch', '2019-05-16 14:32:59', 'Edited'),
(313, 'Air Vent ( pairs )', 100, 'Main Branch', '2019-05-16 14:33:51', 'Edited'),
(314, 'Roller Brush + Tray', 0, 'Main Branch', '2019-05-16 14:34:39', 'Edited'),
(315, 'Roller Brush + Tray', 0, 'Main Branch', '2019-05-16 14:35:26', 'Edited'),
(316, 'Engine oil (Petrol) 1 Ltrs', 0, 'Main Branch', '2019-05-16 14:36:59', 'Edited'),
(317, 'Engine oil (Diesel) 1 Ltrs', 2, 'Main Branch', '2019-05-16 14:37:51', 'Edited'),
(318, 'Roofing Nail', 3, 'Main Branch', '2019-05-16 14:39:40', 'Edited'),
(319, 'Poly Pipe 25MM', 200, 'Main Branch', '2019-05-16 14:42:57', 'Added'),
(320, 'Sink Waste 1/4Inch', 5, 'Main Branch', '2019-05-17 08:15:43', 'Added'),
(321, 'Barrow Bolt 4', 23, 'Main Branch', '2019-05-17 08:17:59', 'Edited'),
(322, 'Barrow Bolt 6', 24, 'Main Branch', '2019-05-17 08:18:44', 'Edited'),
(323, 'Black Plactic HD', 500, 'Main Branch', '2019-05-17 08:19:46', 'Edited'),
(324, 'Roofing Sheet 8F (2.5m)', 103, 'Main Branch', '2019-05-17 08:21:13', 'Edited'),
(325, 'Roofing Sheet 10F (3.0m)', 150, 'Main Branch', '2019-05-17 08:22:00', 'Edited'),
(326, 'Roofing Sheet 12F (3.5m)', 150, 'Main Branch', '2019-05-17 08:23:10', 'Edited'),
(327, 'Roofing Sheet 10F (3.0m)', 150, 'Main Branch', '2019-05-17 08:23:47', 'Edited'),
(328, 'Ridges', 66, 'Main Branch', '2019-05-17 08:24:24', 'Edited'),
(329, 'Square Tube 20 x 20', 54, 'Main Branch', '2019-05-17 08:25:23', 'Edited'),
(330, 'Square Tube 16 x 16', 22, 'Main Branch', '2019-05-17 08:26:09', 'Edited'),
(331, 'Round Tube 50 x  1.2 mm', 25, 'Main Branch', '2019-05-17 08:26:52', 'Edited'),
(332, 'Flat Sheet  0.6 mm', 10, 'Main Branch', '2019-05-17 08:27:39', 'Edited'),
(333, 'Flat Sheet 0.8 mm', 10, 'Main Branch', '2019-05-17 08:28:27', 'Edited'),
(334, 'Square Tube 30 x 30', 51, 'Main Branch', '2019-05-18 07:35:42', 'Edited'),
(335, 'Chicken Wire 1.2X45Mtr', 3, 'Main Branch', '2019-05-18 07:52:49', 'Edited'),
(336, 'Square Tube 30 x 30', 31, 'Main Branch', '2019-05-18 08:06:00', 'Edited'),
(337, 'Square Tube 25 x 25', 100, 'Main Branch', '2019-05-22 08:01:24', 'Edited'),
(338, 'Square Tube 25 x 25', 100, 'Main Branch', '2019-05-22 08:06:53', 'Edited'),
(339, 'Pick Head', 17, 'Main Branch', '2019-05-22 09:36:47', 'Edited'),
(340, 'Pick Head', 17, 'Main Branch', '2019-05-22 09:37:39', 'Edited'),
(341, 'PVA Dove Grey 20L', 4, 'Main Branch', '2019-05-22 12:26:58', 'Edited'),
(342, 'PVA Honey Cream 20L', 0, 'Main Branch', '2019-05-22 12:28:06', 'Edited'),
(343, 'PVA Paint Banana 20L', 6, 'Main Branch', '2019-05-22 12:28:47', 'Edited'),
(344, 'PVA Paint Cream White 20L', 2, 'Main Branch', '2019-05-22 12:29:29', 'Edited'),
(345, 'PVA Paint Sky Blue 20L', 1, 'Main Branch', '2019-05-22 12:30:09', 'Edited'),
(346, 'PVA Paint White 20L', 17, 'Main Branch', '2019-05-22 12:30:58', 'Edited'),
(347, 'PVA Pista Green 20L', 2, 'Main Branch', '2019-05-22 12:31:46', 'Edited'),
(348, 'Brickforce Wire 4', 0, 'Main Branch', '2019-05-23 12:31:11', 'Edited'),
(349, 'Gloss Black 5ltrs', 7, 'Main Branch', '2019-05-24 07:44:27', 'Edited'),
(350, 'Gloss Green Dome', 5, 'Main Branch', '2019-05-24 07:45:10', 'Edited'),
(351, 'Gloss Paint Charcoal Grey 5L', 5, 'Main Branch', '2019-05-24 07:45:49', 'Edited'),
(352, 'Gloss Paint White 5L', 6, 'Main Branch', '2019-05-24 08:06:38', 'Edited'),
(353, 'Window Handle(Left)', 40, 'Main Branch', '2019-05-28 07:50:50', 'Added'),
(354, 'Window Handle(Right)', 40, 'Main Branch', '2019-05-28 07:51:48', 'Added'),
(355, 'Brickforce Wire 4', 500, 'Main Branch', '2019-05-29 08:32:29', 'Edited'),
(356, 'Ms Welding Rods', 45, 'Main Branch', '2019-05-30 07:25:26', 'Edited'),
(357, 'Ceiling Board 6 mm', 100, 'Main Branch', '2019-05-30 07:26:47', 'Edited'),
(358, 'Red Oxide 5L', 8, 'Main Branch', '2019-06-03 08:07:08', 'Edited'),
(359, 'Red Oxide 5L', 8, 'Main Branch', '2019-06-03 08:13:09', 'Edited'),
(360, 'Ms Welding Rods', 60, 'Main Branch', '2019-06-03 08:14:12', 'Edited'),
(361, 'F7', 0, 'Main Branch', '2019-06-03 08:28:31', 'Edited'),
(362, 'Cement 32.5', 263, 'Main Branch', '2019-06-08 08:04:10', 'Edited'),
(363, 'Paint Brushs 4', 21, 'Main Branch', '2019-06-11 13:04:35', 'Edited'),
(364, 'F7', 0, 'Main Branch', '2019-06-11 13:09:15', 'Edited'),
(365, 'F7', 165, 'Main Branch', '2019-06-11 13:10:05', 'Edited'),
(366, 'Roofing Sheet 8F (2.5m)', 100, 'Main Branch', '2019-06-11 13:14:42', 'Edited'),
(367, 'Fencing Wire  (Diamond)', 1, 'Main Branch', '2019-06-19 09:26:57', 'Edited'),
(368, 'Amarula', 30, 'Warehouse', '2019-06-25 14:20:23', 'Added'),
(369, 'Fanta', 100, 'Main Branch', '2019-07-16 14:42:00', 'Added'),
(370, 'Elantine', 22, 'Main Branch', '2019-07-31 11:08:32', 'Added'),
(371, 'Fanta', 100, 'Main Branch', '2019-07-31 11:08:50', 'Edited'),
(372, 'Elantine', 22, 'Main Branch', '2019-07-31 11:09:41', 'Edited'),
(373, 'Face Scrub', 20, 'Main Branch', '2019-07-31 11:11:26', 'Added'),
(374, 'test', 33, 'Main Branch', '2019-08-05 18:13:35', 'Added'),
(375, 'Panado', 22, 'Main Branch', '2019-08-05 19:38:39', 'Added'),
(376, 'Panado', 22, 'Main Branch', '2019-08-06 06:43:00', 'Added'),
(377, 'Panado', 22, 'Main Branch', '2019-08-06 06:51:03', 'Added'),
(378, 'Panado', 22, 'Main Branch', '2019-08-06 07:12:55', 'Added'),
(379, 'Spare Ribs', 22, 'Main Branch', '2019-08-06 10:11:17', 'Added'),
(380, 'Panado test', 22, 'Main Branch', '2019-08-06 12:11:57', 'Added'),
(381, 'Panado test', 1, 'Main Branch', '2019-08-06 12:15:05', 'Deleted'),
(382, 'Panado test', 22, 'Main Branch', '2019-08-06 12:15:20', 'Added'),
(383, 'Boom 250 Grams', 22, 'Main Branch', '2019-08-06 12:16:37', 'Added'),
(384, 'Panado', 1, 'Main Branch', '2019-08-08 12:58:33', 'Deleted'),
(385, 'Dipers', 1, 'Main Branch', '2019-08-08 12:58:36', 'Deleted'),
(386, 'Spare Ribs', 1, 'Main Branch', '2019-08-08 12:58:39', 'Deleted'),
(387, 'Panado test', 1, 'Main Branch', '2019-08-08 12:58:42', 'Deleted'),
(388, 'Boom 250 Grams', 1, 'Main Branch', '2019-08-08 12:58:45', 'Deleted'),
(389, '16 mm board , Registered Oak 605', 190, 'Main Branch', '2019-08-08 13:00:30', 'Added'),
(390, '16 mm board , Registered Oak 605', 1, 'Main Branch', '2019-08-08 13:01:29', 'Deleted'),
(391, 'BO15 16 mm board, Registred Oak 605', 20, 'Main Branch', '2019-08-08 13:01:58', 'Added'),
(392, 'choolwe ngandu', 1, 'Main Branch', '2019-08-11 10:14:54', 'Added'),
(393, 'test', 22, 'Main Branch', '2019-08-11 11:14:31', 'Added'),
(394, 'Clear,yellow,brown (40mic) 12MMX40M', 144, 'Main Branch', '2019-08-11 11:21:33', 'Edited'),
(395, 'Clear,yellow,brown (40mic) 12MMX40M', 144, 'Main Branch', '2019-08-11 11:22:02', 'Edited'),
(396, 'test', 1, 'Main Branch', '2019-08-11 11:22:19', 'Deleted'),
(397, 'Rolls', 22, 'Main Branch', '2019-08-14 12:17:56', 'Added'),
(398, 'Clear 2', 114, 'Main Branch', '2019-08-14 12:22:49', 'Edited'),
(399, 'AVVIS BRAID #1', 33282, 'Main Branch', '2019-08-14 12:46:09', 'Added'),
(400, 'AVVIS BRAID #1', 33282, 'Main Branch', '2019-08-14 12:46:18', 'Edited'),
(401, 'AVVIS BRAID # 27', 50, 'Main Branch', '2019-08-14 12:46:47', 'Added'),
(402, 'test', 22, 'Main Branch', '2019-09-03 09:24:11', 'Added'),
(403, 'test', 22, 'Main Branch', '2019-09-03 09:37:58', 'Edited'),
(404, 'ZAHARA# 27 /33', 0, 'Main Branch', '2019-09-03 09:38:16', 'Edited'),
(405, 'test', 22, 'Main Branch', '2019-09-20 09:05:57', 'Edited'),
(406, 'test Pack', 11, 'Main Branch', '2019-09-30 16:02:48', 'Added'),
(407, 'test Pack', 11, 'Main Branch', '2019-09-30 16:07:23', 'Edited'),
(408, 'test', 22, 'Main Branch', '2019-09-30 16:07:35', 'Edited'),
(409, 'Added Item', 10, 'Main Branch', '2019-10-12 22:16:33', 'Added'),
(410, 'Added Item', 10, 'Main Branch', '2019-10-15 16:12:15', 'Edited'),
(411, 'Added Item', 6, 'Main Branch', '2019-10-21 08:28:50', 'Edited'),
(412, 'Viniger ', 1222, 'Main Branch', '2020-01-28 16:26:13', 'Added'),
(413, 'Samusa Cage', 140, 'Main Branch', '2020-01-28 16:28:34', 'Added'),
(414, 'Barcode scanners', 2, 'Lusaka', '2020-12-14 21:00:47', 'Added'),
(415, 'Barcode scanners', 2, 'Lusaka', '2020-12-14 21:01:36', 'Edited'),
(416, 'Reciept Printer', 7, 'Lusaka', '2020-12-14 21:02:17', 'Added'),
(417, 'POS Elo Machine', 1, 'Lusaka', '2020-12-14 21:02:58', 'Added'),
(418, 'CPU And IBM Touch NEW', 1, 'Lusaka', '2020-12-14 21:03:54', 'Added'),
(419, 'Second Hand IBM with CPUs', 2, 'Lusaka', '2020-12-14 21:04:29', 'Added'),
(420, '3 D Scanner', 1, 'Lusaka', '2020-12-14 21:04:54', 'Added'),
(421, 'POS Software', 10000000, 'Lusaka', '2021-02-06 08:01:50', 'Added'),
(422, 'Hole 96mm black nickel', 10, 'Lusaka', '2021-04-09 06:56:18', 'Added'),
(423, 'Hole 96mm black nickel', 10, 'Lusaka', '2021-04-09 06:56:31', 'Edited'),
(424, 'Hole 96mm black nickel', 10, 'Lusaka', '2021-04-09 07:16:21', 'Edited'),
(425, 'Hole 96mm black nickel', 10, 'Lusaka', '2021-04-09 07:17:06', 'Edited'),
(426, 'Hole 96mm black nickel', 10, 'Lusaka', '2021-04-09 07:17:21', 'Edited'),
(427, 'Hole 96mm black nickel', 0, 'Warehouse', '2021-09-14 14:50:19', 'Transfer'),
(428, 'Hole 96mm black nickel', 0, 'Warehouse', '2021-09-14 14:52:21', 'Transfer'),
(429, 'Hole 96mm black nickel', 1, 'Warehouse', '2021-09-14 14:59:19', 'Transfer'),
(430, '3 D Scanner', 1, 'Warehouse', '2021-09-14 15:02:42', 'Transfer'),
(431, '3 D Scanner', 1, 'Warehouse', '2021-09-15 14:16:05', 'Transfer'),
(432, 'Hole 96mm black nickel', 1, 'Warehouse', '2021-09-15 14:16:28', 'Transfer'),
(433, '3 D Scanner', 0, 'Lusaka', '2021-09-18 14:24:52', 'Edited'),
(434, '3 D Scanner', 100, 'Lusaka', '2021-09-18 14:25:30', 'Edited'),
(435, 'Hole 96mm black nickel', 1, 'Lusaka', '2021-09-19 07:42:29', 'Edited');

-- --------------------------------------------------------

--
-- Table structure for table `stock_damages_tb`
--

CREATE TABLE `stock_damages_tb` (
  `id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `no_damages` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_purchases_tb`
--

CREATE TABLE `stock_purchases_tb` (
  `purchase_id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `qty` text NOT NULL,
  `user_id` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supplier_id` int(12) NOT NULL,
  `status` text NOT NULL,
  `invoice` int(12) NOT NULL,
  `cost_price` text NOT NULL,
  `sale_price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_purchases_tb`
--

INSERT INTO `stock_purchases_tb` (`purchase_id`, `prod_id`, `qty`, `user_id`, `date`, `supplier_id`, `status`, `invoice`, `cost_price`, `sale_price`) VALUES
(0, 3, '1', 4, '2021-09-14 09:35:08', 15, '', 0, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock_trasfers_tb`
--

CREATE TABLE `stock_trasfers_tb` (
  `id` int(12) NOT NULL,
  `prod_id` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qty` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `moved_to` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_trasfers_tb`
--

INSERT INTO `stock_trasfers_tb` (`id`, `prod_id`, `date_added`, `qty`, `user_id`, `moved_to`) VALUES
(1, 10, '2021-09-14 14:50:19', 0, 0, 0),
(2, 10, '2021-09-14 14:51:20', 0, 0, 0),
(3, 10, '2021-09-14 14:52:21', 0, 4, 0),
(4, 10, '2021-09-14 14:56:16', 0, 4, 1),
(5, 10, '2021-09-14 14:57:13', 1, 4, 1),
(6, 10, '2021-09-14 14:59:19', 1, 4, 2),
(7, 10, '2021-09-14 14:59:36', 1, 4, 2),
(8, 8, '2021-09-14 15:02:42', 1, 4, 2),
(9, 14, '2021-09-15 14:16:05', 1, 4, 59),
(10, 13, '2021-09-15 14:16:28', 1, 4, 59);

-- --------------------------------------------------------

--
-- Table structure for table `stores_branch`
--

CREATE TABLE `stores_branch` (
  `id` int(12) NOT NULL,
  `branch_name` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores_branch`
--

INSERT INTO `stores_branch` (`id`, `branch_name`, `date_added`) VALUES
(2, 'Lusaka', '2021-11-18 06:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cons_tb`
--

CREATE TABLE `sub_cons_tb` (
  `id` int(12) NOT NULL,
  `class` text NOT NULL,
  `description` text NOT NULL,
  `qty` int(12) NOT NULL,
  `category_id` int(12) NOT NULL,
  `origin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`) VALUES
(11, 'Best Provider', 'Stand 8643, Chinika Industrial Area\r\nLusaka', 'Ashish'),
(12, 'Jibu Purified Water', 'Jibu Purified Water', '00'),
(13, 'NameHero, LLC', 'NameHero, LLC\r\n', '00'),
(14, 'Zamtel Telecommunications', 'Zamtel Telecommunications\r\n', '00'),
(15, 'B K Electronics', 'B K Electronics\r\n', '00'),
(16, 'Town Guys', 'B K Electronics\r\n', '00'),
(17, 'Other', 'B K Electronics\r\n', '00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments_tb`
--

CREATE TABLE `supplier_payments_tb` (
  `payment_id` int(12) NOT NULL,
  `supplier_id` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount_paid` text NOT NULL,
  `balance` text NOT NULL,
  `total_amount` text NOT NULL,
  `status` text NOT NULL,
  `invoice_no` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_payments_tb`
--

INSERT INTO `supplier_payments_tb` (`payment_id`, `supplier_id`, `date_added`, `amount_paid`, `balance`, `total_amount`, `status`, `invoice_no`) VALUES
(3, 11, '2019-05-22 06:57:16', '20000', '', '39842.5', '', 0),
(4, 17, '2019-05-22 06:58:29', '0', '', '6208', '', 1),
(5, 19, '2019-05-22 06:59:55', '0', '', '84732', '', 1),
(6, 18, '2019-05-22 07:00:48', '0', '', '12420', '', 35641),
(7, 20, '2019-05-22 07:02:07', '12000', '', '29481', '', 1),
(8, 24, '2019-05-22 07:09:58', '0', '', '8100', '', 1),
(9, 22, '2019-05-22 07:10:22', '0', '', '53100', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE `temp_trans` (
  `temp_trans_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_id` int(12) NOT NULL,
  `price_tag` text NOT NULL,
  `discount_type` text NOT NULL,
  `amount` text NOT NULL,
  `description` text NOT NULL,
  `quote_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_trans`
--

INSERT INTO `temp_trans` (`temp_trans_id`, `prod_id`, `price`, `qty`, `branch_id`, `user_id`, `price_tag`, `discount_type`, `amount`, `description`, `quote_id`) VALUES
(10, 14, '22250.00', 1, 1, 8, '', 'Percentage', '5', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `term_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `payable_for` varchar(10) NOT NULL,
  `term` varchar(11) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `payment_start` date NOT NULL,
  `down` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_type` text NOT NULL,
  `branch_id_user` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `status`, `branch_id`, `user_type`, `branch_id_user`) VALUES
(4, 'admin', '7e535a557cc37abf1513d298d2cb1f02', 'Mona Lisas', 'active', 1, 'Admin', 3),
(8, 'user', '81dc9bdb52d04dc20036dbd8313ed055', 'choolwe ngandu', 'active', 1, 'Admin', 1),
(9, 'user', 'd5c186983b52c4551ee00f72316c6eaa', 'Test User2', 'active', 1, 'User', 0),
(10, 'william', '372d30dd2849813ef674855253900679', 'William', 'active', 1, 'warehouse', 0),
(11, 'mainza', '45743d55bd87a0a846737c8318a48a3a', 'Mainza Chilombe', 'active', 1, 'User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ware_house_tb`
--

CREATE TABLE `ware_house_tb` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_sell_price` text NOT NULL,
  `prod_pic` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(12) NOT NULL,
  `barcode` text NOT NULL,
  `stock_branch_id` int(12) NOT NULL,
  `belongs_to` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ware_house_tb`
--

INSERT INTO `ware_house_tb` (`prod_id`, `prod_name`, `prod_desc`, `prod_price`, `prod_sell_price`, `prod_pic`, `cat_id`, `prod_qty`, `branch_id`, `supplier_id`, `serial`, `date_added`, `added_by`, `barcode`, `stock_branch_id`, `belongs_to`) VALUES
(1, 'Amarula', 'Amarula', '20.00', '35', 'default.gif', 59, 30, 1, 11, 'Non', '2019-06-25 14:20:23', 0, '', 0, 0),
(2, '3 D Scanner', '', '800.00', '2500', '', 59, 1, 1, 11, 'Non', '2021-09-15 14:16:05', 0, '0.0', 59, 59),
(3, 'Hole 96mm black nickel', '', '5.00', '50', '', 59, 1, 1, 11, 'Non', '2021-09-15 14:16:28', 0, 'MT015', 59, 59);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_payments_tb`
--
ALTER TABLE `advance_payments_tb`
  ADD PRIMARY KEY (`advace_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `cashout_limits_tb`
--
ALTER TABLE `cashout_limits_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `credit_outgoing_stock`
--
ALTER TABLE `credit_outgoing_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_payments`
--
ALTER TABLE `credit_payments`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damages_log_tb`
--
ALTER TABLE `damages_log_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_tb`
--
ALTER TABLE `delivery_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_tb`
--
ALTER TABLE `discount_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_sales_tb`
--
ALTER TABLE `draft_sales_tb`
  ADD PRIMARY KEY (`sales_details_id`);

--
-- Indexes for table `draft_temp_trans`
--
ALTER TABLE `draft_temp_trans`
  ADD PRIMARY KEY (`temp_trans_id`);

--
-- Indexes for table `expenses_tb`
--
ALTER TABLE `expenses_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_types_tb`
--
ALTER TABLE `expense_types_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_log`
--
ALTER TABLE `history_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `inventory_tb`
--
ALTER TABLE `inventory_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_tb`
--
ALTER TABLE `invoices_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_damages_tb`
--
ALTER TABLE `inv_damages_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licience_reg_tb`
--
ALTER TABLE `licience_reg_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modes_of_payment_tb`
--
ALTER TABLE `modes_of_payment_tb`
  ADD PRIMARY KEY (`payment_mode_id`);

--
-- Indexes for table `notifications_settings_tb`
--
ALTER TABLE `notifications_settings_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_close_cashout_tb`
--
ALTER TABLE `open_close_cashout_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_close_tb`
--
ALTER TABLE `open_close_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_payments_tb`
--
ALTER TABLE `part_payments_tb`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prospect_comments`
--
ALTER TABLE `prospect_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `quotation_tb`
--
ALTER TABLE `quotation_tb`
  ADD PRIMARY KEY (`quote_identity`);

--
-- Indexes for table `rawdata_tb`
--
ALTER TABLE `rawdata_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rawdata_updates_tb`
--
ALTER TABLE `rawdata_updates_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`sales_details_id`);

--
-- Indexes for table `sales_tb`
--
ALTER TABLE `sales_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_category_tb`
--
ALTER TABLE `shop_category_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stockin_id`);

--
-- Indexes for table `stock_audit_tb`
--
ALTER TABLE `stock_audit_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_damages_tb`
--
ALTER TABLE `stock_damages_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_purchases_tb`
--
ALTER TABLE `stock_purchases_tb`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `stock_trasfers_tb`
--
ALTER TABLE `stock_trasfers_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores_branch`
--
ALTER TABLE `stores_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_cons_tb`
--
ALTER TABLE `sub_cons_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_payments_tb`
--
ALTER TABLE `supplier_payments_tb`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `temp_trans`
--
ALTER TABLE `temp_trans`
  ADD PRIMARY KEY (`temp_trans_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ware_house_tb`
--
ALTER TABLE `ware_house_tb`
  ADD PRIMARY KEY (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_payments_tb`
--
ALTER TABLE `advance_payments_tb`
  MODIFY `advace_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cashout_limits_tb`
--
ALTER TABLE `cashout_limits_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `credit_outgoing_stock`
--
ALTER TABLE `credit_outgoing_stock`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `credit_payments`
--
ALTER TABLE `credit_payments`
  MODIFY `credit_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `damages_log_tb`
--
ALTER TABLE `damages_log_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_tb`
--
ALTER TABLE `delivery_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `discount_tb`
--
ALTER TABLE `discount_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `draft_sales_tb`
--
ALTER TABLE `draft_sales_tb`
  MODIFY `sales_details_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `draft_temp_trans`
--
ALTER TABLE `draft_temp_trans`
  MODIFY `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `expenses_tb`
--
ALTER TABLE `expenses_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `expense_types_tb`
--
ALTER TABLE `expense_types_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `history_log`
--
ALTER TABLE `history_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=711;
--
-- AUTO_INCREMENT for table `inventory_tb`
--
ALTER TABLE `inventory_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices_tb`
--
ALTER TABLE `invoices_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1495;
--
-- AUTO_INCREMENT for table `inv_damages_tb`
--
ALTER TABLE `inv_damages_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `licience_reg_tb`
--
ALTER TABLE `licience_reg_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modes_of_payment_tb`
--
ALTER TABLE `modes_of_payment_tb`
  MODIFY `payment_mode_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `notifications_settings_tb`
--
ALTER TABLE `notifications_settings_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `open_close_cashout_tb`
--
ALTER TABLE `open_close_cashout_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `open_close_tb`
--
ALTER TABLE `open_close_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `part_payments_tb`
--
ALTER TABLE `part_payments_tb`
  MODIFY `payment_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `prospect_comments`
--
ALTER TABLE `prospect_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotation_tb`
--
ALTER TABLE `quotation_tb`
  MODIFY `quote_identity` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `rawdata_tb`
--
ALTER TABLE `rawdata_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rawdata_updates_tb`
--
ALTER TABLE `rawdata_updates_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `sales_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `sales_tb`
--
ALTER TABLE `sales_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shop_category_tb`
--
ALTER TABLE `shop_category_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stockin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stock_audit_tb`
--
ALTER TABLE `stock_audit_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;
--
-- AUTO_INCREMENT for table `stock_damages_tb`
--
ALTER TABLE `stock_damages_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_trasfers_tb`
--
ALTER TABLE `stock_trasfers_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `stores_branch`
--
ALTER TABLE `stores_branch`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sub_cons_tb`
--
ALTER TABLE `sub_cons_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `supplier_payments_tb`
--
ALTER TABLE `supplier_payments_tb`
  MODIFY `payment_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `temp_trans`
--
ALTER TABLE `temp_trans`
  MODIFY `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ware_house_tb`
--
ALTER TABLE `ware_house_tb`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2021 at 06:45 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rigid`
--

-- --------------------------------------------------------

--
-- Table structure for table `core_settings`
--

CREATE TABLE `core_settings` (
  `setting_id` int(11) NOT NULL,
  `module_code` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `module_name` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `module_label` varchar(255) CHARACTER SET utf16 NOT NULL,
  `section_code` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `section_name` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `setting_code` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `setting_name` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `setting_description` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `setting_value` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `value_type` varchar(255) CHARACTER SET utf16 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `core_users`
--

CREATE TABLE `core_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `first_name` varchar(90) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `firm_name` varchar(255) DEFAULT NULL,
  `firm_id` varchar(255) DEFAULT NULL,
  `fk_executive_id` int(11) DEFAULT NULL,
  `last_modified_dtm` datetime DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `web_session_id` varchar(255) DEFAULT NULL,
  `last_login_dtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `core_users`
--

INSERT INTO `core_users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `firm_name`, `firm_id`, `fk_executive_id`, `last_modified_dtm`, `dept`, `role`, `web_session_id`, `last_login_dtm`) VALUES
(1, 'ganesh', 'ganesh', 'Unique', 'Ventures', 'Empower Designs Private Limited', '1,2,3,4', 1, '2018-11-21 10:32:31', 'admin', 'manager', 'RItEbjuxSC', '2018-12-10 11:08:53'),
(2, 'sales1', 'sales1', 'Sales', 'Executive (1)', 'Empower Designs Private Limited', '1', NULL, '2018-11-21 10:37:02', 'sales', 'executive', '9xHrIkLeh4', '2018-11-27 13:40:45'),
(3, 'sales2', 'sales2', 'Sales', 'Executive 2', 'Empower Designs Private Limited', '1', NULL, '2018-11-21 10:59:04', 'sales', 'executive', NULL, NULL),
(4, 'sales3', 'sales3', 'Sales', 'Executive 3', 'Empower Designs Private Limited', '1', NULL, '2018-11-21 11:00:12', 'sales', 'executive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_customers`
--

CREATE TABLE `master_customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `mobile_number` int(15) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `identity_no` varchar(30) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `balance` varchar(30) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `master_customers`
--

INSERT INTO `master_customers` (`customer_id`, `customer_name`, `mobile_number`, `address`, `identity_no`, `gst_no`, `email`, `pan_no`, `balance`, `remark`) VALUES
(1, 'Maniklal Shah', 2147483647, 'A/p -Ozar Tal- Junnar Dist- Pune 410504', '', '', '', '', '0', 'New Through Invoice');

-- --------------------------------------------------------

--
-- Table structure for table `master_firms`
--

CREATE TABLE `master_firms` (
  `firm_id` int(11) NOT NULL,
  `firm_code` varchar(30) DEFAULT NULL,
  `firm_name` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `mobile_no` varchar(13) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `state_code` varchar(5) DEFAULT NULL,
  `gsn_no` varchar(30) DEFAULT NULL,
  `pan_no` varchar(30) DEFAULT NULL,
  `license_no` varchar(30) DEFAULT NULL,
  `reference_no` varchar(30) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `contact_mobile` varchar(13) DEFAULT NULL,
  `contact_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `master_firms`
--

INSERT INTO `master_firms` (`firm_id`, `firm_code`, `firm_name`, `address`, `city`, `state`, `country`, `mobile_no`, `phone_no`, `email_address`, `state_code`, `gsn_no`, `pan_no`, `license_no`, `reference_no`, `contact_person`, `contact_mobile`, `contact_email`) VALUES
(1, '1', 'Shri Ganesh Krushi Seva Kendra', 'A/P- Ozar', 'Junnar', 'Maharashtra', 'India', '9561140185', '9561140185', 'vijayskawade@gmail.com', '27', '27AFKPK5950N1ZT', 'NA', 'LAFD10070295', '', 'Vijay Kawade', '9561140185', 'vijayskawade@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `master_items`
--

CREATE TABLE `master_items` (
  `item_id` int(11) NOT NULL,
  `item_code` varchar(20) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_type` varchar(30) DEFAULT NULL,
  `items_inbox` varchar(50) DEFAULT '1',
  `manufacture` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `stock_quantity` varchar(20) CHARACTER SET utf16 COLLATE utf16_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `master_items`
--

INSERT INTO `master_items` (`item_id`, `item_code`, `item_name`, `item_type`, `items_inbox`, `manufacture`, `description`, `stock_quantity`) VALUES
(1, '1', 'Aloo Bhujia', 'fertilizer', '1', 'Haldiram', '500gms', '0');

-- --------------------------------------------------------

--
-- Table structure for table `master_routes`
--

CREATE TABLE `master_routes` (
  `route_id` int(11) NOT NULL,
  `route_code` varchar(50) DEFAULT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `from_location` varchar(255) DEFAULT NULL,
  `to_location` varchar(255) DEFAULT NULL,
  `customer_array` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_routes`
--

INSERT INTO `master_routes` (`route_id`, `route_code`, `route_name`, `from_location`, `to_location`, `customer_array`) VALUES
(2, '01', 'Pune Nashik', 'Pune', 'Nashik', '[\"2\",\"2\"]');

-- --------------------------------------------------------

--
-- Table structure for table `master_vendors`
--

CREATE TABLE `master_vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `mobile_no` varchar(13) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `identity_no` varchar(30) DEFAULT NULL,
  `license_no` varchar(30) DEFAULT NULL,
  `pan_no` varchar(30) DEFAULT NULL,
  `state_code` varchar(5) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_mobile` varchar(13) DEFAULT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `outstanding_balanace` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `master_vendors`
--

INSERT INTO `master_vendors` (`vendor_id`, `vendor_name`, `address`, `city`, `state`, `country`, `mobile_no`, `phone_no`, `email_address`, `identity_no`, `license_no`, `pan_no`, `state_code`, `contact_name`, `contact_mobile`, `contact_email`, `outstanding_balanace`) VALUES
(1, 'Rahul Agency', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rahul Agency', NULL, NULL, '80');

-- --------------------------------------------------------

--
-- Table structure for table `record_invoices`
--

CREATE TABLE `record_invoices` (
  `invoice_id` int(11) NOT NULL,
  `invoice_no` varchar(30) NOT NULL,
  `invoice_dt` date NOT NULL,
  `invoice_type` varchar(20) NOT NULL,
  `vehicle_no` varchar(30) DEFAULT NULL,
  `gst_no` varchar(20) NOT NULL,
  `receiver_name` varchar(70) NOT NULL,
  `receiver_mobile` varchar(15) NOT NULL,
  `receiver_address` varchar(50) NOT NULL,
  `receiver_identity_no` varchar(30) NOT NULL,
  `receiver_gst` varchar(255) DEFAULT NULL,
  `dispatch_details` varchar(50) NOT NULL,
  `date_of_supply` date NOT NULL,
  `net_amount` varchar(30) NOT NULL,
  `tax_amount` varchar(30) NOT NULL,
  `gross_amount` varchar(30) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `outstanding` varchar(20) DEFAULT NULL,
  `terms_conditions` varchar(150) NOT NULL,
  `fk_customers` int(11) DEFAULT NULL,
  `fk_master_firms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `record_invoices`
--

INSERT INTO `record_invoices` (`invoice_id`, `invoice_no`, `invoice_dt`, `invoice_type`, `vehicle_no`, `gst_no`, `receiver_name`, `receiver_mobile`, `receiver_address`, `receiver_identity_no`, `receiver_gst`, `dispatch_details`, `date_of_supply`, `net_amount`, `tax_amount`, `gross_amount`, `payment_type`, `outstanding`, `terms_conditions`, `fk_customers`, `fk_master_firms`) VALUES
(1, '1', '2020-12-31', 'Fertilizer', NULL, '27AFKPK5950N1ZT', 'Maniklal Shah', '9876543217', 'A/p -Ozar Tal- Junnar Dist- Pune 410504', '', '', 'Vijay Kawade', '2020-12-31', '100.00', '0.00', '100.00', 'Cash', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `record_invoice_contents`
--

CREATE TABLE `record_invoice_contents` (
  `content_id` int(11) NOT NULL,
  `item_quantity` varchar(20) NOT NULL,
  `item_unit` varchar(20) NOT NULL,
  `item_rate` varchar(20) NOT NULL,
  `item_sgst` varchar(20) NOT NULL,
  `item_cgst` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `inv_item_type` varchar(50) DEFAULT NULL,
  `inv_discount` varchar(50) DEFAULT NULL,
  `inv_boxes` varchar(50) DEFAULT NULL,
  `inv_items_inbox` varchar(50) DEFAULT NULL,
  `fk_record_stocks` int(11) NOT NULL,
  `fk_record_invoices` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `record_invoice_contents`
--

INSERT INTO `record_invoice_contents` (`content_id`, `item_quantity`, `item_unit`, `item_rate`, `item_sgst`, `item_cgst`, `date`, `discount`, `inv_item_type`, `inv_discount`, `inv_boxes`, `inv_items_inbox`, `fk_record_stocks`, `fk_record_invoices`) VALUES
(1, '1', 'grams', '100', '0', '0', '2020-12-31', NULL, 'Peace', '0', '1.0', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `record_payments`
--

CREATE TABLE `record_payments` (
  `payment_id` int(11) NOT NULL,
  `payment_code` varchar(30) DEFAULT NULL,
  `payment_dtm` datetime DEFAULT NULL,
  `reference_no` varchar(30) DEFAULT NULL,
  `payment_mode` varchar(10) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT 'customer',
  `amount` varchar(30) DEFAULT NULL,
  `cheque_no` varchar(30) DEFAULT NULL,
  `cheque_dt` date DEFAULT NULL,
  `account_no` varchar(30) DEFAULT NULL,
  `transaction_id` varchar(45) DEFAULT NULL,
  `bank_name` varchar(80) DEFAULT NULL,
  `branch_name` varchar(80) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `fk_master_customers` int(11) DEFAULT NULL,
  `fk_master_vendors` int(11) DEFAULT NULL,
  `fk_master_coporates` int(11) DEFAULT NULL,
  `fk_master_firms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `record_payments`
--

INSERT INTO `record_payments` (`payment_id`, `payment_code`, `payment_dtm`, `reference_no`, `payment_mode`, `payment_type`, `amount`, `cheque_no`, `cheque_dt`, `account_no`, `transaction_id`, `bank_name`, `branch_name`, `remark`, `fk_master_customers`, `fk_master_vendors`, `fk_master_coporates`, `fk_master_firms`) VALUES
(1, '1', '2020-04-09 00:00:00', '', 'cash', 'vendor', '1171750', '', '0000-00-00', NULL, '', '', '', 'clear', 5, 1, NULL, 1),
(2, '2', '2020-04-09 00:00:00', '', 'cash', 'vendor', '-100000', '', '0000-00-00', NULL, '', '', '', 'New FY Year', 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `record_stocks`
--

CREATE TABLE `record_stocks` (
  `stock_id` int(11) NOT NULL,
  `batch_no` varchar(10) NOT NULL,
  `purchase_dt` date DEFAULT NULL,
  `expiry_dt` date NOT NULL,
  `manufacture_dt` date NOT NULL,
  `packaging_quantity` varchar(10) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `stock_qty` varchar(10) NOT NULL,
  `pending_quantity` varchar(10) NOT NULL,
  `item_hsn` varchar(20) NOT NULL,
  `purchase_price` varchar(10) NOT NULL,
  `selling_price` varchar(10) DEFAULT NULL,
  `item_mrp` varchar(12) DEFAULT NULL,
  `boxes` varchar(12) DEFAULT NULL,
  `discount` varchar(10) NOT NULL,
  `item_sgst` varchar(10) NOT NULL,
  `item_cgst` varchar(10) NOT NULL,
  `vendor_name` varchar(244) DEFAULT NULL,
  `net_price` varchar(50) DEFAULT '00',
  `items_per_box` varchar(50) DEFAULT '1',
  `cash_retail_rate` varchar(20) NOT NULL,
  `credit_retail_rate` varchar(20) NOT NULL,
  `cash_wholesale_rate` varchar(20) NOT NULL,
  `credit_wholesale_rate` varchar(20) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `fk_master_vendors` int(11) DEFAULT NULL,
  `fk_master_items` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `record_stocks`
--

INSERT INTO `record_stocks` (`stock_id`, `batch_no`, `purchase_dt`, `expiry_dt`, `manufacture_dt`, `packaging_quantity`, `unit`, `stock_qty`, `pending_quantity`, `item_hsn`, `purchase_price`, `selling_price`, `item_mrp`, `boxes`, `discount`, `item_sgst`, `item_cgst`, `vendor_name`, `net_price`, `items_per_box`, `cash_retail_rate`, `credit_retail_rate`, `cash_wholesale_rate`, `credit_wholesale_rate`, `payment_type`, `fk_master_vendors`, `fk_master_items`) VALUES
(1, '1', '2020-12-31', '2021-01-01', '2020-12-31', '500', 'grams', '1', '0', '0', '80', '100', '100', '1', '0', '0', '0', NULL, '100.00', '1', '0', '0', '0', '0', 'credit', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_settings`
--
ALTER TABLE `core_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `core_users`
--
ALTER TABLE `core_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `master_customers`
--
ALTER TABLE `master_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `master_firms`
--
ALTER TABLE `master_firms`
  ADD PRIMARY KEY (`firm_id`);

--
-- Indexes for table `master_items`
--
ALTER TABLE `master_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `master_routes`
--
ALTER TABLE `master_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `master_vendors`
--
ALTER TABLE `master_vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `record_invoices`
--
ALTER TABLE `record_invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `record_invoice_contents`
--
ALTER TABLE `record_invoice_contents`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `record_payments`
--
ALTER TABLE `record_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `record_stocks`
--
ALTER TABLE `record_stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core_settings`
--
ALTER TABLE `core_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `core_users`
--
ALTER TABLE `core_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_customers`
--
ALTER TABLE `master_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_firms`
--
ALTER TABLE `master_firms`
  MODIFY `firm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_items`
--
ALTER TABLE `master_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_routes`
--
ALTER TABLE `master_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_vendors`
--
ALTER TABLE `master_vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `record_invoices`
--
ALTER TABLE `record_invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `record_invoice_contents`
--
ALTER TABLE `record_invoice_contents`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `record_payments`
--
ALTER TABLE `record_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `record_stocks`
--
ALTER TABLE `record_stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

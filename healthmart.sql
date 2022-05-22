-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 09:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CID` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNo` varchar(10) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `newAddress` varchar(500) NOT NULL,
  `itemsAndQuantity` varchar(1000) NOT NULL,
  `Ordered-date-and-Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CID`, `uname`, `email`, `mobileNo`, `address1`, `payment`, `newAddress`, `itemsAndQuantity`, `Ordered-date-and-Time`) VALUES
(1, 'isuru madusanka', 'isuru@gmail.com', '0771886641', 'no.05, Walahanduwa, Galle', 'Card Payment', '', 'acyclovir capsule - Zovirax Qty = 1 / amiodarone table - Cordarone Qty = 1 / clopidogrel bisulfate tablets - Plavix Qty = 1 / Tablets USP 500000 units - nystatin Qty = 1 / ', '2022-05-21 18:50:08'),
(2, 'yasiru deshan', 'yasiru@gmail.com', '0788095559', 'no 07, Rakwana', 'Card Payment', 'no 27, main street, Rakwana', 'AND UA-651 - Upper Arm Blood Pressure Monitor Qty = 1 / ', '2022-05-21 18:51:09'),
(3, 'janesha lansakara', 'janesha@gmail.com', '0702099934', 'no.07, Variyapola ,Kurunagala', 'Cash On Delivery', '', 'Axe universal oil (56ml) - AXE Qty = 1 / clonidine HCL tablets - Catapres Qty = 1 / amiodarone table - Cordarone Qty = 1 / AND UM-102 - Mercury-Free Sphygmomanometer Qty = 1 / Blood Pressure Meter Bulb - Sphygmomanometer Qty = 1 / AND UA-1020 - Upper Arm Blood Pressure Monitor Qty = 1 / ', '2022-05-21 18:52:51'),
(4, 'sandani amasha', 'sandani@gmail.com', '0774749770', 'no 09, main street, Madampe', 'Card Payment', '', 'AND UM-102 - Mercury-Free Sphygmomanometer Qty = 1 / AND UA-1020 - Upper Arm Blood Pressure Monitor Qty = 1 / alendronate tablet - Fosamax Qty = 1 / amiodarone table - Cordarone Qty = 1 / llopurinol tablet - Zyloprim Qty = 1 / Garlichol black seed oil (30s) - Baraka Qty = 1 / ', '2022-05-21 19:06:44'),
(5, 'sandani amasha', 'sandani@gmail.com', '0774749770', 'no 09, main street, Madampe', 'Card Payment', 'no 27,variyapola,kurunagala', 'acyclovir capsule - Zovirax Qty = 1 / decitabine - Dacogen Qty = 1 / alendronate tablet - Fosamax Qty = 1 / amiodarone table - Cordarone Qty = 1 / Medismart Sapphire - Blood Glucose Test Strips-25 Qty = 1 / ', '2022-05-21 19:15:24'),
(6, 'bagya sewwandi', 'bagya@gmail.com', '0763988972', 'no 10, Ibbagamuwa, Kurunagala', 'Card Payment', 'no 128, new street ,kurunagala', 'acyclovir capsule - Zovirax Qty = 1 / llopurinol tablet - Zyloprim Qty = 1 / amiodarone table - Cordarone Qty = 1 / Imsyser - Imsyser Internal Microbial Stabiliser Qty = 1 / ', '2022-05-21 19:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `cmtID` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNo` int(10) NOT NULL,
  `userIdeas` varchar(1000) NOT NULL,
  `comment-date-and-Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`cmtID`, `uname`, `email`, `mobileNo`, `userIdeas`, `comment-date-and-Time`) VALUES
(1, 'isuru sanka', 'isurusanka98@gmail.com', 715625154, 'It comes in handy when I cannot remember a drugs dosage or even when you cannot recall your normal lab result', '2022-05-21 17:00:57'),
(2, 'yasiru deshan', 'yasiru@gmail.com', 775236412, 'Overall, I would recommend to everyone about this Health Mart pharmacy space.', '2022-05-21 17:01:52'),
(3, 'janesha lansakara', 'janeshalansakara@gmail.com', 712569863, 'They have one of the top customer service responses available 24 hours a day, 7 days a week for a quick resolution in the event of an issue', '2022-05-21 17:07:43'),
(4, 'seyuni yahansa', 'seyuni@gmail.com', 785236524, 'Best Pharmacy Software and I support Out There', '2022-05-21 17:03:27'),
(5, 'sandani amasha', 'sandani@gmail.com', 742569874, 'This site is something I would suggest to anyone. They have a great customer service team, great products, and great pricing!', '2022-05-21 17:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `hmuser`
--

CREATE TABLE `hmuser` (
  `hmUID` int(11) NOT NULL,
  `uName` varchar(100) NOT NULL,
  `eMailAddress` varchar(100) NOT NULL,
  `uMobileNo` int(10) NOT NULL,
  `uAddress` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `UPW` varchar(100) NOT NULL,
  `hmRole` varchar(50) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hmuser`
--

INSERT INTO `hmuser` (`hmUID`, `uName`, `eMailAddress`, `uMobileNo`, `uAddress`, `city`, `UPW`, `hmRole`) VALUES
(1, 'janesha lansakara', 'janesha@gmail.com', 702099934, 'no.07, Variyapola ,Kurunagala', 'Kurunagala', 'ed8e8a51dc94464c683e82d44d7aad949e72b7b8', 'User'),
(2, 'isuru madusanka', 'isuru@gmail.com', 771886641, 'no.05, Walahanduwa, Galle', 'Galle', '7a9fb252f0c81b880af991d907d819d4611e0d9c', 'User'),
(3, 'yasiru deshan', 'yasiru@gmail.com', 788095559, 'no 07, Rakwana', 'Rathnapura', 'a5d6bb4852ac793833273d4685d8c762a5c49eab', 'User'),
(4, 'sandani amasha', 'sandani@gmail.com', 774749770, 'no 09, main street, Madampe', 'Madampe', 'ac0547ac2c37ca4c3e96a1015df6c648f455b334', 'User'),
(5, 'bagya sewwandi', 'bagya@gmail.com', 763988972, 'no 10, Ibbagamuwa, Kurunagala', 'Kurunagala', 'b9e8b90a2646758ada2dd1f5c3067c0fcd9a1c30', 'User'),
(6, 'janesha lansakara', 'janeshaA@gmail.com', 702099934, 'no.07, Variyapola ,Kurunagala', 'Kurunagala', 'ed8e8a51dc94464c683e82d44d7aad949e72b7b8', 'Admin'),
(7, 'isuru madusanka', 'isuruA@gmail.com', 771886641, 'no.05, Walahanduwa, Galle', 'Galle', '7a9fb252f0c81b880af991d907d819d4611e0d9c', 'Admin'),
(8, 'yasiru deshan', 'yasiruA@gmail.com', 788095559, 'no 07, Rakwana', 'Rathnapura', 'a5d6bb4852ac793833273d4685d8c762a5c49eab', 'Admin'),
(9, 'sandani amasha', 'sandaniA@gmail.com', 774749770, 'no 09, main street, Madampe', 'Madampe', 'ac0547ac2c37ca4c3e96a1015df6c648f455b334', 'Admin'),
(11, 'bagya sewwandi', 'bagyaA@gmail.com', 763988972, 'no 10, Ibbagamuwa, Kurunagala', 'Kurunagala', 'b9e8b90a2646758ada2dd1f5c3067c0fcd9a1c30', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `genericName` varchar(100) NOT NULL,
  `brandName` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `itemPrice` float NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `itemImage` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemID`, `genericName`, `brandName`, `code`, `itemPrice`, `isDeleted`, `itemImage`, `type`) VALUES
(1, 'alendronate tablet', 'Fosamax', 'med01', 3150, 0, 'img1.jpg', 'medicine'),
(2, 'acyclovir capsule', 'Zovirax', 'med02', 1300, 0, 'img2.jpg', 'medicine'),
(3, 'llopurinol tablet', 'Zyloprim', 'med03', 260, 0, 'img3.jpeg', 'medicine'),
(4, 'amiodarone table', 'Cordarone', 'med04', 1887, 0, 'img4.jpg', 'medicine'),
(5, 'clonidine HCL tablets', 'Catapres', 'med05', 175, 0, 'img5.jpg', 'medicine'),
(6, 'clopidogrel bisulfate tablets', 'Plavix', 'med06', 102, 0, 'img6.jpg', 'medicine'),
(7, 'decitabine', 'Dacogen', 'med07', 500, 0, 'img7.jpg', 'medicine'),
(8, 'letrozole', 'Femara', 'med08', 900, 0, 'img8.jpg', 'medicine'),
(9, 'methylphenidate tablet', 'Ritalin', 'med09', 500, 0, 'img9.jpg', 'medicine'),
(10, 'nystatin tablet', 'Nystatin tablet', 'med10', 600, 0, 'img10.jpg', 'medicine'),
(11, 'AND UA-651', 'Upper Arm Blood Pressure Monitor', 'medDiv01', 13500, 0, 'img15.jpeg', 'medical devices'),
(12, 'AND UM-102', 'Mercury-Free Sphygmomanometer', 'medD02', 26000, 0, 'img17.jpg', 'medical devices'),
(13, 'AND UA-1020', 'Upper Arm Blood Pressure Monitor', 'medD03', 20000, 0, 'img19.jpg', 'medical devices'),
(14, 'AND UM-201', 'Blood Pressure Monitor', 'medD04', 28000, 0, 'img20.jpg', 'medical devices'),
(15, 'Bionime GM700', 'Glucometer (Lifetime Warranty)', 'medD05', 3500, 0, 'img21.jpeg', 'medical devices'),
(16, 'Medismart Sapphire', 'Blood Glucose Test Strips-25', 'medD06', 2000, 0, 'img22.jpg', 'medical devices'),
(18, 'Blood Pressure Meter Bulb', 'Sphygmomanometer', 'medD09', 1590, 0, 'img25.jpg', 'medical devices'),
(20, 'Aloe Vera', 'Aloe Vera Esi Gel 200ml Argan', 'medTR01', 500, 0, 'img30.jpg', 'traditional remedies'),
(21, 'HERBAL DRAUGHT', 'African Ginger Tea 25g', 'medTR02', 300, 0, 'img31.jpg', 'traditional remedies'),
(22, 'Lennons', 'Lennons Gal Tablets', 'medTR03', 500, 0, 'img32.jpg', 'traditional remedies'),
(23, 'Imsyser', 'Imsyser Internal Microbial Stabiliser', 'medTR04', 1500, 0, 'img33.jpg', 'traditional remedies'),
(24, 'Tablets USP 500000 units', 'nystatin', 'med11', 600, 0, 'img10.jpg', 'medicine'),
(25, 'Femara', 'Letrozole', 'med12', 748.79, 0, 'img8.jpg', 'medicine'),
(26, 'Portable', 'Urinal Male', 'medD11', 699, 0, 'img26.jpeg', 'medical devices'),
(27, 'Stethoscope', 'Dual Rhythm Stethoscope', 'medD13', 4950, 0, 'img24.jpg', 'medical devices'),
(29, 'BiPAP Machine', 'BIPAP', 'medD002', 360000, 0, 'imgmed1.jpg', 'medical devices'),
(30, 'Silicon catheter 20G', 'catheter', 'medD003', 1300, 0, 'imgmed2.jpg', 'medical devices'),
(31, 'Softa Care Urine Bag', '400cc Urine Bag ', 'medD005', 1350, 0, 'imgmed3.jpg', 'medical devices'),
(32, 'Osupen(50g)', 'Link natural', 'medTR001', 110, 0, 'osupan_1000x1000.jpg', 'traditional remedies'),
(33, 'Axe universal oil (56ml)', 'AXE', 'medTR002', 120, 0, 'axe.jpg', 'traditional remedies'),
(34, 'cystone tablets (100s)', 'Himalaya', 'medTR003', 5300, 0, 'himalaya-cystone-tablets.jpg', 'traditional remedies'),
(35, 'Garlichol black seed oil (30s)', 'Baraka', 'medTR004', 3200, 0, 'dsc_0541-1_copy_1.jpg', 'traditional remedies');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `SID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateAndTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`SID`, `email`, `dateAndTime`) VALUES
(1, 'isurusanka98@gmail.com', '2022-05-20 03:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `pupload`
--

CREATE TABLE `pupload` (
  `PID` int(11) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNo` varchar(10) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `fullfillment` varchar(50) NOT NULL,
  `substitutes` varchar(50) NOT NULL,
  `days` int(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `refund` varchar(50) NOT NULL,
  `prescriptionTxt` varchar(1000) NOT NULL,
  `prescriptionFile` varchar(100) NOT NULL,
  `newAddress` varchar(1000) NOT NULL,
  `Ordered-date-and-Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pupload`
--

INSERT INTO `pupload` (`PID`, `uname`, `email`, `mobileNo`, `address1`, `frequency`, `fullfillment`, `substitutes`, `days`, `payment`, `refund`, `prescriptionTxt`, `prescriptionFile`, `newAddress`, `Ordered-date-and-Time`) VALUES
(1, 'yasiru deshan', 'yasiru@gmail.com', '0788095559', 'no 07, Rakwana', 'On Going', 'Partial', 'Yes', 6, 'Cash On Delivery', 'Online Banking', '', 'Picture1.jpg', '', '2022-05-21 18:49:21'),
(2, 'janesha lansakara', 'janesha@gmail.com', '0702099934', 'no.07, Variyapola ,Kurunagala', 'One Time', 'Partial', 'No', 2, 'Cash On Delivery', 'Online Banking', 'Revlimid (Multiple myeloma Myelodysplastic syndromes)	\r\nSeretide Advair (Asthma Chronic obstructive pulmonary disease)\r\nSuboxone (Pain; opioid addiction)\r\nAcetaminophen/hydrocodone (attention deficit hyperactivity disorder; narcolepsy)', '', '', '2022-05-21 19:02:18'),
(3, 'isuru madusanka', 'isuru@gmail.com', '0771886641', 'no.05, Walahanduwa, Galle', 'On Going', 'Partial', 'Yes', 6, 'Card Payment', 'Online Banking', 'Paullinia cupana 200 to 1600 mg of seed \r\nORAL (yoe-HIM-been)\r\nsodium chloride intranasal spray\r\nLantus Solostar (Diabetes mellitus type 1 and 2)\r\nOxyContin (Mon-20XX)\r\nLevemir(Diabetes mellitus type 1 and 2)\r\n', '', '', '2022-05-21 19:03:53'),
(4, 'bagya sewwandi', 'bagya@gmail.com', '0763988972', 'no 10, Ibbagamuwa, Kurunagala', 'On Going', 'Partial', 'No', 8, 'Cash On Delivery', 'Online Banking', '', 'Picture2.jpg', '', '2022-05-21 19:10:45'),
(5, 'sandani amasha', 'sandani@gmail.com', '0774749770', 'no 09, main street, Madampe', 'One Time', 'Full', 'Yes', 3, 'Card Payment', 'Cash', '', '', '', '2022-05-21 19:09:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`cmtID`);

--
-- Indexes for table `hmuser`
--
ALTER TABLE `hmuser`
  ADD PRIMARY KEY (`hmUID`),
  ADD UNIQUE KEY `eMailAddress` (`eMailAddress`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `pupload`
--
ALTER TABLE `pupload`
  ADD PRIMARY KEY (`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `cmtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hmuser`
--
ALTER TABLE `hmuser`
  MODIFY `hmUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pupload`
--
ALTER TABLE `pupload`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

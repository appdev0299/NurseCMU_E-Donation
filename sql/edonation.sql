-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 03:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edonation`
--

-- --------------------------------------------------------

--
-- Table structure for table `json_confirm`
--

CREATE TABLE `json_confirm` (
  `id` int(11) NOT NULL,
  `payeeProxyId` varchar(255) DEFAULT NULL,
  `payeeProxyType` varchar(255) DEFAULT NULL,
  `payeeAccountNumber` varchar(255) DEFAULT NULL,
  `payeeName` varchar(255) DEFAULT NULL,
  `payerAccountNumber` varchar(255) DEFAULT NULL,
  `payerAccountName` varchar(255) DEFAULT NULL,
  `payerName` varchar(255) DEFAULT NULL,
  `sendingBankCode` varchar(255) DEFAULT NULL,
  `receivingBankCode` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `transactionId` varchar(255) DEFAULT NULL,
  `transactionDateandTime` varchar(255) DEFAULT NULL,
  `billPaymentRef1` varchar(255) DEFAULT NULL,
  `billPaymentRef2` varchar(255) DEFAULT NULL,
  `currencyCode` varchar(255) DEFAULT NULL,
  `channelCode` varchar(255) DEFAULT NULL,
  `transactionType` varchar(255) DEFAULT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Organization` varchar(255) NOT NULL,
  `CMU_IT_Account` varchar(255) NOT NULL,
  `IT_Account_Type_EN` varchar(255) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pro_offline`
--

CREATE TABLE `pro_offline` (
  `id` int(11) NOT NULL,
  `edo_pro_id` varchar(10) NOT NULL,
  `edo_name` varchar(255) NOT NULL COMMENT 'ชื่อโครงการ',
  `edo_description` varchar(255) NOT NULL COMMENT 'ชื่อแสดงในใบเสร็จ',
  `edo_objective` varchar(255) NOT NULL COMMENT 'ชื่อแสดงในใบอนุโม',
  `edo_details` text NOT NULL COMMENT 'รายละเอียดโครงการแสดงหน้าเว็บ',
  `edo_details_objective1` text NOT NULL COMMENT 'วัตถุประสงค์แสดงหน้าเว็บ',
  `edo_details_objective2` text NOT NULL COMMENT 'วัตถุประสงค์แสดงหน้าเว็บ',
  `edo_details_objective3` text NOT NULL COMMENT 'วัตถุประสงค์แสดงหน้าเว็บ',
  `edo_details_objective4` text NOT NULL COMMENT 'วัตถุประสงค์แสดงหน้าเว็บ',
  `edo_tex` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL COMMENT 'รูปโครงการ',
  `img_banner` varchar(255) NOT NULL COMMENT 'รูปลดหย่อนในโครงการ',
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_offline`
--

INSERT INTO `pro_offline` (`id`, `edo_pro_id`, `edo_name`, `edo_description`, `edo_objective`, `edo_details`, `edo_details_objective1`, `edo_details_objective2`, `edo_details_objective3`, `edo_details_objective4`, `edo_tex`, `img_file`, `img_banner`, `dateCreate`) VALUES
(1, '121205', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ แต่ละปีมีนักศึกษาที่อยู่ระหว่างการศึกษาทุกระดับมากกว่า 1,500 คน คณะฯ ตระหนักถึงความสำคัญของการให้โอกาสทางการศึกษา และมุ่งหวังที่จะสนับสนุนและส่งเสริมให้นักศึกษาได้มีโอกาสเรียนรู้จนสำเร็จการศึกษาภายในระยะเวลาที่กำหนดไว้ในหลักสูตร โครงการนี้จัดตั้งขึ้นเพื่อมอบทุนการศึกษาแก่นักศึกษาพยาบาลทุกระดับที่ขาดแคลน ทุนทรัพย์ ให้สามารถจ่ายค่าธรรมเนียมการศึกษา ค่าที่พักอาศัย และค่าใช้จ่ายในการดำรงชีพ ซึ่งจะช่วยให้นักศึกษาได้ใช้เวลาในการศึกษาเล่าเรียนอย่างเต็มศักยภาพ รวมทั้งเป็นรางวัลสำหรับนักศึกษาผู้ที่มีผลการเรียนและผลการฝึกปฏิบัติยอดเยี่ยม  ดังนั้นเมื่อสำเร็จการศึกษา นักศึกษาจะได้นำความรู้และทักษะทางการพยาบาลมาช่วยเหลือดูแลผู้ป่วย ครอบครัว และสังคมต่อไป', 'โครงการทุนการศึกษาเพื่อนักศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', '', '', '', 'บริจาคเพื่อลดหย่อนภาษี 2 เท่า', 'DSC_2927.jpg', 'banner_tex2.jpg', '2023-11-10 04:21:50'),
(2, '121206', 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'คณะพยาบาลศาสตร์ มช. เปิดดำเนินการจัดการเรียนการสอนและได้ผลิตบัณฑิตคณะพยาบาลศาสตร์ ออกไปรับใช้สังคมทั้งไทยและต่างประเทศมามากกว่า 60 ปี ปัจจุบันคณะพยาบาลศาสตร์ มีอาคารเรียนทั้งหมด 4 อาคาร ในการดำเนินการตามพันธกิจของคณะฯ จำเป็นต้องมีการพัฒนาปรับปรุงห้องเรียน อาคารเรียน อาคารสถานที่ และสภาพแวดล้อมภูมิทัศน์อย่างต่อเนื่อง เพื่อให้อาคารสถานที่และสิ่งแวดล้อม สะอาด ร่มรื่น สวยงาม ปลอดภัย และมีบรรยากาศเอื้ออำนวยต่อการเรียนการสอนของอาจารย์ นักศึกษา บุคลากร และผู้รับบริการทุกกลุ่มมีความพึงพอใจ ', 'เพื่อจัดสร้างอาคารและปรับปรุงอาคารเรียน คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'เพื่อจัดหาวัสดุอุปกรณ์การศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', '', '', 'บริจาคเพื่อลดหย่อนภาษี 2 เท่า', 'DSC_2926.jpg', 'banner_tex2.jpg', '2023-09-27 04:32:56'),
(3, '121207', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ ที่ไม่ได้มุ่งหวังแค่การรักษาพยาบาลประชาชนเมื่อเจ็บป่วยเท่านั้น แต่มุ่งหวังให้ประชาชนมีสุขภาวะกายและจิตที่ดี ผ่านกระบวนการสร้างเสริมสุขภาพ ป้องกันโรค รักษาโรค และฟื้นฟูสภาพ คณะฯ ตระหนักถึงความยากลำบาก และความไม่เท่าเทียมกันของประชาชนในกลุ่มและพื้นที่ต่างๆ ที่ยังมีช่องว่างในการเข้าถึงบริการสาธารณสุขขั้นพื้นฐานที่มีคุณภาพ ดังนั้นคณะฯมีความมุ่งมั่นตั้งใจที่จะช่วยเหลือผู้ยากไร้ ผู้ด้อยโอกาสในสังคม ผู้ที่ขาดโอกาสในการเข้าถึงบริการสาธารณสุข ตลอดจนผู้ที่ขาดโอกาสด้านการศึกษาในสังคม โดยการรวบรวมเงินบริจาคเพื่อแบ่งปันเอื้ออาทร ช่วยเหลือซึ่งกันและกัน', 'บริจาคเพื่อผู้ยากไร้และผู้ด้อยโอกาสในสังคม', 'บริจาคเพื่อเพื่อนร่วมวิชาชีพพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่ ', 'บริจาคเพื่อสนับสนุนโครงการนักศึกษาพยาบาล มช. ส่งต่อความดีเพื่อสังคม', 'บริจาคเพื่อครอบครัวคณะพยาบาลศาสตร์ มช. ที่ประสบความเดือดร้อน', 'บริจาคเพื่อลดหย่อนภาษี 1 เท่า', 'DSC_8522.jpg', 'banner_tex1.jpg', '2023-11-10 04:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL,
  `ref1` varchar(255) NOT NULL,
  `id_receipt` varchar(255) DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  `name_title` varchar(20) NOT NULL COMMENT 'คำนำหน้า',
  `rec_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `rec_surname` varchar(255) NOT NULL COMMENT 'สกุล',
  `rec_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `rec_email` varchar(255) NOT NULL COMMENT 'เมล์',
  `rec_idname` varchar(255) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู๋',
  `road` varchar(255) NOT NULL COMMENT 'ถนน',
  `districts` varchar(255) NOT NULL COMMENT 'ตำบล',
  `amphures` varchar(255) NOT NULL COMMENT 'อำเภอ',
  `provinces` varchar(255) NOT NULL COMMENT 'จังหวัด',
  `zip_code` varchar(255) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `rec_date_s` varchar(55) NOT NULL COMMENT 'เวลารับเงิน',
  `rec_date_out` varchar(255) NOT NULL COMMENT 'เวลาออกใบเสร็จ',
  `amount` varchar(255) NOT NULL COMMENT 'จำนวนเงิน',
  `payby` varchar(255) NOT NULL COMMENT 'ชำระโดย',
  `edo_name` text NOT NULL COMMENT 'ชื่อโครงการ',
  `other_description` varchar(255) NOT NULL COMMENT 'สำหรับโครงการอื่นๆ',
  `edo_pro_id` varchar(255) NOT NULL COMMENT 'รหัสโครงการ',
  `edo_description` text NOT NULL COMMENT 'คำอธิบายโครงการ แสดงในใบเสร็จ',
  `edo_objective` text NOT NULL COMMENT 'วัตถุประสงค์ โครงการ แสดงในใบเสร็จ',
  `comment` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `status_donat` varchar(255) NOT NULL COMMENT 'บริจาคช่องทางไหน offline/online',
  `status_user` varchar(55) NOT NULL COMMENT 'person/corporation',
  `status_receipt` varchar(55) NOT NULL COMMENT 'รับใบเสร็จ/ไม่รับใบเสร็จ yes/no',
  `resDesc` varchar(255) NOT NULL COMMENT 'ตรวจสอบการชำระเงิน',
  `receipt_cc` varchar(255) NOT NULL,
  `pdflink` varchar(255) NOT NULL COMMENT 'ลิ้งใบเสร็จ',
  `id` int(11) NOT NULL,
  `rec_time` time DEFAULT curtime(),
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_2566`
--

CREATE TABLE `receipt_2566` (
  `receipt_id` int(11) NOT NULL,
  `ref1` varchar(255) NOT NULL,
  `id_receipt` varchar(255) DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  `name_title` varchar(20) NOT NULL COMMENT 'คำนำหน้า',
  `rec_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `rec_surname` varchar(255) NOT NULL COMMENT 'สกุล',
  `rec_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `rec_email` varchar(255) NOT NULL COMMENT 'เมล์',
  `rec_idname` varchar(255) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู๋',
  `road` varchar(255) NOT NULL COMMENT 'ถนน',
  `districts` varchar(255) NOT NULL COMMENT 'ตำบล',
  `amphures` varchar(255) NOT NULL COMMENT 'อำเภอ',
  `provinces` varchar(255) NOT NULL COMMENT 'จังหวัด',
  `zip_code` varchar(255) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `rec_date_s` varchar(55) NOT NULL COMMENT 'เวลารับเงิน',
  `rec_date_out` varchar(255) NOT NULL COMMENT 'เวลาออกใบเสร็จ',
  `amount` varchar(255) NOT NULL COMMENT 'จำนวนเงิน',
  `payby` varchar(255) NOT NULL COMMENT 'ชำระโดย',
  `edo_name` text NOT NULL COMMENT 'ชื่อโครงการ',
  `other_description` varchar(255) NOT NULL COMMENT 'สำหรับโครงการอื่นๆ',
  `edo_pro_id` varchar(255) NOT NULL COMMENT 'รหัสโครงการ',
  `edo_description` text NOT NULL COMMENT 'คำอธิบายโครงการ แสดงในใบเสร็จ',
  `edo_objective` text NOT NULL COMMENT 'วัตถุประสงค์ โครงการ แสดงในใบเสร็จ',
  `comment` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `status_donat` varchar(255) NOT NULL COMMENT 'บริจาคช่องทางไหน offline/online',
  `status_user` varchar(55) NOT NULL COMMENT 'person/corporation',
  `status_receipt` varchar(55) NOT NULL COMMENT 'รับใบเสร็จ/ไม่รับใบเสร็จ yes/no',
  `resDesc` varchar(255) NOT NULL COMMENT 'ตรวจสอบการชำระเงิน',
  `receipt_cc` varchar(255) NOT NULL,
  `pdflink` varchar(255) NOT NULL COMMENT 'ลิ้งใบเสร็จ',
  `id` int(11) NOT NULL,
  `rec_time` time DEFAULT curtime(),
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_offline`
--

CREATE TABLE `receipt_offline` (
  `id` int(11) NOT NULL,
  `ref1` varchar(255) NOT NULL,
  `id_receipt` varchar(255) DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  `name_title` varchar(20) NOT NULL COMMENT 'คำนำหน้า',
  `rec_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `rec_surname` varchar(255) NOT NULL COMMENT 'สกุล',
  `rec_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `rec_email` varchar(255) NOT NULL COMMENT 'เมล์',
  `rec_idname` varchar(255) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู๋',
  `road` varchar(255) NOT NULL COMMENT 'ถนน',
  `districts` varchar(255) NOT NULL COMMENT 'ตำบล',
  `amphures` varchar(255) NOT NULL COMMENT 'อำเภอ',
  `provinces` varchar(255) NOT NULL COMMENT 'จังหวัด',
  `zip_code` varchar(255) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `rec_date_s` varchar(55) NOT NULL COMMENT 'เวลารับเงิน',
  `rec_date_out` varchar(255) NOT NULL COMMENT 'เวลาออกใบเสร็จ',
  `amount` varchar(255) NOT NULL COMMENT 'จำนวนเงิน',
  `payby` varchar(255) NOT NULL COMMENT 'ชำระโดย',
  `edo_name` text NOT NULL COMMENT 'ชื่อโครงการ',
  `other_description` varchar(255) NOT NULL COMMENT 'สำหรับโครงการอื่นๆ',
  `edo_pro_id` varchar(255) NOT NULL COMMENT 'รหัสโครงการ',
  `edo_description` text NOT NULL COMMENT 'คำอธิบายโครงการ แสดงในใบเสร็จ',
  `edo_objective` text NOT NULL COMMENT 'วัตถุประสงค์ โครงการ แสดงในใบเสร็จ',
  `comment` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `status_donat` varchar(255) NOT NULL COMMENT 'บริจาคช่องทางไหน offline/online',
  `status_user` varchar(55) NOT NULL COMMENT 'person/corporation',
  `status_receipt` varchar(55) NOT NULL COMMENT 'รับใบเสร็จ/ไม่รับใบเสร็จ yes/no',
  `resDesc` varchar(255) NOT NULL COMMENT 'ตรวจสอบการชำระเงิน',
  `receipt_cc` varchar(255) NOT NULL,
  `pdflink` varchar(255) NOT NULL COMMENT 'ลิ้งใบเสร็จ',
  `rec_time` time DEFAULT curtime(),
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reg_login`
--

CREATE TABLE `reg_login` (
  `login_id` int(11) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `login_surname` varchar(255) NOT NULL,
  `login_department` varchar(255) NOT NULL,
  `login_cmuaccount` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `items` int(11) NOT NULL,
  `items_set` varchar(10) NOT NULL,
  `min` decimal(10,2) NOT NULL,
  `max` decimal(10,2) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `order_id` int(11) NOT NULL,
  `order_ref1` varchar(255) NOT NULL,
  `order_receipt` varchar(255) NOT NULL,
  `id` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `order_set` varchar(55) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_tel` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_description` varchar(255) NOT NULL,
  `status_order` varchar(55) NOT NULL,
  `user_order` varchar(255) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name_title` varchar(20) NOT NULL COMMENT 'คำนำหน้า',
  `rec_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `rec_surname` varchar(255) NOT NULL COMMENT 'สกุล',
  `rec_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `rec_email` varchar(255) NOT NULL COMMENT 'เมล์',
  `rec_idname` varchar(255) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู๋',
  `road` varchar(255) NOT NULL COMMENT 'ถนน',
  `districts` varchar(255) NOT NULL COMMENT 'ตำบล',
  `amphures` varchar(255) NOT NULL COMMENT 'อำเภอ',
  `provinces` varchar(255) NOT NULL COMMENT 'จังหวัด',
  `zip_code` varchar(255) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `status_donat` varchar(255) NOT NULL COMMENT 'บริจาคช่องทางไหน offline/online',
  `status_user` varchar(55) NOT NULL COMMENT 'person/corporation',
  `status_receipt` varchar(255) DEFAULT 'yes',
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `json_confirm`
--
ALTER TABLE `json_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_offline`
--
ALTER TABLE `pro_offline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `receipt_2566`
--
ALTER TABLE `receipt_2566`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `receipt_offline`
--
ALTER TABLE `receipt_offline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_login`
--
ALTER TABLE `reg_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `json_confirm`
--
ALTER TABLE `json_confirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `pro_offline`
--
ALTER TABLE `pro_offline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `receipt_2566`
--
ALTER TABLE `receipt_2566`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `receipt_offline`
--
ALTER TABLE `receipt_offline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `reg_login`
--
ALTER TABLE `reg_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

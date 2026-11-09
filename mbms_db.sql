-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 03:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL,
  `appointment_id` varchar(250) NOT NULL,
  `patient_name` varchar(250) NOT NULL,
  `appointment_type` varchar(20) NOT NULL,
  `m_phone` varchar(200) NOT NULL,
  `department` varchar(250) NOT NULL,
  `doctor` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Approved, 0=Declined, 2=Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`id`, `appointment_id`, `patient_name`, `appointment_type`, `m_phone`, `department`, `doctor`, `date`, `time`, `message`, `status`, `created_at`) VALUES
(57, 'APT-1', 'Karen Barrientos', 'Prenatal Checkup', '09499618163', '', '', '2024-11-09', '9:00 AM', 'Good day Karen Barrientos!\r\n\r\nYour prenatal checkup has been scheduled for 2024-11-09 at 9:00 AM. The attending midwife will be . Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-11-09 08:39:44'),
(58, 'APT-58', 'Karen Barrientos', 'Child Immunization', '09499618163', '', 'Jessica Doe', '2024-11-07', '9:00 AM', 'Good day Karen Barrientos!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-11-07 at 9:00 AM. The attending midwife will be Jessica Doe. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-10-19 04:05:48'),
(59, 'APT-59', 'Karen Barrientos', 'Child Immunization', '09499618163', '', 'Analyn Santos', '2024-10-19', '9:00 AM', 'Good day Karen Barrientos!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-10-19 at 9:00 AM. The attending midwife will be Analyn Santos. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-10-19 06:06:44'),
(60, 'APT-60', 'Karen Barrientos', 'Child Immunization', '09499618163', '', 'Analyn Santos', '2024-11-01', '9:03 AM', 'Good day Karen Barrientos!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-11-01 at 9:03 AM. The attending midwife will be Analyn Santos. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-10-31 01:56:51'),
(61, 'APT-61', 'Karen Barrientos', 'Child Immunization', '09664803348', '', 'Jessica Doe', '2024-12-26', '9:00 am', 'Good day Karen Barrientos!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-12-26 at 9:00 am. The attending midwife will be Jessica Doe. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-11-04 02:40:46'),
(63, 'APT-62', 'Malome Arboleda', 'Prenatal Checkup', '09618408316', '', 'Jessica Doe', '2024-11-12', '9:00 AM', 'Good day Malome Arboleda!\r\n\r\nYour prenatal checkup has been scheduled for 2024-11-12 at 9:00 AM. The attending midwife will be Jessica Doe. Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-11-05 02:45:15'),
(66, 'APT-64', 'Imee Salazar', 'Prenatal Checkup', '09499618163', '', 'Ma. Shanine Grace Ame', '2024-11-27', '9:00 AM', 'Good day Imee Salazar!\r\n\r\nYour prenatal checkup has been scheduled for 2024-11-27 at 9:00 AM. The attending midwife will be Ma. Shanine Grace Ame. Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 2, '2024-11-14 08:59:10'),
(67, 'APT-67', 'Dimelyn Villanueva', 'Prenatal Checkup', '09985511946', '', 'Ma. Shanine Grace Ame', '2024-11-28', '9:00 AM', 'Good day Dimelyn Villanueva!\r\n\r\nYour prenatal checkup has been scheduled for 2024-11-28 at 9:00 AM. The attending midwife will be Ma. Shanine Grace Ame. Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-11-14 09:01:31'),
(68, 'APT-68', 'Malome Arboleda', 'Prenatal Checkup', '09499618163', '', 'Ma. Shanine Grace Ame', '2025-01-30', '09:00', 'Good day Malome Arboleda!\r\n\r\nYour prenatal checkup has been scheduled for 2025-01-30 at 09:00. The attending midwife will be Ma. Shanine Grace Ame. Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-12-20 07:18:34'),
(69, 'APT-69', 'Anna Cruz', 'Prenatal Checkup', '09499618163', '', 'Ma. Shanine Grace Ame', '2024-12-12', '09:38', 'Good day Anna Cruz!\r\n\r\nYour prenatal checkup has been scheduled for 2024-12-12 at 09:38. The attending midwife will be Ma. Shanine Grace Ame. Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-12-14 15:47:01'),
(70, 'APT-70', 'Karen Barrientos', 'Prenatal Checkup', '09499618163', '', 'Ma. Shanine Grace Ame', '2025-01-02', '9:00 AM', 'Good day Karen Barrientos!\r\n\r\nYour prenatal checkup has been scheduled for 2025-01-02 at 9:00 AM. The attending midwife will be Ma. Shanine Grace Ame. Please make sure to arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-12-12 01:32:51'),
(71, 'APT-71', 'Anna Cruz', 'Child Immunization', '09499618163', '', 'Ma. Shanine Grace Ame', '2024-12-12', '9:41 AM', 'Good day Anna Cruz!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-12-12 at 9:41 AM. The attending midwife will be Ma. Shanine Grace Ame. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-12-12 01:41:11'),
(72, 'APT-72', 'Anna Cruz', 'Child Immunization', '09499618163', '', 'Ma. Shanine Grace Ame', '2024-12-12', '9:41 AM', 'Good day Anna Cruz!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-12-12 at 9:41 AM. The attending midwife will be Ma. Shanine Grace Ame. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 2, '2024-12-12 01:40:50'),
(74, 'APT-73', 'Karen Barrientos', 'Child Immunization', '09664803348', '', 'Ma. Shanine Grace Ame', '2024-12-31', '09:00', 'Good day Karen Barrientos!\r\n\r\nYour child\'s immunization appointment has been scheduled for 2024-12-31 at 09:00. The attending midwife will be Ma. Shanine Grace Ame. Please ensure to bring your child\'s immunization card and arrive 15 minutes early.\r\n\r\nThank you,\r\nLaguinbanua East Health Center', 1, '2024-12-20 07:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baby`
--

CREATE TABLE `tbl_baby` (
  `b_id` int(11) NOT NULL,
  `b_fname` varchar(200) DEFAULT NULL,
  `b_mname` varchar(200) DEFAULT NULL,
  `b_lname` varchar(200) DEFAULT NULL,
  `b_number` varchar(100) DEFAULT NULL,
  `b_mother` varchar(250) DEFAULT NULL,
  `b_father` varchar(250) DEFAULT NULL,
  `b_m_number` varchar(20) DEFAULT NULL,
  `b_dob` varchar(50) DEFAULT NULL,
  `b_sex` varchar(20) DEFAULT NULL,
  `b_bloodtype` varchar(10) DEFAULT NULL,
  `b_tod` varchar(50) DEFAULT NULL,
  `b_accurate` int(20) NOT NULL COMMENT '1=Yes, 0=No',
  `b_sotb` varchar(20) DEFAULT NULL,
  `b_nom` varchar(100) DEFAULT NULL,
  `b_bweight` varchar(20) DEFAULT NULL,
  `b_blength` varchar(20) DEFAULT NULL,
  `b_cheadsize` varchar(20) DEFAULT NULL,
  `b_cc` varchar(100) DEFAULT NULL,
  `b_hmcdyh` varchar(20) DEFAULT NULL,
  `b_dobr` varchar(50) DEFAULT NULL,
  `b_address` varchar(200) DEFAULT NULL,
  `b_list` varchar(250) DEFAULT NULL,
  `b_pic` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `baby_type` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_baby`
--

INSERT INTO `tbl_baby` (`b_id`, `b_fname`, `b_mname`, `b_lname`, `b_number`, `b_mother`, `b_father`, `b_m_number`, `b_dob`, `b_sex`, `b_bloodtype`, `b_tod`, `b_accurate`, `b_sotb`, `b_nom`, `b_bweight`, `b_blength`, `b_cheadsize`, `b_cc`, `b_hmcdyh`, `b_dobr`, `b_address`, `b_list`, `b_pic`, `created_at`, `baby_type`) VALUES
(19, 'Arn Kaylier', 'Barrientos', 'Firmanes', '6A3F', 'Karen Barrientos', 'Arnulfo Firmanes', 'NEZP', '21/09/2024', 'Male', '', 'CS', 1, '', '', '3.7', '54', '', '', '', '21/09/2024', 'Laguinbanua East, Numancia, Aklan', '', 'bab.jpg', '2024-11-08 06:01:23', 'Active'),
(20, 'Arnel John', '', 'Lima', 'D1RJ', 'Doreyna Lima', 'Seth  Lima', '5TNF', '01/11/2024', 'Male', 'B+', 'Normal', 1, 'Single', 'Ma. Shanine Ami', '', '', '', '', '', '', '', '', '', '2024-11-12 05:34:58', 'Active'),
(21, 'Lyka', 'Piano', 'Sabido', '94ES', 'Grace Piano', 'Jenesis Sabido', '9A8B', '09/10/2024', 'Female', 'A+', 'Caesarean', 1, 'Single', 'Ma. Shanine Ami', '', '', '', '', '', '', '', '', '', '2024-11-12 05:48:03', 'Active'),
(22, 'Angel', '', 'Cruz', 'X38M', 'Anna Cruz', ' ', 'EJIU', '26/10/2024', 'Female', 'B+', 'Normal', 1, '', 'Ma. Shanine Ami', '', '', '', '', '', '', '', '', '', '2024-11-13 15:06:46', 'Active'),
(23, 'Steven Blaise', 'Villanueva', 'Alvarez', 'DH6C', 'Dimelyn Villanueva', ' ', 'YCFP', '03/02/2024', 'Male', 'B+', 'Normal', 1, 'Single', '', '', '', '', '', '', '', '', '', '', '2024-11-13 16:00:46', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_name`, `description`, `status`, `created_at`) VALUES
(1, 'Dentists', 'Dentists', 1, '2023-05-05 16:50:33'),
(2, 'Neurology', 'Neurology', 1, '2023-05-05 16:50:49'),
(3, 'Opthalmology', 'Opthalmology', 1, '2023-05-05 16:51:28'),
(4, 'ENT', 'ENT', 1, '2023-05-05 18:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `new_password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `bio` text NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `joining_date` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL COMMENT '1=Admin, 2=Midwife, 3=Staff',
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `last_name`, `username`, `emailid`, `password`, `new_password`, `confirm_password`, `dob`, `gender`, `address`, `bio`, `employee_id`, `joining_date`, `phone`, `role`, `status`, `created_at`, `pic`) VALUES
(1, '', '', 'admin', 'admin@mbssr.com', 'admin', '', '', '27/10/2024', '', '', '', '', '', '', '1', 1, '2024-12-14 16:07:17', ''),
(10, 'John', 'Dela Cruz', 'staff', 'staff@gmail.com', 'staff', '', '', '21/05/2000', 'Male', 'Numancia, Aklan', 'Staff', '3', '31/08/2024', '0926261234', '3', 1, '2024-11-08 03:23:56', ''),
(14, 'Mande', 'Arevalo', 'mande', 'mandearevalo@gmail.com', 'mande', '', '', '13/07/2003', 'Female', 'Kalibo, Aklan', 'Staff', '003', '27/10/2024', '0949961816', '1', 1, '2024-12-14 15:56:44', 'pitsyur.jpg'),
(16, 'Ma. Shanine Grace', 'Ame', 'midwife', 'shaninegrace.ame@gmail.com', 'Midwife', '', '', '21/06/2001', 'Female', 'Altavas, Aklan', 'RHMPP-RS', '0021', '06/11/2024', '0949961816', '2', 1, '2024-11-06 07:50:15', '462555236_1735727447216735_8620588071157744744_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_experience`
--

CREATE TABLE `tbl_experience` (
  `e_id` int(11) NOT NULL,
  `e_name` varchar(250) DEFAULT NULL,
  `e_number` varchar(50) DEFAULT NULL,
  `dod1` varchar(5) DEFAULT NULL,
  `dod2` varchar(5) DEFAULT NULL,
  `dod3` varchar(5) DEFAULT NULL,
  `dod4` varchar(5) DEFAULT NULL,
  `dod5` varchar(5) DEFAULT NULL,
  `dod6` varchar(5) DEFAULT NULL,
  `normal` varchar(200) DEFAULT NULL,
  `cs1` varchar(5) DEFAULT NULL,
  `n2` varchar(5) DEFAULT NULL,
  `cs2` varchar(5) DEFAULT NULL,
  `n3` varchar(5) DEFAULT NULL,
  `cs3` varchar(5) DEFAULT NULL,
  `n4` varchar(5) DEFAULT NULL,
  `cs4` varchar(5) DEFAULT NULL,
  `n5` varchar(5) DEFAULT NULL,
  `cs5` varchar(5) DEFAULT NULL,
  `n6` varchar(5) DEFAULT NULL,
  `cs6` varchar(5) DEFAULT NULL,
  `ali1` varchar(5) DEFAULT NULL,
  `mis1` varchar(5) DEFAULT NULL,
  `sti1` varchar(5) DEFAULT NULL,
  `ali2` varchar(5) DEFAULT NULL,
  `mis2` varchar(5) DEFAULT NULL,
  `sti2` varchar(5) DEFAULT NULL,
  `ali3` varchar(5) DEFAULT NULL,
  `mis3` varchar(5) DEFAULT NULL,
  `sti3` varchar(5) DEFAULT NULL,
  `ali4` varchar(5) DEFAULT NULL,
  `mis4` varchar(5) DEFAULT NULL,
  `sti4` varchar(5) DEFAULT NULL,
  `ali5` varchar(5) DEFAULT NULL,
  `mis5` varchar(5) DEFAULT NULL,
  `sti5` varchar(5) DEFAULT NULL,
  `ali6` varchar(5) DEFAULT NULL,
  `mis6` varchar(5) DEFAULT NULL,
  `sti6` varchar(5) DEFAULT NULL,
  `sin1` varchar(5) DEFAULT NULL,
  `twi1` varchar(5) DEFAULT NULL,
  `mul1` varchar(5) DEFAULT NULL,
  `sin2` varchar(5) DEFAULT NULL,
  `twi2` varchar(5) DEFAULT NULL,
  `mul2` varchar(5) DEFAULT NULL,
  `sin3` varchar(5) DEFAULT NULL,
  `twi3` varchar(5) DEFAULT NULL,
  `mul3` varchar(5) DEFAULT NULL,
  `sin4` varchar(5) DEFAULT NULL,
  `twi4` varchar(5) DEFAULT NULL,
  `mul4` varchar(5) DEFAULT NULL,
  `sin5` varchar(5) DEFAULT NULL,
  `twi5` varchar(5) DEFAULT NULL,
  `mul5` varchar(5) DEFAULT NULL,
  `sin6` varchar(5) DEFAULT NULL,
  `twi6` varchar(5) DEFAULT NULL,
  `mul6` varchar(5) DEFAULT NULL,
  `pih1` varchar(5) DEFAULT NULL,
  `pee1` varchar(5) DEFAULT NULL,
  `bl1` varchar(5) DEFAULT NULL,
  `pih2` varchar(5) DEFAULT NULL,
  `pee2` varchar(5) DEFAULT NULL,
  `bl2` varchar(5) DEFAULT NULL,
  `pih3` varchar(5) DEFAULT NULL,
  `pee3` varchar(5) DEFAULT NULL,
  `bl3` varchar(5) DEFAULT NULL,
  `pih4` varchar(5) DEFAULT NULL,
  `pee4` varchar(5) DEFAULT NULL,
  `bl4` varchar(5) DEFAULT NULL,
  `pih5` varchar(5) DEFAULT NULL,
  `pee5` varchar(5) DEFAULT NULL,
  `bl5` varchar(5) DEFAULT NULL,
  `pih6` varchar(5) DEFAULT NULL,
  `pee6` varchar(5) DEFAULT NULL,
  `bl6` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_experiences`
--

CREATE TABLE `tbl_experiences` (
  `e_id` int(11) NOT NULL,
  `e_name` varchar(255) NOT NULL,
  `e_m_number` varchar(10) NOT NULL,
  `e_number` varchar(10) NOT NULL,
  `pregnancy_1_dod` date DEFAULT NULL,
  `pregnancy_2_dod` date DEFAULT NULL,
  `pregnancy_3_dod` date DEFAULT NULL,
  `pregnancy_4_dod` date DEFAULT NULL,
  `pregnancy_5_dod` date DEFAULT NULL,
  `pregnancy_6_dod` date DEFAULT NULL,
  `pregnancy_1_tod_normal` tinyint(1) DEFAULT NULL,
  `pregnancy_2_tod_normal` tinyint(1) DEFAULT NULL,
  `pregnancy_3_tod_normal` tinyint(1) DEFAULT NULL,
  `pregnancy_4_tod_normal` tinyint(1) DEFAULT NULL,
  `pregnancy_5_tod_normal` tinyint(1) DEFAULT NULL,
  `pregnancy_6_tod_normal` tinyint(1) DEFAULT NULL,
  `pregnancy_1_tod_cs` tinyint(1) DEFAULT NULL,
  `pregnancy_2_tod_cs` tinyint(1) DEFAULT NULL,
  `pregnancy_3_tod_cs` tinyint(1) DEFAULT NULL,
  `pregnancy_4_tod_cs` tinyint(1) DEFAULT NULL,
  `pregnancy_5_tod_cs` tinyint(1) DEFAULT NULL,
  `pregnancy_6_tod_cs` tinyint(1) DEFAULT NULL,
  `pregnancy_1_birth_outcome_alive` tinyint(1) DEFAULT NULL,
  `pregnancy_2_birth_outcome_alive` tinyint(1) DEFAULT NULL,
  `pregnancy_3_birth_outcome_alive` tinyint(1) DEFAULT NULL,
  `pregnancy_4_birth_outcome_alive` tinyint(1) DEFAULT NULL,
  `pregnancy_5_birth_outcome_alive` tinyint(1) DEFAULT NULL,
  `pregnancy_6_birth_outcome_alive` tinyint(1) DEFAULT NULL,
  `pregnancy_1_birth_outcome_miscarriage` tinyint(1) DEFAULT NULL,
  `pregnancy_2_birth_outcome_miscarriage` tinyint(1) DEFAULT NULL,
  `pregnancy_3_birth_outcome_miscarriage` tinyint(1) DEFAULT NULL,
  `pregnancy_4_birth_outcome_miscarriage` tinyint(1) DEFAULT NULL,
  `pregnancy_5_birth_outcome_miscarriage` tinyint(1) DEFAULT NULL,
  `pregnancy_6_birth_outcome_miscarriage` tinyint(1) DEFAULT NULL,
  `pregnancy_1_birth_outcome_stillbirth` tinyint(1) DEFAULT NULL,
  `pregnancy_2_birth_outcome_stillbirth` tinyint(1) DEFAULT NULL,
  `pregnancy_3_birth_outcome_stillbirth` tinyint(1) DEFAULT NULL,
  `pregnancy_4_birth_outcome_stillbirth` tinyint(1) DEFAULT NULL,
  `pregnancy_5_birth_outcome_stillbirth` tinyint(1) DEFAULT NULL,
  `pregnancy_6_birth_outcome_stillbirth` tinyint(1) DEFAULT NULL,
  `pregnancy_1_children_single` tinyint(1) DEFAULT NULL,
  `pregnancy_2_children_single` tinyint(1) DEFAULT NULL,
  `pregnancy_3_children_single` tinyint(1) DEFAULT NULL,
  `pregnancy_4_children_single` tinyint(1) DEFAULT NULL,
  `pregnancy_5_children_single` tinyint(1) DEFAULT NULL,
  `pregnancy_6_children_single` tinyint(1) DEFAULT NULL,
  `pregnancy_1_children_twin` tinyint(1) DEFAULT NULL,
  `pregnancy_2_children_twin` tinyint(1) DEFAULT NULL,
  `pregnancy_3_children_twin` tinyint(1) DEFAULT NULL,
  `pregnancy_4_children_twin` tinyint(1) DEFAULT NULL,
  `pregnancy_5_children_twin` tinyint(1) DEFAULT NULL,
  `pregnancy_6_children_twin` tinyint(1) DEFAULT NULL,
  `pregnancy_1_children_multiple` tinyint(1) DEFAULT NULL,
  `pregnancy_2_children_multiple` tinyint(1) DEFAULT NULL,
  `pregnancy_3_children_multiple` tinyint(1) DEFAULT NULL,
  `pregnancy_4_children_multiple` tinyint(1) DEFAULT NULL,
  `pregnancy_5_children_multiple` tinyint(1) DEFAULT NULL,
  `pregnancy_6_children_multiple` tinyint(1) DEFAULT NULL,
  `pregnancy_1_conditions_pih` varchar(5) DEFAULT NULL,
  `pregnancy_2_conditions_pih` varchar(5) DEFAULT NULL,
  `pregnancy_3_conditions_pih` varchar(5) DEFAULT NULL,
  `pregnancy_4_conditions_pih` varchar(5) DEFAULT NULL,
  `pregnancy_5_conditions_pih` varchar(5) DEFAULT NULL,
  `pregnancy_6_conditions_pih` varchar(5) DEFAULT NULL,
  `pregnancy_1_conditions_pe` varchar(5) DEFAULT NULL,
  `pregnancy_2_conditions_pe` varchar(5) DEFAULT NULL,
  `pregnancy_3_conditions_pe` varchar(5) DEFAULT NULL,
  `pregnancy_4_conditions_pe` varchar(5) DEFAULT NULL,
  `pregnancy_5_conditions_pe` varchar(5) DEFAULT NULL,
  `pregnancy_6_conditions_pe` varchar(5) DEFAULT NULL,
  `pregnancy_1_conditions_bleeding` varchar(5) DEFAULT NULL,
  `pregnancy_2_conditions_bleeding` varchar(5) DEFAULT NULL,
  `pregnancy_3_conditions_bleeding` varchar(5) DEFAULT NULL,
  `pregnancy_4_conditions_bleeding` varchar(5) DEFAULT NULL,
  `pregnancy_5_conditions_bleeding` varchar(5) DEFAULT NULL,
  `pregnancy_6_conditions_bleeding` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_experiences`
--

INSERT INTO `tbl_experiences` (`e_id`, `e_name`, `e_m_number`, `e_number`, `pregnancy_1_dod`, `pregnancy_2_dod`, `pregnancy_3_dod`, `pregnancy_4_dod`, `pregnancy_5_dod`, `pregnancy_6_dod`, `pregnancy_1_tod_normal`, `pregnancy_2_tod_normal`, `pregnancy_3_tod_normal`, `pregnancy_4_tod_normal`, `pregnancy_5_tod_normal`, `pregnancy_6_tod_normal`, `pregnancy_1_tod_cs`, `pregnancy_2_tod_cs`, `pregnancy_3_tod_cs`, `pregnancy_4_tod_cs`, `pregnancy_5_tod_cs`, `pregnancy_6_tod_cs`, `pregnancy_1_birth_outcome_alive`, `pregnancy_2_birth_outcome_alive`, `pregnancy_3_birth_outcome_alive`, `pregnancy_4_birth_outcome_alive`, `pregnancy_5_birth_outcome_alive`, `pregnancy_6_birth_outcome_alive`, `pregnancy_1_birth_outcome_miscarriage`, `pregnancy_2_birth_outcome_miscarriage`, `pregnancy_3_birth_outcome_miscarriage`, `pregnancy_4_birth_outcome_miscarriage`, `pregnancy_5_birth_outcome_miscarriage`, `pregnancy_6_birth_outcome_miscarriage`, `pregnancy_1_birth_outcome_stillbirth`, `pregnancy_2_birth_outcome_stillbirth`, `pregnancy_3_birth_outcome_stillbirth`, `pregnancy_4_birth_outcome_stillbirth`, `pregnancy_5_birth_outcome_stillbirth`, `pregnancy_6_birth_outcome_stillbirth`, `pregnancy_1_children_single`, `pregnancy_2_children_single`, `pregnancy_3_children_single`, `pregnancy_4_children_single`, `pregnancy_5_children_single`, `pregnancy_6_children_single`, `pregnancy_1_children_twin`, `pregnancy_2_children_twin`, `pregnancy_3_children_twin`, `pregnancy_4_children_twin`, `pregnancy_5_children_twin`, `pregnancy_6_children_twin`, `pregnancy_1_children_multiple`, `pregnancy_2_children_multiple`, `pregnancy_3_children_multiple`, `pregnancy_4_children_multiple`, `pregnancy_5_children_multiple`, `pregnancy_6_children_multiple`, `pregnancy_1_conditions_pih`, `pregnancy_2_conditions_pih`, `pregnancy_3_conditions_pih`, `pregnancy_4_conditions_pih`, `pregnancy_5_conditions_pih`, `pregnancy_6_conditions_pih`, `pregnancy_1_conditions_pe`, `pregnancy_2_conditions_pe`, `pregnancy_3_conditions_pe`, `pregnancy_4_conditions_pe`, `pregnancy_5_conditions_pe`, `pregnancy_6_conditions_pe`, `pregnancy_1_conditions_bleeding`, `pregnancy_2_conditions_bleeding`, `pregnancy_3_conditions_bleeding`, `pregnancy_4_conditions_bleeding`, `pregnancy_5_conditions_bleeding`, `pregnancy_6_conditions_bleeding`) VALUES
(17, 'LNEH', '', '', '1999-11-08', '2001-07-29', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'N', 'N', '', '', '', '', 'N', 'N', '', '', '', '', 'N', 'N', '', '', '', ''),
(18, 'YCFP', '', '4ALW', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'N', 'N', '', '', '', '', 'N', 'N', '', '', '', '', 'N', 'N', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_first_trimester`
--

CREATE TABLE `tbl_first_trimester` (
  `first_id` int(11) NOT NULL,
  `first_m_name` varchar(200) DEFAULT NULL,
  `first_m_age` int(11) DEFAULT NULL,
  `first_m_number` varchar(200) DEFAULT NULL,
  `first_number` varchar(200) DEFAULT NULL,
  `first_date` date DEFAULT NULL,
  `first_weight` varchar(200) DEFAULT NULL,
  `first_height` varchar(200) DEFAULT NULL,
  `first_aog` varchar(200) DEFAULT NULL,
  `first_bp` varchar(200) DEFAULT NULL,
  `first_nutrition` varchar(200) DEFAULT NULL,
  `first_examine` longtext DEFAULT NULL,
  `first_p` longtext DEFAULT NULL,
  `first_cotbp` varchar(200) DEFAULT NULL,
  `first_dental` longtext DEFAULT NULL,
  `first_ltd` longtext DEFAULT NULL,
  `first_hc` varchar(200) DEFAULT NULL,
  `first_u` varchar(200) DEFAULT NULL,
  `first_cbc` varchar(200) DEFAULT NULL,
  `first_stis` varchar(200) DEFAULT NULL,
  `first_stool` varchar(200) DEFAULT NULL,
  `first_aaw` varchar(200) DEFAULT NULL,
  `first_tcvdg` varchar(200) DEFAULT NULL,
  `first_treatments` varchar(200) DEFAULT NULL,
  `first_dsp` varchar(200) DEFAULT NULL,
  `first_donc` varchar(200) DEFAULT NULL,
  `first_noh` varchar(200) DEFAULT NULL,
  `first_hr` varchar(200) DEFAULT NULL,
  `second_date` date DEFAULT NULL,
  `second_w` varchar(200) DEFAULT NULL,
  `second_h` varchar(200) DEFAULT NULL,
  `second_age` varchar(200) DEFAULT NULL,
  `second_bp` varchar(200) DEFAULT NULL,
  `second_ns` varchar(200) DEFAULT NULL,
  `second_examine` longtext DEFAULT NULL,
  `second_pres` longtext DEFAULT NULL,
  `second_changes` varchar(200) DEFAULT NULL,
  `second_dental` longtext DEFAULT NULL,
  `second_ltd` varchar(200) DEFAULT NULL,
  `second_hc` varchar(200) DEFAULT NULL,
  `second_u` varchar(200) DEFAULT NULL,
  `second_cbc` varchar(200) DEFAULT NULL,
  `second_stis` varchar(200) DEFAULT NULL,
  `second_stool` varchar(200) DEFAULT NULL,
  `second_aaw` varchar(200) DEFAULT NULL,
  `second_tcvdg` varchar(200) DEFAULT NULL,
  `second_treatments` varchar(200) DEFAULT NULL,
  `second_dsp` varchar(200) DEFAULT NULL,
  `second_donc` varchar(200) DEFAULT NULL,
  `second_noh` varchar(200) DEFAULT NULL,
  `second_hr` varchar(200) DEFAULT NULL,
  `third_date` date DEFAULT NULL,
  `third_w` varchar(200) DEFAULT NULL,
  `third_h` varchar(200) DEFAULT NULL,
  `third_aog` varchar(200) DEFAULT NULL,
  `third_bp` varchar(200) DEFAULT NULL,
  `third_ns` varchar(200) DEFAULT NULL,
  `third_examine` longtext DEFAULT NULL,
  `third_pres` longtext DEFAULT NULL,
  `third_changes` varchar(200) DEFAULT NULL,
  `third_dental` longtext DEFAULT NULL,
  `third_ltd` varchar(200) DEFAULT NULL,
  `third_hc` varchar(200) DEFAULT NULL,
  `third_u` varchar(200) DEFAULT NULL,
  `third_cbc` varchar(200) DEFAULT NULL,
  `third_STIs` varchar(200) DEFAULT NULL,
  `third_stool` varchar(200) DEFAULT NULL,
  `third_aaw` varchar(200) DEFAULT NULL,
  `third_tcvdg` varchar(200) DEFAULT NULL,
  `third_treatments` varchar(200) DEFAULT NULL,
  `third_dsp` varchar(200) DEFAULT NULL,
  `third_donc` varchar(200) DEFAULT NULL,
  `third_noh` varchar(200) DEFAULT NULL,
  `third_hr` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `tbl_first_trimester`
--

INSERT INTO `tbl_first_trimester` (`first_id`, `first_m_name`, `first_m_age`, `first_m_number`, `first_number`, `first_date`, `first_weight`, `first_height`, `first_aog`, `first_bp`, `first_nutrition`, `first_examine`, `first_p`, `first_cotbp`, `first_dental`, `first_ltd`, `first_hc`, `first_u`, `first_cbc`, `first_stis`, `first_stool`, `first_aaw`, `first_tcvdg`, `first_treatments`, `first_dsp`, `first_donc`, `first_noh`, `first_hr`, `second_date`, `second_w`, `second_h`, `second_age`, `second_bp`, `second_ns`, `second_examine`, `second_pres`, `second_changes`, `second_dental`, `second_ltd`, `second_hc`, `second_u`, `second_cbc`, `second_stis`, `second_stool`, `second_aaw`, `second_tcvdg`, `second_treatments`, `second_dsp`, `second_donc`, `second_noh`, `second_hr`, `third_date`, `third_w`, `third_h`, `third_aog`, `third_bp`, `third_ns`, `third_examine`, `third_pres`, `third_changes`, `third_dental`, `third_ltd`, `third_hc`, `third_u`, `third_cbc`, `third_STIs`, `third_stool`, `third_aaw`, `third_tcvdg`, `third_treatments`, `third_dsp`, `third_donc`, `third_noh`, `third_hr`, `created_at`) VALUES
(28, 'Karen Barrientos', 20, 'NEZP', '', '2024-10-13', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2024-11-15', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-19 06:46:29'),
(29, 'Malome Arboleda', 46, 'LNEH', 'GAY3', '2002-10-09', '75kg', '166', '24', '', 'Normal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-04 03:30:34'),
(30, 'April Joy  Mationg', 25, 'JONZ', '4SY0', '2024-06-11', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-08 05:17:21'),
(31, 'Jonnie Ann Illazar', 44, '4EXU', 'GQJK', '2024-01-29', '45', '154', '44', '120/80', 'Normal', '', '', '', '', '', '', '', '', 'Syphilis', '', '', '', 'Syphilis', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-11 14:31:18'),
(32, 'Jonah Ann', 36, 'DANK', 'PFBM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-11 14:36:21'),
(33, 'Anna Cruz', 23, 'EJIU', '', '2024-08-01', '45', '162', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-25 02:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_immunization`
--

CREATE TABLE `tbl_immunization` (
  `i_id` int(11) NOT NULL,
  `i_name` varchar(250) DEFAULT NULL,
  `i_gender` varchar(20) DEFAULT NULL,
  `i_number` varchar(10) DEFAULT NULL,
  `i_bcg_d1` date DEFAULT NULL,
  `i_bcg_rem` varchar(100) DEFAULT NULL,
  `i_hep_d1` date DEFAULT NULL,
  `i_hep_rem` varchar(100) DEFAULT NULL,
  `i_dpt_d1` date DEFAULT NULL,
  `i_dpt_rem1` varchar(100) DEFAULT NULL,
  `i_dpt_d2` date DEFAULT NULL,
  `i_dpt_rem2` varchar(100) DEFAULT NULL,
  `i_dpt_d3` date DEFAULT NULL,
  `i_dpt_rem3` varchar(100) DEFAULT NULL,
  `i_opv_d1` date DEFAULT NULL,
  `i_opv_rem1` varchar(100) DEFAULT NULL,
  `i_opv_d2` date DEFAULT NULL,
  `i_opv_rem2` varchar(100) DEFAULT NULL,
  `i_opv_d3` date DEFAULT NULL,
  `i_opv_rem3` varchar(100) DEFAULT NULL,
  `i_ipv_d1` date DEFAULT NULL,
  `i_ipv_rem` varchar(100) DEFAULT NULL,
  `i_pcv_d1` date DEFAULT NULL,
  `i_pcv_rem1` varchar(100) DEFAULT NULL,
  `i_pcv_d2` date DEFAULT NULL,
  `i_pcv_rem2` varchar(100) DEFAULT NULL,
  `i_pcv_d3` date DEFAULT NULL,
  `i_pcv_rem3` varchar(100) DEFAULT NULL,
  `i_mmr_d1` date DEFAULT NULL,
  `i_mmr_rem1` varchar(100) DEFAULT NULL,
  `i_mmr_d2` date DEFAULT NULL,
  `i_mmr_rem2` varchar(100) DEFAULT NULL,
  `i_other_name1` varchar(100) DEFAULT NULL,
  `i_other_d1` date DEFAULT NULL,
  `i_other_rem1` varchar(100) DEFAULT NULL,
  `i_other_name2` varchar(100) DEFAULT NULL,
  `i_other_d2` date DEFAULT NULL,
  `i_other_rem2` varchar(100) DEFAULT NULL,
  `stat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_immunization`
--

INSERT INTO `tbl_immunization` (`i_id`, `i_name`, `i_gender`, `i_number`, `i_bcg_d1`, `i_bcg_rem`, `i_hep_d1`, `i_hep_rem`, `i_dpt_d1`, `i_dpt_rem1`, `i_dpt_d2`, `i_dpt_rem2`, `i_dpt_d3`, `i_dpt_rem3`, `i_opv_d1`, `i_opv_rem1`, `i_opv_d2`, `i_opv_rem2`, `i_opv_d3`, `i_opv_rem3`, `i_ipv_d1`, `i_ipv_rem`, `i_pcv_d1`, `i_pcv_rem1`, `i_pcv_d2`, `i_pcv_rem2`, `i_pcv_d3`, `i_pcv_rem3`, `i_mmr_d1`, `i_mmr_rem1`, `i_mmr_d2`, `i_mmr_rem2`, `i_other_name1`, `i_other_d1`, `i_other_rem1`, `i_other_name2`, `i_other_d2`, `i_other_rem2`, `stat`) VALUES
(49, 'Arn Kaylier Firmanes', 'Male', 'MS3X', '2024-09-21', '', '2024-09-21', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', 'Vitamin K', '2024-09-21', '', '', NULL, '', 'Active'),
(50, 'Arnel John Lima', 'Male', 'G45L', '2024-11-01', '', '2024-11-04', '', '2024-11-06', '', NULL, '', NULL, '', '2024-11-08', '', NULL, '', NULL, '', '2024-11-10', '', '2024-11-06', '', NULL, '', NULL, '', '2024-11-06', '', NULL, '', 'Vit K', '2024-11-04', '', '', NULL, '', 'Active'),
(51, 'Lyka Sabido', 'Female', 'GC7A', '2024-10-09', '', '2024-10-09', '', '2024-10-09', '', NULL, '', NULL, '', '2024-12-10', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', 'Vit K', '2024-10-09', '', '', NULL, '', 'Active'),
(52, 'Angel Cruz', 'Female', '4WVP', '2024-10-26', '', '2024-10-27', '', '2024-10-27', '', NULL, '', NULL, '', '2024-10-27', '', NULL, '', NULL, '', NULL, '', '2024-10-27', '', NULL, '', NULL, '', '2024-10-26', '', NULL, '', '', NULL, '', '', NULL, '', 'Active'),
(53, 'Steven Blaise Alvarez', 'Male', 'RFSB', '2024-02-05', '', '2024-02-05', '', '2024-03-25', '', '2024-04-22', '', '2024-05-27', '', '2024-03-25', '', '2024-04-22', '', '2024-05-27', '', '2024-05-22', '', '2024-03-25', '', '2024-04-22', '', '2024-05-27', '', '2024-11-11', '', NULL, '', 'Vit K', '2024-02-03', '', '', NULL, '', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_other`
--

CREATE TABLE `tbl_other` (
  `o_id` int(11) NOT NULL,
  `o_name` varchar(250) DEFAULT NULL,
  `o_m_number` varchar(20) DEFAULT NULL,
  `o_number` varchar(50) DEFAULT NULL,
  `aap` varchar(250) DEFAULT NULL,
  `aam` varchar(250) DEFAULT NULL,
  `paf` varchar(5) NOT NULL COMMENT '1=Oo,\r\n0=Hindi',
  `pm` varchar(5) NOT NULL COMMENT '1=Oo, 0=Hindi	',
  `nbp` varchar(200) DEFAULT NULL,
  `pay` varchar(15) NOT NULL COMMENT '1=Cash, 2=PhilHealth, 3=Insurance',
  `veh` varchar(30) DEFAULT NULL,
  `dname` varchar(250) DEFAULT NULL,
  `dnum` varchar(20) DEFAULT NULL,
  `bhwname` varchar(250) DEFAULT NULL,
  `bhwnum` varchar(20) DEFAULT NULL,
  `tname` varchar(250) DEFAULT NULL,
  `tnum` varchar(20) DEFAULT NULL,
  `ename` varchar(250) DEFAULT NULL,
  `enum` varchar(20) DEFAULT NULL,
  `edd` varchar(250) DEFAULT NULL,
  `emername1` varchar(250) DEFAULT NULL,
  `emernum1` varchar(20) DEFAULT NULL,
  `emeradd1` varchar(250) DEFAULT NULL,
  `emername2` varchar(250) DEFAULT NULL,
  `emernum2` varchar(20) DEFAULT NULL,
  `emeradd2` varchar(250) DEFAULT NULL,
  `emername3` varchar(250) DEFAULT NULL,
  `emernum3` varchar(20) DEFAULT NULL,
  `emeradd3` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_other`
--

INSERT INTO `tbl_other` (`o_id`, `o_name`, `o_m_number`, `o_number`, `aap`, `aam`, `paf`, `pm`, `nbp`, `pay`, `veh`, `dname`, `dnum`, `bhwname`, `bhwnum`, `tname`, `tnum`, `ename`, `enum`, `edd`, `emername1`, `emernum1`, `emeradd1`, `emername2`, `emernum2`, `emeradd2`, `emername3`, `emernum3`, `emeradd3`) VALUES
(32, 'NEZP', '', '5RQF', 'Midwife', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(33, 'JY9H', '', 'TAKP', '', '', 'on', 'on', '', '', '', '', '', '', '', '', '', 'Jayson A. Mabansag', '', '', '', '', '', '', '', '', '', '', ''),
(34, 'DANK', '', '6BGS', '', '', 'on', 'on', '', '', '', '', '', '', '', '', '', 'Rolena L. Zarsa', '09281198513', '', '', '', '', '', '', '', '', '', ''),
(35, '5TNF', '', 'GKID', '', '', 'on', 'on', '', '', '', '', '', '', '', '', '', 'Seth A. Lima', '09459154055', '', '', '', '', '', '', '', '', '', ''),
(36, 'NUKW', '', 'BUPN', '', 'DRSTMH', 'on', 'on', '', 'on', 'Tricycle', 'Mike Lachica', '', 'Angelito Villaruel', '', '', '', 'Angelito Villaruel', '09270273535', '', '', '', '', '', '', '', '', '', ''),
(37, '9A8B', '', 'RY8I', '', '', 'on', 'on', '', '', '', '', '', '', '', '', '', 'Rosalie Piano', '09811218159', '', '', '', '', '', '', '', '', '', ''),
(38, 'I2VO', '', '1CEL', '', '', 'on', 'on', '', '', '', '', '', '', '', '', '', 'Ramy Sarandin', '09488979374', '', '', '', '', '', '', '', '', '', ''),
(39, 'IN6X', '', 'JX82', '', 'DRSTMH', 'on', '', '', 'on', 'Tricycle', '', '', 'Husband', '', '', '', 'Ariel Antonio', '09480792785', '', '', '', '', '', '', '', '', '', ''),
(40, 'YCFP', '', 'RUPS', 'Doctor', 'DRSTMH', 'on', 'on', '5,000', 'on', 'Tricycle', 'Jaime Villanueva', '', '', '', 'Lovely Villanueva', '', 'Ritchel John Alvarez', '', '', 'Ritchel John Alvarez', '', 'Laguinbanua East, Numancia, Aklan', 'Aireen Villanueva', '', 'Libacao, Aklan', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `patient_type` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`id`, `first_name`, `last_name`, `email`, `dob`, `gender`, `patient_type`, `address`, `phone`, `status`, `created_at`) VALUES
(1, 'Paul', 'Smith', 'paul@abc.com', '24/04/1991', 'Male', 'InPatient', 'USA', '1234567890', 1, '2023-05-05 18:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `id` int(11) NOT NULL,
  `m_first_name` varchar(250) DEFAULT NULL,
  `m_middle_name` varchar(250) DEFAULT NULL,
  `m_last_name` varchar(250) DEFAULT NULL,
  `m_phone` varchar(20) DEFAULT NULL,
  `m_landline` varchar(30) DEFAULT NULL,
  `m_dob` varchar(250) DEFAULT NULL,
  `m_type_blood` varchar(20) DEFAULT NULL,
  `m_occupation` varchar(250) DEFAULT NULL,
  `m_number` varchar(250) DEFAULT NULL,
  `dofcu` varchar(250) DEFAULT NULL,
  `m_age` varchar(10) DEFAULT NULL,
  `m_weight` varchar(20) NOT NULL,
  `m_height` varchar(20) DEFAULT NULL,
  `m_bmi` varchar(20) DEFAULT NULL,
  `m_dolp` varchar(250) DEFAULT NULL,
  `m_edod` varchar(250) DEFAULT NULL,
  `f_first_name` varchar(250) DEFAULT NULL,
  `f_middle_name` varchar(250) DEFAULT NULL,
  `f_last_name` varchar(250) DEFAULT NULL,
  `f_phone` varchar(20) DEFAULT NULL,
  `f_landline` varchar(30) DEFAULT NULL,
  `f_dob` varchar(250) DEFAULT NULL,
  `f_type_blood` varchar(20) DEFAULT NULL,
  `f_occupation` varchar(250) DEFAULT NULL,
  `children1` varchar(250) DEFAULT NULL,
  `children2` varchar(250) DEFAULT NULL,
  `children3` varchar(250) DEFAULT NULL,
  `dob1` varchar(250) DEFAULT NULL,
  `dob2` varchar(250) DEFAULT NULL,
  `dob3` varchar(250) DEFAULT NULL,
  `addr` varchar(250) DEFAULT NULL,
  `g_name` varchar(250) DEFAULT NULL,
  `g_rel` varchar(250) DEFAULT NULL,
  `g_phone` varchar(20) DEFAULT NULL,
  `g_dob` varchar(250) DEFAULT NULL,
  `patient_type` varchar(200) DEFAULT NULL,
  `stat` int(250) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `m_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`id`, `m_first_name`, `m_middle_name`, `m_last_name`, `m_phone`, `m_landline`, `m_dob`, `m_type_blood`, `m_occupation`, `m_number`, `dofcu`, `m_age`, `m_weight`, `m_height`, `m_bmi`, `m_dolp`, `m_edod`, `f_first_name`, `f_middle_name`, `f_last_name`, `f_phone`, `f_landline`, `f_dob`, `f_type_blood`, `f_occupation`, `children1`, `children2`, `children3`, `dob1`, `dob2`, `dob3`, `addr`, `g_name`, `g_rel`, `g_phone`, `g_dob`, `patient_type`, `stat`, `created_at`, `m_pic`) VALUES
(12, 'Karen', 'S.', 'Barrientos', '097022269478', '', '02/02/2004', 'B+', '', 'NEZP', '', '20', '', '', '', '15/12/2023', '22/09/2024', 'Arnulfo', '', 'Firmanes', '', '', '', '', 'Driver Southwest', '', '', '', '', '', '', 'Purok 1, Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 1, '2024-11-13 16:08:59', ''),
(20, 'Malome', 'Tanoan', 'Arboleda', '09504246853', '', '24/05/1978', 'B+', 'Housewife', 'LNEH', '09/10/2002', '46', '70', '166', 'none', '22/08/2024', '01/05/2025', 'Ardis', 'Nepomuceno', 'Arboleda', '09664803348', '', '03/11/1967', 'A+', 'Sales Clerk', 'Arvin Arboleda ', 'Shannen Arboleda', '', '19/07/2001', '08/11/1999', '', 'Purok 3 Bulwang, Numancia, Aklan', 'Arvin Arboleda', 'Daughter', '09709246259', '19/07/2001', 'Active', 1, '2024-12-04 14:21:56', ''),
(22, 'Mary Joy ', 'E. ', 'Matos', '09664803348', '', '05/11/2024', '', 'Housewife', 'TDWX', '06/11/2001', '37', '', '', '', '08/05/2024', '12/02/2025', 'Mark Lester ', 'J.', 'Matos', '09072347287', '', '', '', 'Construction Worker', '', '', '', '', '', '', 'Purok 7 Laguinbanua East Numancia, Aklan', '', '', '09123456742', '', 'Active', 1, '2024-11-06 07:37:24', ''),
(23, 'April Joy ', 'De Pedro', 'Mationg', '09536278321', '', '14/04/2000', '', 'Housewife', 'JONZ', '06/11/2024', '25', '', '', '', '23/01/2024', '09/10/2024', 'Cyrel Dave', 'Arriola', 'Zulueta', '0987645636531', '', '', '', 'Seaman', '', '', '', '', '', '', 'Purok 7 Laguinbanua East Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 05:58:30', ''),
(24, 'Justin Nicole ', '', 'Dionela', '09825463524', '', '24/08/2000', '', 'Housewife', '9M5Q', '06/11/2024', '26', '', '', '', '26/03/2024', '31/12/2024', 'Mark Angelo', '', 'Jorque', '09676754365', '', '', '', 'PNP', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:05:48', ''),
(25, 'Jolina May ', '', 'Irineo', '09875643213', '', '22/02/2000', '', 'Front Office', '8SFA', '', '25', '', '', '', '', '10/10/2024', 'John Eric', '', 'Velasco', '09957400122', '', '', '', 'Waiter', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:10:01', ''),
(26, 'Leny', 'R', 'Vega', '09887624315', '', '17/09/2000', '', 'Housewife', '83HD', '', '25', '', '', '', '05/03/2024', '10/12/2024', 'Gerald Ron ', '', 'Vega', '', '', '', '', 'Tricycle Driver', '', '', '', '', '', '', 'Purok 5 Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:13:40', ''),
(27, 'Flormalyn', '', 'Pioquinto', '09736515421', '', '20/05/1979', '', 'Housewife', 'QOYH', '', '36', '', '', '', '21/05/2024', '25/02/2025', 'Rexie', '', 'Pioquinto', '', '', '', '', 'Seaman', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:25:01', ''),
(28, 'Shanen Joy ', 'V', 'Rompe', '09874352431', '', '01/08/2000', '', 'Housewife', '2X7G', '', '32', '', '', '', '01/06/2024', '08/03/2025', 'Frenz Darl  ', '', 'Rompe', '', '', '', '', 'Family Driver', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:20:17', ''),
(29, 'Kia Jane', 'D', 'Benedicto', '09535463222', '', '29/03/2000', '', 'Housewife', 'A4OH', '', '27', '', '', '', '10/03/2024', '15/12/2024', 'Jurin', '', 'Tropa', '', '', '', '', 'Driver', '', '', '', '', '', '', 'Purok 3 Bulwang, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:23:20', ''),
(30, 'Mirabel', 'R', 'Sarandin', '09245241554', '', '24/08/1994', 'O+', 'Housewife', 'I2VO', '', '29', '', '', '', '01/02/2024', '07/11/2024', 'Arvin ', '', 'Bautista', '', '', '', '', 'Self Employed', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 07:19:36', ''),
(31, 'Grace', 'P.', 'Piano', '09811218159', '', '08/11/2007', '', 'Student', '9A8B', '', '17', '', '', '', '18/01/2024', '25/10/2024', 'Jenesis', '', 'Sabido', '', '', '', '', 'Laborer', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-13 16:02:42', ''),
(32, 'Doreyna', 'L.', 'Lima', '09303160532', '', '06/01/1987', '', 'Housewife', '5TNF', '', '37', '', '', '', '01/01/2024', '02/11/2024', 'Seth ', 'A.', 'Lima', '', '', '', '', 'Freelance', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-13 16:02:25', ''),
(33, 'Jently', 'De leon', 'Firmanes', '09223245654', '', '19/09/1991', '', 'Vendor', 'NUKW', '', '31', '', '', '', '28/03/2024', '04/01/2025', 'Angelito ', 'Inso', 'Villaruel', '', '', '', '', 'Painter', '', '', '', '', '', '', 'Purok 2 Bulwang, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:44:51', ''),
(34, 'Jhenevie', 'V.', 'Mabansag', '0965437265321', '', '04/10/1989', '', 'Book keeper', 'JY9H', '', '34', '', '', '', '29/04/2024', '03/02/2025', 'Jayson ', 'A.', 'Mabansag', '', '', '', '', 'Car Painter', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-06 06:50:34', ''),
(35, 'Jonah', 'L. ', 'Ann', '09662267438', '', '07/06/1987', '', 'Secretary', 'DANK', '', '36', '', '', '', '10/01/2024', '16/10/2024', 'Ricky ', '', 'Ann', '', '', '', '', 'salesman', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-13 16:09:41', ''),
(36, 'Rosemary ', 'Rotulo', 'Antonio', '09480792785', '', '21/10/1997', '', 'Housewife', 'IN6X', '', '26', '', '', '', '06/07/2024', '12/04/2025', 'Ariel', '', 'Antonio', '', '', '', '', 'Construction Worker', '', '', '', '', '', '', 'Purok 4 Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 1, '2024-11-13 16:10:02', ''),
(37, 'Anna', 'Legaspi', 'Cruz', '09499618163', '', '25/06/2001', 'A+', 'Teacher', 'EJIU', '', '23', '40.6', '153', '23.7', '24/12/2024', '26/10/2024', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 1, '2024-11-13 16:02:08', ''),
(38, 'Jonnie Ann', 'Quimpo', 'Illazar', '09499618163', '', '16/06/1980', 'B+', 'Nurse', '4EXU', '29/01/2024', '44', '45', '172', '15.21', '08/11/2023', '11/09/2024', 'Francisco', 'Tumbokon', 'Illazar', '', '', '24/09/1979', 'O+', 'Driver', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', 'Leonila Quimpo', 'Mother', '', '11/12/1954', 'Active', 1, '2024-11-13 16:09:59', ''),
(39, 'Imee', 'Perez', 'Salazar', '09499618163', '', '21/01/2000', 'O+', 'Teacher', '7CZY', '11/02/2024', '24', '67', '154', '28.25', '08/11/2023', '02/11/2024', 'Julius', 'Tambong', 'Salazar', '09499618163', '', '11/01/1999', 'B+', 'Security Guard', '', '', '', '', '', '', 'Purok 5 Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Active', 0, '2024-11-11 14:41:35', ''),
(40, 'Dimelyn', 'N.', 'Villanueva', '0938825505', '', '17/12/1992', 'A+', 'Housewife', 'YCFP', '13/09/2023', '32', '40.6', '153', '17.34', '26/04/2023', '02/02/2024', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Laguinbanua East, Numancia, Aklan', '', '', '', '', 'Inactive', 0, '2024-11-13 16:01:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reminders`
--

CREATE TABLE `tbl_reminders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `i_id` int(11) NOT NULL,
  `i_name` varchar(250) DEFAULT NULL,
  `i_gender` varchar(20) DEFAULT NULL,
  `i_number` varchar(10) DEFAULT NULL,
  `i_bcg_d1` date DEFAULT NULL,
  `i_bcg_rem` varchar(100) DEFAULT NULL,
  `i_hep_d1` date DEFAULT NULL,
  `i_hep_rem` varchar(100) DEFAULT NULL,
  `i_dpt_d1` date DEFAULT NULL,
  `i_dpt_rem1` varchar(100) DEFAULT NULL,
  `i_dpt_d2` date DEFAULT NULL,
  `i_dpt_rem2` varchar(100) DEFAULT NULL,
  `i_dpt_d3` date DEFAULT NULL,
  `i_dpt_rem3` varchar(100) DEFAULT NULL,
  `i_opv_d1` date DEFAULT NULL,
  `i_opv_rem1` varchar(100) DEFAULT NULL,
  `i_opv_d2` date DEFAULT NULL,
  `i_opv_rem2` varchar(100) DEFAULT NULL,
  `i_opv_d3` date DEFAULT NULL,
  `i_opv_rem3` varchar(100) DEFAULT NULL,
  `i_ipv_d1` date DEFAULT NULL,
  `i_ipv_rem` varchar(100) DEFAULT NULL,
  `i_pcv_d1` date DEFAULT NULL,
  `i_pcv_rem1` varchar(100) DEFAULT NULL,
  `i_pcv_d2` date DEFAULT NULL,
  `i_pcv_rem2` varchar(100) DEFAULT NULL,
  `i_pcv_d3` date DEFAULT NULL,
  `i_pcv_rem3` varchar(100) DEFAULT NULL,
  `i_mmr_d1` date DEFAULT NULL,
  `i_mmr_rem1` varchar(100) DEFAULT NULL,
  `i_mmr_d2` date DEFAULT NULL,
  `i_mmr_rem2` varchar(100) DEFAULT NULL,
  `i_other_name1` varchar(100) DEFAULT NULL,
  `i_other_d1` date DEFAULT NULL,
  `i_other_rem1` varchar(100) DEFAULT NULL,
  `i_other_name2` varchar(100) DEFAULT NULL,
  `i_other_d2` date DEFAULT NULL,
  `i_other_rem2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`i_id`, `i_name`, `i_gender`, `i_number`, `i_bcg_d1`, `i_bcg_rem`, `i_hep_d1`, `i_hep_rem`, `i_dpt_d1`, `i_dpt_rem1`, `i_dpt_d2`, `i_dpt_rem2`, `i_dpt_d3`, `i_dpt_rem3`, `i_opv_d1`, `i_opv_rem1`, `i_opv_d2`, `i_opv_rem2`, `i_opv_d3`, `i_opv_rem3`, `i_ipv_d1`, `i_ipv_rem`, `i_pcv_d1`, `i_pcv_rem1`, `i_pcv_d2`, `i_pcv_rem2`, `i_pcv_d3`, `i_pcv_rem3`, `i_mmr_d1`, `i_mmr_rem1`, `i_mmr_d2`, `i_mmr_rem2`, `i_other_name1`, `i_other_d1`, `i_other_rem1`, `i_other_name2`, `i_other_d2`, `i_other_rem2`) VALUES
(37, 'Steven Blaise Alvarez', 'Male', 'ZPGA', '2024-09-27', '', '2024-10-03', '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', NULL, '', '', NULL, '', '', NULL, ''),
(38, 'Anne Cruz', 'Female', 'ZPGD', '2024-09-25', NULL, '2024-10-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `title`, `role`, `created_at`) VALUES
(1, 'Midwife', 2, '2024-08-31 02:49:04'),
(2, 'Staff', 3, '2024-08-31 02:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `doctor_name` varchar(250) NOT NULL,
  `available_days` text NOT NULL,
  `start_time` varchar(250) NOT NULL,
  `end_time` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `doctor_name`, `available_days`, `start_time`, `end_time`, `message`, `status`, `created_at`) VALUES
(6, 'Ma. Shanine Grace Ame', 'Tuesday, Thursday', '9:00 AM', '10:00 AM', 'For Child Immunization and Prenatal Checkup', 1, '2024-11-08 06:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_second_trimester`
--

CREATE TABLE `tbl_second_trimester` (
  `second_id` int(11) NOT NULL,
  `second_m_name` varchar(200) DEFAULT NULL,
  `second_m_age` int(11) DEFAULT NULL,
  `second_m_number` varchar(200) DEFAULT NULL,
  `second_number` varchar(200) DEFAULT NULL,
  `Sec_date` varchar(200) DEFAULT NULL,
  `sec_weight` varchar(200) DEFAULT NULL,
  `sec_height` varchar(200) DEFAULT NULL,
  `sec_aog` varchar(200) DEFAULT NULL,
  `sec_bp` varchar(200) DEFAULT NULL,
  `sec_nutrition` varchar(200) DEFAULT NULL,
  `sec_examine` longtext DEFAULT NULL,
  `sec_p` longtext DEFAULT NULL,
  `sec_cotbp` varchar(200) DEFAULT NULL,
  `sec_dental` longtext DEFAULT NULL,
  `sec_ltd` varchar(200) DEFAULT NULL,
  `sec_u` varchar(200) DEFAULT NULL,
  `sec_cbc` varchar(200) DEFAULT NULL,
  `sec_sti` varchar(200) DEFAULT NULL,
  `sec_g` varchar(200) DEFAULT NULL,
  `sec_bac` varchar(200) DEFAULT NULL,
  `sec_tre` varchar(200) DEFAULT NULL,
  `sec_dsp` varchar(200) DEFAULT NULL,
  `sec_donc` varchar(200) DEFAULT NULL,
  `sec_noh` varchar(200) DEFAULT NULL,
  `sec_hr` varchar(200) DEFAULT NULL,
  `sect_date` varchar(200) DEFAULT NULL,
  `sect_weight` varchar(200) DEFAULT NULL,
  `sect_height` varchar(200) DEFAULT NULL,
  `sect_aog` varchar(200) DEFAULT NULL,
  `sect_bp` varchar(200) DEFAULT NULL,
  `sect_nutrition` varchar(200) DEFAULT NULL,
  `sect_examine` longtext DEFAULT NULL,
  `sect_p` longtext DEFAULT NULL,
  `sect_cotbp` varchar(200) DEFAULT NULL,
  `sect_dental` varchar(200) DEFAULT NULL,
  `sect_ltd` varchar(200) DEFAULT NULL,
  `sect_u` varchar(200) DEFAULT NULL,
  `sect_cbc` varchar(200) DEFAULT NULL,
  `sect_et` varchar(200) DEFAULT NULL,
  `sect_ges` varchar(200) DEFAULT NULL,
  `sect_bac` varchar(200) DEFAULT NULL,
  `sect_treat` varchar(200) DEFAULT NULL,
  `sect_d` varchar(200) DEFAULT NULL,
  `sect_donc` varchar(200) DEFAULT NULL,
  `sect_noh` varchar(200) DEFAULT NULL,
  `sect_hr` varchar(200) DEFAULT NULL,
  `seco_date` varchar(200) DEFAULT NULL,
  `seco_weight` varchar(200) DEFAULT NULL,
  `seco_height` varchar(200) DEFAULT NULL,
  `seco_aog` varchar(200) DEFAULT NULL,
  `seco_bp` varchar(200) DEFAULT NULL,
  `seco_nutrition` varchar(200) DEFAULT NULL,
  `seco_examine` longtext DEFAULT NULL,
  `seco_p` longtext DEFAULT NULL,
  `seco_cotbp` varchar(200) DEFAULT NULL,
  `seco_dental` longtext DEFAULT NULL,
  `seco_ltd` varchar(200) DEFAULT NULL,
  `seco_u` varchar(200) DEFAULT NULL,
  `seco_cbc` varchar(200) DEFAULT NULL,
  `seco_sti` varchar(200) DEFAULT NULL,
  `seco_gd` varchar(200) DEFAULT NULL,
  `seco_bac` varchar(200) DEFAULT NULL,
  `seco_tret` varchar(200) DEFAULT NULL,
  `seco_dsp` varchar(200) DEFAULT NULL,
  `seco_don` varchar(200) DEFAULT NULL,
  `seco_noh` varchar(200) DEFAULT NULL,
  `seco_hr` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `tbl_second_trimester`
--

INSERT INTO `tbl_second_trimester` (`second_id`, `second_m_name`, `second_m_age`, `second_m_number`, `second_number`, `Sec_date`, `sec_weight`, `sec_height`, `sec_aog`, `sec_bp`, `sec_nutrition`, `sec_examine`, `sec_p`, `sec_cotbp`, `sec_dental`, `sec_ltd`, `sec_u`, `sec_cbc`, `sec_sti`, `sec_g`, `sec_bac`, `sec_tre`, `sec_dsp`, `sec_donc`, `sec_noh`, `sec_hr`, `sect_date`, `sect_weight`, `sect_height`, `sect_aog`, `sect_bp`, `sect_nutrition`, `sect_examine`, `sect_p`, `sect_cotbp`, `sect_dental`, `sect_ltd`, `sect_u`, `sect_cbc`, `sect_et`, `sect_ges`, `sect_bac`, `sect_treat`, `sect_d`, `sect_donc`, `sect_noh`, `sect_hr`, `seco_date`, `seco_weight`, `seco_height`, `seco_aog`, `seco_bp`, `seco_nutrition`, `seco_examine`, `seco_p`, `seco_cotbp`, `seco_dental`, `seco_ltd`, `seco_u`, `seco_cbc`, `seco_sti`, `seco_gd`, `seco_bac`, `seco_tret`, `seco_dsp`, `seco_don`, `seco_noh`, `seco_hr`, `created_at`) VALUES
(12, 'Dimelyn Villanueva', 32, 'YCFP', '', '13/09/2023', '40.6', '', '20 weeks', '110/58', '', '', 'Calcium 1 Box', 'TT4 - 9/13/23', '', '', '', '', '', '', '', '', '', '22/10/2023', '', '', '22/10/2023', '45', '', '', '113/64', '', 'FHT - 16cm, FHB - 1506m 40', 'Calcium; 1 tab 3x/day', '', '', '', '', '', '', '', '', '', '', '26/11/2023', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 15:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_templates`
--

CREATE TABLE `tbl_templates` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `template_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_templates`
--

INSERT INTO `tbl_templates` (`id`, `template_name`, `template_content`) VALUES
(1, 'Prenatal Checkup', 'Dear {patient_name},\n\nThis is a reminder for your prenatal checkup on {date} at {time}. Your midwife will be {midwife_name}.\n\nBest regards,\nLaguinbanua East Health Center');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_third_trimester`
--

CREATE TABLE `tbl_third_trimester` (
  `third_id` int(11) NOT NULL,
  `third_m_name` varchar(200) DEFAULT NULL,
  `third_m_age` int(11) DEFAULT NULL,
  `third_m_number` varchar(200) DEFAULT NULL,
  `third_number` varchar(200) DEFAULT NULL,
  `th_date` varchar(200) DEFAULT NULL,
  `th_weight` varchar(200) DEFAULT NULL,
  `th_height` varchar(200) DEFAULT NULL,
  `th_aog` varchar(200) DEFAULT NULL,
  `th_bp` varchar(200) DEFAULT NULL,
  `th_nutrition` varchar(200) DEFAULT NULL,
  `th_examine` longtext DEFAULT NULL,
  `th_p` longtext DEFAULT NULL,
  `th_cotbp` varchar(200) DEFAULT NULL,
  `th_dental` longtext DEFAULT NULL,
  `th_ltd` varchar(200) DEFAULT NULL,
  `th_u` varchar(200) DEFAULT NULL,
  `th_cbc` varchar(200) DEFAULT NULL,
  `th_bac` varchar(200) DEFAULT NULL,
  `th_blood` varchar(200) DEFAULT NULL,
  `th_treat` varchar(200) DEFAULT NULL,
  `th_dsp` varchar(200) DEFAULT NULL,
  `th_donc` varchar(200) DEFAULT NULL,
  `th_noh` varchar(200) DEFAULT NULL,
  `th_hr` varchar(200) DEFAULT NULL,
  `thir_date` varchar(200) DEFAULT NULL,
  `thir_weight` varchar(200) DEFAULT NULL,
  `thir_height` varchar(200) DEFAULT NULL,
  `thir_aog` varchar(200) DEFAULT NULL,
  `thir_bp` varchar(200) DEFAULT NULL,
  `thir_nutrition` varchar(200) DEFAULT NULL,
  `thir_examine` longtext DEFAULT NULL,
  `thir_p` longtext DEFAULT NULL,
  `thir_cotbp` varchar(200) DEFAULT NULL,
  `thir_dental` longtext DEFAULT NULL,
  `thir_ltd` varchar(200) DEFAULT NULL,
  `thir_u` varchar(200) DEFAULT NULL,
  `thir_cbc` varchar(200) DEFAULT NULL,
  `thir_bac` varchar(200) DEFAULT NULL,
  `thir_blood` varchar(200) DEFAULT NULL,
  `thir_treat` varchar(200) DEFAULT NULL,
  `thir_dsp` varchar(200) DEFAULT NULL,
  `thir_donc` varchar(200) DEFAULT NULL,
  `thir_noh` varchar(200) DEFAULT NULL,
  `thir_hr` varchar(200) DEFAULT NULL,
  `thi_date` varchar(200) DEFAULT NULL,
  `thi_weight` varchar(200) DEFAULT NULL,
  `thi_height` varchar(200) DEFAULT NULL,
  `thi_aog` varchar(200) DEFAULT NULL,
  `thi_bp` varchar(200) DEFAULT NULL,
  `thi_nutrition` varchar(200) DEFAULT NULL,
  `thi_examine` longtext DEFAULT NULL,
  `thi_p` longtext DEFAULT NULL,
  `thi_cotbp` varchar(200) DEFAULT NULL,
  `thi_dental` longtext DEFAULT NULL,
  `thi_ltd` varchar(200) DEFAULT NULL,
  `thi_u` varchar(200) DEFAULT NULL,
  `thi_cbc` varchar(200) DEFAULT NULL,
  `thi_bac` varchar(200) DEFAULT NULL,
  `thi_blood` varchar(200) DEFAULT NULL,
  `thi_treat` varchar(200) DEFAULT NULL,
  `thi_dsp` varchar(200) DEFAULT NULL,
  `thi_donc` varchar(200) DEFAULT NULL,
  `thi_noh` varchar(200) DEFAULT NULL,
  `thi_hr` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `tbl_third_trimester`
--

INSERT INTO `tbl_third_trimester` (`third_id`, `third_m_name`, `third_m_age`, `third_m_number`, `third_number`, `th_date`, `th_weight`, `th_height`, `th_aog`, `th_bp`, `th_nutrition`, `th_examine`, `th_p`, `th_cotbp`, `th_dental`, `th_ltd`, `th_u`, `th_cbc`, `th_bac`, `th_blood`, `th_treat`, `th_dsp`, `th_donc`, `th_noh`, `th_hr`, `thir_date`, `thir_weight`, `thir_height`, `thir_aog`, `thir_bp`, `thir_nutrition`, `thir_examine`, `thir_p`, `thir_cotbp`, `thir_dental`, `thir_ltd`, `thir_u`, `thir_cbc`, `thir_bac`, `thir_blood`, `thir_treat`, `thir_dsp`, `thir_donc`, `thir_noh`, `thir_hr`, `thi_date`, `thi_weight`, `thi_height`, `thi_aog`, `thi_bp`, `thi_nutrition`, `thi_examine`, `thi_p`, `thi_cotbp`, `thi_dental`, `thi_ltd`, `thi_u`, `thi_cbc`, `thi_bac`, `thi_blood`, `thi_treat`, `thi_dsp`, `thi_donc`, `thi_noh`, `thi_hr`, `created_at`) VALUES
(4, 'Dimelyn Villanueva', 0, 'YCFP', '', '26/11/2023', '46', '', '', '102/72', '', 'FHT- 75cm, FHB-1386m, Pre. Breech', '1 Gut. take  Vit', '', '', '', '', '', '', '', '', '', '03/01/2024', '', '', '03/01/2020', '50', '', '', '107/58', '', 'FHT-29 cm, FHB-114bm', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 15:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_week`
--

CREATE TABLE `tbl_week` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_week`
--

INSERT INTO `tbl_week` (`id`, `name`, `created_at`) VALUES
(1, 'Sunday', '2023-05-05 11:16:11'),
(2, 'Monday', '2023-05-05 11:16:25'),
(3, 'Tuesday', '2023-05-05 11:16:37'),
(4, 'Wednesday', '2023-05-05 11:16:49'),
(5, 'Thursday', '2023-05-05 11:16:58'),
(6, 'Friday', '2023-05-05 11:17:06'),
(7, 'Saturday', '2023-05-05 11:17:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_baby`
--
ALTER TABLE `tbl_baby`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_experience`
--
ALTER TABLE `tbl_experience`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tbl_experiences`
--
ALTER TABLE `tbl_experiences`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tbl_first_trimester`
--
ALTER TABLE `tbl_first_trimester`
  ADD PRIMARY KEY (`first_id`);

--
-- Indexes for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `tbl_other`
--
ALTER TABLE `tbl_other`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reminders`
--
ALTER TABLE `tbl_reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_second_trimester`
--
ALTER TABLE `tbl_second_trimester`
  ADD PRIMARY KEY (`second_id`);

--
-- Indexes for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_third_trimester`
--
ALTER TABLE `tbl_third_trimester`
  ADD PRIMARY KEY (`third_id`);

--
-- Indexes for table `tbl_week`
--
ALTER TABLE `tbl_week`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbl_baby`
--
ALTER TABLE `tbl_baby`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_experience`
--
ALTER TABLE `tbl_experience`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_experiences`
--
ALTER TABLE `tbl_experiences`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_first_trimester`
--
ALTER TABLE `tbl_first_trimester`
  MODIFY `first_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_other`
--
ALTER TABLE `tbl_other`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_reminders`
--
ALTER TABLE `tbl_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_second_trimester`
--
ALTER TABLE `tbl_second_trimester`
  MODIFY `second_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_third_trimester`
--
ALTER TABLE `tbl_third_trimester`
  MODIFY `third_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_week`
--
ALTER TABLE `tbl_week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

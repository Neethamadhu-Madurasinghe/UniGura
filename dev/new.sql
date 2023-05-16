-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 06:11 AM
-- Server version: 8.0.31
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unigura`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int NOT NULL,
  `day_id` int NOT NULL,
  `is_completed` int NOT NULL DEFAULT '0',
  `is_hidden` int NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT 'Activity_Description',
  `type` int NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `day_id`, `is_completed`, `is_hidden`, `description`, `type`, `link`, `position`) VALUES
(1, 16, 0, 0, 'Theory Note', 0, './user_files/16840921734225.pdf', NULL),
(2, 16, 0, 0, 'Complete Following Activity and Submit the Activity', 2, '', NULL),
(3, 16, 0, 0, 'Question Tute', 0, './user_files/16840922118287.pdf', NULL),
(4, 16, 1, 0, 'Upload Answers', 1, './user_files/16840993737445.pdf', NULL),
(5, 17, 0, 0, 'Question Tute', 0, './user_files/16840924206061.pdf', NULL),
(6, 18, 0, 0, 'Questions', 0, '', NULL),
(7, 18, 0, 0, 'Upload Answers', 1, '', NULL),
(8, 19, 0, 0, 'Question Tute', 0, './user_files/16840923768381.pdf', NULL),
(9, 19, 0, 0, 'Upload Answers', 1, '', NULL),
(10, 20, 0, 0, 'Short Note', 0, '', NULL),
(11, 21, 0, 0, 'Note', 0, './user_files/16840928267542.pdf', NULL),
(12, 22, 0, 0, 'Question Tute', 0, './user_files/16840928918987.pdf', NULL),
(13, 23, 0, 0, 'Question Tute', 0, '', NULL),
(14, 24, 0, 0, 'Refference', 0, './user_files/16840927713346.pdf', NULL),
(15, 25, 0, 0, 'Question', 0, './user_files/16840923279570.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_template`
--

CREATE TABLE `activity_template` (
  `id` int NOT NULL,
  `day_template_id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Activity_Description',
  `type` int NOT NULL DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  `position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `activity_template`
--

INSERT INTO `activity_template` (`id`, `day_template_id`, `description`, `type`, `link`, `position`) VALUES
(15, 20, 'Theory Note', 0, './user_files/16840921734225.pdf', NULL),
(16, 20, 'Complete Following Activity and Submit the Activity', 2, '', NULL),
(17, 20, 'Question Tute', 0, './user_files/16840922118287.pdf', NULL),
(18, 20, 'Upload Answers', 1, '', NULL),
(20, 31, 'Question', 0, './user_files/16840923279570.pdf', NULL),
(21, 23, 'Questions', 0, '', NULL),
(22, 23, 'Upload Answers', 1, '', NULL),
(23, 24, 'Question Tute', 0, './user_files/16840923768381.pdf', NULL),
(24, 24, 'Upload Answers', 1, '', NULL),
(26, 22, 'Question Tute', 0, './user_files/16840924206061.pdf', NULL),
(27, 25, 'Short Note', 0, '', NULL),
(28, 29, 'Refference', 0, './user_files/16840927713346.pdf', NULL),
(29, 26, 'Note', 0, './user_files/16840928267542.pdf', NULL),
(30, 28, 'Question Tute', 0, '', NULL),
(31, 27, 'Question Tute', 0, './user_files/16840928918987.pdf', NULL),
(32, 33, 'Question Tute', 0, './user_files/16840974626277.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `code` varchar(15) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_validated` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `email`, `password`, `role`, `code`, `token`, `time`, `is_validated`) VALUES
(59, 'admin@gmail.com', '$2y$10$jnXiQm9CWHB8i/tQ2m0kju2l./6QU2vhful7V1epiZO1ojVvpjfZC', 0, 'n2kC6f', NULL, '2023-05-14 23:30:17', 1),
(60, 'viraj123@gmail.com', '$2y$10$RKKNaEIOIVdzSb0E151rYOMTob0hV.vXBVt0WkdZomb0.ddfKimca', 1, 'kvhaSf', NULL, '2023-05-15 00:12:36', 1),
(61, 'madushariniperera13@gmail.com', '$2y$10$f0SOccYmgD7NSNPQPPaOmeJTr2JW9itL.2BpS9sIhYoxDrgd31lsO', 1, 'cyQH8a', NULL, '2023-05-15 01:21:41', 1),
(62, 'dihanhansaja@gmail.com', '$2y$10$GCV4kUHZE.XpVCMYwnTCS.ISTNf02v7WMUt8rNVi2RCFUupyiZuo.', 1, 'RvCXBW', NULL, '2023-05-15 02:30:55', 1),
(63, 'Janithsh@gmail.com', '$2y$10$DdYfTvI37ZnCEp3mli1AhuKWoceNjc8Zw8jQL5VD.sIRzsax9qp3e', 2, 'sv3om7', NULL, '2023-05-15 02:37:22', 1),
(64, 'student1@gmail.com', '$2y$10$Ra1xsEPCKrR./wPfq52oke2sHXM/o/uCT/QcQ6WOQEZYc5wx6itKS', 2, 'qoRg6L', NULL, '2023-05-15 09:28:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int NOT NULL,
  `thread_id` int NOT NULL,
  `message` text NOT NULL,
  `sender` int NOT NULL,
  `receiver` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_seen` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `thread_id`, `message`, `sender`, `receiver`, `created_at`, `is_seen`) VALUES
(102, 20, 'hiii', 60, 63, '2023-05-14 21:16:38', 1),
(103, 20, 'Hi sir', 63, 60, '2023-05-14 21:17:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_thread`
--

CREATE TABLE `chat_thread` (
  `id` int NOT NULL,
  `user_id_1` int NOT NULL,
  `user_id_2` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `chat_thread`
--

INSERT INTO `chat_thread` (`id`, `user_id_1`, `user_id_2`) VALUES
(20, 60, 63);

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_hidden` int NOT NULL DEFAULT '0',
  `payment_status` int NOT NULL DEFAULT '0',
  `is_completed` int NOT NULL DEFAULT '0',
  `meeting_link` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `position` int DEFAULT NULL,
  `day_template_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`id`, `class_id`, `title`, `is_hidden`, `payment_status`, `is_completed`, `meeting_link`, `timestamp`, `position`, `day_template_id`) VALUES
(16, 8, 'Linear Motion', 0, 1, 1, NULL, '2023-05-14 21:21:00', 1, 20),
(17, 8, 'Force Equillibrium', 0, 0, 1, NULL, '2023-05-14 21:44:08', 5, 22),
(18, 8, 'Friction', 0, 0, 1, NULL, '2023-05-14 21:44:40', 3, 23),
(19, 8, 'Newton&#39;s laws of motion', 0, 0, 1, NULL, '2023-05-14 21:44:39', 4, 24),
(20, 8, 'Circular motion', 0, 0, 1, NULL, '2023-05-14 21:44:09', 6, 25),
(21, 8, 'Momentum and impulse', 0, 0, 1, NULL, '2023-05-14 21:44:11', 8, 26),
(22, 8, 'Fluid Dynamics', 0, 0, 1, NULL, '2023-05-14 21:44:13', 10, 27),
(23, 8, 'HydroStatics', 0, 0, 1, NULL, '2023-05-14 21:44:12', 9, 28),
(24, 8, 'Rotational Motion', 0, 0, 1, NULL, '2023-05-14 21:44:10', 7, 29),
(25, 8, 'Motion Time Graph', 0, 0, 1, NULL, '2023-05-14 21:43:09', 2, 31);

-- --------------------------------------------------------

--
-- Table structure for table `day_template`
--

CREATE TABLE `day_template` (
  `id` int NOT NULL,
  `class_template_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `day_template`
--

INSERT INTO `day_template` (`id`, `class_template_id`, `title`, `position`) VALUES
(20, 21, 'Linear Motion', 1),
(22, 21, 'Force Equillibrium', 5),
(23, 21, 'Friction', 3),
(24, 21, 'Newton&#39;s laws of motion', 4),
(25, 21, 'Circular motion', 6),
(26, 21, 'Momentum and impulse', 8),
(27, 21, 'Fluid Dynamics', 10),
(28, 21, 'HydroStatics', 9),
(29, 21, 'Rotational Motion', 7),
(31, 21, 'Motion Time Graph', 2),
(32, 20, 'Messurments', 1),
(33, 22, 'Angles', 1),
(34, 25, '1', 1),
(35, 25, '2', 2),
(36, 25, '3', 3),
(37, 25, '4', 4),
(38, 25, '5', 5),
(39, 25, '6', 6),
(40, 25, '7', 7),
(41, 24, '1', 1),
(42, 24, '2', 2),
(43, 24, '3', 3),
(44, 24, '4', 4),
(45, 24, '5', 5),
(46, 24, '6', 6),
(47, 24, '7', 7),
(48, 24, '8', 8),
(49, 24, '9', 9);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Module_Name',
  `is_hidden` int NOT NULL DEFAULT '0',
  `subject_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `is_hidden`, `subject_id`) VALUES
(15, 'Units', 0, 22),
(16, 'Mechanics', 0, 22),
(17, 'Occillations and waves', 0, 22),
(18, 'Heat', 0, 22),
(19, 'Gravitational Feilds', 0, 22),
(20, 'Electrostatic Feild', 0, 22),
(21, 'Magnetic Feilds', 0, 22),
(22, 'Current Electricity', 0, 22),
(23, 'Electronics', 0, 22),
(24, 'Properties of Matter', 0, 22),
(25, 'Matter and Radiation', 0, 22),
(26, 'Atomic structure', 0, 23),
(27, 'Chemical bonding', 0, 23),
(28, 'Chemical calculation', 0, 23),
(29, 'Gases', 0, 23),
(30, 'Chemical kinetics', 0, 23),
(31, 'Equilibrium', 0, 23),
(32, 'Organic chemistry', 0, 23),
(33, 'Inorganic chemistry', 0, 23),
(34, 'Industrial chemistry', 0, 23),
(35, 'Environmental Chemistry', 0, 23),
(36, 'Energetics', 0, 23),
(37, 'Functions', 0, 24),
(38, 'Straight Line', 0, 24),
(39, 'Trigonometry', 0, 24),
(40, 'Polynomials', 0, 24),
(41, 'Vectors', 0, 24),
(42, 'Quadratic Functions and equations', 0, 24),
(43, 'Limts', 0, 24),
(44, 'Derivatives', 0, 24),
(45, 'Projectiles', 0, 24),
(46, 'Friction', 0, 24),
(47, 'Relative Motion', 0, 24),
(48, 'Newton&#39;s Laws of Motion', 0, 24),
(49, 'Intergration', 0, 24),
(50, 'Jointed rods', 0, 24),
(51, 'Frame works', 0, 24),
(52, 'Impulse and collision', 0, 24),
(53, 'Circular rotion', 0, 24),
(54, 'Work, Power, Energy', 0, 24),
(55, 'Circle', 0, 24),
(56, 'Permutations and Combinations', 0, 24),
(57, 'Mathamatical Induction', 0, 24),
(58, 'Series', 0, 24),
(59, 'Probability', 0, 24),
(60, 'Simple Harmonic Motion', 0, 24),
(61, 'Center of Mass', 0, 24),
(62, 'Complex Numbers', 0, 24);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Notification_Title',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_seen` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `title`, `description`, `link`, `created_at`, `is_seen`) VALUES
(180, 61, 'Your tutor request has been accepted.', 'Now you can login to your account and start tutoring.', NULL, '2023-05-14 19:59:13', 0),
(181, 62, 'Your tutor request has been accepted.', 'Now you can login to your account and start tutoring.', NULL, '2023-05-14 21:04:46', 0),
(182, 63, 'Tutor request has been sent', 'You have sent a tutor request to Viraj Sadakallum. You can cancel it by clicking here', '/UniGura/student/stats#requests', '2023-05-14 21:14:02', 1),
(184, 63, 'Message has been sent', 'Click here to go chat further', '/UniGura/student/chat', '2023-05-14 21:17:30', 1),
(185, 63, 'Your payment has been accepted', 'Click here to see all payments', 'http://localhost/UniGura/student/stats', '2023-05-14 21:21:00', 0),
(186, 60, 'Student has paid for your class', NULL, NULL, '2023-05-14 21:21:00', 1),
(187, 60, 'A Student has rescheduled a class', NULL, NULL, '2023-05-14 21:22:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `day_id` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `withdrawal_day` timestamp NULL DEFAULT NULL,
  `withdrawal_slip` int DEFAULT NULL,
  `is_withdrawed` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `tutor_id`, `amount`, `day_id`, `timestamp`, `withdrawal_day`, `withdrawal_slip`, `is_withdrawed`) VALUES
(1, 63, 60, 2500, 16, '2023-05-14 21:21:00', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_reason`
--

CREATE TABLE `report_reason` (
  `id` int NOT NULL,
  `is_for_tutor` int NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT 'Report_Reason'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int NOT NULL,
  `class_template_id` int NOT NULL,
  `mode` varchar(15) DEFAULT NULL,
  `tutor_id` int NOT NULL,
  `student_id` int NOT NULL,
  `status` int DEFAULT '0',
  `location` point DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `class_template_id`, `mode`, `tutor_id`, `student_id`, `status`, `location`) VALUES
(100, 21, 'physical', 60, 63, 1, 0xe61000000101000000965e9b8d95f6534000c974e8f4bc1b40);

-- --------------------------------------------------------

--
-- Table structure for table `request_time_slot`
--

CREATE TABLE `request_time_slot` (
  `id` int NOT NULL,
  `request_id` int NOT NULL,
  `time_slot_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `request_time_slot`
--

INSERT INTO `request_time_slot` (`id`, `request_id`, `time_slot_id`) VALUES
(173, 100, 696),
(174, 100, 703);

-- --------------------------------------------------------

--
-- Table structure for table `reschedule`
--

CREATE TABLE `reschedule` (
  `id` int NOT NULL,
  `time_slot_id` int NOT NULL,
  `tutoring_class_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `student_id` int NOT NULL,
  `class_template_id` int NOT NULL,
  `description` text,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `tutor_id`, `student_id`, `class_template_id`, `description`, `rating`) VALUES
(47, 60, 63, 21, 'This class is very good', 4);

--
-- Triggers `review`
--
DELIMITER $$
CREATE TRIGGER `class_rating` AFTER INSERT ON `review` FOR EACH ROW UPDATE tutoring_class_template 
SET current_rating = ROUND(((current_rating * rating_count) + NEW.rating) / (rating_count + 1), 1), 
    rating_count = rating_count + 1 
WHERE id = NEW.class_template_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` int NOT NULL,
  `year_of_exam` int NOT NULL DEFAULT '2018',
  `medium` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `year_of_exam`, `medium`) VALUES
(63, 2024, 'sinhala'),
(64, 2024, 'sinhala');

-- --------------------------------------------------------

--
-- Table structure for table `student_report`
--

CREATE TABLE `student_report` (
  `id` int NOT NULL,
  `description` text,
  `is_inquired` int NOT NULL DEFAULT '0',
  `student_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `reason_id` int DEFAULT NULL,
  `tutoring_class_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Subject_Name',
  `is_hidden` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `is_hidden`) VALUES
(22, 'Physics', 0),
(23, 'Chemistry', 0),
(24, 'Combine Mathamatics', 0);

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `day` varchar(31) NOT NULL,
  `time` time NOT NULL,
  `state` int NOT NULL DEFAULT '0',
  `tutoring_class_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`id`, `tutor_id`, `day`, `time`, `state`, `tutoring_class_id`) VALUES
(659, 60, 'mon', '08:00:00', 0, NULL),
(660, 60, 'tue', '08:00:00', 0, NULL),
(661, 60, 'wed', '08:00:00', 0, NULL),
(662, 60, 'thu', '08:00:00', 0, NULL),
(663, 60, 'fri', '08:00:00', 0, NULL),
(664, 60, 'sat', '08:00:00', 0, NULL),
(665, 60, 'sun', '08:00:00', 0, NULL),
(666, 60, 'mon', '10:00:00', 0, NULL),
(667, 60, 'tue', '10:00:00', 0, NULL),
(668, 60, 'wed', '10:00:00', 0, NULL),
(669, 60, 'thu', '10:00:00', 0, NULL),
(670, 60, 'fri', '10:00:00', 0, NULL),
(671, 60, 'sat', '10:00:00', 1, NULL),
(672, 60, 'sun', '10:00:00', 1, NULL),
(673, 60, 'mon', '12:00:00', 0, NULL),
(674, 60, 'tue', '12:00:00', 0, NULL),
(675, 60, 'wed', '12:00:00', 0, NULL),
(676, 60, 'thu', '12:00:00', 0, NULL),
(677, 60, 'fri', '12:00:00', 0, NULL),
(678, 60, 'sat', '12:00:00', 1, NULL),
(679, 60, 'sun', '12:00:00', 1, NULL),
(680, 60, 'mon', '14:00:00', 0, NULL),
(681, 60, 'tue', '14:00:00', 0, NULL),
(682, 60, 'wed', '14:00:00', 0, NULL),
(683, 60, 'thu', '14:00:00', 0, NULL),
(684, 60, 'fri', '14:00:00', 0, NULL),
(685, 60, 'sat', '14:00:00', 0, NULL),
(686, 60, 'sun', '14:00:00', 0, NULL),
(687, 60, 'mon', '16:00:00', 0, NULL),
(688, 60, 'tue', '16:00:00', 0, NULL),
(689, 60, 'wed', '16:00:00', 0, NULL),
(690, 60, 'thu', '16:00:00', 0, NULL),
(691, 60, 'fri', '16:00:00', 0, NULL),
(692, 60, 'sat', '16:00:00', 0, NULL),
(693, 60, 'sun', '16:00:00', 0, NULL),
(694, 60, 'mon', '18:00:00', 2, 8),
(695, 60, 'tue', '18:00:00', 1, NULL),
(696, 60, 'wed', '18:00:00', 1, NULL),
(697, 60, 'thu', '18:00:00', 0, NULL),
(698, 60, 'fri', '18:00:00', 0, NULL),
(699, 60, 'sat', '18:00:00', 1, NULL),
(700, 60, 'sun', '18:00:00', 1, NULL),
(701, 60, 'mon', '20:00:00', 2, 8),
(702, 60, 'tue', '20:00:00', 1, NULL),
(703, 60, 'wed', '20:00:00', 1, NULL),
(704, 60, 'thu', '20:00:00', 0, NULL),
(705, 60, 'fri', '20:00:00', 0, NULL),
(706, 60, 'sat', '20:00:00', 1, NULL),
(707, 60, 'sun', '20:00:00', 1, NULL),
(708, 60, 'mon', '22:00:00', 1, NULL),
(709, 60, 'tue', '22:00:00', 1, NULL),
(710, 60, 'wed', '22:00:00', 1, NULL),
(711, 60, 'thu', '22:00:00', 0, NULL),
(712, 60, 'fri', '22:00:00', 0, NULL),
(713, 60, 'sat', '22:00:00', 1, NULL),
(714, 60, 'sun', '22:00:00', 1, NULL),
(715, 61, 'mon', '08:00:00', 0, NULL),
(716, 61, 'tue', '08:00:00', 0, NULL),
(717, 61, 'wed', '08:00:00', 0, NULL),
(718, 61, 'thu', '08:00:00', 0, NULL),
(719, 61, 'fri', '08:00:00', 0, NULL),
(720, 61, 'sat', '08:00:00', 0, NULL),
(721, 61, 'sun', '08:00:00', 0, NULL),
(722, 61, 'mon', '10:00:00', 0, NULL),
(723, 61, 'tue', '10:00:00', 0, NULL),
(724, 61, 'wed', '10:00:00', 0, NULL),
(725, 61, 'thu', '10:00:00', 0, NULL),
(726, 61, 'fri', '10:00:00', 0, NULL),
(727, 61, 'sat', '10:00:00', 1, NULL),
(728, 61, 'sun', '10:00:00', 0, NULL),
(729, 61, 'mon', '12:00:00', 0, NULL),
(730, 61, 'tue', '12:00:00', 0, NULL),
(731, 61, 'wed', '12:00:00', 0, NULL),
(732, 61, 'thu', '12:00:00', 0, NULL),
(733, 61, 'fri', '12:00:00', 1, NULL),
(734, 61, 'sat', '12:00:00', 1, NULL),
(735, 61, 'sun', '12:00:00', 0, NULL),
(736, 61, 'mon', '14:00:00', 0, NULL),
(737, 61, 'tue', '14:00:00', 0, NULL),
(738, 61, 'wed', '14:00:00', 0, NULL),
(739, 61, 'thu', '14:00:00', 0, NULL),
(740, 61, 'fri', '14:00:00', 0, NULL),
(741, 61, 'sat', '14:00:00', 1, NULL),
(742, 61, 'sun', '14:00:00', 0, NULL),
(743, 61, 'mon', '16:00:00', 0, NULL),
(744, 61, 'tue', '16:00:00', 0, NULL),
(745, 61, 'wed', '16:00:00', 0, NULL),
(746, 61, 'thu', '16:00:00', 1, NULL),
(747, 61, 'fri', '16:00:00', 0, NULL),
(748, 61, 'sat', '16:00:00', 1, NULL),
(749, 61, 'sun', '16:00:00', 1, NULL),
(750, 61, 'mon', '18:00:00', 1, NULL),
(751, 61, 'tue', '18:00:00', 0, NULL),
(752, 61, 'wed', '18:00:00', 0, NULL),
(753, 61, 'thu', '18:00:00', 1, NULL),
(754, 61, 'fri', '18:00:00', 0, NULL),
(755, 61, 'sat', '18:00:00', 0, NULL),
(756, 61, 'sun', '18:00:00', 1, NULL),
(757, 61, 'mon', '20:00:00', 1, NULL),
(758, 61, 'tue', '20:00:00', 0, NULL),
(759, 61, 'wed', '20:00:00', 0, NULL),
(760, 61, 'thu', '20:00:00', 0, NULL),
(761, 61, 'fri', '20:00:00', 1, NULL),
(762, 61, 'sat', '20:00:00', 0, NULL),
(763, 61, 'sun', '20:00:00', 1, NULL),
(764, 61, 'mon', '22:00:00', 0, NULL),
(765, 61, 'tue', '22:00:00', 0, NULL),
(766, 61, 'wed', '22:00:00', 0, NULL),
(767, 61, 'thu', '22:00:00', 0, NULL),
(768, 61, 'fri', '22:00:00', 1, NULL),
(769, 61, 'sat', '22:00:00', 0, NULL),
(770, 61, 'sun', '22:00:00', 1, NULL),
(771, 62, 'mon', '08:00:00', 0, NULL),
(772, 62, 'tue', '08:00:00', 0, NULL),
(773, 62, 'wed', '08:00:00', 0, NULL),
(774, 62, 'thu', '08:00:00', 0, NULL),
(775, 62, 'fri', '08:00:00', 0, NULL),
(776, 62, 'sat', '08:00:00', 0, NULL),
(777, 62, 'sun', '08:00:00', 0, NULL),
(778, 62, 'mon', '10:00:00', 0, NULL),
(779, 62, 'tue', '10:00:00', 0, NULL),
(780, 62, 'wed', '10:00:00', 0, NULL),
(781, 62, 'thu', '10:00:00', 0, NULL),
(782, 62, 'fri', '10:00:00', 0, NULL),
(783, 62, 'sat', '10:00:00', 0, NULL),
(784, 62, 'sun', '10:00:00', 0, NULL),
(785, 62, 'mon', '12:00:00', 0, NULL),
(786, 62, 'tue', '12:00:00', 0, NULL),
(787, 62, 'wed', '12:00:00', 0, NULL),
(788, 62, 'thu', '12:00:00', 0, NULL),
(789, 62, 'fri', '12:00:00', 0, NULL),
(790, 62, 'sat', '12:00:00', 0, NULL),
(791, 62, 'sun', '12:00:00', 0, NULL),
(792, 62, 'mon', '14:00:00', 0, NULL),
(793, 62, 'tue', '14:00:00', 0, NULL),
(794, 62, 'wed', '14:00:00', 0, NULL),
(795, 62, 'thu', '14:00:00', 0, NULL),
(796, 62, 'fri', '14:00:00', 0, NULL),
(797, 62, 'sat', '14:00:00', 1, NULL),
(798, 62, 'sun', '14:00:00', 0, NULL),
(799, 62, 'mon', '16:00:00', 1, NULL),
(800, 62, 'tue', '16:00:00', 0, NULL),
(801, 62, 'wed', '16:00:00', 0, NULL),
(802, 62, 'thu', '16:00:00', 0, NULL),
(803, 62, 'fri', '16:00:00', 0, NULL),
(804, 62, 'sat', '16:00:00', 1, NULL),
(805, 62, 'sun', '16:00:00', 0, NULL),
(806, 62, 'mon', '18:00:00', 1, NULL),
(807, 62, 'tue', '18:00:00', 0, NULL),
(808, 62, 'wed', '18:00:00', 0, NULL),
(809, 62, 'thu', '18:00:00', 0, NULL),
(810, 62, 'fri', '18:00:00', 0, NULL),
(811, 62, 'sat', '18:00:00', 1, NULL),
(812, 62, 'sun', '18:00:00', 0, NULL),
(813, 62, 'mon', '20:00:00', 1, NULL),
(814, 62, 'tue', '20:00:00', 0, NULL),
(815, 62, 'wed', '20:00:00', 0, NULL),
(816, 62, 'thu', '20:00:00', 0, NULL),
(817, 62, 'fri', '20:00:00', 0, NULL),
(818, 62, 'sat', '20:00:00', 1, NULL),
(819, 62, 'sun', '20:00:00', 0, NULL),
(820, 62, 'mon', '22:00:00', 0, NULL),
(821, 62, 'tue', '22:00:00', 0, NULL),
(822, 62, 'wed', '22:00:00', 0, NULL),
(823, 62, 'thu', '22:00:00', 0, NULL),
(824, 62, 'fri', '22:00:00', 0, NULL),
(825, 62, 'sat', '22:00:00', 0, NULL),
(826, 62, 'sun', '22:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `user_id` int NOT NULL,
  `is_approved` int NOT NULL DEFAULT '0',
  `description` text,
  `university` varchar(255) NOT NULL DEFAULT 'Tutor_University',
  `is_hidden` int NOT NULL DEFAULT '0',
  `education_qualification` varchar(255) NOT NULL DEFAULT 'Tutor_Qualification',
  `id_copy` varchar(255) NOT NULL,
  `university_entrance_letter` varchar(255) NOT NULL,
  `advanced_level_result` varchar(255) NOT NULL,
  `bank_account_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `bank_account_owner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `current_rating` float NOT NULL DEFAULT '0',
  `rating_count` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`user_id`, `is_approved`, `description`, `university`, `is_hidden`, `education_qualification`, `id_copy`, `university_entrance_letter`, `advanced_level_result`, `bank_account_number`, `bank_name`, `bank_branch`, `bank_account_owner`, `current_rating`, `rating_count`) VALUES
(60, 1, 'My teaching approach is to make physics concepts easy', 'University of Jayewardenepura', 0, 'advanced-level', './tutor_detail_files/id_copy/16840912795897.pdf', './tutor_detail_files/uni_entrance/16840912791866.pdf', './tutor_detail_files/advanced_level_results/16840912795434.pdf', '123123423231', 'Sampath Bank', 'Colombo', 'AVSadakalum', 0, 0),
(61, 1, 'I am good at teaching English Medium Chemistry', 'University Of Kaleniya', 0, 'advanced-level', './tutor_detail_files/id_copy/16840942933659.pdf', './tutor_detail_files/uni_entrance/16840942933554.pdf', './tutor_detail_files/advanced_level_results/16840942938834.pdf', '123212323212', 'National Savings Bank', 'Colombo', 'm k perera', 0, 0),
(62, 1, 'Learn from a tutor who obtain 3As in Physical Science Stream', 'University of Moratuwa', 0, 'advanced-level', './tutor_detail_files/id_copy/16840982794907.pdf', './tutor_detail_files/uni_entrance/16840982798462.pdf', './tutor_detail_files/advanced_level_results/16840982793070.pdf', '1234312', 'Seylan Bank', 'Colombo', 'dihan de silva', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutoring_class`
--

CREATE TABLE `tutoring_class` (
  `id` int NOT NULL,
  `class_template_id` int DEFAULT NULL,
  `date` varchar(31) NOT NULL,
  `time` time NOT NULL,
  `duration` int NOT NULL,
  `class_type` varchar(63) NOT NULL,
  `mode` varchar(15) NOT NULL,
  `session_rate` int NOT NULL,
  `completion_status` int NOT NULL DEFAULT '0',
  `is_suspended` int NOT NULL DEFAULT '0',
  `student_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `medium` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tutoring_class`
--

INSERT INTO `tutoring_class` (`id`, `class_template_id`, `date`, `time`, `duration`, `class_type`, `mode`, `session_rate`, `completion_status`, `is_suspended`, `student_id`, `tutor_id`, `medium`) VALUES
(8, 21, 'mon', '18:00:00', 4, 'theory', 'physical', 2500, 1, 0, 63, 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutoring_class_template`
--

CREATE TABLE `tutoring_class_template` (
  `id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `module_id` int NOT NULL,
  `session_rate` int NOT NULL,
  `class_type` varchar(63) NOT NULL,
  `mode` varchar(15) NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `is_hidden` int NOT NULL DEFAULT '0',
  `current_rating` float NOT NULL DEFAULT '0',
  `rating_count` int NOT NULL DEFAULT '0',
  `medium` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tutoring_class_template`
--

INSERT INTO `tutoring_class_template` (`id`, `tutor_id`, `subject_id`, `module_id`, `session_rate`, `class_type`, `mode`, `duration`, `is_hidden`, `current_rating`, `rating_count`, `medium`) VALUES
(20, 60, 22, 15, 1000, 'theory', 'online', 2, 0, 0, 0, 0),
(21, 60, 22, 16, 2500, 'theory', 'Both', 4, 0, 4, 1, 0),
(22, 60, 24, 45, 1200, 'theory', 'online', 2, 0, 0, 0, 0),
(23, 61, 23, 27, 2000, 'theory', 'physical', 2, 0, 0, 0, 1),
(24, 61, 22, 16, 3000, 'theory', 'physical', 2, 0, 0, 0, 0),
(25, 62, 22, 16, 2500, 'theory', 'physical', 4, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tutoring_class_tutor`
-- (See below for the actual view)
--
CREATE TABLE `tutoring_class_tutor` (
`city` varchar(255)
,`class_type` varchar(63)
,`current_rating` float
,`description` text
,`duration` int
,`education_qualification` varchar(255)
,`first_name` varchar(255)
,`gender` varchar(15)
,`id` int
,`last_name` varchar(255)
,`location` point
,`medium` int
,`mode` varchar(15)
,`module_id` int
,`module_name` varchar(255)
,`profile_picture` varchar(255)
,`session_rate` int
,`subject_id` int
,`subject_name` varchar(255)
,`user_id` int
);

-- --------------------------------------------------------

--
-- Table structure for table `tutor_report`
--

CREATE TABLE `tutor_report` (
  `id` int NOT NULL,
  `description` text,
  `is_inquired` int NOT NULL DEFAULT '0',
  `tutor_id` int NOT NULL,
  `student_id` int NOT NULL,
  `reason_id` int DEFAULT NULL,
  `tutoring_class_template_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT 'First_Name',
  `last_name` varchar(255) NOT NULL DEFAULT 'Last_Name',
  `phone_number` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '0000000000',
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_banned` int NOT NULL DEFAULT '0',
  `location` point DEFAULT NULL,
  `mode` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `phone_number`, `address_line1`, `address_line2`, `city`, `district`, `gender`, `profile_picture`, `joined_date`, `is_banned`, `location`, `mode`) VALUES
(60, 'Viraj', 'Sadakallum', '0786830506', '76/C', '12A', 'Pilliyandala', 'Colombo', 'male', './public/profile_pictures/16840985797060.jpeg', '2023-05-14 19:07:59', 0, 0xe610000001010000009bae27ba2ef7534049145ad6fdb31b40, 'both'),
(61, 'Madusharini', 'Perera', '0765637381', '123', 'Kumara Road', 'Slave Island', 'Colombo', 'female', './public/profile_pictures/16840942934113.jpeg', '2023-05-14 19:58:13', 0, 0xe61000000101000000d190f12895f653402c616d8c9db01b40, 'both'),
(62, 'Dihan', 'DeSilva', '0767573172', '123', 'Flower Road', 'Borella', 'Colombo', 'male', './public/profile_pictures/16840982793459.jpeg', '2023-05-14 21:04:39', 0, 0xe610000001010000001c0c7558e1f753400ad7a3703daa1b40, 'both'),
(63, 'Janith', 'Shanaka', '0765647283', '123', 'premadasa road', 'colombo', 'Colombo', 'male', './public/profile_pictures/16840985442066.jpeg', '2023-05-14 21:09:04', 0, 0xe61000000101000000965e9b8d95f6534000c974e8f4bc1b40, 'both'),
(64, 'Neethamadhu', 'Madurasinghe', '0719830101', '19, Somapala Road', '', 'Fort', 'Colombo', 'male', './public/profile_pictures/16841231622166.png', '2023-05-15 03:59:22', 0, 0xe61000000101000000e1b4e0455ff653403622180797be1b40, 'physical');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `rate` int NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`id`, `user_id`, `rate`, `description`) VALUES
(1, 64, 3, 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int NOT NULL,
  `slip` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure for view `tutoring_class_tutor`
--
DROP TABLE IF EXISTS `tutoring_class_tutor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tutoring_class_tutor`  AS SELECT `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `user`.`city` AS `city`, `user`.`profile_picture` AS `profile_picture`, `user`.`location` AS `location`, `user`.`gender` AS `gender`, `tutor`.`user_id` AS `user_id`, `tutor`.`description` AS `description`, `tutor`.`education_qualification` AS `education_qualification`, `subject`.`name` AS `subject_name`, `module`.`name` AS `module_name`, `tutoring_class_template`.`id` AS `id`, `tutoring_class_template`.`subject_id` AS `subject_id`, `tutoring_class_template`.`module_id` AS `module_id`, `tutoring_class_template`.`session_rate` AS `session_rate`, `tutoring_class_template`.`class_type` AS `class_type`, `tutoring_class_template`.`mode` AS `mode`, `tutoring_class_template`.`duration` AS `duration`, `tutoring_class_template`.`current_rating` AS `current_rating`, `tutoring_class_template`.`medium` AS `medium` FROM ((((`tutoring_class_template` join `tutor` on((`tutoring_class_template`.`tutor_id` = `tutor`.`user_id`))) join `user` on((`tutor`.`user_id` = `user`.`id`))) join `subject` on((`tutoring_class_template`.`subject_id` = `subject`.`id`))) join `module` on((`tutoring_class_template`.`module_id` = `module`.`id`))) WHERE ((`tutoring_class_template`.`is_hidden` = 0) AND (`tutor`.`is_approved` = 1) AND (`user`.`is_banned` = 0) AND (`tutor`.`is_hidden` = 0))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_day_id` (`day_id`);

--
-- Indexes for table `activity_template`
--
ALTER TABLE `activity_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_template_day_template_id` (`day_template_id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_thread_id_chatThread_id` (`thread_id`);

--
-- Indexes for table `chat_thread`
--
ALTER TABLE `chat_thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_user_id_1_user_id` (`user_id_1`),
  ADD KEY `chat_user_id_2_user_id` (`user_id_2`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_class_id` (`class_id`);

--
-- Indexes for table `day_template`
--
ALTER TABLE `day_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_template_class_template_id` (`class_template_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD UNIQUE KEY `name_3` (`name`),
  ADD KEY `module_subject_id` (`subject_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_student_id` (`student_id`),
  ADD KEY `payment_tutor_id` (`tutor_id`),
  ADD KEY `payment_day_id` (`day_id`),
  ADD KEY `withdrwal_slip_id` (`withdrawal_slip`);

--
-- Indexes for table `report_reason`
--
ALTER TABLE `report_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_tutor_id` (`tutor_id`),
  ADD KEY `request_student_id` (`student_id`),
  ADD KEY `request_class_template_id` (`class_template_id`);

--
-- Indexes for table `request_time_slot`
--
ALTER TABLE `request_time_slot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_time_slot_request_id` (`request_id`),
  ADD KEY `request_time_slot_id_time_slot_id` (`time_slot_id`);

--
-- Indexes for table `reschedule`
--
ALTER TABLE `reschedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reschedule_time_slot_id` (`time_slot_id`),
  ADD KEY `reschedule_tutoring_class_id` (`tutoring_class_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_tutor_id` (`tutor_id`),
  ADD KEY `review_student_id` (`student_id`),
  ADD KEY `review_class_template_id` (`class_template_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `student_report`
--
ALTER TABLE `student_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_report_student_id` (`student_id`),
  ADD KEY `student_report_tutor_id` (`tutor_id`),
  ADD KEY `reason_id` (`reason_id`),
  ADD KEY `tutoring_class_which_we_suspend` (`tutoring_class_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_slot_class_id` (`tutoring_class_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD UNIQUE KEY `id_copy` (`id_copy`),
  ADD UNIQUE KEY `university_entrance_letter` (`university_entrance_letter`),
  ADD UNIQUE KEY `advanced_level_result` (`advanced_level_result`),
  ADD UNIQUE KEY `bank_account_owner` (`bank_account_owner`),
  ADD UNIQUE KEY `bank_number` (`bank_account_number`),
  ADD KEY `tutor_id_user_id` (`user_id`);

--
-- Indexes for table `tutoring_class`
--
ALTER TABLE `tutoring_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutoring_class_student_id` (`student_id`),
  ADD KEY `tutoring_class_tutor_id` (`tutor_id`),
  ADD KEY `tutoring_class_class_template_id` (`class_template_id`);

--
-- Indexes for table `tutoring_class_template`
--
ALTER TABLE `tutoring_class_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_template_tutor_id` (`tutor_id`),
  ADD KEY `class_template_subject_id` (`subject_id`),
  ADD KEY `class_template_module_id` (`module_id`);

--
-- Indexes for table `tutor_report`
--
ALTER TABLE `tutor_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_report_tutor_id_user_id` (`tutor_id`),
  ADD KEY `tutor_report_student_id_user_id` (`student_id`),
  ADD KEY `reason_id` (`reason_id`),
  ADD KEY `tutoring_class_template_which_we_suspend` (`tutoring_class_template_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_feedback_use_id` (`user_id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `activity_template`
--
ALTER TABLE `activity_template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `chat_thread`
--
ALTER TABLE `chat_thread`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `day_template`
--
ALTER TABLE `day_template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_reason`
--
ALTER TABLE `report_reason`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `request_time_slot`
--
ALTER TABLE `request_time_slot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `reschedule`
--
ALTER TABLE `reschedule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `student_report`
--
ALTER TABLE `student_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=827;

--
-- AUTO_INCREMENT for table `tutoring_class`
--
ALTER TABLE `tutoring_class`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tutoring_class_template`
--
ALTER TABLE `tutoring_class_template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tutor_report`
--
ALTER TABLE `tutor_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_day_id` FOREIGN KEY (`day_id`) REFERENCES `day` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_template`
--
ALTER TABLE `activity_template`
  ADD CONSTRAINT `activity_template_day_template_id` FOREIGN KEY (`day_template_id`) REFERENCES `day_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_thread_id_chatThread_id` FOREIGN KEY (`thread_id`) REFERENCES `chat_thread` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `chat_thread`
--
ALTER TABLE `chat_thread`
  ADD CONSTRAINT `chat_user_id_1_user_id` FOREIGN KEY (`user_id_1`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `chat_user_id_2_user_id` FOREIGN KEY (`user_id_2`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `day`
--
ALTER TABLE `day`
  ADD CONSTRAINT `day_class_id` FOREIGN KEY (`class_id`) REFERENCES `tutoring_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `day_template`
--
ALTER TABLE `day_template`
  ADD CONSTRAINT `day_template_class_template_id` FOREIGN KEY (`class_template_id`) REFERENCES `tutoring_class_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_day_id` FOREIGN KEY (`day_id`) REFERENCES `day` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `withdrwal_slip_id` FOREIGN KEY (`withdrawal_slip`) REFERENCES `withdrawal` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_class_template_id` FOREIGN KEY (`class_template_id`) REFERENCES `tutoring_class_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_time_slot`
--
ALTER TABLE `request_time_slot`
  ADD CONSTRAINT `request_time_slot_id_time_slot_id` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_time_slot_request_id` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reschedule`
--
ALTER TABLE `reschedule`
  ADD CONSTRAINT `reschedule_time_slot_id` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reschedule_tutoring_class_id` FOREIGN KEY (`tutoring_class_id`) REFERENCES `tutoring_class` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_class_template_id` FOREIGN KEY (`class_template_id`) REFERENCES `tutoring_class_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_report`
--
ALTER TABLE `student_report`
  ADD CONSTRAINT `student_report_ibfk_1` FOREIGN KEY (`reason_id`) REFERENCES `report_reason` (`id`),
  ADD CONSTRAINT `student_report_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_report_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutoring_class_which_we_suspend` FOREIGN KEY (`tutoring_class_id`) REFERENCES `tutoring_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD CONSTRAINT `time_slot_class_id` FOREIGN KEY (`tutoring_class_id`) REFERENCES `tutoring_class` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `time_slot_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tutoring_class`
--
ALTER TABLE `tutoring_class`
  ADD CONSTRAINT `tutoring_class_class_template_id` FOREIGN KEY (`class_template_id`) REFERENCES `tutoring_class_template` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tutoring_class_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tutoring_class_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tutoring_class_template`
--
ALTER TABLE `tutoring_class_template`
  ADD CONSTRAINT `class_template_module_id` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `class_template_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `class_template_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutor_report`
--
ALTER TABLE `tutor_report`
  ADD CONSTRAINT `tutor_report_ibfk_1` FOREIGN KEY (`reason_id`) REFERENCES `report_reason` (`id`),
  ADD CONSTRAINT `tutor_report_student_id_user_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutor_report_tutor_id_user_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutor` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutoring_class_template_which_we_suspend` FOREIGN KEY (`tutoring_class_template_id`) REFERENCES `tutoring_class_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_id_auth_id` FOREIGN KEY (`id`) REFERENCES `auth` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD CONSTRAINT `user_feedback_use_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2025 at 06:45 AM
-- Server version: 8.0.44-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scms_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('attending','absence','permission') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `course_offering_id`, `date`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 51, 3, '2025-12-20', 'attending', 'Consectetur doloremq', '2025-12-20 02:54:27', '2025-12-20 03:27:19', NULL),
(2, 30, 3, '2025-12-20', 'attending', 'Dicta eius corporis', '2025-12-20 03:27:19', '2025-12-20 03:27:19', NULL),
(3, 54, 3, '2025-12-20', 'attending', 'Minima consectetur v', '2025-12-20 03:27:19', '2025-12-20 03:27:19', NULL),
(4, 12, 3, '2025-12-20', 'attending', 'Aut modi ipsam place', '2025-12-20 03:27:19', '2025-12-20 03:27:19', NULL),
(5, 7, 3, '2025-12-20', 'attending', 'Sed aute deserunt es', '2025-12-20 03:27:19', '2025-12-20 03:27:19', NULL),
(6, 40, 3, '2025-12-20', 'attending', 'Reprehenderit labor', '2025-12-20 03:27:19', '2025-12-20 03:27:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('scms_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:66:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"create_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"view_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"update_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:17:\"delete_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:16:\"create_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"view_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"update_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"delete_classroom\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:22:\"create_course-offering\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:20:\"view_course-offering\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:22:\"update_course-offering\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:22:\"delete_course-offering\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:17:\"create_enrollment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"view_enrollment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:17:\"update_enrollment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:17:\"delete_enrollment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"create_exam\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:9:\"view_exam\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:11:\"update_exam\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"delete_exam\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:14:\"create_expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"view_expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:14:\"update_expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"delete_expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:23:\"create_expense-category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:21:\"view_expense-category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:23:\"update_expense-category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:23:\"delete_expense-category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:10:\"create_fee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:8:\"view_fee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:10:\"update_fee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:10:\"delete_fee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:15:\"create_fee-type\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:13:\"view_fee-type\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:15:\"update_fee-type\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:15:\"delete_fee-type\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:12:\"create_score\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:10:\"view_score\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:12:\"update_score\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"delete_score\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:14:\"create_subject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:12:\"view_subject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"update_subject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:14:\"delete_subject\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:17:\"create_permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:15:\"view_permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:17:\"update_permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:17:\"delete_permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:14:\"create_teacher\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:12:\"view_teacher\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:14:\"update_teacher\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:14:\"delete_teacher\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:14:\"create_student\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:12:\"view_student\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:14:\"update_student\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:14:\"delete_student\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:14:\"view_dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:11:\"view_report\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}}}', 1766253254);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `room_number`, `capacity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Room 100', 'A145', 25, '2025-12-19 17:54:10', '2025-12-20 02:41:49', NULL),
(2, 'Room 101', 'B201', 25, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_offerings`
--

CREATE TABLE `course_offerings` (
  `id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED DEFAULT NULL,
  `classroom_id` bigint UNSIGNED DEFAULT NULL,
  `time_slot` enum('morning','afternoon','evening') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'morning',
  `schedule` enum('mon-wed','mon-fri','wed-fri','sat-sun') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mon-fri',
  `payment_type` enum('course','monthly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'course',
  `is_final_only` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `join_start` date DEFAULT NULL,
  `join_end` date DEFAULT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_offerings`
--

INSERT INTO `course_offerings` (`id`, `subject_id`, `teacher_id`, `classroom_id`, `time_slot`, `schedule`, `payment_type`, `is_final_only`, `start_time`, `end_time`, `join_start`, `join_end`, `fee`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 1, 'morning', 'mon-wed', 'course', 0, '02:02:47', '10:01:24', '2025-04-10', '2025-10-26', 277.15, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(2, 2, 3, 2, 'morning', 'mon-wed', 'monthly', 0, '07:32:13', '22:55:42', '2025-05-31', '2025-11-16', 272.97, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(3, 3, 4, 1, 'afternoon', 'mon-wed', 'course', 0, '16:48:24', '02:43:11', '2025-12-21', '2026-03-19', 50.03, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(4, 1, 2, 2, 'afternoon', 'mon-wed', 'course', 0, '01:39:35', '03:52:19', '2025-03-26', '2026-02-21', 157.19, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(5, 2, 3, 1, 'evening', 'mon-wed', 'monthly', 0, '08:33:53', '03:54:05', '2025-02-09', '2025-07-25', 69.18, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(6, 3, 4, 2, 'evening', 'mon-wed', 'monthly', 0, '05:43:10', '07:26:03', '2025-06-03', '2025-07-22', 258.68, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(7, 1, 2, 1, 'morning', 'mon-fri', 'monthly', 0, '01:21:05', '10:25:08', '2025-04-08', '2026-02-25', 89.88, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `status` enum('studying','suspended','dropped','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'studying',
  `attendance_grade` decimal(5,2) DEFAULT NULL,
  `listening_grade` decimal(5,2) DEFAULT NULL,
  `writing_grade` decimal(5,2) DEFAULT NULL,
  `reading_grade` decimal(5,2) DEFAULT NULL,
  `speaking_grade` decimal(5,2) DEFAULT NULL,
  `midterm_grade` decimal(5,2) DEFAULT NULL,
  `final_grade` decimal(5,2) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_offering_id`, `status`, `attendance_grade`, `listening_grade`, `writing_grade`, `reading_grade`, `speaking_grade`, `midterm_grade`, `final_grade`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 51, 3, 'studying', 10.00, NULL, NULL, NULL, NULL, 2.20, NULL, NULL, '2025-12-19 17:54:33', '2025-12-20 05:06:10'),
(2, 51, 7, 'studying', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:54:42', '2025-12-19 17:54:42'),
(3, 51, 4, 'studying', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:54:51', '2025-12-19 17:54:51'),
(4, 30, 3, 'studying', 10.00, NULL, NULL, NULL, NULL, 7.00, NULL, NULL, '2025-12-20 02:56:56', '2025-12-20 05:06:10'),
(5, 54, 3, 'studying', 10.00, NULL, NULL, NULL, NULL, 19.00, NULL, NULL, '2025-12-20 02:57:10', '2025-12-20 05:06:10'),
(6, 12, 3, 'studying', 10.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, '2025-12-20 02:57:17', '2025-12-20 05:06:10'),
(7, 7, 3, 'studying', 10.00, NULL, NULL, NULL, NULL, 0.20, NULL, NULL, '2025-12-20 02:57:27', '2025-12-20 05:06:10'),
(8, 40, 3, 'studying', 10.00, NULL, NULL, NULL, NULL, 5.40, NULL, NULL, '2025-12-20 02:57:35', '2025-12-20 05:06:10'),
(9, 26, 3, 'studying', NULL, NULL, NULL, NULL, NULL, 1.80, NULL, NULL, '2025-12-20 04:16:44', '2025-12-20 05:06:10'),
(10, 8, 3, 'studying', NULL, NULL, NULL, NULL, NULL, 5.80, NULL, NULL, '2025-12-20 04:18:33', '2025-12-20 05:06:10'),
(11, 15, 3, 'studying', NULL, NULL, NULL, NULL, NULL, 17.20, NULL, NULL, '2025-12-20 04:35:14', '2025-12-20 05:06:10'),
(12, 20, 3, 'suspended', NULL, NULL, NULL, NULL, NULL, 9.60, NULL, NULL, '2025-12-20 04:35:24', '2025-12-20 07:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `course_offering_id` bigint UNSIGNED NOT NULL,
  `type` enum('midterm','final','speaking','listening','reading','writing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `total_marks` int NOT NULL,
  `passing_marks` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `course_offering_id`, `type`, `description`, `date`, `total_marks`, `passing_marks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'midterm', NULL, '2026-04-02', 100, 60, '2025-12-20 04:39:30', '2025-12-20 04:39:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `expense_category_id` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `title`, `description`, `amount`, `date`, `expense_category_id`, `approved_by`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Non ad sed fugit cu', 'Id sit repudiandae', 60.00, '2025-09-16', 1, 1, 1, '2025-12-20 06:56:39', '2025-12-20 06:59:15', NULL),
(2, 'sdf', 'sdf', 20.00, '2025-12-20', 1, NULL, 1, '2025-12-20 07:02:42', '2025-12-20 07:02:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CEO', NULL, '2025-12-20 06:55:05', '2025-12-20 06:55:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `enrollment_id` bigint UNSIGNED NOT NULL,
  `fee_type_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `enrollment_id`, `fee_type_id`, `created_by`, `amount`, `due_date`, `remarks`, `payment_date`, `payment_method`, `transaction_id`, `received_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 51, 1, 1, 1, 50.03, '2026-01-04', NULL, '2025-12-20', 'Cash', 'SCMS:G2-MWEAU-WCLXH-1KVW7-5CTW0', 1, '2025-12-19 17:54:33', '2025-12-20 06:54:54', NULL),
(2, 51, 2, 1, 1, 89.88, '2025-04-16', NULL, '2025-12-19', 'Cash', 'SCMS-U9JF9-5ZU7M-LEL3O-5XVXK', 1, '2025-12-19 17:54:42', '2025-12-19 17:55:10', NULL),
(3, 51, 2, 1, 1, 89.88, '2025-05-16', NULL, '2025-12-19', 'Cash', 'SCMS-M2AMX-WI4U5-TOZ22-BH242', 1, '2025-12-19 17:54:42', '2025-12-19 17:55:14', NULL),
(4, 51, 2, 1, 1, 89.88, '2025-06-16', NULL, '2025-12-19', 'Cash', 'SCMS-YO3E2-7VSQU-GR9VK-PGBJ0', 1, '2025-12-19 17:54:42', '2025-12-19 17:55:17', NULL),
(5, 51, 2, 1, 1, 89.88, '2025-07-16', NULL, '2025-12-19', 'Cash', 'SCMS-QAIH5-74LDF-NHTO0-H0E34', 1, '2025-12-19 17:54:42', '2025-12-19 17:55:20', NULL),
(6, 51, 2, 1, 1, 89.88, '2025-08-16', NULL, '2025-12-19', 'Cash', 'SCMS-8XXBR-SXHVQ-SKLJ6-IQ7S8', 1, '2025-12-19 17:54:42', '2025-12-19 17:55:23', NULL),
(7, 51, 2, 1, 1, 89.88, '2025-09-16', NULL, '2025-12-20', 'Cash', 'SCMS-9BXUF-J91ML-JVNJQ-MCXW4', 1, '2025-12-19 17:54:42', '2025-12-20 04:16:48', NULL),
(8, 51, 2, 1, 1, 89.88, '2025-10-16', NULL, '2025-12-20', 'Cash', 'SCMS-6VJAW-3CR9E-DYMZ6-MEQKE', 1, '2025-12-19 17:54:42', '2025-12-20 05:22:21', NULL),
(9, 51, 2, 1, 1, 89.88, '2025-11-16', NULL, '2025-12-20', 'Cash', 'SCMS-G2-XRYXI-7SF2S-N9ZJS-G90TP', 1, '2025-12-19 17:54:42', '2025-12-20 05:24:27', NULL),
(10, 51, 2, 1, 1, 89.88, '2025-12-16', NULL, '2025-12-20', 'Cash', 'SCMS:G2-2QDSC-7BPCF-JEXXL-Q5ZLC', 1, '2025-12-19 17:54:42', '2025-12-20 05:25:35', NULL),
(11, 51, 2, 1, 1, 89.88, '2026-01-16', NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:54:42', '2025-12-19 17:54:42', NULL),
(12, 51, 2, 1, 1, 89.88, '2026-02-16', NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:54:42', '2025-12-19 17:54:42', NULL),
(13, 51, 3, 1, 1, 157.19, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:54:51', '2025-12-19 17:54:51', NULL),
(14, 30, 4, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 02:56:56', '2025-12-20 02:56:56', NULL),
(15, 54, 5, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 02:57:10', '2025-12-20 02:57:10', NULL),
(16, 12, 6, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 02:57:17', '2025-12-20 02:57:17', NULL),
(17, 7, 7, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 02:57:27', '2025-12-20 02:57:27', NULL),
(18, 40, 8, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 02:57:35', '2025-12-20 02:57:35', NULL),
(19, 26, 9, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 04:16:44', '2025-12-20 04:16:44', NULL),
(20, 8, 10, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 04:18:33', '2025-12-20 04:18:33', NULL),
(21, 15, 11, 1, 1, 50.03, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 04:35:14', '2025-12-20 04:35:14', NULL),
(22, 20, 12, 1, 1, 50.03, '2026-01-04', NULL, '2025-12-20', 'Cash', 'SCMS:G2-ZPTSV-SKCUP-4K7FU-UGDP9', 1, '2025-12-20 04:35:24', '2025-12-20 05:51:50', NULL),
(23, 7, 7, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(24, 8, 10, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(25, 12, 6, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(26, 15, 11, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(27, 20, 12, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(28, 26, 9, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(29, 30, 4, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(30, 40, 8, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(31, 51, 1, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(32, 54, 5, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(33, 51, 3, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL),
(34, 51, 2, 2, 1, 20.00, '2026-01-04', NULL, NULL, NULL, NULL, NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Course Fee', 'Automatically generated fee type for course enrollment', '2025-12-19 17:54:33', '2025-12-19 17:54:33', NULL),
(2, 'CEO', NULL, '2025-12-20 05:58:50', '2025-12-20 05:58:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '1_create_tb', 1),
(2, '2_create_cache_table', 1),
(3, '3_create_personal_access_tokens_table', 1),
(4, '4_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 35),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 43),
(3, 'App\\Models\\User', 44),
(3, 'App\\Models\\User', 45),
(3, 'App\\Models\\User', 46),
(3, 'App\\Models\\User', 47),
(3, 'App\\Models\\User', 48),
(3, 'App\\Models\\User', 49),
(3, 'App\\Models\\User', 50),
(3, 'App\\Models\\User', 51),
(3, 'App\\Models\\User', 52),
(3, 'App\\Models\\User', 53),
(3, 'App\\Models\\User', 54),
(3, 'App\\Models\\User', 55);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('01f388b7-1e21-4548-a02f-9b867b9d4c4e', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/7\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-20 04:16:48', '2025-12-20 07:38:14'),
('0643f2cb-1231-4cde-bbb5-c4a8e077a66c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 23, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('08d01866-645f-4895-8c2f-ccf6cf4a3cf8', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 16, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('0abecea8-149c-487b-9028-0a490c70424f', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/26\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('0d969def-9863-412e-a9c9-207c1470b74a', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 17, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('0e9fb99a-7c3f-4559-a7cf-1dad38c23ca1', 'App\\Notifications\\ExpenseCategoryModified', 'App\\Models\\User', 1, '{\"title\":\"Expense Category Created\",\"body\":\"The expense category \\\"CEO\\\" has been created.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expense_categories\\/1\",\"category_id\":1,\"action\":\"created\"}', '2025-12-20 07:38:14', '2025-12-20 06:55:05', '2025-12-20 07:38:14'),
('118c9eb3-7127-4474-a306-2ab41efb2002', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 30, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('1df5dbe0-e2dc-4d79-91c6-617cf382f7a5', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 20, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('1eba2c6b-c468-4093-a2f9-4ddee4bb94c4', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 12, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('1fe3c9e6-1169-4bb0-ace3-6d0ba0e62ac9', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 43, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('21ff6434-8784-46e4-ab99-87f297106ce3', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/31\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('22cd566d-3096-443c-b45a-b6a11b87a9ac', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/9\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-20 05:24:27', '2025-12-20 07:38:14'),
('26d76d10-63cf-462a-9bcf-1d6408393eed', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 8, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('26ff26b7-4e6d-4c54-adc3-e4628884da27', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 38, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('294e3602-9d24-45d8-86de-bd1d82206b73', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 54, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('2fc943e8-4cd9-4ea3-9290-054af592cc7e', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Adrian Greenholt PhD in English Grammar\",\"body\":\"Adrian Greenholt PhD has successfully enrolled in the course \'English Grammar\'. The fee is $89.88.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/51\\/7\",\"date\":\"Dec 20, 2025 00:54 AM\"}', '2025-12-20 07:38:14', '2025-12-19 17:54:42', '2025-12-20 07:38:14'),
('2fd82bbc-7624-4e4d-8786-9bacd9140b02', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 20, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('329a3a80-5034-4cff-ac5c-acf195e3aa70', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/33\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('338c386f-b330-4e94-9b93-4a34552ba349', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/23\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('33a2ffda-580d-4826-871f-4cb50b326f5f', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 34, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('34b34110-6216-415b-8a8b-9543c2ef1ad5', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Deonte Toy in Microeconomics\",\"body\":\"Deonte Toy has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/20\\/3\",\"date\":\"Dec 20, 2025 11:35 AM\"}', '2025-12-20 07:38:14', '2025-12-20 04:35:24', '2025-12-20 07:38:14'),
('370e0611-c1bc-43bd-ae66-b5a93229844f', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 50, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('374c3208-7e48-4f43-8b08-16dd1f9ddcdb', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 35, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('3cedc0f2-6b1e-4256-8834-205db1cd75fc', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 2, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('40f87375-924e-4f4d-9829-01dfc57879f5', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 12, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('427a518a-ff80-494c-aca9-40bf5d53e46c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 24, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('43a517d2-8f78-40ed-9d01-879e7258386f', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 27, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('44ce2184-6059-4a43-8320-fb8b9f2c4dfe', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 30, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('44f1e669-c589-4a84-b3e6-8e9a5ed749eb', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $50.03\",\"body\":\"Payment for Course Fee by Deonte Toy has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/22\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-20 05:51:50', '2025-12-20 07:38:14'),
('46879922-b6d8-41db-8547-6e1b443d2f0c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 44, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('4947dde8-aaeb-4e9a-bbf4-cec1a3fd91c7', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/25\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('4a354e3a-1b5c-4930-aa09-7cf465bd3cf0', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 54, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('4c8e93cc-f16d-4f96-88bf-2bca14145f46', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/34\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('4d66a6f8-e5c7-4b20-a733-d027be89b0dd', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Conner Hirthe in Microeconomics\",\"body\":\"Conner Hirthe has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/8\\/3\",\"date\":\"Dec 20, 2025 11:18 AM\"}', '2025-12-20 07:38:14', '2025-12-20 04:18:33', '2025-12-20 07:38:14'),
('4faee911-1f2d-4f68-9afe-85e524b68a25', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 36, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('50c82664-869b-4922-982c-470dbd9fcf22', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Adrian Greenholt PhD in English Grammar\",\"body\":\"Adrian Greenholt PhD has successfully enrolled in the course \'English Grammar\'. The fee is $157.19.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/51\\/4\",\"date\":\"Dec 20, 2025 00:54 AM\"}', '2025-12-20 07:38:14', '2025-12-19 17:54:51', '2025-12-20 07:38:14'),
('515e6a97-87a9-4698-b9a8-a5aa41335e9f', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 31, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('547e2149-1595-4439-8004-d51989eed2ec', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 42, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('596b18f5-f649-4898-b555-f5f228f78d59', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 8, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('5a359965-5559-40ed-b11e-353c5bfbdd0c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 55, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('63c42302-5192-4bec-bfef-e486bb2eb2e8', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 45, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('640f2932-3d96-4bf7-8ebe-bf6e1d0ce530', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 49, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('6c3be848-bf76-41a6-930c-255995fdd90d', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 19, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('7570738d-2e68-4de1-aba2-8f0c79d53083', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/6\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-19 17:55:23', '2025-12-20 07:38:14'),
('7a0a6fa5-d799-4894-ba05-feb444637e78', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Brenden Wisoky in Microeconomics\",\"body\":\"Brenden Wisoky has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/12\\/3\",\"date\":\"Dec 20, 2025 09:57 AM\"}', '2025-12-20 07:38:14', '2025-12-20 02:57:17', '2025-12-20 07:38:14'),
('7a80b274-f325-49a7-a2ae-b6f54dcdb253', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/5\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-19 17:55:20', '2025-12-20 07:38:14'),
('7be0d123-a5a0-45d4-8fa3-c86dab3de301', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 46, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('7daf2968-cf18-4c61-ba38-80fb30b1a06a', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 39, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('827af90c-1434-4ca5-a34f-9f03a96ee992', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 48, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('83dc2a7a-bd27-4120-94c8-29cfc55e79be', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/4\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-19 17:55:17', '2025-12-20 07:38:14'),
('89265c2c-711b-41a7-9c17-c33069fdba22', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 29, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('8e913e44-ae64-4270-bd2b-b1a8473ac953', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 26, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('9186de81-7a1f-42a7-a201-b85d6d8630e6', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 13, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('91ea00aa-3f4c-4976-be55-adcf64f525a1', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 53, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('9256505e-4da0-40de-89e3-a55894cca9cb', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 5, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('943ffb09-22eb-4767-8f8a-0d03a80c5254', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/32\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('962ce160-7d9d-47e2-80ee-532c520f5c29', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 18, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('97ea7865-610f-4b1f-b5ed-e67cef29f47b', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 1, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $20.00 was submitted for category: CEO\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/2\"}', '2025-12-20 07:38:14', '2025-12-20 07:02:43', '2025-12-20 07:38:14'),
('9810ee10-1552-4c5b-b9cb-8a6308e6a6bb', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/2\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-19 17:55:10', '2025-12-20 07:38:14'),
('99507c17-56fe-49a4-bf1b-79b3973a7488', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 51, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('997dae27-55d5-4ee1-8d7d-1cb8552fd638', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Celestino Corwin in Microeconomics\",\"body\":\"Celestino Corwin has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/40\\/3\",\"date\":\"Dec 20, 2025 09:57 AM\"}', '2025-12-20 07:38:14', '2025-12-20 02:57:35', '2025-12-20 07:38:14'),
('9a3be6e4-cc8e-4308-ad52-941811c5407e', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 25, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('9b48c1a1-6f21-4056-ab23-5f6fa0523665', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 51, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('9ccd7e1a-f974-41c1-a44b-361da9fea4c8', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 33, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('9d29adea-792f-4843-8800-0da8b392fe4e', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/3\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-19 17:55:14', '2025-12-20 07:38:14'),
('a3748990-3690-4981-abd5-b5f70c5443d8', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Cameron Toy in Microeconomics\",\"body\":\"Cameron Toy has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/7\\/3\",\"date\":\"Dec 20, 2025 09:57 AM\"}', '2025-12-20 07:38:14', '2025-12-20 02:57:27', '2025-12-20 07:38:14'),
('ab6b1b40-c047-4e15-8dac-2dee50cc5fb2', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 15, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('adb207de-bfd1-4ee6-a589-70cab6706d94', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/27\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('afe69c7b-b18f-457c-abec-b45e11a5f500', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $50.03\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/1\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-20 06:54:54', '2025-12-20 07:38:14'),
('b26d6eb9-552a-4a8c-bc2f-972f93f57225', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/28\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('b85a37d2-e0da-4886-bf68-c207d531d775', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 22, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('b9472d4d-b5a5-4afd-831c-7976ba6dd6d9', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 1, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', '2025-12-20 07:38:14', '2025-12-20 07:37:36', '2025-12-20 07:38:14'),
('bee3ca61-ac79-42f6-8523-558b83d9975a', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 40, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('bf49ab52-158a-458f-9942-2d9ef04816f9', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 40, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('c295efca-f815-41c7-a6d0-7c945d3b2867', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 7, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('c29fef66-f092-4e2f-98ef-7c31074b1932', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/30\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('c3efc8af-1b9f-4fcf-81e2-68789b729855', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/8\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-20 05:22:21', '2025-12-20 07:38:14'),
('c55eb741-a80f-4c7d-847d-d47eac2f559f', 'App\\Notifications\\FeePaidNotification', 'App\\Models\\User', 1, '{\"title\":\"Fee Paid: $89.88\",\"body\":\"Payment for Course Fee by Adrian Greenholt PhD has been recorded.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/10\",\"date\":null}', '2025-12-20 07:38:14', '2025-12-20 05:25:35', '2025-12-20 07:38:14'),
('c5957c77-b778-44d7-97ff-84c49f209bab', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 4, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('c8e589dd-140a-4b87-bcc1-996e67a814fb', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 32, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('caadbba4-a54d-4ccb-91a2-0c26f5e9b1e3', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Cordell Jaskolski in Microeconomics\",\"body\":\"Cordell Jaskolski has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/15\\/3\",\"date\":\"Dec 20, 2025 11:35 AM\"}', '2025-12-20 07:38:14', '2025-12-20 04:35:14', '2025-12-20 07:38:14'),
('cb56e585-fc3c-4783-87a8-feda4d01c12c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 21, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('cb91de57-ccab-4e84-84ff-8db9a1261fcd', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 52, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('cce6a601-f5f1-436e-a024-d8dd50785f3f', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 11, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('cd88503e-e376-49f1-9ebb-6464c67a47d5', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 10, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('ce892184-9106-4583-baa5-9da2745c7394', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 47, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('d1905373-4850-4fa3-be50-e764d676783a', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 9, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('d2a9dad8-7a35-4353-982a-d973821b136c', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/24\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('d2dbd90d-741b-486a-bfe6-d3f37dcbc439', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 41, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('d42acdd8-6f47-47b9-9f95-b68be54498e1', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 28, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('dbf82999-d0af-4d11-b81c-1742badd8d3f', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 14, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('dde283e8-ec6f-4cbd-8bf4-024a512c5815', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 7, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('e04c177d-dc86-498c-bd33-3580fb7c3871', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 26, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('e37cdd8e-9106-4d10-8d60-6fce34ecf8eb', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Antwan Langworth in Microeconomics\",\"body\":\"Antwan Langworth has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/54\\/3\",\"date\":\"Dec 20, 2025 09:57 AM\"}', '2025-12-20 07:38:14', '2025-12-20 02:57:10', '2025-12-20 07:38:14'),
('e8ec61ef-6ff3-4479-967f-79a363662aa2', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 3, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('ecbc9ec5-3d82-4611-b2f4-4061f1220b6c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 37, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36'),
('f3cb4be4-129b-4c89-8acd-1f14ec20f30e', 'App\\Notifications\\ExpenseCreated', 'App\\Models\\User', 1, '{\"title\":\"New Expense Submitted\",\"body\":\"A new expense of $60.00 was submitted for category: CEO\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/expenses\\/1\"}', '2025-12-20 07:38:14', '2025-12-20 06:56:39', '2025-12-20 07:38:14'),
('f778ddec-e285-47cd-b728-f13d5e7caa08', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Adrian Greenholt PhD in Microeconomics\",\"body\":\"Adrian Greenholt PhD has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/51\\/3\",\"date\":\"Dec 20, 2025 00:54 AM\"}', '2025-12-20 07:38:14', '2025-12-19 17:54:33', '2025-12-20 07:38:14'),
('f8aa54ba-158c-4b23-9a76-8476fe64524b', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Alex Lind in Microeconomics\",\"body\":\"Alex Lind has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/30\\/3\",\"date\":\"Dec 20, 2025 09:56 AM\"}', '2025-12-20 07:38:14', '2025-12-20 02:56:56', '2025-12-20 07:38:14'),
('fbd50983-4676-4955-bf16-780621480fe5', 'App\\Notifications\\NewCourseEnrollment', 'App\\Models\\User', 1, '{\"title\":\"New Enrollment: Chandler McGlynn in Microeconomics\",\"body\":\"Chandler McGlynn has successfully enrolled in the course \'Microeconomics\'. The fee is $50.03.\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/enrollments\\/26\\/3\",\"date\":\"Dec 20, 2025 11:16 AM\"}', '2025-12-20 07:38:14', '2025-12-20 04:16:44', '2025-12-20 07:38:14'),
('fc8b02aa-4cab-4f01-ba54-f300a5afbb7c', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 15, '{\"title\":\"sfsdf\",\"body\":\"sdfsfsdfsdfsdf\"}', NULL, '2025-12-20 07:30:23', '2025-12-20 07:30:23'),
('fcbd7263-5b4c-4d34-870a-7798db634d0a', 'App\\Notifications\\FeeAssigned', 'App\\Models\\User', 1, '{\"title\":\"New CEO Assigned\",\"body\":\"You have been assigned a new fee of $20.00 (Due: Jan 04, 2026).\",\"link\":\"http:\\/\\/127.0.0.1:8102\\/admin\\/fees\\/29\",\"status\":\"unpaid\"}', '2025-12-20 07:38:14', '2025-12-20 05:58:50', '2025-12-20 07:38:14'),
('ffc2db26-5ef6-4529-a810-a554ee2c2e1a', 'App\\Notifications\\CustomNotification', 'App\\Models\\User', 6, '{\"title\":\"fdsdfasdfsa\",\"body\":\"fsdfasdfasdfsadf\"}', NULL, '2025-12-20 07:37:36', '2025-12-20 07:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_attendance', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(2, 'view_attendance', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(3, 'update_attendance', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(4, 'delete_attendance', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(5, 'create_classroom', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(6, 'view_classroom', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(7, 'update_classroom', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(8, 'delete_classroom', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(9, 'create_course-offering', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(10, 'view_course-offering', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(11, 'update_course-offering', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(12, 'delete_course-offering', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(13, 'create_enrollment', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(14, 'view_enrollment', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(15, 'update_enrollment', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(16, 'delete_enrollment', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(17, 'create_exam', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(18, 'view_exam', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(19, 'update_exam', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(20, 'delete_exam', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(21, 'create_expense', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(22, 'view_expense', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(23, 'update_expense', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(24, 'delete_expense', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(25, 'create_expense-category', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(26, 'view_expense-category', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(27, 'update_expense-category', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(28, 'delete_expense-category', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(29, 'create_fee', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(30, 'view_fee', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(31, 'update_fee', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(32, 'delete_fee', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(33, 'create_fee-type', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(34, 'view_fee-type', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(35, 'update_fee-type', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(36, 'delete_fee-type', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(37, 'create_score', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(38, 'view_score', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(39, 'update_score', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(40, 'delete_score', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(41, 'create_subject', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(42, 'view_subject', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(43, 'update_subject', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(44, 'delete_subject', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(45, 'create_user', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(46, 'view_user', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(47, 'update_user', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(48, 'delete_user', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(49, 'create_role', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(50, 'view_role', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(51, 'update_role', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(52, 'delete_role', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(53, 'create_permission', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(54, 'view_permission', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(55, 'update_permission', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(56, 'delete_permission', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(57, 'create_teacher', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(58, 'view_teacher', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(59, 'update_teacher', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(60, 'delete_teacher', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(61, 'create_student', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(62, 'view_student', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(63, 'update_student', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(64, 'delete_student', 'web', '2025-12-19 17:53:58', '2025-12-19 17:53:58'),
(65, 'view_dashboard', 'web', '2025-12-19 17:53:59', '2025-12-19 17:53:59'),
(66, 'view_report', 'web', '2025-12-19 17:53:59', '2025-12-19 17:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-19 17:53:59', '2025-12-19 17:53:59'),
(2, 'teacher', 'web', '2025-12-19 17:53:59', '2025-12-19 17:53:59'),
(3, 'student', 'web', '2025-12-19 17:53:59', '2025-12-19 17:53:59'),
(4, 'staff', 'web', '2025-12-19 17:53:59', '2025-12-19 17:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `exam_id` bigint UNSIGNED NOT NULL,
  `score` int NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `student_id`, `exam_id`, `score`, `grade`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 51, 1, 11, 'F', 'Quis sunt ipsam dol', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(2, 30, 1, 35, 'D', 'Voluptate neque est', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(3, 54, 1, 95, 'A+', 'Non quo quisquam con', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(4, 12, 1, 5, 'F', 'Et fuga Unde velit', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(5, 7, 1, 1, 'F', 'Minima irure et illu', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(6, 40, 1, 27, 'F', 'Non accusamus culpa', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(7, 26, 1, 9, 'F', 'Sint sint velit quas', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(8, 8, 1, 29, 'F', 'Dolor tempor maiores', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(9, 15, 1, 86, 'A', 'Possimus cumque ali', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL),
(10, 20, 1, 48, 'C', 'Minus voluptate in s', '2025-12-20 05:06:10', '2025-12-20 05:06:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aMLcD1y0RDCfgv1s5Du5OGyuNr9KNJw0yQniBaK3', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ0lkSFZFc2lkbnAyMnVaT05McUFraGNRUVNnUzdXUllzeUk5eHg5eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODEwMi9hZG1pbi9wcm9maWxlIjtzOjU6InJvdXRlIjtzOjE4OiJhZG1pbi5wcm9maWxlLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1766217766),
('eYWT9Hveg3Y3j9Cc9lUVC6yLOLJegqIaibSXksiD', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOUtOem1YUHJtcGc0c0wwbjljdkxpSm9ia2VZbVVzNTRkTVVLc2xSeSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjc2OiJodHRwOi8vMTI3LjAuMC4xOjgxMDIvYWRtaW4vYXR0ZW5kYW5jZXM/Y291cnNlX29mZmVyaW5nX2lkPTMmZGF0ZT0yMDI1LTEyLTIwIjtzOjU6InJvdXRlIjtzOjIzOiJhZG1pbi5hdHRlbmRhbmNlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1766206082),
('kgZLIWUdmPPAiEMgiuvs5CMV8otDS3UNCh8Jvyr8', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOXh5OGRrdk1nYUcyR0UzS0ZNODdicjhKZER4alh0bDNtck5wQngwcyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTI3LjAuMC4xOjgxMDIvYWRtaW4vc2NvcmVzP2V4YW1faWQ9MSI7czo1OiJyb3V0ZSI7czoxODoiYWRtaW4uc2NvcmVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1766206933);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `credit_hours` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `description`, `credit_hours`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English Grammar', 'ENGL102', 'Quisquam et dolores consectetur quisquam eveniet incidunt iste numquam.', 4, '2025-12-19 17:54:10', '2025-12-20 02:42:04', NULL),
(2, 'World History', 'HIST201', 'Illo nihil fuga at enim neque est.', 4, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(3, 'Microeconomics', 'ECON305', 'Nihil velit dolores neque et.', 3, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('monk','male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT 'male',
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` text COLLATE utf8mb4_unicode_ci,
  `salary` decimal(10,2) DEFAULT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `date_of_birth`, `gender`, `joining_date`, `qualification`, `experience`, `specialization`, `salary`, `cv`, `blood_group`, `nationality`, `religion`, `admission_date`, `occupation`, `company`, `avatar`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2025-12-19 17:53:59', '$2y$12$W68pWnFKUZRMD78uRq7ps.kis3P9sQIVqk5xX00EB2223hxjtd8ba', NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:53:59', '2025-12-19 17:53:59', NULL),
(2, 'Dayton Moore', 'teacher1@example.com', '2025-12-19 17:53:59', '$2y$12$z2rnMUTS1UNvJl6FvLVTT.lvtNXosT7jmUN.4nXxl3TpLhSF2QMp2', '+1.925.621.4377', '2190 Doug River\nPort Asha, AK 58859-0748', '1994-08-09', 'male', '2021-05-29', 'Master in Education', '1 years', 'Mathematics', 109448.04, NULL, 'B+', 'Example Country', 'Example Faith', NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:53:59', '2025-12-19 17:53:59', NULL),
(3, 'Kim Goyette MD', 'teacher2@example.com', '2025-12-19 17:53:59', '$2y$12$zPD16ATPTtYn2IsdtFp12e2dzGhQaLYxopkPVOlPxrRr.tFXIlJ.q', '(667) 702-0737', '95560 Jenkins Course Suite 820\nRyantown, VT 86893-5902', '1992-09-20', 'male', '2023-02-27', 'Bachelor in Arts', '5 years', 'Physics', 74076.88, NULL, 'B+', 'Example Country', 'Example Faith', NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:53:59', '2025-12-19 17:53:59', NULL),
(4, 'Bradley Abernathy', 'teacher3@example.com', '2025-12-19 17:54:00', '$2y$12$iz9Glcb0Y3Yk8cajQL9Su.HR0LomcWDhwmiosWDDh4Me/ePWJ6ar.', '1-818-603-3067', '6408 Ima Meadow\nKennaburgh, ME 85571-5279', '1992-02-01', 'male', '2021-05-02', 'PhD in Science', '10 years', 'Mathematics', 84787.68, NULL, 'AB-', 'Example Country', 'Example Faith', NULL, NULL, NULL, NULL, NULL, '2025-12-19 17:54:00', '2025-12-19 17:54:00', NULL),
(5, 'Omari Predovic', 'student1@example.com', '2025-12-19 17:54:00', '$2y$12$bnVuT6iBip/hA8hJtCh6hOgYPmmwPvBwm2sDSfgbcR8ikxYjZkcPS', '+1.463.414.5708', '6508 Elisa Falls\nAmericoside, IL 71096', '2010-12-08', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2025-05-22', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:00', '2025-12-19 17:54:00', NULL),
(6, 'Mr. Augustus Steuber III', 'student2@example.com', '2025-12-19 17:54:00', '$2y$12$b12O9fXAZqRkNffZlIDbDeOadGZQBzWUfMcUGZJI0OgNiVeqHs97W', '+1.832.479.8710', '2897 Koss Motorway Apt. 920\nTremblayview, GA 82003-5455', '2010-06-15', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2024-02-26', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:00', '2025-12-19 17:54:00', NULL),
(7, 'Cameron Toy', 'student3@example.com', '2025-12-19 17:54:00', '$2y$12$oEFDC7DU.PrZJ4ixLCG.6ukff/0NqWKKPETynLaip93I8iEyj5N72', '(786) 538-8051', '44242 Jarrod Trail Apt. 776\nWest Gabriella, MA 03334-2955', '2010-06-23', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2024-07-26', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:00', '2025-12-19 17:54:00', NULL),
(8, 'Conner Hirthe', 'student4@example.com', '2025-12-19 17:54:00', '$2y$12$l1jMd1vzE8ppjWL3pD/sweX7B4j6fbGyyah5NnL5WWFLe0V4hn5R.', '360-960-6813', '154 Bradtke Extensions Apt. 147\nGoyetteshire, SC 80311', '2009-02-06', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2024-01-10', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:00', '2025-12-19 17:54:00', NULL),
(9, 'Mr. Dennis Klocko DDS', 'student5@example.com', '2025-12-19 17:54:01', '$2y$12$d9xGq4nhNEiGGOSjwU.3JujZJ//d0Zue4BR/1WByUQIfI4H8f0Xj.', '+1 (269) 612-0064', '1638 McCullough Crossing\nSouth Linneaside, VT 52564-3146', '2008-10-26', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2024-10-13', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:01', '2025-12-19 17:54:01', NULL),
(10, 'Waylon Jones DDS', 'student6@example.com', '2025-12-19 17:54:01', '$2y$12$kjzwogTRt1AABjzdCaa8D.m683KzUEKKwPI5km4bqs6SDdtfexQw2', '1-228-615-3860', '611 Terrance Coves\nSouth Heather, WV 92060', '2008-11-19', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2024-12-28', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:01', '2025-12-19 17:54:01', NULL),
(11, 'Jaylen Kling', 'student7@example.com', '2025-12-19 17:54:01', '$2y$12$ArUK/XtZbnRs8s0XcfDQSeZ8Zf6kkYVBTgB4/TgBF3NQSBvd2RQpy', '272.455.1929', '4682 Zemlak Roads\nThoraport, KY 32391', '2008-08-09', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2024-01-13', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:01', '2025-12-19 17:54:01', NULL),
(12, 'Brenden Wisoky', 'student8@example.com', '2025-12-19 17:54:01', '$2y$12$WBc5rMR.lz26w3l0L5mPSOCk04Mm79IjoJqoWA.BdK5E.qhrx4U.i', '1-779-842-1233', '307 Ellis Glen\nWest Louveniabury, MS 05370', '2007-05-23', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2024-02-07', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:01', '2025-12-19 17:54:01', NULL),
(13, 'Dr. Sofia Emard DDS', 'student9@example.com', '2025-12-19 17:54:01', '$2y$12$FIDYYf56GqTlAqaQTISok.DYI8HZQQ63Z.VfJ/RQW/RFC40FK.M2y', '+1.585.334.6808', '4784 Shaun Cliff\nEast Venaberg, WV 47238', '2010-08-07', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-07-02', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:01', '2025-12-19 17:54:01', NULL),
(14, 'Olin Lowe', 'student10@example.com', '2025-12-19 17:54:02', '$2y$12$CTsK9pDxVQNYC8Tc2a1xsubnpASKvJ4MAD.1HFQgyjw3sVhVAapJa', '347.222.9276', '92835 Ratke Forges\nSouth Shawna, AK 30347', '2008-05-19', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-03-03', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:02', '2025-12-19 17:54:02', NULL),
(15, 'Cordell Jaskolski', 'student11@example.com', '2025-12-19 17:54:02', '$2y$12$FKMKc4jt.xRU8JXifCJYnuEzdvwtssIfI1bpFQNkJiim11Co2KZu6', '419-609-8925', '6197 Thompson Locks\nJoelleport, MI 24722', '2008-04-30', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2024-10-16', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:02', '2025-12-19 17:54:02', NULL),
(16, 'Salvatore Wilkinson', 'student12@example.com', '2025-12-19 17:54:02', '$2y$12$bI14UIZbV9FB68u/zPRYI.hlWTYJuFKbsYvtuadW4tSum0QHGbxO6', '1-458-656-2562', '3937 Winston Coves\nPort Elnafurt, TX 89924', '2009-05-09', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2025-06-26', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:02', '2025-12-19 17:54:02', NULL),
(17, 'Golden Brown', 'student13@example.com', '2025-12-19 17:54:02', '$2y$12$RuIYpPdasNgn54UMpd0ZW.0R5nOx8KIUR3kszkbBplSjMiNV5NAaK', '228-662-4560', '8115 Kennedy Freeway Apt. 832\nNew Aniyah, MD 55261-1509', '2007-11-09', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2024-02-10', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:02', '2025-12-19 17:54:02', NULL),
(18, 'Mr. Van Crist IV', 'student14@example.com', '2025-12-19 17:54:02', '$2y$12$se.ztf4PlTGKgy4mp.kOjuEFAdZVm/AH.rE9WuPBAKYdaOmKFhnru', '1-713-325-3667', '172 Swaniawski Throughway\nSouth Micheal, IN 61523', '2007-09-07', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-03-20', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:02', '2025-12-19 17:54:02', NULL),
(19, 'Mr. Sage Herzog', 'student15@example.com', '2025-12-19 17:54:03', '$2y$12$Ut71mEeJxdE6LPlkzRNq.OSpZB9t6tWjEhX1p6Jyp3Sc2R.WVDKXu', '1-612-952-3634', '4043 Pearl Drives\nNorth Robertashire, OK 59345', '2009-12-06', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2024-10-18', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:03', '2025-12-19 17:54:03', NULL),
(20, 'Deonte Toy', 'student16@example.com', '2025-12-19 17:54:03', '$2y$12$bWwimrGwHj.ExwIJ/0Nr/eSW1bHPeQzfmn4t63.8ipLiHVFGF9pMi', '779-592-4136', '117 Marie Roads Suite 127\nPort Trey, KS 75159', '2009-06-02', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2024-09-03', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:03', '2025-12-19 17:54:03', NULL),
(21, 'Dr. Pierre McDermott', 'student17@example.com', '2025-12-19 17:54:03', '$2y$12$8/979RLu9o6bsLALSwsc8elOACpIwPTw9Cu1Kb90rpTo13kZ5CTWu', '+1 (929) 770-9885', '39536 Heller Fields\nWilliamsonstad, NE 30577-2593', '2006-04-05', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2024-02-06', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:03', '2025-12-19 17:54:03', NULL),
(22, 'Fredrick Casper', 'student18@example.com', '2025-12-19 17:54:03', '$2y$12$KOxyK/3Il1YiRKwFNFmfq.dd1QEodrD/netQPDXEk7IL5wKzjPQca', '1-817-328-8539', '77840 Asia Landing\nLake Merlfurt, OK 77277', '2007-12-07', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-11-06', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:03', '2025-12-19 17:54:03', NULL),
(23, 'Reagan Gulgowski', 'student19@example.com', '2025-12-19 17:54:03', '$2y$12$j8g8eZE8BOlowrhMnQlwe.k8hZFYShuw2vq6Ve/bDhP18Lo/cHKGG', '1-724-567-2859', '29336 Mante Flats Apt. 426\nBeahanberg, TX 78951-7939', '2010-07-11', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-04-28', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:03', '2025-12-19 17:54:03', NULL),
(24, 'Mr. Lamar Macejkovic MD', 'student20@example.com', '2025-12-19 17:54:04', '$2y$12$EXfOKndfZCS8BHln/rmt6Og4mwVjXpb/1k2S4sgAFdDnVtsGDp4PC', '+13643632766', '29562 Reichert Summit Apt. 012\nPowlowskiland, UT 33221', '2008-11-11', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2025-04-27', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:04', '2025-12-19 17:54:04', NULL),
(25, 'Dr. Elijah Casper', 'student21@example.com', '2025-12-19 17:54:04', '$2y$12$1/t7ccqCDbn3p4zsSecOcOFy7uM9RWaZbMH7TivObhWa.PLZkzugG', '+18123760228', '62707 Angel Path Apt. 501\nNew Hilbert, VA 44406', '2007-09-25', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-09-24', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:04', '2025-12-19 17:54:04', NULL),
(26, 'Chandler McGlynn', 'student22@example.com', '2025-12-19 17:54:04', '$2y$12$4Gu1dG.buLjYkWdPJUO7WuDDVBb9PQ3LrVGukTGkaAJdoSwZ5nAdi', '(707) 364-3683', '18149 Sheridan Radial\nTremainestad, TX 21963', '2008-07-20', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2025-08-18', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:04', '2025-12-19 17:54:04', NULL),
(27, 'Emerson Farrell', 'student23@example.com', '2025-12-19 17:54:04', '$2y$12$6h2ycha2lBTwnGnYwJrzgOOqMPeQWHXpX/qDtUFCUALqQGXqIXLvK', '+1-772-565-5737', '322 Roberta Crest\nLockmanhaven, OR 42515-9080', '2009-07-16', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-06-06', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:04', '2025-12-19 17:54:04', NULL),
(28, 'Seth Huel', 'student24@example.com', '2025-12-19 17:54:04', '$2y$12$W2Pgfu2xUflidOqLb.1wtO2n/oH8wO4P08aExL.PyfLQPatoOKITe', '(269) 433-9170', '241 Aric Hill\nMaritzaview, MN 62725-4567', '2010-01-29', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2024-06-10', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:04', '2025-12-19 17:54:04', NULL),
(29, 'Martin Fay', 'student25@example.com', '2025-12-19 17:54:05', '$2y$12$6BfoTNurjpW2r7F1Jjbdfu/FncbgIYL.961aFXWagb0u2m.sNL3ba', '213.761.3702', '54849 Beulah Plains\nNew Wilfred, NY 64322', '2007-03-03', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2024-08-07', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:05', '2025-12-19 17:54:05', NULL),
(30, 'Alex Lind', 'student26@example.com', '2025-12-19 17:54:05', '$2y$12$/2DdkUZs7izOSTvyd2VDUOt1Wf/sTq6wzK3d9pH0MBNbVjmsf02D2', '+1-360-471-6120', '90585 Godfrey Lane Apt. 062\nStokesburgh, NV 72204', '2006-03-05', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2025-03-25', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:05', '2025-12-19 17:54:05', NULL),
(31, 'Okey Walter', 'student27@example.com', '2025-12-19 17:54:05', '$2y$12$CimxBVXGz3tHO.L09oFB4eD8xJg8we2OE8lZZY.1wfS0/Vnwvqo9C', '+13463852147', '914 Schuyler Stream Suite 660\nSchimmelview, MO 27703', '2009-05-23', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-06-07', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:05', '2025-12-19 17:54:05', NULL),
(32, 'Kevin Feest', 'student28@example.com', '2025-12-19 17:54:05', '$2y$12$d1M0p0mv36LtD.yNFRDWiudNL9VmxIqhv8IgBj1nB0JmcH1jL5NWy', '(732) 460-6619', '479 Schneider Extension\nSouth Hollis, AK 18445-5048', '2010-10-02', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2024-11-22', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:05', '2025-12-19 17:54:05', NULL),
(33, 'Mr. Jamie Mraz III', 'student29@example.com', '2025-12-19 17:54:05', '$2y$12$nFmY2pPhUlecUh6R0Ldf.etDANbLRuKHw2fc0JP.PUr.J.l0UEDGy', '1-321-690-7315', '7323 Baumbach Spring\nWest Leo, NM 21965', '2007-12-05', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2024-06-06', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:05', '2025-12-19 17:54:05', NULL),
(34, 'Howell Schmitt', 'student30@example.com', '2025-12-19 17:54:06', '$2y$12$.Ql7j.aSx.w/woSMybcpV.erA2Udtj34n3YbfIJxyhrBxZeS3MEPq', '(409) 819-5886', '42313 Norval Divide Apt. 808\nWest Vivianne, WV 90233', '2008-06-13', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2025-03-03', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:06', '2025-12-19 17:54:06', NULL),
(35, 'Prof. Ryann Pollich II', 'student31@example.com', '2025-12-19 17:54:06', '$2y$12$JN9K1aDadHD6CbkMiYWgZ.AvxY/sD1Tp3rh.g5IsoO0aJOmNCfWWu', '402.648.9731', '4078 Abernathy Courts Suite 288\nSchusterview, NC 09936-6902', '2010-04-29', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-05-25', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:06', '2025-12-19 17:54:06', NULL),
(36, 'Dr. Craig Hackett', 'student32@example.com', '2025-12-19 17:54:06', '$2y$12$SunbHUsAXaU35jF7D.6bNe9xD4IsENWeM/0TAcA6WILSE4ouZIWTK', '(980) 293-7965', '15748 Lexie Landing Apt. 953\nSouth Arnoldmouth, MS 55754', '2007-09-16', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-03-21', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:06', '2025-12-19 17:54:06', NULL),
(37, 'Prof. Bud Reichel MD', 'student33@example.com', '2025-12-19 17:54:06', '$2y$12$eM17563hcx5mXQIK.bLvKupkfTubRElwVeEQCrA7wIezw015YMI4S', '843.476.8923', '8439 Yessenia Burg\nSouth Allen, OK 64362', '2007-02-26', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2024-11-24', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:06', '2025-12-19 17:54:06', NULL),
(38, 'Tyree Koelpin', 'student34@example.com', '2025-12-19 17:54:06', '$2y$12$DI59AOBWGFlsPIVM/cWG1.Wfrz0NIK44uvCjYlQg2L9qpMUrQ0HHK', '1-941-562-0526', '24553 Runolfsson Lakes Apt. 899\nEast Deontefurt, AR 70167-3373', '2007-10-15', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-10-29', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:06', '2025-12-19 17:54:06', NULL),
(39, 'Prof. Cletus Little MD', 'student35@example.com', '2025-12-19 17:54:07', '$2y$12$PLaT.EfwSlQTPEmUJMjAbu0H3RcwbNiRfIc8pTiwpoZbzHucouaLS', '559.726.4679', '5053 Boyer Lodge\nPort Alethatown, IL 19563', '2009-05-19', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-12-08', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:07', '2025-12-19 17:54:07', NULL),
(40, 'Celestino Corwin', 'student36@example.com', '2025-12-19 17:54:07', '$2y$12$LStf0.n0xeFzlSgNOZJzzeelScDXDK2a0YkqGajgCfs2iANy7W3a6', '+1-651-658-9587', '900 Rau Valleys Apt. 030\nKayburgh, LA 00918', '2006-09-22', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2024-11-23', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:07', '2025-12-19 17:54:07', NULL),
(41, 'Mr. Monte Konopelski DDS', 'student37@example.com', '2025-12-19 17:54:07', '$2y$12$s83GEA7WXj/yHeVh50TqXuC.RyRkiNHRYUoR84oSmL/hmWvHybNW2', '+16816919864', '5841 Joany Glen Apt. 789\nLake Heber, ID 99978-0433', '2010-05-16', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2024-03-12', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:07', '2025-12-19 17:54:07', NULL),
(42, 'Tatum Jacobi', 'student38@example.com', '2025-12-19 17:54:07', '$2y$12$9Isnd4rWk.DgteBSebqAIu66t/uiz1ijuyzTVNyujUwhllcEVZej.', '+1-346-872-7707', '817 Gulgowski Causeway\nDurganville, GA 17055-8228', '2010-05-17', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2025-06-03', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:07', '2025-12-19 17:54:07', NULL),
(43, 'Prof. Karl Watsica IV', 'student39@example.com', '2025-12-19 17:54:07', '$2y$12$5teFICnWtLyIN2h5qniVUOAdyAdHUtLZBtLADm4u.sSkyrDCJ.kbi', '270.903.3731', '2017 Reichel Island\nNorth Allan, NV 04451-4944', '2007-08-28', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2025-07-22', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:07', '2025-12-19 17:54:07', NULL),
(44, 'Monroe Gorczany', 'student40@example.com', '2025-12-19 17:54:08', '$2y$12$fT8F3x3Y5ffg5/rY62omjOTpOGjy60QZr9zhLdSY6olAwT961rHSK', '+1 (531) 397-9644', '71634 Hermiston Street\nNew Marie, NY 71064-9211', '2007-03-01', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2024-12-09', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:08', '2025-12-19 17:54:08', NULL),
(45, 'Prof. Earl Feil', 'student41@example.com', '2025-12-19 17:54:08', '$2y$12$jGVkw7cR2.3TJFdMClE7XO5xBF3RtvQKFW9v6fRJu2G8bzgZiVlfq', '1-207-653-3439', '359 Roman Isle Apt. 181\nOlenfort, DE 78055-1121', '2010-09-02', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-04-19', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:08', '2025-12-19 17:54:08', NULL),
(46, 'Ferne Runolfsdottir IV', 'student42@example.com', '2025-12-19 17:54:08', '$2y$12$XLcF7aR.FK09Z9jKbzyiZ.O0K9jW6zE8ikWNnLF10vpa2EvrTMM8K', '571.824.6784', '77023 Everett Fields Suite 223\nPort Kayla, NE 60812', '2009-03-03', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2025-01-08', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:08', '2025-12-19 17:54:08', NULL),
(47, 'Jett Zulauf', 'student43@example.com', '2025-12-19 17:54:08', '$2y$12$tK.IhSb26DoFPbWCVkSLiuAfzQ4GwJOg/XuY3Rm7gA1ULTPuHKVrG', '1-352-655-9632', '55266 Dayne Hollow\nLake Katelin, CA 38659-9832', '2010-10-29', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'AB-', 'Example Country', 'Example Faith', '2025-02-19', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:08', '2025-12-19 17:54:08', NULL),
(48, 'Olaf Cronin', 'student44@example.com', '2025-12-19 17:54:08', '$2y$12$w2Ccpui5EEJUNJ7V2A4Wb.i3w7reSZ0taYkyh/rHaEpYI8VH4efru', '+1-332-454-3314', '9063 Maddison Coves Suite 332\nEast Marietta, UT 46282', '2010-10-16', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2024-12-02', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:08', '2025-12-19 17:54:08', NULL),
(49, 'Dr. Vernon Herman', 'student45@example.com', '2025-12-19 17:54:09', '$2y$12$GV44n5PKbzZOPYWbrF9NPePb5qEdcL77curwk4QnAqEtdI2gW2pBq', '(681) 561-2448', '99002 Carter Plaza Apt. 056\nWest Emilie, AZ 97214-5270', '2009-04-16', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-05-04', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:09', '2025-12-19 17:54:09', NULL),
(50, 'Kiley Schoen', 'student46@example.com', '2025-12-19 17:54:09', '$2y$12$4.FLyyis/lPGXjghl2rL3eP1CCLU/05jQPt0L.ijtO9FVTiPhCIoy', '484.620.6596', '368 Abdul Branch\nShainashire, WV 13868', '2006-09-30', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-11-18', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:09', '2025-12-19 17:54:09', NULL),
(51, 'Adrian Greenholt PhD', 'student47@example.com', '2025-12-19 17:54:09', '$2y$12$FQ4pmSXVUQjWBxahT4n/FOoLBsCEBRPlUXSQwFmEoEHihRfR7jaMK', '520-512-9297', '74368 Trycia Spring\nEast Alison, CO 97521', '2008-10-02', 'female', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2025-11-14', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:09', '2025-12-19 17:54:09', NULL),
(52, 'Mr. Stanley Hegmann', 'student48@example.com', '2025-12-19 17:54:09', '$2y$12$zk2OdAidEcnWF0YSgqdkSOyTusda66Eldx3usZ0KSz9aVDpg9TnLO', '607.953.4675', '306 Homenick Trace\nNorth Merlinmouth, SC 67033-9686', '2008-04-12', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'B+', 'Example Country', 'Example Faith', '2025-04-17', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:09', '2025-12-19 17:54:09', NULL),
(53, 'Prof. Kiley Wiza', 'student49@example.com', '2025-12-19 17:54:09', '$2y$12$6IfmuemeIGIWFMXjtnLNW.7MkNVQLzJSQl6VW8qebDInNjX.mMN26', '+1 (747) 463-3081', '1296 Serenity Common Apt. 831\nPort Brendonland, MS 24105-6430', '2007-04-15', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'A+', 'Example Country', 'Example Faith', '2023-12-31', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:09', '2025-12-19 17:54:09', NULL),
(54, 'Antwan Langworth', 'student50@example.com', '2025-12-19 17:54:10', '$2y$12$2pBU6RLlJwzloqrmB/Z22egZGMn6xDmkaf/SWJPLFffBFzwe6l/q6', '+1.458.625.9001', '842 Neva Way\nEast Edythe, ID 00472-0867', '2007-02-01', 'male', NULL, NULL, NULL, NULL, NULL, NULL, 'O+', 'Example Country', 'Example Faith', '2025-02-14', 'Student', NULL, NULL, NULL, '2025-12-19 17:54:10', '2025-12-19 17:54:10', NULL),
(55, 'Rinah Montgomery', 'tivyhyvax@mailinator.com', NULL, '$2y$12$XH5wjyV/SLMLoHiztVgC/u.52E6mZBQtYD8aY5GI1Hha5PJ9Qjedi', '+1 (102) 242-3853', 'Temporibus labore ma', '1980-04-06', 'other', NULL, NULL, NULL, NULL, NULL, NULL, 'O-', 'Nostrud qui corrupti', 'Est harum dolor qui', '1984-01-08', 'Quasi ut ullam cum e', 'Burke Cruz LLC', 'uploads/avatars/1766208866-20-12-2025_user_avatar.jpg', NULL, '2025-12-20 05:34:02', '2025-12-20 05:34:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_unique_idx` (`student_id`,`course_offering_id`,`date`),
  ADD KEY `attendances_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classrooms_name_unique` (`name`),
  ADD UNIQUE KEY `classrooms_room_number_unique` (`room_number`);

--
-- Indexes for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_teacher_schedule_slot_period` (`teacher_id`,`schedule`,`time_slot`,`join_start`,`join_end`),
  ADD UNIQUE KEY `unique_classroom_schedule_slot_period` (`classroom_id`,`schedule`,`time_slot`,`join_start`,`join_end`),
  ADD KEY `course_offerings_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_course_enrollment` (`student_id`,`course_offering_id`),
  ADD KEY `enrollments_course_offering_id_foreign` (`course_offering_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_exam_type_per_course` (`course_offering_id`,`type`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_category_id_foreign` (`expense_category_id`),
  ADD KEY `expenses_approved_by_foreign` (`approved_by`),
  ADD KEY `expenses_created_by_foreign` (`created_by`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_categories_name_unique` (`name`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_student_id_foreign` (`student_id`),
  ADD KEY `fees_enrollment_id_foreign` (`enrollment_id`),
  ADD KEY `fees_fee_type_id_foreign` (`fee_type_id`),
  ADD KEY `fees_created_by_foreign` (`created_by`),
  ADD KEY `fees_received_by_foreign` (`received_by`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fee_types_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_exam_score` (`student_id`,`exam_id`),
  ADD KEY `scores_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_name_unique` (`name`),
  ADD UNIQUE KEY `subjects_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_offerings`
--
ALTER TABLE `course_offerings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`),
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_offerings`
--
ALTER TABLE `course_offerings`
  ADD CONSTRAINT `course_offerings_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `course_offerings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_offerings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_course_offering_id_foreign` FOREIGN KEY (`course_offering_id`) REFERENCES `course_offerings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fees_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_fee_type_id_foreign` FOREIGN KEY (`fee_type_id`) REFERENCES `fee_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

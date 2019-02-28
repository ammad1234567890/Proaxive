-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2018 at 04:21 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proaxive`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `name`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Adria Airways', 0, 4, 4, NULL, NULL),
(2, 'Aegean Airlines', 0, 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Human Resource Management', 0, NULL, NULL, NULL, NULL),
(3, 'Payroll', 0, NULL, NULL, NULL, NULL),
(4, 'Finance', 0, NULL, NULL, NULL, NULL),
(5, 'Admin', 0, NULL, NULL, NULL, NULL),
(6, 'Management', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'HR Generalist', 0, NULL, NULL, NULL, NULL),
(2, 'Finance Coordinator', 0, NULL, NULL, NULL, NULL),
(3, 'Admin Officer', 0, NULL, NULL, NULL, NULL),
(4, 'CEO', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `code`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 0, NULL, NULL, NULL, NULL),
(2, 'Albania', 'AL', 0, NULL, NULL, NULL, NULL),
(3, 'Algeria', 'DZ', 0, NULL, NULL, NULL, NULL),
(4, 'American Samoa', 'DS', 0, NULL, NULL, NULL, NULL),
(5, 'Andorra', 'AD', 0, NULL, NULL, NULL, NULL),
(6, 'Angola', 'AO', 0, NULL, NULL, NULL, NULL),
(7, 'Anguilla', 'AI', 0, NULL, NULL, NULL, NULL),
(8, 'Antarctica', 'AQ', 0, NULL, NULL, NULL, NULL),
(9, 'Antigua and Barbuda', 'AG', 0, NULL, NULL, NULL, NULL),
(10, 'Argentina', 'AR', 0, NULL, NULL, NULL, NULL),
(11, 'Armenia', 'AM', 0, NULL, NULL, NULL, NULL),
(12, 'Aruba', 'AW', 0, NULL, NULL, NULL, NULL),
(13, 'Australia', 'AU', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_24_110435_travel_type', 1),
(4, '2018_12_27_113056_travel_request', 1),
(5, '2018_12_27_113754_travel_members', 1),
(6, '2018_12_27_114159_user_members', 1),
(7, '2018_12_27_114607_locations', 1),
(8, '2018_12_27_114914_airlines', 1),
(9, '2018_12_27_115120_department', 1),
(10, '2018_12_27_115205_designation', 1),
(11, '2018_12_27_115759_travel_status', 1),
(12, '2018_12_27_120419_request_approvals', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_approvals`
--

CREATE TABLE `request_approvals` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'HR'),
(3, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `travel_members`
--

CREATE TABLE `travel_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `travel_id` int(10) UNSIGNED NOT NULL,
  `user_member_id` int(10) UNSIGNED NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_request`
--

CREATE TABLE `travel_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `trip_from_loc` int(10) UNSIGNED NOT NULL,
  `trip_to_loc` int(10) UNSIGNED NOT NULL,
  `travel_type` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` int(10) UNSIGNED NOT NULL,
  `airline_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travel_status`
--

CREATE TABLE `travel_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_status`
--

INSERT INTO `travel_status` (`id`, `name`, `is_deleted`) VALUES
(1, 'Pending', 0),
(2, 'Processing', 0),
(3, 'Rejected', 0),
(4, 'Approved', 0);

-- --------------------------------------------------------

--
-- Table structure for table `travel_type`
--

CREATE TABLE `travel_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_type`
--

INSERT INTO `travel_type` (`id`, `name`, `is_active`) VALUES
(1, 'One Way', '0'),
(2, 'Return', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(10) UNSIGNED DEFAULT NULL,
  `designation_id` int(10) UNSIGNED DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `email_verified_at`, `phone_no`, `cnic`, `passport_no`, `passport_attachment`, `department_id`, `designation_id`, `role_id`, `password`, `remember_token`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'Nadia Ishaque', 'Nadia', 'Ishaque', 'nadia@outlook.com', NULL, NULL, NULL, NULL, NULL, 2, 1, 2, '$2b$10$gKrRPMNfGT/QQnYsYVqLIeNCr9iFffGlJ/e0BbGK.JWX/wKMQa9Wq', NULL, 0, NULL, NULL, NULL, NULL),
(4, 'Ammad baig', 'Ammad', 'baig', 'ammad.baig66@yahoo.com', NULL, NULL, NULL, NULL, NULL, 2, 1, 2, '$2y$10$7KExsfsv1R0ZWO3s64TkweTEqVPeSePaYe5VrLv62688owUBgCDuq', 'K7aylWorGCHRPpBF5vVmhUvS6hEToE3Cm6kIGxuqiFO25U4pEyu4bMlwXPnW', 0, 3, NULL, '2018-12-28 02:24:37', '2018-12-28 02:24:37'),
(5, 'Wajahat Jawaid', 'Wajahat', 'Jawaid', 'wajahat@gmail.com', NULL, NULL, NULL, NULL, NULL, 5, 3, 1, '$2y$10$s0zVAPHS1YuivPHRrSFgj.eJvKQe/3CyygP5SWqGMC15x4xdw4a..', NULL, 0, 4, NULL, '2018-12-28 06:39:37', '2018-12-28 06:39:37'),
(6, 'Nabeel Shaikh', 'Nabeel', 'Shaikh', 'nabeel@gmail.com', NULL, NULL, NULL, '1234', 'image.jpg', 4, 2, 3, '$2y$10$OQRy1No.zB7Y10BeZUng/O8sBxzCA1lk/DGPWfc9X9WyEz.s8boly', NULL, 0, 4, NULL, '2018-12-28 08:36:06', '2018-12-28 08:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_members`
--

CREATE TABLE `user_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_members`
--

INSERT INTO `user_members` (`id`, `user_id`, `first_name`, `last_name`, `passport_no`, `passport_attachment`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 4, 'Zain ', 'Baig', '1321', 'abc.jpg', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airlines_created_by_foreign` (`created_by`),
  ADD KEY `airlines_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_created_by_foreign` (`created_by`),
  ADD KEY `department_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designation_created_by_foreign` (`created_by`),
  ADD KEY `designation_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_created_by_foreign` (`created_by`),
  ADD KEY `locations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `request_approvals`
--
ALTER TABLE `request_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_approvals_status_foreign` (`status`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_members`
--
ALTER TABLE `travel_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_members_travel_id_foreign` (`travel_id`),
  ADD KEY `travel_members_user_member_id_foreign` (`user_member_id`);

--
-- Indexes for table `travel_request`
--
ALTER TABLE `travel_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_request_trip_from_loc_foreign` (`trip_from_loc`),
  ADD KEY `travel_request_trip_to_loc_foreign` (`trip_to_loc`),
  ADD KEY `travel_request_travel_type_foreign` (`travel_type`),
  ADD KEY `travel_request_user_foreign` (`user`),
  ADD KEY `travel_request_status_foreign` (`status`),
  ADD KEY `airline_id` (`airline_id`);

--
-- Indexes for table `travel_status`
--
ALTER TABLE `travel_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_type`
--
ALTER TABLE `travel_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_index` (`department_id`),
  ADD KEY `users_designation_id_index` (`designation_id`),
  ADD KEY `users_created_by_index` (`created_by`),
  ADD KEY `users_updated_by_index` (`updated_by`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_members`
--
ALTER TABLE `user_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_members_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `request_approvals`
--
ALTER TABLE `request_approvals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `travel_members`
--
ALTER TABLE `travel_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel_request`
--
ALTER TABLE `travel_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel_status`
--
ALTER TABLE `travel_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `travel_type`
--
ALTER TABLE `travel_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_members`
--
ALTER TABLE `user_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airlines`
--
ALTER TABLE `airlines`
  ADD CONSTRAINT `airlines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `airlines_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `department_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `designation`
--
ALTER TABLE `designation`
  ADD CONSTRAINT `designation_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `designation_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `locations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_approvals`
--
ALTER TABLE `request_approvals`
  ADD CONSTRAINT `request_approvals_status_foreign` FOREIGN KEY (`status`) REFERENCES `travel_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_members`
--
ALTER TABLE `travel_members`
  ADD CONSTRAINT `travel_members_travel_id_foreign` FOREIGN KEY (`travel_id`) REFERENCES `travel_request` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_members_user_member_id_foreign` FOREIGN KEY (`user_member_id`) REFERENCES `user_members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_request`
--
ALTER TABLE `travel_request`
  ADD CONSTRAINT `travel_request_status_foreign` FOREIGN KEY (`status`) REFERENCES `travel_status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_request_travel_type_foreign` FOREIGN KEY (`travel_type`) REFERENCES `travel_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_request_trip_from_loc_foreign` FOREIGN KEY (`trip_from_loc`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_request_trip_to_loc_foreign` FOREIGN KEY (`trip_to_loc`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `travel_request_user_foreign` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_members`
--
ALTER TABLE `user_members`
  ADD CONSTRAINT `user_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

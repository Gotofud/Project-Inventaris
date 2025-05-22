-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2025 at 01:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incoming_items`
--

CREATE TABLE `incoming_items` (
  `id` bigint UNSIGNED NOT NULL,
  `icm_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `entry_date` date NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incoming_items`
--

INSERT INTO `incoming_items` (`id`, `icm_code`, `amount`, `entry_date`, `info`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 'INCM-0001', 50, '2025-05-14', 'Brand New', 1, '2025-05-21 08:05:03', '2025-05-21 08:05:03'),
(2, 'INCM-0002', 50, '2025-05-16', 'Brand New', 2, '2025-05-21 08:05:28', '2025-05-21 08:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Classroom and Office Furniture', '2025-05-21 07:56:59', '2025-05-21 07:57:45'),
(2, 'Teaching and Learning Equipment', '2025-05-21 08:00:33', '2025-05-21 08:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `loandatas`
--

CREATE TABLE `loandatas` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `loan_date` date NOT NULL,
  `brws_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loandatas`
--

INSERT INTO `loandatas` (`id`, `loan_code`, `amount`, `loan_date`, `brws_name`, `info`, `status`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 'LOAN-0001', 2, '2025-05-21', 'Fazli', 'For An Event', 1, 1, '2025-05-21 08:07:47', '2025-05-21 08:08:15'),
(2, 'LOAN-0002', 15, '2025-05-22', 'Osis', 'For A Meeting', 0, 2, '2025-05-21 08:08:11', '2025-05-21 08:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `maindatas`
--

CREATE TABLE `maindatas` (
  `id` bigint UNSIGNED NOT NULL,
  `prd_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maindatas`
--

INSERT INTO `maindatas` (`id`, `prd_code`, `name`, `category_id`, `img`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'ITEM-0001', 'Classroom Table', 1, '4546images (6).jpeg', 50, '2025-05-21 07:57:17', '2025-05-21 08:08:15'),
(2, 'ITEM-0002', 'Classroom Chair', 1, '5381images (3).jfif', 35, '2025-05-21 07:58:09', '2025-05-21 08:08:11'),
(3, 'ITEM-0003', 'White Board', 1, '4612whiteboard-3d-realistic-school-business-office-demonstration-white-board-with-round-magnets-marker-pen-and-sponge-blank-empty-magnetic-board-mockup-vector.jpg', 0, '2025-05-21 08:00:09', '2025-05-21 08:00:09'),
(4, 'ITEM-0004', 'Stationery', 2, '2929images (6).jfif', 0, '2025-05-21 08:01:10', '2025-05-21 08:01:10'),
(5, 'ITEM-0005', 'School Computer', 2, '3450desktop-computer.jpg', 0, '2025-05-21 08:01:36', '2025-05-21 08:01:36');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_25_040838_item_category', 1),
(6, '2025_04_26_134040_create-maindatas-table', 1),
(7, '2025_04_26_134445_create-loan_datas-table', 1),
(8, '2025_04_26_140403_create-incoming_items-table', 1),
(9, '2025_04_26_142240_create-outcoming_items-table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outcoming_items`
--

CREATE TABLE `outcoming_items` (
  `id` bigint UNSIGNED NOT NULL,
  `out_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `exit_date` date NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin@example.com', NULL, 1, '$2y$10$fk6CdKROtwLVi.B2MLpkjuXPUuEmJQ7xF/9DHz0waYQ7BAemcovSS', NULL, '2025-05-21 07:56:01', '2025-05-21 07:56:01'),
(2, 'Fazli', 'alsptr@gmail.com', NULL, 0, '$2y$10$k8TsXfDib2WDj7i8HDAVxe8CPguYd8FEcNzkaSwO47ig6emhUx8y2', NULL, '2025-05-21 07:56:43', '2025-05-21 07:56:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incoming_items`
--
ALTER TABLE `incoming_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incoming_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loandatas`
--
ALTER TABLE `loandatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loandatas_item_id_foreign` (`item_id`);

--
-- Indexes for table `maindatas`
--
ALTER TABLE `maindatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maindatas_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outcoming_items`
--
ALTER TABLE `outcoming_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outcoming_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incoming_items`
--
ALTER TABLE `incoming_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loandatas`
--
ALTER TABLE `loandatas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maindatas`
--
ALTER TABLE `maindatas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `outcoming_items`
--
ALTER TABLE `outcoming_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incoming_items`
--
ALTER TABLE `incoming_items`
  ADD CONSTRAINT `incoming_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `maindatas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loandatas`
--
ALTER TABLE `loandatas`
  ADD CONSTRAINT `loandatas_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `maindatas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maindatas`
--
ALTER TABLE `maindatas`
  ADD CONSTRAINT `maindatas_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `outcoming_items`
--
ALTER TABLE `outcoming_items`
  ADD CONSTRAINT `outcoming_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `maindatas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

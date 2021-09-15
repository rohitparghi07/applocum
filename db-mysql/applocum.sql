-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2021 at 01:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `applocum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(7, 'Corrugated Box', '20210915084716.jpg', '2021-09-15 03:17:16', '2021-09-15 03:17:16'),
(8, 'facebook123', '20210915090423.jpg', '2021-09-15 03:34:23', '2021-09-15 03:34:23'),
(9, 'core cate', '20210915095046.jpg', '2021-09-15 04:20:34', '2021-09-15 04:20:46'),
(10, 'parghi rohit', '20210915104641.jpg', '2021-09-15 05:16:41', '2021-09-15 05:16:41'),
(11, 'facebook hh', '20210915105554.jpg', '2021-09-15 05:25:54', '2021-09-15 05:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_09_15_045353_create_categories_table', 1),
(5, '2021_09_15_045412_create_products_table', 1),
(6, '2021_09_15_103904_create_sub_categories_table', 2);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'category reference',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 6, 'sdfsdf', 'saasdasdf fgdf dfgdfg', '20210915090839.jpg', '2021-09-15 03:38:39', '2021-09-15 04:03:58'),
(4, 7, 'facebook', 'asdasdasdadads', '20210915091609.jpg', '2021-09-15 03:46:09', '2021-09-15 03:46:09'),
(7, 7, 'dddd', 'adas', '20210915093115.jpg', '2021-09-15 04:01:15', '2021-09-15 04:01:15'),
(9, 7, 'facebook test 5', 'dtgdfg', '20210915094529.jpg', '2021-09-15 04:15:29', '2021-09-15 04:15:29'),
(10, 7, 'Customer 1', 'dfgdfg', '20210915094844.jpg', '2021-09-15 04:18:44', '2021-09-15 04:18:44'),
(11, 7, 'asdasd', 'sdadasd', '20210915100343.png', '2021-09-15 04:33:43', '2021-09-15 04:33:43'),
(12, 7, 'asdasd ddd', 'sdadasd', '20210915100450.jpg', '2021-09-15 04:34:50', '2021-09-15 04:34:50'),
(13, 7, 'asdasd ddd ddd', 'sdadasd', '20210915100630.jpg', '2021-09-15 04:36:30', '2021-09-15 04:36:30'),
(14, 7, 'asdasd ddd ddd dd', 'sdadasd', '20210915100855.jpg', '2021-09-15 04:38:55', '2021-09-15 04:38:55'),
(15, 9, 'facebook ddd', 'asdasd a', '20210915101453.png', '2021-09-15 04:44:53', '2021-09-15 04:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'category reference',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(4, 10, 'sdfsdf', '2021-09-15 05:23:17', '2021-09-15 05:23:17'),
(5, 10, 'sdfsd', '2021-09-15 05:23:17', '2021-09-15 05:23:17'),
(6, 10, 'sdfsdf', '2021-09-15 05:23:17', '2021-09-15 05:23:17'),
(7, 10, 'ssss', '2021-09-15 05:23:17', '2021-09-15 05:23:17'),
(9, 11, 'sdfsdf', '2021-09-15 05:26:06', '2021-09-15 05:26:06'),
(10, 11, 'dfdf', '2021-09-15 05:26:06', '2021-09-15 05:26:06'),
(11, 9, 'sdfsdf', '2021-09-15 05:42:50', '2021-09-15 05:42:50'),
(12, 9, 'sdfsdf', '2021-09-15 05:42:50', '2021-09-15 05:42:50'),
(13, 9, 'sdf', '2021-09-15 05:42:50', '2021-09-15 05:42:50'),
(14, 8, 'dd', '2021-09-15 05:43:11', '2021-09-15 05:43:11'),
(15, 8, 'dd', '2021-09-15 05:43:11', '2021-09-15 05:43:11'),
(16, 6, 'dd', '2021-09-15 05:43:27', '2021-09-15 05:43:27'),
(17, 6, 'dfdf', '2021-09-15 05:43:27', '2021-09-15 05:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'First Name',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email Address/ user name ',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'super admin, admin, user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'App locum', 'applocumadmin@yopmail.com', 'super admin', '$2y$10$K3YOZyh4dc3YpyHLbr8thu2kBCBmD6e0KwXUjMCo8urjoXPWySuLa', '2021-09-15 06:18:30', '2021-09-15 06:18:30'),
(2, 'rohit parghi', 'admin@gmail.com', 'admin', '$2y$10$NUlpiNvgOlhIWGwit/XL5.Sg1kMMyr6oObsY0rU9Iirz1Ij6V3DK.', '2021-09-15 06:18:30', '2021-09-15 06:18:30'),
(3, 'test user', 'user@gmail.com', 'user', '$2y$10$TyD.FI/iGmDOMM51.1tjTOTH0Iqc0R74x3m9o8UrwCkJ1GSbGR9aG', '2021-09-15 06:18:30', '2021-09-15 06:18:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_role_unique` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

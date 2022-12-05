-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 04:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stripe-payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(3, '2019_05_03_000001_create_customer_columns', 1),
(4, '2019_05_03_000002_create_subscriptions_table', 1),
(5, '2019_05_03_000003_create_subscription_items_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2022_09_14_170741_create_packages_table', 1),
(9, '2022_11_07_233243_create_planstriples_table', 1),
(10, '2022_12_02_171932_create_paypalpayments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `type`, `amount`, `details`, `created_at`, `updated_at`) VALUES
(1, 'Free 1 Month', '0.00', 'one months free package', '2022-09-14 08:02:41', '2022-09-14 12:03:19'),
(2, '3 Months', '10', 'its is three months package', '2022-09-14 08:27:07', '2022-09-14 08:27:07'),
(3, '6 Months', '19.99', 'its is six months package', '2022-09-14 08:28:09', '2022-09-14 08:28:09'),
(4, 'Yearly', '34.99', 'its our yearly package', '2022-09-14 08:28:52', '2022-09-14 08:28:52');

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
-- Table structure for table `paypalpayments`
--

CREATE TABLE `paypalpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscriptionID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypalpayments`
--

INSERT INTO `paypalpayments` (`id`, `user_id`, `package_id`, `status`, `name`, `package_amount`, `orderID`, `subscriptionID`, `package_response`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 0, 'James Albert', '10', NULL, NULL, '{\"orderID\":\"84X14977F7517664G\",\"subscriptionID\":\"I-TX6XHD5P1MXS\",\"facilitatorAccessToken\":\"A21AAIeJ6bwv_cTQCWTw0jdJNMUyB33S2Mehr_6XOZdKtwB6oPFMSkpQMECtQwTqwFGl1gH-BgF0j7sCrFsb2Fj1rVzd4S9Rg\",\"paymentSource\":\"paypal\"}', '2022-12-02 13:26:12', '2022-12-02 13:26:12'),
(2, 2, 2, 0, 'James Albert', '10', NULL, NULL, '{\"orderID\":\"1NY38030R2952742L\",\"subscriptionID\":\"I-74LB12LY05W0\",\"facilitatorAccessToken\":\"A21AAJ7ZRJZsa6BVGfSIUoHNDFTwg0zTAKih1rqxvXMjH6qrHL2-1k7sj-RfhlhlkUwHl-x24nLx4apO8fn4TfddUGmN2l2ZA\",\"paymentSource\":\"paypal\"}', '2022-12-02 15:15:11', '2022-12-02 15:15:11'),
(3, 2, 4, 1, 'James Albert', '34.99', NULL, NULL, '{\"orderID\":\"3CL38781P9352594M\",\"subscriptionID\":\"I-VPSHBR7W9YSB\",\"facilitatorAccessToken\":\"A21AAIrFfwgkUXCUXvrVOb6UyMyT3G6xyFC0eIKnfVO4iP4F-V3bDxdeygUjWktb4RBhSPXF8zgaeSdWQ5iDB1f32EwRPJjyQ\",\"paymentSource\":\"paypal\"}', '2022-12-02 16:27:51', '2022-12-02 16:27:51'),
(4, 2, 3, 0, 'James Albert', '19.99', NULL, NULL, '{\"orderID\":\"18T61812R0488973S\",\"subscriptionID\":\"I-LN4S416JAU5B\",\"facilitatorAccessToken\":\"A21AAKlEIRIuAVL98Y0iafm3mytuYgai2mb0ViAeiWnM-XcD4rkijR6kQgUidRqMXdBr1G9A-KeO39YutHtyGiCePd0gpuglw\",\"paymentSource\":\"paypal\"}', '2022-12-02 16:31:04', '2022-12-02 16:31:04'),
(5, 2, 2, 0, 'James Albert', '10', NULL, NULL, '{\"orderID\":\"41H97816E50404229\",\"subscriptionID\":\"I-5LSASVSEHABC\",\"facilitatorAccessToken\":\"A21AAKWX31Wp5Np81jcRugfAbLAoF1IVByjXGwSPDZnb-Gea5J9Ep7FoN3AwbRnuSF5ilAVbY_uuagreETsnFEToSrJ-GfU8w\",\"paymentSource\":\"paypal\"}', '2022-12-02 17:39:47', '2022-12-02 17:39:47'),
(6, 2, 3, 0, 'James Albert', '19.99', NULL, NULL, '{\"orderID\":\"8XU57133S1600840L\",\"subscriptionID\":\"I-58L3WMX7J2R7\",\"facilitatorAccessToken\":\"A21AAKWX31Wp5Np81jcRugfAbLAoF1IVByjXGwSPDZnb-Gea5J9Ep7FoN3AwbRnuSF5ilAVbY_uuagreETsnFEToSrJ-GfU8w\",\"paymentSource\":\"paypal\"}', '2022-12-02 17:42:42', '2022-12-02 17:42:42'),
(7, 2, 2, 0, 'James Albert', '10', '7FM95353V2456790E', 'I-SC6PJ6180L87', '{\"orderID\":\"7FM95353V2456790E\",\"subscriptionID\":\"I-SC6PJ6180L87\",\"facilitatorAccessToken\":\"A21AAKWX31Wp5Np81jcRugfAbLAoF1IVByjXGwSPDZnb-Gea5J9Ep7FoN3AwbRnuSF5ilAVbY_uuagreETsnFEToSrJ-GfU8w\",\"paymentSource\":\"paypal\"}', '2022-12-02 17:56:27', '2022-12-02 17:56:27'),
(8, 2, 4, 1, 'James Albert', '34.99', '8GE04087D2146535N', 'I-TC046T63KKR0', '{\"orderID\":\"8GE04087D2146535N\",\"subscriptionID\":\"I-TC046T63KKR0\",\"facilitatorAccessToken\":\"A21AAK8pfJfsD1_frlWk0cmzTei_1Vsu8sNFI2B8uYyEVZ0dXusiknwKJHBVd1tMSljQzYRwWYWxftY_wUW4-J2SgAMzl_bsw\",\"paymentSource\":\"paypal\"}', '2022-12-02 18:22:13', '2022-12-02 18:22:13'),
(9, 2, 4, 0, 'James Albert', '34.99', '5T961320RJ684663A', 'I-F2CELHMY0GEA', '{\"orderID\":\"5T961320RJ684663A\",\"subscriptionID\":\"I-F2CELHMY0GEA\",\"facilitatorAccessToken\":\"A21AAK8pfJfsD1_frlWk0cmzTei_1Vsu8sNFI2B8uYyEVZ0dXusiknwKJHBVd1tMSljQzYRwWYWxftY_wUW4-J2SgAMzl_bsw\",\"paymentSource\":\"paypal\"}', '2022-12-02 18:26:51', '2022-12-02 19:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planstriples`
--

CREATE TABLE `planstriples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval_count` tinyint(4) NOT NULL DEFAULT 1,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planstriples`
--

INSERT INTO `planstriples` (`id`, `plan_id`, `name`, `slug`, `billing_payment`, `interval_count`, `price`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'plan_MmcYbrJjbIBKU8', 'Silver', 'silver96zr', 'week', 2, '10', 'usd', '2022-11-11 14:54:40', '2022-11-11 14:54:40'),
(2, 'plan_MmcahUUmlKWiqp', 'platinum', 'platinumiv8l', 'month', 2, '20', 'usd', '2022-11-11 14:56:49', '2022-11-11 14:56:49'),
(3, 'plan_MmcbPGjrPXB1BT', 'Gold', 'goldoq0u', 'year', 1, '35', 'usd', '2022-11-11 14:58:02', '2022-11-11 14:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `name`, `stripe_id`, `stripe_status`, `stripe_price`, `quantity`, `trial_ends_at`, `ends_at`, `subscription_ends_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'default', 'sub_1M33PHJ5CNuTNvMYioLuxXin', 'active', 'plan_MmcYbrJjbIBKU8', 1, NULL, NULL, NULL, '2022-11-11 15:00:58', '2022-11-11 15:50:04'),
(2, 1, 'default', 'sub_1M35O1J5CNuTNvMYKPYB7HX5', 'active', 'plan_MmcahUUmlKWiqp', 1, NULL, NULL, NULL, '2022-11-11 17:07:48', '2022-11-11 17:07:48'),
(3, 1, 'default', 'sub_1M35XzJ5CNuTNvMYPXEAFjvs', 'active', 'plan_MmcbPGjrPXB1BT', 1, NULL, NULL, NULL, '2022-11-11 17:18:06', '2022-11-11 18:23:53'),
(4, 2, 'default', 'sub_1M36e8J5CNuTNvMYzIpcqMsQ', 'active', 'plan_MmcYbrJjbIBKU8', 1, NULL, NULL, NULL, '2022-11-11 18:28:31', '2022-11-17 12:52:16'),
(5, 2, 'default', 'sub_1MAKdzJ5CNuTNvMYGgPu8Yfh', 'active', 'plan_MmcahUUmlKWiqp', 1, NULL, NULL, NULL, '2022-12-01 16:50:16', '2022-12-01 16:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_items`
--

INSERT INTO `subscription_items` (`id`, `subscription_id`, `stripe_id`, `stripe_product`, `stripe_price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'si_MmcevkeLNw0AUc', 'prod_MmcYFrCS79UnTD', 'plan_MmcYbrJjbIBKU8', 1, '2022-11-11 15:00:58', '2022-11-11 15:00:58'),
(2, 2, 'si_MmehlxkB6Phnex', 'prod_MmcaLTrLIRJe1H', 'plan_MmcahUUmlKWiqp', 1, '2022-11-11 17:07:48', '2022-11-11 17:07:48'),
(3, 3, 'si_MmervFSuntauLk', 'prod_MmcbdjYGnneJg2', 'plan_MmcbPGjrPXB1BT', 1, '2022-11-11 17:18:06', '2022-11-11 17:18:06'),
(4, 4, 'si_Mmg0efAklqtI07', 'prod_MmcYFrCS79UnTD', 'plan_MmcYbrJjbIBKU8', 1, '2022-11-11 18:28:31', '2022-11-11 18:28:31'),
(5, 5, 'si_Mu8vs3Zz2KOqZt', 'prod_MmcaLTrLIRJe1H', 'plan_MmcahUUmlKWiqp', 1, '2022-12-01 16:50:16', '2022-12-01 16:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'user', 'user@gmail.com', NULL, '$2y$10$0XTNqzNiJKvHvuklHt7BJebAla8Y/B/meHtXLLN8ANwyyR7IeZwbi', NULL, '2022-11-11 14:29:12', '2022-11-11 15:00:55', 'cus_MmcemnYPSVWlHb', 'visa', '4242', NULL),
(2, 'James Albert', 'iamjamesalbertt@gmail.com', NULL, '$2y$10$IxNiq9.eFx2dNDNa5Y/KqeP7kzMK.YkB8AHJcuWJVemcMn0mfeMp2', NULL, '2022-11-11 18:26:55', '2022-11-11 18:28:29', 'cus_Mmg04nP1tzc5sb', 'visa', '4242', NULL);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paypalpayments`
--
ALTER TABLE `paypalpayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `planstriples`
--
ALTER TABLE `planstriples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_price_unique` (`subscription_id`,`stripe_price`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paypalpayments`
--
ALTER TABLE `paypalpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planstriples`
--
ALTER TABLE `planstriples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

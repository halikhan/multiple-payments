-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2022 at 08:42 PM
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
(10, '2022_12_02_171932_create_paypalpayments_table', 2),
(11, '2022_12_06_171736_create_single_paypal_payments_table', 3),
(12, '2022_12_07_213632_create_refund_payments_table', 4),
(13, '2022_12_12_164529_create_paypal_products_table', 5),
(14, '2022_12_14_203425_create_paypal_plans_table', 6);

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
(7, 2, 2, 0, 'James Albert', '10', '7FM95353V2456790E', 'I-SC6PJ6180L87', '{\"orderID\":\"7FM95353V2456790E\",\"subscriptionID\":\"I-SC6PJ6180L87\",\"facilitatorAccessToken\":\"A21AAKWX31Wp5Np81jcRugfAbLAoF1IVByjXGwSPDZnb-Gea5J9Ep7FoN3AwbRnuSF5ilAVbY_uuagreETsnFEToSrJ-GfU8w\",\"paymentSource\":\"paypal\"}', '2022-12-02 17:56:27', '2022-12-02 17:56:27'),
(8, 2, 4, 1, 'James Albert', '34.99', '8GE04087D2146535N', 'I-TC046T63KKR0', '{\"orderID\":\"8GE04087D2146535N\",\"subscriptionID\":\"I-TC046T63KKR0\",\"facilitatorAccessToken\":\"A21AAK8pfJfsD1_frlWk0cmzTei_1Vsu8sNFI2B8uYyEVZ0dXusiknwKJHBVd1tMSljQzYRwWYWxftY_wUW4-J2SgAMzl_bsw\",\"paymentSource\":\"paypal\"}', '2022-12-02 18:22:13', '2022-12-02 18:22:13'),
(9, 2, 4, 0, 'James Albert', '34.99', '5T961320RJ684663A', 'I-F2CELHMY0GEA', '{\"orderID\":\"5T961320RJ684663A\",\"subscriptionID\":\"I-F2CELHMY0GEA\",\"facilitatorAccessToken\":\"A21AAK8pfJfsD1_frlWk0cmzTei_1Vsu8sNFI2B8uYyEVZ0dXusiknwKJHBVd1tMSljQzYRwWYWxftY_wUW4-J2SgAMzl_bsw\",\"paymentSource\":\"paypal\"}', '2022-12-02 18:26:51', '2022-12-02 19:22:30'),
(10, 1, 2, 3, 'user', '10', '9SU78432YM3034643', 'I-L2L17W390RFE', '{\"orderID\":\"9SU78432YM3034643\",\"subscriptionID\":\"I-L2L17W390RFE\",\"facilitatorAccessToken\":\"A21AALb66RXjNZAPmbpVd_Uv2nHNLv6EPhmrTL_PoK-4WWIzQTwS7sFHud9_rGnKlh5JdoPJKJ8OEG_0-Tle5QwdjQNxA2R7A\",\"paymentSource\":\"paypal\"}', '2022-12-05 10:31:47', '2022-12-05 13:27:23'),
(11, 1, 3, 2, 'user', '19.99', '60B0673012989405L', 'I-SK0G1NWW3W7T', '{\"orderID\":\"60B0673012989405L\",\"subscriptionID\":\"I-SK0G1NWW3W7T\",\"facilitatorAccessToken\":\"A21AALqjXKtkQKUyBHovvkLWF2arDQtXYtLZpILtvSYf0_-ykvqG1xtupd0KLb1mkOEOZM93mbPd07jHVaZtuPxmbQmc4L_Kg\",\"paymentSource\":\"paypal\"}', '2022-12-05 11:09:41', '2022-12-05 11:56:46'),
(12, 1, 2, 0, 'user', '10', '3LU91513TC823381B', 'I-R9YDXFD7JCF6', '{\"orderID\":\"3LU91513TC823381B\",\"subscriptionID\":\"I-R9YDXFD7JCF6\",\"facilitatorAccessToken\":\"A21AAJfJADUpeOXLNNOC17VCkG67tJI6ewlS5kGxh6Mj8Ctbn3roLJrMINyXijqe7UkeFC-6Bw_yRvqFPKzmQMx65SbdLKZ7g\",\"paymentSource\":\"paypal\"}', '2022-12-05 13:05:45', '2022-12-05 13:05:45'),
(13, 1, 2, 2, 'user', '10', '2K9908398G459962N', 'I-2RM3K47F30SM', '{\"orderID\":\"2K9908398G459962N\",\"subscriptionID\":\"I-2RM3K47F30SM\",\"facilitatorAccessToken\":\"A21AAJfJADUpeOXLNNOC17VCkG67tJI6ewlS5kGxh6Mj8Ctbn3roLJrMINyXijqe7UkeFC-6Bw_yRvqFPKzmQMx65SbdLKZ7g\",\"paymentSource\":\"paypal\"}', '2022-12-05 13:17:53', '2022-12-05 13:25:14'),
(14, 1, 2, 1, 'user', '10', '0AV72063UP704894A', 'I-4DH3XSLCRC6F', '{\"orderID\":\"0AV72063UP704894A\",\"subscriptionID\":\"I-4DH3XSLCRC6F\",\"facilitatorAccessToken\":\"A21AAJfJADUpeOXLNNOC17VCkG67tJI6ewlS5kGxh6Mj8Ctbn3roLJrMINyXijqe7UkeFC-6Bw_yRvqFPKzmQMx65SbdLKZ7g\",\"paymentSource\":\"paypal\"}', '2022-12-05 13:27:23', '2022-12-05 13:59:22'),
(15, 3, 2, 3, 'meer', '10', '3M712895R7775973A', 'I-UEC16PG6XYYW', '{\"orderID\":\"3M712895R7775973A\",\"subscriptionID\":\"I-UEC16PG6XYYW\",\"facilitatorAccessToken\":\"A21AALNfWiLoI0zs-xIEB5MXXAZqvXgEObb0UdpsuZm8KRtWeh5ApwlthcgMisUh0eBRiYHt2fTRk77H9dxdDh4dtJxmFHj7w\",\"paymentSource\":\"paypal\"}', '2022-12-05 14:04:11', '2022-12-05 15:38:16'),
(16, 3, 2, 0, 'meer', '10', '3EW244721C609732Y', 'I-L76909RE6LN6', '{\"orderID\":\"3EW244721C609732Y\",\"subscriptionID\":\"I-L76909RE6LN6\",\"facilitatorAccessToken\":\"A21AALNfWiLoI0zs-xIEB5MXXAZqvXgEObb0UdpsuZm8KRtWeh5ApwlthcgMisUh0eBRiYHt2fTRk77H9dxdDh4dtJxmFHj7w\",\"paymentSource\":\"paypal\"}', '2022-12-05 14:43:09', '2022-12-05 15:14:48'),
(17, 3, 3, 3, 'meer', '19.99', '0B617747T8622354D', 'I-43DY60CWTY2B', '{\"orderID\":\"0B617747T8622354D\",\"subscriptionID\":\"I-43DY60CWTY2B\",\"facilitatorAccessToken\":\"A21AALNfWiLoI0zs-xIEB5MXXAZqvXgEObb0UdpsuZm8KRtWeh5ApwlthcgMisUh0eBRiYHt2fTRk77H9dxdDh4dtJxmFHj7w\",\"paymentSource\":\"paypal\"}', '2022-12-05 14:53:35', '2022-12-05 14:55:04'),
(18, 3, 3, 1, 'meer', '19.99', '06078928C49743649', 'I-K5L59CJYAT0M', '{\"orderID\":\"06078928C49743649\",\"subscriptionID\":\"I-K5L59CJYAT0M\",\"facilitatorAccessToken\":\"A21AALNfWiLoI0zs-xIEB5MXXAZqvXgEObb0UdpsuZm8KRtWeh5ApwlthcgMisUh0eBRiYHt2fTRk77H9dxdDh4dtJxmFHj7w\",\"paymentSource\":\"paypal\"}', '2022-12-05 14:55:05', '2022-12-05 15:17:03'),
(19, 3, 2, 0, 'meer', '10', NULL, NULL, '{\"3\":null}', '2022-12-05 15:31:29', '2022-12-05 15:31:29'),
(20, 3, 2, 0, 'meer', '10', '1EA993266M315851H', 'I-4291GPD8SBAG', '{\"orderID\":\"1EA993266M315851H\",\"subscriptionID\":\"I-4291GPD8SBAG\",\"facilitatorAccessToken\":\"A21AALlzFbOleyWi4BkFjp9eAB7Un65miMTiqx9OQqSnCxGCOKIfeSekfFVHMXw2EGc4RlTYPGCSEja3cQsm-jZRyNFjd3Ejw\",\"paymentSource\":\"paypal\"}', '2022-12-05 15:38:16', '2022-12-05 15:38:16'),
(21, 4, 2, 2, 'Skyler Shannon', '10', '9GR43699L0888024P', 'I-C5G4JUTRA21L', '{\"orderID\":\"9GR43699L0888024P\",\"subscriptionID\":\"I-C5G4JUTRA21L\",\"facilitatorAccessToken\":\"A21AALlzFbOleyWi4BkFjp9eAB7Un65miMTiqx9OQqSnCxGCOKIfeSekfFVHMXw2EGc4RlTYPGCSEja3cQsm-jZRyNFjd3Ejw\",\"paymentSource\":\"paypal\"}', '2022-12-05 15:54:55', '2022-12-05 17:10:40'),
(22, 5, 2, 3, 'Adil', '10', '90P549667E374044C', 'I-6288PRCC5CSA', '{\"orderID\":\"90P549667E374044C\",\"subscriptionID\":\"I-6288PRCC5CSA\",\"facilitatorAccessToken\":\"A21AAKPNuT1j7FtO1r7FvuyZ1XgMD1SIuhMVLVA4J8iLPeZIVDkkqLgV_ACLF9u7zN2Cch2yexXQttSdUyqgQ16DJfsUoPQog\",\"paymentSource\":\"paypal\"}', '2022-12-05 17:13:40', '2022-12-05 17:14:31'),
(23, 5, 3, 2, 'Adil', '19.99', '1B752203GF0956310', 'I-EV65W67TVMXT', '{\"orderID\":\"1B752203GF0956310\",\"subscriptionID\":\"I-EV65W67TVMXT\",\"facilitatorAccessToken\":\"A21AAKPNuT1j7FtO1r7FvuyZ1XgMD1SIuhMVLVA4J8iLPeZIVDkkqLgV_ACLF9u7zN2Cch2yexXQttSdUyqgQ16DJfsUoPQog\",\"paymentSource\":\"paypal\"}', '2022-12-05 17:14:31', '2022-12-05 17:32:45'),
(24, 6, 2, 2, 'Jannny', '10', '1T553694920185828', 'I-1FBMERL190UD', '{\"orderID\":\"1T553694920185828\",\"subscriptionID\":\"I-1FBMERL190UD\",\"facilitatorAccessToken\":\"A21AAIioJ7loI-wWLg4AmPcQmlrWytAShV99mV5SX_GB8TLERXK3pM1Uw9kkbQiq1UyZaN8BOa338jx2I2pXfT-DcemJZuXuA\",\"paymentSource\":\"paypal\"}', '2022-12-06 10:23:15', '2022-12-06 10:29:12'),
(25, 6, 1, 2, 'Jannny', '0.00', '2DL637610W499262E', 'I-2M496V2AR2WH', '{\"orderID\":\"2DL637610W499262E\",\"subscriptionID\":\"I-2M496V2AR2WH\",\"facilitatorAccessToken\":\"A21AAIioJ7loI-wWLg4AmPcQmlrWytAShV99mV5SX_GB8TLERXK3pM1Uw9kkbQiq1UyZaN8BOa338jx2I2pXfT-DcemJZuXuA\",\"paymentSource\":\"paypal\"}', '2022-12-06 10:29:55', '2022-12-06 10:30:33'),
(26, 6, 1, 2, 'Jannny', '0.00', '9NG31789LB9650640', 'I-TR0W4JGR4PYB', '{\"orderID\":\"9NG31789LB9650640\",\"subscriptionID\":\"I-TR0W4JGR4PYB\",\"facilitatorAccessToken\":\"A21AAIioJ7loI-wWLg4AmPcQmlrWytAShV99mV5SX_GB8TLERXK3pM1Uw9kkbQiq1UyZaN8BOa338jx2I2pXfT-DcemJZuXuA\",\"paymentSource\":\"paypal\"}', '2022-12-06 10:32:10', '2022-12-06 10:34:27'),
(27, 6, 2, 1, 'Jannny', '10', '33F674367V458352M', 'I-P7UXRY7D3C19', '{\"orderID\":\"33F674367V458352M\",\"subscriptionID\":\"I-P7UXRY7D3C19\",\"facilitatorAccessToken\":\"A21AAIioJ7loI-wWLg4AmPcQmlrWytAShV99mV5SX_GB8TLERXK3pM1Uw9kkbQiq1UyZaN8BOa338jx2I2pXfT-DcemJZuXuA\",\"paymentSource\":\"paypal\"}', '2022-12-06 10:40:06', '2022-12-06 10:42:58'),
(28, 6, 3, 3, 'Jannny', '19.99', '3T699888FR295224E', 'I-56JLSD79KY5S', '{\"orderID\":\"3T699888FR295224E\",\"subscriptionID\":\"I-56JLSD79KY5S\",\"facilitatorAccessToken\":\"A21AAIioJ7loI-wWLg4AmPcQmlrWytAShV99mV5SX_GB8TLERXK3pM1Uw9kkbQiq1UyZaN8BOa338jx2I2pXfT-DcemJZuXuA\",\"paymentSource\":\"paypal\"}', '2022-12-06 10:41:09', '2022-12-06 10:46:08'),
(29, 6, 4, 3, 'Jannny', '34.99', '2V577286RW2025705', 'I-37BPH5L6XEJJ', '{\"orderID\":\"2V577286RW2025705\",\"subscriptionID\":\"I-37BPH5L6XEJJ\",\"facilitatorAccessToken\":\"A21AAIioJ7loI-wWLg4AmPcQmlrWytAShV99mV5SX_GB8TLERXK3pM1Uw9kkbQiq1UyZaN8BOa338jx2I2pXfT-DcemJZuXuA\",\"paymentSource\":\"paypal\"}', '2022-12-06 10:46:08', '2022-12-16 17:55:23'),
(30, 7, 2, 3, 'Adil', '10', '21P57413G0544790E', 'I-8D8F1PMKDMUC', '{\"orderID\":\"21P57413G0544790E\",\"subscriptionID\":\"I-8D8F1PMKDMUC\",\"facilitatorAccessToken\":\"A21AAJsmSU8qke9iRpX1kC_aiYrWF3qj6koDhLrwC91P0ypTXpTcaGUGqrjgFZKto3YYT7QWu-zjmqFEBQKtSgYtpzomFcoog\",\"paymentSource\":\"paypal\"}', '2022-12-06 15:24:17', '2022-12-06 15:27:59'),
(31, 7, 3, 2, 'Adil', '19.99', '8BR16739NP9973316', 'I-1K3R01LP70HB', '{\"orderID\":\"8BR16739NP9973316\",\"subscriptionID\":\"I-1K3R01LP70HB\",\"facilitatorAccessToken\":\"A21AAJsmSU8qke9iRpX1kC_aiYrWF3qj6koDhLrwC91P0ypTXpTcaGUGqrjgFZKto3YYT7QWu-zjmqFEBQKtSgYtpzomFcoog\",\"paymentSource\":\"paypal\"}', '2022-12-06 15:28:00', '2022-12-06 15:29:55'),
(32, 6, 2, 2, 'Jannny', '10', '5TR3461465030401L', 'I-DUH86FJYB4BG', '{\"orderID\":\"5TR3461465030401L\",\"subscriptionID\":\"I-DUH86FJYB4BG\",\"facilitatorAccessToken\":\"A21AAJain5xl8YMTwOOilE2gprICPHaMxytOoNQiRnEQ9YnD_EobrlV-xVqBjdgardk36LhJy0yw5c09C_e0TT25sjSpRUU_w\",\"paymentSource\":\"paypal\"}', '2022-12-16 17:53:26', '2022-12-16 17:54:48'),
(33, 6, 3, 0, 'Jannny', '19.99', '1E988627B2393935W', 'I-WK63TL02W4DU', '{\"orderID\":\"1E988627B2393935W\",\"subscriptionID\":\"I-WK63TL02W4DU\",\"facilitatorAccessToken\":\"A21AAJain5xl8YMTwOOilE2gprICPHaMxytOoNQiRnEQ9YnD_EobrlV-xVqBjdgardk36LhJy0yw5c09C_e0TT25sjSpRUU_w\",\"paymentSource\":\"paypal\"}', '2022-12-16 17:55:23', '2022-12-16 17:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_plans`
--

CREATE TABLE `paypal_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_cycles_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_response` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_plans`
--

INSERT INTO `paypal_plans` (`id`, `user_id`, `product_id`, `plan_id`, `name`, `description`, `plan_price`, `Currency`, `interval_count`, `billing_cycles_period`, `plan_response`, `status`, `created_at`, `updated_at`) VALUES
(8, 6, 'PROD-58902938CA238762B', 'P-9V034721MK507642NMONE7CI', 'Golden', 'Shop Golden PLAN', '31', 'usd', '1', 'YEAR', '{\"id\":\"P-9V034721MK507642NMONE7CI\",\"product_id\":\"PROD-58902938CA238762B\",\"name\":\"Golden\",\"status\":\"ACTIVE\",\"description\":\"Shop Golden PLAN\",\"usage_type\":\"LICENSED\",\"create_time\":\"2022-12-14T22:34:49Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-9V034721MK507642NMONE7CI\",\"rel\":\"self\",\"method\":\"GET\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-9V034721MK507642NMONE7CI\",\"rel\":\"edit\",\"method\":\"PATCH\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-9V034721MK507642NMONE7CI\\/deactivate\",\"rel\":\"self\",\"method\":\"POST\",\"encType\":\"application\\/json\"}]}', 0, '2022-12-14 17:34:50', '2022-12-16 12:24:19'),
(9, 6, 'PROD-58902938CA238762B', 'P-67E09034GU880681VMONE7QA', 'Golden', 'Shop Golden PLAN', '12', 'usd', '1', 'WEEK', '{\"id\":\"P-67E09034GU880681VMONE7QA\",\"product_id\":\"PROD-58902938CA238762B\",\"name\":\"Golden\",\"status\":\"ACTIVE\",\"description\":\"Shop Golden PLAN\",\"usage_type\":\"LICENSED\",\"create_time\":\"2022-12-14T22:35:44Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-67E09034GU880681VMONE7QA\",\"rel\":\"self\",\"method\":\"GET\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-67E09034GU880681VMONE7QA\",\"rel\":\"edit\",\"method\":\"PATCH\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-67E09034GU880681VMONE7QA\\/deactivate\",\"rel\":\"self\",\"method\":\"POST\",\"encType\":\"application\\/json\"}]}', 0, '2022-12-14 17:35:45', '2022-12-16 13:31:06'),
(10, 7, 'PROD-3KM51210SR1550500', 'P-7JW44396RU9886032MONX7HI', 'New York', 'Basic Music', '12', 'usd', '1', 'MONTH', '{\"id\":\"P-7JW44396RU9886032MONX7HI\",\"product_id\":\"PROD-3KM51210SR1550500\",\"name\":\"New York\",\"status\":\"ACTIVE\",\"description\":\"Basic Music\",\"usage_type\":\"LICENSED\",\"create_time\":\"2022-12-15T20:12:13Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-7JW44396RU9886032MONX7HI\",\"rel\":\"self\",\"method\":\"GET\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-7JW44396RU9886032MONX7HI\",\"rel\":\"edit\",\"method\":\"PATCH\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-7JW44396RU9886032MONX7HI\\/deactivate\",\"rel\":\"self\",\"method\":\"POST\",\"encType\":\"application\\/json\"}]}', 0, '2022-12-15 15:12:14', '2022-12-16 13:31:09'),
(11, 6, 'PROD-4S535289U5278150A', 'P-25B069361B0264204MOOL4OY', 'Paris', 'Paris shoot Basic', '10', 'usd', '1', 'WEEK', '{\"id\":\"P-25B069361B0264204MOOL4OY\",\"product_id\":\"PROD-4S535289U5278150A\",\"name\":\"Paris\",\"status\":\"ACTIVE\",\"description\":\"Paris shoot Basic\",\"usage_type\":\"LICENSED\",\"create_time\":\"2022-12-16T18:51:39Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-25B069361B0264204MOOL4OY\",\"rel\":\"self\",\"method\":\"GET\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-25B069361B0264204MOOL4OY\",\"rel\":\"edit\",\"method\":\"PATCH\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-25B069361B0264204MOOL4OY\\/deactivate\",\"rel\":\"self\",\"method\":\"POST\",\"encType\":\"application\\/json\"}]}', 0, '2022-12-16 13:51:39', '2022-12-16 14:02:14'),
(12, 6, 'PROD-08N856815G236341T', 'P-95X44606VW236413TMOOM22Y', 'Istanbul', 'Istanbul SILVER PLAN', '10', 'usd', NULL, 'YEAR', '{\"id\":\"P-95X44606VW236413TMOOM22Y\",\"product_id\":\"PROD-08N856815G236341T\",\"name\":\"Istanbul\",\"status\":\"ACTIVE\",\"description\":\"Istanbul SILVER PLAN\",\"usage_type\":\"LICENSED\",\"create_time\":\"2022-12-16T19:56:27Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-95X44606VW236413TMOOM22Y\",\"rel\":\"self\",\"method\":\"GET\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-95X44606VW236413TMOOM22Y\",\"rel\":\"edit\",\"method\":\"PATCH\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-95X44606VW236413TMOOM22Y\\/deactivate\",\"rel\":\"self\",\"method\":\"POST\",\"encType\":\"application\\/json\"}]}', 1, '2022-12-16 14:56:27', '2022-12-16 17:43:42'),
(13, 6, 'PROD-4CY318491K698624D', 'P-8N883159LC8377038MOOPPXY', 'Singapore', 'Singapore Tour Basic', '20', 'usd', NULL, 'MONTH', '{\"id\":\"P-8N883159LC8377038MOOPPXY\",\"product_id\":\"PROD-4CY318491K698624D\",\"name\":\"Singapore\",\"status\":\"ACTIVE\",\"description\":\"Singapore Tour Basic\",\"usage_type\":\"LICENSED\",\"create_time\":\"2022-12-16T22:57:35Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-8N883159LC8377038MOOPPXY\",\"rel\":\"self\",\"method\":\"GET\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-8N883159LC8377038MOOPPXY\",\"rel\":\"edit\",\"method\":\"PATCH\",\"encType\":\"application\\/json\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/billing\\/plans\\/P-8N883159LC8377038MOOPPXY\\/deactivate\",\"rel\":\"self\",\"method\":\"POST\",\"encType\":\"application\\/json\"}]}', 0, '2022-12-16 17:57:35', '2022-12-16 17:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_products`
--

CREATE TABLE `paypal_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_response` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_products`
--

INSERT INTO `paypal_products` (`id`, `user_id`, `name`, `description`, `type`, `category`, `product_id`, `product_response`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'Silver', 'Shop Silver PLAN', NULL, NULL, 'PROD-2HR68734RJ4247933', '{\"id\":\"PROD-2HR68734RJ4247933\",\"name\":\"Silver\",\"description\":\"Shop Silver PLAN\",\"create_time\":\"2022-12-12T19:21:50Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-2HR68734RJ4247933\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-2HR68734RJ4247933\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-12 14:21:50', '2022-12-12 14:21:50'),
(2, 6, 'Golden', 'Shop Golden PLAN', NULL, NULL, 'PROD-58902938CA238762B', '{\"id\":\"PROD-58902938CA238762B\",\"name\":\"Golden\",\"description\":\"Shop Golden PLAN\",\"create_time\":\"2022-12-12T19:22:17Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-58902938CA238762B\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-58902938CA238762B\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-12 14:22:17', '2022-12-12 14:22:17'),
(3, 6, 'Diamond', 'Shop Diamond PLAN', NULL, NULL, 'PROD-9RD60798DG869610L', '{\"id\":\"PROD-9RD60798DG869610L\",\"name\":\"Diamond\",\"description\":\"Shop Diamond PLAN\",\"create_time\":\"2022-12-12T19:22:50Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-9RD60798DG869610L\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-9RD60798DG869610L\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-12 14:22:50', '2022-12-12 14:22:50'),
(4, 6, 'BASIC', 'Events Basic Plans', NULL, NULL, 'PROD-4FP82533J0761234U', '{\"id\":\"PROD-4FP82533J0761234U\",\"name\":\"BASIC\",\"description\":\"Events Basic Plans\",\"create_time\":\"2022-12-14T21:16:52Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4FP82533J0761234U\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4FP82533J0761234U\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-14 16:16:52', '2022-12-14 16:16:52'),
(5, 6, 'Premium', 'Movies Premium', NULL, NULL, 'PROD-4PP236380X422360H', '{\"id\":\"PROD-4PP236380X422360H\",\"name\":\"Premium\",\"description\":\"Movies Premium\",\"create_time\":\"2022-12-14T21:22:33Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4PP236380X422360H\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4PP236380X422360H\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-14 16:22:33', '2022-12-14 16:22:33'),
(6, 6, 'SilverPlay', 'Rivers Silver PLAN', NULL, NULL, 'PROD-4B7866429D167300E', '{\"id\":\"PROD-4B7866429D167300E\",\"name\":\"SilverPlay\",\"description\":\"Rivers Silver PLAN\",\"create_time\":\"2022-12-14T21:32:06Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4B7866429D167300E\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4B7866429D167300E\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-14 16:32:07', '2022-12-14 16:32:07'),
(7, 7, 'New York', 'Basic Music Album', NULL, NULL, 'PROD-3KM51210SR1550500', '{\"id\":\"PROD-3KM51210SR1550500\",\"name\":\"New York\",\"description\":\"Basic Music\",\"create_time\":\"2022-12-15T20:11:48Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-3KM51210SR1550500\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-3KM51210SR1550500\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-15 15:11:49', '2022-12-15 15:39:34'),
(8, 7, 'London', 'london Golden', NULL, NULL, 'PROD-9DG64097AS663003X', '{\"id\":\"PROD-9DG64097AS663003X\",\"name\":\"London\",\"description\":\"london Golden\",\"create_time\":\"2022-12-15T20:44:57Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-9DG64097AS663003X\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-9DG64097AS663003X\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-15 15:44:58', '2022-12-15 15:44:58'),
(9, 7, 'London', 'london Golden', NULL, NULL, 'PROD-8HC558298G4806001', '{\"id\":\"PROD-8HC558298G4806001\",\"name\":\"London\",\"description\":\"london Golden\",\"create_time\":\"2022-12-15T20:46:09Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-8HC558298G4806001\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-8HC558298G4806001\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-15 15:46:10', '2022-12-15 15:46:10'),
(10, 6, 'Paris', 'Paris shoot Basic', NULL, NULL, 'PROD-4S535289U5278150A', '{\"id\":\"PROD-4S535289U5278150A\",\"name\":\"Paris\",\"description\":\"Paris shoot Basic\",\"create_time\":\"2022-12-16T18:35:55Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4S535289U5278150A\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4S535289U5278150A\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-16 13:35:55', '2022-12-16 13:35:55'),
(11, 6, 'Istanbul', 'Istanbul SILVER PLAN', NULL, NULL, 'PROD-08N856815G236341T', '{\"id\":\"PROD-08N856815G236341T\",\"name\":\"Istanbul\",\"description\":\"Istanbul SILVER PLAN\",\"create_time\":\"2022-12-16T19:44:21Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-08N856815G236341T\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-08N856815G236341T\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-16 14:44:21', '2022-12-16 14:44:21'),
(12, 6, 'Singapore', 'Singapore Tour Basic', NULL, NULL, 'PROD-4CY318491K698624D', '{\"id\":\"PROD-4CY318491K698624D\",\"name\":\"Singapore\",\"description\":\"Singapore Tour Basic\",\"create_time\":\"2022-12-16T22:56:36Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4CY318491K698624D\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-4CY318491K698624D\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-16 17:56:36', '2022-12-16 17:56:36'),
(13, 6, 'Malta', 'Malta Tour Basic', NULL, NULL, 'PROD-3TF35604NJ3134115', '{\"id\":\"PROD-3TF35604NJ3134115\",\"name\":\"Malta\",\"description\":\"Malta Tour Basic\",\"create_time\":\"2022-12-16T23:09:06Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-3TF35604NJ3134115\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/catalogs\\/products\\/PROD-3TF35604NJ3134115\",\"rel\":\"edit\",\"method\":\"PATCH\"}]}', 0, '2022-12-16 18:09:07', '2022-12-16 18:09:07');

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
-- Table structure for table `refund_payments`
--

CREATE TABLE `refund_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `refund_id` int(11) DEFAULT NULL,
  `status` int(119) DEFAULT 1,
  `package_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_response` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refund_payments`
--

INSERT INTO `refund_payments` (`id`, `user_id`, `refund_id`, `status`, `package_amount`, `payment_id`, `package_response`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, NULL, '1DG69213AG209212V', '{\"id\":\"73891239TJ7501209\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/73891239TJ7501209\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/5Y423533DX0675032\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-08 13:57:19', '2022-12-08 13:57:19'),
(2, 1, NULL, 1, NULL, '52613356TW9215625', '{\"id\":\"5FV43443KS284742Y\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/5FV43443KS284742Y\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/3EK28151K16697843\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-08 14:22:47', '2022-12-08 14:22:47'),
(3, 1, NULL, 1, NULL, '1PR30681YK768881U', '{\"id\":\"6SF65411GY050854U\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/6SF65411GY050854U\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/1F207898K1497910C\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-08 14:48:16', '2022-12-08 14:48:16'),
(4, 1, NULL, 1, NULL, '2KM89942BL229572X', '{\"id\":\"97T93251M4996935V\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/97T93251M4996935V\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/399806895C2965411\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-08 14:58:16', '2022-12-08 14:58:16'),
(5, 1, NULL, 1, NULL, '30C2055419731122C', '{\"id\":\"1EU41616VH8140417\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/1EU41616VH8140417\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/4C729148MB131220R\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-08 14:58:26', '2022-12-08 14:58:26'),
(6, 4, NULL, 1, NULL, '9DN54224RB930574H', '{\"id\":\"46R672132Y562823X\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/46R672132Y562823X\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/69964741NA6620544\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-09 10:44:42', '2022-12-09 10:44:42'),
(7, 4, NULL, 1, NULL, '084042086A315001R', '{\"id\":\"2VF29226KM996670U\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/2VF29226KM996670U\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/9N9888285A691312T\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-09 12:50:53', '2022-12-09 12:50:53'),
(8, 6, NULL, 1, NULL, '1E889081KS392642A', '{\"id\":\"4M8863099L717761T\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/4M8863099L717761T\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/95F523861K9037456\",\"rel\":\"up\",\"method\":\"GET\"}]}', '2022-12-16 17:50:37', '2022-12-16 17:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `single_paypal_payments`
--

CREATE TABLE `single_paypal_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_response` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `single_paypal_payments`
--

INSERT INTO `single_paypal_payments` (`id`, `user_id`, `package_id`, `status`, `name`, `package_amount`, `payment_id`, `package_response`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 'user', '10', '1DG69213AG209212V', '{\"create_time\":\"2022-12-08T18:25:20Z\",\"update_time\":\"2022-12-08T18:25:32Z\",\"id\":\"1DG69213AG209212V\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"value\":\"10.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"5Y423533DX0675032\",\"final_capture\":\"true\",\"create_time\":\"2022-12-08T18:25:32Z\",\"update_time\":\"2022-12-08T18:25:32Z\",\"amount\":{\"value\":\"10.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/5Y423533DX0675032\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/5Y423533DX0675032\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/1DG69213AG209212V\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/1DG69213AG209212V\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2022-12-08 13:25:33', '2022-12-08 13:25:33'),
(2, 1, 3, 0, 'user', '19.99', '1PR30681YK768881U', '{\"create_time\":\"2022-12-08T19:15:58Z\",\"update_time\":\"2022-12-08T19:16:06Z\",\"id\":\"1PR30681YK768881U\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"value\":\"19.99\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"1F207898K1497910C\",\"final_capture\":\"true\",\"create_time\":\"2022-12-08T19:16:06Z\",\"update_time\":\"2022-12-08T19:16:06Z\",\"amount\":{\"value\":\"19.99\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/1F207898K1497910C\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/1F207898K1497910C\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/1PR30681YK768881U\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/1PR30681YK768881U\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2022-12-08 14:16:07', '2022-12-08 14:16:07'),
(3, 1, 2, 0, 'user', '10', '52613356TW9215625', '{\"create_time\":\"2022-12-08T19:18:00Z\",\"update_time\":\"2022-12-08T19:18:09Z\",\"id\":\"52613356TW9215625\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"value\":\"10.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"3EK28151K16697843\",\"final_capture\":\"true\",\"create_time\":\"2022-12-08T19:18:09Z\",\"update_time\":\"2022-12-08T19:18:09Z\",\"amount\":{\"value\":\"10.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/3EK28151K16697843\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/3EK28151K16697843\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/52613356TW9215625\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/52613356TW9215625\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2022-12-08 14:18:11', '2022-12-08 14:18:11'),
(4, 1, 3, 0, 'user', '19.99', '7RM42670LX090840H', '{\"create_time\":\"2022-12-08T19:55:19Z\",\"update_time\":\"2022-12-08T19:55:28Z\",\"id\":\"7RM42670LX090840H\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"value\":\"19.99\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"55G32648AE856251X\",\"final_capture\":\"true\",\"create_time\":\"2022-12-08T19:55:28Z\",\"update_time\":\"2022-12-08T19:55:28Z\",\"amount\":{\"value\":\"19.99\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/55G32648AE856251X\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/55G32648AE856251X\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7RM42670LX090840H\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7RM42670LX090840H\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2022-12-08 14:55:31', '2022-12-08 14:55:31'),
(5, 1, 3, 0, 'user', '19.99', '30C2055419731122C', '{\"create_time\":\"2022-12-08T19:56:55Z\",\"update_time\":\"2022-12-08T19:57:03Z\",\"id\":\"30C2055419731122C\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"value\":\"19.99\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"4C729148MB131220R\",\"final_capture\":\"true\",\"create_time\":\"2022-12-08T19:57:03Z\",\"update_time\":\"2022-12-08T19:57:03Z\",\"amount\":{\"value\":\"19.99\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/4C729148MB131220R\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/4C729148MB131220R\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/30C2055419731122C\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/30C2055419731122C\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2022-12-08 14:57:05', '2022-12-08 14:57:05'),
(6, 1, 4, 0, 'user', '34.99', '2KM89942BL229572X', '{\"create_time\":\"2022-12-08T19:57:27Z\",\"update_time\":\"2022-12-08T19:57:36Z\",\"id\":\"2KM89942BL229572X\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"value\":\"34.99\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"399806895C2965411\",\"final_capture\":\"true\",\"create_time\":\"2022-12-08T19:57:36Z\",\"update_time\":\"2022-12-08T19:57:36Z\",\"amount\":{\"value\":\"34.99\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/399806895C2965411\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/399806895C2965411\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/2KM89942BL229572X\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/2KM89942BL229572X\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2022-12-08 14:57:38', '2022-12-08 14:57:38'),
(7, 4, 2, 0, 'Skyler Shannon', '10', '4YX110638D638364Y', '{\"id\":\"4YX110638D638364Y\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"10.00\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"63C51793UW907251A\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"10.00\"},\"final_capture\":\"true\",\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-12-09T15:20:22Z\",\"update_time\":\"2022-12-09T15:20:22Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"}},\"create_time\":\"2022-12-09T15:19:49Z\",\"update_time\":\"2022-12-09T15:20:22Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/4YX110638D638364Y\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-12-09 10:20:24', '2022-12-09 10:20:24'),
(8, 4, 3, 0, 'Skyler Shannon', '19.99', '9DN54224RB930574H', '{\"id\":\"9DN54224RB930574H\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"19.99\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"69964741NA6620544\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"19.99\"},\"final_capture\":\"true\",\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-12-09T15:43:27Z\",\"update_time\":\"2022-12-09T15:43:27Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"}},\"create_time\":\"2022-12-09T15:43:17Z\",\"update_time\":\"2022-12-09T15:43:27Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/9DN54224RB930574H\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-12-09 10:43:30', '2022-12-09 10:43:30'),
(9, 4, 3, 0, 'Skyler Shannon', '19.99', '084042086A315001R', '{\"id\":\"084042086A315001R\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"19.99\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"9N9888285A691312T\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"19.99\"},\"final_capture\":\"true\",\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-12-09T17:50:34Z\",\"update_time\":\"2022-12-09T17:50:34Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"}},\"create_time\":\"2022-12-09T17:50:18Z\",\"update_time\":\"2022-12-09T17:50:34Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/084042086A315001R\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-12-09 12:50:35', '2022-12-09 12:50:35'),
(10, 6, 3, 0, 'Jannny', '19.99', '1E889081KS392642A', '{\"id\":\"1E889081KS392642A\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"19.99\"},\"payee\":{\"email_address\":\"sb-hbanr15523997@business.example.com\",\"merchant_id\":\"4JFSCZS37V9AC\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"95F523861K9037456\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"19.99\"},\"final_capture\":\"true\",\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-12-16T21:33:09Z\",\"update_time\":\"2022-12-16T21:33:09Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-rdmju21368986@personal.example.com\",\"payer_id\":\"K9AM3ZSN2M33U\",\"address\":{\"country_code\":\"US\"}},\"create_time\":\"2022-12-16T21:32:47Z\",\"update_time\":\"2022-12-16T21:33:09Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/1E889081KS392642A\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2022-12-16 16:33:10', '2022-12-16 16:33:10');

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
(5, 2, 'default', 'sub_1MAKdzJ5CNuTNvMYGgPu8Yfh', 'active', 'plan_MmcahUUmlKWiqp', 1, NULL, NULL, NULL, '2022-12-01 16:50:16', '2022-12-01 16:50:16'),
(6, 6, 'default', 'sub_1MGmNYJ5CNuTNvMYxZJSitER', 'active', 'plan_MmcbPGjrPXB1BT', 1, NULL, NULL, NULL, '2022-12-19 11:39:54', '2022-12-19 11:39:54');

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
(5, 5, 'si_Mu8vs3Zz2KOqZt', 'prod_MmcaLTrLIRJe1H', 'plan_MmcahUUmlKWiqp', 1, '2022-12-01 16:50:16', '2022-12-01 16:50:16'),
(6, 6, 'si_N0nz5hocKkv7qP', 'prod_MmcbdjYGnneJg2', 'plan_MmcbPGjrPXB1BT', 1, '2022-12-19 11:39:54', '2022-12-19 11:39:54');

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
(2, 'James Albert', 'iamjamesalbertt@gmail.com', NULL, '$2y$10$IxNiq9.eFx2dNDNa5Y/KqeP7kzMK.YkB8AHJcuWJVemcMn0mfeMp2', NULL, '2022-11-11 18:26:55', '2022-11-11 18:28:29', 'cus_Mmg04nP1tzc5sb', 'visa', '4242', NULL),
(3, 'meer', 'meer@gmail.com', NULL, '$2y$10$VZ0e/Cu.z8D42mC1EdCcuOj.Osi5//EXdwzrs4y4jfDbfCKxi1mne', NULL, '2022-12-05 14:03:12', '2022-12-05 14:03:12', NULL, NULL, NULL, NULL),
(4, 'Skyler Shannon', 'Skyler @gmail.com', NULL, '$2y$10$x..ZXa5znnXYtJZabrxBA.mdELfEXnvbVisXXUh63lvTZ6UmiYNDe', NULL, '2022-12-05 15:53:44', '2022-12-05 15:53:44', NULL, NULL, NULL, NULL),
(5, 'Adil', 'meer1@gmail.com', NULL, '$2y$10$j4vu27JbcwTMgXDnagavt./HE8TZC8gk/PckqSs9Tgf4L/fSouWU6', NULL, '2022-12-05 17:12:49', '2022-12-05 17:12:49', NULL, NULL, NULL, NULL),
(6, 'Jannny', 'paradise@gmail.com', NULL, '$2y$10$xoahMwzYZoCYwbwpqnzy1eAdwQL2fKSyKqCyuh27ioIh9F3scTMXa', NULL, '2022-12-06 10:14:00', '2022-12-19 11:39:52', 'cus_N0nzcOtmDZZbU7', 'visa', '4242', NULL),
(7, 'Adil', 'ali1@gmail.com', NULL, '$2y$10$Tt7WxUIFEPpBox8J12MYBuXtRo3eoMjQJqQZCNbfYQdKiH2C.nM2W', NULL, '2022-12-06 15:23:38', '2022-12-06 15:23:38', NULL, NULL, NULL, NULL);

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
-- Indexes for table `paypal_plans`
--
ALTER TABLE `paypal_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_products`
--
ALTER TABLE `paypal_products`
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
-- Indexes for table `refund_payments`
--
ALTER TABLE `refund_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `single_paypal_payments`
--
ALTER TABLE `single_paypal_payments`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paypalpayments`
--
ALTER TABLE `paypalpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `paypal_plans`
--
ALTER TABLE `paypal_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `paypal_products`
--
ALTER TABLE `paypal_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `refund_payments`
--
ALTER TABLE `refund_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `single_paypal_payments`
--
ALTER TABLE `single_paypal_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

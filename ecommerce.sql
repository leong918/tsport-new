-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2024 at 09:31 AM
-- Server version: 5.7.41
-- PHP Version: 8.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', '$2y$12$8pJ0NECtwF9hLtqo7vPDi.LzsDTJvkDs5xkKgLYf2FKEkcl2NZiBu', 1, NULL, '2024-02-23 01:13:28', '2024-02-23 01:13:28', NULL),
(2, 'Jeff', 'jeff', '$2y$12$BxnWeHIINUNaWH9CkzVEOuJLldaj/ghYhIyL4th2DT6KtW4Wj90hK', 1, NULL, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `title`, `icon`, `url`, `type`, `key`, `sort`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Admin', 'fa-solid fa-user-gear', NULL, 'system_config', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(2, NULL, 'Product & Category', 'fa-solid fa-folder-open', NULL, 'shop', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(3, NULL, 'Blog', 'fa-solid fa-blog', NULL, 'shop', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(4, NULL, 'Currency', 'fa-solid fa-dollar-sign', NULL, 'system_config', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(5, NULL, 'User', 'fa-solid fa-user', NULL, 'system_config', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(6, 1, 'Admin List', NULL, 'admin.admin.index', 'system_config', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(7, 2, 'Product List', NULL, 'admin.product.index', 'shop', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(8, 2, 'Category List', NULL, 'admin.category.index', 'shop', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(9, 2, 'Brand List', NULL, 'admin.brand.index', 'shop', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(10, 3, 'Blog List', NULL, 'admin.blog.index', 'shop', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(11, 4, 'Currency List', NULL, 'admin.currency.index', 'system_config', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL),
(12, 5, 'User List', NULL, 'admin.user.index', 'system_config', NULL, 1, 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `name`, `status`, `sort`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Blog 1', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(2, 'Blog 2', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(3, 'Blog 3', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(4, 'Blog 4', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(5, 'Blog 5', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(6, 'Blog 6', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(7, 'Blog 7', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(8, 'Blog 8', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(9, 'Blog 9', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL),
(10, 'Blog 10', 1, 0, '2024-02-25 16:00:00', '2024-02-26 00:56:02', '2024-02-26 00:56:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_detail`
--

CREATE TABLE `blog_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_detail`
--

INSERT INTO `blog_detail` (`id`, `blog_id`, `language`, `name`, `image`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(2, 1, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(3, 2, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(4, 2, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(5, 3, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(6, 3, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(7, 4, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(8, 4, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(9, 5, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(10, 5, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(11, 6, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(12, 6, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(13, 7, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(14, 7, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(15, 8, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(16, 8, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(17, 9, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(18, 9, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL),
(19, 10, 'en', 'Blog 1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/ZejLdcCK4MgRXpVlNsvUYNT1aBuNPfwjq8gAq1lY.png', '<p>Blog 1 Description</p>', '2024-02-26 00:56:03', '2024-02-26 00:56:03', NULL),
(20, 10, 'cn', '博客1', 'https://vvinners-staging.sgp1.digitaloceanspaces.com/blog_detail/s0Z4LSfZFQu6LVfCqMCN8YdyrEojsJ5WXZA8usQM.png', '<p>博客1描述</p>', '2024-02-26 00:56:04', '2024-02-26 00:56:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `status`, `sort`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(2, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(3, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(4, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(5, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(6, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(7, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(8, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(9, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(10, 'Lovinah', 1, 0, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/brand/RGs6jogUHLqfj2DaeV8j8JW0lwhhquPeCY2Y2fZs.png', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand_description`
--

CREATE TABLE `brand_description` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_description`
--

INSERT INTO `brand_description` (`id`, `brand_id`, `language`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(2, 1, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(3, 2, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(4, 2, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(5, 3, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(6, 3, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(7, 4, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(8, 4, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(9, 5, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(10, 5, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(11, 6, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(12, 6, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(13, 7, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(14, 7, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(15, 8, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(16, 8, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(17, 9, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(18, 9, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(19, 10, 'en', 'Lovinah', '<p>Tag Concept has been designated as the exclusive distributor for Lovinah in Hong Kong and Macau for four consecutive years, ensuring fresh arrivals every month. With in-depth knowledge of the products and extensive experience in skincare, Tag Concept provides authentic and effective usage methods tailored to individual skin conditions. Unlike typical retail experiences, Tag Concept offers high-quality follow-up services.</p>\r\n<p>Lovinah Supernatural Skincare Brand Story and Philosophy: Joy Bkbator, the founder of Lovinah, grew up in a traditional Nigerian village where her grandmother, a herbalist, traditional healer, bone setter, and midwife, imparted ancient African healing wisdom. From her grandmother, Joy learned about the healing power of nature. While working full-time as a computer programmer and raising three children in three years, Joy\'s hectic lifestyle led to hormonal imbalances, sudden weight gain, and a plethora of health issues, including cancerous growths. Despite trying various products with no results, Joy refused to let her son use steroid creams prescribed by doctors. This decision marked a turning point as she sought genuine healing from nature\'s remedies. Grateful for her decision, Joy and her children found healing through the supernatural power of nature, marking the beginning of Lovinah.</p>\r\n<p>Lovinah Supernatural Skincare honors ancient African beauty wisdom and traditional herbal formulas. Inspired by centuries-old African beauty secrets and traditional botanical remedies, the brand combines modern technology to address various skin concerns. Lovinah offers a range of high-performance and multifunctional products aimed at addressing hormone-related issues, preventing premature skin aging, improving skin tone, and helping the skin resist environmental pollutants and damage.</p>\r\n<p>All products are free from: Parabens, Phthalates, Sulphates, Formaldehyde, Gluten, Mineral Oil, Petroleum, and are cruelty-free.</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL),
(20, 10, 'cn', 'Lovinah', '<p>Tag Concept（本店）連續四年為Lovinah指定香港及澳門地區代理商，保證每月新鮮到貨。對產品具有深入了解及擁有豐富治理皮膚經驗，能針對客人個列皮腐狀況提供最正宗最有效使用方法，有別於一般一買一賣的零售體驗，給你優質的後跟進服務。 Lovinah Supernatural Skincare品牌故事及理念： Joy Bkbator 是Lovinah的創人，她在察鄉尼日利亞的一倒傳統非羅案庭中長大。進的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向進傳授古老的那洲档終知業，自小她就從祖母身上微發到大自然的治愈力最。joy 在全職擔任計算檢程序員的需候，同時在三年內生了三個孩子，虛大的歷力令煌而爾豪重失調、體查驟增，並且全驗長滿癌癒，非常縮普。姓試了市面上的產品，但沒有為姐帶來任何效果。而當時她的孩子的皮膚亦同標出現間題，在拜訪多個醫生之後，娘最小的兒子得到了處方穀固感一這就是轉折點，她拒絕讓兒子聚用類固發，並決定從大自然的方量去我尋求真正的治愈。娘感謝自己的決定，因為大自然真的用超自然力量治總了她和娘的孩子，這是Lovinah說生的開始。 Lovinah Supernatural skincare是對古代非洲美容智慧和傳統草媒配方的該敬與遺現。品牌的自然識膚品的靈感，是來自古老的非洲美容秘缺和練有數百年曆史的傳統非而植物水法，並加人現代技術，以解決不同的皮膚問題。Lovinah提供一系列全指物高性能和多功能產品，台在照銷和解決惱人的荷爾蒙圖題，以及預財皮膚衰老，明顯改普厲色，幫助皮膚抵抗環境的污染和損胄。 所有產品不合：對羥基苯甲酸酯，鄰苯二甲酸盥，琉酸鹽，型化劑，麩質，礦物油，石油，不經動物試驗。</p>', '2024-02-23 01:15:34', '2024-02-23 01:15:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `type`, `status`, `sort`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cleanser', 'skincare', 1, 0, '2024-02-23 01:24:57', '2024-02-23 01:24:57', NULL),
(2, 'Makeup', 'makeup', 1, 0, '2024-02-23 01:25:44', '2024-02-23 01:25:44', NULL),
(3, 'Body Care', 'hairbody', 1, 0, '2024-02-23 01:37:19', '2024-02-23 01:37:19', NULL),
(4, 'Ampoules', 'skincare', 1, 0, '2024-02-25 19:27:02', '2024-02-25 19:27:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_description`
--

CREATE TABLE `category_description` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_description`
--

INSERT INTO `category_description` (`id`, `category_id`, `language`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Cleanser', '<p>Cleanser Description</p>', '2024-02-23 01:24:57', '2024-02-23 01:24:57', NULL),
(2, 1, 'cn', '清洁剂', '<p><strong>清洁剂简介</strong></p>', '2024-02-23 01:24:57', '2024-02-23 01:24:57', NULL),
(3, 2, 'en', 'Makeup', '<p>Makeup</p>', '2024-02-23 01:25:44', '2024-02-23 01:25:44', NULL),
(4, 2, 'cn', '化妆品', '<p>化妆品简介</p>', '2024-02-23 01:25:44', '2024-02-23 01:25:44', NULL),
(5, 3, 'en', 'Body Care', '<p>Body Care Description</p>', '2024-02-23 01:37:19', '2024-02-23 01:37:19', NULL),
(6, 3, 'cn', '身体护理', '<p>身体护理产品描述</p>', '2024-02-23 01:37:19', '2024-02-23 01:37:19', NULL),
(7, 4, 'en', 'Ampoule', '<p>Ampoule Description</p>', '2024-02-25 19:27:02', '2024-02-25 19:27:02', NULL),
(8, 4, 'cn', '安瓿', '<p>安瓿描述</p>', '2024-02-25 19:27:02', '2024-02-25 19:27:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MALAYSIA RINGGIT', 'MYR', 1, '2024-02-23 01:15:51', '2024-02-23 01:15:51', NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(1, '2014_10_12_000000_create_user_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_02_121830_create_admin_table', 1),
(6, '2024_01_23_112753_create_product_table', 1),
(7, '2024_01_24_023341_create_brand_table', 1),
(8, '2024_01_24_033117_create_admin_menu_table', 1),
(9, '2024_01_24_035329_create_brand_description_table', 1),
(10, '2024_01_24_035831_create_category_description_table', 1),
(11, '2024_01_24_035847_create_category_table', 1),
(12, '2024_01_24_042207_create_product_image_table', 1),
(13, '2024_01_24_042832_create_product_price_table', 1),
(14, '2024_01_24_044305_create_product_description_table', 1),
(15, '2024_01_24_045138_create_product_related_table', 1),
(16, '2024_01_24_045508_create_blog_table', 1),
(17, '2024_01_24_050242_create_blog_detail_table', 1),
(18, '2024_01_24_050524_create_currency_table', 1),
(19, '2024_01_24_090853_create_blog_comment_table', 1),
(20, '2024_01_29_113353_create_plugin_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `plugin`
--

CREATE TABLE `plugin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `is_best_seller` tinyint(4) NOT NULL DEFAULT '0',
  `is_new` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `brand_id`, `category_id`, `name`, `sku`, `alias`, `status`, `sort`, `is_best_seller`, `is_new`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Product 1', '1', 'product-1', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(2, 1, 1, 'Product 2', '2', 'product-2', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(3, 1, 1, 'Product 3', '3', 'product-3', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(4, 1, 1, 'Product 4', '4', 'product-4', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(5, 1, 1, 'Product 5', '5', 'product-5', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(6, 1, 4, 'Product 6', '6', 'product-6', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(7, 1, 4, 'Product 7', '7', 'product-7', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(8, 1, 4, 'Product 8', '8', 'product-8', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(9, 1, 4, 'Product 9', '9', 'product-9', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(10, 1, 4, 'Product 10', '10', 'product-10', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(11, 1, 2, 'Product 11', '11', 'product-11', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(12, 1, 2, 'Product 12', '12', 'product-12', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(13, 1, 2, 'Product 13', '13', 'product-13', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(14, 1, 2, 'Product 14', '14', 'product-14', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(15, 1, 2, 'Product 15', '15', 'product-15', 1, 0, 1, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(16, 1, 2, 'Product 16', '16', 'product-16', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(17, 1, 2, 'Product 17', '17', 'product-17', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(18, 1, 2, 'Product 18', '18', 'product-18', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(19, 1, 2, 'Product 19', '19', 'product-19', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(20, 1, 2, 'Product 20', '20', 'product-20', 1, 0, 0, 1, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(21, 1, 3, 'Product 21', '21', 'product-21', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(22, 1, 3, 'Product 22', '22', 'product-22', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(23, 1, 3, 'Product 23', '23', 'product-23', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(24, 1, 3, 'Product 24', '24', 'product-24', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(25, 1, 3, 'Product 25', '25', 'product-25', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(26, 1, 3, 'Product 26', '26', 'product-26', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(27, 1, 3, 'Product 27', '27', 'product-27', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(28, 1, 3, 'Product 28', '28', 'product-28', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(29, 1, 3, 'Product 29', '29', 'product-29', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(30, 1, 3, 'Product 30', '30', 'product-30', 1, 0, 0, 0, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_description`
--

CREATE TABLE `product_description` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredient` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `usage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_information` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_description`
--

INSERT INTO `product_description` (`id`, `product_id`, `language`, `name`, `information`, `description`, `ingredient`, `usage`, `additional_information`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(2, 1, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(3, 2, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(4, 2, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(5, 3, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(6, 3, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(7, 4, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(8, 4, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(9, 5, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(10, 5, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(11, 6, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(12, 6, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(13, 7, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(14, 7, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(15, 8, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(16, 8, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(17, 9, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(18, 9, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(19, 10, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(20, 10, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(21, 11, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(22, 11, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(23, 12, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(24, 12, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(25, 13, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(26, 13, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(27, 14, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(28, 14, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(29, 15, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(30, 15, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(31, 16, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(32, 16, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(33, 17, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(34, 17, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(35, 18, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(36, 18, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(37, 19, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(38, 19, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(39, 20, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(40, 20, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(41, 21, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(42, 21, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(43, 22, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(44, 22, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(45, 23, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(46, 23, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(47, 24, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(48, 24, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(49, 25, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(50, 25, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(51, 26, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(52, 26, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(53, 27, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(54, 27, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(55, 28, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(56, 28, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(57, 29, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(58, 29, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(59, 30, 'en', 'Product', '<p>Product Information</p>', '<p>Product Description</p>', '<p>Ingredient Description</p>', '<p>Ingredient Usage</p>', '<p>Ingredient Additional Information</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(60, 30, 'cn', '产品', '<p>产品内容</p>', '<p>产品描述</p>', '<p>产品成分</p>', '<p>产品功效</p>', '<p>产品附加内容</p>', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(2, 2, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(3, 3, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(4, 4, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(5, 5, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(6, 6, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(7, 7, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(8, 8, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(9, 9, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(10, 10, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(11, 11, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(12, 12, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(13, 13, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(14, 14, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(15, 15, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(16, 16, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(17, 17, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(18, 18, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(19, 19, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(20, 20, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(21, 21, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(22, 22, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(23, 23, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(24, 24, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(25, 25, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(26, 26, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(27, 27, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(28, 28, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(29, 29, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL),
(30, 30, 'https://vvinners-staging.sgp1.digitaloceanspaces.com/product/ozmMqzk3nk3ofnXP7zHuYFYIyxwcm2SnYtRVXiu0.png', '2024-02-23 01:40:19', '2024-02-23 01:40:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `currency_id`, `code`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(2, 2, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(3, 3, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(4, 4, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(5, 5, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(6, 6, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(7, 7, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(8, 8, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(9, 9, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(10, 10, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(11, 11, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(12, 12, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(13, 13, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(14, 14, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(15, 15, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(16, 16, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(17, 17, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(18, 18, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(19, 19, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(20, 20, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(21, 21, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(22, 22, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(23, 23, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(24, 24, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(25, 25, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(26, 26, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(27, 27, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(28, 28, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(29, 29, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL),
(30, 30, 1, 'MYR', 99.00, '2024-02-23 01:40:17', '2024-02-23 01:40:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_related`
--

CREATE TABLE `product_related` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `related_product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `phone_no`, `dob`, `password`, `referral_email`, `referral_phone_no`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'User', 'ABC', 'userABC', 'user@gmail.com', '60123456789', '2024-02-23 01:13:29', '$2y$12$azeZVG2EjP5mmexdToxIjeQMqyGUwbp19SKR2GqnZmswy84xLJg/e', 'referral@gmail.com', '60112223333', 1, '2024-02-23 01:13:29', '2024-02-23 01:13:29', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_description`
--
ALTER TABLE `brand_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_description`
--
ALTER TABLE `category_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plugin`
--
ALTER TABLE `plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku_unique` (`sku`),
  ADD UNIQUE KEY `product_alias_unique` (`alias`);

--
-- Indexes for table `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_related`
--
ALTER TABLE `product_related`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_detail`
--
ALTER TABLE `blog_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brand_description`
--
ALTER TABLE `brand_description`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_description`
--
ALTER TABLE `category_description`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plugin`
--
ALTER TABLE `plugin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_description`
--
ALTER TABLE `product_description`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_related`
--
ALTER TABLE `product_related`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 07:45 AM
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
-- Database: `votesmash`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Health', '2025-05-15 12:35:40', '2025-05-15 12:35:40'),
(2, 'Politics', '2025-05-15 12:35:40', '2025-05-15 12:35:40'),
(3, 'Business', '2025-05-15 12:35:40', '2025-05-15 12:35:40'),
(4, 'Science', '2025-05-15 12:35:40', '2025-05-15 12:35:40'),
(5, 'Weather', '2025-05-15 12:35:40', '2025-05-15 12:35:40'),
(6, 'Technology', '2025-05-15 12:35:40', '2025-05-15 12:35:40'),
(7, 'Earthquake', '2025-05-15 12:35:40', '2025-05-15 12:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `match1_answers`
--

CREATE TABLE `match1_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `match_info_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `user_answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match1_answers`
--

INSERT INTO `match1_answers` (`id`, `match_info_id`, `question_id`, `user_answer`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'By requiring more on-site servers', '2025-05-15 13:07:07', '2025-05-15 13:07:07'),
(2, 1, 2, 'Manual scaling', '2025-05-15 13:07:07', '2025-05-15 13:07:07'),
(3, 3, 1, 'By requiring more on-site servers', '2025-05-15 20:22:21', '2025-05-15 20:22:21'),
(4, 3, 2, 'Manual scaling', '2025-05-15 20:22:21', '2025-05-15 20:22:21'),
(5, 3, 3, 'By depending on physical hardware', '2025-05-15 20:22:21', '2025-05-15 20:22:21'),
(6, 5, 6, 'Schizophrenia', '2025-05-15 23:17:08', '2025-05-15 23:17:08'),
(7, 5, 7, 'Persistent worry or fear', '2025-05-15 23:17:08', '2025-05-15 23:17:08'),
(8, 5, 8, 'Sleeping less than 4 hours', '2025-05-15 23:17:08', '2025-05-15 23:17:08'),
(9, 6, 6, 'Schizophrenia', '2025-05-16 16:30:00', '2025-05-16 16:30:00'),
(10, 6, 7, 'Persistent worry or fear', '2025-05-16 16:30:00', '2025-05-16 16:30:00'),
(11, 6, 8, 'Regular exercise', '2025-05-16 16:30:00', '2025-05-16 16:30:00'),
(12, 8, 9, 'A new programming language used to build websites', '2025-05-16 22:17:14', '2025-05-16 22:17:14'),
(13, 8, 10, 'Writing HTML for websites', '2025-05-16 22:17:14', '2025-05-16 22:17:14'),
(14, 9, 9, 'A new programming language used to build websites', '2025-05-16 22:25:03', '2025-05-16 22:25:03'),
(15, 9, 10, 'Using Excel for data entry', '2025-05-16 22:25:03', '2025-05-16 22:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `match_infos`
--

CREATE TABLE `match_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match_infos`
--

INSERT INTO `match_infos` (`id`, `user_id`, `tour_id`, `start_time`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-05-15 13:03:21.000000', '2025-05-15 13:03:21', '2025-05-15 13:03:21'),
(2, 3, 1, '2025-05-15 13:03:31.000000', '2025-05-15 13:03:31', '2025-05-15 13:03:31'),
(3, 1, 1, '2025-05-15 20:22:12.000000', '2025-05-15 20:22:12', '2025-05-15 20:22:12'),
(4, 4, 1, '2025-05-15 20:24:59.000000', '2025-05-15 20:24:59', '2025-05-15 20:24:59'),
(5, 2, 3, '2025-05-15 23:16:59.000000', '2025-05-15 23:16:59', '2025-05-15 23:16:59'),
(6, 1, 3, '2025-05-16 16:29:26.000000', '2025-05-16 16:29:26', '2025-05-16 16:29:26'),
(7, 5, 1, '2025-05-16 22:08:08.000000', '2025-05-16 22:08:08', '2025-05-16 22:08:08'),
(8, 1, 4, '2025-05-16 22:14:00.000000', '2025-05-16 22:14:00', '2025-05-16 22:14:00'),
(9, 5, 4, '2025-05-16 22:24:59.000000', '2025-05-16 22:24:59', '2025-05-16 22:24:59'),
(10, 3, 4, '2025-05-16 22:49:13.000000', '2025-05-16 22:49:13', '2025-05-16 22:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_08_153051_create_categories_table', 1),
(5, '2025_05_09_152135_create_tours_table', 1),
(6, '2025_05_09_233519_create_questions_table', 1),
(7, '2025_05_11_095558_create_tour_user_table', 1),
(9, '2025_05_12_132405_create_match1_answers_table', 1),
(10, '2025_05_14_152909_create_mvcs_table', 1),
(11, '2025_05_15_101156_create_votings_table', 1),
(12, '2025_05_12_051252_create_match_infos_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mvcs`
--

CREATE TABLE `mvcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MVC` varchar(255) NOT NULL,
  `confidence_rating` tinyint(4) DEFAULT NULL,
  `match_info_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mvcs`
--

INSERT INTO `mvcs` (`id`, `MVC`, `confidence_rating`, `match_info_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'I think Cloud is more powerful than anything', 40, 1, 2, '2025-05-15 13:08:28', '2025-05-15 13:08:28'),
(2, 'What do you think about infraturee?', 50, 1, 2, '2025-05-15 13:08:28', '2025-05-15 13:08:28'),
(3, 'What is your point on this?', NULL, 2, 3, '2025-05-15 13:11:11', '2025-05-15 13:11:11'),
(4, 'More energy, more output', 90, 2, 3, '2025-05-15 13:11:11', '2025-05-15 13:11:11'),
(5, 'Time do not wait until you finish', 30, 2, 3, '2025-05-15 13:11:11', '2025-05-15 13:11:11'),
(6, 'Should mental health education be a mandatory part of school curricula?', 60, 5, 2, '2025-05-15 23:24:49', '2025-05-15 23:24:49'),
(7, 'Should mental illness be treated as a public safety issue or a healthcare issue?', 0, 5, 2, '2025-05-15 23:24:49', '2025-05-15 23:24:49'),
(8, 'Should AI be given legal personhood or rights?', 80, 8, 1, '2025-05-16 22:22:17', '2025-05-16 22:22:17'),
(9, 'Will AI ever surpass human intelligence completely (Artificial General Intelligence)?', 80, 9, 5, '2025-05-16 22:30:20', '2025-05-16 22:30:20'),
(10, 'Should AI be allowed in military weapons and warfare?', NULL, 9, 5, '2025-05-16 22:30:20', '2025-05-16 22:30:20'),
(11, 'Is AI-generated content (art, music, writing) truly creative?', 89, 9, 5, '2025-05-16 22:30:20', '2025-05-16 22:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `tour_id`, `options`, `created_at`, `updated_at`) VALUES
(1, 'How does cloud computing reduce IT infrastructure costs?', 1, '[\"By requiring more on-site servers\",\"Through a pay-as-you-go pricing model\",\"By eliminating the need for the internet\",\"By requiring long-term contracts\"]', '2025-05-15 12:47:42', '2025-05-15 12:47:42'),
(2, 'Which feature of cloud computing supports rapid business expansion?', 1, '[\"Static hosting\",\"Manual scaling\",\"Automatic resource scaling\",\"Local-only data access\"]', '2025-05-15 12:47:42', '2025-05-15 12:47:42'),
(3, 'How does cloud computing enhance business continuity?', 1, '[\"By eliminating the need for backups\",\"Through remote data storage and disaster recovery\",\"By depending on physical hardware\",\"Through slower deployment cycles\"]', '2025-05-15 12:47:42', '2025-05-15 12:47:42'),
(4, 'Which condition most often leads to the formation of hurricanes?', 2, '[\"Cold ocean water and calm winds\",\"Warm ocean water and moist air\",\"Dry deserts and low humidity\",\"High-altitude snowstorms\"]', '2025-05-15 12:50:55', '2025-05-15 12:50:55'),
(5, 'What is a common consequence of prolonged heavy rainfall in urban areas?', 2, '[\"Reduced water supply\",\"Earthquakes\",\"Flash floods\",\"Drought\"]', '2025-05-15 12:50:55', '2025-05-15 12:50:55'),
(6, 'What is the most common mental health disorder worldwide?', 3, '[\"Schizophrenia\",\"Bipolar Disorder\",\"Depression\",\"PTSD\"]', '2025-05-15 22:56:13', '2025-05-15 22:56:13'),
(7, 'Which of the following is a common symptom of anxiety disorders?', 3, '[\"Chest pain from heart disease\",\"Persistent worry or fear\",\"High blood sugar\",\"Hallucinations\"]', '2025-05-15 22:56:13', '2025-05-15 22:56:13'),
(8, 'Which lifestyle habit is most helpful for maintaining good mental health?', 3, '[\"Avoiding social contact\",\"Sleeping less than 4 hours\",\"Regular exercise\",\"Working without breaks\"]', '2025-05-15 22:56:13', '2025-05-15 22:56:13'),
(9, 'Which of the following best defines Artificial Intelligence?', 4, '[\"A new programming language used to build websites\",\"A machine\'s ability to perform tasks that typically require human intelligence\",\"A type of internet connection\",\"A mobile phone operating system\"]', '2025-05-16 21:57:56', '2025-05-16 21:57:56'),
(10, 'Which of these is a common application of AI in everyday life?', 4, '[\"Writing HTML for websites\",\"Using Excel for data entry\",\"Personalized recommendations on Netflix or YouTube\",\"Sending SMS messages manually\"]', '2025-05-16 21:57:56', '2025-05-16 21:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hoxywihaMFg1kzBHyVj1IeM3iv45v6uASHz48yIN', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ3A4UjZYcW9HWXdTTTBkaGFFRzJWc0tIOVhMUGQxSXVHUTF6ckMwZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tdmMvMTEvdm90ZS9BZ3JlZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ3NDU1NzQ1O319', 1747458178),
('KejFEPqy7DISYAIYcbbb5dr6TIW1SXWXpdKHv7Gm', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNm1taGhnSGUzV0NWWGhiWE5oUmRtRkJMWFIwYWcwU3plN1ljVXdmVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90b3VyLzQvcmVzdWx0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1747458273),
('QTl7VESe1gIQAVjkIPkbyTM5Bfolo2IaRRncymQO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmdMQWJiRVJUd2dyNldCU1QyVGVSb0tUOEp5ZndEZnNHTk9kQThvVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RvdXIvMS9yZXN1bHQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747455727),
('Qwmf4oBpEZJiua1e6VP5rJkypjzKmpdES1pP7TbR', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUnJkcHZGeFJYZGtFdDg2R1BONGFtNk9ianFnSFhDTjVzejZ1N01LZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90b3VyLzQvcmVzdWx0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDc0NTgwNDc7fX0=', 1747459158);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_date` date NOT NULL,
  `tour_time` time NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `live_event_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `title`, `category_id`, `question`, `user_id`, `tour_date`, `tour_time`, `cover_image`, `video_link`, `live_event_link`, `created_at`, `updated_at`) VALUES
(1, 'Emerging Trends in Innovation', 3, 'What is a key advantage of adopting cloud computing for modern businesses?', 1, '2025-05-16', '01:48:00', 'cover_images/FX3bSO005oaHQhPyh6IojP4AyNjqYAaElQDxs9xo.jpg', 'https://youtu.be/ZNl1vsSmPG4?si=9JNTMOrNros8NX3d', 'https://youtu.be/ZNl1vsSmPG4?si=9JNTMOrNros8NX3d', '2025-05-15 12:47:42', '2025-05-15 12:47:42'),
(2, 'Understanding Extreme Weather Events', 5, 'How do extreme weather events impact the environment and human society?', 1, '2025-05-17', '15:00:00', 'cover_images/ZFlav2qaxN4GGzSXUwRzO7TKlWHA7yuQ23He67be.jpg', 'https://youtu.be/ZNl1vsSmPG4?si=9JNTMOrNros8NX3d', 'https://youtu.be/ZNl1vsSmPG4?si=9JNTMOrNros8NX3d', '2025-05-15 12:50:55', '2025-05-15 12:50:55'),
(3, 'Understanding Mental Health Awareness', 1, 'Why is mental health considered a vital part of overall well-being?', 1, '2025-05-16', '12:17:00', 'cover_images/Jnymy3EmTpBk7vBUNNd2qSQ1lJYAhoTnnJlMJwGX.jpg', 'https://youtu.be/ZNl1vsSmPG4?si=9JNTMOrNros8NX3d', 'https://youtu.be/JkwkmzQ4GRs?si=sG5a-qbJO4pZrdFh', '2025-05-15 22:56:13', '2025-05-15 22:56:13'),
(4, 'Artificial Intellligence', 6, 'What is the impact of Ai on our daily life?', 1, '2025-05-17', '10:30:00', 'cover_images/n0BUB9h27ot3nBTUpVUNOu30fMzyxll9xNBtQE3X.jpg', 'blah blah', 'blah blah', '2025-05-16 21:57:56', '2025-05-16 21:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `tour_user`
--

CREATE TABLE `tour_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_user`
--

INSERT INTO `tour_user` (`id`, `user_id`, `tour_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(3, 1, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 1, 3, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 5, 4, NULL, NULL),
(8, 5, 1, NULL, NULL),
(9, 1, 4, NULL, NULL),
(10, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `wallet` decimal(15,8) NOT NULL DEFAULT 10.00000000,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `telephone`, `profile_image`, `wallet`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shwe', 'Zin', 'shwezin@gmail.com', '094332323', 'profiles/zizUDeokYrTvmHRyx7nHMqky7Oh9D7O6vm6KdYYu.jpg', 6.89000000, 'admin', NULL, '$2y$12$c3uua5vojHEDyT8j46sLPOyWJE9z64N/YfLfC2YC29aGSrhzbsRkK', NULL, '2025-05-15 12:36:21', '2025-05-16 22:32:58'),
(2, 'Soe', 'Mon', 'soemon@gmail.com', '094343434', 'profiles/mFYogWXKnK6ERlO0zdRrxilBUwB9KuEnb7cs2aO4.jpg', 55.66720000, 'user', NULL, '$2y$12$4KxaGr9LOxVcvGJRDgdGLOsnhhNQd5DD5tgGHuIORewuuM4eMByny', NULL, '2025-05-15 12:38:22', '2025-05-16 21:52:05'),
(3, 'Mi', 'Mi', 'mimi@gmail.com', '09434343', 'profiles/Gr6VTP5OETSUqmCcpJGOcShPYdq7EjouO1EuDEOH.jpg', 34.26896000, 'user', NULL, '$2y$12$dXE2ZXo3wQ4KIYoIeEoOTe4IwUiGbhizE.ULtzZVRcoXyst2hXbpO', NULL, '2025-05-15 12:39:18', '2025-05-16 22:49:06'),
(4, 'Than', 'Naing', 'thannaing@gmail.com', '09323232', 'profiles/vkx3mu81SYp1lh1qI1JaGnWDtJQSaTt3lICDmZT2.jpg', 9.00000000, 'user', NULL, '$2y$12$6Xg9MWjJEqIqZYfoesQLRe8cl1kpbdrtm94oDjx7FZbNrwBrMcRAG', NULL, '2025-05-15 20:24:01', '2025-05-15 20:24:54'),
(5, 'Shwe', 'Zin', 'testing@gmail.com', '094243232', 'profiles/2m5omqv0mgVbsjRgsm8RkiQoWL3am8RCQJErRiBG.jpg', 9.20660000, 'user', NULL, '$2y$12$v4E8QZPnVsLp5GrxnGYooukM6Z.lC4OruRESYvDYSNb3g./8vJ2Hm', NULL, '2025-05-16 21:49:54', '2025-05-16 22:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `votings`
--

CREATE TABLE `votings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mvc_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` enum('Agree','Disagree','Improvement') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votings`
--

INSERT INTO `votings` (`id`, `mvc_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Agree', '2025-05-15 13:17:27', '2025-05-15 13:17:27'),
(2, 3, 2, 'Disagree', '2025-05-15 13:17:38', '2025-05-15 13:17:38'),
(3, 4, 2, 'Agree', '2025-05-15 13:17:41', '2025-05-15 13:17:41'),
(4, 5, 2, 'Improvement', '2025-05-15 13:17:44', '2025-05-15 13:17:44'),
(5, 1, 3, 'Agree', '2025-05-15 13:17:59', '2025-05-16 18:01:47'),
(6, 2, 3, 'Agree', '2025-05-15 13:18:03', '2025-05-15 13:18:03'),
(7, 4, 3, 'Agree', '2025-05-15 13:18:12', '2025-05-15 13:18:17'),
(8, 5, 3, 'Agree', '2025-05-15 13:18:19', '2025-05-15 13:18:19'),
(9, 6, 2, 'Agree', '2025-05-15 23:37:27', '2025-05-15 23:37:27'),
(10, 7, 2, 'Agree', '2025-05-15 23:37:29', '2025-05-15 23:37:29'),
(11, 1, 1, 'Agree', '2025-05-16 17:59:22', '2025-05-16 17:59:22'),
(12, 8, 5, 'Disagree', '2025-05-16 22:31:56', '2025-05-16 22:32:01'),
(13, 9, 5, 'Agree', '2025-05-16 22:32:18', '2025-05-16 22:32:18'),
(14, 10, 5, 'Agree', '2025-05-16 22:32:19', '2025-05-16 22:32:19'),
(15, 11, 5, 'Improvement', '2025-05-16 22:32:21', '2025-05-16 22:32:21'),
(16, 8, 1, 'Agree', '2025-05-16 22:32:55', '2025-05-16 22:32:55'),
(17, 9, 1, 'Agree', '2025-05-16 22:32:56', '2025-05-16 22:32:56'),
(18, 10, 1, 'Agree', '2025-05-16 22:32:57', '2025-05-16 22:32:57'),
(19, 11, 1, 'Agree', '2025-05-16 22:32:58', '2025-05-16 22:32:58');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match1_answers`
--
ALTER TABLE `match1_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_infos`
--
ALTER TABLE `match_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mvcs`
--
ALTER TABLE `mvcs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_user`
--
ALTER TABLE `tour_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_user_user_id_foreign` (`user_id`),
  ADD KEY `tour_user_tour_id_foreign` (`tour_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votings`
--
ALTER TABLE `votings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match1_answers`
--
ALTER TABLE `match1_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `match_infos`
--
ALTER TABLE `match_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mvcs`
--
ALTER TABLE `mvcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tour_user`
--
ALTER TABLE `tour_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votings`
--
ALTER TABLE `votings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tour_user`
--
ALTER TABLE `tour_user`
  ADD CONSTRAINT `tour_user_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tour_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

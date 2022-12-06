-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 12 月 06 日 10:14
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `medapp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `calendar`
--

CREATE TABLE `calendar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL COMMENT '開始日',
  `end_date` date NOT NULL COMMENT '終了日',
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'イベント名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'ユーザID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `calendar`
--

INSERT INTO `calendar` (`id`, `start_date`, `end_date`, `event_name`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '2022-12-02', '2022-12-03', '薬を飲む', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
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
-- テーブルの構造 `meds`
--

CREATE TABLE `meds` (
  `id` int(11) NOT NULL COMMENT 'システムID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `name` varchar(100) NOT NULL COMMENT '薬名',
  `days` varchar(100) NOT NULL COMMENT '曜日',
  `amount` int(11) NOT NULL COMMENT '数量',
  `type` varchar(100) DEFAULT NULL COMMENT '錠・個・包',
  `comments` varchar(255) DEFAULT NULL COMMENT '備考欄',
  `time` varchar(100) NOT NULL COMMENT '朝・昼・夕・就寝前',
  `date_of_creation` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '投稿日時',
  `date_of_update` datetime DEFAULT NULL,
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT 'delete flag'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `meds`
--

INSERT INTO `meds` (`id`, `user_id`, `name`, `days`, `amount`, `type`, `comments`, `time`, `date_of_creation`, `date_of_update`, `del_flag`) VALUES
(1, 1, 'バファリン', '月、火、水、木、金、土、日', 1, '錠', '慢性の頭痛のため', '朝', '2022-12-01 09:56:57', '2022-12-01 09:34:15', 1),
(2, 1, 'ステロイド', '月、火、水、木、金、土、日', 2, '錠', NULL, '朝、昼、夕、就寝前', '2022-12-05 17:16:04', '2022-12-05 17:16:04', 0),
(3, 1, 'aaaa', '水、木', 1, '個', 'aaa', '昼、夕', '2022-11-30 15:00:39', NULL, 1),
(4, 1, 'バファリン', '月、火、水、木、金、土、日', 1, '錠', '慢性の頭痛のため', '朝、昼、夕、就寝前', '2022-12-01 09:58:12', NULL, 0),
(5, 4, '薬3', '月、木、金、土', 3, '個', NULL, '夕、就寝前', '2022-12-01 10:40:31', NULL, 0),
(6, 1, '薬3', '月、火、水、木、金', 22, '個', 'ああああ', '昼、夕', '2022-12-05 17:30:05', '2022-12-05 17:30:05', 0),
(7, 1, '薬5', '月、水、木、金、土、日', 1, '個', 'ああああ', '朝、昼', '2022-12-02 18:02:29', NULL, 1),
(8, 1, '薬5', '月、火', 2, '包', 'ああああああ', '朝、昼', '2022-12-02 18:05:23', NULL, 1),
(9, 1, '薬5', '月、火', 2, '包', 'ああああ', '朝、夕', '2022-12-02 18:12:34', NULL, 1),
(10, 1, '薬5', '水、木、金', 33, '個', 'あああああ', '朝、昼', '2022-12-02 18:19:29', '2022-12-02 18:19:19', 1),
(11, 1, '薬5', '月、火、木', 33, '錠', 'ああああああ', '夕、就寝前', '2022-12-02 18:21:41', '2022-12-02 18:21:33', 1),
(12, 1, '薬5', '火、木、金、土、日', 33, '個', 'aaa', '朝、昼、夕', '2022-12-05 17:29:56', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_11_25_060834_create_sessions_table', 1),
(7, '2022_12_02_132203_calendar', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('cmeier130@gmail.com', '$2y$10$sMGIsx0WtLTR11HU4YpBue1ExcYoVSrqg4Y6EfTjKLXH1ZYPYEfR2', '2022-12-02 08:27:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL COMMENT 'システムID',
  `patientid` int(11) NOT NULL COMMENT '患者のユーザ ID',
  `doctorid` int(11) NOT NULL COMMENT '医療関係者のユーザID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `patients`
--

INSERT INTO `patients` (`id`, `patientid`, `doctorid`) VALUES
(1, 1, 3),
(3, 4, 3),
(5, 1, 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
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
-- テーブルの構造 `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VXAYOg58DOPUuJX8QXSSvc9c2BAicO7X8tZLbzN1', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmdVNnVnVE80VGVuT2JpNTZLUUFEU1hua3dGQ3pRWDNEMkJhT1FXbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1670289021);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role`) VALUES
(1, '山田太郎', 'test@test.co.jp', NULL, '$2y$10$Hn9XrwIYyqYyJWCARUoZu.9c1M4zArqv9qsMkIAw32eBAxKstROxm', NULL, NULL, NULL, NULL, NULL, 'public/profiles/jVqePpoDvxDRUvk1y0EMYtAM9XOgglNd3sXDCoAw.png', '2022-11-27 16:42:16', '2022-12-05 08:31:58', 0),
(2, '管理ユーザ', 'admin@admin.co.jp', NULL, '$2y$10$rRwZpXU5Yw5Br7D68ZnbfOkhNh5WW6Jr4pIGW.zgu8vqIiGK05FNK', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-28 15:02:18', '2022-11-28 15:02:18', 2),
(3, '髙橋', 'doctor@doctor.co.jp', NULL, '$2y$10$H.0maBx9IGiGNp0uzDAome..aMpnNE1CgnmrDegkr2RZbODqBE.HW', NULL, NULL, NULL, NULL, NULL, 'public/profiles/6RNRIVAHM40jxiV3hRxyALwrnTn1KNbdZkYnjMjn.png', '2022-11-28 16:45:22', '2022-12-01 06:49:00', 1),
(4, '田中花子', 'test2@test.co.jp', NULL, '$2y$10$48PLuPHFhBJYUO5YlPp39uhF4XaOqzdu/2X2Ie7OI4C0D/dLtna9y', NULL, NULL, NULL, NULL, NULL, 'public/profiles/zoO8uRioBb7jYcLg9XqTFPrEnxqX63OohPJuRxrj.jpg', '2022-11-30 03:01:09', '2022-12-01 07:13:41', 0),
(5, '橋本', 'doctor2@doctor.co.jp', NULL, '$2y$10$reqYlUmNpTbyK2Z4mrwQ7eBp1VCSkIXB09ZAKM/MxRCKp./GZwLv2', NULL, NULL, NULL, NULL, NULL, 'public/profiles/Lza7ArtrNNJ5O7mAQuSStJaauS445usg63s2mizO.png', '2022-12-01 01:41:49', '2022-12-01 07:16:32', 1),
(7, '山下達郎', 'test3@test.co.jp', NULL, '$2y$10$heyilQTM.wegQpRjF6Zu6esQHkeyU9J6fR7EaABET1tUqUPttEXDC', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-06 01:09:20', '2022-12-06 01:09:20', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- テーブルのインデックス `meds`
--
ALTER TABLE `meds`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- テーブルのインデックス `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `meds`
--
ALTER TABLE `meds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'システムID', AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'システムID', AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

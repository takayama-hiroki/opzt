-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-04-03 08:39:46
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `opzt`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `body` varchar(200) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `articles`
--

INSERT INTO `articles` (`id`, `body`, `user_id`, `created_at`) VALUES
(1, 'テスト①', 3, '2022-03-28 06:10:59'),
(2, 'テスト②', 4, '2022-03-28 06:11:48'),
(3, 'テスト③', 5, '2022-03-28 06:12:19'),
(7, 'つぶやき', 9, '2022-03-29 11:32:08');

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `body`, `user_id`, `article_id`, `comment_id`, `created_at`) VALUES
(7, '返信', 6, 1, NULL, '2022-03-28 06:13:12'),
(8, '返信', 6, 1, NULL, '2022-03-28 06:36:17'),
(9, '返信', 8, 2, NULL, '2022-03-28 06:36:52'),
(12, '返信', 9, 1, NULL, '2022-03-28 16:17:48'),
(13, 'コメント', 9, 1, NULL, '2022-03-29 11:31:31');

-- --------------------------------------------------------

--
-- テーブルの構造 `diary`
--

CREATE TABLE `diary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  `curriculum` varchar(20) DEFAULT NULL,
  `step` varchar(20) DEFAULT NULL,
  `body` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `diary`
--

INSERT INTO `diary` (`id`, `user_id`, `day`, `time`, `curriculum`, `step`, `body`) VALUES
(1, 3, '2022-03-01', '12', 'Linux基礎/フレームワーク', '8-1', 'Linux'),
(2, 4, '2022-03-02', '3', 'PHP自作', '7-2', 'php自作'),
(3, 5, '2022-03-03', '4', 'PHP応用', '6-1', 'php応用'),
(4, 6, '2022-03-06', '2', 'PHP基礎/アルゴリズム', '4-2', 'php基礎'),
(5, 7, '2022-03-11', '5', 'コーディング応用', '3-3', 'コーディング応用'),
(6, 8, '2022-03-13', '10', 'javascript/jQuery', '2-1', 'js'),
(7, 9, '2022-03-14', '10', 'コーディング基礎', '1-1', 'コーディング基礎');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `article_id`, `created_at`) VALUES
(79, 8, 1, '2022-03-28 07:41:38'),
(80, 8, 2, '2022-03-28 07:41:40'),
(91, 9, 1, '2022-03-29 11:31:17');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `account_name` varchar(20) DEFAULT NULL,
  `belong` varchar(10) DEFAULT NULL,
  `learning_time` varchar(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `account_name`, `belong`, `learning_time`, `password`, `updated_at`, `created_at`) VALUES
(1, '犬伏', '犬伏', '管理', NULL, '$2y$10$PGIm6AZfL2uDH3eceqzntODMymqSa0Jey..d8J8zcwmUGObhycaA.', '2022-03-15 04:05:47', '2022-03-15 04:05:47'),
(2, '寺浦', '寺浦', '管理', NULL, '$2y$10$8.v57dh11PPOSDFsaup2DuOgCFgG1LKjCGUaYHgsEgQKIB2Nkl3Iy', '2022-03-15 04:16:30', '2022-03-15 04:16:30'),
(3, '楠田', '楠田', '関東', '12', '$2y$10$cKCKVIg1K4DQ0Hjpepo81OPgpm84KOq2pzicDNBuqul4.0O9qHubm', '2022-03-16 22:09:43', '2022-03-16 22:09:43'),
(4, '小林桂好季', '小林桂好季', '関西', '3', '$2y$10$zyAz4D1CPZr1JikSioHJqOAQ65wkW2DoTKLQHLS1aQJ6XNM4FpjRC', '2022-03-16 22:10:06', '2022-03-16 22:10:06'),
(5, '鳥居裕太', '鳥居裕太', '関西', '4', '$2y$10$lNks0S5uYnFtGaQFKWgcReGuw9TT4jIfthrhMHtExweSNaLSiMFzC', '2022-03-16 22:11:01', '2022-03-16 22:11:01'),
(6, '湊翔平', '湊翔平', '関西', '2', '$2y$10$nGakilhVMLsTQmh02.hovui/6FY36ZutcYGh5h16UR2MdHYy9gv.W', '2022-03-16 22:12:18', '2022-03-16 22:12:18'),
(7, '八田一磨', '八田一磨', '関西', '5', '$2y$10$kYooGIVuBTCKrGIX/BTKjOvdt3sHSokvJAPm2NUSHJUwL4eqFcXEa', '2022-03-16 22:13:06', '2022-03-16 22:13:06'),
(8, '関谷健太', '関谷健太', '関西', '10', '$2y$10$V0AOm0h21L1kG2g2g.YGYO2rVL370Nt635iszR.SBeWygbSMOOH8q', '2022-03-16 22:13:53', '2022-03-16 22:13:53'),
(9, '髙山拓生', '髙山', '関西', '10', '$2y$10$it481MofedgubcGXB7x38OSu81IvCdSjiwYJyWKvySgNJqdIrGjpC', '2022-03-16 22:14:20', '2022-03-16 22:14:20'),
(10, '丸山廉也', '丸山廉也', '関西', NULL, '$2y$10$AEYEY/kNpTfx6FulRfV3HOQn8d/rkGg9mQxS77n8etdzFoRiKiUcC', '2022-03-16 22:14:59', '2022-03-16 22:14:59'),
(11, '安枝浩輝', '安枝浩輝', '関東', NULL, '$2y$10$plvxAYj7aTej5zaDq4rKYeJGCvyaJU3miTki/9R.XLr9EhlgYvoKe', '2022-03-16 22:17:28', '2022-03-16 22:17:28'),
(12, '長谷川万利奈', '長谷川万利奈', '関東', NULL, '$2y$10$BncrV372IWy8zoO4SzEv5O1NZ72.q7fkrI4qWJP.6PbbaKiz4muTW', '2022-03-16 22:18:18', '2022-03-16 22:18:18'),
(13, '正野 琉大', '正野 琉大', '関東', NULL, '$2y$10$hz54YSvrCRLCWkyhjpspoOKHx9F7BTbxIZXDorZljoSxottvuuc9S', '2022-03-16 22:18:41', '2022-03-16 22:18:41'),
(14, '佐藤敦大', '佐藤敦大', '関東', NULL, '$2y$10$Huc2Tom4JZ.6S11N1tZIVezXxSf5C7AN87k/FrPmLygL4L4RM.RYq', '2022-03-16 22:19:02', '2022-03-16 22:19:02'),
(15, '平井光', '平井光', '関西', NULL, '$2y$10$KdMG4xC0Ht78.If4gx1rKe/h9g9MYmEORChDi/mopqLX2vqpieWn.', '2022-03-16 22:19:30', '2022-03-16 22:19:30'),
(16, '窪駿', '窪駿', '関西', NULL, '$2y$10$KSBjNKNOjJ5kh7tYMqLNqeVv9v/DKWPGtqkSQvgzmBUU.9pc3DLpq', '2022-03-16 22:19:52', '2022-03-16 22:19:52'),
(17, '大下博之', '大下博之', '関西', NULL, '$2y$10$lkJe/ljbdYCawPuXsfSIoOttc/PuVmcPLEHTxTJ7910Cde6YfIY8G', '2022-03-16 22:20:21', '2022-03-16 22:20:21'),
(18, '齊藤せな', '齊藤せな', '関西', NULL, '$2y$10$feSnND5J.aGKL6WNq1uC6eTp//oTEtpwCi3SPWj7wnwJSEKKFNbTq', '2022-03-16 22:20:51', '2022-03-16 22:20:51'),
(21, '髙山拓生', '髙山拓生', '関西', NULL, '$2y$10$1ROPox3xE1lcEbAYyxKBou5AVJvo8kc7GBK20Bctl6X108IFDKi/C', '2022-03-28 07:20:34', '2022-03-28 07:20:34'),
(22, 'テスト', 'テスト', '関西', NULL, '$2y$10$HnBAhEiY7tGO3GuHfckTt.HpzXnWpmARVnrcW6n0d/ZwejKuwQHEi', '2022-03-29 02:33:52', '2022-03-29 02:33:52');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `diary`
--
ALTER TABLE `diary`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `diary`
--
ALTER TABLE `diary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

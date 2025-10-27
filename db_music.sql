-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2025 at 12:35 AM
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
-- Database: `db_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `featured_image`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'BTS IS THE BEST ARTIST ALL THE TIME', 'bts-is-the-best-artist-all-the-time', '<p>BTS SANGATA KERENRNAFKAFAFJASJF</p>\r\n<p>FAKSDFJASKFAJSF</p>\r\n<p>FNASFNASNFASFK<img src=\"https://assets.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p3/278/2025/10/02/BTS-1176931248.jpg\" alt=\"\" width=\"1500\" height=\"1000\"></p>', 'uploads/img_68ffcf7f6349b.png', 3, '2025-10-28 03:00:24', '2025-10-28 03:01:03'),
(3, 'NANANAN', 'nananan', '<p>HAY GENK</p>', 'uploads/img_68ffd3120c2b8.jpg', 3, '2025-10-28 03:16:18', '2025-10-28 03:16:18'),
(4, 'yuyuayfu', 'yuyuayfu', '<p>alaflafla</p>\r\n<p>fakdfalfk</p>\r\n<p><img src=\"https://people.com/thmb/TlNhUj4fJ8pnJNpEvUN-015Jcac=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():focal(979x595:981x597):format(webp)/bts-members-1-03a9c478f1794c448bcb5f74bf94812c.jpg\" alt=\"\" width=\"750\" height=\"533\"></p>', 'uploads/img_68ffd34146f5e.jpg', 3, '2025-10-28 03:17:05', '2025-10-28 03:17:05'),
(5, 'LO SIAPAA', 'lo-siapaa', '<p>GUE</p>', 'uploads/img_68ffd3533742b.jpg', 3, '2025-10-28 03:17:23', '2025-10-28 03:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `body`, `created_at`, `is_approved`) VALUES
(2, 5, 4, 'keren bgt', '2025-10-28 05:03:01', 1),
(3, 5, 4, 'pengen ikutt', '2025-10-28 05:03:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `article_id`, `user_id`, `created_at`) VALUES
(2, 1, 4, '2025-10-28 05:29:43'),
(3, 5, 4, '2025-10-28 05:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_changes`
--

CREATE TABLE `role_changes` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `old_role` varchar(50) NOT NULL,
  `new_role` varchar(50) NOT NULL,
  `changed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_changes`
--

INSERT INTO `role_changes` (`id`, `admin_id`, `user_id`, `old_role`, `new_role`, `changed_at`) VALUES
(2, 3, 2, '', 'user', '2025-10-28 06:16:06'),
(3, 3, 4, 'user', 'user', '2025-10-28 06:16:51'),
(4, 3, 1, '', 'editor', '2025-10-28 06:16:58'),
(5, 3, 1, '', 'admin', '2025-10-28 06:16:59'),
(6, 3, 1, 'admin', 'editor', '2025-10-28 06:17:01'),
(7, 3, 5, '', 'user', '2025-10-28 06:17:05'),
(8, 3, 1, '', 'admin', '2025-10-28 06:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Apa ya wak', 'apenih@gmail.com', '$2y$10$xT06dVdP85QEo5lYPWJQE.Vg4vtWwZoMZzcKgU0n3E8h4bH657lvW', 'admin', '2025-10-28 01:22:28'),
(2, 'yu', 'yuk@gmail.com', '$2y$10$xBWVKcXS6iMiWieUjkFHMuB47cbV0.EEx6knlQwOvOG4EGGDjhRtq', 'user', '2025-10-28 01:27:14'),
(3, 'Naylan Admin', 'naylanadmin@gmail.com', '$2y$10$WcXTW96D4U9igNCXmpAEVODEet20yhEI20qNVsLNlsCK1HfjhBB1K', 'admin', '2025-10-28 01:30:22'),
(4, 'sakit', 'sakitkepala@gmail.com', '$2y$10$5jbR3yM.Ps873BNg1JWxx.TAVtpc09qyu4k5dngZqskOzVEUJgtf.', 'user', '2025-10-28 05:02:34'),
(5, 'NAYLAN SITI NABILA', 'desainer123@gmail.com', '$2y$10$72YSqlkHRWG1CAA.LskybO1HOwE63N98T9hTKA2qY0KXP2FyPTafy', 'user', '2025-10-28 06:05:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_article` (`article_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_article_user` (`article_id`,`user_id`),
  ADD KEY `idx_article` (`article_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `role_changes`
--
ALTER TABLE `role_changes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rolechanges_admin` (`admin_id`),
  ADD KEY `fk_rolechanges_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_changes`
--
ALTER TABLE `role_changes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_changes`
--
ALTER TABLE `role_changes`
  ADD CONSTRAINT `fk_rolechanges_admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rolechanges_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

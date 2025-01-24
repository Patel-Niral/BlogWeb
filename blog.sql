-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 10:21 AM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(1, 'food', 'this is description'),
(2, 'Travel', 'about travel details'),
(12, 'Art', 'creativity'),
(13, 'CSE', 'computer related'),
(14, 'Technology', 'The Technology category explores the latest advancements, trends, and innovations shaping the modern world. From artificial intelligence and machine learning to blockchain, cybersecurity, and emerging gadgets, this category delves into the tools and systems driving progress across industries.');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `featured`) VALUES
(4, 'Default user', 'not admin', '1737375984aot.jpg', '2025-01-20 12:26:24', 2, 4, 0),
(9, 'default', 'default', '1737377487aotprofile02.jpg', '2025-01-20 12:51:27', 1, 4, 0),
(10, 'kk', 'jkjkj', '1737377529aotprofile02.jpg', '2025-01-20 12:52:09', 1, 4, 0),
(13, 'The Rise of AI: Transforming Industries and Everyday Life', 'Artificial Intelligence (AI) is no longer a futuristic concept&mdash;it is a reality shaping industries and redefining how we live. From healthcare to transportation, AI-powered solutions are driving innovation and improving efficiency. In healthcare, AI assists in diagnosing diseases with remarkable accuracy, while in transportation, self-driving vehicles are becoming increasingly common.\r\n\r\nAI also enhances our daily lives through virtual assistants, personalized recommendations, and smart home devices. However, its rapid growth raises ethical concerns, such as data privacy and job displacement, which require careful consideration.\r\n\r\nAs AI continues to evolve, its potential seems limitless. It is crucial for governments, organizations, and individuals to adapt to this transformation, ensuring that AI benefits society as a whole.', '173747029512149.jpg', '2025-01-21 14:38:15', 14, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES
(1, 'Edit2', 'p', 'demo1', 'demo1@gmail.com', '$2y$10$CHU1qmOJrx5D3pq2.WbD5eOceqjcqH7kUAKFx.FXN/CRJu7yuJiYi', '1737194930Snap (2).png', 0),
(2, 'demo2', 'p', 'demo2', 'demo2@gmail.com', '$2y$10$3cfyzOKbd9z80h32TV6MYebeKiQJc68iNv7j4KBG2il1DIr2qhaky', '1737195162Snap (2).png', 0),
(3, 'demo', 'p', 'demo', 'demo@gmail.com', '$2y$10$/FQKVXntMn87DAWS2Bxl/OGec6nif47yCtHmrZ9i8KkkPiL9w7Idy', '1737206482Snap (2).png', 0),
(4, 'demo3', 'demo3', 'demo3', 'dem03@gmail.com', '$2y$10$LZkiF4iv8q7qC3OSwTn99O6C7WBGXx6AYYtBCFk9e0YmQyWEY9PfO', '1737208174Snap (2).png', 0),
(5, 'asd', 'asd', 'asd', 'asd@gmail.com', '$2y$10$Jkmr/35AqvO8O8IMwEp9QuGi5ya11UToiOPPPPVyoPyRj2SHMO2ZW', '1737209562Snap (1).png', 1),
(6, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$uvXdEOJnJ8YcxiAcyWAixu6W4gtFJiBZcon2EWpC3IjqTR/uUn6P.', '1737215915Snap.png', 1),
(13, 'admin2', 'admin2', 'admin2', 'admin2@gmail.com', '$2y$10$Z.xQWfqEJDc77Yui6BcYfuDCtMie88/t9SIsKRvXAby4h4vV3mpEi', '1737390180Snap (2).png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_category` (`category_id`),
  ADD KEY `FK_blog_author` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

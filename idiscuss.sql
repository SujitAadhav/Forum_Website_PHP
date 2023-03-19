-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 10:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idiscuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `dt`) VALUES
(1, 'JavaScript', 'JavaScript (JS) is a lightweJavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2022, 98% of websites use JavaScript on the client side for webpage behavior, often incorporating third-party libraries.ight, interpreted, or just-in-time compiled programming language with first-class functions. While it is most well-known as the scripting language for Web pages, many non-browser environments also use it, such as Node.js, Apach', '2023-03-16 11:36:25'),
(2, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically typed and garbage-collected. It supports multiple programming paradigms, includi', '2023-03-16 11:47:04'),
(3, 'Django', 'Django is a free and open-source, Python-based web framework that follows the model–template–views architectural pattern. It is maintained by the Django Software Foundation, an independent organization established in the US as a 501 non-profit.', '2023-03-16 11:49:35'),
(4, 'C Programming', 'C is a general-purpose computer programming language. It was created in the 1970s by Dennis Ritchie, and remains very widely used and influential. By design, C\'s features cleanly reflect the capabilities of the targeted CPUs.', '2023-03-16 11:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(1, 'This is my first comment', 1, 1, '2023-03-17 12:33:04'),
(2, 'This is my second comment', 1, 2, '2023-03-17 12:43:16'),
(3, 'Hello how are you', 1, 3, '2023-03-19 11:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(11) NOT NULL,
  `thread_user_id` int(11) NOT NULL,
  `thread_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `thread_dt`) VALUES
(1, 'Unable to install pyaudio', 'Unable to install pyaudio on windows machine.', 1, 1, '2023-03-16 14:26:04'),
(2, 'installation problem', 'I have also same problem ', 1, 2, '2023-03-16 17:11:37'),
(3, 'Node js', 'can anyone help me about node js ', 1, 3, '2023-03-16 17:21:52'),
(4, 'Study Material', 'I want study material of face recognition system in python', 2, 4, '2023-03-16 17:24:25'),
(5, 'ES6 VS JavaScript', 'What is the difference between ES6 and JavaScript', 1, 5, '2023-03-17 19:49:32'),
(6, 'Hey', 'I am enjoying this forum', 1, 5, '2023-03-19 11:48:14'),
(7, 'This is a problem', 'and this is an answer\r\n', 1, 5, '2023-03-19 11:48:47'),
(8, 'ham hai khataro', 'ke khiladi', 1, 3, '2023-03-19 12:07:28'),
(9, 'he', 'hey', 1, 3, '2023-03-19 12:07:42'),
(10, 'he', 'hey', 1, 3, '2023-03-19 12:17:30'),
(11, '&lt;script&gt; alert(\"hello\") &lt;/script&gt;', '&gt;script&gt; alert(\"hello\") &gt;/script&gt;', 1, 3, '2023-03-19 12:17:58'),
(12, '&lt;script&gt; alert(\"hello\") &lt;/script&gt;', '&lt;script&gt; alert(\"hello\") &lt;/script&gt;', 1, 3, '2023-03-19 12:19:18'),
(13, '&lt;script&gt; alert(\"hello\") &lt;/script&gt;', '&lt;script&gt; alert(\"hello\") &lt;/script&gt;', 1, 3, '2023-03-19 12:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `dt`) VALUES
(1, 'sujitadhav', '1', '2023-03-18 09:12:43'),
(2, 'rahuladhav', '1', '2023-03-18 09:34:49'),
(3, 'rahuladhav1', '$2y$10$rub1gLMFcgFKNQIjmMdLpuVCGMhoQkIXxH6ASkQVwBR3wU01rm7Qy', '2023-03-18 09:45:28'),
(4, 'rahuladhav2', '$2y$10$/Xrph9mUVLZpdYSiz9doZeccT2VDQ.ur5bZt0TDDfa7nDLZpHy0HC', '2023-03-18 09:47:45'),
(5, 'rahuladhav3', '$2y$10$9mLRyvvyA2HV8x5LcNruH./Lg8Qagxsgs6TUQZi2lqHLOtL5ZqfMK', '2023-03-18 09:50:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);
ALTER TABLE `categories` ADD FULLTEXT KEY `category_name` (`category_name`,`category_description`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);
ALTER TABLE `comments` ADD FULLTEXT KEY `comment_content` (`comment_content`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

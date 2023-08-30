-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 03:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(55, 'Web Development'),
(56, 'Mobile App Development'),
(57, 'Data Science and Machine Learning'),
(58, 'Algorithms and Data Structures'),
(59, 'Software Engineering'),
(60, 'DevOps'),
(61, 'Game Development'),
(62, 'Cybersecurity'),
(63, 'Internet of Things');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(36, 95, 'user', 'user@gmail.com', 'Wow great post , (We Will aprove this comment from the admin account)', 'approved', '2023-07-23'),
(37, 91, 'mohammedh', 'mohammed19@gmail.com', 'wow keep the good work , (We will aprove this too :) )', 'approved', '2023-07-23'),
(38, 94, 'mohammedh', 'mohammed19@gmail.com', 'Very Nice !', 'approved', '2023-07-23'),
(39, 97, 'aymanismail', 'aymanxbassam@gmail.com', 'Welcome to the Website :)', 'approved', '2023-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(187, 32, 91),
(188, 32, 94),
(189, 2, 88),
(190, 2, 97);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_likes` int(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'posted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_likes`, `post_comment_count`, `post_status`) VALUES
(87, 55, 'Introduction to HTML and CSS', '21', '2023-07-22', 'IMG-64bb18930d02d5.75481531.png', 'In this post, we\'ll explore the fundamentals of HTML and CSS and how they work together to build beautiful web pages.', 'webdevelopment, html, css, webdesign', 0, 0, 'published'),
(88, 56, 'Building Your First Android App', '22', '2023-07-22', 'IMG-64bb1a46d677b5.31868800.png', 'Follow this step-by-step guide to create your first Android app from scratch using Android Studio and Java.', 'mobileappdevelopment, android ,appdevelopment ,androidstudio', 1, 0, 'published'),
(89, 57, 'Exploring Data with Pandas', '23', '2023-07-22', 'IMG-64bb1c06f3cee1.72390739.png', 'Learn how to use Pandas, a powerful Python library, to manipulate and analyze data for your machine learning projects.', 'datascience, machinelearning, pandas, python', 0, 0, 'published'),
(90, 58, 'Mastering Sorting Algorithms', '24', '2023-07-22', 'IMG-64bb1ee94e3918.46842895.jpg', 'Dive into various sorting algorithms like Bubble Sort, Merge Sort, and Quick Sort, and understand their time complexities and applications.', 'algorithms, datastructures, sorting, computerscience', 0, 0, 'published'),
(91, 59, 'Best Practices for Code Documentation', '25', '2023-07-22', 'IMG-64bb1fa6c4c414.77291780.png', 'Proper code documentation is crucial for maintaining large-scale projects. Learn the best practices to make your code more readable and maintainable.', 'softwareengineering, documentation, programming, bestpractices', 1, 1, 'published'),
(92, 60, 'Continuous Integration with Jenkins', '26', '2023-07-22', 'IMG-64bb217d5b71b7.66048175.png', 'Discover how Jenkins can automate your software development processes and enable continuous integration and continuous delivery (CI/CD).', 'devops, jenkins, continuousintegration, cicd', 0, 0, 'published'),
(93, 61, 'Introduction to Unity Game Engine', '27', '2023-07-22', 'IMG-64bb259455e2e5.95532597.png', 'Learn the basics of Unity and start creating your own 2D and 3D games with this powerful game development engine.', 'gamedevelopment, unity, gameengine, gamedev', 0, 0, 'published'),
(94, 62, 'Common Cybersecurity Threats and How to Defend Against Them', '28', '2023-07-22', 'IMG-64bb2d09bf0d57.72667847.jpg', 'Stay one step ahead of cybercriminals by understanding common threats and implementing effective cybersecurity measures.', 'cybersecurity, cyberthreats, infosec, networksecurity', 1, 1, 'published'),
(95, 63, 'Getting Started with IoT Development using Raspberry Pi', '29', '2023-07-22', 'IMG-64bb2eb9e04c76.89504874.png', 'Learn how to build your own Internet of Things projects using a Raspberry Pi and connect physical devices to the digital world.', 'iot, internetofthings, raspberrypi, embedded', 0, 3, 'published'),
(97, 56, 'Building Cross-Platform Mobile Apps with React Native', '32', '2023-07-23', 'IMG-64bc6e0240b700.63388646.png', 'In this post, we explore the power of React Native for building cross-platform mobile applications. React Native allows developers to use a single codebase to create apps that work seamlessly on both iOS and Android devices. We&#039;ll delve into the core concepts of React Native, discuss its benefits, and provide a step-by-step guide on setting up your development environment. From there, we&#039;ll create a simple mobile app, showcasing the ease and efficiency of building user interfaces with React Native components. Whether you&#039;re a seasoned developer or just getting started, React Native is a game-changer for mobile app development!', 'mobileappdevelopment, reactnative, crossplatform, iOS, Android, mobiledevelopment', 1, 1, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_CreateDate` date NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_CreateDate`, `token`) VALUES
(2, 'aymanismail', '$2y$10$j6BdOg510USex1b3ZFQoNecFtP65yrM511GGm0/yAUc3ZVPG6xICq', 'Ayman', 'Bassam', 'aymanxbassam@gmail.com', 'IMG-64b0838893d4f5.36068300.jpg', 'admin', '2023-07-09', ''),
(21, 'janedoe', '$2y$10$zOVB1lRRaS6y0KsZ84nmIOAG4Lol.39Gs12jiMo/KS/OpAhA2j8b.', 'Jane', 'Doe', 'janedoe@gmail.com', 'IMG-64bb17dccfd4b6.51181052.jpg', 'user', '2023-07-22', ''),
(22, 'johnsmith', '$2y$10$eWHF/bJFlP8RUIhtuXWn1uOI5uQcLPAUssWn9nBirm/ztggjslJlS', 'John', 'Smith', 'johnsmith@gmail.com', 'IMG-64bb19de783013.87530151.jpg', 'user', '2023-07-22', ''),
(23, 'emilyjohnson', '$2y$10$y21HCMkYTwXpVpEJi10wru3.vjqKNz89MLLX7dooMIw6nt5okPR/.', 'Emily', 'Johnson', 'emilyjohnson@gmail.com', 'IMG-64bb1b4aa41d21.24891555.jpg', 'user', '2023-07-22', ''),
(24, 'michaellee', '$2y$10$Xjyl7xqCjZkxIq/Wf/h9peC6jOYF/Ge18viBoIrYWw2ADBGGPUn4i', 'Michael', 'Lee', 'michaellee@gmail.com', 'IMG-64bb1daf576955.97462561.jpg', 'user', '2023-07-22', ''),
(25, 'alexturner', '$2y$10$Itietyn4AWnDQHuzQnfRBuxnuiAnr4JSIz37ZHlbULwf87q1Hxh1e', 'Alex', 'Turner', 'alexturner@gmail.com', 'IMG-64bb1f61374468.36002956.jpg', 'user', '2023-07-22', ''),
(26, 'samanthawhite', '$2y$10$Psm5rN3q3.LrGO2vs9uacuo4YTlV21/FqBGrJIfjGFrf3cSvvzVDu', 'Samantha', 'White', 'samanthawhite@gmail.com', 'IMG-64bb205a4289a7.92911759.jpg', 'user', '2023-07-22', ''),
(27, 'chrisroberts', '$2y$10$i07mm/RjgqAi3uhZWGmX8eulMtf/IDy7R2elmRIisRPMQ4ts./MF6', 'Chris', 'Roberts', 'chrisroberts@gmail.com', 'IMG-64bb25370dede3.59835739.jpg', 'user', '2023-07-22', ''),
(28, 'sarahadams', '$2y$10$NKekZ04o8kwvVJtIiJ68bO/iFQhNqQFtE0c6y.i0AnLDz336kdXie', 'Sarah', 'Adams', 'sarahadams@gmail.com', 'IMG-64bb25f9b33354.10292756.jpg', 'user', '2023-07-22', ''),
(29, 'kevinbrown', '$2y$10$SFwborihfIRl58cVLrNx4.yt0ej5xK7vUJkCIqhbWdeqUdLwRG2HK', 'Kevin', 'Brown', 'kevinbrown@gmail.com', 'IMG-64bb2e68a8c2f7.95736310.jpg', 'user', '2023-07-22', ''),
(32, 'mohammedh', '$2y$10$tZ/pjjjFI9txVuOzpGMiHeoJJWuQ.j89xpbDFNosnHbXgtkz.K/l6', 'Mohammed', 'hassan', 'mohammed19@gmail.com', 'IMG-64bc6ddfdc5e04.42757757.jpg', 'user', '2023-07-23', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

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
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

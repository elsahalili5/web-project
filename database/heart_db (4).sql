-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2026 at 11:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`) VALUES
(1, 'Medical', 'fa-heart-pulse'),
(2, 'Emergency', 'fa-kit-medical'),
(3, 'Charity', 'fa-ribbon'),
(4, 'Education', 'fa-graduation-cap'),
(5, 'Animal', 'fa-dog'),
(6, 'Environment', 'fa-tree'),
(7, 'Arts', 'fa-paint-brush'),
(8, 'Sports', 'fa-futbol'),
(9, 'Technology', 'fa-laptop-code'),
(10, 'Community', 'fa-people-group'),
(11, 'Family', 'fa-users'),
(12, 'Research', 'fa-microscope'),
(13, 'Travel', 'fa-plane-departure'),
(14, 'Food', 'fa-utensils'),
(15, 'Community', 'fa-people-group'),
(16, 'Family', 'fa-users');

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE `causes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `goal_amount` decimal(10,2) DEFAULT NULL,
  `raised_amount` decimal(10,2) DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `user_id`, `category_id`, `title`, `description`, `goal_amount`, `raised_amount`, `image`, `status`, `created_at`) VALUES
(9, 30, 1, 'Support Sienna’s Brain Recovery', 'Hello, we\'re Gary and Angelina, and we have two beautiful daughters: Adriana, 7, and our youngest, Sienna, 4. On 19th November, Sienna suddenly became unresponsive and was rushed to Kettering A&E. After scans, she was placed into an induced coma and transferred to Queens Medical Centre in Nottingham, where she has remained in ICU ever since.', 50000.00, 0.00, 'https://images.gofundme.com/nLnMdFjvwlR0jNeqxabZCmmIRmg=/720x405/https://d2g8igdw686xgo.cloudfront.net/97509371_1765262773517765_r.jpg', 'approved', '2026-01-30 19:41:59'),
(10, 25, 1, 'Help children fight cancer', 'Make a difference in the lives of children battling cancer by supporting charitable initiatives...Make a difference in the lives of children fighting cancer by supporting initiatives that provide medical care, emotional support, and small moments of joy during their treatment.\n', 90000.00, 0.00, 'https://i.pinimg.com/1200x/23/90/83/239083288b913d29c5d68224865a16db.jpg', 'approved', '2026-01-30 19:41:59'),
(11, 27, 1, 'Help John fight chronic illness', 'John is battling a long-term illness and needs financial and emotional support to access necessary treatments, medications, and daily care. Your contribution can help improve his quality of life and provide hope during this difficult time.\n', 20000.00, 0.00, 'https://i.pinimg.com/1200x/37/ac/7e/37ac7efdfef8f4d8aff459783d49bf8a.jpg', 'approved', '2026-01-30 19:41:59'),
(12, 29, 1, 'Hope for My 26-Year-Old Sister', 'My sister Beatriz is 26, and I’m sharing her story because she’s too exhausted to fight alone. Your support can help cover treatments, therapy, and essential care she desperately needs.', 10000.00, 0.00, 'https://i.pinimg.com/736x/7a/e3/69/7ae3694ca7fa17245862448520ad9d49.jpg', 'approved', '2026-01-30 19:41:59'),
(13, 30, 10, 'Empower the Kids of Ghana', 'Far far away, behind the word mountains, far from the countries there are kids who need your support to get education and a better future.', 50000.00, 0.00, './images/ghanakids.jpg', 'approved', '2026-01-30 22:34:07'),
(14, 25, 6, 'Help for pure water', 'Away, behind the word mountains, far from the countries there are kids who need clean and safe drinking water to survive and grow healthy.', 100000.00, 0.00, 'https://i.pinimg.com/1200x/36/e2/3a/36e23a5c628d1aba81c01662aa71925c.jpg', 'approved', '2026-01-30 22:34:07'),
(15, 29, 2, 'Help children fight cancer', 'Make a difference in the lives of children battling cancer by supporting charitable initiatives, treatments, and medical care for them.', 90000.00, 3242.00, 'https://i.pinimg.com/1200x/54/cb/8f/54cb8f0760ab8a8e210ee5f528f7f90c.jpg', 'approved', '2026-01-30 22:34:07'),
(16, 30, 4, 'Help for children education', 'Empower children through charity by providing them with books, school supplies, and protective support to improve their education and future.', 50000.00, 0.00, 'https://i.pinimg.com/1200x/0b/52/7c/0b527cae2b0718c7c38f477a0ca99cf8.jpg', 'approved', '2026-01-30 22:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `user_id`, `name`, `email`, `subject`, `message`, `reply`, `created_at`) VALUES
(2, 29, 'Gentrit Halili', 'gentrit@gmail.com', 'Issue with login', 'I tried logging in multiple times today, but I keep getting an error saying my password is incorrect. I have tried resetting it, but the link seems expired. Can you help me regain access?', 'Hi Gentrit, thank you for letting us know. Please try resetting your password again using the \"Forgot Password\" link. Make sure to use the most recent link sent to your email. If the problem persists, we can manually reset it for you.', '2026-02-01 09:20:00'),
(3, 27, 'Genita Halilii', 'genita@gmail.com', 'Feedback on website', 'I just wanted to say that your website is very intuitive and easy to navigate. I especially liked the new donation tracker feature, it helps me follow my contributions easily.', 'Thank you Genita! We are glad to hear that the new donation tracker feature is useful. We always aim to improve the user experience and your feedback really helps.', '2026-02-01 10:05:00'),
(4, 25, 'Elsa Halili', 'elsa@gmail.com', 'Bug report', 'While making a donation, I noticed that the confirmation page sometimes freezes and I have to refresh the page. This has happened twice today. Could you check if there is a bug?', 'Thanks Elsa, our technical team is aware of this issue and is working on a fix. In the meantime, please try clearing your browser cache or using a different browser.', '2026-02-01 11:30:00'),
(5, 30, 'Eriona Bunjaku', 'eriona@gmail.com', 'Feature suggestion', 'I think it would be really helpful to have a search function for causes. Sometimes I spend a long time scrolling to find a specific cause I want to donate to. Could this be added?', 'Thanks for your suggestion, Gentrit! We are planning to add a search feature soon to improve navigation. Your input is very valuable for our roadmap.', '2026-02-01 12:45:00'),
(6, 27, 'Genita Halilii', 'genita@gmail.com', 'Subscription question', 'I want to receive updates whenever there are new causes or events. How can I subscribe to notifications? I did not see a clear option on the website.', 'Hello Genita, you can subscribe to updates at the bottom of the homepage by entering your email in the \"Subscribe\" box. Once subscribed, you will receive email notifications for new causes and events.', '2026-02-01 13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `cause_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Card',
  `payment_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `donated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `cause_id`, `user_email`, `first_name`, `last_name`, `amount`, `payment_method`, `payment_status`, `anonymous`, `donated_at`) VALUES
(17, 15, 'elsa@gmail.com', 'Elsa', 'Halili', 3242.00, 'Card', 'successful', 1, '2026-02-01 17:31:05'),
(18, 9, 'elsa@gmail.com', 'Elsa', 'Halili', 150.00, 'Card', 'successful', 0, '2026-02-01 18:10:22'),
(19, 10, 'elsa@gmail.com', 'Elsa', 'Halili', 75.50, 'Card', 'successful', 1, '2026-02-02 09:45:10'),
(20, 11, 'eriona@gmail.com', 'Eriona', 'Bunjaku', 500.00, 'Card ', 'successful', 0, '2026-02-02 12:30:00'),
(21, 12, 'genita@gmail.com', 'Genita', 'Halili', 60.00, 'Card', 'successful', 1, '2026-02-02 16:05:44'),
(22, 13, 'elsa@gmail.com', 'Elsa', 'Halili', 200.00, 'Card', 'successful', 0, '2026-02-03 11:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'Admin', 'heart@gmail.com', '$2y$10$hNuJLDOPeMQwhF7TE8Ry2uD1mcSLGlhlpV1XYwVAEv2Cgddaj8DxG', 'admin', '2026-01-30 17:32:06'),
(25, 'Elsa', 'Halili', 'elsa@gmail.com', '$2y$10$z5nhxWCjnF2VkE1caacfgOmpE1CA2IzQbP06265tfRNk73AcgQ1eu', 'user', '2026-01-31 16:33:37'),
(27, 'Genita', 'Halili', 'genita@gmail.com', '$2y$10$Hok4KZMN6BkgA.0w0jo/2e84HLTPmsqM7yTzEbQyjvqQzwPBq4Ag2', 'user', '2026-01-31 22:16:42'),
(29, 'Gentrit', 'Halili', 'gentrit@gmail.com', '$2y$10$gcYbuAOOWlVOCu/dSJaai.mK3DPOodO.thoNsk.7qRM9mj/gjtIey', 'user', '2026-02-01 03:24:09'),
(30, 'Eriona', 'Bunjaku', 'eriona@gmail.com', '$2y$10$Qcd1hQvgvrkPdwA4uWQJjO4yvGmPfBtLnWoyssQmGoT.8ypNtnQey', 'user', '2026-02-01 18:41:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cause_id` (`cause_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `causes`
--
ALTER TABLE `causes`
  ADD CONSTRAINT `causes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `causes_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `fk_donations_cause` FOREIGN KEY (`cause_id`) REFERENCES `causes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

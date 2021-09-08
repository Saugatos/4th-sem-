-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 04:32 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notifications_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_data` text NOT NULL,
  `quantity_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notifications_id`, `user_id`, `status`, `datetime`, `product_data`, `quantity_data`) VALUES
(9, 2, 'Pending', '2021-07-16 02:12:51', '29-30-', '2-1-');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MRP` float NOT NULL,
  `Price` float NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `Available` int(11) NOT NULL,
  `Category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `Title`, `Author`, `MRP`, `Price`, `Discount`, `Available`, `Category`, `Description`, `Language`, `image`) VALUES
(22, 'Love . . . Not for Sale!', 'Anurag Garg', 175, 123, 30, 27, 'Literature and Fiction', 'Love can happen anywhere, with anyone. Kabir Thapar is the spoilt son of a rich capitalist in Mumbai. His mothers sudden death scars him for life, leaving him at loggerheads with his father who finds himself a new wife in no time. As Kabir embarks on a downward spiral of alcohol and drugs, he, on one ill-fated day, finds himself embroiled in a hit-andrun case. Making a quick escape, Kabir ends up in a red-light area, where he meets Sehar, a sex worker. As he falls head over heels for her, he must own up to the one emotion he has been running away from all his life love. From the bestselling author of A Half-baked Story comes a story that perfectly weaves together the explosive passion between Kabir and Sehar, the contradictions of modern India and the inevitable tragedy that befalls its lovers.', 'English', 'img/books/eb02c97ef8af22133889e65858d97b75.jpg'),
(23, 'You are Trending In My Dreams', 'Sudeep Nagarkar', 175, 123, 30, 15, 'Literature and Fiction', 'Four friends . . . four lives . . . ', 'English', 'img/books/12855e76021bf3dc068f9fa85e8f449c.jpg'),
(28, 'I Am Malala : The Girl Who Stood Up For Education And Was Shot By The Taliban', 'Malala Yousafzai, Christina Lamb', 399, 200, 50, 12, 'Biographies and Auto Biographies', 'Winner of the 2014 Nobel Peace Prize. In 2009 Malala Yousafzai began writing a blog on BBC Urdu about life in the Swat Valley as the Taliban gained control, at times banning girls from attending school.', 'English', 'img/books/f2c852cb5a375f08ce67727d99e84b85.jpg'),
(29, 'M.K. Gandhi An Autobiography', 'M K Gandhi', 140, 98, 30, 13, 'Biographies and Auto Biographies', 'The Story of My Experiments with Truth is the Autobiography of Mohandas Karamchand Gandhi, covering his life from early childhood through to 1920. ', 'English', 'img/books/59f5fc69cdce8a87c349cac7686810b1.jpg'),
(27, 'Cracking The Code : My Journey To Bollywood', 'Ayushmann Khurrana, Tahira Kashyap', 195, 137, 30, 15, 'Biographies and Auto Biographies', 'This journey is a wholesome and insightful account of the trials and tribulations involved in trying to get a break in entertainment industry of Mumbai. The account of the dreaded yet inevitable pre-stardom struggle is as real and insightful as it gets! His experiences will make you cry and make you laugh.', 'English', 'img/books/5c01446c625eaef65e4184b3dd1aaf2e.jpg'),
(32, 'Get a Grip on Grammar', 'Scholastic Experts', 250, 188, 25, 2, 'Academic and Professional', 'Here s a book which, through different kinds of exercises, will help students get a surer grip on the English language.', 'English', 'img/books/751d9435ec3153d51cf21a0215e50999.jpg'),
(30, 'The Adventures Of Stoob : A Difficult Stage', 'Rupa Books', 195, 144, 26, 4, 'Children and Teens', 'Stoob is headed for an amazing global stardom incident but sinister forces lurk as always between him and ultimate glory. Stoob is in class six and his days of childhood are over.', 'English', 'img/books/6bb0b023021c21bd0a695f5a6426b3b4.jpg'),
(31, 'What Next? A Complete Course & Career Guide', 'Times Group Experts', 149, 118, 24, 3, 'Academic and Professional', 'Everybody looks forward to enjoying college life after passing school. However, selecting the right career option is one of the most difficult decisions for a student.', 'English', 'img/books/d6a002ce0e5c77073adf487477f9205f.jpg'),
(26, 'Getting A Coding Job For Dummies', 'Nikhil Abraham', 299, 289, 3, 5, 'Academic and Professional', 'Nikhil Abraham helped millions of people prepare for the coding job market in his past role at Codecademy. That site set 25 million users on the road to gaining the skills to taking part in the explosion of coding jobs. ', 'English', 'img/books/1dbba4e30b607e5fc47d33c8868edc19.jpg'),
(21, 'Code Red', 'Shantanu Dhar', 195, 135, 31, 25, 'Literature and Fiction', 'Code Red is a complex horrorcum- psychological thriller that takes place across the UK, the US and the rainforest. A truly international thriller, it takes the reader on a dizzying ride across a story that is multilayered and asks several thought-provoking questions.  About Shantanu Dhar  Shantanu Dhar earned a Bachelor s in English Literature from the University of Pune, Nashik, and a post-graduate degree in Human Resource Development from Pittsburgh State University, Kansas, US. Currently employed with a major Inconglomerate, he writes regularly for business magazines on human behaviour at the workplace. He has been deeply inspired by Greek tragedies and Gothic novels in his fiction writing. Shantanu lives in Greater Noida with his wife and two children.', 'English', 'img/books/1e6ae4ada992769567b71815f124fac5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `UserName`, `Password`, `phone`, `email`, `usertype`) VALUES
(1, 'Bookstore Admin', 'admin', 'admin', '', 'bookstoreadmin@gmail.com', 'admin'),
(2, 'Ram Prasad', 'ram', 'password', '9800000000', 'ram@gmail.com', 'normal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notifications_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notifications_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2020 at 01:22 PM
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
-- Database: `lib_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `l_activity_logs`
--

CREATE TABLE `l_activity_logs` (
  `id` int(11) NOT NULL,
  `activity` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_activity_logs`
--

INSERT INTO `l_activity_logs` (`id`, `activity`, `user_id`, `date_created`) VALUES
(1, 'Updated Staff [Syntax] by [Syntax]', 3, '2020-09-17 12:22:24'),
(2, 'Created New Book [Qwerty] By [Syntax]', 3, '2020-09-17 12:28:00'),
(3, 'Created New Student [kwanza.mwisho]', 3, '2020-09-17 12:32:29'),
(4, 'Deleted Student [1343567658]', 3, '2020-09-17 12:34:30'),
(5, 'User [Syntax] Changed Password', 3, '2020-09-17 14:41:36'),
(6, 'User [Syntax] Changed Password', 3, '2020-09-17 14:59:49'),
(7, 'User [Syntax] Changed Password', 3, '2020-09-17 15:01:40'),
(8, 'Returned Book [] Borrowed by [First.LAst] -> [Syntax]', 3, '2020-09-17 15:37:00'),
(9, 'Created New Book [Times magazine] By [Syntax]', 3, '2020-09-17 15:55:16'),
(10, 'Created New User [ken@gmail.com] by [AsapKenn]', 3, '2020-09-18 10:45:02'),
(11, 'Created New User [zack@gmail.com] by [admin]', 1, '2020-09-18 11:58:00'),
(12, 'Returned Book [fdsgfdg] Borrowed by [First.LAst] -> [Syntax]', 1, '2020-09-18 11:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `l_books`
--

CREATE TABLE `l_books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `isbn` varchar(100) DEFAULT NULL,
  `books` int(11) NOT NULL DEFAULT 0,
  `publisher_name` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_books`
--

INSERT INTO `l_books` (`id`, `title`, `author`, `isbn`, `books`, `publisher_name`, `category`, `status`, `added_by`, `added_date`) VALUES
(1, 'Book 2', 'ggdgdfg', '147852369', 8, 'something', '2', '1', '3', '2020-09-17 13:37:01'),
(2, 'fdsgfdg', 'ggdgdfg', 'gfdgdf', 8, 'ggdfgdf', '3', '1', '1', '2020-09-18 09:58:51'),
(3, 'fdsgfdg', 'ggdgdfg', 'gfdgdf', 8, 'ggdfgdf', '4', '1', '1', '2020-09-11 07:06:20'),
(4, 'Calculus IV', 'this author', '14546451521', 7, 'publisher name', '2', '1', '3', '2020-09-15 14:44:44'),
(5, 'Painting', 'ggdgdfg', '789456123', 7, 'ggdfgdf', '2', '1', '3', '2020-09-15 14:45:37'),
(7, 'Book 1', 'ggdgdfg', '1456238', 7, 'Punlidhsd', '4', '1', '3', '2020-09-15 14:47:10'),
(8, 'Qwerty', 'Asdf', '12345687', 10, 'mnbvc', '5', '1', '3', '2020-09-17 10:28:00'),
(9, 'Times magazine', 'Someone', '1234577', 10, 'New york times', '6', '1', '3', '2020-09-17 13:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `l_book_activity`
--

CREATE TABLE `l_book_activity` (
  `id` int(11) NOT NULL,
  `book_id` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_book_activity`
--

INSERT INTO `l_book_activity` (`id`, `book_id`, `description`, `added_by`, `added_date`) VALUES
(1, '1', 'Created New Book', '1321', '2020-09-10 13:12:58'),
(2, '1', 'Created New Book', '1321', '2020-09-10 13:22:56'),
(3, '1', 'Created New Book', '1321', '2020-09-10 13:23:33'),
(4, '1', 'Borrowed Book', '3', '2020-09-12 07:23:42'),
(5, '2', 'Borrowed Book', '3', '2020-09-12 07:24:25'),
(6, '4', 'Created New Book', '3', '2020-09-15 14:44:44'),
(7, '5', 'Created New Book', '3', '2020-09-15 14:45:37'),
(8, '5', 'Created New Book', '3', '2020-09-15 14:46:39'),
(9, '7', 'Created New Book', '3', '2020-09-15 14:47:10'),
(10, '8', 'Created New Book [Qwerty] By [Syntax]', '3', '2020-09-17 10:28:00'),
(11, '9', 'Created New Book [Times magazine] By [Syntax]', '3', '2020-09-17 13:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `l_book_status`
--

CREATE TABLE `l_book_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_borrowed`
--

CREATE TABLE `l_borrowed` (
  `id` int(11) NOT NULL,
  `book_id` varchar(100) DEFAULT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `borrow_status` varchar(100) DEFAULT NULL,
  `issued_by` varchar(100) DEFAULT NULL,
  `books` int(100) DEFAULT NULL,
  `borrow_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_borrowed`
--

INSERT INTO `l_borrowed` (`id`, `book_id`, `student_id`, `borrow_status`, `issued_by`, `books`, `borrow_date`, `return_date`) VALUES
(1, '1', '1', '2', '3', 1, '2020-09-12 00:00:00', '2020-09-26 00:00:00'),
(2, '2', '1', '2', '3', 1, '2020-09-12 00:00:00', '2020-09-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `l_category`
--

CREATE TABLE `l_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_category`
--

INSERT INTO `l_category` (`id`, `name`) VALUES
(2, 'Arts & Music'),
(3, 'Biographies'),
(4, 'Business'),
(5, 'Computers & Tech'),
(6, 'Edu & Referennces'),
(7, 'Entertainment'),
(8, 'History'),
(9, 'Social Science'),
(10, 'Cooking'),
(14, 'Math and Science');

-- --------------------------------------------------------

--
-- Table structure for table `l_groups`
--

CREATE TABLE `l_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_groups`
--

INSERT INTO `l_groups` (`id`, `name`, `status`) VALUES
(1, 'Admin', '1'),
(2, 'Super Admin', '1'),
(3, 'Staff', '1'),
(4, 'Students', '1');

-- --------------------------------------------------------

--
-- Table structure for table `l_group_permissions`
--

CREATE TABLE `l_group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` varchar(100) DEFAULT NULL,
  `permission_name` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `p_view` int(11) DEFAULT NULL,
  `p_add` int(11) DEFAULT NULL,
  `p_edit` int(11) DEFAULT NULL,
  `p_del` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_group_permissions`
--

INSERT INTO `l_group_permissions` (`id`, `group_id`, `permission_name`, `description`, `p_view`, `p_add`, `p_edit`, `p_del`) VALUES
(1, '1', 'STAFF_MANAGEMENT', '', 1, 1, 1, 0),
(2, '1', 'SETTING_MANAGEMENT', '', 1, 1, 1, 0),
(3, '1', 'STUDENT_MANAGEMENT', '', 1, 1, 1, 0),
(4, '1', 'BOOK_MANAGEMENT', '', 1, 1, 1, 0),
(5, '1', 'LOGS', '', 1, 1, 1, 0),
(6, '2', 'STAFF_MANAGEMENT', '', 1, 1, 1, 1),
(7, '2', 'SETTING_MANAGEMENT', '', 1, 1, 1, 1),
(8, '2', 'STUDENT_MANAGEMENT', '', 1, 1, 1, 1),
(9, '2', 'BOOK_MANAGEMENT', '', 1, 1, 1, 1),
(10, '2', 'LOGS', '', 1, 1, 1, 1),
(11, '3', 'STAFF_MANAGEMENT', '', 1, 0, 0, 0),
(12, '3', 'SETTING_MANAGEMENT', '', 0, 0, 0, 0),
(13, '3', 'STUDENT_MANAGEMENT', '', 1, 1, 1, 0),
(14, '3', 'BOOK_MANAGEMENT', '', 1, 1, 1, 0),
(15, '3', 'LOGS', '', 0, 0, 0, 0),
(16, '4', 'STAFF_MANAGEMENT', '', 0, 0, 0, 0),
(17, '4', 'SETTING_MANAGEMENT', '', 0, 0, 0, 0),
(18, '4', 'STUDENT_MANAGEMENT', '', 0, 0, 0, 0),
(19, '4', 'BOOK_MANAGEMENT', '', 1, 0, 0, 0),
(20, '4', 'LOGS', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `l_passes`
--

CREATE TABLE `l_passes` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_passes`
--

INSERT INTO `l_passes` (`id`, `user_id`, `pass`, `reset_token`, `reset_status`) VALUES
(1, '1', '%gEqFSwBXgJ.rc_.Mpgt%UA.]+k0s|s_', NULL, NULL),
(2, '3', 'nFhi:IdlGQ3)cvOWmq--@b}1a}+(hYl;', NULL, NULL),
(3, '4', 'Y5Qd*VuQHCeR#b8:cuoq2R8w_lvVh|Gs', NULL, NULL),
(4, '5', 'u337(-VDJO>w[(YwtcVUo)E;X^%n;m07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `l_staff`
--

CREATE TABLE `l_staff` (
  `id` int(11) NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `id_no` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `user_group` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_staff`
--

INSERT INTO `l_staff` (`id`, `f_name`, `l_name`, `email`, `phone`, `id_no`, `username`, `pass`, `user_group`, `status`, `avatar`, `added_by`, `added_date`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '0712345677', '1234567890', 'admin', '0862bece505a410f0a6be43ef2d5aa43d3734d3d55b74631b768646b26143152', '1', '1', 'https://www.gravatar.com/avatar/75d23af433e0cea4c0e45a56dba18b30?s=80&d=mp&r=g', '3', '2020-09-15 12:18:50'),
(3, 'Norbert', 'Kioko', 'vincentkioko51@gmail.com', '0727796831', '297141625', 'Syntax', '7420e7230e784f91a2f6d72deca371937741e425021fb42c723fe39d3187134d', '2', '1', 'https://www.gravatar.com/avatar/36f216731cb0527d17d81dfda6e3a08a?s=80%d=mpg=g', '3', '2020-09-17 13:01:40'),
(4, 'Ken', 'Mutuku', 'ken@gmail.com', '0715478963', '12457896', 'AsapKenn', '10f91ccc7d4682b87d6fa4e7b5f709bf370eaf1cca877c6416c8af460875ac82', '3', '1', 'https://www.gravatar.com/avatar/1e72d7bcd14512016242b145a3ebfc52?s=80%d=mpg=g', '3', '2020-09-18 08:45:02'),
(5, 'Zack', 'Kyalo', 'zack@gmail.com', '0714568794', '14567896', 'zack.kyalo', 'fadb17254e0181b70d5d24ec5b9504d3996b5945a6d81121503cbabbb6b10221', '3', '1', 'https://www.gravatar.com/avatar/296bbd87abac0985fe53e458bda64c53?s=80%d=mpg=g', '1', '2020-09-18 09:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `l_student`
--

CREATE TABLE `l_student` (
  `id` int(11) NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `m_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `adm_no` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `borrowed` varchar(100) DEFAULT NULL,
  `owed` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_student`
--

INSERT INTO `l_student` (`id`, `f_name`, `m_name`, `l_name`, `adm_no`, `username`, `pass`, `class`, `borrowed`, `owed`, `status`, `added_by`, `added_date`) VALUES
(1, 'First', 'Second', 'LAst', '123456789', 'First.LAst', NULL, '3', NULL, NULL, '1', '1', '2020-09-15 13:55:16'),
(2, 'sjhdsjdfhs', 'jnfdjbgjdbv', 'nvjdfvj vn', '1456789523', 'sjhdsjdfhs.nvjdfvj vn', NULL, '2', NULL, NULL, '1', '1', '2020-09-15 13:55:20'),
(5, 'lydia', 'Mwikali', 'Mutunga', '4156', 'lydia.Mutunga', NULL, '4', NULL, NULL, '1', '3', '2020-09-15 13:16:29'),
(6, 'Shadrack', 'Sammy', 'Mutuku', '8017', 'Shadrack.Mutuku', NULL, '4', NULL, NULL, '1', '3', '2020-09-15 13:19:03'),
(7, 'kwanza', 'kati', 'mwisho', '1457896', 'kwanza.mwisho', NULL, '2', NULL, NULL, '1', '3', '2020-09-17 10:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `l_token_auth`
--

CREATE TABLE `l_token_auth` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `selector_hash` varchar(255) NOT NULL,
  `is_expired` int(11) NOT NULL DEFAULT 0,
  `expiry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_token_auth`
--

INSERT INTO `l_token_auth` (`id`, `username`, `password_hash`, `selector_hash`, `is_expired`, `expiry_date`) VALUES
(1, 'vincentkioko51@gmail.com', '$2y$10$R1B8GAgxbQ3.yPUZ8LqVluyAPywmeKCMGQAUp2GHSXlvhbY4VTNIm', '$2y$10$So54aS7C9agT4CbcweiITeiYNrQdsTG6PBr3BoX.G4btQ/7ReEny2', 1, '2020-09-17 08:21:38'),
(2, 'vincentkioko51@gmail.com', '$2y$10$T5H6FQky7xgOwwyqV7UIv.U1CG7ApmcCYCOirvn9sDcF.Fp2wUHmW', '$2y$10$BTIdAJgmExEUR.tDrY7ZzOuMmJwQ1zm/ami/OFTDIM9iWAO2CnmI.', 1, '2020-09-17 08:29:00'),
(3, 'Syntax', '$2y$10$QdvyJki47Zpa9obiHTcQPeaNCBJfp7C2B5mqBe5ohMV25za5zI7wi', '$2y$10$0P9IfBfKPILXeYhd/vCKyO1PPMGHtES8F5kWFQdCRKFi7gX53Dwzq', 1, '2020-09-17 08:39:36'),
(4, 'vincentkioko51@gmail.com', '$2y$10$7bFrJlpEMv3CJxHjwikDru14f/NepC61ieqRfX1p.AmnRJOPG3msC', '$2y$10$lQc8HkRnAm2xuzwHzYbcSeLlNai8JHegT9YhNG1V7K2vUbnPA7S/S', 0, '2020-10-17 07:29:00'),
(5, 'admin@gmail.com', '$2y$10$P8mIxtGt8z4J30gPlY5HHOTdozxpLhKBuA/3BD2rAipcpNrQBTPu.', '$2y$10$eq9ycGspf3zBQKeuXV4PXuxnmYdGbpjpJUaClalR/Ynt60lOH4Vla', 1, '2020-09-17 12:52:13'),
(6, 'Syntax', '$2y$10$EP/0xckv0f0AoTpcwWr4rez0kBv3Myjqk0PHBHvomZaIIkhS9HNCW', '$2y$10$daGUjvihOnPMWeaWcpyBheSTRl4zoiBrCZF1L0q7KjziEaVF8LwPG', 1, '2020-09-17 08:40:39'),
(7, 'Syntax', '$2y$10$gOwY./94mABpo5k491PtTOXiS7mtYUCMJdzs4IQvQpNuVtMje0Gq2', '$2y$10$ra4GOVUG0.zfb.mimeNNfOvAAbSD9DO/ol5rpYHnnZN43EFcDbtlq', 1, '2020-09-17 09:19:50'),
(8, 'Syntax', '$2y$10$FYpkaW9vNLGvTubWyaWB.O.GgteVZ.krOb9tdqUVrk9a5FMFp.uDy', '$2y$10$krRgASAZLy0h27ZzCpSBbuvbEkLJNK46Z2Sv0PS9SfP9QMrNdod.G', 0, '2020-10-17 08:19:50'),
(9, 'admin@gmail.com', '$2y$10$uDKAQTyk7mHuPvIsLu3Ipu8ytz8ja1dv1gHaVtwcKJfKxQUN0H66.', '$2y$10$i9jh.nHZxQtCXvtLX63YceuHxwj.23i0j8Yv7vSNqj3RUjGSKXijW', 0, '2020-10-17 11:52:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `l_activity_logs`
--
ALTER TABLE `l_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_books`
--
ALTER TABLE `l_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_book_activity`
--
ALTER TABLE `l_book_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_book_status`
--
ALTER TABLE `l_book_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_borrowed`
--
ALTER TABLE `l_borrowed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_category`
--
ALTER TABLE `l_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_groups`
--
ALTER TABLE `l_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_group_permissions`
--
ALTER TABLE `l_group_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_passes`
--
ALTER TABLE `l_passes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_staff`
--
ALTER TABLE `l_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student`
--
ALTER TABLE `l_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_token_auth`
--
ALTER TABLE `l_token_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `l_activity_logs`
--
ALTER TABLE `l_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `l_books`
--
ALTER TABLE `l_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `l_book_activity`
--
ALTER TABLE `l_book_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `l_book_status`
--
ALTER TABLE `l_book_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `l_borrowed`
--
ALTER TABLE `l_borrowed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `l_category`
--
ALTER TABLE `l_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `l_groups`
--
ALTER TABLE `l_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `l_group_permissions`
--
ALTER TABLE `l_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `l_passes`
--
ALTER TABLE `l_passes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `l_staff`
--
ALTER TABLE `l_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `l_student`
--
ALTER TABLE `l_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `l_token_auth`
--
ALTER TABLE `l_token_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

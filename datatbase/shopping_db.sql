-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 10:35 AM
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
-- Database: `shopping_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `status`, `created_at`, `address`, `payment_method`) VALUES
(1, 1, 2597.00, 'completed', '2025-06-14 08:53:36', NULL, NULL),
(2, 1, 1199.00, 'completed', '2025-06-14 08:56:27', NULL, NULL),
(3, 1, 2298.99, 'completed', '2025-06-14 09:19:42', NULL, NULL),
(4, 1, 1199.00, 'completed', '2025-06-14 12:30:41', NULL, NULL),
(5, 1, 909.00, 'completed', '2025-06-14 12:40:21', NULL, NULL),
(6, 1, 909.00, 'completed', '2025-06-14 12:55:44', NULL, NULL),
(7, 1, 909.00, 'completed', '2025-06-14 15:00:06', NULL, NULL),
(8, 1, 909.00, 'completed', '2025-06-14 15:49:56', NULL, NULL),
(9, 1, 1818.00, 'completed', '2025-06-14 15:51:24', NULL, NULL),
(10, 1, 909.00, 'completed', '2025-06-14 15:53:35', NULL, NULL),
(11, 1, 909.00, 'completed', '2025-06-14 15:54:19', NULL, NULL),
(12, 1, 909.00, 'completed', '2025-06-14 15:54:31', NULL, NULL),
(13, 1, 909.00, 'completed', '2025-06-14 15:55:18', NULL, NULL),
(14, 1, 3000.00, 'completed', '2025-06-14 16:35:28', NULL, NULL),
(15, 2, 1200.00, 'completed', '2025-06-14 16:39:09', NULL, NULL),
(16, 2, 1200.00, 'completed', '2025-06-14 16:39:45', NULL, NULL),
(17, 2, 909.00, 'completed', '2025-06-14 16:40:51', NULL, NULL),
(18, 2, 1200.00, 'completed', '2025-06-14 16:41:33', NULL, NULL),
(19, 2, 1800.00, 'completed', '2025-06-14 16:43:23', NULL, NULL),
(20, 2, 1200.00, 'completed', '2025-06-14 16:46:52', 'ktm, tpgn', 'COD'),
(21, 2, 1800.00, 'completed', '2025-06-14 16:47:21', 'fgs', 'COD'),
(22, 2, 1200.00, 'completed', '2025-06-14 16:48:05', NULL, NULL),
(23, 2, 1200.00, 'completed', '2025-06-14 16:48:17', NULL, NULL),
(24, 2, 1200.00, 'completed', '2025-06-14 16:51:05', NULL, NULL),
(25, 2, 1800.00, 'completed', '2025-06-14 16:51:55', NULL, NULL),
(26, 2, 1800.00, 'completed', '2025-06-14 16:53:37', NULL, NULL),
(27, 2, 1200.00, 'pending', '2025-06-14 16:55:17', 'dfsad', NULL),
(28, 2, 1200.00, 'pending', '2025-06-14 16:56:54', 'dfsad', NULL),
(29, 2, 1200.00, 'pending', '2025-06-14 16:57:39', 'dfsad', NULL),
(30, 2, 1200.00, 'completed', '2025-06-14 16:58:39', 'dfsad', NULL),
(31, 2, 909.00, 'completed', '2025-06-14 16:59:46', 'dfa', NULL),
(32, 2, 909.00, 'completed', '2025-06-14 17:00:11', 'daf', NULL),
(33, 1, 1800.00, 'completed', '2025-06-14 17:00:59', 'vdva', NULL),
(34, 1, 909.00, 'completed', '2025-07-03 15:24:06', 'ktm', NULL),
(35, 1, 99999999.99, 'completed', '2025-07-03 15:24:23', 'k', NULL),
(36, 1, 1200.00, 'completed', '2025-07-18 10:31:40', 'hjghb', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(8, 5, 8, 1, 909.00),
(9, 6, 8, 1, 909.00),
(10, 7, 8, 1, 909.00),
(11, 8, 8, 1, 909.00),
(12, 9, 8, 2, 909.00),
(13, 10, 8, 1, 909.00),
(14, 11, 8, 1, 909.00),
(15, 12, 8, 1, 909.00),
(16, 13, 8, 1, 909.00),
(17, 14, 13, 1, 3000.00),
(18, 15, 9, 1, 1200.00),
(19, 16, 9, 1, 1200.00),
(20, 17, 8, 1, 909.00),
(21, 18, 9, 1, 1200.00),
(22, 19, 10, 1, 1800.00),
(23, 20, 9, 1, 1200.00),
(24, 21, 10, 1, 1800.00),
(25, 22, 9, 1, 1200.00),
(26, 23, 9, 1, 1200.00),
(27, 24, 9, 1, 1200.00),
(28, 25, 10, 1, 1800.00),
(29, 26, 10, 1, 1800.00),
(30, 27, 9, 1, 1200.00),
(31, 28, 9, 1, 1200.00),
(32, 29, 9, 1, 1200.00),
(33, 30, 9, 1, 1200.00),
(34, 31, 8, 1, 909.00),
(35, 32, 8, 1, 909.00),
(36, 33, 10, 1, 1800.00),
(37, 34, 8, 1, 909.00),
(38, 35, 11, 1, 99999999.99),
(39, 36, 9, 1, 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `amount`, `payment_status`, `created_at`, `method`) VALUES
(1, 1, 2597.00, 'paid', '2025-06-14 08:53:36', NULL),
(2, 2, 1199.00, 'paid', '2025-06-14 08:56:27', NULL),
(3, 3, 2298.99, 'paid', '2025-06-14 09:19:42', NULL),
(4, 4, 1199.00, 'paid', '2025-06-14 12:30:41', NULL),
(5, 5, 909.00, 'paid', '2025-06-14 12:40:21', NULL),
(6, 6, 909.00, 'paid', '2025-06-14 12:55:44', NULL),
(7, 7, 909.00, 'paid', '2025-06-14 15:00:06', NULL),
(8, 8, 909.00, 'paid', '2025-06-14 15:49:56', NULL),
(9, 9, 1818.00, 'paid', '2025-06-14 15:51:24', NULL),
(10, 10, 909.00, 'paid', '2025-06-14 15:53:35', NULL),
(11, 11, 909.00, 'paid', '2025-06-14 15:54:19', NULL),
(12, 12, 909.00, 'paid', '2025-06-14 15:54:31', NULL),
(13, 13, 909.00, 'paid', '2025-06-14 15:55:18', NULL),
(14, 14, 3000.00, 'paid', '2025-06-14 16:35:28', NULL),
(15, 15, 1200.00, 'paid', '2025-06-14 16:39:09', NULL),
(16, 16, 1200.00, 'paid', '2025-06-14 16:39:45', NULL),
(17, 17, 909.00, 'paid', '2025-06-14 16:40:51', NULL),
(18, 18, 1200.00, 'paid', '2025-06-14 16:41:33', NULL),
(19, 19, 1800.00, 'paid', '2025-06-14 16:43:23', NULL),
(20, 20, 1200.00, 'paid', '2025-06-14 16:46:52', NULL),
(21, 21, 1800.00, 'paid', '2025-06-14 16:47:21', NULL),
(22, 22, 1200.00, 'paid', '2025-06-14 16:48:05', NULL),
(23, 23, 1200.00, 'paid', '2025-06-14 16:48:17', NULL),
(24, 24, 1200.00, 'paid', '2025-06-14 16:51:05', NULL),
(25, 25, 1800.00, 'paid', '2025-06-14 16:51:55', NULL),
(26, 26, 1800.00, 'paid', '2025-06-14 16:53:37', NULL),
(27, 30, 1200.00, 'paid', '2025-06-14 16:58:39', 'cod'),
(28, 31, 909.00, 'paid', '2025-06-14 16:59:46', 'cod'),
(29, 32, 909.00, 'paid', '2025-06-14 17:00:11', 'online'),
(30, 33, 1800.00, 'paid', '2025-06-14 17:00:59', 'cod'),
(31, 34, 909.00, 'paid', '2025-07-03 15:24:06', 'cod'),
(32, 35, 99999999.99, 'paid', '2025-07-03 15:24:23', 'cod'),
(33, 36, 1200.00, 'paid', '2025-07-18 10:31:40', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category`, `created_at`) VALUES
(8, 'burger', 'tasty', 909.00, 'uploads/684d6da3b23d1.jpg', 'food', '2025-06-14 12:40:03'),
(9, 'tshirt', 'modern fashionable tshirt', 1200.00, 'uploads/684da22771648.jpg', 'Clothing', '2025-06-14 16:14:16'),
(10, 'pants', 'jeans', 1800.00, 'uploads/684da11fd9e03.jpg', 'Clothing', '2025-06-14 16:19:43'),
(11, 'airbus 380', 'a giant aeroplane', 999999.99, 'uploads/684da1ef0b217.jpg', 'technology', '2025-06-14 16:23:11'),
(12, 'iphone', 'iphone 16 pro max', 250000.00, 'uploads/687a239e89e96.png', 'technology', '2025-06-14 16:25:16'),
(13, 'earbuds', 'anker ', 3000.00, 'uploads/684da2ccd111e.jpg', 'electronics', '2025-06-14 16:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'krishna', 'bhattarai@gmail.com', '$2y$10$5NjspcPFMEtzrNQjPmN/Ue7GDNA9aHvr16uEcA25U/..5tQYO6yfW', 'admin', '2025-06-14 08:03:20'),
(2, 'krishna1', 'bhattarai1@gmail.com', '$2y$10$A63KFp1fC4gGizoiW5Q9uOxZ6yd71TZxFTaCUNN7xfgbzKXN65OcC', 'customer', '2025-06-14 09:35:07'),
(3, '123', '123@gmail.com', '$2y$10$hQ3KS8EXFSGeoX/q40Ko1u.gEKwgWANjAawad07t8XiNR565llrEG', 'customer', '2025-06-14 15:56:29'),
(4, 'krishna', 'krishna@gmail.com', '$2y$10$dACeuN3AEmj1l70uA7kEEu/gMAPPq.EAkAshCtZ2MwApTvmhtP7ae', 'customer', '2025-07-30 08:29:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `fk_product_orderitem` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_product_orderitem` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

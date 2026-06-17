-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 04:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im102_lab2_alindayo`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `supplier_id`, `created_at`) VALUES
(1, 'Laptop', '15-inch business laptop', 45000.00, 10, 1, 1, '2026-06-17 14:15:47'),
(2, 'Mouse', 'Wireless mouse', 500.00, 50, 1, 1, '2026-06-17 14:15:47'),
(3, 'Keyboard', 'Mechanical keyboard', 1500.00, 30, 1, 1, '2026-06-17 14:15:47'),
(4, 'Printer Paper', 'A4 size bond paper', 250.00, 100, 2, 2, '2026-06-17 14:15:47'),
(5, 'Ballpen', 'Blue ink ballpen', 15.00, 500, 2, 2, '2026-06-17 14:15:47'),
(6, 'Notebook', '200-page notebook', 50.00, 200, 2, 2, '2026-06-17 14:15:47'),
(7, 'Bread', 'Whole wheat bread', 50.00, 40, 3, 3, '2026-06-17 14:15:47'),
(8, 'Milk', '1-liter fresh milk', 90.00, 60, 3, 3, '2026-06-17 14:15:47'),
(9, 'Office Chair', 'Ergonomic chair', 3500.00, 15, 4, 2, '2026-06-17 14:15:47'),
(10, 'Table', 'Wooden office table', 7000.00, 8, 4, 2, '2026-06-17 14:15:47'),
(11, 'T-Shirt', 'Cotton T-shirt', 300.00, 100, 5, 3, '2026-06-17 14:15:47'),
(12, 'Jacket', 'Waterproof jacket', 1200.00, 25, 5, 3, '2026-06-17 14:15:47'),
(13, 'wa ragud', 'wa sad', 100.00, 200, 3, 3, '2026-06-17 14:47:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

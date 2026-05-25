-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 05:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'Guess 1875', 3000),
(2, 'Guest Watch', 2500),
(3, 'Panerai Watch', 3500),
(4, 'Nonos Watch', 1800),
(5, 'Levis', 1800),
(6, 'louis philippe t-shirt', 2500),
(7, 'Highlander t-shirt', 500),
(8, 'GUCCI White t-Shirt', 2300),
(9, 'Nike White Sneaker', 8000),
(10, 'Nike White Shoes', 7500),
(11, 'Nike Yellow Sneaker', 7000),
(12, 'Nike Brown Sneaker', 6000),
(13, 'Beats Headphone', 22500),
(14, 'Zolo Headphone', 4500),
(15, 'Sony Speaker', 10500),
(16, 'Airpods', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `registration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_id`, `first_name`, `last_name`, `registration_time`, `password`) VALUES
(65, 'demo@gmail.com', 'reys', 'rudt', '2022-10-19 13:46:33', 'e4f194cba29960e12d8b8f1bfedc972b'),
(66, 'sgad34@gmail.com', 'werty', 'erty', '2019-10-19 13:55:46', 'e10adc3949ba59abbe56e057f20f883e'),
(67, 'aca234@gmail.com', 'Sham', 'das', '2019-03-19 07:37:46', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `users_products`
--

CREATE TABLE users_products (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    item_id INT NOT NULL,
    status VARCHAR(50),
    PRIMARY KEY (id)
);

--
-- Dumping data for table `users_products`
--

INSERT INTO `users_products` (`id`, `user_id`, `item_id`, `status`) VALUES
(11, 67, 6, 'Confirmed'),
(17, 67, 1, 'Confirmed'),
(18, 67, 5, 'Confirmed'),
(19, 67, 6, 'Confirmed'),
(20, 67, 1, 'Confirmed'),
(23, 67, 1, 'Confirmed'),
(24, 67, 2, 'Confirmed'),
(25, 67, 9, 'Confirmed');

CREATE TABLE `shipping_address` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100),
    address VARCHAR(255),
    city VARCHAR(100),
    state VARCHAR(100),
    zipcode VARCHAR(10),
    phone VARCHAR(15),
    email VARCHAR(100)
);


CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  payment_method VARCHAR(50),
  amount DECIMAL(10,2),
  status enum('Completed') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE admins (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `registration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`id`, `email_id`, `first_name`, `last_name`, `registration_time`, `password`) VALUES
(12, 'srajaltrivedi0@gmail.com', 'Srajal', 'Trivedi', '2022-10-19 13:46:33', '81dc9bdb52d04dc20036dbd8313ed055');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`item_id`);
  
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);


ALTER Table `shipping_address`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;


--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

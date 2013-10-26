-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2013 at 01:17 PM
-- Server version: 5.6.11
-- PHP Version: 5.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopdb`
--
CREATE DATABASE IF NOT EXISTS `shopdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shopdb`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(4, 'Accessories'),
(3, 'Cell Phones'),
(1, 'Computers'),
(6, 'Gaming'),
(5, 'Navigation'),
(2, 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `oders`
--

CREATE TABLE IF NOT EXISTS `oders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `processed` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `oders`
--

INSERT INTO `oders` (`id`, `user`, `processed`) VALUES
(16, 1, 0),
(17, 2, 0),
(18, 1, 0),
(19, 2, 0),
(20, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE IF NOT EXISTS `orderproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderNumber` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`orderNumber`,`product`),
  KEY `product` (`product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`id`, `orderNumber`, `product`) VALUES
(1, 16, 4),
(2, 17, 2),
(3, 17, 3),
(4, 18, 4),
(6, 19, 3),
(5, 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Make` varchar(20) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Image` varchar(20) NOT NULL,
  `Special` tinyint(4) NOT NULL,
  `Category` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Category` (`Category`),
  KEY `Category_2` (`Category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Make`, `Model`, `Description`, `Price`, `Image`, `Special`, `Category`) VALUES
(1, 'Dell', 'NB3521 i5', 'Notebook', '7999.99', 'dellnb3521i5', 1, 'Computers'),
(2, 'Samsung', '1043664', 'All in One PC', '8999.99', 'samsung1043664', 1, 'Computers'),
(3, 'Samsung', 'Galaxy Tab 3', 'Tablet', '7499.95', 'samsungtab3', 0, 'Tablets'),
(4, 'Apple', 'iPad 2', 'Tablet', '5999.95', 'ipad2', 1, 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `Surname`, `Firstname`, `Email`, `Phone`) VALUES
(1, 'koos', 'Du toit', 'Koos', 'koos@gmail.com', '0712345678'),
(2, 'ben2013', 'Zuma', 'Ben', 'ben@gmail.com', '0723456789');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oders`
--
ALTER TABLE `oders`
  ADD CONSTRAINT `oders_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`orderNumber`) REFERENCES `oders` (`id`),
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `categories` (`category`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

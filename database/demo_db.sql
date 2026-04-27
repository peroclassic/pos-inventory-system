-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 09:16 PM
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
-- Database: `demo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL,
  `cname` varchar(400) NOT NULL,
  `cphone` varchar(40) NOT NULL,
  `caddress` varchar(400) NOT NULL,
  `cemail` varchar(100) NOT NULL,
  `purchaseno` int(11) NOT NULL,
  `regby` varchar(400) NOT NULL,
  `updatedby` varchar(400) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `cname`, `cphone`, `caddress`, `cemail`, `purchaseno`, `regby`, `updatedby`, `datecreated`, `dateupdated`) VALUES
(1, 'Customer', '07033', 'B/C', 'customer@gmail.com', 1, '', '', '2025-02-28 12:52:42', '2025-02-28 12:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `pcode` varchar(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pdesc` varchar(400) NOT NULL,
  `psold` int(100) NOT NULL,
  `pleft` int(100) NOT NULL,
  `saleprice` int(40) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `createdby` varchar(100) NOT NULL,
  `updatedby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pcode`, `pname`, `pdesc`, `psold`, `pleft`, `saleprice`, `datecreated`, `dateupdated`, `createdby`, `updatedby`) VALUES
(1, '79343576', 'Martell VS ()', 'Brandy', 0, 1000000, 300000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(2, '68555251', 'Martell Blue Swift ()', 'Brandy', 0, 1000000, 160000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(3, '04745529', 'Martell XO ()', 'Brandy', 0, 1000000, 500000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(4, '18061898', 'Hennessy VSOP ()', 'Brandy', 0, 1000000, 170000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(5, '76072906', 'Hennessy XO ()', 'Brandy', 0, 1000000, 550000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(6, '26178839', 'Carlo Rossi ()', 'Wines', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(7, '02675482', 'Sweet Kiss ()', 'Wines', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(8, '34840894', 'Four Cousin ()', 'Wines', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(9, '66178029', 'Agor ()', 'Wines', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(10, '26367466', 'Frontera ()', 'Wines', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(11, '33303248', 'Declan ()', 'Wines', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(12, '87413846', 'Best Cream ()', 'Liqueur', 0, 1000000, 45000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(13, '37159490', 'Baileys ()', 'Liqueur', 0, 1000000, 50000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(14, '23555913', 'Cream Coffee ()', 'Liqueur', 0, 1000000, 50000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(15, '06301099', 'Campari (Small)', 'Liqueur', 0, 1000000, 20000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(16, '60837760', 'Campari (Big)', 'Liqueur', 0, 1000000, 50000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(17, '85285506', 'Ciroc ()', 'Vodka', 0, 1000000, 80000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(18, '43914254', 'Absolute ()', 'Vodka', 0, 1000000, 60000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(19, '63714755', 'Don Julio ()', 'Tequila', 0, 1000000, 550000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(20, '86831018', 'Casamigo ()', 'Tequila', 0, 1000000, 300000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(21, '43010828', 'Olmeca ()', 'Tequila', 0, 1000000, 60000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(22, '54561091', 'Olmeca Chocolate ()', 'Tequila', 0, 1000000, 60000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(23, '43772972', 'Camido ()', 'Tequila', 0, 1000000, 55000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(24, '55181592', 'Sierra ()', 'Tequila', 0, 1000000, 55000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(25, '44589048', 'Coke ()', 'Mixers', 0, 1000000, 2000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(26, '57400465', 'Sprite ()', 'Mixers', 0, 1000000, 2000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(27, '53235188', 'Red Bull ()', 'Mixers', 0, 1000000, 3000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(28, '93974546', 'Power Horse ()', 'Mixers', 0, 1000000, 3000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(29, '10167171', 'Water ()', 'Mixers', 0, 1000000, 1500, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(30, '68912222', 'Jameson Original ()', 'Whiskey', 0, 1000000, 50000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(31, '14059597', 'Jameson Black Barrel ()', 'Whiskey', 0, 1000000, 60000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(32, '63561325', 'Gold Label ()', 'Whiskey', 0, 1000000, 70000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(33, '75627838', 'Black Label ()', 'Whiskey', 0, 1000000, 90000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(34, '87455217', 'Glenfiddich 12yrs ()', 'Whiskey', 0, 1000000, 90000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(35, '10392574', 'Glenfiddich 15yrs ()', 'Whiskey', 0, 1000000, 150000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(36, '89597224', 'Glenfiddich 18yrs ()', 'Whiskey', 0, 1000000, 350000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(37, '16808400', 'Gordons ()', 'Whiskey', 0, 1000000, 50000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(38, '15250334', 'Dom Perignon Brut ()', 'Champagne', 0, 1000000, 500000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(39, '25826474', 'Moet & Chandon Brut ()', 'Champagne', 0, 1000000, 200000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(40, '83381371', 'Imperial ()', 'Champagne', 0, 1000000, 200000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(41, '39427437', 'Martini Rose ()', 'Champagne', 0, 1000000, 50000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(42, '46993076', 'Belaire Rose ()', 'Champagne', 0, 1000000, 150000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(43, '16683073', 'Shisha Premium ()', 'Shisha Smoke', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(44, '42436138', 'Sutra Exclusive ()', 'Shisha Smoke', 0, 1000000, 30000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(45, '62131476', 'Joker ()', 'Shisha Smoke', 0, 1000000, 35000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(46, '83348968', 'Ecstacy ()', 'Shisha Smoke', 0, 1000000, 40000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(47, '30350419', 'Extra Coal ( )', 'Shisha Smoke', 0, 1000000, 20000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(48, '01705191', 'F*** My P**** ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(49, '17474705', 'Alcoholic Chapman ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(50, '82257953', 'Margarita ((Classic/Frozen)', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(51, '58865655', 'Long Island ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(52, '47554419', 'Sex on the Beach ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(53, '61175133', 'Pina Colada ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(54, '63212413', 'Strawberry Daiquiri (Classic/Frozen)', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(55, '32536670', 'Banana Fantasy ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(56, '73046116', 'Screw Driver ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(57, '67620571', 'Tequila Sunrise ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(58, '18964512', 'Liquid Marijuana Shot ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(59, '91960852', 'Audio Mother F***** ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(60, '02910726', 'Pain Killer ()', 'Alcoholic Cocktails', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(61, '38671079', 'De Sutra Special ()', 'Alcoholic Cocktails', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(62, '84623218', 'Mojito ()', 'Alcoholic Cocktails', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(63, '07102858', 'Bahamas Mama ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(64, '81644640', 'Swimming Pool ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(65, '86914629', 'White Russian ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(66, '89639231', 'Hurricane ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(67, '87452268', 'After Party ()', 'Alcoholic Cocktails', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(68, '68343653', 'Chapman ()', 'Non-Alcoholic Mocktails', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(69, '79361463', 'Virgin Colada ()', 'Non-Alcoholic Mocktails', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(70, '91776359', 'Almond Cooler ()', 'Non-Alcoholic Mocktails', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(71, '20797409', 'After Glow ()', 'Non-Alcoholic Mocktails', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(72, '28657971', 'Police Control ()', 'Non-Alcoholic Mocktails', 2, 999998, 8000, '2025-03-16 18:00:26', '2026-04-26 20:47:28', 'created by peroclassic', 'updated by  admin'),
(73, '80897631', 'Vanilla ()', 'Milkshakes and Smoothies', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(74, '18514246', 'Chocolate & Banana ()', 'Milkshakes and Smoothies', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(75, '49878340', 'Banana Shake ()', 'Milkshakes and Smoothies', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(76, '93848968', 'Chocolate Shake ()', 'Milkshakes and Smoothies', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(77, '19609821', 'Strawberry ()', 'Milkshakes and Smoothies', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(78, '16502206', 'Fruit Smoothie ()', 'Milkshakes and Smoothies', 0, 1000000, 7000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(79, '23681570', 'Spring Roll (4 pieces)', 'Appetizers', 0, 1000000, 5500, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(80, '68901237', 'Samosa (4 Pieces)', 'Appetizers', 0, 1000000, 6000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(81, '73461478', 'Peppered Snail (2 pieces)', 'Appetizers', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(82, '60603682', 'Gizzard Kebab ()', 'Appetizers', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(83, '82633979', 'Chicken Wings (Spicy/Honey Glazed, 3 pieces)', 'Appetizers', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(84, '31358853', 'Gizzard and Plantain in Sauce (Sweet and Spicy)', 'Appetizers', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(85, '08892331', 'Oriental Rice (Mixed with diced chicken)', 'Rice Dishes', 0, 1000000, 12000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(86, '50385099', 'Asun Jollof (Spicy Jollof with goat meat)', 'Rice Dishes', 0, 1000000, 13000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(87, '25248507', 'Seafood Coconut Rice (Mixed with shrimps)', 'Rice Dishes', 0, 1000000, 13000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(88, '75087240', 'Chinese Rice (Paired with beef/chicken curry)', 'Rice Dishes', 0, 1000000, 20000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(89, '99690683', 'Native Rice (Spicy/Mild, mixed with crab, snail, smoked fish)', 'Rice Dishes', 0, 1000000, 15000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(90, '73191700', 'Suya Rice (Chefs Special)', 'Rice Dishes', 0, 1000000, 14000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(91, '66886455', 'Sutra Special Seafood Rice (Prawns, crab, diced chicken)', 'Specialty Rice', 0, 1000000, 20000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(92, '14857177', 'Smokey Jollof (Owambe Special)', 'Specialty Rice', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(93, '73626524', 'Sutra Thai Pineapple Rice (Paired with king-size prawn, diced chicken and pineapple cubes)', 'Specialty Rice', 0, 1000000, 20000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(94, '23561094', 'Peppered Turkey (Whole, diced)', 'Protein and Grill', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(95, '96925899', 'Peppered Chicken (Whole, diced)', 'Protein and Grill', 0, 1000000, 7600, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(96, '13946218', 'Melluza Fish ()', 'Protein and Grill', 0, 1000000, 7000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(97, '78953398', 'Goat Meat (Fried/Sauced)', 'Protein and Grill', 0, 1000000, 7000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(98, '52928339', 'T-Bone Steak and Mashed Potato ()', 'Protein and Grill', 0, 1000000, 16000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(99, '27781503', 'Lamb Chop and Fries ()', 'Protein and Grill', 0, 1000000, 18000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(100, '80122502', 'Tuna Salad ()', 'Salads and Sides', 0, 1000000, 5500, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(101, '17268003', 'Vegetable Salad (Paired with prawns)', 'Salads and Sides', 0, 1000000, 7000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(102, '45972513', 'Caesar Salad ()', 'Salads and Sides', 0, 1000000, 5000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(103, '78058561', 'Fries (Irish)', 'Salads and Sides', 0, 1000000, 4000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(104, '52375270', 'Sweet Potato ()', 'Salads and Sides', 0, 1000000, 3500, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(105, '27700669', 'Fried Plantain ()', 'Salads and Sides', 0, 1000000, 3000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(106, '81377537', 'Chicken Pepper Soup (Live chicken mix with yam)', 'Hot pot', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(107, '23785684', 'Whole Chicken ()', 'Hot pot', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(108, '74795814', 'Mexican Wrap (Veggies, chicken, sweet mayo cream)', 'Burger Wrap Sandwich', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(109, '02622019', 'Classic 3-in-1 Burger ()', 'Burger Wrap Sandwich', 0, 1000000, 12000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(110, '88722659', 'American Style Burger ()', 'Burger Wrap Sandwich', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(111, '35747239', 'Club Sandwich (Pair of 2)', 'Burger Wrap Sandwich', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(112, '12568221', 'Cheesy Sandwich ()', 'Burger Wrap Sandwich', 0, 1000000, 9000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(113, '55599392', 'Chicken Alfredo (Creamy pasta with mushroom)', 'Pasta and Noodles', 0, 1000000, 15000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(114, '40292303', 'Stir Fry Pasta (Mixed with chicken, beef and eggs)', 'Pasta and Noodles', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(115, '34663340', 'Spaghetti Jollof ()', 'Pasta and Noodles', 0, 1000000, 8000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(116, '52439797', 'Seafood Noodles (Mixed with prawns, shrimp and crab)', 'Pasta and Noodles', 0, 1000000, 15000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(117, '58208967', 'Seafood Okra (Snail, Prawns, Crab, Fresh Catfish/Croaker and Periwinkle, Paired with Swallow (Pounde', 'Sutra Special Soups', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(118, '33725449', 'Fisherman Soup  (Fresh Catfish/Croaker, Snail, Prawns, Periwinkle, Paired with Swallow(Pounded yam, ', 'Sutra Special Soups', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(119, '94000346', 'Delta Banga Soup (Fresh/Dried Catfish, Kpomo and Prawns, Paired with Swallow(Pounded yam, wheat-semo', 'Sutra Special Soups', 0, 1000000, 25000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(120, '68825387', 'Jollof and Fried Rice Platter  (Combo with diced grilled chicken, gizzard kebab, fried plantain, col', 'Platters', 0, 1000000, 30000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(121, '62125899', 'Seafood Platter  (Coconut rice, grilled prawns, peppered snail, crab and extra pepper sauce, fries)', 'Platters', 0, 1000000, 45000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(122, '04153340', 'Special Grills Platter (Assorted grills: chicken kebabs, turkey wings, beef, gizzard kebab, extra pe', 'Platters', 0, 1000000, 55000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(123, '34389006', 'Classic Chicken ()', 'Tacos', 0, 1000000, 7000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(124, '59485012', 'Turkey Special ()', 'Tacos', 0, 1000000, 10000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(125, '94258047', 'Shrimp Avocado ()', 'Tacos', 0, 1000000, 12000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(126, '92835201', 'Waffles and Vanilla Ice Cream ()', 'Desserts', 0, 1000000, 5500, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(127, '81401868', 'Chocolate Slice ()', 'Desserts', 0, 1000000, 6000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(128, '28503739', 'Red Velvet Fudge ()', 'Desserts', 0, 1000000, 6000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', ''),
(129, '98313097', 'Fruit Tart ()', 'Desserts', 0, 1000000, 6000, '2025-03-16 18:00:26', '0000-00-00 00:00:00', 'created by peroclassic', '');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `saleid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pid` varchar(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `saleprice` int(100) NOT NULL,
  `totalcost` int(100) NOT NULL,
  `transcode` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL,
  `cphone` int(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  `staff` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`saleid`, `pname`, `pid`, `qty`, `saleprice`, `totalcost`, `transcode`, `datecreated`, `cphone`, `status`, `staff`) VALUES
(1, 'Waffles &amp; Vanilla Ice Cream', ' 155 ', 2, 4000, 8000, 'BET-00001', '2025-02-25 17:36:51', 7033, 'COMPLETED', ''),
(2, 'Sauced Turkey Wings', ' 103 ', 2, 6000, 12000, 'BET-00001', '2025-02-25 17:37:15', 7033, 'COMPLETED', ''),
(3, 'Seafood Noodles (Prawns, Calamari, Crab)', ' 118 ', 3, 10000, 30000, 'BET-00002', '2025-02-25 17:50:59', 7033, 'COMPLETED', ''),
(4, 'White Russian', ' 18 ', 1, 8500, 8500, 'BET-00003', '2025-02-25 18:08:52', 7033, 'COMPLETED', ''),
(5, 'Chapman', ' 21 ', 2, 7000, 14000, 'BET-00004', '2025-02-26 15:32:10', 7033, 'COMPLETED', ''),
(6, 'Seafood Platter (A deluxe of grilled prawns, peppered snail, crab fish, served with creamy coconut r', ' 147 ', 2, 45000, 90000, 'BET-00005', '2025-02-26 15:48:28', 7033, 'COMPLETED', ''),
(7, 'Waffles &amp; Vanilla Ice Cream', ' 155 ', 2, 4000, 8000, 'BET-00005', '2025-02-26 15:48:43', 7033, 'COMPLETED', ''),
(8, 'Red Bull', ' 79 ', 2, 2000, 4000, 'BET-00005', '2025-02-26 15:48:58', 7033, 'COMPLETED', ''),
(10, 'Seafood Coconut Fried Rice', ' 109 ', 2, 12000, 24000, 'BET-00006', '2025-02-26 16:32:28', 7033, 'COMPLETED', ''),
(11, 'Seafood Noodles (Prawns, Calamari, Crab)', ' 118 ', 2, 10000, 20000, 'BET-00006', '2025-02-26 16:33:43', 7033, 'COMPLETED', ''),
(15, 'Chi Exotic', ' 84 ', 2, 3000, 6000, 'BET-00007', '2025-02-26 18:19:02', 7033, 'COMPLETED', ''),
(16, 'Waffles &amp; Vanilla Ice Cream', ' 155 ', 2, 4000, 8000, 'BET-00008', '2025-02-26 18:33:48', 7033, 'COMPLETED', ''),
(17, 'Beef Mix Samosa', ' 98 ', 2, 5000, 10000, 'BET-00009', '2025-02-26 20:00:19', 7033, 'COMPLETED', ''),
(19, 'Seafood Platter (A deluxe of grilled prawns, peppered snail, crab fish, served with creamy coconut r', ' 147 ', 3, 45000, 135000, 'BET-000010', '2025-02-26 20:05:01', 7033, 'COMPLETED', ''),
(20, 'White Russian', ' 18 ', 1, 8500, 8500, 'BET-000010', '2025-02-26 20:05:18', 7033, 'COMPLETED', ''),
(21, 'Police Control ()', ' 72 ', 2, 8000, 16000, 'BET-6000011', '2026-04-26 20:47:28', 7033, 'COMPLETED', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `salesummary`
--

CREATE TABLE `salesummary` (
  `sumid` int(11) NOT NULL,
  `sumdate` datetime NOT NULL,
  `transcode` varchar(100) NOT NULL,
  `summedcost` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `totalcost` int(100) NOT NULL,
  `paymentmode` varchar(100) NOT NULL,
  `colamount` int(100) NOT NULL,
  `balreturned` int(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `cphone` varchar(20) NOT NULL,
  `staff` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `salesummary`
--

INSERT INTO `salesummary` (`sumid`, `sumdate`, `transcode`, `summedcost`, `discount`, `totalcost`, `paymentmode`, `colamount`, `balreturned`, `cname`, `cphone`, `staff`) VALUES
(1, '2025-02-25 17:38:21', 'BET-00001', 20000, 0, 20000, 'POS', 0, 0, 'Customer', '07033', ''),
(2, '2025-02-25 17:52:19', 'BET-00002', 30000, 0, 30000, 'Cash', 0, 0, 'Customer', '07033', ''),
(3, '2025-02-25 18:09:13', 'BET-00003', 8500, 0, 8500, 'Bank Transfer', 0, 0, 'Customer', '07033', ''),
(4, '2025-02-26 15:32:48', 'BET-00004', 14000, 0, 14000, 'Bank Transfer', 0, 0, 'Customer', '07033', ''),
(5, '2025-02-26 15:49:28', 'BET-00005', 102000, 0, 102000, 'POS', 0, 0, 'Customer', '07033', ''),
(6, '2025-02-26 16:34:06', 'BET-00006', 44000, 0, 44000, 'Bank Transfer', 0, 0, 'Customer', '07033', ''),
(7, '2025-02-26 18:19:26', 'BET-00007', 6000, 0, 6000, 'Bank Transfer', 0, 0, 'Customer', '07033', ''),
(8, '2025-02-26 18:34:09', 'BET-00008', 8000, 0, 8000, 'Bank Transfer', 0, 0, 'Customer', '07033', ''),
(9, '2025-02-26 20:00:54', 'BET-00009', 10000, 0, 10000, 'Bank Transfer', 0, 0, 'Customer', '07033', ''),
(10, '2025-02-26 20:05:51', 'BET-000010', 143500, 0, 143500, 'POS', 0, 0, 'Customer', '07033', ''),
(11, '2026-04-26 20:48:02', 'BET-6000011', 16000, 0, 16000, 'Cash', 0, 0, 'Customer', '07033', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `staffposition`
--

CREATE TABLE `staffposition` (
  `posid` int(11) NOT NULL,
  `posname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staffposition`
--

INSERT INTO `staffposition` (`posid`, `posname`) VALUES
(1, 'Super Admin'),
(2, 'Staff Admin');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `sid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pcode` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `stockprice` int(100) NOT NULL,
  `totalcost` int(100) NOT NULL,
  `transcode` varchar(100) NOT NULL,
  `purchasedate` datetime NOT NULL,
  `updatedby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `position` varchar(100) NOT NULL,
  `permission` int(11) NOT NULL,
  `ban` int(11) NOT NULL,
  `reset_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `fullname`, `phone`, `email`, `position`, `permission`, `ban`, `reset_key`) VALUES
(10, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', '07034597401', 'admin@test.com', 'Super Admin', 3, 0, 'k9t1p48s'),
(11, 'staff', '10176e7b7b24d317acfcf8d2064cfd2f24e154f7b5a96603077d5ef813d6a6b6', 'staff', '07034597401', 'staff@test.com', 'Staff Admin', 2, 0, 'cw4inftn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleid`);

--
-- Indexes for table `salesummary`
--
ALTER TABLE `salesummary`
  ADD PRIMARY KEY (`sumid`);

--
-- Indexes for table `staffposition`
--
ALTER TABLE `staffposition`
  ADD PRIMARY KEY (`posid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `saleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `salesummary`
--
ALTER TABLE `salesummary`
  MODIFY `sumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staffposition`
--
ALTER TABLE `staffposition`
  MODIFY `posid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

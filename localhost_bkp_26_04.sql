-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2020 at 03:51 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dateout`
--
CREATE DATABASE IF NOT EXISTS `dateout` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dateout`;

-- --------------------------------------------------------

--
-- Table structure for table `active_pages`
--

CREATE TABLE `active_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_pages`
--

INSERT INTO `active_pages` (`id`, `name`, `enabled`) VALUES
(1, 'blog', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `bic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `image`, `url`, `priority`, `time`) VALUES
(1, '25d49cef-0b38-438c-acbd-250ec7d2cf1f.jpg', 'Testing_backend_1', 0, 1586235988),
(2, '73482705_599784830559389_8348354965206466560_o.jpg', 'Testing_part_2', 0, 1586236150),
(3, 'Lighthouse2.jpg', 'ee_3', 1, 1587817966),
(4, '', 'Title_4', 1, 1587911472);

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `title`, `description`, `abbr`, `for_id`) VALUES
(1, 'Testing backend', '<p>Test it out</p>\r\n', 'bg', 1),
(2, 'Testing backend', '<p>Test i it out</p>\r\n', 'en', 1),
(3, 'Testing backend', '', 'gr', 1),
(4, '', '', 'bg', 2),
(5, 'Testing part 2', '<p>Testing part 2</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'en', 2),
(6, '', '', 'gr', 2),
(7, '', '', 'bg', 3),
(8, 'ee', '<p>ee</p>\r\n', 'en', 3),
(9, '', '', 'gr', 3),
(10, '', '', 'bg', 4),
(11, 'Title', '<!DOCTYPE html>\r\n<html>\r\n<title>W3.CSS Template</title>\r\n<meta charset=\"UTF-8\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">\r\n<style>\r\nbody {font-family: \"Times New Roman\", Georgia, Serif;}\r\nh1, h2, h3, h4, h5, h6 {\r\n  font-family: \"Playfair Display\";\r\n  letter-spacing: 5px;\r\n}\r\n</style>\r\n<body>\r\n\r\n<!-- Navbar (sit on top) -->\r\n<div class=\"w3-top\">\r\n  <div class=\"w3-bar w3-white w3-padding w3-card\" style=\"letter-spacing:4px;\">\r\n    <a href=\"#home\" class=\"w3-bar-item w3-button\">Gourmet au Catering</a>\r\n    <!-- Right-sided navbar links. Hide them on small screens -->\r\n    <div class=\"w3-right w3-hide-small\">\r\n      <a href=\"#about\" class=\"w3-bar-item w3-button\">About</a>\r\n      <a href=\"#menu\" class=\"w3-bar-item w3-button\">Menu</a>\r\n      <a href=\"#contact\" class=\"w3-bar-item w3-button\">Contact</a>\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n<!-- Header -->\r\n<header class=\"w3-display-container w3-content w3-wide\" style=\"max-width:1600px;min-width:500px\" id=\"home\">\r\n  <img class=\"w3-image\" src=\"/w3images/hamburger.jpg\" alt=\"Hamburger Catering\" width=\"1600\" height=\"800\">\r\n  <div class=\"w3-display-bottomleft w3-padding-large w3-opacity\">\r\n    <h1 class=\"w3-xxlarge\">Le Catering</h1>\r\n  </div>\r\n</header>\r\n\r\n<!-- Page content -->\r\n<div class=\"w3-content\" style=\"max-width:1100px\">\r\n\r\n  <!-- About Section -->\r\n  <div class=\"w3-row w3-padding-64\" id=\"about\">\r\n    <div class=\"w3-col m6 w3-padding-large w3-hide-small\">\r\n     <img src=\"/w3images/tablesetting2.jpg\" class=\"w3-round w3-image w3-opacity-min\" alt=\"Table Setting\" width=\"600\" height=\"750\">\r\n    </div>\r\n\r\n    <div class=\"w3-col m6 w3-padding-large\">\r\n      <h1 class=\"w3-center\">About Catering</h1><br>\r\n      <h5 class=\"w3-center\">Tradition since 1889</h5>\r\n      <p class=\"w3-large\">The Catering was founded in blabla by Mr. Smith in lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute iruredolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.We only use <span class=\"w3-tag w3-light-grey\">seasonal</span> ingredients.</p>\r\n      <p class=\"w3-large w3-text-grey w3-hide-medium\">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod temporincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n    </div>\r\n  </div>\r\n  \r\n  <hr>\r\n  \r\n  <!-- Menu Section -->\r\n  <div class=\"w3-row w3-padding-64\" id=\"menu\">\r\n    <div class=\"w3-col l6 w3-padding-large\">\r\n      <h1 class=\"w3-center\">Our Menu</h1><br>\r\n      <h4>Bread Basket</h4>\r\n      <p class=\"w3-text-grey\">Assortment of fresh baked fruit breads and muffins 5.50</p><br>\r\n    \r\n      <h4>Honey Almond Granola with Fruits</h4>\r\n      <p class=\"w3-text-grey\">Natural cereal of honey toasted oats, raisins, almonds and dates 7.00</p><br>\r\n    \r\n      <h4>Belgian Waffle</h4>\r\n      <p class=\"w3-text-grey\">Vanilla flavored batter with malted flour 7.50</p><br>\r\n    \r\n      <h4>Scrambled eggs</h4>\r\n      <p class=\"w3-text-grey\">Scrambled eggs, roasted red pepper and garlic, with green onions 7.50</p><br>\r\n    \r\n      <h4>Blueberry Pancakes</h4>\r\n      <p class=\"w3-text-grey\">With syrup, butter and lots of berries 8.50</p>    \r\n    </div>\r\n    \r\n    <div class=\"w3-col l6 w3-padding-large\">\r\n      <img src=\"/w3images/tablesetting.jpg\" class=\"w3-round w3-image w3-opacity-min\" alt=\"Menu\" style=\"width:100%\">\r\n    </div>\r\n  </div>\r\n\r\n  <hr>\r\n\r\n  <!-- Contact Section -->\r\n  <div class=\"w3-container w3-padding-64\" id=\"contact\">\r\n    <h1>Contact</h1><br>\r\n    <p>We offer full-service catering for any event, large or small. We understand your needs and we will cater the food to satisfy the biggerst criteria of them all, both look and taste. Do not hesitate to contact us.</p>\r\n    <p class=\"w3-text-blue-grey w3-large\"><b>Catering Service, 42nd Living St, 43043 New York, NY</b></p>\r\n    <p>You can also contact us by phone 00553123-2323 or email catering@catering.com, or you can send us a message here:</p>\r\n    <form action=\"/action_page.php\" target=\"_blank\">\r\n      <p><input class=\"w3-input w3-padding-16\" type=\"text\" placeholder=\"Name\" required name=\"Name\"></p>\r\n      <p><input class=\"w3-input w3-padding-16\" type=\"number\" placeholder=\"How many people\" required name=\"People\"></p>\r\n      <p><input class=\"w3-input w3-padding-16\" type=\"datetime-local\" placeholder=\"Date and time\" required name=\"date\" value=\"2017-11-16T20:00\"></p>\r\n      <p><input class=\"w3-input w3-padding-16\" type=\"text\" placeholder=\"Message \\ Special requirements\" required name=\"Message\"></p>\r\n      <p><button class=\"w3-button w3-light-grey w3-section\" type=\"submit\">SEND MESSAGE</button></p>\r\n    </form>\r\n  </div>\r\n  \r\n<!-- End page content -->\r\n</div>\r\n\r\n<!-- Footer -->\r\n<footer class=\"w3-center w3-light-grey w3-padding-32\">\r\n  <p>Powered by <a href=\"https://www.w3schools.com/w3css/default.asp\" title=\"W3.CSS\" target=\"_blank\" class=\"w3-hover-text-green\">w3.css</a></p>\r\n</footer>\r\n\r\n</body>\r\n</html>\r\n', 'en', 4),
(12, '', '', 'gr', 4);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `key_name` text NOT NULL,
  `value` text NOT NULL,
  `abbr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `type`, `key_name`, `value`, `abbr`) VALUES
(1, 'explore', 'top_experience', 'Top Experience', 'en'),
(2, 'explore', 'popular_destination', 'Popular Destination', 'en'),
(3, 'explore', 'article', 'Top article', 'en'),
(4, 'explore', 'credit', 'Credit Rewards', 'en'),
(5, 'explore', 'redeem', 'Only for you', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_links`
--

CREATE TABLE `confirm_links` (
  `id` int(11) NOT NULL,
  `link` char(32) NOT NULL,
  `for_order` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law`
--

CREATE TABLE `cookie_law` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law_translations`
--

CREATE TABLE `cookie_law_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `learn_more` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `valid_from_date` int(10) UNSIGNED NOT NULL,
  `valid_to_date` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-enabled, 0-disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `explore`
--

CREATE TABLE `explore` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `credit_url` text NOT NULL,
  `credit_image` text NOT NULL,
  `abbr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `explore`
--

INSERT INTO `explore` (`id`, `title`, `message`, `credit_url`, `credit_image`, `abbr`) VALUES
(6, 'Hey Yuen', '                                                                                                                                                Let\'s experience Singapore.\r\n                                                                                                                                            ', 'https://www.dateout.co/rewards', 'image_rewards_Explore.jpg', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `explore_image`
--

CREATE TABLE `explore_image` (
  `id` int(11) NOT NULL,
  `explore_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `explore_image`
--

INSERT INTO `explore_image` (`id`, `explore_id`, `image`) VALUES
(26, 6, 'Image_cover_explore.jpg'),
(27, 6, 'image_deal7_explore.jpg'),
(28, 6, 'image_deal3_explore.jpg'),
(29, 6, 'image_deal6_explore.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `currencyKey` varchar(5) NOT NULL,
  `flag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `name`, `currency`, `currencyKey`, `flag`) VALUES
(1, 'bg', 'bulgarian', 'лв', 'BGN', 'bg.jpg'),
(2, 'en', 'english', '$', 'USD', 'en.jpg'),
(3, 'gr', 'greece', 'EUR', 'EUR', 'gr.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'point to public_users ID',
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'viewed status is change when change processed status',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `discount_code` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_clients`
--

CREATE TABLE `orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `experience_id` int(10) UNSIGNED DEFAULT NULL,
  `credit_point_for_review` int(10) UNSIGNED DEFAULT NULL,
  `credit_point_for_booking` int(10) UNSIGNED DEFAULT NULL,
  `is_point_on_booking` text NOT NULL,
  `deduct_max_points_on_booking` int(10) UNSIGNED NOT NULL,
  `number_of_booking_available` int(10) UNSIGNED NOT NULL,
  `cancellation_policy` text NOT NULL,
  `how_to_redeem_offer` text NOT NULL,
  `duration` text NOT NULL,
  `confirmation` text NOT NULL,
  `ticket_type` text NOT NULL,
  `meeting_place` text NOT NULL,
  `experience_type` text NOT NULL,
  `ticket_collection` text NOT NULL,
  `discount_available` text NOT NULL,
  `package_available_type` text NOT NULL,
  `specific_day` text,
  `available_date` text,
  `slot_time` text,
  `total_slot` text,
  `person_per_slot` text,
  `time` int(11) NOT NULL,
  `time_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packages_translations`
--

CREATE TABLE `packages_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `before_booking` text NOT NULL,
  `after_booking` longtext NOT NULL,
  `cancellation_summary` longtext NOT NULL,
  `price_adult` varchar(20) NOT NULL,
  `price_child` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_review_images`
--

CREATE TABLE `product_review_images` (
  `id` int(11) NOT NULL,
  `product_review_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_review_images`
--

INSERT INTO `product_review_images` (`id`, `product_review_id`, `image`) VALUES
(13, 2, 'Desert3.jpg'),
(14, 2, 'Hydrangeas3.jpg'),
(15, 3, 'Chrysanthemum4.jpg'),
(16, 3, 'Desert4.jpg'),
(17, 3, 'Hydrangeas4.jpg'),
(18, 4, 'Chrysanthemum3.jpg'),
(19, 4, 'Desert4.jpg'),
(21, 4, 'Desert5.jpg'),
(22, 2, 'Koala.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `title`, `rating`, `comment`, `status`, `created_at`, `updated_at`, `product_id`, `customer_id`) VALUES
(2, 'The deal was good.', 4, '                        The deal was good.                    ', '', '0000-00-00 00:00:00', NULL, 2, 1),
(3, 'The deal was good', 4, 'The deal was good....', '', '0000-00-00 00:00:00', NULL, 2, 1),
(4, 'Test', 4, '                        Test                    ', '', '0000-00-00 00:00:00', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_shop_categorie_mapping`
--

CREATE TABLE `product_shop_categorie_mapping` (
  `product_shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shop_categorie_id` int(11) NOT NULL,
  `last_updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder` int(10) UNSIGNED DEFAULT NULL COMMENT 'folder with images',
  `expectation_folder` text NOT NULL COMMENT 'expectation_folder',
  `image` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time created',
  `time_update` int(10) UNSIGNED NOT NULL COMMENT 'time updated',
  `visibility` tinyint(1) NOT NULL DEFAULT '0',
  `shop_categorie` int(11) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `country` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `metaword` int(11) NOT NULL,
  `procurement` int(10) UNSIGNED NOT NULL,
  `in_slider` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `virtual_products` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand_id` int(5) DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `folder`, `expectation_folder`, `image`, `time`, `time_update`, `visibility`, `shop_categorie`, `discount_percent`, `latitude`, `longitude`, `country`, `city`, `metaword`, `procurement`, `in_slider`, `url`, `virtual_products`, `brand_id`, `position`, `vendor_id`) VALUES
(2, 1583594102, '', '', 1583594723, 0, 1, 2, 0, '', '', 0, 0, 0, 0, 0, '_2', NULL, NULL, 0, 0),
(3, 1584254749, '', 'Chrysanthemum2.jpg', 1584254873, 1584960193, 1, 8, 0, '', '', 0, 0, 0, 0, 0, 'Demo_3', NULL, NULL, 1, 0),
(4, 1584960619, '1584960619_s', 'Chrysanthemum3.jpg', 1584960763, 0, 0, 2, 0, '', '', 0, 0, 0, 0, 0, 'Prod_4', NULL, NULL, 1, 0),
(5, 1584963915, '1584963915_s', 'Lighthouse1.jpg', 1584964064, 0, 0, 6, 0, '', '', 0, 0, 0, 0, 0, 'Test_5', NULL, NULL, 1, 2),
(6, 1584964727, '1584964727_s', 'Penguins.jpg', 1584964947, 1584965062, 0, 3, 0, '', '', 0, 0, 0, 0, 0, 'Test_6', NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products_expectation`
--

CREATE TABLE `products_expectation` (
  `id` int(11) NOT NULL,
  `expectation_folder` text NOT NULL,
  `image` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products_translations`
--

CREATE TABLE `products_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `expectation` longtext NOT NULL,
  `price` varchar(20) NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_translations`
--

INSERT INTO `products_translations` (`id`, `title`, `description`, `basic_description`, `expectation`, `price`, `old_price`, `abbr`, `for_id`) VALUES
(4, '', '', '', '', '', '', 'bg', 2),
(5, '', '<p><span style=\"font-size:20px;\"><strong>Know Before booking</strong></span></p>\r\n\r\n<p><span style=\"font-size:17px;\">Confirmation Process</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:14px;\">test1</span></li>\r\n	<li><span style=\"font-size:14px;\">test2</span></li>\r\n	<li><span style=\"font-size:14px;\">test3</span></li>\r\n</ul>\r\n', '', '', '', '', 'en', 2),
(6, '', '', '', '', '', '', 'gr', 2),
(7, '', '', '', '', '', '', 'bg', 3),
(8, 'Demo', '<p><span style=\"font-size:16px;\"><strong>Version 2</strong></span></p>\r\n\r\n<p><em>Our Spa getaway package includes:</em></p>\r\n\r\n<ul>\r\n	<li><em>Two-night accommodation</em></li>\r\n	<li><em>Two 50-minute spa treatment of your choice</em></li>\r\n	<li><em>An in-room breakfast for two</em></li>\r\n	<li><em>Gift basket upon arrival</em></li>\r\n</ul>\r\n', '<p>Demo1</p>\r\n', '<p>Demo1</p>\r\n', '150', '180', 'en', 3),
(9, '', '', '', '', '', '', 'gr', 3),
(10, '', '', '', '', '', '', 'bg', 4),
(11, 'Prod 1', '<p>Prod 1</p>\r\n', '<p>Prod 1</p>\r\n', '<p>Prod 1</p>\r\n', '100', '80', 'en', 4),
(12, '', '', '', '', '', '', 'gr', 4),
(16, '', '', '', '', '', '', 'bg', 6),
(17, 'Deal demo', '<p>Test</p>\r\n', '<p>test</p>\r\n', '<p>Test</p>\r\n', '231', '251', 'en', 6),
(18, '', '', '', '', '', '', 'gr', 6);

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `name`) VALUES
(1, 'home'),
(2, 'checkout'),
(3, 'contacts'),
(4, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages_translations`
--

CREATE TABLE `seo_pages_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `page_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_for` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `categorie_image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `sub_for`, `position`, `categorie_image`) VALUES
(3, 0, 0, ''),
(2, 0, 0, ''),
(4, 0, 0, ''),
(5, 0, 0, ''),
(6, 0, 0, ''),
(7, 0, 0, ''),
(8, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories_translations`
--

CREATE TABLE `shop_categories_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_categories_translations`
--

INSERT INTO `shop_categories_translations` (`id`, `name`, `abbr`, `for_id`) VALUES
(4, '', 'bg', 2),
(5, 'Workshops', 'en', 2),
(6, '', 'gr', 2),
(7, '', 'bg', 3),
(8, 'Sports & Adventures', 'en', 3),
(9, '', 'gr', 3),
(10, '', 'bg', 4),
(11, 'Flowers', 'en', 4),
(12, '', 'gr', 4),
(13, '', 'bg', 5),
(14, 'Personalized Gifts', 'en', 5),
(15, '', 'gr', 5),
(16, '', 'bg', 6),
(17, 'Latest', 'en', 6),
(18, '', 'gr', 6),
(19, '', 'bg', 7),
(20, 'Wellness', 'en', 7),
(21, '', 'gr', 7),
(22, '', 'bg', 8),
(23, 'Demo Category', 'en', 8),
(24, '', 'gr', 8);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `textual_pages_tanslations`
--

CREATE TABLE `textual_pages_tanslations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'notifications by email',
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `notify`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'your@email.com', 0, 1587911175);

-- --------------------------------------------------------

--
-- Table structure for table `users_public`
--

CREATE TABLE `users_public` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `value_store`
--

CREATE TABLE `value_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `thekey` varchar(50) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `value_store`
--

INSERT INTO `value_store` (`id`, `thekey`, `value`) VALUES
(1, 'sitelogo', 'NewLogo.jpg'),
(2, 'navitext', ''),
(3, 'footercopyright', ''),
(4, 'contactspage', 'Hello dear client'),
(5, 'footerContactAddr', ''),
(6, 'footerContactEmail', 'support@shop.dev'),
(7, 'footerContactPhone', ''),
(8, 'googleMaps', '42.671840, 83.279163'),
(9, 'footerAboutUs', ''),
(10, 'footerSocialFacebook', ''),
(11, 'footerSocialTwitter', ''),
(12, 'footerSocialGooglePlus', ''),
(13, 'footerSocialPinterest', ''),
(14, 'footerSocialYoutube', ''),
(16, 'contactsEmailTo', 'contacts@shop.dev'),
(17, 'shippingOrder', '1'),
(18, 'addJs', ''),
(19, 'publicQuantity', '0'),
(20, 'paypal_email', ''),
(21, 'paypal_sandbox', '0'),
(22, 'publicDateAdded', '0'),
(23, 'googleApi', ''),
(24, 'template', 'greenlabel'),
(25, 'cashondelivery_visibility', '1'),
(26, 'showBrands', '0'),
(27, 'showInSlider', '0'),
(28, 'codeDiscounts', '1'),
(29, 'virtualProducts', '0'),
(30, 'multiVendor', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `url`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, NULL, '', 'cshelake7@gmail.com', '$2y$10$9QUAOCVbAggPOtW5yBahI.74emNMPp8NcoaeCZZz0Mq.CzE5eRFiC', '2020-03-01 12:02:31', '2020-03-01 12:02:31'),
(2, 'Indrajit Auddy', 'Spain', 'indrajit.auddy27@gmail.com', '$2y$10$DezVVD8rY6bEJrUINEsMN.t0UN94nncsyWW8vqI.bFWL/1zYIToWu', '2020-03-23 11:41:45', '2020-03-23 11:41:45'),
(3, NULL, '', 'Kapil@silverwingsxr.com', '$2y$10$oOYXYqKhx89NTGyoPFTo2eOmU2mAeBxcxt.NMR7hESZ8HzKxun3FW', '2020-03-30 05:44:57', '2020-03-30 05:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders`
--

CREATE TABLE `vendors_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `discount_code` varchar(20) NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders_clients`
--

CREATE TABLE `vendors_orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_pages`
--
ALTER TABLE `active_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_links`
--
ALTER TABLE `confirm_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law`
--
ALTER TABLE `cookie_law`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`abbr`,`for_id`) USING BTREE;

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `explore`
--
ALTER TABLE `explore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `explore_image`
--
ALTER TABLE `explore_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_clients`
--
ALTER TABLE `orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review_images`
--
ALTER TABLE `product_review_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_public`
--
ALTER TABLE `users_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_store`
--
ALTER TABLE `value_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`thekey`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_pages`
--
ALTER TABLE `active_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `confirm_links`
--
ALTER TABLE `confirm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cookie_law`
--
ALTER TABLE `cookie_law`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `explore`
--
ALTER TABLE `explore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `explore_image`
--
ALTER TABLE `explore_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders_clients`
--
ALTER TABLE `orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_review_images`
--
ALTER TABLE `product_review_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `subscribed`
--
ALTER TABLE `subscribed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_public`
--
ALTER TABLE `users_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `value_store`
--
ALTER TABLE `value_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

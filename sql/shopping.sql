-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 02:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `status`) VALUES
(1, 25, 0),
(2, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`) VALUES
(0, 'General Goods', 'Goods that don\'t fit into any specialized categories.'),
(1, 'Electronics', 'Electronic devices, peripherals, and related content.'),
(2, 'Camping Gear', 'All goods related to camping.'),
(3, 'Board Games', 'Non-electronic games to play at home or on the go. All tabletop games are included from card games to board games.'),
(4, 'Sports', 'Athletic and sports gear for being active and playing outside.'),
(5, 'Books', 'Physical books of all varieties and genres.');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`cart_id`, `item_id`, `quantity`) VALUES
(1, 4, 3),
(1, 2, 5),
(1, 3, 10),
(1, 5, 16);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `stock` int(12) NOT NULL,
  `description` varchar(512) NOT NULL,
  `name` varchar(64) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `cost`, `stock`, `description`, `name`, `category_id`) VALUES
(2, '500.00', 37, 'This wonderful family-sized tent can fit up to eight people cozily inside! Perfect for casual trips out into nature with the whole family.', 'Family Tent', 2),
(3, '13.00', 500, '10 years ago, after “the Gate” that connected the real world with the monster world opened, some of the ordinary, everyday people received the power to hunt monsters within the Gate. They are known as \"Hunters\". However, not all Hunters are powerful. My name is Sung Jin-Woo, an E-rank Hunter. I\'m someone who has to risk his life in the lowliest of dungeons, the \"World\'s Weakest\". Having no skills whatsoever to display, I barely earned the required money by fighting in low-leveled dungeons…', 'Solo Leveling Vol. 1', 5),
(4, '1344.00', 135, 'Edited', 'Edited Product', 1),
(5, '14.99', 133, 'A nice size 5 padded soccer ball.', 'Soccer Ball', 4),
(6, '1337.00', 9001, 'It\'s just so super special awesome that I\'m not sure how to properly describe it. And it doesn\'t even cost half as much as I thought it would, either. I just don\'t know what\'s up with this.', 'Super Special Awesome Secret Mega Product', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `ZIP` varchar(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `clearance` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `email`, `address`, `city`, `state`, `ZIP`, `password`, `clearance`) VALUES
(1, 'Quinn', 'Hanlon', 'quinn1', 'quinn.hanlon@gmail.com', '5131 NE Heart Lane', 'Vancouver', 'Washington', '98664-6543', '', 0),
(8, 'Quinn', 'Hanlon', 'quinn', 'quinn.hanl@gmail.com', '5131 NE Heart Lane', 'Vancouver', 'Washington', '98664-6543', '', 0),
(11, 'Quinn', 'Hanlon', 'quin', 'quinn.han@gmail.com', '5131 NE Heart Lane', 'Vancouver', 'Washington', '98664-6543', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', 0),
(14, 'Quinn', 'Hanlon', 'quinnn', 'quinn.hannn@gmail.com', '5131 NE Heart Lane', 'Vancouver', 'Washington', '98664-6543', '38a5988196b62e65a9f40df368171e97be98dcfd537e1719defdcae87fa8845c70b30175b025df962dedce4a2f90350571dc774da7b043a6c73011894282cb06', 0),
(24, 'Steve', 'Stevenson', 'steve', 'steve@ste.ve', 'Steve\'s House', 'Steveville', 'Steveland', 'Steve', '9c34c004fc342112de3e5c25a0a3b127aeb9d8f1a691d224ad10bf1f4b25936d0857cd26495c185284aacee5108245de7916e55279337e33f6cd5898e4f2dc8b', 1),
(25, 'Shawn', 'Spencer', 'shawn', 'shawnspencer@gmail.com', 'Shawn', 'Shawn', 'Shawn', '39482', '73941847d9611927275d93139981ee78316de50bc51bf398f8ccdd778c7723f370cb252c5293c085ec3c6a3d185246837ed71d651a679cb680793581ad77ac24', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 05:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `created_at`, `email`, `register_date`, `phone_number`, `membership_id`, `staff_id`) VALUES
(1, 'yongch', '$2y$10$GBupIpsDgcYCLXhULt.VKO4fEwg2MffQarZWaj4FK4DWP0exyizHy', '2023-08-19 20:20:35', NULL, NULL, NULL, NULL, NULL),
(2, '', '$2y$10$4jEx6d7gT1q81PA.E1jfzu7e0E3iBDxjKyQ4nLcbUmpCuVPS5n5ie', '2023-08-19 20:32:42', 'yong123456@gmail.com', NULL, '0123456789', NULL, NULL),
(3, '', '$2y$10$iEd896Jx8lD2VWxNJ3SkZO8GHK.c/usEUdmQUycRZizOfvduTyAgO', '2023-08-19 20:33:38', 'yong0123456789@gmial.com', NULL, '0123456789', NULL, NULL),
(4, 'lai', '$2y$10$6FW1GEXdwIU3U.4e5zgdeOhyivFh9kYf0GiFFq5s0rCRxiPD7dIve', '2023-08-20 11:16:01', 'lai123456@gmail.com', NULL, '99999999999999', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `bill_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `bill_item_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `item_id` varchar(6) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `item_id` varchar(6) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `item_category` varchar(255) DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`item_id`, `item_name`, `item_type`, `item_category`, `item_price`, `item_description`) VALUES
('B1', 'Tiger bottle', 'Beer', 'Drinks', 17.00, 'per bottle'),
('B10', 'Carlsberg bucket', 'Beer', 'Drinks', 54.00, 'per bucket with 4 bottles'),
('B11', 'Somersby bottle', 'Beer', 'Drinks', 18.00, 'per bottle'),
('B12', 'Somersby bucket', 'Beer', 'Drinks', 59.00, 'per bucket with 4 bottles'),
('B2', 'Tiger bucket', 'Beer', 'Drinks', 55.00, 'per bucket with 4 bottles'),
('B3', 'Guinness Stout bottle', 'Beer', 'Drinks', 18.00, 'per bottle'),
('B4', 'Guinness Stout bucket', 'Beer', 'Drinks', 59.00, 'per bucket with 4 bottles'),
('B5', 'Heineken bottle', 'Beer', 'Drinks', 18.00, 'per bottle'),
('B6', 'Heineken bucket', 'Beer', 'Drinks', 59.00, 'per bucket with 4 bottles'),
('B7', 'Blanc 1664 bottle', 'Beer', 'Drinks', 19.00, 'per bottle'),
('B8', 'Blanc 1664 bucket', 'Beer', 'Drinks', 60.00, 'per bucket with 4 bottles'),
('B9', 'Carlsberg bottle', 'Beer', 'Drinks', 16.00, 'per bottle'),
('C1', 'Kamikaze', 'Classic Cocktails', 'Drinks', 28.00, 'cocktails'),
('C10', 'Tequila Pop', 'Classic Cocktails', 'Drinks', 26.00, 'cocktails'),
('C11', 'Tequila Sunrise', 'Classic Cocktails', 'Drinks', 26.00, 'cocktails'),
('C12', 'Black Russian', 'Classic Cocktails', 'Drinks', 28.00, 'cocktails'),
('C13', 'White Russian', 'Classic Cocktails', 'Drinks', 28.00, 'cocktails'),
('C14', 'Daiquiri', 'Classic Cocktails', 'Drinks', 28.00, 'Strawberry, Lychee, Mango, Lemon'),
('C2', 'Singapore Sling', 'Classic Cocktails', 'Drinks', 29.00, 'cocktails'),
('C3', 'Long Island Iced Tea', 'Classic Cocktails', 'Drinks', 29.00, 'cocktails'),
('C4', 'Lady on the Beach', 'Classic Cocktails', 'Drinks', 29.00, 'cocktails'),
('C5', 'Margarita', 'Classic Cocktails', 'Drinks', 29.00, 'cocktails'),
('C6', 'Pina Colada', 'Classic Cocktails', 'Drinks', 26.00, 'cocktails'),
('C7', 'Mojito', 'Classic Cocktails', 'Drinks', 29.00, 'cocktails'),
('C8', 'Blue Lagoon', 'Classic Cocktails', 'Drinks', 28.00, 'cocktails'),
('C9', 'Cosmopolitan', 'Classic Cocktails', 'Drinks', 28.00, 'cocktails'),
('CC1', 'Americano Hot ', 'Coffee & Chocolate', 'Drinks', 8.00, 'hot'),
('CC10', 'Chocolate Cold', 'Coffee & Chocolate', 'Drinks', 14.00, 'cold'),
('CC2', 'Americano Cold ', 'Coffee & Chocolate', 'Drinks', 11.00, 'cold'),
('CC3', 'Cappuccino Hot ', 'Coffee & Chocolate', 'Drinks', 11.00, 'hot'),
('CC4', 'Cappuccino Cold', 'Coffee & Chocolate', 'Drinks', 14.00, 'cold'),
('CC5', 'Latte Hot ', 'Coffee & Chocolate', 'Drinks', 11.00, 'hot'),
('CC6', 'Latte Cold', 'Coffee & Chocolate', 'Drinks', 14.00, 'cold'),
('CC7', 'Mocha Hot ', 'Coffee & Chocolate', 'Drinks', 12.00, 'hot'),
('CC8', 'Mocha Cold', 'Coffee & Chocolate', 'Drinks', 15.00, 'cold'),
('CC9', ' Chocolate Hot', 'Coffee & Chocolate', 'Drinks', 11.00, 'hot'),
('CJ1', 'Orange', 'Chilled Juice', 'Drinks', 8.00, 'fresh juice'),
('CJ2', 'Pineapple', 'Chilled Juice', 'Drinks', 8.00, 'fresh juice'),
('CJ3', 'Mango', 'Chilled Juice', 'Drinks', 8.00, 'fresh juice'),
('CJ4', 'Guava', 'Chilled Juice', 'Drinks', 8.00, 'fresh juice'),
('CP1', 'Green Apple', 'Cold Pressed Juice', 'Drinks', 15.00, 'fresh pressed juice'),
('CP2', 'Orange', 'Cold Pressed Juice', 'Drinks', 15.00, 'fresh pressed juice'),
('CP3', 'Carrot', 'Cold Pressed Juice', 'Drinks', 15.00, 'fresh pressed juice'),
('CP4', 'Watermelon', 'Cold Pressed Juice', 'Drinks', 13.00, 'fresh pressed juice'),
('CP5', 'Pineapple', 'Cold Pressed Juice', 'Drinks', 13.00, 'fresh pressed juice'),
('CP6', 'Lime', 'Cold Pressed Juice', 'Drinks', 10.00, 'fresh pressed juice'),
('CP7', 'Lemon', 'Cold Pressed Juice', 'Drinks', 10.00, 'fresh pressed juice'),
('CS1', 'Coke', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS2', 'Root Beer', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS3', '100 Plus', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS4', 'Ginger Ale', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS5', 'Sprite', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS6', 'Soda Water', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS7', 'Tonic Water', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('CS8', 'Mineral Water', 'Canned Soda', 'Drinks', 5.00, 'per can'),
('FB1', 'Passion Fruit', 'Fruity Ice Blended', 'Drinks', 15.00, 'ice blended juice'),
('FB2', 'Mango', 'Fruity Ice Blended', 'Drinks', 15.00, 'ice blended juice'),
('FB3', 'Kiwi', 'Fruity Ice Blended', 'Drinks', 15.00, 'ice blended juice'),
('FF1', 'Watermelon', 'Frozen Fruit Yogurt', 'Drinks', 13.00, 'fresh fruit yogurt'),
('FF2', 'Pineapple', 'Frozen Fruit Yogurt', 'Drinks', 13.00, 'fresh fruit yogurt'),
('FT1', 'Soothing Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT10', 'Peach Fruit Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT11', 'Blueberry Fruit Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT12', 'Blueberry Fruit Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT13', 'Chamomile Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT14', 'Chamomile Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT15', 'Pink Rose Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT16', 'Pink Rose Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT17', 'Jasmine Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT18', 'Jasmine Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT19', 'Lemongrass Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT2', 'Soothing Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT20', 'Lemongrass Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT3', 'Refreshing Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT4', 'Refreshing Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT5', 'Metabolism Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT6', 'Metabolism Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT7', 'Lemon Digestive Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('FT8', 'Lemon Digestive Cold', 'Flower Tea', 'Drinks', 12.00, 'cold'),
('FT9', 'Peach Fruit Hot', 'Flower Tea', 'Drinks', 9.00, 'hot'),
('HC1', 'Shoney Iced Tea', 'House Cocktails', 'Drinks', 32.00, 'Gin.Rum'),
('HC2', 'Blue Lady', 'House Cocktails', 'Drinks', 30.00, 'Vodka'),
('HC3', 'Black Mambaa', 'House Cocktails', 'Drinks', 30.00, 'Vodka'),
('HC4', 'Lycheetini', 'House Cocktails', 'Drinks', 25.00, 'Vodka'),
('HC5', 'Chichi', 'House Cocktails', 'Drinks', 25.00, 'Vodka'),
('HD1', 'Brownies', 'House Dessert', 'Side Snacks', 15.00, 'delicious brownies'),
('HD2', 'American Cheese Cake', 'House Dessert', 'Side Snacks', 15.00, 'delicious cheese cake'),
('HD3', 'Pie of the Day', 'House Dessert', 'Side Snacks', 13.00, 'delicious served with vanilla ice cream'),
('HD4', 'Coated Ice Cream', 'House Dessert', 'Side Snacks', 12.00, 'delicious ice cream'),
('HD5', 'Messy Sundae', 'House Dessert', 'Side Snacks', 14.00, 'delicious brownies'),
('HD6', 'Ice Cream', 'House Dessert', 'Side Snacks', 5.00, 'per scoop choco,vanilla'),
('HP1', 'Whiskey', 'House Pour', 'Drinks', 20.00, 'per shot'),
('HP2', 'Gin', 'House Pour', 'Drinks', 20.00, 'per shot'),
('HP3', 'Vodka', 'House Pour', 'Drinks', 20.00, 'per shot'),
('HP4', 'Rum', 'House Pour', 'Drinks', 20.00, 'per shot'),
('HP5', 'Tequila', 'House Pour', 'Drinks', 18.00, 'per shot'),
('HP6', 'Cognac', 'House Pour', 'Drinks', 28.00, 'per shot'),
('HW1', 'Red Wine per bottle', 'House Wines', 'Drinks', 99.00, 'per bottle'),
('HW2', 'Red Wine per glass', 'House Wines', 'Drinks', 25.00, 'per glass'),
('HW3', 'White Wine per bottle', 'House Wines', 'Drinks', 99.00, 'per bottle'),
('HW4', 'White Wine per bottle', 'House Wines', 'Drinks', 25.00, 'per glass'),
('IT1', 'Lie Chi', 'Flavored Ice Tea', 'Drinks', 15.00, 'served with no ice'),
('IT2', 'Passion', 'Flavored Ice Tea', 'Drinks', 15.00, 'served with no ice'),
('IT3', 'Man-Go', 'Flavored Ice Tea', 'Drinks', 15.00, 'served with no ice'),
('IT4', 'Green Fruit', 'Flavored Ice Tea', 'Drinks', 15.00, 'served with no ice'),
('L1', 'Blended Scotch(Black Label)', 'Liquor', 'Drinks', 310.00, 'Johnny Walker Black Label Sherry 700ml'),
('L2', 'Blended Scotch(Gold Label)', 'Liquor', 'Drinks', 390.00, 'Johnny Walker Gold Label 750ml'),
('L3', 'American Whisky (Jack Daniel)', 'Liquor', 'Drinks', 290.00, '700ml'),
('L4', 'American Whisky (Jim Beam)', 'Liquor', 'Drinks', 270.00, '750ml'),
('L5', 'Single Malt', 'Liquor', 'Drinks', 360.00, 'Singleton Signature 700ml'),
('L6', 'Cognac', 'Liquor', 'Drinks', 390.00, 'Hennessy VSOP 700ml'),
('L7', 'Vodka', 'Liquor', 'Drinks', 195.00, 'Smirnoff Red 700ml'),
('L8', 'Tequila', 'Liquor', 'Drinks', 165.00, 'Jose Cuervo 750ml'),
('L9', 'Gin', 'Liquor', 'Drinks', 210.00, 'Gordon 700ml'),
('M1', 'Cool & Refreshing', 'Mocktails', 'Drinks', 16.00, 'Cucumber,peppermint,lemon'),
('M2', 'Virgin Apple Mojito', 'Mocktails', 'Drinks', 16.00, 'Green apple, mint leaf'),
('M3', 'Shirley Temple', 'Mocktails', 'Drinks', 16.00, 'Lemonade, grenadine'),
('M4', 'Purple Rain', 'Mocktails', 'Drinks', 16.00, 'Blackcurrant, strawberry'),
('M5', 'Silly Rose', 'Mocktails', 'Drinks', 16.00, 'Green Tea, lychee, rose'),
('M6', 'Incredible Green', 'Mocktails', 'Drinks', 16.00, 'Green apple, lemon, lime, soda'),
('M7', 'Charlie & The Chocolate Factory', 'Mocktails', 'Drinks', 18.00, 'Chocolate, cookies, peppermint'),
('M8', 'Blue Graciea', 'Mocktails', 'Drinks', 16.00, 'Passion fruit, blue lagoon'),
('MD1', 'Prime Rib Steak', 'Steak & Ribs', 'Main Dishes', 96.00, 'Delicious prime rib steak 300g'),
('MD10', 'Braised Lamb Shank', 'Lamb', 'Main Dishes', 52.00, 'delicious braised lamb shank'),
('MD11', 'Catch of the day', 'Seafood', 'Main Dishes', 46.00, 'fresh seafood'),
('MD12', 'Grilled Salmon', 'Seafood', 'Main Dishes', 48.00, 'fresh salmon'),
('MD13', 'Jambalaya', 'Seafood', 'Main Dishes', 28.00, 'delicious jambalaya'),
('MD14', 'Fish & Chips', 'Seafood', 'Main Dishes', 35.00, 'delicious fish & chips'),
('MD15', 'Classic Cheese Burger', 'Burgers & Sandwiches', 'Main Dishes', 30.00, 'delicious burger'),
('MD16', 'Hickory Burger', 'Burgers & Sandwiches', 'Main Dishes', 30.00, 'delicious burger'),
('MD17', 'Fried Chicken Burger', 'Burgers & Sandwiches', 'Main Dishes', 24.00, 'delicious burger'),
('MD18', 'Grilled Chicken Burger', 'Burgers & Sandwiches', 'Main Dishes', 24.00, 'delicious burger'),
('MD19', 'Chili Dog', 'Burgers & Sandwiches', 'Main Dishes', 25.00, 'delicious sandwich'),
('MD2', 'Sirloin Steak', 'Steak & Ribs', 'Main Dishes', 79.00, '230g'),
('MD20', 'Meatballs Sandwich', 'Burgers & Sandwiches', 'Main Dishes', 25.00, 'delicious sandwich'),
('MD21', 'Street Car', 'Burgers & Sandwiches', 'Main Dishes', 24.00, 'delicious sandwich'),
('MD22', 'Shrimp Po Boy', 'Burgers & Sandwiches', 'Main Dishes', 32.00, 'delicious sandwich'),
('MD23', 'Chicken Po Boy', 'Burgers & Sandwiches', 'Main Dishes', 28.00, 'delicious sandwich'),
('MD24', 'Chicken Tortilla', 'Burgers & Sandwiches', 'Main Dishes', 22.00, 'delicious sandwich'),
('MD25', 'Bolognese', 'Pasta', 'Main Dishes', 26.00, 'Spaghetti'),
('MD26', 'Meat Balls', 'Pasta', 'Main Dishes', 28.00, 'Spaghetti'),
('MD27', 'Carbonara', 'Pasta', 'Main Dishes', 28.00, 'Penne'),
('MD28', 'Chicken & Mushroom Aglio Olio', 'Pasta', 'Main Dishes', 28.00, 'Penne'),
('MD29', 'Chicken Arabiatta', 'Pasta', 'Main Dishes', 28.00, 'Spaghetti'),
('MD3', 'Ribeye Steak', 'Steak & Ribs', 'Main Dishes', 96.00, '230g'),
('MD30', 'Seafood Aglio Olio', 'Pasta', 'Main Dishes', 32.00, 'Spaghetti'),
('MD31', 'Shrimp', 'Pasta', 'Main Dishes', 32.00, 'Penne'),
('MD32', 'Italian Chicken', 'Pasta', 'Main Dishes', 30.00, 'Chef\'s Signature Pasta'),
('MD33', 'Braised Lamb Cutlet', 'Pasta', 'Main Dishes', 33.00, 'Chef\'s Signature Pasta'),
('MD34', 'Fries', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD35', 'Potato Wedges', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD36', 'Garden Salad', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD37', 'V.O.D', 'Side Dishes', 'Side Snacks', 9.00, 'delicious vegetables'),
('MD38', 'Wan Tan', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD39', 'Buttered Corn', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD4', 'BBQ Ribs', 'Steak & Ribs', 'Main Dishes', 59.00, ' delicious bbq ribs'),
('MD40', 'Coleslaw', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD41', 'Garlic Bread', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD42', 'Dirty Rice', 'Side Dishes', 'Side Snacks', 9.00, 'delicious'),
('MD5', 'Grilled Chicken ½ Bird', 'Chicken', 'Main Dishes', 33.00, '½ Bird'),
('MD6', 'Southern Fried Chicken ½ Bird', 'Chicken', 'Main Dishes', 33.00, '½ Bird'),
('MD7', 'Pan Seared Chicken', 'Chicken', 'Main Dishes', 28.00, 'delicious pan seared chicken'),
('MD8', 'Chicken Chop', 'Chicken', 'Main Dishes', 28.00, 'delicious chicken chop'),
('MD9', 'Grilled Lamb Chops', 'Lamb', 'Main Dishes', 48.00, 'delicious grilled lamb chop'),
('MS1', 'Classic MilkShakes', 'Milkshakes', 'Drinks', 13.00, 'vanilla or chocolate'),
('MS2', 'Milky Oreo', 'Milkshakes', 'Drinks', 15.00, 'vanilla ice cream,oreo'),
('S1', 'Buffalo Wings', 'Bar Bites', 'Side Snacks', 24.00, 'delicious buffalo wings'),
('S10', 'Shoney Salad', 'Salad', 'Side Snacks', 20.00, 'delicious salad'),
('S11', 'Soup of the day', 'Soup', 'Side Snacks', 14.00, 'delicious soup'),
('S12', 'Classic Cream of Mushroom', 'Soup', 'Side Snacks', 17.00, 'delicious mushroom soup'),
('S13', 'Seafood Tomato', 'Soup', 'Side Snacks', 24.00, 'fresh seafood soup'),
('S14', 'Seafood Chowder', 'Soup', 'Side Snacks', 24.00, 'fresh seafood chowder'),
('S2', 'Fried Calamari', 'Bar Bites', 'Side Snacks', 29.00, 'delicious fried calamari'),
('S3', 'Cheesy Baked Mussels ½ Dozen', 'Bar Bites', 'Side Snacks', 23.00, '½ Dozen'),
('S4', 'Cheesy Baked Mussels 1 Dozen', 'Bar Bites', 'Side Snacks', 38.00, '1 Dozen'),
('S5', 'Chopped Lamb Chops', 'Bar Bites', 'Side Snacks', 39.00, 'Delicious lamb chop'),
('S6', 'Nachos', 'Bar Bites', 'Side Snacks', 28.00, 'delicious nachos'),
('S7', 'Cheesy Fries', 'Bar Bites', 'Side Snacks', 14.00, 'delicious cheesy fries'),
('S8', 'Cheesy Meat Fries', 'Bar Bites', 'Side Snacks', 22.00, 'delicious cheesy meat fries'),
('S9', 'Grilled Chicken Caesar Salad', 'Salad', 'Side Snacks', 24.00, 'delicious salad'),
('SK1', 'Chicken Tenders', 'Shoney Kid', 'Side Snacks', 12.00, 'delicious chicken tenders'),
('SK2', 'Chicken Wings', 'Shoney Kid', 'Side Snacks', 12.00, 'delicious chicken wings'),
('SK3', 'Fish Fingers', 'Shoney Kid', 'Side Snacks', 15.00, 'served with fries & corn'),
('SK4', 'Cheesy Pasta', 'Shoney Kid', 'Side Snacks', 12.00, 'delicious cheesy pasta'),
('SK5', 'Meat Sauce Pasta', 'Shoney Kid', 'Side Snacks', 12.00, 'delicious pasta'),
('SK6', 'Milo', 'Shoney Kid', 'Side Snacks', 2.50, '200ml pack'),
('SK7', 'Ribena', 'Shoney Kid', 'Side Snacks', 3.50, '330ml pack'),
('SK8', 'Fruity Yogurt Smoothies', 'Shoney Kid', 'Side Snacks', 5.00, 'watermelon or pineapple'),
('SK9', 'Ice Cream MilkShakes', 'Shoney Kid', 'Side Snacks', 5.00, 'vanilla or chocolate'),
('T1', 'Lemon Tea Hot', 'Tea', 'Drinks', 8.00, 'hot'),
('T2', 'Lemon Tea Cold', 'Tea', 'Drinks', 10.00, 'cold'),
('T3', 'Honey Lemon Tea Hot', 'Tea', 'Drinks', 9.00, 'hot'),
('T4', 'Honey Lemon Tea Cold', 'Tea', 'Drinks', 11.00, 'cold'),
('T5', 'Green Tea Hot', 'Tea', 'Drinks', 8.00, 'hot'),
('T6', 'Green Tea Cold', 'Tea', 'Drinks', 10.00, 'cold');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `head_count` int(11) DEFAULT NULL,
  `special_request` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tables`
--

CREATE TABLE `restaurant_tables` (
  `table_id` int(11) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_availability`
--

CREATE TABLE `table_availability` (
  `availability_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `membership_id` (`membership_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`bill_item_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `table_availability`
--
ALTER TABLE `table_availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `table_id` (`table_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `bill_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_availability`
--
ALTER TABLE `table_availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`member_id`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`staff_id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`staff_id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `memberships` (`member_id`),
  ADD CONSTRAINT `bills_ibfk_3` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`),
  ADD CONSTRAINT `bills_ibfk_4` FOREIGN KEY (`table_id`) REFERENCES `restaurant_tables` (`table_id`);

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`),
  ADD CONSTRAINT `bill_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu` (`item_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `restaurant_tables` (`table_id`);

--
-- Constraints for table `table_availability`
--
ALTER TABLE `table_availability`
  ADD CONSTRAINT `table_availability_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `restaurant_tables` (`table_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

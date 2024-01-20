CREATE DATABASE IF NOT EXISTS restaurantdb; -- Change to your database name

CREATE TABLE IF NOT EXISTS Menu (
  item_id VARCHAR(6) PRIMARY KEY,
  item_name VARCHAR(255),
  item_type VARCHAR(255),
  item_category VARCHAR(255),
  item_price DECIMAL(10, 2),
  item_description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Accounts (
  account_id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255),
  register_date DATE,
  phone_number VARCHAR(255),
  password VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Staffs (
  staff_id INT PRIMARY KEY AUTO_INCREMENT,
  staff_name VARCHAR(255),
  role VARCHAR(255),
  account_id INT,
  FOREIGN KEY (account_id ) REFERENCES Accounts(account_id )
);

CREATE TABLE IF NOT EXISTS Memberships (
  member_id INT PRIMARY KEY AUTO_INCREMENT,
  member_name VARCHAR(255),
  points INT,
  account_id INT,
  FOREIGN KEY (account_id ) REFERENCES Accounts(account_id )
);

CREATE TABLE IF NOT EXISTS Restaurant_Tables (
  table_id INT PRIMARY KEY AUTO_INCREMENT,
  capacity INT,
  is_available BOOLEAN
);


CREATE TABLE IF NOT EXISTS Table_Availability (
  availability_id INT PRIMARY KEY AUTO_INCREMENT,
  table_id INT,
  reservation_date DATE,
  reservation_time TIME,
  status VARCHAR(20),
  FOREIGN KEY (table_id) REFERENCES Restaurant_Tables(table_id)
);

CREATE TABLE IF NOT EXISTS Reservations (
  reservation_id INT PRIMARY KEY AUTO_INCREMENT,
  customer_name VARCHAR(255),
  table_id INT,
  reservation_time TIME,
  reservation_date DATE,
  head_count INT,
  special_request VARCHAR(255),
  FOREIGN KEY (table_id) REFERENCES Restaurant_Tables(table_id)
);




CREATE TABLE IF NOT EXISTS card_payments (
    card_id INT AUTO_INCREMENT PRIMARY KEY,
    account_holder_name VARCHAR(255) NOT NULL,
    card_number VARCHAR(16) NOT NULL,
    expiry_date VARCHAR(7) NOT NULL,
    security_code VARCHAR(3) NOT NULL
);

CREATE TABLE IF NOT EXISTS Bills (
  bill_id INT PRIMARY KEY AUTO_INCREMENT,
  staff_id INT,
  member_id INT,
  reservation_id INT,
  table_id INT,
  card_id INT,
  payment_method VARCHAR(255),
  bill_time DATETIME,
  payment_time DATETIME,
  FOREIGN KEY (staff_id) REFERENCES Staffs(staff_id),
  FOREIGN KEY (member_id) REFERENCES Memberships(member_id),
  FOREIGN KEY (reservation_id) REFERENCES Reservations(reservation_id),
  FOREIGN KEY (table_id) REFERENCES Restaurant_Tables(table_id),
  FOREIGN KEY (card_id) REFERENCES card_payments(card_id)
);




CREATE TABLE IF NOT EXISTS Bill_Items (
  bill_item_id INT PRIMARY KEY AUTO_INCREMENT,
  bill_id INT,
  item_id VARCHAR(6),
  quantity INT,
  FOREIGN KEY (bill_id) REFERENCES Bills(bill_id),
  FOREIGN KEY (item_id) REFERENCES Menu(item_id)
);


CREATE TABLE IF NOT EXISTS Kitchen (
    kitchen_id INT AUTO_INCREMENT PRIMARY KEY,
    table_id INT,
    item_id VARCHAR(6),
    quantity INT,
    time_submitted DATETIME,
    time_ended DATETIME,
    FOREIGN KEY (table_id) REFERENCES Restaurant_Tables(table_id),
    FOREIGN KEY (item_id) REFERENCES Menu(item_id)
);




INSERT INTO Restaurant_Tables (table_id, capacity, is_available)
VALUES 
  ('1', '4', 1),
  ('2', '4', 1),
  ('3', '4', 1),
  ('4', '6', 1), 
  ('5', '6', 1),
  ('6', '6', 1),
('7', '6', 1),
  ('8', '8', 1), 
  ('9', '8', 1),
('10','8', 1);


INSERT INTO Menu (item_id, item_name, item_type, item_category, item_price, item_description)
VALUES
  ('MD1', 'Prime Rib Steak', 'Steak & Ribs', 'Main Dishes', 96,'300g'),
  ('MD2', 'Sirloin Steak', 'Steak & Ribs', 'Main Dishes', 79, '230g'),
  ('MD3', 'Ribeye Steak', 'Steak & Ribs', 'Main Dishes', 96, '230g'),
  ('MD4', 'BBQ Ribs', 'Steak & Ribs', 'Main Dishes', 59, '400g'),
  ('MD5', 'Grilled Chicken ½ Bird', 'Chicken', 'Main Dishes', 33, '½ Bird'),
  ('MD6', 'Southern Fried Chicken ½ Bird', 'Chicken', 'Main Dishes', 33, '½ Bird'),
  ('MD7', 'Pan Seared Chicken' , 'Chicken', 'Main Dishes', 28, '300g'),
  ('MD8', 'Chicken Chop', 'Chicken', 'Main Dishes', 28, '300g'),
  ('MD9', 'Grilled Lamb Chops', 'Lamb', 'Main Dishes', 48, 'delicious grilled lamb chop'),
  ('MD10', 'Braised Lamb Shank', 'Lamb', 'Main Dishes', 52, 'delicious braised lamb shank'),
  ('MD11', 'Catch of the day', 'Seafood', 'Main Dishes',  46, 'fresh seafood'),
  ('MD12', 'Grilled Salmon', 'Seafood', 'Main Dishes',  48, 'fresh salmon'),
  ('MD13', 'Jambalaya', 'Seafood', 'Main Dishes',  28, 'delicious jambalaya'),
  ('MD14', 'Fish & Chips', 'Seafood', 'Main Dishes',  35, 'delicious fish & chips'),
  ('MD15', 'Classic Cheese Burger', 'Burgers & Sandwiches', 'Main Dishes',  30, 'delicious burger'),
 ('MD16', 'Hickory Burger', 'Burgers & Sandwiches', 'Main Dishes',  30, 'delicious burger'),
 ('MD17', 'Fried Chicken Burger', 'Burgers & Sandwiches', 'Main Dishes',  24, 'delicious burger'),
 ('MD18', 'Grilled Chicken Burger', 'Burgers & Sandwiches', 'Main Dishes',  24, 'delicious burger'),
 ('MD19', 'Chili Dog', 'Burgers & Sandwiches', 'Main Dishes',  25, 'delicious sandwich'),
 ('MD20', 'Meatballs Sandwich', 'Burgers & Sandwiches', 'Main Dishes',  25, 'delicious sandwich'),
 ('MD21', 'Street Car', 'Burgers & Sandwiches', 'Main Dishes',  24, 'delicious sandwich'),
 ('MD22', 'Shrimp Po Boy', 'Burgers & Sandwiches', 'Main Dishes',  32, 'delicious sandwich'),
 ('MD23', 'Chicken Po Boy', 'Burgers & Sandwiches', 'Main Dishes',  28, 'delicious sandwich'),
 ('MD24', 'Chicken Tortilla', 'Burgers & Sandwiches', 'Main Dishes',  22, 'delicious sandwich'),
 ('MD25', 'Bolognese', 'Pasta', 'Main Dishes',  26, 'Spaghetti'),
 ('MD26', 'Meat Balls', 'Pasta', 'Main Dishes',  28, 'Spaghetti'),
 ('MD27', 'Carbonara', 'Pasta', 'Main Dishes',  28, 'Penne'),
 ('MD28', 'Chicken & Mushroom Aglio Olio', 'Pasta', 'Main Dishes',  28, 'Penne'),
 ('MD29', 'Chicken Arabiatta', 'Pasta', 'Main Dishes',  28, 'Spaghetti'),
 ('MD30', 'Seafood Aglio Olio', 'Pasta', 'Main Dishes',  32, 'Spaghetti'),
 ('MD31', 'Shrimp', 'Pasta', 'Main Dishes',  32, 'Penne'),
 ('MD32', 'Italian Chicken', 'Pasta', 'Main Dishes',  30, 'Chef''s Signature Pasta'),
 ('MD33', 'Braised Lamb Cutlet', 'Pasta', 'Main Dishes',  33, 'Chef''s Signature Pasta'),
 ('MD34', 'Fries', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
 ('MD35', 'Potato Wedges', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
 ('MD36', 'Garden Salad', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
 ('MD37', 'V.O.D', 'Side Dishes', 'Side Snacks',  9, 'delicious vegetables'),
 ('MD38', 'Wan Tan', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
('MD39', 'Buttered Corn', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
('MD40', 'Coleslaw', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
('MD41', 'Garlic Bread', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
('MD42', 'Dirty Rice', 'Side Dishes', 'Side Snacks',  9, 'delicious'),
('S1', 'Buffalo Wings', 'Bar Bites', 'Side Snacks', 24, 'delicious buffalo wings'),
('S2', 'Fried Calamari', 'Bar Bites', 'Side Snacks', 29, 'delicious fried calamari'),
('S3', 'Cheesy Baked Mussels ½ Dozen', 'Bar Bites', 'Side Snacks', 23, '½ Dozen'),
('S4', 'Cheesy Baked Mussels 1 Dozen', 'Bar Bites', 'Side Snacks', 38, '1 Dozen'),
('S5', 'Chopped Lamb Chops', 'Bar Bites', 'Side Snacks', 39, 'Delicious lamb chop'),
('S6', 'Nachos', 'Bar Bites', 'Side Snacks', 28, 'delicious nachos'),
('S7', 'Cheesy Fries', 'Bar Bites', 'Side Snacks', 14, 'delicious cheesy fries'),
('S8', 'Cheesy Meat Fries', 'Bar Bites', 'Side Snacks', 22, 'delicious cheesy meat fries'),
('S9', 'Grilled Chicken Caesar Salad', 'Salad', 'Side Snacks', 24, 'delicious salad'),
('S10', 'Shoney Salad', 'Salad', 'Side Snacks', 20, 'delicious salad'),

('L1', 'Blended Scotch (Black Label)', 'Liquor', 'Drinks', 310, 'Johnny Walker Black Label Sherry 700ml'),
('L2', 'Blended Scotch (Gold Label)', 'Liquor', 'Drinks', 390, 'Johnny Walker Gold Label 750ml'),
('L3', 'American Whisky (Jack Daniel)', 'Liquor', 'Drinks', 290, '700ml'),
('L4', 'American Whisky (Jim Beam)', 'Liquor', 'Drinks', 270, '750ml'),
('L5', 'Single Malt', 'Liquor', 'Drinks', 360, 'Singleton Signature 700ml'),
('L6', 'Cognac', 'Liquor', 'Drinks', 390, 'Hennessy VSOP 700ml'),
('L7', 'Vodka', 'Liquor', 'Drinks', 195, 'Smirnoff Red 700ml'),
('L8', 'Tequila', 'Liquor', 'Drinks', 165, 'Jose Cuervo 750ml'),
('L9', 'Gin', 'Liquor', 'Drinks', 210, 'Gordon 700ml'),
('C1', 'Kamikaze', 'Classic Cocktails', 'Drinks', 28, 'cocktails'),
('C2', 'Singapore Sling', 'Classic Cocktails', 'Drinks', 29, 'cocktails'),
('C3', 'Long Island Iced Tea', 'Classic Cocktails', 'Drinks', 29, 'cocktails'),
('C4', 'Lady on the Beach', 'Classic Cocktails', 'Drinks', 29, 'cocktails'),
('C5', 'Margarita', 'Classic Cocktails', 'Drinks', 29, 'cocktails'),
('C6', 'Pina Colada', 'Classic Cocktails', 'Drinks', 26, 'cocktails'),
('C7', 'Mojito', 'Classic Cocktails', 'Drinks', 29, 'cocktails'),


('HC1', 'Shoney Iced Tea', 'House Cocktails', 'Drinks', 32, 'Gin, Rum'),
('HC2', 'Blue Lady', 'House Cocktails', 'Drinks', 30, 'Vodka'),
('HC3', 'Black Mambaa', 'House Cocktails', 'Drinks', 30, 'Vodka'),
('HC4', 'Lycheetini', 'House Cocktails', 'Drinks', 25, 'Vodka'),
('HC5', 'Chichi', 'House Cocktails', 'Drinks', 25, 'Vodka'),

('HD1', 'Brownies', 'House Dessert', 'Side Snacks', 15, 'delicious brownies'),
('HD2', 'American Cheese Cake', 'House Dessert', 'Side Snacks', 15, 'delicious cheese cake'),
('HD3', 'Pie of the Day', 'House Dessert', 'Side Snacks', 13, 'delicious served with vanilla ice cream'),
('HD4', 'Coated Ice Cream', 'House Dessert', 'Side Snacks', 12, 'delicious ice cream'),
('HD5', 'Messy Sundae', 'House Dessert', 'Side Snacks', 14, 'delicious brownies'),
('SK1', 'Chicken Tenders', 'Shoney Kid', 'Side Snacks', 12, 'delicious chicken tenders'),
('SK2', 'Chicken Wings', 'Shoney Kid', 'Side Snacks', 12, 'delicious chicken wings'),
('SK3', 'Fish Fingers', 'Shoney Kid', 'Side Snacks', 15, 'served with fries & corn'),
('SK4', 'Cheesy Pasta', 'Shoney Kid', 'Side Snacks', 12, 'delicious cheesy pasta'),
('SK5', 'Meat Sauce Pasta', 'Shoney Kid', 'Side Snacks', 12, 'delicious pasta'),
('SK6', 'Milo', 'Shoney Kid', 'Side Snacks', 2.5, '200ml pack'),
('SK7', 'Ribena', 'Shoney Kid', 'Side Snacks', 3.5, '330ml pack'),
('SK8', 'Fruity Yogurt Smoothies', 'Shoney Kid', 'Side Snacks', 5, 'watermelon or pineapple'),
('SK9', 'Ice Cream MilkShakes', 'Shoney Kid', 'Side Snacks', 5, 'vanilla or chocolate'),
('CP1', 'Green Apple', 'Cold Pressed Juice', 'Drinks', 15, 'fresh pressed juice'),
('CP2', 'Orange', 'Cold Pressed Juice', 'Drinks', 15, 'fresh pressed juice'),
('CP3', 'Carrot', 'Cold Pressed Juice', 'Drinks', 15, 'fresh pressed juice'),
('CP4', 'Watermelon', 'Cold Pressed Juice', 'Drinks', 13, 'fresh pressed juice'),
('CP5', 'Pineapple', 'Cold Pressed Juice', 'Drinks', 13, 'fresh pressed juice'),
('CP6', 'Lime', 'Cold Pressed Juice', 'Drinks', 10, 'fresh pressed juice'),
('M1', 'Cool & Refreshing', 'Mocktails', 'Drinks', 16, 'Cucumber,peppermint,lemon'),
('M2', 'Virgin Apple Mojito', 'Mocktails', 'Drinks', 16, 'Green apple, mint leaf'),
('M3', 'Shirley Temple', 'Mocktails', 'Drinks', 16, 'Lemonade, grenadine'),
('M4', 'Purple Rain', 'Mocktails', 'Drinks', 16, 'Blackcurrant, strawberry'),
('M5', 'Silly Rose', 'Mocktails', 'Drinks', 16, 'Green Tea, lychee, rose'),
('M6', 'Incredible Green', 'Mocktails', 'Drinks', 16, 'Green apple, lemon, lime, soda');



-- Accounts table
INSERT INTO Accounts (email, register_date, phone_number, password)
VALUES ('john@gmail.com', '2023-08-31', '+1234567890', 'password123'),
       ('susan@gmail.com', '2023-08-30', '+1987654321', 'susanpassword'),
       ('james@gmail.com', '2023-08-29', '+18887776666', 'jamespass'),
       ('alice@gmail.com', '2023-08-28', '+15555555555', 'alicepassword'),
       ('mike@gmail.com', '2023-08-27', '+14444444444', 'mikepass'),
       ('lisa@gmail.com', '2023-08-26', '+13333333333', 'lisapassword'),
       ('robert@gmail.com', '2023-08-25', '+12222222222', 'robertpass'),
       ('emily@gmail.com', '2023-08-24', '+16666666666', 'emilypassword'),
       ('david@gmail.com', '2023-08-23', '+1993219999', 'davidp321ass'),
       ('ddwd@gmail.com', '2023-08-23', '+1999999329999', 'davidpa2ss'),
       ('dadsvawvid@gmail.com', '2023-08-23', '+12234132199', 'david4pass'),
       ('davdavid@gmail.com', '2023-08-23', '+123239999', 'davidp13ass'),
       ('davvdasid@gmail.com', '2023-08-23', '+1995324319999', 'david2pass'),
       ('321david@gmail.com', '2023-08-23', '+1942199999', 'davidpa52ss'),
	('32avid@gmail.com', '2023-08-23', '+1942193429999', 'da2332ss'),
	('321da543vid@gmail.com', '2023-08-23', '+1942132199999', 'dav43a52ss'),
	('3211234avid@gmail.com', '2023-08-23', '+194213599999', '32533pa52ss'),
	('321543avid@gmail.com', '2023-08-23', '+1942154399999', '754dpa52ss'),
	('rbsjsd@gmail.com', '2023-08-23', '+131351241239', '41f2s'),
       ('ol435143ivia@gmail.com', '2023-08-22', '+18888888888', 'oliviapass4215word'),
    ('robber@gmail.com', '2023-09-01', '+1234567890', 'password123'),
    ('jean@gmail.com', '2023-09-02', '+2345678901', 'password456'),
    ('emily@gmail.com', '2023-09-03', '+3456789012', 'password789'),
    ('robert@gmail.com', '2023-09-04', '+4567890123', 'passwordabc'),
    ('zoe@gmail.com', '2023-09-05', '+5678901234', 'passworddef'),
    ('lisa@gmail.com', '2023-09-06', '+6789012345', 'passwordghi'),
    ('taylor@gmail.com', '2023-09-07', '+7890123456', 'passwordjkl'),
    ('stephan@gmail.com', '2023-09-08', '+8901234567', 'passwordmno'),
    ('bruce@gmail.com', '2023-09-09', '+9012345678', 'passwordpqr'),
    ('jackie@gmail.com', '2023-09-10', '+0123456789', 'passwordstu');


-- Staffs table
INSERT INTO Staffs (staff_name, role, account_id)
VALUES ('John Smith', 'Waiter', 1),
       ('Susan Johnson', 'Waiter', 2),
       ('James Brown', 'Waiter', 3),
       ('Alice Davis', 'Waiter', 4),
       ('Mike Wilson', 'Waiter', 5),
       ('Lisa Martinez', 'Chef', 6),
       ('Robert Miller', 'Manager', 7),
       ('Emily Moore', 'Manager', 8),
       ('David Taylor', 'Chef', 9),
       ('Olivia Anderson', 'Chef', 10);



-- Memberships table
INSERT INTO Memberships (member_name, points,account_id)
VALUES 
	('Abbel TuTuTu', 100,11),
       	('Abignail Downey ', 200,12),
       	('Jamie Mustafa', 300,13),
       	('Luke Gun Slinger', 400,14),
       	('Johny Rings', 500,15),
       	('Wee Tuu Low', 600,16),
       	('Sum Ting Wong', 700,17),
       	('Ho Lee Fuk', 800,18),
       	('Bang Ding Ow', 900,19),
       	('Rocky Rocket', 1000,20),	
	('Robber Hellington', 250, 21),
  	('Jean Ng', 300, 22),
  	('Emily Davis', 400, 23),
  	('Robert Wilson', 550, 24),
  	('Zoe Chong', 650, 25),
  	('Lisa Chia', 750, 26),
  	('Taylor Swift', 900, 27),
  	('Stephan Curry', 1050, 28),
  	('Bruce Lee', 1200, 29),
  	('Jackie Chan', 1350, 30);



-- Reservations table
INSERT INTO Reservations (reservation_id, customer_name, table_id, reservation_time, reservation_date, head_count, special_request)
VALUES 
(2220231, 'Abbel Tu Far Behind', 1, '22:00:34', '2023-09-28', 1, 'Prepare Panadol for me'),
(2220232, 'Abignaile Lin Downney Jr', 2, '22:00:34', '2023-09-29', 1, 'Default Special Request'),
(1920233, 'Jamie Mustafa', 3, '19:30:00', '2023-09-30', 2, 'Vegan options needed'),
(2020234, 'Luke Gun Slinger', 4, '20:00:00', '2023-09-30', 3, 'Birthday celebration'),
(1920235, 'Johny Rings', 5, '19:45:00', '2023-10-01', 2, 'Quiet corner, please'),
(1820237, 'Jean Ng', 7, '18:30:00', '2023-10-03', 2, 'Allergies: peanuts'),
(1920239, 'Taylor Swift', 9, '19:15:00', '2023-10-05', 2, 'Surprise dessert for anniversary'),
(1111111, 'Default', 9, '19:15:00', '2023-10-05', 2, 'Description'),
(14202310, 'Bruce Lee', 10, '14:45:00', '2023-10-06', 3, 'Window seat, if available');

INSERT INTO card_payments (card_id, account_holder_name, card_number, expiry_date, security_code)
VALUES
('1', 'John Smith', '1234567890123456', '10/15', '123'),
('2', 'Susan Johnson', '2345678901234567', '10/24', '456'),
('3', 'James Brown', '3456789012345678', '09/30', '789'),
('4', 'Alice Davis', '4567890123456789', '09/28', '321'),
('5', 'Mike Wilson', '5678901234567890', '09/29', '654'),
('6', 'Robert Miller', '7890123456789012', '10/19', '123'),
('7', 'Abbel TuTuTu', '1234123412341234', '10/25', '654'),
('8', 'Abignail Downey', '2345234523452345', '10/24', '987'),
('9', 'Jamie Mustafa', '3456345634563456', '09/23', '123'),
('10', 'Luke Gun Slinger', '4567456745674567', '09/22', '456');

INSERT INTO Bills (staff_id, member_id, reservation_id, table_id, card_id, payment_method, bill_time, payment_time)
VALUES
(1, 1, 2220231, 1, 1, 'Card', '2023-09-28 22:45:00', '2023-09-28 22:50:00'),
(1, 5, NULL, 5, NULL, 'Cash', '2023-09-28 19:00:00', '2023-09-28 19:05:00'),
(1, 2, 2220232, 2, 2, 'Card', '2023-09-29 22:45:00', '2023-09-29 22:50:00'),
(2, 3, 1920233, 3, NULL, 'Cash', '2023-09-30 20:15:00', '2023-09-30 20:20:00'), 
(2, 4, 2020234, 4, 3, 'Card', '2023-09-30 20:30:00', '2023-09-30 20:35:00'),
(2, 8, NULL, 6, NULL, 'Cash', '2023-09-30 20:15:00', '2023-09-30 20:20:00'),
(3, 5, 1920235, 5, NULL, 'Cash', '2023-10-01 20:15:00', '2023-10-01 20:20:00'), 
(3, 6, NULL, 7, NULL, 'Cash', '2023-10-01 19:00:00', '2023-10-01 19:05:00'),
(3, 18, NULL, 2, NULL, 'Cash', '2023-10-01 18:30:00', '2023-10-01 18:35:00'),
(4, 7, NULL, 9, NULL, 'Cash', '2023-10-02 19:30:00', '2023-10-02 19:35:00'), 
(4, 17, NULL, 8, NULL, 'Cash', '2023-10-02 20:00:00', '2023-10-02 20:05:00'),
(4, 8, NULL, 10, 4, 'Card', '2023-10-02 19:00:00', '2023-10-02 19:05:00'),
(5, 9, 1820237, 6, 5, 'Card', '2023-10-03 18:45:00', '2023-10-03 18:50:00'),
(5, 16, NULL, 9, NULL, 'Cash', '2023-10-03 19:45:00', '2023-10-03 19:50:00'),
(5, 10, NULL, 5, NULL, 'Cash', '2023-10-03 20:00:00', '2023-10-03 20:05:00'), 
(6, 11, NULL, 4, 6, 'Card', '2023-10-03 20:15:00', '2023-10-03 20:20:00'),
(6, 8, NULL, 10, NULL, 'Cash', '2023-10-03 20:30:00', '2023-10-03 20:35:00'),
(6, 12, NULL, 3, 7, 'Card', '2023-10-04 19:30:00', '2023-10-04 19:35:00'),
(7, 13, NULL, 2, NULL, 'Cash', '2023-10-04 19:15:00', '2023-10-04 19:20:00'), 
(7, 14, 1920239, 1, NULL, 'Cash', '2023-10-05 20:30:00', '2023-10-05 20:35:00'),
(7, 1, NULL, 6, NULL, 'Cash', '2023-10-05 14:00:00', '2023-10-05 14:05:00'),
(8, 15, NULL, 8, 8, 'Card', '2023-10-05 20:45:00', '2023-10-05 20:50:00'),
(8, 16, NULL, 7, NULL, 'Cash', '2023-10-05 20:00:00', '2023-10-05 20:05:00'), 
(8, 2, NULL, 9, NULL, 'Cash', '2023-10-05 19:30:00', '2023-10-05 19:35:00'),
(8, 9, NULL, 4, NULL, 'Cash', '2023-10-05 20:15:00', '2023-10-05 20:20:00'),
(9, 17, NULL, 9, 9, 'Card', '2023-10-05 12:00:00', '2023-10-05 12:05:00'),
(9, 18, NULL, 10, 10, 'Card', '2023-10-06 13:15:00', '2023-10-06 13:20:00'),
(9, 19, 14202310, 8, NULL, 'Cash', '2023-10-06 14:30:00', '2023-10-06 14:35:00'),
(10, 7, NULL, 10, NULL, 'Cash', '2023-10-06 10:45:00', '2023-10-06 10:50:00'), 
(10, 20, NULL, 6, NULL, 'Cash', '2023-10-06 14:45:00', '2023-10-06 14:50:00');



INSERT INTO Bill_Items (bill_id, item_id, quantity)
VALUES 
(1, 'MD1', 2),
(1, 'MD15', 1),
(1, 'S3', 2),
(1, 'L1', 1),

(2, 'MD2', 1),
(2, 'MD5', 2),
(2, 'MD16', 1),
(2, 'S5', 2),
(2, 'L2', 1),
(2, 'HC2', 2),

(3, 'MD19', 1),
(3, 'MD2', 1),
(3, 'MD4', 1),
(3, 'S6', 2),
(3, 'L3', 1),
(3, 'HC3', 2),

(4, 'MD23', 1),
(4, 'MD9', 1),
(4, 'L2', 2),
(4, 'C3', 1),
(4, 'HC4', 2),

(5, 'MD23', 1),
(5, 'S1', 1),
(5, 'S8', 2),
(5, 'L5', 1),
(5, 'HC5', 2),

(6, 'MD23', 1),
(6, 'MD21', 1),
(6, 'C1', 1),
(6, 'C2', 2),

(7, 'MD23', 1),
(7, 'S1', 1),
(7, 'S4', 1),
(7, 'C3', 1),
(7, 'C4', 2),

(8, 'MD23', 1),
(8, 'L2', 1),
(8, 'C3', 1),
(8, 'L5', 1),
(8, 'C4', 2),
(8, 'M1', 1),
(8, 'M2', 2),

(9, 'MD23', 1),
(9, 'M1', 1),
(9, 'M4', 1),
(9, 'M2', 1),
(9, 'M5', 2),
(9, 'M6', 1),
(9, 'HD1', 2),

(10, 'SK3', 1),
(10, 'SK6', 1),
(10, 'CP1', 1),
(10, 'CP2', 1),
(10, 'CP3', 2),
(10, 'CP4', 1),
(10, 'CP5', 2),

(11, 'MD1', 2),
(11, 'MD15', 1),
(11, 'S3', 2),
(11, 'L1', 1),

(12, 'MD2', 1),
(12, 'MD5', 2),
(12, 'MD16', 1),
(12, 'S5', 2),
(12, 'L2', 1),
(12, 'HC2', 2),

(13, 'MD19', 1),
(13, 'MD2', 1),
(13, 'MD4', 1),
(13, 'S6', 2),
(13, 'L3', 1),
(13, 'HC3', 2),

(14, 'MD23', 1),
(14, 'MD9', 1),
(14, 'L2', 2),
(14, 'C3', 1),
(14, 'HC4', 2),

(15, 'MD23', 1),
(15, 'S1', 1),
(15, 'S8', 2),
(15, 'L5', 1),
(15, 'HC5', 2),

(16, 'MD23', 1),
(16, 'MD21', 1),
(16, 'C1', 1),
(16, 'C2', 2),

(17, 'MD23', 1),
(17, 'MD41', 1),
(17, 'S4', 1),
(17, 'C3', 1),
(17, 'C4', 2),

(18, 'MD23', 1),
(18, 'MD32', 1),
(18, 'MD33', 1),
(18, 'L5', 1),
(18, 'C4', 2),
(18, 'M1', 1),
(18, 'M2', 2),

(19, 'MD23', 1),
(19, 'M1', 1),
(19, 'M4', 1),
(19, 'MD29', 1),
(19, 'M5', 2),
(19, 'M6', 1),
(19, 'HD1', 2),

(20, 'MD42', 1),
(20, 'SK6', 1),
(20, 'CP1', 1),
(20, 'CP2', 1),
(20, 'CP3', 2),
(20, 'CP4', 1),
(20, 'CP5', 2),

(21, 'MD1', 2),
(21, 'MD15', 1),
(21, 'S3', 2),
(21, 'S1', 1),

(22, 'MD2', 1),
(22, 'MD5', 2),
(22, 'MD16', 1),
(22, 'S5', 2),
(22, 'SK2', 1),
(22, 'HC2', 2),

(23, 'MD9', 1),
(23, 'MD21', 1),
(23, 'M6', 1),
(23, 'SK6', 2),
(23, 'L9', 1),
(23, 'HC5', 2),

(24, 'MD23', 1),
(24, 'HD2', 1),
(24, 'MD2', 2),
(24, 'M3', 1),
(24, 'HC1', 2),

(25, 'MD2', 1),
(25, 'MD21', 1),
(25, 'MD8', 2),
(25, 'L5', 1),
(25, 'HC5', 2),

(26, 'MD23', 1),
(26, 'MD21', 1),
(26, 'C1', 1),
(26, 'C2', 2),

(27, 'MD23', 1),
(27, 'MD11', 1),
(27, 'MD4', 1),
(27, 'C3', 1),
(27, 'C4', 2),

(28, 'MD23', 1),
(28, 'MD22', 1),
(28, 'M3', 1),
(28, 'CP5', 1),
(28, 'SK4', 2),
(28, 'M1', 1),
(28, 'MD2', 2),

(29, 'MD23', 1),
(29, 'M1', 1),
(29, 'M4', 1),
(29, 'MD2', 1),
(29, 'M5', 2),
(29, 'CP1', 1),
(29, 'HD1', 2),

(30, 'MD3', 1),
(30, 'MD6', 1),
(30, 'MD11', 1),
(30, 'MD22', 1),
(30, 'CP3', 2),
(30, 'CP4', 1),
(30, 'CP5', 2);

-- Kitchen
INSERT INTO Kitchen (table_id, item_id, quantity, time_submitted, time_ended)
VALUES	
	
	(6, 'SK3', 4, '2023-10-03 18:45:00', '2023-10-03 18:46:00'),
	(6, 'CP2', 3, '2023-10-03 18:45:00', '2023-10-03 18:46:00'),
	(5, 'S3', 5, '2023-10-03 20:00:00', '2023-10-03 20:46:00'), 
	(5, 'MD15', 2, '2023-10-03 14:45:00', '2023-10-03 14:46:00'),
	(1, 'MD1', 1, '2023-09-28 22:45:00', '2023-09-28 23:00:00'),
	(1, 'MD15', 2, '2023-09-28 22:45:00', '2023-09-28 23:00:00'),
	(1, 'S3', 1, '2023-09-28 22:45:00', '2023-09-28 23:00:00'), 
	(1, 'L1', 1, '2023-09-28 22:45:00', '2023-09-28 23:00:00'),
	(5, 'MD2', 1, '2023-09-28 19:00:00', '2023-09-28 19:15:00'),
	(5, 'MD5', 1, '2023-09-28 19:00:00', '2023-09-28 19:15:00'),
	(5, 'MD16', 1, '2023-09-28 19:00:00', '2023-09-28 19:15:00'), 
	(5, 'S5', 1, '2023-09-28 19:00:00', '2023-09-28 19:15:00'),
	(5, 'L2', 2, '2023-09-28 19:00:00', '2023-09-28 19:15:00'),
	(5, 'HC2', 1, '2023-09-28 19:00:00', '2023-09-28 19:15:00'),
	(2, 'MD19', 2, '2023-09-29 22:45:00', '2023-09-29 23:00:00'), 
	(2, 'MD2', 1, '2023-09-29 22:45:00', '2023-09-29 23:00:00'),
	(2, 'MD4', 2, '2023-09-29 22:45:00', '2023-09-29 23:00:00'),
	(2, 'S6', 2, '2023-09-29 22:45:00', '2023-09-29 23:00:00'),
	(2, 'L3', 1, '2023-09-29 22:45:00', '2023-09-29 23:00:00'), 
	(2, 'HC3', 1, '2023-09-29 22:45:00', '2023-09-29 23:00:00');

INSERT INTO Kitchen (table_id, item_id, quantity, time_submitted)
VALUES	
	(10, 'MD23', 1, '2023-10-06 10:45:00'),
	(10, 'MD2', 1, '2023-10-06 10:45:00'),
	(6, 'MD22', 1, '2023-10-06 14:45:00'), 
	(6, 'CP5', 2, '2023-10-06 14:45:00');




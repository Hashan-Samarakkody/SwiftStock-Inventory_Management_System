CREATE DATABASE IF NOT EXISTS inventory_system;
USE inventory_system;

CREATE TABLE IF NOT EXISTS Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS Items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES Categories(id)
);

CREATE TABLE users (
  userID int(11) AUTO_INCREMENT PRIMARY KEY,
  fullName varchar(200) NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(200) NOT NULL,
  telNo int(10) NOT NULL,
  status varchar(255) NOT NULL DEFAULT 'Active'
);

INSERT INTO users (fullName, username, password, status) VALUES
('Guest', 'guest', '81dc9bdb52d04dc20036dbd8313ed055', 'Active'),
('a', 'a', '0cc175b9c0f1b6a831c399e269772661', 'Active'),
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Active');

INSERT INTO Categories (name) VALUES 
('Electronics'),
('Furniture'),
('Clothing'),
('Books'),
('Toys'),
('Sports'),
('Home Appliances'),
('Gardening'),
('Office Supplies'),
('Beauty Products');

INSERT INTO Items (name, description, quantity, price, category_id) VALUES 
('Smartphone', 'Latest model with 5G support', 50, 699.99, 1),
('Laptop', 'High-performance laptop with 16GB RAM', 30, 1299.99, 1),
('Sofa', 'Comfortable 3-seater sofa', 20, 499.99, 2),
('Dining Table', 'Wooden dining table for 6', 15, 299.99, 2),
('T-shirt', 'Cotton T-shirt with logo', 100, 19.99, 3),
('Jeans', 'Denim jeans with a modern fit', 60, 39.99, 3),
('Novel', 'Bestselling fiction novel', 120, 14.99, 4),
('Textbook', 'Mathematics textbook for grade 10', 80, 24.99, 4),
('Toy Car', 'Remote-controlled toy car', 150, 34.99, 5),
('Basketball', 'Official size basketball', 40, 29.99, 6),
('Blender', 'Kitchen blender with multiple speeds', 25, 89.99, 7),
('Lawn Mower', 'Gas-powered lawn mower', 10, 299.99, 8),
('Office Chair', 'Ergonomic office chair', 35, 199.99, 9),
('Printer', 'All-in-one printer with wireless capability', 22, 159.99, 9),
('Lipstick', 'Long-lasting lipstick in various shades', 70, 14.99, 10);

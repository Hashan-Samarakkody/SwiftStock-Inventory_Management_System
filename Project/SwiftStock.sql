-- Create a new database named `swiftstock` if it doesn't already exist
CREATE DATABASE IF NOT EXISTS swiftstock;

-- Switch to the `swiftstock` database so all subsequent operations are done here
USE swiftstock;

-- Create a table named `users` to store user information
-- Each user has a unique ID, name, username, email, telephone number, and password
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,        -- Unique ID for each user, automatically increments
    `name` VARCHAR(255) NOT NULL,               -- Full name of the user
    `username` VARCHAR(255) UNIQUE NOT NULL,    -- Unique username for login
    `email` VARCHAR(255) UNIQUE NOT NULL,       -- Unique email address of the user
    `telephone_number` VARCHAR(10) NOT NULL,       -- Telephone number of the user
    `password` VARCHAR(255) NOT NULL                -- Encrypted password for user authentication
);

-- Create a table named `categories` to store different item categories
-- Each category has a unique ID and a name
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,    -- Unique ID for each category, automatically increments
    `category` VARCHAR(255) NOT NULL         -- Name of the category (e.g., Electronics, Books)
);

-- Create a table named `items` to store information about items for sale
-- Each item has a unique ID, name, description, price, quantity, and is linked to a category
CREATE TABLE IF NOT EXISTS `items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,    -- Unique ID for each item, automatically increments
    `name` VARCHAR(255) NOT NULL,           -- Name of the item
    `description` TEXT NOT NULL,            -- Description of the item
    `price` DECIMAL(10, 2) NOT NULL,        -- Price of the item, with 2 decimal places
    `quantity` INT NOT NULL,                -- Quantity of the item in stock
    `category_id` INT NOT NULL,             -- ID of the category this item belongs to
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) -- Foreign key linking to `categories` table
);

-- Insert predefined categories into the `categories` table
-- The `INSERT IGNORE` statement avoids inserting duplicate entries
INSERT IGNORE INTO `categories` (`category`) VALUES
('ELECTRONICS'),                        -- Category for electronic items
('BOOKS'),                              -- Category for books
('CLOTHING'),                           -- Category for clothing
('TOYS'),                               -- Category for toys
('HOME & KITCHEN'),                     -- Category for home and kitchen items
('SPORTS'),                             -- Category for sports equipment
('HEALTH & BEAUTY'),                    -- Category for health and beauty products
('AUTOMOTIVE'),                         -- Category for automotive products
('JEWELRY'),                            -- Category for jewelry
('MUSIC');                              -- Category for musical instruments

-- Insert predefined users into the `users` table
-- The `INSERT IGNORE` statement avoids inserting duplicate entries
INSERT IGNORE INTO `users` (`name`, `username`, `email`, `telephone_number`, `password`) VALUES
("User","user","user@gmail.com",0123456789,"$2y$10$RlsKaR1j2uhD33GKumqss.PFKFhMmQtXPZeyGNa2Kz3yHrHcKqpte"); -- Default User Account

-- Insert predefined items into the `items` table
-- The `INSERT IGNORE` statement avoids inserting duplicate entries
INSERT IGNORE INTO `items` (`name`, `description`, `price`, `quantity`, `category_id`) VALUES
('Smartphone', 'Latest model with 6GB RAM and 128GB storage.', 699.99, 50, 1),          -- Category 1: ELECTRONICS
('Laptop', 'High performance laptop with 16GB RAM and 512GB SSD.', 1199.99, 30, 1),     -- Category 1: ELECTRONICS
('Novel', 'Bestselling fiction novel.', 15.99, 100, 2),                                 -- Category 2: BOOKS
('Cookbook', 'Delicious recipes for home cooking.', 22.50, 80, 5),                      -- Category 5: HOME & KITCHEN
('Shirt', 'Comfortable cotton T-shirt in various sizes.', 12.99, 200, 3),               -- Category 3: CLOTHING
('Action Figure', 'Collectible action figure of a popular character.', 25.00, 60, 4),   -- Category 4: TOYS
('Blender', 'High-power blender for making smoothies.', 89.95, 40, 5),                  -- Category 5: HOME & KITCHEN
('Soccer Ball', 'Standard size 5 soccer ball.', 19.99, 75, 6),                          -- Category 6: SPORTS
('Shampoo', 'Shampoo for all hair types.', 9.99, 150, 7),                               -- Category 7: HEALTH & BEAUTY
('Car Battery', '12V car battery suitable for most vehicles.', 120.00, 25, 8),          -- Category 8: AUTOMOTIVE
('Necklace', 'Elegant gold necklace.', 250.00, 20, 9),                                  -- Category 9: JEWELRY
('Guitar', 'Acoustic guitar with case.', 150.00, 15, 10),                               -- Category 10: MUSIC
('Tablet', '10-inch tablet with WiFi and 64GB storage.', 299.99, 45, 1),                -- Category 1: ELECTRONICS
('Camera', 'Digital camera with 20MP resolution.', 499.99, 20, 1),                      -- Category 1: ELECTRONICS
('Desk Lamp', 'Adjustable desk lamp with LED light.', 35.00, 55, 5),                    -- Category 5: HOME & KITCHEN
('Winter Jacket', 'Warm winter jacket for cold weather.', 120.00, 35, 3),               -- Category 3: CLOTHING
('Board Game', 'Fun and engaging board game for family nights.', 30.00, 25, 4),         -- Category 4: TOYS
('Running Shoes', 'Comfortable running shoes for all terrains.', 75.00, 50, 6),         -- Category 6: SPORTS
('Face Cream', 'Moisturizing face cream for dry skin.', 25.00, 100, 7),                 -- Category 7: HEALTH & BEAUTY
('Car Tire', 'Durable car tire for various road conditions.', 90.00, 30, 8);            -- Category 8: AUTOMOTIVE

# SwiftStock - Inventory Management System

Welcome to SwiftStock, a robust and scalable Inventory Management System developed as the final project for the Web Applications Development I course. This repository contains the complete source code for a web-based application built using PHP and MySQL, designed to help users efficiently manage their inventory items through a comprehensive set of features.

## Table of Contents

1. [Introduction](#1-introduction)
2. [Features](#2-features)
3. [Prerequisites](#3-prerequisites)
4. [Installation](#4-installation)
5. [Configuration](#5-configuration)
6. [Running the Application](#6-running-the-application)
7. [Folder Structure](#7-folder-structure)
8. [Usage](#8-usage)
9. [Troubleshooting](#9-troubleshooting)
10. [Credits](#10-credits)

---

### 1. Introduction

SwiftStock is an advanced Inventory Management System tailored to streamline the process of tracking, managing, and reporting inventory items. The system is designed with a user-friendly interface and a powerful backend to handle inventory management tasks efficiently. The application is ideal for businesses of all sizes, allowing users to maintain an organized and up-to-date inventory.

#### Sample Demo Link

You can view a live demo of the application here: [SwiftStock Demo](http://swiftstock.zya.me/)

### 2. Features

SwiftStock offers a rich set of features designed to make inventory management simple and efficient:

#### Manage Inventory

-   **Add Inventory Items**: Users can add new inventory items, complete with details such as name, category, quantity, and value.
-   **Delete Inventory Items**: Easily remove inventory items that are no longer needed.
-   **Update Inventory Items**: Modify existing inventory items to keep information current.
-   **View Inventory Items**: Display a list of all inventory items with sortable and filterable columns.
-   **Category Management**: Add or delete categories for better organization and classification of inventory items.

#### Search Inventory

-   **Search by Name**: Quickly find items by searching their names.
-   **Search by ID**: Locate specific items using their unique identifiers.
-   **Search by Category**: Filter inventory items based on their assigned categories for quicker access.

#### Generate and Display Reports

-   **Current Inventory Reports**: Generate detailed reports that summarize the current inventory, including total items, total quantity, and total value.
-   **CSV Export**: Export inventory reports in CSV format for easy sharing, analysis, and archival.

#### Visualize Inventory Data

-   **Graphical Representations**: View inventory data through various graphical charts to gain better insights into inventory status and trends.

#### User Registration and Management

-   **User Registration**: Allow new users to sign up and create their own accounts.
-   **Profile Management**: Users can update their profiles, including changing their details or updating their passwords.
-   **Account Deletion**: Users can delete their accounts if they no longer wish to use the system.

### 3. Prerequisites

Before setting up the SwiftStock application, ensure your environment meets the following requirements:

1. **PHP 7.4+**: The application is built using PHP, and a version of 7.4 or higher is required.
2. **MySQL 5.7+**: A MySQL database is necessary to store the application's data.
3. **Apache Web Server**: The application is designed to run on an Apache web server.
4. **Web Browser**: Ensure your web browser is JavaScript-enabled for full functionality.

### 4. Installation

Follow these steps to install the SwiftStock application on your local or server environment:

1. **Clone the Repository**: Use Git to clone the repository to your local machine. Run the following command in your terminal, replacing `YOUR-USERNAME` with your GitHub username:

    ```bash
    git clone https://github.com/YOUR-USERNAME/SwiftStock-Inveventory_Management_System.git
    ```

2. **Move the Project Folder**: After cloning, move the root folder of the project to the deployment directory of your web server. For Apache, this is typically the `htdocs` folder.

3. **Create the Database**: Using MySQL or a tool like phpMyAdmin, create a new database named `swiftstock`.

4. **Import the Database Schema**: Import the `SwiftStock.sql` file located in the project repository into your newly created `swiftstock` database. This file contains all the necessary SQL queries to set up the database structure and initial data.

### 5. Configuration

Before running the application, update the database configuration to match your environment:

1. **Locate the Database Configuration File**: The file responsible for database connections is named `DBconnection.php`. You can find it in the root directory.

2. **Update the Configuration**: Open the `DBconnection.php` file and replace the placeholders with your actual database credentials:

    ```php
    // Hostname
    define('DB_HOST', 'YOUR-HOST-NAME'); // <-- Enter your hostname, usually 'localhost'

    // DB user
    define('DB_USER', 'YOUR-USERNAME'); // <-- Enter your MySQL username

    // DB password
    define('DB_PASSWORD', 'YOUR-PASSWORD'); // <-- Enter your MySQL password

    // Database name
    define('DB_NAME', 'swiftstock'); // <-- Enter the name of your database
    ```

3. **Save the Changes**: Ensure the changes are saved before proceeding to run the application.

### 6. Running the Application

To start using the SwiftStock application:

1. **Start Apache and MySQL**: Ensure both Apache and MySQL services are running on your server.
2. **Deploy the Project**: Place the project directory in the Apache server root or configure a virtual host to point to the project directory.
3. **Access the Application**: If you are using Apache server, open your web browser at `http://localhost/SwiftStock-Inveventory_Management_System/Project/`. Or, if you are using a virtual host, configure it to point to the project directory.

4. **Default users**:
    - User name :- `user`
    - Password :- `User@001`

### 7. Folder Structure

The project follows a structured organization of files and directories:

-   **`index.php`**: The landing page of the application where users are greeted.
-   **`Components/`**: Contains reusable components such as headers and footers.
-   **`Components/navigation/`**: Houses the navigation links and menus used throughout the application.
-   **`images/`**: Contains all the images used in the application, such as logos and icons.

### 8. Usage

After setting up and running the application, users can perform the following tasks:

#### User Authentication

-   **Registration**: New users can sign up via the `register.php` page.
-   **Login**: Existing users can log in using their credentials on the `login.php` page.
-   **Profile Management**: Users can manage their profiles, including updating their personal information or passwords.

#### Inventory Management

-   **Add Items**: Use the `manage_inventory.php` page to add new items to the inventory.
-   **Update Items**: Modify existing items through the same page.
-   **Delete Items**: Remove outdated or unnecessary items from the inventory.

#### Search Inventory

-   **Search Items**: Use the `search.php` page to search for items in the inventory.
-   **Search by ID**: Locate specific items using their unique identifiers.
-   **Search by Category**: Filter inventory items based on their assigned categories for quicker access.
-   **Search by Name**: Quickly find items by searching their names.

#### Reports

-   **Generate Reports**: Access `createReport.php` to generate comprehensive reports on the current inventory status.
-   **View Graphs**: Visualize inventory data through various graphs for better decision-making.

### 9. Troubleshooting

Here are common issues and their solutions:

#### Database Connection Issues

-   **Issue**: Unable to connect to the database.
-   **Solution**: Ensure your MySQL server is running. Verify that your credentials in `DBconnection.php` are correct and that the database exists.

#### Application Errors

-   **Issue**: Encountering PHP errors or warnings.
-   **Solution**: Enable error reporting in PHP by setting `display_errors` to `On` in your `php.ini` file. Review the error messages to identify and fix issues in the code.

### 10. Credits

SwiftStock was developed by **Group 8** as the final project for the Web Applications Development - I course. The team members contributed to various aspects of the project, including front-end design, back-end development, database management, and testing.

**Team Members: Group 8**

-   _[Nuzha](https://github.com/Nuzha-Kitchilan)_
-   _[Hansini](https://github.com/Hansini2002)_
-   _[Samadhi](https://github.com/SamadhiWadithya)_
-   _[Githmi](https://github.com/Githz26)_
-   _[Mathumithan](https://github.com/Mathu20011013)_
-   _[Shenal](https://github.com/Shen-fons)_
-   _[Dinan](https://github.com/DDJkln)_
-   _[Hashan](https://github.com/Hashan-Samarakkody)_
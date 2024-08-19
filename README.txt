SwiftStock is a web-based Inventory Management System built with PHP and MySQL. 
It helps users manage inventory items efficiently with features like item addition, deletion, updates, and reporting.

Prerequisites:
- PHP 7.4+
- MySQL 5.7+
- Apache Web Server
- JavaScript-enabled Web Browser (Chrome, Firefox, Safari, etc.)

Installation:
1. Clone the repository: git clone https://github.com/YOUR-USERNAME/Web-Dev_1.git
2. Move the project folder to your web server's root (e.g., htdocs for Apache).
3. Create a database named swiftstock and import SwiftStock.sql to set up the schema.

Configuration:
1. Edit DBconnection.php with your database credentials:
   - DB_HOST: Your database host (usually 'localhost')
   - DB_USER: Your MySQL username
   - DB_PASSWORD: Your MySQL password
   - DB_NAME: swiftstock

Running the Application:
1. Start Apache and MySQL services.
2. Access the application via your web browser at http://localhost/Web_Dev-1/.
3. Default users,
	User name :- user
	Password :- User@001

Error Handling:
- Database Connection Issues: Verify MySQL server is running and credentials in DBconnection.php are correct.
- PHP Errors: Enable error reporting by setting display_errors to On in php.ini.
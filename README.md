# SkiMania Shop

SkiMania Shop is a web application for an online ski equipment store. The application allows users to browse products, register and log in, place orders, send contact messages, and provides an admin panel for managing users, products, orders, and client messages.

The project was built using PHP, MySQL, and XAMPP as a local development server.

---

## Application Features

The application supports two user roles:

- **Admin**
- **User**

After login, a session is assigned based on the user role stored in the database. Depending on whether the account is marked as `admin` or `user`, the user gets access to different parts of the application.

---

## User Roles

### Guest User

A guest user can:

- view the homepage
- browse the shop
- view available products

Guest users cannot send contact messages or place orders. To use these features, they need to register and log in.

---

### Logged-in User

A logged-in user can:

- browse products
- place orders
- send contact messages, suggestions, and questions
- use the main features of the online shop

---

### Admin User

The admin has all the features of a regular customer, but also has access to the admin panel.

The admin can:

- browse the shop as a customer
- place orders
- access the admin panel
- view all client contact messages
- view all orders
- view all registered users
- add new users
- edit user information
- delete users
- add new products
- edit existing products
- delete products

---

## Technologies Used

The project was built using the following technologies:

- HTML
- CSS
- Bootstrap
- JavaScript
- jQuery
- PHP
- MySQL
- XAMPP
- phpMyAdmin

---

## How to Run the Project Locally

To run this project locally, you need to have XAMPP installed.

### 1. Clone the Repository

```bash
git clone https://github.com/gobeljanovic/SkiMania-Shop-php.git
```

### 2. Move the Project to the XAMPP Folder
Move the project folder into the htdocs directory.

Example path:
```bash
C:\xampp\htdocs\SkiMania-Shop-php
```

### 3. Start XAMPP
Open the XAMPP Control Panel and start:
- Apache
- MySQL

### 4. Create the Database
Open phpMyAdmin in your browser:
```bash
http://localhost/phpmyadmin
```
Create a new database.

### 5. Import the Database
In phpMyAdmin, select the created database, click on Import, and import the SQL file located in the project folder.
Example:
```bash
database/skimaniaDB.sql
```

### 6. Configure the Database Connection
If needed, check and update the database connection settings in the PHP file used for connecting to the database.

Example XAMPP local settings:
```bash
$host = "localhost";
$user = "root";
$password = "";
$database = "skimania";
```
### 7. Run the Application
Open the project in your browser:
```bash
http://localhost/SkiMania-Shop-php
```
### Demo Accounts
The database contains test accounts that can be used to test the application features.
- Admin Account
```bash
Email: admin@example.com
Password: admin123
```
- User Account
```bash
Email: user@example.com
Password: user123
```
Note: Passwords in the database are stored in hashed format.
## Notes

This project was created as a school project and is also used for portfolio purposes. The main focus of the project was not on advanced frontend design, but on implementing the core functionality of an online shop.

The project demonstrates user authentication, role-based access control, session handling, product management, order management, contact messages, and communication between users and the admin.

The frontend was built using HTML, CSS, Bootstrap, JavaScript, and jQuery, while the backend functionality was implemented using PHP and MySQL.


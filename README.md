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

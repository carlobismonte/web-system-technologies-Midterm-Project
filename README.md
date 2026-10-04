# CodeIgniter Point-of-Sale System

## Project Description

This project is a Point-of-Sale (POS) system developed using CodeIgniter 4 and MySQL.

The system provides:

- Product management
- Customer management
- Staff/User management
- User authentication
- Product image upload
- Staff avatar upload
- Record Sale
- Stock management
- Sales History

## Features

### Product Management
Users can:
- View products
- Add products
- Edit products
- Delete products
- Upload and display product images

### Customer Management
Users can:
- View customers
- Add customers
- Edit customers
- Delete customers

### Staff/User Management
Users can:
- View staff accounts
- Add staff accounts
- Edit staff accounts
- Delete staff accounts
- Upload and display avatars
- Store passwords using password hashing

### Authentication

The system includes:
- Login
- Logout
- Session management
- Protected management pages

### Sales

A logged-in staff member can:
- Select a product
- Select an optional customer
- Enter a quantity
- Record a sale
- Automatically calculate the total price
- Automatically decrease product stock
- Prevent sales that exceed available stock

### Sales History

The system displays:
- Product
- Customer
- Staff member
- Quantity
- Total price
- Sale date

## Requirements

- PHP
- XAMPP
- MySQL
- CodeIgniter 4
- Composer
- Web browser

## Installation

1. Copy the project into the XAMPP `htdocs` folder.

2. Start Apache and MySQL using XAMPP.

3. Create a MySQL database named:

   `tasks_db`

4. Import the included:

   `tasks_db.sql`

   file into phpMyAdmin.

5. Configure the database connection in the local `.env` file.

6. Open a terminal in the project folder.

7. Run:

   `php spark serve`

8. Open the application in a browser:

   `http://localhost:8080`

## Database

The project uses the following tables:

- `products`
- `customers`
- `users`
- `sales`

The `sales` table connects products, customers, and staff members.

## Test Account

For local testing, create or use a staff account through the application.

Passwords are stored using password hashing.

## Project Repository

GitHub Repository:

https://github.com/carlobismonte/web-system-technologies-Midterm-Project
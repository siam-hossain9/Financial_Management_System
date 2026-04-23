# 💰 FinTech – Financial Management System

**FinTech** is a full-stack, web-based financial management platform designed to help both individuals and small business owners take control of their finances. Whether you are tracking personal savings goals or monitoring business cash flow, FinTech delivers a clean, intuitive interface backed by a robust PHP/MySQL architecture.

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Screenshots](#screenshots)
- [Getting Started](#getting-started)
- [Project Structure](#project-structure)
- [License](#license)

---

## Overview

Managing money effectively is one of the most important skills for individuals and businesses alike. FinTech simplifies that process by providing dedicated dashboards, detailed transaction histories, and savings tracking — all in one place. The platform supports two distinct user types so that the experience is always tailored to the user's needs:

- **Personal Users** – track household income, everyday expenses, and personal savings targets.
- **Small Business Owners** – monitor business revenue and expenditures, manage operational costs, and review financial history at a glance.

---

## Features

| Feature | Description |
|---|---|
| 🔐 Secure Authentication | User registration, login, and session management for both user types |
| 📊 Interactive Dashboard | At-a-glance summary of income, expenses, and savings |
| 💳 Expense Management | Add, edit, delete, and categorize expense records |
| 🏦 Savings Tracking | Set and monitor savings goals with a dedicated savings module |
| 📜 Transaction History | Full searchable history of all financial activity |
| 🛠️ Account Settings | Update personal or business profile and account preferences |
| 📦 Service Plans | Choose between Personal and Business plans from the Services page |
| 📱 Responsive UI | Mobile-friendly design built with modern HTML, CSS, and JavaScript |

---

## Tech Stack

- **Backend:** PHP (MVC architecture)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, JavaScript
- **Server:** Apache / any PHP-compatible web server

---

## Screenshots

### 🏠 Home Page – Hero Section
![Home Hero](Screenshot%202026-02-05%20194621.png)

---

### 🏠 Home Page – Why Choose Us
![Why Choose Us](Screenshot%202026-02-05%20194635.png)

---

### 🏠 Home Page – Feature Highlights
![Feature Highlights](Screenshot%202026-02-05%20194644.png)

---

### 🏠 Home Page – Footer
![Footer](Screenshot%202026-02-05%20194655.png)

---

### 📦 Services – Pricing Plans
![Services Page](Screenshot%202026-02-05%20194705.png)

---

### 🔑 Login Page
![Login](Screenshot%202026-02-05%20194714.png)

---

### 📝 Registration Page
![Registration](Screenshot%202026-02-05%20194722.png)

---

### 📊 Personal User – Dashboard
![Personal Dashboard](Screenshot%202026-02-05%20194854.png)

---

### 💳 Personal User – Expense Tracker
![Personal Expenses](Screenshot%202026-02-05%20194902.png)

---

### 🏦 Personal User – Savings Tracker
![Personal Savings](Screenshot%202026-02-05%20194913.png)

---

### 📊 Small Business Owner – Dashboard
![Business Dashboard](Screenshot%202026-02-05%20194921.png)

---

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 / MariaDB 10.3 or higher
- Apache or Nginx web server (XAMPP / WAMP / LAMP recommended for local development)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/siam-hossain9/Financial_Management_System.git
   ```

2. **Import the database**
   - Open phpMyAdmin (or your preferred MySQL client)
   - Create a new database (e.g., `financialmanagementsystem`)
   - Import `financialmanagementsystem.sql` into the newly created database

3. **Configure the database connection**
   - Navigate to the model files inside `layouts/models/`, `personal_user/models/`, and `small_business_owner/models/`
   - Update the database host, username, password, and database name to match your environment

4. **Serve the project**
   - Place the project folder in your web server's document root (e.g., `htdocs` for XAMPP)
   - Start Apache and MySQL services

5. **Access the application**
   - Open your browser and navigate to `http://localhost/Financial_Management_System`

---

## Project Structure

```
Financial_Management_System/
│
├── layouts/                    # Shared components (header, footer, home, services, login)
│   ├── assets/                 # Images and shared media
│   ├── controllers/            # Route controllers for public pages
│   ├── css/                    # Global stylesheets
│   ├── models/                 # Database connection and shared models
│   └── views/                  # Shared page templates (home, services, login, etc.)
│
├── personal_user/              # Personal user module
│   ├── controllers/            # Dashboard, expense, savings controllers
│   ├── models/                 # Personal user data models
│   ├── views/                  # Dashboard, expense, savings, settings views
│   └── css/                    # Module-specific styles
│
├── small_business_owner/       # Small business owner module
│   ├── controllers/            # Business dashboard, expense, savings controllers
│   ├── models/                 # Business data models
│   ├── views/                  # Business dashboard, expense, savings, settings views
│   └── css/                    # Module-specific styles
│
└── financialmanagementsystem.sql   # Full database schema with sample data
```

---

## License

This project is licensed under the [MIT License](LICENSE).

---

> Built with ❤️ by [Siam Hossain](https://github.com/siam-hossain9)

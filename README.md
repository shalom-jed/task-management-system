# Task Management System

A simple task manager built with Core PHP, MySQL, and vanilla JavaScript.

## Setup Instructions

### 1. Start XAMPP
- Open XAMPP Control Panel
- Start **Apache** and **MySQL**

### 2. Create Database
- Open phpMyAdmin: `http://localhost/phpmyadmin`
- Create database: `intern_task_system`
- Click **Import** tab → choose `database.sql` from this folder → click **Go**

### 3. Configure Database (if needed)
- Open `includes/db.php`
- Default credentials (XAMPP):  
  `$user = 'root'`  
  `$pass = ''`

### 4. Run the Project
- Move this `project` folder to `C:\xampp\htdocs\` (or your web server root)
- Open browser and go to:  
  `http://localhost/project/index.php`

## Features
- Add, update status, delete tasks
- Search by title (live)
- Filter by priority
- Dark mode toggle
- Responsive design

## Tech Stack
- PHP (Core), MySQL, HTML5, CSS3, JavaScript, Bootstrap 5

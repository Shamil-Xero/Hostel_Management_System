# Hostel Management System

A lightweight, clean, and intuitive web-based application designed to manage hostel student registrations and room allocations. Built as a summer internship project, this application provides an administrative dashboard to monitor room occupancy, add or update student details, and assign rooms with real-time feedback and search capabilities.

## 🚀 Features

- **Dashboard Statistics**: View total registered students, currently occupied rooms, and remaining available rooms (based on a 100-room capacity limit).
- **Admin Authentication**: Secure login system with session protection for all administrative actions.
- **Student Directory Management**:
  - Add new students with validation (name, course).
  - Edit student details.
  - Delete student records with confirmation prompts.
- **Room Allocation**:
  - Assign unique room numbers to students.
  - Checks room availability to prevent double-booking/assigning a room to multiple students.
- **Live Search**: Instant table-row filtering on the student list screen for quick navigation.
- **Interactive Feedback**: Dynamic success/error alerts with fade-in animations that auto-dismiss.

---

## 🛠️ Tech Stack

- **Backend**: PHP (Object-Oriented Database Interactions using `mysqli`)
- **Frontend**: HTML5, Vanilla CSS, JS (ES6)
- **CSS Framework**: [Bootstrap 5](https://getbootstrap.com/) & [Bootstrap Icons](https://icons.getbootstrap.com/)
- **Libraries**: jQuery 3.6.0 (used for UI support)
- **Database**: MySQL

---

## 📁 File Structure

```text
Hostel_Management_System/
│
├── css/
│   └── style.css            # Custom styling & animations
├── js/
│   └── script.js            # Front-end search, validation & alerts
├── includes/
│   ├── db.php               # Database connection settings
│   ├── header.php           # Common header & navigation guard
│   └── footer.php           # Common footer
│
├── index.php                # Admin login page
├── dashboard.php            # Statistics & activity overview
├── add_student.php          # Add a new student profile
├── view_students.php        # Searchable table of all students
├── edit_student.php         # Modify student data
├── assign_room.php          # Manage room numbers allocation
│
├── db.sql                   # MySQL database schema setup script
└── README.md                # Project documentation
```

---

## 📥 Installation & Setup

Follow these steps to host and run this project locally:

### 1. Prerequisites
Ensure you have a local web server with PHP and MySQL capabilities installed. Standard stacks include:
- **XAMPP** (Windows/macOS/Linux)
- **WampServer** (Windows)
- **LAMP Stack** (Linux)
- **MAMP** (macOS)

### 2. Database Configuration
1. Start your **Apache** and **MySQL** servers from your control panel.
2. Open your browser and navigate to `http://localhost/phpmyadmin`.
3. Create a new database named `hostel`.
4. Import the database structure using the `db.sql` file provided, or execute the SQL command below:
   ```sql
   CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100),
       course VARCHAR(50),
       room_no VARCHAR(10)
   );
   ```

### 3. Deploy Project Files
1. Copy or clone the project folder into your server's root directory:
   - For **XAMPP**: `htdocs/`
   - For **WAMP**: `www/`
   - For **LAMP**: `/var/www/html/`
2. Ensure database configuration in `includes/db.php` matches your local environment database credentials:
   ```php
   $conn = new mysqli("localhost", "your_mysql_username", "your_mysql_password", "hostel");
   ```

### 4. Run the Application
Navigate to the application in your browser:
```
http://localhost/Hostel_Management_System/index.php
```

---

## 🔑 Login Credentials

Use the default administrator credentials below to log in:

- **Username**: `admin`
- **Password**: `admin123`

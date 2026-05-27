# Student Management System (PHP REST API + Frontend)

## 🚀 Features
- Add Student
- Edit Student
- Delete Student
- Search Student
- REST API (PHP)
- Modern UI (Bootstrap + JS Fetch)

---

## 🧰 Tech Stack
- PHP (Backend API)
- MySQL (Database)
- HTML, CSS, JavaScript
- Bootstrap 5

---

## 📂 Project Structure
```bash
student-modern-app/
│── api/
│── config/
│── frontend/
│── assets/
|── docker-compose.yml
|── start.bat
|── stop.bat
```
---

## ⚙️ Setup Instructions

### Step 1. Clone project
```bash
git clone https://github.com/[your-username]/student-management-system.git

```

### Step 2: Docker-compose-setup for MYSQL_DB Connection

# Start database
```bash
docker-compose up -d

```

# Start PHP server
```bash
php -S localhost:8000

```

### Step 3: Open browser
```bash
http://localhost:8000/frontend/index.html

```

---

## 🗄️ Database Setup

```sql
CREATE DATABASE student_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    course VARCHAR(100)
);
```

## 📌 API Endpoints
- GET /api/students.php
- POST /api/students.php
- PUT /api/students.php
- DELETE /api/students.php

---

## 👨‍💻 Author
Sankara Subramanian

---

# Single click to start and stop the project in Windows 
```bash
**Start for windows**
run the start.bat

**Stop for windows**
run the stop.bat
```
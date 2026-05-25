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

student-modern-app/
│── api/
│── config/
│── frontend/
│── assets/
---

## ⚙️ Setup Instructions

### 1. Clone project

git clone https://github.com/your-username/student-app.git


### 2. Start PHP server

php -S localhost:8000


### 3. Open browser

http://localhost:8000/frontend/index.html


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

## Docker-compose-setup for MYSQL_DB Connection
# Step 1: Start database
```bash
docker-compose up -d
```

# Step 2: Start PHP server
```bash
php -S localhost:8000
```

# Step 3: Open app
```bash
http://localhost:8000/frontend/index.html
```


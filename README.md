# 📚 Student Management System

A modern, full-stack web application for managing student records with user authentication. Built with PHP REST API, MySQL databases, and a responsive Bootstrap UI.

---

## ✨ Features

### 🔐 Authentication System

- **User Registration** - Create new user accounts with secure password hashing (bcrypt)
- **User Login** - Authenticate users with email and password
- **Session Management** - Maintain user sessions with PHP
- **Logout** - Securely end user sessions

### 👨‍🎓 Student Management

- **Add Students** - Create new student records with name, email, and course
- **View Students** - Display all students in a responsive table
- **Search Students** - Real-time search by name, email, or course
- **Edit Students** - Update existing student information
- **Delete Students** - Remove student records from the system

### 🎨 User Interface

- **Modern Bootstrap 5 Design** - Clean, responsive UI for desktop and mobile
- **Interactive Dashboard** - Real-time student count and statistics
- **Modal Forms** - Inline editing and creation dialogs
- **Search Functionality** - Live filtering of student records
- **Admin Sidebar** - Navigation and quick access to features

---

## 🧰 Tech Stack

**Backend:**

- PHP 7+ (REST API)
- MySQL 8.0 (Database)

**Frontend:**

- HTML5
- CSS3
- JavaScript (Vanilla - Fetch API)
- Bootstrap 5 (UI Framework)

**Infrastructure:**

- Docker & Docker Compose (Containerization)
- Windows Batch Scripts (.bat) for automation

---

## 📂 Project Structure

```
student-management-modern/
│
├── frontend/                    # Frontend HTML pages
│   ├── index.html              # Main dashboard (protected)
│   ├── login.html              # Login page
│   └── register.html           # Registration page
│
├── login/
│   └── login-api/              # Authentication endpoints
│       ├── login.php           # POST - User login
│       ├── register.php        # POST - User registration
│       ├── logout.php          # POST - User logout
│       └── check-login.php     # GET - Check session status
│
├── api/
│   └── students.php            # Student management endpoints
│                               # GET - Fetch all/search students
│                               # POST - Add new student
│                               # PUT - Update student
│                               # DELETE - Remove student
│
├── config/                     # Database configurations
│   ├── auth_db.php            # Auth database connection (port 3308)
│   └── student_db.php         # Student database connection (port 3307)
│
├── assets/                     # Static resources
│   └── app.js                 # Main JavaScript logic
│
├── db/                         # Database initialization scripts
│   ├── authdb_init.sql        # Auth DB schema
│   └── studentdb_init.sql     # Student DB schema
│
├── docker-compose.yml          # Docker services definition
├── start.bat                   # Windows startup script
├── stop.bat                    # Windows shutdown script
└── README.md                   # This file

```

---

## ⚙️ Setup Instructions

### Prerequisites

- Docker & Docker Compose installed
- PHP 7+ installed (if not using Docker)
- Git installed
- Browser with JavaScript enabled

### Quick Start (Windows)

#### Option 1: Automated (Recommended)

```bash
# Start the project
start.bat

# Stop the project
stop.bat
```

#### Option 2: Manual Setup

**Step 1: Start Docker Containers**

```bash
docker-compose up -d
```

This will start two MySQL containers:

- `student_db` on port 3307 (Student database)
- `auth_db` on port 3308 (Authentication database)

**Step 2: Start PHP Development Server**

```bash
php -S localhost:8000
```

**Step 3: Open in Browser**
Navigate to: `http://localhost:8000/frontend/login.html`

---

## 🔑 Default Credentials

After running `docker-compose up`, the databases are initialized automatically. Create a test account:

1. Go to **Register Page**: `http://localhost:8000/frontend/register.html`
2. Create a test account
3. Log in with your credentials
4. Manage students on the dashboard

---

## 📊 Database Schema

### Authentication Database (`auth_db`)

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Student Database (`student_db`)

```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    course VARCHAR(100)
);
```

---

## 🔌 API Endpoints

All endpoints return JSON responses.

### Authentication Endpoints

| Method | Endpoint                           | Description          | Auth Required |
| ------ | ---------------------------------- | -------------------- | ------------- |
| POST   | `/login/login-api/register.php`    | Register new user    | No            |
| POST   | `/login/login-api/login.php`       | Login user           | No            |
| POST   | `/login/login-api/logout.php`      | Logout user          | Yes           |
| GET    | `/login/login-api/check-login.php` | Check session status | No            |

### Student Endpoints

| Method | Endpoint                           | Description      | Auth Required |
| ------ | ---------------------------------- | ---------------- | ------------- |
| GET    | `/api/students.php`                | Get all students | Yes           |
| GET    | `/api/students.php?search=keyword` | Search students  | Yes           |
| POST   | `/api/students.php`                | Create student   | Yes           |
| PUT    | `/api/students.php`                | Update student   | Yes           |
| DELETE | `/api/students.php`                | Delete student   | Yes           |

### Request/Response Examples

**Register User**

```bash
curl -X POST http://localhost:8000/login/login-api/register.php \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password123"}'
```

**Login User**

```bash
curl -X POST http://localhost:8000/login/login-api/login.php \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'
```

**Add Student**

```bash
curl -X POST http://localhost:8000/api/students.php \
  -H "Content-Type: application/json" \
  -d '{"name":"Alice Smith","email":"alice@example.com","course":"Computer Science"}'
```

**Search Students**

```bash
curl http://localhost:8000/api/students.php?search=Alice
```

---

## 🔒 Security Features

- **Password Hashing** - Uses PHP's `password_hash()` with bcrypt algorithm
- **Prepared Statements** - Protects against SQL injection attacks
- **Session Management** - Server-side session handling
- **Input Validation** - Server-side validation of all inputs
- **HTTPS Ready** - Can be deployed with HTTPS

---

## 🛠️ Troubleshooting

**Database Connection Error**

- Ensure Docker is running: `docker ps`
- Check ports 3307 and 3308 are available
- Verify credentials in `config/` files

**PHP Server Not Starting**

- Check if port 8000 is available
- Try: `php -S 0.0.0.0:8000` for network access
- Use different port: `php -S localhost:8001`

**Login Page Shows Blank**

- Check browser console (F12) for JavaScript errors
- Verify PHP server is running
- Clear browser cache and reload

**Students Not Loading**

- Ensure you're logged in
- Check if `api/students.php` responds: Visit `http://localhost:8000/api/students.php` in browser
- Check PHP error logs

---

## 📝 Development Notes

### Session Handling

- Sessions are started in login.php
- User data stored in `$_SESSION['user_id']` and `$_SESSION['user_name']`
- Checked on every page load for authentication

### Frontend Architecture

- Vanilla JavaScript (no framework dependencies)
- Fetch API for HTTP requests
- Modal dialogs for add/edit operations
- Real-time search with debouncing

### Database Connections

- Separate databases for auth and students (security boundary)
- Each file includes respective config file
- Connection errors return JSON error responses

---

## 🚀 Deployment

### Deploy to Production

1. Change database credentials in `config/` files
2. Use a production database server instead of Docker
3. Enable HTTPS on the web server
4. Set proper file permissions
5. Add error logging instead of error output
6. Use environment variables for sensitive data

### Docker Production Build

```bash
# Build custom image
docker build -t student-mgmt:1.0 .

# Run with production settings
docker run -e MYSQL_PASSWORD=secure_password -p 80:8000 student-mgmt:1.0
```

---

## 📋 Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Requires JavaScript enabled

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is open source and available under the MIT License.

---

## 👨‍💻 Author

**Karthis Sankar**

- GitHub: [@karthisankar21](https://github.com/karthisankar21)
- Project: [student-management-system](https://github.com/karthisankar21/student-management-system)

---

## 📞 Support

For issues, questions, or suggestions:

- Open an issue on GitHub
- Check existing issues for solutions
- Review the Troubleshooting section

---

**Last Updated:** 2024
**Version:** 1.0.0

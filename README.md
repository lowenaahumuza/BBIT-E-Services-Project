# BBIT E Services Project

## Git & GitHub Exercise - Part II

**NAME :** AHUMUZA LOWENA 191339 
**Course:** BBIT E
**Deadline:** September 18th, 2025, 11:59 PM

## Project Overview
This project demonstrates a complete Git workflow for the BBIT E Services system, which includes user registration with email notifications and user listing functionality.

## Features Implemented ✅
- **User Registration System** with email validation
- **PHPMailer Integration** for welcome emails
- **Numbered User List Display** (ascending order by name)
- **Database Integration** (MySQL)
- **Responsive Web Design**
- **Error Handling** and user feedback
- **Complete Git Workflow** documentation

## Project Files
1. **`mail_fixed.php`** - Clean user registration system with PHPMailer
2. **`user_list.php`** - Displays numbered list of users from database (ascending order)
3. **`git_workflow.txt`** - Complete Git workflow documentation
4. **`mail.php`** - Original file (with syntax errors, kept for reference)
5. **`README.md`** - This documentation file

## Technical Requirements Met
- ✅ **Numbered list of users in ascending order** (4 marks)
- ✅ **Users stored and retrieved from database**
- ✅ **Professional styling and layout**
- ✅ **Form validation and sanitization**
- ✅ **Email functionality with PHPMailer**
- ✅ **Complete Git workflow implementation**

## How to Run
1. Set up a local web server (Apache/Nginx)
2. Create MySQL database named `bbit_services`
3. Create `users` table with columns: `id`, `name`, `email`, `created_at`
4. Configure database connection in the PHP files
5. Access `mail_fixed.php` for user registration
6. Access `user_list.php` to view numbered user list

## Database Schema
```sql
CREATE DATABASE bbit_services;
USE bbit_services;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Git Workflow Used
1. **Initialize** Git repository
2. **Stage** all project files
3. **Commit** changes with descriptive messages
4. **Push** to remote GitHub repository

## Deliverable
- **Repository Link:** [GitHub Repository URL]
- **All project files** committed and pushed
- **Documentation** of Git workflow process

## Screenshots
- User registration form with validation
- Numbered user list display (ascending order)
- Email functionality demonstration
- Git commit history

---
**Project Status:** ✅ **COMPLETED**  
**Submission Date:** September 16, 2025

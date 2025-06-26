# Database Security Enhancement

Comprehensive security assessment and enhancement of a registration and login module for an Online Property Marketplace web application

[![Course](https://img.shields.io/badge/course-COS20031-green.svg)](https://github.com/audreychee/Database-Security-Enhancement)
[![Platform](https://img.shields.io/badge/platform-XAMPP-orange.svg)](https://www.apachefriends.org/)
[![Language](https://img.shields.io/badge/language-PHP-blue.svg)](https://www.php.net/)
[![Security](https://img.shields.io/badge/security-SQL%20Injection%20Prevention-red.svg)](https://owasp.org/www-community/attacks/SQL_Injection)

> **WARNING: Educational Purpose Only** - This repository contains web application security research for academic purposes. All testing was conducted in controlled local environments with proper safety measures.

## Table of Contents

- Overview
- Features
- Prerequisites
- Installation
- Usage
- Documentation
- Tools
- Results
- Contributing
- Disclaimer

## Overview

This repository documents a comprehensive database security assessment and enhancement project for an Online Property Marketplace web application. The study focuses on identifying and mitigating SQL injection vulnerabilities in authentication modules using both manual and automated testing methodologies.

### Key Objectives
- Identify SQL injection vulnerabilities in web application authentication systems
- Implement robust security measures using parameterized queries and input validation
- Conduct systematic vulnerability testing using OWASP ZAP and manual techniques
- Document complete security remediation process with measurable improvements

## Features

- **Comprehensive Vulnerability Assessment**: Manual SQL injection testing and automated OWASP ZAP scanning
- **Security Implementation**: Parameterized queries, input validation, password strength requirements
- **Authentication Security**: Enhanced login/registration modules with proper error handling
- **Client-side Validation**: JavaScript validation for improved user experience and security
- **Measurable Results**: 94% reduction in SQL injection vulnerabilities (16 to 5 false positives)

## Prerequisites

### System Requirements
- **OS**: Windows 10/11 (XAMPP compatible environment)
- **Web Server**: Apache HTTP Server 2.4+
- **Database**: MySQL/MariaDB 10.4+
- **PHP**: Version 7.4 or higher with mysqli extension

### Software Dependencies
```bash
# XAMPP Development Stack
Apache HTTP Server
MySQL Database Server
PHP (with mysqli extension)
phpMyAdmin

# Security Testing Tools
OWASP ZAP (Zed Attack Proxy)
Burp Suite Community (optional)
Modern Web Browser (Chrome/Firefox)
```

## Installation

### 1. Clone Repository
```bash
git clone https://github.com/audreychee/Database-Security-Enhancement.git
cd Database-Security-Enhancement
```

### 2. Set Up XAMPP Environment
```bash
# Download and install XAMPP from https://www.apachefriends.org/
# Start Apache and MySQL services via XAMPP Control Panel
# Place project files in htdocs directory
C:\xampp\htdocs\Database-Security-Enhancement\
```

### 3. Database Configuration
```sql
-- Create database
CREATE DATABASE online_property_marketplace;
USE online_property_marketplace;

-- Create user table
CREATE TABLE userlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert test users
INSERT INTO userlist (fname, lname, email, password) VALUES
('Audrey', 'Chee', 'audrey@gmail.com', '$2y$10$example_hashed_password'),
('Megan', 'Smith', 'megan@gmail.com', '$2y$10$example_hashed_password2');
```

### 4. Configure Database Connection
```php
// config/database.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_property_marketplace";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("Database connection failed. Please try again later.");
}
?>
```

## Usage
### Manual SQL Injection Testing
#### Authentication Bypass Techniques
#### Parameter Injection Testing

### Automated Testing with OWASP ZAP
#### 1. Configure ZAP Context
#### 2. Authentication Configuration
#### 3. Active Scan Execution


### Security Enhancement Implementation
#### 1. Parameterized Queries
#### 2. Input Validation and Sanitization

## Documentation

### Project Structure
```
├── vulnerable/                    
│   ├── account.php
│   ├── contactus.php
│   ├── dashboard.php
│   └── header.php
│   └── login.php
│   └── reg_confirm.php
│   └── register.php
│   └── style.css
│   └── cos20031_proj.sql
│   └── v3_changelog.txt
├── image/
│   ├── logo.png
│   ├── module1.png
│   └── module2.png
│   └── module3.png
│   └── p_pic.png
│   └── settings.png
├── documentation/
│   ├── Evaluation and Enhancement of Database Security for Online Property Marketplace.pdf
└── README.md
```

### Analysis Components
- **Manual Testing**: Authentication bypass and parameter injection testing
- **Automated Scanning**: OWASP ZAP comprehensive vulnerability assessment
- **Security Implementation**: Parameterized queries and input validation
- **Verification Testing**: Post-remediation security validation

## Tools

### Manual Testing Tools
| Tool | Purpose | Effectiveness | Learning Curve |
|------|---------|---------------|----------------|
| **Browser Dev Tools** | Request/response inspection | 5/5 | 2/5 |
| **Burp Suite Community** | Request interception and modification | 4/5 | 3/5 |
| **Manual Payload Crafting** | Custom SQL injection testing | 5/5 | 4/5 |

### Automated Security Tools
| Tool | Detection Rate | Speed | Depth | False Positives |
|------|----------------|-------|-------|-----------------|
| **OWASP ZAP** | 4/5 | 4/5 | 4/5 | Low |
| **SQLMap** | 5/5 | 3/5 | 5/5 | Medium |
| **Nikto** | 3/5 | 5/5 | 3/5 | High |

## Results

### Vulnerability Assessment Results

#### Before Security Implementation
```
Total SQL Injection Vulnerabilities Identified: 14
├── Authentication Bypass (email parameter): 3 instances
├── Boolean-based Injection (fname/lname): 4 instances
├── Time-based Blind Injection (email): 2 instances
├── UNION-based Injection (fname): 3 instances
└── MySQL Error-based Injection (email): 2 instances

OWASP ZAP Scan Results:
├── High Severity Alerts: 8
├── Medium Severity Alerts: 6
├── Low Severity Alerts: 2
└── Total Alerts: 16
```

#### After Security Implementation
```
Remaining Alerts: 5 (All confirmed false positives)
├── Parameter validation functioning correctly: 3
├── Prepared statements preventing injection: 2
└── Input sanitization working as expected: 0

Security Improvement Metrics:
├── Vulnerability Reduction: 94% (14 → 0 real vulnerabilities)
├── Alert Reduction: 69% (16 → 5 false positives)
├── Authentication Security: 100% bypass prevention
└── Database Interaction Security: 100% parameterized
```

### Key Security Enhancements

#### 1. Database Security
- **Prepared Statements**: All database queries use parameterized queries
- **Password Hashing**: bcrypt implementation with appropriate cost factor
- **Connection Security**: Secure database connection handling with error logging
- **Least Privilege**: Database user permissions restricted to necessary operations

#### 2. Input Validation
- **Server-side Validation**: Comprehensive validation for all user inputs
- **Email Validation**: RFC-compliant email format checking
- **Name Validation**: Alphabetic character restrictions with length limits
- **Password Policy**: Complex password requirements with strength validation

#### 3. Authentication Security
- **Session Management**: Secure session handling with regeneration
- **CSRF Protection**: Cross-site request forgery prevention tokens
- **Error Handling**: Generic error messages preventing information disclosure
- **Brute Force Protection**: Account lockout mechanisms (recommended for future implementation)

### Performance Impact Analysis
- **Query Performance**: No measurable performance degradation with prepared statements
- **User Experience**: Improved feedback with client-side validation
- **Security Overhead**: Minimal processing cost for validation routines
- **Maintainability**: Enhanced code structure and security documentation

## Contributing

Contributions are welcome for educational enhancement! Please read our Contributing Guidelines.

### Security Research Areas
- Advanced SQL injection bypass techniques
- NoSQL injection vulnerability assessment
- Authentication mechanism security analysis
- Session management security improvements

### Development Setup
```bash
# Fork the repository
git fork https://github.com/audreychee/Database-Security-Enhancement.git

# Create feature branch
git checkout -b security/advanced-validation

# Implement security enhancement
git add .
git commit -m "Add advanced input validation techniques"

# Submit pull request
git push origin security/advanced-validation
```

## Disclaimer

**IMPORTANT**: This repository is for **educational and research purposes only**.

- **Academic Project**: Conducted under university supervision (COS20031 Individual Portfolio)
- **Controlled Environment**: All testing performed on local XAMPP installation
- **No Real Data**: Test environment uses dummy data and isolated database
- **Ethical Research**: Follows responsible security research practices

### Security Guidelines
1. **Local Testing Only**: Never test SQL injection on systems you don't own
2. **Authorized Testing**: Only test applications with explicit permission
3. **Responsible Disclosure**: Report real vulnerabilities through proper channels
4. **Educational Use**: Knowledge should improve security, not exploit systems

## Authors & Acknowledgments

- **Author**: Audrey Vanessa Chee Wan Tai
- **Course**: COS20031 Individual Portfolio
- **Institution**: Swinburne University of Technology Sarawak
- **Academic Year**: 2024

### Special Thanks
- Course instructors and cybersecurity mentors
- OWASP community for security testing tools and methodologies
- PHP security community for secure coding best practices
- Web application security researchers and ethical hackers

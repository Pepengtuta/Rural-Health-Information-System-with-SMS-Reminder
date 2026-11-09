# Rural Health Information System with SMS Reminder (Mother's Book)

![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-mbms__db-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/License-Academic%20%2F%20Capstone-blue?style=for-the-badge)

A web-based maternal and child healthcare management information system designed to digitize health records, streamline prenatal checkups and child immunization tracking, and automate appointment notifications through an SMS reminder service for **Barangay Laguinbanua East Health Center, Numancia, Aklan**.

---

## 📌 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [System Architecture & Tech Stack](#-system-architecture--tech-stack)
- [Folder Structure](#-folder-structure)
- [Prerequisites](#-prerequisites)
- [Installation & Setup](#-installation--setup)
- [SMS Reminder Gateway Configuration](#-sms-reminder-gateway-configuration)
- [Database Schema](#-database-schema)
- [Project Team](#-project-team)
- [License](#-license)

---

## 📖 Overview

In many rural health units (RHUs) and barangay health centers, maternal and child healthcare records are traditionally tracked using physical paper records (e.g., Mother's Book / Mother & Child Passports). Physical records are vulnerable to damage, loss, and wear, and tracking follow-up visits or vaccination schedules is often prone to missed appointments.

**Rural Health Information System with SMS Reminder (Mother's Book)** solves these challenges by providing:
1. A centralized digital repository for maternal health records, prenatal trimesters, and child immunization schedules.
2. An automated SMS notification mechanism to alert mothers about their scheduled prenatal appointments and child vaccination dates.
3. Report generation and record printing for health workers and midwives.

---

## 🚀 Key Features

### 🤰 Maternal Health Record Management (Mother's Book)
- Comprehensive maternal profiling and medical history.
- Dedicated monitoring modules across all stages:
  - **First Trimester Tracking**: Initial assessment, lab findings, vitals, medical history.
  - **Second Trimester Tracking**: Growth assessment, ultrasound milestones, supplements.
  - **Third Trimester Tracking**: Delivery readiness, birth plan, final trimester evaluations.
- Historical checkup timeline and printable medical summaries.

### 👶 Child Registration & Immunization Tracking
- Digital birth recording and profile management for newborns.
- Complete immunization schedule tracking (BCG, Hepatitis B, Pentavalent, Oral Polio, Measles/MMR, etc.).
- Printable immunization record cards powered by FPDF.

### 📅 Midwife Scheduling & Appointment System
- Midwife duty schedules (available days, duty hours, active status).
- Appointment booking module for:
  - Prenatal Checkups
  - Child Immunization
- Appointment status lifecycle: *Pending*, *Approved*, *Declined*.

### 📱 Real-Time SMS Reminder Gateway
- Dynamic SMS template generation tailored to appointment type, patient name, midwife, date, and time.
- Integrated WebSocket client (`WebSocket` API) connecting to an SMS gateway device/application to send SMS reminders directly to the mother's mobile number upon appointment approval.

### 📄 Reports & Printable Documents
- Formatted PDF exports for patient profiles, checkup histories, immunization records, and health center summaries using the **FPDF** library.
- Filterable and searchable patient tables with DataTables.

### 🔐 User & Access Management
- Multi-role authentication (Admin, Midwives, Health Center Staff).
- Secure password management and profile configuration.

---

## 🛠 System Architecture & Tech Stack

- **Backend:** PHP (Procedural / MySQLi)
- **Database:** MySQL / MariaDB (`mbms_db`)
- **Frontend:** HTML5, CSS3, JavaScript (ES6), jQuery, Bootstrap 4, Font Awesome
- **PDF Generation:** FPDF library
- **SMS Gateway:** WebSocket Client (`ws://<gateway-ip>:<port>`) communicating with a mobile SMS server app
- **Server Environment:** Apache (via XAMPP, WAMP, or standalone LAMP/LEMP)

---

## 📂 Folder Structure

```text
├── .vscode/                     # VS Code workspace settings
├── login/                       # Authentication and management portal
│   ├── css/                     # Stylesheets and Bootstrap files
│   ├── fonts/                   # Web fonts and icon fonts
│   ├── fpdf/                    # FPDF PHP library for document export
│   ├── images/                  # Images, logos, team photos, and assets
│   ├── js/                      # JavaScript libraries and custom scripts
│   ├── scss/                    # SASS source files
│   ├── system/                  # Main application modules and dashboards
│   │   ├── includes/            # Database connection & configurations
│   │   ├── header.php           # Portal header & navigation bar
│   │   ├── sidebar.php          # Main sidebar navigation
│   │   ├── footer.php           # Portal footer and common scripts
│   │   ├── dashboard.php        # System overview and statistical widgets
│   │   ├── appointments.php     # Appointment listings & approvals
│   │   ├── send.php             # Appointment creation & SMS message generator
│   │   ├── edit-appointment.php # SMS dispatch via WebSocket gateway
│   │   ├── register-patient.php # Maternal record registration
│   │   ├── register-baby.php    # Newborn registration
│   │   ├── register-immunization.php # Vaccine record registration
│   │   ├── schedule.php         # Midwife schedule management
│   │   └── report.php           # Reporting and export dashboard
│   ├── forgot_password.php      # Password recovery page
│   └── index.php                # Staff and Admin login page
├── about.php                    # About the Mother's Book project
├── index.php                    # Public landing page with video background
├── mbms_db.sql                  # Complete MySQL database export
├── team.php                     # Capstone project team profile page
└── README.md                    # Project documentation
```

---

## 📋 Prerequisites

Before running the application, make sure you have installed:
1. **XAMPP** (recommended) or **WAMP** with:
   - **PHP:** version 7.4 or later
   - **MySQL / MariaDB:** version 5.7 / 10.4 or later
   - **Apache Web Server**
2. A modern web browser (Google Chrome, Mozilla Firefox, Microsoft Edge).
3. *(Optional for SMS Reminders)* An Android device running an SMS Gateway application with WebSocket support on the same local network.

---

## ⚙️ Installation & Setup

### 1. Clone or Copy the Repository
Clone or place this repository inside your local web server's root folder (`htdocs` for XAMPP):
```bash
cd C:/xampp/htdocs/vsp/CAPSTONE
git clone https://github.com/Pepengtuta/Rural-Health-Information-System-with-SMS-Reminder.git team
```

### 2. Start Apache and MySQL
Open the **XAMPP Control Panel** and start both **Apache** and **MySQL**.

### 3. Import the Database
1. Open your browser and navigate to `http://localhost/phpmyadmin/`.
2. Click **New** and create a new database named:
   ```text
   mbms_db
   ```
3. Select the created `mbms_db` database and click the **Import** tab.
4. Choose the `mbms_db.sql` file located at the root of this project and click **Import** (or **Go**).

### 4. Verify Database Connection
Check `login/system/includes/connection.php` to ensure your database credentials match your local setup:
```php
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "mbms_db";
$connection = mysqli_connect("$server", "$username", "$password");
$select_db = mysqli_select_db($connection, $database);
if(!$select_db) {
    echo("connection terminated");
}
?>
```

### 5. Access the Application
- **Public Landing Page:**
  ```text
  http://localhost/vsp/CAPSTONE/team/index.php
  ```
- **Login Portal:**
  ```text
  http://localhost/vsp/CAPSTONE/team/login/index.php
  ```

---

## 📲 SMS Reminder Gateway Configuration

The system uses a WebSocket client to send SMS messages through a local SMS gateway application running on a connected device (e.g., an Android device running a WebSocket SMS server).

1. Locate the WebSocket configuration in `login/system/edit-appointment.php`:
   ```javascript
   var wsUri = 'ws://192.168.123.51:8030';
   ```
2. Replace `192.168.123.51:8030` with the local IP address and port of your active SMS Gateway server.
3. When an appointment is set to **Approved** and saved, the payload containing the mother's phone number and message template is dispatched:
   ```json
   {
       "receiver": "09123456789",
       "message": "Good day [Patient]! Your prenatal checkup has been scheduled for [Date] at [Time]..."
   }
   ```

---

## 🗄 Database Schema

The database `mbms_db` includes the following core tables:

| Table Name | Description |
| :--- | :--- |
| `tbl_employee` | User accounts, credentials, and staff information |
| `tbl_role` | User role definitions (Admin, Midwife, Healthcare Worker) |
| `tbl_patients` | Primary maternal patient records and contact details |
| `tbl_first_trimester` | 1st Trimester clinical assessments and history |
| `tbl_second_trimester`| 2nd Trimester clinical examinations and milestones |
| `tbl_third_trimester` | 3rd Trimester prenatal checkups and birth readiness |
| `tbl_baby` | Newborn registration details and maternal linkage |
| `tbl_immunization` | Child vaccine administration and schedule records |
| `tbl_schedule` | Midwife duty hours, availability days, and status |
| `tbl_appointment` | Appointment bookings and approval statuses |
| `tbl_report` | System audit logs and report records |

---

## 👥 Project Team

This system was conceptualized, designed, and developed by:

- **Anne Loraine Pabon** — *Project Manager*
- **Jan Dominique Beltran** — *UI Designer*
- **Anna Rica Tajaran** — *Programmer*
- **Arvin Arboleda** — *System Analyst*
- **Mande Arevalo** — *Technical Writer*

---

## 📄 License

Developed for academic / capstone project purposes for **Barangay Laguinbanua East Health Center, Numancia, Aklan**. All rights reserved &copy; 2024.

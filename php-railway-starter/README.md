# PHP + Railway Starter Kit

A production-ready starter template for deploying PHP + MySQL web applications to **Railway** (or any Apache-based cloud / shared hosting like InfinityFree or local XAMPP) with **Pretty / Clean URLs** out of the box.

---

## 📦 What's Included

| File | Purpose |
| :--- | :--- |
| **`Dockerfile`** | Pre-configured container with PHP 8.2, Apache, `mod_rewrite`, `mysqli`, `pdo_mysql`, 64MB upload limits, and Railway dynamic `$PORT` binding. |
| **`.htaccess`** | Production rewrite rules for extensionless URLs (`/about` loads `about.php` without renaming files). Safe for GET & POST requests. |
| **`.dockerignore`** | Keeps git history, local configs, database dumps (`.sql`), `.env` secrets, and dependencies out of your production container build. |

---

## 🚀 How to Use in Any PHP Project

### 1. Copy Files
Copy `Dockerfile`, `.htaccess`, and `.dockerignore` directly into the root folder of your PHP project.

### 2. Connect Database via Environment Variables
In your project's database connection file (e.g., `db.php` or `connection.php`), use environment variables so your code connects to **Railway MySQL** in production while still working on **local XAMPP** without any manual edits:

#### Using MySQLi:
```php
<?php
$server   = getenv('MYSQLHOST') ?: 'localhost';
$username = getenv('MYSQLUSER') ?: 'root';
$password = getenv('MYSQLPASSWORD') ?: '';
$database = getenv('MYSQLDATABASE') ?: 'your_db_name';
$port     = getenv('MYSQLPORT') ?: '3306';

$connection = mysqli_connect($server, $username, $password, $database, (int)$port);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
```

#### Using PDO:
```php
<?php
$host     = getenv('MYSQLHOST') ?: 'localhost';
$db       = getenv('MYSQLDATABASE') ?: 'your_db_name';
$user     = getenv('MYSQLUSER') ?: 'root';
$pass     = getenv('MYSQLPASSWORD') ?: '';
$port     = getenv('MYSQLPORT') ?: '3306';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
```

### 3. Deploy to Railway
1. Push your project to GitHub.
2. In [Railway.app](https://railway.app/), create a **New Project** > **Deploy from GitHub repo**.
3. (Optional) In the same Railway project, click **+ New** > **Database** > **Add MySQL**.
4. Railway will automatically inject `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, etc., and your app will connect automatically!

---

## ⚙️ Customization Guide

### Adding Extra PHP Extensions
If your project requires image processing (**GD**) or zip archive handling (**Zip**), open `Dockerfile` and uncomment:

```dockerfile
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip
```

### Changing PHP Version
To use a different PHP version (e.g., PHP 8.1 or 8.3), simply change the first line of `Dockerfile`:
```dockerfile
FROM php:8.3-apache
```

### Adjusting Upload Limits
The `Dockerfile` comes with generous 64MB upload and 256MB memory limits. To adjust them, edit line 14 in `Dockerfile`:
```dockerfile
RUN echo "upload_max_filesize = 128M\npost_max_size = 128M\nmemory_limit = 512M" > /usr/local/etc/php/conf.d/custom-limits.ini
```

---

## 🌐 How the Pretty URLs Work (`.htaccess`)
- Visiting `/about` internally serves `about.php` (files keep their `.php` extension on disk).
- Directly visiting `/about.php` 301 redirects to `/about` to enforce clean URLs in the browser.
- Query string parameters like `/product?id=123` are preserved (`QSA`).
- `POST` requests are excluded from redirects to ensure forms never lose submitted data.


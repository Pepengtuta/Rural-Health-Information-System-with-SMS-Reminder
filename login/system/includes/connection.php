<?php
// Check if running on localhost (XAMPP) or online (InfinityFree)
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['SERVER_NAME'] === 'localhost') {
    // Local XAMPP Settings
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "mbms_db";
} else {
    // InfinityFree Settings (replace with your details from InfinityFree vPanel)
    $server = "sql310.infinityfree.com"; // Your MySQL Hostname from InfinityFree
    $username = "if0_43391381";           // Your MySQL Username
    $password = "GUYnrxYdeeE";   // Your InfinityFree Password
    $database = "if0_43391381_mbms_db";   // Your Database Name
}

$connection = mysqli_connect($server, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Sets $conn for pages that use $conn instead of $connection
$conn = $connection;
?>
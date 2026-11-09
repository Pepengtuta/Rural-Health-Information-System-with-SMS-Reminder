<?php 
session_start();
if (!empty($_SESSION['name'])) {
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    session_destroy();
}
header('location:../index.php');
exit();
?>
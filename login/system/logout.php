<?php 
session_start();
if(!empty($_SESSION['name']))
{
	unset($_SESSION['name']);
	header('location:/../Mothers_Book/login/index.php');
}
?>
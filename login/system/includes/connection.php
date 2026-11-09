<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "mbms_db";
$connection = mysqli_connect("$server","$username","$password");
$select_db = mysqli_select_db($connection, $database);
if(!$select_db)
{
	echo("connection terminated");
}
?>
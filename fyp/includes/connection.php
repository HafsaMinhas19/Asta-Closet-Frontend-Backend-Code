<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Karachi"); //setting time-zone according to pak time

$con = mysqli_connect('localhost', 'root', ''); //when we work locally, the username of database is "root" by default. 
$db = mysqli_select_db($con, 'asta_closet_db'); //The mysqli_select_db() function is used to change the default database for the connection.


?>
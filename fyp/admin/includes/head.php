<?php
require "connection.php";
require "functions.php";

//admin cannot go to the index page without login
if (isAdminLogin() === false) {
  header("location:login.php");
  exit(); // immediately terminates execution of the script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo getPageTitle(); ?></title>
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
  <link rel="stylesheet" href="assets/css/css_bootstrap.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
<?php
require "includes/connection.php";
require "includes/functions.php";
?>

<?php
$categoryType = $categoryName = $categoryImage = $categoryStatus = $categoryCreatedDate = $categoryID = "";

$categoryTypeTitle = "";
if (isset($_GET['categoryType']) && $_GET['categoryType'] != "") {
  $categoryType = $_GET['categoryType'];
  if ($categoryType == "M") {
    $categoryTypeTitle = "Male";
  } else if ($categoryType == "F") {
    $categoryTypeTitle = "Female";
  } else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewCategoriesListing.php");
    exit();
  }
} else {
  $_SESSION['errorMessage'] = "Access Denied...!";
  header("location:viewCategoriesListing.php");
  exit();
}

if (isset($_GET["categoryID"]) && $_GET["categoryID"] != "") {
  $categoryID = $_GET['categoryID'];
  $sql = "SELECT * FROM `tbl_categories` WHERE `category_id` = '$categoryID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $sql = "DELETE FROM `tbl_categories` WHERE `category_id` = '$categoryID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          $_SESSION['successMessage'] = "Category Deleted Successfully";
          header("location:viewCategoriesListing.php?categoryType=" . $categoryType);
          exit();
        }
      }
    } else {
      $_SESSION['errorMessage'] = "Access Denied...!";
      header("location:viewCategoriesListing.php?categoryType=" . $categoryType);
      exit();
    }
  }
} else {
  $_SESSION['errorMessage'] = "Access Denied...!";
  header("location:viewCategoriesListing.php?categoryType=" . $categoryType);
  exit();
}
?>
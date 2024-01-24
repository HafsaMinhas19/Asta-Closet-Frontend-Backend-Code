<?php
function isAdminLogin()
{
  //The isset function returns true if the variable exists and is not NULL, otherwise it returns false.
  if (isset($_SESSION['adminID']) && $_SESSION['adminID'] != "" && isset($_SESSION['adminName']) && $_SESSION['adminName'] != "" && isset($_SESSION['adminEmail']) && $_SESSION['adminEmail'] != "" && isset($_SESSION['adminType']) && $_SESSION['adminType'] != "") {
    return true; //admin is aready login
  } else {
    return false;  //admin is not login
  }
}

function getStatusTitle($status)
{
  if ($status == "A") {
    return "Active";
  } else if ($status == "B") {
    return "Blocked";
  } else {
    return "N/A";
  }
}

function getSizeTitle($size)
{
  if ($size == "A") {
    return "Available";
  } else if ($size == "NA") {
    return "Not Available";
  }
}

function checkCategoryExist($categoryName, $categoryType, $categoryID = "")
{
  global $con;
  $sql = "SELECT count(`category_name`) as `totalCategoryNames` FROM `tbl_categories` WHERE `category_name` = '$categoryName' AND `category_type` = '$categoryType' AND `category_id`!= '$categoryID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if ($row = mysqli_fetch_array($result)) {
      return $row["totalCategoryNames"];
    }
  }
}

function checkProductExist($productName, $productCategoryType, $productID = "")
{
  global $con;
  $sql = "SELECT count(`product_name`) as `totalProductNames` FROM `tbl_products` WHERE `product_name` = '$productName' AND `product_categoryType` = '$productCategoryType' AND `product_id`!= '$productID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if ($row = mysqli_fetch_array($result)) {
      return $row["totalProductNames"];
    }
  }
}

function checkColorExist($productColorName, $productColorID = "")
{
  global $con;
  $sql = "SELECT count(`product_color`) as `totalColorNames` FROM `tbl_product_colors` WHERE `product_color` = '$productColorName' AND `product_color_id`!= '$productColorID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if ($row = mysqli_fetch_array($result)) {
      return $row["totalColorNames"];
    }
  }
}

function checkAdminEmailExist($adminEmail, $adminID = "")
{
  global $con;
  $sql = "SELECT count(`user_email`) as `totalEmails` FROM `tbl_users` WHERE `user_email` = '$adminEmail' AND `user_id`!= '$adminID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if ($row = mysqli_fetch_array($result)) {
      return $row["totalEmails"];
    }
  }
}


function getCurrentPageName()
{
  $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
  return $curPageName;
}

function getPageTitle()
{
  if ($_SESSION['adminType'] == "A") {
    $type = "Admin";
  } else if ($_SESSION['adminType'] == "E") {
    $type = "Employee";
  } else {
    $type = "";
  }
  $curPageName = getCurrentPageName();
  $pageTitle = "Asta Closet " . $type . " | ";
  if ($curPageName == "index.php") {  //dashboard
    $pageTitle .= "Dashboard";
  } else if ($curPageName == "addNewCategory.php") {   //categories
    $pageTitle .= "Add New Category";
  } else if ($curPageName == "viewAllCategories.php") {
    $pageTitle .= "View All Categories Listing";
  } else if ($curPageName == "viewCategoriesListing.php") {
    if (isset($_GET['categoryType']) && $_GET['categoryType'] != "") {
      $categoryType = $_GET['categoryType'];
      if ($categoryType == "M") {
        $categoryTypeTitle = "Male";
      } else if ($categoryType == "F") {
        $categoryTypeTitle = "Female";
      } else {
        $categoryTypeTitle = "";
      }
    }
    $pageTitle .= "View All " . $categoryTypeTitle . " Categories";
  } else if ($curPageName == "updateCategory.php") {
    if (isset($_GET['categoryType']) && $_GET['categoryType'] != "") {
      $categoryType = $_GET['categoryType'];
      if ($categoryType == "M") {
        $categoryTypeTitle = "Male";
      } else if ($categoryType == "F") {
        $categoryTypeTitle = "Female";
      } else {
        $categoryTypeTitle = "";
      }
    }
    $pageTitle .= "Update " . $categoryTypeTitle . " Categories";
  } else if ($curPageName == "addNewProduct.php") {   //products
    $pageTitle .= "Add New Product";
  } else if ($curPageName == "viewAllProducts.php") {
    $pageTitle .= "View All Products Listing";
  } else if ($curPageName == "viewProductsListing.php") {
    if (isset($_GET['productCategoryType']) && $_GET['productCategoryType'] != "") {
      $productCategoryType = $_GET['productCategoryType'];
      if ($productCategoryType == "M") {
        $productCategoryTypeTitle = "Male";
      } else if ($productCategoryType == "F") {
        $productCategoryTypeTitle = "Female";
      } else {
        $productCategoryTypeTitle = "";
      }
    }
    $pageTitle .= "View All " . $productCategoryTypeTitle . " Products";
  } else if ($curPageName == "updateProduct.php") {
    if (isset($_GET['productCategoryType']) && $_GET['productCategoryType'] != "") {
      $productCategoryType = $_GET['productCategoryType'];
      if ($productCategoryType == "M") {
        $productCategoryTypeTitle = "Male";
      } else if ($productCategoryType == "F") {
        $productCategoryTypeTitle = "Female";
      } else {
        $productCategoryTypeTitle = "";
      }
    }
    $pageTitle .= "Update " . $productCategoryTypeTitle . " Products";
  } else if ($curPageName == "viewProductImages_colors.php") {
    $pageTitle .= "Product Multiple Images & Colors";
  } else if ($curPageName == "addNewEmployee.php") {   //employees
    $pageTitle .= "Add New Employee";
  } else if ($curPageName == "viewEmployeesListing.php") {
    $pageTitle .= "View All Employees Listing";
  } else if ($curPageName == "updateEmployee.php") {
    $pageTitle .= "Update Employees";
  } else if ($curPageName == "viewCustomersListing.php") {    //customers
    $pageTitle .= "View All Customers Listing";
  } else if ($curPageName == "updateCustomers.php") {    //customers
    $pageTitle .= "Update Customers";
  } else if ($curPageName == "profile.php") {    //my-profile
    $pageTitle .= "Profile";
  }
  return $pageTitle;
}
?>
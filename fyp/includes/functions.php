<?php
function checkUserEmailExist($userEmail, $userID = "")
{
  global $con;
  $sql = "SELECT count(`user_email`) as `totalEmails` FROM `tbl_users` WHERE `user_email` = '$userEmail' AND `user_id`!= '$userID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if ($row = mysqli_fetch_array($result)) {
      return $row["totalEmails"];
    }
  }
}



function isUserLogin()
{
  //The isset function returns true if the variable exists and is not NULL, otherwise it returns false.
  if (isset($_SESSION['userID']) && $_SESSION['userID'] != "" && isset($_SESSION['userName']) && $_SESSION['userName'] != "" && isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != "" && isset($_SESSION['userType']) && $_SESSION['userType'] != "") {
    return true; //user is aready login
  } else {
    return false;  //user is not login
  }
}

function calculateProductDiscount($productID)
{
  global $con;
  $sql = "SELECT product_discount,product_price FROM tbl_products WHERE product_id = '$productID'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $productDiscount = $row['product_discount'];
  $productPrice = $row['product_price'];
  $discount = $productDiscount / 100;
  return $discount_price = $discount * $productPrice;
}

?>
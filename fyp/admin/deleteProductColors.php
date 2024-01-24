<?php
require "includes/connection.php";
require "includes/functions.php";
?>

<?php
$productCategoryType = $productColorID = $productCategoryTypeTitle = $productID = "";

if (isset($_GET['productCategoryType']) && $_GET['productCategoryType'] != "") {
    $productCategoryType = $_GET['productCategoryType'];
    if ($productCategoryType == "M") {
        $productCategoryTypeTitle = "Male";
    } else if ($productCategoryType == "F") {
        $productCategoryTypeTitle = "Female";
    } else {
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:viewProductsListing.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewProductsListing.php");
    exit();
}

if (isset($_GET['productID']) && $_GET['productID'] != "") {
    $productID = $_GET['productID'];
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewProductsListing.php");
    exit();
}

if (isset($_GET["productColorID"]) && $_GET["productColorID"] != "") {
    $productColorID = $_GET['productColorID'];
    $sql = "SELECT * FROM `tbl_product_colors` WHERE `product_color_id` = '$productColorID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            if ($row = mysqli_fetch_array($result)) {
                $sql = "DELETE FROM `tbl_product_colors` WHERE `product_color_id` = '$productColorID'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['successMessage'] = "Product Color Deleted Successfully";
                    header("location:viewProductsListing.php?productCategoryType=" . $productCategoryType);
                    exit();
                }
            }
        } else {
            $_SESSION['errorMessage'] = "Access Denied...!";
            header("location:viewProductsListing.php?productCategoryType=" . $productCategoryType);
            exit();
        }
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewProductsListing.php?productCategoryType=" . $productCategoryType);
    exit();
}
?>
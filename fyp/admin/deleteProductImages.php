<?php
require "includes/connection.php";
require "includes/functions.php";
?>

<?php
$productCategoryType = $productImageID = $productCategoryTypeTitle = $productID = "";

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

if (isset($_GET["productImageID"]) && $_GET["productImageID"] != "") {
    $productImageID = $_GET['productImageID'];
    $sql = "SELECT * FROM `tbl_product_images` WHERE `product_image_id` = '$productImageID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            if ($row = mysqli_fetch_array($result)) {
                $sql = "DELETE FROM `tbl_product_images` WHERE `product_image_id` = '$productImageID'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['successMessage'] = "Product Image Deleted Successfully";
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
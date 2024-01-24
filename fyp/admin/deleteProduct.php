<?php
require "includes/connection.php";
require "includes/functions.php";
?>

<?php
$productCategoryType = $productCategoryTypeTitle = $productID = "";

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

if (isset($_GET["productID"]) && $_GET["productID"] != "") {
    $productID = $_GET['productID'];
    $sql = "SELECT * FROM `tbl_products` WHERE `product_id` = '$productID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
           
            if ($row = mysqli_fetch_array($result)) {
                $featuredImage= $row['product_featuredImage'];
                $sql = "DELETE FROM `tbl_products` WHERE `product_id` = '$productID'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    if($featuredImage != "" && file_exists($featuredImage)){
                        unlink($featuredImage);
                    }
                    $sqlPImages = "SELECT * FROM `tbl_product_images` WHERE `product_image_productID` = '$productID' ORDER BY `product_image_id` DESC";
                    $resultPImages = mysqli_query($con, $sqlPImages);
                    if ( $resultPImages ) {
                      if (mysqli_num_rows( $resultPImages ) > 0) {
                        $srNo = 1;
                        while ($rowImage = mysqli_fetch_array( $resultPImages )) {
                            if ($rowImage['product_image_path'] != "" && file_exists($rowImage['product_image_path'])) {
                                unlink($rowImage['product_image_path']);  
                            }
                        }
                    }
                }
                $sqlPImageDelete = "DELETE FROM `tbl_product_images` WHERE `product_image_productID` = '$productID' ";
                $result = mysqli_query($con, $sqlPImageDelete);

                $sqlPolorDelete = "DELETE FROM `tbl_product_colors` WHERE `product_color_productID` = '$productID' ";
                $result = mysqli_query($con, $sqlPolorDelete);
                    $_SESSION['successMessage'] = "Product Deleted Successfully";
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
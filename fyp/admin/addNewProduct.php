<?php require "includes/head.php"; ?>

<?php
$productCategoryID = $productCategoryType = $productName = $productPrice = $productDiscount = $productFeaturedImage = $productDescription = $productStatus = $productCreatedDate = $productSmall = $productMedium = $productLarge = $productExtraLarge = "";

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
}

// check addNewProduct btn is pressed or not.
if (isset($_POST['addNewProductBtn'])) {

    if (empty($_POST['productCategoryType'])) {
        array_push($_SESSION['errors'], "Product Category Type is required");
    } else {
        $productCategoryType = mysqli_real_escape_string($con, $_POST['productCategoryType']);
        $_SESSION['productCategoryType'] = $productCategoryType;
    }

    if (empty($_POST['productCategoryID'])) {
        array_push($_SESSION['errors'], "Product Sub Category is required");
    } else {
        $productCategoryID = mysqli_real_escape_string($con, $_POST['productCategoryID']);
        $_SESSION['productCategoryID'] = $productCategoryID;
    }

    if (isset($_POST['productSmall'])) {
        $productSmall = 'A';
    } else {
        $productSmall = 'NA';
    }

    if (isset($_POST['productMedium'])) {
        $productMedium = 'A';
    } else {
        $productMedium = 'NA';
    }

    if (isset($_POST['productLarge'])) {
        $productLarge = 'A';
    } else {
        $productLarge = 'NA';
    }

    if (isset($_POST['productExtraLarge'])) {
        $productExtraLarge = 'A';
    } else {
        $productExtraLarge = 'NA';
    }

    if ($productSmall == 'NA' && $productMedium == 'NA' && $productLarge == 'NA' && $productExtraLarge == 'NA') {
        array_push($_SESSION['errors'], "Select atleast one size");
    }

    if (empty($_POST['productName'])) {
        array_push($_SESSION['errors'], "Product Name is required");
    } else {
        $productName = trim(mysqli_real_escape_string($con, $_POST['productName']));
        if (checkProductExist($productName, $productCategoryType) > 0) {
            array_push($_SESSION["errors"], "Product Name Already Exist");
        }
    }

    if ($_POST['productPrice'] == 0 || $_POST['productPrice'] == "") {
        array_push($_SESSION['errors'], "Product Price can't be 0 or empty");
    } else {
        $productPrice = mysqli_real_escape_string($con, $_POST['productPrice']);
    }

    $productDiscount = mysqli_real_escape_string($con, $_POST['productDiscount']);

    if (empty($_POST['productDescription'])) {
        array_push($_SESSION['errors'], "Product Description is required");
    } else {
        $productDescription = trim(mysqli_real_escape_string($con, $_POST['productDescription']));
    }

    if (basename($_FILES["productFeaturedImage"]["name"] != "")) {
        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp . '-' . basename($_FILES["productFeaturedImage"]["name"]); //uploads/12131231-abc.jpg
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            array_push($_SESSION['errors'], "Sorry, file already exists");
        }
        if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
            if (move_uploaded_file($_FILES["productFeaturedImage"]["tmp_name"], $target_file)) {
                //your query with file path
                $productFeaturedImage = $target_file;
            } else {
                array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
            }
        }
    } else {
        array_push($_SESSION['errors'], "Please Upload Product Image");
    }

    if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
        $productStatus = "A";
        $productCreatedDate = date("Y-m-d h:i:s");
        $sql = "INSERT INTO `tbl_products` (`product_name`,`product_categoryType`,`product_categoryID`,`product_price`,`product_discount`,`product_description`, `product_small`, `product_medium`, `product_large`, `product_extraLarge`, `product_featuredImage`,`product_status`,`product_createdDate`) VALUES ('$productName','$productCategoryType','$productCategoryID','$productPrice','$productDiscount','$productDescription', '$productSmall', '$productMedium', '$productLarge', '$productExtraLarge', '$productFeaturedImage','$productStatus','$productCreatedDate')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            unset($_SESSION['productCategoryType']);
            unset($_SESSION['productCategoryID']);
            $_SESSION['successMessage'] = "Product Added Successfully";
            header("location:viewProductsListing.php?productCategoryType=" . $productCategoryType);
            exit();
        }
    }
}
?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
    <section class="all-products">
        <h1 class="title-secondary">Add New Product</h1>
        <div class="row">
            <div class="col-12">
                <form action="addNewProduct.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (isset($_SESSION['errors'])) {
                        $errors = $_SESSION['errors'];
                        foreach ($errors as $error) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                            <?php
                        }
                        unset($_SESSION['errors']);
                    }

                    ?>
                    <div class="form-group">
                        <select onchange="getCategories();" id="productCategoryType" name="productCategoryType"
                            class="form-select">
                            <option selected disabled hidden value="">Select Product Category Type</option>
                            <option <?php if ($productCategoryType == "M") {
                                echo "selected";
                            } ?> value="M">Male</option>
                            <option <?php if ($productCategoryType == "F") {
                                echo "selected";
                            } ?> value="F">Female
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="productCategoryID" name="productCategoryID" class="form-select">
                            <option selected disabled hidden value="">Select Category </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productName" class="form-control mb-3" id="productName"
                            placeholder="Enter Product Name" value="<?php echo $productName; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="number" name="productPrice" class="form-control mb-3" id="productPrice"
                            placeholder="Enter Product Price" value="<?php echo $productPrice; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="number" name="productDiscount" class="form-control mb-3" id="productDiscount"
                            placeholder="Enter Product Discount" value="<?php echo $productDiscount; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="file" name="productFeaturedImage" class="form-control mb-3"
                            id="productFeaturedImage" placeholder="Choose Product Image" />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-3" id="productDescription" name="productDescription"
                            rows="3"><?php echo $productDescription; ?></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="productSmall" name="productSmall"
                                value="S" <?php if ($productSmall == "A") {
                                    echo "checked";
                                } ?>>
                            <label class="form-check-label" for="productSmall">Small</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="productMedium" name="productMedium"
                                value="M" <?php if ($productMedium == "A") {
                                    echo "checked";
                                } ?>>
                            <label class="form-check-label" for="productMedium">Medium</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="productLarge" name="productLarge"
                                value="L" <?php if ($productLarge == "A") {
                                    echo "checked";
                                } ?>>
                            <label class="form-check-label" for="productLarge">Large</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="productExtraLarge"
                                name="productExtraLarge" value="XL" <?php if ($productExtraLarge == "A") {
                                    echo "checked";
                                } ?>>
                            <label class="form-check-label" for="productExtraLarge">Extra Large</label>
                        </div>
                    </div>
                    <button type="submit" name="addNewProductBtn" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php require "includes/scripts.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
    <?php if (isset($_SESSION['productCategoryType'])) {
        ?>
        getCategories();
        <?php
    } ?>

    function getCategories() {
        var productCategoryType = $("#productCategoryType").val();
        // console.log(productCategoryType);
        $.ajax({
            url: "getCategories.php",
            type: "POST",
            data: {
                productCategoryType: productCategoryType
            },
            success: function (response) {

                //  alert(response);
                document.getElementById("productCategoryID").innerHTML = response;
            },
            error: function () {
                alert("error");
            }

        });
    }

</script>
</body>

</html>
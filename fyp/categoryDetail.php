<?php require "includes/head.php"; ?>

<?php
$categoryID = "";
if (isset($_GET["categoryID"]) && $_GET["categoryID"] != "") {
    $categoryID = $_GET['categoryID'];
    $sql = "SELECT * FROM `tbl_categories` WHERE `category_id` = '$categoryID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            if ($row = mysqli_fetch_array($result)) {
                $categoryName = $row["category_name"];
            }
        } else {
            $_SESSION['errorMessage'] = "Access Denied...!";
            header("location:allCategories.php?categoryType=" . $categoryType);
            exit();
        }
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:allCategories.php?categoryType=" . $categoryType);
    exit();
}
?>

<?php require "includes/header.php"; ?>

<section class="men-eastern my-5">
    <div class="container">
        <h1 class="title-secondary text-center my-3">
            <?php echo $categoryName ?>
        </h1>
        <div class="d-flex gap-4">
            <div class="filter-btn">
                <button class="btn d-flex gap-1" onclick="toggle()">
                    <i class="fa-solid fa-sort-down"></i> Filter
                </button>
                <div class="paragraph" id="toggle-para">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ut
                        repudiandae, aperiam nam ducimus sunt iste minus mollitia,
                        eligendi velit, error tenetur voluptate eveniet doloribus maxime
                        earum fuga ad eos.
                    </p>
                </div>
            </div>
            <div class="search-btn">
                <button class="btn" onclick="toggle()">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
                <div class="paragraph" id="toggle-para2">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ut
                        repudiandae, aperiam nam ducimus sunt iste minus mollitia,
                        eligendi velit, error tenetur voluptate eveniet doloribus maxime
                        earum fuga ad eos.
                    </p>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <?php
            $sql = "SELECT `p`.*,`c`.* FROM `tbl_products` as `p` INNER JOIN `tbl_categories` as `c` ON `c`.`category_id` = `p`.`product_categoryID` WHERE `p`.`product_categoryID` = '$categoryID' AND `p`.`product_status` = 'A' ORDER BY `p`.`product_id` DESC";
            $result = mysqli_query($con, $sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $srNo = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $productFeaturedImage = "admin/" . $row['product_featuredImage'];
                        ?>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-img">
                                    <?php if ($productFeaturedImage != "admin/" && file_exists($productFeaturedImage)) {
                                        ?>
                                        <img src="<?php echo $productFeaturedImage; ?>" alt="<?php echo $row['product_name'] ?>"
                                            class="card-img-top" />
                                        <?php
                                    } else {
                                        echo "N/A";
                                    } ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $row['product_price'] . " PKR"; ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $row['product_description']; ?>
                                    </p>
                                    <a href="product-description.php?categoryID=<?php echo $categoryID; ?>&productID=<?php echo $row['product_id']; ?>"
                                        class="btn">Quick View</a>
                                    <a href="shopping-cart.php" class="btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        $srNo++;
                    }
                } else {
                    ?>
                    <div class="alert alert-info">
                        Sorry, No
                        <?php echo $categoryName ?> Products Found.
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<?php require "includes/footer.php"; ?>

<?php require "includes/scripts.php"; ?>
</body>

</html>
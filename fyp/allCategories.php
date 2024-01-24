<?php require "includes/head.php"; ?>

<?php
$categoryType = $categoryTypeTitle = "";
if (isset($_GET['categoryType']) && $_GET['categoryType'] != "") {
    $categoryType = $_GET['categoryType'];
    if ($categoryType == "M") {
        $categoryTypeTitle = "Men";
    } else if ($categoryType == "F") {
        $categoryTypeTitle = "Women";
    } else {
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:index.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:index.php");
    exit();
}
?>

<?php require "includes/header.php"; ?>

<section class="mens-wear my-5">
    <div class="container">
        <h1 class="title-secondary text-center my-3">
            <?php echo $categoryTypeTitle; ?> Categories
        </h1>
        <div class="row">
            <?php
            $sql = "SELECT * FROM `tbl_categories` WHERE `category_type` = '$categoryType' AND `category_status` = 'A' ORDER BY `category_id` DESC";
            $result = mysqli_query($con, $sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $srNo = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $categoryImage = "admin/" . $row['category_img'];
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <a href="categoryDetail.php?categoryID=<?php echo $row['category_id']; ?>">
                                <div class="card">
                                    <div class="card-img">
                                        <?php if ($categoryImage != "admin/" && file_exists($categoryImage)) {
                                            ?>
                                            <img src="<?php echo $categoryImage; ?>" alt="<?php echo $row['category_name'] ?>"
                                                class="card-img-top" />
                                            <?php
                                        } else {
                                            echo "N/A";
                                        } ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $row['category_name']; ?>
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                        $srNo++;
                    }
                } else {
                    ?>
                    <div class="alert alert-info">
                        Sorry, No
                        <?php echo $categoryTypeTitle; ?> Categories Found.
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
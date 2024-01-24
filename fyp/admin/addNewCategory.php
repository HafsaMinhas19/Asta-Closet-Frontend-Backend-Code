<?php require "includes/head.php"; ?>

<?php
$categoryType = $categoryName = $categoryImage = $categoryStatus = $categoryCreatedDate = "";

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] = array();
}

// check addNewCategory btn is pressed or not.
if (isset($_POST['addNewCategoryBtn'])) {

  if (empty($_POST['categoryType'])) {
    array_push($_SESSION['errors'], "Category Type is Required");
  } else {
    $categoryType = mysqli_real_escape_string($con, $_POST['categoryType']);
  }

  if (empty($_POST['categoryName'])) {
    array_push($_SESSION['errors'], "Category Name is Required");
  } else {
    $categoryName = mysqli_real_escape_string($con, $_POST['categoryName']);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $categoryName)) {
      $nameErr = "Only letters and white space allowed in Category Name";
      array_push($_SESSION['errors'], $nameErr);
    }
    if (checkCategoryExist($categoryName, $categoryType) > 0) {
      array_push($_SESSION["errors"], "Category Name Already Exist");
    }
  }

  if (basename($_FILES["categoryImage"]["name"] != "")) {
    $target_dir = "uploads/";
    $timestamp = time();
    $target_file = $target_dir . $timestamp . '-' . basename($_FILES["categoryImage"]["name"]); //uploads/12131231-abc.jpg
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (file_exists($target_file)) {
      array_push($_SESSION['errors'], "Sorry, file already exists");
    }
    if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
      if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $target_file)) {
        //your query with file path
        $categoryImage = $target_file;
      } else {
        array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
      }
    }
  } else {
    array_push($_SESSION['errors'], "Please Upload Product Image");
  }

  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    $categoryStatus = "A";
    $categoryCreatedDate = date("Y-m-d h:i:s");
    $sql = "INSERT INTO `tbl_categories` (`category_name`,`category_type`,`category_img`,`category_status`,`category_createdDate`) VALUES ('$categoryName','$categoryType','$categoryImage','$categoryStatus','$categoryCreatedDate')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $_SESSION['successMessage'] = "Category Added Successfully";
      header("location:viewCategoriesListing.php?categoryType=" . $categoryType);
      exit();
    }
  }
}
?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="all-products">
    <h1 class="title-secondary">Add New Category</h1>
    <div class="row">
      <div class="col-12">
        <form action="addNewCategory.php" method="POST" enctype="multipart/form-data">
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
          <div class="form-group mb-3">
            <select id="categoryType" name="categoryType" class="form-select">
              <option selected disabled hidden value="">Select Category Type</option>
              <option <?php if ($categoryType == "M") {
                echo "selected";
              } ?> value="M">Male</option>
              <option <?php if ($categoryType == "F") {
                echo "selected";
              } ?> value="F">Female</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="categoryName" class="form-control mb-3" id="categoryName"
              placeholder="Enter your Category Name" value="<?php echo $categoryName; ?>" />
          </div>
          <div class="form-group">
            <input type="file" name="categoryImage" class="form-control mb-3" id="categoryImage"
              placeholder="Choose Category Image" />
          </div>
          <button type="submit" name="addNewCategoryBtn" class="btn btn-primary">Add Category</button>
        </form>
      </div>
    </div>
  </section>
</div>

<?php require "includes/scripts.php"; ?>
</body>

</html>
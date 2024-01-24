<?php require "includes/head.php"; ?>

<?php
$categoryType = $categoryName = $categoryImage = $categoryImageOld = $categoryStatus = $categoryCreatedDate = $categoryUpdatedDate = $categoryID = $categoryTypeTitle = "";

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
        $categoryType = $row["category_type"];
        $categoryName = $row["category_name"];
        $categoryStatus = $row["category_status"];
        $categoryImage = $row['category_img'];
        $categoryImageOld = $row['category_img'];
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

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] = array();
}

// check updateCategory btn is pressed or not.
if (isset($_POST['updateCategoryBtn'])) {

  if (empty($_POST['categoryType'])) {
    array_push($_SESSION['errors'], "Category Type is Required");
  } else {
    $categoryType = mysqli_real_escape_string($con, $_POST['categoryType']);
  }

  if (empty($_POST['categoryName'])) {
    array_push($_SESSION['errors'], "Category Name is Required");
  } else {
    $categoryName = mysqli_real_escape_string($con, $_POST['categoryName']);
    if (checkCategoryExist($categoryName, $categoryType, $categoryID) > 0) {
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
    $categoryImage = $categoryImageOld;
  }

  if (empty($_POST['categoryStatus'])) {
    array_push($_SESSION['errors'], "Category Status is Required");
  } else {
    $categoryStatus = mysqli_real_escape_string($con, $_POST['categoryStatus']);
  }

  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    $categoryUpdatedDate = date("Y-m-d h:i:s");
    $sql = "UPDATE `tbl_categories` SET `category_name` = '$categoryName', `category_type` = '$categoryType', `category_status` = '$categoryStatus', `category_updatedDate` = '$categoryUpdatedDate', `category_img` = '$categoryImage' WHERE `category_id` = '$categoryID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $_SESSION['successMessage'] = "Category Updated Successfully";
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
    <h1 class="title-secondary">Update
      <?php echo $categoryTypeTitle; ?> Category
    </h1>
    <div class="row">
      <div class="col-12">
        <form
          action="updateCategory.php?categoryType=<?php echo $categoryType; ?>&categoryID=<?php echo $categoryID; ?>"
          method="POST" enctype="multipart/form-data">
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
            <select id="categoryType" name="categoryType" class="form-select">
              <option selected disabled hidden>Select Category Type</option>
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
          <div class="form-group mb-2">
            <div class="row">
              <div class="col-md-11">
                <input type="file" name="categoryImage" class="form-control mb-3" id="categoryImage"
                  placeholder="Choose Product Image" />
              </div>
              <div class="col-md-1">
                <?php if ($categoryImage != "" && file_exists($categoryImage)) {
                  ?>
                  <img src="<?php echo $categoryImage; ?>" alt="<?php echo $categoryName; ?>"
                    style="width:80px; height:80px;" />
                  <?php
                } ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <select name="categoryStatus" id="categoryStatus" class="form-select">
              <option selected disabled hidden>Category Status</option>
              <option <?php if ($categoryStatus == "A") {
                echo "selected";
              } ?> value="A">Active</option>
              <option <?php if ($categoryStatus == "B") {
                echo "selected";
              } ?> value="B">Blocked</option>
            </select>
          </div>
          <button type="submit" name="updateCategoryBtn" class="btn btn-primary">Update Category</button>
        </form>
      </div>
    </div>
  </section>
</div>

<?php require "includes/scripts.php"; ?>
</body>

</html>
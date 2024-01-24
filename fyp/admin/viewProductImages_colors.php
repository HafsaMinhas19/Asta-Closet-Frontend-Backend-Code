<?php require "includes/head.php"; ?>

<?php
$productCategoryType = $productCategoryTypeTitle = $productColorName = $productColorCreatedDate = "";
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
        $productName = $row["product_name"];
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

if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] = array();
}

if (isset($_POST['addNewProductImagesBtn'])) {

  if ($_FILES['prodImages']['name'][0] == "") {
    array_push($_SESSION['errors'], "Please Upload atleast one Product Image");
  }
  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    // Count # of uploaded files in array
    $total = count($_FILES['prodImages']['name']);
    $createdDate = date("Y-m-d h:i:s");
    for ($i = 0; $i < $total; $i++) {

      //Get the temp file path
      $tmpFilePath = $_FILES['prodImages']['tmp_name'][$i];

      //Make sure we have a file path
      if ($tmpFilePath != "") {
        //Setup our new file path
        $dir = "uploads/";
        $fileName = time() . '-' . $_FILES['prodImages']['name'][$i];
        $newFilePath = $dir . $fileName;

        //Upload the file into the temp dir
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {

          $sqlImages = "INSERT INTO `tbl_product_images` (`product_image_productID`, `product_image_path`, `product_image_createdDate`) VALUES ('$productID','$newFilePath','$createdDate')";
          $resultImage = mysqli_query($con, $sqlImages);
        }
      }
    }

    $_SESSION['successMessage'] = "Product Image(s) Added Successfully";
    header("location:viewProductsListing.php?productCategoryType=" . $productCategoryType);
    exit();
  }
}

if (isset($_POST['addNewProductColorBtn'])) {

  if (empty($_POST['productColorName'])) {
    array_push($_SESSION['errors'], "Product Color is Required");
  } else {
    $productColorName = mysqli_real_escape_string($con, $_POST['productColorName']);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $productColorName)) {
      $nameErr = "Only letters and white space allowed in Product Color Name";
      array_push($_SESSION['errors'], $nameErr);
    }
    if (checkColorExist($productColorName, $productColorID) > 0) {
      array_push($_SESSION["errors"], "Product Color Already Exist");
    }
  }

  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    $productColorCreatedDate = date("Y-m-d h:i:s");
    $sql = "INSERT INTO `tbl_product_colors` (`product_color_productID`, `product_color`, `product_color_createdDate`) VALUES ('$productID', '$productColorName', '$productColorCreatedDate')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $_SESSION['successMessage'] = "Product Color Added Successfully";
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
    <?php if (isset($_SESSION['successMessage'])) { ?>
      <div class="alert alert-success">
        <?php echo $_SESSION['successMessage'];
        unset($_SESSION['successMessage']); ?>
      </div>
    <?php } ?>

    <?php if (isset($_SESSION['errorMessage'])) { ?>
      <div class="alert alert-danger">
        <?php echo $_SESSION['errorMessage'];
        unset($_SESSION['errorMessage']); ?>
      </div>
    <?php } ?>

    <div class="row">
      <div class="col-12">
        <h1 class="title-secondary">All Images of
          <?php echo $productName; ?>
        </h1>
        <form
          action="viewProductImages_colors.php?productCategoryType=<?php echo $productCategoryType; ?>&productID=<?php echo $productID; ?>"
          method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <input type="file" name="prodImages[]" multiple class="form-control mb-3" id="prodImages"
              placeholder="Choose Product Image" />
          </div>
          <button type="submit" name="addNewProductImagesBtn" class="btn btn-primary">Add Images</button>
        </form>

        <table class="table table-striped table-hover mt-3 text-center table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_product_images` WHERE `product_image_productID` = '$productID' ORDER BY `product_image_id` DESC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                $srNo = 1;
                while ($row = mysqli_fetch_array($result)) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $srNo; ?>
                    </td>
                    <td>
                      <?php if ($row['product_image_path'] != "" && file_exists($row['product_image_path'])) {
                        ?>
                        <img src="<?php echo $row['product_image_path']; ?>" alt="<?php echo $productName; ?> Image"
                          style="width:50px; height:50px;" />
                        <?php
                      } else {
                        echo "N/A";
                      } ?>
                    </td>
                    <td>
                      <a href="deleteProductImages.php?productCategoryType=<?php echo $productCategoryType; ?>&productImageID=<?php echo $row['product_image_id']; ?>&productID=<?php echo $productID; ?>"
                        class="btn btn-sm btn-danger delete-confirm">Delete Product Image </a>
                    </td>
                  </tr>
                  <?php
                  $srNo++;
                }
              } else {
                ?>
                <div class="alert alert-info">
                  Sorry, No
                  <?php echo $productName; ?> Images Found
                </div>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-12">
        <h1 class="title-secondary">All Colors of
          <?php echo $productName; ?>
        </h1>
        <form
          action="viewProductImages_colors.php?productCategoryType=<?php echo $productCategoryType; ?>&productID=<?php echo $productID; ?>"
          method="POST">
          <div class="form-group">
            <input type="text" name="productColorName" class="form-control mb-3" id="productColorName"
              placeholder="Enter Product Color Name" value="<?php echo $productColorName; ?>" />
          </div>
          <button type="submit" name="addNewProductColorBtn" class="btn btn-primary">Add Colors</button>
        </form>

        <table class="table table-striped table-hover mt-3 text-center table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Color</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_product_colors` WHERE `product_color_productID` = '$productID' ORDER BY `product_color_id` DESC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                $srNo = 1;
                while ($row = mysqli_fetch_array($result)) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $srNo; ?>
                    </td>
                    <td>
                      <?php echo $row['product_color'] ?>
                    </td>
                    <td>
                      <a href="deleteProductColors.php?productCategoryType=<?php echo $productCategoryType; ?>&productColorID=<?php echo $row['product_color_id']; ?>&productID=<?php echo $productID; ?>"
                        class="btn btn-sm btn-danger delete-confirm">Delete Product Color </a>
                    </td>
                  </tr>
                  <?php
                  $srNo++;
                }
              } else {
                ?>
                <div class="alert alert-info">
                  Sorry, No
                  <?php echo $productName; ?> Colors Found
                </div>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php require "includes/scripts.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

  $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
      title: 'Are you sure?',
      text: 'This record and it`s details will be permanantly deleted!',
      icon: 'warning',
      buttons: ["No", "Yes!"],
    }).then(function (value) {
      if (value) {
        window.location.href = url;
      }
    });
  });
</script>
</body>

</html>
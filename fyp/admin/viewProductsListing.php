<?php require "includes/head.php"; ?>

<?php
$productCategoryType = $productCategoryTypeTitle = "";
if (isset($_GET['productCategoryType']) && $_GET['productCategoryType'] != "") {
  $productCategoryType = $_GET['productCategoryType'];
  if ($productCategoryType == "M") {
    $productCategoryTypeTitle = "Male";
  } else if ($productCategoryType == "F") {
    $productCategoryTypeTitle = "Female";
  } else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewAllProducts.php");
    exit();
  }
} else {
  $_SESSION['errorMessage'] = "Access Denied...!";
  header("location:viewAllProducts.php");
  exit();
}
?>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="all-products">
    <h1 class="title-secondary">All
      <?php echo $productCategoryTypeTitle; ?> Products
    </h1>
    <div class="row">
      <div class="col-12">
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

        <div class="table-responsive">
          <table id="table" class="table table-striped table-hover mt-3 text-center table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Size Small</th>
                <th>Size Medium</th>
                <th>Size Large</th>
                <th>Size Extra Large</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // $sql = "SELECT * FROM `tbl_products` WHERE `product_categoryType` = '$productCategoryType' ORDER BY `product_id` DESC";
              $sql = "SELECT `p`.*,`c`.* FROM `tbl_products` as `p` INNER JOIN `tbl_categories` as `c` ON `c`.`category_id` = `p`.`product_categoryID` WHERE `p`.`product_categoryType` = '$productCategoryType' ORDER BY `p`.`product_id` DESC";
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
                        <?php echo $row['product_name']; ?>
                      </td>
                      <td>
                        <?php echo $row['category_name']; ?>
                      </td>
                      <td>
                        <?php echo getStatusTitle($row['product_status']); ?>
                      </td>
                      <td>
                        <?php echo getSizeTitle($row['product_small']); ?>
                      </td>
                      <td>
                        <?php echo getSizeTitle($row['product_medium']); ?>
                      </td>
                      <td>
                        <?php echo getSizeTitle($row['product_large']); ?>
                      </td>
                      <td>
                        <?php echo getSizeTitle($row['product_extraLarge']); ?>
                      </td>
                      <td>
                        <?php echo $row['product_price'] . " PKR"; ?>
                      </td>
                      <td>
                        <?php if ($row['product_discount'] != "0" && $row['product_discount'] != "") {
                          echo $row['product_discount'] . "%";
                        } else {
                          echo "N/A";
                        } ?>
                      </td>
                      <td>
                        <?php echo $row['product_description']; ?>
                      </td>
                      <td title="Add/View All Images & Colors Click me" style="cursor:pointer;"
                        onclick="window.location.href='viewProductImages_colors.php?productCategoryType=<?php echo $productCategoryType; ?>&productID=<?php echo $row['product_id']; ?>'">

                        <?php if ($row['product_featuredImage'] != "" && file_exists($row['product_featuredImage'])) {
                          ?>
                          <img src="<?php echo $row['product_featuredImage']; ?>" alt="<?php echo $row['product_name']; ?>"
                            style="width:50px; height:50px;" />
                          <?php
                        } else {
                          echo "N/A";
                        } ?>
                      </td>
                      <td>
                        <a href="updateProduct.php?productCategoryType=<?php echo $productCategoryType; ?>&productID=<?php echo $row['product_id']; ?>"
                          class="btn btn-sm btn-success">Update Products</a>

                        <a href="deleteProduct.php?productCategoryType=<?php echo $productCategoryType; ?>&productID=<?php echo $row['product_id']; ?>"
                          class="btn btn-sm btn-danger delete-confirm">Delete Products</a>
                      </td>
                    </tr>
                    <?php
                    $srNo++;
                  }
                } else {
                  ?>
                  <div class="alert alert-info">
                    Sorry, No
                    <?php echo $productCategoryTypeTitle; ?> Products Found
                  </div>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?php require "includes/scripts.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

  <script>       
    $(function () {
      $("#table").DataTable();
    });
  </script>

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
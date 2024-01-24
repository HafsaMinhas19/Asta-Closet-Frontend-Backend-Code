<?php require "includes/head.php"; ?>

<?php
$categoryType = $categoryTypeTitle = "";
if (isset($_GET['categoryType']) && $_GET['categoryType'] != "") {
  $categoryType = $_GET['categoryType'];
  if ($categoryType == "M") {
    $categoryTypeTitle = "Male";
  } else if ($categoryType == "F") {
    $categoryTypeTitle = "Female";
  } else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewAllCategories.php");
    exit();
  }
} else {
  $_SESSION['errorMessage'] = "Access Denied...!";
  header("location:viewAllCategories.php");
  exit();
}
?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="all-products">
    <h1 class="title-secondary">All
      <?php echo $categoryTypeTitle; ?> Categories
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

        <table class="table table-striped table-hover mt-3 text-center table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Title</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_categories` WHERE `category_type` = '$categoryType' ORDER BY `category_id` DESC";
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
                      <?php echo $row['category_name']; ?>
                    </td>
                    <td>
                      <?php if ($row['category_img'] != "" && file_exists($row['category_img'])) {
                        ?>
                        <img src="<?php echo $row['category_img'] ?>" style="width:50px; height: 50px;"
                          alt="<?php echo $row['category_name'] ?>" />
                        <?php
                      } else {
                        echo "N/A";
                      } ?>
                    </td>
                    <td>
                      <?php echo getStatusTitle($row['category_status']); ?>
                    </td>
                    <td>
                      <a href="updateCategory.php?categoryType=<?php echo $categoryType; ?>&categoryID=<?php echo $row['category_id']; ?>"
                        class="btn btn-sm btn-success">Update Categories</a>

                      <a href="deleteCategory.php?categoryType=<?php echo $categoryType; ?>&categoryID=<?php echo $row['category_id']; ?>"
                        class="btn btn-sm btn-danger delete-confirm">Delete Categories</a>
                    </td>
                  </tr>
                  <?php
                  $srNo++;
                }
              } else {
                ?>
                <div class="alert alert-info">
                  Sorry, No
                  <?php echo $categoryTypeTitle; ?> Categories Found
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
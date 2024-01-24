<?php
require("includes/connection.php");
$productCategoryID = "";

//incase of any error or page refresh, category should remain selected, that's why session of productCategoryID is used here
if (isset($_SESSION['productCategoryID'])) {
  $productCategoryID = $_SESSION['productCategoryID'];
}

if (isset($_POST['productCategoryType'])) {
  $productCategoryType = $_POST['productCategoryType'];
  $sql = "SELECT * FROM `tbl_categories` WHERE `category_status` = 'A' and `category_type` = '$productCategoryType' ORDER BY `category_id` DESC";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
        ?>
        <option <?php if ($productCategoryID == $row['category_id']) {
          echo "selected";
        } ?>
          value="<?php echo $row['category_id']; ?>">
          <?php echo $row['category_name']; ?>
        </option>
      <?php }
    }
  }
}
?>
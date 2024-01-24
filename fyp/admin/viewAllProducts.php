<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="all-products">
    <h1 class="title-secondary">View Products</h1>
    <div class="row">
      <?php if (isset($_SESSION['successMessage'])) { ?>
        <div class="alert alert-success">
          <?php echo $_SESSION['successMessage'];
          unset($_SESSION['successMessage']); ?>
        </div>
      <?php } ?>
      <div class="col-12">
        <table class="table table-striped table-hover mt-3 text-center table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Male</td>
              <td>
                <a href="viewProductsListing.php?productCategoryType=M" class="btn btn-sm btn-success">View Male
                  Products</a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Female</td>
              <td>
                <a href="viewProductsListing.php?productCategoryType=F" class="btn btn-sm btn-success">View Female
                  Products</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php require "includes/scripts.php"; ?>
</body>

</html>
<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="all-products">
    <h1 class="title-secondary">View Categories</h1>
    <div class="row">
      <div class="col-12">
        <?php
        if (isset($_SESSION['errorMessage'])) {
          ?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['errorMessage'];
            unset($_SESSION['errorMessage']); ?>
          </div>
          <?php
        }
        ?>
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
                <a href="viewCategoriesListing.php?categoryType=M" class="btn btn-sm btn-success">View Male
                  Categories</a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Female</td>
              <td>
                <a href="viewCategoriesListing.php?categoryType=F" class="btn btn-sm btn-success">View Female
                  Categories</a>
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
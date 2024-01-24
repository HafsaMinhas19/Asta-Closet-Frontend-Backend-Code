<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
  <section class="all-products">
    <h1 class="title-secondary">All Products</h1>
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
        <table class="table table-striped table-hover mt-3 text-center table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Picture</th>
              <th>Product Name</th>
              <th>Product Actual Price</th>
              <th>Product Price</th>
              <th>Product Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><img src="assets/img/card-1.jpeg" alt="" class="w-25" /></td>
              <td>Embroidered Black Frock 0012</td>
              <td>4490</td>
              <td>2490</td>
              <td>Embroidered Frock Dupatta Trouser - Black - Tissue</td>
            </tr>
            <tr>
              <td>2</td>
              <td><img src="assets/img/card-2.1.jpeg" alt="" class="w-25" /></td>
              <td>Embroidered Red Frock 0013</td>
              <td>2100</td>
              <td>2100</td>
              <td>Embroidered Frock Dupatta Trouser - Red - Tissue</td>
            </tr>
            <tr>
              <td>3</td>
              <td><img src="assets/img/sidra red 1.jpeg" alt="" class="w-25" /></td>
              <td>Lawn Red Kurta 0014</td>
              <td>3110</td>
              <td>3110</td>
              <td>Lawn Kurta Trouser</td>
            </tr>
            <tr>
              <td>4</td>
              <td><img src="assets/img/card-3.jpeg" alt="" class="w-25" /></td>
              <td>Lawn Purple Kurta Trouser 0015</td>
              <td>3600</td>
              <td>2600</td>
              <td>Lawn Kurta Trouser</td>
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
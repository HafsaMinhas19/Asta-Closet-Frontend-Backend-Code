<?php require "includes/head.php"; ?>

<?php
$categoryID = "";
if (isset($_GET["categoryID"]) && $_GET["categoryID"] != "") {
  $categoryID = $_GET['categoryID'];
  $sql = "SELECT * FROM `tbl_categories` WHERE `category_id` = '$categoryID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $categoryName = $row["category_name"];
      }
    } else {
      $_SESSION['errorMessage'] = "Access Denied...!";
      header("location:categoryDetail.php?categoryID=" . $categoryID);
      exit();
    }
  }
} else {
  $_SESSION['errorMessage'] = "Access Denied...!";
  header("location:categoryDetail.php?categoryID=" . $categoryID);
  exit();
}

if (isset($_GET["productID"]) && $_GET["productID"] != "") {
  $productID = $_GET['productID'];
  $sql = "SELECT * FROM `tbl_products` WHERE `product_id` = '$productID'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      if ($row = mysqli_fetch_array($result)) {
        $productCategoryType = $row["product_categoryType"];
        $productCategoryID = $row["product_categoryID"];
        $productName = $row["product_name"];
        $productPrice = $row["product_price"];
        $productDiscount = $row["product_discount"];
        $discountInRs = calculateProductDiscount($productID);
        $productDiscountedPrice = $productPrice - $discountInRs;
        $productDescription = $row["product_description"];
        $productStatus = $row["product_status"];
        $productFeaturedImage = $row['product_featuredImage'];
        $productFeaturedImageOld = $row['product_featuredImage'];
      }
    } else {
      $_SESSION['errorMessage'] = "Access Denied...!";
      header("location:categoryDetail.php?categoryID=" . $categoryID);
      exit();
    }
  }
} else {
  $_SESSION['errorMessage'] = "Access Denied...!";
  header("location:categoryDetail.php?categoryID=" . $categoryID);
  exit();
}
?>

<?php require "includes/header.php"; ?>

<section class="product-details">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <img id=featured src="assets/img/jia-1.jpeg">

        <div id="slide-wrapper">
          <img id="slideLeft" class="arrow" src="assets/img/arrow-left.png">

          <div id="slider">
            <img class="thumbnail active" src="assets/img/jia-1.jpeg">
            <img class="thumbnail" src="assets/img/jia-2.jpeg">
            <img class="thumbnail" src="assets/img/jia-3.jpeg">
            <img class="thumbnail" src="assets/img/jia-4.jpeg">
          </div>

          <img id="slideRight" class="arrow" src="assets/img/arrow-right.png">
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="details">
          <h2 class="title-secondary">
            <?php echo $productName; ?>
          </h2>
          <p>
            <?php echo $productDescription; ?>
          </p>
          <span class="product-price">
            <?php echo round($productDiscountedPrice) . " PKR"; ?>
          </span>
          <?php if ($productDiscount != 0) { ?>
            <span class="product-actual-price">
              <?php echo $productPrice . " PKR"; ?>
            </span>
            <span class="product-discount">(
              <?php echo $productDiscount; ?>% off )
            </span>
          <?php } ?>

          <p class="product-sub-heading my-3">Select size</p>

          <input type="radio" name="size" value="s" checked hidden id="s-size" />
          <label for="s-size" class="size-radio-btn check">s</label>

          <input type="radio" name="size" value="s" hidden id="m-size" />
          <label for="m-size" class="size-radio-btn">m</label>

          <input type="radio" name="size" value="s" hidden id="l-size" />
          <label for="l-size" class="size-radio-btn">l</label>

          <input type="radio" name="size" value="s" hidden id="xl-size" />
          <label for="xl-size" class="size-radio-btn">xl</label>

          <p class="product-sub-heading my-3">Colors</p>

          <?php

          $sql = "SELECT * FROM `tbl_product_colors` WHERE `product_color_productID` = '$productID' ORDER BY `product_color_id` DESC";
          $result = mysqli_query($con, $sql);
          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              $srNo = 1;
              while ($rowColor = mysqli_fetch_array($result)) {

                ?>

                <input type="radio" name="size" value="<?php echo $rowColor['product_color_id']; ?>" checked hidden
                  id="s-size" />
                <label for="s-size" class="size-radio-btn check">
                  <?php echo $rowColor['product_color']; ?>
                </label>
                <?php

              }
            }
          } ?>


          <div class="my-4">
            <button class="btn cart-btn"><a href="shopping-cart.html">Add to cart</a></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="detail-des my-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <h2 class="title-secondary">Description</h2>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magni
          dignissimos totam iste alias impedit consectetur eius eveniet
          nihil, dolor eos ipsam accusantium modi aliquid dolore cum odio.
          Aperiam fuga omnis optio incidunt voluptatum libero ipsam!
          Voluptatum ad quam ullam aliquam vel laudantium fuga ipsa fugiat
          at quia inventore illum reprehenderit esse harum nobis excepturi
          laboriosam dolor, in voluptas cumque earum autem eum eius! Et quae
          corrupti vero commodi cupiditate in corporis inventore provident
          unde assumenda praesentium aliquam eaque ipsam odit nobis
          excepturi doloribus fuga qui nesciunt soluta asperiores
          doloremque, ut expedita! Voluptas quis numquam perspiciatis
          asperiores consequatur quasi, non est, deleniti perferendis
          blanditiis cupiditate quas mollitia inventore. Asperiores ex esse
          odit earum, adipisci quisquam placeat hic cum corrupti iusto
          possimus rem rerum suscipit culpa dignissimos molestiae facilis
          alias doloribus deserunt laudantium libero temporibus eos officia.
          Quis explicabo odit corrupti mollitia esse quod nemo enim
          voluptatem maiores, reiciendis iure aliquid sint? Laudantium
          provident, sed deserunt reiciendis voluptatum nemo voluptatibus,
          ipsum quibusdam fugit recusandae consequatur nihil dolores, optio
          blanditiis? Dicta, alias reprehenderit rem eligendi porro tempore
          molestias animi provident, iusto error asperiores dolorum facilis
          recusandae est perspiciatis. Veniam ut, eos cum hic facere tenetur
          consequatur tempora ratione deserunt molestiae nesciunt. Eligendi
          itaque sapiente nemo culpa amet praesentium necessitatibus, sint
          pariatur nam repellat nesciunt fugit nostrum, nihil assumenda
          accusantium iure ratione dolorum magnam odit temporibus. Magni,
          architecto, iste delectus nobis at, atque ex velit mollitia
          officiis beatae ipsam! Dignissimos fugit nostrum sint optio eum
          iure voluptatibus distinctio eligendi tempora quae ducimus dicta
          totam illo at temporibus in maiores quidem quod veniam aperiam
          unde quasi sapiente, repudiandae impedit. Consectetur sint laborum
          inventore veniam ad, ipsum natus eligendi nesciunt facere quas
          laudantium vero quod fugit doloremque nulla dolore quia unde culpa
          tenetur vel quaerat! Rerum eum quisquam maiores vitae esse! Esse
          dolorum cupiditate perspiciatis cumque!
        </p>
      </div>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>

<?php require "includes/scripts.php"; ?>

<script type="text/javascript">
  let thumbnails = document.getElementsByClassName('thumbnail')

  let activeImages = document.getElementsByClassName('active')

  for (var i = 0; i < thumbnails.length; i++) {

    thumbnails[i].addEventListener('mouseover', function () {
      console.log(activeImages)

      if (activeImages.length > 0) {
        activeImages[0].classList.remove('active')
      }


      this.classList.add('active')
      document.getElementById('featured').src = this.src
    })
  }


  let buttonRight = document.getElementById('slideRight');
  let buttonLeft = document.getElementById('slideLeft');

  buttonLeft.addEventListener('click', function () {
    document.getElementById('slider').scrollLeft -= 180
  })

  buttonRight.addEventListener('click', function () {
    document.getElementById('slider').scrollLeft += 180
  })


</script>
</body>

</html>
<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/carousel-1.jpg" class="carousel-image" alt="" />
      <div class="carousel-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="title-secondary mt-5">Welcome to Asta Closet</h2>
              <p>
                We're thrilled to have you here, and we can't wait to embark
                on a stylish journey together. At ASTA CLOSET, we're all
                about helping you express your unique fashion sense,
                offering a curated collection of the latest trends, timeless
                classics, and everything in between.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/carousel-2.jpg" class="carousel-image" alt="" />
      <div class="carousel-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="title-secondary mt-5">Welcome to Asta Closet</h2>
              <p>
                We're thrilled to have you here, and we can't wait to embark
                on a stylish journey together. At ASTA CLOSET, we're all
                about helping you express your unique fashion sense,
                offering a curated collection of the latest trends, timeless
                classics, and everything in between.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/carousel-3.jpg" class="carousel-image" alt="" />
      <div class="carousel-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="title-secondary mt-5">Welcome to Asta Closet</h2>
              <p>
                We're thrilled to have you here, and we can't wait to embark
                on a stylish journey together. At ASTA CLOSET, we're all
                about helping you express your unique fashion sense,
                offering a curated collection of the latest trends, timeless
                classics, and everything in between.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/carousel-4.jpg" class="carousel-image" alt="" />
      <div class="carousel-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="title-secondary mt-5">Welcome to Asta Closet</h2>
              <p>
                We're thrilled to have you here, and we can't wait to embark
                on a stylish journey together. At ASTA CLOSET, we're all
                about helping you express your unique fashion sense,
                offering a curated collection of the latest trends, timeless
                classics, and everything in between.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="carousel-btn-container">
    <button class="carousel-btn-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
      <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.244141 5.49999L14.1275 0.787789L14.1275 10.2122L0.244141 5.49999Z" fill="#E1F0E6" />
      </svg>
    </button>
    <button class="carousel-btn-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
      <svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.7559 5.50001L0.872527 10.2122L0.872528 0.787817L14.7559 5.50001Z" fill="#E1F0E6" />
      </svg>
    </button>
  </div>
</div>

<section class="my-5 banner-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="single-banner">
          <img src="assets/img/banner-1.jpg.jpg" alt="" />
          <div class="inner-text">
            <h4 style="cursor:pointer;" onclick="window.location.href='allCategories.php?categoryType=M'">Men's</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="single-banner">
          <img src="assets/img/banner-2.jpg.jpg" alt="" />
          <div class="inner-text">
            <h4 style="cursor:pointer;" onclick="window.location.href='allCategories.php?categoryType=F'">Women's</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="women-banner my-lg-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3">
        <div class="w-product-bg">
          <h2 class="text-white fs-1">Women's</h2>
          <a href="allCategories.php?categoryType=F" class="text-decoration-underline fs-5">Discover More</a>
        </div>
      </div>
      <div class="col-lg-8 offset-lg-1">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <?php
            $sql = "SELECT * FROM `tbl_categories` WHERE `category_type` = 'F' AND `category_status` = 'A' ORDER BY `category_id` DESC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  $categoryImage = "admin/" . $row['category_img'];
                  $categoryID = $row['category_id'];
                  ?>
                  <div title="<?php echo $row['category_name']; ?>" style="cursor:pointer"
                    onclick="window.location.href='women-categories.php?categoryID=<?php echo $categoryID; ?>'"
                    class="swiper-slide">
                    <?php if ($categoryImage != "admin/" && file_exists($categoryImage)) { ?>
                      <img src="<?php echo $categoryImage; ?>" alt="<?php echo $row['category_name']; ?> Category" />
                    <?php } ?>
                  </div>
                  <?php
                }
              }
            }
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="find-more my-lg-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="pos-imgs">
          <img src="assets/img/pos-img1.jpg" alt="" class="pos-img1" style="height: 500px" />
          <img src="assets/img/pos-img2.jpg" alt="" class="pos-img2 d-lg-block d-none" style="height: 300px" />
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <h1 class="mb-5">Cherish Every Moment in Asta's Attire</h1>
        <p>
          Gravida eget cras scelerisque neque risus. Ac a vitae laoreet
          sagittis, elit, arcu vestibulum vel. Sem aliquet mauris magna
          justo. Suspendisse posuere suspendisse habitasse ac tempor.
          Egestas fermentum ante malesuada faucibus duis risus adipiscing
          duis nisl. Malesuada nunc fermentum egestas lobortis in tincidunt.
          Nunc tempus, et tincidunt amet at condimentum massa id pulvinar.
        </p>
        <a href="about-us.php" class="text-uppercase btn">More Info</a>
      </div>
    </div>
  </div>
</section>

<section class="men-banner">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php
            $sql = "SELECT * FROM `tbl_categories` WHERE `category_type` = 'M' AND `category_status` = 'A' ORDER BY `category_id` DESC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                  $categoryImage = "admin/" . $row['category_img'];
                  $categoryID = $row['category_id'];
                  ?>
                  <div title="<?php echo $row['category_name']; ?>" style="cursor:pointer"
                    onclick="window.location.href='men-categories.php?categoryID=<?php echo $categoryID; ?>'"
                    class="swiper-slide">
                    <?php if ($categoryImage != "admin/" && file_exists($categoryImage)) { ?>
                      <img src="<?php echo $categoryImage; ?>" alt="<?php echo $row['category_name']; ?> Category" />
                    <?php } ?>
                  </div>
                  <?php
                }
              }
            }
            ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
      <div class="col-lg-3 offset-lg-1">
        <div class="m-product-bg">
          <h2 class="text-white fs-1">Men's</h2>
          <a href="allCategories.php?categoryType=M" class="text-decoration-underline fs-5">Discover More</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>

<?php require "includes/scripts.php"; ?>
</body>

</html>
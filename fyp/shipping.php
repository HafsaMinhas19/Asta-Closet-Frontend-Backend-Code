<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<section class="check-out py-5">
  <div class="container">
    <h1 class="title-secondary text-center">Shipping Method</h1>
    <div class="row align-items-center my-5 justify-content-around">
      <div class="col-lg-6 col-md-5 col-sm-12">
        <div class="shipping-detail border border-black p-4">
          <div class="shipping-contact d-flex align-items-center justify-content-between">
            <h6>Contact</h6>
            <p>dummyData123@gmail.com</p>
            <h6><a href="check-out.html">Change</a></h6>
          </div>
          <div class="shipping-contact align-items-center d-flex justify-content-between text-center">
            <h6>Ship to</h6>
            <address>S/A 179 st 8 sadiqabad, Rwp 0000, Pakistan</address>
            <h6><a href="check-out.html">Change</a></h6>
          </div>
        </div>
        <h4 class="color-red mt-5">Shipping Method</h4>
        <div class="border border-black mb-5 mt-4 p-4 shipping-detail">
          <div class="shipping-contact d-flex align-items-center justify-content-between">

            <input type="radio" name="shipped" id="shipped" checked>
            <label for="shipped">Home Delivery</label>
            <h6 class="color-red">200Rs</h6>
          </div>
        </div>
        <div class="cart-buttons d-flex gap-3 my-4">
          <a href="shopping-cart.html" class="mb-3 check-btn1"><i class="px-2 fa-solid fa-arrow-left"></i> Back To
            Cart</a>
          <a href="order-confirm.html" class="mb-3 check-btn2">
            Confirm Order
            <i class="px-2 fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-lg-5 col-md-6 col-sm-12 bg-grey p-0">
        <h2 class="bg-blue color-white p-3 text-center">Order Summary</h2>
        <div class="px-5">
          <div
            class="align-items-center border-bottom border-dark check-summary d-flex gap-4 p-4 justify-content-around">
            <img src="assets/img/mens-wear-6.jpg" alt="" />
            <h5>Pure Pineapple</h5>
            <h5 class="color-red">1500Rs</h5>
            <i class="fa-solid fa-xmark"></i>
          </div>
          <div
            class="align-items-center border-bottom border-dark check-summary d-flex gap-4 p-4 justify-content-around">
            <img src="assets/img/mens-wear-6.jpg" alt="" />
            <h5>Pure Pineapple</h5>
            <h5 class="color-red">1500Rs</h5>
            <i class="fa-solid fa-xmark"></i>
          </div>
          <div
            class="align-items-center check-summary d-flex gap-4 p-4 border-bottom border-dark justify-content-around">
            <img src="assets/img/mens-wear-6.jpg" alt="" />
            <h5>Pure Pineapple</h5>
            <h5 class="color-red">1500Rs</h5>
            <i class="fa-solid fa-xmark"></i>
          </div>
          <div class="border-black border-bottom px-5 py-4">
            <div class="align-items-center d-flex gap-5 justify-content-between">
              <h6>Sub-Total</h6>
              <h6 class="color-red">4500Rs</h6>
            </div>
            <div class="align-items-center d-flex gap-5 justify-content-between">
              <h6>Shipping Charges?</h6>
              <h6 class="color-red">200Rs</h6>
            </div>
          </div>
          <div class="px-5 my-4">
            <div class="align-items-center d-flex gap-5 justify-content-between">
              <h6>Total</h6>
              <h6 class="color-red">4700Rs</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>

<?php require "includes/scripts.php"; ?>
</body>

</html>
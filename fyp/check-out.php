<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<section class="check-out py-5">
  <div class="container">
    <h1 class="title-secondary text-center">Checkout</h1>
    <div class="row align-items-center my-5 justify-content-around">
      <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="checkout-wrapper">
          <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-user"></i>
            <h5 class="m-0">
              Have an Account?<a href="login.html" class="color-red">
                Log In</a>
            </h5>
          </div>
          <div class="checkout-form">
            <form action="">
              <h3 class="py-3">Shipping Address</h3>
              <div class="form-group">
                <label for="address" class="fw-bolder">Address</label>
                <input type="text" class="form-control mb-3" id="address" placeholder="Enter your Address" />
              </div>
              <div class="d-flex align-items-center gap-3">
                <div class="form-group w-50">
                  <label for="country" class="fw-bolder">Country</label>
                  <input type="country" class="form-control mb-3" id="country" placeholder="Enter your Country" />
                </div>
                <div class="form-group w-50">
                  <label for="city" class="fw-bolder">City</label>
                  <input type="city" class="form-control mb-3" id="city" placeholder="Enter your City" />
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <div class="form-group w-50">
                  <label for="fName" class="fw-bolder">First Name</label>
                  <input type="fName" class="form-control mb-3" id="fName" placeholder="First Name" />
                </div>
                <div class="form-group w-50">
                  <label for="lName" class="fw-bolder">Last Name</label>
                  <input type="lName" class="form-control mb-3" id="lName" placeholder="Last Name" />
                </div>
              </div>
              <div class="form-group">
                <label for="Phone" class="fw-bolder">Phone</label>
                <input type="text" class="form-control mb-3" id="Phone" placeholder="Enter your Phone Number" />
              </div>
              <div class="form-group form-check my-3">
                <input type="checkbox" class="form-check-input" id="remember-me" />
                <label class="form-check-label fw-bolder" for="remember-me">SAVE THIS INFORMATION FOR NEXT
                  TIME</label>
              </div>

              <div class="cart-buttons d-flex gap-3 my-4">
                <a href="shopping-cart.html" class="mb-3 check-btn1"><i class="px-2 fa-solid fa-arrow-left"></i> Back
                  To
                  Cart</a>
                <a href="shipping.html" class="mb-3 check-btn2">
                  Continue To Shipping
                  <i class="px-2 fa-solid fa-arrow-right"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 bg-grey p-0">
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
              <h6 class="text-black-50">Calculated at next step</h6>
            </div>
          </div>
          <div class="px-5 my-4">
            <div class="align-items-center d-flex gap-5 justify-content-between">
              <h6>Total</h6>
              <h6 class="color-red">4500Rs</h6>
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
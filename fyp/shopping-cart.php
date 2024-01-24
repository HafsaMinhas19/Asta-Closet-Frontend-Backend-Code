<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<section class="shopping-cart my-5">
  <div class="container">
    <h1 class="title-secondary text-center my-5">Shopping Cart</h1>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="cart-table">
          <table>
            <thead>
              <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="cart-pic">
                  <img src="assets/img/women-banner-1.jpg" alt="" />
                </td>
                <td>
                  <h5>Pure Pineapple</h5>
                </td>
                <td class="p-price">1500Rs</td>
                <td class="qua-col">
                  <div class="quantity">
                    <div class="pro-qty">
                      <span class="dec qtybtn">-</span>
                      <input type="text" value="1" />
                      <span class="inc qtybtn">+</span>
                    </div>
                  </div>
                </td>
                <td class="total-price">1500Rs</td>
                <td class="close-td"><i class="fa-solid fa-xmark"></i></td>
              </tr>
              <tr>
                <td class="cart-pic">
                  <img src="assets/img/women-banner-2.jpg"" />
                    </td>
                    <td>
                      <h5>American lobster</h5>
                    </td>
                    <td class=" p-price">1500Rs
                </td>
                <td class="qua-col">
                  <div class="quantity">
                    <div class="pro-qty">
                      <span class="dec qtybtn">-</span>
                      <input type="text" value="1" />
                      <span class="inc qtybtn">+</span>
                    </div>
                  </div>
                </td>
                <td class="total-price">1500Rs</td>
                <td class="close-td"><i class="fa-solid fa-xmark"></i></td>
              </tr>
              <tr>
                <td class="cart-pic">
                  <img src="assets/img/women-banner-3.jpg" alt="" />
                </td>
                <td>
                  <h5>Silver clutch</h5>
                </td>
                <td class="p-price">1500Rs</td>
                <td class="qua-col">
                  <div class="quantity">
                    <div class="pro-qty">
                      <span class="dec qtybtn">-</span>
                      <input type="text" value="1" />
                      <span class="inc qtybtn">+</span>
                    </div>
                  </div>
                </td>
                <td class="total-price">1500Rs</td>
                <td class="close-td"><i class="fa-solid fa-xmark"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
        <div class="cart-buttons">
          <a href="collection.html" class="cartbtn-1">Continue Shopping</a>
          <a href="" class="cartbtn-2">Update Cart</a>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-4 col-md-12 col-sm-12">
        <div class="proceed-check-out">
          <ul class="m-0 list-unstyled">
            <li class="sub-total d-flex justify-content-between">
              Subtotal
              <span>4500Rs</span>
            </li>
            <li class="cart-total d-flex justify-content-between">
              Total
              <span>4500Rs</span>
            </li>
          </ul>
          <a href="check-out.html">Proceed to Check out</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>

<?php require "includes/scripts.php"; ?>
</body>

</html>
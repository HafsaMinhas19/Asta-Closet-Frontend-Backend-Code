<?php require "includes/head.php"; ?>

<?php require "includes/header.php"; ?>

<section class="contact-us my-5">
  <div class="container">
    <h1 class="title-secondary text-center mb-3">Contact Us</h1>
    <div class="row">
      <div class="col-lg-6 contact-form-border">
        <div class="contact-us-inner">
          <h3 class="mb-3">Send Us A Message</h3>
          <form action="" class="contact-form">
            <div class="contact-input-container mb-3">
              <i class="fa-solid fa-envelope"></i>
              <input type="email" placeholder="Your Email Address" required />
            </div>
            <div class="contact-input-container mb-3">
              <textarea name="" id="" cols="30" rows="10" placeholder="How Can We Help?"></textarea>
            </div>
            <div class="contact-input-container mb-3">
              <input type="submit" value="Submit" class="text-uppercase" />
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-6 contact-form-border">
        <div class="contact-us-inner d-flex flex-column gap-3">
          <div class="mt-lg-5 pt-lg-5">
            <div class="d-flex gap-3 align-items-center">
              <i class="fa-solid fa-location-dot"></i>
              <h3>Address</h3>
            </div>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae,
              temporibus?
            </p>
          </div>
          <div>
            <div class="d-flex gap-3 align-items-center">
              <i class="fa-solid fa-phone"></i>
              <h3>Let's Talk</h3>
            </div>
            <a href="tel:000.000.000">000.000.000</a>
          </div>
          <div>
            <div class="d-flex gap-3 align-items-center">
              <i class="fa-solid fa-envelope"></i>
              <h3 class="mt-4">Sale Support</h3>
            </div>
            <a href="mailto:astacloset@gmail.com" class="mt-3">astacloset@gmail.com</a>
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
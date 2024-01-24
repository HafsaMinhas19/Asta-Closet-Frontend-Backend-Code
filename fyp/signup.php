<?php
require "includes/connection.php";
require "includes/functions.php";

if (isUserLogin() === true) {
  header("location:index.php");
  exit();
}

$userName = $userEmail = $userPassword = $confirmPassword = $userContactNo = $userAddress = $userType = $userProfileImage = $userStatus = $userCreatedDate = "";

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] = array();
}

// check signUp btn is pressed or not.
if (isset($_POST['signUpBtn'])) {

  if (empty($_POST['userName'])) {
    array_push($_SESSION['errors'], "Name is required");
  } else {
    $userName = trim(mysqli_real_escape_string($con, $_POST['userName']));
    if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
      $nameErr = "Only letters and white space allowed in user Name";
      array_push($_SESSION['errors'], $nameErr);
    }
  }

  if (empty($_POST['userEmail'])) {
    array_push($_SESSION['errors'], "Email is required");
  } else {
    $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      array_push($_SESSION["errors"], $emailErr);
    }
    if (checkUserEmailExist($userEmail) > 0) {
      array_push($_SESSION["errors"], "Email Already Exist");
    }
  }

  if (empty($_POST['userPassword'])) {
    array_push($_SESSION['errors'], "Password is required");
  } else {
    $userPassword = mysqli_real_escape_string($con, $_POST['userPassword']);
  }

  if (empty($_POST['confirmPassword'])) {
    array_push($_SESSION['errors'], "Confirm password is Required");
  } else {
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
  }

  // Check for confirm password field
  if (trim($userPassword) != trim($confirmPassword)) {
    array_push($_SESSION['errors'], "Passwords should match");
  } else {
    $userPassword = md5($userPassword);
  }

  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    $userStatus = "A";
    $userType = "C";
    $userCreatedDate = date("Y-m-d h:i:s");
    $sql = "INSERT INTO `tbl_users` (`user_name`,`user_email`,`user_password`,`user_type`,`user_status`,`user_createdDate`) VALUES ('$userName','$userEmail','$userPassword','$userType','$userStatus','$userCreatedDate')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $_SESSION['successMessage'] = "Registration Successfull";
      header("location: login.php");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Asta Closet SignUp</title>
  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="assets/img/vector.png" />
</head>


<body>

  <section class="login-section vh-100">
    <div class="container">
      <div class="login-box">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="back-button" onclick="goBack()">
              <i class="fa-solid fa-arrow-left text-white"></i>
            </div>
            <div class="login-vector">
              <img src="assets/img/login-vector.png" alt="" />
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="login-form">
              <h2 class="sign-title title-secondary mb-4">
                Sign Up to create account
              </h2>
              <div class="sign-body">
                <form action="signup.php" method="POST" name="signupForm">
                  <?php
                  if (isset($_SESSION['errors'])) {
                    $errors = $_SESSION['errors'];
                    foreach ($errors as $error) {
                      ?>
                      <div class="alert alert-danger">
                        <?php echo $error; ?>
                      </div>
                      <?php
                    }
                    unset($_SESSION['errors']);
                  }

                  ?>
                  <?php if (isset($_SESSION['errorMessage'])) { ?>
                    <div class="alert alert-danger">
                      <?php echo $_SESSION['errorMessage'];
                      unset($_SESSION['errorMessage']); ?>
                    </div>
                  <?php } ?>

                  <div class="form-group">
                    <label for="userName" class="fw-bolder">Name</label>
                    <input type="text" name="userName" class="form-control mb-3" id="userName"
                      placeholder="Enter your name" value="<?php echo $userName; ?>" />
                    <div class="formerror"></div>
                  </div>
                  <div class="form-group">
                    <label for="userEmail" class="fw-bolder">Email</label>
                    <input type="email" class="form-control mb-3" name="userEmail" id="userEmail"
                      placeholder="Enter your email" value="<?php echo $userEmail; ?>" />
                    <div class="formerror"></div>
                  </div>
                  <div class="form-group">
                    <label for="userPassword" class="fw-bolder">Password</label>
                    <input type="password" name="userPassword" class="form-control mb-3" id="userPassword"
                      placeholder="Enter your password" />
                    <div class="formerror"></div>
                  </div>
                  <div class="form-group">
                    <label for="confirmPassword" class="fw-bolder">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control mb-3" id="confirmPassword"
                      placeholder="Confirm password" />
                    <div class="formerror"></div>
                  </div>
                  <button type="submit" name="signUpBtn" class="btn btn-primary my-3 text-uppercase">
                    SignUp
                  </button>
                </form>
              </div>
              <div class="sign-footer d-flex gap-2">
                <p>Already have an account?</p>
                <a href="login.php" class="color-red fw-bolder">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require "includes/scripts.php"; ?>
</body>

</html>
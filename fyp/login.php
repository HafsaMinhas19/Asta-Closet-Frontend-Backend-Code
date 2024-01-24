<?php
require "includes/connection.php";
require "includes/functions.php";

if (isUserLogin() === true) {
  header("location:index.php");
  exit();
}

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] = array();
}

//declare variable
$userName = $userEmail = $userPassword = $confirmPassword = $userContactNo = $userAddress = $userType = $userProfileImage = $userStatus = $userCreatedDate = "";

// check login btn is pressed or not.
if (isset($_POST['loginBtn'])) {

  if (empty($_POST['userEmail'])) {
    array_push($_SESSION['errors'], "Email is Required");
  } else {
    $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
  }

  if (empty($_POST['userPassword'])) {
    array_push($_SESSION['errors'], "Password is Required");
  } else {
    $userPassword = mysqli_real_escape_string($con, $_POST['userPassword']);
    $userPassword = md5($userPassword);
  }

  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    $sql = "SELECT * FROM tbl_users WHERE user_email = '$userEmail' AND user_password = '$userPassword' AND user_type = 'C'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      if (mysqli_num_rows($result) == 1) {
        if ($row = mysqli_fetch_array($result)) {
          if ($row['user_status'] == "A") {
            $_SESSION['userID'] = $row['user_id'];
            $_SESSION['userName'] = $row['user_name'];
            $_SESSION['userEmail'] = $row['user_email'];
            $_SESSION['userImage'] = $row['user_profileImage'];
            $_SESSION['userType'] = $row['user_type'];
            header("location:index.php");
            exit();
          } else if ($row['user_status'] == "P") {
            array_push($_SESSION['errors'], 'Your Account is in Pending State');
          } else if ($row['user_status'] == "B") {
            array_push($_SESSION['errors'], 'Your Account Has been blocked');
          } else if ($row['user_status'] == "R") {
            array_push($_SESSION['errors'], 'Your Account has been Rejected');
          }
        }
      } else {
        array_push($_SESSION['errors'], 'Email or Password is invalid, Please enter vaild Email and Password');
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
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
                Log in to your account
              </h2>
              <div class="sign-body">
                <form action="login.php" method="POST">
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
                  <?php if (isset($_SESSION['successMessage'])) { ?>
                    <div class="alert alert-success">
                      <?php echo $_SESSION['successMessage'];
                      unset($_SESSION['successMessage']); ?>
                    </div>
                  <?php } ?>
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
                  <button type="submit" name="loginBtn" class="btn btn-primary my-3 text-uppercase">
                    Login
                  </button>
                </form>
              </div>
              <div class="sign-footer d-flex gap-2">
                <p>Don't have an account?</p>
                <a href="signup.php" class="color-red fw-bolder">Sign up</a>
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
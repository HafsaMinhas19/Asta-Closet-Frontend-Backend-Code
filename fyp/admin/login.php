<?php
require "includes/connection.php";
require "includes/functions.php";

if (isAdminLogin() === true) {
  header("location:index.php");
  exit();
}

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] = array();
}

//declare variable
$email = $password = "";
// check login btn is pressed or not.
if (isset($_POST['loginBtn'])) {

  if (empty($_POST['email'])) {
    array_push($_SESSION['errors'], "Email is Required");
  } else {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      array_push($_SESSION["errors"], $emailErr);
    }
  }

  if (empty($_POST['password'])) {
    array_push($_SESSION['errors'], "Password is Required");
  } else {
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password = md5($password);
  }

  if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    $sql = "SELECT * FROM tbl_users WHERE user_email = '$email' AND user_password = '$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      if (mysqli_num_rows($result) == 1) {
        if ($row = mysqli_fetch_array($result)) {
          if ($row['user_status'] == "A") {
            $_SESSION['adminID'] = $row['user_id'];
            $_SESSION['adminName'] = $row['user_name'];
            $_SESSION['adminEmail'] = $row['user_email'];
            $_SESSION['adminImage'] = $row['user_profileImage'];
            $_SESSION['adminType'] = $row['user_type'];
            header("location:index.php");
            exit();
          } else if ($row['user_status'] == "P") {
            array_push($_SESSION['errors'], 'Your Account is in Pending State');
          } else if ($row['user_status'] == "B") {
            array_push($_SESSION['errors'], 'Your Account has been Blocked');
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
  <title>Asta Closet Admin | Login</title>
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
  <link rel="stylesheet" href="assets/css/css_bootstrap.min.css" />
  <link rel="stylesheet" href="style.css" />
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
                <form action="login.php" method="post">
                  <?php if (isset($_SESSION['successMessage'])) {
                    ?>
                    <div class="alert alert-success">
                      <?php echo $_SESSION['successMessage'];
                      unset($_SESSION['successMessage']); ?>
                    </div>
                    <?php
                  } ?>


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
                  <div class="form-group" id="name">
                    <label for="email" class="fw-bolder">Email</label>
                    <input type="email" name="email" class="form-control mb-3" id="email" placeholder="Enter your email"
                      value="<?php echo $email; ?>" />
                  </div>
                  <div class="form-group" id="pass">
                    <label for="password" class="fw-bolder">Password</label>
                    <input type="password" class="form-control mb-3" name="password" id="password"
                      placeholder="Enter your password" />
                  </div>
                  <button type="submit" name="loginBtn" class="btn btn-primary my-3 text-uppercase">
                    Login
                  </button>
                </form>
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
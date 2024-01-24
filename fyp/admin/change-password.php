<?php
require "includes/connection.php";
require "includes/functions.php";

if (isAdminLogin() === false) {
    header("location:login.php");
    exit();
}

// create error array for storing errors in this array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
}

//declare variable
$oldPassword = $password = $confirmPassword = "";
/*check login btn is pressed or not.*/
if (isset($_POST['updatePasswordBtn'])) {

    if (empty($_POST['oldPassword'])) {
        array_push($_SESSION['errors'], "Old Password is Required");
    } else {
        $oldPassword = mysqli_real_escape_string($con, $_POST['oldPassword']);
        $oldPassword = md5($oldPassword);
    }

    if (empty($_POST['password'])) {
        array_push($_SESSION['errors'], "Password is Required");
    } else {
        $password = mysqli_real_escape_string($con, $_POST['password']);

    }

    if (empty($_POST['confirmPassword'])) {
        array_push($_SESSION['errors'], "Confirm Password is Required");
    } else {
        $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

    }

    if ($password == $confirmPassword) {
        $password = md5($password);
    } else {
        array_push($_SESSION['errors'], "Passwords should match");
    }

    if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
        $adminID = $_SESSION['adminID'];
        $sql = "SELECT * FROM `tbl_users` WHERE `user_password` = '$oldPassword' AND `user_id` = '$adminID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $sql = "UPDATE `tbl_users` SET `user_password` = '$password' WHERE `user_id` = '$adminID'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['successMessage'] = "Password Updated Successfully";
                    header("location:logout.php");
                    exit();
                }
            } else {
                array_push($_SESSION['errors'], 'Old Password is invalid, Please enter vaild Old Password');
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
    <title>Asta Closet Admin | Change Password</title>
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
                                Change your Account Password
                            </h2>
                            <div class="sign-body">
                                <form action="change-password.php" method="POST">
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
                                        <label for="oldPassword" class="fw-bolder">Old Password</label>
                                        <input type="password" class="form-control mb-3" name="oldPassword"
                                            id="oldPassword" placeholder="Enter your old password" />
                                        <div class="formerror"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="fw-bolder">New Password</label>
                                        <input type="password" name="password" class="form-control mb-3" id="password"
                                            placeholder="Enter your new password" />
                                        <div class="formerror"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword" class="fw-bolder">Confirm Password</label>
                                        <input type="password" name="confirmPassword" class="form-control mb-3"
                                            id="confirmPassword" placeholder="Confirm Password" />
                                        <div class="formerror"></div>
                                    </div>
                                    <button type="submit" name="updatePasswordBtn"
                                        class="btn btn-primary my-3 text-uppercase">
                                        Update password
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
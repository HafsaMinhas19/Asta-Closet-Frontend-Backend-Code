<?php require "includes/head.php"; ?>

<?php
$userName = $userEmail = $userPassword = $userContactNo = $userAddress = $userType = $userTypeTitle = $userProfileImage = $userStatus = $userCreatedDate = $userUpdatedDate = $userID = "";

if (isset($_GET['userType']) && $_GET['userType'] != "") {
    $userType = $_GET['userType'];
    if ($userType == "C") {
        $userTypeTitle = "Customer";
    } else {
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:viewCustomersListing.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewCustomersListing.php");
    exit();
}

if (isset($_GET["userID"]) && $_GET["userID"] != "") {
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            if ($row = mysqli_fetch_array($result)) {
                $userName = $row["user_name"];
                $userEmail = $row["user_email"];
                $userContactNo = $row["user_contactNo"];
                $userAddress = $row["user_address"];
                $userType = $row["user_type"];
                $userStatus = $row['user_status'];
                $userProfileImage = $row["user_profileImage"];
                $userProfileImageOld = $row['user_profileImage'];
            }
        } else {
            $_SESSION['errorMessage'] = "Access Denied...!";
            header("location:viewCustomersListing.php?userType=" . $userType);
            exit();
        }
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewCustomersListing.php?userType=" . $userType);
    exit();
}

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
}

// check updateCustomer btn is pressed or not.
if (isset($_POST['updateCustomerBtn'])) {

    if (empty($_POST['userName'])) {
        array_push($_SESSION['errors'], "Customer Name is required");
    } else {
        $userName = trim(mysqli_real_escape_string($con, $_POST['userName']));
        if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
            $nameErr = "Only letters and white space allowed in Employee Name";
            array_push($_SESSION['errors'], $nameErr);
        }
    }

    if (empty($_POST['userEmail'])) {
        array_push($_SESSION['errors'], "Customer email is required");
    } else {
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            array_push($_SESSION["errors"], $emailErr);
        }
        if (checkUserEmailExist($userEmail, $userID) > 0) {
            array_push($_SESSION["errors"], "Email Already Exist");
        }
    }

    if (empty($_POST['userContactNo'])) {
        array_push($_SESSION['errors'], "Customer contact no is required");
    } else {
        $userContactNo = mysqli_real_escape_string($con, $_POST['userContactNo']);
        if (!preg_match("/^[0-9]{3}[0-9]{4}[0-9]{4}$/", $userContactNo)) {
            array_push($_SESSION['errors'], "InValid Phone No");
        }
    }

    if (empty($_POST['userAddress'])) {
        array_push($_SESSION['errors'], "Customer address is required");
    } else {
        $userAddress = mysqli_real_escape_string($con, $_POST['userAddress']);
    }

    if (basename($_FILES["userProfileImage"]["name"] != "")) {
        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp . '-' . basename($_FILES["userProfileImage"]["name"]); //uploads/12131231-abc.jpg
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            array_push($_SESSION['errors'], "Sorry, file already exists");
        }
        if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
            if (move_uploaded_file($_FILES["userProfileImage"]["tmp_name"], $target_file)) {
                //your query with file path
                $userProfileImage = $target_file;
            } else {
                array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
            }
        }
    } else {
        $userProfileImage = $userProfileImageOld;
    }

    if (empty($_POST['userStatus'])) {
        array_push($_SESSION['errors'], "Customer Status is Required");
    } else {
        $userStatus = mysqli_real_escape_string($con, $_POST['userStatus']);
    }

    if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
        $userType = "C";
        $userUpdatedDate = date("Y-m-d h:i:s");
        $sql = "UPDATE `tbl_users` SET `user_name` = '$userName', `user_email` = '$userEmail', `user_contactNo` = '$userContactNo', `user_address` = '$userAddress', `user_type` = '$userType', `user_profileImage` = '$userProfileImage', `user_updatedDate` = '$userUpdatedDate', `user_status` = '$userStatus' WHERE `user_id` = '$userID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['successMessage'] = "Customer Updated Successfully";
            header("location:viewCustomersListing.php?userType=" . $userType);
            exit();
        }
    }
}
?>


<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
    <section class="all-products">
        <h1 class="title-secondary">Edit Customers
        </h1>
        <div class="row">
            <div class="col-12">
                <form action="updateCustomers.php?userType=<?php echo $userType; ?>&userID=<?php echo $userID; ?>"
                    method="POST" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="userName" class="fw-bolder">Name</label>
                        <input type="text" name="userName" class="form-control mb-3" id="userName"
                            placeholder="Enter employee name" value="<?php echo $userName; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="userEmail" class="fw-bolder">Email</label>
                        <input type="email" name="userEmail" class="form-control mb-3" id="userEmail"
                            placeholder="Enter employee email" value="<?php echo $userEmail; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="userContactNo" class="fw-bolder">Contact No</label>
                        <input type="tel" class="form-control mb-3" name="userContactNo" id="userContactNo"
                            placeholder="Enter employee contact no" value="<?php echo $userContactNo; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="userAddress" class="fw-bolder">Address</label>
                        <input type="text" class="form-control mb-3" name="userAddress" id="userAddress"
                            placeholder="Enter employee address" value="<?php echo $userAddress; ?>" />
                    </div>
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-11">
                                <input type="file" name="userProfileImage" class="form-control mb-3"
                                    id="userProfileImage" placeholder="Choose Image" />
                            </div>
                            <div class="col-md-1">
                                <?php if ($userProfileImage != "" && file_exists($userProfileImage)) {
                                    ?>
                                    <img src="<?php echo $userProfileImage; ?>" alt="<?php echo $userName; ?>"
                                        style="width:80px; height:80px;" />
                                    <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <select name="userStatus" id="userStatus" class="form-select">
                            <option selected disabled hidden>Customer Status</option>
                            <option <?php if ($userStatus == "A") {
                                echo "selected";
                            } ?> value="A">Active</option>
                            <option <?php if ($userStatus == "B") {
                                echo "selected";
                            } ?> value="B">Blocked</option>
                        </select>
                    </div>
                    <button type="submit" name="updateCustomerBtn" class="btn btn-primary">Update Customer</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php require "includes/scripts.php"; ?>

</body>

</html>
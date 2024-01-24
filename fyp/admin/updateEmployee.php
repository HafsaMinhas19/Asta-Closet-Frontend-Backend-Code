<?php require "includes/head.php"; ?>

<?php
$adminName = $adminEmail = $adminContactNo = $adminAddress = $adminType = $adminTypeTitle = $adminImage = $adminStatus = $adminUpdatedDate = $adminID = "";

if (isset($_GET['adminType']) && $_GET['adminType'] != "") {
    $adminType = $_GET['adminType'];
    if ($adminType == "E") {
        $adminTypeTitle = "Employee";
    } else {
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:viewEmployeesListing.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewEmployeesListing.php");
    exit();
}

if (isset($_GET["adminID"]) && $_GET["adminID"] != "") {
    $adminID = $_GET['adminID'];
    $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$adminID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            if ($row = mysqli_fetch_array($result)) {
                $adminName = $row["user_name"];
                $adminEmail = $row["user_email"];
                $adminContactNo = $row["user_contactNo"];
                $adminAddress = $row["user_address"];
                $adminType = $row["user_type"];
                $adminStatus = $row['user_status'];
                $adminImage = $row["user_profileImage"];
                $adminImageOld = $row['user_profileImage'];
            }
        } else {
            $_SESSION['errorMessage'] = "Access Denied...!";
            header("location:viewEmployeesListing.php?adminType=" . $adminType);
            exit();
        }
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:viewEmployeesListing.php?adminType=" . $adminType);
    exit();
}

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
}

// check updateEmployee btn is pressed or not.
if (isset($_POST['updateEmployeeBtn'])) {

    if (empty($_POST['adminName'])) {
        array_push($_SESSION['errors'], "Employee Name is required");
    } else {
        $adminName = trim(mysqli_real_escape_string($con, $_POST['adminName']));
        if (!preg_match("/^[a-zA-Z-' ]*$/", $adminName)) {
            $nameErr = "Only letters and white space allowed in Employee Name";
            array_push($_SESSION['errors'], $nameErr);
        }
    }

    if (empty($_POST['adminEmail'])) {
        array_push($_SESSION['errors'], "Employee email is required");
    } else {
        $adminEmail = mysqli_real_escape_string($con, $_POST['adminEmail']);
        if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            array_push($_SESSION["errors"], $emailErr);
        }
        if (checkAdminEmailExist($adminEmail, $adminID) > 0) {
            array_push($_SESSION["errors"], "Email Already Exist");
        }
    }

    if (empty($_POST['adminContactNo'])) {
        array_push($_SESSION['errors'], "Employee contact no is required");
    } else {
        $adminContactNo = mysqli_real_escape_string($con, $_POST['adminContactNo']);
        if (!preg_match("/^[0-9]{3}[0-9]{4}[0-9]{4}$/", $adminContactNo)) {
            array_push($_SESSION['errors'], "InValid Phone No");
        }
    }

    if (empty($_POST['adminAddress'])) {
        array_push($_SESSION['errors'], "Employee address is required");
    } else {
        $adminAddress = mysqli_real_escape_string($con, $_POST['adminAddress']);
    }

    if (basename($_FILES["adminImage"]["name"] != "")) {
        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp . '-' . basename($_FILES["adminImage"]["name"]); //uploads/12131231-abc.jpg
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            array_push($_SESSION['errors'], "Sorry, file already exists");
        }
        if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
            if (move_uploaded_file($_FILES["adminImage"]["tmp_name"], $target_file)) {
                //your query with file path
                $adminImage = $target_file;
            } else {
                array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
            }
        }
    } else {
        $adminImage = $adminImageOld;
    }

    if (empty($_POST['adminStatus'])) {
        array_push($_SESSION['errors'], "Employee Status is Required");
    } else {
        $adminStatus = mysqli_real_escape_string($con, $_POST['adminStatus']);
    }

    if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
        $adminType = "E";
        $adminUpdatedDate = date("Y-m-d h:i:s");
        $sql = "UPDATE `tbl_users` SET `user_name` = '$adminName', `user_email` = '$adminEmail', `user_contactNo` = '$adminContactNo', `user_address` = '$adminAddress', `user_type` = '$adminType', `user_profileImage` = '$adminImage', `user_updatedDate` = '$adminUpdatedDate', `user_status` = '$adminStatus' WHERE `user_id` = '$adminID'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['successMessage'] = "Employee Updated Successfully";
            header("location:viewEmployeesListing.php?adminType=" . $adminType);
            exit();
        }
    }
}
?>


<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
    <section class="all-products">
        <h1 class="title-secondary">Edit Employee
        </h1>
        <div class="row">
            <div class="col-12">
                <form action="updateEmployee.php?adminType=<?php echo $adminType; ?>&adminID=<?php echo $adminID; ?>"
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
                        <label for="adminName" class="fw-bolder">Name</label>
                        <input type="text" name="adminName" class="form-control mb-3" id="adminName"
                            placeholder="Enter employee name" value="<?php echo $adminName; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="adminEmail" class="fw-bolder">Email</label>
                        <input type="email" name="adminEmail" class="form-control mb-3" id="adminEmail"
                            placeholder="Enter employee email" value="<?php echo $adminEmail; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="adminContactNo" class="fw-bolder">Contact No</label>
                        <input type="tel" class="form-control mb-3" name="adminContactNo" id="adminContactNo"
                            placeholder="Enter employee contact no" value="<?php echo $adminContactNo; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="adminAddress" class="fw-bolder">Address</label>
                        <input type="text" class="form-control mb-3" name="adminAddress" id="adminAddress"
                            placeholder="Enter employee address" value="<?php echo $adminAddress; ?>" />
                    </div>
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-md-11">
                                <input type="file" name="adminImage" class="form-control mb-3"
                                    id="adminImage" placeholder="Choose Image" />
                            </div>
                            <div class="col-md-1">
                                <?php if ($adminImage != "" && file_exists($adminImage)) {
                                    ?>
                                    <img src="<?php echo $adminImage; ?>" alt="<?php echo $adminName; ?>"
                                        style="width:80px; height:80px;" />
                                    <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <select name="adminStatus" id="adminStatus" class="form-select">
                            <option selected disabled hidden>Employee Status</option>
                            <option <?php if ($adminStatus == "A") {
                                echo "selected";
                            } ?> value="A">Active</option>
                            <option <?php if ($adminStatus == "B") {
                                echo "selected";
                            } ?> value="B">Blocked</option>
                        </select>
                    </div>
                    <button type="submit" name="updateEmployeeBtn" class="btn btn-primary">Update Employee</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php require "includes/scripts.php"; ?>

</body>

</html>
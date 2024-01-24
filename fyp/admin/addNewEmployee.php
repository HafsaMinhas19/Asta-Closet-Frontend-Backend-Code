<?php require "includes/head.php"; ?>

<?php
$adminName = $adminEmail = $adminPassword = $adminContactNo = $adminAddress = $adminType = $adminImage = $adminStatus = $adminCreatedDate = "";

//Error Array
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
}

// check addNewUserBtn btn is pressed or not.
if (isset($_POST['addNewUserBtn'])) {

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
        if (checkAdminEmailExist($adminEmail) > 0) {
            array_push($_SESSION["errors"], "Email Already Exist");
        }
    }

    $adminPassword = md5($adminName);

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
        array_push($_SESSION['errors'], "Please Upload Employee Image");
    }

    if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
        $adminStatus = "A";
        $adminType = "E";
        $adminCreatedDate = date("Y-m-d h:i:s");
        $sql = "INSERT INTO `tbl_users` (`user_name`,`user_email`,`user_password`,`user_contactNo`,`user_address`,`user_type`,`user_profileImage`,`user_status`,`user_createdDate`) VALUES ('$adminName','$adminEmail','$adminPassword','$adminContactNo','$adminAddress','$adminType','$adminImage','$adminStatus','$adminCreatedDate')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['successMessage'] = "Employee Added Successfully";
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
        <h1 class="title-secondary">Add New Employee</h1>
        <div class="row">
            <div class="col-12">
                <form action="addNewEmployee.php" method="POST" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <input type="file" name="adminImage" class="form-control mb-3" id="adminImage"
                            placeholder="Choose Image" />
                    </div>
                    <button type="submit" name="addNewUserBtn" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php require "includes/scripts.php"; ?>
</body>

</html>
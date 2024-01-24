<?php
require "includes/connection.php";
require "includes/functions.php";
?>

<?php
$adminType = $adminTypeTitle = $adminName = $adminStatus = $adminCreatedDate = $adminID = "";

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
                $sql = "DELETE FROM `tbl_users` WHERE `user_id` = '$adminID'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['successMessage'] = "Employee Deleted Successfully";
                    header("location:viewEmployeesListing.php?adminType=" . $adminType);
                    exit();
                }
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
?>
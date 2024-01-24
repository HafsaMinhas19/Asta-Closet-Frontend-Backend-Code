<?php
require "includes/connection.php";
require "includes/functions.php";
?>

<?php
$userType = $userTypeTitle = $userName = $userStatus = $userCreatedDate = $userID = "";

$userType = $userTypeTitle = "";
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
                $sql = "DELETE FROM `tbl_users` WHERE `user_id` = '$userID'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $_SESSION['successMessage'] = "User Deleted Successfully";
                    header("location:viewCustomersListing.php?userType=" . $userType);
                    exit();
                }
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
?>
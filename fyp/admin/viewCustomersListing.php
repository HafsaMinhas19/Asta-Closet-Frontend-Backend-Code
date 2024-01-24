<?php require "includes/head.php"; ?>

<?php
$userType = $userTypeTitle = "";
if (isset($_GET['userType']) && $_GET['userType'] != "") {
    $userType = $_GET['userType'];
    if ($userType == "C") {
        $userTypeTitle = "Customer";
    } else {
        $_SESSION['errorMessage'] = "Access Denied...!";
        header("location:index.php");
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Access Denied...!";
    header("location:index.php");
    exit();
}
?>

<?php require "includes/header.php"; ?>

<?php require "includes/sidebar.php"; ?>

<div id="main">
    <section class="all-products">
        <h1 class="title-secondary">All Customers
        </h1>
        <div class="row">
            <div class="col-12">
                <?php if (isset($_SESSION['successMessage'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['successMessage'];
                        unset($_SESSION['successMessage']); ?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['errorMessage'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['errorMessage'];
                        unset($_SESSION['errorMessage']); ?>
                    </div>
                <?php } ?>

                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tbl_users` WHERE `user_type` = '$userType' ORDER BY `user_id` DESC";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $srNo = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $srNo; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_contactNo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_address']; ?>
                                        </td>
                                        <td>
                                            <?php echo getStatusTitle($row['user_status']); ?>
                                        </td>
                                        <td>
                                            <?php if ($row['user_profileImage'] != "" && file_exists($row['user_profileImage'])) {
                                                ?>
                                                <img src="<?php echo $row['user_profileImage']; ?>"
                                                    alt="<?php echo $row['user_name']; ?>" style="width:50px; height:50px;" />
                                                <?php
                                            } else {
                                                echo "N/A";
                                            } ?>
                                        </td>
                                        <td>
                                            <a href="updateCustomers.php?userType=<?php echo $userType; ?>&userID=<?php echo $row['user_id']; ?>"
                                                class="btn btn-sm btn-success">Edit Customers</a>

                                            <a href="deleteCustomers.php?userType=<?php echo $userType; ?>&userID=<?php echo $row['user_id']; ?>"
                                                class="btn btn-sm btn-danger delete-confirm">Delete Customers</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $srNo++;
                                }
                            } else {
                                ?>
                                <div class="alert alert-info">
                                    Sorry, No Customers Found.
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php require "includes/scripts.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["No", "Yes!"],
        }).then(function (value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
</body>

</html>
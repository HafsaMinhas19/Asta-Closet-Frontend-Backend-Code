<header class="header py-2">
    <div class="container">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <ul class="m-0 p-0 list-unstyled d-flex gap-3 d-md-flex d-none topbar-links">
                <li>
                    <a href="index.php">Home </a>
                </li>
                <li class="submenu">
                    <a href="allCategories.php?categoryType=M">Men </a>
                    <ul class="submenu-inner m-0 list-unstyled">
                        <?php
                        $sql = "SELECT * FROM `tbl_categories` WHERE `category_type` = 'M' AND `category_status` = 'A' ORDER BY `category_id` DESC";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $srNo = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <li>
                                        <a href="categoryDetail.php?categoryID=<?php echo $row['category_id']; ?>">
                                            <?php echo $row['category_name']; ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="allCategories.php?categoryType=F">Women </a>
                    <ul class="submenu-inner m-0 list-unstyled">
                        <?php
                        $sql = "SELECT * FROM `tbl_categories` WHERE `category_type` = 'F' AND `category_status` = 'A' ORDER BY `category_id` DESC";
                        $result = mysqli_query($con, $sql);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $srNo = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <li>
                                        <a href="categoryDetail.php?categoryID=<?php echo $row['category_id']; ?>">
                                            <?php echo $row['category_name']; ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="about-us.php">About Us</a>
                </li>
                <li>
                    <a href="contact-us.php">Contact</a>
                </li>
            </ul>
            <a href="index.php" class="logo">
                <img src="assets/img/logo.png" alt="" />
            </a>
            <ul class="topbar-icons m-0 p-0 list-unstyled d-flex gap-3 justify-content-end d-md-flex d-none">

                <li class="submenu">
                    <a href="javascript:;"><i class="fa-solid fa-user"></i></a>
                    <ul class="submenu-inner m-0 list-unstyled">
                        <?php if (isset($_SESSION["userType"]) && $_SESSION['userType'] == "C") { ?>
                            <li><a href="change-password.php">Change Password</a></li>
                            <li><a href="my-profile.php">My Profile</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        <?php } else {
                            ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Signup</a></li>
                            <?php
                        } ?>
                    </ul>
                </li>
                <li>
                    <a href="shopping-cart.php"><i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
            </ul>
            <button class="btn mobile-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight">
                <svg data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                    enable-background="new 0 0 32 32" style="height: 30px">
                    <path
                        d="M4 10h24a2 2 0 0 0 0-4H4a2 2 0 0 0 0 4zm24 4H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4zm0 8H4a2 2 0 0 0 0 4h24a2 2 0 0 0 0-4z"
                        fill="#ffffff" class="fill-000000"></path>
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Asta Closet</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="men.php">Men </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="women.php">Women </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.php">About </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact-us.php">Contact </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">SignUp </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shopping-cart.php">Cart </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
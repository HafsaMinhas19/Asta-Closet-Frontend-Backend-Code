<header class="fixed-top">
    <div class="header-inner d-flex justify-content-between align-items-center">
        <a href="index.php" class="logo">
            <img src="assets/img/brand-name.png" alt="" />
        </a>
        <div class="d-flex align-items-center gap-4">
            <i class="fa-solid fa-bars fs-3" onclick="toggle()"></i>
            <form action="" class="search-bar">
                <input type="text" placeholder="Search" />
                <i class="fa-solid fa-magnifying-glass"></i>
            </form>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <div class="notify-dropdown">
                <div class="dropdown">
                    <button class="notify-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notify-count-info">3</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="notify-dropdown">
                <div class="dropdown">
                    <button class="notify-btn" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-message"></i>
                        <span class="notify-count-info">2</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <div class="btn-group">
                    <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <a href="">
                            <?php if ($_SESSION['adminImage'] != "" && file_exists($_SESSION['adminImage'])) {
                                ?>
                                <img src="<?php echo $_SESSION['adminImage']; ?>" alt="" />
                                <?php
                            } else {
                                ?>
                                <img src="assets/img/blank-profile.jpg" alt="" />
                                <?php
                            } ?>

                        </a>
                        <?php echo $_SESSION['adminName']; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button onclick="window.location.href='profile.php'" class="dropdown-item"
                                type="button">Profile</button>
                        </li>
                        <li>
                            <button onclick="window.location.href='change-password.php'" class="dropdown-item"
                                type="button">
                                Change Password
                            </button>
                        </li>
                        <li>
                            <button onclick="window.location.href='logout.php'" class="dropdown-item" type="button">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
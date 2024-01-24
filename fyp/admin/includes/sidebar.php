<aside class="sidebar" id="side-bar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if ($_SESSION['adminType'] == "A") { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse"
                    href="javascript:;">
                    <i class="fa-solid fa-list-check"></i><span>Manage Categories</span><i
                        class="fa-solid fa-chevron-down"></i>
                </a>
                <ul id="components-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="addNewCategory.php">
                            <span>Add Categories</span>
                        </a>
                    </li>

                    <li>
                        <a href="viewAllCategories.php">
                            <span>View Categories</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse"
                    href="javascript:;">
                    <i class="fa-solid fa-list-check"></i><span>Manage Products</span><i
                        class="fa-solid fa-chevron-down"></i>
                </a>
                <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="addNewProduct.php">
                            <span>Add Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="viewAllProducts.php">
                            <span>View Products</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse"
                    href="javascript:;">
                    <i class="fa-solid fa-people-roof"></i><span>Manage Employees</span><i
                        class="fa-solid fa-chevron-down"></i>
                </a>
                <ul id="components-nav3" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="addNewEmployee.php">
                            <span>Add Employee</span>
                        </a>
                    </li>
                    <li>
                        <a href="viewEmployeesListing.php?adminType=E">
                            <span>View Employees</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse"
                    href="javascript:;">
                    <i class="fa-solid fa-people-roof"></i><span>Manage Customers</span><i
                        class="fa-solid fa-chevron-down"></i>
                </a>
                <ul id="components-nav4" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="viewCustomersListing.php?userType=C">
                            <span>View Customers</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
        <?php }
        if ($_SESSION['adminType'] == "E") {
            ?>
             <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse"
                    href="javascript:;">
                    <i class="fa-solid fa-list-check"></i><span>Manage Products</span><i
                        class="fa-solid fa-chevron-down"></i>
                </a>
                <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="addNewProduct.php">
                            <span>Add Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="viewAllProducts.php">
                            <span>View Products</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
        } ?>
    </ul>
</aside>
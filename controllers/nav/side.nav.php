<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="assets/img/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Maktaba</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="home?a=d" class="nav-link <?php echo selected($_GET['a'],"d","active"); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="books?a=b" class="nav-link <?php echo selected($_GET['a'],"b","active"); ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Books
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="categories?a=c" class="nav-link <?php echo selected($_GET['a'],"c","active"); ?>">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="staff?a=sa" class="nav-link">
                                <i class="far fa-user-circle nav-icon"></i>
                                <p>
                                    Staff
                                    <span class="badge badge-info right"><?php echo getCount('l_staff',"status=1"); ?></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="students?a=su" class="nav-link">
                                <i class="far fa-id-badge nav-icon"></i>
                                <p>
                                    Students
                                    <span class="badge badge-info right"><?php echo getCount('l_student',"status='1'"); ?></span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="borrowed?a=bo" class="nav-link <?php echo selected($_GET['a'],"bo","active"); ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Borrowed
                            <span class="badge badge-info right"><?php echo getCount('l_borrowed',"borrow_status='1'"); ?></span>
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="fines?a=f" class="nav-link <?php echo selected($_GET['a'],"f","active"); ?>">
                        <i class="nav-icon fas fa-comments-dollar"></i>
                        <p>
                            Fines

                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="add?t=staff&a=nsa" class="nav-link">
                                <i class="far fa-user-circle nav-icon"></i>
                                <p>Add Staff</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add?t=stud&a=nsu" class="nav-link">
                                <i class="far fa-id-badge nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add?t=book&a=nbo" class="nav-link">
                                <i class="far fa-book-medical nav-icon"></i>
                                <p>Add Book</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="components/log-out.php" class="nav-link">
                        <i class="nav-icon fas fa-circle-notch"></i>
                        <p>
                            Logout

                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
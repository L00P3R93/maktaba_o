<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-2">
        <div class="input-group input-group-sm search">
            <input class="form-control form-control-navbar searchform" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <ul class="results" style="top: 100% !important;"></ul>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <!--<i class="far fa-user"></i>-->
                <img class="avatar" src="<?php $id=decurl($_SESSION['maktaba_']); echo getValue('l_staff',"id='$id'","avatar"); ?>" width="30" height="30" alt="IMG_USER" />
                <?php echo getNames($_SESSION['maktaba_']); ?>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="profile?a=p&id=<?php echo $_SESSION["maktaba_"]; ?>" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="reset?a=r&id=<?php echo $_SESSION["maktaba_"]; ?>" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> Password Reset
                </a>
                <div class="dropdown-divider"></div>
                <?php
                    if(permission_check(decurl($_SESSION['maktaba_']),"SETTING_MANAGEMENT","view") && permission_check(decurl($_SESSION['maktaba_']),"SETTING_MANAGEMENT","add")){ ?>
                        <a href="logs?a=l" class="dropdown-item">
                            <i class="fas fa-clipboard-list mr-2"></i> Activity Logs
                        </a>
                        <div class="dropdown-divider"></div>
                <?php
                    }else{}
                ?>
                <a href="components/log-out.php" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> Sign Out
                </a>
            </div>
        </li>
    </ul>
</nav>
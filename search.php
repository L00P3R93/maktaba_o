<?php
    include 'controllers/base/head.php';
    if(isset($_REQUEST['t']) && isset($_REQUEST['id'])){
        $id = decurl($_REQUEST['id']);
        switch ($_REQUEST['t']){
            case "sta":
                $title = "Staff Search";
                $r = getOneRow('l_staff',"id='$id'");
                break;
            case "stu":
                $title =  "Student Search";
                $r = getOneRow('l_student',"id='$id'");
                break;
            case "b":
                $title = "Book Search";
                $r = getOneRow('l_books',"id='$id'");
                break;
            default:
                $title = "Undefined Search";
                $r = array("Nothing Here");
                break;
        }
    }else{
        $title = "Undefined Search";
        $r = array("Nothing Here");
    }
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <?php include 'controllers/nav/nav.php'; ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php include 'controllers/nav/side.nav.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Search Result</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Search</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    if(isset($_REQUEST['t']) && isset($_REQUEST['id'])){
                                        $id = decurl($_REQUEST['id']);
                                        switch ($_REQUEST['t']){
                                            case "sta": ?>
                                                <div class="col-md-4">
                                                    <!-- Profile Image -->
                                                    <div class="card card-primary card-outline">
                                                        <div class="card-body box-profile">
                                                            <div class="text-center">
                                                                <img class="profile-user-img img-fluid img-circle" src="<?php echo $r['avatar']; ?>" alt="User profile picture">
                                                            </div>
                                                            <h3 class="profile-username text-center"><?php echo $r['f_name']." ".$r['l_name']; ?></h3>
                                                            <p class="text-muted text-center"><?php echo getGroup($r['user_group']); ?></p>
                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                <li class="list-group-item">
                                                                    <b>Email</b> <a class="float-right"><?php echo $r['email']; ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Phone</b> <a class="float-right"><?php echo $r['phone']; ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>National ID</b> <a class="float-right"><?php echo $r['id_no']; ?></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                    <!-- About Me Box -->
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">About <?php echo strtoupper($r['username']); ?></h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <strong><i class="fas fa-book mr-1"></i> User Group</strong>
                                                            <p class="text-muted"><?php echo getGroup($r['user_group']); ?></p>
                                                            <hr>
                                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Username</strong>
                                                            <p class="text-muted"><?php echo $r['username']; ?></p>
                                                            <hr>
                                                            <strong><i class="fas fa-pencil-alt mr-1"></i> Status</strong>
                                                            <p class="text-muted"><?php echo getStatus($r['status']); ?></p>
                                                            <hr>
                                                            <strong><i class="far fa-file-alt mr-1"></i> Added By:</strong>
                                                            <p class="text-muted"><?php $addedby = $r['added_by']; echo getValue('l_staff',"id='$addedby'",'username'); ?></p>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header p-2">
                                                            <ul class="nav nav-pills">
                                                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                                            </ul>
                                                        </div><!-- /.card-header -->
                                                        <div class="card-body croll">
                                                            <div class="tab-content">
                                                                <div class="active tab-pane" id="activity">
                                                                    <?php
                                                                    $a = getTableOrdered('l_activity_logs',"user_id='$id'",'id','desc',1000);
                                                                    if(mysqli_num_rows($a)>0){
                                                                        while($ac = mysqli_fetch_object($a)){ ?>
                                                                            <!-- Post -->
                                                                            <div class="post">
                                                                                <div class="user-block">
                                                                                    <img class="img-circle img-bordered-sm" src="assets/img/log-circle.png" alt="user image">
                                                                                    <span class="username">
                                                                                    <a><?php echo date("d-M-Y H:i:s", strtotime($ac->date_created)); ?></a>
                                                                                </span>
                                                                                    <span class="description"><?php echo "Performed By: ".getValue("l_staff","id='$ac->user_id'","username"); ?></span>
                                                                                </div>
                                                                                <!-- /.user-block -->
                                                                                <p><?php echo $ac->activity; ?></p>
                                                                            </div>
                                                                            <!-- /.post -->
                                                                        <?php   }
                                                                    }else{ ?>
                                                                        <!-- Post -->
                                                                        <div class="post">
                                                                            <div class="user-block">
                                                                        <span class="username">
                                                                            <a>No Activities Logged!</a>
                                                                            <a class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                                        </span>
                                                                            </div>
                                                                            <!-- /.user-block -->
                                                                        </div>
                                                                        <!-- /.post -->
                                                                    <?php   } ?>
                                                                </div>
                                                                <!-- /.tab-pane -->
                                                            </div>
                                                            <!-- /.tab-content -->
                                                        </div><!-- /.card-body -->
                                                    </div>
                                                    <!-- /.nav-tabs-custom -->
                                                </div>
                                                <!-- /.col -->
                                            <?php
                                                break;
                                            case "stu":
                                                $r=getOneRow('l_student',"id='$id'"); ?>
                                                <div class="col-md-12">
                                                    <!-- Profile Image -->
                                                    <div class="card card-primary card-outline">
                                                        <div class="card-body box-profile">
                                                            <div class="text-center">
                                                                <i class="fas fa-user-graduate fa-7x"></i>
                                                            </div>
                                                            <h3 class="profile-username text-center"><?php echo $r['f_name']." ".$r['m_name']." ".$r['l_name']; ?></h3>
                                                            <p class="text-muted text-center"><?php echo getClass($r['class']); ?></p>
                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                <li class="list-group-item">
                                                                    <b>Admission/Registration</b> <a class="float-right"><?php echo $r['adm_no']; ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Username</b> <a class="float-right"><?php echo $r['username']; ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Status</b> <a class="float-right"><?php echo getStatus($r['status']); ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Added By</b> <a class="float-right"><?php $addedby=$r['added_by']; echo getValue('l_staff',"added_by='$addedby'",'username'); ?></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            <?php
                                                break;
                                            case "b":
                                                $r = getOneRow('l_books',"id='$id'"); ?>
                                                <div class="col-md-6">
                                                    <!-- Profile Image -->
                                                    <div class="card card-primary card-outline">
                                                        <div class="card-body box-profile">
                                                            <h3 class="profile-username text-center title"><?php echo $r['title']; ?></h3>
                                                            <p class="text-muted text-center author"><?php echo $r['author'] ?></p>
                                                            <ul class="list-group list-group-unbordered mb-3">
                                                                <li class="list-group-item">
                                                                    <b>ISBN</b> <a class="float-right isbn"><?php echo $r['isbn']; ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Stocked Copies </b> <a class="float-right books"><?php echo $r['books']; ?></a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <b>Added By </b> <a class="float-right books"><?php echo getValue('l_staff',"id='$r[added_by]'",'username'); ?></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- About Me Box -->
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">About Book</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <strong><i class="fas fa-book mr-1"></i> Publisher</strong>
                                                            <p class="text-muted publisher"><?php echo $r['publisher_name'] ?></p>
                                                            <hr>
                                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Category</strong>
                                                            <p class="text-muted category"><?php echo getValue('l_category',"id='$r[category]'",'name') ?></p>
                                                            <hr>
                                                            <strong><i class="fas fa-pencil-alt mr-1"></i> Status</strong>
                                                            <p class="text-muted status"><?php echo getStatus($r['status']); ?></p>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            <?php
                                                break;
                                            default:
                                                echo "Nothing";
                                                break;
                                        }
                                    }else{}
                                    ?>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include 'controllers/base/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'controllers/base/js.php'; ?>
</body>
</html>


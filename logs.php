<?php include 'controllers/base/head.php'; ?>
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
                        <h1 class="m-0 text-dark">Activity Logs</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Logs</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                    <!--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>-->
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <?php
                                        $a = getTableOrdered('l_activity_logs',"id>0",'id','desc',1000);
                                        if(mysqli_num_rows($a)>0){
                                            while($ac = mysqli_fetch_object($a)){ ?>
                                                <!-- Post -->
                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm" src="assets/img/log-circle.png" alt="user image">
                                                        <span class="username">

                                                                <a><?php echo date("d-M-Y H:i:s", strtotime($ac->date_created)); ?></a>
                                                            <!--<a class="float-right btn-tool"><i class="fas fa-times"></i></a>-->
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
                                                            <!--<i class="fas fa-clipboard-list"></i>-->
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include 'controllers/base/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'controllers/base/js.php'; ?>
</body>
</html>

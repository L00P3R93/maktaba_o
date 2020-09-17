<?php
    include 'controllers/base/head.php';
    if(isset($_GET['id'])){
        $userid = decurl($_REQUEST['id']);
        $r = getOneRow('l_staff',"id='$userid'");
        $fname=$r['f_name']; $lname=$r['l_name']; $email=$r['email']; $id_no=$r['id_no'];
        $phone=$r['phone']; $group=$r['user_group']; $status=$r['status']; $username=$r['username'];
    }else{
        $r="";
        $staffid=0; $fname=""; $lname=""; $email=""; $id_no=""; $phone=""; $group=""; $status=""; $username="";
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
                        <h1 class="m-0 text-dark"><?php echo $username; ?>&apos;s Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                    <?php
                                            $a = getTableOrdered('l_activity_logs',"user_id='$userid'",'id','desc',1000);
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
                                    <div class="tab-pane" id="settings">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="f_name" class="col-sm-4 col-form-label">First Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="f_name" id="f_name" placeholder="First Name" value="<?php echo $fname; ?>" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="id_no" class="col-sm-4 col-form-label">National ID/Passport/Work ID</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="id_no" id="id_no" placeholder="National ID/Passport/Work ID" value="<?php echo $id_no; ?>" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-4 col-form-label">Phone Number</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="07XX XXX XXX" value="<?php echo $phone; ?>" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="l_name" class="col-sm-4 col-form-label">Surname</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="l_name" id="l_name" placeholder="Surname" value="<?php echo $lname; ?>" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="group" class="col-sm-4 col-form-label">User Group</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" style="width: 100%;" name="group" id="group">
                                                        <option>Select Group</option>
                                                        <?php
                                                        $dt = getTable('l_groups');
                                                        while($v=mysqli_fetch_object($dt)){ ?>
                                                            <option <?php echo selected($group,$v->id,'selected'); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="stat2" class="col-sm-4 col-form-label">Status</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" style="width: 100%;" name="stat2" id="stat2">
                                                        <option <?php echo selected($status,"0",'selected'); ?> value="0">Select Status</option>
                                                        <option <?php echo selected($status,"1",'selected'); ?> value="1">Active</option>
                                                        <option <?php echo selected($status,"2",'selected'); ?> value="2">Blocked</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-4 col-sm-8">
                                                    <button class="btn btn-primary saveStaff mb-4" value="SAVE_STAFF" style="width: 30%;">Save</button>
                                                    <input id="sid" name="sid" value="<?php echo $_SESSION['maktaba_']; ?>" type="hidden" />
                                                    <input id="uid" name="uid" value="<?php echo $_SESSION['maktaba_']; ?>" type="hidden" />
                                                    <div class="feedback"></div>
                                                    <div class="processing"></div>
                                                </div>
                                            </div>
                                        </div>
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

<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';
        $userid = encurl($_REQUEST['id']);
        $r = getOneRow('l_staff',"id='$userid'");
        if($userid>0){ ?>
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">
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
<?php
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Choose valid User!');
                </script>";
        }
    }

<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';
        $studentid = decurl($_REQUEST['studid']);
        if($studentid>0){
            $r=getOneRow('l_student',"id='$studentid'"); ?>
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
        }else{

        }
    }
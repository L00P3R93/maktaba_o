<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $bookid = decurl($_REQUEST['bookid']);
        if($bookid>0){
            $r = getOneRow('l_books',"id='$bookid'"); ?>
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
        }else{

        }
    }

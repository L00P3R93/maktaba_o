<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $borrow_id = decurl($_REQUEST['id']);
        if($borrow_id>0){
            $r = getOneRow('l_borrowed',"id='$borrow_id'");
            $book_id = $r['book_id'];
            $student_id = $r['student_id'];
            $staff_id = $r['issued_by'];
            ?>
            <div class="col-md-6">
                <!-- Book Details Box -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Book Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Book Title</strong>
                        <p class="text-muted">
                            Title: <?php echo strtoupper(getValue('l_books',"id='$book_id'",'title')); ?><br>
                            Author: <?php echo strtoupper(getValue('l_books',"id='$book_id'",'author')); ?>
                        </p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Publisher</strong>
                        <p class="text-muted">
                            <?php echo strtoupper(getValue('l_books',"id='$book_id'",'publisher_name')); ?>
                        </p>
                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i>ISBN</strong>

                        <p class="text-muted">
                            ISBN: <?php echo strtoupper(getValue('l_books',"id='$book_id'",'isbn')); ?><br>
                            Copies: <?php echo $r['books']." Borrowed"; ?>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Category</strong>

                        <p class="text-muted">
                            <?php
                            $category_id = getValue('l_books',"id='$book_id'",'category');
                            echo strtoupper(getValue('l_category',"id='$category_id'",'name')); ?>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <!-- User Details Box-->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">User Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user-graduate mr-1"></i> Borrowed By:</strong>
                        <p class="text-muted">
                            <?php
                                echo "Admmission/Reg No: ".strtoupper(getValue('l_student',"id='$student_id'",'adm_no'))."<br>".
                                            "Name: ".strtoupper(getValue('l_student',"id=$student_id","f_name"))." ".
                                            strtoupper(getValue('l_student',"id=$student_id","m_name"))." ".
                                            strtoupper(getValue('l_student',"id=$student_id","l_name"));
                            ?>
                        </p>
                        <hr>
                        <strong><i class="fas fa-user-astronaut mr-1"></i> Issued By: </strong>
                        <p class="text-muted">
                            <?php echo strtoupper(getValue('l_staff',"id='$staff_id'",'username')); ?>
                        </p>
                        <hr>
                        <strong><i class="fas fa-calendar-alt mr-1"></i> Issue &amp; Return Dates</strong>
                        <p class="text-muted">
                            Issue Date: <?php echo date('d-M-Y', strtotime($r['borrow_date'])); ?><br>
                            Return Date: <?php echo date('d-M-Y', strtotime($r['return_date'])); ?>
                        </p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Borrow Status</strong>
                        <p class="text-muted">
                            <?php echo getBorrowStatus($r['borrow_status'],$r['return_date']);?>
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
<?php
        }

    }
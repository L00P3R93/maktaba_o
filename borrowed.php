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
                        <h1 class="m-0 text-dark">Borrowed Books</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Borrowed</li>
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
                                <h3 class="card-title">Book </h3>
                                <button class="btn btn-primary ml-5" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus-circle"></i> New Book</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-responsive table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Books/Copies</th>
                                        <th scope="col">Borrower</th>
                                        <!--<th scope="col">Issuer</th>-->
                                        <th scope="col">Borrow_Date</th>
                                        <th scope="col">Return_Date</th>
                                        <th scope="col">Borrow Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    $st = getTable('l_borrowed');
                                    while($sts = mysqli_fetch_object($st)){ ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo getValue("l_books","id='$sts->book_id'",'title'); ?></td>
                                            <td><?php echo $sts->books." Book(s)"; ?></td>
                                            <td><?php echo getValue('l_student',"id='$sts->student_id'",'adm_no'); ?></td>
                                            <!--<td><?php echo getValue('l_staff', "id='$sts->issued_by'","username"); ?></td>-->
                                            <td><?php echo date("d-M-Y", strtotime($sts->borrow_date)); ?></td>
                                            <td><?php echo date("d-M-Y", strtotime($sts->return_date)); ?></td>
                                            <td><?php echo getBorrowStatus($sts->borrow_status,$sts->return_date)?></td>
                                            <td>
                                                <button class="btn btn-primary bookReturn" data-toggle="modal" data-target="#modal-return" value="<?php echo $sts->id; ?>">Return</button>
                                            </td>

                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Books/Copies</th>
                                        <th scope="col">Borrower</th>
                                        <!--<th scope="col">Issuer</th>-->
                                        <th scope="col">Borrow_Date</th>
                                        <th scope="col">Return_Date</th>
                                        <th scope="col">Borrow Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
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

    <div class="modal fade" id="modal-return">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Return Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="setBorrow" class="row"></div>
                    <div class="processing"></div>
                    <input type="hidden" id="returnId" name="returnId" value="0">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveReturn" value="SAVE_RETURN">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Main Footer -->
    <?php include 'controllers/base/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'controllers/base/js.php'; ?>
<script>
    function action(actionPage, params, feedbackArea='.feedback', processingArea='.processing', processingMessage='Processing'){
        var ico = '<img src="assets/img/loader.gif" title="'+processingMessage+'" height="22px" alt="IMG_PROCESS"/>';
        console.log(params);
        $.ajax({
            method: "POST",
            url: actionPage,
            data: params,
            beforeSend: function(){
                $(processingArea).html(ico + processingMessage);
                $(processingArea).show();
            },
            complete: function(){$(processingArea).hide();},
            success: function(data){$(feedbackArea).html(data);},
            error: function(){$(feedbackArea).html('Oops! Something went wrong');}
        });
    }

    $('.bookReturn').click(function(){
        var borrowId = $(this).val();

        $("#returnId").val(borrowId);

        var params = "id="+borrowId;
        console.log(params);
        action('components/return.set.php',params,'#setBorrow','.processing','Loading ...');
    });

    $('.saveReturn').click(function(){
        var returnId = $("#returnId").val();
        //console.log(returnId);
        params = "id="+returnId;
        //action('components/return.php',params);
    });
</script>
</body>
</html>

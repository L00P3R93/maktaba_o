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
                        <h1 class="m-0 text-dark">Late Books</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Late</li>
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
                                <!--<button class="btn btn-primary ml-5" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus-circle"></i> New Book</button>-->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 form-inline" data-toggle="tooltip" data-html="true" title="<em>Pick</em> <u>Range of Dates</u> <b>and Submit</b>">
                                        <!-- Date range -->
                                        <div class="form-group">
                                            <label class="sr-only">Date range:</label>
                                            <div class="input-group  mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                </div>
                                                <input type="text" class="form-control float-right " id="reservation">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                        <button class="btn btn-primary dtRange  mb-2">Submit</button>
                                    </div>
                                </div>
                                <table id="example1" class="table table-responsive table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Books/Copies</th>
                                        <th scope="col">Borrower</th>
                                        <th scope="col">Issuer</th>
                                        <th scope="col">Borrow_Date</th>
                                        <th scope="col">Return_Date</th>
                                        <th scope="col">Borrow Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                    <?php
                                    $i=1;
                                    $st = getTableOrdered('l_borrowed',"borrow_status='3'","id","desc","100000000");
                                    while($sts = mysqli_fetch_object($st)){ ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="#" class="bookView" data-toggle="modal" data-target="#modal-view" value="<?php echo encurl($sts->book_id); ?>"><?php echo getValue("l_books","id='$sts->book_id'",'title'); ?></a></td>
                                            <td><?php echo $sts->books." Book(s)"; ?></td>
                                            <td><a href="#" class="studentView" value="<?php echo encurl($sts->id); ?>" data-toggle="modal" data-target="#modal-view"><?php echo getValue('l_student',"id='$sts->student_id'",'adm_no'); ?></a></td>
                                            <td><a href="#" class="viewStaff"  data-toggle="modal" data-target="#modal-view" value="<?php echo encurl($sts->issued_by); ?>" ><?php echo getValue('l_staff', "id='$sts->issued_by'","username"); ?></a></td>
                                            <td><?php echo date("d-M-Y", strtotime($sts->borrow_date)); ?></td>
                                            <td><?php echo date("d-M-Y", strtotime($sts->return_date)); ?></td>
                                            <td><?php echo getBorrowStatus($sts->borrow_status,$sts->return_date,$sts->id)?></td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Books/Copies</th>
                                        <th scope="col">Borrower</th>
                                        <th scope="col">Issuer</th>
                                        <th scope="col">Borrow_Date</th>
                                        <th scope="col">Return_Date</th>
                                        <th scope="col">Borrow Status</th>
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

    <!-- Modal View -->
    <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Student Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="set" class="row"></div>
                    <div class="processing"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

    $('.studentView').click(function(){
        var studentid = $(this).attr("value");
        var params = "studid="+studentid;
        action('components/set.student.php',params,"#set");
    });
    $('.viewStaff').click(function(){
        var userid = $(this).attr("value");
        var params = "id="+userid;
        action('components/set.staff.php',params,"#set");
    });
    $('.bookView').click(function(e){
        e.preventDefault();
        var id = $(this).attr("value");
        var params = "bookid="+id;
        action('components/set.book.php',params,"#set");
        $('.saveBook').hide();
    });
    $(".dtRange").click(function(){
        var dt = $("#reservation").val();
        var params = "dt="+dt;
        console.log(dt);
        action("components/set.table.php",params,"#setTable");
    })
</script>

</body>
</html>


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
                        <h1 class="m-0 text-dark">Students</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Students</li>
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
                                <h3 class="card-title">Student</h3>
                                <a href="add?a=nsu&t=stud" class="btn btn-primary ml-5"><i class="fas fa-plus-circle"></i> New Student</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-responsive table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Admission</th>
                                        <th>Class</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                    $st = getTable('l_student');
                                    while($sts = mysqli_fetch_object($st)){ ?>
                                        <tr>
                                            <td><?php echo $sts->f_name." ".$sts->m_name." ".$sts->l_name; ?></td>
                                            <td><?php echo $sts->adm_no; ?></td>
                                            <td><?php echo getClass($sts->class); ?></td>
                                            <td><?php echo getStatus($sts->status); ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Buttons">
                                                    <button class="btn btn-primary studentView" data-toggle="modal" data-target="#modal-view" value="<?php echo encurl($sts->id); ?>"><i class="fas fa-eye"></i></button>
                                                    <a href="add?a=nsu&t=stud&id=<?php echo encurl($sts->id); ?>" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger studentDelete" value="<?php echo encurl($sts->id); ?>"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                                <input type="hidden" name="studname<?php echo encurl($sts->id); ?>" id="studname<?php echo encurl($sts->id); ?>" value="<?php echo $sts->f_name." ".$sts->m_name." ".$sts->l_name; ?>">
                                            </td>
                                        </tr>
                                <?php } ?>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Admission</th>
                                        <th>Class</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                    <div id="setStudent" class="row"></div>
                    <div class="processing"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary saveStaff" value="SAVE_CATEGORY">Save changes</button>-->
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
        var studentid = $(this).val();
        var params = "studid="+studentid;
        action('components/set.student.php',params,"#setStudent");
    });

    $('.studentDelete').click(function(){
        var studentid = $(this).val();
        var nm = $("#studname"+studentid).val();
        bootbox.confirm({
            message: "Are you sure you would like to Delete <strong>"+nm+"</strong>?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result == 1){
                    var params = "studid="+studentid;
                    console.log(params);
                    action('components/delete_student.php',params);
                }
            }
        });
    });
</script>
</body>
</html>

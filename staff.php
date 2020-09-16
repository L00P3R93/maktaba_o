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
                        <h1 class="m-0 text-dark">Staff</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Staff</li>
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
                                <h3 class="card-title">Staff</h3>
                                <a href="add?a=nsa&t=staff" class="btn btn-primary ml-5"><i class="fas fa-plus-circle"></i> New Staff</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-responsive table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <!--<th scope="col">Avatar</th>-->
                                        <th scope="col">Name</th>
                                        <th scope="col">National_ID</th>
                                        <th scope="col">Phone_Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i =1;
                                    $st = getTable('l_staff');
                                    while($sts = mysqli_fetch_object($st)){ ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <!--<td><img src="<?php echo $sts->avatar; ?>" class="avatar" alt="IMG_USER" /></td>-->
                                            <td><?php echo $sts->f_name." ".$sts->l_name; ?></td>
                                            <td><?php echo $sts->id_no; ?></td>
                                            <td><?php echo $sts->phone; ?></td>
                                            <td><?php echo $sts->email; ?></td>
                                            <td><?php echo $sts->username; ?></td>
                                            <td><?php echo getStatus($sts->status); ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Buttons">
                                                    <button class="btn btn-primary viewStaff" data-toggle="modal" data-target="#modal-view" value="<?php echo encurl($sts->id); ?>"><i class="fas fa-eye"></i></button>
                                                    <a class="btn btn-secondary" href="add?a=nsa&t=staff&id=<?php echo encurl($sts->id); ?>"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger deleteStaff" value="<?php echo encurl($sts->id); ?>"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                                <input type="hidden" name="uname<?php echo encurl($sts->id); ?>" id="uname<?php echo encurl($sts->id); ?>" value="<?php echo $sts->f_name." ".$sts->l_name; ?>">
                                            </td>
                                        </tr>
                                    <?php $i++;} ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <!--<th scope="col">Avatar</th>-->
                                        <th scope="col">Name</th>
                                        <th scope="col">National_ID</th>
                                        <th scope="col">Phone_Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Status</th>
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

    <!-- Modal View -->
    <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Staff Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="setUser" class="row"></div>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Staff Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="f_name" id="f_name" placeholder="First Name" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>National ID/Passport/Work ID</label>
                                <input type="text" class="form-control" name="id_no" id="id_no" placeholder="National ID/Passport/Work ID" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="07XX XXX XXX" autocomplete="off" required>
                            </div>
                            <button class="btn btn-primary saveStaff mb-4" value="SAVE_STAFF" style="width: 30%;">Save</button>
                            <input id="sid" name="sid" value="<?php echo $_SESSION['maktaba_'] ?>" type="hidden" />
                            <!--<input id="uid" name="uid" value="" type="hidden" />-->
                            <div class="feedback"></div>
                            <div class="processing"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Surname</label>
                                <input class="form-control" name="l_name" id="l_name" placeholder="Surname" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>User Group</label>
                                <select class="form-control select2" style="width: 100%;" name="group" id="group">
                                    <option>Select Group</option>
                                    <?php
                                    $dt = getTable('l_groups');
                                    while($v=mysqli_fetch_object($dt)){ ?>
                                        <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2" style="width: 100%;" name="stat2" id="stat2">
                                    <option value="0">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Blocked</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveStaff" value="SAVE_CATEGORY">Save changes</button>
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

    $('.viewStaff').click(function(){
        var userid = $(this).val();
        var params = "id="+userid;
        action('components/set.staff.php',params,"#setUser");
    });

    $('.deleteStaff').click(function (){
        var id = $(this).val();
        var nm = $("#uname"+id).val();
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
                    var params = "userid="+id;
                    action('components/delete_staff.php',params);
                }
            }
        });
    });
</script>
</body>
</html>


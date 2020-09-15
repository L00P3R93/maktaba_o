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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
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
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                                <!--<a href="#" class="btn btn-outline-primary"></a>-->
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


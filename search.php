<?php
    include 'controllers/base/head.php';

    if(isset($_REQUEST['t']) && isset($_REQUEST['id'])){
        $id = decurl($_REQUEST['id']);
        switch ($_REQUEST['t']){
            case "sta":
                $title = "Staff Search";
                $r = getOneRow('l_staff',"id='$id'");
                break;
            case "stu":
                $title =  "Student Search";
                $r = getOneRow('l_student',"id='$id'");
                break;
            case "b":
                $title = "Book Search";
                $r = getOneRow('l_books',"id='$id'");
                break;
            default:
                $title = "Undefined Search";
                $r = array("Nothing Here");
                break;
        }
    }else{
        $title = "Undefined Search";
        $r = array("Nothing Here");
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
                        <h1 class="m-0 text-dark">Search Result</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Search</li>
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
                                <h3 class="card-title">
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php echo var_dump($r)?>
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

    <!-- Main Footer -->
    <?php include 'controllers/base/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'controllers/base/js.php'; ?>
</body>
</html>


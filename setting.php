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
                        <h1 class="m-0 text-dark">Permissions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Access</li>
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
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h5 class="card-title">Group Access Permissions</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <!--<div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <a href="#" class="dropdown-item">Action</a>
                                            <a href="#" class="dropdown-item">Another action</a>
                                            <a href="#" class="dropdown-item">Something else here</a>
                                            <a class="dropdown-divider"></a>
                                            <a href="#" class="dropdown-item">Separated link</a>
                                        </div>
                                    </div>-->
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="feedback"></div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="list-group list-group-flush">
                                    <?php
                                            $t = getTable('l_groups');
                                            while($r=mysqli_fetch_object($t)){ ?>
                                                <a href="?a=set&id=<?php echo encurl($r->id); ?>" class="list-group-item list-group-item-action <?php echo selected($_GET['id'],encurl($r->id),'active') ?>"><?php echo $r->name ?></a>
                                    <?php   } ?>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-8">
                                        <div id="perms_"></div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">

                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
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
<script>
    function loadpage(resource, targetdiv, params) {
        fields = params;
        var processingmessage = 'Working...';
        processingarea = '.processing';
        var thislocation = $('#thislocation').val();
        var ico = '<img src="assets/img/loader.gif" title="' + processingmessage + '" height="22px" alt="..."/>';
        $.ajax({
            method: 'GET',
            url: resource,
            data: fields,
            beforeSend: function () {
                $(processingarea).html(ico + processingmessage);
                $(processingarea).show();
            },

            complete: function () {
                $('#processing').hide();
                $(processingarea).hide();
            },
            success: function (feedback) {
                $(targetdiv).html(feedback);
                $(processingarea).hide();
            }

        });
    }
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
    function changeperm(g,n,t,a){
        var params = "g="+g+"&n="+n+"&t="+t+"&a="+a;
        console.log(params);
        action('components/change.permission.php',params);
    }
    function load_perms(gr) {
        var params = "id=" + gr;
        loadpage('components/perm_load.php', '#perms_', params);

    }
    load_perms("<?php echo $_REQUEST['id']; ?>");
</script>
</body>
</html>

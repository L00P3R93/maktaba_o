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
                        <h1 class="m-0 text-dark">Book Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">Book Categories</h3>
                                <button class="btn btn-primary ml-5" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus-circle"></i> New Category</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-responsive table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Books</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    $st = getTable('l_category');
                                    while($sts=mysqli_fetch_object($st)){ ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $sts->name; ?></td>
                                            <td><?php echo getTotal('l_books',"category='$sts->id'",'books'); ?></td>
                                            <td class="justify-content-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-primary categoryView" data-toggle="modal" data-target="#modal-lg" value="<?php echo $sts->id ?>" c_name="<?php echo $sts->name; ?>"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-secondary categoryEdit" data-toggle="modal" data-target="#modal-lg" value="<?php echo $sts->id ?>" c_name="<?php echo $sts->name; ?>"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger categoryDelete" value="<?php echo $sts->id ?>" c_name="<?php echo $sts->name; ?>"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                                <!--<a href="#" class="btn btn-outline-primary"></a>-->
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Books</th>
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

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name" autocomplete="off" required>
                            </div>
                            <input type="hidden" id="category_id" name="category_id" value="0">
                            <div class="feedback"></div>
                            <div class="processing"></div>
                            <!--<button class="btn btn-primary " >Save</button>-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveCategory" value="SAVE_CATEGORY">Save changes</button>
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

    $('.categoryView').click(function(e){
        e.preventDefault();
        var id = $(this).val();
        var name = $(this).attr("c_name");
        $("#category_id").val(id);
        $("#category_name").val(name);
        $("#category_name").prop("disabled",'true');
    });

    $(".categoryEdit").click(function(e){
        e.preventDefault();
        var id = $(this).val();
        var name = $(this).attr("c_name");
        $("#category_id").val(id);
        $("#category_name").val(name);
        $("#category_name").removeAttr("disabled");
    });

    $(".categoryDelete").click(function(e) {
        e.preventDefault();
        var categoryid = $(this).val();
        var categoryName = $(this).attr('c_name');
        console.log(categoryid);
        bootbox.confirm({
            message: "Are you sure you would like to Delete "+categoryName+" Category?",
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
                    params = "categoryId="+categoryid;
                    action("components/delete_category.php",params);
                    //console.log('This was logged in the callback: ' + result);
                }
            }
        });
    })

</script>
</body>
</html>


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
                        <h1 class="m-0 text-dark">Books</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Books</li>
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">ISBN Number</th>
                                        <th scope="col">Books/Copies</th>
                                        <th scope="col">Book Category</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Borrow</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    $st = getTable('l_books');
                                    while($sts = mysqli_fetch_object($st)){ ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $sts->title; ?></td>
                                            <td><?php echo $sts->author; ?></td>
                                            <td><?php echo $sts->isbn; ?></td>
                                            <td><?php echo $sts->books; ?></td>
                                            <td><?php echo getValue('l_category',"id=$sts->category",'name'); ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action">
                                                    <button class="btn btn-primary bookView" data-toggle="modal" data-target="#modal-lg" value="<?php echo $sts->id ?>"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-secondary bookEdit" data-toggle="modal" data-target="#modal-lg" value="<?php echo $sts->id ?>"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger bookDelete" value="<?php echo $sts->id; ?>" ><i class="fas fa-trash-alt"></i></button>

                                                    <input type="hidden" id="bookTitle" name="bookTitle" value="<?php echo $sts->title ?>">
                                                    <input type="hidden" id="bookAuthor" name="bookAuthor" value="<?php echo $sts->author ?>">
                                                    <input type="hidden" id="bookIsbn" name="bookIsbn" value="<?php echo $sts->isbn ?>">
                                                    <input type="hidden" id="bookPublisher" name="bookPublisher" value="<?php echo $sts->publisher_name; ?>">
                                                    <input type="hidden" id="bookCategory" name="bookCategory" value="<?php echo $sts->category ?>">
                                                    <input type="hidden" id="bookStatus" name="bookStatus" value="<?php echo $sts->status ?>">
                                                    <input type="hidden" id="bookCopies" name="bookCopies" value="<?php echo $sts->books ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Borrow-Return">
                                                    <button class="btn btn-info bookBorrow" data-toggle="modal" data-target="#modal-borrow" value="<?php echo $sts->id; ?>">Borrow</button>
                                                    <!--<button class="btn btn-info return"  value="<?php echo $sts->id; ?>">Return</button>-->
                                                </div>

                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">ISBN Number</th>
                                        <th scope="col">Books/Copies</th>
                                        <th scope="col">Book Category</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Borrow</th>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="displayBook" class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Book Title</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Book Title" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Book Author</label>
                                <input type="text" id="author" name="author" class="form-control" placeholder="Book Author" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" id="isbn" name="isbn" class="form-control" placeholder="ISBN Number" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="books">Stocked Copies</label>
                                <input type="number" id="books" name="books" class="form-control" placeholder="Number of Books" required autocomplete="off">
                            </div>
                            <input type="hidden" id="bookid" name="bookid" value="0">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="publisher">Book Publisher Name</label>
                                <input type="text" id="publisher" name="publisher" class="form-control" placeholder="Book Publisher">
                            </div>
                            <div class="form-group">
                                <label for="category">Book Category</label>
                                <input type="text" id="category" name="category" class="form-control" placeholder="Book Publisher">
                            </div>
                            <div class="form-group">
                                <label for="stat3">Book Status</label>
                                <input type="text" id="status" name="status" class="form-control" placeholder="Book Publisher">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveBook" value="SAVE_CATEGORY">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-borrow">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Borrow Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="displayBook" class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Book Title</label>
                                <input type="text" id="borrowTitle" name="borrowTitle" class="form-control" placeholder="Book Title" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Book Author</label>
                                <input type="text" id="borrowAuthor" name="borrowAuthor" class="form-control" placeholder="Book Author" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" id="borrowIsbn" name="borrowIsbn" class="form-control" placeholder="ISBN Number" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="books">Stocked Copies</label>
                                <input type="number" id="borrowBooks" name="borrowBooks" class="form-control" placeholder="Number of Books" required autocomplete="off">
                            </div>
                            <input type="hidden" id="borrowBookId" name="borrowBookId" value="0">
                            <input type="hidden" id="borrowSid" name="borrowSid" value="<?php if(isset($_SESSION['maktaba_'])){echo $_SESSION['maktaba_'];}else{echo 0;} ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group search">
                                <label for="publisher">Student</label>
                                <input type="text" id="student" name="student" class="form-control" placeholder="Search Student ..." data-toggle="tooltip" data-placement="top" title="Type to Search Student">
                                <input type="hidden" id="studentid" name="studentid" value="0">
                                <ul class="results"></ul>

                                <!--<div id="search-result-container" class="res0" style="border:solid 1px #BDC7D8;display:none; "></div>-->
                            </div>
                            <!-- Date -->
                            <div class="form-group">
                                <label>Borrow Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="pickup" name="pickup" class="">
                                </div>
                            </div>
                            <!-- /.form group -->
                            <!-- Date -->
                            <div class="form-group">
                                <label>Return Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="return" name="return" class="">
                                </div>
                            </div>
                            <!-- /.form group -->
                            <div class="form-group">
                                <div class="feedback"></div>
                                <div class="processing"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveBorrow" value="BORROW_BOOK">Save changes</button>
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
    $('[data-toggle="tooltip"]').tooltip();

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

    $('.bookView').click(function(e){
        e.preventDefault();
        var id = $(this).val();

        var title = $("#bookTitle").val();
        var author = $("#bookAuthor").val();
        var isbn = $("#bookIsbn").val();
        var books = $("#bookCopies").val();
        var publisher = $("#bookPublisher").val();
        var category = $("#bookCategory").val();
        var status = $("#bookStatus").val();

        $("#title").val(title);
        $("#title").prop("disabled",'true');

        $("#author").val(author);
        $("#author").prop("disabled",'true');

        $("#isbn").val(isbn);
        $("#isbn").prop("disabled",'true');

        $("#books").val(books);
        $("#books").prop("disabled",'true');

        $("#publisher").val(publisher);
        $("#publisher").prop("disabled",'true');

        $("#category").val(category);
        $("#category").prop("disabled",'true');

        $("#status").val(status);
        $("#status").prop("disabled",'true');

        $('.saveBook').hide();
    });

    $(".bookEdit").click(function(e){
        e.preventDefault();
        var id = $(this).val();

        var title = $("#bookTitle").val();
        var author = $("#bookAuthor").val();
        var isbn = $("#bookIsbn").val();
        var books = $("#bookCopies").val();
        var publisher = $("#bookPublisher").val();
        var category = $("#bookCategory").val();
        var status = $("#bookStatus").val();

        $("#bookid").val(id);

        $("#title").val(title);
        $("#title").removeAttr("disabled");

        $("#author").val(author);
        $("#author").removeAttr("disabled");

        $("#isbn").val(isbn);
        $("#isbn").removeAttr("disabled");

        $("#books").val(books);
        $("#books").removeAttr("disabled");

        $("#publisher").val(publisher);
        $("#publisher").removeAttr("disabled");

        $("#category").val(category);
        $("#category").removeAttr("disabled");

        $("#status").val(status);
        $("#status").removeAttr("disabled");

        $('.saveBook').show();
    });

    $(".bookDelete").click(function(e) {
        e.preventDefault();
        var bookid = $(this).val();
        var title = $("#bookTitle").val()
        console.log(bookid);
        bootbox.confirm({
            message: "Are you sure you would like to Delete "+title+"?",
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
                    params = "bookId="+bookid;
                    action("components/delete_book.php",params);
                    //console.log('This was logged in the callback: ' + result);
                }
            }
        });
    })

    $(".bookBorrow").click(function(){
        var bookid = $(this).val();


        var title = $("#bookTitle").val();
        var author = $("#bookAuthor").val();
        var isbn = $("#bookIsbn").val();

        $("#borrowBookId").val(bookid);

        $("#borrowTitle").val(title);
        $("#borrowTitle").prop("disabled",'true');

        $("#borrowAuthor").val(author);
        $("#borrowAuthor").prop("disabled",'true');

        $("#borrowIsbn").val(isbn);
        $("#borrowIsbn").prop("disabled",'true');

        $("#borrowBooks").val(1);
        $("#borrowBooks").prop("disabled",'true');

        //console.log("hjdfklbn");
    });

    $(".saveBorrow").click(function (){
        var title = $("#borrowTitle").val();
        var author = $("#borrowAuthor").val();
        var isbn = $("#borrowIsbn").val();
        var books = $("#borrowBooks").val();
        var bookid = $("#borrowBookId").val();
        var studentid = $("#studentid").val();
        var sid = $("#borrowSid").val();
        var pickup = $("#pickup").val();
        var _return = $("#return").val();

        if(studentid !== ""){
            if(pickup !== "" && _return !== ""){
                var params = "title="+title+"&author="+author+"&isbn="+isbn+"&books="+books+"&bookid="+bookid+"&studentid="+studentid+"&pickup="+pickup+"&return="+_return+"&sid="+sid;
                console.log(params);
                action('components/borrow.php',params);
            }else{
                toastr.error('Borrow & Return Date Cannot be Empty');
            }
        }else{
            toastr.error('Student Cannot be Empty');
        }

    });
</script>
</body>
</html>


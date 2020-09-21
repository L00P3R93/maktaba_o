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
                        <h1 class="m-0 text-dark">Class Streams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active">Streams</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Manage Class Streams</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                       <div class="row">
                           <div class="col-md-4">
                               <div class="list-group">
                                   <a href="?a=st" class="list-header list-group-item list-group-item-action justify-content-center"><i class="fa fa-plus-circle"></i> New Stream</a>
                                <?php
                                    $t = getTable('l_streams');
                                    if(mysqli_num_rows($t)>0){
                                        while($r=mysqli_fetch_object($t)){ ?>
                                            <a href="?a=st&id=<?php echo encurl($r->id); ?>" class="list-group-item list-group-item-action <?php echo selected($_GET['id'],encurl($r->id),'active') ?>"><?php echo $r->name ?></a>
                                <?php    }
                                    }else{ ?>
                                        <a class="list-group-item list-group-item-action ">No Streams Defined!</a>
                                <?php   } ?>
                               </div>
                           </div>
                           <div class="col-md-8">
                                <?php
                                 if(isset($_REQUEST["id"]) && !empty($_REQUEST["id"])){
                                     $id = decurl($_REQUEST["id"]);
                                     $stream = getValue('l_streams',"id='$id'","name");
                                     ?>
                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             <label for="streams">Stream</label>
                                         </div>
                                         <div class="col-sm-6">
                                             <input type="text" class="form-control" id="stream" name="stream" placeholder="Edit Stream" value="<?php echo $stream; ?>" autocomplete="off" required>
                                             <input type="hidden" id="streamid" name="streamid" value="<?php echo encurl($id); ?>">
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <div class="offset-sm-2 col-sm-2"></div>
                                         <div class="col-sm-10">
                                             <button class="btn btn-primary updateStream">Save</button>
                                         </div>
                                     </div>
                                     <div class="feedback"></div>
                                <?php }else{ ?>
                                     <div class="form-group">
                                         <label for="streams">Number of Streams</label>
                                         <input type="text" class="form-control" id="streams" name="streams" placeholder="Number of Streams" autocomplete="off" required>
                                     </div>
                                     <div id="setStreams"></div>
                                <?php } ?>
                               <div id="processing"></div>
                           </div>
                       </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <?php include 'controllers/base/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'controllers/base/js.php'; ?>
<script>
    (function($){
        $.fn.inputFilter = function(inputFilter){
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function (){
                if(inputFilter(this.value)){
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                }else if(this.hasOwnProperty("oldValue")){
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }else{
                    this.value = "";
                }
            });
        };

        //Ajax Function
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

        $("#streams").inputFilter(function(value){return /^\d*$/.test(value) && (value === "" || parseInt(value)<=10)});
        $("#streams").bind("keyup", function(){
            var ite = $(this).val()-0;
            console.log(ite);
            if(/^\d*$/.test(ite) && (ite === "" || parseInt(ite)<=10)){
                params = "iter="+ite;
                action("components/streams.php",params,"#setStreams");
            }else{}
        });

        $(".updateStream").click(function(){
            var stream = $("#stream").val();
            var id = $("#streamid").val();
            var params = "id="+id+"&stream="+stream;
            console.log(params);
            action("components/update_stream.php",params);
        });
    }(jQuery));

</script>
</body>
</html>

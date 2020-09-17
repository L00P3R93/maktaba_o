<?php include 'controllers/base/head.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="index"><b>Maktaba</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <?php
                    $userid=decurl($_SESSION['maktaba_']);
                    $username = getValue('l_staff',"id='$userid'","username");
                    if(isset($_SESSION['maktaba_'])){
                        echo strtoupper($username).", Reseting Password will log you out.";
                    }
                ?>
            </p>
            <div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        The Password must contain one Number, one Lowercase and one Uppercase letter
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        Passwords Do Not Match
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block changePassword">Change password</button>
                        <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION['maktaba_']; ?>">
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <p class="mt-3 mb-1">
                <a href="login">Login</a> <a class="ml-4" href="home?a=d">Home</a>
                <div class="feedback"></div>
                <div class="processing"></div>
                <div class="feed "></div>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<?php include 'controllers/base/js.php'; ?>
<script>
    function checkPassword(str){
        //at least one number, one lowercase and one uppercase letter
        //at least six characters
        var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
        return re.test(str);
    }
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

    $("#password").bind("keyup", function(){
        var p = $("#password").val();
        if(checkPassword(p)){
            $(this).focus();
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $(".feed").removeClass("alert alert-warning")
            $(".feed").hide();
            $(".feed").html("")
        }else{
            $(this).focus();
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(".feed1").addClass("alert alert-warning")
            $(".feed").show();
            $(".feed1").html("")
        }
    });

    $("#password2").bind("keyup", function(){
        var p = $("#password").val();
        var p2 = $("#password2").val();
        if(p==p2){
            $(this).focus();
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }else{
            $(this).focus();
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');

        }
    });

    $('.changePassword').click(function(){
        var userid = $("#userid").val();
        var password1 = $("#password").val();
        var password2 = $("#password2").val();
        if(checkPassword(password1) && checkPassword(password2) && password1 == password2){
            var params = "id="+userid+"&pass="+password1+"&confirm="+password2;
            console.log(params);
            action('components/reset.php',params);
            $(".feed").removeClass("alert alert-warning alert-dismissible")
            $(".feed").hide();
        }else{
            $(".feed").addClass("alert alert-warning alert-dismissible")
            $(".feed").show();
            $(".feed").html("<ul><li>The Password must contain one Number, one Lowercase and one Uppercase letter</li><li>The Passwords do not match!</li></ul>");
        }
    });
</script>
</body>
</html>

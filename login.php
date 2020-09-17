<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Maktaba | Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/floating-labels.css" rel="stylesheet">
</head>
<body>
<div class="form-signin">
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Maktaba Login</h1>
    </div>

    <div class="form-label-group">
        <input type="text" id="email" name="email" class="form-control" placeholder="Username/Email address" required autofocus>
        <label for="email">Username/Email address</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
        <label for="pass">Password</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember" id="remember" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block signin">Sign in</button>
    <div class="mt-5 mb-3" id="processing"></div>
    <div class="mt-5 mb-3" id="result"></div>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2020</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script type="text/javascript">
    (function($){
        'use strict'
        $('.signin').click(function (e){
           console.log("SIGN IN");

           var email = $("#email").val();
           var pass = $("#pass").val();
           var remember = $("#remember :checked").val()
           if(email == "" && pass==""){}
           else{
               var ico = '<img src="assets/img/loader.gif" title="Processing" height="22px" alt="..."/>';
               var dataString = "email="+email+"&pass="+pass+"&remember="+remember;
               console.log(dataString);
               $.ajax({
                   url: "components/login-process.php",
                   type: "POST",
                   data: dataString,
                   beforeSend:function (){
                       $("#processing").html(ico+"Processing");
                       $("#processing").show()
                   },
                   complete: function (){$("#processing").hide();},
                   success: function (data){$("#result").html(data);},
                   error: function (data){$("#result").html("Ajax Error");}
               });
           }
        });

    })(jQuery)
</script>
</body>
</html>

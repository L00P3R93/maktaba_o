<?php
    session_start();
    include_once '../includes/conn.php';
    include_once '../includes/data.php';

    if($_POST){
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $pass = mysqli_real_escape_string($con,$_POST['pass']);
        //echo $email." ".$pass;
        $emailOk = input_available($email);
        if($emailOk == 0){echo error('Email/Username Invalid');}
        $passOk = input_available($pass);
        if($passOk == 0){echo error('Password needed.');}
        $validated = $emailOk+$passOk;
        if($validated == 2){
            $username = $email;
            $userid = getValue("l_staff","status='1' AND (email='$email' OR username='$username')","id");
            if($userid>0){
                $salt = getValue("l_passes","user_id='$userid'", "pass");
                //print_r($salt);
                $full_pass = $salt.$pass;
                $enc_pass = hash('SHA256', $full_pass);
                $db_pass = getValue("l_staff","id='$userid'","pass");
                //print_r($db_pass);
                if($enc_pass==$db_pass){
                    //echo "true";
                    $enc_userid = encurl($userid);
                    $_SESSION['maktaba_'] = $enc_userid;
                    //echo $_SESSION['maktaba_'];
                    if(isset($_SESSION['maktaba_'])){
                        $refresh = 1;
                        echo "
                            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                            <script>
                                toastr.success('Successfully loggedin. Please wait ...')
                            </script>";
                        echo success('Successfully loggedin. Please wait ...');
                        //header("Refresh:2; url=home.php");
                    }else{
                        echo "
                            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                            <script>
                                toastr.error('Incorrect username and password')
                            </script>";
                        echo error('Incorrect username and password');
                    }
                }else{
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Incorrect password')
                        </script>";
                    echo error('Incorrect password');
                }
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Email not found')
                    </script>";
                echo error('Email not found');
            }
        }
    }else{
        echo "
            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
            <script>
                toastr.error('Method NOT supported')
            </script>";
        echo error('Method NOT supported');
    }
?>
<script>
    var action = '<?php echo $refresh; ?>';
    if(action == '1'){window.location = 'home?a=d';}
</script>



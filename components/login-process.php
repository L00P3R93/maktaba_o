<?php
    session_start();
    include_once '../includes/conn.php';
    include_once '../includes/data.php';
    include_once '../includes/auth.php';

    $auth = new Auth();
    $util = new Util();
    if($_POST){
        $isAuthenticated = false;
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $pass = mysqli_real_escape_string($con,$_POST['pass']);
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
                $full_pass = $salt.$pass;
                $enc_pass = hash('SHA256', $full_pass);
                $db_pass = getValue("l_staff","id='$userid'","pass");
                if($enc_pass==$db_pass){
                    $enc_userid = encurl($userid);
                    $_SESSION['maktaba_'] = $enc_userid;
                    if(isset($_SESSION['maktaba_'])){
                        /*if(isset($_POST["remember"])){
                            $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
                            setcookie("staff_login",$email,$cookie_expiration_time,"/",$domain,false);

                            $random_password = $util->genToken(16);
                            setcookie("random_password",$random_password,$cookie_expiration_time,"/",$domain,false);

                            $random_selector = $util->genToken(32);
                            setcookie("random_selector",$random_selector, $cookie_expiration_time,"/",$domain,false);

                            $random_password_hash = password_hash($random_password,PASSWORD_DEFAULT);
                            $random_selector_hash = password_hash($random_selector,PASSWORD_DEFAULT);
                            $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);

                            //Mark existing token as expired
                            $userToken = $auth->getToken($email,0);
                            if(!empty($userToken[0]["id"])){
                                $auth->markAsExpired($userToken[0]["id"]);
                            }

                            //Insert new Token
                            $ins=$auth->insertToken($email,$random_password_hash,$random_selector_hash,$expiry_date);
                            //echo $ins;
                        }else{
                            $util->clearAuthCookie();
                            //echo $_POST['remember'];
                        }*/
                        $refresh = 1;
                        echo success('Successfully loggedin. Please wait ...');
                    }else{
                        echo error('Incorrect username and password');
                    }
                }else{
                    echo error('Incorrect password');
                }
            }else{
                echo error('Email not found');
            }
        }
    }else{
        echo error('Method NOT supported');
    }
?>
<script>
    var action = '<?php echo $refresh; ?>';
    if(action == '1'){window.location = 'home?a=d';}
</script>



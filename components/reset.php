<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';
        $userid = decurl($_REQUEST['id']);
        $username = getValue('l_staff',"id='$userid'","username");
        $password = $_REQUEST['pass'];
        $password2 = $_REQUEST['confirm'];
        $pass1OK = input_length($password,5);
        $pass2OK = input_length($password2, 5);
        if($userid>0 && ($pass1OK+$pass2OK)==2){
            if($password == $password2){
                $epass = passencrypt($password);
                $hash = substr($epass, 0, 64);
                $salt = substr($epass, 64, 96);
                $updateHash = updateDb('l_staff',"pass='$hash'","id='$userid'");
                if($updateHash == 1){
                    $updateSalt = updateDb('l_passes',"pass='$salt'","user_id='$userid'");
                    $proceed = 1;
                    $desc = "User [$username] Changed Password";
                    save_log($desc,$userid);
                    echo success("Password changed Successfully");
                }
            }else{
                echo error("Passwords do not match");
            }
        }else{
            echo error("Invalid Password!");
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed == 1){window.location.href = "components/log-out.php";}
</script>

<?php
    include_once '../includes/conn.php';
    include_once '../includes/data.php';

    if($_POST){

        $sid = decurl($_REQUEST["sid"]);
        $username = getValue('l_staff',"id='$sid'",'username');
        $uid = decurl($_REQUEST["uid"]);
        $f_name = $_REQUEST['f_name'];
        $l_name = $_REQUEST['l_name'];
        $username = $_REQUEST['username'];
        $password = $username;
        $id_no = $_REQUEST['id_no'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $group = $_REQUEST['group'];
        $status = $_REQUEST['status'];

        $fNameOk = input_length($f_name,2);
        if($fNameOk == 0){ $error='First name Needed';}
        $lNameOk = input_length($l_name, 2);
        if($lNameOk == 0){ $error='Last name Needed';}
        $usernameOk = input_length($username, 2);
        if($usernameOk == 0){ $error='Username Needed';}
        $emailOk = validate_email($email);
        if($emailOk == 0){ $error='Invalid Email';}
        $phoneOk = validate_phone($phone);
        if($phoneOk == 0){ $error='Invalid Phone Number';}
        if($group>0){$groupOk=1;}else{$groupOk=0; $error='User Group Needed';}
        if($status>0){$statusOk=1;}else{$statusOk=0; $error='User Status Needed';}
        $validated = $fNameOk+$lNameOk+$emailOk+$phoneOk+$groupOk+$statusOk;
        if($validated == 6){
            if($uid>0){
                $updateString = "f_name='$f_name',l_name='$l_name',email='$email',phone='$phone',id_no='$id_no',username='$username',user_group='$group',status='$status',added_by='$sid'";
                $update = updateDb('l_staff',$updateString,"id='$uid'");
                if($update == 1){
                    $proceed = 1;
                    $desc = "Updated Staff [$username] by [$username]";
                    save_log($desc,$sid);
                    echo "
                            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                            <script>
                                toastr.success('User Updated Succesfully');
                            </script>";
                    echo success("User Updated Succesfully");
                }else{
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Unable to Update User!')
                        </script>";
                    echo error("Unable to Update User!");
                }
            }else{
                $epass = passencrypt($password);
                $hash = substr($epass, 0, 64);
                $salt = substr($epass, 64, 96);

                $avatar = get_gravatar($email);

                $fields = array('f_name','l_name','email','phone','id_no','username','pass','user_group','status','avatar','added_by');
                $values = array("$f_name","$l_name","$email","$phone","$id_no","$username","$hash","$group","$status","$avatar","$sid");
                $create = insertDb('l_staff', $fields, $values);
                //echo $create;
                if($create == 1){
                    echo success('User Added Successfully');
                    $userid = getValue('l_staff',"email='$email'","id");
                    $proceed = 1;
                    $desc = "Created New User [$email] by [$username]";
                    save_log($desc,$sid);
                    $fields = array('user_id','pass');
                    $values = array($userid,$salt);
                    $saltSave = insertDb('l_passes',$fields,$values);
                    if($saltSave == 1){
                        echo "
                            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                            <script>
                                toastr.success('Default Password Created')
                            </script>";
                        echo success("Default Password Created");
                    }else{
                        echo "
                            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                            <script>
                                toastr.error('Unable to create Password!')
                            </script>";
                        echo error("Unable to create Password");
                    }
                }else{
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Unable to Add Staff')
                        </script>";
                    echo error("Unable to Add Staff");
                }
            }
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Unable to Add Staff')
                </script>";
            echo error($error);
        }

    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed == '1'){
        setTimeout(function (){
            window.location.href = 'staff?a=sa';
        }, 2000);
    }
</script>

<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';
        $studentid = decurl($_REQUEST['studid']);
        if($studentid>0){
            $adm_no = getValue('l_student',"id='$studentid'","adm_no");
            $student_name = getValue('l_student',"id='$studentid'",'username');
            $delete = deleteDb('l_student',"id='$studentid'");
            if($delete == 1){
                $proceed = 1;
                $sid = decurl($_SESSION["maktaba_"]);
                $username = getValue('l_staff',"id='$sid'",'username');
                $desc = "Deleted Student [$adm_no] [$student_name] By [$username]";
                save_log($desc,$sid);
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.success('User Deleted Succesfully');
                    </script>";
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('User NOT Deleted');
                    </script>";
            }
        }else{
            echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('User Invalid');
                    </script>";
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed == '1'){
        setTimeout(function (){
            location.reload();
        }, 2000);
    }
</script>

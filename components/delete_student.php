<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';
        $studentid = decurl($_REQUEST['studid']);
        if($studentid>0){
            $delete = deleteDb('l_student',"id='$studentid'");
            if($delete == 1){
                $proceed = 1;
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

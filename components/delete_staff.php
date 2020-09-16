<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';
        $userid=decurl($_REQUEST['userid']);
        if($userid>0){
            $delete = deleteDb('l_staff',"id='$userid'");
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
                        toastr.error('User could NOT be Deleted');
                    </script>";
            }
        }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Invalid User');
                    </script>";
        }
    }
?>
<script>
    var proceed="<?php echo $proceed; ?>";
    if(proceed == 1){
        setTimeout(function (){
            location.reload();
        }, 2000);
    }
</script>

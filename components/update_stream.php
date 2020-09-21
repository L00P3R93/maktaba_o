<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';
        $sid = decurl($_SESSION["maktaba_"]);
        $username = getValue('l_staff',"id='$sid'","username");
        $id = decurl($_REQUEST['id']);
        $stream = $_REQUEST['stream'];
        $updateString = "name='$stream'";
        $upd = updateDb('l_streams',$updateString,"id='$id'");
        if($upd){
            $proceed = 1;
            $desc = "Updated Class Stream [$stream] By [$username]";
            save_log($desc,$sid);
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.success('Stream Updated Succesfully');
                </script>";
            echo success("Stream Updated Succesfully");
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Stream Not Updated');
                </script>";
            echo error("Stream Not Updated");
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed=='1'){
        location.reload();
    }
</script>

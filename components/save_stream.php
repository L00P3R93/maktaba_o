<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';
        $sid = decurl($_SESSION["maktaba_"]);
        $username = getValue('l_staff',"id='$sid'","username");
        $iter = $_REQUEST['iter'];
        $streams = array();
        $fds = array("name");
        for($i=1;$i<=$iter;$i++){
            $stream = $_REQUEST["stream".$i];
            $vls = array($stream);
            $insert = insertDb('l_streams',$fds,$vls);
            $desc = "Created New Class Stream [$stream] By [$username]";
            save_log($desc,$sid);
        }
        if($insert){
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.success('Streams Created Succesfully');
                </script>";
            echo success("Stream Created Succesfully");
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Stream Could Not be Created');
                </script>";
            echo error("Stream Could Not be Created");
        }
    }
?>
<script>
    var proceed = "<?php echo $insert; ?>";
    if(proceed == '1'){
        location.reload();
    }
</script>

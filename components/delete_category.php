<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';

        $category_id = $_REQUEST['categoryId'];
        if($category_id>0){
            $categroy_name = getValue('l_category',"id='$category_id'","name");
            $delete = deleteDb('l_category',"id='$category_id'");
            if($delete == 1){
                $proceed = 1;
                $sid = decurl($_SESSION["maktaba_"]);
                $username = getValue('l_staff',"id='$sid'",'username');
                $desc = "Deleted Category [$categroy_name] By [$username]";
                save_log($desc,$sid);
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.success('Category Deleted Successfully')
                    </script>";
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Category could Not be Deleted!')
                    </script>";
            }
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Invalid Category!')
                </script>";
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed === "1"){
        setTimeout(function() {
            location.reload();
        }, 2000); // 4 seconds
    }
</script>

<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';
        $category_name = $_REQUEST['categoryName'];
        $category_id = $_REQUEST['categoryId'];
        $categoryNameOk = input_length($category_name, 2);
        if($categoryNameOk == 0){
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Category Name cannot be Blank!')
                </script>";
        }else{
            if($category_id>0){
                $updateString = "name='$category_name'";
                $upd = updateDb('l_category',$updateString,"id='$category_id'");
                if($upd == 1){
                    $proceed = 1;
                    $sid = decurl($_SESSION["maktaba_"]);
                    $username = getValue('l_staff',"id='$sid'","name");
                    $desc = "Updated Category Name [$category_name] By [$username]";
                    save_log($desc,$sid);
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Category Created Successfully')
                        </script>";
                }else{
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Category Name cannot be Blank!')
                        </script>";
                }
            }else{
                $fds = array("name"); $val = array("$category_name");
                $create = insertDb('l_category',$fds,$val);
                if($create==1){
                    $proceed = 1;
                    $sid = decurl($_SESSION["maktaba_"]);
                    $desc = "Created New Category";
                    save_log($desc,$sid);
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Category Created Successfully')
                        </script>";
                }
            }
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed === "1"){
        setTimeout(function() {
            window.location.href = 'categories?a=c'; // the redirect goes here
        }, 2000); // 2 seconds
    }
</script>

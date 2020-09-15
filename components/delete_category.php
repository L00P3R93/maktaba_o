<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $category_id = $_REQUEST['categoryId'];
        if($category_id>0){
            $delete = deleteDb('l_category',"id='$category_id'");
            if($delete == 1){
                $proceed = 1;
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
            window.location.href = 'categories?a=c'; // the redirect goes here
        }, 2000); // 4 seconds
    }
</script>

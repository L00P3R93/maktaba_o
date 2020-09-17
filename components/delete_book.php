<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';
        $book_id = decurl($_REQUEST['bookId']);
        if($book_id>0){
            $book_name = getValue('l_books',"id='$book_id'","title");
            $delete = deleteDb('l_books',"id='$book_id'");
            if($delete == 1){
                $proceed = 1;
                $sid = decurl($_SESSION["maktaba_"]);
                $username = getValue('l_staff',"id='$sid'",'username');
                $desc = "Deleted Book [$book_name] By [$username]";
                save_log($desc,$sid);
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.success('Book Deleted Successfully')
                    </script>";
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Book could Not be Deleted!')
                    </script>";
            }
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Invalid Book Selected!')
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

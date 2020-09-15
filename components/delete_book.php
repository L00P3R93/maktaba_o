<?php
    if($_POST){
        $book_id = $_REQUEST['bookId'];
        if($book_id>0){
            $delete = deleteDb('l_books',"id='$book_id'");
            if($delete == 1){
                $proceed = 1;
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
            window.location.href = 'books?a=b'; // the redirect goes here
        }, 2000); // 4 seconds
    }
</script>

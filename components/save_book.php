<?php
    if($_POST){
        require '../includes/data.php';
        require '../includes/conn.php';

        $sid = decurl($_REQUEST['sid']);
        $username = getValue('l_staff',"id='$sid'",'username');
        $bookid = decurl($_REQUEST['bookid']);
        $title = $_REQUEST['title'];
        $author = $_REQUEST['author'];
        $isbn = $_REQUEST['isbn'];
        $books = $_REQUEST['books'];
        $publisher = $_REQUEST['publisher'];
        $category = $_REQUEST['category'];
        $status = $_REQUEST['status'];

        $titleOk = input_length($title,2);
        if($titleOk==0){$error="Book Title Needed";}
        if($books>0){$booksOk=1;}else{$booksOk=0;$error="Number of Books Needed";}
        if($category>0){$categoryOk=1;}else{$categoryOk=0;$error="Book Category Needed";}
        if($status>0){$statusOk=1;}else{$statusOk=0;$error="Book Status Needed";}

        $validated = $titleOk+$categoryOk+$statusOk;
        if($validated == 3){
            if($bookid>0){
                $updateString="title='$title',author='$author',isbn='$isbn',books='$books',publisher_name='$publisher',category='$category',status='$status',added_by='$sid'";
                $update = updateDb('l_books',$updateString,"id='$bookid'");
                if($update == 1){
                    $proceed = 1;
                    $desc = "Updated Book [$title] By [$username]";
                    save_log($desc,$sid);
                    echo success("Book Updated Successfully");
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Book Updated Successfully');
                        </script>";
                }else{
                    echo error("Book Not Updated");
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Book Not Updated');
                        </script>";
                }
            }else{
                $fields = array('title','author','isbn','books','publisher_name','category','status','added_by');
                $values = array("$title","$author","$isbn","$books","$publisher","$category","$status","$sid");
                $create = insertDb('l_books',$fields,$values);
                if($create == 1){
                    $proceed = 1;
                    $book_id = getValue('l_books',"title='$title'",'id');
                    $desc = "Created New Book [$title] By [$username]";
                    $fds = array('book_id','description','added_by');
                    $vals = array($book_id,$desc,$sid);
                    $create_activity = insertDb('l_book_activity',$fds,$vals);
                    save_log($desc,$sid);
                    echo success("Book Created Successfully");
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Book Created Successfully')
                        </script>";
                }else{
                    echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Failed to Add Book')
                    </script>";
                    echo error("Failed to add Book");}
            }
        }else{
            echo error($error);
            echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('".$error.".')
                    </script>";
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed == '1'){
        setTimeout(function (){
            window.location.href = "books?a=b";
        }, 2000);
    }
</script>

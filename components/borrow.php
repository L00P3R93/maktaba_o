<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $sid = decurl($_REQUEST['sid']);
        $username = getValue('l_staff',"id='$sid'",'username');
        $bookid = $_REQUEST['bookid'];
        $studentid = $_REQUEST['studentid'];
        $adm_no = getValue('l_student',"id='$studentid'",'adm_no');
        $title = $_REQUEST['title'];
        $author = $_REQUEST['author'];
        $isbn = $_REQUEST['isbn'];
        $books = $_REQUEST['books'];
        $pickup = $_REQUEST['pickup'];
        $return = $_REQUEST['return'];

        $pickupDt = explode('-',$pickup);
        $pickupD = $pickupDt[2]; $pickupM = $pickupDt[1]; $pickupY = $pickupDt[0];

        $returnDT = explode('-',$return);
        $returnD = $returnDT[2]; $returnM=$returnDT[1]; $returnY=$returnDT[0];
        if($sid>0 && $bookid>0 && $studentid>0){
            if(checkdate($pickupM,$pickupD,$pickupY) && checkdate($returnM,$returnD,$returnY)){
                $fds = Array('book_id','student_id','borrow_status','issued_by','books','borrow_date','return_date');
                $vals = Array("$bookid","$studentid","1","$sid","$books","$pickup","$return");
                $create = insertDb("l_borrowed",$fds,$vals);
                if($create == 1){
                    $proceed=1;
                    $updateString = "books=books-$books";
                    $update = updateDb('l_books',$updateString,"id=$bookid");
                    if($update==1){
                        $fdss = Array("book_id","description","added_by");
                        $valss = Array("$bookid","Borrowed Book","$sid");
                        insertDb("l_book_activity",$fdss,$valss);
                        $sid = decurl($_SESSION["maktaba_"]);
                        $desc = "Issued Book to [$adm_no] by [$username]";
                        save_log($desc,$sid);
                        echo "
                            <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                            <script>
                                toastr.success('Book Borrowed Successfully!');
                            </script>";
                    }
                }
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Invalid Date!');
                    </script>";
            }
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('Book & Student Cannot be empty!');
                </script>";
        }
    }
?>

<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed == '1'){
        setTimeout(function (){
            window.location.href="books?a=b";
        }, 2000);
    }
</script>

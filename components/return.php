<?php
    if($_POST){
        session_start();
        require '../includes/conn.php';
        require '../includes/data.php';
        $borrowid = decurl($_REQUEST['id']);
        $b=getOneRow('l_borrowed',"id='$borrowid'");
        if($borrowid>0){
            $update = updateDb('l_borrowed',"borrow_status='2'","id='$borrowid'");
            if($update==1){
                $updateBook = updateDb('l_books',"books=books+$b[books]","id='$b[book_id]'");
                if($updateBook==1){
                    $student = getValue('l_student',"id='$b[student_id]'",'username');
                    $book = getValue('l_books',"id='$b[book_id]'",'title');
                    $user = getValue('l_staff',"id='$b[issued_by]'",'username');
                    $proceed = 1;
                    $desc = "Returned Book [$book] Borrowed by [$student] -> [$user]";
                    save_log($desc,decurl($_SESSION['maktaba_']));
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Book Returned Successfully!');
                        </script>";
                    }
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Failed to Return Book!');
                    </script>";
            }
        }
    }
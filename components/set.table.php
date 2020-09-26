<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $dt = $_REQUEST['dt'];
        $d = explode('-', $dt);
        $from = $d[0]; $to = $d[1];
        $from = str_replace('/','-',$from); $to = str_replace('/','-',$to);
        $from = strval(date("Y-m-d",strtotime($from))); $to = strval(date("Y-m-d",strtotime($to)));
        $condition = "borrow_date>='$from' AND return_date<='$to' AND borrow_status='3'";
        $r = getTableOrdered('l_borrowed',$condition,"id","desc","1000000000"); $i=1;
        if(mysqli_num_rows($r) > 0){
            while($sts = mysqli_fetch_object($r)){ ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><a href="#" class="bookView" data-toggle="modal" data-target="#modal-view" value="<?php echo encurl($sts->book_id); ?>"><?php echo getValue("l_books","id='$sts->book_id'",'title'); ?></a></td>
                    <td><?php echo $sts->books." Book(s)"; ?></td>
                    <td><a href="#" class="studentView" value="<?php echo encurl($sts->id); ?>" data-toggle="modal" data-target="#modal-view"><?php echo getValue('l_student',"id='$sts->student_id'",'adm_no'); ?></a></td>
                    <td><a href="#" class="viewStaff"  data-toggle="modal" data-target="#modal-view" value="<?php echo encurl($sts->issued_by); ?>" ><?php echo getValue('l_staff', "id='$sts->issued_by'","username"); ?></a></td>
                    <td><?php echo date("d-M-Y", strtotime($sts->borrow_date)); ?></td>
                    <td><?php echo date("d-M-Y", strtotime($sts->return_date)); ?></td>
                    <td><?php echo getBorrowStatus($sts->borrow_status,$sts->return_date,$sts->id)?></td>
                </tr>
            <?php
                $i++;
            }
        }else{}
    }
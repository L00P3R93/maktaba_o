<?php
    include_once '../includes/conn.php';
    include_once '../includes/data.php';

    if($_POST){
        $sid = decurl($_REQUEST['sid']);
        $uid = decurl($_REQUEST['studid']);
        $f_name = $_REQUEST['f_name'];
        $m_name = $_REQUEST['m_name'];
        $l_name = $_REQUEST['l_name'];
        $adm_no = $_REQUEST['adm_no'];
        $class = $_REQUEST['class'];
        $status = $_REQUEST['status'];

        $fNameOk = input_length($f_name,2);
        if($fNameOk==0){$error = "First Name Needed";}
        $lNameOk = input_length($l_name, 2);
        if($lNameOk==0){$error = "Last Name Needed";}
        $mNameOk = input_length($m_name, 2);
        if($mNameOk==0){$error = "Middle Name Needed";}
        if($class>0){$classOk=1;}else{$classOk=0;$error="Student Class Needed";}
        if($status>0){$statusOk=1;}else{$statusOk=0;$error="Student Status Needed";}
        $validated = $fNameOk+$lNameOk+$mNameOk+$classOk+$statusOk;
        if($validated == 5){
            if($uid>0){
                $updateString = "f_name='$f_name',m_name='$m_name',l_name='$l_name',adm_no='$adm_no',class='$class',status='$status',added_by='$sid'";
                $update = updateDb('l_student',$updateString,"id='$uid'");
                if($update == 1){
                    $proceed = 1;
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Student Updated Succesfully');
                        </script>";
                    echo success("Student Updated Succesfully");
                }else{
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Student Not Updated');
                        </script>";
                    echo error("Student Not Updated");
                }
            }else{
                $username = $f_name.".".$l_name;
                $fields = array("f_name","m_name","l_name","adm_no","username","class","status","added_by");
                $values = array("$f_name","$m_name","$l_name","$adm_no","$username","$class","$status","$sid");
                $create = insertDb('l_student',$fields,$values);
                if($create == 1){
                    $proceed = 1;
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.success('Student Added Successfully')
                        </script>";
                    echo success("Student Added Successfully");
                }else{
                    echo "
                        <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                        <script>
                            toastr.error('Unable to Add Student!')
                        </script>";
                    echo error("Unable to Add Student");
                }
            }
        }else{
            echo "
                <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                <script>
                    toastr.error('".$error."')
                </script>";
            echo error($error);
        }
    }
?>
<script>
    var proceed = "<?php echo $proceed; ?>";
    if(proceed == '1'){
        setTimeout(function (){
            window.location.href = "students?a=su";
        });
    }
</script>

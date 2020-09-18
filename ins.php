<?php
    require 'includes/conn.php';
    require 'includes/data.php';

    $g = getTable('l_groups');
    $p = array("STAFF_MANAGEMENT","SETTING_MANAGEMENT","STUDENT_MANAGEMENT","BOOK_MANAGEMENT","LOGS");
    while($r=mysqli_fetch_object($g)){
        foreach($p as $pr){
            $fds = array("group_id","permission_name","description","p_view","p_add","p_del","p_edit");
            $vls = array("$r->id","$pr",NULL,"1","1","1","1");
            $insert = insertDb('l_group_permissions',$fds,$vls);
            if($insert==1){
                echo $pr."ADDED \n";
            }
        }
    }
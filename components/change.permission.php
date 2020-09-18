<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $group = $_REQUEST['g'];
        $perm_name = $_REQUEST['n'];
        $type = $_REQUEST['t'];
        $action = $_REQUEST['a'];
        $v=$a=$e=$d=0;
        switch ($type){
            case 'view':
                $v=$action;
                $act = "p_view='$action'";
                break;
            case 'add':
                $a=$action;
                $act = "p_add='$action'";
                break;
            case 'edit':
                $e=$action;
                $act="p_edit='$action'";
                break;
            case 'delete':
                $d=$action;
                $act="p_del='$action'";
                break;
        }

        $perm_exists = checkRowExists('l_group_permissions',"group_id='$group' AND permission_name='$perm_name'");
        if($perm_exists == 1){
            $effect = updateDb('l_group_permissions',"$act", "group_id='$group' AND permission_name='$perm_name'");
            if($effect){
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.success('Permission Updated Successfully')
                    </script>";
            }else{
                echo "
                    <script src=\"assets/plugins/toastr/toastr.min.js\"></script>
                    <script>
                        toastr.error('Permission NOT Updated')
                    </script>";
            }
        }
    }
?>
<script>
    var proceed = "<?php echo $effect; ?>";
    if(proceed == 1){load_perms("<?php echo encurl($group); ?>")}
</script>

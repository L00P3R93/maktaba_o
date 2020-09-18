<?php
    if($_GET){
        require '../includes/conn.php';
        require '../includes/data.php';

        if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
            $i=1;
            $group = decurl($_REQUEST['id']);
            $perm = getTableGrouped('l_group_permissions',"group_id='$group'","permission_name","asc","permission_name","100");
?>
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Permission_Name</th>
                    <th scope="col">View</th>
                    <th scope="col">Add</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    while($r=mysqli_fetch_object($perm)){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $r->permission_name; ?></td>
                        <td><?php echo setPermission($r->p_view,$r->group_id,$r->permission_name,'view'); ?></td>
                        <td><?php echo setPermission($r->p_add,$r->group_id,$r->permission_name,'add'); ?></td>
                        <td><?php echo setPermission($r->p_edit,$r->group_id,$r->permission_name,'edit'); ?></td>
                        <td><?php echo setPermission($r->p_del,$r->group_id,$r->permission_name,'delete'); ?></td>
                    </tr>
                <?php
                        $i++;
                    }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Permission_Name</th>
                    <th scope="col">View</th>
                    <th scope="col">Add</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </tfoot>
            </table>
<?php
        }else{ ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> You should select a group first.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<?php   }
    }

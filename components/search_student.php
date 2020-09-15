<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $searchVal = $_REQUEST['student'];
        $condition = "f_name LIKE '%$searchVal%' OR m_name LIKE '%$searchVal%' OR l_name LIKE '%$searchVal%' OR adm_no LIKE '%$searchVal%' OR username LIKE '%$searchVal%'";
        $searchData = searchTable('l_student', $condition);
        $searchRows = mysqli_num_rows($searchData);
        if($searchRows>0){
            while($sd=mysqli_fetch_object($searchData)){ ?>
                <li>
                    <a class="setStudent" stuid="<?php echo $sd->id; ?>" nm="<?php echo $sd->f_name." ".$sd->m_name." ".$sd->l_name; ?>"><?php echo $sd->f_name." ".$sd->m_name." ".$sd->l_name; ?><br />
                        <span><?php echo $sd->adm_no; ?></span>
                    </a>
                </li>
    <?php   }
        }else{
            echo "<li><a>No Results ...</a></li>";
        }
    }
?>
<script>
    $(".setStudent").click(function(){
        var studentid = $(this).attr("stuid");
        var nm = $(this).attr("nm");
        $("#student").val(nm);
        $("#studentid").val(studentid);
        console.log(studentid);
        console.log(nm);
    });
</script>

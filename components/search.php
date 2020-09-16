<?php
    if($_POST){
        require '../includes/conn.php';
        require '../includes/data.php';

        $searchVal = $_REQUEST['val'];
        //echo $searchVal;
        $conditionStaff = "f_name LIKE '%$searchVal%' OR l_name LIKE '%$searchVal%' OR id_no LIKE '%$searchVal%' OR phone LIKE '%$searchVal%' OR username LIKE '%$searchVal%'";
        $conditionStudent = "f_name LIKE '%$searchVal%' OR m_name LIKE '%$searchVal%' OR l_name LIKE '%$searchVal%' OR adm_no LIKE '%$searchVal%' OR username LIKE '%$searchVal%'";
        $conditionBooks = "title LIKE '%$searchVal%' OR author LIKE '%$searchVal%' OR publisher_name LIKE '%$searchVal%' OR isbn LIKE '%$searchVal%'";
        $staff = searchTable('l_staff',$conditionStaff);
        $student = searchTable('l_student',$conditionStudent);
        $books = searchTable('l_books',$conditionBooks);
        if(mysqli_num_rows($staff)>0){
            while($r=mysqli_fetch_object($staff)){ ?>
                <li>
                    <a href="search?a=s&t=sta&id=<?php echo encurl($r->id) ?>"><?php echo $r->f_name." ".$r->l_name; ?><br />
                        <span><?php echo getGroup($r->user_group); ?></span>
                    </a>
                </li>
<?php
            }
        }else if(mysqli_num_rows($student)>0){
            while($r=mysqli_fetch_object($student)){ ?>
                <li>
                    <a href="search?a=s&t=stu&id=<?php echo encurl($r->id) ?>"><?php echo $r->f_name." ".$r->m_name." ".$r->l_name; ?><br />
                        <span><?php echo $r->adm_no; ?></span>
                    </a>
                </li>
<?php
            }
        }else if(mysqli_num_rows($books)>0){
            while($r=mysqli_fetch_object($books)){ ?>
                <li>
                    <a href="search?a=s&t=b&id=<?php echo encurl($r->id) ?>" class="setBookSearch" bookid="<?php echo $r->id; ?>" nm="<?php echo $r->title; ?>"><?php echo $r->title; ?><br />
                        <span><?php echo $r->author; ?></span>
                    </a>
                </li>
<?php
            }
        }else{echo "<li><a>No Results ...</a></li>";}
    }
?>
<script>

</script>

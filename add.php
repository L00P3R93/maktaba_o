<?php include 'controllers/base/head.php'; ?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <?php include 'controllers/nav/nav.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'controllers/nav/side.nav.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                        <?php
                            if($_REQUEST['t'] == 'stud'){
                                if(isset($_REQUEST['id'])){echo 'Edit Student';}
                                else{echo 'New Student';}
                            }else if($_REQUEST['t'] == 'staff'){
                                if(isset($_REQUEST['id'])){echo 'Edit Staff';}
                                else{echo 'New Staff';}
                            }else{
                                if(isset($_REQUEST['id'])){echo 'Edit Book';}
                                else{echo 'New Book';}
                            }
                        ?>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home?a=d">Home</a></li>
                            <li class="breadcrumb-item active"><?php if($_REQUEST['t'] == 'stud'){echo 'Add Student';}else{echo 'Add Staff';} ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><?php if($_REQUEST['t'] == 'stud'){echo 'Add Student';}else{echo 'Add Staff';} ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                <?php
                        if($_REQUEST['t']=='stud'){
                            if(isset($_GET['id'])){
                                $studentid = decurl($_REQUEST['id']);
                                $r = getOneRow('l_student',"id='$studentid'");
                                $fname=$r['f_name']; $mname=$r['m_name']; $lname=$r['l_name'];
                                $admno=$r['adm_no']; $class=$r['class']; $status=$r['status'];
                            }else{
                                $studentid=0; $fname=""; $mname=""; $lname=""; $admno=""; $class=""; $status="";
                            }

                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="f_name" id="f_name" placeholder="First Name" value="<?php echo $fname; ?>" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Admission/Registration Number</label>
                                        <input type="text" class="form-control" name="adm_no" id="adm_no" placeholder="Admission/Registration Number" value="<?php echo $admno; ?>" autocomplete="off" required />
                                    </div>
                                    <button class="btn btn-primary saveStudent mb-4" value="SAVE_STUDENT" style="width: 50%;">Save</button>
                                    <input type="hidden" name="sid" id="sid" value="<?php echo $_SESSION['maktaba_']; ?>">
                                    <input type="hidden" name="studid" id="studid" value="<?php echo encurl($studentid); ?>">
                                    <div class="feedback"></div>
                                    <div class="processing"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" name="m_name" id="m_name" placeholder="Middle Name" value="<?php echo $mname; ?>" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Class/Level</label>
                                        <select class="form-control select2" style="width: 100%;" name="class" id="class">
                                            <option value="0">Select Class</option>
                                            <option <?php echo selected($class,"1", 'selected') ?> value="1">Form One</option>
                                            <option <?php echo selected($class,"2", 'selected') ?> value="2">Form Two</option>
                                            <option <?php echo selected($class,"3", 'selected') ?> value="3">Form Three</option>
                                            <option <?php echo selected($class,"4", 'selected') ?> value="4">Form Four</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Surname</label>
                                        <input type="text" class="form-control" name="l_name" id="l_name" placeholder="Surname" value="<?php echo $lname; ?>" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" style="width: 100%;" name="stat1" id="stat1">
                                            <option value="0">Select Status</option>
                                            <option <?php echo selected($status,"1", 'selected') ?>  value="1">Active</option>
                                            <option <?php echo selected($status,"3", 'selected') ?>  value="3">Blocked</option>
                                            <option <?php echo selected($status,"2", 'selected') ?>  value="2">Cleared</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                <?php   }
                        else if($_REQUEST['t'] == 'staff'){
                            if(isset($_GET['id'])){
                                $staffid=decurl($_REQUEST['id']);
                                $r = getOneRow('l_staff',"id='$staffid'");
                                $fname=$r['f_name']; $lname=$r['l_name']; $email=$r['email']; $id_no=$r['id_no'];
                                $phone=$r['phone']; $group=$r['user_group']; $status=$r['status']; $username=$r['username'];
                            }else{
                                $staffid=0; $fname=""; $lname=""; $email=""; $id_no=""; $phone=""; $group=""; $status=""; $username="";
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="f_name" id="f_name" placeholder="First Name" value="<?php echo $fname; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>National ID/Passport/Work ID</label>
                                        <input type="text" class="form-control" name="id_no" id="id_no" placeholder="National ID/Passport/Work ID" value="<?php echo $id_no; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="07XX XXX XXX" value="<?php echo $phone; ?>" autocomplete="off" required>
                                    </div>
                                    <button class="btn btn-primary saveStaff mb-4" value="SAVE_STAFF" style="width: 30%;">Save</button>
                                    <input id="sid" name="sid" value="<?php echo $_SESSION['maktaba_'] ?>" type="hidden" />
                                    <input id="uid" name="uid" value="<?php echo encurl($staffid); ?>" type="hidden" />
                                    <div class="feedback"></div>
                                    <div class="processing"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Surname</label>
                                        <input class="form-control" name="l_name" id="l_name" placeholder="Surname" value="<?php echo $lname; ?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>User Group</label>
                                        <select class="form-control select2" style="width: 100%;" name="group" id="group">
                                            <option>Select Group</option>
                                            <?php
                                            $dt = getTable('l_groups');
                                            while($v=mysqli_fetch_object($dt)){ ?>
                                                <option <?php echo selected($group,$v->id,'selected'); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" style="width: 100%;" name="stat2" id="stat2">
                                            <option <?php echo selected($status,"0",'selected'); ?> value="0">Select Status</option>
                                            <option <?php echo selected($status,"1",'selected'); ?> value="1">Active</option>
                                            <option <?php echo selected($status,"2",'selected'); ?> value="2">Blocked</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                <?php   }
                        else if($_REQUEST['t'] == 'book'){
                            if(isset($_REQUEST['id'])){
                                $bookid=decurl($_REQUEST['id']);
                                $r = getOneRow('l_books',"id='$bookid'");
                                $title=$r['title']; $author=$r['author']; $isbn=$r['isbn']; $books=$r['books'];
                                $publisher=$r['publisher_name']; $category=$r['category']; $status=$r['status'];
                            }else{
                                $bookid=0;
                                $title=""; $author=""; $isbn=""; $books=""; $publisher=""; $category=""; $status="";
                            }

                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Book Title</label>
                                        <input type="text" id="title" name="title" class="form-control" placeholder="Book Title" value="<?php echo $title; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Book Author</label>
                                        <input type="text" id="author" name="author" class="form-control" placeholder="Book Author" value="<?php echo $author; ?>" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" id="isbn" name="isbn" class="form-control" placeholder="ISBN Number" value="<?php echo $isbn; ?>" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="books">Stocked Copies</label>
                                        <input type="number" id="books" name="books" class="form-control" placeholder="Number of Books"  value="<?php echo $books; ?>" required autocomplete="off">
                                    </div>
                                    <button class="btn btn-primary saveBook mb-4" value="SAVE_BOOK" style="width: 30%;">Save</button>
                                    <input id="sid" name="sid" value="<?php echo $_SESSION['maktaba_'] ?>" type="hidden" />
                                    <input id="bookid" name="bookid" value="<?php echo encurl($bookid); ?>" type="hidden" />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="publisher">Book Publisher Name</label>
                                        <input type="text" id="publisher" name="publisher" class="form-control" placeholder="Book Publisher"  value="<?php echo $publisher; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Book Category</label>
                                        <select class="form-control select2" style="width: 100%;" name="category" id="category">
                                            <option>Select Category</option>
                                            <?php
                                            $dt = getTable('l_category');
                                            while($v=mysqli_fetch_object($dt)){ ?>
                                                <option <?php echo selected($category,$v->id,'selected'); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="stat3">Book Status</label>
                                        <select class="form-control select2" style="width: 100%;" name="stat3" id="stat3">
                                            <option value="0">Select Category</option>
                                            <option <?php echo selected($status, "1",'selected')  ?> value="1">Active</option>
                                            <option <?php echo selected($status, "2",'selected')  ?> value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="feedback"></div>
                                    <div class="processing"></div>
                                </div>

                            </div>
                <?php   }else{} ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <?php include 'controllers/base/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php include 'controllers/base/js.php'; ?>
</body>
</html>

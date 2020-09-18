<?php
    //session_start();
    //if(isset($_SESSION['maktaba_'])){$s_id=$_SESSION['maktaba_'];}

    $fdate= date('Y-m-d H:i:s');

    function generateRandomString($length){
        $ch = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chLength = strlen($ch);
        $randString = '';
        for($i=0;$i<length;$i++){
            $randString .= $ch[rand(0,$chLength-1)];
        }
        return $randString;
    }

    function crazyString($length){
        $ch = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%^*()_+-~{}[];:|.<>';
        $chLenght = strlen($ch);
        $randomString = '';
        for($i=0; $i<$length; $i++){
            $randomString .= $ch[rand(0, $chLenght-1)];
        }
        return $randomString;
    }

    function passencrypt($pass){
        $ourSalt = crazyString(32);
        $longPass = $ourSalt.$pass;
        $hash = hash('SHA256', $longPass);
        return $hash.$ourSalt;
    }

    function encurl($id){
        $secureId = $id*1321;
        return $secureId;
    }

    function decurl($id){
        $originalId = $id/1321;
        return $originalId;
    }

    function extractnumber($str){
        preg_match_all('!\d+!', $str, $matches);
        $final = implode('', $matches[0]);
        return $final;
    }

    function input_available($x){
        $x = rtrim($x);
        if(empty($x)){return 0;}
        else{return 1;}
    }

    function input_length($x,$l){
        $x = rtrim($x);
        if(strlen($x)<$l){return 0;}
        else{return 1;}
    }

    function validate_email($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 1;
        }else{return 0;}
    }

    function validate_phone($phone){
        if((strlen($phone)) == 10 && (substr($phone, 0,2) === "07")){
            return 1;
        }else{return 0;}
    }

    function uploadFile($filename,$tmpName,$uploadDir){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newFileName = generateRandomString(10).'.'.$ext;
        $filePath = $uploadDir.$newFileName;
        $r = move_uploaded_file($tmpName,$filePath);
        if(!$r){return 0;}
        else{return $newFileName;}
    }

    function selected($value1, $value2, $return){
        if($value1 == $value2){
            return $return;
        }
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    function get_gravatar($email, $s=80, $d='mp',$r='g', $img=false,$atts=array()){
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s%d=$d$r=$r";
        if($img){
            $url='<img src="'.$url.'"';
            foreach($atts as $k=>$v){
                $url .= ' '.$k.'="'.$v.'"';
            }
            $url .= ' />';
        }
        return $url;
    }


    function success($x){
        return "
        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
          <strong>Hey!</strong> $x
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>";
    }

    function error($x){
        return "
        <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
          <strong>Oops!</strong> $x
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>";
    }

    function getPage($page){
        switch($page){
            case 'd':
                return "Dashboard";
                break;
            case 'b':
                return "Books";
                break;
            case 'c':
                return "Categories";
                break;
            case 'bo':
                return "Borrowed";
                break;
            case 'f':
                return "Fines";
                break;
            case 'nsa':
                return "Add Staff";
                break;
            case 'nsu':
                return "Add Student";
                break;
            case 'nb':
                return "Add Book";
                break;
            case 'su':
                return "Students";
                break;
            case 'sa':
                return "Staff";
                break;
            case 's':
                return "Search";
                break;
            case 'r':
                return "Reset";
                break;
            case 'p':
                return "Profile";
                break;
            case 'l':
                return "Activity Logs";
                break;
            case 'set':
                return "Settings";
                break;
            default:
                return "Maktaba";
                break;
        }
    }

    function getStatus($status){
        switch($status){
            case 1:
                return '<span class="badge badge-primary">Active</span>';
                break;
            case 2:
                return '<span class="badge badge-primary">Blocked</span>';
                break;
            default:
                return '<span class="badge badge-info">Not Defined</span>';
                break;
        }
    }

    function getClass($class){
        switch($class){
            case 1:
                return 'Form 1';
                break;
            case 2:
                return 'Form 2';
                break;
            case 3:
                return 'Form 3';
                break;
            case 4:
                return 'Form 4';
            default:
                return 'Not Defined';
                break;
        }
    }

    function getBorrowStatus($status='',$returnDt){
        $today= strtotime("now");
        $returnDt = strtotime($returnDt);
        switch($status){
            case "1":
                if($today>$returnDt){return "<span class=\"badge badge-danger\">Late</span>";}
                return "<span class=\"badge badge-primary\">Borrowed</span>";
                break;
            case "2":
                return "<span class=\"badge badge-success\">Returned</span>";
                break;
            default:
                return "<span class=\"badge badge-primary\">Borrowed</span>";
                break;
        }

    }

    function getGroup($group){
        switch ($group){
            case "1":
                return "Admin";
                break;
            case "2":
                return "Super Admin";
                break;
            case "3":
                return "Staff";
                break;
            case "4":
                return  "Student";
                break;
            default:
                return "Invalid";
                break;
        }
    }

    function setPermission($p,$groupid,$pname,$type){
        if($p == 1){
            echo "<a onclick='changeperm(\"$groupid\",\"$pname\",\"$type\",\"0\")' class='fas fa-check text-success'></a>";
        }else{
            echo "<a onclick='changeperm(\"$groupid\",\"$pname\",\"$type\",\"1\")' class='fas fa-times text-danger'></a>";
        }
    }

    function getTable($table, $cols='*'){
        global $con; $all =array();
        $q = "SELECT $cols FROM $table";
        $r = mysqli_query($con,$q);
        return $r;
    }

    function getTableOrdered($table, $conditions, $orderby, $direction='ASC', $limit, $cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $conditions ORDER BY $orderby $direction LIMIT $limit";
        $r = mysqli_query($con, $q);
        return $r;
    }

    function getTableGrouped($table,$conditions,$orderby,$direction,$groupby,$limit,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $conditions GROUP BY $groupby ORDER BY $orderby $direction LIMIT $limit";
        $r = mysqli_query($con, $q);
        return $r;
    }

    function getValue($table,$conditions, $col){
        global $con;
        $q = "SELECT $col FROM $table WHERE $conditions";
        $r = mysqli_fetch_assoc(mysqli_query($con,$q));
        return $r[$col];
    }

    function getOneRow($table, $condition, $cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $condition";
        $r = mysqli_fetch_assoc(mysqli_query($con, $q));
        return $r;
    }

    function getOneRowOrdered($table, $condition, $cols='*',$orderby,$direction,$limit){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $condition ORDER BY $orderby $direction LIMIT $limit,1";
        $r = mysqli_fetch_assoc(mysqli_query($con, $q));
        return $r;
    }

    function getRandomRow($table,$conditions,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $conditions ORDER BY RAND()";
        $r = mysqli_fetch_assoc(mysqli_query($con, $q));
        return $r;
    }

    function getMaxId($table,$condition,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $condition ORDER BY id DESC LIMIT 0,1";
        $r = mysqli_fetch_assoc(mysqli_query($con,$q));
        return $r;
    }

    function getMaxOrdered($table,$conditions,$orderby,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $conditions ORDER BY $orderby DESC LIMIT 0,1";
        $r = mysqli_fetch_assoc(mysqli_query($con,$q));
        return $r;
    }

    function getMinId($table,$condition,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $condition ORDER BY id ASC LIMIT 0,1";
        $r = mysqli_fetch_assoc(mysqli_query($con,$q));
        return $r;
    }

    function checkRowExists($table,$conditions,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $conditions";
        $r = mysqli_num_rows(mysqli_query($con,$q));
        if($r>0){return 1;}
        else{return 0;}
    }

    function getCount($table,$condition,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $condition";
        $r = mysqli_num_rows(mysqli_query($con,$q));
        return $r;
    }

    function insertDb($table, $cols, $vals){
        global $con;
        $fields = implode(',',$cols);
        $values = implode("','",$vals);
        $values = "'$values'";
        $q = "INSERT INTO $table($fields) VALUES($values)";
        if(!mysqli_query($con,$q)){return mysqli_error($con);}
        else{return 1;}
    }

    function updateDb($table, $cols, $condition){
        global $con;
        $q = "UPDATE $table SET $cols WHERE $condition";
        if(!mysqli_query($con,$q)){return mysqli_error($con);}
        else{return 1;}
    }

    function deleteDb($table, $condition){
        global $con;
        $q = "DELETE FROM $table WHERE $condition";
        if(!mysqli_query($con,$q)){return 0;}
        else{return 1;}
    }

    function runQuery($q){
        global $con;
        $r = mysqli_query($con,$q);
        while($row=mysqli_fetch_assoc($r)){
            $res[] = $row;
        }
        if(!empty($res))
            return $res;
    }


    function permission_check($user, $module, $action){
        $userGroup = getValue('l_staff', "id='$user'", "user_group");
        $group = getOneRow('l_group_permissions',"group_id='$userGroup' AND permission_name='$module'");
        $view = $group['p_view']; $add = $group['p_add'];
        $edit = $group['p_edit']; $del = $group['p_del'];
        switch ($action){
            case 'view':
                return $view;
                break;
            case 'add':
                return $add;
                break;
            case 'edit':
                return $edit;
                break;
            case 'delete':
                return $del;
                break;
            default:
                return 0;
                break;
        }
    }

    function permission_check_group($group, $module, $action){
        $group = getOneRow('s_group_permissions',"group_id=$group AND permission_name=$module");
        $view = $group['p_view']; $add = $group['p_add'];
        $edit = $group['p_edit']; $del = $group['p_del'];
        switch ($action){
            case 'view':
                return $view;
                break;
            case 'add':
                return $add;
                break;
            case 'edit':
                return $edit;
                break;
            case 'delete':
                return $del;
                break;
            default:
                return 0;
                break;
        }
    }

    function save_log($content,$by){
        global $con;
        global $fdate;
        $fields = array('activity','user_id','date_created');
        $values = array($content,$by,$fdate);
        insertDb('l_activity_logs', $fields, $values);
    }

    function getNames($id){
        $id = decurl($id);
        $user = getOneRow('l_staff',"id='$id'","username");
        return $user['username'];
    }

    function getTotal($table, $condition, $cols){
        global $con;
        $q = "SELECT sum($cols) AS Total FROM $table WHERE $condition";
        $r = mysqli_fetch_assoc(mysqli_query($con, $q));
        if($r['Total']>0){return $r['Total'];}
        else{return 0;}
    }

    function searchTable($table,$condition,$cols='*'){
        global $con;
        $q = "SELECT $cols FROM $table WHERE $condition";
        $r = mysqli_query($con, $q);
        return $r;
    }



    class Auth{
        function getUser($username){
            $q = "SELECT * from l_staff WHERE status='1' AND (email='$username' OR username='$username')";
            $r = runQuery($q);
            return $r;
        }
        function getToken($username,$expired){
            $q = "SELECT * FROM l_token_auth WHERE username='$username' AND is_expired='$expired'";
            $r = runQuery($q);
            return $r;
        }

        function markAsExpired($tokenId){
            return updateDb('l_token_auth',"is_expired='1'","id='$tokenId'");
        }

        function insertToken($username,$random_password_hash,$random_selector_hash,$expiry_date){
            $fds = array('username','password_hash','selector_hash','expiry_date');
            $vals = array("$username","$random_password_hash","$random_selector_hash","$expiry_date");
            $insert = insertDb('l_token_auth',$fds,$vals);
            return $insert;
        }
    }

    class Util{
        public function genToken($length){
            $token="";
            $alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $max = strlen($alpha)-1;
            for($i=0; $i<$length; $i++){
                $token .= $alpha[$this->cryptoR(0,$max)];
            }
            return $token;
        }
        public function cryptoR($min, $max){
            $range = $max - $min;
            if($range < 1){return $min;}
            $log = ceil(log($range, 2));
            $bytes = (int)($log/8)+1; //length in bytes
            $bits = (int)$log+1; //length in bits
            $filter = (int)(1 << $bits) - 1; //Sets all lower bits to 1
            do{
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; //filter and discard irrelevant bits
            }while($rnd >= $range);
            return $min+$rnd;
        }
        public function clearAuthCookie(){
            if(isset($_COOKIE["staff_login"])){
                setcookie("staff_login","");
            }
            if(isset($_COOKIE["random_password"])){
                setcookie("random_password","");
            }
            if(isset($_COOKIE["random_selector"])){
                setcookie("random_selector","");
            }
        }

    }

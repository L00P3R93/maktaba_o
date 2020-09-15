<?php
    $HOST = "localhost";
    $USER = "root"; $PASS = "";
    $DB = "lib_portal";

    $con = mysqli_connect($HOST,$USER,$PASS,$DB) or die("Oops!Something Went Wrong. ".mysqli_connect_error());


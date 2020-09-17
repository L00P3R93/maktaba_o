<?php
    session_start();
    require_once "includes/auth.php";
    if($isLoggedIn){
        header("Location: home?a=d");
    }else{
        header("Location: login");
    }
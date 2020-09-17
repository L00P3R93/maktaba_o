<?php
    require_once 'conn.php';
    require_once 'data.php';

    $auth = new Auth();
    $util = new Util();

    $current_time = time();
    $current_date = date("Y-m-d H:i:s", $current_time);

    //Set Cookie expiration for 1 month
    $cookie_expiration_time = $current_time + (30*24*60*60); //1 month

    $isLoggedIn = false;

    if(!empty($_SESSION["maktaba_"])){
        $isLoggedIn = true;
    }else if(!empty($_COOKIE["staff_login"]) && !empty($_COOKIE["random_password"]) && !empty($_COOKIE["random_selector"])){
        $isPasswordVerified = false;
        $isSelectorVerified = false;
        $isExpiryDateVerified = false;

        $userToken = $auth->getToken($_COOKIE["staff_login"],0);

        if(password_verify($_COOKIE["random_password"],$userToken[0]["password_hash"])){
            $isPasswordVerified = true;
        }
        if(password_verify($_COOKIE["random_selector"],$userToken[0]["selector_hash"])){
            $isSelectorVerified = true;
        }
        if($userToken[0]["expiry_date"] >= $current_date){
            $isExpiryDateVerified = true;
        }

        //Redirect if validation is true for all.
        //Else, mark the token as expired and clear cookies.
        if(!empty($userToken[0]["id"]) && $isPasswordVerified && $isSelectorVerified && $isExpiryDateVerified){$isLoggedIn=true;}
        else{
            if(!empty($userToken[0]["id"])){
                $auth->markAsExpired($userToken[0]["id"]);
            }
            //Clear Cookies
            $util->clearAuthCookie();
        }
    }


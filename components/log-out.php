<?php
    session_start();
    if(isset($_SESSION['maktaba_'])){session_destroy();}
    header('Location: ../login');
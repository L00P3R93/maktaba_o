<!DOCTYPE html>
<html lang="en">
<head>
<?php
    session_start();
    date_default_timezone_set('Africa/Nairobi');
    include 'includes/conn.php';
    include 'includes/data.php';
    include 'controllers/base/meta.php';
    include 'controllers/base/css.php';
?>
    <title><?php echo getPage($_GET['a']) ?> | Maktaba </title>
</head>
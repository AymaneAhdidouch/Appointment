<?php

if ( isset($_POST['logout']) ) {
    session_start();
    session_unset();
    session_destroy();
    header("location: login.php?logout=true");
    exit();
}else{
    header('location: login.php');
    exit();
}
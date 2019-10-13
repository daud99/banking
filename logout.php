<?php
require('config/config.php');
session_start();
if($_SESSION['user']){
    session_unset();
    session_destroy();
    echo "yes";
    $cookie_name = "accounttype";
    setcookie($cookie_name, "", time() - (86400 * 30), "/"); 
    header('location:'.ROOT_URL.'/login.php');
} else {
    $noti = "In order to use TRANCHULAS BANKING you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}

?>
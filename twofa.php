<?php
session_start();
require('config/config.php');
if($_SESSION['user']){
    require('config/db.php');
 if(isset($_POST['Enable'])){
     $id = $_POST['id'];
     $enablefaquery = "UPDATE users SET 2fa='1' WHERE user_id= {$id}";
     if(mysqli_query($connection,$enablefaquery))
    {
        $d = "Two fa authentication is successfully enabled";
        header("location:".ROOT_URL."/setting.php?s=".$d);
    }
    else {
        $e = 'ERROR: '.mysqli_error($connection);
        header("location:".ROOT_URL."/setting.php?e=".$e);
    }
 }
 elseif (isset($_POST['Disable'])) {
    $id = $_POST['id'];
    $enablefaquery = "UPDATE users SET 2fa='0' WHERE user_id= {$id}";
    if(mysqli_query($connection,$enablefaquery))
   {    
        $d = "Two FA authentication is successfully Disabled";
        header("location:".ROOT_URL."/setting.php?s=".$d);
   }
   else {
        $e = 'ERROR: '.mysqli_error($connection);
        header("location:".ROOT_URL."/setting.php?e=".$e);
   }
 }
} else {
    $noti = "In order to use TRANCHULAS SOCIAL SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}

?>
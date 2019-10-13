<?php
session_start();
require('config/config.php');
if(isset($_SESSION['user'])) {
    require('config/db.php');
    if(isset($_POST['submit'])) {
        $name = $_POST['username'];
        $userid = $_POST['userid'];
        $updatequery = "UPDATE users SET username='$name' WHERE user_id= {$userid}";
        if(mysqli_query($connection,$updatequery)){
            if($_SESSION['user']['user_id']==$userid){
                $_SESSION['user']['username'] = $name;
            }
            $success = "Your Info is updated successfully";
            header('location:'.ROOT_URL.'/setting.php?s='.$success);
        } else {
            $error = 'ERROR :'.mysqli_error($connection);
            header('location:'.ROOT_URL.'/setting.php?e='.$error);
        }   
    }
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
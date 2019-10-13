<?php
session_start(); 
require('config/config.php');
if($_SESSION['user']){
    require('config/db.php');
    // $id = $_GET['id'];
    // echo 'current id is'.$currentId;
    if(isset($_POST['submit'])){
        $id = $_POST['userid'];
        $query = "DELETE FROM users WHERE users.user_id={$id}";
        if(mysqli_query($connection,$query))
        {
            $deleteposts = "DELETE FROM documents WHERE documents.user_id=".$id;
            if(mysqli_query($connection,$deleteposts)){
                $noti = "Your account is deleted successfully.";
                session_unset();
                session_destroy();
                header('location:'.ROOT_URL.'/login.php?f='.$noti);
            }
            else{
               $e = 'ERROR: '.mysqli_error($connection);
               header("location:".ROOT_URL."/setting.php?e=".$e);
            }
        }
        else {
            $e = 'ERROR: '.mysqli_error($connection);
            header("location:".ROOT_URL."/setting.php?e=".$e);
        }
    }
    
}
else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}

<?php
session_start();
require('config/config.php');
if($_SESSION['user']){
    require('config/db.php');
    if(isset($_POST['requestloan'])) {
        $amount = $_POST['loanamount'];
        $type = $_POST['loantype'];
        $name = $_SESSION['user']['username'];
        $query = "INSERT INTO loan (username,amount,loantype) VALUES ('$name','$amount','$type')";
        if(mysqli_query($connection,$query)) {
            $success = "Your loan request is sended successfully";
            header('location:'.ROOT_URL.'/service.php?s='.$success);
        } else {
            $error = 'ERROR :'.mysqli_error($connection);
            header('location:'.ROOT_URL.'/service.php?e='.$error);
        }
    }
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
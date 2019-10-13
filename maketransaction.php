<?php
session_start();
require('config/config.php');
if($_SESSION['user']){
    require('config/db.php');
    if(isset($_POST['transfer'])) {
        $to_account_no = $_POST['to_account_no'];
        $amount = (int)$_POST['amount'];
        $from_account_no = $_POST['from_account_no'];
        $validquery = "Select amount FROM users WHERE accountno=".$from_account_no;
        $transferquery = "Select amount FROM users WHERE accountno=".$to_account_no;
        $res = mysqli_query($connection,$validquery);
        $r = mysqli_query($connection,$transferquery);
        $f1 = mysqli_num_rows($res);
        $f2 = mysqli_num_rows($r);
        if($f1<=0 || $f2<=0) {
            if($_SESSION['user']['type'] == "admin"){
                $error = "Invalid Account# is enter";
                header('location:'.ROOT_URL.'/adminmanagment.php?e='.$error);
            } else {
                $error = "Invalid Account# is enter";
                header('location:'.ROOT_URL.'/service.php?e='.$error); 
            }
            echo "yes here";
            die();
        }
        $t = mysqli_fetch_assoc($res);
        $tt = mysqli_fetch_assoc($r);
        $toamount = (int)$tt['amount'];
        echo "current bank amount is : ".$t['amount'];
        $currentamount = (int)$t['amount'];
        if($currentamount>$amount) {
            if($to_account_no != $from_account_no) {
                $newamount = $currentamount - $amount;
                $updatequery = "UPDATE users SET amount='$newamount' WHERE accountno= {$from_account_no}";
                if(mysqli_query($connection,$updatequery)){
                    if($_SESSION['user']['amount']==$currentamount){
                        $_SESSION['user']['amount'] = $newamount;
                    }
                    $tonewamount = $toamount + $amount;
                    $updatequery1 = "UPDATE users SET amount='$tonewamount' WHERE accountno= {$to_account_no}";
                    if(mysqli_query($connection,$updatequery1)){
                        $query = "INSERT INTO transaction (from_accountno,to_accountno,amount) VALUES ('$from_account_no','$to_account_no','$amount')";
                        if(mysqli_query($connection,$query)){
                            // echo "success";
                            if($_SESSION['user']['type'] == "admin"){
                                $success = "The amount is transfered successfully";
                                header('location:'.ROOT_URL.'/adminmanagment.php?s='.$success);
                            } else {
                                $success = "The amount is transfered successfully";
                                header('location:'.ROOT_URL.'/service.php?s='.$success);
                            }
                           
                        } else {
                            if($_SESSION['user']['type'] == "admin"){
                                $error = 'ERROR :'.mysqli_error($connection);
                                header('location:'.ROOT_URL.'/adminmanagment.php?e='.$error);
                            } else {
                                $error = 'ERROR :'.mysqli_error($connection);
                                header('location:'.ROOT_URL.'/service.php?e='.$error);
                            }
                            
                        }
                    }
                } else {
                    if($_SESSION['user']['type'] == "admin"){
                        $error = 'ERROR :'.mysqli_error($connection);
                        header('location:'.ROOT_URL.'/adminmanagment.php?e='.$error);
                    } else {
                        $error = 'ERROR :'.mysqli_error($connection);
                        header('location:'.ROOT_URL.'/service.php?e='.$error);
                    }
                    
                }
            } else {
                if($_SESSION['user']['type'] == "admin"){
                    $error = "You cannot do transaction to your own account LOLzzz!";
                    header('location:'.ROOT_URL.'/adminmanagment.php?e='.$error);
                } else {
                    $error = "You cannot do transaction to your account LOLzzz!";
                    header('location:'.ROOT_URL.'/service.php?e='.$error);
                }
                
            }
        } else {
            if($_SESSION['user']['type'] == "admin"){
                $error = "You do not have sufficient balance to make this transaction";
                header('location:'.ROOT_URL.'/adminmanagment.php?e='.$error);
            } else {
                $error = "You do not have sufficient balance to make this transaction";
                header('location:'.ROOT_URL.'/service.php?e='.$error);
            }
           
            // echo "failed";
        }
        
    }
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
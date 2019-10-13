<?php
require('config/config.php');
echo $_SERVER['DOCUMENT_ROOT'];
// die();
session_start();
if($_SESSION['user']){
    require('config/db.php');
    if(isset($_GET['documentid'])){
        $documentid = $_GET['documentid'];
    }
    // echo $documentid;
    // die();
    // if(unlink('C:/xampp/htdocs/banking/uploads/a.txt')){
       
    // }
    $deletedocument = "DELETE FROM documents WHERE documents.document_id=".$documentid;
    if(mysqli_query($connection,$deletedocument)){

        $s =  "Your document is deleted successfully";
        header('location:'.ROOT_URL.'/showdocument.php?userid='.$_SESSION['user']['user_id']);
        
    }
    else{
        $e = 'ERROR: '.mysqli_error($connection);
        header('location:'.ROOT_URL.'/showdocument.php?userid='.$_SESSION['user']['user_id']);
    }
    
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
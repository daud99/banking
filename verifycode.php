<?php
session_start();
require('config/config.php');
if($_SESSION['accountno']){
require('config/db.php');
$accountno = $_SESSION['accountno'];
$result=mysqli_query($connection,"SELECT * FROM users WHERE accountno= '{$accountno}'");
$row = mysqli_fetch_array($result); 
$currentuserid = $row['user_id'];
$currentusername=$row['username'];
$currentaccountno=$row['accountno'];
$currentpassword=$row['password'];
$currenttype = $row['usertype'];
$currentfa = $row['2fa'];
$currentamount = $row['amount'];
if(isset($_POST['verify'])){
    echo "request is received";
    $code = $_POST['vc'];
    echo 'code we recived form field id: '.$code;
    echo "code in session is: ".$_SESSION['verification_code'];
    if($code == $_SESSION['verification_code']){
        $userarray=array('user_id'=>$currentuserid,'username'=>$currentusername,'accountno'=>$currentaccountno,'password'=>$currentpassword,'type'=>$currenttype,'fa'=>$currentfa,'amount'=>$currentamount);
        $_SESSION['user'] = $userarray;
        $cookie_name = "accounttype";
        $cookie_value = $_SESSION['user']['type'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        header('location:'.ROOT_URL.'/index.php');
    }
    else {
        $e = "Your verification code is wrong please try again";
    }
}
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="img/tt.png">
    <link rel="stylesheet" href="css/sendmail.css">
</head>

<body>
    <div id="index-jumbotron" class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-2">TRANCHULAS</h1>
            <h3 id="small-text" class="display-4">we’d love to see you here</h3>
        </div>
    </div>
    <div class="container">
        <div class="text-center">
            <h1 class="text-muted">Your verification code is sended to the mail associated with your account.</h1>
            <p>If email is not found kindly check it in the spam folder.</p>
            <form action="verifycode.php" method="POST">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <input id="inputcode" type="number" name="vc" minlength="4" class="form-control"
                            placeholder="Enter code here....." required>
                    </div>
                </div>
                <div class="row">
                    <div id="vbtn" class="mt-2 col-md-2 offset-md-5">
                        <input type="submit" value="Verify" name="verify" class="form-control btn btn-dark">
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        $(document).ready(function(){
            var vc = "<?php echo $_SESSION['verification_code']; ?>";
            console.log("Verification code: "+vc);
        });
    </script>
</body>
</html>
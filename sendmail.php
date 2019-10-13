<?php
session_start();
require('config/config.php');
use PHPMailer\PHPMailer\PHPMailer;
if($_SESSION['email']){
    function randomNumber($length) {
        $result = '';
    
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
    
        return $result;
    }
    $rndnum = randomNumber(4);
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    require 'phpmailer/src/Exception.php';
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail-> isHTML();
    $mail->Username = 'daudahmed8700@gmail.com';
    $mail->Password = 'daud585414';
    $mail->setFrom('tranchulas@no-reply.com');
    $mail->Subject = 'Verification code from TRANCHULAS';
    // echo "code that is send is :".$rndnum;
    $mail->Body = "Please enter this code in order to logged in successfully in TRANCHULAS SOCIAL SITE"."\n"."Your verication code is: ".$rndnum;
    $_SESSION['verification_code'] = $rndnum;
    $email = $_SESSION['email'];
    $email = "$email";
    // echo $email;
    $mail->addAddress($email);
;;
    // $mail->Send();
    
    // echo "welcome to the sendmail page";
}else {
    $noti = "In order to use TRANCHULAS BANKING SITE you must logged in first.";
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
                    <div class="mt-2 col-md-2 offset-md-5">
                        <input id="vbtn" type="submit" value="Verify" name="verify" class="form-control btn btn-dark">
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        $(document).ready(function(){
            var vc = "<?php echo $rndnum; ?>";
            console.log("Verification code: "+vc);
        });
    </script>
</body>
</html>
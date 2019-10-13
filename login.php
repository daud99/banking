<?php
session_start();
require('config/config.php');

if(!isset($_SESSION['user'])){
    $error = null;    
    require('config/db.php');
    if(isset($_GET['f'])) {
        $error = $_GET['f'];
    }
    $username = '';
    $password = '';
    if(isset($_POST['login'])) {
        
        $accountno =mysqli_real_escape_string($connection,$_POST['accountno']);
        $password = mysqli_real_escape_string($connection,$_POST['pass']);
        $_SESSION['accountno'] = $_POST['accountno'];
        // echo $username.$password;
        $result=mysqli_query($connection,"SELECT * FROM users WHERE accountno = '{$accountno}'");
        $row = mysqli_fetch_array($result); 
        if(is_null($row)){
           $error = "Account# doesn't exist";
           echo "User doesn't exist";
        }
        else {
               $currentuserid = $row['user_id'];
               $currentusername=$row['username'];
               $currentaccountno=$row['accountno'];
               $currentpassword=$row['password'];
               $currenttype = $row['usertype'];
               $currentfa = $row['2fa'];
               $currentamount = $row['amount'];
               $_SESSION['email'] = $row['email'];
               // echo "currenttype is :".$currenttype;
               // die();
            //    echo "password enter is:".$password;
            //    echo "password to match with:".$currentpassword;
            //    echo "result is ".password_verify($password,$currentpassword);
        if($accountno==$currentaccountno&&password_verify($password,$currentpassword)==1) {  
           echo 'you are successfully loggedin';
           if($currentfa == 0){
               $userarray=array('user_id'=>$currentuserid,'username'=>$currentusername,'accountno'=>$currentaccountno,'password'=>$currentpassword,'type'=>$currenttype,'fa'=>$currentfa,'amount'=>$currentamount);
               $_SESSION['user'] = $userarray;
               $cookie_name = "accounttype";
               $cookie_value = $_SESSION['user']['type'];
               setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
               header('location:'.ROOT_URL.'/index.php');
           }
           else{
               
               header('location:'.ROOT_URL.'/sendmail.php');
           }
        }
        else if($accountno==$currentaccountno&&password_verify($password,$currentpassword)==null) {  
            $error = "Password doesn't match";   
            echo "Password doesn't match";      
        }
        }
    }
} else {
    echo "You are already logged in";
    // header('location:'.ROOT_URL.'/index.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>TRANCHULAS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="static/tt.png">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/util.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="container">
                <?php if($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?php echo $error; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                    class="login100-form validate-form flex-sb flex-w">
                    <span class="login100-form-title p-b-32">
                        Account Login
                    </span>

                    <span class="txt1 p-b-11">
                        Account #
                    </span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
                        <input class="input100" type="number" name="accountno" value="<?php echo $accountno;?>" placeholder="Account No." required>
                        <span class="focus-input100"></span>
                    </div>

                    <span class="txt1 p-b-11">
                        Password
                    </span>
                    <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                        <span class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </span>
                        <input class="input100" type="password" name="pass" value="<?php echo $password; ?>" placeholder="Password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-48">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt3">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" name="login" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>
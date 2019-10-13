<?php
require("inc/navbar.php");
require('config/config.php');
if($_SESSION['user']) {
    $error = null;    
    if(isset($_GET['f'])) {
        $error = $_GET['f'];
    }
    if(isset($_COOKIE['accounttype'])) {
        if($_COOKIE['accounttype'] == "admin"){
        
            $cookie_name = "accounttype";
            $cookie_value = "admin";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            //header('location:'.ROOT_URL.'/home.php');
            $_SESSION['user']['type'] = 'admin';
           
        }  else {
          
            $cookie_name = "accounttype";
            $cookie_value = "customer";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            $_SESSION['user']['type'] = 'customer';
            //header('location:'.ROOT_URL.'/home.php');
            
        }
    }
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
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
<section class="home_banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="banner_content text-center">
                <h3>Protecting your <br />Data&Dollar</h3>
                <h5>Let our expert hackers secure your business by
                    discovering security vulnerabilities before others do.</h5>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Offer Area =================-->
<section class="offer_area p_120">
    <div class="container">
        <div class="offer_title">
            <h5>What we offer for you</h5>
            <p>We offer a comprehensive set of both offensive and defensive cyber solutions through our world-class research capabilities that are focused on finding technology flaws.</p>
        </div>
    </div>
</section>
<!--================End Offer Area =================-->

<!--================ start footer Area  =================-->
<?php require('inc/footer.php'); ?>
<?php
    session_start();
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

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/tt.png" type="image/png">
        <title>TRANCHULAS</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/responsive.css">
		<link rel="stylesheet" href="css/setting.css">
		<link rel="stylesheet" href="css/sendmail.css">
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="index.php"><img src="img/t.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="/banking/index.php">Home</a></li>
								<?php if($_SESSION['user']['type'] == 'customer'): ?>  
								<li class="nav-item"><a class="nav-link" href="/banking/service.php?an=<?php echo $_SESSION['user']['accountno']; ?>">Services</a></li>
								<?php endif; ?>
								<?php if($_SESSION['user']['type'] == 'admin'): ?>  
								<li class="nav-item"><a class="nav-link" href="/banking/adminmanagment.php">Managment</a></li>
								<?php endif; ?>
								<?php if($_SESSION['user']['type'] == 'customer'): ?>
								<li class="nav-item"><a class="nav-link" href="/banking/document.php">Supporting Documents</a></li>
								<?php endif; ?>
								<?php if($_SESSION['user']): ?>
								<li class="nav-item submenu dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']['username']; ?></a>
									<ul class="dropdown-menu">
										<li class="nav-item"><a class="nav-link" href="setting.php">Settings</a></li>
										<li class="nav-item"><a class="nav-link" href="/banking/showdocument.php?userid=<?php echo $_SESSION['user']['user_id'];?>">Show Documents</a></li>
									</ul>
								</li> 
								<?php endif; ?>
								
								<?php if($_SESSION['user']): ?>
								<li class="nav-item"><a class="nav-link" href="/banking/logout.php">Logout</a></li>
								<?php elseif(!$_SESSION['user']): ?>
								<li class="nav-item"><a href="/banking/login.php">Login</a></li>	
								<?php endif; ?></li>
								<?php if($_SESSION['user']['type'] == 'customer'): ?>
								<li class="nav-item"><a class="nav-link" href="/banking/faq.php?qid=1">FAQ's</a></li>
								<?php endif; ?>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="nav-item"><a href="#" class="search"><i class="lnr lnr-magnifier"></i></a></li>
							</ul>
						</div> 
					</div>
            	</nav>
            </div>
        </header>
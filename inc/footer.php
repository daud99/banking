<footer class="footer-area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">About Tranchulas</h6>
                            <p>We offer a comprehensive set of both offensive and defensive cyber solutions through our world-class research capabilities that are focused on finding technology flaws.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Navigation Links</h6>
                            <div class="row">
                                <div class="col-4">
                                    <ul class="list">
                                        <li><a href="/banking/index.php">Home</a></li>
                                        <li><a href="/banking/service.php?an=<?php echo $_SESSION['user']['accountno']; ?>">Services</a></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    
                                </div>										
                            </div>							
                        </div>
                    </div>												
                </div>
                <div class="border_line"></div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-md-8 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Daud Ahmed</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    <div class="col-lg-4 col-md-4 footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </footer>
		<!--================ End footer Area  =================-->
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope-min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendors/counter-up/jquery.counterup.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/theme.js"></script>
        <script>
$(document).ready(function(){

    $("#transferamountbtn").click(function(){
        $('#maketransactiondiv').css('display','block');
        $('#transactionhistorydiv').css('display','none');
        $('#currentaccountstatusdiv').css('display','none');
        $('#loanrequestdiv').css('display','none');
    });
    $('#transactionhistorybtn').click(function(){
        $('#maketransactiondiv').css('display','none');
        $('#transactionhistorydiv').css('display','block');
        $('#currentaccountstatusdiv').css('display','none');
        $('#loanrequestdiv').css('display','none');
    });
    $('#currentaccountstatusbtn').click(function(){
        $('#maketransactiondiv').css('display','none');
        $('#transactionhistorydiv').css('display','none');
        $('#currentaccountstatusdiv').css('display','block');
        $('#loanrequestdiv').css('display','none');
    });
    $('#loanrequestbtn').click(function(){
        $('#maketransactiondiv').css('display','none');
        $('#transactionhistorydiv').css('display','none');
        $('#currentaccountstatusdiv').css('display','none');
        $('#loanrequestdiv').css('display','block');
    });
    $('#editbtn').click(function(){
        // alert('hey');
        $('#profileinfo').css('display', 'none');
        $('#editform').css('display', 'block');
    });
    $('#1').click(function(){
        $('#showinfo').css('display','block');
        $('#fa').css('display','none');
        $('#deleteview').css('display','none');
        $('#setting-heading').html('General Settings');
    });
    $('#3').click(function(){
        $('#showinfo').css('display','none');
        $('#fa').css('display','block');
        $('#deleteview').css('display','none');
        $('#setting-heading').html('Enable 2FA');
    });
    $('#2').click(function(){
        $('#showinfo').css('display','none');
        $('#fa').css('display','none');
        $('#deleteview').css('display','block');
        $('#setting-heading').html('Delete Account');
    });
});
$('input[type="file"]').change(function(e){
var fileName = e.target.files[0].name;
$('#filename').html(fileName);
});



</script>
    </body>
</html>
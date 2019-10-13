<?php
require('inc/navbar.php');
require('config/config.php');
if(isset($_SESSION['user'])){
    require('config/db.php');

    if(isset($_GET['qid'])){
        $qid = $_GET['qid'];
        $q = "SELECT answer FROM faq WHERE faq_id=".$qid;
        $res = mysqli_query($connection,$q);
        $q = mysqli_fetch_assoc($res);
        $answer = $q['answer'];
        
    } 
        $query = "SELECT faq_id,question FROM faq";
        $r = mysqli_query($connection,$query);
        $qs = mysqli_fetch_all($r, MYSQLI_ASSOC);
    
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}

?>
<div class="container">
    <div class="mt-5 mb-2">
        <h2 class="text-center text-muted mt-5 mb-4">
            Frequently Asked Question's
        </h2>
    </div>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content" id="faq-tab-content">
                <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                    <?php foreach($qs as $q): ?>
                    <div class="accordion mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                    <button id="<?php echo $q['faq_id']."aa"; ?>" class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#accordion-tab-1-content-1" aria-expanded="false"
                                        aria-controls="accordion-tab-1-content-1"><a href="/banking/faq.php?qid=<?php echo $q['faq_id']; ?>"><strong>Question: </strong><?php echo $q['question']; ?></a></button>
                                </h5>
                            </div>
                            <div class="hideanswer" id="<?php echo $q['faq_id']; ?>"
                                aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                                <div class="card-body">
                                    <p id=""><strong>Answer:</strong><?php echo $answer; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('inc/footer.php'); ?>
<script>
    $(document).ready(function(){
        $('#<?php echo $qid; ?>').css('display','block');
    });
</script>
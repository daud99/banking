<?php
require('inc/navbar.php'); 
require('config/config.php');
if($_SESSION['user']){
    $error = null;
    $success = null;
    $no = null;
    
    if(isset($_GET['e'])){
        $error = $_GET['e'];
    }

    if(isset($_GET['an'])){
        $no = $_GET['an'];
    }
    if(isset($_GET['s'])){
        $success = $_GET['s'];
         header('location:'.ROOT_URL.'/service.php?an='.$_SESSION['user']['accountno']);
    }
    require('config/db.php');
    $q = "SELECT * FROM transaction WHERE to_accountno = {$no} OR from_accountno = {$no}";
    $r = mysqli_query($connection,$q);
    $transactions = mysqli_fetch_all($r, MYSQLI_ASSOC);
    // $query = "Select amount FROM users WHERE user_id=".$_SESSION['user']['user_id'];
    // $res = mysqli_query($connection,$query);
    // $t = mysqli_fetch_assoc($res);
    // $currentbalance = $t['amount'];
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="service.html">Services</a>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a id="transferamountbtn" class="form-control btn btn-default"><strong>Transfer
                                    Amount</strong></a>
                        </div>
                        <div class="col-md-3">
                            <a id="transactionhistorybtn" class="form-control btn btn-default"><strong>Transaction
                                    History</strong></a>
                        </div>
                        <div class="col-md-3">
                            <a id="currentaccountstatusbtn" class="form-control btn btn-default"><strong>Current Account
                                    Status</strong></a>
                        </div>
                        <div class="col-md-3">
                            <a id="loanrequestbtn" class="form-control btn btn-default"><strong>Loan
                                    Request</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Offer Area =================-->
<section class="offer_area p_120">
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
    <div class="container">
        <?php if($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $success; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
    </div>
    <div id="maketransactiondiv">
        <h2 class="text-center text-muted mb-5">Transfer Amount</h2>
        <div class="container">
            <form action="maketransaction.php" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <h1>Transfer to:</h1>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="to_account_no" placeholder="Enter account# you want to transfer"
                            class="form-control" required>
                        <input type="hidden" name="from_account_no" value="<?php echo $_SESSION['user']['accountno'];?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h1>Enter Amount:</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="number" name="amount" class="form-control d-none d-xl-block"
                                placeholder="Enter Amount you want to transfer" required>
                            <div class="input-group-addon d-none d-xl-block">
                                $
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-4">
                        <input type="submit" name="transfer" value="TRANSFER" class="btn btn-primary form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="transactionhistorydiv">
        <h2 class="text-center text-muted mb-5">Transaction History</h2>
        <div class="container">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">Transfer From Account#</th>
                        <th scope="col">Transfer To Account#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction ): ?>
                    <tr>
                        <th scope="row"><?php echo $transaction['transaction_id'];?></th>
                        <td><?php echo $transaction['from_accountno'];?></td>
                        <td><?php echo $transaction['to_accountno']; ?></td>
                        <td><?php echo $transaction['amount']; ?></td>
                        <td><?php echo $transaction['done_at']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="currentaccountstatusdiv">
        <h2 class="text-center text-muted mb-5">Current Account Status</h2>
        <div class="container">
            <div class="text-center">
                <div class="display-4">Your current account balance is:
                    <strong><?php echo $_SESSION['user']['amount']; ?>$</strong></div>
            </div>
        </div>
    </div>
    <div id="loanrequestdiv">
        <h2 class="text-center text-muted mb-5">Loan Request</h2>
        <div class="container">
            <form action="loanrequest.php" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <h1>Loan Amount:</h1>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="loanamount" placeholder="Enter amount for loan" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <select name="loantype" class="form-control" required>
                            <option value="home">Home</option>
                            <option value="bussiness">Bussiness</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-3 offset-md-5">
                        <input type="submit" name="requestloan" value="Request" class="btn btn-primary form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Offer Area =================-->
<?php require('inc/footer.php'); ?>
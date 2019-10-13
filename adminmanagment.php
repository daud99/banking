<?php 
require('inc/navbar.php');
require('config/config.php');
if($_SESSION['user']['type'] == 'admin'){
    $error = null;
    $success = null;
    if(isset($_GET['e'])){
        $error = $_GET['e'];
    }
    if(isset($_GET['s'])){
        $success = $_GET['s'];
    }
    
    require('config/db.php');
    $q = "SELECT * FROM transaction";
    $r = mysqli_query($connection,$q);
    $transactions = mysqli_fetch_all($r, MYSQLI_ASSOC);
    $query = "SELECT * FROM users";
    $res = mysqli_query($connection,$query);
    $us = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $qu = "SELECT * FROM loan";
    $re = mysqli_query($connection,$qu);
    $ls = mysqli_fetch_all($re, MYSQLI_ASSOC);
} else {
    $noti = "You do not have the right to access this page.";
    header('location:'.ROOT_URL.'/index.php?f='.$noti);
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
                            <a id="transactionhistorybtn" class="form-control btn btn-default"><strong>Transactions
                                    History</strong></a>
                        </div>
                        <div class="col-md-3">
                            <a id="currentaccountstatusbtn" class="form-control btn btn-default"><strong>Current Accounts
                                    Status</strong></a>
                        </div>
                        <div class="col-md-3">
                            <a id="loanrequestbtn" class="form-control btn btn-default"><strong>Loan
                                    Requests</strong></a>
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
                        <h1>Transfer From:</h1>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="from_account_no" placeholder="Enter account# you want to transfer from"
                            class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h1>Transfer to:</h1>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="to_account_no" placeholder="Enter account# you want to transfer to"
                            class="form-control" required>
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
    <h2 class="text-center text-muted mb-5">Account Status</h2>
        <div class="container">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">User Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Account#</th>
                        <th scope="col">Current Amount</th>
                        <th scope="col">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($us as $u ): ?>
                    <tr>
                        <th scope="row"><?php echo $u['user_id'];?></th>
                        <td><?php echo $u['username'];?></td>
                        <td><?php echo $u['accountno']; ?></td>
                        <td><?php echo $u['amount']; ?></td>
                        <td><?php echo $u['password']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="loanrequestdiv">
    <h2 class="text-center text-muted mb-5">Loan Requests</h2>
        <div class="container">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Loan Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Request Amount</th>
                        <th scope="col">Loan Type</th>
                        <th scope="col">Loan Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ls as $l): ?>
                    <tr>
                        <th scope="row"><?php echo $l['loan_id'];?></th>
                        <td><?php echo $l['username'];?></td>
                        <td><?php echo $l['amount']; ?></td>
                        <td><?php echo $l['loantype']; ?></td>
                        <?php if($l['loanstatus'] == 0): ?>
                        <td>Pending</td>
                        <?php endif; ?>
                        <?php if($l['loanstatus'] == 1): ?>
                        <td>Approve</td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--================End Offer Area =================-->


<?php require('inc/footer.php'); ?>
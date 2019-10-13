<?php
require('config/config.php');
require('inc/navbar.php');
if($_SESSION['user']){
    require('config/db.php');
    $error = null;
    $success = null;
    if(isset($_GET['e'])){
        $error = $_GET['e'];
    }
    if(isset($_GET['s'])){
        $success = $_GET['s'];
    }
    $q = "SELECT 2fa FROM users WHERE user_id=".$_SESSION['user']['user_id'];
    $res = mysqli_query($connection,$q);
    $fastatus = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    mysqli_close($connection);
    // print_r($fastatus);
    if($fastatus['2fa'] == 0){
        $b = "Enable";
    }
    else{
        $b = "Disable";
    }
} else {
    $noti = "In order to use TRANCHULAS Banking SITE you must logged in first.";
    header('location:'.ROOT_URL.'/login.php?f='.$noti);
}
?>
<div class="container-fluid">
    <div class="row">
        <div id="sidebar" class="col-md-3">
            <h4 id="1">Profile Information</h4>
            <br>
            <h4 id="2">Delete Account</h4>
            <br>
            <h4 id="3">Security and login</h4>
        </div>
        <div id="content" class="col-md-9">
            <div class="text-center">
                <h1><strong id="setting-heading">General Settings</strong></h1>
            </div>
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
            <div class="container">
                <div id="showinfo">
                    <div id="profileinfo">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Username:
                                <strong><?php echo $_SESSION['user']['username']; ?></strong>
                            </li>
                            <li class="list-group-item">Balance:
                                <strong><?php echo $_SESSION['user']['amount']; ?></strong></li>
                            <li class="list-group-item">Account#:
                                <strong><?php echo $_SESSION['user']['accountno']; ?></strong></li>
                            <li class="list-group-item">User Type:
                                <strong><?php echo $_SESSION['user']['type']; ?></strong></li>
                        </ul>
                        <div class="float-right mt-4 mb-4">
                            <button id="editbtn" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                    <div id="editform">
                        <form action="updateuser.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" name="username" class="form-control" aria-describedby="emailHelp"
                                    placeholder="Enter Username" value="<?php echo $_SESSION['user']['username']; ?>"
                                    required="">
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['user']['user_id'];?>">
                            </div>
                            <div class="float-right">
                                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="deleteview">
                    <h1 class="display-8 text-muted">
                        Are you sure to delete your account if you click the "DELETE" then you will not be able to logged in using this account as well as lost all the cerrosponding data associated with your account?
                    </h1>
                    <form action="deleteaccount.php" method="POST" class="text-center">
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['user']['user_id']; ?>">
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <div id="fa" class="mb-4">
                    <div class="card mt-4">
                        <div class="card-header">
                            Two-factor authentication
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Use Two-factor Authentication</h5>
                            <p class="card-text">We will ask for security code after login that will be send to the
                                your
                                account associated email you have to submit the code sended to your email in order
                                to
                                use
                                the app successfully.</p>
                            <form action="twofa.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $_SESSION['user']['user_id']; ?>">
                                <button id="changebtn" name="<?php echo $b; ?>" type="submit"
                                    class="btn btn-primary"><?php echo $b; ?></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('inc/footer.php'); ?>
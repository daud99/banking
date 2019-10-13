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
    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];
    }
    if($_SESSION['user']['type'] == 'customer'){
        $query = "SELECT document_id,url FROM documents WHERE user_id=".$userid;
        $r = mysqli_query($connection,$query);
        $documents = mysqli_fetch_all($r, MYSQLI_ASSOC);
    } else {
        $query = "SELECT * FROM documents";
        $r = mysqli_query($connection,$query);
        $documents = mysqli_fetch_all($r, MYSQLI_ASSOC);
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
<div class="text-center">
    <h1><strong id="setting-heading">Your Supporting Documents</strong></h1>
</div>
 <?php if($documents): ?>
<div class="container">
    <ul class="list-group list-group-flush">
        <?php if($_SESSION['user']['type'] == 'customer'): ?>
        <?php foreach ($documents as $document ): ?>
        <li class="list-group-item">
            <strong><a href="<?php echo "/banking/".$document['url']; ?>"><?php echo $document['url']; ?></a></strong>
            <div class="float-right">
                <a href="deletedocument.php?documentid=<?php echo $document['document_id']; ?>&documentname=<?php echo $document['url']; ?>"><input type="submit"
                        name="delete" value="DELETE" class="btn"></a>
            </div>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php if($_SESSION['user']['type'] != 'customer'): ?>
        <h2 class="text-center text-muted mb-5">All Documents</h2>
        <div class="container">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Document Id</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Document</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($documents as $document ): ?>
                    <tr>
                        <th scope="row"><?php echo $document['document_id'];?></th>
                        <td><?php echo $document['user_id'];?></td>
                        <td><?php echo $document['url']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </ul>
</div>
<?php else: ?>
<div class="container mt-5">
<h3>You have uploaded no supporting documnets yet!</h3>
</div>
<?php endif; ?>
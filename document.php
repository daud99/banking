<?php 
require('config/config.php');
require('inc/navbar.php');
if($_SESSION['user']){
    $error = null;
    $success = null;
    if(isset($_GET['f'])) {
        $success = $_GET['f'];
    }
    if(isset($_GET['e'])) {
        $error = $_GET['e'];
    }
    require('config/db.php');
    if(isset($_POST['submit'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];  
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        if($fileError === 0){
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = 'uploads/'.$fileNameNew;
            // extension is the extension of the file.
            move_uploaded_file($fileTmp,$fileDestination);
            $userid = $_SESSION['user']['user_id'];
            // print_r($_SESSION['user']);
    
            $u = $_SESSION['user']['username'];
            $query = "INSERT INTO documents (user_id,url) VALUES ('$userid','$fileDestination')";
            $a=mysqli_query($connection,$query);
            if($a)
            {   
                $f = "Your image is successfully uploaded";
                header('location:'.ROOT_URL.'/document.php?f='.$f); 
            }
            else
            {
                $e = 'ERROR :'.mysqli_error($connection);
                header('location:'.ROOT_URL.'/document.php?e='.$e);
            }            
        }
        else {
            $e = "ERROR : There is error uploading file. Try again";
            header('location:'.ROOT_URL.'/document.php?e='.$e);
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
<div class="container mb-5">
    <div class="mt-5 mb-2">
        <h2 class="text-center text-muted mt-5 mb-2">
            UPLOAD YOUR SUPPORTING DOCUMENTS
        </h2>
    </div>
    <div>
    <section class="mt-4">
        <div class="container">
            <div class="card">
                <h5 class="card-header">Share your Document</h5>
                <div class="card-body">
                    <h5 class="card-title">Hey <?php echo $_SESSION['user']['username']."!"; ?></h5>
                    <p class="card-text">Share your document so that it can help us identify you better.</p>
                    <form action="document.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <div class="custom-file">
                                <!-- <input type="file" name="file"> -->
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01" required="">
                                <label class="custom-file-label" id="filename" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 offset-md-9">
                                <input class="form-control btn btn-primary" id="uploadbtn" type="submit" name="submit" value="Upload" >
                            </div>      
                                <!-- <span class="input-group-text" id="inputGroupFileAddon01" type="submit" name="submit">Upload</span> -->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    </div>
</div>
<?php require('inc/footer.php'); ?>

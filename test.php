 <?php
$hashedpass = password_hash("admin", PASSWORD_DEFAULT);
$verify = password_verify('admin',$hashedpass);
if($verify == 1){
 echo 'success';   
} 
if($verify == null){
    echo "fail";
}
?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>

 <body>
     <form method="GET">
         <input type="text" name="name">
         <input type="submit">
     </form>
     <p>
         hey
     </p>

     <p>hey how are you \r are you fine \n i am not been able to see you.</p>
     <h1 hey how are you </p> This is going to be in h1 tag
 </body>

 </html>
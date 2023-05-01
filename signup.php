<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
include 'partials/_dbconnect.php';
$username=$_POST["username"];
$password=$_POST["password"];
$cpassword=$_POST["cpassword"];
//$exists=false;
//check whether this username exists
$existSql="SELECT * FROM `users` WHERE username='$username'";
$result=mysqli_query($conn,$existSql);
$numExistRows=mysqli_num_rows($result);
if($numExistRows>0){
  //$exists=true;
  $showError="User name already exists";
}
else{
  //$exists=false;
if(($password==$cpassword)){
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $sql="INSERT INTO `users` ( `username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp())"; 
  $result=mysqli_query($conn,$sql);

  if($result){
    $showAlert=true;
  }
}
else{
  $showError="Password do not match";
}
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
    if($showAlert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created and you can login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>'.$showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
?>
   <div class="container">
    <h1 class="text-center">Signup to our website</h1>
    <form action="/rinku/loginsystem/signup.php" method="post">
  <div class=" form-group mb-3 ">
    <label for="username" >Username</label>
    <input type="text" maxlength="11" class="form-control" id="username" name="username">
  </div>
  <div class="form-group mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" maxlength="23" class="form-control" id="password" name="password">
  </div>
  <div class="form-group mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to type the same password</div>
  </div>
  
  <button type="submit" class="btn btn-primary ">SignUP</button>
</form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
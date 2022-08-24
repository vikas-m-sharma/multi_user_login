<?php
require('db.php');
if(isset($_SESSION['isUserLoggedIn'])){
  if($_SESSION['role']=="customer"){
      echo "<script>window.location.href='customer.php?user_already_logged_in';</script>";
  }
  
  if($_SESSION['role']=="admin"){
      echo "<script>window.location.href='admin.php?user_already_logged_in';</script>";
  }
  }
if(isset($_POST['register'])){
  $query="SELECT * FROM customers WHERE email_id='{$_POST['emailid']}'";
  $run = mysqli_query($db,$query);
  $data = mysqli_fetch_array($run);
  if(count($data)>0){
  echo "<script>window.location.href='register.php?user_already_registered';</script>";
  }else{
    $password = crypt($_POST['password'],"ilovemyindiaabcdefg123456");
    $query="INSERT INTO customers (full_name,email_id,password,role)";
    $query.="VALUES ('{$_POST['fullname']}','{$_POST['emailid']}','$password','customer')";

  $run = mysqli_query($db,$query);
  if($run){
  echo "<script>window.location.href='index.php?user_registered_successfully';</script>";

  }

  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Register</title>
</head>
<body>
  <div class="main">
      <div class="login-box">
          <h1>Register</h1>
          <?php if(isset($_GET['user_already_registered'])){
              ?>
          <p style="color:red;text-align:center;">Email Id already registered !</p>

              <?php
          }
          ?>
          <form method="post">
            <input type="text" name="fullname" placeholder="Enter Full Name..." class="input" required>

              <input type="email" name="emailid" placeholder="Enter Email Id..." class="input" required>
              <input type="password" name="password" placeholder="Enter Password..." class="input">
              <div class="row" required>
              <a href="index.php" class="register-btn">Login</a><input type="submit" value="Register" name="register" class="login-btn">
              </div>

          </form>
      </div>
  </div>  
</body>
</html>
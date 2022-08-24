<?php
require('db.php');
if (isset($_SESSION['isUserLoggedIn'])) {
    if ($_SESSION['role'] == "customer") {
        echo "<script>window.location.href='customer.php?user_already_logged_in';</script>";
    }

    if ($_SESSION['role'] == "admin") {
        echo "<script>window.location.href='admin.php?user_already_logged_in';</script>";
    }
}
if (isset($_POST['login'])) {
    // print_r($_POST);
    $password = crypt($_POST['password'], "ilovemyindiaabcdefg123456");

    $query = "SELECT * FROM customers WHERE email_id='{$_POST['emailid']}' AND password='$password'";
    $run = mysqli_query($db, $query);
    $data = mysqli_fetch_array($run);
    if (count($data) > 0) {
        $_SESSION['isUserLoggedIn'] = true;        $_SESSION['emailId'] = $_POST['emailid'];        $_SESSION['role'] = $data['role'];
        if ($data['role'] == "customer") {
            echo "<script>window.location.href='customer.php?user_loggedin';</script>";        }
        if ($data['role'] == "admin") {
            echo "<script>window.location.href='admin.php?user_loggedin';</script>";        }


    }
    else {        echo "<script>window.location.href='index.php?incorrect_email_or_password';</script>";

    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<body>
  <div class="main">
      <div class="login-box">
          <h1>Login</h1>
          <?php if (isset($_GET['incorrect_email_or_password'])) {
?>
          <p style="color:red;text-align:center;">Incorrect Email or Password !</p>

              <?php
}
?>

<?php if (isset($_GET['user_registered_successfully'])) {
?>
          <p style="color:green;text-align:center;">User registered Successfully !</p>

              <?php
}
?>

          <form method="post">
              <input type="email" name="emailid" placeholder="Enter Email Id..." class="input">
              <input type="password" name="password" placeholder="Enter Password..." class="input">
              <div class="row">
              <a href="register.php" class="register-btn">Create Account</a><input type="submit" value="Login" name="login" class="login-btn">
              </div>

          </form>
      </div>
  </div>  
</body>
</html>
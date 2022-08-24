<?php
require('db.php');
if(!isset($_SESSION['isUserLoggedIn'])){
echo "<script>window.location.href='index.php?user_not_logged_in';</script>";
}
if($_SESSION['role']!='customer'){
echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Welcome Customer</h1>
    <h2><?=$_SESSION['emailId']?></h2>
    <a href="logout.php">logout</a>
</body>
</html>
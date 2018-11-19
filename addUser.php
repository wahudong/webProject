<?php
session_start();
if (!isset($_SESSION['loginUser'])) {
    echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    die();
}
include "connect.php";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>

<fieldset>
    <legend>Add User</legend>
    <form action="saveRegistration.php" method="post" name="regForm" id="regForm">
        <label for="userName">Please Enter Email Address as User Name</label>
        <input type="email" name="userName" id="userName">
        <br>
        <label for="password1">Please Enter Password</label>
        <input type="password" name="password1" id="password1">
        <br>
        <label for="password2">Please Confirm Your Password</label>
        <input type="password" name="password2" id="password2">
        <br>
        <input type="submit" name="submit" id="sumbit">
        <input type="reset" name="reset" id="reset">     
</fieldset>
    
</body>
</html>
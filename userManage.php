 <!--//This cold provide the user manage page  --> 
<?php
session_start();
if (!isset($_SESSION['loginUser'])) {
    echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    die();
}
include "connect.php";
$query="SELECT userName, userID FROM USER";
$statement=$db->prepare($query);
$statement->execute();
$users=$statement->fetchall();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Manage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">    
</head>
<body>       
    <h2>User Management</h2>
    <h3><a href="manage.php">Back to manage page</a></h3>
    
    <?php foreach ($users as $key => $userItem):?>
        <?=$userItem['userName']?>  <a href="deleteUser.php?ID=<?=$userItem['userID']?>&name=<?=$userItem['userName']?>">Delete</a>
        <br>
    <?php endforeach;?>
    <br>
    <a href="addUser.php?">Add New User</a>
</body>
</html>

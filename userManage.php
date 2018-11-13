<?php
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
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>
    <h2>User Management</h3>
    <?php foreach ($users as $key => $userItem):?>
        <?=$userItem['userName']?>  <a href="deleteUser.php?ID=<?=$userItem['userID']?>">Delete</a>
        <br>
    <?php endforeach;?>
    <br>
    <a href="addUser">Add New User</a>
</body>
</html>

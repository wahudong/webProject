
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manage Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />   
</head>
<body>
<?php session_start();?>
    <?php if (isset($_SESSION['loginUser'])):?>
    <h4>Wellcom <?= $_SESSION['loginUser']?></h4>
    <h4><a href="logout.php">Log Out</a></h4>
    <h4><a href="index.php">Back to homepage</a></h4>
    <br>
    <p>Management manual 功能列举清单</p>
    
    <p><a href="userManage.php">User Management</a></p>
    <p>Items's Page Management</p>
    <p>Categary Management</p>

<?php else:?>


    <script LANGUAGE = "javascript"> 
        alert("Sorry, You are not allow to access this page!");
        location.href="login.php";
    </script>


<?php endif;?>

</body>
</html>
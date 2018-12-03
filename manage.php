<!-- This page is a hub of maintance. all the maintance or registered user's previlige is go from here. -->
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
    <h2>Management Page</h2>
    <h4>Wellcom <?= $_SESSION['loginUser']?></h4>
    <h4><a href="logout.php">Log Out</a></h4>
    <h4><a href="index.php">Back to homepage</a></h4>
    <br>
    <p>Management manual 功能列举清单</p>
    
    <p><a href="userManage.php">User Management</a></p>
    <p><a href="itemPageManage.php">Items's Page Management</a></p>  
    <a href="categoryManage.php"> <p>Categary Management</p></a>

<?php else:?>


    <script LANGUAGE = "javascript"> 
        alert("Sorry, You are not allow to access this page!");
        location.href="login.php";
    </script>


<?php endif;?>

</body>
</html>

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
<h4>Welcom <?= $_SESSION['loginUser']?></h4>
<h4><a href="logout.php">Log Out</a></h4>
<br>
<p>manage manual 功能列举清单</p>
<?php else:?>


    <script LANGUAGE = "javascript"> 
        alert("Sorry, You are not allow to access this page!");
        location.href="login.php";
    </script>


<?php endif;?>

</body>
</html>
<!-- //Thhis code is to save the registration datat passed from register.php page into database. -->

<?php
include "connect.php";
$userName=filter_input(INPUT_POST,'userName',FILTER_SANITIZE_EMAIL);
$password1=filter_input(INPUT_POST,'password1',FILTER_SANITIZE_SPECIAL_CHARS);
$password2=filter_input(INPUT_POST,'password2',FILTER_SANITIZE_SPECIAL_CHARS);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Save Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <!-- <script src="main.js"></script> -->
</head>
<body>
    
<?php if ($password1!=$password2):?>

<script LANGUAGE = "javascript"> 
alert("The two password do not match. Please reenter it.");
location.href="register.php";
</script>
<?php exit;?>
<?php endif;?>

<?php
$queryUser="SELECT userName FROM USER WHERE userName=:user";
$statementUser=$db->prepare($queryUser);
$statementUser->bindvalue(':user',$userName);
$statementUser->execute();
$users=$statementUser->fetchall();
if (!empty($users)) {
    echo "<script LANGUAGE = 'javascript'> alert('The user has been used, Please choose another one.');location.href='register.php'; </script>"; 
    die();  
}

$hash=password_hash($password1,PASSWORD_DEFAULT);

$query = "INSERT INTO USER (userName, password) VALUES (:userName, :password1)";
$statement=$db->prepare($query);
$statement->bindvalue(':userName',$userName);
$statement->bindvalue(':password1',$hash);
$saved=$statement->execute();
?>

<?php if ($saved) :?>
    <?php session_start();?>
    <?php $_SESSION['loginUser']=$userName;?>

    <script LANGUAGE = "javascript"> 
        alert("Create user succefully");
        location.href="manage.php";
    </script>
<?php else:?>
    <script LANGUAGE = "javascript">    
        alert("Registration is not successfull.");
        location.href="register.php";
    </script>
<?php endif;?>


</body>
</html>

<!-- let user login ans set the session variable. -->

<?php 
if (isset($_POST['submit'])){
    include "connect.php";
    $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
    $user=filter_input(INPUT_POST,'userName', FILTER_SANITIZE_SPECIAL_CHARS);

    $query="SELECT userName, password FROM USER WHERE userName=:user";
    $statement=$db->prepare($query);
    $statement->bindvalue(':user',$user);
    $success=$statement->execute();
    $rows=$statement->fetch();
   
    if (empty($rows)) {
        echo "<script LANGUAGE = 'javascript'> alert('Wrong user name');location.href='login.php'; </script>";
    } 

    if (password_verify($password,$rows['password'])) {
        session_start();
        $_SESSION['loginUser']=$user;
        echo "<script LANGUAGE = 'javascript'> alert('You have successfully logined');location.href='manage.php'; </script>";        
    }else{       
        echo "<script LANGUAGE = 'javascript'> alert('Wrong password');location.href='login.php'; </script>";          
    }   
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />    
</head>
<body>
    <form action="" method="post" name="loginForm" id="loginForm">
    <label for="userName">Please enter your user name</label>
    <input type="email" id=userName name="userName">
    <br>
    <label for="passWord">Please enter your password</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" name="submit" id="submit" value="submit">   
    </form>

</body>
</html>
<!-- To update the category stored in the database. -->
<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        
        $id=filter_input(INPUT_GET,'ID',FILTER_SANITIZE_NUMBER_INT);
    
        
        
        $query="SELECT categoryID, categoryName FROM category WHERE categorID==:id";
        $statement=$db->prepare($query);
        $statement->bindvalue(':id',$id);
        $statement->execute();
        $categorie=$statement->fetch();

       

        $qureyUpdate="UPDATE  Category SET CategorynAME=:name WHERE CategoryID=:id";
        $statement=$db->prepare($qureyUpdate);
        $statement->bindvalue(':id',$id);
        $statement->bindvalue(':name',$name);
        $statement->execute();
        header('Location:categoryManage.php');       
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src=""></script>
</head>
<body>
    
</body>
</html>

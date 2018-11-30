<!-- To update the category stored in the database. -->
<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        
        $id=filter_input(INPUT_GET,'ID',FILTER_SANITIZE_NUMBER_INT);
        
        // $id=$_GET['id'];
        // print_r($_GET);
        echo '<br>';
        echo '$id= ';
        print_r($id);
        echo '<br>';

        $query="SELECT categoryID, categoryName FROM category WHERE categoryID=:id";
        $statement=$db->prepare($query);
        $statement->bindvalue(':id',$id);
        $statement->execute();
        $categorie=$statement->fetch();

       print_r($categorie);
  

        // $qureyUpdate="UPDATE  Category SET CategorynAME=:name WHERE CategoryID=:id";
        // $statement=$db->prepare($qureyUpdate);
        // $statement->bindvalue(':id',$id);
        // $statement->bindvalue(':name',$name);
        // $statement->execute();
        // header('Location:categoryManage.php');       
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
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>
    <h3>Please Enter The New Name to The Category</h3>
<form action="saveCategory.php" method="POST" name="updateCategory" id="updateCategory">
<input type="hidden" name="id" value=<?=$id?>>
<label for="newCateName">CategoryID: <?=$categorie['categoryID']?></label>
<input type="text" name="newCateName" id="newCatName" value=<?=$categorie['categoryName']?>>
<input type="submit" name="submitUpdate" value="Save">

</form>

</body>
</html>

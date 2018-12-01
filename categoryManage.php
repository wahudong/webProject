 <!--//This cold provide the user manage page  --> 
 <?php
session_start();
if (!isset($_SESSION['loginUser'])) {
    echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    die();
}
include "connect.php";
$query="SELECT categoryID, categoryName FROM category";
$statement=$db->prepare($query);
$statement->execute();
$categories=$statement->fetchall();
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
    <h2>Category Management</h2>
    <h3><a href="manage.php">Back to manage page</a></h3>
    
    <form action="updateCategory.php" method="POST" name="displayCategory" id="displayCategory">
    <?php foreach ($categories as $key => $categoryItem):?>
    <input type="hidden" name="id" value=<?=$categoryItem['categoryID']?>>

    <label>Category ID: <?=$categoryItem['categoryID']?></label>
    <br>
    <h4>Category Name: </h4>
    <?=$categoryItem['categoryName']?>|   
  

    <!-- <input type="text" name="cateName" value=<?=$categoryItem['categoryName']?>> -->

    <!-- // <input type="submit" name="delete" value="Delete"> -->
    <!-- // <input type="submit" name="update" value="Update"> -->

    
    <a href="deleteCategory.php?ID=<?=$categoryItem['categoryID']?>&name=<?=$categoryItem['categoryName']?>">Delete</a>
    <a href="updateCategory.php?ID=<?=$categoryItem['categoryID']?>">Update</a>
    <br>
    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
    <br>      
    <br>
    <?php endforeach;?>
    <br>
    </form>

    <form action="insertCategory.php" name="createCategory" id="createCategory" method="POST">

    <label for="newName">Please Enter New Category Name</label>
    <br>
    <input type="text" name="create" id="create">
    <input type="submit" name="createSubmit" value="Create Cagegory">

    </form>

</body>
</html>

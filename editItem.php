<!-- This code is to edit item page -->

<?php 
session_start();
include "connect.php";

$queryCategory = "SELECT categoryID, categoryName FROM category";
$statementCategory = $db->prepare($queryCategory);
$statementCategory->execute();
$rowArrayCategory=$statementCategory->fetchall();

$commdID=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price FROM commodity where commodityID=:commodityID";
$statement = $db->prepare($query);
$statement->bindvalue(':commodityID',$commdID);
$statement->execute();
$item=$statement->fetch();

$queryCurrentCategory = "SELECT categoryID, categoryName FROM category WHERE categoryID=".$item['categoryID'];
$statementCurrentCategory = $db->prepare($queryCurrentCategory);
$statementCurrentCategory->execute();
$currentCategory=$statementCurrentCategory->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit new item page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src=""></script>
</head>
<body>
<!-- //Check if it is the registered user. -->
<?php if (!isset($_SESSION['loginUser'])):?>
  
  <script LANGUAGE = "javascript"> 
      alert("Sorry, You are not allow to access this page!");
      location.href="login.php";
  </script>
<?php die();?>
<?php endif;?>


<p><a href="itemPageManage.php">Back to item manage page</a></p>

    <form action="updateItem.php" method="post" name="editPage" id="editPage">
        <input type="hidden" name='commid' value= <?=$commdID?>>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value=<?=$item['briefintro'] ?>>
        <br>
        <br>
        <label for="description">Description</label>
        <br>
        <textarea name="description" id="description" cols="50" rows="7" form="editPage"><?=$item['description']?></textarea>
        <br>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value=<?=$item['price']?> step="any">
        <br>
        <h4>Current category: <?=$currentCategory['categoryName']?></h4>
        <br>
        <label for="category">Please select new category</label>
        <select name="category">

        <?php   foreach ($rowArrayCategory as $key => $value):?>
            <option value=<?=$value['categoryID']?>><?=$value['categoryName']?></option>
            <br>
        <?php endforeach;?>

        </select>
        <br>
        <br>

        <input type="submit" name="submit" value="SUBMIT" form="editPage">
        <input type="reset" name="reset" value="reset" form="editPage">   

    </form>

</body>
</html>
<!-- This code is to edit item page -->

<?php 
session_start();
include "connect.php";

//select all the categorys for the select-optional element in the form
$queryCategory = "SELECT categoryID, categoryName FROM category";
$statementCategory = $db->prepare($queryCategory);
$statementCategory->execute();
$rowArrayCategory=$statementCategory->fetchall();

$commdID=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

//search item based on commodityID
$query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price FROM commodity where commodityID=:commodityID";
$statement = $db->prepare($query);
$statement->bindvalue(':commodityID',$commdID);
$statement->execute();
$item=$statement->fetch();

//search related comments
$queryComment = "SELECT commentID, commodityID, writerName, commentText, updateDate FROM comment where commodityID=:commodityID2";
$searchComment = $db->prepare($queryComment);
$searchComment->bindvalue(':commodityID2',$commdID);
$searchComment->execute();
$commentArray=$searchComment->fetchall();

// print_r($commentArray);

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
            <?php if ($value['categoryID']==$currentCategory['categoryID']):?>
                <option value=<?=$value['categoryID']?> selected><?=$value['categoryName']?></option>
            <?php else:?>
                <option value=<?=$value['categoryID']?>><?=$value['categoryName']?></option>
            <?php endif;?>
            <br>
        <?php endforeach;?>

        </select>
        <br>
        <br>

        <input type="submit" name="submit" value="SUBMIT" form="editPage">
        <input type="reset" name="reset" value="reset" form="editPage">   

    </form>

    <br>

     
        <?php foreach ($commentArray as $key => $eachComment) :?>

        ++++++++++++++++++++++++++++++++++++++++++++++++

        <h3>Writer: <?=$eachComment['writerName']?></h3>
        <textarea name="" id="" cols="50" rows="6"><?=$eachComment['commentText']?></textarea>
        <br>

        <a href="deleteComment.php?comID=<?=$eachComment['commentID']?>&itemID=<?=$item['commodityID']?>">Delete</a>
        <a href="updateComment.php?comID=<?=$eachComment['commentID']?>&itemID=<?=$item['commodityID']?>">Edit</a>
        <a href="hideComment.php?comID=<?=$eachComment['commentID']?>&itemID=<?=$item['commodityID']?>&contentText=<?=$eachComment['commentText']?>">Hide</a>

        <?php if (empty($eachComment['commentText'])):?>

         <a href="BackToPublic.php?comID=<?=$eachComment['commentID']?>&itemID=<?=$item['commodityID']?>&contentText=<?=$eachComment['commentText']?>">Show Comment</a>

        <?php endif;?>
        <br>
        <br>

        <?php endforeach;?>
    
    
    

</body>
</html>
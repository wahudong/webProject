<!-- // to display the functions that related to item page manage -->

<?php
session_start();
include "connect.php";

if (isset($_POST['submit'])) {
  $order=$_POST['sortBy'];
}else{
    $order="briefintro";
}


// NO ERROR,JUST NOT GOOD
// $query = "SELECT commodity.commodityID, category.categoryID, briefintro, description, createDate, commodity.updateDate, price, category.categoryName 
// FROM commodity, category,comment
// WHERE commodity.categoryID=category.categoryID
// AND commodity.commodityID=comment.commodityID
// ORDER BY ".$order;

// NO ERROR,JUST NOT GOOD
// SELECT commodityID, categoryID, briefintro, description, createDate, commodity.updateDate, price, category.categoryName 
// FROM (commodity
// LEFT JOIN category USING(categoryID))
// LEFT JOIN comment USING(commodityID)


// SELECT commodityID, categoryID, briefintro, description, createDate, commodity.updateDate, price, category.categoryName 
// FROM (commodity 
// LEFT OUTER JOIN category ON commodity.categoryID=category.categoryID
// LEFT OUTER JOIN comment ON commodity.commodityID=comment.commodityID



$query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price, category.categoryName 
FROM (commodity
LEFT JOIN category USING(categoryID))
ORDER BY ".$order;

$statement = $db->prepare($query);
$statement->execute();
$rowArray=$statement->fetchall();

$queryCategory = "SELECT categoryID, categoryName FROM category";
$statementCategory = $db->prepare($queryCategory);
$statementCategory->execute();
$rowArrayCategory=$statementCategory->fetchall();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Item page manage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>

<?php if (!isset($_SESSION['loginUser'])):?>
  
  <script LANGUAGE = "javascript"> 
      alert("Sorry, You are not allow to access this page!");
      location.href="login.php";
  </script>
<?php die();?>
<?php endif;?>

<a href="editNewPage.php">Create Nem Item Page</a>

<p><a href="manage.php">Back to manage page</a></p>

<br>

<h2>Commodities Displayed By Order</h2>
<br>
<form action="" method="post" name="sort">
    <label for="sortBy"> Please choose sort type:</label>
    <select name="sortBy" id="sortBy">       
            <option value="briefintro">Title</option>
            <option value="createDate">Create Date</option>
            <option value="updateDate">Update Date</option>        
    </select>

    <input type="submit" name="submit">

</form>
<br>
<?php foreach ($rowArray as $key => $value):?>
    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    <br>
    Title: <?=$value['briefintro']?>     <a href="deleteItem.php?id=<?=$value['commodityID']?>">Delete</a>         <a href="editItem.php?id=<?=$value['commodityID']?>">Edit</a>
    <br>
    <br>
    
    <!-- <br>    -->

    description:
    <?=$value['description']?>
    <br>
    <br>
    createDate:
    <?=$value['createDate']?>
    <br>
    <!-- <br> -->
    updateDate:
    <?=$value['updateDate']?>
    <br>
    <!-- <br> -->
    price:
    <?=$value['price']?>
    <br>
    Cagegory:
    <?=$value['categoryName']?>
    <br>
    <br>
    <?php
        $cmdID=$value['commodityID'];
        $queryImg = "SELECT imageID,imagePath FROM image WHERE commodityID=$cmdID";
        $statementImg = $db->prepare($queryImg);
        $statementImg->execute();
        $rowArrayImg=$statementImg->fetchall();
       
    ?>
    <?php foreach ($rowArrayImg as $keyImg => $valueImg) :?>     
        <img src=<?=$valueImg['imagePath']?> alt="cooki1 picture">
        <a href="deletePicture.php?imageID=<?=$valueImg['imageID']?>&path=<?=$valueImg['imagePath']?>">Delete</a>      
    <?php endforeach;?>
    <br>
    <br>
    <h3>Add new picture to the item</h3>
    <form action="upload-resize.php" method="POST" enctype="multipart/form-data">
        <label for="file">Select the picture you want to be upload</label>
        <input type="file" name="file" id="file">
        <input type="hidden" name="itemID" value=<?=$value['commodityID']?>>
        <input type="submit" name="submit" value="Up Load">
    </form>

    <br>

    
    <br>
   
<?php endforeach;?>
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




    
</body>
</html>
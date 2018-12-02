<!-- // to display the functions that related to item page manage -->

<?php
session_start();
include "connect.php";

if (isset($_POST['submit'])) {
  $order=$_POST['sortBy'];
}else{
    $order="briefintro";
}

$query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price, category.categoryName 
FROM commodity
LEFT JOIN category USING(categoryID)

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
    <?php
        $cmdID=$value['commodityID'];
        $queryImg = "SELECT imagePath FROM image WHERE commodityID=$cmdID";
        $statementImg = $db->prepare($queryImg);
        $statementImg->execute();
        $rowArrayImg=$statementImg->fetchall();
       
    ?>
    <br>
    <br>
    <?php foreach ($rowArrayImg as $keyImg => $valueImg) :?>     
        <img src=<?=$valueImg['imagePath']?> alt="cooki1 picture">        
    <?php endforeach;?>
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
<?php endforeach;?>
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

<!-- <fieldset>
    <legend>  New Itmes </legend>
        <form action="insterNewItem.php" method="post" name=newItems>
        
        <label for="title">Title</label>
        <input type="text" name="title">
        <br>
        <label for="description">Detailed description</label>
        <input type="text" name="description">
        <br>
        <label for="price">Price</label>
        <input type="number" name="price">        
        
        </form>
   
</fieldset> -->


    
</body>
</html>
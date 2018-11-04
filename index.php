<?php
    include "connect.php";

    $query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price FROM commodity";
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
    <title>Commodities Display</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<h2>Categories</h2>
<br>
<?php foreach ($rowArrayCategory as $key => $value):?>
    <a href="itemsInCategory.php?cateID=<?=$value['categoryID']?>"><?=$value['categoryName']?></a>
    <br>
<?php endforeach;?>
<br>
<br>
<h2>Commodities Display</h2>

<br>
<?php foreach ($rowArray as $key => $value):?>
    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    <br>
    briefintro:
    <?=$value['briefintro']?>
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
    <br>   

    description:
    <?=$value['description']?>
    <br>
    <br>
    createDate:
    <?=$value['createDate']?>
    <br>
    <br>
    updateDate:
    <?=$value['updateDate']?>
    <br>
    <br>
    price:
    <?=$value['price']?>
    <br>
    <br>
<?php endforeach;?>
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
</body>
</html>
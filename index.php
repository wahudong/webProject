<?php
    include "connect.php";
    session_start();

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

<?php if (isset($_SESSION['loginUser'])):?>
    <h3><a href="logout.php">Logout</a></h3>
    <h3><a href="manage.php">Go To Management Page</a></h3>
<?php else:?>
    <h3><a href="login.php">login</a></h2>
    <h3><a href="register.php">Register</a></h2>
<?php endif?>


<h2>Categories</h2>
<!-- to create a list of category -->
<?php foreach ($rowArrayCategory as $key => $value):?>
    <a href="itemsInCategory.php?cateID=<?=$value['categoryID']?>&CateName=<?=$value['categoryName']?>"><?=$value['categoryName']?></a>
    <br>
<?php endforeach;?>
<br>
<br>
<a href="allContent.php"><h1>All the items list</h1></a> 
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
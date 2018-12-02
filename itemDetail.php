<!-- This page is to display all the detail about the item, including pictures , comments. -->

<?php
// echo $_GET['comID'];
include "connect.php";

    //query the commodities in the commodity table.
    $ID=filter_var($_GET['comID'],FILTER_SANITIZE_SPECIAL_CHARS);
    $query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price FROM commodity WHERE commodityID=$ID";
    $statement = $db->prepare($query);
    $statement->execute();
    $rowArray=$statement->fetch();

    // query the image in the image table for a specific commoditID
    $cmdID=$rowArray['commodityID'];
    $queryImg = "SELECT imagePath FROM image WHERE commodityID=$cmdID";
    $statementImg = $db->prepare($queryImg);
    $statementImg->execute();
    $rowArrayImg=$statementImg->fetchall();

    //query the category table
    $cateID=$rowArray['categoryID'];
    $queryCate = "SELECT categoryName FROM category WHERE categoryID=$cateID";
    $statementCate = $db->prepare($queryCate);
    $statementCate->execute();
    $cateRow=$statementCate->fetch();

    //query the comment table.
    $querycomment = "SELECT writerName, commentText, updateDate FROM comment WHERE commodityID= $ID ORDER BY updateDate DESC";
    $statementComment = $db->prepare($querycomment);
    $statementComment->execute();
    $rowArrayComment=$statementComment->fetchall();   

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Item Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h2><a href="index.php">Back To Home Page</a></h2>

<h3>Title:<?=$rowArray['briefintro']?></h3>
<h3>Category: <?=$cateRow['categoryName']?></h3>

<br>
<?php foreach ($rowArrayImg as $keyImg => $valueImg) :?>     
    <img src=<?=$valueImg['imagePath']?> alt="<?=$valueImg['briefintro']?> picture">        
<?php endforeach;?>
<br>
<br>   

<h3>Description:</h3>
<?=$rowArray['description']?>
<br>
<!-- <br> -->
<h3>CreateDate: <?=$rowArray['createDate']?></h3>
<br>
<h3>UpdateDate: <?=$rowArray['updateDate']?></h3>
<br>
<h3>Price: <?=$rowArray['price']?></h3>
<br>
<h3>Comment:</h3>
<br>
<?php foreach ($rowArrayComment as $key => $value) :?>
    <?php if (!empty($value['writerName'])):?> 
        <?=$value['writerName'].' said:  '?>
    <?php endif;?>
    <?=$value['commentText']?>
    <br>
    <br>
<?php endforeach;?>
<br>
<br>
<h4>Please leave your comment here:</h4>
<br>
<form action="createComment.php" name="comment" method="post" id="comment" >
<textarea name="comment" id="comment" cols="50" rows="4" form="comment"></textarea>
<input type="hidden" name="commID" value=<?=$ID?>>
<br>
<?php session_start();?>

<?php if (!isset($_SESSION['loginUser'])):?>
    <h4>Please Enter your Name Here  <input type="text" name="writerName" form="comment" value=""></h4>
<?php endif;?>
<br>
<input type="submit" value="SUBMIT" form="comment">
</form>


</body>
</html>
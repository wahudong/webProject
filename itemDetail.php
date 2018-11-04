<?php
// echo $_GET['comID'];
include "connect.php";

    //query the commodities in the commodity table.
    $ID=$_GET['comID'];
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

    //qery the comment table.
    $querycomment = "SELECT writerName, commentText FROM comment WHERE commodityID= $ID";
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
    
briefintro:
<br>
<?=$rowArray['briefintro']?>

<br>
<br>
<?php foreach ($rowArrayImg as $keyImg => $valueImg) :?>     
    <img src=<?=$valueImg['imagePath']?> alt="<?=$valueImg['briefintro']?> picture">        
<?php endforeach;?>
<br>
<br>   

Description:
<br>
<?=$rowArray['description']?>
<br>
<br>
CreateDate:
<br>
<?=$rowArray['createDate']?>
<br>
<br>
UpdateDate:
<br>
<?=$rowArray['updateDate']?>
<br>
<br>
Price:
<br>
<?=$rowArray['price']?>
<br>
<br>

<br>
<br>
Comment:
<br>
<br>
<?php foreach ($rowArrayComment as $key => $value) :?>
    <?=$value['commentText']?>
    <br>
    <br>
<?php endforeach;?>
</body>
</html>
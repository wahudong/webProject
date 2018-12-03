<!-- This code is going to display items in a specifican category -->
<?php
include "connect.php";
//query the commodities in the commodity table.
$CateId=$_GET['cateID'];
$query = "SELECT commodityID,briefintro FROM commodity WHERE categoryID=$CateId";
$statement = $db->prepare($query);
$statement->execute();
$rowArray=$statement->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />   
    <title>Items In Category</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h2>Category:  <?=$_GET['CateName']?></h2>
<br>
<br>
<?php foreach ($rowArray as $key => $value):?>
    <a href="itemDetail.php?comID=<?=$value['commodityID']?>"><?=$value['briefintro']?></a>
    <br>
<?php endforeach;?>
    
</body>
</html>
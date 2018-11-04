<?php
    include "connect.php";

    $query = "SELECT commodityID, categoryID, briefintro, description, createDate, updateDate, price FROM commodity";
    $statement = $db->prepare($query);
    $statement->execute();
    $rowArray=$statement->fetchall();
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

<h2>Commodities Display</h2>

<br>
<?php foreach ($rowArray as $key => $value):?>
    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    <br>
    briefintro:
    <a href="itemDetail.php?comID=<?=$value['commodityID']?>"> <?=$value['briefintro']?></a>
    <br>
    <br>
<?php endforeach;?>
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
</body>
</html>
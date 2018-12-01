<!-- // This page is to display all the items we have already regardless the category. -->

<?php
    include "connect.php";

    $query = "SELECT commodityID, categoryID, briefintro, description, price FROM commodity";
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
<p><a href="index.php">Back To Home Page</a></p>

<h2>All the Commodities list</h2>

<br>
<?php foreach ($rowArray as $key => $value):?>
    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    <br>
    <h4>Title: </h4>
    <a href="itemDetail.php?comID=<?=$value['commodityID']?>"> <?=$value['briefintro']?></a>    CategoryID: <?=$value['categoryID']?>
    <br>
    <br>
<?php endforeach;?>
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
</body>
</html>
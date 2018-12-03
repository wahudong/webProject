<!-- This code is to search the keywaord in a item page. -->
<?php
session_start();
include "connect.php";

$searchWords=filter_input(INPUT_POST,'keyWord',FILTER_SANITIZE_SPECIAL_CHARS);

$itemQuery="SELECT * FROM COMMODITY";
$statement=$db->prepare($itemQuery);
$statement->execute();
$itemRows=$statement->fetchall();


$itemIDResults=[];


foreach ($itemRows as $key => $value) {
   
    if (stristr($value['briefintro'],$searchWords)) {
        array_push($itemIDResults,$value['commodityID']);
    }elseif(stristr($value['description'],$searchWords)){
        array_push($itemIDResults,$value['commodityID']);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>

<h3>************Search Result***************</h3>

<br>
<?php foreach ($itemRows as $key => $eachitem):?>

   
    <?php if (in_array($eachitem['commodityID'],$itemIDResults)) :?>

    <a href="itemDetail.php?comID=<?=$eachitem['commodityID']?>"><?=$eachitem['briefintro']?></a>    
    <br>
    <br>
    <?php endif;?>
  

<?php endforeach;?>
    
</body>
</html>
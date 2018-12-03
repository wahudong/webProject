<!-- This code is to search the keywaord in a item page. -->
<?php
session_start();
include "connect.php";

$searchWords=filter_input(INPUT_POST,'keyWord',FILTER_SANITIZE_SPECIAL_CHARS);
$searchCategoryID=filter_input(INPUT_POST,'category',FILTER_SANITIZE_SPECIAL_CHARS);

$itemQuery="SELECT * FROM COMMODITY";
$statement=$db->prepare($itemQuery);
$statement->execute();
$itemRows=$statement->fetchall();


$itemIDResults=[];
$resultTitles=[];

foreach ($itemRows as $key => $value) {

    if (stristr($value['briefintro'],$searchWords)) {
        array_push($itemIDResults,$value['commodityID']);
        array_push($resultTitles,$value['briefintro']);
    }elseif(stristr($value['description'],$searchWords)){
        array_push($itemIDResults,$value['commodityID']);
        array_push($resultTitles,$value['briefintro']);
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
<a href="index.php">Back To Home Page</a>
<br>

<h3>************Search Result For Key Words "<?=$searchWords?>"***************</h3>


<br>

<?php
$no_of_rows_per_page=3;
$totalRows=count($resultTitles);
$totalPage=ceil($totalRows/$no_of_rows_per_page);

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$offset = ($pageno-1) * $no_of_rows_per_page; 

?>

<br>
<?php foreach ($itemRows as $key => $eachitem):?>

    <?php if ($searchCategoryID=='all'):?>

        <?php if (in_array($eachitem['commodityID'],$itemIDResults)) :?>

            <a href="itemDetail.php?comID=<?=$eachitem['commodityID']?>"><?=$eachitem['briefintro']?></a> 
            <br>
            <br>
        <?php endif?>
    <?php else:?> 
   
        <?php if (in_array($eachitem['commodityID'],$itemIDResults) & $eachitem['categoryID']==$searchCategoryID) :?>

        <a href="itemDetail.php?comID=<?=$eachitem['commodityID']?>"><?=$eachitem['briefintro']?></a> 
        <br>
        <br>
        <?php endif?>
    <?php endif?>
  

<?php endforeach?>
    
</body>
</html>
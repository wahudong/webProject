This code is to search the keywaord in a item page.
<?php
session_start();
include "connect.php";

$searchWords=filter_input(INPUT_GET,'keyWord',FILTER_SANITIZE_SPECIAL_CHARS);

$itemQuery="SELECT * FROM COMMODITY";
$statement=$db->prepare($itemQuery);
$statement->execute();
$itemsRow=$statement->fetchall();


print_r($itemsRow);
?>
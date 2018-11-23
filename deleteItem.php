<!-- this code is to delete the page which the id is passed in. -->
<?php
session_start();
include"connect.php";
if (!isset($_SESSION['loginUser'])){
    echo "You are not allow to access this page";    
    die();
}  

$id_current=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

     
    $query="DELETE FROM commodity WHERE commodityID=:id_bind";
    $statement=$db->prepare($query);
    $statement->bindvalue(':id_bind',$id_current);
    $statement->execute();  
    header('Location: itemPageManage.php'); 


?>
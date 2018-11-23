<?php
session_start();
if (!isset($_SESSION['loginUser'])){
    echo "You are not allow to access this page";    
    die();
}  

include"connect.php";

$new_title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$new_description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id_current=filter_input(INPUT_POST,'commid',FILTER_SANITIZE_NUMBER_INT);
$new_categoryID=filter_input(INPUT_POST,'category',FILTER_SANITIZE_NUMBER_INT);
$price=filter_input(INPUT_POST,'price',FILTER_SANITIZE_NUMBER_FLOAT);

    if (!empty($new_title)&&!empty($new_description)) {        
        $query="UPDATE commodity SET briefintro=:new_title, description=:new_description, categoryID=:categoryID, price=:price WHERE commodityID=:id_bind";
        $statement=$db->prepare($query); 
        $statement->bindvalue(':id_bind',$id_current,PDO::PARAM_INT);
        $statement->bindvalue(':new_title',$new_title);
        $statement->bindvalue(':new_description',$new_description);
        $statement->bindvalue(':categoryID',$new_categoryID);
        $statement->bindvalue(':price',$price);
        $statement->execute();        
    }


  
    header('Location: itemPageManage.php');
    die();
?>
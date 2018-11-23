<?php
/*This code is to perform the insert action to insert new item pages into the database. */

include'connect.php';
session_start();

if (!isset($_SESSION['loginUser'])){
    echo "You are not allow to access this page";
    header('Location: login.php');
    die();
}  

if (isset($_POST['submit'])) {
    //make sure both title and content not empty.
    if ((strlen($_POST['title'])>=1)&&(strlen($_POST['description'])>=1)) {
       //Sanitize the input the data
        $new_title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $new_description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $new_price = filter_input(INPUT_POST,'price',FILTER_SANITIZE_SPECIAL_CHARS);
        $new_price=filter_var($new_price,FILTER_SANITIZE_NUMBER_FLOAT);
        
        //insert query.
        $query="INSERT INTO commodity (briefintro,description,price) VALUES(:title, :description, :price)";
        $statement=$db->prepare($query);
        $statement->bindvalue(':title',$new_title);
        $statement->bindvalue(':description',$new_description);
        $statement->bindvalue(':price',$new_price);
        $statement->execute();  
        header('Location: itemPageManage.php');
        exit; 
    }else{
        //if one of the title or content is lest then 1 letter, display error message.
        echo "Tthe title and content are both at least 1 character in length.";
    }
}

?>
<!-- this page is to update the category -->
<?php
session_start();
if (!isset($_SESSION['loginUser'])){
    echo "You are not allow to access this page";    
    die();
}  

include"connect.php";

// $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
// $name=filter_input(INPUT_POST,'cateName',FILTER_SANITIZE_SPECIAL_CHARS);




// if the delete is set, do deleting
if (isset($_POST['delete'])) {
    
    $qurey="DELETE FROM Category WHERE CategoryID=:id";
        $statement=$db->prepare($qurey);
        $statement->bindvalue(':id',$id);
        $statement->execute();       
        // header('Location:categoryManage.php');
        die();
}elseif (isset($_POST['update'])) {
    $qurey="UPDATE  Category SET CategorynAME=:name WHERE CategoryID=:id";
        $statement=$db->prepare($qurey);
        $statement->bindvalue(':name',$name);
        $statement->bindvalue(':id',$id);
        $statement->execute();       
        // header('Location:categoryManage.php');
        die();
}elseif (isset($_POST['createSubmit'])) {

    $newName=filter_input(INPUT_POST,'create',FILTER_SANITIZE_SPECIAL_CHARS);
    print_r($_POST);
    echo "<br>";
   

    $qurey="INSERT INTO  Category (categoryName) VALUES(:name)";
    $statement=$db->prepare($qurey);
    $statement->bindvalue(':name',$newName);
    $statement->execute();       
    header('Location:categoryManage.php');
    die();
}
?>


<!-- to Save changes on category -->
<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        
        $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
        $name=filter_input(INPUT_POST,'newCateName', FILTER_SANITIZE_SPECIAL_CHARS);   

        $qureyUpdate="UPDATE  Category SET CategoryNAME=:name WHERE CategoryID=:id";
        $statement=$db->prepare($qureyUpdate);
        $statement->bindvalue(':id',$id);
        $statement->bindvalue(':name',$name);
        $statement->execute();
        header('Location:categoryManage.php');       
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>
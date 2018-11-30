<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        echo "<script LANGUAGE = 'javascript'> alert('Your Are Going to Delet the User'); </script>";
        $id=filter_input(INPUT_GET,'ID',FILTER_SANITIZE_NUMBER_INT);
        $name=filter_input(INPUT_GET,'name',FILTER_SANITIZE_SPECIAL_CHARS);     
        $qurey="DELETE FROM Category WHERE CategoryID=:id";
        $statement=$db->prepare($qurey);
        $statement->bindvalue(':id',$id);
        $statement->execute();
        header('Location:categoryManage.php');
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>


<!-- //this code is to delete a cooment whic is related to the a specific item -->

<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        echo "<script LANGUAGE = 'javascript'> alert('Your Are Going to Delet the User'); </script>";
        $id=filter_input(INPUT_GET,'comID',FILTER_SANITIZE_NUMBER_INT);
        $itemID=filter_input(INPUT_GET,'itemID',FILTER_SANITIZE_NUMBER_INT);
        // $name=filter_input(INPUT_GET,'name',FILTER_SANITIZE_SPECIAL_CHARS);   

        $qurey="DELETE FROM comment WHERE commentID=:id";
        $statement=$db->prepare($qurey);
        $statement->bindvalue(':id',$id);
        $statement->execute();
        header('Location:edititem.php?id='.$itemID);
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>

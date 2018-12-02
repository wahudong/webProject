<!-- //this code is to move the comment text to another column so that other query can not find it. it is like hidded -->

<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        // echo "<script LANGUAGE = 'javascript'> alert('Your Are Going to Delet the User'); </script>";
        $id=filter_input(INPUT_GET,'comID',FILTER_SANITIZE_NUMBER_INT);
        $itemID=filter_input(INPUT_GET,'itemID',FILTER_SANITIZE_NUMBER_INT);
        $text=filter_input(INPUT_GET,'contentText',FILTER_SANITIZE_SPECIAL_CHARS);
       
      
                     
            $query='UPDATE comment SET commentText2=:text, commentText="" WHERE commentID=:id_bind';
            $statement=$db->prepare($query); 
            $statement->bindvalue(':id_bind',$id,PDO::PARAM_INT);
            $statement->bindvalue(':text',$text);           
            $statement->execute();        
        
    
        header('Location:edititem.php?id='.$itemID);
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>

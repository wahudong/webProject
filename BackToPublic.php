<!-- //this code is to move the comment text to commentText from commentText2. so the data will back to school -->

<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        // echo "<script LANGUAGE = 'javascript'> alert('Your Are Going to Delet the User'); </script>";
        $id=filter_input(INPUT_GET,'comID',FILTER_SANITIZE_NUMBER_INT);
        $itemID=filter_input(INPUT_GET,'itemID',FILTER_SANITIZE_NUMBER_INT);
        $text=filter_input(INPUT_GET,'contentText',FILTER_SANITIZE_SPECIAL_CHARS);
       
        print_r($_GET);

         
            $queryCommand = "SELECT commentText2 FROM comment WHERE commentID=:commentID";

            $statementCommand= $db->prepare($queryCommand);
            $statementCommand ->bindvalue(':commentID',$id);
            $statementCommand->execute();
            $row=$statementCommand->fetch();

            // echo "<br>";
            // print_r($row);
             
            $query='UPDATE comment SET commentText=:row, commentText2="" WHERE commentID=:id_bind';
            $statement=$db->prepare($query); 
            $statement->bindvalue(':id_bind',$id,PDO::PARAM_INT);
            $statement->bindvalue(':row',$row['commentText2']);           
            $statement->execute();        
        
    
        header('Location:edititem.php?id='.$itemID);
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>
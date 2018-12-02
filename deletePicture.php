
<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        // echo "<script LANGUAGE = 'javascript'> alert('Your Are Going to Delet the User'); </script>";
        $imageID=filter_input(INPUT_GET,'imageID',FILTER_SANITIZE_NUMBER_INT);
        $imagePath=filter_input(INPUT_GET,'path',FILTER_SANITIZE_SPECIAL_CHARS);
        // $itemID=filter_input(INPUT_GET,'itemID',FILTER_SANITIZE_NUMBER_INT);
        // $text=filter_input(INPUT_GET,'contentText',FILTER_SANITIZE_SPECIAL_CHARS);
       
        // print_r($_GET);

         
            $queryCommand = "SELECT imagePath FROM image WHERE imageID=:picID";

            $statementCommand= $db->prepare($queryCommand);
            $statementCommand ->bindvalue(':picID',$imageID);
            $statementCommand->execute();
            $imgPath=$statementCommand->fetch();

            // echo "<br>";
            // print_r($row);
             
            $query='DELETE FROM IMAGE WHERE imageID=:id_bind';
            $statement=$db->prepare($query); 
            $statement->bindvalue(':id_bind',$imageID,PDO::PARAM_INT);                
            $statement->execute();   
            
            unlink($imagePath);
        
    
        header('Location:itemPageManage.php');
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>
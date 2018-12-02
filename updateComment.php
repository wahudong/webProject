<!-- To update the category stored in the database. -->
<?php
    session_start();
    if (isset($_SESSION['loginUser'])) {
        include "connect.php";
        
        $id=filter_input(INPUT_GET,'comID',FILTER_SANITIZE_NUMBER_INT); 
        $itemID=filter_input(INPUT_GET,'itemID',FILTER_SANITIZE_NUMBER_INT);      
    
        if (isset($_POST['submitUpdate'])) {           
      
            $content=filter_input(INPUT_POST,'commentText',FILTER_SANITIZE_SPECIAL_CHARS);
            $comID=filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);

            // print_r($_POST);
            // echo '<br>';
            // print_r($content);
            // echo '<br>';
            // print_r($comID);
            // echo '<br>';

            $qureyUpdate="UPDATE  comment SET commentText=:content WHERE commentID=:id";
            $statement=$db->prepare($qureyUpdate);
            $statement->bindvalue(':id',$comID);
            $statement->bindvalue(':content',$content);
            $statement->execute();
            header('Location:editItem.php?id='.$itemID);

        }

        $query="SELECT commentID, commodityID, writerName, commentText FROM comment WHERE commentID=:id";
        $statement3=$db->prepare($query);
        $statement3->bindvalue(':id',$id);
        $statement3->execute();
        $comment=$statement3->fetch();

    //    print_r($categorie);
  
       
    }else{

        echo "<script LANGUAGE = 'javascript'> alert('Your can not access this page'); location.href='login.php' </script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>
    <h3>Please Enter Your comment to The Item</h3>
<form action="" method="POST" name="updateCategory" id="updateCategory">
<input type="hidden" name="id" value=<?=$id?>>



<textarea name="commentText" id="commentText" cols="30" rows="5"><?=$comment['commentText']?></textarea>
<input type="submit" name="submitUpdate" value="Save">

</form>

</body>
</html>

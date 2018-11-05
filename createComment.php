<?php
include "connect.php";
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Create New Comment</title>  
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body> 

<?php
     $new_comment=filter_input(INPUT_POST,'comment',FILTER_SANITIZE_SPECIAL_CHARS);
     $new_writer=filter_input(INPUT_POST,'writerName', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!isset($_SESSION['loginUser'])){
        $writer=$new_writer;
    }else {
        $writer=$_SESSION['loginUser'];
    }  

    $query="INSERT INTO comment (commodityID, writerName, commentText) VALUES(:commodityID, :writerName,:commentText)";
    $statement=$db->prepare($query);
    $commID=$_POST['commID'];
    $statement->bindvalue(':commodityID',$commID);
    $statement->bindvalue(':writerName',$writer);
    $statement->bindvalue(':commentText',$new_comment);
    $statement->execute();
    header('Location: itemDetail.php?comID='.$commID)

    ?>

</body>
</html>




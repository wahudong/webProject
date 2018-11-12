<?php   

session_start();
if(!isset($_SESSION['loginUser'])){
    include "authenticate.php";
    $_SESSION['loginUser']=1;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Bew Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="insertNewPage.php" method="post" name="editNewPage">
    <label for="title">Please Enter The Title</label>
    <input type="text" name="title" id="title">
    <br>
    <br>
    <label for="description">Please Enter The Description Here</label>
    <br>
    <textarea name="description" id="description" cols="50" rows="7" form="editNewPage"></textarea>
    <br>
    <br>
    <label for="price">Please Enter The Price Here</label>
    <input type="text" name="price" id="price">
    <br>
    <br>
    <input type="submit" value="SUBMIT" form="editNewPage">
    <input type="reset" value="reset" form="editNewPage">    
    </form>

</body>
</html>
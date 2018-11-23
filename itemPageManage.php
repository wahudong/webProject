<?php
session_start();
include "connect.php";

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Item page manage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="" />
    <script src=""></script>
</head>
<body>

<?php if (!isset($_SESSION['loginUser'])):?>
  
  <script LANGUAGE = "javascript"> 
      alert("Sorry, You are not allow to access this page!");
      location.href="login.php";
  </script>
<?php die();?>
<?php endif;?>


<a href="editNewPage.php">Create Nem Item Page</a>

<p><a href="manage.php">Back to manage page</a></p>

<fieldset>
    <legend>  New Itmes </legend>
        <form action="insterNewItem.php" method="post" name=newItems>
        
        <label for="title">Title</label>
        <input type="text" name="title">
        <br>
        <label for="description">Detailed description</label>
        <input type="text" name="description">
        <br>
        <label for="price">Price</label>
        <input type="number" name="price">        
        
        </form>
   
</fieldset>


    
</body>
</html>
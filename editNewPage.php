<?php 
session_start();
include "connect.php";

$queryCategory = "SELECT categoryID, categoryName FROM category";
    $statementCategory = $db->prepare($queryCategory);
    $statementCategory->execute();
    $rowArrayCategory=$statementCategory->fetchall();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit new item page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<?php if (!isset($_SESSION['loginUser'])):?>
  
  <script LANGUAGE = "javascript"> 
      alert("Sorry, You are not allow to access this page!");
      location.href="login.php";
  </script>
<?php die();?>
<?php endif;?>


<p><a href="manage.php">Back to manage page</a></p>

    <form action="insertNewPage.php" method="post" name="editNewPage" id="editNewPage">
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
    <input type="number" name="price" id="price" step="any">
    <br>
    <br>
    <label for="category">Please select category</label>
    <select name="category">

    <?php   foreach ($rowArrayCategory as $key => $value):?>
        <option value=<?=$value['categoryID']?>><?=$value['categoryName']?></option>
        <br>
    <?php endforeach;?>

    </select>
    <br>
    <br>

    <input type="submit" name="submit" value="SUBMIT" form="editNewPage">
    <input type="reset" name="reset" value="reset" form="editNewPage">   

    </form>

</body>
</html>
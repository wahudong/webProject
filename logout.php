<?php
session_start();
session_destroy();
echo "<script LANGUAGE = 'javascript'> alert('You have successfully longed out');location.href='index.php'; </script>";

?>
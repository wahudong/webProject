<?php
    define('DB_DSN','mysql:host=localhost;dbname=serverside;charset=utf8');
    define('DB_USER','serveruser');
    define('DB_PASS','gorgonzola7!');

    //CREATE A PDO OBJECT CALLED $db.
    try{
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    }catch(PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }
?>
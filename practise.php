elseif(isset($_POST['update']))







    if (!empty($id)&&!empty($name)) {        
        $query="UPDATE category SET categoryID=:id, categoryName=:name";

        $statement=$db->prepare($query); 
        $statement->bindvalue(':id',$id_current,PDO::PARAM_INT);
        $statement->bindvalue(':name',$name);       
        $statement->execute();        
    }


  
    header('Location: categaryManage.php');
    die();
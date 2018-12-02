<!-- To save the uploaded file, and resize it. -->
<?php


include"connect.php";
require('ImageResize.php');
use \Gumlet\ImageResize;

echo '<br>';
echo '<br>';

if (isset($_FILES['file']) && ($_FILES['file']['error']==0)) {

    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }

    
        // if (($_FILES['file']['type']=='image/jpg')
        // ||($_FILES['file']['type']=='image/png')
        // ||($_FILES['file']['type']=='image/gif')) {
        
        $filepath='image/'.$_FILES['file']['name'];

        if (file_is_an_image($_FILES['file']['tmp_name'], $filepath) ) {
           
            move_uploaded_file($_FILES['file']['tmp_name'], 'image'.DIRECTORY_SEPARATOR. $_FILES['file']['name'] );

            // $filepath='image/'.$_FILES['file']['name'];
            // $extention_name=pathinfo($filepath, PATHINFO_EXTENSION);           
               

                $image = new ImageResize($filepath);
                $image -> resizeToWidth(300);

                // $filename=pathinfo($filepath, PATHINFO_FILENAME);
                // $extention_name=pathinfo($filepath, PATHINFO_EXTENSION);
                // $newpath='uploads/'.$filename.'_medium.'.$extention_name;
                $image -> save($filepath);                    
                
                $itemID=filter_input(INPUT_POST,'itemID',FILTER_SANITIZE_NUMBER_INT);
                
                $qurey="INSERT INTO  IMAGE (commodityID,imagePath) VALUES(:commodityID, :imagePath)";
                $statement=$db->prepare($qurey);
                $statement->bindvalue(':commodityID',$itemID);
                $statement->bindvalue(':imagePath',$filepath);
                $statement->execute();       
                header('Location:itemPageManage.php');
                die();

        
            echo '<br>';
            // echo 'the original file stored at: '.'uploads'.DIRECTORY_SEPARATOR.$_FILES['file']['name'];

        }else{

            echo "invalide file type";
        }
}else{
    echo ' No file upload or uploaded error';
}

?>
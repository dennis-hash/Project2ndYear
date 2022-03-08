<?php
class upload extends db{
    
    protected function uploads($prodName, $prodPrice, $image){
        //'image'= $_FILES['image'];
        $file_name = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_error = $_FILES['image']['error'];
        $file_type = $_FILES['image']['type'];

       $fileExt = explode('.',$file_name);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpeg', 'jpg', 'png');
	

	
      if(in_array($fileActualExt, $allowed)){
      echo "in_array executed";
           if($file_error === 0){
                if($file_size < 1000000){
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'uploads/'. $fileNameNew;
                    //header("Location: adminPage.php?uploadSuccess");

                    move_uploaded_file($fileTmpName, $fileDestination );
                }
                else{
                    echo "file too big";
                }
            }else{
                echo "error uploading file";
            }
        }else{
            echo "this file type is not accepted";
        } 
    
    }
}
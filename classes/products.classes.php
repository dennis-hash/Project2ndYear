<?php
class Upload extends DB{
     private $fileDestination;
     private $prodName;
     private $prodPrice;
     private $prodImage;

    public function __construct($prodName, $prodPrice,$prodImage)
    {
        $this->prodName = $prodName;
        $this->prodPrice = $prodPrice;
        $this->prodImage = $prodImage;
       // $this->prod_img_tmp_name = $prod_img_tmp_name;
       // $this->prod_img_folder = $prod_img_folder;
       
    }

    protected function uploads(){
       
        $file_name = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_error = $_FILES['image']['error'];
        $file_type = $_FILES['image']['type'];

       $fileExt = explode('.',$file_name);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpeg', 'jpg', 'png');
	

	
      if(in_array($fileActualExt, $allowed)){
      
           if($file_error === 0){
                if($file_size < 1000000){
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $this->fileDestination = 'uploads/'. $fileNameNew;
                    //header("Location: adminPage.php?uploadSuccess");
                   // echo " $fileTmpName ";
                    //echo "$fileDestination";
                    move_uploaded_file($fileTmpName, $this->fileDestination );

                    //resizing image
                    if(file_exists($this->fileDestination )){
                        //echo "half way done!0.111";
                        $filePath = $this->fileDestination;
                        $src = imagecreatefrompng($filePath);
                        //echo "half way done!1";
                        list($w, $h) = getimagesize($filePath);
                        $max = 300;
                        $tw = $w;
                        $th = $h;
                        //echo "half way done!2";
                        if ($w > $h && $max < $w)
                        {
                            $th = $max / $w * $h;
                            $tw = $max;
                        }
                        
                        elseif ($h > $w && $max < $h)
                        {
                            $tw = $max / $h * $w;
                            $th = $max;
                        }
                        elseif ($max < $w)
                        {
                            $tw = $th = $max;
                        }
                        //echo "half way done!3";
                        $tmp = imagecreatetruecolor($tw, $th);
                        //echo "half way done!4";
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                        //echo "half way done!5";
                        imageconvolution($tmp, array(array(-1, -1, -1),
                        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                       // echo "half way done!6";
                        imagepng($tmp, $filePath);
                        
                        //echo "half way done!";
                        imagedestroy($tmp);
                        imagedestroy($src);
                    }
                    $userName = $_SESSION['user'];
                  
                    //echo " $this->prodName, $this->prodPrice,$this->fileDestination   ";
                    $connection = $this->connect();
                    $userId = $this->queryMysql("SELECT userID FROM users WHERE username ='$userName';");
                    if($userId->num_rows == 0){
                        $results =NULL;
                        header("location: ../includes/login.php?error=userIDnotfound");
                        exit();
                    }else{
                        while($row = $userId->fetch_assoc()){
                            $userID = $row["userID"];
                        }
                    }

                   // echo "helllll $userID,$this->prodName, $this->prodPrice,$this->fileDestination";
                    $connection = $this->connect();
                    $this->queryMysql( "INSERT INTO products(userID, productName, price, imagePath) VALUES('$userID','$this->prodName',' $this->prodPrice','$this->fileDestination');");
                    

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
   /* protected function resizeImage($file){
        $filePath = $file;
        if(file_exists($filePath)){
            //echo "half way done!0.111";
            $src = imagecreatefrompng($filePath);
            //echo "half way done!1";
            list($w, $h) = getimagesize($filePath);
            $max = 300;
            $tw = $w;
            $th = $h;
            //echo "half way done!2";
            if ($w > $h && $max < $w)
            {
                $th = $max / $w * $h;
                $tw = $max;
            }
            
            elseif ($h > $w && $max < $h)
            {
                $tw = $max / $h * $w;
                $th = $max;
            }
            elseif ($max < $w)
            {
                $tw = $th = $max;
            }
            //echo "half way done!3";
            $tmp = imagecreatetruecolor($tw, $th);
            //echo "half way done!4";
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
            //echo "half way done!5";
            imageconvolution($tmp, array(array(-1, -1, -1),
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
           // echo "half way done!6";
            imagepng($tmp, $filePath);
            
            //echo "half way done!";
            imagedestroy($tmp);
            imagedestroy($src);

            return $filePath;
            
        } 
    }*/

    protected function displayProducts(){
       // $a = array();
       // $pName = array();
       // $pPrice = array();
       // $pImage = array();

        
        $userName = $_SESSION['user'];
        $result =  $this->queryMysql( "SELECT products.productName, products.price, products.imagePath FROM products JOIN users ON products.userID = users.userID;");
        $noRows=$result->num_rows;
        echo  '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="styles.css">
                    
                </head>
               
                
            ';
        
        echo "<table >
                <tr>
                    <th>No.</th>
                    <th>Product Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Edit</th>
                    
                </tr>";
       // while($row = $result->fetch_assoc()){
       //     $i = 0;
       //     $productName = $row["productName"];
       //     $productPrice = $row["price"];
       //     $imagepath = $row["imagePath"];
       //     $image = $this->resizeImage($imagepath);

            //$pName = array_push($productName );
            //$pPrice = array_push($productPrice );
            //$pImage = array_push( $image );
        
            
                //for($i = 0;$i < $noRows; $i++){
                   /* echo '
                    <tr>
                        <td>'. $i++ . '</td>
                        <td>'.$productName .'</td>
                        <td>'.$productPrice .'</td>
                        <td>'. "<img src = '$image' >" .'</td>
                    </tr>
                    ';
                //}   */
       // }
       // echo "in resize end";
      // $a = array_push($pName, $pPrice,  $pImage, $rows ); 
       //echo "$a";
       // return $a;

       for($j=0; $j<$noRows; ++$j){
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $imagepath = htmlspecialchars($row["imagePath"]);
       
        echo '
            <tr>
                <td>'.$j .'</td>
                <td>'. htmlspecialchars($row['productName']) . '</td>
                <td>'.htmlspecialchars($row['price']) .'</td>
                <td>'. "<img src = '$imagepath' >" .'</td>
            </tr>
            ';
        
        }
       
    }




}


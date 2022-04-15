<?php
class Upload extends DB{
    private $destination;
    private $prodName;
    private $prodPrice;
    private $prodDescription;
    private $prodQuantity;
    private $prodCategory;
    private $prodSubCategory;
    private $County;
    private $prodSubCounty;
    private $prodTitle;
    
    
   
    public function __construct($prodName, $prodPrice,$prodImage,$prodDescription,$prodQuantity,$prodCategory,$prodSubCategory,$County,$prodSubCounty){
        $this->prodName = $prodName;
        $this->prodPrice = $prodPrice;
        $this->prodDescription = $prodDescription;
        $this->prodQuantity = $prodQuantity;
        $this->prodCategory = $prodCategory;
        $this->prodSubCategory = $prodSubCategory;
        $this->County = $County;
        $this->prodSubCounty = $prodSubCounty;
  
    }
    
    
   protected function uploadToFolder(){
       
        $file_name =  $_FILES['image']['name'];
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
                    $this->destination = 'uploads/'. $fileNameNew;
                    move_uploaded_file($fileTmpName, $this->destination );

                    //resizing image
                    if(file_exists($this->destination )){
                       
                        $filePath = $this->destination;
                        $src = imagecreatefrompng($filePath);
                       
                        list($w, $h) = getimagesize($filePath);
                        $max = 300;
                        $tw = $w;
                        $th = $h;
                    
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
                      
                        $tmp = imagecreatetruecolor($tw, $th);
                      
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                       
                        imageconvolution($tmp, array(array(-1, -1, -1),
                        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                      
                        imagepng($tmp, $filePath);
                        
                     
                        imagedestroy($tmp);
                        imagedestroy($src);
                    }
                    $userName = $_SESSION['user'];

                    $userid = $this->getUserID($userName);
  
                    foreach($userid as $userid){
                       $userid = $userid['userID'];
                    }
                    $this->insertProduct($userid,$this->prodName, $this->prodPrice, $this->destination, $this->prodDescription, $this->prodQuantity, $this->prodCategory, $this->prodSubCategory, $this->County, $this->prodSubCounty, $this->prodTitle);
                  
                    
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

    //get userID
    public function getUserID($userName){
       
        $query = "SELECT `userID` FROM `users` WHERE `userName` = :userName";

        $stmt = $this->dbConnection()->prepare($query);
     
        $stmt->execute(array(':userName' => $userName));
    
        $result = $stmt->fetch();
     
        return $result;
    }
    //insert products
    public function insertProduct($userID, $productName, $price, $imagePath,$prodDescription, $prodQuantity, $prodCategory, $prodSubCategory, $County, $prodSubCounty, $prodTitle){
        $query = "INSERT INTO `products`(`userID`, `productName`, `price`, `imagePath`,`productDescription`,`prodQuantity`,`prodCategory`,`prodSubCategory`,`County`,`SubCounty`,`Title`) VALUES (:userID, :productName, :price, :imagePath, :prodDescription, :prodQuantity, :prodCategory, :prodSubCategory, :County, :prodSubCounty, :prodTitle)";
        $stmt = $this->dbConnection()->prepare($query);
        $stmt->execute(array(':userID' => $userID, ':productName' => $productName, ':price' => $price, ':imagePath' => $imagePath, ':prodDescription' => $prodDescription, ':prodQuantity' => $prodQuantity, ':prodCategory' => $prodCategory, ':prodSubCategory' => $prodSubCategory, ':County' => $County, ':prodSubCounty' => $prodSubCounty, ':prodTitle' => $prodTitle));
     
    }
   
}


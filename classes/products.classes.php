<?php
session_start();
 require_once 'dbConnect.class.php';
       

 $uploadProduct = new Upload();

class Upload {
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
    
    
   
    public function __construct(){
        $db=new DB();
        $this->DB = $db->dbConnection();
        $this->prodName = $_POST['product_name'];
        $this->prodPrice = $_POST['product_price'];
        $this->prodDescription = $_POST['textarea'];
        $this->prodQuantity = $_POST['product_quantity'];
        $this->prodCategory = $_POST['category'];
        $this->prodSubCategory =  $_POST['subcategory'];
        $this->County = $_POST['county'];
        $this->prodSubCounty = $_POST['subcounty'];
        $this->title = $_POST['title'];
        $this->content = $_POST['content'];
        $this->author = $_POST['author'];
        $this->created_at = $_POST['date'];
        
        if($_POST['edit']==='edit'){
            $this->editProducts($_POST['index']);
        }elseif($_POST['action']==='insert_article'){
            $this->insert_article();
        }
        else{
           
            $this->uploadProducts();   
        }
  
    }
    
    private function emptyInputs()
    {
        
        if(empty($this->prodName) || empty($this->prodPrice) || empty($this->prodImage) || empty( $this->prodDescription) || empty($this->prodQuantity) || empty($this->prodCategory) || empty($this->prodSubCategory) || empty($this->County) || empty($this->prodSubCounty)){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }
    public function uploadProducts()
    {
        
        $this->insertProduct();

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
                if($file_size < 10000000){
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $this->destination = '../includes/uploads/'. $fileNameNew;
                move_uploaded_file($fileTmpName, $this->destination );

                    //resizing image
                   if(file_exists($this->destination )){
                       
                       /* $filePath = $this->destination;
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
                        imagedestroy($src);*/
                    }
                    
                   
                   // $this->insertProduct ($userid,$this->prodName, $this->prodPrice, $this->destination, $this->prodDescription, $this->prodQuantity, $this->prodCategory, $this->prodSubCategory, $this->County, $this->prodSubCounty, $this->prodTitle);
                  
                    
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
        return $this->destination; 
    
    }

    //get userID
    public function getUserID($userName){
       
        $query = "SELECT `userID` FROM `users` WHERE `userName` = :userName";

        $stmt = $this->DB->prepare($query);
     
        $stmt->execute(array(':userName' => $userName));
    
        $result = $stmt->fetch();
     
        return $result;
    }
    //insert products
    public function insertProduct(){
        $userName = $_SESSION['user'];
        $userid = $_SESSION['user_id'];
        foreach($userid as $userid){
            $userid = $userid['userID'];
        }
        //           
        $this->imagePath=$this->uploadToFolder();
      //
        $query = "INSERT INTO `products`(`userID`, `productName`, `price`, `imagePath`,`productDescription`,`prodQuantity`,`prodCategory`,`prodSubCategory`,`County`,`SubCounty`,`Title`) VALUES (:userID, :productName, :price, :imagePath, :prodDescription, :prodQuantity, :prodCategory, :prodSubCategory, :County, :prodSubCounty, :prodTitle)";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':userID'=>$userid, ':productName'=>$this->prodName, ':price'=>$this->prodPrice, ':imagePath'=>$this->imagePath, ':prodDescription'=>$this->prodDescription, ':prodQuantity'=>$this->prodQuantity, ':prodCategory'=>$this->prodCategory, ':prodSubCategory'=>$this->prodSubCategory, ':County'=>$this->County, ':prodSubCounty'=>$this->prodSubCounty, ':prodTitle'=>$this->prodTitle));
        echo "<p style='color:green;'>Added successfully</p>";
     
    }
    //edit products
    public function editProducts($prodID){
        $this->imagePath=$this->uploadToFolder();
        $query = "UPDATE `products` SET `productName`=:productName,`price`=:price,`imagePath`=:imagePath,`productDescription`=:productDescription,`prodQuantity`=:prodQuantity,`prodCategory`=:prodCategory,`prodSubCategory`=:prodSubCategory,`County`=:County,`SubCounty`=:SubCounty,`Title`=:Title WHERE `productID`=:productID";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':productName' => $this->prodName, ':price' => $this->prodPrice, ':imagePath' => $this->imagePath, ':productDescription' => $this->prodDescription, ':prodQuantity' => $this->prodQuantity, ':prodCategory' => $this->prodCategory, ':prodSubCategory' => $this->prodSubCategory, ':County' => $this->County, ':SubCounty' => $this->prodSubCounty, ':Title' => $this->prodTitle, ':productID' => $prodID));
       
    }
    public function insert_article(){
        $this->imagepath=$this->uploadToFolder();
        $query = "INSERT INTO `articles`(`title`, `content`, `author`, `created_at`,`imagepath`) VALUES (:title, :content, :author, :created_at, :imagepath)";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':title' => $this->title, ':content'=>$this->content,':author'=>$this->author,':created_at'=>$this->created_at ,':imagepath'=>$this->imagepath));
        echo"(':title' => $this->title, ':content'=>$this->content,':author'=>$this->author,':created_at'=>$this->created_at ,':imagepath'=>$this->imagepath))";
        echo "<h1>Article added successfully</h1>";
       
    }
   
}


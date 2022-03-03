<?php
class productController extends upload{
    private $prodName;
    private $prodPrice;
    private $prodImage;
    private $prod_img_tmp_name;
    private $prod_img_folder;
   

    public function __construct($prodName, $prodPrice,$prodImage, $prod_img_tmp_name, $prod_img_folder )
    {
        $this->prodName = $prodName;
        $this->prodPrice = $prodPrice;
        $this->prodImage = $prodImage;
        $this->prod_img_tmp_name = $prod_img_tmp_name;
        $this->prod_img_folder = $prod_img_folder;
       
    }
    //error handling for the inputs
    private function emptyInputs()
    {
        
        if(empty($this->prodName) || empty($this->prodPrice) || empty($this->prodImage)){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }
    public function uploadProducts()
    {
       echo "$this->prodName";
       echo "$this->prodPrice";
       echo "$this->prodImage";
        if($this->emptyInputs() == false){
           //header("location: adminPage.php?error=emptyInputs");
           
           exit();
        }
        
        $this->uploadProduct($this->prodName, $this->prodPrice, $this->prodImage, $this->prod_img_tmp_name, $this->prod_img_folder);
        
    }

}
<?php
class productController extends upload{
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
      
       if($this->emptyInputs() == false){
           header("location: AddProducts.php?error=emptyInputs");
           exit();
        }
        echo "heyy!!";
        $this->uploads($this->prodName, $this->prodPrice, $this->prodImage);
        
    }

}
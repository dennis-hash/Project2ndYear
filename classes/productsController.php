<?php
class productController extends Upload{
    private $fileDestination;
    private $prodName;
    private $prodPrice;
    private $prodDescription;
    private $prodQuantity;
    private $prodCategory;
    private $prodSubCategory;
    private $County;
    private $prodSubCounty;
   
    
   
    public function __construct($prodName, $prodPrice,$prodImage,$prodDescription,$prodQuantity,$prodCategory,$prodSubCategory,$County,$prodSubCounty){
        $this->prodName = $prodName;
        $this->prodPrice = $prodPrice;
        $this->prodImage = $prodImage;
        $this->prodDescription = $prodDescription;
        $this->prodQuantity = $prodQuantity;
        $this->prodCategory = $prodCategory;
        $this->prodSubCategory = $prodSubCategory;
        $this->County = $County;
        $this->prodSubCounty = $prodSubCounty;
        
    }
    //error handling
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

       $uploadAndDisplay = new Upload($this->prodName, $this->prodPrice,$this->prodImage,$this->prodDescription,$this->prodQuantity,$this->prodCategory,$this->prodSubCategory,$this->County,$this->prodSubCounty);
       $uploadAndDisplay->uploadToFolder();

    }

}
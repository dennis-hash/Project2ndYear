<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../includes/ains.css">
</head>
<?php
include "header.php";
//$product->searched_prod();
require_once '../classes/dbConnect.class.php';


class Search extends DB{
    private $productName;
    private $productPrice;
    private $productDescription;
    private $county;
    private $subcounty;
    private $category;
    private $productImage;
    private $difference;
    private $created_at;
    
  public function searched_prod(){
        $title = $_GET['title'];
        $date_time = $_GET['date'];
       
        $sql = "SELECT * FROM `products` WHERE `productName` = :prodName AND `created_at` = :date_time ";
        $stmt = $this->dbConnection()->prepare($sql);
        $stmt->execute(array(':prodName' => $title, ':date_time' => $date_time));
       
        $result = $stmt->fetchALL();
        $num_row = $stmt->rowCount();
       
        
       foreach($result as $row) {
       
                    $this->productName = $row['productName'];
                    $this->productPrice = $row['price'];
                    $this->productImage = $row['imagePath'];
                    $this->productDescription = $row['description'];
                    $this->county = $row['County'];
                    $this->subcounty = $row['SubCounty'];
                    $this->category = $row['Category'];
                    $this->subcategory = $row['prodSubCategory'];
                    $this->difference = $row['difference'];
                    $this->created_at = $row['created_at'];
                    echo "<a class='product' href =' search.php?title = ". $this->productName."&date = ".$this->created_at."'>

                    <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
                    <div class='prod'>
                    <div class = 'prodname'>  <p>$this->productName </p></div>
                    <div class = 'prodprice'> <p>Price: $this->productPriceKsh Ksh</p></div>
                    <div class = 'prodcategory'> <p>Category: $this->category </p></div>
                    <div class = 'proddesc'> <p>Decription: $this->productDescription </p></div>
                    <div class = 'prodlocation'> <p>$this->county $this->subcounty </p></div>
                    <div class = 'prodtime'><p> Posted:  $this->difference Hrs ago</p></div>
                   </div>
                   </a>";
                }
    } 
    

 
}

$d = new dd();

//$d->searched_prod();


?>
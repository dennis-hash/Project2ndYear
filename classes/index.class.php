<?php
     require_once 'dbConnect.class.php';
 
     $product = new Product();
     
     if($_GET['action'] === 'display_products'){
       $product->dispProduct();
     
     }
     if($_POST['action'] === 'search'){
     
       $product->search($_POST);
     }
     
    class Product {
        private $productName;
        private $productPrice;
        private $productDescription;
        private $county;
        private $subcounty;
        private $category;
        private $productImage;
        private $difference;
        private $created_at;
        private $output;
        private $DB;

        public function __construct(){
            $db=new DB();
            $this->DB = $db->dbConnection();
        }
       /* public function get_elements(){
            
            
                
        $search = $_POST['search'];
        
        $this->search($search);
                
                
            
        }*/

        public function dispProduct(){
           
           date_default_timezone_set('Africa/Nairobi');
         
            $query = "SELECT * FROM `products`";
            $stmt = $this->DB->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll();
            
           foreach($results as $row){
                 $this->id=$row['userID'];
                 $this->prodid=$row['productID'];
                $this->productName = $row['productName'];
                $this->productPrice = $row['price'];
                $this->productImage = $row['imagePath'];
                $this->productDescription = $row['productDescription'];
                $this->county = $row['County'];
                $this->subcounty = $row['SubCounty'];
                $this->category = $row['prodCategory'];
                $this->difference = $row['difference'];
                $this->created_at = $row['created_at'];

                $created_at = new DateTime(date('Y-m-d H:i:s', strtotime($this->created_at)));
                $curr_time=new DateTime(date('Y-m-d H:i:s'));
                $this->difference=$created_at->diff($curr_time);
                $this->difference = $this->difference->format('%H');
                echo"<a class='product' href='../includes/product_page.php?title=".$this->productName."=".$this->created_at."=".$this->id."=". $this->prodid."'>
    
                    <!-- <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>-->
                    <div class='prod'>
                    <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
                    <div class = 'prodname'>  <p>$this->productName </p></div>
                    <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>
                    <div class = 'prodcategory'> <p>Category: $this->category </p></div>
                    <div class = 'proddesc'> <p>$this->productDescription</p></div>
                    <div class = 'prodlocation'> <p><img class = 'icon' src='../images/location-dot-solid.svg' alt=''>$this->county, $this->subcounty </p></div>
                    <div class = 'prodtime'><p> Posted:$this->difference Hrs ago</p></div>
                    </div>
                </a>";
            }
         
        }
        
        
        public function getAll(){
            
            $query = "SELECT * FROM `products`";
            $stmt = $this->DB->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    
        public function search($data){
            
           
                $search = $data['search'];
            
                $sql = "SELECT * FROM products WHERE productName LIKE '%$search%' OR productDescription LIKE '%$search%' OR prodQuantity LIKE '%$search%' OR prodCategory LIKE '%$search%' OR prodSubCategory LIKE '%$search%' OR County LIKE '%$search%' OR SubCounty LIKE '%$search%' OR Title LIKE '%$search%'";
                $result = $this->DB->query($sql);
                $num_row = $result->rowCount();
                if($num_row > 0){
                    while($row = $result->fetch(PDO::FETCH_GROUP |PDO::FETCH_ASSOC)){
                        $this->id=$row['userID'];
                        $this->productName = $row['productName'];
                        $this->productPrice = $row['price'];
                        $this->productImage = $row['imagePath'];
                        $this->productDescription = $row['productDescription'];
                        $this->county = $row['County'];
                        $this->subcounty = $row['SubCounty'];
                        $this->category = $row['prodCategory'];
                        $this->difference = $row['difference'];
                        $this->created_at = $row['created_at'];
                        $created_at = new DateTime(date('Y-m-d H:i:s', strtotime($this->created_at)));
                        $curr_time=new DateTime(date('Y-m-d H:i:s'));
                        $this->difference=$created_at->diff($curr_time);
                        $this->difference = $this->difference->format('%H');
                        echo"<a class='product' href='../includes/product_page.php?title=".$this->productName."=".$this->created_at."=".$this->id."'>
                            <div class='prod'>
                            <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
                            <div class = 'prodname'>  <p>$this->productName </p></div>
                            <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>
                            <div class = 'prodcategory'> <p>Category: $this->category </p></div>
                            <div class = 'proddesc'> <p>$this->productDescription</p></div>
                            <div class = 'prodlocation'> <p><img class = 'icon' src='../images/location-dot-solid.svg' alt=''>$this->county, $this->subcounty </p></div>
                            <div class = 'prodtime'><p> Posted:$this->difference Hrs ago</p></div>
                            </div>
                        </a>";
                  
                    }
                    
                    
                }
                else{
                    $this->output .= "no results found";
                   
                }
            
            
            
        }
        
    }
    
    
            
?>
       
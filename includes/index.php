<?php
    session_start();
    if (isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        
    }
    
   
    require_once '../classes/dbConnect.class.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MStore</title>
    <link rel="stylesheet" href="ains.css">
<body>

    <header>
    <div class="navlinks">
        <img src="../images/menu.svg" alt="" onclick="toggleNav()">
        <div class="search">
            <input type="search" name="search" id="search" placeholder="search">
        </div>
       
        
            <?php
                if($loggedin){
             
                echo<<< _INIT
                <li><a href="#">$user</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                <li><a href="AddProducts.php">SELL</a></li>
                <li><a href="logout.php">Logout</a></li>
               _INIT;
                }
                else{
        
            echo <<< _END
                <li><a href="singup.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="AddProducts.php">SELL</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                
                _END;
                }
            ?>
        </div>
    </header>
   
    <!--side bar-->
    <aside class="sidebar">
        <ul>
            <li><span>Categories</span></li>
            <li><a href="#">Farm and Machinery</a></li>
            <li><a href="Register.php">Feeds and Supplements</a></li>
            <li><a href="records.php">Livestock & Poultry</a></li>
            <li><a href="#">Fertilizers</a></li>
            <li><a href="#">Pesticides & insecticides</a></li>
            <li><a href="#">Agroservice</a></li>
        </ul>
    </aside>
    
    <div class="allProducts">
        <?php
            class Product extends DB {
                private $productName;
                private $productPrice;
                private $productDescription;
                private $county;
                private $subcounty;
                private $category;
                private $productImage;
                private $difference;
                private $created_at;

                public function __construct(){}

                public function dispProduct(){
                    date_default_timezone_set('Africa/Nairobi');
                    $results = $this->getAll();
                   foreach($results as $row){
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

                        $created_at = new DateTime(date('Y-m-d H:i:s', strtotime($this->created_at)));
                        $curr_time=new DateTime(date('Y-m-d H:i:s'));
                        $this->difference=$created_at->diff($curr_time);
                        $this->difference = $this->difference->format('%H');
                        echo "<div class='product'>
         
                            <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
                         <div class='prod'>
                            <div class = 'prodname'>  <p>$this->productName </p></div>
                            <div class = 'quantitySold'>  <p>Sold in Bulk</p></div>
                            <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>"
                            . "<div class = 'proddesc'> <p>$this->productDescription </p></div>"
                            . "<div class = 'prodcounty'> <p>$this->county </p></div>"
                            . "<div class = 'prodsubcounty'> <p>$this->subcounty </p></div>"
                            . "<div class = 'prodcategory'> <p>$this->category </p></div>"
                            . "<div class = 'prodsubcategory'> <p>$this->subcategory </p></div>"

                            . "<div class = 'prodview'> <a href='#'>View</a></div>"
                            . "<div class = 'prodbuy'> <a href='#'>Buy</a></div>"
                            . "<div class = 'prodName'><p> Posted:  $this->difference Hrs ago</p></div>
                           </div>
                        </div>";
                    }
                }
                
                
                public function getAll(){
                   
                    $query = "SELECT * FROM `products`";
                    $stmt = $this->dbConnection()->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    return $result;
                }
            }
            $product = new Product();
            $product->dispProduct();
        ?>
       
    </div>
       
</body>
<script src="mains.js"></script> 
</html>
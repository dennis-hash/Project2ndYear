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
        
        
            <?php
                if($loggedin){
             
                echo<<< _INIT
                "<li><a href="#">$user</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                <li><a href="AddProducts.php">SELL</a></li>
                <li><a href="logout.php">Logout</a></li>
               _INIT;
                }
                else{
        
            echo <<< _END
                <li><a href="singup.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="#">Cart</a></li>
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
            <li><a href="#">Fruits</a></li>
            <li><a href="Register.php">Vegitables</a></li>
            <li><a href="records.php">Records</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contacts</a></li>
        </ul>
    </aside>
    <a href="login.php">
    <div class="allProducts">
        <?php
            class Product extends DB {
                private $productName;
                private $productPrice;
                private $productDescription;
                private $location;
                private $category;
                private $productImage;
                private $difference;

                public function __construct(){}

                public function dispProduct(){
                    date_default_timezone_set('Africa/Nairobi');
                    $results = $this->getAll();
                   foreach($results as $row){
                        $this->productName = $row['productName'];
                        $this->productPrice = $row['price'];
                        $this->productImage = $row['imagePath'];
                        $created_at = $results['created_at'];
                        $created_at = new DateTime(date('Y-m-d H:i:s', strtotime($created_at)));
                         $curr_time=new DateTime(date('Y-m-d H:i:s'));
                        $this->difference=$created_at->diff($curr_time);
                        $this->difference = $this->difference->format('%H');
                        echo "<div class='product'>
                            <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
                            <div class = 'prodname'>  <p>$this->productName </p></div>
                            <div class = 'quantitySold'>  <p>Sold in Bulk</p></div>
                            <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>";
                       echo "<div class = 'prodName'><p> Posted:  $this->difference Hrs ago</p></div>
                           
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
        </a>
</body>
<script src="mains.js"></script> 
</html>
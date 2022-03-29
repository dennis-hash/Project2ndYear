
<?php
 include "index.php";
 require_once '../classes/dbConnect.class.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="allProducts">
        <?php
            class Product extends DB {
                public function __construct(){}
                public function dispProduct(){
                    $this->connect();
                    $sql = "SELECT * FROM products;";
                    $results = $this->queryMysql($sql);
                    while($row = $results->fetch_assoc()){
                        $productName = $row['productName'];
                        $productPrice = $row['price'];
                        $productImage = $row['imagePath'];
                        echo "<div class='product'>
                            <img src='$productImage' alt='$productName'>
                            <p>$productName </p>
                            <p>Sold in Bulk</p>
                            <p>Ksh $productPrice </p>
                            <form action='cart.php' method='post'>
                                <input type='hidden' name='productName' value='$productName'>
                                <input type='hidden' name='productPrice' value='$productPrice'>
                                <input type='hidden' name='productImage' value='$productImage'>
                                <input type='submit' name='addToCart' value='Add to Cart'>
                            </form>
                        </div>";
                    }
                }
            }
            $product = new Product();
            $product->dispProduct();
        ?>
       
    </div>
</body>
</html>
<?php
if(isset($_POST['add'])){
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $image = $_FILES['product_image'];

   
    include "../classes/dbConnect.class.php";
    include "../classes/products.classes.php";
    include "../classes/productsController.php";

    $this -> uploadProduct($productName, $productPrice, $image);
}
      
	
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
    <header>
        <h3>Admin Panel </h3>
    </header>
    <div class="addProduct">
        <form  action="" method="POST" enctype="multipart/form-data">
          <ul>
            <p>Product name</p>
            <input type="text" placeholder="Product name" name="product_name">
            <p>Price</p>
            <input type="number" placeholder="Product price" name="product_price">
            <p>Upload image</p>
            <input type="file" name="product_image">
            <input type="submit" name="add" value="ADD">
            </ul>
        </form>
    </div>
</body>
</html>




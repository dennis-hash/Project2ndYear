<?php
//session_start();
include_once "index.php";
session_start();
if(isset($_POST['add'])){
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    include "../classes/dbConnect.class.php";
    include "../classes/products.classes.php";
    include "../classes/productsController.php";


  
   $uploadProduct = new productController($productName, $productPrice, $_FILES);
   $uploadProduct->uploadProducts();
   
}

   
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <header>

   </header>
    <div class="addProduct">
        <form  action="AddProducts.php" method="post" enctype="multipart/form-data">
          <ul>
         <!-- <label>Category</label>
              <select name="category" >
                <option value="">Vegetable</option>
                <option value="Mombasa">Cereals</option>                  
                <option value="Kwale">Fruits</option>
                <option value="Kilifi">Tubers</option>
                <option value="Kilifi">Legumes</option>
              </select>-->
            <p>Product name</p>
            <input type="text" placeholder="Product name" name="product_name">
          <!--  <p>Quantity in Kgs</p>
            <input type="number" placeholder="Quantity" name="product_quantity">-->
            <p>Price</p>
            <input type="number" placeholder="Product price" name="product_price">
            <p>Upload</p>
            <input type="file" name='image'>
            <input type="submit" name="add" value="ADD">
            </ul>
        </form>
    </div>
    <div class="displayProducts">
        <?php
   
        require_once "../classes/dbConnect.class.php";
        class DisplayRecords extends DB {
            public function __construct()
            {
                
            }
           public function display(){
               
               $userName = $_SESSION['user'];
                $this->connect();
                $result =  $this->queryMysql( "SELECT products.productName, products.price, products.imagePath FROM products JOIN users ON products.userID = users.userID;");
               $noRows=$result->num_rows;
                echo "<div class = 'dispRecords'>";
                       
                echo "
                     <table >
                        <tr>
                            <th>No.</th>
                            <th>Product Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Edit</th>
                            
                        </tr>";

                for($j=0; $j<$noRows; ++$j){
                    $row=$result->fetch_array(MYSQLI_ASSOC);
                    $imagepath = htmlspecialchars($row["imagePath"]);
                   
                    echo '
                        <tr>
                            <td>'.$j .'</td>
                            <td>'. htmlspecialchars($row['productName']) . '</td>
                            <td>'.htmlspecialchars($row['price']) .'</td>
                            <td>'. "<img src = '$imagepath' width='40' height='50'>" .'</td>
                            <td>'. "<input type='submit' name='edit' value='Edit'> <br>
                            <input type='submit' name='delete' value='Delete'>" .'</td>
                        </tr>
                        ';
                    echo"
                    </div>";

                    if(isset($_POST['delete'])){
                        $this->delete(); 
                    }
                    if(isset($_POST['edit'])){
                        $this->edit(); 
                    }

                    }
                   
            }
            public function delete(){

            }
            public function edit(){

            }
            
        }
        $disp = new DisplayRecords();
        $disp->display();
        ?>
    </div>
</body>
</html>




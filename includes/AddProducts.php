<?php
//session_start();

session_start();
include 'header.php';
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
   <div class = "contain">
    <div class="addProduct">
        <form  action="AddProducts.php" method="post" enctype="multipart/form-data">
         <div class = "grid">
             <div class ='data'>
          <p>Category</p>
              <select name="category">
                <option value="">--select-- </option>
                <option value="Farm Machinery & Equipments">Farm Machinery & Equipments</option>
                <option value="Feeds, Supplements & Seeds">Feeds, Supplements & Seeds</option>                  
                <option value="Livestock & Poultry">Livestock & Poultry</option>
                <option value="Fertilizers & Chemicals">Fertilizers & Chemicals</option>
                <option value="Pesticides & Insecticides">Pesticides & Insecticides</option>
                <option value="Agro-Processing">Agro-Processing</option>
                <option value="Agro-Services">Agro-Services</option>

              </select>
              </div>
              <div class="data">
            <p>County</p>
            <select required name="county" id="county">
                <option value="">--select-- </option>
                <option value="Mombasa">Mombasa </option>                  
                <option value="Kwale">Kwale</option>
                <option value="Kilifi">Kilifi</option>
                <option value="Tana River">Tana River</option>
                <option value="Lamu">Lamu </option>
                <option value="Taita Taveta">Taita Taveta </option>
                <option value="Garissa">Garissa</option>
                <option value="Wajir"> Wajir</option>
                <option value="Mandera"> Mandera</option>
                <option value="Marsabit"> Marsabit</option>
                <option value="Isiolo"> Isiolo</option>
                <option value="Meru"> Meru </option>
                <option value="Tharaka Nithi"> Tharaka Nithi </option>
                <option value="Embu">  Embu</option>
                <option value="Kitui">  Kitui</option>
                <option value="Machakos">  Machakos</option>
                <option value="Makueni">  Makueni</option>
                <option value="Nyandarua">  Nyandarua </option>
                <option value="Nyeri">  Nyeri</option>
                <option value="Kirinyaga">  Kirinyaga </option>
                <option value="Muranga">  Murang’a </option>
                <option value="Kiambu">  Kiambu</option>
                <option value="Turkana">   Turkana </option>
                <option value="West Pokot">   West Pokot</option>
                <option value="Samburu">   Samburu </option>
                <option value="Trans Nzoia">   Trans-Nzoia </option>
                <option value="Uasin Gishu">   Uasin Gisshu</option>
                <option value="Elgo Marakwet">   Elgeyo Marakwet</option>
                <option value="Nandi">   Nandi</option>
                <option value="Baringo">   Baringo</option>
                <option value="Laikipia">   Laikipia</option>
                <option value="Nakuru">   Nakuru</option>
                <option value="Narok">   Narok</option>
                <option value="Kajiado">   Kajiado</option>
                <option value="Kericho">   Kericho</option>
                <option value="Bomet">   Bomet</option>
                <option value="Kakamega">   Kakamega</option>
                <option value="Vihiga">   Vihiga </option>
                <option value="Bungoma">   Bungoma </option>
                <option value="Busia">   Busia </option>
                <option value="Siaya">   Siaya </option>
                <option value="Kisumu">   Kisumu </option>
                <option value=" Homa Bay">   Homa Bay </option>
                <option value="Migori">   Migori</option>
                <option value="Kisii">   Kisii </option>
                <option value="Nyamira">   Nyamira</option>
                <option value="Nairobi">   Nairobi</option>
            </select>
            </div>
              <div class="data">
                <p>Sub County</p>
                <input type="text" name = "subcounty" placeholder="Sub County">
            </div>
            <div class="data">
                <p>Product name</p>
                <input type="text" placeholder="Title" name="product_name">
            </div>
            <div class="data">
                <p>Quantity in Kgs</p>
                <input type="text" placeholder="Quantity" name="product_quantity">
            </div>
            <div class="data">
                <p>Price</p>
                <input type="text" placeholder="Product price" name="product_price">
            </div>
            <div class="data">
                <p>Upload file</p>
                <input class = "file" type="file" name='image'>
            </div>
            </div>
            <div class = "textarea">
                <p>Description</p>
                <textarea  name="textarea" id="" cols="30" rows="7" placeholder="Type here..."></textarea>
            </div>
            <div class="datasubmit">
                <input type="submit" name="add" value="ADD">
            </div>
           
        </form>
    </div>
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
                            <td>'. "    <img src = '$imagepath' width='40' height='50'>" .'</td>
                                <td>'. "    <input type='submit' name='edit' value='Edit'> <br>
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
        //$disp->display();
        ?>
    </div>
</body>
</html>




<?php
    session_start();
        require_once 'dbConnect.class.php';
        
            $profile = new Profile();
            $profile->getdata();
    
       


        class Profile {
            private $output;
            private $DB;
            public function __construct(){
                $db=new DB();
                $this->DB = $db->dbConnection();
                
            }
            public function getdata(){
                $id=$_POST['index'];
                $action=$_POST['a'];
               
                
                    /*$category=$_POST['cat'];
                    $county=$_POST['county'];
                    $subcounty=$_POST['sc'];
                    $prodname=$_POST['pn'];
                    $prodq=$_POST['pq'];
                    $productprice=$_POST['pp'];
                    $coun=$_POST[''];
                    $county=$_POST[''];
                    $this->edit($id);*/
                     
               // if($action === 'edit'){
               //    echo $this->edit($id);
               // }elseif($action === 'delete'){
               //    
               //     echo $this->delete($id);
               // }
            
            
                if($_GET['action'] === 'myPoducts'){
                    
                  echo $this->myProducts();
                }
                if($_GET['action'] === 'profile'){
                
                  echo $this->dispProfile();
                }
                if($_POST['action'] === 'edit'){
                  $id=$_POST['prodid'];
                  echo $this->edit($id);
                }
            }
            public function dispProfile(){
           
            $userName = $_SESSION['user'];
            $userName = $userName;
            $query = "SELECT * FROM `users` WHERE `username` = :username";
            $stmt = $this->DB->prepare($query);
            $stmt->execute(array(':username' => $userName,));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            if($stmt->rowCount() == 0){

                $results =NULL;
                header("location: login.php?error=usernotfound");
                exit();
            }else{
                foreach($result as $row){
                  
                    $userEmail  = $row['email'];
                    $phoneNum = $row['phone'];
                    $userPass = $row['password'];
                  
                    
                }
               
               $this->output .=  "
                <div class='profile'>

                <form action='update.php' method='post' enctype='multipart/form-data'>
                    <ul>
                        
                        <li>
                            <p>Username</p>
                            <input type='text' name='username' value= '$userName' ?>
                        </li>
                        <li>
                            <p>Password</p>
                            <input type='password' name='password' value='$userPass'>
                        </li>
                        <li>
                            <p>Email</p>
                            <input type='email' name='email' value='$userEmail'>
                        </li>
                        <li>
                            <p>Phone Number</p>
                            <input type='number' name='phone' value='$phoneNum'>
                        </li>
                        <li>
                            <input type='submit' name='update' value='Update'>
                        </li>
                    </ul>
                </form>
                </div>";
            }
            return $this->output;
        }
            public function myProducts(){
                $userName = $_SESSION['user'];
                $user_id=$_SESSION['user_id'];
              

                $query = "SELECT * FROM products WHERE userID = $user_id ";
                $stmt = $this->DB->query($query);
               
                $noRows = $stmt->rowCount();
               
               
                    
                       if($noRows == 0){
                           echo "<h2>No Products<h2> ";
                           exit();
                       }else{
               
                     echo"   <div class = 'records_heading'>My Products</div>";
                            echo" <table >
                                <tr>
                                    <th>Title</th>
                                    <th>Date created</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    
                                </tr>";
                        for($j=0; $j<$noRows; ++$j){
                            $row = $stmt->fetch(PDO::FETCH_GROUP |PDO::FETCH_ASSOC);
                            
                                $imagepath = $row["imagePath"];
                                $prodid = $row["productID"];
                            
                                echo '
                                 <tr>
                                        <td>'. $row['productName'] . '</td>
                                        <td>'. $row['created_at'] . '</td>
                                        <td>'.$row['productID'] .'</td>
                                        <td>'. "<img src = '$imagepath'>" .'</td>
                                        <td>'. "<form action='' ><button type='button' id='button' onclick='edit(".$prodid.")' style='background-color:green; color:white; border-radius:5px;'>edit</button> <br>
                                        <button type='submit' name='delete' value='$prodid' onclick='delete()'style='background-color:red; color:white; border-radius:5px;'>delete</button>" .'</form></td>
                                    </tr>
                                    ';
                                echo"
                                </div>";

                                }
                       }
            }

            public function delete($prodId){
                
                 $sql="DELETE FROM `products` WHERE `productID` = :productID";
                 $stmt = $this->DB->prepare($sql);
                 $stmt->execute(array(':productID'=>$prodId));
                
                 
            }

            public function edit($prodId){
                $sql = "SELECT * FROM `products` WHERE `productID` = :productID";
                $stmt = $this->DB->prepare($sql);
                $stmt->execute(array(':productID'=>$prodId));
                $results= $stmt->fetchAll(PDO::FETCH_ASSOC);
                $numrows = $stmt->rowCount();
                foreach($results as $row){
                    $this->id=$row['userID'];
                    $this->productName = $row['productName'];
                    $this->productPrice = $row['price'];
                    $this->productImage = $row['imagePath'];
                    $this->productDescription = $row['productDescription'];
                    $this->county = $row['County'];
                    $this->subcounty = $row['SubCounty'];
                    $this->category = $row['prodCategory'];
                    $this->quantity = $row['prodQuantity'];
                    $this->created_at = $row['created_at'];
                }
              echo '
              <div class="editProd">
              <div class = "contain">
               <div class="addProduct">
             
                   <form  class="buy_form" action="/" method="post" name="form" target="_blank"
                   onSubmit="update_prod('.$prodId.'); return false;">
                    <div class = "grid">
                        <div class ="data">
                     <p>Category</p>
                         <select id="category" name="category">
                           <option value="'.$this->category.'">'.$this->category.'</option>
                           <option value="Farm Machinery & Equipments">Farm Machinery & Equipments</option>
                           <option value="Feeds, Supplements & Seeds">Feeds, Supplements & Seeds</option>                  
                           <option value="Livestock & Poultry">Livestock & Poultry</option>
                           <option value="Fertilizers & Chemicals">Fertilizers & Chemicals</option>
                           <option value="Pesticides & Insecticides">Pesticides & Insecticides</option>
                           <option value="Agro-Processing">Agro-Processing</option>
                           <option value="Agro-Services">Agro-Services</option>
           
                         </select>
                         </div>
                         <!--<div class ="data">
                     <p>Sub Category</p>
                         <select name="subcategory" >
                           <option value="">--select-- </option>
                           <option value="Farm Machinery & Equipments">Farm Machinery & Equipments</option>
                           <option value="Feeds, Supplements & Seeds">Feeds, Supplements & Seeds</option>                  
                           <option value="Livestock & Poultry">Livestock & Poultry</option>
                           <option value="Fertilizers & Chemicals">Fertilizers & Chemicals</option>
                           <option value="Pesticides & Insecticides">Pesticides & Insecticides</option>
                           <option value="Agro-Processing">Agro-Processing</option>
                           <option value="Agro-Services">Agro-Services</option>
           
                         </select>
                         </div>-->
                         <div class="data">
                       <p>County</p>
                       <select required name="county" id="county"  onchange="populate()">
                           <option value="'.$this->county.'">'.$this->county.'</option>
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
                            <select required name="subcounty" id="subcounty">
                           <option value="'. $this->subcounty .'">'. $this->subcounty .'</option>
                           <select>
                       </div>
                       <div class="data">
                           <p>Title</p>
                           <input type="text" placeholder="Title" id="product_name" name="product_name" value="'.$this->productName.'">
                       </div>
                       <div class="data">
                           <p>Quantity in Kgs</p>
                           <input type="text" placeholder="Quantity" id="product_quantity" name="product_quantity" value="'.$this->quantity.'">
                       </div>
                       <div class="data">
                           <p>Price</p>
                           <input type="text" placeholder="Product price" id="product_price" name="product_price" value="'. $this->productPrice.'">
                       </div>
                       <div class="data">
                           <p>Upload file</p>
                           <input class = "file" type="file" id="image" name="image"  value="'.$this->productImage.'" required>
                       </div>
                       </div>
                       <div class = "textarea">
                           <p>Description</p>
                           <textarea  name="textarea" id="textarea" cols="30" rows="7" placeholder="'.$this->productDescription.'" value="'.$this->productDescription.'"></textarea>
                       </div>
                       <div class="datasubmit">
                           <input type="submit" name="add" value="ADD">
                       </div>
                      
                   </form>
               </div>
               </div>
               </div>
              
              
         
               
              ';
              
             
            }
            
        }

      

    ?>



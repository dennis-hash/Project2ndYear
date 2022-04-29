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
                     
                if($action === 'edit'){
                   echo $this->edit($id);
                }elseif($action === 'delete'){
                   
                    echo $this->delete($id);
                }
            
            
                if($_GET['action'] === 'get_message'){
                    
                echo $this->myProducts();
                }
                if($_GET['action'] === 'profile'){
                
                echo $this->dispProfile();
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
                            
                            <input class = 'file' type='file' name='image'>
                        </li>
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
                $qquery = "SELECT `userID` from `users` where `username` = :username";
                $stmt = $this->DB->prepare($qquery);
                $stmt->execute(array(':username'=>$userName));
                $result = $stmt->fetch();
                foreach($result as $result){
                    $user_id = $result['userID'];
                }

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
                                        <td>'. "<form action='' ><button type='submit' name='edit' value='$prodid'>edit</button> <br>
                                        <button type='submit' name='delete' value='$prodid'>delete</button>" .'</form></td>
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
              //header("location: ../includes/update.php?id=$prodId");
              header("location: ../includes/AddProducts.php?id=$prodId");
              
             
            }
            
        }

      

    ?>



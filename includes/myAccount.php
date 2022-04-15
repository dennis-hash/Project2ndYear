<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php?error=notLoggedIn ');
        exit();
    }
    require_once 'header.php';
    require_once '../classes/dbConnect.class.php';
       
    

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>MStore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        
    </header>
    <div class="profile_Records">
   <?php
    //require_once '../classes/dbConnect.class.php';
        class Profile extends DB {
            public function __construct(){}
            public function dispProfile(){
           
            $userName = $_SESSION['user'];
            $query = "SELECT * FROM `users` WHERE `username` = :username";
            $stmt = $this->dbConnection()->prepare($query);
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
               
                echo "<div class='prof'>
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
                </div>
                </div>";
            }
        }
            public function myProducts(){
                $userName = $_SESSION['user'];
                $qquery = "SELECT `userID` from `users` where `username` = :username";
                $stmt = $this->dbConnection()->prepare($qquery);
                $stmt->execute(array(':username'=>$userName));
                $result = $stmt->fetch();
                foreach($result as $result){
                    $user_id = $result['userID'];
                }

                $query = "SELECT products.productName, products.price, products.imagePath FROM products WHERE userID = $user_id ";
                $stmt = $this->dbConnection()->query($query);
               
                $noRows = $stmt->rowCount();
               
                echo "<div class = 'dispRecords'>
                <div class = 'records_heading'>My Products</div>";
                    
                       if($noRows == 0){
                           echo "<h2>No Products<h2> ";
                           exit();
                       }
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
                $row = $stmt->fetch(PDO::FETCH_GROUP |PDO::FETCH_ASSOC);
                  
                    $imagepath = $row["imagePath"];
                   
                    echo '
                        <tr>
                          
                            <td>'. $row['productName'] . '</td>
                            <td>'.$row['price'] .'</td>
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

        $profile = new Profile();
        $profile->dispProfile();
        $profile->myProducts();

    ?>
 </div>   
</body>
</html>
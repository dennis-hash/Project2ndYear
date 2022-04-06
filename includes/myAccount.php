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
                $this->connect();
                $sql = "SELECT * FROM users WHERE username = '$userName';";
                $results = $this->queryMysql($sql);
                $row = $results->fetch_assoc();
                $userPass = $row['password'];
                $userEmail = $row['email'];
                $phoneNum = $row['phoneNO'];
                echo "<div class='prof'>
                <div class='profile'>

                <form action='update.php'>
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
                </div>
                </div>";
            }
            public function myProducts(){
                $userName = $_SESSION['user'];
                $this->connect();
                $result =  $this->queryMysql( "SELECT products.productName, products.price, products.imagePath FROM products JOIN users ON products.userID = users.userID;");
               $noRows=$result->num_rows;
            
                echo "<div class = 'dispRecords'>
                <div class = 'records_heading'>My Products</div>";
                    
                       if($noRows == 0){
                           echo "<h2>No Products<h2> ";
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
        $profile = new Profile();
        $profile->dispProfile();
        $profile->myProducts();

    ?>
 </div>   
</body>
</html>
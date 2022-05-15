<?php
include_once "dbConnect.class.php";
$admin = new Admin();
$admin->get_data();

class Admin{
    public function __construct(){
        $db=new DB();
        $this->DB = $db->dbConnection();
       

    }
    public function get_data(){
       // echo "<h1>elete</h1>";
       $d=1;
        if($_POST['action']==='view_users'){
           $this->getUsers();
            
        }
       if($_GET['action']==='delete_users'){
            $this->deleteUser($_GET['id']);
            $this->getUsers();
        }elseif($_GET['action']=='add_admin'){
            $this->add_admin_page();
       }elseif($_GET['action']=='view_prod'){
            $this-> view_products();
       }elseif($_GET['action']=='view_prod'){
        $this-> view_products();
       }elseif($_GET['action']=='delete_product'){
        $this-> delete_product($_GET['id']);
       }elseif($_GET['action']=='edit_users'){
       // $this->updateUser($_GET['id']);

       }elseif($_POST['action']=='add_admin'){
          
          $this->add_admin($_POST['user'],$_POST['email'],$_POST['phone'],$_POST['pass']);
 
        }
    }
  

    public function getUsers(){
        
        $query = "SELECT * FROM `users`";
       $stmt = $this->DB->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo"<div class='profile_Records'> <div class='dispRecords'>
        <div class = 'records_heading'>Users</div>
        <table >
        <tr>
            <th>User_id</th>
            <th>Username</th>
            <th>Email</th>
            <th>PhoneNO</th>
            <th>Password</th>
            <th>User_role</th>
            <th>edit</th>
            <th>delete</th>
            
        </tr>";
       foreach($result as $row){
             $prodid=$row['userID'];
             
              echo '<tr>';
              echo '<td>'.$row['userID'].'</td>';
              echo '<td>'.$row['username'].'</td>';
              echo '<td>'.$row['email'].'</td>';
              echo '<td>'.$row['phoneNO'].'</td>';
              echo '<td>'.$row['password'].'</td>';
              echo '<td>'.$row['user_role'].'</td>';
              echo '<td><button style="background-color:green; color:white; border-radius:5px;" onclick="edit_user('.$row['userID'].')">Edit</button></td>';
              echo '<td><button style="background-color:red; color:white; border-radius:5px;" onclick="delete_user('.$row['userID'].')">Delete</button></td>';
             // echo "<td><form action='#' > <button type='submit' name='edit' value='$prodid'>edit</button> <br>
              //<button type='submit' name='delete' value='$prodid'>delete</button> </form></td>";
              echo '</tr>';
              echo'</div>';
              

       }
       echo"</table>";
       echo'</div> </div>';
    }
   
    public function deleteUser($userID){
        $query = "DELETE FROM `users` WHERE `userID` = :userID";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':userID' => $userID));
       
    }
    public function updateUser($userID,$name,$phone,$email,$password){
        $query = "UPDATE `users` SET `username`=:name,`phoneNO`=:phone,`email`=:email,`password`=:password WHERE `userID`=:userID";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':name' => $name, ':phone'=>$phone,':email' => $email, ':password' => $password,':userID'=>$userID));
        header("location: admin.php?success=userupdated");
        exit();
    }
    public function add_admin_page(){
       /* echo' <div class="register">   <div class="box">
        
        <h2>Add Admin</h2>
        <h1 class="g">Create Admin account</h1>
        
        <form id="form" action="" method = "POST">
            <p>Username</p>
            <input type="text"  id="user" name="user" placeholder="Username" >
            <p>Email address</p>
            <input type="text" id="email" name="email"  placeholder="Email">
            <p>Phone number</p>
            <input type="text"  id="phone" name="phone"  placeholder="Phone number">
            <p>Create password</p>
            <input type="password"  id="pass" name="pass"  placeholder="Password">
            <p>Confirm pasword</p>
            <input type="password"  id="confpass" name="confpass"  placeholder="Confirm password">
            <input type="submit" name="submit" placeholder="create account" value="Create account">
        </form>

        <form action = "login.php">
          
            <p class = "terms">By singing up you agree to the <a href="">Terms and conditions</a></p>

        </form>
        
        </div> </div>';*/
        /*$query = "INSERT INTO `users`(`username`,`phoneNO`, `email`, `password`,`user_role`) VALUES (:name, :phone ,:email, :password,:user_role)";
        $stmt = $this->DB->prepare($query);
        $stmt->execute(array(':name' => $name, ':phone'=>$phone,':email' => $email, ':password' => $password,':user_role'=>'admin'));
        header("location: admin.php?success=useradded");
        exit();*/
    }
    public function view_products(){
        $query = "SELECT * FROM `products`";
        $stmt = $this->DB->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
        foreach($result as $row){
            $this->id=$row['userID'];
           $this->productName = $row['productName'];
           $this->productPrice = $row['price'];
           $this->productImage = $row['imagePath'];
           $this->productDescription = $row['productDescription'];
           $this->county = $row['County'];
           $this->subcounty = $row['SubCounty'];
           $this->category = $row['prodCategory'];
           $this->difference = $row['difference'];
           $this->created_at = $row['created_at'];

           $created_at = new DateTime(date('Y-m-d H:i:s', strtotime($this->created_at)));
           $curr_time=new DateTime(date('Y-m-d H:i:s'));
           $this->difference=$created_at->diff($curr_time);
           $this->difference = $this->difference->format('%H');
           echo"<div class='product'>

               <!-- <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>-->
               <div class='prod'>
               <div class = 'prodImage'> <img src='$this->productImage' alt='$this->productName'> </div>
               <div class = 'prodname'>  <p>$this->productName </p></div>
               <div class = 'prodprice'> <p>Ksh $this->productPrice </p></div>
               <div class = 'prodcategory'> <p>Category: $this->category </p></div>
               <div class = 'proddesc'> <p>$this->productDescription</p></div>
               <div class = 'prodlocation'> <p><img class = 'icon' src='../images/location-dot-solid.svg' alt=''>$this->county, $this->subcounty </p></div>
               <div class = 'prodtime'><button onclick='delete_product(".$row['productID'].")' style='background-color:red; color:white; border-radius:5px;'>DELETE</button></div>
               </div>
           </div>";
       }
       echo"</table>";
       echo '</div>';
    }
    public function delete_product($id){
       $query = "DELETE FROM `products` WHERE `productID` = :id";
       $stmt = $this->DB->prepare($query);
       $stmt->execute(array(':id' => $id));
       
    }
    public function add_admin($username,$email,$phone,$pass){
        if(empty($username) || empty($email) || empty($phone) || empty($pass)){
            
            echo "Please enter all fields";
            exit();
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "Please enter a valid email";
            exit();
        }
        else{
            $query = "SELECT * FROM `users` WHERE `username`=:username OR `email`=:email OR `phoneNO`=:phone";
            $stmt = $this->DB->prepare($query);
            $stmt->execute(array(':username' => $username, ':email'=>$email,':phone'=>$phone));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
               echo "Username or email or phone number already exists";
                exit();
            }
            else{
                $query = "INSERT INTO `users`(`username`,`phoneNO`, `email`, `password`,`user_role`) VALUES (:username, :phone ,:email, :password,:user_role)";
                $stmt = $this->DB->prepare($query);
                $stmt->execute(array(':username' => $username, ':phone'=>$phone,':email' => $email, ':password' => $pass,':user_role'=>'admin'));
                echo "Admin added successfully";
                exit();
            }
        }
        //$query = "INSERT INTO `users`(`username`,`phoneNO`, `email`, `password`,`user_role`) VALUES (:name, :phone ,:email, :password,:user_role)";
        //$stmt = $this->DB->prepare($query);
        //$stmt->execute(array(':name' => $username, ':phone'=>$phone,':email' => $email, ':password' => $pass,':user_role'=>'admin'));
        //echo "Added Successfully";
    }
}
?>
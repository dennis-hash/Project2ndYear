<?php
class Login extends DB{
    public function __construct()
    {
        
    }
    protected function getUser($userName, $passWord){ 
       
        $query = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
        $stmt = $this->dbConnection()->prepare($query);
        $stmt->execute(array(':username' => $userName, ':password' => $passWord));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       
        if($stmt->rowCount() == 0){

            $results =NULL;
            header("location: login.php?error=usernotfound");
            exit();
        }
     
        else{
            foreach($result as $row){
               
                $user_id = $row['userID'];
                $user_role = $row['user_role'];
            }
           
           session_start();
            $_SESSION['user'] = $userName;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_role'] = $user_role;
           
            if($_SESSION['user_role']=='admin'){
                header("location: admin.php?success=loggedin");
                exit();
          
            }else{
                header("location: index.php?success=loggedin");
                exit();
            }
           
        }
    }

    


}
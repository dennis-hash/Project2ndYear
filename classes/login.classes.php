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
           
          session_start();
            $_SESSION['user'] = $userName;
            $_SESSION['pass'] = $passWord;
            header("location: index.php?loggedin");
        }
    }

    


}
<?php
class Login extends DB{
    public function __construct()
    {
        
    }
    protected function getUser($userName, $passWord){ 
       
      $query = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
        $stmt = $this->dbConnection()->prepare($query);
        echo "hett";
        $stmt->execute(array(':username' => $userName, ':password' => $passWord));
        echo "hett4";
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        if($stmt->rowCount() == 0){

            $results =NULL;
            header("location: login.php?error=usernotfound");
            exit();
        }
        
       /* $pwd = password_verify($passWord, $results[0]);
        if($pwd = false){
            $results =NULL;
            header("location: ../includes/login.php?error=wrongPassWord");
            exit();
        }*/
        else{
           
          session_start();
            $_SESSION['user'] = $userName;
            $_SESSION['pass'] = $passWord;
            header("location: index.php?loggedin");
        }
    }

    


}
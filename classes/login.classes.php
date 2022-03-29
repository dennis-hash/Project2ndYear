<?php
class Login extends DB{
    protected function getUser($userName, $passWord){ 
        $connect = $this->connect();

        $results = $this->queryMysql("SELECT username,password FROM users WHERE username = '$userName' AND password = '$passWord';");
        
        if($results->num_rows == 0){

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
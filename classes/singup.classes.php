<?php
class signup extends db{
    protected function checkUser($userName, $email){ 
        $results = $this->queryMysql("SELECT * FROM users WHERE userID = '$userName'OR email = '$email';");
        if($results->num_rows > 0){
            $resultscheck =false;
        }
        else{
            $resultscheck = true;
        }
        return $resultscheck;
    }

    protected function setUser($userName,$phone, $email, $passWord){
        //referencing to the connect method in db class
        $result = $this->connect();
         //referencing to the queryMysql method in db class
        $this->queryMysql("INSERT INTO users VALUES(1,'$userName','$phone','$email', '$passWord'); ");
        die('Account Created');
    }


}
<?php
class signup extends db{
   
    public function checkUser($userName, $email){
        $query = "SELECT * FROM `users` WHERE `email` = :email OR `userName` = :userName";
        $stmt = $this->dbConnection()->prepare($query);
        $stmt->execute(array(':email' => $email, ':userName' => $userName));
        if($stmt->rowCount() > 0){
            $resultscheck = false;
        }
        else{
            $resultscheck = true;
        }
        return $resultscheck;
    }

    public function setUser($name,$phone, $email, $password){
        $query = "INSERT INTO `users`(`username`,`phoneNO`, `email`, `password`,`user_role`) VALUES (:name, :phone ,:email, :password,:user_role)";
        $stmt = $this->dbConnection()->prepare($query);
        $stmt->execute(array(':name' => $name, ':phone'=>$phone,':email' => $email, ':password' => $password,':user_role'=>'user'));
        
    }   



}
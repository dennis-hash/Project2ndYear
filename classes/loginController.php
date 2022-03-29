<?php
class LoginController extends Login{
    private $userName;
    private $passWord;

    public function __construct($Uname, $pass)
    {
        $this->userName = $Uname;
        $this->passWord = $pass;
        
    }
    //error handling for the inputs
    private function emptyInputs()
    {
        
        if(empty($this->userName)  || empty($this->passWord) ){
            $results = 8;
        }
        else{
            $results = 4; 
        }
        return $results;
    }
    public function loginUsers()
    {
      
        if($this->emptyInputs() == 8){
           header("location: ../includes/login.php?error=emptyInputs");
           exit();
        }else{
            $this->getUser($this->userName,$this->passWord ); 
        }
        
    }
    
}

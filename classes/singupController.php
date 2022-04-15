<?php
class singupController extends signup{
    private $userName;
    private $phone;
    private $email;
    private $passWord;
    private $passRepeat;

    public function __construct($Uname, $phone, $email, $pass1 ,$pass2)
    {
        $this->userName = $Uname;
        $this->phone = $phone;
        $this->email = $email;
        $this->passWord = $pass1;
        $this->passRepeat = $pass2;
    }
    //error handling for the inputs
    private function emptyInputs()
    {
        
        if(empty($this->userName) || empty($this->phone) || empty($this->email) || empty($this->passWord) || empty($this->passRepeat) ){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }

    private function invalidUsername()
    {
        
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->userName)){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }

    private function invalidEmail()
    {
        
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }

    private function matchPassword()
    {
       
        if($this->passRepeat !== $this->passWord){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }

    private function userEmailMatch()
    {
        
        if(!$this->checkUser($this->userName, $this->email)){
            $results = false;
        }
        else{
            $results = true; 
        }
        return $results;
    }
    
    //check whether any of the function has returned false
    public function singupUsers()
    {
       
        if($this->emptyInputs() == false){
           header("location: singup.php?error=emptyInputs");
           exit();
        }
        if($this->invalidUsername() == false){
            header("location: singup.php?error=invalidUsername");
            exit();
        }
        if($this->invalidEmail() == false){
            header("location: singup.php?error=invalidEmail");
            exit();
         }
         if($this->matchPassword() == false){
            header("location: singup.php?error=passwordnotMatching");
            exit();
         }
         

         //when no errors are found
         
         $this->setUser( $this->userName,$this->phone,  $this->email, $this->passWord );
       
    }
}

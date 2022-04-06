<?php
//require_once 'index.php';
if(isset($_POST['submit'])){

    //grabing the data
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    
    //instantiate singup controller class
    include "../classes/dbConnect.class.php";
    include "../classes/login.classes.php";
    include "../classes/loginController.php";

    $singup = new LoginController($username, $pass);
    //running error handlers
    $singup->loginUsers();
    //going back to front page
    //header("loaction: ../index.php?error=none");
}
?>
<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" type="text/css" href="login.css">    
        
        <title>Login Form</title>
        <link rel="stylesheet" type="text/css" href="site.css">
        <body>
            <div class="loginbox">
                <div class="box">
                
                        <h2>xyz</h2>
                        <h1 class="g">Account login</h1>
                    
                   <form action="" method = "POST">
                       <p>Username</p>
                       <input type="text" name="user" placeholder="Enter Username">
                       <p>Password</p>
                       <input type="password" name="pass" placeholder="Enter Password">
                       
                       <p><a href="">Forgot password?</a></p><br>
                       <input type="submit" name="submit" placeholder="Login" value="Login">
                       
                        <h1 class="g">Create account</h1>
                        <input type="submit" name="singup"  placeholder="Login" value="Register">
                       

                   </form>
                   </div>
            </div>

        </body>
    </head>
</html>


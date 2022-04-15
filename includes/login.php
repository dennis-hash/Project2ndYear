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
            <div class ="log">
           <?php
     
            $login_check = $_GET['error'];
            if($login_check == "usernotfound"){
                echo "<p class = 'error' >Unable to login with provided credentials</p>";
                //exit();
            } elseif($login_check == "emptyInputs"){
                echo "<p class = 'error'>Fill all fields </p>";
                //exit();
            }
            

            ?>
            <div class="loginbox">
                <div class="box">
                
                        <h2>xyz</h2>
                        <h1 class="g">Account login</h1>
                    
                   <form action="" method = "POST">
                       <p>Username</p>
                       <input type="text" name="user" placeholder="Enter Username">
                       <p>Password</p>
                       <input type="password" name="pass" placeholder="Enter Password">
                       
                       <p class = "terms"><a href="" >Forgot password?</a></p><br>
                       <input type="submit" name="submit" placeholder="Login" value="Login">
                       
                        <h1 class="g">Create account</h1>
                        </form>
                    <form action="singup.php">
                        <input type="submit" name="signup" value="Register">
                   </form>
                   </div>
            </div>
            </div>
        </body>
    </head>
</html>


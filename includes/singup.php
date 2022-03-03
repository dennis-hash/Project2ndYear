<?php
if(isset($_POST['submit'])){

    //grabing the data
    $username = $_POST['user'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $confpass = $_POST['confpass'];

    //instantiate singup controller class
    include "../classes/dbConnect.class.php";
    include "../classes/singup.classes.php";
    include "../classes/singupController.php";

    $singup = new singupController($username, $phone, $email, $pass, $confpass);
    //running error handlers
    $singup->singupUsers();
    //going back to front page
    //header("loaction: ../index.php?error=none");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing up</title>
    <link rel="stylesheet" href="site.css">
</head>
<body>
<div class="register">
        <div class="box">
        
            <h2>MSoko</h2>
            <h1 class="g">Create account</h1>
            
            <form action="singup.php" method = "POST">
                <p>Enter username</p>
                <input type="text" name="user" placeholder="Enter Username">
                <p>Email address</p>
                <input type="text" name="email"  placeholder="email">
                <p>Phone number</p>
                <input type="text" name="phone"  placeholder="phone number">
                <p>Create password</p>
                <input type="password" name="pass"  placeholder="Create password">
                <p>Confirm pasword</p>
                <input type="password" name="confpass"  placeholder="Confirm password">
                <input type="submit" name="submit" placeholder="create account" value="Create account">
            </form>

            <form action = "login.php">
                <h1 class="g">Already have an account?</h1>
                <input type="submit" name="" placeholder="Login" value="Login" >
                <p class = "terms">By singing up you agree to the <a href="">Terms and conditions</a></p>

            </form>
            
            </div>
    </div>
</body>
</html>
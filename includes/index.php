<?php
    session_start();
    if (isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MStore</title>
    <link rel="stylesheet" href="main.css">
<body>

    <header>
    <div class="navlinks">
        <img src="../images/menu.svg" alt="" onclick="toggleNav()">
        
        
            <?php
                if($loggedin){
             
                echo<<< _INIT
                "<li><a href="#">$user</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                <li><a href="#">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
               _INIT;
                }
                else{
        
            echo <<< _END
                <li><a href="singup.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="#">Cart</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                
                _END;
                }
            ?>
        </div>
    </header>
   
    <!--side bar-->
    <aside class="sidebar">
        <ul>
            <li><span>Categories</span></li>
            <li><a href="#">Fruits</a></li>
            <li><a href="Register.php">Vegitables</a></li>
            <li><a href="records.php">Records</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contacts</a></li>
        </ul>
    </aside>

     
   <!-- <div class="sidemenu">
    
            <h4>Categories</h4>
            <li><a href="#">Fruits</a></li>
            <li><a href="Register.php">Vegitables</a></li>
            <li><a href="records.php">Records</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contacts</a></li>
    </div>-->
</body>
<script src="main.js"></script> 
</html>
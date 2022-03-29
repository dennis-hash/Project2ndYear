<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php?error=notLoggedIn ');
        exit();
    }
    
    require_once '../classes/dbConnect.class.php';
       
    

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>MStore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
   
    </header>
   <?php
    //require_once '../classes/dbConnect.class.php';
        class Profile extends DB {
            public function __construct(){}
            public function dispProfile(){
                $userName = $_SESSION['user'];
                $this->connect();
                $sql = "SELECT * FROM users WHERE username = '$userName';";
                $results = $this->queryMysql($sql);
                $row = $results->fetch_assoc();
                $userPass = $row['password'];
                $userEmail = $row['email'];
                $phoneNum = $row['phoneNO'];
                echo "<div class='profile'>

                <form action='update.php'>
                    <ul>
                        <li>
                            <p>Username</p>
                            <input type='text' name='username' value= '$userName' ?>
                        </li>
                        <li>
                            <p>Password</p>
                            <input type='password' name='password' value='$userPass'>
                        </li>
                        <li>
                            <p>Email</p>
                            <input type='email' name='email' value='$userEmail'>
                        </li>
                        <li>
                            <p>Phone Number</p>
                            <input type='number' name='phone' value='$phoneNum'>
                        </li>
                        <li>
                            <input type='submit' name='update' value='Update'>
                        </li>
                    </ul>
                </form>
                </div>";
            }
        }
        $profile = new Profile();
        $profile->dispProfile();

    ?>
    
</body>
</html>
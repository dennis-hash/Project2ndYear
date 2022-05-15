<?php
    session_start();
    if (isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $loggedin = TRUE;  
        
    } if($_SESSION['user_role'] === 'admin'){
        $admin = TRUE;
    }
    else{
        $admin = FALSE;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MStore</title>
    <link rel="stylesheet" href="ains.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

    <header>
    <div class="navlinks">
       
        <img src="../images/menu.svg" alt="" onclick="toggleNav()">
      <div class="searches">
      <form action = "../classes/index.class.php" method="POST" >
                <input type="search" name="search"  class="search" placeholder="search">
                <input class="button" class="submit" type="submit" name = "submit" value="search">
                <!--<button type="submit" ><img src="../images/magnifying-glass-solid.svg" alt=""></button>-->
            </form>
        
      </div>
       
            <?php
                if($loggedin && !$admin){
             
                echo<<< _INIT
                <li><a href="index.php">Home</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                <li><a href="AddProducts.php">SELL</a></li>
                <li><a href="logout.php">Logout</a></li>
               _INIT;
                }elseif($loggedin && $admin){
                   echo '<li><a class="" href="index.php">Home</a></li>
                   <li><a class="" href="myAccount.php">My account</a></li>
                   <li><a class="" href="AddProducts.php">SELL</a></li>
                   <li><a class="view_users" href="../classes/admin.class.php">View users</a></li>
                   <li><a class="view_prod" href="../classes/admin.class.php">View Products</a></li>
                   <li><a class="add_admin" href="../classes/admin.class.php">Add admin</a></li>
                   <li><a class="" href="logout.php">Logout</a></li>';
                }
                else{
        
            echo <<< _END
                <li><a href="index.php">Home</a></li>
                <li><a href="singup.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="AddProducts.php">SELL</a></li>
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

    
   
</body>
<script src="main.js"></script> 
<script>
    $('form').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var action = 'search';
    search(url, action);
   
  });

  function search(url,action){
    var post = $.post(url, {
        search: $('.search').val(),
        
        action:action
    
    });
    post.done(function(data){
        $('.allProducts').html(data);
        $('.search').val('');
    });
  }
</script>
</html>
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
    <link rel="stylesheet" href="ains.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                if($loggedin){
             
                echo<<< _INIT
                <li><a href="index.php">Home</a></li>
                <li><a href="myAccount.php">My Acount</a></li>
                <li><a href="AddProducts.php">SELL</a></li>
                <li><a href="logout.php">Logout</a></li>
               _INIT;
                }
                else{
        
            echo <<< _END
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
            <li><a href="#">Agroproducts</a></li>
            <li><a href="#">Farm Machinery</a></li>
            <li><a href="Register.php">Feeds & Supplements</a></li>
            <li><a href="records.php">Livestock & Poultry</a></li>
            <li><a href="#">Fertilizers</a></li>
            <li><a href="#">Pesticides & insecticides</a></li>
            <li><a href="#">Agroservices</a></li>
            
        </ul>
    </aside>
    
    <div class="allProducts"></div>
    
       
</body>
<script src="mains.js"></script> 
<script>
    getall();
    function getall(){
    $.get('../classes/index.class.php',{ action:'display_products'})
        .done(function(data){
        $('.allProducts').html(data);
        });
    }
  
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


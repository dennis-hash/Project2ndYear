<?php
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MStore</title>
    <link rel="stylesheet" href="site.css">
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
                
                <li><a class="" href="index.php">Home</a></li>
                <li><a class="view_users" href="../classes/admin.class.php">View users</a></li>
                <li><a class="view_prod" href="../classes/admin.class.php">View Products</a></li>
                <li><a class="add_admin" href="../classes/admin.class.php">Add admin</a></li>
                <li><a class="" href="logout.php">Logout</a></li>
           
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
  
    <div class="allProducts">
   
    </div>
    
   
       
</body>
<script src="mains.js"></script> 
<script>


    getall();
    function getall(){
        //preventDefault();
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

  $(".view_users").click(function(e){
    e.preventDefault();
    $.get('../classes/admin.class.php',{ action:'view_users'})
    .done(function(data){
    $('.allProducts').html(data);
    });

 });
 function delete_user(id){
     var r = confirm("Are you sure you want to delete this user?");
        if(r==true){
            $.get('../classes/admin.class.php',{ action:'delete_users',edit:'edit', id:id})
            .done(function(data){
            $('.allProducts').html(data);
           
            });
        }
       location.reload(true);

 }
 function edit_user(id){
     var r = confirm("Are you sure you want to edit this user?");
        if(r==true){
            $.get('../classes/admin.class.php',{ action:'edit_users',edit:'edit', id:id})
            .done(function(data){
            $('.allProducts').html(data);
            });
        }
       

 }
 function delete_product(id){
     var r = confirm("Are you sure you want to delete?");
        if(r==true){
            $.get('../classes/admin.class.php',{ action:'delete_product',edit:'edit', id:id})
            .done(function(data){
            $('.allProducts').html(data);
            });
        }
        //$('.view_users').trigger('click');
        reload();
 }



 $(".view_prod").click(function(e){
     console.log("clicked");
    e.preventDefault();
    $.get('../classes/admin.class.php',{ action:'view_prod'})
    .done(function(data){
    $('.allProducts').html(data);
    });
 });

 $(".add_admin").click(function(e){
    e.preventDefault();
    $.get('../classes/admin.class.php',{ action:'add_admin'})
    .done(function(data){
    $('.allProducts').html(data);
    });
    
 });
 


</script>
</html>
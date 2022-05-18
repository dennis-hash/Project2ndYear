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
                <li><a class="" href="myAccount.php">My account</a></li>
                <li><a class="" href="AddProducts.php">SELL</a></li>
                <li><a class="add_article" href="../classes/admin.class.php">Add Article</a></li>
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
   <div class="err"></div>
    </div>
    <div class="register" id="register">   <div class="box">
        
        <h2>Add Admin</h2>
        <h1 class="g">Create Admin account</h1>
        
        <form id="form" action="" method = "POST">
            <p>Username</p>
            <input type="text"  id="user" name="user" placeholder="Username" >
            <p>Email address</p>
            <input type="text" id="email" name="email"  placeholder="Email">
            <p>Phone number</p>
            <input type="text"  id="phone" name="phone"  placeholder="Phone number">
            <p>Create password</p>
            <input type="password"  id="pass" name="pass"  placeholder="Password">
            <p>Confirm pasword</p>
            <input type="password"  id="confpass" name="confpass"  placeholder="Confirm password">
            <input type="submit" name="submit" placeholder="create account" value="Create account">
        </form>

        <form action = "login.php">
          
            <p class = "terms">By singing up you agree to the <a href="">Terms and conditions</a></p>

        </form>
        
        </div> </div>'
   
       
</body>
<script src="mains.js"></script> 
<script>
     $('#register').hide();

    getall();
    function getall(){
        //$('#register').hide();
        //preventDefault();
    $.get('../classes/index.class.php',{ action:'display_products'})
        .done(function(data){
        $('.allProducts').html(data);
        });
    }
  
  /*$('form').submit(function(event){
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
  }*/

  $(".view_users").click(function(e){
    e.preventDefault();
    $.post('../classes/admin.class.php',{ action:'view_users'})
    .done(function(data){
    $('.allProducts').html(data);
    });

 });
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
    $('#register').show();
    $.get('../classes/admin.class.php',{ action:'add_admin'})
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
        }else{

        }
       $('.allProducts').load(" .allProducts");

 }
 function edit_user(id){
     var r = confirm("Are you sure you want to edit this user?");
        if(r==true){
            $.get('../classes/admin.class.php',{ action:'edit_users',edit:'edit', id:id})
            .done(function(data){
            $('.allProducts').html(data);
            });
        }else{

        }
        $('.allProducts').load(" .allProducts");

 }
 function delete_product(id){
     var r = confirm("Are you sure you want to delete?");
        if(r==true){
            $.get('../classes/admin.class.php',{ action:'delete_product',edit:'edit', id:id})
            .done(function(data){
            $('.allProducts').html(data);
            });
        }else{

        }
     
        $('.allProducts').load(" .allProducts");
      
        
 }

 


    $('#form').submit(function(event){
    event.preventDefault();
    console.log("Add admin");
    url = '../classes/admin.class.php';
    var action = 'add_admin';
    search(url, action);
   
  });

  function search(url,action){
   //var pass1= $('#pass').val();
   // var pass2= $('#confpass').val();
   // if(pass1===pass2){
   //     var pass=pass1;
   // }
    var post = $.post(url, {
        user: $('#user').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        pass: $('#pass').val(),
        conpass: $('#confpass').val(),
        action:action
    
    });
    post.done(function(data){
        $('.allProducts').html(data);
        $('#user').val('');
        $('#email').val('');
        $('#phone').val('');
        $('#pass').val('');
        $('#confpass').val('');
        
    });
    $('.register').load(" .register");
  }

  $(".add_article").click(function(e){
    e.preventDefault();
    $.get('../classes/admin.class.php',{ action:'add_article'})
    .done(function(data){
    $('.allProducts').html(data);
    });

 });
 function insert_article(){
    
    var file= $('#image')[0].files;
    var formData = new FormData();
    formData.append('image', file[0]);
    formData.append('title', $('#title').val());
    formData.append('content', $('#content').val());
    formData.append('author', $('#author').val());
    formData.append('date', $('#date').val());
    formData.append('action', "insert_article");
   
    $.ajax({
        url: '../classes/products.classes.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            $('.allProducts').html(data);
            
        }
    });
 }

  



 
 


</script>
</html>
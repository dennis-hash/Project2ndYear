<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php?error=notLoggedIn ');
        exit();
    }
    require_once 'header.php';
    
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>MStore</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
    
    </header>
   
    <div class="profile_Records">
  
        <div class="prof"></div>
       
        <div class="adispRecords">
         
        </div>  
    
        

    </div> 
</body>
<script>
  var error;
    getall();
    function getall(){
    
  //url = '../classes/myaccount.class.php';
  //var page_url = window.location.search.substring(1);
  //var parameter = page_url.split('=');
  //var action = parameter[0];
  //var index = parameter[1];
//
  //var posting = $.post( url, { action:'edit', a:action ,index:index });
  //posting.done(function( data ) {
  //     $('.dispRecords').html(data);   
  //});
    
   
  $.get('../classes/myaccount.class.php',{ action:'myPoducts'})
  .done(function(data){
    $('.adispRecords').html(data);
  });

  $.get('../classes/myaccount.class.php',{ action:'profile'})
  .done(function(data){
    $('.prof').html(data);
  });
  console.log(error);
  }
  function edit(id){
    
    var posting = $.post( '../classes/myaccount.class.php', { action:'edit',prodid:id});
    posting.done(function( data ) {
        $('.adispRecords').html(data);   
    });
    //$('.dispRecords').load(" .dispRecords");
  }
  function update_prod(prodid){
    //product_name = $('#product_name').val();
    //product_price = $('#product_price').val();
    //product_description = $('#product_description').val();
    //textarea = $('#textarea').val();
    //product_quantity = $('#product_quantity').val();
    //category = $('#category').val();
    //county = $('#county').val();
    //subcounty = $('#subcounty').val();
    
        var file= $('#image')[0].files;
        var formData = new FormData();
        formData.append('image', file[0]);
        formData.append('product_name', $('#product_name').val());
        formData.append('product_quantity', $('#product_quantity').val());
        formData.append('product_price', $('#product_price').val());
        formData.append('textarea', $('#textarea').val());
        formData.append('category', $('#category').val());
        formData.append('county', $('#county').val());
        formData.append('subcounty', $('#subcounty').val());
        formData.append('index', prodid);
        formData.append('edit', 'edit');
        ;
        $.ajax({
            url: "../classes/products.classes.php",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
               
                $('.err').html(data);
                error = data;
                $('#county').val('');
                $('#subcounty').val('');
                $('#product_name').val('');
                $('#product_quantity').val('');
                $('#product_price').val('');
                $('#textarea').val('');
                $('#category').val('');
                $('#image').val('');
                $('#county').val('');
                $('#subcounty').val('');
                $('.adispRecords').load('.adispRecords')
              
            }
        });
  }

</script>
</html>
<?php
include "header.php";
session_start();
if(!isset($_SESSION['user'])){
    header('location: login.php?error=notLoggedIn ');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/efb0967787.js" crossorigin="anonymous"></script>
  
</head>
<body>
  <?php
    $user = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
  ?>
<div class="containerr">
  <div class="a">
 
  </div>
  <div class="right">
  <div class="contacts"></div>
 
<div><button id="mybutton" onclick="get_chat()" style="border:none; width: 100%; background-color:blue; font-size:16px; color:white; border-radius:5px; margin-top:10px; height:40px;">Chat with Farmer</button></div>
  <div class="chat">
      <section class="chat-area">
        <header>
          <!--<a href="use.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="php/images/<?php //echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php // echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php // echo $row['status']; ?></p>
          </div>-->
        </header>
      <!--<div class="chat-box">
      </div>-->
        <form action="../classes/chat.class.php" class="typing-area" name="form" id="form" method="post">
          <input type="text" id="sender_id" class="incoming_id" name="incoming_id" value="<?php echo $user_id?>" hidden>
          <input type="text" id="message" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <input type="submit" class="icon"  value="send" style="width: 55px; background: #0D5BE1;">
          
        </form>
      </section>
  </div>
  
  <div class="payment">

  </div>
  </div>
</div>
  
</body>
<script>
  
    var page_url = window.location.href;
    var page_url_array = page_url.split('=');
    var title = page_url_array[1];
    var created_at = page_url_array[2];
    var seller_id = page_url_array[3];
    var prod_id = page_url_array[4];
 
    console.log("prrr"+prod_id);
   post_data();
   $('.chat').hide();
    function post_data(){
     
      url = '../classes/product_page.class.php';
      var page_url = window.location.href;
      var page_url_array = page_url.split('=');
      var title = page_url_array[1];
      var created_at = page_url_array[2];
      var prod_id = page_url_array[4];
      console.log(title);
      console.log(created_at);
      console.log(prod_id);
      var posting = $.post( url, { action: 'pageurl', id1:title ,id2:created_at });
      posting.done(function( data ) {
           $('.a').html(data);
           
      });
      //getchat();
      //var posting_to_chat = $.post( url2, { action: 'pageurl', id1:title ,id2:created_at });
      //posting_to_chat.done(function( data ) {
      //     $('.chat').html(data);
      //     
      //});

    
    }


  //getprice_offer();
  function getprice_offer(){
  $.get('../classes/product_page.class.php',{ action:'getprice_offer'})
      .done(function(data){
      $('.priceOffer').html(data);
      });
  }
  

  getcontacts();
  function getcontacts(){
    $.get('../classes/product_page.class.php',{ action:'getcontacts'})
      .done(function(data){
      $('.contacts').html(data);
      });
  } 
  //getpayment();
  function getpayment(){
    $.get('../classes/product_page.class.php',{ action:'getpayment'})
      .done(function(data){
      $('.payment').html(data);
      });
  } 
  //get_chat()
  function get_chat(){
    
    $('.chat').toggle(/*change text of button to hide chat */ function(){
      let text = $('#mybutton').html();
      if(text == 'Hide Chat'){
        $('#mybutton').html('Chat with Farmer');
      }else{
        $('#mybutton').html('Hide Chat');
      }

    });
      
    
    var page_url = window.location.href;
    var page_url_array = page_url.split('=');
    var seller_id = page_url_array[3];
    var prod_id = page_url_array[4];
    var sender_id = $('#sender_id').val();
    var seller_id = seller_id ;
    console.log("prod id"+prod_id);
    var url = '../classes/chat.class.php';
    var posting = $.post( url, { action: 'getchat', sender_id:sender_id, seller_id:seller_id });
    posting.done(function( data ) {
        
         $('.chat-box').html(data);

         
    });
    

  }

  $('form').submit(function(event){
    event.preventDefault();
    var $form = $(this);
    url = $form.attr('action');
    var action = 'send_message';
     send(url, action);
     get_chat()
    });
    function send(url,action){
      var formData = new FormData($('form')[0]);
      formData.append('message', $('#message').val());
      formData.append('sender_id', $('#sender_id').val());
      formData.append('action', action);
      formData.append('seller_id', seller_id);
      formData.append('prod_id', prod_id);
   
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          $('.chat-box').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
      });
     
      //chatBox = document.querySelector(".chat-box");
      //chatBox.scrollBottom = chatBox.scrollHeight;
      
    }

   /* function insert(url,action){
        var page_url = window.location.search.substring(1);
        var parameter = page_url.split('=');
        var action2 = parameter[0];
        var index = parameter[1];
        console.log(action);
        console.log(index);
        //var posting = $.post( url, { action:'edit', a:action ,index:index });
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
        formData.append('index', index);
        formData.append('edit', action2);
        formData.append('action', action);
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('.error').html(data);
                //alert(data);
                //window.location.href = "../pages/addProduct.php";
            }
        });
    }*/
    function buy(){
     console.log("sell");
     var posting = $.post( url, { action: 'buy'});
      posting.done(function( data ) {
          
          $('.a').html(data);

          
      });
      //$('.a').load(" .a");
    }
    function handleFormSubmit(){
    
        console.log("handle");
        var formData = new FormData();
        formData.append('sender_id', $('#sender_id').val());
        formData.append('name', $('#productname').val());
        formData.append('amount', $('#quantity').val());
        formData.append('phone', $('#phone').val());
        formData.append('email', $('#email').val());
        formData.append('address', $('#address').val());
        formData.append('total', $('#total').val());
        formData.append('payment', $('.payment').val());
        formData.append('action', 'send_buy_product_message');
        formData.append('seller_id', seller_id);
        formData.append('prod_id', prod_id);
        $.ajax({
            url: '../classes/chat.class.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                $('.error').html(data);
                //alert(data);
                //window.location.href = "../pages/addProduct.php";
            }
        });
      
    }
 function addPrice(){
   var price = $('#total').val();
   var amount = $('#quantity').val()
  var total = price * amount;
  $('#total').val(total);
 }
</script>
</html>
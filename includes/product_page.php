<?php
include "header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="containerr">
  <div class="a"></div>
  <div class="right">
  <div class="contacts"></div>
  <div class="priceOffer">
    <form action="../classes/product_page.class.php" method="POST">
      <input type="text" placeholder="price">
      <input type="submit" value="send">
    </form>
  </div>
  <div class="chat">
      <section class="chat-area">
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="" hidden>
          <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <button><i class="">send</i></button>
        </form>
      </section>
  </div>
  
  <div class="payment">

  </div>
  </div>
</div>
  
</body>
<script>
  // getall();
  // post_data();
   getcontacts();
   post_data();
    function post_data(){
     
      url = '../classes/product_page.class.php';
      var page_url = window.location.href;
      var page_url_array = page_url.split('=');
      var title = page_url_array[1];
      var created_at = page_url_array[2];
      console.log(title);
      console.log(created_at);
      var posting = $.post( url, { action: 'pageurl', id1:title ,id2:created_at });
      posting.done(function( data ) {
           $('.a').html(data);
           
      });

      //$.get('../classes/product_page.class.php',{ action:'getcontacts'})
      //.done(function(data){
      //$('.contacts').html(data);
      //});
    
  }


  //getprice_offer();
  function getprice_offer(){
  $.get('../classes/product_page.class.php',{ action:'getprice_offer'})
      .done(function(data){
      $('.priceOffer').html(data);
      });
  }
  
  //getchat();
  function getchat(){
    $.get('../classes/product_page.class.php',{ action:'chat'})
      .done(function(data){
      $('.chat').html(data);
      });
  }
  //getcontacts();
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

  
</script>
</html>
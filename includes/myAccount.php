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
      <div class="a"></div>
        <div class="prof"></div>
        <div class="dispRecords">
          <div class="s"></div>
    </div>  
    
        

    </div> 
</body>
<script>
    getall();
    function getall(){
    
  url = '../classes/myaccount.class.php';
  var page_url = window.location.search.substring(1);
  var parameter = page_url.split('=');
  var action = parameter[0];
  var index = parameter[1];
  console.log(action);
  console.log(index);
  var posting = $.post( url, { action:'edit', a:action ,index:index });
  posting.done(function( data ) {
       $('.dispRecords').html(data);
       
  });
    

  $.get('../classes/myaccount.class.php',{ action:'get_message'})
  .done(function(data){
    $('.dispRecords').html(data);
  });
  $.get('../classes/myaccount.class.php',{ action:'profile'})
  .done(function(data){
    $('.prof').html(data);
  });
  }

</script>
</html>
<?php

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
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
          /*$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }*/
        ?>
        <a href="use.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php //echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php // echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php // echo $row['status']; ?></p>
        </div>
      </header>
      <div class="msg">

      </div>
      <form action="crud.php" class="typing-area" method="post">
        <input type="text" class="incoming_id" name="incoming_id" value="1111" hidden>
        <input type="text" name="message" class="message" placeholder="Type a message here..." autocomplete="off">
        <!--<button><i class="fab fa-telegram-plane"></i></button>-->
        <input type="submit" class = 'submit' name="submit" value="add" >
      </form>
      <div class="msg2"></div>
      <tbody>

      </tbody>
    </section>
  </div>

  <script>
    getall();
  

    $('form').submit(function(event){
    event.preventDefault();
    var $form = $(this),
    url = $form.attr('action');
    var action = 'send_message';
    insert_user(url, action);
    getall();
    });
    function insert_user(url,action){
    var post = $.post(url, {
        incoming_id: $('.incoming_id').val(),
        message: $('.message').val(),
        action:action
    
    });
    post.done(function(data){
        $('.msg').text(data);
        $('.incoming_id').val('');
        $('.message').val('');
    });
  }

  function getall(){
    $.get('crud.php',{ action:'get_message'})
    .done(function(data){
      $('.msg2').html(data);
    });
  }

 

  </script>

</body>
</html>

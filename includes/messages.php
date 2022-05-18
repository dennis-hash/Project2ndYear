<?php
include_once 'header.php';
session_start();
if (isset($_SESSION['user'])) {
    $user_id=$_SESSION['user_id'];

}

include_once '../classes/dbConnect.class.php';
$db = new DB();
$DB = $db->dbConnection();
$sql = "SELECT * FROM messages WHERE incoming_msg_id = :in_id  ORDER BY id";
$stmt = $DB->prepare($sql);
$stmt->execute(array(':in_id'=>$user_id));
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$a=array();
//foreach($result as $row){
//        $prod_id = $row['prod_id'];
//        $out_id =$row['outgoing_msg_id'];
//        array_push($a,$out_id);
       /* $sql = "SELECT * FROM products WHERE productID = :id";
        $stmt = $DB->prepare($sql);
        $stmt->execute(array(':id'=>$prod_id));
        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $noRows= $stmt->rowCount();
        foreach($result2 as $row2){
            $prodTitle=$row2['productName'];
            $prodPrice=$row2['price'];

        }
        echo "<a href='#' onclick='show_chat(); return false;'><div class='no_chats'>
        <div class='sent_msg'>
        <p>id=$prod_id</p>
        <p>$prodTitle</p>
        <p>$prodPrice</p>
        <p>".$row['msg']."</p>
        </div>
        </div></a>";*/
/*}
$num_unique = array_unique($a);
foreach($num_unique as $num){
   
    $sql = "SELECT * FROM users WHERE userID = :id";
    $stmt = $DB->prepare($sql);
    $stmt->execute(array(':id'=>$num));
    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $noRows= $stmt->rowCount();
    foreach($result2 as $row2){
        $username=$row2['username'];
       
        $user_id=$row2['userID'];
    }
    
    echo "<a href='#' onclick='show_chat(); return false;'><div class='no_chats'>
    <div class='sent_msg'>
    <p>$num</p>
    <p>title$username</p>
    </div>
    </div></a>";
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="ains.css">
</head>
<body>
    <div class="connn">
        <div class="no_chats">
            <?php
                include_once '../classes/dbConnect.class.php';
                $db = new DB();
                $DB = $db->dbConnection();
                $sql = "SELECT * FROM messages WHERE incoming_msg_id = :in_id  ORDER BY id";
                $stmt = $DB->prepare($sql);
                $stmt->execute(array(':in_id'=>$user_id));
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $a=array();
                foreach($result as $row){
                        $prod_id = $row['prod_id'];
                        $out_id =$row['outgoing_msg_id'];
                        $in_id =$row['incoming_msg_id'];
                        array_push($a,$out_id);
                     
                }
                $num_unique = array_unique($a);
             

                foreach($num_unique as $num){
                   
                    $sql = "SELECT * FROM users WHERE userID = :id";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute(array(':id'=>$num));
                    $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $noRows= $stmt->rowCount();
                    foreach($result2 as $row2){
                        $username=$row2['username'];
                       
                        $user_id=$row2['userID'];
                    }
                    if($noRows = 0){
                        echo "<p>No available chats</p>";
                    }
                    echo "<a href='#' onclick='show_chat(".$user_id.','.$in_id."); return false;'><div class='no_chats'>
                    <div class='sent_msg'>
                    
                    <p>$username</p>
                    </div>
                    </div></a>";
                }
            ?>
        </div>
        <div class="chat_area">
        <div class="chat-box">
                <p style="text-align: center;">Select Chat to view conversation</p>

        </div>
        <form action="../classes/chat.class.php" class="typing-area" name="form" id="form" method="post">
        <input type="text" id="sender_id" class="" name="" value="<?php echo $in_id?>" hidden>
          <input type="text" id="seller_id" class="" name="" value="<?php echo $user_id?>" hidden>
          <input type="text" id="prod_id" class="" name="" value="<?php echo $prod_id?>" hidden>
          <input type="text" id="message" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <input type="submit" class="icon"  value="send" style="width: 55px; background: #0D5BE1;">
          
        </form>
        </div>

    </div>
</body>
<script>
   function show_chat(sender_id,my_id){
       
       var url = '../classes/chat.class.php';
        var posting = $.get( url, { action: 'getchat', sender_id:sender_id, seller_id:my_id });
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
     show_chat(sender_id,my_id)
    });
    function send(url,action){
        console.log($('#sender_id').val());
        console.log($('#seller_id').val());

      var formData = new FormData($('form')[0]);
      formData.append('message', $('#message').val());
      formData.append('sender_id', $('#sender_id').val());
      formData.append('seller_id', $('#seller_id').val());
      formData.append('prod_id', $('#prod_id').val());
      formData.append('action', action);
      //formData.append('seller_id', seller_id);
      //formData.append('prod_id', prod_id);
   
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          //$('.chat-box').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
      });

      chatBox = document.querySelector(".chat-box");
      chatBox.scrollBottom = chatBox.scrollHeight;
      
    }

</script>
</html>

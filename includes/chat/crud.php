<?php
require_once "insert-chat.php";
$chat = new Chat();
if($_POST['action'] === 'send_message'){
   $chat->send_message($data);
   $chat->send_message($_POST);
}
if($_GET['action'] === 'get_message'){
  echo $chat->get_message();
}


?>
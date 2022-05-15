<?php
require_once 'dbConnect.class.php';
session_start();
$chat = new Chat();
//$this->send_message($_POST);
class Chat{ 
    private $sender_id;
    private $receiver_id;
    private $message;
    private $output;

    public function __construct()
    {
        $db=new DB();
        $this->DB = $db->dbConnection();
        
        if($_POST['action'] === 'getchat'){
            $sender_id = $_POST['sender_id'];
            $receiver_id = $_POST['seller_id'];
            //echo "s=$sender_id, r=$receiver_id";
            $this->get_message($sender_id, $receiver_id);
            
        }
       if($_POST['action'] === 'send_message'){
        $this->message = $_POST['message'];
        $this->sender_id = $_POST['sender_id'];
        $this->receiver_id = $_POST['seller_id'];
        $this->send_message($_POST);
            
        }
       
         
    }

    public function send_message(){
     
       if(!empty($this->message)){
            
            $sql = "INSERT INTO messages (`incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES (:in_id, :out_id,:msg)";
            $stmt = $this->DB->prepare($sql);
            $stmt->execute(array(':in_id'=>$this->receiver_id,':out_id'=>$this->sender_id,':msg'=>$this->message));
           

        }
        else{
            
        }
        
    }

    public function get_message($sender_id, $receiver_id){
  
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
       
       
        $sql ="SELECT * FROM `messages` WHERE `incoming_msg_id` = :in_id AND `outgoing_msg_id` = :out_id OR `incoming_msg_id` = :out_id AND `outgoing_msg_id` = :in_id ORDER BY id";
        $stmt = $this->DB->prepare($sql);
        $stmt->execute(array(':in_id'=>$this->receiver_id,':out_id'=>$this->sender_id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $num_rows = $stmt->rowCount();
        if($num_rows > 0){
            foreach($result as $row){
                if($row['outgoing_msg_id'] === $this->sender_id){
                  
                    $this->output .= '<div class="chat outgoing">
                                <div class="details"> 
                                    <p>'.$row['msg'].'</p>
                                </div>
                                </div>';
                                echo $this->output;
                   
                }else{
                   
                    $this->output .= '<div class="chat incoming">
                               <!-- <img src="php/images/'.$row['img'].'" alt="">-->
                                <div class="details">
                                    <p>' .$row['msg'] .'</p>
                                    
                                </div>
                                </div>';
                                echo $this->output;
                                
                                
                }
        }
    }else{
        
        $this->output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        echo $this->output;
    }
   
}

}

//$chat = new Chat();
//$chat->send_message();
//$chat->get_message();



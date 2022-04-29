<?php
require_once ("db.php");
class Chat extends DB {
    private $sender_id;
    private $receiver_id;
    private $message;
    private $output;

    public function __construct()
    {
        //$this->sender_id = $sender_id;
        //$this->receiver_id = $receiver_id;
        //$this->message = $message;
    }

    public function send_message($data){
       
       $message = $data['message'];
       $sender_id = $data['sender_id'];
       $this->receiver_id = 123;
       if(!empty($message)){
            
            $sql = "INSERT INTO messages (`incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES (:in_id, :out_id,:msg)";
            $stmt = $this->dbConnection()->prepare($sql);
            $stmt->execute(array(':in_id'=>$this->receiver_id,':out_id'=>$sender_id,':msg'=>$message));
            echo "inserted!";
            echo "wow";
            echo "wow1";
            echo "wow2";

        }
        else{
            
        }
        
    }

    public function get_message(){
       
        $this->receiver_id = 123;
        $sql = "SELECT * FROM messages WHERE incoming_msg_id = :in_id";
        $stmt = $this->dbConnection()->prepare($sql);
        $stmt->execute(array(':in_id'=>$this->receiver_id));
        $result = $stmt->fetchAll();
        if(!empty($result)){
            foreach($result as $row){
                $this->output .= "<div class='outgoing_msg'>
                                <div class='sent_msg'>
                                    <p>".$row['msg']."</p>
                                    <span class='time_date'> 11:01 AM    |    June 9</span>
                                </div>
                            </div>";
                
            }
        }else{
            $this->output = "No messages";
        }
        return $this->output;
    
        /*$sql = "SELECT * FROM messages LEFT JOIN users ON users.unserID = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$this->sender_id} AND incoming_msg_id = {$this->receiver_id})
                OR (outgoing_msg_id = {$this->receiver_id} AND incoming_msg_id = {$this->sender_id}) ORDER BY msg_id";*/
        //$result = $this->dbConnection()->query($sql);
        //$num_row = $result->rowCount();
        /*if($num_row > 0){
            while($row = $result->fetch(PDO::FETCH_GROUP |PDO::FETCH_ASSOC)){
                if($row['outgoing_msg_id'] === $this->sender_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details"> 
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                    echo $output;
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                                echo $output;
                }
        }
    }else{
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        echo $output;
    }*/
   
}

}

//$chat = new Chat();
//$chat->send_message();
//$chat->get_message();



<?php

   
    /*protected function connect(){
        global  $connectdb;
        $dbhost = 'localhost';
        $dbname = 'projectDB';
        $dbuser = 'dennis';
        $dbpass = '12414-Denn!s';
        
       
       $connectdb = new mysqli( $dbhost, $dbuser, $dbpass, $dbname);
        if($connectdb -> connect_error) die(" Unable to connect to Database");
       
       return $connectdb;
    }

    protected function queryMysql ($query) {
        global $connectdb;
        $results = $connectdb ->query($query);
        if (!$results) echo mysqli_error($connectdb);
        return $results;
    }*/
class DB{
    private $host = "localhost";
    private $db_name = "projectDB";
    private $username = "dennis";
    private $password = "12414-Denn!s";
    public $conn;
    //db connection
    public function dbConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}




<?php
class DB{
   
    protected function connect(){
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
    }
}
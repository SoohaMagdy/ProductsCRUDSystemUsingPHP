<?php
class DB
{
   var $servername;
   var $dbuser;
   var $dbpassword;
   var $dbname;

   public function __construct($servername, $dbuser, $dbpassword, $dbname){
       $this->servername = $servername;
       $this->dbuser = $dbuser;
       $this->dbpassword = $dbpassword;
       $this->dbname = $dbname;
   }

   function getConnection(){
    $conn = new mysqli($this->servername, $this->dbuser, $this->dbpassword, $this->dbname);
    return $conn;
   }
}

$db = new Db("localhost","root","","route_backend");
$conn = $db->getConnection();
?>
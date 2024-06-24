<?php 
class Database
{
    private $host="localhost";
    private $db_name="clotherapp";
    private $user="root";
    private $pass="";
    public $conn;
    public function getConnect(){
        $this->conn=null;
        try{
            $this->conn=new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->user,$this->pass);
            $this->conn->exec("Set names utf8");
        }
        catch(PDOException $e){
            echo "Connection err".$e->getMessage();
        }
        return $this->conn;
    }
}
?>
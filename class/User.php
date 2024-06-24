<?php 
class User{
    private $conn;
    private $table_name="account";
    private $user,$pass;
    public function __construct($db,$user,$pass)
    {
        $this->conn=$db;
        $this->user=$user;
        $this->pass=$pass;
    }
    public function checkLoginAdmin(){
        $sql="SELECT Name FROM account WHERE Username='".$this->user."' and Password='".$this->pass."' and Role='Admin'";
        $stmt=$this->conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->execute();

    }
    
}
?>
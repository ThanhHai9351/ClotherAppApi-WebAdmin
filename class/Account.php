<?php 
class Account{
    public $ID,$Name,$Username,$Phone,$DOB,$Address,$Gender;
    public function __construct($ID=0,$Name="",$Username="",$Phone="",$DOB="",$Address="",$Gender=true)
    {
        $this->$ID=$ID;
        $this->$Name=$Name;
        $this->$Username=$Username;
        $this->$Phone=$Phone;
        $this->$DOB=$DOB;
        $this->$Address=$Address;
        $this->$Gender=$Gender;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `account`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new Account();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($id){
        global $conn;
        $sql="SELECT * FROM `account` where ID=".$id;
        $temp=new Account();
        $query=$conn->query($sql);
        $row= $query->fetch(PDO::FETCH_ASSOC);
        foreach($row as $key=>$pro){
            $temp->{$key}=$row[$key];
        }
        return $temp;
    }
}
?>
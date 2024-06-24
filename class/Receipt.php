<?php 
class Receipt{
    public $ID,$IDUser,$IDProduct,$TotalMoney,$IDPayment,$PaidAt,$Color,$Size;
    public function __construct($ID=0,$IDUser=0,$IDProduct=0,$TotalMoney=0,$IDPayment=0,$PaidAt="",$Color="",$Size=0)
    {
        $this->ID=$ID;
        $this->IDUser=$IDUser;
        $this->IDProduct=$IDProduct;
        $this->TotalMoney=$TotalMoney;
        $this->IDPayment=$IDPayment;
        $this->PaidAt=$PaidAt;
        $this->Color=$Color;
        $this->Size=$Size;
            
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `receipt`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new Receipt();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($id){
        global $conn;
        $sql="SELECT * FROM `receipt` where ID=".$id;
        $temp=new Receipt();
        $query=$conn->query($sql);
        $row= $query->fetch(PDO::FETCH_ASSOC);
        foreach($row as $key=>$pro){
            $temp->{$key}=$row[$key];
        }
        return $temp;
    }
    function deleteData($id){
        global $conn;
        $sql="DELETE FROM `receipt` WHERE ID=".$id;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    
}
?>
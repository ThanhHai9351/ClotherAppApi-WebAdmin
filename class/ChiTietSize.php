<?php 
class ChiTietSize{
    public $IDSize,$IDProduct;
    public function __construct($IDSize=0,$IDProduct=0)
    {
        $this->IDSize=$IDSize;
        $this->IDProduct=$IDProduct;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `chitietsize`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new ChiTietSize();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($idProduct){
        global $conn;
        $sql="SELECT * FROM `chitietsize` where IDProduct=".$idProduct;
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new ChiTietSize();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function insertData($IDSize,$IDProduct){
        global $conn;
        $sql="INSERT INTO `chitietsize`(`IDSize`, `IDProduct`) VALUES ('".$IDSize."','".$IDProduct."')";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function updateData($IDSize,$IDProduct){
        global $conn;
        $sql="UPDATE `chitietsize` SET `IDSize`='".$IDSize."' WHERE `IDProduct`='".$IDProduct."'";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData($IDProduct){
        global $conn;
        $sql="DELETE FROM `chitietsize` WHERE `IDProduct`=".$IDProduct;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteSize($IDSize, $IDProduct){
        global $conn;
        $sql="DELETE FROM `chitietsize` WHERE `IDSize`=".$IDSize." and IDProduct=".$IDProduct;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
}
?>
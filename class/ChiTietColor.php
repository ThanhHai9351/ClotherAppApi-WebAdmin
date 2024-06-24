<?php 
class ChiTietColor{
    public $IDColor,$IDProduct;
    public function __construct($IDColor=0,$IDProduct=0)
    {
        $this->IDColor=$IDColor;
        $this->IDProduct=$IDProduct;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `chitietcolor`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new ChiTietColor();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($idProduct){
        global $conn;
        $sql="SELECT * FROM `chitietcolor` where IDProduct=".$idProduct;
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new ChiTietColor();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function insertData($IDColor,$IDProduct){
        global $conn;
        $sql="INSERT INTO `chitietcolor`(`IDColor`, `IDProduct`) VALUES ('".$IDColor."','".$IDProduct."')";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function updateData($IDColor,$IDProduct){
        global $conn;
        $sql="UPDATE `chitietcolor` SET `IDColor`='".$IDColor."' WHERE `IDProduct`='".$IDProduct."'";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData($IDProduct){
        global $conn;
        $sql="DELETE FROM `chitietcolor` WHERE `IDProduct`=".$IDProduct;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteColor($IDColor, $IDProduct){
        global $conn;
        $sql="DELETE FROM `chitietcolor` WHERE `IDColor`=".$IDColor." and IDProduct=".$IDProduct;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
}
?>
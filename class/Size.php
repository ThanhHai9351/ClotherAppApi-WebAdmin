<?php 
class Size{
    public $ID,$Size;
    public function __construct($id=0,$size=0)
    {
        $this->ID=$id;
        $this->Size=$size;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `size`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new Size();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($id){
        global $conn;
        $sql="SELECT * FROM `size` where ID=".$id;
        $temp=new Size();
        $query=$conn->query($sql);
        $row= $query->fetch(PDO::FETCH_ASSOC);
        foreach($row as $key=>$pro){
            $temp->{$key}=$row[$key];
        }
        return $temp;
    }
    function insertData($Size){
        global $conn;
        $sql="INSERT INTO `size`(Size) VALUES ('".$Size."')";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function updateData($id,$Size){
        global $conn;
        $sql="UPDATE `size` SET `Size`='".$Size."' WHERE `ID`='".$id."'";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData($id){
        global $conn;
        $sql="DELETE FROM `size` WHERE ID=".$id;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    
}
?>
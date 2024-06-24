<?php 
class Color{
    public $ID,$Color;
    public function __construct($id=0,$color="")
    {
        $this->ID=$id;
        $this->Color=$color;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `color`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new Color();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($id){
        global $conn;
        $sql="SELECT * FROM `color` where ID=".$id;
        $temp=new Color();
        $query=$conn->query($sql);
        $row= $query->fetch(PDO::FETCH_ASSOC);
        foreach($row as $key=>$pro){
            $temp->{$key}=$row[$key];
        }
        return $temp;
    }
    function insertData($color){
        global $conn;
        $sql="INSERT INTO `color`(`Color`) VALUES ('".$color."')";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function updateData($id,$color){
        global $conn;
        $sql="UPDATE `color` SET `color`='".$color."' WHERE `ID`='".$id."'";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData($id){
        global $conn;
        $sql="DELETE FROM `color` WHERE ID=".$id;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    
}
?>
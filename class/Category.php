<?php 
class Category{
    public $ID,$NameCategory;
    public function __construct($id=0,$NameCategory="")
    {
        $this->ID=$id;
        $this->NameCategory=$NameCategory;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `category`";
        $list=$conn->query($sql);
        $arrTemps=array();
        foreach($list->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $temp=new Category();
            foreach($row as $key=>$pro){
                $temp->{$key}=$row[$key];
            }
            $arrTemps[]=$temp;
        }
        return $arrTemps;
    }
    function getById($id){
        global $conn;
        $sql="SELECT * FROM `category` where ID=".$id;
        $temp=new Category();
        $query=$conn->query($sql);
        $row= $query->fetch(PDO::FETCH_ASSOC);
        foreach($row as $key=>$pro){
            $temp->{$key}=$row[$key];
        }
        return $temp;
    }
    function insertData($category){
        global $conn;
        $sql="INSERT INTO `category`(`NameCategory`) VALUES ('".$category."')";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function updateData($id,$category){
        global $conn;
        $sql="UPDATE `category` SET `NameCategory`='".$category."' WHERE `ID`='".$id."'";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData($id){
        global $conn;
        $sql="DELETE FROM `category` WHERE ID=".$id;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    
}
?>
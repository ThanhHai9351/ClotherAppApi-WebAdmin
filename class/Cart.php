<?php 
class Cart{
    private $conn;
    private $table_name="shoppingcart";
    public $ID,$IDUser,$IDProduct,$Quantity,$Money,$Color,$Size;
    public function __construct($db)
    {
        $this->conn=$db;
    }
    function getData($idUser){
        $sql="SELECT `shoppingcart`.*,`product`.`Image`,product.NameProduct, category.NameCategory,product.Price,(SELECT COUNT(*) FROM `evaluate` WHERE `evaluate`.`IDProduct` = `product`.`ID`) AS `QuantityReview` FROM `shoppingcart`, `product`,category WHERE shoppingcart.IDProduct=product.ID and product.CategoryID=category.ID and shoppingcart.IDUser='".$idUser."'";
        $stmt=$this->conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt;
    }
    function insertData(){
        $sql="INSERT INTO `shoppingcart`(`IDUser`, `IDProduct`, `Quantity`, `Money`, `Color`, `Size`) VALUES ('".$this->IDUser."','".$this->IDProduct."','".$this->Quantity."','".$this->Money."','".$this->Color."','".$this->Size."')";
        $stmt=$this->conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function updateData(){
        $sql="UPDATE ".$this->table_name." SET `Quantity`='".$this->Quantity ."' WHERE `IDUser`='".$this->IDUser ."' and `IDProduct`='".$this->IDProduct."' and `Color`='".$this->Color."' and `Size`=".$this->Size;
        $stmt=$this->conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData(){
        $sql="DELETE FROM ".$this->table_name." WHERE `ID`='".$this->ID ."'";
        $stmt=$this->conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function checkData($idUser,$idProduct,$color,$size){
        $sql="SELECT Quantity FROM `shoppingcart` WHERE IDUser=".$idUser." and IDProduct=".$idProduct." and Color='".$color."' and Size=".$size;
        $temp=$this->conn->query($sql);
        $row= $temp->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>
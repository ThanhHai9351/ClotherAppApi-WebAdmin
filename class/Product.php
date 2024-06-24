<?php 
class Product{
    public $ID,$NameProduct,$Description,$Image,$Star,$Price,$Quantity,$CategoryID;
    public function __construct($id=0,$nameProduct="",$description="",$image="",$star=0,$price=0,$quantity=0,$categoryId=0)
    {
        $this->ID=$id;
        $this->NameProduct=$nameProduct;
        $this->Description=$description;
        $this->Image=$image;
        $this->Star=$star;
        $this->Price=$price;
        $this->Quantity=$quantity;
        $this->CategoryID=$categoryId;
    }
    function getData(){
        global $conn;
        $sql="SELECT * FROM `product`";
        $products=$conn->query($sql);
        $arrProducts=array();
        foreach($products->fetchAll(PDO::FETCH_ASSOC) as $row){ 
            $product=new Product();
            foreach($row as $key=>$pro){
                $product->{$key}=$row[$key];
            }
            $arrProducts[]=$product;
        }
        return $arrProducts;
    }
    function getById($id){
        global $conn;
        $sql="SELECT * FROM `product` where ID=".$id;
        $product=new Product();
        $temp=$conn->query($sql);
        $row= $temp->fetch(PDO::FETCH_ASSOC);
        foreach($row as $key=>$pro){
            $product->{$key}=$row[$key];
        }
        return $product;
    }
    function insertData($nameProduct,$description,$image,$star,$price,$quantity,$categoryId){
        global $conn;
        $sql="INSERT INTO `product`(`NameProduct`, `Description`, `Image`, `Star`, `Price`, `Quantity`, `CategoryID`) VALUES ('".$nameProduct."','".$description."','".$image."','$star','".$price."','".$quantity."','".$categoryId."')";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return $conn->lastInsertId();
        return false;
    }
    function updateData($id,$nameProduct,$description,$image,$star,$price,$quantity,$categoryId){
        global $conn;
        $sql="UPDATE `product` SET `NameProduct`='".$nameProduct."',`Description`='".$description."',`Image`='".$image."',`Star`='".$star."',`Price`='".$price."',`Quantity`='".$quantity."',`CategoryID`='".$categoryId."' WHERE `ID`='".$id."'";
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    function deleteData($id){
        global $conn;
        $sql="DELETE FROM `product` WHERE ID=".$id;
        $stmt=$conn->prepare($sql);
        if($stmt->execute())
            return true;
        return false;
    }
    
}
?>
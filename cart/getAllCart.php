<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include '../class/db.php';
include '../class/Cart.php';

$database= new Database();
$db=$database->getConnect();

$carts=new Cart($db);
$data=json_decode(file_get_contents("php://input"));
$idUser=$data->idUser;
//$idUser=1;
$stmt=$carts->getData($idUser);
$num=$stmt->rowCount();
if($num){
    $arrCarts = array();
    $arrCarts["carts"] = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $product = array(
            "ID" => $ID,
            "IDUser" => $IDUser,
            "IDProduct" => $IDProduct,
            "Quantity"=>$Quantity,
            "Money"=>$Money,
            "Color"=>$Color,
            "Size"=>$Size,
            "Image"=>$Image,
            "NameProduct"=>$NameProduct,
            "NameCategory"=>$NameCategory,
            "Price"=>$Price,
            "QuantityReview"=>$QuantityReview
        );
        array_push($arrCarts["carts"], $product);
    }
    
    echo json_encode($arrCarts);
}
else{
    echo json_encode(array("message" => "Khong co sv"));
}
?>
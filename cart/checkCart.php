<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
include '../class/db.php';
include '../class/Cart.php';

$database= new Database();
$db=$database->getConnect();

$carts=new Cart($db);
$data=json_decode(file_get_contents("php://input"));
$IDUser=$data->IDUser;
$IDProduct=$data->IDProduct;
$Color=$data->Color;
$Size=$data->Size;

// $IDUser=1;
// $IDProduct=5;
// $Color='Red';
// $Size=20;
$stmt=$carts->checkData($IDUser,$IDProduct,$Color,$Size);

if($stmt){
    echo json_encode(array("Count" => $stmt['Quantity']));
}
else{
    echo json_encode(array("Count" => 0));
}
?>
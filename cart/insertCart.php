<?php  
header("Access-Control-Allow-Origin: *");
header("Conten-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../class/db.php';
include '../class/Cart.php';

$respone=array("error"=>FALSE);
$database=new Database();
$db=$database->getConnect();
$cart=new Cart($db);

$data=json_decode(file_get_contents("php://input"));
$cart->IDUser=$data->IDUser;
$cart->IDProduct=$data->IDProduct;
$cart->Quantity=$data->Quantity;
$cart->Money=$data->Money;
$cart->Color=$data->Color;
$cart->Size=$data->Size;
// $cart->IDUser=1;
// $cart->IDProduct=5;
// $cart->Quantity=10;
// $cart->Money=50;
// $cart->Color='Red';
// $cart->Size=20;
if($cart->insertData()){
    $respone["error"]=FALSE;
    $respone["message"]="Successful";
    echo json_encode($respone);
}
else{
    $respone["error"]=TRUE;
    $respone["error__msg"]="Unsuccessful";
    echo json_encode($respone);
}
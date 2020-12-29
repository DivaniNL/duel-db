<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_GET['name'])){
   $atk_name = $_GET['name'];
}
if(isset($_GET['atk_id'])){
    $atk_id = $_GET['atk_id'];
 }
 if(isset($_GET['type'])){
    $type = $_GET['type'];
 }
// required headers
// database connection will be here
// include database and object files
include_once '../conn/connect.php';
include_once '../objects/product.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$product = new Product($db);

// read products will be here
// query products
if($type == 'color'){
if($atk_name == 'gold' || $atk_name == 'red' || $atk_name == 'white' || $atk_name == 'purple' || $atk_name == 'blue'){
$result = $product->update_attacks($atk_id,$atk_name, $type);
}
}else{
$result = $product->update_attacks($atk_id,$atk_name, $type);
}
?>
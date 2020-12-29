<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET['atk_id'])){
    $atk_id = $_GET['atk_id'];
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
$result = $product->delete($atk_id);
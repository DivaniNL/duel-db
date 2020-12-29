<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_GET['name'])){
   $value = $_GET['name'];
}
if(isset($_GET['figure_id'])){
    $figure_id = $_GET['figure_id'];
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


if($type == 'type_1'){
if($value == 'None' || $value == 'Bug' || $value == 'Dark' || $value == 'Dragon' || $value == 'Electric' || $value == 'Fairy' || $value == 'Fighting' || $value == 'Flying' || $value == 'Grass' || $value == 'Ghost' || $value == 'Ground' || $value == 'Ice' || $value == 'Normal' || $value == 'Poison' || $value == 'Psychic' || $value == 'Rock' || $value == 'Steel' || $value == 'Water'){
$result = $product->update_figure($figure_id,$value, $type);
}
}

else if($type == 'type_2'){
if($value == 'None' || $value == 'Bug' || $value == 'Dark' || $value == 'Dragon' || $value == 'Electric' || $value == 'Fairy' || $value == 'Fighting' || $value == 'Flying' || $value == 'Grass' || $value == 'Ghost' || $value == 'Ground' || $value == 'Ice' || $value == 'Normal' || $value == 'Poison' || $value == 'Psychic' || $value == 'Rock' || $value == 'Steel' || $value == 'Water'){
$result = $product->update_figure($figure_id,$value, $type);
}
}

else if($type == 'mp'){
if($value == 0 || $value == 1 || $value == 2 || $value == 3){
$result = $product->update_figure($figure_id,$value, $type);
}
}

else if($type == 'rarity'){
if($value == 'C' || $value == 'UC' || $value == 'R' || $value == 'EX' || $value == 'UX'){
$result = $product->update_figure($figure_id,$value, $type);
}
}



else{$result = $product->update_figure($figure_id,$value, $type);}
?>

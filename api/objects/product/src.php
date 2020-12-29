<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_GET['set_id'])){
    $set_id = $_GET['set_id'];
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
$result = $product->srcNew();
$num = $result->num_rows;

// check if more than 0 record found
if($num>0){

   // products array
   $products_arr=array();
//    $overview .=  "id  ||  ";
//    $overview .=  "naam  ||  ";
//    $overview .=  "beschrijving  ||  ";
//    $overview .=  "prijs  ||  ";
//    $overview .=  "\n";
   // product data ophalen
   while ($row = $result->fetch_assoc()){
       // extract row
       // this will make $row['name'] to
       // just $name only

       extract($row);

 $product_item=array(
           'password' => $password,
           'figure_id' => $figure_id,
           'figname' => $figname,
           'ability' => $ability,
           'ability_name' => $ability_name,
           'atk_id' => $id,
           'name' => $name,
           'size' => $size,
           'damage' => $damage,
           'color' => $color,
           'descr' => $descr,
           'type_1' => $type_1,
           'type_2' => $type_2,
           'mp' => $mp,
           'rarity' => $rarity,
	    'user' => $user,
           'set_id' => $set_id
       );


       array_push($products_arr, $product_item);
    //    $overview .=  $id."  ||  ";

    //    $overview .=  "<a href='delete.php?id=$id'>".$naam."</a>  ||  ";

    //    $overview .=  html_entity_decode($beschrijving)."  ||  ";
    //    $overview .=  $prijs."  ||  ";
    //    $overview .=  "\n";
   }

   // set response code - 200 OK
   http_response_code(200);

   echo json_encode($products_arr);

   //echo($products_arr[0]['id']);


}

else{

   // set response code - 404 Not found
   http_response_code(404);

   // tell the user no products found
   echo json_encode(
       array("message" => "Geen producten gevonden")
   );
}
$_SESSION['fig'] = $figname;
?>

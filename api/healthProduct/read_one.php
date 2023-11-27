<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/healthProduct.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare healthProduct object
$healthProduct = new HealthProduct($db);
  
// set ID property of record to read
$healthProduct->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of healthProduct to be edited
$healthProduct->readOne();
  
if($healthProduct->name!=null){
    // create array
    $healthProduct_arr = array(
        "id" =>  $healthProduct->id,
        "image" =>  $healthProduct->image,
        "name" => $healthProduct->name,
        "ingredient" => $healthProduct->ingredient,
        "directions" => $healthProduct->directions,
        "category_id" => $healthProduct->category_id,
        "category_brand" => $healthProduct->category_brand
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($healthProduct_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user healthProduct does not exist
    echo json_encode(array("message" => "Health Product does not exist."));
}
?>
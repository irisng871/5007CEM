<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/healthProduct.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare healthProduct object
$healthProduct = new HealthProduct($db);
  
// get id of healthProduct to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of healthProduct to be edited
$healthProduct->id = $data->id;
  
// set product property values
$healthProduct->image = $data->image;
$healthProduct->name = $data->name;
$healthProduct->ingredient = $data->ingredient;
$healthProduct->directions = $data->directions;
$healthProduct->category_id = $data->category_id;
  
// update the healthProduct
if($healthProduct->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Medical Product was updated."));
}
  
// if unable to update the healthProduct, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update Medical Product."));
}
?>
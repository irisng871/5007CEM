<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate healthProduct object
include_once '../objects/healthProduct.php';
  
$database = new Database();
$db = $database->getConnection();
  
$healthProduct = new HealthProduct($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->image) &&
    !empty($data->name) &&
    !empty($data->ingredient) &&
    !empty($data->directions) &&
    !empty($data->category_id)
){
  
    // set healthProduct property values
    $healthProduct->image = $data->image;
    $healthProduct->name = $data->name;
    $healthProduct->ingredient = $data->ingredient;
    $healthProduct->directions = $data->directions;
    $healthProduct->category_id = $data->category_id;
  
    // create the healthProduct
    if($healthProduct->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Health Product was created."));
    }
  
    // if unable to create the healthProduct, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Health Product."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create Health Product. Data is incomplete."));
}
?>
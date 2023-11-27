<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate pharmacy object
include_once '../objects/pharmacy.php';
  
$database = new Database();
$db = $database->getConnection();
  
$pharmacy = new Pharmacy($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->image) &&
    !empty($data->name) &&
    !empty($data->address) &&
    !empty($data->operation_hour) &&
    !empty($data->contact) &&
    !empty($data->facebook) &&
    !empty($data->map) &&
    !empty($data->category_id)
){
  
    // set pharmacy property values
    $pharmacy->image = $data->image;
    $pharmacy->name = $data->name;
    $pharmacy->address = $data->address;
    $pharmacy->operation_hour = $data->operation_hour;
    $pharmacy->contact = $data->contact;
    $pharmacy->facebook = $data->facebook;
    $pharmacy->map = $data->map;
    $pharmacy->category_id = $data->category_id;
  
    // create the pharmacy
    if($pharmacy->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Pharmacy was created."));
    }
  
    // if unable to create the pharmacy, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create pharmacy."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create pharmacy. Data is incomplete."));
}
?>
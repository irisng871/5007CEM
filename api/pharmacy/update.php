<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/pharmacy.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare pharmacy object
$pharmacy = new Pharmacy($db);
  
// get id of pharmacy to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of pharmacy to be edited
$pharmacy->id = $data->id;
  
// set pharmacy property values
$pharmacy->image = $data->image;
$pharmacy->name = $data->name;
$pharmacy->address = $data->address;
$pharmacy->operation_hour = $data->operation_hour;
$pharmacy->contact = $data->contact;
$pharmacy->facebook = $data->facebook;
$pharmacy->map = $data->map;
$pharmacy->category_id = $data->category_id;
  
// update the pharmacy
if($pharmacy->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Pharmacy was updated."));
}
  
// if unable to update the pharmacy, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update pharmacy."));
}
?>
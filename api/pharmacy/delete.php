<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../config/database.php';
include_once '../objects/pharmacy.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare pharmacy object
$pharmacy = new Pharmacy($db);
  
// get pharmacy id
$data = json_decode(file_get_contents("php://input"));
  
// set pharmacy id to be deleted
$pharmacy->id = $data->id;
  
// delete the pharmacy
if($pharmacy->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Pharmacy was deleted."));
}
  
// if unable to delete the pharmacy
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete pharmacy."));
}
?>
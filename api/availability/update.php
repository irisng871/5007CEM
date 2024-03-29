<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/availability.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare availability object
$availability = new Availability($db);
  
// get id of availability to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of availability to be edited
$availability->id = $data->id;
  
// set availability property values
$availability->booking_id = $data->booking_id;
  
// update the availability
if($availability->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Availability was updated."));
}
  
// if unable to update the availability, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update availability."));
}
?>
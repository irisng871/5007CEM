<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/availability.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare availability object
$availability = new Availability($db);
  
// set ID property of record to read
$availability->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of availability to be edited
$availability->readOne();
  
if($availability->name!=null){
    // create array
    $availability_arr = array(
        "id" =>  $availability->id,
        "booking_id" =>  $availability->booking_id,
        "state" => $availability->state,
        "date" =>  $availability->date,
        "time" => $availability->time,
        "user_id" => $availability->user_id,
        "user_name" => $availability->user_name,
        "user_birth_date" => $availability->birth_date,
        "user_ic_number" =>  $availability->user_ic_number,
        "user_contact" => $availability->user_contact,
        "email" => $availability->email,
        "pharmacy_id" => $availability->pharmacy_id,
        "pharmacy_name" => $availability->pharmacy_name,
        "address" => $availability->address,
        "operation_hour" => $availability->operation_hour,
        "pharmacy_contact" => $availability->pharmacy_contact
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($availability_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user availability does not exist
    echo json_encode(array("message" => "Availability does not exist."));
}
?>
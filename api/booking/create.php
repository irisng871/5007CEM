<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate booking object
include_once '../objects/booking.php';
  
$database = new Database();
$db = $database->getConnection();
  
$booking = new Booking($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->contact) &&
    !empty($data->ic_number) &&
    !empty($data->state) &&
    !empty($data->pharmacy) &&
    !empty($data->date) &&
    !empty($data->time) &&
    !empty($data->user_id) &&
    !empty($data->pharmacy_id)
){
  
    // set booking property values
    $booking->name = $data->name;
    $booking->contact = $data->contact;
    $booking->ic_number = $data->ic_number;
    $booking->state = $data->state;
    $booking->pharmacy = $data->pharmacy;
    $booking->date = $data->date;
    $booking->time = $data->time;
    $booking->user_id = $data->user_id;
    $booking->pharmacy_id = $data->pharmacy_id;
  
    // create the booking
    if($booking->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Booking was created."));
    }
  
    // if unable to create the booking, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create booking."));
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
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/booking.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare booking object
$booking = new Booking($db);
  
// set ID property of record to read
$booking->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of booking to be edited
$booking->readOne();
  
if($booking->name!=null){
    // create array
    $booking_arr = array(
        "id" =>  $booking->id,
        "state" => $booking->state,
        "date" =>  $booking->date,
        "time" => $booking->time,
        "user_id" => $booking->user_id,
        "user_name" => $booking->user_name,
        "user_birth_date" => $booking->birth_date,
        "user_ic_number" =>  $booking->user_ic_number,
        "user_contact" => $booking->user_contact,
        "email" => $booking->email,
        "pharmacy_id" => $booking->pharmacy_id,
        "pharmacy_name" => $booking->pharmacy_name,
        "address" => $booking->address,
        "operation_hour" => $booking->operation_hour,
        "pharmacy_contact" => $booking->pharmacy_contact
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($booking_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user booking does not exist
    echo json_encode(array("message" => "Booking does not exist."));
}
?>
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/pharmacy.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare pharmacy object
$pharmacy = new Pharmacy($db);
  
// set ID property of record to read
$pharmacy->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of pharmacy to be edited
$pharmacy->readOne();
  
if($pharmacy->name!=null){
    // create array
    $pharmacy_arr = array(
        "id" =>  $pharmacy->id,
        "image" =>  $pharmacy->image,
        "name" => $pharmacy->name,
        "address" => $pharmacy->address,
        "operation_hour" => $pharmacy->operation_hour,
        "contact" => $pharmacy->contact,
        "facebook" => $pharmacy->facebook,
        "map" => $pharmacy->map,
        "category_id" => $pharmacy->category_id,
        "category_state" => $pharmacy->category_state
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($pharmacy);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user pharmacy does not exist
    echo json_encode(array("message" => "Pharmacy does not exist."));
}
?>
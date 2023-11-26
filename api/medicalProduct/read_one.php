<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/medicalProduct.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare medicalProduct object
$medicalProduct = new MedicalProduct($db);
  
// set ID property of record to read
$medicalProduct->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of medicalProduct to be edited
$medicalProduct->readOne();
  
if($medicalProduct->name!=null){
    // create array
    $medicalProduct_arr = array(
        "id" =>  $medicalProduct->id,
        //"image" =>  $medicalProduct->image,
        "name" => $medicalProduct->name,
        "ingredient" => $medicalProduct->ingredient,
        "directions" => $medicalProduct->directions,
        "category_id" => $medicalProduct->category_id,
        "category_symptoms" => $medicalProduct->category_symptoms
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($medicalProduct_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user medicalProduct does not exist
    echo json_encode(array("message" => "Medical Product does not exist."));
}
?>
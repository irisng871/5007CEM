<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/pharmacy.php';
  
// instantiate database and pharmacy object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$pharmacy = new Pharmacy($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query pharmacys
$stmt = $pharmacy->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // pharmacys array
    $pharmacys_arr=array();
    $pharmacys_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $pharmacy_item=array(
            "id" => $id,
            "image" => $image,
            "name" => $name,
            "address" => $address,
            "operation_hour" => $address,
            "contact" => $contact,
            "facebook" => $facebook,
            "map" => $map,
            "category_id" => $category_id,
            "category_state" => $category_state
        );
  
        array_push($pharmacys_arr["records"], $pharmacy_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show pharmacys data
    echo json_encode($pharmacys_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no pharmacy found
    echo json_encode(
        array("message" => "No pharmacies found.")
    );
}
?>
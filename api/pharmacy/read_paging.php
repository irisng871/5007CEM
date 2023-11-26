<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/pharmacy.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and pharmacy object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$pharmacy = new Pharmacy($db);
  
// query pharmacys
$stmt = $pharmacy->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // pharmacys array
    $pharmacys_arr=array();
    $pharmacys_arr["records"]=array();
    $pharmacys_arr["paging"]=array();
  
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
            "operation_hour" => $operation_hour,
            "contact" => $contact,
            "facebook" => $facebook,
            "map" => $map,
            "category_id" => $category_id,
            "category_state" => $category_state
        );
  
        array_push($pharmacys_arr["records"], $pharmacy_item);
    }
  
  
    // include paging
    $total_rows=$pharmacy->count();
    $page_url="{$home_url}pharmacy/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $pharmacys_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($pharmacys_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user pharmacys does not exist
    echo json_encode(
        array("message" => "No pharmacies found.")
    );
}
?>
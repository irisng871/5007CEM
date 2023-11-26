<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/healthProduct.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and healthProduct object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$healthProduct = new HealthProduct($db);
  
// query healthProducts
$stmt = $healthProduct->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // healthProducts array
    $healthProducts_arr=array();
    $healthProducts_arr["records"]=array();
    $healthProducts_arr["paging"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $healthProduct_item=array(
            "id" => $id,
            "image" => $image,
            "name" => $name,
            "ingredient" => $ingredient,
            "directions" => $directions,
            "category_id" => $category_id,
            "category_brand" => $category_brand
        );
  
        array_push($healthProducts_arr["records"], $healthProduct_item);
    }
  
  
    // include paging
    $total_rows=$healthProduct->count();
    $page_url="{$home_url}healthProduct/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $healthProducts_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($healthProducts_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user healthProducts does not exist
    echo json_encode(
        array("message" => "No Health Products found.")
    );
}
?>
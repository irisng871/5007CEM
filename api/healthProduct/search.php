<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/healthProduct.php';
  
// instantiate database and healthProduct object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$healthProduct = new HealthProduct($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query healthProducts
$stmt = $healthProduct->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // healthProducts array
    $healthProducts_arr=array();
    $healthProducts_arr["records"]=array();
  
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
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show healthProducts data
    echo json_encode($healthProducts_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no healthProducts found
    echo json_encode(
        array("message" => "No Health Products found.")
    );
}
?>
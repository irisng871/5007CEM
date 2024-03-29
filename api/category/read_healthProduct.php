<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/category_healthProduct.php';
  
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$category_healthProduct = new Category_healthProduct($db);
  
// query categorys
$stmt = $category_healthProduct->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $category_healthProducts_arr=array();
    $category_healthProducts_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $category_healthProduct_item=array(
            "id" => $id,
            "brand" => $brand
        );
  
        array_push($category_healthProducts_arr["records"], $category_healthProduct_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show categories data in json format
    echo json_encode($category_healthProducts_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no categories found
    echo json_encode(
        array("message" => "No categories found.")
    );
}
?>
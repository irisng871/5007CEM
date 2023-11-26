<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/medicalProduct.php';
  
// instantiate database and medicalProduct object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$medicalProduct = new MedicalProduct($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query medicalProducts
$stmt = $medicalProduct->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // medicalProducts array
    $medicalProducts_arr=array();
    $medicalProducts_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $medicalProduct_item=array(
            "id" => $id,
            //"image" => $image,
            "name" => $name,
            "ingredient" => $ingredient,
            "directions" => $directions,
            "category_id" => $category_id,
            "category_symptoms" => $category_symptoms
        );
  
        array_push($medicalProducts_arr["records"], $medicalProduct_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show medicalProducts data
    echo json_encode($medicalProducts_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no medicalProducts found
    echo json_encode(
        array("message" => "No Medical Products found.")
    );
}
?>
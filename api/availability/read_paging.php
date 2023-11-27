<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/availability.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and availability object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$availability = new Availability($db);
  
// query availabilitys
$stmt = $availability->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // boosking array
    $availabilitys_arr=array();
    $availabilitys_arr["records"]=array();
    $availabilitys_arr["paging"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $availability_item=array(
            "id" => $id,
            "booking_id" => $booking_id,
            "state" => $state,
            "date" => $date,
            "time" => $time,
            "user_id" => $user_id,
            "user_name" => $user_name,
            "user_birth_date" => $birth_date,
            "user_ic_number" => $user_ic_number,
            "user_contact" => $user_contact,
            "email" => $email,
            "pharmacy_id" => $pharmacy_id,
            "pharmacy_name" => $pharmacy_name,
            "address" => $address,
            "operation_hour" => $operation_hour,
            "pharmacy_contact" => $pharmacy_contact
        );
  
        array_push($availabilitys_arr["records"], $availability_item);
    }
  
  
    // include paging
    $total_rows=$availability->count();
    $page_url="{$home_url}availability/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $availabilitys_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($availabilitys_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user availabilitys does not exist
    echo json_encode(
        array("message" => "No pharmacies found.")
    );
}
?>
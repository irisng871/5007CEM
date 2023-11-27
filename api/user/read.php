<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
  
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$user = new User($db);
  
// query user
$stmt = $user->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // user array
    $user_arr=array();
    $user_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $user_item=array(
            "id" => $id,
            "name" => $name,
            "birth_date" => $birth_date,
            "ic_number" => $ic_number,
            "contact" => $contact,
            "email" => $email,
            "password" => $password
        );
  
        array_push($user_arr["records"], $user_item);
    }

    // set response code - 200 OK
    http_response_code(200);
  
    // show user data in json format
    echo json_encode($user_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no user found
    echo json_encode(
        array("message" => "No user found.")
    );
}
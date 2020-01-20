<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json") {

    $data = json_decode(file_get_contents("php://input"));
 
// include database and object files
// File that will accept email and passwd to read a record from the database

include_once '../config/database.php';
include_once '../objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$customer = new Customer($db);
 

// set email and password property of record to read
$customer->email = $data->email;
$customer->passwd = $data->password;
 
// read the details of product to be edited

    $customer->readOne();

 if( $customer->custID !=null){
    // create array
        $customer_arr = array(
        "custID" => $customer->custID,
        "name" => $customer->name,
        "lastname" => $customer->lastname,
        "address" => $customer->address,
        "postalcode" => $customer->postalcode,
        "typecust" => $customer->typecust,
        "phone" => $customer->phone,
        "email" => $customer->email,
        "creatDate" => $customer->creatDate,
        "creatTime" => $customer->creatTime,        
        "status" => $customer->status
        );
 
        // set response code - 200 OK
        http_response_code(200);
 
    // make it json format    
    echo json_encode($customer_arr);

    }
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the customer doesn't exist
    echo json_encode(array("message" => "Username  and\or Password are wrong or you should register first!"));
}
}
?>


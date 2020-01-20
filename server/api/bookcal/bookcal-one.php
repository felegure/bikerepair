<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
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
$customer->email = isset($_GET['email']) ? $_GET['email'] : die();
$customer->passwd = isset($_GET['passwd']) ? $_GET['passwd'] : die();
 
// read the details of product to be edited
$customer->readOne();
 
if($customer->name!=null && $customer->email!=null){
    // create array
    $customer_arr = array(
        "custID" => $customer->custID,
        "name" => $customer->name,
        "lastname" => $customer->lastname,
        "address" => $customer->adress,
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
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Username and/or Password is wrong or you should register first!"));
}
?>

?>
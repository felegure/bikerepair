<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");

/* file that will accept posted customer data to be saved in the database */
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER["CONTENT_TYPE"] == "application/json") {
 
// get database connection
    include_once '../config/database.php';
 
// instantiate customer object
    include_once '../objects/customer.php';
 
    $database = new Database();
    $db = $database->getConnection();
 
    $customer = new customer($db);
 
// get posted data   - Decode received data
    $data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
    if(
      !empty($data->name) &&
      !empty($data->lastname) &&
      !empty($data->email) &&
      !empty($data->passwd) &&
      !empty($data->postalcode) &&
      !empty($data->address) &&
      !empty($data->phone) 
      ){
      $customer->name = $data->name;
      $customer->lastname = $data->lastname;
      $customer->email = $data->email;
      $customer->passwd = md5($data->passwd);
      $customer->postalcode = $data->postalcode;
      $customer->address = $data->address;
      $customer->phone= $data->phone;
      $customer->creatDate = date('Y-m-d H:i:s');
  
      if($customer->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "customer was created."));
      }
 
    // if unable to create the customer, tell the user
      else{
 
        // set response code - 503 service unavailable
         http_response_code(503);
 
        // tell the user
         echo json_encode(array("message" => "Customer with this email already exist!"));
      }
  }       
}




<?php
// query customers
// File will output Json data based from "customer"

$stmt = $customer->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // customers array
    $customers_arr=array();
    $customers_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $customer_item=array(
            "custID" => $customer->custID,
            "name" => $customer->name,
            "lastname" => $customer->lastname,
            "address" => $customer->address,
            "typecust" => $customer->typecust,
            "phone" => $customer->phone,
            "email" => $customer->email,
            "creatDate" => $customer->creatDate,
            "creatTime" => $customer->creatTime,        
            "status" => $customer->status
        );
 
        array_push($customers_arr["records"], $customer_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show customers data in json format
    echo json_encode($customers_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no Customer found
    echo json_encode(
        array("message" => "User doesn't exist or Username/Password wrong!")
    );

}
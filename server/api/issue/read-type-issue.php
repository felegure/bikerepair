<?php
// required header
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");
 
if ($_SERVER["REQUEST_METHOD"] == "GET") {  
// include database and object files
  include_once '../config/database.php';
  include_once '../objects/issue.php';
 
// instantiate database and issue object
  $database = new Database();
  $db = $database->getConnection();
 
// initialize object
  $issue = new Issue($db);
 
// query typebikes
  $stmt = $issue->read();

  $num = $stmt->rowCount();

// check if more than 0 record found
  if($num>0){
 
    // issue_arr=array();
    $issue_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $issue_item=array(
            "issueID" => $issueID,
            "description" => html_entity_decode($description),
            "basicCost" => $basicCost, 
            "basicTime" => $basicTime, 
            "flatRate" => $flatRate

        );
 
        array_push($issue_arr["records"], $issue_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show categories data in json format
    echo json_encode($issue_arr);
 }
 
 else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no issue found
    echo json_encode(
        array("message" => "No type of issues found.")
    );
 }
}
?>
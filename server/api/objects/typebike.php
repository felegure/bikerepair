<?php
class Typebike{
 
    // database connection and table name
    private $conn;
    private $table_name = "typebike";
 
    // object properties
    public $tbikeID;
    public $description;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
// used by select drop-down list
    public function readAll(){
    //select all data
        $query = "SELECT
        tbikeID, description
        FROM
        " . $this->table_name . "
        ORDER BY
        description";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
    function read(){
 
        // select all query
        $query = "SELECT
                    tbikeID, description
                FROM
                    " . $this->table_name . " 
                   
                ORDER BY
                    description";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
}

?>
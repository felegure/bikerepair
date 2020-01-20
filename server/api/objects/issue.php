<?php
class Issue{
 
    // database connection and table name
    private $conn;
    private $table_name = "issue";
 
    // object properties
    public $issueID;
    public $description;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    function read(){
 
        // select all query
        $query = "SELECT
                    issueID, description, basicCost, basicTime, flatRate
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


<?php
class Customer{
 
    // database connection and table name
    private $conn;
    private $table_name = "customer";
 
    // object properties
    public $bookingID;
    public $dday;
    public $name;
    public $starTime;
    public $endTime;
    public $event;
    public $custID;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
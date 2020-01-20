<?php
class Invoice{
 
    // database connection and table name
    private $conn;
    private $table_name = "invoice";
 
    // object properties
    public $invID;
    public $lastname;
    public $name;
    public $address;
    public $postalcode;
    public $email;
    public $typecust;
    public $passwd;
    public $phone;
    public $creatDate;
    public $creaTime;
    public $status;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
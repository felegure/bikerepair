<?php
class Customer{
 
    // database connection and table name
    private $conn;
    private $table_name = "customer";
 
    // object properties
    public $custID;
    public $lastname;
    public $name;
    public $address;
    public $postalcode;
    public $email;
    public $typecust;
    public $passwd;
    public $phone;
    public $creatDate;
    public $creatTime;
    public $status;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used when filling up the update product form
function readOne(){
 
 //   echo "dans readOne";
        // query to read single record
    $query = "SELECT
                * 
            FROM
                " . $this->table_name . " 
            WHERE
                email = ? and passwd = ?
            LIMIT
                0,1";
   //             var_dump($query);
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
   // var_dump($query);
    // bind id of product to be updated
    $stmt->bindParam(1, $this->email);
    $stmt->bindParam(2, $this->passwd);
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 //var_dump($row);
    if($row){ 
        $this->custID = $row['custID'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->passwd = $row['passwd'];
        $this->lastname = $row['lastname'];
        $this->address = $row['address']; 
        $this->phone = $row['phone'];
        $this->postalcode = $row['postalcode'];
        $this->creatDate = $row['creatDate'];
        $this->creatTime = $row['creatTime'];
        $this->status = $row['status'];

    } else $this->custID ="";

}
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}

// create customer
function create(){
 
    // query to insert record


    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, lastname=:lastname, passwd=:passwd, email=:email, 
                address=:address, postalcode=:postalcode, phone=:phone";


    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->lastname=htmlspecialchars(strip_tags($this->lastname));
    $this->passwd=htmlspecialchars(strip_tags($this->passwd));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->address=htmlspecialchars(strip_tags($this->address));
    $this->postalcode=htmlspecialchars(strip_tags($this->postalcode));
    $this->phone=htmlspecialchars(strip_tags($this->phone));

 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":lastname", $this->lastname);
    $stmt->bindParam(":passwd", $this->passwd);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":postalcode", $this->postalcode);
    $stmt->bindParam(":phone", $this->phone);
 //   $stmt->bindParam(":creatDate", $this->creatDate);

 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;    
}
}
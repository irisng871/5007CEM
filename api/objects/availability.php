<?php
class Availability{
  
    // database connection and table name
    private $conn;
    private $table_name = "availability";
  
    // object properties
    public $id;
    public $booking_id;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read availability
    function read(){
    
        // select all query
        $query = "SELECT
                    a.id, a.booking_id,
                    b.id as booking_id, b.name, b.contact, b.ic_number, b.state, b.pharmacy, b.date, b.time,
                    u.id as user_id, u.name as user_name, u.birth_date, u.ic_number as user_ic_number, u.contact as user_contact, u.email,
                    p.id as pharmacy_id, p.name as pharmacy_name, p.address, p.operation_hour, p.contact as pharmacy_contact
                FROM
                    " . $this->table_name . " a
                    LEFT JOIN
                        booking b
                            ON b.id = a.id
                    LEFT JOIN
                        user u
                            ON b.user_id = u.id
                    LEFT JOIN
                        pharmacy p
                            ON b.pharmacy_id = p.id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create availability
    function create(){
  
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                      id=:id, booking_id=:booking_id";
      
        // prepare query
        $stmt = $this->conn->prepare($query);
      
        // sanitize
        $this->booking_id = htmlspecialchars(strip_tags($this->booking_id));
      
        // bind values
        $stmt->bindParam(":booking_id", $this->booking_id);
      
        // execute query
        if($stmt->execute()){
            return true;
        }
      
        return false;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                    a.id, a.booking_id,
                    b.id as booking_id, b.name, b.contact, b.ic_number, b.state, b.pharmacy, b.date, b.time,
                    u.id as user_id, u.name as user_name, u.birth_date, u.ic_number as user_ic_number, u.contact as user_contact, u.email,
                    p.id as pharmacy_id, p.name as pharmacy_name, p.address, p.operation_hour, p.contact as pharmacy_contact
                FROM
                    " . $this->table_name . " a
                    LEFT JOIN
                        booking b
                            ON b.id = a.id
                    LEFT JOIN
                        user u
                            ON b.user_id = u.id
                    LEFT JOIN
                        pharmacy p
                            ON b.pharmacy_id = p.id
                WHERE
                    a.id = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->booking_id = $row['booking_id'];
        $this->name = $row['name'];
        $this->contact = $row['contact'];
        $this->ic_number = $row['ic_number'];
        $this->state = $row['state'];
        $this->pharmacy = $row['pharmacy'];
        $this->date = $row['date'];
        $this->time = $row['time'];
        $this->user_id = $row['user_id'];
        $this->user_name = $row['user_name'];
        $this->birth_date = $row['birth_date'];
        $this->user_ic_number = $row['user_ic_number'];
        $this->user_contact = $row['user_contact'];
        $this->email = $row['email'];
        $this->pharmacy_id = $row['pharmacy_id'];
        $this->pharmacy_name = $row['pharmacy_name'];
        $this->address = $row['address'];
        $this->operation_hour = $row['operation_hour'];
        $this->pharmacy_contact = $row['pharmacy_contact'];
    }

    // update the user
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    booking_id = :booking_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->booking_id = htmlspecialchars(strip_tags($this->booking_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(":booking_id", $this->booking_id);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the user
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // search users
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    a.id, a.booking_id,
                    b.id as booking_id, b.name, b.contact, b.ic_number, b.state, b.pharmacy, b.date, b.time,
                    u.id as user_id, u.name as user_name, u.birth_date, u.ic_number as user_ic_number, u.contact as user_contact, u.email,
                    p.id as pharmacy_id, p.name as pharmacy_name, p.address, p.operation_hour, p.contact as pharmacy_contact
                FROM
                    " . $this->table_name . " a
                    LEFT JOIN
                        booking b
                            ON b.id = a.id
                    LEFT JOIN
                        user u
                            ON b.user_id = u.id
                    LEFT JOIN
                        pharmacy p
                            ON b.pharmacy_id = p.id
                WHERE
                    u.ic_number LIKE ? OR u.name LIKE ? OR p.name LIKE ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read users with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    a.id, a.booking_id,
                    b.id as booking_id, b.name, b.contact, b.ic_number, b.state, b.pharmacy, b.date, b.time,
                    u.id as user_id, u.name as user_name, u.birth_date, u.ic_number as user_ic_number, u.contact as user_contact, u.email,
                    p.id as pharmacy_id, p.name as pharmacy_name, p.address, p.operation_hour, p.contact as pharmacy_contact
                FROM
                    " . $this->table_name . " a
                    LEFT JOIN
                        booking b
                            ON b.id = a.id
                    LEFT JOIN
                        user u
                            ON b.user_id = u.id
                    LEFT JOIN
                        pharmacy p
                            ON b.pharmacy_id = p.id
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging users
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>
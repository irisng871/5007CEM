<?php
class Pharmacy{
  
    // database connection and table name
    private $conn;
    private $table_name = "pharmacy";
  
    // object properties
    public $id;
    public $image;
    public $name;
    public $address;
    public $operation_hour;
    public $contact;
    public $facebook;
    public $map;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read pharmacy
    function read(){
    
        // select all query
        $query = "SELECT
                    c.state as category_state, p.id, p.image, p.name, p.address, p.operation_hour, p.contact, p.facebook, p.map
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories_pharmacy c
                            ON p.category_id = c.id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create pharmacy
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                image=:image, name=:name, address=:address, operation_hour=:operation_hour, contact=:contact, facebook=:facebook, map=:map, category_id=:category_id";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->operation_hour=htmlspecialchars(strip_tags($this->operation_hour));
        $this->contact=htmlspecialchars(strip_tags($this->contact));
        $this->facebook=htmlspecialchars(strip_tags($this->facebook));
        $this->map=htmlspecialchars(strip_tags($this->map));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    
        // bind values
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":operation_hour", $this->operation_hour);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":facebook", $this->facebook);
        $stmt->bindParam(":map", $this->map);
        $stmt->bindParam(":category_id", $this->category_id);
        
    
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
                    c.state as category_state, p.id, p.image, p.name, p.address, p.operation_hour, p.contact, p.facebook, p.map, p.category_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories_pharmacy c
                            ON p.category_id = c.id
                WHERE
                    p.id = ?
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
        $this->image = $row['image'];
        $this->name = $row['name'];
        $this->address = $row['address'];
        $this->operation_hour = $row['operation_hour'];
        $this->contact = $row['contact'];
        $this->facebook = $row['facebook'];
        $this->map = $row['map'];
        $this->category_id = $row['category_id'];
        $this->category_state = $row['category_state'];
    }

    // update the pharmacy
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    image = :image,
                    name = :name,
                    address = :address,
                    operation_hour = :operation_hour,
                    contact = :contact,
                    facebook = :facebook,
                    map = :map,
                    category_id = :category_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->operation_hour=htmlspecialchars(strip_tags($this->operation_hour));
        $this->contact=htmlspecialchars(strip_tags($this->contact));
        $this->facebook=htmlspecialchars(strip_tags($this->facebook));
        $this->map=htmlspecialchars(strip_tags($this->map));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':operation_hour', $this->operation_hour);
        $stmt->bindParam(':contact', $this->contact);
        $stmt->bindParam(':facebook', $this->facebook);
        $stmt->bindParam(':map', $this->map);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the pharmacy
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

    // search pharmacys
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    c.state as category_state, p.id, p.image, p.name, p.address, p.operation_hour, p.contact, p.facebook, p.map, p.category_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories_pharmacy c
                            ON p.category_id = c.id
                WHERE
                    p.name LIKE ? OR p.address LIKE ? OR c.state LIKE ?";
    
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

    // read pharmacys with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    c.state as category_state, p.id, p.image, p.name, p.address, p.operation_hour, p.contact, p.facebook, p.map, p.category_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories_pharmacy c
                            ON p.category_id = c.id
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

    // used for paging pharmacys
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>
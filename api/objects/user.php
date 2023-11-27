<?php
class User{
  
    // database connection and table name
    private $conn;
    private $table_name = "user";
  
    // object properties
    public $id;
    public $name;
    public $birth_date;
    public $ic_number;
    public $contact;
    public $email;
    public $password;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read user
    function read(){
    
        // select all query
        $query = "SELECT
                    c.position as category_position, u.id, u.name, u.birth_date, u.ic_number, u.contact, u.email, u.password
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        categories_user c
                            ON u.category_id = c.id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create user
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                name=:name, birth_date=:birth_date, ic_number=:ic_number, contact=:contact, email=:email, password=:password";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->birth_date=htmlspecialchars(strip_tags($this->birth_date));
        $this->ic_number=htmlspecialchars(strip_tags($this->ic_number));
        $this->contact=htmlspecialchars(strip_tags($this->contact));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":birth_date", $this->birth_date);
        $stmt->bindParam(":ic_number", $this->ic_number);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
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
                    c.position as category_position, u.id, u.name, u.birth_date, u.ic_number, u.contact, u.email, u.password, u.category_id
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories_user c
                            ON u.category_id = c.id
                WHERE
                    u.id = ?
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
        $this->name = $row['name'];
        $this->birth_date = $row['birth_date'];
        $this->ic_number = $row['ic_number'];
        $this->contact = $row['contact'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->category_id = $row['category_id'];
        $this->category_position = $row['category_position'];
    }

    // update the user
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    birth_date = :birth_date,
                    ic_number = :ic_number,
                    contact = :contact,
                    email = :email,
                    password = :password,
                    category_id = :category_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->birth_date=htmlspecialchars(strip_tags($this->birth_date));
        $this->ic_number=htmlspecialchars(strip_tags($this->ic_number));
        $this->contact=htmlspecialchars(strip_tags($this->contact));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":birth_date", $this->birth_date);
        $stmt->bindParam(":ic_number", $this->ic_number);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":category_id", $this->category_id);
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
                    c.position as category_position, u.id, u.name, u.birth_date, u.ic_number, u.contact, u.email, u.password, u.category_id
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        categories_user c
                            ON u.category_id = c.id
                WHERE
                    u.name LIKE ? OR u.email LIKE ? OR u.position LIKE ?";
    
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
                    c.position as category_position, u.id, u.name, u.birth_date, u.ic_number, u.contact, u.email, u.password, u.category_id
                FROM
                    " . $this->table_name . " u
                    LEFT JOIN
                        categories_user c
                            ON u.category_id = c.id
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
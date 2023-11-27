<?php
class healthProduct{
  
    // database connection and table name
    private $conn;
    private $table_name = "healthProduct";
  
    // object properties
    public $id;
    public $image;
    public $name;
    public $ingredient;
    public $directions;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    c.brand as category_brand, h.id, h.image, h.name, h.ingredient, h.directions
                FROM
                    " . $this->table_name . " h
                    LEFT JOIN
                        categories_healthProduct c
                            ON h.category_id = c.id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create healthProduct
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                image=:image, name=:name, ingredient=:ingredient, directions=:directions, category_id=:category_id";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->ingredient=htmlspecialchars(strip_tags($this->ingredient));
        $this->directions=htmlspecialchars(strip_tags($this->directions));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    
        // bind values
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":ingredient", $this->ingredient);
        $stmt->bindParam(":directions", $this->directions);
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
                    c.brand as category_brand, h.id, h.image, h.name, h.ingredient, h.directions, h.category_id
                FROM
                    " . $this->table_name . " h
                    LEFT JOIN
                        categories_healthProduct c
                            ON h.category_id = c.id
                WHERE
                    h.id = ?
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
        $this->ingredient = $row['ingredient'];
        $this->directions = $row['directions'];
        $this->category_id = $row['category_id'];
        $this->category_brand = $row['category_brand'];
    }

    // delete the healthProduct
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

    // search healthProducts
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    c.brand as category_brand, h.id, h.image, h.name, h.ingredient, h.directions, h.category_id
                FROM
                    " . $this->table_name . " h
                    LEFT JOIN
                        categories_healthProduct c
                            ON h.category_id = c.id
                WHERE
                    h.name LIKE ? OR h.ingredient LIKE ? OR c.brand LIKE ?";
    
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

    // read healthProducts with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    c.brand as category_brand, h.id, h.image, h.name, h.ingredient, h.directions, h.category_id
                FROM
                    " . $this->table_name . " h
                    LEFT JOIN
                        categories_healthProduct c
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

    // used for paging healthProducts
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>
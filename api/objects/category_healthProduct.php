<?php
class Category_healthProduct{
  
    // database connection and table name
    private $conn;
    private $table_name = "categories_healthProduct";
  
    // object properties
    public $id;
    public $brand;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, brand
                FROM
                    " . $this->table_name . "
                ORDER BY
                    brand";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT
                    id, brand
                FROM
                    " . $this->table_name . "
                ORDER BY
                    brand";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }
}
?>
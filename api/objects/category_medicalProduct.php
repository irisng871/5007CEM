<?php
class Category_medicalProduct{
  
    // database connection and table name
    private $conn;
    private $table_name = "categories_medicalProduct";
  
    // object properties
    public $id;
    public $symptoms;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, symptoms
                FROM
                    " . $this->table_name . "
                ORDER BY
                    symptoms";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT
                    id, symptoms
                FROM
                    " . $this->table_name . "
                ORDER BY
                    symptoms";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }
}
?>
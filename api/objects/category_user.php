<?php
class Category_user{
  
    // database connection and table name
    private $conn;
    private $table_name = "categories_user";
  
    // object properties
    public $id;
    public $position;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, position
                FROM
                    " . $this->table_name . "
                ORDER BY
                    position";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT
                    id, position
                FROM
                    " . $this->table_name . "
                ORDER BY
                    position";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }
}
?>
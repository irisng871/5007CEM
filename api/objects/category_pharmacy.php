<?php
class Category_pharmacy{
  
    // database connection and table name
    private $conn;
    private $table_name = "categories_pharmacy";
  
    // object properties
    public $id;
    public $state;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, state
                FROM
                    " . $this->table_name . "
                ORDER BY
                    state";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT
                    id, state
                FROM
                    " . $this->table_name . "
                ORDER BY
                    state";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }
}
?>
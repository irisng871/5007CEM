<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "careplusdb";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }

    public function getMapEmbedLink() {
        $sql = "SELECT map FROM pharmacy";
        $stmt = $this->conn->query($sql);

        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row["map"];
            } else {
                return "No results found.";
            }
        } else {
            return "Error in query execution.";
        }
    }

    public function getFacebookLink() {
        $sql = "SELECT facebook FROM pharmacy";
        $stmt = $this->conn->query($sql);

        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row["facebook"];
            } else {
                return "No results found.";
            }
        } else {
            return "Error in query execution.";
        }
    }
}
?>
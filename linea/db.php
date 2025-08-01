<?php
class Database {
    private $conn;

    public function __construct($host="localhost", $db="linea", $user="root", $pass="MW@dmin") {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Method for queries with optional parameters
    public function run_query($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query); // Prepare the query
            $stmt->execute($params); // Bind the parameters and execute
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; // Return an empty array if there's an error
        }
    }

    // Backwards compatibility wrapper
    public function run_prep_query($query, $params) {
        return $this->run_query($query, $params);
    }
    public function close_cnx(){
		if ($this->conn){
		$this->conn = null;
		}
	}
    public function __destruct (){
		 $this->conn = null;
	}
}	
?>

<?php
// Include the config file to get the database connection constants
//include_once './config/config.php';

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;
    private $conn;

    // Connect to the database
    public function connect() {
        $this->conn = null;
        try {
            // Create a PDO instance to connect to the database
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->name,
                $this->user,
                $this->pass
            );
            // Set error mode to exception for better error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Log the error to a file (you could change the path to your preferred location)
            //error_log("Database connection error: " . $e->getMessage(), 3, "/var/log/php_errors.log");
            // Optionally, display a generic message to the user
            echo "Error connecting to the database.";
        }
        return $this->conn;
    }
}





 
// INnclude "./config/Database.php";
//
// Class Database{
//   private $host = DB_HOST;
//   private $user = DB_USER;
//   private $pass = DB_PASS;
//   private $name = DB_NAME;
//   private $conn;
//
//   public function connect(){
//       $this->conn = null;
//       try {
//            $this->conn = new PDO(
//               "mysql:host=".$this->host.";dbname=".$this->name,
//               $this->user,
//               $this->pass
//            );
//            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//       } catch (PDOException $e) {
//           echo "Error en la conexión".$e->getMessage();
//           
//       }
//       return $this->conn;
//   }
//
<?php
    class Database {
        private $host = "127.0.0.1";
        private $db_name = "gestion_universite";  
        private $username = "root";
        private $password = "";  
        public $conn;

        public function getConnection() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connexion réussie!";
            } catch (PDOException $exception) {
                echo "Erreur de connexion: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>


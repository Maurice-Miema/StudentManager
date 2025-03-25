<?php
    class Database {
        private $host = 'localhost';    
        private $db_name = 'gestion_universite'; 
        private $username = 'root';  
        private $password = '';
        private $port = '3306';
        public $conn;

        public function getConnection() {
            $this->conn = null;
            try {
                // DSN de connexion à la base de données
                $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8mb4";
                $this->conn = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
                echo "✅ Connexion réussie!";
            } catch (PDOException $exception) {
                echo "❌ Erreur de connexion: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>
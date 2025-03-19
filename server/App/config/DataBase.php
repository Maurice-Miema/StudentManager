<?php
    require_once __DIR__ . "/../../config.php"; 

    loadEnv(__DIR__ . "/../../.env"); 

    class Database {
        private $host;
        private $db_name;
        private $username;
        private $password;
        private $port;
        public $conn;

        public function __construct() {
            $this->host = $_ENV['DB_HOST'];
            $this->db_name = $_ENV['DB_NAME'];
            $this->username = $_ENV['DB_USER'];
            $this->password = $_ENV['DB_PASS'];
            $this->port = $_ENV['DB_PORT'];
        }

        public function getConnection() {
            $this->conn = null;
            try {
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

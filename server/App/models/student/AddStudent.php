<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class AddStudentModel {
        private $conn;
        private $table = "utilisateur";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function addStudent($nom, $postnom, $matricule, $password, $role) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO " . $this->table . "(nom, post_nom, matricule, mot_de_passe, role) VALUES (:nom, :postnom, :matricule, :password, :role)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":postnom", $postnom);
            $stmt->bindParam(":matricule", $matricule);
            $stmt->bindParam(":password", $hashed_password);
            $stmt->bindParam(":role", $role);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }
?>

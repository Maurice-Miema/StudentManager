<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class StudentGroupe {
        private $conn;
        private $table = "etudiant";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function studentgroupe($id_groupe, $id_promotion) {
            try {
                $query = "INSERT INTO " . $this->table . " (id_groupe, id_promotion) VALUES (:id_groupe, :id_promotion)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":id_groupe", $id_groupe);
                $stmt->bindParam(":id_promotion", $id_promotion);

                if (!$stmt->execute()) {
                    throw new Exception("Échec de l'insertion de la note.");
                }

                return true;
            } catch (Exception $e) {
                return ["error" => $e->getMessage()];
            }
        }
    }
?>

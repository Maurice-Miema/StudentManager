<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class AddGroupe {
        private $conn;
        private $table = "groupe";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function addgroupe($nom_groupe, $nom_projet) {
            try {
                $query = "INSERT INTO " . $this->table . " (nom_groupe, nom_projet) VALUES (:nom_groupe, :nom_projet)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":nom_groupe", $nom_groupe);
                $stmt->bindParam(":nom_projet", $nom_projet);

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

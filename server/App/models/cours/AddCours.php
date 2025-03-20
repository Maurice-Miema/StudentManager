<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class AddCours {
        private $conn;
        private $table = "cours";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function addcours($nom_cours, $id_professeur) {
            try {
                $query = "INSERT INTO " . $this->table . " (nom, id_professeur) VALUES (:nom_cours, :id_professeur)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":nom_cours", $nom_cours);
                $stmt->bindParam(":id_professeur", $id_professeur);

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

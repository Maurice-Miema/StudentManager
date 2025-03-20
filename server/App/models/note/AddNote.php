<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class AddNote {
        private $conn;
        private $table = "notes";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function addnote($id_etudiant, $id_cours, $note_obtenue) {
            try {
                $query = "INSERT INTO " . $this->table . " (id_etudiant, id_cours, note_obtenue) VALUES (:id_etudiant, :id_cours, :note_obtenue)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":id_etudiant", $id_etudiant);
                $stmt->bindParam(":id_cours", $id_cours);
                $stmt->bindParam(":note_obtenue", $note_obtenue);

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

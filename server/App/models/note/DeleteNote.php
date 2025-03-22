<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class DeleteNote {
        private $conn;
        private $table = "notes";

        public function __construct() {
            $database = new Database(); 
            $this->conn = $database->getConnection();
        }

        // Méthode pour supprimer l'étudiant
        public function deletenote($id_note) {
            try {

                // Supprimer la note de la table note
                $query_note = "DELETE FROM " . $this->table . " WHERE id_note = :id_note";
                $stmt_note = $this->conn->prepare($query_note);
                $stmt_note->bindParam(":id_note", $id_note);

                if (!$stmt_note->execute()) {
                    throw new Exception("Échec de la suppression de l'étudiant dans la table utilisateur.");
                }

                return true;

            } catch (Exception $e) {
                return ["error" => $e->getMessage()];
            }
        }
    }
?>

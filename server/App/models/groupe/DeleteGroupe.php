<?php
require_once __DIR__ . "/../../config/DataBase.php";

class DeleteGroupe {
    private $conn;
    private $table = "groupe";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function deleteGroupe($id_groupe) {
        try {
            // Vérifier si l'ID est valide
            if (!is_numeric($id_groupe) || $id_groupe <= 0) {
                throw new Exception("ID de groupe invalide.");
            }

            // Requête SQL pour supprimer le groupe
            $query = "DELETE FROM groupe WHERE id_groupe = :id_groupe";
            //$query = "DELETE FROM " . $this->table . " WHERE id = :id_groupe";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_groupe", $id_groupe, PDO::PARAM_INT);

            // Exécution de la requête
            if (!$stmt->execute()) {
                throw new Exception("Échec de la suppression du groupe.");
            }

            return ["success" => "Groupe supprimé avec succès."];
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
?>
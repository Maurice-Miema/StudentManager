<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class DeleteStudent {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_promotion = "promotion";

        public function __construct() {
            $database = new Database(); 
            $this->conn = $database->getConnection();
        }

        // Méthode pour supprimer l'étudiant
        public function deleteStudent($id_etudiant) {
            try {
                // Vérifier si l'étudiant existe dans la table utilisateur
                $query_check_id = "SELECT id_utilisateur FROM " . $this->table_utilisateur . " WHERE id_utilisateur = :id_etudiant";
                $stmt_check_id = $this->conn->prepare($query_check_id);
                $stmt_check_id->bindParam(":id_etudiant", $id_etudiant);
                $stmt_check_id->execute();

                // Si l'étudiant n'existe pas, retourner un message d'erreur
                if ($stmt_check_id->rowCount() == 0) {
                    return ["error" => "L'étudiant avec cet ID n'existe pas dans la base de données."];
                }

                // Démarrer une transaction
                $this->conn->beginTransaction();

                // Supprimer l'étudiant de la table utilisateur
                $query_utilisateur = "DELETE FROM " . $this->table_utilisateur . " WHERE id_utilisateur = :id_etudiant";
                $stmt_utilisateur = $this->conn->prepare($query_utilisateur);
                $stmt_utilisateur->bindParam(":id_etudiant", $id_etudiant);

                if (!$stmt_utilisateur->execute()) {
                    throw new Exception("Échec de la suppression de l'étudiant dans la table utilisateur.");
                }

                // Supprimer l'étudiant de la table promotion
                $query_promotion = "DELETE FROM " . $this->table_promotion . " WHERE id_etudiant = :id_etudiant";
                $stmt_promotion = $this->conn->prepare($query_promotion);
                $stmt_promotion->bindParam(":id_etudiant", $id_etudiant);

                if (!$stmt_promotion->execute()) {
                    throw new Exception("Échec de la suppression de l'étudiant dans la table promotion.");
                }

                // Valider la transaction
                $this->conn->commit();
                return true;

            } catch (Exception $e) {
                // Annuler la transaction en cas d'erreur
                $this->conn->rollBack();
                return ["error" => $e->getMessage()];
            }
        }
    }
?>

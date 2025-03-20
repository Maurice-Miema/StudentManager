<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class DeleteTeacher {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_professeur = "professeur";
        public function __construct() {
            $database = new Database(); 
            $this->conn = $database->getConnection();
        }

        // Méthode pour supprimer l'étudiant
        public function deleteTeacher($id_professeur) {
            try {
                // Vérifier si l'étudiant existe dans la table utilisateur
                $query_check_id = "SELECT id_utilisateur FROM " . $this->table_utilisateur . " WHERE id_utilisateur = :id_professeur";
                $stmt_check_id = $this->conn->prepare($query_check_id);
                $stmt_check_id->bindParam(":id_professeur", $id_professeur);
                $stmt_check_id->execute();

                // Si le professeur n'existe pas, retourner un message d'erreur
                if ($stmt_check_id->rowCount() == 0) {
                    return ["error" => "Le professeur avec cet ID n'existe pas dans la base de données."];
                }

                // Démarrer une transaction
                $this->conn->beginTransaction();


                // Supprimer le professeur de la table professeur
                $query_professeur = "DELETE FROM " . $this->table_professeur . " WHERE id_utilisateur = :id_professeur";
                $stmt_professeur = $this->conn->prepare($query_professeur);
                $stmt_professeur->bindParam(":id_professeur", $id_professeur);
                $stmt_professeur->execute();

                // Supprimer le professeur de la table utilisateur
                $query_utilisateur = "DELETE FROM " . $this->table_utilisateur . " WHERE id_utilisateur = :id_professeur";
                $stmt_utilisateur = $this->conn->prepare($query_utilisateur);
                $stmt_utilisateur->bindParam(":id_professeur", $id_professeur);

                if (!$stmt_utilisateur->execute()) {
                    throw new Exception("Échec de la suppression du professeur dans la table utilisateur.");
                }

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
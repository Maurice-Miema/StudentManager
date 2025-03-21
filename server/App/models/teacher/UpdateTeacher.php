<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class UpdateTeacher {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_professeur = "professeur";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function updateTeacher($id_professeur, $nom, $postnom, $matricule, $grade) {
            try {
                // Vérifier si l'ID du professeur existe
                $query_check_id = "SELECT id_utilisateur FROM " . $this->table_utilisateur . " WHERE id_utilisateur = :id_professeur";
                $stmt_check_id = $this->conn->prepare($query_check_id);
                $stmt_check_id->bindParam(":id_professeur", $id_professeur);
                $stmt_check_id->execute();

                if ($stmt_check_id->fetchColumn() === false) {
                    return ["error" => "Le professeur avec cet ID n'existe pas dans la base de données."];
                }

                // Démarrer une transaction
                $this->conn->beginTransaction();

                // Mise à jour des informations dans la table professeur
                $query_professeur = "UPDATE " . $this->table_professeur . " SET grade = :grade WHERE id_utilisateur = :id_professeur";
                $stmt_professeur = $this->conn->prepare($query_professeur);
                $stmt_professeur->bindParam(":grade", $grade);
                $stmt_professeur->bindParam(":id_professeur", $id_professeur);

                if (!$stmt_professeur->execute()) {
                    throw new Exception("Échec de la mise à jour des informations du professeur dans la table professeur");
                }

                // Mise à jour des informations dans la table utilisateur
                $query_utilisateur = "UPDATE " . $this->table_utilisateur . " 
                                    SET nom = :nom, post_nom = :postnom, matricule = :matricule
                                    WHERE id_utilisateur = :id_professeur";

                $stmt_utilisateur = $this->conn->prepare($query_utilisateur);
                $stmt_utilisateur->bindParam(":nom", $nom);
                $stmt_utilisateur->bindParam(":postnom", $postnom);
                $stmt_utilisateur->bindParam(":matricule", $matricule);
                $stmt_utilisateur->bindParam(":id_professeur", $id_professeur);

                if (!$stmt_utilisateur->execute()) {
                    throw new Exception("Échec de la mise à jour des informations du professeur dans la table utilisateur");
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

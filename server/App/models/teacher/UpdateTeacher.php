<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class UpdateStudent {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_promotion = "promotion";

        public function __construct() {
            $database = new Database();  // Connexion à la base de données
            $this->conn = $database->getConnection();
        }

        // Méthode pour mettre à jour les informations de l'étudiant
        public function updateStudent($id_etudiant, $nom, $postnom, $matricule, $promotion, $annee_academique) {
            try {
                // Vérifier si l'ID de l'étudiant existe dans la table utilisateur
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

                // Mise à jour des informations dans la table utilisateur
                $query_utilisateur = "UPDATE " . $this->table_utilisateur . " 
                                    SET nom = :nom, post_nom = :postnom, matricule = :matricule 
                                    WHERE id_utilisateur = :id_etudiant";
                $stmt_utilisateur = $this->conn->prepare($query_utilisateur);
                $stmt_utilisateur->bindParam(":nom", $nom);
                $stmt_utilisateur->bindParam(":postnom", $postnom);
                $stmt_utilisateur->bindParam(":matricule", $matricule);
                $stmt_utilisateur->bindParam(":id_etudiant", $id_etudiant);

                if (!$stmt_utilisateur->execute()) {
                    throw new Exception("Échec de la mise à jour des informations de l'étudiant dans la table utilisateur.");
                }

                // Mise à jour des informations dans la table promotion
                $query_promotion = "UPDATE " . $this->table_promotion . " 
                                    SET nom_promotion = :nom_promotion, annee_academique = :annee_academique
                                    WHERE id_etudiant = :id_etudiant";
                $stmt_promotion = $this->conn->prepare($query_promotion);
                $stmt_promotion->bindParam(":nom_promotion", $promotion);
                $stmt_promotion->bindParam(":annee_academique", $annee_academique);
                $stmt_promotion->bindParam(":id_etudiant", $id_etudiant);

                if (!$stmt_promotion->execute()) {
                    throw new Exception("Échec de la mise à jour des informations de la promotion.");
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

<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class AddStudentModel {
        private $conn;
        private $table = "utilisateur";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function addStudent($nom, $postnom, $prenom, $email, $matricule, $password, $role, $promotion, $annee_academique) {
            try {
                // Démarrer une transaction
                $this->conn->beginTransaction();

                // Hacher le mot de passe
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insérer l'étudiant
                $query = "INSERT INTO " . $this->table . "(nom, post_nom, prenom, email, matricule, mot_de_passe, role) VALUES (:nom, :postnom, :prenom, :email, :matricule, :password, :role)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":nom", $nom);
                $stmt->bindParam(":postnom", $postnom);
                $stmt->bindParam(":prenom", $postnom);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":matricule", $matricule);
                $stmt->bindParam(":password", $hashed_password);
                $stmt->bindParam(":role", $role);

                if (!$stmt->execute()) {
                    throw new Exception("Échec de l'insertion de l'étudiant.");
                }

                // Récupérer l'ID de l'étudiant ajouté
                $id_etudiant = $this->conn->lastInsertId();

                // Insérer la promotion et l'année académique
                $query_promotion = "INSERT INTO promotion (id_etudiant, nom_promotion, annee_academique) VALUES (:id_etudiant, :nom_promotion, :annee_academique)";
                $stmt_promotion = $this->conn->prepare($query_promotion);
                $stmt_promotion->bindParam(":id_etudiant", $id_etudiant);
                $stmt_promotion->bindParam(":nom_promotion", $promotion);
                $stmt_promotion->bindParam(":annee_academique", $annee_academique);

                if (!$stmt_promotion->execute()) {
                    throw new Exception("Échec de l'insertion de la promotion.");
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


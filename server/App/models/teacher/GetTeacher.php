<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class GetTeacher {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_professeur = "professeur";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function getTeacher($id_utilisateur) {
            // Vérifier si l'utilisateur existe et a le rôle "enseignant"
            $query = "SELECT id_utilisateur, nom, post_nom, prenom, email, matricule, role 
                    FROM " . $this->table_utilisateur . " 
                    WHERE id_utilisateur = :id_utilisateur AND role = 'enseignant'";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return ["error" => "Utilisateur introuvable ou non enseignant"];
            }

            // Vérifier si l'utilisateur a une correspondance dans la table professeur
            $query = "SELECT grade 
                    FROM " . $this->table_professeur . " 
                    WHERE id_utilisateur = :id_utilisateur";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();

            $professeur = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$professeur) {
                return ["error" => "Aucune information de professeur trouvée"];
            }

            // Fusionner les données utilisateur et professeur
            return array_merge($user, $professeur);
        }
    }
?>

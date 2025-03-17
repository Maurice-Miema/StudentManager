<?php
    require_once __DIR__ . "/../../config/DataBase.php";

    class AuthModel {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_promotion = "promotion";

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        public function authenticate($matricule, $password) {
            try {
                // Vérifier si l'utilisateur existe avec le matricule
                $query = "SELECT u.id_utilisateur, u.nom, u.post_nom, u.matricule, u.role, u.mot_de_passe, 
                                p.nom_promotion, p.annee_academique 
                        FROM " . $this->table_utilisateur . " u
                        LEFT JOIN " . $this->table_promotion . " p ON u.id_utilisateur = p.id_etudiant
                        WHERE u.matricule = :matricule";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":matricule", $matricule);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Vérifier le mot de passe
                    if (password_verify($password, $user['mot_de_passe'])) {
                        // Supprimer le mot de passe avant de renvoyer les infos
                        unset($user['password']);
                        return $user;
                    } else {
                        return ["error" => "Mot de passe incorrect"];
                    }
                } else {
                    return ["error" => "Utilisateur non trouvé"];
                }
            } catch (Exception $e) {
                return ["error" => $e->getMessage()];
            }
        }
    }
?>

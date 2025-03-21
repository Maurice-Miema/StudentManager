<?php
    require_once __DIR__ . "/../../config/DataBase.php";
    require_once __DIR__ . "/../../config/Jwt.php";
    require_once __DIR__ . "/../../../vendor/autoload.php"; 
    use Firebase\JWT\JWT;


    class AuthModel {
        private $conn;
        private $table_utilisateur = "utilisateur";
        private $table_promotion = "promotion";
        private $jwt_config;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->getConnection();
            $this->jwt_config = require __DIR__ . "/../../config/Jwt.php";
        }

        public function authenticate($matricule, $password) {
            try {
                $query = "SELECT u.id_utilisateur, u.nom, u.post_nom, u.prenom, u.email, u.matricule, u.mot_de_passe, u.role, 
                        p.nom_promotion, p.annee_academique 
                        FROM " . $this->table_utilisateur . " u
                        LEFT JOIN " . $this->table_promotion . " p ON u.id_utilisateur = p.id_etudiant
                        WHERE u.matricule = :matricule";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":matricule", $matricule);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($password, $user['mot_de_passe'])) {
                        // Supprimer le mot de passe avant de renvoyer les infos
                        unset($user['mot_de_passe']);

                        // Générer le token JWT
                        $token_payload = [
                            "iss" => $this->jwt_config['issuer'],
                            "aud" => $this->jwt_config['audience'],
                            "iat" => time(), // Temps actuel
                            "exp" => time() + $this->jwt_config['expiration_time'], // Expiration
                            "data" => [
                                "id_user" => $user['id_utilisateur'],
                                "sure_name" => $user['nom'],
                                "last_name" => $user['post_nom'],
                                "first_name" => $user['prenom'],
                                "email" => $user['email'],
                                "matricule" => $user['matricule'],
                                "role" => $user['role']
                            ]
                        ];

                        $jwt = JWT::encode($token_payload, $this->jwt_config['secret_key'], $this->jwt_config['algorithm']);

                        return [
                            "message" => "Connexion réussie",
                            "token" => $jwt,
                            "user" => $user
                        ];
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

<?php
    require_once __DIR__ . "/../config/Jwt.php";
    require_once __DIR__ . "/../../vendor/autoload.php";
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    class AuthMiddleware {
        public static function verifyToken() {
            $headers = getallheaders();
            
            if (!isset($headers['Authorization'])) {
                http_response_code(401);
                echo json_encode(["error" => "Accès refusé, token manquant"]);
                exit();
            }

            // Récupérer le token depuis l'en-tête Authorization
            $authHeader = $headers['Authorization'];
            $token = str_replace("Bearer ", "", $authHeader);

            try {
                // Charger la configuration JWT
                $jwt_config = require __DIR__ . "/../config/Jwt.php";

                // Décoder le token
                $decoded = JWT::decode($token, new Key($jwt_config['secret_key'], $jwt_config['algorithm']));

                // Retourner les données du token si tout est OK
                return $decoded->data;

            } catch (Exception $e) {
                http_response_code(401);
                echo json_encode(["error" => "Token invalide ou expiré"]);
                exit();
            }
        }
    }
?>

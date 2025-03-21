<?php
    require_once __DIR__ . "/../../models/auth/AuthModel.php";

    class AuthController {
        private $authModel;
        public function __construct() {
            $this->authModel = new AuthModel();
        }

        public function login() {
            // Vérifier si les données sont envoyées en POST
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                http_response_code(405);
                echo json_encode(["error" => "Méthode non autorisée"]);
                return;
            }

            // Récupérer les données JSON envoyées
            $data = json_decode(file_get_contents("php://input"), true);

            if (!isset($data["matricule"]) || !isset($data["password"])) {
                http_response_code(400);
                echo json_encode(["error" => "Matricule et mot de passe requis"]);
                return;
            }

            $matricule = $data["matricule"];
            $password = $data["password"];

            // Vérification avec le modèle
            $result = $this->authModel->authenticate($matricule, $password);

            if (isset($result["error"])) {
                http_response_code(401); // Unauthorized
            } else {
                http_response_code(200);
            }

            echo json_encode($result);
        }
    }
?>

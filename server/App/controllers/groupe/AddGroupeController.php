<?php
    require_once __DIR__ . "/../../models/groupe/AddGroupe.php";

    class AddGroupeController {
        public function addgroupecontroller(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = json_decode(file_get_contents("php://input"), true);

                if(!isset($data["nom_groupe"], $data["nom_projet"])){
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $note = new AddGroupe();
                $result = $note->addgroupe( $data["nom_groupe"], $data["nom_projet"]);

                if ($result === true) {
                    echo json_encode(["message" => "Le groupe Ajouter avec succès"]);
                    http_response_code(200);
                }else{
                    echo json_encode(["message" => "Échec de l'ajout", "error" => $result["error"]]);
                    http_response_code(500);
                }
            }
        }
    }
?>
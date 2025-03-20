<?php
    require_once __DIR__ . "/../../models/cours/AddCours.php";

    class AddCoursController {
        public function addcourscontroller(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = json_decode(file_get_contents("php://input"), true);

                if(!isset($data["nom_cours"], $data["id_professeur"])){
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $note = new AddCours();
                $result = $note->addcours( $data["nom_cours"], $data["id_professeur"]);

                if ($result === true) {
                    echo json_encode(["message" => "La cours Ajouter avec succès"]);
                    http_response_code(200);
                }else{
                    echo json_encode(["message" => "Échec de l'ajout", "error" => $result["error"]]);
                    http_response_code(500);
                }
            }
        }
    }
?>
<?php
    require_once __DIR__ . "/../../models/student/StudentGroup.php";

    class StudentGroupeController {
        public function studentgroupecontroller(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = json_decode(file_get_contents("php://input"), true);

                if(!isset($data["id_groupe"], $data["id_promotion"])){
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $note = new StudentGroupe();
                $result = $note->studentgroupe( $data["id_groupe"], $data["id_promotion"]);

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
<?php
    require_once __DIR__ . "/../../models/note/AddNote.php";

    class AddNoteController {
        public function addnotecontroller(){
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = json_decode(file_get_contents("php://input"), true);

                if(!isset($data["id_etudiant"], $data["id_cours"], $data["note_obtenue"])){
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $note = new AddNote();
                $result = $note->addnote(
                    $data["id_etudiant"],
                    $data["id_cours"],
                    $data["note_obtenue"]
                );

                if ($result === true) {
                    echo json_encode(["message" => "La note Ajouter avec succès"]);
                    http_response_code(200);
                }else{
                    echo json_encode(["message" => "Échec de l'ajout", "error" => $result["error"]]);
                    http_response_code(500);
                }
            }
        }
    }
?>
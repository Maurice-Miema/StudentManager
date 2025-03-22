<?php
    require_once __DIR__ . "/../../models/note/GetNote.php";

    class GetNoteController {
        public function getNotesByStudent() {
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                $data = json_decode(file_get_contents("php://input"), true);

                if (!isset($data["id_etudiant"])) {
                    echo json_encode(["message" => "ID étudiant requis"]);
                    http_response_code(400);
                    exit();
                }

                $note = new GetNote();
                $result = $note->getNotesByStudent($data["id_etudiant"]);

                if (isset($result["error"])) {
                    echo json_encode(["message" => "Erreur de récupération", "error" => $result["error"]]);
                    http_response_code(500);
                } else {
                    echo json_encode($result);
                    http_response_code(200);
                }
            }

        }
    }
?>

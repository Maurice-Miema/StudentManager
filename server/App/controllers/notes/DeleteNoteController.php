<?php
    require_once __DIR__ . "/../../models/note/DeleteNote.php";

    class DeleteNoteController {
        public function delete() {
            if($_SERVER["REQUEST_METHOD"] === "DELETE") {
                // Vérification si les données sont envoyées en méthode PUT
                $data = json_decode(file_get_contents("php://input"));
                
                // Vérifier si l'ID de l'étudiant est envoyé
                if (!isset($data->id_note)) {
                    echo json_encode(["error" => "L'ID de l'étudiant est requis."]);
                    http_response_code(400); 
                    return;
                }

                $id_note = $data->id_note;

                // Appel au modèle pour supprimer l'étudiant
                $deleteStudent = new DeleteNote();
                $result = $deleteStudent->deletenote($id_note);

                if (isset($result['error'])) {
                    echo json_encode($result);
                    http_response_code(500); 
                } else {
                    echo json_encode(["message" => "L'étudiant a été supprimé avec succès."]);
                    http_response_code(200);  
                }
            }
        }
    }
?>

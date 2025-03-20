<?php
    require_once __DIR__ . "/../../models/teacher/DeleteTeacher.php";

    class DeleteTeacherController {
        public function delete() {
            // Vérification si les données sont envoyées en méthode PUT
            $data = json_decode(file_get_contents("php://input"));
            
            // Vérifier si l'ID de l'étudiant est envoyé
            if (!isset($data->id_professeur)) {
                echo json_encode(["error" => "L'ID du professeur est requis."]);
                http_response_code(400); 
                return;
            }

            $id_professeur = $data->id_professeur;

            // Appel au modèle pour supprimer l'étudiant
            $deleteTeacher = new DeleteTeacher();
            $result = $deleteTeacher->deleteTeacher($id_professeur);

            if (isset($result['error'])) {
                echo json_encode($result);
                http_response_code(500); 
            } else {
                echo json_encode(["message" => "Le professeur a été supprimé avec succès."]);
                http_response_code(200);  
            }
        }
    }
?>

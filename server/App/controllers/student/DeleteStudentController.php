<?php
    require_once __DIR__ . "/../../models/student/DeleteStudent.php";
    require_once __DIR__ . "/../../middleware/AuthMiddleware.php";

    class DeleteStudentController {
        public function delete() {
            $user = AuthMiddleware::verifyToken();
            // Vérification si les données sont envoyées en méthode PUT
            $data = json_decode(file_get_contents("php://input"));
            
            // Vérifier si l'ID de l'étudiant est envoyé
            if (!isset($data->id_etudiant)) {
                echo json_encode(["error" => "L'ID de l'étudiant est requis."]);
                http_response_code(400); 
                return;
            }

            $id_etudiant = $data->id_etudiant;

            // Appel au modèle pour supprimer l'étudiant
            $deleteStudent = new DeleteStudent();
            $result = $deleteStudent->deleteStudent($id_etudiant);

            if (isset($result['error'])) {
                echo json_encode($result);
                http_response_code(500); 
            } else {
                echo json_encode(["message" => "L'étudiant a été supprimé avec succès."]);
                http_response_code(200);  
            }
        }
    }
?>
